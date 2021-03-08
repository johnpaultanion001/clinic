<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Purpose;
use Illuminate\Http\Request;
use Validator;
use Yajra\DataTables\Facades\DataTables;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class PurposeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('purpose_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $data = Purpose::all();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" edit="' . $data->id . '" class="edit btn btn-info btn-sm">Edit</button>';
                    $button .= '<button type="button" name="delete" delete="' . $data->id . '" id="' . $data->id . '" class="delete btn btn-danger btn-sm ml-2">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.purposes.purposes');
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
        abort_if(Gate::denies('purpose_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $errors =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:purposes'],
        ]);

        if ($errors->fails()) {
            return response()->json(['errors' => $errors->errors()]);
        }

        Purpose::create($request->all());

        return response()->json(['success' => 'Data Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purpose  $purpose
     * @return \Illuminate\Http\Response
     */
    public function show(Purpose $purpose)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purpose  $purpose
     * @return \Illuminate\Http\Response
     */
    public function edit(Purpose $purpose)
    {
        abort_if(Gate::denies('purpose_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (request()->ajax()) {
           
            return response()->json(['result' => $purpose]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purpose  $purpose
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purpose $purpose)
    {
        abort_if(Gate::denies('purpose_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $errors =  Validator::make($request->all(), [
            'name' => ['required', 'unique:purposes'],
        ]);

        if ($errors->fails()) {
            return response()->json(['errors' => $errors->errors()]);
        }

        $credentials = array(
            'name' => $request->name,
        );

        $purpose->update($credentials);

        return response()->json(['success' => 'Data updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purpose  $purpose
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purpose $purpose)
    {
        abort_if(Gate::denies('purpose_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return response()->json(['success' => $purpose->delete()]);
    }
}
