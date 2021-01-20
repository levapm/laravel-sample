<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Exception;
use Hash;

class UserController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function getUsers(Request $request){
      $users = User::paginate(config('perPage', 10));
      return view('users', ['users' => $users]);
    }

    public function create(Request $request) {
      $name = $request->input('name');
      $password = $request->input('password');
      $password_enc = Hash::make($password);
      $user = new User();
      $user->name = $name;
      $user->password = $password_enc;
      try{
        $user->save();
        return redirect()->back()->withSuccess("New user " . $name . " has been added");
      }
      catch(Exception $e)
      {
        return redirect()->back()->withError("New user " . $name . " hasn't been added");
      }
    }

    public function edit(Request $request) {
      $id = $request->input('id');
      $name = $request->input('name');
      $password = $request->input('password');
      $password_enc = Hash::make($password);
      $user = User::find($id);
      $user->name = $name;
      $user->password = $password_enc;
      try{
        $user->save();
        return redirect()->back()->withSuccess("New user " . $name . " has been changed");
      }
      catch(Exception $e)
      {
        return redirect()->back()->withError("New user " . $name . " hasn't been changed");
      }
    }

    public function delete(Request $request) {
      $id = $request->input('id');
      $user = User::find($id);
      $name = $user->name;
      $user->delete();
      return redirect()->back()->withSuccess("New user " . $name . " has been deleted");
    }
}
