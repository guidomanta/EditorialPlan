@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Projects List
                </div>

                <div class="panel-body">
                <form id="data-form" class="form-inline" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <a href="{{ route('projects.create') }}">
                        <button id="new-btn" class="btn btn-success" type="button">
                            New
                        </button>
                    </a>
                </form>
                <hr>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Name</td>
                        <td>Customer</td>
                        <td>Description</td>
                        <td>Start Date</td>
                        <td>End Date</td>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($projects as $project)
                          <tr>
                            <td>
                              {{ $project->name }}
                            </td>
                            <td>
                              {{ $project->customer }}
                            </td>
                            <td>
                              {{ $project->description }}
                            </td>
                            <td>
                              {{ $project->start_date->format('d/m/Y') }}
                            </td>
                            <td>
                              {{ $project->end_date->format('d/m/Y') }}
                            </td>
                            <td>
                                <button id="edit-btn" class="btn btn-primary" type="button" data-id="{{ $project->id }}">
                                    Edit
                                </button>
                            </td>
                            <td>
                                <button id="delete-btn" class="btn btn-danger" type="button" data-id="{{ $project->id }}">
                                    Delete
                                </button>
                            </td>
                          </tr>
                      @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

    <script src="{{ asset('js/projects.js') }}"></script>

@endsection
