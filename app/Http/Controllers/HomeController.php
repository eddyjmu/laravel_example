<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUsers(){
        $users = User::all();
        foreach ($users as $user) {
            $user->role = DB::table('roles')->where('id',$user->role)->value('type');
        }
        return $users;
    }
    public function index()
    {
        if(Auth::user()->role == 1){
            $users = $this->getUsers();
            return view('admin',compact('users'));
        } else {
            if(Auth::user()->role == 3){
                return view('approved');
            } else {
                return view('unapproved');
            }
        }
    }
    public function changeApproval(Request $request){
        $currentRole = DB::table('users')->where('name',$request->username)->value('role');
        if($currentRole == 2){
            $newRole = 3;
        } else {
            $newRole = 2;
        }
        DB::table('users')->where('name',$request->username)->update(['role'=>$newRole]);
        $users = $this->getUsers();
        return view('admin',compact('users'));
    }
}
