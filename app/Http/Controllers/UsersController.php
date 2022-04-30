<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use http\Message;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Symfony\Component\Console\Input\Input;

class UsersController extends Controller
{

    public function register()
    {

        $roles = Role::all();
        return view('pages.register', compact('roles'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function registerUser(Request $request)
    {

        $data = [
            'fullName' => $request->input('fullName'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'passwordTwo' => $request->input('confirmPassword'),
        ];

        $validator = Validator::make($data, array(
                'email' => 'unique:users'
            )
        );
        if ($validator->fails()) {
            return Redirect::to('register')->withErrors('Bu email zaten kayıtlı!');
        }
        if ($request->password != $request->confirmPassword) {
            return Redirect::to('register')->withErrors('Şifreler eşleşmiyor.');
        }
        if ($request->password == '' || $request->confirmPassword == '' || $request->email == '' || $request->fullName == '') {

            return Redirect::to('register')->withErrors('Boş alanları doldurunuz.');
        }


        User::create([
            'name' => $request->fullName,
            'email' => $request->email,
            'password' => Hash::make($request->password)
//        ])->assignRole($request->input('role'))->save();
        ])->syncRoles($request->input('role'))->save();

//        return Redirect::to('/');
        $user = User::with('roles')->orderBy('id', 'desc')->paginate(10);
        return view('pages.userList', compact('user'));
    }

    public function userList()
    {
        //$user = User::orderBy('id', 'desc')->paginate(10);
//        $user = User::with('roles')->first();
        $user = User::with('roles')->orderBy('id', 'desc')->paginate(10);
//        dd($user[3]->roles[0]->name);

        return view('pages.userList', compact('user'));
    }

    public function userDelete($id)
    {
        $user = User::find($id);

        if (Auth::user()->id == $id) {
            return Redirect::to('userList')->withErrors('Kendi kullanıcını silemezsin.');
        }

        $user->delete();
        return redirect()->back();
//        return view('pages.userUpdate', compact('user', 'roles'));
    }

    public function userEdit($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        return view('pages.userEdit', compact('user', 'roles'));
    }

    public function userUpdate(Request $request)
    {
        $userUpdate = User::find($request->id);

//        $validator = Validator::make($data, array(
//                'email' => 'unique:users'
//            )
//        );
//        if ($validator->fails()) {
//            return Redirect::to('userEdit/'.$user->id)->withErrors('Bu email zaten kayıtlı!');
//        }

        $userUpdate->name = $request->fullName;
//            $user->email = $request->email;
        $userUpdate->save();
//        $userUpdate->assignRole($request->input('role'));
        $userUpdate->syncRoles($request->role);
        $user = User::with('roles')->orderBy('id', 'desc')->paginate(10);
        return view('pages.userList', compact('user'));
//        return redirect()->back();

    }
}
