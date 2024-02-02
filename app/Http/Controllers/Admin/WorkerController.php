<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkerStoreRequest;
use App\Http\Requests\WorkerUpdateRequest;
use App\Models\Document;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class WorkerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:workers.show|workers.index|workers.create|workers.edit|workers.destroy',['only'=>['index','show']]);
        $this->middleware('permission:workers.create', ['only'=>['create', 'store']]);
        $this->middleware('permission:workers.edit', ['only'=>[
            'edit', 'update',
            'setUser', 'unsetUser',
            'editDocuments','addDocument','deleteDocument',
            'removePhoto'
        ]]);
        $this->middleware('permission:workers.destroy', ['only'=>['destroy']]);
    }

    public function index(Request $request):View
    {
        $status = $request->status??'1';
        $isCommercial = $request->is_commercial;

        $selectedStatus =trans('messages.All');
        $selectedIsCommercial =trans('messages.All');

        $workers = Worker::orderBy('name');

        switch ($status) {
            case '1':
                $workers = Worker::where('status','=',1);
                $selectedStatus =trans('messages.Actives');
                break;
            case '0':
                $workers = Worker::where('status','=',0);
                $selectedStatus =trans('messages.NoActives');
                break;
            case 'all':
                $selectedStatus =trans('messages.All');
                break;
        }

        switch ($isCommercial) {
            case '1':
                $workers = Worker::where('is_commercial','=',1);
                $selectedIsCommercial =trans('messages.IsCommercial');
                break;
            case '0':
                $workers = Worker::where('is_commercial','=',0);
                $selectedIsCommercial =trans('messages.NotCommercial');
                break;
        }

        $workers = $workers->get();

        $departmentSelect = departmentSelect();

        return view('Admin.Workers.index',compact(
            'workers',
            'status',
            'isCommercial',
            'selectedStatus',
            'selectedIsCommercial',
            'departmentSelect',
        ));
    }

    public function create(Request $request):View
    {
        $users = User::all();
        $countrySelect = countrySelect();
        $categorySelect = categorySelect();
        $businessSelect = businessSelect();
        $departmentSelect = departmentSelect();
        $areaSelect = areaSelect();

        $userAsign = $request->user_id?(User::find($request->user_id)):null;

        return view('Admin.Workers.create',compact(
            'countrySelect',
            'categorySelect',
            'businessSelect',
            'users',
            'userAsign',
            'departmentSelect',
            'areaSelect',
        ));
    }

    public function store(WorkerStoreRequest $request):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Worker.Worker');
        $controllerFunction = 'WorkerController.store';
        $route = $request->ubi?base64_decode($request->ubi):'admin.workers.edit';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;
        $inputs['email'] = strtolower($inputs['email']);
        $inputs['photo'] = null;
        $worker = null;

        try {
            if ($request->user_id) {
                $existUserAssign = Worker::where('user_id','=',$request->user_id)->first();
                if($existUserAssign){
                    $existUserAssign->update(['user_id'=>null]);
                }
            }

            $worker = Worker::create($inputs);
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }

        if($request->hasFile('photo')){
            try {
                $fieldName  = $worker->id.'_photo';
                $folderName = 'wrk';
                $worker->photo = setImage600($request,$fieldName,$folderName);
                $worker->save();
            } catch (\Throwable $th) {
                createErrorExceptionLog($th,$controllerFunction);
                return redirect()->route('admin.workers.edit',$worker)->with('warning',trans('messages.InfoError.ToAssignImage'));
            }
        }

        try {
            Log::info("Worker Store. ".trans('messages.InfoSuccess.Created'),array('context'=>$worker,'logVars'=>$logVars));
            return redirect()->route($route,$worker)->with('info',trans('messages.InfoSuccess.Created'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return redirect()->route('admin.workers.edit',$worker)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        }
    }

    public function show(Worker $worker)
    {
        //
    }

    public function edit(Worker $worker)
    {
        $countrySelect = countrySelect();
        $categorySelect = categorySelect();
        $businessSelect = businessSelect();
        $documentTypeSelect = documentTypeSelect();
        $coinTypeSelect = coinTypeSelect();
        $departmentSelect = departmentSelect();
        $areaSelect =areaSelect();
        $users = userSelect();

        $users = User::all();
        return view('Admin.Workers.edit',compact(
            'worker',
            'countrySelect',
            'categorySelect',
            'businessSelect',
            'documentTypeSelect',
            'coinTypeSelect',
            'departmentSelect',
            'areaSelect',
            'users',
        ));
    }

    public function update(WorkerUpdateRequest $request, Worker $worker):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Worker.Worker');
        $controllerFunction = 'WorkerController.update';
        $route = $request->ubi?base64_decode($request->ubi):'admin.workers.edit';

        $inputs = $request->except(['photo']);
        $inputs['user_id_mod'] = auth()->user()->id;
        $inputs['email'] = strtolower($inputs['email']);
        if (!$request->is_commercial) {
            $inputs['is_commercial'] = 0;
        }

        try {
            $worker->update($inputs);
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }

        if($request->hasFile('photo')){
            try {
                $fieldName  = $worker->id.'_photo';
                $folderName = 'wrk';
                $worker->photo = setImage600($request,$fieldName,$folderName);
                $worker->save();
            } catch (\Throwable $th) {
                createErrorExceptionLog($th,$controllerFunction);
                return redirect()->route('admin.workers.edit',$worker)->with('warning',trans('messages.InfoError.ToAssignImage'));
            }
        }

        try {
            Log::info("Worker Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$worker,'logVars'=>$logVars));
            return redirect()->route($route,$worker)->with('info',trans('messages.InfoSuccess.Created'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return redirect()->route('admin.workers.edit',$worker)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        }

    }

    public function destroy(Worker $worker):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Worker.Worker');
        $controllerFunction = 'WorkerController.destroy';
        $route = 'admin.workers.index';

        try {
            $documents = $worker->documents;
            if ($documents) {
                foreach ($documents as $document) {
                    if (Storage::disk('public')->exists($document->file)) {
                        Storage::disk('public')->delete($document->file);
                    }
                    $document->delete();
                }
            }

            $worker->delete();

            Log::info("Worker Destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$worker,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Deleted'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.workers.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans('messages.InfoError.Delete',['model'=>$model]));
        }
    }

    public function setUser(Request $request,Worker $worker,User $user):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Worker.Worker');
        $controllerFunction = 'WorkerController.setUser';
        $route = 'admin.workers.edit';

        try {
            $worker->user_id = $user->id;
            $worker->user_id_mod = auth()->user()->id;
            $worker->save();

            Log::info("Worker Update. Asociado Usuario a Trabajador",array('context'=>$worker,'info'=>$logVars,));
            return redirect()->route($route,$worker)
                ->with('info',trans('messages.InfoSuccess.Updated'));

        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.workers.edit',$worker)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return redirect()->route($route,$worker)->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function unsetUser(Worker $worker):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Worker.Worker');
        $controllerFunction = 'WorkerController.unsetUser';
        $route = 'admin.workers.edit';

        try {
            $worker->user_id = null;
            $worker->user_id_mod = auth()->user()->id;
            $worker->save();

            Log::info("Worker Update. Quitado usuario asociado a trabajador.",array('context'=>$worker,'info'=>$logVars,));
            return redirect()->route($route,$worker)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.workers.edit',$worker)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return redirect()->route($route,$worker)->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function editDocuments(Worker $worker):View
    {
        $documents = $worker->documents;
        $documentTypeSelect = documentTypeSelect();

        return view('Admin.Workers.documents',compact(
            'documents',
            'worker',
            'documentTypeSelect',
        ));
    }

    public function addDocument(Request $request,Worker $worker)//:RedirectResponse
    {
        $model = trans('messages.Worker.Worker');
        $controllerFunction = 'WorkerController.addDocument';
        $route = $request->ubi?base64_decode($request->ubi):'admin.workers.editDocuments';

        $this->validate($request, [
            'name'                  => 'required|string|max:191',
            'document'              => 'required|file|max:10240|mimes:pdf,jpeg,png,jpg',
            'document_type_id'      => 'required|exists:document_types,id',
            'description'           => 'nullable|string|max:500',
            'date'                  => 'required|date',
        ]);

        try {
            $document = $request->file('document');
            $documentName = 'Worker_'.$worker->id.'_'.date('YmdHis').'.'.$document->getClientOriginalExtension();
            $documentNamePath = $request->document->storeAs('documents',$documentName,'public');

            $documentInputs['name'] = $request->name;
            $documentInputs['file'] = $documentNamePath;
            $documentInputs['extension'] = $document->getClientOriginalExtension();
            $documentInputs['description'] = $request->description??trans('messages.Worker.Worker').':'.$worker->id.'-'.$worker->full_name;
            $documentInputs['document_type_id'] = $request->document_type_id;
            $documentInputs['worker_id'] = $worker->id;
            $documentInputs['date'] = $request->date;
            $documentInputs['user_id_mod'] = auth()->user()->id;

            $document = $worker->documents()->create($documentInputs);

            $tagsArray = null;
            if ($request->tags) {
                $tagsArray = explode(",", mb_strtolower($request->tags,'UTF-8'));
                $document->attachTags($tagsArray,'Worker');
            }

            Log::info("Document.Create. Añadido documento a ".$model,array('context'=>$worker,'info'=>$document,));
            return redirect()->route($route,$worker)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.workers.editDocuments',$worker)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function deleteDocument(Document $document):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Worker.Worker');
        $controllerFunction = 'WorkerController.deleteDocument';
        $worker = $document->documentable;

        try {
            if ($document->file) {
                if (Storage::disk('public')->exists($document->file)) {
                    Storage::disk('public')->delete($document->file);
                }
            }

            $document->delete();

            $worker->user_id_mod = auth()->user()->id;
            $worker->save();

            Log::info("Workers Update. ".trans('messages.InfoSuccess.DeletedOfModel',['model'=>'Documents']),array('context'=>$document,'info'=>$logVars,));
            return redirect()->route('admin.workers.edit',$worker)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.workers.editDocuments',$worker)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function removePhoto(Request $request, Worker $worker):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Worker.Worker');
        $controllerFunction = 'WorkerController.removePhoto';
        $route = $request->ubi?base64_decode($request->ubi):'admin.workers.edit';

        try {
            if ($worker->photo) {
                if (Storage::disk('public')->exists($worker->photo)) {
                    Storage::disk('public')->delete($worker->photo);
                }
            }

            $worker->photo = null;
            $worker->save();

            Log::info("Worker Update. Quitado usuario asociado a trabajador.",array('context'=>$worker,'info'=>$logVars,));
            return redirect()->route($route, $worker)->with('info',trans('messages.InfoSuccess.Deleted'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.workers.edit',$worker)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return redirect()->route($route,$worker)->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }
}
