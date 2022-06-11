<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
class DepartmentController extends Controller
{
    //

    public function search(Request $request) 
    {
        $user = Department::query();
        // $user->where('is_admin', 0)->where('is_approved', 1);
        if ($request->input('searchkey') != "") {
            $keyword = $request->input('searchkey');
            $user->where(function($query) use($keyword) {
                $query   ->where('department', 'LIKE', "%$keyword%");
            });
        }
        return $user->orderBy('department', 'asc')->get();
    }

    public function pagination(Request $request){
        $users = Department::query();
        if($request->input('keyword') != ""){
            $keyword = $request->input('keyword');
            $users->where(function($query) use($keyword){
                $query  ->where('department', 'LIKE', "%$keyword%");  
            });
        }
        return $users->orderBy('department', 'asc')->paginate(10);
    }
}
