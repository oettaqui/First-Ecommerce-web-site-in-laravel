<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserController extends Controller
{
    public function index(){
        // $user =  User::findOrFail(Auth::user()->id);
        return view('frontend.user.profile');
    }

    public function updateUserDetails(Request $request){
        $request->validate([
            'name' => ['required','string'],
            'phone' => ['required','digits:10'],
            'zipcode' => ['required','digits:5'],
            'address' => ['required','string','max:499'],
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->name,
        ]);
        $user->userDetail()->updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'phone' => $request->phone,
                'zipcode' => $request->zipcode,
                'address' => $request->address,
            ]
        );
        return redirect()->back()->with(['message'=>'Profile updated successfully','messageType'=>'update']);
    }
    public function passwordCreate(){
        return view('frontend.user.change-password');
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required','string','min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with(['message'=>'Password updated successfully','messageType'=>'update']);

        }else{

            return redirect()->back()->with(['message'=>'Current Password does not match with Old Password','messageType'=>'error']);
        }
    }
}
