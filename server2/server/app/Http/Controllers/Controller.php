<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use DB;

class Controller
{
    //
    public function login()
    {
        $request = Request()->all();
        $userTemp = new Users();
        $user = $userTemp->user_by_username($request);
        $flag = 0;
        //dd($user);  
        //dd($user[0]->password);
        if($user == null)
        {
            $flag = 0;
        }
        else if ($user[0]->password == $request['password']) {
            if ($user[0]->role == 'admin') {
               
                $_SESSION['username'] = $request['username'];
                $_SESSION['role'] = 'admin';
                $_SESSION['id'] = $user[0]->id; 
                $_SESSION['name'] = $user[0]->name;
                $flag = 1;
            } else if ($user[0]->role == 'user') {
                $_SESSION['username'] = $request['username'];
                $_SESSION['role'] = 'user';
                $_SESSION['id'] = $user[0]->id;
                $_SESSION['name'] = $user[0]->name;
                $flag = 2;
            } else
                $flag = 0;
        } else {
            $flag = 0;
        }
        if ($flag == 0) 
        {
            return redirect()->route('login');
        } 
        return view('welcome');
        //return view('login');
    }
}