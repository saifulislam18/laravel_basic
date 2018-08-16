<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        if (count(Role::all())==0){
            $roleName=['adminstrator','editor','author','subscriber'];
            foreach ($roleName as $value){
                $role['role_name']=$value;
                Role::create($role);
            }
        }
        if (count(Admin::all())==0){
            $admin['name']='Msi';
            $admin['username']=strtolower('msisaiful');
            $admin['role_id']=1;
            $admin['email']='msisaifulsaif@gmail.com';
            $admin['password']=Hash::make('L@r@vel');
            $admin['status']='active';
            Admin::create($admin);
        }

//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index()
//    {
//        return view('admin.home');
//    }
    public function welcome(){
        return view('home');
    }
}
