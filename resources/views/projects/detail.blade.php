@extends('layouts.base')
@section('title')
    Detail Project
@endsection
@section('content-header')
    <div class="container-fluid">
        <div class="container">
            <h1>Project Details</h1>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID:</strong> {{ $project->id }}</p>
                    <p><strong>Client:</strong> {{ $project->client_name }}</p>
                    <p><strong>Title:</strong> {{ $project->project_title }}</p>
                    <p><strong>Task Type:</strong> {{ $project->task_type }}</p>
                    <p><strong>Stack:</strong> {{ $project->stack }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Project Description:</strong> {{ $project->project_description }}</p>
                    <p><strong>Assigned To:</strong> {{ $project->assigned_to }}</p>
                    <p><strong>Deadline:</strong> {{ $project->deadline }}</p>
                    <p><strong>Price:</strong> {{ $project->price }}</p>
                    <p><strong>Progress:</strong> 
                        @if ($project->progress == 'to_do')
                        <span class="badge badge-info">TO DO</span>
                    @elseif ($project->progress == 'on_progress')
                        <span class="badge badge-warning">ON PROGRESS</span>
                    @elseif ($project->progress == 'complete')
                        <span class="badge badge-success">COMPLETED</span>
                    @elseif ($project->progress == 'reject')
                        <span class="badge badge-danger">REJECTED</span>
                        
                    @endif
                    </p>
                    <p><strong>Admin :</strong>
                        @if ($project->admin == 1)
                        <span class="badge badge-warning">Izzul</span>
                    @elseif ($project->admin == 2)
                        <span class="badge badge-warning">Alya</span>
                            
                        @endif
                    </p>
                   
                </div>
                {{-- make button back in right --}}
                <div class="col-md-12 text-right">
                    <a href="{{ route('projects.index') }}" class="btn btn-primary">Back</a>
                </div>  
            </div>
        </div>
    </div>
@endsection
