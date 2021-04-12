<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formUL extends Model
{
	public $timestamps = false; //set time to false
    protected $fillable = [
    	'ten_form','don_vi','loai','mo_ta','duong_dan','luot_tai', 'ngay_dang'
    ];
    protected $primaryKey = 'id_form';
 	protected $table = 'form'; 
}
