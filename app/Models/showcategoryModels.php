<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class showcategoryModels extends Model
{
    // use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'CmsID','id_khoa'
    ];
    protected $primaryKey = 'CmsID';
 	protected $table = 'show_category';
}
