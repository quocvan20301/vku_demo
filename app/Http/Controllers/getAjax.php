<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\categoryModels;
use Request;
use DB;
session_start();

class getAjax extends Controller
{
    public function getDataCms() {
    	
    	if (Request::ajax()) {

    		$num_start = (String)Request::get('pageCurrent');

    		$countrow = DB::table('show_category')->join('cms', 'show_category.CmsID', 'cms.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Thông tin - thông báo')->count();

    		$currentPage = $num_start ? $num_start : 1;

    		$pageShow = 2;

    		$countPage = ceil($countrow / $pageShow);

    		if ($currentPage > $countPage) {
				$currentPage = $countPage;
			}
			if ($currentPage < 1) {
				$currentPage = 1;
			}

			$pageStart = ($currentPage - 1) * $pageShow;

			$allCms = DB::table('show_category')->join('cms', 'show_category.CmsID', 'cms.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms_categories.Name_l0', 'Thông tin - thông báo')->offset($pageStart)->limit($pageShow)->orderBy('cms.CmsID', 'DESC')->get();


			$loadAvatar = "";

			$contentCms = "";
			$contentCms = '<div class="content-block-1">';
			$contentCms .= "<ul>";

			foreach ($allCms as $key => $value) {

				$contentCms .= "<li>";
				$contentCms .= '<div class="img-ctbl1">';
				$contentCms .= '<a href="thong-tin-chi-tiet/'.$value->Slug.'">';
				$contentCms .= '<img src="./public/uploads/Cms_img/'.$value->Avatar.'">';
				$contentCms .= "</a>";
				$contentCms .= "</div>";
				$contentCms .= '<div class="tt-ctbl1">';
				$contentCms .= '<p class="p-text"><a href="thong-tin-chi-tiet/'.$value->Slug.'">';
				$contentCms .= $value->Title_l0;
				$contentCms .= "</a></p>";
				$contentCms .= '<p class="p-day">';
				$contentCms .= date('d/m/Y', strtotime($value->Date));
				$contentCms .= "</p>";
				$contentCms .=" </div>";
				$contentCms .=" </li>";
			}

			$contentCms .= "</ul>";

			$contentCms .= "</div>";

			$contentCms .= '<div class="pagin-pagea">';
			$contentCms .= '<ul class="qwer1">';


			if ($currentPage > 1 && $countPage > 1) {
				$contentCms .= '<li id="'.($currentPage-1).'"><i class="fas fa-angle-left"></i></li>';
			} else {
				$contentCms .= '<li><i class="fas fa-angle-left"></i></li>';
			}

			if ( $currentPage >= 4 )  {
				$contentCms .= '<li><p>...</p></li>';
			}

			for ($i = $currentPage - 2; $i <= $currentPage + 2;$i ++) {

				if ($i < 1 || $i > $countPage) {

				} else {
					if ($i == $currentPage) {
						$contentCms .= '<li id="'.$i.'" class="activecr"><p>'.$i.'</p></li>';
					} else {
						$contentCms .= '<li id="'.$i.'" ><p>'.$i.'</p></li>';
					}
				}
			}

			if ( $currentPage < $countPage - 2 )  {
				$contentCms .= '<li id="'.$i.'" ><p>...</p></li>';
			}

			if ($currentPage < $countPage && $countPage > 1) {
				$contentCms .= '<li id="'.($currentPage+1).'"><i class="fas fa-angle-right"></i></li>';
			} else {
				$contentCms .= '<li><i class="fas fa-angle-right"></i></li>';
			}

			$contentCms .= "</ul>";

			$contentCms .= "</div>";

    		return $contentCms;

    	}

    }


    public function getdataallaj() {
    	
    	if (Request::ajax()) {

    		$num_start = (String)Request::get('pageCurrent');

    		$countrow = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms.Status', '1')->count();

    		//->where('cms.Event', '1')

    		$currentPage = $num_start ? $num_start : 1;

    		$pageShow = 12;

    		$countPage = ceil($countrow / $pageShow);

    		if ($currentPage > $countPage) {
				$currentPage = $countPage;
			}
			if ($currentPage < 1) {
				$currentPage = 1;
			}

			$pageStart = ($currentPage - 1) * $pageShow;

			$allCms = DB::table('cms')->join('show_category', 'cms.CmsID', 'show_category.CmsID')->join('cms_categories', 'cms.CategoryID', 'cms_categories.ParentID')->where('show_category.id_khoa', $_SESSION['id_khoa'])->where('cms.Status', '1')->orderBy('cms.CmsID', 'DESC')->offset($pageStart)->limit($pageShow)->get();
 
			$contentCms = "";

			foreach ($allCms as $key => $value) {
				$contentCms .= '<div class="block-theme-1-right">';
				$contentCms .= '<div class="img-theme-1-right">';
				$contentCms .= '<a href="thong-tin-chi-tiet/'.$value->Slug.'">';
				$contentCms .= '<img src="./public/uploads/Cms_img/'. $value->Avatar .'">';		
				$contentCms .= "</a>";
				$contentCms .= '<div class="title-img-theme-1-right" style="background: '.$value->Color_bl;
				//.'">';
				$contentCms .= '">';
				$contentCms .= "<p>".$value->Name_l0."</p>";
				$contentCms .= "</div>";
				$contentCms .= "</div>";
				$contentCms .= "<span>THÁNG MƯỜI HAI 4TH, 2020</span>";
				$contentCms .= "<p>";
				$contentCms .= '<a href="thong-tin-chi-tiet/'.$value->Slug.'">';
				$contentCms .= $value->Title_l0;
				$contentCms .= "</a>";
				$contentCms .= "</p>";
				$contentCms .= "</div>";

			}


			$contentCms .= '<div class="post-pagination">';


			if ($currentPage > 1 && $countPage > 1) {

				$contentCms .= '<p id="'.($currentPage-1).'"><i class="fas fa-angle-left"></i></p>';

			} else {
				// $contentCms .= '<p><i class="fas fa-angle-left"></i></p>';
			}

			if ( $currentPage >= 4 )  {
				$contentCms .= '<p>...</i></p>';
			}

			for ($i = $currentPage - 2; $i <= $currentPage + 2;$i ++) {

				if ($i < 1 || $i > $countPage) {

				} else {
					if ($i == $currentPage) {

						$contentCms .= '<p id="'.$i.' " class="active-ppa">'.$i.'</p>';

					} else {
						$contentCms .= '<p id="'.$i.'">'.$i.'</p>';
					}
				}

			}

			if ( $currentPage < $countPage - 2 )  {
				$contentCms .= '<p id="'.$i.'">...</p>';
			}

			if ($currentPage < $countPage && $countPage > 1) {
				$contentCms .= '<p id="'.($currentPage+1).'"><i class="fas fa-angle-right"></i></p>';
			} else {
				// $contentCms .= '<p><i class="fas fa-angle-left"></i></p>';
			}

			$contentCms .= "</div>";

    		return $contentCms;

    	}

    }


    public function edit_parent() {

    	if (Request::ajax()) {
    		$idparent = (String)Request::get('idParent');
    		$nameparent = (String)Request::get('nameEdit');

    		$editpost = categoryModels::find($idparent);
        	$editpost->Name_l0 = $nameparent;

        	$editpost->save();

        	return $idparent.$nameparent;

    	}

    }

    public function insert_parent() {

    	if (Request::ajax()) {
    		$nameparent = (String)Request::get('nameParent');

    		$addParent = new categoryModels;
    		$addParent->ParentID = 0;
        	$addParent->Name_l0 = $nameparent;
        	$addParent->Slug_category = $this->converto($nameparent);
        	$addParent->Khoa = "khmt";

        	$addParent->save();

        	return "Successfull";

    	}

    }

    public function delete_parent() {

    	if (Request::ajax()) {
    		$idparent = (String)Request::get('idParent');

    		$delete_parent = categoryModels::find($idparent);
        	$delete_parent->delete();

        	return "Successfull";

    	}

    }

    public function insert_child() {
    	if (Request::ajax()) {
    		$idchild = (String)Request::get('idChild');
    		$namechild = (String)Request::get('namechild');

    		$addChild = new categoryModels;
    		$addChild->ParentID = $idchild;
        	$addChild->Name_l0 = $namechild;
        	$addChild->Slug_category = $this->converto($namechild);
        	$addChild->Khoa = "khmt";

        	$addChild->save();

        	return "Successfull";

    	}
    }

    public function delete_child() {

    	if (Request::ajax()) {
    		$idchild = (String)Request::get('idChild');

    		$delete_child = categoryModels::find($idchild);
        	$delete_child->delete();

        	return "Successfull";
    	}
    }

    public function ajtenhocphan() {
        if (Request::ajax()) {

            $query = (String)Request::get('query');

            $data = DB::table('table_hocphan')->where('tenhocphan', 'LIKE', "%{$query}%")->limit(7)->get();

            $output = '<ul style="display:block; position:relative">';
            foreach($data as $row)
            {
               $output .= '<li data-value="'.$row->id.'">'.$row->tenhocphan.'</li>';
            }
            $output .= '</ul>';
            echo $output;

        }
    }

    public function ajgiangvienphutrach() {
        if (Request::ajax()) {

            $query = (String)Request::get('query');

            $data = DB::table('table_giangvien')->where('hodem', 'LIKE', "%{$query}%")->orwhere('ten', 'LIKE', "%{$query}%")->limit(7)->get();

            $output = '<ul style="display:block; position:relative">';
            foreach($data as $row)
            {
               $output .= '<li data-value="'.$row->id.'">'.$row->hodem." ".$row->ten.'</li>';
            }
            $output .= '</ul>';
            echo $output;

        }
    }

    public function ajgiangviendaycung() {
        if (Request::ajax()) {

            $query = (String)Request::get('query');

            $id_gvptc = (String)Request::get('id_gvptc');

            $id_gvdc1 = (String)Request::get('id_gvdc1');


            $data = DB::table('table_giangvien')->where('hodem', 'LIKE', "%{$query}%")->orwhere('ten', 'LIKE', "%{$query}%")->limit(7)->get();       

            $output = '<ul style="display:block; position:relative">';
            foreach($data as $row)
            {
                if($row->id != $id_gvptc) {
                    $output .= '<li data-value="'.$row->id.'">'.$row->hodem." ".$row->ten.'</li>';
                }
            }
            $output .= '</ul>';
            echo $output;

        }
    }

	public function ajselectnganh() {

		if(Request::ajax()) {

			$id_nganh = (String)Request::get('id_nganh');

			//$data = DB::table('table_chuandaura_chung')->where('id_nganh', $id_nganh)->get();

			$all_nganh = DB::table('table_nganh')->join('table_chuandaura_chung', 'table_nganh.id', 'table_chuandaura_chung.id_nganh')->get();

			$data = $this->data_chuyen_nganh($all_nganh, $id_nganh);

			$output = '<li>';
			$output .= '<p class="stt-1">STT</p>';
			$output .= '<h4>Chuẩn đầu ra học phần (CLO)</h4>';
			$output .= '</li>';

			$stt_cdr_chung = 1; 
			foreach($data as $value_cdr_chung) {
			$output .= '<li>';
			$output .= '<div class="cdr-left">';
			$output .= '<p class="stt-cdr">'.$stt_cdr_chung.'</p>';
			$output .= '<h3 class="name-cdr11">'.$value_cdr_chung->noidung_cdr_chung.'</h3>';
			$output .= '</div>';

			$output .= '<div class="cdr-right" id="add-parent-cdr-'.$value_cdr_chung->id_cdr_chung.'">';
			$output .= '</div>';
			$output .= '<p id="add-cdr" data-value="'.$value_cdr_chung->id_cdr_chung.'">Thêm</p>';

			$stt_cdr_chung++;

			$output .= '</li>';
			}

			echo $output;

		}

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

   


}
