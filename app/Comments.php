<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{    
	protected $fillable=["id_user", "id_topic", "content"];
}
