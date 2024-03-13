<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use DataTables;
use App\User;
use App\Supervision;


class UsersController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $users = DB::table('users')
                   ->leftJoin('c_company', 'users.company', '=', 'c_company.company_id')
                   ->leftJoin('c_region', 'users.region', '=', 'c_region.reg_id')
                   ->leftJoin('c_city', 'c_region.reg_city_id', '=', 'c_city.city_id')
                   ->leftJoin('users_role', 'users.role', '=', 'users_role.id')
                   ->select(
                       '*',
                    'users.id AS main_id',
                    'c_company.company_name',
                    'c_city.city_name',
                    'users_role.description'
                       )
                   ->get();
               return Datatables::of($users)
                       ->addIndexColumn()
                       ->addColumn('action','<a href="#" class="btn btn-primary">Edit</a>')
                       ->make(true);
           }
           $uid = $request->user()->company;
           $token = $request->session()->get('token');
           $user = Supervision::getUserCompany($uid, $token,$request);
        return view('Users.index',compact('user'));
    }

    public function create(Request $request){

        $uid = $request->user()->company;
        $token = $request->session()->get('token');
        $user = Supervision::getUserCompany($uid, $token,$request);
        return view('Users.create',compact('user'));

    }

    public function addUser(Request $request){
        
        $user=User::create([
            'name' => $request->firstname,
            'email' => $request->username,
            'phone_no' =>$request->phone,
            'region' => $request->region,
            'designation' => $request->designation,
            'company' =>$request->company,
            'role' => $request->role,
            'service' => 'Prism',
            'status' => 0,
            'password' => Hash::make($request->password)
        ]);
        
        
         $user->createToken('KgtERP')-> accessToken; 
         return $user;
    }

    public function getUserRoles()
    {
       $roles = DB::table('users_role')
                    ->select('*')
                    ->get();
        return $roles;
    }
}
