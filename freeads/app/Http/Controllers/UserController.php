<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Message;
use Validator;
use Auth;
use Mail;
use DB;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    public function sendMessage(Request $request)
    {
        $messages = array(
            'required'  => 'The :attribute field is required.',
            'max'       => 'The :attribute field must be shorter',
        );

        $v = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'content' => 'required|max:255',
        ], $messages);

        if ($v->fails())
        {
            $messages = $v->messages();
            return back()->withInput()->withErrors($v);
        }
        $id = Auth::user()->id;
        $user = '%' . $request->input('dest') . '%';
        $id_dest = DB::table('users')->where('username', 'like', $user)->first()->id;

        Message::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'receiver_id' => $id_dest,
            'sender_id' => $id,
        ]);
        return redirect('/');
    }

    public function showMessage()
    {
        $id = Auth::user()->id;
        $messages = Message::where('receiver_id', '=', $id)->get();
        return view('user/message')->with('messages', $messages);
    }
    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $messages = array(
            'required'  => 'The :attribute field is required.',
            'max'       => 'The :attribute field must be shorter',
            'unique'    => 'The :attribute already exists',
        );

        $v = Validator::make($request->all(), [
            'username' => 'required|unique:users|max:255',
            'password' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
        ], $messages);

        if ($v->fails())
        {
            $messages = $v->messages();
            return back()->withInput()->withErrors($v);
        }
        $user = User::find($id);
        $user->username = $request->input('username');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        return redirect('user/' . $id . '/edit');
    }

    public function activate($token)
    {
        $user = User::where('confirmation_code', '=', $token)->first();
        if ($user)
        {
            $user->role = 1;
            $user->confirmation_code = null;
            $user->save();
        } else {
            return redirect('register');
        }
        return redirect('login');
    }
    public function showHome()
    {
        return view('user/home');
    }
    protected function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function create()
    {
        return view('user/register');
    }

    public function showLogin()
    {
        return view('user/login');
    }

    public function store(Request $request)
    {
        $messages = array(
            'required'  => 'The :attribute field is required.',
            'max'       => 'The :attribute field must be shorter',
            'unique'    => 'The :attribute already exists',
        );

        $v = Validator::make($request->all(), [
            'username' => 'required|unique:users|max:255',
            'password' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users',  //add 'email' rule
        ], $messages);

        if ($v->fails())
        {
            $messages = $v->messages();
            return back()->withInput()->withErrors($v);
        }

        $confirmation_code = str_random(30);

        User::create([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'confirmation_code' => $confirmation_code,
            'role' => 0,
        ]);

        Mail::send('email.validate', ['key' => $confirmation_code], function($message) {
            $message->from('us@example.com', 'FreeAds');
            $message->to(Input::get('email'), Input::get('username'))
                ->subject('Check your email address');
        });
        return redirect('/');
    }
    public function edit()
    {
        return view('user/edit_profile');
    }
    public function destroy($id)
    {
        //
    }
    protected function authenticate(Request $request)
    {
        $messages = array(
            'required'  => 'The :attribute field is required.',
        );

        $v = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ], $messages);

        if ($v->fails())
        {
            $messages = $v->messages();
            return back()->withErrors($v);
        }

        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password'), 'role' => 1]))
        {
            return redirect('home');
        }
        return back()->with('errorr', trans('account.incorrect_credentials'));
    }
}
