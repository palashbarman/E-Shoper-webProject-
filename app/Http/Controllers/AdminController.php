<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
{
    public function index(){
        return view('admin.admin_login');
    }

    public function show_dashboard(){
        return view('admin.dashboard');
    }

    public function dashboard(Request $request){
        // echo "Ariyan Khan";
        $admin_email=$request->admin_email;
        $admin_password=md5($request->admin_password);
        $admin_name=$request->admin_name;
        $result=DB::table('tbl_admin')
                ->where('admin_email',$admin_email)
                ->where('admin_password',$admin_password)
                ->first();
            if ($result) {
                Session::put('admin_email',$admin_email);
                Session::put('admin_password',$admin_password);
                Session::put('admin_name',$admin_name);
                return Redirect::to('/dashboard');
            }
            else{
                Session::put('msg','email or message invalid');
                return Redirect::to('/admin');
            }
    }
}
