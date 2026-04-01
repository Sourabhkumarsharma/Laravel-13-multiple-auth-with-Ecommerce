@extends('admin.layouts.app')
 

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Table: {{ $table->table_name }}</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <!-- EXISTING COLUMNS -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Existing Columns</h3>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach($table->columns as $col)
                            <li class="list-group-item d-flex justify-content-between">
                                {{ $col->column_name }}
                                <span class="badge text-black badge-info">{{ $col->type }}</span>
                                <span class="badge text-black badge-info">{{ $col->nullable ? 'Nullable' : 'Required' }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- ADD NEW COLUMNS -->
            <div class="card card-primary mt-3">

                <div class="card-header">
                    <h3 class="card-title">Add Columns</h3>
                </div>

                <form method="POST"
                      action="{{ route('admin.migration.update',$table->id) }}">
                    @csrf

                    <div class="card-body">

                        <div id="columns-wrapper">

                            <div class="row mb-2 column-row">

                                <div class="col-md-4">
                                    <input type="text"
                                           name="columns[0][name]"
                                           class="form-control"
                                           placeholder="Column Name">
                                </div>

                                <div class="col-md-3">
                                    <select name="columns[0][type]" class="form-control">
                                        <option value="string">String</option>
                                        <option value="text">Text</option>
                                        <option value="integer">Integer</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <input type="checkbox" name="columns[0][nullable]"> Nullable
                                </div>

                                <div class="col-md-2">
                                    <button type="button"
                                            class="btn btn-danger"
                                            onclick="removeRow(this)">
                                        X
                                    </button>
                                </div>

                            </div>

                        </div>

                        <button type="button"
                                class="btn btn-secondary btn-sm"
                                onclick="addRow()">
                            + Add More
                        </button>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-success">
                            Save Columns
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
<script>
let i = 1;

function addRow() {
    let html = `
    <div class="row mb-2 column-row">
        <div class="col-md-4">
            <input type="text" name="columns[${i}][name]" class="form-control">
        </div>

        <div class="col-md-3">
            <select name="columns[${i}][type]" class="form-control">
                <option value="string">String</option>
                <option value="text">Text</option>
                <option value="integer">Integer</option>
            </select>
        </div>

        <div class="col-md-2">
            <input type="checkbox" name="columns[${i}][nullable]"> Nullable
        </div>

        <div class="col-md-2">
            <button type="button" class="btn btn-danger"
                onclick="removeRow(this)">X</button>
        </div>
    </div>
    `;

    document.getElementById('columns-wrapper')
        .insertAdjacentHTML('beforeend', html);

    i++;
}

function removeRow(btn) {
    btn.closest('.column-row').remove();
}
</script>
@endsection