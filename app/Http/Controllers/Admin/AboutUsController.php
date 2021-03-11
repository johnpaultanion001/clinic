<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\AboutUs;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Gate;
use Validator;
use Symfony\Component\HttpFoundation\Response;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('aboutus_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $data = AboutUs::all();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" edit="' . $data->id . '" class="edit btn btn-info btn-sm">Edit</button>';
                    $button .= '<button type="button" name="delete" delete="' . $data->id . '" id="' . $data->id . '" class="delete btn btn-danger btn-sm ml-2">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.aboutus.aboutus');
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
        abort_if(Gate::denies('aboutus_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $errors =  Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required'],
        ]);

        if ($errors->fails()) {
            return response()->json(['errors' => $errors->errors()]);
        }

        AboutUs::create($request->all());

        return response()->json(['success' => 'Data Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function show(AboutUs $aboutUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function edit(AboutUs $aboutu)
    {
        abort_if(Gate::denies('aboutus_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (request()->ajax()) {
            return response()->json(['result' => $aboutu]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AboutUs $aboutu)
    {
        abort_if(Gate::denies('aboutus_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $errors =  Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required'],
        ]);

        if ($errors->fails()) {
            return response()->json(['errors' => $errors->errors()]);
        }

        $credentials = array(
            'title' => $request->title,
            'body' => $request->body,
        );

        $aboutu->update($credentials);

        return response()->json(['success' => 'Data updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(AboutUs $aboutu)
    {
        abort_if(Gate::denies('aboutus_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return response()->json(['success' => $aboutu->delete()]);
    }
}
