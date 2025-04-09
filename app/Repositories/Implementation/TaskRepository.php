<?php

namespace App\Repositories\Implementation;

use App\Models\Task;
use App\Repositories\Interface\ITask;

class TaskRepository implements ITask
{
    public function get($query, $limit, $sort_by = 'id', $sort_direction = 'asc',$filter=null)
    {
        $tasks = Task::where('user_id', auth()->user()->id)
            ->when($query, function ($q) use ($query) {
                return $q->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%");
                });
            })
            ->when($filter, function ($q) use ($filter) {
                $statusMap = [
                    'pending' => 1,
                    'completed' => 2
                ];
                
                if (array_key_exists($filter, $statusMap)) {
                    return $q->where('status', $statusMap[$filter]);
                }
                return $q;
            })
            ->orderBy($sort_by, $sort_direction)
            ->paginate($limit);

        return $tasks;
    }

    public function save($model)
    {
     return  Task::create($model);
    }

    public function delete($model)
    {
     return $model->delete(); 
    }

 
    public function update($model, $data)
    {
        $model->fill($data);
        return $model->save();
    }
    public function restore($model)
    {
     return $model->restore();
    }
    public function getById($id)
    {
        return Task::where('user_id', auth()->user()->id)->find($id);
    }

    public function getTotalTasks()
    {
     return Task::where('user_id', auth()->user()->id)->count();
    }
    public function getDeletedTasks($limit)
    {
        return Task::onlyTrashed()
            ->where('user_id', auth()->user()->id)
            ->paginate($limit);
    }

    public function getDeletedById($id)
    {
        try {
            return Task::onlyTrashed()
                ->where('id', $id)
                ->where('user_id', auth()->user()->id)
                ->first();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function forceDelete($model)
    {
        return $model->forceDelete();
    }
    public function bulkDelete($ids)
    {
        $authorizedIds = Task::whereIn('id', $ids)
            ->where('user_id', auth()->user()->id)
            ->pluck('id')
            ->toArray();
        
        $unauthorizedIds = array_diff($ids, $authorizedIds);
        
        if (empty($authorizedIds)) {
            throw new \Exception('No authorized tasks found for bulk delete');
        }
        
        $deletedCount = Task::whereIn('id', $authorizedIds)->delete();
        
        return [
            'deleted_count' => $deletedCount,
            'authorized_ids' => $authorizedIds,
            'unauthorized_ids' => $unauthorizedIds
        ];
    }
    
    public function bulkRestore($ids)
    {
        $authorizedIds = Task::onlyTrashed()
            ->whereIn('id', $ids)
            ->where('user_id', auth()->user()->id)
            ->pluck('id')
            ->toArray();
        
        $unauthorizedIds = array_diff($ids, $authorizedIds);
        
        $result = Task::onlyTrashed()
            ->whereIn('id', $authorizedIds)
            ->restore();
        
        return [
            'success' => $result,
            'authorized_ids' => $authorizedIds,
            'unauthorized_ids' => $unauthorizedIds
        ];
    }
    
    public function bulkForceDelete($ids)
    {
        $query = Task::onlyTrashed()->whereIn('id', $ids);
        
        $authorizedIds = $query->where('user_id', auth()->id())
                             ->pluck('id')
                             ->toArray();
        
        $unauthorizedIds = array_diff($ids, $authorizedIds);
        
        $anyTrashedExist = Task::onlyTrashed()->whereIn('id', $ids)->exists();
        
        $result = false;
        if (!empty($authorizedIds)) {
            $result = $query->whereIn('id', $authorizedIds)->forceDelete();
        }
        
        return [
            'success' => $result,
            'authorized_ids' => $authorizedIds,
            'unauthorized_ids' => $unauthorizedIds,
            'any_trashed_exist' => $anyTrashedExist
        ];
    }




}
