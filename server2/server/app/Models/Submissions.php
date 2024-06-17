<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Submissions extends Model
{
    use HasFactory;
    public function create(array $attributes)
    {
        return DB::insert('INSERT INTO submissions (id_user,id_task,link) VALUES (?,?,?)',[$attributes['id_user']
        ,$attributes['id_task'],$attributes['link']]);
    }
    public function get_data()
    {
        return DB::select('SELECT * FROM submissions');
    }
    public function get_data_by_id_task($id_task)
    {
        return DB::select('SELECT * FROM submissions where id_task=?',[$id_task]);
    }

    public function get_data_submission($id_task,$id_user)
    {
        return DB::select('SELECT * FROM submissions where id_user=? and id_task=?',[$id_user,$id_task]);
    }
    public function edit(array $attributes)
    {
        if($attributes['link'] == null)
        {
            return DB::update('UPDATE submissions SET title=?,des=? WHERE id_task=?',[$attributes['title'],$attributes['des'],$attributes['id_task']]);
        }
        else
        {
            return DB::update('UPDATE submissions SET title=?,des=?,link=? WHERE id_task=?',[$attributes['title'],$attributes['des'],$attributes['link'],$attributes['id_task']]);
        }
    }
}
