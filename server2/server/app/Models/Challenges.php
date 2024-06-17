<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Challenges extends Model
{
    use HasFactory;
    public function get_data()
    {
        return DB::select('SELECT * FROM challenges');
    }
    public function get_data_by_id($id)
    {
        return DB::select('SELECT * FROM challenges where id=?',[$id]);
    }
    public function delete_data_by_id($id)
    {
        return DB::delete('DELETE FROM challenges where id=?',[$id]);
    }
    public function create(array $attributes)
    {
        return DB::insert('INSERT INTO challenges (name,des,link) VALUES (?,?,?)',[$attributes['name'],$attributes['des'],$attributes['link']]);
    }
}
