<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessStoreRequest;
use App\Models\BankAccount;
use App\Models\Business;
use App\Models\Document;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\Routing\Exception\RouteNotFoundException;


use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BusinessController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:businesses.show|businesses.index|businesses.create|businesses.edit|businesses.destroy',['only'=>['index','show']]);
        $this->middleware('permission:businesses.create', ['only'=>['create', 'store']]);
        $this->middleware('permission:businesses.edit', ['only'=>[
            'edit', 'update',
            'setUser','deleteLogo',
            'addBankAccount','delBankAccount',
            'editDocuments','addDocument','deleteDocument'
        ]]);
        $this->middleware('permission:businesses.destroy', ['only'=>['destroy']]);
    }
    public function index():View
    {
        $businesses = Business::all();
        return view('Admin.Businesses.index', compact('businesses'));
    }

    public function create():View
    {
        $bankAccounts = BankAccount::all();
        $countries = countrySelect();
        $vats = vatSelect();
        return view('Admin.Businesses.create',compact(
            'countries',
            'bankAccounts',
            'vats',
        ));
    }

    public function store(BusinessStoreRequest $request):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Business.Businesses');
        $controllerFunction = 'BusinessController.store';
        $route = $request->ubi?base64_decode($request->ubi):'admin.businesses.edit';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;

        try {
            if (!$request->default) {
                $inputs['default']='0';
            }else{
                $businessDefault = Business::where('default','=',1)->first();
                if($businessDefault){
                    $businessDefault->default = 0;
                    $businessDefault->save();
                }
            }
            $inputs['email'] = strtolower($inputs['email']);

                // if ($request->file('logo')) {
                //     $manager = new ImageManager(new Driver());
                // }

            if($request->hasFile('logo')){
                try {
                    $storagePath = storage_path()."/app/public/businesses";
                    if (!Storage::disk('public')->exists('businesses')) {
                        Storage::disk('public')->makeDirectory('businesses');
                    }

                    $manager = new ImageManager(new Driver());
                    $imageName = date('YmdHis').'.'.$request->file('logo')->getClientOriginalExtension();

                    $image = $manager->read($request->file('logo'));

                    $image = $image->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    $image->save($storagePath.'/'.$imageName);

                    //https://www.youtube.com/watch?v=iD6ThMYed9E
                    //https://image.intervention.io/v3


                    // Image::make($request->file('image'))->resize(320,246)->save('upload/category/'.$name_gen);
                    // $save_url = 'upload/category/'.$name_gen;

                    // $image = $request->file('logo');


                    // if (!Storage::disk('public')->exists('businesses')) {
                    //     Storage::disk('public')->makeDirectory('businesses');
                    // }
                    // $storagePath = storage_path()."/app/public/businesses";

                    // $img = Image::make($image->path());
                    // $img->resize(600, 600, function ($constraint) {
                    //     $constraint->aspectRatio();
                    // })->save($storagePath.'/'.$imageName);
                } catch (\Throwable $th) {
                    throw new Exception(trans("messages.InfoError.ToAssignImage",['model'=>$model]));
                }
                $inputs['logo'] = 'businesses/'.$imageName;
            }

            $business = Business::create($inputs);

            Log::info("Business Store. ".trans('messages.InfoSuccess.Created'),array('context'=>$business,'logVars'=>$logVars));
            return redirect()->route($route,$business)->with('info',trans('messages.InfoSuccess.Created'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.businesses.edit',$business)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function show(Business $business):View
    {
        return view('Admin.Businesses.show',compact(
            'business',
        ));
    }

    public function edit(Business $business):View
    {
        $bankAccounts = BankAccount::all();
        $countries = countrySelect();
        $vats = vatSelect();
        return view('Admin.Businesses.edit',compact(
            'business',
            'countries',
            'bankAccounts',
            'vats',
        ));
    }

    public function update(Request $request, Business $business):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Business.Business');
        $controllerFunction = 'BusinessController.update';
        $route = $request->ubi?base64_decode($request->ubi):'admin.businesses.edit';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;
        $inputs['email'] = strtolower($inputs['email']);

        try {
            if (!$request->default) {
                $inputs['default']='0';
            }else{
                $businessDefault = Business::where('default','=',1)->first();
                if($businessDefault){
                    $businessDefault->default = 0;
                    $businessDefault->save();
                }
            }

            if($request->hasFile('logo')){
                try {
                    $storagePath = storage_path()."/app/public/businesses";
                    if (!Storage::disk('public')->exists('businesses')) {
                        Storage::disk('public')->makeDirectory('businesses');
                    }

                    $manager = new ImageManager(new Driver());
                    $imageName = date('YmdHis').'.'.$request->file('logo')->getClientOriginalExtension();

                    $image = $manager->read($request->file('logo'));

                    $image = $image->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    $image->save($storagePath.'/'.$imageName);


                    // $image = $request->file('logo');
                    // $imageName = date('YmdHis').'.'.$request->file('logo')->getClientOriginalExtension();

                    // if (!Storage::disk('public')->exists('businesses')) {
                    //     Storage::disk('public')->makeDirectory('businesses');
                    // }
                    // $storagePath = storage_path()."/app/public/businesses";
                    // $img = Image::make($image->path());
                    // $img->resize(600, 600, function ($constraint) {
                    //     $constraint->aspectRatio();
                    // })->save($storagePath.'/'.$imageName);
                } catch (\Throwable $th) {
                    throw new Exception(trans("messages.InfoError.ToAssignImage",['model'=>$model]));
                }
                $inputs['logo'] = 'businesses/'.$imageName;
            }

            $business->update($inputs);

            Log::info("Business Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$business,'logVars'=>$logVars));
            return redirect()->route($route,$business)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.businesses.edit',$business)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function destroy(Request $request, Business $business):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Business.Business');
        $controllerFunction = 'BusinessController.destroy';
        $route = $request->ubi?base64_decode($request->ubi):'admin.businesses.index';

        try {
            if ($business->logo) {
                if (Storage::disk('public')->exists($business->logo)) {
                    Storage::disk('public')->delete($business->logo);
                }
            }

            $documents = $business->documents;
            if ($documents) {
                foreach ($documents as $document) {
                    if (Storage::disk('public')->exists($document->file)) {
                        Storage::disk('public')->delete($document->file);
                    }
                }
                $documents->delete();
            }

            $business->delete();

            Log::info("Business Destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$business,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Deleted'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.businesses.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans('messages.InfoError.Delete',['model'=>$model]));
        }
    }

    public function deleteLogo(Request $request, Business $business):RedirectResponse
    {
        $logVars=logVars();
        $controllerFunction = 'BusinessController.deleteLogo';
        $route = $request->ubi?base64_decode($request->ubi):'admin.businesses.edit';

        try {
            if ($business->logo) {
                if (Storage::disk('public')->exists($business->logo)) {
                    Storage::disk('public')->delete($business->logo);
                }
            }

            $business->logo = null;
            $business->save();

            Log::info("Business Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$business,'logVars'=>$logVars));
            return redirect()->route($route,$business)->with('info',trans('messages.InfoSuccess.DeletedImage'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.businesses.edit',$business)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.DeleteImage"));
        }
    }

    public function addBankAccount(Request $request,Business $business,BankAccount $bankAccount):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Business.Businesses');
        $controllerFunction = 'BusinessController.addBankAccount';
        $route = $request->ubi?base64_decode($request->ubi):'admin.businesses.edit';

        try {
            $countBank = $business->bankAccounts()->get()->where('id',$bankAccount->id)->count();

            if($countBank>0){
                return redirect()->route('admin.businesses.edit',$business)
                    ->with('error',trans("messages.InfoError.Duplicate"));
            }

            $business->bankAccounts()->attach($bankAccount->id);
            $business->user_id_mod = auth()->user()->id;
            $business->save();

            Log::info("Business.Update. Añadida cuenta bancaria.",array('context'=>$business,'info'=>$logVars));
            return redirect()->route($route,$business)
                ->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.businesses.edit',$business)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function delBankAccount(Request $request,Business $business):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Business.Businesses');
        $controllerFunction = 'BusinessController.deleteBankAccount';
        $route = $request->ubi?base64_decode($request->ubi):'admin.businesses.edit';

        try {
            $business->bankAccounts()->detach($request->bank);
            $business->user_id_mod = auth()->user()->id;
            $business = $business->save();

            Log::info("Business.Update. Quitada cuenta bancaria de la tabla Businesses.",array('context'=>$business,'info'=>$logVars));
            return redirect()->route($route,$business)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.businesses.edit',$business)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function editDocuments(Business $business):View
    {
        $documents = $business->documents;
        $documentTypeSelect = documentTypeSelect();

        return view('Admin.Businesses.documents',compact(
            'documents',
            'business',
            'documentTypeSelect',
        ));
    }

    public function addDocument(Request $request,Business $business):RedirectResponse
    {
        $this->validate($request, [
            'name'                  => 'required|string|max:191',
            'document'              => 'required|file|max:10240|mimes:pdf,jpeg,png,jpg',
            'document_type_id'      => 'required|exists:document_types,id',
            'description'           => 'nullable|string|max:500',
        ]);

        $logVars=logVars();
        $model = trans('messages.Business.Business');
        $controllerFunction = 'BusinessController.addDocument';
        $route = $request->ubi?base64_decode($request->ubi):'admin.businesses.editDocuments';

        try {
            $document = $request->file('document');
            $documentName = 'Business_'.$business->id.'_'.date('YmdHis').'.'.$document->getClientOriginalExtension();
            $documentNamePath = $request->document->storeAs('documents',$documentName,'public');

            $documentInputs['name'] = $request->name;
            $documentInputs['file'] = $documentNamePath;
            $documentInputs['extension'] = $document->getClientOriginalExtension();
            $documentInputs['description'] = $request->description??trans('messages.Business.Business').':'.$business->id.'-'.$business->full_name;
            $documentInputs['document_type_id'] = $request->document_type_id;
            $documentInputs['business_id'] = $business->id;
            $documentInputs['user_id_mod'] = auth()->user()->id;

            $document = $business->documents()->create($documentInputs);

            $tagsArray = null;
            if ($request->tags) {
                $tagsArray = explode(",", mb_strtolower($request->tags,'UTF-8'));
                $document->attachTags($tagsArray,'Business');
            }

            Log::info("Document.Create. Añadido documento a ".$model,array('context'=>$document,'info'=>$logVars,));
            return redirect()->route($route,$business)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.businesses.editDocuments',$business)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function deleteDocument(Document $document):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Business.Business');
        $controllerFunction = 'BusinessController.deleteDocument';
        $route = 'admin.customers.editDocuments';
        $business = $document->documentable;

        try {
            if ($document->file) {
                if (Storage::disk('public')->exists($document->file)) {
                    Storage::disk('public')->delete($document->file);
                }
            }

            $document->delete();

            $business->user_id_mod = auth()->user()->id;
            $business->save();

            Log::info("Businesses Update. ".trans('messages.InfoSuccess.DeletedOfModel',['model'=>'Documents']),array('context'=>$document,'info'=>$logVars,));
            return redirect()->route($route,$business)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.businesses.editDocuments',$business)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }
}
