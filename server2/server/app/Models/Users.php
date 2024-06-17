<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Users extends Model
{
    use HasFactory;
    public function  user_list()
    {
        $user = DB::select('SELECT id,username,name, email, phone, role 
        FROM users'
        );
        return $user;
    }
    public function user_by_id($id)
    {
        $user = DB::select('SELECT * FROM
        users WHERE id = ?',[$id]);
        return $user;
    }
    public function create_user($request)
    {
        $user = DB::insert('INSERT INTO users (username,name,email,phone,password,role) 
        VALUES (?,?,?,?,?,?)',[ $request['username'],$request['name'],$request['email'],$request['phone'],$request['password'],$request['role']]);
        return $user;
    }
    public function delete_user($id)
    {
        $user = DB::delete('DELETE FROM users WHERE id = ?',[$id]);
        return $user;
    }
    public function edit_user($request,$id)
    {
        $user = DB::update('UPDATE users SET email = ?, phone = ?, password = ? WHERE id = ?',
       [ $request['email'],$request['phone'],$request['password'],$id]);
        return $user;
    }
    public function user_by_username($request)
    {
        $user = DB::select('SELECT * FROM users WHERE username = ?',[$request['username']]);
        return $user;
    }
    public function get_data($id)
    {
        $user = DB::select('SELECT * FROM data where id1=? and id2=?',[$id,$_SESSION['id']]);
        return $user;
    }
    public function insert_data($id)
    {
        $request = Request()->all();
        $user = DB::insert('INSERT INTO data (id1,id2,content) 
        VALUES (?,?,?)',[$id,$_SESSION['id'],$request['message']]);
        return $user;
    }
    public function delete_data($id)
    {
        $user = DB::delete('DELETE FROM data where id = ?',[$id]);
        return $user;
    }
}
