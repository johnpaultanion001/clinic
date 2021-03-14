<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Feedback;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Gate;
use Validator;
use Symfony\Component\HttpFoundation\Response;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('feedback_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $data = Feedback::all();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" edit="' . $data->id . '" class="edit btn btn-info btn-sm">Edit</button>';
                    $button .= '<button type="button" name="delete" delete="' . $data->id . '" id="' . $data->id . '" class="delete btn btn-danger btn-sm ml-2">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.feedbacks.feedbacks');
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $errors =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:feedback'],
            'number' => ['required', 'string', 'min:8','max:11','unique:feedback'],
            'msg' => ['required'],
        ]);

        if ($errors->fails()) {
            return response()->json(['errors' => $errors->errors()]);
        }

        Feedback::create($request->all());

        return response()->json(['success' => 'Data Added successfully.']);
    }

    public function show(Feedback $feedback)
    {
    }

    public function edit(Feedback $feedback)
    {
        abort_if(Gate::denies('feedback_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (request()->ajax()) {
            return response()->json(['result' => $feedback]);
        }
    }

    public function update(Request $request, Feedback $feedback)
    {
        abort_if(Gate::denies('feedback_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $errors =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255' ],
            'number' => ['required', 'string', 'min:8','max:11'],
            'msg' => ['required'],

        ]);

        if ($errors->fails()) {
            return response()->json(['errors' => $errors->errors()]);
        }

        $credentials = array(
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'msg' => $request->msg,
           
        );

        $feedback->update($credentials);

        return response()->json(['success' => 'Data updated successfully']);
    }

    public function destroy(Feedback $feedback)
    {
        abort_if(Gate::denies('feedback_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return response()->json(['success' => $feedback->delete()]);
    }
}
