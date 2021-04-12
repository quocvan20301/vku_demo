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
            $name_image = current(explode('.', $get_name_image)); //current(explode('.', $get_name_image)); chia chuỗi ra để cắt đuôi từ dấu chấm
            $new_custom_name_image = $name_image.'('.rand(0,99).')'.'.'.$get_avatar->getClientOriginalExtension(); 
            //getClientOriginalExtention():lấy đuôi mở rộng
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
            $name_image = current(explode('.', $get_name_image)); //current(explode('.', $get_name_image)); chia chuỗi ra để cắt đuôi từ dấu chấm
            $new_custom_name_image = $name_image.'('.rand(0,99).')'.'.'.$get_avatar->getClientOriginalExtension(); 
            //getClientOriginalExtention():lấy đuôi mở rộng
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
            $name_image = current(explode('.', $get_name_image)); //current(explode('.', $get_name_image)); chia chuỗi ra để cắt đuôi từ dấu chấm
            $new_custom_name_image = $name_image.'('.rand(0,99).')'.'.'.$get_avatar->getClientOriginalExtension(); 
            //getClientOriginalExtention():lấy đuôi mở rộng
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
            '&amp;' => 'and',   '@' => 'at',    '©' => 'c', '®' => 'r', 'À' => 'a',
            'Á' => 'a', 'Â' => 'a', 'Ä' => 'a', 'Å' => 'a', 'Æ' => 'ae','Ç' => 'c',
            'È' => 'e', 'É' => 'e', 'Ë' => 'e', 'Ì' => 'i', 'Í' => 'i', 'Î' => 'i',
            'Ï' => 'i', 'Ò' => 'o', 'Ó' => 'o', 'Ô' => 'o', 'Õ' => 'o', 'Ö' => 'o',
            'Ø' => 'o', 'Ù' => 'u', 'Ú' => 'u', 'Û' => 'u', 'Ü' => 'u', 'Ý' => 'y',
            'ß' => 'ss','à' => 'a', 'á' => 'a', 'â' => 'a', 'ä' => 'a', 'å' => 'a',
            'æ' => 'ae','ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
            'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ò' => 'o', 'ó' => 'o',
            'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u',
            'û' => 'u', 'ü' => 'u', 'ý' => 'y', 'þ' => 'p', 'ÿ' => 'y', 'Ā' => 'a',
            'ā' => 'a', 'Ă' => 'a', 'ă' => 'a', 'Ą' => 'a', 'ą' => 'a', 'Ć' => 'c',
            'ć' => 'c', 'Ĉ' => 'c', 'ĉ' => 'c', 'Ċ' => 'c', 'ċ' => 'c', 'Č' => 'c',
            'č' => 'c', 'Ď' => 'd', 'ď' => 'd', 'Đ' => 'd', 'đ' => 'd', 'Ē' => 'e',
            'ē' => 'e', 'Ĕ' => 'e', 'ĕ' => 'e', 'Ė' => 'e', 'ė' => 'e', 'Ę' => 'e',
            'ę' => 'e', 'Ě' => 'e', 'ě' => 'e', 'Ĝ' => 'g', 'ĝ' => 'g', 'Ğ' => 'g',
            'ğ' => 'g', 'Ġ' => 'g', 'ġ' => 'g', 'Ģ' => 'g', 'ģ' => 'g', 'Ĥ' => 'h',
            'ĥ' => 'h', 'Ħ' => 'h', 'ħ' => 'h', 'Ĩ' => 'i', 'ĩ' => 'i', 'Ī' => 'i',
            'ī' => 'i', 'Ĭ' => 'i', 'ĭ' => 'i', 'Į' => 'i', 'į' => 'i', 'İ' => 'i',
            'ı' => 'i', 'Ĳ' => 'ij','ĳ' => 'ij','Ĵ' => 'j', 'ĵ' => 'j', 'Ķ' => 'k',
            'ķ' => 'k', 'ĸ' => 'k', 'Ĺ' => 'l', 'ĺ' => 'l', 'Ļ' => 'l', 'ļ' => 'l',
            'Ľ' => 'l', 'ľ' => 'l', 'Ŀ' => 'l', 'ŀ' => 'l', 'Ł' => 'l', 'ł' => 'l',
            'Ń' => 'n', 'ń' => 'n', 'Ņ' => 'n', 'ņ' => 'n', 'Ň' => 'n', 'ň' => 'n',
            'ŉ' => 'n', 'Ŋ' => 'n', 'ŋ' => 'n', 'Ō' => 'o', 'ō' => 'o', 'Ŏ' => 'o',
            'ŏ' => 'o', 'Ő' => 'o', 'ő' => 'o', 'Œ' => 'oe','œ' => 'oe','Ŕ' => 'r',
            'ŕ' => 'r', 'Ŗ' => 'r', 'ŗ' => 'r', 'Ř' => 'r', 'ř' => 'r', 'Ś' => 's',
            'ś' => 's', 'Ŝ' => 's', 'ŝ' => 's', 'Ş' => 's', 'ş' => 's', 'Š' => 's',
            'š' => 's', 'Ţ' => 't', 'ţ' => 't', 'Ť' => 't', 'ť' => 't', 'Ŧ' => 't',
            'ŧ' => 't', 'Ũ' => 'u', 'ũ' => 'u', 'Ū' => 'u', 'ū' => 'u', 'Ŭ' => 'u',
            'ŭ' => 'u', 'Ů' => 'u', 'ů' => 'u', 'Ű' => 'u', 'ű' => 'u', 'Ų' => 'u',
            'ų' => 'u', 'Ŵ' => 'w', 'ŵ' => 'w', 'Ŷ' => 'y', 'ŷ' => 'y', 'Ÿ' => 'y',
            'Ź' => 'z', 'ź' => 'z', 'Ż' => 'z', 'ż' => 'z', 'Ž' => 'z', 'ž' => 'z',
            'ſ' => 'z', 'Ə' => 'e', 'ƒ' => 'f', 'Ơ' => 'o', 'ơ' => 'o', 'Ư' => 'u',
            'ư' => 'u', 'Ǎ' => 'a', 'ǎ' => 'a', 'Ǐ' => 'i', 'ǐ' => 'i', 'Ǒ' => 'o',
            'ǒ' => 'o', 'Ǔ' => 'u', 'ǔ' => 'u', 'Ǖ' => 'u', 'ǖ' => 'u', 'Ǘ' => 'u',
            'ǘ' => 'u', 'Ǚ' => 'u', 'ǚ' => 'u', 'Ǜ' => 'u', 'ǜ' => 'u', 'Ǻ' => 'a',
            'ǻ' => 'a', 'Ǽ' => 'ae','ǽ' => 'ae','Ǿ' => 'o', 'ǿ' => 'o', 'ə' => 'e',
            'Ё' => 'jo','Є' => 'e', 'І' => 'i', 'Ї' => 'i', 'А' => 'a', 'Б' => 'b',
            'В' => 'v', 'Г' => 'g', 'Д' => 'd', 'Е' => 'e', 'Ж' => 'zh','З' => 'z',
            'И' => 'i', 'Й' => 'j', 'К' => 'k', 'Л' => 'l', 'М' => 'm', 'Н' => 'n',
            'О' => 'o', 'П' => 'p', 'Р' => 'r', 'С' => 's', 'Т' => 't', 'У' => 'u',
            'Ф' => 'f', 'Х' => 'h', 'Ц' => 'c', 'Ч' => 'ch','Ш' => 'sh','Щ' => 'sch',
            'Ъ' => '-', 'Ы' => 'y', 'Ь' => '-', 'Э' => 'je','Ю' => 'ju','Я' => 'ja',
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ж' => 'zh','з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l',
            'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's',
            'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
            'ш' => 'sh','щ' => 'sch','ъ' => '-','ы' => 'y', 'ь' => '-', 'э' => 'je',
            'ю' => 'ju','я' => 'ja','ё' => 'jo','є' => 'e', 'і' => 'i', 'ї' => 'i',
            'Ґ' => 'g', 'ґ' => 'g', 'א' => 'a', 'ב' => 'b', 'ג' => 'g', 'ד' => 'd',
            'ה' => 'h', 'ו' => 'v', 'ז' => 'z', 'ח' => 'h', 'ט' => 't', 'י' => 'i',
            'ך' => 'k', 'כ' => 'k', 'ל' => 'l', 'ם' => 'm', 'מ' => 'm', 'ן' => 'n',
            'נ' => 'n', 'ס' => 's', 'ע' => 'e', 'ף' => 'p', 'פ' => 'p', 'ץ' => 'C',
            'צ' => 'c', 'ק' => 'q', 'ר' => 'r', 'ש' => 'w', 'ת' => 't', '™' => 'tm',
            'Ṭ' => 't', 'ṭ' => 't', ':' => ' ', '\'' => ' ', '"' => ' ', '-' => ' ',
        );

        $str = strtr(trim($string), $_convertTable);

        $xstring = $this->stripVN(trim($str));

        $newstring = preg_replace('([\s]+)', ' ', $xstring);

        $output = str_replace(' ', '-', $newstring);  

        $outputString = strtolower($output);

        return $outputString;
    }

    function stripVN($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);

        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
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
            $msg = 'Tải ảnh thành công';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url','$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;

        }
    }
}
