<?php

namespace App\Http\Controllers;
use App\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    //

    public function search(Request $request) 
    {
        $user = Designation::with('user_designation', 'department_designate')->query();
        // $user->where('is_admin', 0)->where('is_approved', 1);
        if ($request->input('searchkey') != "") {
            $keyword = $request->input('searchkey');
            $user->where(function($query) use($keyword) {
                $query   ->where('user_designation.first_name', 'LIKE', "%$keyword%")
                         ->orWhere('department_designate.department', 'LIKE', "%$keyword%")
                         ->orWhere('user_designation.last_name', 'LIKE', "%$keyword%");
                        //  ->orWhere('email', 'LIKE', "%$keyword%");
            });
        }
        return $user->orderBy('user_designation.last_name', 'asc')->get();
    }

    public function pagination(Request $request){
        $users = Designation::with('user_designation', 'department_designate');
        if($request->input('keyword') != ""){
            $keyword = $request->input('keyword');
            $users->where(function($query) use($keyword){
                $query   ->where('user_designation.first_name', 'LIKE', "%$keyword%")
                ->orWhere('department_designate.department', 'LIKE', "%$keyword%")
                ->orWhere('user_designation.last_name', 'LIKE', "%$keyword%");
            });
        }
        return $users->paginate(10);

        // $users = Designation::with('user_designation', 'department_designate')->paginate(10);
        // return $users;

        // $designation = Designation::join('users', 'designations.user_id', '=', 'users.id')->join('departments', 'designations.department_id', '=', 'departments.id');
        // return $designation->paginate(10);


    }


}
