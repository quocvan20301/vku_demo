<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 
Route::get('/', 'home@index');

Route::get('/carousel', function() {
	return view('pages.carousel');
});

Route::get('/resapi', function() {
	$connect = mysqli_connect("localhost","root","", "demo_resapi_kotlin");
    $sql=mysqli_query($connect, "select * from cau_thu");
    if($sql === FALSE) {
        die(mysql_error()); // TODO: better error handling
    }
    while($row=mysqli_fetch_assoc($sql))
        $output[]=$row;
    print(json_encode($output));
});

Route::get('/theme-2', 'home@index_theme_2')->name('them-2');
Route::get('/theme-2/getdataallaj', 'getAjax@getdataallaj');

Route::get('/theme-3', 'home@index_theme_3')->name('them-3');;

Route::get('/gioi-thieu-khoa', 'home@gioithieu');

Route::get('/the-manh', 'home@themanh');

Route::get('/thong-tin-lien-he', 'home@thongtinlienhe');

Route::get('/bieu-mau', 'home@bieumau');

Route::get('/tags/{name_tag}', 'home@hashtags');

Route::get('/chi-tiet-bieu-mau/{id_form}', 'home@chitietbieumau');

Route::get('/thong-tin-chi-tiet/{titlecms}', 'home@thongtinchitiet');

Route::get('/thong-tin-thong-bao', 'home@thongtinthongbao');

Route::get('/hoat-dong-ngoai-khoa', 'home@hoatdongngoaikhoa');

Route::get('/tin-tuc-nganh', 'home@tintucnganh');

Route::get('/nghien-cuu-khoa-hoc', 'home@nghiencuukhoahoc');

Route::get('/goc-ky-nang', 'home@gockynang');

Route::get('/tuyen-sinh', 'home@tuyensinh');

Route::get('/thong-tin-thong-bao/getdataajax', 'getAjax@getDataCms');


// dowload-bieumau 

Route::get('/download/{file}/{id_form}', 'bieuMau@download');

// admin

Route::get('/login', 'adminController@login');
Route::post('/login', 'adminController@login');

Route::get('/admin', 'adminController@indexadmin');

Route::post('/insertdata', 'adminController@insertsvdata')->name('dropzone.fetch');
Route::get('/start', 'adminController@start');

Route::post('/upload-ckeditor', 'adminController@ckeditor_image');
Route::get('/file-browser', 'adminController@file_browser');

Route::get('/insert-post', 'adminController@layout_insert');

Route::get('/all-post/{khtpost}/{pageshow}', 'adminController@layout_all_post');

//post khoa
Route::get('/insert-post-khoa', 'adminController@layout_insert_khoa');
Route::post('/insertdata-khoa', 'adminController@insertsvdata_khoa');

Route::get('/all-post-khoa/{pageshow}', 'adminController@layout_all_post_khoa');

Route::get('/edit-post/{id_post}', 'adminController@layout_edit_post');
Route::post('/editdata/{id_post}', 'adminController@editdata');

Route::get('/delete-post/{id_post}', 'adminController@delete_post');

Route::get('/eyepost-show/{id_post}', 'adminController@eyepost_show');
Route::get('/eyepost-hide/{id_post}', 'adminController@eyepost_hide');
Route::get('/preview-post/{id_post}', 'adminController@preview_post');


Route::get('/upload-form', 'bieuMau@uploadform');
Route::post('/upload-form', 'bieuMau@uploadform_insert');
Route::get('/all-form', 'bieuMau@allform');

Route::get('/edit-form/{id_form}', 'bieuMau@editform');
Route::post('/edit-form/{id_form}', 'bieuMau@editform_edit');
Route::get('/delete-form/{id_form}', 'bieuMau@deleteform');

//menu

Route::get('/edit-menu', 'adminController@edit_menu');

Route::get('admin/edit-parent', 'getAjax@edit_parent');
Route::get('admin/insert-parent', 'getAjax@insert_parent');
Route::get('admin/delete-parent', 'getAjax@delete_parent');

Route::get('admin/insert-child', 'getAjax@insert_child');
Route::get('admin/delete-child', 'getAjax@delete_child');

//footer

Route::get('/edit-footer', 'adminController@edit_footer');


//de cuong

Route::get('/them-de-cuong', 'DeCuongChiTietController@themdecuong');
Route::get('/danh-sach-de-cuong', 'DeCuongChiTietController@danhsachdecuong');

Route::get('de-cuong/dc-ten-hoc-phan', 'getAjax@ajtenhocphan');
Route::get('de-cuong/dc-giang-vien-phu-trach', 'getAjax@ajgiangvienphutrach');
Route::get('de-cuong/dc-giang-vien-day-cung', 'getAjax@ajgiangviendaycung');
Route::get('de-cuong/select-nganh-aj', 'getAjax@ajselectnganh');

Route::get('edit-de-cuong/{id_decuong}', 'DeCuongChiTietController@editdecuong');
Route::post('sua-de-cuong/{id_decuong}', 'DeCuongChiTietController@sua_decuong');

Route::get('delete-de-cuong/{id_decuong}', 'DeCuongChiTietController@xoa_decuong');

Route::post('/them-moi-de-cuong', 'DeCuongChiTietController@tao_decuong');

Route::get('xem-de-cuong/{id_decuong}', 'DeCuongChiTietController@xem_de_cuong');

Route::get('cau-truc-chuong-trinh-dao-tao', 'DeCuongChiTietController@cau_truc_ct_dt');

Route::get('danh-gia-hoc-phan/{id_decuong}', 'DeCuongChiTietController@danh_gia_hoc_phan');
Route::post('danh-gia-hoc-phan/{id_decuong}', 'DeCuongChiTietController@insert_danh_gia_hoc_phan');
Route::get('edit-danh-gia-hoc-phan/{id_decuong}', 'DeCuongChiTietController@edit_danh_gia_hoc_phan');
Route::post('edit-danh-gia-hoc-phan/{id_decuong}', 'DeCuongChiTietController@insert_edit_danh_gia_hoc_phan');

Route::get('ke-hoach-giang-day/{id_decuong}', 'DeCuongChiTietController@ke_hoach_giang_day');
Route::post('ke-hoach-giang-day/{id_decuong}', 'DeCuongChiTietController@insert_ke_hoach_giang_day');
Route::get('edit-ke-hoach-giang-day/{id_decuong}', 'DeCuongChiTietController@edit_ke_hoach_giang_day');
Route::post('edit-ke-hoach-giang-day/{id_decuong}', 'DeCuongChiTietController@insert_edit_ke_hoach_giang_day');

//chuan dau ra
Route::get('/ma-tran-chuan-dau-ra', 'DeCuongChiTietController@matran_chuandaura');

Route::get('thong-bao', 'home@thong_bao');


// Multiple language

Route::get('language/{language}', 'LanguageController@index');









