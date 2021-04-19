<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Schedule;
use Yajra\DataTables\Facades\DataTables;
use Gate;
use Validator;
use Symfony\Component\HttpFoundation\Response;

class ScheduledListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('scheduledlist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        date_default_timezone_set('Asia/Manila');
       
        $historys = Schedule::where('date_time', date('Y-m-d'))->get();  
        return view('admin.scheduledlist.scheduledlist', compact('historys'));
    }

    // public function filterbydate(Request $request){
    //     abort_if(Gate::denies('scheduledlist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    //     $this->validate($request,[
    //         'date' => [
    //            'required','date','after:yesterday'
    //         ]
    //        ]);

    //     date_default_timezone_set('Asia/Manila');
    //     $historys = Schedule::whereBetween('date_time', [date('Y-m-d'), $request->date])->get();  
    //     return view('admin.scheduledlist.scheduledlist', compact('historys'));
    // }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $scheduled_list)
    {
        abort_if(Gate::denies('scheduledlist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.scheduledlist.edit', compact('scheduled_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $scheduled_list)
    {
        abort_if(Gate::denies('history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        

        $scheduled_list->isCancel = $request->status_id;
        $scheduled_list->save();
        if($scheduled_list){
            return redirect('admin/scheduled-list')->with('success', 'Status Successfully Changed ');
        }else{
            return response()->json(["error"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
