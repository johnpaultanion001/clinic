<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Schedule;
use Yajra\DataTables\Facades\DataTables;
use Gate;
use Validator;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        date_default_timezone_set('Asia/Manila');
        $historys = Schedule::whereBetween('date_time', ['2019-12-15', Carbon::now()->subDays(1)])->get(); 
        return view('admin.histories.histories', compact('historys'));
    }

    public function filterbydate(Request $request){
        abort_if(Gate::denies('history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->validate($request,[
            'date' => [
               'required'
            ]
           ]);

        date_default_timezone_set('Asia/Manila');
        $historys = Schedule::whereBetween('date_time', ['2019-12-15', Carbon::now()->subDays(1)])
                            ->where('date_time', $request->date)
                            ->get();  
        return view('admin.histories.histories', compact('historys'));
    }

    public function massDestroy(Request $request)
    {
        $this->validate($request,[
            'ids'   => 'required|array',
            'ids.*' => 'exists:schedules,id',
           ]);

        Schedule::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
    
}
