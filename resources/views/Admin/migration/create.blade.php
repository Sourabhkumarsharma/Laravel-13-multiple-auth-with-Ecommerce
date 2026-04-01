@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1>Create Table</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">New Table</h3>
                </div>

                <form method="POST" action="{{ route('admin.migration.store') }}">
                    @csrf

                    <div class="card-body">

                        <div class="form-group">
                            <label>Table Name</label>
                            <input type="text"
                                   name="table_name"
                                   class="form-control"
                                   placeholder="Enter table name"
                                   required>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-success">
                            <i class="fas fa-save"></i> Create
                        </button>

                        <a href="{{ route('admin.migration.index') }}"
                           class="btn btn-secondary">
                            Back
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </section>

</div>

@endsection