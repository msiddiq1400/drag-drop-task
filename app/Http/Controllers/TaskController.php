<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tasks = $this->taskService->getAllTasks();
        return view('tasks.index', compact('tasks'));
    }

    public function filter(Request $request)
    {
        $data = $request->only('value');
        $tasks = $this->taskService->getFilteredTasks($data);
        return view('tasks.index', compact('tasks'));
    }

    public function updatePriority(Request $request)
    {
        $tasks = Task::all();
        foreach ($tasks as $task) {
            foreach ($request->priority as $order) {
                if ($order['id'] == $task->id) {
                    $task->update(['priority' => $order['position']]);
                }
            }
        }
        return redirect('/tasks');
    }

    public function create()
    {
        $projects = $this->taskService->getProjects();
        return view('tasks.add',compact('projects'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->taskService->addTask($data);
        return redirect('/tasks');
    }

    public function delete(Request $request)
    {
        $status = 'Record Deleted!';
        $this->taskService->delete($request->id);
        return redirect('/tasks')->with('status', $status);
    }

    public function edit($id)
    {
        $task = $this->taskService->getTask($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $this->taskService->update($data);
        return redirect('tasks');
    }
}