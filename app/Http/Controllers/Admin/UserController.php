<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users= User::paginate(10);
        return view('admin.user.index',compact('users'));
    }
    public function create(){
        return view('admin.user.create');
    }
  public function store(Request $request){
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'address' =>['required','string', 'max:255'],
        'phone' =>['required','Numeric'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8'],
        'role'=> ['required', 'string']
    ]);
    
    User::create([
        'name' => $request->name,
        'address' => $request->address,
        'phone' => $request->phone,
        'email' => $request->email,
        'role' => $request->role,
        'password' => Hash::make($request->password),
    ]);

    return redirect('/admin/users')->with(['message'=>'User created successfully.','messageType'=>'add']);  
    }   
    public function edit(int $userId){
        $user = User::findOrFail($userId);
        return view('admin.user.edit',compact('user'));
    }
    public function update(Request $request ,int  $userId){
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'address' =>['required','string', 'max:255'],
        'phone' =>['required','Numeric'],
        // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8'],
        'role'=> ['required', 'string']
    ]);
    
    User::findOrFail($userId)->update([
        'name' => $request->name,
        'address' => $request->address,
        'phone' => $request->phone,
        'email' => $request->email,
        'role' => $request->role,
        'password' => Hash::make($request->password),
    ]);

    return redirect('/admin/users')->with(['message'=>'User updated successfully.','messageType'=>'update']);  
    }
    public function destroy(int $userId){
        $user = User::findOrfail($userId);
        $user->delete();
        return redirect('/admin/users')->with(['message'=>'User deleted successfully.','messageType'=>'delete']);   
    }


}
