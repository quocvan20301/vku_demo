function newtabtitle_admin(e, tabId) {

	var i;
	var tab_1 = document.getElementsByClassName("bottom-post");

	for (i = 0; i < tab_1.length; i ++) {
		tab_1[i].style.display = 'none';
	}

	tab_1[tabId - 1].style.display = 'block';

	var tabLink_1 = document.getElementsByClassName("tabLink");

	for (i = 0; i < tabLink_1.length; i ++) {
		tabLink_1[i].className = tabLink_1[i].className.replace(' active', '');
	}

	event.currentTarget.className += ' active';
}


function auto_slug() {
	var iptieude = document.getElementById("ip_tieude");
	var ipslug = document.getElementById("ip_slug");
	var getipslug;
	getipslug = getSlug(iptieude.value);
	ipslug.value = getipslug;
}

function getSlug(title) { 
    //Đổi chữ hoa thành chữ thường
    var slug = title.toLowerCase();

    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    slug = slug.replace(/\//gi, "-");

    slug = slug.replace(/[^a-z0-9 -]/gi, '');

    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    return slug;
}