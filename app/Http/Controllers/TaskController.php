<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Http\Requests\FormTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $Projects = Project::all();
        if ($request->ajax()) {
            $query = Task::query();
            $Seach = $request->get('searchTaskValue');
            $Filter = $request->get('selectProjrctValue');
            $Seach = str_replace(' ', '%', $Seach);
            // if ($Seach && $Filter) {
            //     $Tasks = $query->with('project')->where('name', 'like', '%' . $Seach . '%')->orWhere('project_id', $Filter)->paginate(2);
            // }
            if ($Seach) {
                $Tasks = $query->with('project')->where('name', 'like', '%' . $Seach . '%')->orWhere('description', 'like', '%' . $Seach . '%')->paginate(3);
            }
            if ($Filter) {
                $Tasks = $query->with('project')->where('project_id', $Filter)->with('project')->paginate(3);
            }

            // $Tasks = Task::with('project')->paginate(4);
            return view('Tasks.Search', compact('Tasks', 'Projects'))->render();

        }

        $Tasks = Task::with('project')->paginate(3);
        return view('Tasks.index', compact('Tasks', 'Projects'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Projects = Project::all();
        return view('Tasks.create', compact('Projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormTaskRequest $request)
    {
        // dd($request->validated());
        Task::create($request->validated());
        return redirect('/')->with('success', 'Tâche créée avec succès !');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $Projects = Project::all();

        return view('Tasks.edit', compact('task', 'Projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormTaskRequest $request, Task $task)
    {
        // dd($task);
        $task->update($request->validated());
        return redirect('/')->with('success', 'Tâche update avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/')->with('success', 'Tâche delete avec succès !');
    }
}