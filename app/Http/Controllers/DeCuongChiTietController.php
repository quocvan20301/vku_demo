<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
//use App\Http\Controllers\Redirect;
use App\Http\Controllers\Controller;
use App\Models\decuongchitiet;
use App\Models\chuandauramonhoc;
use App\Models\danhgiahocphan;
use App\Models\thanhphandanhgia;
use App\Models\kehoachgiangday;
use App\Models\trongsolophocphan;
use DB;
use Redirect;

class DeCuongChiTietController extends Controller
{
    public function themdecuong() {
    	
    	$all_cdr_chung = DB::table('table_chuandaura_chung')->limit(3)->get();

        $all_nganh = DB::table('table_nganh')->get();


    	return view('admin.decuong.them_decuong')->with('all_cdr_chung', $all_cdr_chung)->with('all_nganh', $all_nganh);
    }

    public function data_chuyen_nganh($data, $parent_id = 0) {
        $result = [];
        $result_parent = [];
        $result_child = [];
        $id_chuyennganh = 0;
        foreach ($data as $value_child) {

            if ($value_child->id == $parent_id) {
                $result_child[] = $value_child;
                $id_chuyennganh = $value_child->id_chuyennganh;
            }    
        }

        foreach ($data as $value_parent) {

            if ($value_parent->id == $id_chuyennganh) {
                $result_parent[] = $value_parent;
            }    
        }

        $result = array_merge($result_parent, $result_child);
        return $result;
    }

    public function editdecuong($id_decuong) {

        $all_decuong = DB::table('table_decuongchitiet')
        ->join('table_hocphan', 'table_hocphan.id', 'table_decuongchitiet.id_hocphan')
        ->join('table_giangvien', 'table_giangvien.id', 'table_decuongchitiet.giangvienphutrach_id')
        ->where('table_decuongchitiet.id_decuong', $id_decuong)->first();

        // echo "<pre>";
        // print_r($all_decuong);

        // die();
        $all_nganh = DB::table('table_nganh')->get();

        $id_gvdc1 = explode("_", $all_decuong->gv_daycung);

        $list_gvdc = [];

        foreach ($id_gvdc1 as $value) {
            $gv = DB::table('table_giangvien')->where('id', $value)->first();
            $child = [];
            $child["id_gv"] = $gv->id;
            $child["ten_gv"] = $gv->hodem." ".$gv->ten;
            $list_gvdc[] = $child;
        }

        $all_cdr_nganh = DB::table('table_chuandaura_chung')->where('id_nganh', $all_decuong->id_nganh)->get();

        $all_chuandaura = DB::table('table_chuandaura_monhoc')->where('id_decuong', $id_decuong)
        ->distinct()->get();

        // echo "<pre>";
        // print_r($all_chuandaura);
        // die();

        $all_cdr_chung = DB::table('table_chuandaura_chung')->get();
        return view('admin.decuong.edit_decuong')->with('all_cdr_chung', $all_cdr_chung)
        ->with('all_decuong', $all_decuong)->with('list_gvdc', $list_gvdc)
        ->with('all_chuandaura', $all_chuandaura)->with('all_nganh', $all_nganh)
        ->with('all_cdr_nganh', $all_cdr_nganh);
    }

    public function danhsachdecuong() {

        $all_decuong = DB::table('table_decuongchitiet')
        ->join('table_hocphan', 'table_hocphan.id', 'table_decuongchitiet.id_hocphan')
        ->join('table_giangvien', 'table_giangvien.id', 'table_decuongchitiet.giangvienphutrach_id')
        ->get();

        $danhsach_danhgiahocphan = DB::table('table_danhgiahocphan')->select('id_hocphan')->distinct()->get();
        $danhsach_kehoachgiangday = DB::table('table_kehoachgiangday')->select('id_hocphan')->distinct()->get();

        foreach($all_decuong as $value_all_decuong) {

            $value_all_decuong->has_dghp = 0;

            foreach($danhsach_danhgiahocphan as $value_ds_dghp) {
                if ($value_ds_dghp->id_hocphan == $value_all_decuong->id_hocphan) {
                    $value_all_decuong->has_dghp = 1;
                    break;
                } else {
                    $value_all_decuong->has_dghp = 0;
                }
            }

            $value_all_decuong->has_khgd = 0;

            foreach($danhsach_kehoachgiangday as $value_ds_khgd) {
                if ($value_ds_khgd->id_hocphan == $value_all_decuong->id_hocphan) {
                    $value_all_decuong->has_khgd = 1;
                    break;
                } else {
                    $value_all_decuong->has_khgd = 0;
                }
            }

        }

        // echo "<pre>";
        // print_r($all_decuong);

        // die();

        return view('admin.decuong.danhsach_decuong')->with('all_decuong', $all_decuong);
    }

    public function tao_decuong(Request $request) {

    	$data = $request->all();
    	$de_cuong = new decuongchitiet;
    	$de_cuong->id_hocphan = $data['id_ten_hoc_phan'];
    	$de_cuong->phanbo_lythuyet = $data['so_tiet_ly_thuyet'];
    	$de_cuong->phanbo_baitap = $data['so_tiet_bai_tap'];
    	$de_cuong->phanbo_thuchanh = $data['so_tiet_thuc_hanh'];
    	$de_cuong->phanbo_tuhoc = $data['so_tiet_tu_hoc'];
    	$de_cuong->giangvienphutrach_id = $data['id_giang_vien_phu_trach'];

    	$list_gvdc = "";
    	foreach ($request->list_id_gvdc as $value_listgvdc) {
    		$list_gvdc .= $value_listgvdc."_";
    	}
		$rs_list_gvdc = rtrim($list_gvdc, '_');

    	$de_cuong->gv_daycung = $rs_list_gvdc;
    	$de_cuong->khoaphutrach = $data['khoa_phu_trach'];
        $de_cuong->id_nganh = $data['nganh'];
    	$de_cuong->loaihocphan = $data['loai_hoc_phan'];
    	$de_cuong->khoikienthuc = $data['khoi_kien_thuc'];
    	$de_cuong->mota_tomtat = $data['mota_tomtat'];
    	$de_cuong->muctieu_kienthuc = $data['muctieu_kienthuc'];
    	$de_cuong->muctieu_kynang = $data['muctiey_kynang'];
    	$de_cuong->muctieu_thaido = $data['muctieu_thaido'];
    	$de_cuong->nhiemvu = $data['nhiemvu'];
    	$de_cuong->tailieuthamkhao_giaotrinh = $data['tltk_giaotrinh'];
    	$de_cuong->tailieuthamkhao_sach = $data['tltk_sach'];
    	$de_cuong->ngaypheduyet = strtotime($data['ngay_phe_duyet']);

    	$de_cuong->save();

    	$id_de_cuong = $de_cuong->id_decuong;

    	$cdr_monhoc = $this->array_2d($request->list_cdr, 2);

    	foreach($cdr_monhoc as $value_cdr_monhoc) {
			$chuandaura_monhoc = new chuandauramonhoc;
		    $chuandaura_monhoc->id_cdr_chung = $value_cdr_monhoc[0];
		    $chuandaura_monhoc->noi_dung = $value_cdr_monhoc[1];
		    $chuandaura_monhoc->id_decuong = $id_de_cuong;
		    $chuandaura_monhoc->save();
		}

		return Redirect::to('/admin');

    }

    public function sua_decuong($id_decuong, Request $request) {
        $data = $request->all();
        $de_cuong = decuongchitiet::find($id_decuong);
        $de_cuong->id_hocphan = $data['id_ten_hoc_phan'];
        $de_cuong->phanbo_lythuyet = $data['so_tiet_ly_thuyet'];
        $de_cuong->phanbo_baitap = $data['so_tiet_bai_tap'];
        $de_cuong->phanbo_thuchanh = $data['so_tiet_thuc_hanh'];
        $de_cuong->phanbo_tuhoc = $data['so_tiet_tu_hoc'];
        $de_cuong->giangvienphutrach_id = $data['id_giang_vien_phu_trach'];

        $list_gvdc = "";
        foreach ($request->list_id_gvdc as $value_listgvdc) {
            $list_gvdc .= $value_listgvdc."_";
        }
        $rs_list_gvdc = rtrim($list_gvdc, '_');

        $de_cuong->gv_daycung = $rs_list_gvdc;
        $de_cuong->khoaphutrach = $data['khoa_phu_trach'];
        $de_cuong->id_nganh = $data['nganh'];
        $de_cuong->loaihocphan = $data['loai_hoc_phan'];
        $de_cuong->khoikienthuc = $data['khoi_kien_thuc'];
        $de_cuong->mota_tomtat = $data['mota_tomtat'];
        $de_cuong->muctieu_kienthuc = $data['muctieu_kienthuc'];
        $de_cuong->muctieu_kynang = $data['muctiey_kynang'];
        $de_cuong->muctieu_thaido = $data['muctieu_thaido'];
        $de_cuong->nhiemvu = $data['nhiemvu'];
        $de_cuong->tailieuthamkhao_giaotrinh = $data['tltk_giaotrinh'];
        $de_cuong->tailieuthamkhao_sach = $data['tltk_sach'];
        $de_cuong->ngaypheduyet = strtotime($data['ngay_phe_duyet']);

        $de_cuong->save();

        $delecdr = chuandauramonhoc::find($id_decuong);
        $delecdr->delete();

        $cdr_monhoc = $this->array_2d($request->list_cdr, 2);

        foreach($cdr_monhoc as $value_cdr_monhoc) {
            $chuandaura_monhoc = new chuandauramonhoc;
            $chuandaura_monhoc->id_cdr_chung = $value_cdr_monhoc[0];
            $chuandaura_monhoc->noi_dung = $value_cdr_monhoc[1];
            $chuandaura_monhoc->id_decuong = $id_decuong;
            $chuandaura_monhoc->save();
        }

        return Redirect::to('/danh-sach-de-cuong');
    }

    public function array_2d($array, $col_count=2){
    	$result = false;
    	if(!empty($array) && is_array($array)){
    		$row_count = ceil( count($array) / $col_count);
    		$pointer = 0;
    		for($row=0; $row < $row_count; $row++) {
    			for($col=0; $col < $col_count; ++$col){
    				if(isset($array[$pointer])) {
    					$result[$row][$col] = $array[$pointer];
    					$pointer++;
    				}
    			}
    		}
    	}
    	return $result;
    }

    public function xoa_decuong($id_decuong) {

        $delete_dc = decuongchitiet::find($id_decuong);
        $delete_dc->delete();

        $dele_cdr = chuandauramonhoc::find($id_decuong);
        $dele_cdr->delete();

        return Redirect::to('/danh-sach-de-cuong');

    }

    public function xem_de_cuong($id_decuong) {

        $all_decuong = DB::table('table_decuongchitiet')
        ->join('table_hocphan', 'table_hocphan.id', 'table_decuongchitiet.id_hocphan')
        ->join('table_giangvien', 'table_giangvien.id', 'table_decuongchitiet.giangvienphutrach_id')
        ->join('table_khoa', 'table_decuongchitiet.khoaphutrach', 'table_khoa.id')
        ->join('table_nganh', 'table_decuongchitiet.id_nganh', 'table_nganh.id')
        ->where('table_decuongchitiet.id_decuong', $id_decuong)->first();

        $id_gvdc1 = explode("_", $all_decuong->gv_daycung);
        $list_gvdc = [];

        foreach ($id_gvdc1 as $value) {
            $gv = DB::table('table_giangvien')->where('id', $value)->first();
            $list_gvdc[] = $gv->hodem." ".$gv->ten;
        }

        $all_cdr = DB::table('table_chuandaura_monhoc')->where('id_decuong', $id_decuong)->get();

        $decuong_dghp = DB::table('table_decuongchitiet')->select('id_hocphan')->where('id_decuong', $id_decuong)->first();
        $id_hocphan = $decuong_dghp->id_hocphan;

        $all_dghp = DB::table('table_danhgiahocphan')->join('table_thanhphandanhgia', 'table_danhgiahocphan.id_baidanhgia'
        ,'table_thanhphandanhgia.id')->where('table_danhgiahocphan.id_hocphan', $id_hocphan)->get();

        $all_baidanhgia = array();

        foreach($all_dghp as $vl_dghp_bdg) {
            $all_baidanhgia[] = $vl_dghp_bdg->id_baidanhgia_parent;
            $vl_dghp_bdg->cdr_hocphan = explode("_", $vl_dghp_bdg->cdr_hocphan);
        }

        $dghp_parent = DB::table('table_thanhphandanhgia')->where('id_baidanhgia', 0)->get();


        foreach($all_dghp as $value_child) {
            foreach($dghp_parent as $value_parent) {
                if ($value_child->id_baidanhgia_parent == $value_parent->id) {
                    $value_child->ten_thanhphandanhgia_parent = $value_parent->ten_thanhphandanhgia;
                }
            }   
        }
 
        $len = count($all_dghp);

        for ($i = 0; $i < $len; $i++) {
            $temp = $all_dghp[$i];
            $j = $i;
            for ($k = 0; $k < $len; $k++) {
                if ($k != $j) {
                    if ($temp->id_baidanhgia_parent == $all_dghp[$k]->id_baidanhgia_parent) {
                        $all_dghp[$k-1]->id_baidanhgia_parent=100;
                        $all_dghp[$k-1]->Level = 0;
                        $all_dghp[$k]->id_baidanhgia_parent=111;
                        $all_dghp[$k]->Level = 1;
                    } 
                }
            }
        }

        $baidanhgia = array();
        $i = 1;
        foreach($all_dghp as $vl_bdg) {

            if (isset($vl_bdg->Level)) {
                if ($vl_bdg->Level == 1) {
                    $baidanhgia[] = "A".$i.".2";
                    $i++;
                } else {
                    $baidanhgia[] = "A".$i.".1";
                    
                }
            } else {
                $baidanhgia[] = "A".$i.".1";
                $i++;
            }
        }


        $all_kehoachgiangday_lt = DB::table('table_kehoachgiangday')->where('thuochocphan', 'lythuyet')->where('id_hocphan', $id_hocphan)->get();
        $all_kehoachgiangday_th = DB::table('table_kehoachgiangday')->where('thuochocphan', 'thuchanh')->where('id_hocphan', $id_hocphan)->get();
        
        foreach($all_kehoachgiangday_lt as $vl_kehoachgiangday_lt) {
            $vl_kehoachgiangday_lt->noidung = $this->xem_decuong_khgd($vl_kehoachgiangday_lt->noidung);
            $vl_kehoachgiangday_lt->hoatdongdayhoc = $this->xem_decuong_khgd($vl_kehoachgiangday_lt->hoatdongdayhoc);
            $vl_kehoachgiangday_lt->cdrhocphan = explode("_", $vl_kehoachgiangday_lt->cdrhocphan);
        }

        foreach($all_kehoachgiangday_th as $vl_kehoachgiangday_th) {
            $vl_kehoachgiangday_th->noidung = $this->xem_decuong_khgd($vl_kehoachgiangday_th->noidung);
            $vl_kehoachgiangday_th->hoatdongdayhoc = $this->xem_decuong_khgd($vl_kehoachgiangday_th->hoatdongdayhoc);
            $vl_kehoachgiangday_th->cdrhocphan = explode("_", $vl_kehoachgiangday_th->cdrhocphan);
        }

        // echo "<pre>";
        // print_r($all_kehoachgiangday_lt);
        // die();

        return view('pages_2.xem_de_cuong')->with('all_decuong', $all_decuong)->with('list_gvdc', $list_gvdc)
        ->with('all_cdr', $all_cdr)->with('all_dghp', $all_dghp)->with('baidanhgia', $baidanhgia)->with('id_decuong', $id_decuong)
        ->with('all_kehoachgiangday_lt', $all_kehoachgiangday_lt)->with('all_kehoachgiangday_th', $all_kehoachgiangday_th);
    }

    public function xem_decuong_khgd($string) {

        $tach = explode("_", $string);
    
        return $tach;

    }

    public function cau_truc_ct_dt() {
        return view('pages_2.cau_truc_chuong_trinh_dt');
    }

    public function danh_gia_hoc_phan($id_decuong) {

        $all_cdr = DB::table('table_chuandaura_monhoc')->where('id_decuong', $id_decuong)->get();

        $all_tpdg = DB::table('table_thanhphandanhgia')->where('id_baidanhgia', 0)->get();

        $all_tpdg_child = DB::table('table_thanhphandanhgia')->where('id_baidanhgia', '!=', 0)->get();

        foreach($all_tpdg_child as $value) {
            foreach($all_tpdg as $value2) {
                if($value2->id == $value->id_baidanhgia) {
                    $value->parent = $value2->ten_thanhphandanhgia;
                }
            }
        }

        $lenght = count($all_tpdg_child);

        for ($i = 0; $i < $lenght; $i ++) {
            $temp = $all_tpdg_child[$i];

            for ($k = $i + 1; $k < $lenght; $k ++) {
                if($all_tpdg_child[$k]->id_baidanhgia == $temp->id_baidanhgia) {
                    $temp->has_child = 1;
                    $all_tpdg_child[$i+1]->child = 1;
                    break;
                } 
            }
        }

        // echo "<pre>";
        // print_r($all_tpdg_child);
        // die();
 
        return view('admin.decuong.danh_gia_hoc_phan')->with('all_cdr', $all_cdr)->with('all_tpdg', $all_tpdg)->with('all_tpdg_child', $all_tpdg_child)->with('id_decuong', $id_decuong);

    }

    public function insert_danh_gia_hoc_phan($id_decuong, Request $request) {

        $trong_so_thanh_phan = $request->trong_so_thanh_phan;
        $data_dghp = $this->array_2d($request->bai_danh_gia, 4);

        $decuong_dghp = DB::table('table_decuongchitiet')->select('id_hocphan')->where('id_decuong', $id_decuong)->first();
        $id_hocphan = $decuong_dghp->id_hocphan;

        $chuandaura = $request->chuan_dau_ra;

        $trongsothanhphan1 = $request->trong_so_thanh_phan_1;
        $trongsothanhphan2 = $request->trong_so_thanh_phan_2;
        $trongsothanhphan3 = $request->trong_so_thanh_phan_3;
        $trongsothanhphan4 = $request->trong_so_thanh_phan_4;

        if($trongsothanhphan1 != null) {
            $trong_so_1 = new trongsolophocphan;
            $trong_so_1->id_lhp = $id_hocphan;
            $trong_so_1->id_trongso = 1;
            $trong_so_1->trongso = $trongsothanhphan1/100;
            $trong_so_1->trangthai = 0;
            $trong_so_1->save();
        }

        if($trongsothanhphan2 != null) {
            $trong_so_2 = new trongsolophocphan;
            $trong_so_2->id_lhp = $id_hocphan;
            $trong_so_2->id_trongso = 2;
            $trong_so_2->trongso = $trongsothanhphan2/100;
            $trong_so_2->trangthai = 0;
            $trong_so_2->save();
        }

        if($trongsothanhphan3 != null) {
            $trong_so_3 = new trongsolophocphan;
            $trong_so_3->id_lhp = $id_hocphan;
            $trong_so_3->id_trongso = 3;
            $trong_so_3->trongso = $trongsothanhphan3/100;
            $trong_so_3->trangthai = 0;
            $trong_so_3->save();
        }

        if($trongsothanhphan4 != null) {
            $trong_so_4 = new trongsolophocphan;
            $trong_so_4->id_lhp = $id_hocphan;
            $trong_so_4->id_trongso = 4;
            $trong_so_4->trongso = $trongsothanhphan4/100;
            $trong_so_4->trangthai = 0;
            $trong_so_4->save();
        }


        if($data_dghp != null) {
            foreach ($data_dghp as $value_data_dghp) {
                $danh_gia_hoc_phan = new danhgiahocphan;
                $danh_gia_hoc_phan->phuongphapdanhgia = $value_data_dghp[0];
                $danh_gia_hoc_phan->trongsobaidanhgia = $value_data_dghp[1];
                $danh_gia_hoc_phan->id_baidanhgia = $value_data_dghp[3];
                $danh_gia_hoc_phan->id_baidanhgia_parent = $value_data_dghp[2];
                $danh_gia_hoc_phan->id_hocphan = $id_hocphan;
    
                $cdr_hocphan = "";
    
                if(isset($chuandaura) && $chuandaura != null) {
                    foreach($chuandaura as $value_chuandaura) {
                        $value_chuandaura = explode("_", $value_chuandaura);
                     
                        if((integer)$value_chuandaura[0] == $value_data_dghp[3]) {
                            $cdr_hocphan .= $value_chuandaura[1]."_";
                        }
                    }
        
                    $cdr_hocphan = rtrim($cdr_hocphan, '_');
                }
    
                $danh_gia_hoc_phan->cdr_hocphan = $cdr_hocphan;
    
                $danh_gia_hoc_phan->save();
            }
        }

        return Redirect::to('/danh-sach-de-cuong');
    }

    public function edit_danh_gia_hoc_phan($id_decuong) {

        $all_cdr = DB::table('table_chuandaura_monhoc')->where('id_decuong', $id_decuong)->get();

        $all_tpdg = DB::table('table_thanhphandanhgia')->where('id_baidanhgia', 0)->get();
        $all_tpdg_child = DB::table('table_thanhphandanhgia')->where('id_baidanhgia', '!=', 0)->get();

        $decuong_dghp = DB::table('table_decuongchitiet')->select('id_hocphan')->where('id_decuong', $id_decuong)->first();
        $id_hocphan = $decuong_dghp->id_hocphan;

        $all_danhgiahocphan = DB::table('table_danhgiahocphan')->where('id_hocphan', $id_hocphan)->get();

      
        foreach($all_tpdg_child as $value) {
            foreach($all_tpdg as $value2) {
                if($value2->id == $value->id_baidanhgia) {
                    $value->parent = $value2->ten_thanhphandanhgia;
                }
            }
        }
        $lenght = count($all_tpdg_child);
        for ($i = 0; $i < $lenght; $i ++) {
            $temp = $all_tpdg_child[$i];
            for ($k = $i + 1; $k < $lenght; $k ++) {
                if($all_tpdg_child[$k]->id_baidanhgia == $temp->id_baidanhgia) {
                    $temp->has_child = 1;
                    $all_tpdg_child[$i+1]->child = 1;
                    $temp->has_child_exits=1;
                    $all_tpdg_child[$i+1]->has_child_exits = 1;
                    break;
                } 
            }

            if(!isset($temp->has_child_exits)) {
                $temp->has_child_exits=0;
            }
    
        }
        // foreach($all_tpdg_child as $vl1) {
        //     foreach($all_danhgiahocphan as $vl2) {
        //         if($vl1->id == $vl2->id_baidanhgia) {
        //             $vl1->has_id_bdg = 1;
        //             break;
        //         } else {
        //             $vl1->has_id_bdg = 0;
        //         }
        //     }
        // }

        $all_trongsothanhphan = DB::table('table_trongso_lhp')->where('id_lhp', $id_hocphan)->get();
        foreach($all_tpdg as $vl_all_tpdg) {
            $vl_all_tpdg->has_id_tstp = 0;
            foreach($all_trongsothanhphan as $vl_all_trongsothanhphan) {
                if($vl_all_tpdg->id == $vl_all_trongsothanhphan->id_trongso) {
                    $vl_all_tpdg->has_id_tstp = 1;
                    $vl_all_tpdg->trongso = $vl_all_trongsothanhphan->trongso;
                    break;
                } else {
                    $vl_all_tpdg->has_id_tstp = 0;
                }
            }
        }

        foreach($all_danhgiahocphan as $vl_dghp_cdr) {
            $vl_dghp_cdr->cdr_hocphan = explode("_", $vl_dghp_cdr->cdr_hocphan);
        }

        $array_chuandaura = array();

        foreach($vl_dghp_cdr->cdr_hocphan as $value) {
            $array_chuandaura[] = $value;
        }

        $stt_cdr = 1;
        foreach($all_cdr as $vl) {
            $vl->has_cdr = 0;
            $vl->stt = $stt_cdr;
            for($i = 0; $i < count($array_chuandaura); $i++) {
                if($array_chuandaura[$i] == $stt_cdr) {
                    $vl->has_cdr = 1;
                }
            }
            $stt_cdr++;
        }

        foreach($all_tpdg_child as $value_result ) {
            $value_result->has_exits = 0;
            foreach($all_danhgiahocphan as $value_result2) {
                if($value_result->id == $value_result2->id_baidanhgia) {
                    $value_result->phuongphapdanhgia = $value_result2->phuongphapdanhgia;
                    $value_result->trongsobaidanhgia = $value_result2->trongsobaidanhgia;
                    $value_result->cdr_hocphan = $value_result2->cdr_hocphan;
                    $value_result->has_exits = 1;
                }
            }
        }

        foreach($all_tpdg_child as $value ) {
            foreach($all_tpdg as $value2) {
                if($value->parent == $value2->ten_thanhphandanhgia) {
                    if(isset($value2->trongso)) {
                        $value->trongso = $value2->trongso;    
                    }  
                } 
            }
        }

        // echo "<pre>";
        // print_r($all_cdr);
        // echo $array_chuandaura[1];
        // die();

        return view('admin.decuong.edit_danh_gia_hoc_phan')->with('all_cdr', $all_cdr)->with('all_tpdg', $all_tpdg)
        ->with('all_tpdg_child', $all_tpdg_child)->with('id_decuong', $id_decuong)
        ->with('all_danhgiahocphan', $all_danhgiahocphan)->with('all_trongsothanhphan', $all_trongsothanhphan)
        ->with('array_chuandaura', $array_chuandaura);

    }

    public function insert_edit_danh_gia_hoc_phan($id_decuong, Request $request) {

        $trong_so_thanh_phan = $request->trong_so_thanh_phan;
        $data_dghp = $this->array_2d($request->bai_danh_gia, 4);

        $decuong_dghp = DB::table('table_decuongchitiet')->select('id_hocphan')->where('id_decuong', $id_decuong)->first();
        $id_hocphan = $decuong_dghp->id_hocphan;

        $deletedghp = danhgiahocphan::find($id_hocphan);
        $deletedghp->delete();

        $deletetslhp = trongsolophocphan::find($id_hocphan);
        $deletetslhp->delete();

        $chuandaura = $request->chuan_dau_ra;
        
        $trongsothanhphan1 = $request->trong_so_thanh_phan_1;
        $trongsothanhphan2 = $request->trong_so_thanh_phan_2;
        $trongsothanhphan3 = $request->trong_so_thanh_phan_3;
        $trongsothanhphan4 = $request->trong_so_thanh_phan_4;

        // echo $trongsothanhphan1/100;
        // die();

        if($trongsothanhphan1 != null) {
            $trong_so_1 = new trongsolophocphan;
            $trong_so_1->id_lhp = $id_hocphan;
            $trong_so_1->id_trongso = 1;
            $trong_so_1->trongso = $trongsothanhphan1/100;
            $trong_so_1->trangthai = 0;
            $trong_so_1->save();
        }

        if($trongsothanhphan2 != null) {
            $trong_so_2 = new trongsolophocphan;
            $trong_so_2->id_lhp = $id_hocphan;
            $trong_so_2->id_trongso = 2;
            $trong_so_2->trongso = $trongsothanhphan2/100;
            $trong_so_2->trangthai = 0;
            $trong_so_2->save();
        }

        if($trongsothanhphan3 != null) {
            $trong_so_3 = new trongsolophocphan;
            $trong_so_3->id_lhp = $id_hocphan;
            $trong_so_3->id_trongso = 3;
            $trong_so_3->trongso = $trongsothanhphan3/100;
            $trong_so_3->trangthai = 0;
            $trong_so_3->save();
        }

        if($trongsothanhphan4 != null) {
            $trong_so_4 = new trongsolophocphan;
            $trong_so_4->id_lhp = $id_hocphan;
            $trong_so_4->id_trongso = 4;
            $trong_so_4->trongso = $trongsothanhphan4/100;
            $trong_so_4->trangthai = 0;
            $trong_so_4->save();
        }


        if($data_dghp != null) {
            foreach ($data_dghp as $value_data_dghp) {
                $danh_gia_hoc_phan = new danhgiahocphan;
                $danh_gia_hoc_phan->phuongphapdanhgia = $value_data_dghp[0];
                $danh_gia_hoc_phan->trongsobaidanhgia = $value_data_dghp[1];
                $danh_gia_hoc_phan->id_baidanhgia = $value_data_dghp[3];
                $danh_gia_hoc_phan->id_baidanhgia_parent = $value_data_dghp[2];
                $danh_gia_hoc_phan->id_hocphan = $id_hocphan;
    
                $cdr_hocphan = "";
    
                if(isset($chuandaura) && $chuandaura != null) {
                    foreach($chuandaura as $value_chuandaura) {
                        $value_chuandaura = explode("_", $value_chuandaura);
                     
                        if((integer)$value_chuandaura[0] == $value_data_dghp[3]) {
                            $cdr_hocphan .= $value_chuandaura[1]."_";
                        }
                    }
        
                    $cdr_hocphan = rtrim($cdr_hocphan, '_');
                }
    
                $danh_gia_hoc_phan->cdr_hocphan = $cdr_hocphan;
    
                $danh_gia_hoc_phan->save();
            }
        }

        return Redirect::to('/danh-sach-de-cuong');

    }

    public function ke_hoach_giang_day($id_decuong) {

        $all_cdr = DB::table('table_chuandaura_monhoc')->where('id_decuong', $id_decuong)->get();

        $decuong_dghp = DB::table('table_decuongchitiet')->select('id_hocphan')->where('id_decuong', $id_decuong)->first();
        $id_hocphan = $decuong_dghp->id_hocphan;

        $all_dghp = DB::table('table_danhgiahocphan')->join('table_thanhphandanhgia', 'table_danhgiahocphan.id_baidanhgia'
        ,'table_thanhphandanhgia.id')->where('table_danhgiahocphan.id_hocphan', $id_hocphan)->get();

        $all_trongso = DB::table('table_trongso_lhp')->where('id_lhp', $id_hocphan)->get();

        $all_baidanhgia = array();

        foreach($all_dghp as $vl_dghp_bdg) {
            $all_baidanhgia[] = $vl_dghp_bdg->id_baidanhgia_parent;
            $vl_dghp_bdg->cdr_hocphan = explode("_", $vl_dghp_bdg->cdr_hocphan);
        }

        $dghp_parent = DB::table('table_thanhphandanhgia')->where('id_baidanhgia', 0)->get();


        foreach($all_dghp as $value_child) {
            foreach($dghp_parent as $value_parent) {
                if ($value_child->id_baidanhgia_parent == $value_parent->id) {
                    $value_child->ten_thanhphandanhgia_parent = $value_parent->ten_thanhphandanhgia;
                }
            }   
        }
 
        $len = count($all_dghp);

        for ($i = 0; $i < $len; $i++) {
            $temp = $all_dghp[$i];
            $j = $i;
            for ($k = 0; $k < $len; $k++) {
                if ($k != $j) {
                    if ($temp->id_baidanhgia_parent == $all_dghp[$k]->id_baidanhgia_parent) {
                        $all_dghp[$k-1]->id_baidanhgia_parent=100;
                        $all_dghp[$k-1]->Level = 0;
                        $all_dghp[$k]->id_baidanhgia_parent=111;
                        $all_dghp[$k]->Level = 1;
                    } 
                }
            }
        }

        $baidanhgia = array();
        $i = 1;
        foreach($all_dghp as $vl_bdg) {

            if (isset($vl_bdg->Level)) {
                if ($vl_bdg->Level == 1) {
                    $baidanhgia[] = "A".$i.".2";
                    $i++;
                } else {
                    $baidanhgia[] = "A".$i.".1";
                    
                }
            } else {
                $baidanhgia[] = "A".$i.".1";
                $i++;
            }
        }

        // echo "<pre>";
        // print_r($all_dghp);
        // die();

        return view('admin.decuong.ke_hoach_giang_day')->with('all_cdr', $all_cdr)->with('all_dghp', $all_dghp)
        ->with('baidanhgia', $baidanhgia)->with('id_decuong', $id_decuong)
        ->with('all_trongso', $all_trongso);
    }

    public function data_tree_dghp($data, $parent_id = 0, $level = 0, $hasChild = 0) {
        $result = [];
        foreach ($data as $value) {
            if($value->id_baidanhgia_parent == $parent_id) {
                $value->level = $level;
                $value->hasChild = 0;
                $result[] = $value;
                $child = $this->data_tree_dghp($data, $value->id_baidanhgia_parent, $level + 1);
                if($child) {
                    $value->hasChild = 1;
                    //$result = array_merge($result, $child);
                }
                
            }     
        }
        return $result;
    }

    public function insert_ke_hoach_giang_day($id_decuong, Request $request) {
        
        $decuong_dghp = DB::table('table_decuongchitiet')->select('id_hocphan')->where('id_decuong', $id_decuong)->first();
        $id_hocphan = $decuong_dghp->id_hocphan;

        $ke_hoach_giang_day = $request->ke_hoach_giang_day;
        $data_khgd = $this->array_2d($request->ke_hoach_giang_day, 3);

        $data_khgd_thuchanh = $this->array_2d($request->ke_hoach_giang_day_thuchanh, 3);

        $bai_danh_gia = $request->bai_danh_gia;
        $chuan_dau_ra = $request->chuan_dau_ra;

        $bai_danh_gia_thuchanh = $request->bai_danh_gia_thuchanh;
        $chuan_dau_ra_thuchanh = $request->chuan_dau_ra_thuchanh;

        $namhoc = $request->namhoc;
        $hocky = $request->hocky;

        if (isset($data_khgd) && $data_khgd != null) {
            foreach($data_khgd as $value_data_khgd) {

                $vl_khgd_0 = $this->tach_hop_khgd($value_data_khgd[0]);
                $vl_khgd_1 = $this->tach_hop_khgd($value_data_khgd[1]);

                $kehoachgiangday = new kehoachgiangday;
                $kehoachgiangday->noidung = $vl_khgd_0;
                $kehoachgiangday->hoatdongdayhoc = $vl_khgd_1;

                $bdg = "";
                if(isset($bai_danh_gia) && $bai_danh_gia != null) {
                    foreach($bai_danh_gia as $value_bdg) {
                        $value_bdg = explode("_", $value_bdg);
                       
                        if($value_bdg[0] == $value_data_khgd[2]) {
                            $bdg .= $value_bdg[1]."_";
                        }
                    }
                    $bdg = rtrim($bdg, '_');
                }

                $cdr = "";
                if(isset($chuan_dau_ra) && $chuan_dau_ra != null) {
                    foreach($chuan_dau_ra as $value_cdr) {
                        $value_cdr = explode("_", $value_cdr);
                       
                        if($value_cdr[0] == $value_data_khgd[2]) {
                            $cdr .= $value_cdr[1]."_";
                        }
                    }
                    $cdr = rtrim($cdr, '_');
                }

                $kehoachgiangday->baidanhgia = $bdg;
                $kehoachgiangday->cdrhocphan = $cdr;

                $kehoachgiangday->id_hocphan = $id_hocphan;
                $kehoachgiangday->thuochocphan = "lythuyet";
                $kehoachgiangday->namhoc = $namhoc;
                $kehoachgiangday->hocky = $hocky;

                $kehoachgiangday->save();
                
            }
        }

        if (isset($data_khgd_thuchanh) && $data_khgd_thuchanh != null) {
            foreach($data_khgd_thuchanh as $value_data_khgd_thuchanh) {

                $vl_khgd_thuchanh_0 = $this->tach_hop_khgd($value_data_khgd_thuchanh[0]);
                $vl_khgd_thuchanh_1 = $this->tach_hop_khgd($value_data_khgd_thuchanh[1]);

                $kehoachgiangdaythuchanh = new kehoachgiangday;
                $kehoachgiangdaythuchanh->noidung = $vl_khgd_thuchanh_0;
                $kehoachgiangdaythuchanh->hoatdongdayhoc = $vl_khgd_thuchanh_1;

                $bdg_thuchanh = "";
                if(isset($bai_danh_gia_thuchanh) && $bai_danh_gia_thuchanh != null) {
                    foreach($bai_danh_gia_thuchanh as $value_bdg_thuchanh) {
                        $value_bdg_thuchanh = explode("_", $value_bdg_thuchanh);
                       
                        if($value_bdg_thuchanh[0] == $value_data_khgd_thuchanh[2]) {
                            $bdg_thuchanh .= $value_bdg_thuchanh[1]."_";
                        }
                    }
                    $bdg_thuchanh = rtrim($bdg_thuchanh, '_');
                }

                $cdr_thuchanh = "";
                if(isset($chuan_dau_ra_thuchanh) && $chuan_dau_ra_thuchanh != null) {
                    foreach($chuan_dau_ra_thuchanh as $value_cdr_thuchanh) {
                        $value_cdr_thuchanh = explode("_", $value_cdr_thuchanh);
                       
                        if($value_cdr_thuchanh[0] == $value_data_khgd_thuchanh[2]) {
                            $cdr_thuchanh .= $value_cdr_thuchanh[1]."_";
                        }
                    }
                    $cdr_thuchanh = rtrim($cdr_thuchanh, '_');
                }

                $kehoachgiangdaythuchanh->baidanhgia = $bdg_thuchanh;
                $kehoachgiangdaythuchanh->cdrhocphan = $cdr_thuchanh;

                $kehoachgiangdaythuchanh->id_hocphan = $id_hocphan;
                $kehoachgiangdaythuchanh->thuochocphan = "thuchanh";
                $kehoachgiangdaythuchanh->namhoc = $namhoc;
                $kehoachgiangdaythuchanh->hocky = $hocky;

                $kehoachgiangdaythuchanh->save();
                
            }
        }

        return Redirect::to('/danh-sach-de-cuong');
    }

    public function tach_hop_khgd($string) {

        $tach = explode("\n", $string);
        $gop = "";

        for ($i = 0; $i < count($tach); $i++) {
            $gop .= trim($tach[$i])."_";
        }

        $result = rtrim($gop, '_');
        return $result;


    }

    public function edit_ke_hoach_giang_day($id_decuong) {
        $all_cdr = DB::table('table_chuandaura_monhoc')->where('id_decuong', $id_decuong)->get();

        $decuong_dghp = DB::table('table_decuongchitiet')->select('id_hocphan')->where('id_decuong', $id_decuong)->first();
        $id_hocphan = $decuong_dghp->id_hocphan;

        $all_dghp = DB::table('table_danhgiahocphan')->join('table_thanhphandanhgia', 'table_danhgiahocphan.id_baidanhgia'
        ,'table_thanhphandanhgia.id')->where('table_danhgiahocphan.id_hocphan', $id_hocphan)->get();

        $all_trongso = DB::table('table_trongso_lhp')->where('id_lhp', $id_hocphan)->get();

        $all_baidanhgia = array();

        foreach($all_dghp as $vl_dghp_bdg) {
            $all_baidanhgia[] = $vl_dghp_bdg->id_baidanhgia_parent;
            $vl_dghp_bdg->cdr_hocphan = explode("_", $vl_dghp_bdg->cdr_hocphan);
        }

        $dghp_parent = DB::table('table_thanhphandanhgia')->where('id_baidanhgia', 0)->get();

        foreach($all_dghp as $value_child) {
            foreach($dghp_parent as $value_parent) {
                if ($value_child->id_baidanhgia_parent == $value_parent->id) {
                    $value_child->ten_thanhphandanhgia_parent = $value_parent->ten_thanhphandanhgia;
                }
            }   
        }
 
        $len = count($all_dghp);

        for ($i = 0; $i < $len; $i++) {
            $temp = $all_dghp[$i];
            $j = $i;
            for ($k = 0; $k < $len; $k++) {
                if ($k != $j) {
                    if ($temp->id_baidanhgia_parent == $all_dghp[$k]->id_baidanhgia_parent) {
                        $all_dghp[$k-1]->id_baidanhgia_parent=100;
                        $all_dghp[$k-1]->Level = 0;
                        $all_dghp[$k]->id_baidanhgia_parent=111;
                        $all_dghp[$k]->Level = 1;
                    } 
                }
            }
        }

        $baidanhgia = array();
        $i = 1;
        foreach($all_dghp as $vl_bdg) {

            if (isset($vl_bdg->Level)) {
                if ($vl_bdg->Level == 1) {
                    $baidanhgia[] = "A".$i.".2";
                    $i++;
                } else {
                    $baidanhgia[] = "A".$i.".1";
                    
                }
            } else {
                $baidanhgia[] = "A".$i.".1";
                $i++;
            }
        }

        $all_edit_khgd = DB::table('table_kehoachgiangday')->where('id_hocphan', $id_hocphan)->where('thuochocphan', "lythuyet")->get();
        
        if(isset($all_edit_khgd) && $all_edit_khgd != null) {
            $namhoc = $all_edit_khgd[0]->namhoc;
            $hocky = $all_edit_khgd[0]->hocky;
        }

        $all_edit_khgd_thuchanh = DB::table('table_kehoachgiangday')->where('id_hocphan', $id_hocphan)->where('thuochocphan', "thuchanh")->get();

        foreach($all_edit_khgd as $value_all_edit_khgd) {
            $value_all_edit_khgd->noidung = $this->tach_khgd($value_all_edit_khgd->noidung);
            $value_all_edit_khgd->hoatdongdayhoc = $this->tach_khgd($value_all_edit_khgd->hoatdongdayhoc);
            $value_all_edit_khgd->baidanhgia = explode("_", $value_all_edit_khgd->baidanhgia);
            $value_all_edit_khgd->cdrhocphan = explode("_", $value_all_edit_khgd->cdrhocphan);
        }

        foreach($all_edit_khgd_thuchanh as $value_all_edit_khgd_thuchanh) {
            $value_all_edit_khgd_thuchanh->noidung = $this->tach_khgd($value_all_edit_khgd_thuchanh->noidung);
            $value_all_edit_khgd_thuchanh->hoatdongdayhoc = $this->tach_khgd($value_all_edit_khgd_thuchanh->hoatdongdayhoc);
            $value_all_edit_khgd_thuchanh->baidanhgia = explode("_", $value_all_edit_khgd_thuchanh->baidanhgia);
            $value_all_edit_khgd_thuchanh->cdrhocphan = explode("_", $value_all_edit_khgd_thuchanh->cdrhocphan);
        }

        // echo "<pre>";
        // print_r($all_trongso);
        // die();

        return view('admin.decuong.edit_ke_hoach_giang_day')->with('all_cdr', $all_cdr)->with('all_dghp', $all_dghp)
        ->with('baidanhgia', $baidanhgia)->with('id_decuong', $id_decuong)->with('all_edit_khgd', $all_edit_khgd)
        ->with('all_edit_khgd_thuchanh', $all_edit_khgd_thuchanh)->with('namhoc', $namhoc)->with('hocky', $hocky)
        ->with('all_trongso', $all_trongso);
    }

    public function tach_khgd($string) {

        $tach = explode("_", $string);
        $gop = "";

        for ($i = 0; $i < count($tach); $i++) {
            $gop .= trim($tach[$i])."\n";
        }

        $result = rtrim($gop, '\n');

        return $result;

    }

    public function insert_edit_ke_hoach_giang_day($id_decuong, Request $request) {
        $decuong_dghp = DB::table('table_decuongchitiet')->select('id_hocphan')->where('id_decuong', $id_decuong)->first();
        $id_hocphan = $decuong_dghp->id_hocphan;

        $ke_hoach_giang_day = $request->ke_hoach_giang_day;
        $data_khgd = $this->array_2d($request->ke_hoach_giang_day, 3);

        $data_khgd_thuchanh = $this->array_2d($request->ke_hoach_giang_day_thuchanh, 3);

        $bai_danh_gia = $request->bai_danh_gia;
        $chuan_dau_ra = $request->chuan_dau_ra;

        $bai_danh_gia_thuchanh = $request->bai_danh_gia_thuchanh;
        $chuan_dau_ra_thuchanh = $request->chuan_dau_ra_thuchanh;

        $namhoc = $request->namhoc;
        $hocky = $request->hocky;

        $deletekhgd = kehoachgiangday::find($id_hocphan);
        $deletekhgd->delete();

        if (isset($data_khgd) && $data_khgd != null) {
            foreach($data_khgd as $value_data_khgd) {

                $vl_khgd_0 = $this->tach_hop_khgd($value_data_khgd[0]);
                $vl_khgd_1 = $this->tach_hop_khgd($value_data_khgd[1]);

                $kehoachgiangday = new kehoachgiangday;
                $kehoachgiangday->noidung = $vl_khgd_0;
                $kehoachgiangday->hoatdongdayhoc = $vl_khgd_1;

                $bdg = "";
                if(isset($bai_danh_gia) && $bai_danh_gia != null) {
                    foreach($bai_danh_gia as $value_bdg) {
                        $value_bdg = explode("_", $value_bdg);
                       
                        if($value_bdg[0] == $value_data_khgd[2]) {
                            $bdg .= $value_bdg[1]."_";
                        }
                    }
                    $bdg = rtrim($bdg, '_');
                }

                $cdr = "";
                if(isset($chuan_dau_ra) && $chuan_dau_ra != null) {
                    foreach($chuan_dau_ra as $value_cdr) {
                        $value_cdr = explode("_", $value_cdr);
                       
                        if($value_cdr[0] == $value_data_khgd[2]) {
                            $cdr .= $value_cdr[1]."_";
                        }
                    }
                    $cdr = rtrim($cdr, '_');
                }

                $kehoachgiangday->baidanhgia = $bdg;
                $kehoachgiangday->cdrhocphan = $cdr;

                $kehoachgiangday->id_hocphan = $id_hocphan;
                $kehoachgiangday->thuochocphan = "lythuyet";
                $kehoachgiangday->namhoc = $namhoc;
                $kehoachgiangday->hocky = $hocky;

                $kehoachgiangday->save();
                
            }
        }

        if (isset($data_khgd_thuchanh) && $data_khgd_thuchanh != null) {
            foreach($data_khgd_thuchanh as $value_data_khgd_thuchanh) {

                $vl_khgd_thuchanh_0 = $this->tach_hop_khgd($value_data_khgd_thuchanh[0]);
                $vl_khgd_thuchanh_1 = $this->tach_hop_khgd($value_data_khgd_thuchanh[1]);

                $kehoachgiangdaythuchanh = new kehoachgiangday;
                $kehoachgiangdaythuchanh->noidung = $vl_khgd_thuchanh_0;
                $kehoachgiangdaythuchanh->hoatdongdayhoc = $vl_khgd_thuchanh_1;

                $bdg_thuchanh = "";
                if(isset($bai_danh_gia_thuchanh) && $bai_danh_gia_thuchanh != null) {
                    foreach($bai_danh_gia_thuchanh as $value_bdg_thuchanh) {
                        $value_bdg_thuchanh = explode("_", $value_bdg_thuchanh);
                       
                        if($value_bdg_thuchanh[0] == $value_data_khgd_thuchanh[2]) {
                            $bdg_thuchanh .= $value_bdg_thuchanh[1]."_";
                        }
                    }
                    $bdg_thuchanh = rtrim($bdg_thuchanh, '_');
                }

                $cdr_thuchanh = "";
                if(isset($chuan_dau_ra_thuchanh) && $chuan_dau_ra_thuchanh != null) {
                    foreach($chuan_dau_ra_thuchanh as $value_cdr_thuchanh) {
                        $value_cdr_thuchanh = explode("_", $value_cdr_thuchanh);
                       
                        if($value_cdr_thuchanh[0] == $value_data_khgd_thuchanh[2]) {
                            $cdr_thuchanh .= $value_cdr_thuchanh[1]."_";
                        }
                    }
                    $cdr_thuchanh = rtrim($cdr_thuchanh, '_');
                }

                $kehoachgiangdaythuchanh->baidanhgia = $bdg_thuchanh;
                $kehoachgiangdaythuchanh->cdrhocphan = $cdr_thuchanh;

                $kehoachgiangdaythuchanh->id_hocphan = $id_hocphan;
                $kehoachgiangdaythuchanh->thuochocphan = "thuchanh";
                $kehoachgiangdaythuchanh->namhoc = $namhoc;
                $kehoachgiangdaythuchanh->hocky = $hocky;

                $kehoachgiangdaythuchanh->save();
                
            }
        }

        return Redirect::to('/danh-sach-de-cuong');
    }



}
