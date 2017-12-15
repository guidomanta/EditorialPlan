@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create Project
                    <span class="pull-right">
                        <a href="../projects">
                            Back
                        </a>
                    </span>
                </div>

                <div class="panel-body">
                <form id="data-form" role="form" action="/projects" method="POST">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" id="name" name="name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Customer</label>
                                <input class="form-control" id="customer" name="customer">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <input class="form-control" id="description" name="description">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Start Date</label>
                                <input class="form-control" id="start_date" type="text"
                                    data-date-format="dd/mm/yyyy" name="start_date">
                            </div>
                        </div><div class="col-md-6">
                            <div class="form-group">
                                <label>End Date</label>
                                <input class="form-control" id="end_date" type="text"
                                    data-date-format="dd/mm/yyyy" name="end_date">
                            </div>
                        </div>
                    </div>
                </form>
                <button type="button" class="btn btn-success pull-right" id="create-project-btn">
                    Create
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

    <script src="{{ asset('js/projects.js') }}"></script>

@endsection
