<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
        $employee = User::orderBy('created_at', 'desc')->get();
       return $employee;
    }

    public function getEmployee(){

    }

    public function addEmployee(Request $request){
        $employee = new User;
        $employee->name = $request->name;
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
    
        
        $employee = User::findorfail($id);

        $employee->name = $request->name;
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
                $query   ->where('name', 'LIKE', "%$keyword%")
                         ->orWhere('email', 'LIKE', "%$keyword%");
            });
        }
        return $user->orderBy('name', 'asc')->get();
    }
}
