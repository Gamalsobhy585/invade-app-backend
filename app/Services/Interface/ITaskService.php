<?php

namespace App\Services\Interface;

interface ITaskService
{
    public function getTasks($request, $limit);
    public function createTask($request);
    public function updateTask($request, $id);
    public function deleteTask($id);
    public function restoreTask($id);
    public function getDeletedTasks($limit);
    public function forceDelete($id);
    public function bulkDelete($ids);
    public function bulkRestore($ids);
    public function bulkForceDelete($ids);





}
