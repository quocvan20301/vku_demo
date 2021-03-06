<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Admin;
use App\Models\cmsModels;
use App\Models\hashtagModels;
use App\Models\showcategoryModels;
use Session;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use App\User;


class adminController extends Controller
{
    public function indexadmin() {
    	return view('admin.dashboard');
    }

    public function login(Request $request) {
        if ($request->isMethod('post')) {

            $email = $request->email;
            $password = $request->password;

            $getLogin = DB::table('admins')->where('email', $email)->where('password', $password)->first();

            if($getLogin) {
                return Redirect::to('/admin');
            } else {
                return Redirect::to('/login');
            }

        }
        return view('login');
    }


    public function layout_insert() {
        $all_khoa = DB::table('list_khoa')->get();
        return view('admin.insert_post')->with('all_khoa', $all_khoa);
    }

    public function layout_all_post($khtpost, $pageshow) {

        if ($khtpost == "all") {

            $num_start = $pageshow;

            $countrow = DB::table('cms')->count();

            $currentPage = $num_start ? $num_start : 1;

            $pageShow = 11;

            $countPage = ceil($countrow / $pageShow);

            if ($currentPage > $countPage) {
                $currentPage = $countPage;
            }
            if ($currentPage < 1) {
                $currentPage = 1;
            }

            $pageStart = ($currentPage - 1) * $pageShow;


            $all_post_khoa = DB::table('cms')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->orderBy('cms.CmsID', 'DESC')->offset($pageStart)->limit($pageShow)->get();
            
        } else {


            $num_start = $pageshow;

            $countrow = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->where('show_category.id_khoa', $khtpost)->count();

            $currentPage = $num_start ? $num_start : 1;

            $pageShow = 11;

            $countPage = ceil($countrow / $pageShow);

            if ($currentPage > $countPage) {
                $currentPage = $countPage;
            }
            if ($currentPage < 1) {
                $currentPage = 1;
            }

            $pageStart = ($currentPage - 1) * $pageShow;

            $all_post_khoa = DB::table('cms')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->where('show_category.id_khoa', $khtpost)->orderBy('show_category.CmsID', 'DESC')->offset($pageStart)->limit($pageShow)->get();
        }

       $list_show_khoa = DB::table('show_category')->get();

        $list_khoa = DB::table('list_khoa')->get();
        return view('admin.all_post')->with('list_khoa', $list_khoa)->with('khtpost', $khtpost)->with('all_post_khoa', $all_post_khoa)->with('list_show_khoa', $list_show_khoa)->with('currentPage', $currentPage)->with('countPage', $countPage)->with('khtpost', $khtpost);

    }

    public function layout_edit_post($id_post) {
        $post_edit = DB::table('cms')->where('CmsID', $id_post)->first();
        $post_cate = DB::table('cms')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('CmsID', $id_post)->first();
        $post_hastag = DB::table('hash_tags')->where('CmsID', $id_post)->get();
        $post_showcare = DB::table('show_category')->where('CmsID', $id_post)->get();

        $all_khoa = DB::table('list_khoa')->get();

        return view('admin.edit_post')->with('post_edit', $post_edit)->with('post_cate', $post_cate)->with('post_showcare', $post_showcare)->with('all_khoa', $all_khoa)->with('post_hastag', $post_hastag);
    }

    public function editdata($id_post, Request $request) {
        $data = $request->all();
        $post_cms = cmsModels::find($id_post);
        $post_cms->CategoryID = $request->category_post;
        $post_cms->Slug = $data['slug_post'];
        $post_cms->Title_l0 = $data['title_post'];
        $post_cms->Content_l0 = $data['content_vn_post'];
        $post_cms->SimpleContent_l0 = $data['simple_content_post'];
        $post_cms->Status = $data['status_post'];
        $post_cms->Event = $data['quantrong_post'];

        $chonkhoaadmin = ""; 
        foreach ($request->all_khoa as $value_ak) {
            $chonkhoaadmin .= $value_ak.", ";
        }
        $chonkhoaadmin2 = rtrim($chonkhoaadmin, ", ");

        $post_cms->List_show_khoa = $chonkhoaadmin2;

        $get_avatar = $request->file('anhdaidienimg');

        if ($get_avatar) {
            $get_name_image = $get_avatar->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image)); //current(explode('.', $get_name_image)); chia chu???i ra ????? c???t ??u??i t??? d???u ch???m
            $new_custom_name_image = $name_image.'('.rand(0,99).')'.'.'.$get_avatar->getClientOriginalExtension(); 
            //getClientOriginalExtention():l???y ??u??i m??? r???ng
            $get_avatar->move('./public/uploads/Cms_img', $new_custom_name_image);
            $post_cms->Avatar = $new_custom_name_image;

        } else {
            //$post_cms->Avatar = "logofooter.png";
            echo "kh co avartat";
        }
        
        $post_cms->save();

        $getcmsid = cmsModels::select('CmsID')->where('Slug', '=', $data['slug_post'])->first();

        $cmIDgett = $getcmsid->CmsID;

        $categoryID = $request->category_post;

        $deletepcmscate = showcategoryModels::find($id_post);
        $deletepcmscate->delete();

        foreach ($request->all_khoa as $value) {
            $post_cmsCategory = new showcategoryModels;
            $post_cmsCategory->CmsID = $cmIDgett;
            $post_cmsCategory->id_khoa = $value;
            $post_cmsCategory->save();
        }

        $listhashtag = $request->hashtag;

        $listhashtag2 = rtrim($listhashtag, ",");

        $crhashtag = explode(',', $listhashtag2);

        $trimhashtag = array();

        foreach ($crhashtag as $value) {
            array_push($trimhashtag, trim($value));
        }

        $deletepostht = hashtagModels::find($id_post);
        $deletepostht->delete();

        foreach ($trimhashtag as $value_hashtag) {
            $post_hashtags = new hashtagModels;
            $post_hashtags->name_tags = $value_hashtag;
            $post_hashtags->CmsID = $cmIDgett;
            $post_hashtags->Slug_tags = $this->converto($value_hashtag);
            $post_hashtags->save();
        }

    return Redirect::to('/admin');
    }

    public function insertsvdata(Request $request) {

        $data = $request->all(); 
        $post_cms = new cmsModels;
        $post_cms->CategoryID = $request->category_post;
        $post_cms->Slug = $data['slug_post'];
        $post_cms->Title_l0 = $data['title_post'];
        $post_cms->Content_l0 = $data['content_vn_post'];
        $post_cms->SimpleContent_l0 = $data['simple_content_post'];  
        $post_cms->Status = $data['status_post'];
        $post_cms->Event = $data['quantrong_post'];
        $post_cms->ViewedCount = '0';

        $date_post = date('Y/m/d', time());
        $post_cms->Date = $date_post;

        $chonkhoaadmin = "";
        foreach ($request->all_khoa as $value_ak) {
            $chonkhoaadmin .= $value_ak.", ";
        }

        $chonkhoaadmin2 = rtrim($chonkhoaadmin, ", ");

        $post_cms->List_show_khoa = $chonkhoaadmin2;

        $get_avatar = $request->file('anhdaidienimg');

        if ($get_avatar) {
            $get_name_image = $get_avatar->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image)); //current(explode('.', $get_name_image)); chia chu???i ra ????? c???t ??u??i t??? d???u ch???m
            $new_custom_name_image = $name_image.'('.rand(0,99).')'.'.'.$get_avatar->getClientOriginalExtension(); 
            //getClientOriginalExtention():l???y ??u??i m??? r???ng
            $get_avatar->move('./public/uploads/Cms_img', $new_custom_name_image);
            $post_cms->Avatar = $new_custom_name_image;

        } else {
            $post_cms->Avatar = "logofooter.png";
            echo "kh co avartat";
        }
        
        $post_cms->save();

        $getcmsid = cmsModels::select('CmsID')->where('Slug', '=', $data['slug_post'])->first();

        $cmIDgett = $getcmsid->CmsID;

        $categoryID = $request->category_post;

        foreach ($request->all_khoa as $value) {
            $post_cmsCategory = new showcategoryModels;
            $post_cmsCategory->CmsID = $cmIDgett;
            $post_cmsCategory->id_khoa = $value;
            $post_cmsCategory->save();
        }

        $listhashtag = $request->hashtag;

        $crhashtag = explode(',', $listhashtag);

        $trimhashtag = array();

        foreach ($crhashtag as $value) {
            array_push($trimhashtag, trim($value));
        }

        foreach ($trimhashtag as $value_hashtag) {
            $post_hashtags = new hashtagModels;
            $post_hashtags->name_tags = $value_hashtag;
            $post_hashtags->CmsID = $cmIDgett;
            $post_hashtags->Slug_tags = $this->converto($value_hashtag);
            $post_hashtags->save();
        }

    	return Redirect::to('/admin');
    }

    public function delete_post($id_post) {
        $delete_cms = cmsModels::find($id_post);
        $delete_cms->delete();
        $delete_sct = showcategoryModels::find($id_post);
        $delete_sct->delete();
        $delete_ht = hashtagModels::find($id_post);
        $delete_ht->delete();
        return Redirect::to('/admin');
    }

    public function eyepost_show($id_post) {
        $eyepost_cms = cmsModels::find($id_post);
        $eyepost_cms->Status = "0";
        $eyepost_cms->save();
        return Redirect::to('/admin');
    }

    public function eyepost_hide($id_post) {
        $eyepost_cms = cmsModels::find($id_post);
        $eyepost_cms->Status = "1";
        $eyepost_cms->save();
        return Redirect::to('/admin');
    }

    public function preview_post($id_post) {
        $contentdetail = DB::table('cms')->where('CmsID', $id_post)->first();

        $list_hash_tags = DB::table('hash_tags')->where('CmsID', $id_post)->get();

        return view('admin.preview_post')->with('contentdetail', $contentdetail)->with('list_hash_tags', $list_hash_tags);
    }


    public function layout_insert_khoa() {

        $all_cate = DB::table('cms_categories')->select('CategoryID', 'ParentID', 'Name_l0', 'Index')->where('Khoa', 'khmt')->get();

        $cateAll = $this->data_tree_khoa($all_cate, 0);

        // echo "<pre>";
        // print_r($cateAll);
        // die();

        return view('admin.insert_post_khoa')->with('cateAll', $cateAll);

    }

    public function insertsvdata_khoa(Request $request) {
        $data = $request->all();
        $post_cms = new cmsModels;
        $post_cms->CategoryID = $request->category_post;
        $post_cms->Slug = $data['slug_post'];
        $post_cms->Title_l0 = $data['title_post'];
        $post_cms->Content_l0 = $data['content_vn_post'];
        $post_cms->SimpleContent_l0 = $data['simple_content_post'];  
        $post_cms->Status = $data['status_post'];
        $post_cms->Event = $data['quantrong_post'];
        $post_cms->ViewedCount = '0';

        $date_post = date('Y/m/d', time());
        $post_cms->Date = $date_post;

        $post_cms->List_show_khoa = "khmt";

        $get_avatar = $request->file('anhdaidienimg');

        if ($get_avatar) {
            $get_name_image = $get_avatar->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image)); //current(explode('.', $get_name_image)); chia chu???i ra ????? c???t ??u??i t??? d???u ch???m
            $new_custom_name_image = $name_image.'('.rand(0,99).')'.'.'.$get_avatar->getClientOriginalExtension(); 
            //getClientOriginalExtention():l???y ??u??i m??? r???ng
            $get_avatar->move('./public/uploads/Cms_img', $new_custom_name_image);
            $post_cms->Avatar = $new_custom_name_image;

        } else {
            $post_cms->Avatar = "logofooter.png";
            echo "kh co avartat";
        }
        
        $post_cms->save();

        $getcmsid = cmsModels::select('CmsID')->where('Slug', '=', $data['slug_post'])->first();

        $cmIDgett = $getcmsid->CmsID;

        $categoryID = $request->category_post;

        $post_cmsCategory = new showcategoryModels;
        $post_cmsCategory->CmsID = $cmIDgett;
        $post_cmsCategory->id_khoa = 'khmt';
        $post_cmsCategory->save();

        $listhashtag = $request->hashtag;

        $crhashtag = explode(',', $listhashtag);

        $trimhashtag = array();

        foreach ($crhashtag as $value) {
            array_push($trimhashtag, trim($value));
        }

        foreach ($trimhashtag as $value_hashtag) {
            $post_hashtags = new hashtagModels;
            $post_hashtags->name_tags = $value_hashtag;
            $post_hashtags->CmsID = $cmIDgett;
            $post_hashtags->Slug_tags = $this->converto($value_hashtag);
            $post_hashtags->save();
        }

        return Redirect::to('/admin');
    }

    public function layout_all_post_khoa($pageshow) {

        $num_start = $pageshow;

        $countrow = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->where('show_category.id_khoa', 'khmt')->count();

        $currentPage = $num_start ? $num_start : 1;

        $pageShow = 11;

        $countPage = ceil($countrow / $pageShow);

        if ($currentPage > $countPage) {
            $currentPage = $countPage;
        }
        if ($currentPage < 1) {
            $currentPage = 1;
        }

        $pageStart = ($currentPage - 1) * $pageShow;

        $all_post_khoa = DB::table('cms')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->where('show_category.id_khoa', 'khmt')->orderBy('show_category.CmsID', 'DESC')->offset($pageStart)->limit($pageShow)->get();


        $list_show_khoa = DB::table('show_category')->get();

        $list_khoa = DB::table('list_khoa')->get();
        return view('admin.all_post_khoa')->with('list_khoa', $list_khoa)->with('all_post_khoa', $all_post_khoa)->with('list_show_khoa', $list_show_khoa)->with('currentPage', $currentPage)->with('countPage', $countPage);

    }

    public function edit_menu() {

        $all_menu = DB::table('cms_categories')->select('CategoryID', 'ParentID', 'Name_l0', 'Index')->where('Khoa', 'khmt')->get();

        $rs = $this->data_tree($all_menu, 0);

        //echo "<pre>";
        //print_r($rs);

        //die();

        return view('admin.edit_menu')->with('rs', $rs)->with('all_menu', $all_menu);
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


    public function data_tree_khoa($data, $parent_id = 0, $level = 0, $hasChild = 0) {
        $result = [];
        foreach ($data as $value) {
            if($value->ParentID == $parent_id) {
                $value->level = $level;
                $value->hasChild = 0;
                $result[] = $value;
                $child = $this->data_tree($data, $value->CategoryID, $level + 1);
                if($child) {
                    $value->hasChild = 1;
                    $result = array_merge($result, $child);
                }
                
            }     
        }
        return $result;
    }

    public function edit_footer() {
        return view('admin.edit_footer');
    }

    public function converto($string) {
        $_convertTable = array(
            '&amp;' => 'and',   '@' => 'at',    '??' => 'c', '??' => 'r', '??' => 'a',
            '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'ae','??' => 'c',
            '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'i', '??' => 'i', '??' => 'i',
            '??' => 'i', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o',
            '??' => 'o', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'y',
            '??' => 'ss','??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a',
            '??' => 'ae','??' => 'c', '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'e',
            '??' => 'i', '??' => 'i', '??' => 'i', '??' => 'i', '??' => 'o', '??' => 'o',
            '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'u', '??' => 'u',
            '??' => 'u', '??' => 'u', '??' => 'y', '??' => 'p', '??' => 'y', '??' => 'a',
            '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'c',
            '??' => 'c', '??' => 'c', '??' => 'c', '??' => 'c', '??' => 'c', '??' => 'c',
            '??' => 'c', '??' => 'd', '??' => 'd', '??' => 'd', '??' => 'd', '??' => 'e',
            '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'e',
            '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'g', '??' => 'g', '??' => 'g',
            '??' => 'g', '??' => 'g', '??' => 'g', '??' => 'g', '??' => 'g', '??' => 'h',
            '??' => 'h', '??' => 'h', '??' => 'h', '??' => 'i', '??' => 'i', '??' => 'i',
            '??' => 'i', '??' => 'i', '??' => 'i', '??' => 'i', '??' => 'i', '??' => 'i',
            '??' => 'i', '??' => 'ij','??' => 'ij','??' => 'j', '??' => 'j', '??' => 'k',
            '??' => 'k', '??' => 'k', '??' => 'l', '??' => 'l', '??' => 'l', '??' => 'l',
            '??' => 'l', '??' => 'l', '??' => 'l', '??' => 'l', '??' => 'l', '??' => 'l',
            '??' => 'n', '??' => 'n', '??' => 'n', '??' => 'n', '??' => 'n', '??' => 'n',
            '??' => 'n', '??' => 'n', '??' => 'n', '??' => 'o', '??' => 'o', '??' => 'o',
            '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'oe','??' => 'oe','??' => 'r',
            '??' => 'r', '??' => 'r', '??' => 'r', '??' => 'r', '??' => 'r', '??' => 's',
            '??' => 's', '??' => 's', '??' => 's', '??' => 's', '??' => 's', '??' => 's',
            '??' => 's', '??' => 't', '??' => 't', '??' => 't', '??' => 't', '??' => 't',
            '??' => 't', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u',
            '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u',
            '??' => 'u', '??' => 'w', '??' => 'w', '??' => 'y', '??' => 'y', '??' => 'y',
            '??' => 'z', '??' => 'z', '??' => 'z', '??' => 'z', '??' => 'z', '??' => 'z',
            '??' => 'z', '??' => 'e', '??' => 'f', '??' => 'o', '??' => 'o', '??' => 'u',
            '??' => 'u', '??' => 'a', '??' => 'a', '??' => 'i', '??' => 'i', '??' => 'o',
            '??' => 'o', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u',
            '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'a',
            '??' => 'a', '??' => 'ae','??' => 'ae','??' => 'o', '??' => 'o', '??' => 'e',
            '??' => 'jo','??' => 'e', '??' => 'i', '??' => 'i', '??' => 'a', '??' => 'b',
            '??' => 'v', '??' => 'g', '??' => 'd', '??' => 'e', '??' => 'zh','??' => 'z',
            '??' => 'i', '??' => 'j', '??' => 'k', '??' => 'l', '??' => 'm', '??' => 'n',
            '??' => 'o', '??' => 'p', '??' => 'r', '??' => 's', '??' => 't', '??' => 'u',
            '??' => 'f', '??' => 'h', '??' => 'c', '??' => 'ch','??' => 'sh','??' => 'sch',
            '??' => '-', '??' => 'y', '??' => '-', '??' => 'je','??' => 'ju','??' => 'ja',
            '??' => 'a', '??' => 'b', '??' => 'v', '??' => 'g', '??' => 'd', '??' => 'e',
            '??' => 'zh','??' => 'z', '??' => 'i', '??' => 'j', '??' => 'k', '??' => 'l',
            '??' => 'm', '??' => 'n', '??' => 'o', '??' => 'p', '??' => 'r', '??' => 's',
            '??' => 't', '??' => 'u', '??' => 'f', '??' => 'h', '??' => 'c', '??' => 'ch',
            '??' => 'sh','??' => 'sch','??' => '-','??' => 'y', '??' => '-', '??' => 'je',
            '??' => 'ju','??' => 'ja','??' => 'jo','??' => 'e', '??' => 'i', '??' => 'i',
            '??' => 'g', '??' => 'g', '??' => 'a', '??' => 'b', '??' => 'g', '??' => 'd',
            '??' => 'h', '??' => 'v', '??' => 'z', '??' => 'h', '??' => 't', '??' => 'i',
            '??' => 'k', '??' => 'k', '??' => 'l', '??' => 'm', '??' => 'm', '??' => 'n',
            '??' => 'n', '??' => 's', '??' => 'e', '??' => 'p', '??' => 'p', '??' => 'C',
            '??' => 'c', '??' => 'q', '??' => 'r', '??' => 'w', '??' => 't', '???' => 'tm',
            '???' => 't', '???' => 't', ':' => ' ', '\'' => ' ', '"' => ' ', '-' => ' ',
        );

        $str = strtr(trim($string), $_convertTable);

        $xstring = $this->stripVN(trim($str));

        $newstring = preg_replace('([\s]+)', ' ', $xstring);

        $output = str_replace(' ', '-', $newstring);  

        $outputString = strtolower($output);

        return $outputString;
    }

    function stripVN($str) {
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'a', $str);
        $str = preg_replace("/(??|??|???|???|???|??|???|???|???|???|???)/", 'e', $str);
        $str = preg_replace("/(??|??|???|???|??)/", 'i', $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'o', $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???)/", 'u', $str);
        $str = preg_replace("/(???|??|???|???|???)/", 'y', $str);
        $str = preg_replace("/(??)/", 'd', $str);

        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'A', $str);
        $str = preg_replace("/(??|??|???|???|???|??|???|???|???|???|???)/", 'E', $str);
        $str = preg_replace("/(??|??|???|???|??)/", 'I', $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'O', $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???)/", 'U', $str);
        $str = preg_replace("/(???|??|???|???|???)/", 'Y', $str);
        $str = preg_replace("/(??)/", 'D', $str);
        return $str;
    }

    public function file_browser(Request $request){
        
        $paths = glob(public_path('../public/uploads/imgCkeditor/*'));
        $fileNames = array();
        foreach ($paths as $path) {
            array_push($fileNames, basename($path));
        }
        $data = array(
            'fileNames' =>  $fileNames
        );
        return view('showImg.file_browser')->with( $data);
    }

    public function ckeditor_image(Request $request){
        
        if($request->hasFile('upload')){

            $originName = $request->file('upload')->getClientOriginalName();

            $fileName =  pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move('./public/uploads/imgCkeditor', $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');

            $url = asset('./public/uploads/imgCkeditor/'.$fileName);
            $msg = 'T???i ???nh th??nh c??ng';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url','$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;

        }
    }
}
