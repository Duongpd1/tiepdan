<?php
/****************************************************************
File Name       : quantrihethonglayout.blade.php
Description     : layout for all pages
Creation Date   : 2016/06/10
Author          : FPT/KhanhTH
Change History  :
 ****************************************************************/
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" charset="utf-8">
    <title>Phần mềm quản lý đơn khiếu nại tố cáo</title>

    {{--Declare *.css library--}}
    <link rel="stylesheet" type="text/css" href="{{url('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/bootstrap-theme.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/_styles.css')}}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{url('/css/font-awesome.min.css')}}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{url('/css/ketquagq.css')}}"/>


    {{--Declare *.js library--}}
    <script type="text/javascript" src="{{url('/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/liveclock.js')}}"></script>

    {{--<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">--}}
    <script type="text/javascript" src="{{url('/js/ie-emulation-modes-warning.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/ie10-viewport-bug-workaround.js')}}"></script>

    <link rel="stylesheet" href="{{url('/css/jdNewsScroll.css')}}" />
    {{--<script type="text/javascript" src="{{url('/js/jquery.dimensions.html')}}"></script>--}}
    <script type="text/javascript" src="{{url('/js/jquery.jdNewsScroll.js')}}"></script>

    <script type="text/javascript" src="{{url('/js/donthuview.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/validatorForm.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/backToTop.js')}}"></script>
    <link rel="stylesheet" href="{{url('/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" href="{{url('/css/admin.css')}}">
    <link rel="stylesheet" href="{{url('/css/siderStyle.css')}}">

    <script type="text/javascript" src="{{url('/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/bootstrap-datepicker.vi.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/jquery.validate.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/jquery.validate.unobtrusive.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/bootbox.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/bootboxExtension.js')}}"></script>

    <script type="text/javascript" src="{{url('/ckeditor/ckeditor.js')}}"></script>

    <script type="text/javascript" src="{{url('/js/bootstrap-notify.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/bootstrap-notify.js')}}"></script>


    @yield('css')
    @yield('js')
    @yield('style')


</head>
<body >

<?php

    if($loginsuccessful = Session::get('loginstatus')){

        Session::put('accountid', $loginsuccessful['accountid']);
        Session::put('accountname', $loginsuccessful['fullname']);
        Session::put('accountpermission', $loginsuccessful['permission']);
        Session::put('quyenXoa', $loginsuccessful['quyenXoa']);
    }

    if(Session::has('accountid')){

        $accountname = Session::get('accountname');
        $accountid = Session::get('accountid');
        $accountpermission = Session::get('accountpermission');
        $permission = $accountpermission;

    } else {

        $dangnhappage = url('/dangnhap');
        header('Location:'.$dangnhappage);
        exit();
    }

    if( ! isset($numbDonThu ))
    {
        $numbDonThu = App\Model\TableModel\DonThuTable::getDataOfDothuOfMasterUser($accountid);
    }

?>

<div class="navbar navbar-kntc" role="navigation" style="font-size: 12px;">
    <div class="container-fluid">
        <table style="width: 100%">
            <tbody>
            <tr style="height: 52px">
                <td rowspan="2" style="width: 100px">
                    <img src="{{url('/img/admin_logo.png')}}" alt="Logo" height="74" style="margin: 8px">
                </td>
                <td style="vertical-align: bottom">
                    <span class="main-title">Phần mềm quản lý đơn khiếu nại tố cáo</span>
                </td>
                <td class="text-right" style="color: #fff; vertical-align: top; font-size: 13px; padding-right: 17px">
                    <div style="margin-top: 5px">
                        <div class="btn-group">
                                <span class="dropdown-toggle" data-toggle="dropdown" style="cursor: pointer">
                                    @if($accountpermission == CHUYENVIEN)
                                    <img src="{{url('/img/chuyenvien.png')}}">
                                    @elseif($accountpermission == LANHDAO)
                                    <img src="{{url('/img/lanhdao.png')}}">
                                    @elseif($accountpermission == QUANLYHETHONG)
                                    <img src="{{url('/img/admin.png')}}">
                                    @elseif($accountpermission == THONGTIN)
                                    <img src="{{url('/img/admin.png')}}">
                                    @elseif($accountpermission == TIEPDAN)
                                    <img src="{{url('/img/admin.png')}}">
                                    @elseif($accountpermission == VANTHU)
                                        <img src="{{url('/img/chuyenvien.png')}}">
                                    @endif
                                    {{$accountname}}
                                    <i class="caret"></i>
                                </span>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{url('/doimatkhau')}}">
                                        <span class="glyphicon glyphicon-lock"></span>
                                        Đổi mật khẩu
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{url('/thoat')}}">
                                        <span class="fa fa-sign-out"></span>
                                        Thoát
                                    </a>
                                </li>
                            </ul>
                        </div>
                        |
                        <a href="{{url('/trogiup')}}" style="color: #fff">
                            <span class="fa fa-support"></span>
                            Trợ giúp
                        </a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="vertical-align: middle; text-align: center">
                    <ul class="nav nav-tabs navbar-right" style="margin-right: 0; border: 0">
                        @if($accountpermission == CHUYENVIEN)
                            <li><a href="{{url('/chuyenvien')}}" data-toggle="tab" aria-expanded="true">Trang chủ</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/danhsachdonthu')}}">Danh sách đơn</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/taodonthumoi')}}">Tạo đơn mới</a></li>
							<li><a aria-expanded="true" data-toggle="tab" href="{{url('/themvanbanphapluat')}}">Lưu văn bản</a></li>
							<li><a aria-expanded="true" data-toggle="tab" href="{{url('/tiepcongdan')}}">Tiếp dân</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/qtvanban')}}">Văn Bản</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/baocao')}}">Báo cáo</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/tracuudonthu')}}">Tra cứu</a></li>
                        @elseif($accountpermission == QUANLYHETHONG)
                            <li><a href="{{url('/chuyenvien')}}" data-toggle="tab" aria-expanded="true">Trang chủ</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/danhsachdonthu')}}">Danh sách đơn</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/taodonthumoi')}}">Tạo đơn mới</a></li>
							<li><a aria-expanded="true" data-toggle="tab" href="{{url('/themvanbanphapluat')}}">Lưu văn bản</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/tiepcongdan')}}">Tiếp dân</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/baocao')}}">Báo cáo</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/tracuudonthu')}}">Tra cứu</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/baiviet')}}">Cổng thông tin</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/qtvanban')}}">Văn Bản</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/diaban')}}">Danh mục</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/qtdanhmucnguoisudung')}}">Hệ thống</a></li>
                        @elseif($accountpermission == THONGTIN)
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/baiviet')}}">Cổng thông tin</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/qtvanban')}}">Văn Bản</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/diaban')}}">Danh mục</a></li>
                        @elseif($accountpermission == TIEPDAN || $accountpermission == LANHDAO)
                            <li><a href="{{url('/chuyenvien')}}" data-toggle="tab" aria-expanded="true">Trang chủ</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/danhsachdonthu')}}">Danh sách đơn</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/taodonthumoi')}}">Tạo đơn mới</a></li>
							<li><a aria-expanded="true" data-toggle="tab" href="{{url('/themvanbanphapluat')}}">Lưu văn bản</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/themdanhsachtiepcongdan')}}">Tiếp dân</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/qtvanban')}}">Văn Bản</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/baocao')}}">Báo cáo</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/tracuudonthu')}}">Tra cứu</a></li>
                        @elseif($accountpermission == VANTHU)
                            <li><a href="{{url('/chuyenvien')}}" data-toggle="tab" aria-expanded="true">Trang chủ</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/taodonthumoi')}}">Tạo đơn mới</a></li>
							<li><a aria-expanded="true" data-toggle="tab" href="{{url('/themvanbanphapluat')}}">Lưu văn bản</a></li>
                            <li><a aria-expanded="true" data-toggle="tab" href="{{url('/qtvanban')}}">Văn Bản</a></li>
                        @endif
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="container-fluid child-menu" style="padding-right: 0px; padding-left: 0px">
        <div class="tab-content">
            <div id="htab-nghiepvu" class="tab-pane fade ">
                <div class="navbar-default navbar-collapse child-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown" id="hs">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="">
                                <span class="glyphicon glyphicon-list-alt menu-icon"></span>
                                Hồ sơ
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('/danhsachdonthu')}}"> Danh sách đơn</a></li>
                                {{--<li><a href="{{url('/danhsachxacminh')}}"> Danh sách xác minh</a></li>--}}
                                {{--<li><a href="{{url('/dsdthoagiaidatdai')}}"> Danh sách đơn thư về đất đai</a></li>--}}
                                {{--<li><a href="{{url('/dsketluanthanhtra')}}"> Danh sách theo dõi kết luận thanh tra</a></li>--}}
                            </ul>
                        </li>
                        <li id="dt">
                            <a href="{{url('/taodonthumoi')}}" id="duong=1">
                                <span class="glyphicon glyphicon-envelope menu-icon">

                                </span> Đơn
                            </a>
                        </li>
                    </ul>
                </div>
            </div>


            <div id="htab-tiepdan" class="tab-pane fade">

                <div class="navbar-default navbar-collapse child-menu">
                    <ul class="nav navbar-nav">

                        <li id="ltd">
                            <a href="{{url('/tiepcongdan')}}">
                                <span class="glyphicon glyphicon-calendar menu-icon"></span>
                                Lịch tiếp dân
                            </a>
                        </li>

                        <li id="tttd">
                            <a href="{{url('/thongtintiepdan')}}">
                                <span class="glyphicon glyphicon-info-sign menu-icon"></span>
                                Thông tin tiếp dân
                            </a>
                        </li>

                        <li id="dstcd">
                            <a href="{{url('/danhsachtiepcongdan')}}">
                                <span class="glyphicon glyphicon-list-alt menu-icon"></span>
                                Danh sách tiếp công dân
                            </a>
                        </li>

                    </ul>
                </div>

            </div>


            <div id="htab-congthongtin" class="tab-pane fade">

                <div class="navbar-default navbar-collapse child-menu">
                    <ul class="nav navbar-nav">

                        <li id="baiviet">
                            <a href="{{url('/baiviet')}}">
                                <span class="glyphicon glyphicon-globe menu-icon"></span>
                                Tin tức
                            </a>
                        </li>

                        <li id="qtgioithieu">
                            <a href="{{url('/gioithieu')}}">
                                <span class="fa fa-history menu-icon"></span>
                                Giới thiệu
                            </a>
                        </li>

                        <li id="qtgopy">
                            <a href="{{url('/qtgopycongdan')}}">
                                <span class="glyphicon glyphicon-share menu-icon"></span>
                                Góp ý
                            </a>
                        </li>

                        <li id="phapluat">
                            <a href="{{url('/qttrogiupphapluat')}}">
                                <span class="glyphicon glyphicon-question-sign menu-icon"></span>
                                Pháp luật
                            </a>
                        </li>

                        <li id="qtthongbao">
                            <a href="{{url('/qtthongbao')}}">
                                <span class="fa fa-wpforms menu-icon"></span>
                                Thông báo
                            </a>
                        </li>

                    </ul>
                </div>

            </div>

            <div id="htab-vanban" class="tab-pane fade">

                <div class="navbar-default navbar-collapse child-menu">
                    <ul class="nav navbar-nav">

                    </ul>
                </div>

            </div>

            <div id="htab-danhmuc" class="tab-pane fade">

                <div class="navbar-default navbar-collapse child-menu">
                    <ul class="nav navbar-nav">

                        <li id="diaban">
                            <a href="{{url('/diaban')}}">
                                <span class="fa fa-map menu-icon"></span>
                                Địa bàn
                            </a>
                        </li>

                        <li id="donvi">
                            <a href="{{url('/donvi')}}">
                                <span class="fa fa-university menu-icon"></span>
                                Đơn vị
                            </a>
                        </li>

                        <li id="loaidon">
                            <a href="{{url('/qtdanhmucloaidon')}}">
                                <span class="fa fa-newspaper-o menu-icon"></span>
                                Loại đơn
                            </a>
                        </li>

                        <li id="linhvuc">
                            <a href="{{url('/qtdanhmuclinhvuc')}}">
                                <span class="fa fa-list menu-icon"></span>
                                Lĩnh vực
                            </a>
                        </li>

                        <li id="thamquyen">
                            <a href="{{url('/thamquyen')}}">
                                <span class="glyphicon glyphicon-retweet menu-icon"></span>
                                Thẩm quyền
                            </a>
                        </li>

                        <li id="chutri">
                            <a href="{{url('/qtdanhmucchutri')}}">
                                <span class="glyphicon glyphicon-user"></span>
                                Chủ Trì
                            </a>
                        </li>

                    </ul>
                </div>

            </div>

            <div id="htab-hethong" class="tab-pane fade">

                <div class="navbar-default navbar-collapse child-menu">
                    <ul class="nav navbar-nav">

                        <li id="nguoisudung">
                            <a href="{{url('/qtdanhmucnguoisudung')}}">
                                <span class="fa fa-user menu-icon"></span>
                                Người sử dụng
                            </a>
                        </li>

                        <li id="nhomsudung">
                            <a href="{{url('/qtnhomnguoisudung')}}">
                                <span class="fa fa-users menu-icon"></span>
                                Nhóm người sử dụng
                            </a>
                        </li>

                        <li id="hethong">
                            <a href="{{url('/cauhinhhethong')}}" >
                                <span class="glyphicon glyphicon-cog menu-icon"></span>
                                Cấu hình hệ thống
                            </a>
                        </li>

                    </ul>
                </div>

            </div>

            <div id="htab-baocao" class="tab-pane fade">

                <div class="navbar-default navbar-collapse child-menu">
                    <ul class="nav navbar-nav">

                        {{--<li id="taobaocaodotxuat">--}}
                        {{--<a href="{{url('/taobaocaodotxuat')}}">--}}
                        {{--<span class="fa fa-wpforms menu-icon"></span>--}}
                        {{--Tạo Báo Cáo Đột Xuất--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        <li id="baocao">
                            <a href="{{url('/baocao')}}">
                                <span class="fa fa-wpforms menu-icon"></span>
                                Báo Cáo
                            </a>
                        </li>

                        <li id="baocaodotxuat">
                            <a href="{{url('/baocaodotxuat')}}">
                                <span class="fa fa-wpforms menu-icon"></span>
                                Báo Cáo Đột Xuất
                            </a>
                        </li>



                    </ul>
                </div>

            </div>


        </div>

        <script type="text/javascript">
            $('a[data-toggle="tab"]').on('click', function (e) {
                var target = $(e.target).attr("href"); // activated tab
                console.log("A link: " + target);
                if (target.substr(0, 1) != "#") {
                    window.location.href = target;
                }
            });



        </script>
    </div>
</div>

<div class="container-fluid" style="font-size: 12px;padding-top: 0.5%">

    <div class="col-xs-3 panel-group" style="padding-top:10px;padding-left: 0px;padding-right: 0px">

        @if(Request::is('chuyenvien'))

            <div class="panel panel-default panel-home" style="display: {{(@$permission != VANTHU)?'':'none'}}">
                <div class="panel-heading">
                    <i aria-hidden="true" class="fa fa-list-alt fa-lg"></i>
                    Đơn khiếu nại/Tố cáo
                </div>

                <div class="list-group">

                    <a class="list-group-item" id="vanBanChoXuLyId" onclick="chonHienThiKetQua2('vanBanChoXuLyId')" style="display: {{(@$permission == CHUYENVIEN)?'none':''}}">Đơn chờ xử lý
                        <span id="numbVanBanChoXuly" style="float: right; background-color: #DD4B39; color: white; padding-left: 10px; padding-right: 10px; border-radius: 5px; font-weight: 600">
                         {{ count(@$numbDonThu->choXuLy) }}
                    </span>
                    </a>
                    <a class="list-group-item" id="vanBanDangXuLy" onclick="chonHienThiKetQua2('vanBanDangXuLy')"> {{(@$permission == CHUYENVIEN)?'Đơn chờ xử lý':'Đơn đang xử lý'}}
                        <span id="numbVanBanDangXuly" style="float: right; background-color: #DD4B39; color: white; padding-left: 10px; padding-right: 10px; border-radius: 5px; font-weight: 600">
                        {{ count(@$numbDonThu->dangXuLy) }}
                    </span>
                    </a>
                    <a class="list-group-item" id="xuLyDon" onclick="chonHienThiKetQua2('xuLyDon')" style="display: none"><span></span>Xử lý đơn khiếu nại, kiến nghị, phản ánh, tố cáo</a>
                    <a class="list-group-item" id="quyetDinhGQ" onclick="chonHienThiKetQua2('quyetDinhGQ')" style="display: none">Quyết định giải quyết KNTC</a>
                    <a class="list-group-item" id="donNhieuNoi" onclick="chonHienThiKetQua2('donNhieuNoi')" style="display: none">Đơn gửi nhiều nơi</a>

                </div>
            </div>

            <div class="panel panel-default panel-home" style="display: {{(@$permission != VANTHU)?'':'none'}}">
                <div class="panel-heading panel-primary">
                    <i aria-hidden="true" class="fa fa-newspaper-o fa-lg"></i>
                    Tiếp dân
                </div>

                <div class="list-group">
                    <a class="list-group-item" id="ketQuaTD" onclick="chonHienThiKetQua2('ketQuaTD')">Kết quả tiếp dân</a>
                    <a class="list-group-item" id="lichTD" onclick="chonHienThiKetQua2('lichTD')">Lịch tiếp dân</a>
                </div>
            </div>

            <div class="panel panel-default panel-home" style="display: {{(@$permission != VANTHU)?'':''}}">
                <div class="panel-heading panel-primary">
                    <i aria-hidden="true" class="fa fa-newspaper-o fa-lg"></i>
                    Kho lưu trữ
                </div>

                <div class="list-group">
                    <a class="list-group-item" id="donKetThuc" onclick="chonHienThiKetQua2('donKetThuc')">Hồ sơ đơn</a>
                </div>
            </div>

            <div class="panel panel-default panel-home" >
                <div class="panel-heading panel-primary">
                    <i aria-hidden="true" class="fa fa-newspaper-o fa-lg"></i>
                    Lịch sử
                </div>

                <div class="list-group">
                    <a class="list-group-item" id="donDen" onclick="chonHienThiKetQua2('donDen')" style="display: {{(@$permission == VANTHU)?'':'none'}}">Danh sách văn bản đến</a>
                    <a class="list-group-item" id="donDi" onclick="chonHienThiKetQua2('donDi')" >Danh sách văn bản đi</a>
                    <a class="list-group-item" id="vanBanPhatHanh" onclick="chonHienThiKetQua2('vanBanPhatHanh')">Văn bản phát hành</a>
                </div>
            </div>

        @else
            <div class="panel panel-default panel-home" style="display: {{(@$permission != VANTHU)?'':'none'}}">
                <div class="panel-heading">
                    <i aria-hidden="true" class="fa fa-list-alt fa-lg"></i>
                    Đơn khiếu nại/Tố cáo
                </div>

                <div class="list-group">

                    <a class="list-group-item" id="vanBanChoXuLyId" href="/chuyenvien?tab=vanBanChoXuLyId" style="display: {{(@$permission == CHUYENVIEN)?'none':''}}">Đơn chờ xử lý
                        <span id="numbVanBanChoXuly" style="float: right; background-color: #DD4B39; color: white; padding-left: 10px; padding-right: 10px; border-radius: 5px; font-weight: 600">
                         {{ count(@$numbDonThu->choXuLy) }}
                    </span>
                    </a>
                    <a class="list-group-item" id="vanBanDangXuLy" href="/chuyenvien?tab=vanBanDangXuLy" > {{(@$permission == CHUYENVIEN)?'Đơn chờ xử lý':'Đơn đang xử lý'}}
                        <span id="numbVanBanDangXuly" style="float: right; background-color: #DD4B39; color: white; padding-left: 10px; padding-right: 10px; border-radius: 5px; font-weight: 600">
                        {{ count(@$numbDonThu->dangXuLy) }}
                    </span>
                    </a>
                    <a class="list-group-item" id="xuLyDon" href="/chuyenvien?tab=xuLyDon" style="display: none"><span></span>Xử lý đơn khiếu nại, kiến nghị, phản ánh, tố cáo</a>
                    <a class="list-group-item" id="quyetDinhGQ" href="/chuyenvien?tab=quyetDinhGQ" style="display: none">Quyết định giải quyết KNTC</a>
                    <a class="list-group-item" id="donNhieuNoi" href="/chuyenvien?tab=donNhieuNoi" style="display: none">Đơn gửi nhiều nơi</a>

                </div>
            </div>

            <div class="panel panel-default panel-home" style="display: {{(@$permission != VANTHU)?'':'none'}}">
                <div class="panel-heading panel-primary">
                    <i aria-hidden="true" class="fa fa-newspaper-o fa-lg"></i>
                    Tiếp dân
                </div>

                <div class="list-group">
                    <a class="list-group-item" id="ketQuaTD" href="/chuyenvien?tab=ketQuaTD">Kết quả tiếp dân</a>
                    <a class="list-group-item" id="lichTD" href="/chuyenvien?tab=lichTD"> Lịch tiếp dân </a>
                </div>
            </div>

            <div class="panel panel-default panel-home" style="display: {{(@$permission != VANTHU)?'':''}}">
                <div class="panel-heading panel-primary">
                    <i aria-hidden="true" class="fa fa-newspaper-o fa-lg"></i>
                    Kho lưu trữ
                </div>

                <div class="list-group">
                    <a class="list-group-item" id="donKetThuc" href="/chuyenvien?tab=donKetThuc">Hồ sơ đơn</a>
                </div>
            </div>

            <div class="panel panel-default panel-home" >
                <div class="panel-heading panel-primary">
                    <i aria-hidden="true" class="fa fa-newspaper-o fa-lg"></i>
                    Lịch sử
                </div>

                <div class="list-group">
                    <a class="list-group-item" id="donDen" href="/chuyenvien?tab=donDen" style="display: {{(@$permission == VANTHU)?'':'none'}}">Danh sách văn bản đến</a>
                    <a class="list-group-item" id="donDi" href="/chuyenvien?tab=donDi" >Danh sách văn bản đi</a>
                    <a class="list-group-item" id="vanBanPhatHanh" href="/chuyenvien?tab=vanBanPhatHanh" >Văn bản phát hành</a>
                </div>
            </div>

        @endif

    </div>

    <div class="col-xs-9 panel-group" style="padding-right: 0px;padding-left: 0px;">

        @yield('content')

    </div>

</div>

<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>


<span id="back-to-top" class="btn btn-sm btn-default" style="cursor: pointer; position: fixed; bottom: 10px; right: 10px; display: none;">
    <i class="glyphicon glyphicon-chevron-up text-primary">

    </i>
</span>

<span  class="btn btn-sm btn-default" style="cursor: pointer; position: fixed; bottom: 95px; right: 10px">
    <a href="{{url('mailbox/'.$accountid)}}">
        <img src="{{url('/img/mail.png')}}" width="32" height="32">
        <span id="number_mailbox" class='badge badge-warning'>0</span>
    </a>
</span>

<span  class="btn btn-sm btn-default" style="cursor: pointer; position: fixed; bottom: 45px; right: 10px">
    <img src="{{url('/img/messages.png')}}" width="32" height="32" onclick="openDanhSachNhanVien()">
</span>

<script>
    var accountid = <?php echo json_decode($accountid);?>;
    function openDanhSachNhanVien(){


        var url ="{{url('/danhsachnhanvien')}}"+'/'+accountid ;
        OpenPopupGetData(url,400,500);
    }

    checkMailbox();

    function checkMailbox(){


        $.ajax({
            type: 'post',
            dataType: 'json',
            url:  '{{URL::to('checkmailbox')}}',
            data: {
                accountid: accountid
            },
            success: function (response) {
                document.getElementById('number_mailbox').innerHTML = response['checkmaibox_result'];
            }
        });
    }

    var numbDonthuChoXuLy ={{ count($numbDonThu->choXuLy) }};

    var numbDonthuDangXuLy ={{ count($numbDonThu->dangXuLy) }};

    function updateNumbDonThu()
    {
        $.ajax({
            type: 'post',
            url:  '{{URL::to('getNumberDonthuOfMaster')}}',
            data: {},
            success: function (data)
            {
                if( data[0].choXuLy.length != numbDonthuChoXuLy || data[0].dangXuLy.length != numbDonthuDangXuLy)
                {

                    $('#numbVanBanChoXuly').html(data[0].choXuLy.length);

                    $('#numbVanBanDangXuly').html(data[0].dangXuLy.length);

                    numbDonthuChoXuLy = data[0].choXuLy.length;

                    numbDonthuDangXuLy = data[0].dangXuLy.length;

                    danhSachDonXuLy(data[0].choXuLy,"bodyChoXuLy");
                    danhSachDonXuLy(data[0].dangXuLy,"bodyDangXuLy");

                }
            }
        });

        setTimeout(updateNumbDonThu, 5000);

    }

    $(document).ready(function(){
        updateNumbDonThu();
    });

</script>
</body>
</html>