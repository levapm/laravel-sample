<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Picker;
use Exception;
use Hash;

class PickerController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function getPickers(Request $request){
      $pickers = Picker::where('deleted', '=', '0')->paginate(config('perPage', 10));
      return view('pickers', ['pickers' => $pickers]);
    }

    public function create(Request $request) {
      $name = $request->input('name');
      $picker = new Picker();
      $picker->name = $name;
      try{
        $picker->save();
        return redirect()->back()->withSuccess("New picking personnel " . $name . " has been added");
      }
      catch(Exception $e)
      {
        return redirect()->back()->withError("New picking personnel " . $name . " hasn't been added");
      }
    }

    public function edit(Request $request) {
      $id = $request->input('id');
      $name = $request->input('name');
      $picker = Picker::find($id);
      $picker->name = $name;
      try{
        $picker->save();
        return redirect()->back()->withSuccess("New picking personnel " . $name . " has been changed");
      }
      catch(Exception $e)
      {
        return redirect()->back()->withError("New picking personnel " . $name . " hasn't been changed");
      }
    }

    public function delete(Request $request) {
      $id = $request->input('id');
      $picker = Picker::find($id);
      $name = $picker->name;
      $picker->deleted = 1;
      $picker->save();
      return redirect()->back()->withSuccess("New picking personnel " . $name . " has been deleted");
    }
}
