<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;
use App\Traits\ResponseTrait;
use App\Services\Interface\ITaskService;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;


use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    use ResponseTrait;
    protected ITaskService $taskService;

    public function __construct(ITaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {
        try {
            $tasks = $this->taskService->getTasks($request, $request->get("per_page", 10));
            return $this->returnDataWithPagination(
                __('messages.task.get_all'),
                200,
                TaskResource::collection($tasks)
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());
             $this->returnError(__('messages.task.get_failed'), 500);
        }
    }

    public function show(Task $task) 
    {
        try 
        {
            if ($task->user_id !== auth()->id()) {
                 $this->returnError(__('messages.task.not_found'), 404);
            }
            
            return $this->returnData(
                __('messages.task.get'),
                200,
                new TaskResource($task)
            );
        } 
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            $this->returnError(__('messages.task.get_failed'), 500);
        }
    }

    public function store(StoreTaskRequest $request)
    {
        try {
            $task = $this->taskService->createTask($request);
            return $this->success(
                __('messages.task.created'),
                201
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->returnError(__('messages.task.create_failed'), 500);
        }
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        try {
            $task = $this->taskService->updateTask($request, $task->id);
            if (!$task) {
                 $this->returnError(__('messages.task.not_found'), 404);
            }
            return $this->success(
                __('messages.task.updated'),
                200
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());
             $this->returnError(__('messages.task.update_failed'), 500);
        }
    }

    public function destroy(Task $task)
    {
        try {
            $result = $this->taskService->deleteTask($task->id);
            if (!$result) {
                 $this->returnError(__('messages.task.not_found'), 404);
            }
            return $this->success(
                __('messages.task.deleted'),
                200
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());
             $this->returnError(__('messages.task.delete_failed'), 500);
        }
    }

    public function restore( $id)
    {
        try {
            $task = $this->taskService->restoreTask($id);
            if (!$task) {
                 $this->returnError(__('messages.task.not_found'), 404);
            }
            return $this->success(
                __('messages.task.restored'),
                200
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());
             $this->returnError(__('messages.task.restore_failed'), 500);
        }
    }

    public function getDeletedTasks(Request $request)
    {
        try {
            $tasks = $this->taskService->getDeletedTasks($request->get("per_page", 10));
            return $this->returnDataWithPagination(
                __('messages.task.get_all_deleted'),
                200,
                TaskResource::collection($tasks)
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());
             $this->returnError(__('messages.task.get_failed'), 500);
        }
    }

    public function forceDelete(Task $task)
    {
        try {
            $result = $this->taskService->forceDelete($task->id);
            if (!$result) {
                 $this->returnError(__('messages.task.not_found'), 404);
            }
            return $this->success(
                __('messages.task.deleted'),
                200
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());
             $this->returnError(__('messages.task.delete_failed'), 500);
        }
    }
    public function bulkDelete(Request $request)
    {
        try {
            $ids = $request->input('ids', []);
            if (empty($ids)) {
                return $this->returnError(__('messages.task.no_ids_provided'), 400);
            }
    
            $result = $this->taskService->bulkDelete($ids);
            
            if ($result['status'] === 'partial') {
                return $this->returnData(
                    __('messages.task.partial_bulk_deleted'),
                    207,
                    $result['data']
                );
            }
    
            return $this->success(
                __('messages.task.bulk_deleted'),
                200,
                $result['data']
            );
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $statusCode = $e->getCode() ?: 500;
            return $this->returnError($e->getMessage(), $statusCode);
        }
    }
    public function bulkRestore(Request $request)
    {
        try {
            $ids = $request->input('ids', []);
            if (empty($ids)) {
                return $this->returnError(__('messages.task.no_ids_provided'), 400);
            }
    
            $result = $this->taskService->bulkRestore($ids);
            
            if ($result['status'] === 'partial') {
                return $this->returnData(
                    __('messages.task.partial_bulk_restored'),
                    207,
                    $result['data']
                );
            }
    
            return $this->success(
                __('messages.task.bulk_restored'),
                200
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->returnError(__('messages.task.bulk_restore_failed'), 500);
        }
    }
    
    public function bulkForceDelete(Request $request)
    {
        try {
            $ids = $request->input('ids', []);
            if (empty($ids)) {
                return $this->returnError(__('messages.task.no_ids_provided'), 400);
            }
    
            $result = $this->taskService->bulkForceDelete($ids);
            
            if ($result['status'] === 'partial') {
                return $this->returnData(
                    __('messages.task.partial_bulk_force_deleted'),
                    207,
                    $result['data']
                );
            }
    
            return $this->success(
                __('messages.task.bulk_force_deleted'),
                200,
                $result['data']
            );
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            
            if (str_contains($e->getMessage(), 'No trashed tasks found')) {
                return $this->returnError(__('messages.task.no_trashed_tasks'), 404);
            }
            
            return $this->returnError(__('messages.task.bulk_force_delete_failed'), 500);
        }
    }
}