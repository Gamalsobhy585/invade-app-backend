<?php

namespace App\Services;

use App\Repositories\Interface\ITask;
use App\Services\Interface\ITaskService;

use Illuminate\Support\Facades\Log;

class TaskService implements ITaskService
{
    private ITask $Taskrepo;

    public function __construct(ITask $Taskrepo)
    {
        $this->Taskrepo = $Taskrepo;
    }

    public function getTasks($request, $limit)
    {
        try {
            $query = $request->input('query');
            $sort_by = $request->input('sort_by', 'id');
            $filter = $request->input('filter');
            $sort_direction = $request->input('sort_direction', 'asc');

            return $this->Taskrepo->get($query, $limit, $sort_by, $sort_direction, $filter);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function createTask($request)
    {
        try {
            $userId = auth()->user()->id;
            $taskData = [
                'title' => $request->input('title'),
                'description' => $request->input('content'),
                'status' => $request->input('status'),
                'due_date' => $request->input('due_date'),
                'category_id' => $request->input('category_id'),
                'user_id' => $userId,
            ];
            return $this->Taskrepo->save($taskData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function updateTask($request, $id)
    {
        try {
            $task = $this->Taskrepo->getById($id);
            if (!$task) {
                return null;
            }

            $data = $request->only(['title', 'description', 'status', 'due_date', 'category_id']);
            $this->Taskrepo->update($task, $data);
            return $task;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function deleteTask($id)
    {
        try {
            $task = $this->Taskrepo->getById($id);
            if (!$task) {
                return null;
            }
            return $this->Taskrepo->delete($task);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function restoreTask($id)
    {
        try {
            $task = $this->Taskrepo->getDeletedById($id);
            
            if ($task && $task->user_id === auth()->user()->id) {
                return  $this->Taskrepo->restore($task);
            }
            
            return false;
        } catch (\Exception $e) {
            Log::error('Error restoring task: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getDeletedTasks($limit)
    {
        try {
            return $this->Taskrepo->getDeletedTasks($limit);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }


    public function forceDelete($id)
    {
        try {
            $task = $this->Taskrepo->getById($id);
            if (!$task) {
                return null;
            }
            return $this->Taskrepo->forceDelete($task);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
        
    }


  

    public function bulkDelete($ids)
    {
        try {
            $result = $this->Taskrepo->bulkDelete($ids);
            
            $response = [
                'status' => 'success',
                'data' => [
                    'deleted_ids' => $result['authorized_ids'],
                    'deleted_count' => $result['deleted_count']
                ]
            ];
            
            if (!empty($result['unauthorized_ids'])) {
                $response['status'] = 'partial';
                $response['message'] = 'Some items were not deleted due to authorization issues';
                $response['data']['unauthorized_ids'] = $result['unauthorized_ids'];
            }
            
            return $response;
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            if (str_contains($e->getMessage(), 'No authorized tasks found')) {
                throw new \Exception(__('messages.task.no_authorized_ids'), 403);
            }
            throw $e;
        }
    }
    
    public function bulkRestore($ids)
    {
        try {
            $result = $this->Taskrepo->bulkRestore($ids);
            
            if (count($result['unauthorized_ids']) > 0) {
                return [
                    'status' => 'partial',
                    'message' => 'Some items were not restored due to authorization issues',
                    'data' => $result
                ];
            }
            
            return [
                'status' => 'success',
                'data' => $result
            ];
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
    
    public function bulkForceDelete($ids)
    {
        try {
            $result = $this->Taskrepo->bulkForceDelete($ids);
            
            if (!$result['any_trashed_exist']) {
                throw new \Exception('No trashed tasks found with the given IDs');
            }
            
            if (!empty($result['unauthorized_ids']) || $result['authorized_ids'] === []) {
                return [
                    'status' => 'partial',
                    'message' => 'Some items could not be permanently deleted',
                    'data' => [
                        'deleted_ids' => $result['authorized_ids'],
                        'unauthorized_ids' => $result['unauthorized_ids'],
                        'not_trashed_ids' => array_diff($result['unauthorized_ids'], $result['authorized_ids'])
                    ]
                ];
            }
            
            return [
                'status' => 'success',
                'data' => [
                    'deleted_ids' => $result['authorized_ids']
                ]
            ];
            
        } catch (\Exception $e) {
            Log::error('Bulk force delete error: ' . $e->getMessage());
            throw $e;
        }
    }

}
