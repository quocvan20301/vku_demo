<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoryModels extends Model
{
    // use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'CategoryID','ParentID','Name_l0','Slug_category','Index','Khoa'
    ];
    protected $primaryKey = 'CategoryID';
 	protected $table = 'cms_categories';

}
