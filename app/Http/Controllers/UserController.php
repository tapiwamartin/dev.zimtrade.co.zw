<?php

namespace App\Http\Controllers;

use App\Mail\InquiryOpened;
use App\Mail\UserAuthorised;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   /* public function __construct()
    {
        $this->middleware(['auth','admin','verified'],['except'=>'profile']);
    }*/

    public function getAllUsers()
    {
        return User::with('roles')->get();
    }

    public function index()
    {
       $users= User::whereNotIn('id',array(Auth::id()))->whereNotNull('email_verified_at')->get();
        return view('admin.users')->withUsers($users);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users= User::where('id',$id)->get();
        return view('admin.userView')->withUsers($users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::find($id);
        $user->delete();
        return redirect()->route('user.index');
    }

    public function authoriseUser($id)
    {

        $user = User::find($id);
        $user->update(['isAuthorised'=>1]);
        //return $user;
        Mail::to($user)->queue(new UserAuthorised($user));
        Alert::success('Success','User Authorised');
        return redirect()->route('user.index');
    }

    public function unAuthoriseUser($id)
    {
        $user = User::find($id);
        $user->update(['isAuthorised'=>0]);
        Alert::success('Success','User UnAuthorised');
        return redirect()->route('user.index');
    }
    public function profile()
    {
        return view('admin.profile');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            Alert::error('Error', 'Password Mismatch');
            return back();
        }

        $user->password = Hash::make($request->password);
        $user->save();
        Alert::success('Success', 'Password Changed Successfully');
        return back();//->with('success', 'Password successfully changed!');
    }

}
