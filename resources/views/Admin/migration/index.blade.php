@extends('admin.layouts.app')

@section('content')
<div class="card">

    <!-- HEADER -->
    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="card-title mb-0">
    <i class="fas fa-database mr-1"></i> Migration Tables
</h3>
        <a href="{{ route('admin.migration.create') }}"
           class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Create Table
        </a>

    </div>

    <!-- BODY -->
    <div class="card-body">

        <table id="tableList" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Table Name</th>
                    <th>Total Columns</th>
                    <th width="150">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tables as $key => $table)
                <tr>
                    <td>{{ $key + 1 }}</td>

                    <td>{{ $table->table_name }}</td>

                    <td>{{ $table->columns->count() }}</td>

                    <td>
                        <a href="{{ route('admin.migration.edit',$table->id) }}"
                           class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('admin.migration.delete',$table->id) }}"
                              class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger">
                               Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>
@endsection