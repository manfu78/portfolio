<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierContactStoreRequest;
use App\Http\Requests\SupplierStoreRequest;
use App\Http\Requests\SupplierUpdateRequest;
use App\Models\Supplier;
use App\Models\SupplierContact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class SupplierController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:suppliers.index|suppliers.create|suppliers.edit|suppliers.destroy',['only'=>['index','show']]);
        $this->middleware('permission:suppliers.create', ['only'=>['create', 'store']]);
        $this->middleware('permission:suppliers.edit', ['only'=>[
            'edit', 'update',
            'addContact','deleteContact',
            'editDocuments','addDocument','deleteDocument'
        ]]);
        $this->middleware('permission:suppliers.destroy', ['only'=>['destroy']]);
    }

    public function index(Request $request):View
    {
        $status = $request->status;
        $selectedStatus = trans('messages.All');

        switch ($status) {
            case '1':
                $suppliers = Supplier::orderBy('name')->where('status','=',$status)->get();
                $selectedStatus = trans('messages.Actives');
                break;
            case '0':
                $suppliers = Supplier::orderBy('name')->where('status','=',$status)->get();
                $selectedStatus = trans('messages.NoActives');
                break;
            default:
                $suppliers = Supplier::orderBy('name')->get();
                break;
        }

        return view('Admin.Suppliers.index',compact(
            'suppliers',
            'selectedStatus',
            'status',
        ));
    }

    public function create():View
    {
        $countrySelect = countrySelect();
        $vatSelect = vatSelect();
        $paymentMethods = paymentMethodSelect();
        return view('Admin.Suppliers.create',compact(
            'countrySelect',
            'vatSelect',
            'paymentMethods'
        ));
    }

    public function store(SupplierStoreRequest $request):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Supplier.Suppliers');
        $controllerFunction = 'SupplierController.store';
        $route = $request->ubi?base64_decode($request->ubi):'admin.suppliers.edit';

        $input = $request->all();
        $input['email'] = strtolower($input['email']);
        $input['user_id_mod'] = auth()->user()->id;

        try {
            $supplier = Supplier::create($input);

            Log::info("Supplier Store. ".trans('messages.InfoSuccess.Created'),array('context'=>$supplier,'logVars'=>$logVars));
            return redirect()->route($route,$supplier)->with('info',trans('messages.InfoSuccess.Created'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.countries.edit',$supplier)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function show(Supplier $supplier):View
    {
        return view('Admin.Suppliers.show',compact(
            'supplier',
        ));
    }

    public function edit(Supplier $supplier):View
    {
        $countrySelect = countrySelect();
        $vatSelect = vatSelect();
        $paymentMethods = paymentMethodSelect();

        return view('Admin.Suppliers.edit',compact(
            'supplier',
            'countrySelect',
            'vatSelect',
            'paymentMethods',
        ));
    }

    public function update(SupplierUpdateRequest $request,Supplier $supplier):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Supplier.Suppliers');
        $controllerFunction = 'SupplierController.Update';
        $route = $request->ubi?base64_decode($request->ubi):'admin.suppliers.edit';

        $input = $request->all();

        if (!$request->status) {
            $input['status']='0';
        }
        $input['email'] = strtolower($input['email']);
        $input['user_id_mod'] = auth()->user()->id;

        try {
            $supplier->update($input);

            Log::info("Supplier Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$supplier,'logVars'=>$logVars));
            return redirect()->route($route,$supplier)->with('info',trans('messages.InfoSuccess.Updated'));

        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.countries.edit',$supplier)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function destroy(Request $request,Supplier $supplier):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Supplier.Suppliers');
        $controllerFunction = 'SupplierController.destroy';
        $route = $request->ubi?base64_decode($request->ubi):'admin.suppliers.index';

        try {
            $documents = $supplier->documents;
            if ($documents) {
                foreach ($documents as $document) {
                    if (Storage::disk('public')->exists($document->file)) {
                        Storage::disk('public')->delete($document->file);
                    }
                }
                $documents->delete();
            }

            $supplier->delete();

            Log::info("Supplier Destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$supplier,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Deleted'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.countries.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Delete",['model'=>$model]));
        }
    }

    public function addContact(SupplierContactStoreRequest $request,Supplier $supplier):RedirectResponse
    {
        $logVars=logVars();
        $controllerFunction = 'SupplierController.addContact';
        $model = trans('messages.Supplier.Suppliers');
        $route = $request->ubi?base64_decode($request->ubi):'admin.suppliers.edit';

        $inputs = $request->all();
        $inputs['email'] = strtolower($inputs['email']);
        $inputs['supplier_id'] = $supplier->id;
        $inputs['user_id_mod'] = auth()->user()->id;

        try {
            SupplierContact::create($inputs);

            Log::info("Suppliers.Update. Añadido contacto a la tabla Suppliers.",array('context'=>$supplier,'info'=>$logVars,));
            return redirect()->route($route,$supplier)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route($route,$supplier)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function deleteContact(Request $request, SupplierContact $supplierContact):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Supplier.Suppliers');
        $controllerFunction = 'SupplierController.deleteContact';
        $route = $request->ubi?base64_decode($request->ubi):'admin.suppliers.edit';

        try {
            $supplier = $supplierContact->supplier;

            $supplierContact->delete();

            $supplier->user_id_mod = auth()->user()->id;
            $supplier->save();

            Log::info("Supplier.Update. Eliminado contacto de la tabla Suppliers.",array('context'=>$supplier,'info'=>$logVars,));
            return redirect()->route($route,$supplier)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.countries.edit',$supplier)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function editDocuments(Supplier $supplier):View
    {
        $documents = $supplier->documents;
        $documentTypeSelect = documentTypeSelect();

        return view('Admin.Suppliers.documents',compact(
            'supplier',
            'documents',
            'documentTypeSelect',
        ));
    }

    public function addDocument(Request $request,Supplier $supplier)
    {
        $this->validate($request, [
            'name'                  => 'required|string|max:191',
            'document'              => 'required|file|max:10240|mimes:pdf,jpeg,png,jpg',
            'document_type_id'      => 'required|exists:document_types,id',
            'description'           => 'nullable|string|max:500',
        ]);

        $logVars=logVars();
        $model = trans('messages.Supplier.Suppliers');
        $controllerFunction = 'SupplierController.addDocument';
        $route = $request->ubi?base64_decode($request->ubi):'admin.suppliers.editDocuments';

        try {
            $document = $request->file('document');
            $documentName = 'Supplier_'.$supplier->id.'_'.date('YmdHis').'.'.$document->getClientOriginalExtension();
            $documentNamePath = $request->document->storeAs('documents',$documentName,'public');

            $documentInputs['name'] = $request->name;
            $documentInputs['file'] = $documentNamePath;
            $documentInputs['extension'] = $document->getClientOriginalExtension();
            $documentInputs['description'] = $request->description??trans('messages.Supplier.Supplier').':'.$supplier->id.'-'.$supplier->full_name;
            $documentInputs['document_type_id'] = $request->document_type_id;
            $documentInputs['supplier_id'] = $supplier->id;
            $documentInputs['user_id_mod'] = auth()->user()->id;

            $document = $supplier->documents()->create($documentInputs);

            $tagsArray = null;
            if ($request->tags) {
                $tagsArray = explode(",", mb_strtolower($request->tags,'UTF-8'));
                $document->attachTags($tagsArray,'Supplier');
            }

            Log::info("Document.Create. Añadido documento a ".$model,array('context'=>$document,'info'=>$logVars,));
            return redirect()->route($route,$supplier)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.countries.edit',$supplier)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function deleteDocument(Document $document):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Supplier.Suppliers');
        $controllerFunction = 'SupplierController.deleteDocument';
        $route = 'admin.suppliers.editDocuments';
        $supplier = $document->documentable;

        try {
            if ($document->file) {
                if (Storage::disk('public')->exists($document->file)) {
                    Storage::disk('public')->delete($document->file);
                }
            }

            $document->delete();

            $supplier->user_id_mod = auth()->user()->id;
            $supplier->save();

            Log::info("Supplier.Update. Eliminado contacto de la tabla Suppliers.",array('context'=>$supplier,'info'=>$logVars,));
            return redirect()->route($route,$supplier)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.countries.edit',$supplier)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }
}
