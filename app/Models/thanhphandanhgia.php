<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thanhphandanhgia extends Model
{
    // use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'id','ten_thanhphandanhgia','id_baidanhgia'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'table_thanhphandanhgia';

    public function getChilds() {
        return $this->hasMany(danhgiahocphan::class, 'id_baidanhgia')->get();
    }


}
