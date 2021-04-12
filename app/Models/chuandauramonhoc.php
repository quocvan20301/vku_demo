<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chuandauramonhoc extends Model
{
    // use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'id','id_cdr_chung','noi_dung','id_decuong'
    ];
    protected $primaryKey = 'id_decuong';
 	protected $table = 'table_chuandaura_monhoc';
}
