<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\FullDate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Gate;
use Validator;
use Symfony\Component\HttpFoundation\Response;

class FullDateController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('fulldate_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $data = FullDate::all();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" edit="' . $data->id . '" class="edit btn btn-info btn-sm">Edit</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.fulldates.fulldates');
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
        // abort_if(Gate::denies('fulldate_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $errors =  Validator::make($request->all(), [
        //     'fulldate' => ['required'],
        // ]);

        // if ($errors->fails()) {
        //     return response()->json(['errors' => $errors->errors()]);
        // }

        // FullDate::create($request->all());

        // return response()->json(['success' => 'Data Added successfully.']);
    }


    public function show(FullDate $fullDate)
    {
        //
    }

    public function edit(FullDate $fulldate)
    {
        abort_if(Gate::denies('fulldate_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (request()->ajax()) {
            return response()->json(['result' => $fulldate]);
        }
    }

    public function update(Request $request, FullDate $fulldate)
    {
        abort_if(Gate::denies('fulldate_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $errors =  Validator::make($request->all(), [
            'fulldate' => ['required','numeric', 'min:2'],
        ]);

        if ($errors->fails()) {
            return response()->json(['errors' => $errors->errors()]);
        }
        $credentials = array(
            'fulldate' => $request->fulldate,
        );
        $fulldate->update($credentials);

        return response()->json(['success' => 'Data updated successfully']);
    }
    public function destroy(FullDate $fulldate)
    {
        // abort_if(Gate::denies('fulldate_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // return response()->json(['success' => $fulldate->delete()]);
    }
}
