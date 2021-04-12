<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\formUL;
session_start();
use Session;

class home extends Controller
{
    public function index() {

        session_unset();
        $_SESSION['theme'] = 'Theme-1';

        $_SESSION['id_khoa'] = 'khmt';
        //$_SESSION['id_khoa'] = "ktsvtmdt";
        //$_SESSION['id_khoa'] = "dtn";

    	//$_SESSION['id_khoa'] = "ktmtvdt";

        if (!Session::has('language')) {
            Session::put('language', "vi");
        }

        
        $all_top_news = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms.Event', '1')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->limit(6)->get();

        $all_hdnk = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Hoạt động ngoại khoá')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->limit(3)->get();

        $all_tintucnganh_hot = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Tin tức ngành')->where('cms.Event', '1')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->first();

        $all_tintucnganh = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Tin tức ngành')->where('cms.Status', '1')->where('cms.CmsID', '!=', $all_tintucnganh_hot->CmsID)->orderBy('cms.CmsID', 'DESC')->limit(3)->get();

        $all_gockynang_hot = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Góc kỹ năng')->where('cms.Event', '1')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->first();


        $all_gockynang = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Góc kỹ năng')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->where('cms.CmsID', '!=', $all_gockynang_hot->CmsID)->limit(3)->get();

        $all_nghiencuukhoahoc_hot = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Nghiên cứu khoa học')->where('cms.Event', '1')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->first();

        $all_nghiencuukhoahoc = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Nghiên cứu khoa học')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->where('cms.CmsID', '!=', $all_nghiencuukhoahoc_hot->CmsID)->limit(3)->get();   

        $all_menu = DB::table('cms_categories')->select('CategoryID', 'ParentID', 'Name_l0', 'Index')->where('Khoa', 'khmt')->get();

        $data_menu = $this->data_tree($all_menu, 0);

        // echo "<pre>";
        // print_r($all_menu);
        // die();

    	return view('pages.home')->with('id_khoa', $_SESSION['id_khoa'])->with('all_top_news', $all_top_news)->with('all_hdnk', $all_hdnk)->with('all_tintucnganh_hot', $all_tintucnganh_hot)->with('all_tintucnganh', $all_tintucnganh)->with('all_gockynang_hot', $all_gockynang_hot)->with('all_gockynang', $all_gockynang)->with('all_nghiencuukhoahoc_hot', $all_nghiencuukhoahoc_hot)->with('all_nghiencuukhoahoc', $all_nghiencuukhoahoc)->with('data_menu', $data_menu)->with('all_menu', $all_menu);
    }

    public function data_tree($data, $parent_id = 0, $level = 0, $hasChild = 0) {
        $result = [];
        foreach ($data as $value) {
            if($value->ParentID == $parent_id) {
                $value->level = $level;
                $value->hasChild = 0;
                $result[] = $value;
                $child = $this->data_tree($data, $value->CategoryID, $level + 1);
                if($child) {
                    $value->hasChild = 1;
                    //$result = array_merge($result, $child);
                }
                
            }     
        }
        return $result;
    }

    public function index_theme_2() {

        session_unset();
        $_SESSION['theme'] = 'Theme-2';
        $_SESSION['id_khoa'] = 'khmt';
        //$_SESSION['id_khoa'] = "ktsvtmdt";
        //$_SESSION['id_khoa'] = "dtn";

        //$_SESSION['id_khoa'] = "ktmtvdt"; 

        $all_menu = DB::table('cms_categories')->select('CategoryID', 'ParentID', 'Name_l0', 'Index')->where('Khoa', 'khmt')->get();

        $data_menu = $this->data_tree($all_menu, 0);

        return view('pages.home_theme_2')->with('id_khoa', $_SESSION['id_khoa'])->with('data_menu', $data_menu)->with('all_menu', $all_menu);
    }

    public function index_theme_3() {

        session_unset();
        $_SESSION['theme'] = 'Theme-3';
        $_SESSION['id_khoa'] = 'khmt';
        //$_SESSION['id_khoa'] = "ktsvtmdt";
        //$_SESSION['id_khoa'] = "dtn";

        //$_SESSION['id_khoa'] = "ktmtvdt";   

        $all_menu = DB::table('cms_categories')->select('CategoryID', 'ParentID', 'Name_l0', 'Index')->where('Khoa', 'khmt')->get();

        $data_menu = $this->data_tree($all_menu, 0);

        $all_top_news = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms.Event', '1')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->limit(7)->get();

        $all_tttbao_hot = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Thông tin - thông báo')->where('cms.Event', '1')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->first();

        $all_tttbao = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Thông tin - thông báo')->where('cms.Status', '1')->where('cms.CmsID', '!=', $all_tttbao_hot->CmsID)->orderBy('cms.CmsID', 'DESC')->limit(3)->get(); 

        $all_ttnganh_hot = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Tin tức ngành')->where('cms.Event', '1')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->first();


        $all_ttnganh = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Tin tức ngành')->where('cms.Status', '1')->where('cms.CmsID', '!=', $all_ttnganh_hot->CmsID)->orderBy('cms.CmsID', 'DESC')->limit(7)->get();

        $all_nckhoc_hot = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Nghiên cứu khoa học')->where('cms.Event', '1')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->first();


        $all_nckhoc = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Nghiên cứu khoa học')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->where('cms.CmsID', '!=', $all_nckhoc_hot->CmsID)->limit(7)->get();

        return view('pages.home_theme_3')->with('id_khoa', $_SESSION['id_khoa'])->with('all_tttbao_hot', $all_tttbao_hot)->with('all_tttbao', $all_tttbao)->with('all_ttnganh_hot', $all_ttnganh_hot)->with('all_ttnganh', $all_ttnganh)->with('all_nckhoc_hot', $all_nckhoc_hot)->with('all_nckhoc', $all_nckhoc)->with('all_top_news', $all_top_news)->with('data_menu', $data_menu)->with('all_menu', $all_menu);
    }

    public function gioithieu() {

        $all_thongtinthongbao = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Thông tin - thông báo')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->limit(9)->get();

    	return view('pages.gioithieu')->with('id_khoa', $_SESSION['id_khoa'])->with('all_thongtinthongbao', $all_thongtinthongbao);
    }

    public function themanh() {

        $all_thongtinthongbao = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Thông tin - thông báo')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->limit(9)->get();

        $all_themanhcuakhoa = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Thế mạnh của khoa')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->get();
    	
    	return view('pages.themanh')->with('id_khoa', $_SESSION['id_khoa'])->with('all_themanhcuakhoa', $all_themanhcuakhoa)->with('all_thongtinthongbao', $all_thongtinthongbao);
    }

    public function thongtinlienhe() {
        
        return view('pages.thongtinlienhe')->with('id_khoa', $_SESSION['id_khoa']);
    }
    
    public function bieumau() {

        $all_thongtinthongbao = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Thông tin - thông báo')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->limit(9)->get();

        $all_form = DB::table('form')->join('donvi_form', 'form.don_vi', 'donvi_form.id_dvf')->get();
    	
    	return view('pages.bieumau')->with('id_khoa', $_SESSION['id_khoa'])->with('all_form', $all_form)->with('all_thongtinthongbao', $all_thongtinthongbao);
    }

    public function chitietbieumau($id_form) {

        $all_form = DB::table('form')->join('donvi_form', 'form.don_vi', 'donvi_form.id_dvf')->where('form.id_form', $id_form)->first();
    	
    	return view('pages.chitietbieumau')->with('id_khoa', $_SESSION['id_khoa'])->with('all_form', $all_form);
    }

    public function hashtags($name_tag) {

        $all_thongtinthongbao = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Thông tin - thông báo')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->limit(9)->get();

        $list_name_tags = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->join('hash_tags', 'cms.CmsID', 'hash_tags.CmsID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms.Status', '1')->where('hash_tags.Slug_tags', $name_tag)->orderBy('cms.CmsID', 'DESC')->limit(9)->get();

        foreach ($list_name_tags as $key => $value) {
            $name_hashtagsl = $value->name_tags;
        }
        
        return view('pages.hashtags')->with('id_khoa', $_SESSION['id_khoa'])->with('list_name_tags', $list_name_tags)->with('name_hashtagsl', $name_hashtagsl)->with('all_thongtinthongbao', $all_thongtinthongbao);
    }

    public function thongtinchitiet($titlecms) {

        $all_thongtinthongbao = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Thông tin - thông báo')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->limit(9)->get();

        $contentdetail = DB::table('cms')->where('Slug', $titlecms)->where('cms.Status', '1')->first();

        $list_hash_tags = DB::table('hash_tags')->where('CmsID', $contentdetail->CmsID)->get();

        $data = array();
        $data['ViewedCount'] = $contentdetail->ViewedCount + 1;

        DB::table('cms')->where('Slug', $titlecms)->update($data);

        return view('pages.thongtinchitiet')->with('id_khoa', $_SESSION['id_khoa'])->with('contentdetail', $contentdetail)->with('list_hash_tags', $list_hash_tags)->with('all_thongtinthongbao', $all_thongtinthongbao);
    }

    public function thongtinthongbao() {

        $all_hoatdongngoaikhoa = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Hoạt động ngoại khoá')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->limit(9)->get();
        
        return view('pages.thongtinthongbao')->with('id_khoa', $_SESSION['id_khoa'])->with('all_hoatdongngoaikhoa', $all_hoatdongngoaikhoa);
    }

    public function hoatdongngoaikhoa() {

        $all_thongtinthongbao = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Thông tin - thông báo')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->limit(9)->get();

        $all_hoatdongngoaikhoa = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Hoạt động ngoại khoá')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->get();

        return view('pages.hoatdongngoaikhoa')->with('id_khoa', $_SESSION['id_khoa'])->with('all_hoatdongngoaikhoa', $all_hoatdongngoaikhoa)->with('all_thongtinthongbao', $all_thongtinthongbao);
    }

    public function tintucnganh() {

        $all_thongtinthongbao = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Thông tin - thông báo')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->limit(9)->get();

        $all_tintucnganh = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Tin tức ngành')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->get();

        return view('pages.tintucnganh')->with('id_khoa', $_SESSION['id_khoa'])->with('all_tintucnganh', $all_tintucnganh)->with('all_thongtinthongbao', $all_thongtinthongbao);
    }

    public function nghiencuukhoahoc() {

        $all_thongtinthongbao = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Thông tin - thông báo')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->limit(9)->get();

        $all_nghiencuukhoahoc = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Nghiên cứu khoa học')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->get();

        return view('pages.nghiencuukhoahoc')->with('id_khoa', $_SESSION['id_khoa'])->with('all_nghiencuukhoahoc', $all_nghiencuukhoahoc)->with('all_thongtinthongbao', $all_thongtinthongbao);
    }

    public function gockynang() {

        $all_thongtinthongbao = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Thông tin - thông báo')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->limit(9)->get();

        $all_gockynang = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Góc kỹ năng')->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->get();

        return view('pages.gockynang')->with('id_khoa', $_SESSION['id_khoa'])->with('all_gockynang', $all_gockynang)->with('all_thongtinthongbao', $all_thongtinthongbao);
    }

    public function tuyensinh() {
        return view('pages.tuyensinh')->with('id_khoa', $_SESSION['id_khoa']);
    }

    public function thong_bao() {
        return view('pages_2.ttct_thongbao')->with('id_khoa', $_SESSION['id_khoa']);
    }

    
}
