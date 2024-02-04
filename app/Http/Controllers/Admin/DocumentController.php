<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Customer;
use App\Models\Document;
use App\Models\Worker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DocumentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:documents.index|documents.create|documents.edit|documents.destroy',['only'=>['index','customerProjects','customerOpportunities','projectProjectChores','workerOpportunities']]);
        $this->middleware('permission:documents.create', ['only'=>['create', 'store',]]);
        $this->middleware('permission:documents.edit', ['only'=>['edit', 'update','massiveUpload','massiveUploadStoreWorker','massiveUploadStoreWorkers','massiveUploadStoreBusiness']]);
        $this->middleware('permission:documents.destroy', ['only'=>['destroy']]);
    }

    public function index(Request $request):View
    {
        $fromDate = $request->from_date;
        $toDate = $request->to_date;
        if(!$request->from_date){
            $fromDate = date('Y-m-d',strtotime(now()->subMonth(2)));
        }
        if(!$request->to_date){
            $toDate = date('Y-m-d',strtotime(now()));
        }
        if ($fromDate>$toDate) {
            $x = $fromDate;
            $fromDate = $toDate;
            $toDate = $x;
        }

        $filterWords = $request->filter_words;
        $words = null;
        if ($request->filter_words) {
            $words = explode(",",$request->filter_words);
        }

        $documentTypeSelected = $request->document_type_id;
        $modelSelected = $request->document_of;

        $documentTypeSelect = documentTypeSelect();
        $documentOfSelect = Document::select('documentable_type')
            ->distinct()
            ->pluck('documentable_type');

        $documents = Document::orderBy('date')
            ->filter(
                $fromDate,
                $toDate,
                $documentTypeSelected,
                $modelSelected,
                $words)
            ->get();

        return view('Admin.DocumentManagement.Documents.index',compact(
            'fromDate',
            'toDate',
            'documentTypeSelected',
            'documentTypeSelect',
            'documentOfSelect',
            'modelSelected',
            'filterWords',
            'documents',
        ));

    }

    public function create()
    {
        return '';
        $documentTypeSelect = documentTypeSelect();
        $customerSelect = customerSelect();
        $businessSelect = businessSelect();
        $workerSelect = workerSelect();
        // $projectSelect = projectSelect();
        // $projectChoreSelect = projectChoreSelect();
        // $opportunitySelect = opportunitySelect();
        $coinTypeSelect = coinTypeSelect();

        return view('Admin.DocumentManagement.Documents.create', compact(
            'documentTypeSelect',
            'customerSelect',
            'businessSelect',
            'workerSelect',
            // 'projectSelect',
            // 'projectChoreSelect',
            // 'opportunitySelect',
            'coinTypeSelect',
        ));
    }

    public function store(Request $request)
    {
        return '';
        $this->validate($request, [
            'name'              => 'required|string|max:191',
            'date'              => 'required|date',
            'document'          =>'required|file|max:10240|mimes:pdf,jpeg,png,jpg',
            'document_type_id'  =>'required|exists:document_types,id',
            'description'       =>'nullable|string|max:500',
        ]);
        if($request->is_expense){
            $this->validate($request, [
                'total'         =>'required|numeric|min:1',
                'coin_type_id'  => 'required|exists:coin_types,id',
            ]);
        }

        $logVars=logVars();
        $model = trans('messages.Document.Document');

        $inputs['name'] = $request->name;
        $inputs['description'] = $request->description;
        $inputs['document_type_id'] = $request->document_type_id;
        $inputs['user_id_mod'] = auth()->user()->id;

        if($request->is_expense){
            $this->validate($request, [
                'total'         =>'required|numeric|min:1',
                'coin_type_id'  => 'required|exists:coin_types,id',
            ]);
        }

        try {

            if($request->hasFile('document')){
                $document = $request->file('document');
                $documentName = 'doc_'.date('YmdHis').'.'.$document->getClientOriginalExtension();
                $documentNamePath = $request->document->storeAs('documents',$documentName,'public');

                $inputs['file'] = $documentNamePath;
                $inputs['extension'] = $document->getClientOriginalExtension();
            }

            switch ($request->linked_at) {
                case "App\\Models\\Customer":
                    $this->validate($request, [
                        'customer_id'  =>'required|exists:customers,id',
                    ]);
                    $linked = $request->linked_at::find($request->customer_id);

                    $inputs['customer_id'] = $linked->id;

                    if($request->is_expense){
                        $expenseInputs['total'] = $request->total;
                        $expenseInputs['date'] = date('Y-m-d',strtotime(now()));
                        $expenseInputs['name'] = $request->name;
                        $expenseInputs['description'] = $request->description;
                        $expenseInputs['coin_type_id'] = $request->coin_type_id;
                        $expenseInputs['customer_id'] = $linked->id;
                        $expense = $linked->expenses()->create($expenseInputs);
                        $expense->documents()->create($inputs);
                    }else{
                        $linked->documents()->create($inputs);
                    }
                    break;

                case "App\\Models\\Business":
                    $this->validate($request, [
                        'business_id'  =>'required|exists:businesses,id',
                    ]);
                    $linked = $request->linked_at::find($request->business_id);
                    $inputs['business_id'] = $linked->id;

                    if($request->is_expense){
                        $expenseInputs['total'] = $request->total;
                        $expenseInputs['date'] = date('Y-m-d',strtotime(now()));
                        $expenseInputs['name'] = $request->name;
                        $expenseInputs['description'] = $request->description;
                        $expenseInputs['coin_type_id'] = $request->coin_type_id;
                        $expenseInputs['business_id'] = $linked->id;
                        $expense = $linked->expenses()->create($expenseInputs);
                        $expense->documents()->create($inputs);
                    }else{
                        $linked->documents()->create($inputs);
                    }
                    break;


                case "App\\Models\\Worker":
                    $linked = $request->linked_at::find($request->worker_id);
                    $inputs['worker_id'] = $linked->id;
                    $inputs['business_id'] = $linked->business_id;

                    if($request->is_expense){
                        $this->validate($request, [
                            'total'         =>'required|numeric|min:1',
                            'coin_type_id'  => 'required|exists:coin_types,id',
                        ]);
                            $expenseInputs['total'] = $request->total;
                            $expenseInputs['date'] = date('Y-m-d',strtotime(now()));
                            $expenseInputs['name'] = $request->name;
                            $expenseInputs['description'] = $request->description;
                            $expenseInputs['coin_type_id'] = $request->coin_type_id;
                            $expenseInputs['business_id'] = $linked->business_id;
                            $expenseInputs['worker_id'] = $linked->id;
                            $expense = $linked->expenses()->create($expenseInputs);
                            $expense->documents()->create($inputs);
                    }else{
                        $linked->documents()->create($inputs);
                    }
                    break;

                // case "App\\Models\\Project":
                //     $this->validate($request, [
                //         'project_id'  =>'required|exists:projects,id',
                //     ]);
                //     $linked = $request->linked_at::find($request->project_id);
                //     $inputs['project_id'] = $linked->id;
                //     $inputs['customer_id'] = $linked->customer_id;

                //     if($request->is_expense){
                //         $expenseInputs['total'] = $request->total;
                //         $expenseInputs['date'] = date('Y-m-d',strtotime(now()));
                //         $expenseInputs['name'] = $request->name;
                //         $expenseInputs['description'] = $request->description;
                //         $expenseInputs['coin_type_id'] = $request->coin_type_id;
                //         $expenseInputs['customer_id'] = $linked->customer_id;
                //         $expenseInputs['project_id'] = $linked->id;
                //         $expense = $linked->expenses()->create($expenseInputs);
                //         $expense->documents()->create($inputs);
                //     }else{
                //         $linked->documents()->create($inputs);
                //     }
                //     break;

                // case "App\\Models\\ProjectChore":
                //     $this->validate($request, [
                //         'project_chore_id'  =>'required|exists:project_chores,id',
                //     ]);
                //     $linked = $request->linked_at::find($request->project_chore_id);
                //     $inputs['project_chore_id'] = $linked->id;
                //     $inputs['project_id'] = $linked->project_id;
                //     $inputs['customer_id'] = $linked->project->customer_id;

                //     if($request->is_expense){
                //         $expenseInputs['total'] = $request->total;
                //         $expenseInputs['date'] = date('Y-m-d',strtotime(now()));
                //         $expenseInputs['name'] = $request->name;
                //         $expenseInputs['description'] = $request->description;
                //         $expenseInputs['coin_type_id'] = $request->coin_type_id;
                //         $expenseInputs['customer_id'] = $linked->project->customer_id;
                //         $expenseInputs['project_id'] = $linked->project_id;
                //         $expenseInputs['project_chore_id'] = $linked->id;
                //         $expense = $linked->expenses()->create($expenseInputs);
                //         $expense->documents()->create($inputs);
                //     }else{
                //         $linked->documents()->create($inputs);
                //     }
                //     break;

                // case "App\\Models\\Opportunity":
                //     $this->validate($request, [
                //         'opportunity_id'  =>'required|exists:opportunities,id',
                //     ]);
                //     $linked = $request->linked_at::find($request->opportunity_id);
                //     $inputs['opportunity_id'] = $linked->id;
                //     $inputs['customer_id'] = $linked->customer_id;

                //     if($request->is_expense){
                //         $expenseInputs['total'] = $request->total;
                //         $expenseInputs['date'] = date('Y-m-d',strtotime(now()));
                //         $expenseInputs['name'] = $request->name;
                //         $expenseInputs['description'] = $request->description;
                //         $expenseInputs['coin_type_id'] = $request->coin_type_id;
                //         $expenseInputs['customer_id'] = $linked->customer_id;
                //         $expense = $linked->expenses()->create($expenseInputs);
                //         $expense->documents()->create($inputs);
                //     }else{
                //         $linked->documents()->create($inputs);
                //     }
                //     break;

            }

            Log::info("Document Store. ".trans('messages.InfoSuccess.Created'),array('logVars'=>$logVars));
            return redirect()->route('admin.documents.index')->with('info',trans('messages.InfoSuccess.Created'));

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

    public function edit(Document $document):View
    {
        $documentTypeSelect = documentTypeSelect();
        $customerSelect = customerSelect();
        $businessSelect = businessSelect();
        $workerSelect = workerSelect();
        $coinTypeSelect = coinTypeSelect();

        $documentTags = $document->tags()->get();
        $tags = '';
        foreach ($documentTags as $documentTag) {
            $tags = $tags.$documentTag->translate('name').',';
        }

        return view('Admin.DocumentManagement.Documents.edit', compact(
            'documentTypeSelect',
            'customerSelect',
            'businessSelect',
            'workerSelect',
            'coinTypeSelect',
            'document',
            'tags',
        ));
    }

    public function update(Request $request, Document $document):RedirectResponse
    {
        $this->validate($request, [
            'name'              => 'required|string|max:191',
            'date'              => 'required|date',
            'document_type_id'  => 'required|exists:document_types,id',
            'description'       => 'nullable|string|max:500',
            'tags'              => 'nullable|string',
            //'document'          => 'required|file|max:10240|mimes:pdf,jpeg,png,jpg',
        ]);

        $logVars = logVars();
        $model = trans('messages.Document.Document');
        $controllerFunction = 'DocumentController.update';

        $inputs['name'] = $request->name;
        $inputs['date'] = $request->date;
        $inputs['document_type_id'] = $request->document_type_id;
        $inputs['description'] = $request->description;
        $inputs['user_id_mod'] = auth()->user()->id;

        try {
            $document->update($inputs);
            $document->syncTags(explode(',',$request->tags));
            //https://github.com/spatie/laravel-tags/tree/main
            Log::info("Document Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$document,'logVars'=>$logVars));
            return redirect(route('admin.documents.edit',$document));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function destroy(Document $document):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Document.Document');
        $controllerFunction = 'DocumentController.destroy';
        try {
            if ($document->file) {
                if (Storage::disk('public')->exists($document->file)) {
                    Storage::disk('public')->delete($document->file);
                }
            }
            $document->delete();
            Log::info("Document Destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$document,'logVars'=>$logVars));
            return redirect()->route('admin.documents.index')->with('info',trans('messages.InfoSuccess.Deleted'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans('messages.InfoError.Delete',['model'=>$model]));
        }
    }

    public function massiveUpload():View
    {
        $documentTypeSelect = documentTypeSelect();
        $workers = Worker::orderBy('name')->orderBy('lastname')->where('status','=',1)->get();
        $business = Business::orderBy('name')->where('default','=',1)->first();

        return view('Admin.DocumentManagement.Documents.massiveUpload', compact(
            'workers',
            'documentTypeSelect',
            'business',
        ));
    }

    public function massiveUploadStoreWorker(Request $request):RedirectResponse
    {
        $this->validate($request, [
            'name'              => 'required|string|max:191',
            'date'              => 'required|date',
            'document_type_id'  =>'required|exists:document_types,id',
            'description'       =>'nullable|string|max:500',
            // 'worker_file'          =>'required|file|max:10240|mimes:pdf,jpeg,png,jpg',
        ]);

        $logVars=logVars();
        $route = $request->ubi?base64_decode($request->ubi):'admin.documents.index';
        $messageResponse = trans('messages.InfoSuccess.Created');
        $messageResponseType = 'info';

        $workers = Worker::orderBy('name')->orderBy('lastname')->where('status','=',1)->get();

        $documentInputs['date'] = $request->date;
        $documentInputs['name'] = $request->name;
        $documentInputs['document_type_id'] = $request->document_type_id;

        foreach ($workers as $worker) {
            if($request->hasFile('file_'.$worker->id)){
                $file = $request->file('file_'.$worker->id);
                $documentNamePath = $this->uploadWorkerFile($file,$worker);
                $documentInputs['file'] = $documentNamePath;
                $documentInputs['extension'] = $file->getClientOriginalExtension();
                $documentInputs['description'] = $request->description??trans('messages.Worker.Worker').':'.$worker->id.'-'.$worker->full_name;

                $documentInputs['worker_id'] = $worker->id;
                $documentInputs['business_id'] = $worker->business_id;
                $documentInputs['user_id_mod'] = auth()->user()->id;

                try {
                    $worker->documents()->create($documentInputs);
                    Log::info("Document Store. ".trans('messages.InfoSuccess.Created'),array('logVars'=>$logVars));
                } catch (\Throwable $documentException) {
                    Log::error("Attach Document Error: " . $documentException->getMessage(), array('logVars' => $logVars));
                    $messageResponseType = 'warning';
                    $messageResponse = trans('messages.InfoWarning.CreatedWithAttachFileError');
                }

                if ($worker->user) {
                    $notificationInputs['name'] = $request->name;;
                    $notificationInputs['description'] = $request->description;;
                    $notificationInputs['date'] = now();
                    $notificationInputs['readed'] = 0;
                    $notificationInputs['sender_user_id'] = auth()->user()->id;
                    $notificationInputs['user_id'] = $worker->user_id;
                    $notificationInputs['route'] = $documentNamePath;

                    try {
                        $notification = Notification::create($notificationInputs);
                    } catch (\Throwable $notificationException) {
                        Log::error("Notification Create Error: " . $notificationException->getMessage(), array('logVars' => $logVars));
                        $messageResponseType = 'warning';
                        $messageResponse = trans('messages.InfoWarning.CreatedWithNotificationError');
                    }

                    if ($notification->sendEmail()){
                        Log::info("Email Sent. ",array('logVars'=>$logVars));
                    } else {
                        $messageResponseType = 'warning';
                        $messageResponse = trans('messages.InfoWarning.CreatedWithSendMailError');
                    }
                }
            }
        }
        Log::info("Masive Document Store. ".trans('messages.InfoSuccess.Created'),array('logVars'=>$logVars));
        return redirect()->route($route)->with($messageResponseType,$messageResponse);
    }

    public function massiveUploadStoreWorkers(Request $request)
    {
        $this->validate($request, [
            'name'              => 'required|string|max:191',
            'date'              => 'required|date',
            'document_type_id'  => 'required|exists:document_types,id',
            'description'       => 'nullable|string|max:500',
            'workers'           => 'required|array|exists:workers,id|',
            'worker_file'       => 'required|file|max:10240',
        ]);

        $logVars=logVars();
        $route = $request->ubi?base64_decode($request->ubi):'admin.documents.index';
        $messageResponse = trans('messages.InfoSuccess.Created');
        $messageResponseType = 'info';

        $workers = Worker::orderBy('name')->orderBy('lastname')
            ->where('status','=',1)
            ->whereIn('id',$request->workers)
            ->get();

        $documentInputs['date'] = $request->date;
        $documentInputs['name'] = $request->name;
        $documentInputs['document_type_id'] = $request->document_type_id;


        if($request->hasFile('worker_file')){
            $file = $request->file('worker_file');

            foreach ($workers as $worker) {
                $documentNamePath = $this->uploadWorkerFile($file,$worker);
                $documentInputs['file'] = $documentNamePath;
                $documentInputs['extension'] = $file->getClientOriginalExtension();
                $documentInputs['description'] = $request->description??trans('messages.Worker.Worker').':'.$worker->id.'-'.$worker->full_name;

                $documentInputs['worker_id'] = $worker->id;
                $documentInputs['business_id'] = $worker->business_id;
                $documentInputs['user_id_mod'] = auth()->user()->id;

                try {
                    $worker->documents()->create($documentInputs);
                    Log::info("Document Store. ".trans('messages.InfoSuccess.Created'),array('logVars'=>$logVars));
                } catch (\Throwable $documentException) {
                    Log::error("Attach Document Error: " . $documentException->getMessage(), array('logVars' => $logVars));
                    $messageResponseType = 'warning';
                    $messageResponse = trans('messages.InfoWarning.CreatedWithAttachFileError');
                }

                if ($worker->user) {
                    $notificationInputs['name'] = $request->name;;
                    $notificationInputs['description'] = $request->description;;
                    $notificationInputs['date'] = now();
                    $notificationInputs['readed'] = 0;
                    $notificationInputs['sender_user_id'] = auth()->user()->id;
                    $notificationInputs['user_id'] = $worker->user_id;
                    $notificationInputs['route'] = $documentNamePath;

                    try {
                        $notification = Notification::create($notificationInputs);
                    } catch (\Throwable $notificationException) {
                        Log::error("Notification Create Error: " . $notificationException->getMessage(), array('logVars' => $logVars));
                        $messageResponseType = 'warning';
                        $messageResponse = trans('messages.InfoWarning.CreatedWithNotificationError');
                    }

                    if ($notification->sendEmail()){
                        Log::info("Email Sent. ",array('logVars'=>$logVars));
                    } else {
                        $messageResponseType = 'warning';
                        $messageResponse = trans('messages.InfoWarning.CreatedWithSendMailError');
                    }
                }
            }
        }
        Log::info("Masive Document Store. ".trans('messages.InfoSuccess.Created'),array('logVars'=>$logVars));
        return redirect()->route($route)->with($messageResponseType,$messageResponse);
    }

    public function massiveUploadStoreBusiness(Request $request)
    {
        $this->validate($request, [
            'business_id'       => 'required|exists:businesses,id',
            'name'              => 'required|string|max:191',
            'date'              => 'required|date',
            'document_type_id'  => 'required|exists:document_types,id',
            'description'       => 'nullable|string|max:500',
        ]);

        $logVars=logVars();
        $route = $request->ubi?base64_decode($request->ubi):'admin.documents.index';
        $messageResponse = trans('messages.InfoSuccess.Created');
        $messageResponseType = 'info';

        $business = Business::find($request->business_id);

        if($request->hasFile('business_files')){

            $documentInputs['date'] = $request->date;
            $documentInputs['name'] = $request->name;
            $documentInputs['document_type_id'] = $request->document_type_id;

            foreach ($request->file('business_files') as $file) {
                $documentNamePath = $this->uploadBusinessFile($file,$business);
                $documentInputs['file'] = $documentNamePath;
                $documentInputs['extension'] = $file->getClientOriginalExtension();
                $documentInputs['description'] = $request->description??trans('messages.Worker.Worker').':'.$business->id.'-'.$business->name;
                $documentInputs['business_id'] = $business->id;
                $documentInputs['user_id_mod'] = auth()->user()->id;
                try {
                    $business->documents()->create($documentInputs);
                    Log::info("Document Store. ".trans('messages.InfoSuccess.Created'),array('logVars'=>$logVars));
                } catch (\Throwable $documentException) {
                    Log::error("Attach Document Error: " . $documentException->getMessage(), array('logVars' => $logVars));
                    $messageResponseType = 'warning';
                    $messageResponse = trans('messages.InfoWarning.CreatedWithAttachFileError');
                }
            }
        }

        Log::info("Masive Document Store. ".trans('messages.InfoSuccess.Created'),array('logVars'=>$logVars));
        return redirect()->route($route)->with($messageResponseType,$messageResponse);
    }

    // JSON RESPONSE
    public function customerProjects($id):JsonResponse
    {
        $controllerFunction = 'DocumentController.customerOpportunities';
        $projects = '';
        try {
            $customer = Customer::find($id);
            $projects = $customer->projects;
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
        }finally{
            return response()->json($projects);
        }
    }

    // JSON RESPONSE
    public function customerOpportunities($id):JsonResponse
    {
        $controllerFunction = 'DocumentController.customerOpportunities';
        $opportunities = '';
        try {
            $customer = Customer::find($id);
            $opportunities = $customer->opportunities;
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
        }finally{
            return response()->json($opportunities);
        }
    }

    // public function projectProjectChores($id):JsonResponse
    // {
    //     $controllerFunction = 'DocumentController.projectProjectChores';
    //     $projectChores = '';
    //     try {
    //         $project = Project::find($id);
    //         $projectChores = $project->projectChores;
    //     } catch (\Throwable $th) {
    //         createErrorExceptionLog($th,$controllerFunction);
    //     }finally{
    //         return response()->json($projectChores);
    //     }
    // }

    // public function workerOpportunities(Worker $worker):JsonResponse
    // {
    //     $controllerFunction = 'DocumentController.workerOpportunities';
    //     $opportunities = '';
    //     try {
    //         $opportunities = Opportunity::where('user_id','=',$worker->user_id)->get();
    //     } catch (\Throwable $th) {
    //         createErrorExceptionLog($th,$controllerFunction);
    //     }finally{
    //         return response()->json($opportunities);
    //     }
    // }

    public function uploadWorkerFile(UploadedFile $file, Worker $worker):string
    {
        $folderName = 'wrk_doc';
        $fileName = $worker->id.'_'.date('YmdHis').'.'.$file->getClientOriginalExtension();

        if (!Storage::disk('public')->exists($folderName)) {
            Storage::disk('public')->makeDirectory($folderName);
        }
        $documentNamePath = $file->storeAs($folderName,$fileName,'public');
        return $documentNamePath;
    }

    public function uploadBusinessFile(UploadedFile $file, Business $business):string
    {
        $folderName = 'bsnss_doc';
        $fileName = $business->id.'_'.date('YmdHis').'.'.$file->getClientOriginalExtension();

        if (!Storage::disk('public')->exists($folderName)) {
            Storage::disk('public')->makeDirectory($folderName);
        }

        $documentNamePath = $file->storeAs($folderName,$fileName,'public');
        return $documentNamePath;
    }
}
