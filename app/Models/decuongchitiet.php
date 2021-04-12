<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class decuongchitiet extends Model
{
	public $timestamps = false; //set time to false
    protected $fillable = [
    	'id','id_hocphan','phanbo_lythuyet','phanbo_baitap','phanbo_thuchanh','phanbo_tuhoc','giangvienphutrach_id','gv_daycung','khoaphutrach','id_nganh','loaihocphan','khoikienthuc','mota_tomtat','muctieu_kienthuc','muctieu_kynang','muctieu_thaido','nhiemvu','tailieuthamkhao_giaotrinh','tailieuthamkhao_sach','ngaypheduyet'
    ];
    protected $primaryKey = 'id_decuong';
 	protected $table = 'table_decuongchitiet'; 
}
