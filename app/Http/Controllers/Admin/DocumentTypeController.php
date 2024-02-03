<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentTypeStoreRequest;
use App\Http\Requests\DocumentTypeUpdateRequest;
use App\Models\DocumentType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class DocumentTypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:documentTypes.show|documentTypes.index|documentTypes.create|documentTypes.edit|documentTypes.destroy',['only'=>['index','show']]);
        $this->middleware('permission:documentTypes.create', ['only'=>['create', 'store']]);
        $this->middleware('permission:documentTypes.edit', ['only'=>['edit', 'update','setUser']]);
        $this->middleware('permission:documentTypes.destroy', ['only'=>['destroy']]);
    }

    public function index():View
    {
        $documentTypes = DocumentType::all();
        return view('Admin.DocumentManagement.DocumentTypes.index',compact('documentTypes'));
    }

    public function create():View
    {
        return view('Admin.DocumentManagement.DocumentTypes.create');
    }

    public function store(DocumentTypeStoreRequest $request): RedirectResponse
    {
        $logVars = logVars();
        $model = trans('messages.DocumentType.DocumentType');

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;

        try {
            $documentType = DocumentType::create($inputs);
            Log::info("DocumentType Store. ".trans('messages.InfoSuccess.Created'),array('context'=>$documentType,'logVars'=>$logVars));
            return redirect(route('admin.documentTypes.index'))->with('info',trans('messages.InfoSuccess.Created'));
        } catch (\Throwable $th) {
            Log::error(
                $th->getMessage(),array(
                    'Message'=>$th->getMessage(),
                    'Request'=>$request->all(),
                    'info'=>$logVars,
                ));
            return back()
                ->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(DocumentType $documentType): View
    {
        return view('Admin.DocumentManagement.DocumentTypes.edit',compact(
            'documentType'
        ));
    }

    public function update(DocumentTypeUpdateRequest $request, DocumentType $documentType): RedirectResponse
    {
        $logVars = logVars();
        $model = trans('messages.DocumentType.DocumentType');

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;

        try {
            $documentType->update($inputs);

            Log::info("DocumentType Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$documentType,'logVars'=>$logVars));
            return redirect(route('admin.documentTypes.edit',$documentType))->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (\Throwable $th) {
            Log::error(
                $th->getMessage(),array(
                    'Message'=>$th->getMessage(),
                    'Request'=>$request->all(),
                    'info'=>$logVars,
                ));
            return back()
                ->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function destroy(DocumentType $documentType): RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.DocumentType.DocumentType');
        try {
            $documentType->delete();
            Log::info("DocumentType Destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$documentType,'logVars'=>$logVars));
            return redirect()->route('admin.documentTypes.index')->with('info',trans('messages.InfoSuccess.Deleted'));
        } catch (\Throwable $th) {
            Log::error(
                $th->getMessage(),array(
                    'Message'=>$th->getMessage(),
                    'info'=>$logVars,
                ));
            return back()
                ->with('error',trans('messages.InfoError.Delete',['model'=>$model]));
        }
    }
}
