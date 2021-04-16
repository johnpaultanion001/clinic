<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Database;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Gate;
use Validator;
use Symfony\Component\HttpFoundation\Response;

class DatabaseController extends Controller
{
  
    public function index(Request $request)
    {
        abort_if(Gate::denies('databases_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $data = Database::all();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" edit="' . $data->id . '" class="edit btn btn-info btn-sm">Edit</button>';
                    $button .= '<button type="button" name="delete" delete="' . $data->id . '" id="' . $data->id . '" class="delete btn btn-danger btn-sm ml-2">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.databases.databases');
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('databases_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $errors =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            
        ]);

        if ($errors->fails()) {
            return response()->json(['errors' => $errors->errors()]);
        }

        Database::create($request->all());

        return response()->json(['success' => 'Data Added successfully.']);
    }

    public function show(Database $database)
    {
    }

    public function edit(Database $database)
    {
        abort_if(Gate::denies('databases_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (request()->ajax()) {
            return response()->json(['result' => $database]);
        }
    }

    public function update(Request $request, Database $database)
    {
        abort_if(Gate::denies('databases_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $errors =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            
        ]);

        if ($errors->fails()) {
            return response()->json(['errors' => $errors->errors()]);
        }

        $credentials = array(
            'name' => $request->name,
        );

        $database->update($credentials);

        return response()->json(['success' => 'Data updated successfully']);
    }

    public function destroy(Database $database)
    {
        abort_if(Gate::denies('databases_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return response()->json(['success' =>  $database->delete()]);
    }
}
