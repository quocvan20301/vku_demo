<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kehoachgiangday extends Model
{
    // use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'id','noidung','hoatdongdayhoc','baidanhgia','cdrhocphan','id_hocphan', 'thuochocphan','namhoc','hocky'
    ];
    protected $primaryKey = 'id_hocphan';
 	protected $table = 'table_kehoachgiangday';

}
