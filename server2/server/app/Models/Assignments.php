<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Assignments extends Model
{
    use HasFactory;
    public function create(array $attributes)
    {
        return DB::insert('INSERT INTO assignments (id_user,title,des,link) VALUES (?,?,?,?)',[$attributes['id_user'],
        $attributes['title'],$attributes['des'],$attributes['link']]);
    }
    public function get_data()
    {
        return DB::select('SELECT * FROM assignments');
    }
    public function get_data_by_id($id)
    {
        return DB::select('SELECT * FROM assignments where id_task=?',[$id]);
    }
    public function delete_data_by_id($id)
    {
        return DB::delete('DELETE FROM assignments where id_task=?',[$id]);
    }
    public function edit(array $attributes)
    {
        if($attributes['link'] == null)
        {
            return DB::update('UPDATE assignments SET title=?,des=? WHERE id_task=?',[$attributes['title'],$attributes['des'],$attributes['id_task']]);
        }
        else
        {
            return DB::update('UPDATE assignments SET title=?,des=?,link=? WHERE id_task=?',[$attributes['title'],$attributes['des'],$attributes['link'],$attributes['id_task']]);
        }
    }
}
 