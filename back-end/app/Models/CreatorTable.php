<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreatorTable extends Model
{
    protected $table = "creator_tables";
    protected $fillable = ["full_name","user_name","email","password","birthday","avatar","address","country","score","words","level","subcriber","follower","role","is__deleted"];

    public static function list(){
        return CreatorTable::paginate(5);
    }
}
