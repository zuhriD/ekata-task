@extends('layouts.base')
@section('title')
    Projects
@endsection

@section('content-header')
<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-check-square"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">TO DO</span>
              <span class="info-box-number">
                {{ $todo }} Project
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-spinner"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">On Progress</span>
              <span class="info-box-number">{{ $on_progress }} Project</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">COMPLETE</span>
              <span class="info-box-number">{{ $completed }} Project</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times-circle"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">REJECTED</span>
              <span class="info-box-number">{{ $rejected }} Project</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1>List Project Ekata Technology</h1>
      </div>
      @if (session('success'))
    <div class="col-sm-12 mt-2">
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@elseif(session('error'))
    <div class="col-sm-12 mt-2">
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

       


      {{-- buat tabel list project --}}
      <div class="col-sm-12">
        <div class="d-flex justify-content-between mt-2">
          <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addProjectModal">Add</a>
        </div>
        <table id="example2" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Project</th>
              <th>Deskripsi</th>
              <th>Deadline</th>
              <th>Progress</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($projects as $project)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $project->project_title }}</td>
              <td>{{ $project->project_description }}</td>
              <td>{{ \Carbon\Carbon::parse($project->deadline)->formatLocalized('%A, %d %B %Y') }}</td>
              <td>
                @if ($project->progress == 'to_do')
                    <span class="badge badge-info">TO DO</span>
                @elseif ($project->progress == 'on_progress')
                    <span class="badge badge-warning">ON PROGRESS</span>
                @elseif ($project->progress == 'complete')
                    <span class="badge badge-success">COMPLETED</span>
                @elseif ($project->progress == 'reject')
                    <span class="badge badge-danger">REJECTED</span>
                    
                @endif
              </td>
              <td>
                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                <a href="#" data-toggle="modal" data-target="#editProjectModal" 
                  data-id="{{ $project->id }}" 
                  class="btn btn-warning"><i class="fas fa-edit"></i></a>
                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this data?')"><i class="fas fa-trash"></i></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div><!-- /.container-fluid -->
  
  {{-- Modal Add --}}
<div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="addProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addProjectModalLabel">Add Project</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('projects.store')}}" method="POST" class="row">
            @csrf
            <div class="col-md-6">
              <div class="form-group">
                <label for="clientName">Client Name</label>
                <input type="text" class="form-control" id="clientName" placeholder="Enter client name" name="client_name" required>
              </div>
              <div class="form-group">
                <label for="projectTitle">Project Title</label>
                <input type="text" class="form-control" id="projectTitle" placeholder="Enter project title" name="title" required>
              </div>
              <!-- Form group for Task Type -->
              <div class="form-group">
                <label for="taskType">Task Type</label>
                <select class="form-control" id="taskType" name="task_type" required>
                  <option value="mobile">Mobile</option>
                  <option value="web">Web</option>
                  <option value="ui/ux">UI/UX</option>
                  <option value="desktop">Desktop</option>
                </select>
              </div>
              <div class="form-group">
                <label for="stack">Stack</label>
                <input type="text" class="form-control" id="stack" placeholder="Enter stack" name="stack" required>
              </div>
              <div class="form-group">
                <label for="projectDescription">Project Description</label>
                <textarea class="form-control" id="projectDescription" rows="3" placeholder="Enter project description" name="projectDescription" required></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="assignedTo">Assigned To</label>
                <input type="text" class="form-control" id="assignedTo" placeholder="Enter assigned to" name="assignedTo" required>
              </div>
              <div class="form-group">
                <label for="deadline">Deadline</label>
                <input type="date" class="form-control" id="deadline" name="deadline" required>
              </div>
              <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" placeholder="Enter price" name="price" required>
              </div>
              <div class="form-group">
                <label for="progress">Progress</label>
                <select class="form-control" id="progress" name="progress" required>
                  <option value="to_do">To Do</option>
                  <option value="on_progress">On Progress</option>
                  <option value="complete">Complete</option>
                  <option value="reject">Rejected</option>
                </select>
              </div>
              <div class="form-group">
                <label for="admin">Admin</label>
                <select class="form-control" id="admin" name="admin" required>
                  <option value="1">Izzul</option>
                  <option value="2">Alya</option>
                  </select>
              </div>
            </div>
            <div class="col-md-12 text-right">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>        
      </div>
    </div>
  </div>

  
  {{-- Modal edit --}}
<div class="modal fade" id="editProjectModal" tabindex="-1" role="dialog" aria-labelledby="editProjectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProjectModalLabel">Edit Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" class="row" id="editForm">
          @csrf
          @method('PUT')
          <div class="col-md-6">
            <div class="form-group">
              <label for="clientName">Client Name</label>
              <input type="text" class="form-control" id="clientNameEdit" placeholder="Enter client name" name="client_name" required>
            </div>
            <div class="form-group">
              <label for="projectTitle">Project Title</label>
              <input type="text" class="form-control" id="projectTitleEdit" placeholder="Enter project title" name="title" required>
            </div>
            <!-- Form group for Task Type -->
            <div class="form-group">
              <label for="taskType">Task Type</label>
              <select class="form-control" id="taskTypeEdit" name="task_type" required>
                <option value="mobile">Mobile</option>
                <option value="web">Web</option>
                <option value="ui/ux">UI/UX</option>
                <option value="desktop">Desktop</option>
              </select>
            </div>
            <div class="form-group">
              <label for="stack">Stack</label>
              <input type="text" class="form-control" id="stackEdit" placeholder="Enter stack" name="stack" required>
            </div>
            <div class="form-group">
              <label for="projectDescription">Project Description</label>
              <textarea class="form-control" id="projectDescriptionEdit" rows="3" placeholder="Enter project description" name="projectDescription" required></textarea>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="assignedTo">Assigned To</label>
              <input type="text" class="form-control" id="assignedToEdit" placeholder="Enter assigned to" name="assignedTo" required>
            </div>
            <div class="form-group">
              <label for="deadline">Deadline</label>
              <input type="date" class="form-control" id="deadlineEdit" name="deadline" required>
            </div>
            <div class="form-group">
              <label for="price">Price</label>
              <input type="text" class="form-control" id="priceEdit" placeholder="Enter price" name="price" required>
            </div>
            <div class="form-group">
              <label for="progress">Progress</label>
              <select class="form-control" id="progressEdit" name="progress" required>
                <option value="to_do">To Do</option>
                <option value="on_progress">On Progress</option>
                <option value="complete">Complete</option>
                <option value="reject">Rejected</option>
              </select>
            </div>
            <div class="form-group">
              <label for="admin">Admin</label>
              <select class="form-control" id="adminEdit" name="admin" required>
                <option value="1">Izzul</option>
                <option value="2">Alya</option>
                </select>
            </div>
          </div>
          <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>        
    </div>
  </div>
</div>
@endsection