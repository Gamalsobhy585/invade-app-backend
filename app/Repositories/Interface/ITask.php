<?php

namespace App\Repositories\Interface;

interface ITask
{
    public function get($query, $limit, $sort_by = null, $sort_direction = 'asc',$filter);
    public function save($model);
    public function delete($model);
    public function update($model, $data);
    public function restore($model);
    public function getById($id);
    public function getTotalTasks();
    public function getDeletedTasks($limit);
    public function getDeletedById($id);
    public function forceDelete($model);
    public function bulkDelete($ids);
    public function bulkRestore($ids);
    public function bulkForceDelete($ids);





}
