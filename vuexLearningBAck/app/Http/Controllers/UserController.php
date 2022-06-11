<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Designation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;


class UserController extends Controller
{
    //
    public function self()
    {
        $user = User::find(auth()->user()->id);
        $token = $user->createToken('authToken')->accessToken;
        return response(['user' => $user, 'access_token' => $token]);
    }
    
    public function login(Request $request)
    {
        $login = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email',$request->email)->first();
        if (!Auth::attempt( $login ))
        {
            return response(['message' => 'login Credentials are incorrect'], 500);
        }
        $token = $user->createToken('authToken')->accessToken;
        return response(['user' => Auth::user(), 'access_token' => $token]);
    }
    
    public function logout(Request $request)
    {
        $request->user()->tokem()->delete();
    }
    public function index(){
        $employee = User::orderBy('created_at', 'desc')->paginate(5);
       return $employee;
    }

    public function getEmployee(){

    }

    public function addEmployee(Request $request){

        $request->validate([
            'employee_id' => ['required','unique:users'],
            'first_name'=> ['required'],
            'last_name'=> ['required'],
            'email'=> ['required','unique:users'],
            'phone'=> ['required','unique:users'],
            'password'=> ['required'], 
        ]);
        $employee = new User;
        $employee->employee_id = $request->employee_id;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->mid_name = $request->mid_name;
        $employee->birth_date = $request->birth_date;
        $employee->address = $request->address;
        $employee->phone = $request->phone;
        $employee->person_to_contact = $request->person_to_contact;
        $employee->to_contact_number = $request->to_contact_number;
        $employee->user_type = '1';
        $employee->email = $request->email;
        $employee->password = Hash::make($request->input('password'));
        if($request->profile_picture){
            $image = $request->profile_picture;  // your base64 encoded
            list($type, $image) = explode(';', $image);
            list(, $image)      = explode(',', $image);
            $data = base64_decode($image);
            $imageName = date("YmdHis"). '.' . 'jpeg';
            file_put_contents(public_path() . '/' . 'images/user_profile/' . $imageName, $data);
            $employee->profile_picture = $imageName ;
        }
        $employee->save();
        return new UserResource($employee);
    }

    public function editEmployee(Request $request, $id){
        $request->validate([
            'employee_id' => ['required','unique:users'],
            'first_name'=> ['required'],
            'last_name'=> ['required'],
            'email'=> ['required','unique:users'],
            'phone'=> ['required','unique:users'],
            'password'=> ['required'], 
        ]);
        
        $employee = User::findorfail($id);
        $employee->employee_id = $request->employee_id;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->mid_name = $request->mid_name;
        $employee->birth_date = $request->birth_date;
        $employee->address = $request->address;
        $employee->phone = $request->phone;
        $employee->person_to_contact = $request->person_to_contact;
        $employee->to_contact_number = $request->to_contact_number;
        $employee->user_type = '1';
        $employee->email = $request->email;
        $employee->password = Hash::make($request->input('password'));

        if($request->profile_picture){
            $image = $request->profile_picture;  // your base64 encoded
            list($type, $image) = explode(';', $image);
            list(, $image)      = explode(',', $image);
            $data = base64_decode($image);
            $imageName = date("YmdHis"). '.' . 'jpeg';
            file_put_contents(public_path() . '/' . 'images/user_profile/' . $imageName, $data);
            $employee->profile_picture = $imageName ;
        }
        $employee->save();
        return $employee;
    }

    public function editEmployeenoPic(Request $request, $id){
    
        
        $employee = User::findorfail($id);

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->password = Hash::make($request->input('password'));

        // if($request->profile_picture){
        //     $image = $request->profile_picture;  // your base64 encoded
        //     list($type, $image) = explode(';', $image);
        //     list(, $image)      = explode(',', $image);
        //     $data = base64_decode($image);
        //     $imageName = date("YmdHis"). '.' . 'jpeg';
        //     file_put_contents(public_path() . '/' . 'images/user_profile/' . $imageName, $data);
        //     $employee->profile_picture = $imageName ;
        // }
        $employee->save();
        return $employee;
    }

    public function destroyEmployee(Request $request ,$id){
        $employee = User::findorfail($id);
        $employee->delete();
    }
    public function search(Request $request) 
    {
        $user = User::query();
        // $user->where('is_admin', 0)->where('is_approved', 1);
        if ($request->input('searchkey') != "") {
            $keyword = $request->input('searchkey');
            $user->where(function($query) use($keyword) {
                $query   ->where('first_name', 'LIKE', "%$keyword%")
                         ->orWhere('last_name', 'LIKE', "%$keyword%")
                         ->orWhere('email', 'LIKE', "%$keyword%");
            });
        }
        return $user->orderBy('first_name', 'asc')->get();
    }

    public function pagination(Request $request){
        $users = User::query();
        if($request->input('keyword') != ""){
            $keyword = $request->input('keyword');
            $users->where(function($query) use($keyword){
                $query  ->where('first_name', 'LIKE', "%$keyword%");
            });
        }
        return $users->orderBy('first_name', 'asc')->paginate(10);
    }

    // public function design(){
    //     $user = User::with('designation')->get();
    //     $department = Designation::with('user_designation', 'department_designate')->get();
    //     return $department;
    // }

    
}
