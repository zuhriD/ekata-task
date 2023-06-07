<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todo = Project::where('progress', 'to_do')->get()->count();
        $on_progress = Project::where('progress', 'on_progress')->get()->count();
        $completed = Project::where('progress', 'complete')->get()->count();
        $rejected = Project::where('progress', 'reject')->get()->count();

        $projects = Project::all();
       return view('projects.index', compact('projects', 'todo', 'on_progress', 'completed', 'rejected'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //buatkan validasi untuk form
        $request->validate([
            'client_name' => 'required',
            'title' => 'required',
            'task_type' => 'required',
            'stack' => 'required',
            'projectDescription' => 'required',
            'assignedTo' => 'required',
            'deadline' => 'required',
            'price' => 'required',
            'progress' => 'required',
            'admin' => 'required',
        ]);

        // buatkan kode store
        $project= Project::create([
            'client_name' => $request->client_name,
            'project_title' => $request->title,
            'task_type' => $request->task_type,
            'stack' => $request->stack,
            'project_description' => $request->projectDescription,
            'assigned_to' => $request->assignedTo,
            'deadline' => $request->deadline,
            'price' => $request->price,
            'progress' => $request->progress,
            'admin' => $request->admin,
        ]);

        if($project){
            //redirect dengan pesan sukses
            return redirect()->route('projects.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('projects.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
        $project = Project::findOrFail($project->id);
        return view('projects.detail', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'client_name' => 'required',
            'title' => 'required',
            'task_type' => 'required',
            'stack' => 'required',
            'projectDescription' => 'required',
            'assignedTo' => 'required',
            'deadline' => 'required',
            'price' => 'required',
            'progress' => 'required',
            'admin' => 'required',
        ]);

        $project = Project::findOrFail($project->id);
        $project->client_name = $request->client_name;
        $project->project_title = $request->title;
        $project->task_type = $request->task_type;
        $project->stack = $request->stack;
        $project->project_description = $request->projectDescription;
        $project->assigned_to = $request->assignedTo;
        $project->deadline = $request->deadline;
        $project->price = $request->price;
        $project->progress = $request->progress;
        $project->admin = $request->admin;
        $project->save();

        if($project){
            //redirect dengan pesan sukses
            return redirect()->route('projects.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('projects.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
         //buat kode hapus
            $project = Project::findOrFail($project->id);
            $project->delete();

            if($project){
                //redirect dengan pesan sukses
                return redirect('/')->with(['success' => 'Data Berhasil Dihapus!']);
            }else{
                //redirect dengan pesan error
                return redirect('/')->with(['error' => 'Data Gagal Dihapus!']);
            }
    }
}
