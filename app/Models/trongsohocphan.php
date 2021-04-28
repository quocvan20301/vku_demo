<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trongsohocphan extends Model
{
    // use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'id','id_hp','id_trongso','trongso','trangthai'
    ];
    protected $primaryKey = 'id_hp';
 	protected $table = 'table_trongso_hp';

}
