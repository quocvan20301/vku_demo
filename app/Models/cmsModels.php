<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cmsModels extends Model
{
    // use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'CategoryID','Slug','Title_l0','Content_l0','Avatar','SimpleContent_l0','Status','Event','List_show_khoa', 'Date'
    ];
    protected $primaryKey = 'CmsID';
 	protected $table = 'cms';
}
