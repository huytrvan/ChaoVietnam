<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getSignup()
    {
        if (Auth::check()) {
            return redirect()->route('homepage');
        } else {
            return view('user.signup');
        }
    }

    public function signup(Request $request)
    {
        //
        if ($request['password'] === $request['repeat_password']) {
            User::create([
                'username' => $request['username'],
                'password' => Hash::make($request['password']),
            ]);
            return redirect()->route('user.signin')->with([
                'username' => $request->username,
            ]);
        } else {
            return redirect()
                ->route('user.signup')
                ->with([
                    'message' => "Passwords didn't match. Please try again!",
                    'username' => $request->username,
                ]);
        }

    }

    public function getSignin()
    {
        if (Auth::check()) {
            return redirect()->route('homepage');
        } else {
            return view('user.signin');
        }

    }
    public function signin(Request $request)
    {
        if (Auth::attempt($request->only('username', 'password'), 1)) {
            return redirect()->route('homepage');
        } else {
            return redirect()->route('user.signin')->with([
                'message' => 'Incorrect username/password. Please try again!',
                'username' => $request->username,
            ]);
        }
    }

    public function signout()
    {
        Auth::logout();
        return redirect()->route('homepage');
    }

    public function profile($username)
    {
        $user = User::where('username', $username)->first();
        $posts = $user->post()->whereNotNull('property_id')->get();
        $properties = $posts->map(function ($value) {
            return $value->property()->get();
        });
        $images = $posts->map(function ($value) {
            return $value->media()->get();
        });
        $neighborhoods = $posts->map(function ($value) {
            return $value->neighborhood()->get();
        });

        return view('user.profile', [
            'user' => $user,
            'posts' => $posts,
            'neighborhoods' => $neighborhoods,
            'properties' => $properties,
            'images' => $images,
        ]);
        return redirect()->route('homepage');

    }

    public function editProfile($username)
    {
        $user = User::where('username', $username)->first();

        if (Auth::id() === $user->id) {
            return view('user.editProfile', [
                'user' => $user,
                'type' => session('type'),
                'message' => session('message'),
            ]);
        } else {
            return redirect()->route('homepage');
        }

    }

    public function updateProfile(Request $request, User $user)
    {
        $data = $request->only('username');
        if ($data['username'] === null | $data['username'] === $user->username) {
            $type = "error";
            $message = 'No changes made';
        } else if ((User::where('username', $data['username'])->first() === null) && ($data['username'] !== $user->username)) {
            $user->update(['username' => $data['username']]);
            $type = "success";
            $message = 'Username updated!';
        } else {
            $type = "error";
            $message = "Username exists - Please try a different username";
        }
        return redirect()->route('user.editProfile', [
            'username' => $user->username,
        ])->with([
            'type' => $type,
            'message' => $message,
        ]);
    }

    public function editPassword($username)
    {
        $user = User::where('username', $username)->first();

        if (Auth::id() === $user->id) {
            return view('user.editPassword', [
                'user' => $user,
                'type' => session('type'),
                'message' => session('message'),
            ]);
        } else {
            return redirect()->route('homepage');
        }

    }

    public function updatePassword(Request $request, User $user)
    {
        $data = $request->only('current_password', 'new_password', 'repeat_password');

        if (!in_array(null, array_values($data))) {
            if (Hash::check($data['current_password'], $user->password)) {
                if ($data['new_password'] === $data['repeat_password']) {
                    if (Hash::check($data['new_password'], $user->password)) {
                        $type = "error";
                        $message = 'New Password is similar to Current Password - No changes made';
                    } else {
                        $user->update([
                            'password' => Hash::make($data['new_password']),
                        ]);
                        $type = "success";
                        $message = 'Password updated!';
                    }
                } else {
                    $type = "error";
                    $message = "New Password didn't match Repeat Password";
                }
            } else {
                $type = "error";
                $message = "Incorrect Current Password";
            }
        } else {
            $type = "error";
            $message = 'One or more fields were empty - No changes made';
        }
        return redirect()->route('user.editPassword', [
            'username' => $user->username,
        ])->with([
            'type' => $type,
            'message' => $message,
        ]);
    }
}
