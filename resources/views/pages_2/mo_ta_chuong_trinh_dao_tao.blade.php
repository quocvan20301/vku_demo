<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/decuong/motachuongtrinhdaotao.css')}}">
    <title>Document</title>
</head>
<body>
    <div class="mo-ta-chuong-trinh-dao-tao">
		<div class="container"> 
			<div class="row"> 
				<div class="col-md-12"> 

                    <div class="row mtctdt-top">
                        <div class="col-md-6">
                            <p> Đại học đà nẵng <br> Trường ĐH CNTT & TT VIỆT-HÀN</p>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <p>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM <br> Độc Lập - Tự Do - Hạnh Phúc</p>
                            <hr>
                        </div>
                    </div>

                    <h3>BẢN MÔ TẢ CHƯƠNG TRÌNH ĐÀO TẠO <br> Áp dụng cho CTĐT Ngành Công Nghệ Kỹ thuật máy tính</h3>

                    <p class="index">1. Một số thông tin chung</p>
                    <div class="row index-1">
                        <div class="col-md-6">
                            <p>Ngành đào tạo:</p>
                            <p>Mã ngành đào tạo</p>
                            <p>Đơn vị đào tạo và cấp bằng:</p>
                            <p>Tên văn bằng:</p>
                            <p>Trình độ đào tạo:</p>
                            <p>Hình thức đào tạo:</p>
                            <p>Thời gian đào tạo:</p>
                            <p>Ngôn ngữ đào tạo</p>
                        </div>
                        <div class="col-md-6">
                            <p>a</p>
                            <p>b</p>
                        </div>
                    </div>

                    <p class="index">2. Mục tiêu đào tạo và định hướng nơi làm việc sau tốt nghiệp</p>
                    <p>2.1 Mục tiêu đào tạo</p>
                    <table border="1px" cellspacing="0">
                        <thead>
                            <tr>
                                <td>Mã hóa</td>
                                <td>Mục tiêu</td>
                                <td>Mô tả</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PG1</td>
                                <td>Có đạo đức tốt để làm việc và có ích cho cộng đồng;</td>
                                <td>Mô tả</td>
                            </tr>
                            <tr>
                                <td>PG2</td>
                                <td>Có kiến thức cơ bản về khoa học tự nhiên, khoa học xã hội, 
                                    kiến thức toàn diện, chuyên sâu và tiên tiến về lĩnh vực CNKTMT;</td>
                                <td>Mô tả</td>
                            </tr>
                            <tr>
                                <td>PG3</td>
                                <td>Có khả năng nghiên cứu, giải quyết vấn đề và đưa ra những kết luận
                                     mang tính chuyên gia thuộc lĩnh vực CNKTMT.</td>
                                <td>Mô tả</td>
                            </tr>
                        </tbody>
                    </table>
                    <p>2.2 Nơi làm việc sau khi tốt nghiệp</p>
                    <p>Đào tạo những kỹ sư ngành Công nghệ Kỹ thuật máy tính(CNKTMT) có phẩm chất chính trị, 
                        đạo đức, trách nhiệm nghề nghiệp và ý thức phục vụ cộng đồng; có kiến thức, kỹ năng 
                        thực hành nghề nghiệp và năng lực nghiên cứu tương xứng với trình độ đào tạo; có sức khỏe, 
                        đáp ứng tốt nhu cầu lao động trong thời kỳ hội nhập quốc tế và cuộc cách mạng công nghiệp 
                        lần thứ tư.</p>

                    <p class="index">3. Chuẩn đầu ra</p>
                    <table border="1px" cellspacing="0" class="plo-parent">
                        <thead>
                            <tr>
                                <td class="cr-ct-dt-1">Mô tả</td>
                                <td class="cr-ct-dt-2">Mã CĐR</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $temp_cdr = 1; ?>
                            @foreach($chuandaura as $value_chuandaura) 
                            <tr>
                                <td>{{$value_chuandaura->noidung_cdr_chung}}</td>
                                <td>PLO3.{{$temp_cdr}}</td>
                            </tr>
                            <?php $temp_cdr++; ?>
                            @endforeach
                        </tbody>
                    </table>

                    <p class="index">4. Tiêu chí tuyển sinh</p>
                    <ul>
                        <li>Theo quy chế tuyển sinh của Bộ Giáo dục và Đào tạo và Đề án tuyển sinh đại học 
                            hệ chính quy của Trường Đại Công nghệ Thông tin và truyền thông Việt - Hàn.</li>
                        <li>Xét tuyển theo các phương thức: kết hợp và theo kết quả thi THPT Quốc gia;</li>
                    </ul>

                    <p class="index">5. Ma trận liên kết các học phần và chuẩn đầu ra (PLOs)</p>
                    <table border="1px" cellspacing="0">

                        <thead>
                            <tr>
                                <td>STT</td>
                                <td>Học phần</td>
                                <td>Mã HP</td>
                                <td>Số TC</td>
                                <?php $temp_cdr = 1; ?>
                                @foreach($chuandaura as $value_chuandaura) 
                                <td>PLO3.{{$temp_cdr}}</td>
                                <?php $temp_cdr++; ?>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody>
                            <?php $stt_decuong=1; ?>
                            @foreach($all_decuong as $value_decuong)
                            <tr>
                                <td class="center">{{$stt_decuong}}</td>
                                <td class="ten-hoc-phan">{{$value_decuong->tenhocphan}}</td>
                                <td class="center">{{$value_decuong->mahocphan}}</td>
                                <td class="center">{{$value_decuong->soTC}}</td>
                                @foreach($chuandaura as $value_chuandaura) 
                                    <?php $check = 0; ?>
                                    @foreach($value_decuong->PLO as $vl111)
                                        <?php $vl111 = explode("_", $vl111); ?>
                                        @if($vl111[0] == $value_chuandaura->id_cdr_chung)
                                        <td class="center">{{$vl111[1]}}</td>
                                        <?php $check = 1; ?>
                                        @endif
                                    @endforeach

                                    @if($check == 0) 
                                    <td></td>
                                    @endif
                                @endforeach
                            </tr>
                            <?php $stt_decuong++; ?>
                            @endforeach
                        </tbody>

                    </table>

                </div>	
			</div>
		</div>
	</div>
</body>
</html>