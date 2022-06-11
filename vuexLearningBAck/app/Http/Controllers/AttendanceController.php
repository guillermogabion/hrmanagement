<?php

namespace App\Http\Controllers;
use App\User;
use App\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
class AttendanceController extends Controller
{
    //
    public function present(Request $request){
        $dt = Carbon::now();
        $ff = $dt->toDateString();
        
        $id = $request->id;
        $attendance = Attendance::where('user_id', $id)->where('created_at', $ff)->get();
        if($attendance->isEmpty()){
            $present = New Attendance;
            $present->user_id = $request->id;
            $present->status = '1';
            $present->created_at = $dt->toDateString();
            $present->save();
            echo 'Saved';
            
        }else{
            return 'Not Allowed';
        }
    }
    public function pagination(Request $request){
        $attendance = Attendance::with('users');
       
        $request->created_at = $req;
        $attendance->where('created_at', $req )->get();
        return $attendance;

    }

    public function test(Request $request){
        return Attendance::with('users')->where('attendances.created_at', 'LIKE', "%$request->created_at%" )->get();
    }
    public function todayPresent(Request $request){
        $dt = Carbon::now();
        $ff = $dt->toDateString();

        // return Attendance::with('users')->where('attendances.created_at', 'LIKE', "%$ff%")->paginate(300);
        // return Attendance::with('users')->get();

        $attendance = Attendance::query();
        if($request->input('searchkey') != "") {
            $keyword = $request->input('searchkey');
            $attendance->where(function($query) use($keyword) {
                $query->where('attendances.created_at', 'LIKE', "%$keyword%");
            });
        }else {
           return $attendance->with('users')->where('attendances.created_at', 'LIKE', "%$ff%")->paginate(300);
        }
        return $attendance->with('users')->paginate(300);

    }

    public function getToday(){
        $dt = Carbon::now();
        $ff = $dt->toDateString();

        return Attendance::where('created_at', $ff);

    }


}
