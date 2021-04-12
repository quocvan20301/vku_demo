<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use App\Models\formUL;
use DB;
use Illuminate\Support\Facades\Redirect;


class bieuMau extends Controller
{
    public function download($file_name, $id_form) {

    	$form = DB::table('form')->where('id_form', $id_form)->first();

    	$data = array();
        $data['luot_tai'] = $form->luot_tai + 1;

        DB::table('form')->where('id_form', $id_form)->update($data);


    	$file = "./public/download/".$file_name;

    	$headers = array(
              'Content-Type: application/doc',
            );

    	return Response::download($file, $file_name, $headers);
    }

    public function uploadform() {
    	$all_donvi = DB::table('donvi_form')->get();
    	return view('admin.form.uploadform')->with('all_donvi', $all_donvi);
    }

    public function uploadform_insert(Request $request) {

    	$data = $request->all();
        $formul = new formUL;
        $formul->ten_form = $data['name_form'];
        $formul->don_vi = $data['donvi_form'];
        $formul->loai = $data['loai_form'];
        $formul->mo_ta = $data['mota_form'];
        $formul->luot_tai = '0';

        $date_ul = date('Y/m/d', time());
        $formul->ngay_dang = $date_ul;

        $get_fileform = $request->file('file_form');

        $get_name_form = $get_fileform->getClientOriginalName();
        $name_form = current(explode('.', $get_name_form)); //current(explode('.', $get_name_image)); chia chuỗi ra để cắt đuôi từ dấu chấm
        $new_custom_name_form = $name_form.'('.rand(0,99).')'.'.'.$get_fileform->getClientOriginalExtension(); 
            //getClientOriginalExtention():lấy đuôi mở rộng
        $get_fileform->move('./public/download', $new_custom_name_form);

        $formul->duong_dan = $new_custom_name_form;

        $formul->save();

    	return redirect::to('admin');

    }

    public function allform() {

    	$all_form = DB::table('form')->join('donvi_form', 'form.don_vi', 'donvi_form.id_dvf')->get();

    	return view('admin.form.allform')->with('all_form', $all_form);
    }

    public function editform($id_form) {
    	$all_donvi = DB::table('donvi_form')->get();
    	$all_edit_form = formUL::find($id_form);
    	// echo "<pre>";
    	// print_r($all_edit_form);
    	// die();
    	return view('admin.form.editform')->with('all_donvi', $all_donvi)->with('all_edit_form', $all_edit_form);
    }

    public function editform_edit($id_form, Request $request) {
    	$data = $request->all();
        $formul = formUL::find($id_form);
        $formul->ten_form = $data['name_form'];
        $formul->don_vi = $data['donvi_form'];
        $formul->loai = $data['loai_form'];
        $formul->mo_ta = $data['mota_form'];

        $get_fileform = $request->file('file_form');

        if($get_fileform) {
        	$get_name_form = $get_fileform->getClientOriginalName();
	        $name_form = current(explode('.', $get_name_form)); //current(explode('.', $get_name_image)); chia chuỗi ra để cắt đuôi từ dấu chấm
	        $new_custom_name_form = $name_form.'('.rand(0,99).')'.'.'.$get_fileform->getClientOriginalExtension(); 
	            //getClientOriginalExtention():lấy đuôi mở rộng
	        $get_fileform->move('./public/download', $new_custom_name_form);

	        $formul->duong_dan = $new_custom_name_form;
        }
     
        $formul->save();
		return redirect::to('admin');

    }

    public function deleteform($id_form) {
    	$all_delete_form = formUL::find($id_form);
    	$all_delete_form->delete();
    	return redirect::to('admin');
    }


}
