<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hashtagModels extends Model
{
	public $timestamps = false; //set time to false
    protected $fillable = [
    	'name_tags','CmsID','Slug_tags'
    ];
    protected $primaryKey = 'CmsID';
 	protected $table = 'hash_tags'; 
}
