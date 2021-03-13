<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Holiday;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Gate;
use Validator;
use Symfony\Component\HttpFoundation\Response;

class HolidayController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('holiday_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $data = Holiday::all();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" edit="' . $data->id . '" class="edit btn btn-info btn-sm">Edit</button>';
                    $button .= '<button type="button" name="delete" delete="' . $data->id . '" id="' . $data->id . '" class="delete btn btn-danger btn-sm ml-2">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.holidays.holidays');
    }

    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        abort_if(Gate::denies('holiday_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $errors =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'date_holiday' => ['required'],
        ]);

        if ($errors->fails()) {
            return response()->json(['errors' => $errors->errors()]);
        }

        Holiday::create($request->all());

        return response()->json(['success' => 'Data Added successfully.']);
    }
    public function show(Holiday $holiday)
    {
        //
    }

    
    public function edit(Holiday $holiday)
    {
        abort_if(Gate::denies('holiday_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (request()->ajax()) {
            return response()->json(['result' => $holiday]);
        }
    }

   
    public function update(Request $request, Holiday $holiday)
    {
        abort_if(Gate::denies('holiday_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $errors =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'date_holiday' => ['required'],
        ]);

        if ($errors->fails()) {
            return response()->json(['errors' => $errors->errors()]);
        }

        $credentials = array(
            'name' => $request->name,
            'date_holiday' => $request->date_holiday,
        );

        $holiday->update($credentials);

        return response()->json(['success' => 'Data updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        abort_if(Gate::denies('holiday_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return response()->json(['success' => $holiday->delete()]);
    }
}
