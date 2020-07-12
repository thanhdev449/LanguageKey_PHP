<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreatorTable extends Model
{
    protected $table = "creator_tables";
    protected $fillable = ["full_name","user_name","email","password","birthday","avatar","address","country","score","words","level","subcriber","follower","role","is__deleted"];

    public static function listAndFind($params){
        $a_creator = CreatorTable::select("full_name","user_name","email","avatar","address","country","score","words","level","subcriber","follower","role")
                                  ->where("is_deleted",0);
        if (isset($params['full_name']) && !empty($params['full_name'])) {
            $a_creator->where('full_name','like',"%".$params['full_name']."%");
        }
        if (isset($params['email']) && !empty($params['email'])) {
            $a_creator->where('email','like',"%".$params['email']."%");
        }
        if (isset($params['address']) && !empty($params['address'])) {
           $a_creator->where('address','like',"%".$params['address']."%");
        }
        return $a_creator->orderBy('id','asc')
                         ->paginate(isset($params['page_limit']) ? $params['page_limit'] : 5);
        // return $a_creator;
    }
}
