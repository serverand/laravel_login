<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function detail($id) {
        $user = DB::table('users')->where('id', '=', $id)->first();

        return view('user.create', [
            'user' => $user
        ]);
    }

    public function create() {
        return view('user.create');
    }

    public function save(Request $request) {
        // guardar el registro
        $user = DB::table('users')->insert(array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ));
        

        return redirect()->action('HomeController@index')->with('status', 'User create succesfully');
    }

    public function delete($id) {
        $user = DB::table('users')->where('id', $id)->delete();
        return redirect()->action('HomeController@index')->with('status', 'User delete succesfully');
    }

    public function edit($id) {
        // sacar el registro de la bd
        $user = DB::table('users')->where('id', $id)->first();

        // pasarle a la vista el objeto y rellenar el formulario
        return view('user.create', [
            'user' => $user
        ]);
    }

    public function update(Request $request) {
        $id = $request->input('id');

        $user = DB::table('users')->where('id', $id)
                ->update(array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'updated_at' => date("Y-m-d H:i:s")
        ));
        return redirect()->action('HomeController@index')->with('status', 'User updated succesfully');
    }

}
