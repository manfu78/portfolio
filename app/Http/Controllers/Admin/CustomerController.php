<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerContactStoreRequest;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use App\Models\CustomerContact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class CustomerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:customers.index|customers.create|customers.edit|customers.destroy',['only'=>['index','show']]);
        $this->middleware('permission:customers.create', ['only'=>['create', 'store']]);
        $this->middleware('permission:customers.edit', ['only'=>[
            'edit', 'update',
            'addContact','deleteContact',
            'editDocuments','addDocument','deleteDocument'
        ]]);
        $this->middleware('permission:customers.destroy', ['only'=>['destroy']]);
    }

    public function index(Request $request):View
    {
        $status = $request->status;
        $selectedStatus = trans('messages.All');

        switch ($status) {
            case '1':
                $customers = Customer::orderBy('name')->where('status','=',$status)->get();
                $selectedStatus = trans('messages.Actives');
                break;
            case '0':
                $customers = Customer::orderBy('name')->where('status','=',$status)->get();
                $selectedStatus = trans('messages.NoActives');
                break;
            default:
                $customers = Customer::orderBy('name')->get();
                break;
        }

        return view('Admin.Customers.index',compact(
            'customers',
            'selectedStatus',
            'status',
        ));
    }

    public function create():View
    {
        $countrySelect = countrySelect();
        $vatSelect = vatSelect();
        $paymentMethods = paymentMethodSelect();
        return view('Admin.Customers.create',compact(
            'countrySelect',
            'vatSelect',
            'paymentMethods'
        ));
    }

    public function store(CustomerStoreRequest $request):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Customer.Customers');
        $controllerFunction = 'CustomerController.store';
        $route = $request->ubi?base64_decode($request->ubi):'admin.customers.edit';

        $input = $request->all();
        $input['email'] = strtolower($input['email']);
        $input['user_id_mod'] = auth()->user()->id;

        try {
            $customer = Customer::create($input);

            Log::info("Customer Store. ".trans('messages.InfoSuccess.Created'),array('context'=>$customer,'logVars'=>$logVars));
            return redirect()->route($route,$customer)->with('info',trans('messages.InfoSuccess.Created'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.countries.edit',$customer)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function show(Customer $customer):View
    {
        return view('Admin.Customers.show',compact(
            'customer',
        ));
    }

    public function edit(Customer $customer):View
    {
        $countrySelect = countrySelect();
        $vatSelect = vatSelect();
        $paymentMethods = paymentMethodSelect();

        return view('Admin.Customers.edit',compact(
            'customer',
            'countrySelect',
            'vatSelect',
            'paymentMethods',
        ));
    }

    public function update(CustomerUpdateRequest $request,Customer $customer):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Customer.Customers');
        $controllerFunction = 'CustomerController.Update';
        $route = $request->ubi?base64_decode($request->ubi):'admin.customers.edit';

        $input = $request->all();

        if (!$request->status) {
            $input['status']='0';
        }
        $input['email'] = strtolower($input['email']);
        $input['user_id_mod'] = auth()->user()->id;

        try {
            $customer->update($input);

            Log::info("Customer Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$customer,'logVars'=>$logVars));
            return redirect()->route($route,$customer)->with('info',trans('messages.InfoSuccess.Updated'));

        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.countries.edit',$customer)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function destroy(Request $request,Customer $customer):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Customer.Customers');
        $controllerFunction = 'CustomerController.destroy';
        $route = $request->ubi?base64_decode($request->ubi):'admin.customers.index';

        try {
            $documents = $customer->documents;
            if ($documents) {
                foreach ($documents as $document) {
                    if (Storage::disk('public')->exists($document->file)) {
                        Storage::disk('public')->delete($document->file);
                    }
                }
                $documents->delete();
            }

            $customer->delete();

            Log::info("Customer Destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$customer,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Deleted'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.countries.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Delete",['model'=>$model]));
        }
    }

    public function addContact(CustomerContactStoreRequest $request,Customer $customer):RedirectResponse
    {
        $logVars=logVars();
        $controllerFunction = 'CustomerController.addContact';
        $model = trans('messages.Customer.Customers');
        $route = $request->ubi?base64_decode($request->ubi):'admin.customers.edit';

        $inputs = $request->all();
        $inputs['email'] = strtolower($inputs['email']);
        $inputs['customer_id'] = $customer->id;
        $inputs['user_id_mod'] = auth()->user()->id;

        try {
            CustomerContact::create($inputs);

            Log::info("Customers.Update. Añadido contacto a la tabla Customers.",array('context'=>$customer,'info'=>$logVars,));
            return redirect()->route($route,$customer)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route($route,$customer)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function deleteContact(Request $request, CustomerContact $customerContact):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Customer.Customers');
        $controllerFunction = 'SupplierController.deleteContact';
        $route = $request->ubi?base64_decode($request->ubi):'admin.customers.edit';

        try {
            $customer = $customerContact->customer;

            $customerContact->delete();

            $customer->user_id_mod = auth()->user()->id;
            $customer->save();

            Log::info("Customer.Update. Eliminado contacto de la tabla Customers.",array('context'=>$customer,'info'=>$logVars,));
            return redirect()->route($route,$customer)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.countries.edit',$customer)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function editDocuments(Customer $customer):View
    {
        $documents = $customer->documents;
        $documentTypeSelect = documentTypeSelect();

        return view('Admin.Customers.documents',compact(
            'customer',
            'documents',
            'documentTypeSelect',
        ));
    }

    public function addDocument(Request $request,Customer $customer)
    {
        $this->validate($request, [
            'name'                  => 'required|string|max:191',
            'document'              => 'required|file|max:10240|mimes:pdf,jpeg,png,jpg',
            'document_type_id'      => 'required|exists:document_types,id',
            'description'           => 'nullable|string|max:500',
        ]);

        $logVars=logVars();
        $model = trans('messages.Customer.Customers');
        $controllerFunction = 'CustomerController.addDocument';
        $route = $request->ubi?base64_decode($request->ubi):'admin.customers.editDocuments';

        try {
            $document = $request->file('document');
            $documentName = 'Customer_'.$customer->id.'_'.date('YmdHis').'.'.$document->getClientOriginalExtension();
            $documentNamePath = $request->document->storeAs('documents',$documentName,'public');

            $documentInputs['name'] = $request->name;
            $documentInputs['file'] = $documentNamePath;
            $documentInputs['extension'] = $document->getClientOriginalExtension();
            $documentInputs['description'] = $request->description??trans('messages.Customer.Customer').':'.$customer->id.'-'.$customer->full_name;
            $documentInputs['document_type_id'] = $request->document_type_id;
            $documentInputs['customer_id'] = $customer->id;
            $documentInputs['user_id_mod'] = auth()->user()->id;

            $document = $customer->documents()->create($documentInputs);

            $tagsArray = null;
            if ($request->tags) {
                $tagsArray = explode(",", mb_strtolower($request->tags,'UTF-8'));
                $document->attachTags($tagsArray,'Supplier');
            }

            Log::info("Document.Create. Añadido documento a ".$model,array('context'=>$document,'info'=>$logVars,));
            return redirect()->route($route,$customer)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.countries.edit',$customer)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function deleteDocument(Document $document):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Customer.Customers');
        $controllerFunction = 'CustomerController.deleteDocument';
        $route = 'admin.customers.editDocuments';
        $customer = $document->documentable;

        try {
            if ($document->file) {
                if (Storage::disk('public')->exists($document->file)) {
                    Storage::disk('public')->delete($document->file);
                }
            }

            $document->delete();

            $customer->user_id_mod = auth()->user()->id;
            $customer->save();

            Log::info("Customer.Update. Eliminado contacto de la tabla Customers.",array('context'=>$customer,'info'=>$logVars,));
            return redirect()->route($route,$customer)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.countries.edit',$customer)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }
}
