<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TaskService
{
    public function __construct() {}

    public function getAllTasks()
    {
        return Task::select(
            'tasks.id',
            'tasks.name',
            'tasks.priority',
            'projects.name as project_name'
        )
        ->leftjoin('projects', 'projects.id', '=', 'tasks.project_id')
        ->get()
        ->sortBy('priority')
        ->toArray();
    }

    public function getFilteredTasks($data)
    {
        return Task::select(
            'tasks.id',
            'tasks.name',
            'tasks.priority',
            'projects.name as project_name'
        )
        ->leftjoin('projects', 'projects.id', '=', 'tasks.project_id')
        ->where('projects.id',$data['value'])
        ->get()
        ->sortBy('priority')
        ->toArray();
    }

    public function addTask($data)
    {
        $priority = $this->getNextPriority($data['priority']);
        $task = new Task();
        $task->name = $data['name'];
        $task->priority = $priority;
        $task->project_id = $data['project_id'];
        $task->save();
        return $task;
    }

    public function getNextPriority($priority)
    {
        if(Task::where('priority',$priority)->exists())
        {
            return Task::where('priority', DB::raw("(select max(`priority`) from tasks)"))->get()[0]->priority + 1;
        }
        return $priority;
    }

    public function delete($id)
    {
        $task = Task::find($id);
        $task->delete();
        return $task;
    }

    public function getTask($id)
    {
        return Task::select(
            'tasks.id',
            'tasks.name',
            'tasks.priority',
            'projects.name as project_name'
        )
        ->leftjoin('projects', 'projects.id', '=', 'tasks.project_id')
        ->where('tasks.id',$id)
        ->first()
        ->toArray();
    }

    public function update($data)
    {
        if (!is_null($data)) {
            $task = Task::find($data['id']);
            $task->name = $data['task_name'];
            $task->priority = $task->priority;
            $task->project_id = $task->project_id;
            return $task->save();
        }
    }

    public function getProjects()
    {
        return Project::pluck('name', 'id')->toArray();
    }
}