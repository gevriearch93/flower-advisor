<?php


namespace App\Http\Controllers;
   
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

public function index()
	{
		return view('register');
	}


public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
    	
            $user = new Users();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();

        return redirect()->route('login')
                        ->with('success','User created successfully.');




    }
}