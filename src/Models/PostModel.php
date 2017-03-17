<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
* 
*/
class PostModel extends Model
{
    protected $table 		= 'posts';
    protected $primarykey 	= 'id';
    protected $fillable		= ['title', 'content', 'deleted'];
    public $timestamps		= true;
}