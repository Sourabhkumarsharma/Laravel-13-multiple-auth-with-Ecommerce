<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\DynamicTable;
use App\Models\DynamicColumn;

 
class MigrationController extends Controller
{
    public function index()
    {
        $tables = DynamicTable::with('columns')->get();
        return view('admin.migration.index', compact('tables'));
    }

    public function create()
    {
        return view('admin.migration.create');
    }

    public function store(Request $request)
    {
        $table = DynamicTable::create([
            'table_name' => $request->table_name
        ]);

        Schema::create($request->table_name, function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        return redirect()->route('admin.migration.index');
    }

    public function edit($id)
    {
        $table = DynamicTable::with('columns')->findOrFail($id);
        return view('admin.migration.edit', compact('table'));
    }

    public function update(Request $request, $id)
    {
        $table = DynamicTable::findOrFail($id);

        Schema::table($table->table_name, function (Blueprint $blueprint) use ($request, $table) {

            foreach ($request->columns as $col) {

                DynamicColumn::create([
                    'table_id' => $table->id,
                    'column_name' => $col['name'],
                    'type' => $col['type'],
                    'nullable' => isset($col['nullable'])
                ]);

                switch ($col['type']) {
                    case 'string':
                        $column = $blueprint->string($col['name']);
                        break;

                    case 'text':
                        $column = $blueprint->text($col['name']);
                        break;

                    case 'integer':
                        $column = $blueprint->integer($col['name']);
                        break;
                }

                if (isset($col['nullable'])) {
                    $column->nullable();
                }
            }
        });

        return back()->with('success', 'Columns Added');
    }

    public function destroy($id)
    {
        $table = DynamicTable::findOrFail($id);

        Schema::dropIfExists($table->table_name);

        $table->delete();

        return back()->with('success', 'Table Deleted');
    }
}