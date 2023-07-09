<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page='Index';
        $User=Auth::user();
        $User=[Auth::user()];
$result=true;
        if($User[0]->type=='admin'){
        $User=User::latest()->get();

    }
       return view('Admin/User/index',compact('User','page','result'));
    }


    public function trash()
    {
        $page='Trash';
        $result=true;
        $User1=Auth::user();

        $User=[$User1->onlyTrashed];
        if($User[0]){
            $User=[$User1->onlyTrashed->get()];
        }else{
            $result=false;
        }
        if($User1->type=='admin'){
        $User=User::onlyTrashed()->latest()->get();
        $result=true;
    }


        return view('Admin/User/index')->with('User',$User)->with('result',$result)->with('page',$page);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page="Create";
        $User=new User();
        return view('admin/User/form')->with('User',$User)->with('page',$page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     $request->validate([
        "name"=>'required',
        "email"=>'required|email|unique:users,email',
        "password" =>'required|string',
     ]);

     User::RegisterCode($request);

     return redirect()->route('admin.User.index')->with('msg','User Store successfully')->with('type','info');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page="Edit";
        $User=User::findorfail($id);
        return view('admin/User/form')->with('User',$User)->with('page',$page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name"=>'required',
            "email"=>'required|email',
            "password" =>'nullable|string',
         ]);
        $user=User::findorfail($id);
        if(!empty($request['password'])){
         $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
         ]);}

         if(empty($request['password'])){
            $user->update([
               'name'=>$request->name,
               'email'=>$request->email,
               'password'=>$user->password
            ]);}

         return redirect()->route('admin.User.index')->with('msg','User Updated successfully')->with('type','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findorfail($id)->delete();
        return redirect()->route('admin.User.index')->with('msg','User moved to trash successfully')->with('type','danger');
    }

    public function restore($id)
    {
User::withTrashed()->findorfail($id)->restore();

return redirect()->route('admin.User.index')->with('msg','User restored successfully')->with('type','success');
    }


    public function forcedelete($id)
    {
User::withTrashed()->findorfail($id)->forceDelete();

return redirect()->route('admin.User.index')->with('msg','User deleted successfully')->with('type','danger');
    }
}
