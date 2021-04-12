<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhgiahocphan extends Model
{
    // use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'id','phuongphapdanhgia','trongsobaidanhgia','trongsothanhphan','cdr_hocphan','id_baidanhgia', 'id_baidanhgia_parent','id_hocphan'
    ];
    protected $primaryKey = 'id_hocphan';
 	protected $table = 'table_danhgiahocphan';

}
