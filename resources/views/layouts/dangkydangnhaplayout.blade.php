<?php
/****************************************************************
File Name       : dangkydangnhaplayout.blade.php
Description     : layout for all pages
Creation Date   : 2016/06/10
Author          : FPT/KhanhTH
Change History  :
 ****************************************************************/
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style type="text/css" class="init">

        .mySlides {display:none;}
    </style>
    <title>© Phú Thọ - Cổng thông tin điện tử trụ sở tiếp công dân</title>


    {{--Declare *.css library--}}
    <link rel="stylesheet" type="text/css" href="{{url('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/bootstrap-theme.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/WebStyle.css')}}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{url('/css/font-awesome.min.css')}}" media="screen">

    {{--Declare *.js library--}}
    <script type="text/javascript" src="{{url('/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/liveclock.js')}}"></script>


    <script type="text/javascript" src="{{url('/js/ie-emulation-modes-warning.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/ie10-viewport-bug-workaround.js')}}"></script>

    <link rel="stylesheet" href="{{url('/css/jdNewsScroll.css')}}" />
    {{--<script type="text/javascript" src="{{url('/js/jquery.dimensions.html')}}"></script>--}}
    <script type="text/javascript" src="{{url('/js/jquery.jdNewsScroll.js')}}"></script>

    <script type="text/javascript" src="{{url('/js/donthuview.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/validatorForm.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/backToTop.js')}}"></script>

</head>
<body>

<?php

if(Session::has('accountid')){

    $accountpermission = Session::get('accountpermission');

    if($accountpermission == CHUYENVIEN){

        $chuyenvienpage = url('/chuyenvien');
        header('Location:'.$chuyenvienpage);
        exit();

    }
}

?>

<div id="main">
    <div id="head" style="max-width:1170px">
        <img class="mySlides" src="{{url('/img/bannerV2_1.png')}}" style="width:100%">
        <img class="mySlides" src="{{url('/img/bannerV2_2.png')}}" style="width:100%">
        <img class="mySlides" src="{{url('/img/bannerV2_3.png')}}" style="width:100%">
    </div>

    <script>
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {myIndex = 1}
            x[myIndex-1].style.display = "block";
            setTimeout(carousel, 3000); // Change image every 3 seconds
        }
    </script>

    <div class="container warper">
        <div class="navbar navbar-default home-menu" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="{{url('/trangchu')}}">TRANG CHỦ</a></li>
                        <li class='dropdown'>
                            <a class='dropdown-toggle' data-toggle='dropdown' href="#">GIỚI THIỆU<span class='caret'></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('/gioithieuchung')}}">Giới thiệu chung</a></li>
                                <li><a href="{{url('/chucnangnhiemvu')}}">Chức năng- Nhiệm vụ</a></li>
                                <li><a href="{{url('/lanhdaothanhtratinhphutho')}}">Lãnh đạo Thanh tra tỉnh Phú Thọ</a></li>
                            </ul>
                        </li>

                        <li class='dropdown'>
                            <a class='dropdown-toggle' data-toggle='dropdown' href="#">TIN TỨC<span class='caret'></span></a>
                            <ul class="dropdown-menu" >
                                <li><a href="{{url('/tintiepcongdan')}}">Tin Tiếp công dân</a></li>
                                <li><a href="{{url('/tinkhieunaitocao')}}">Tin khiếu nại - tố cáo</a></li>
                                <li><a href="{{url('/tintuchoatdong')}}">Tin tức hoạt động</a></li>
                            </ul>
                        </li>

                        <li><a href="{{url('/tracuu')}}">TRA CỨU</a></li>
                        <li><a href="{{url('/vanban')}}">VĂN BẢN</a></li>
                        <li><a href="{{url('/lienhe')}}">LIÊN HỆ</a></li>

                    </ul>

                    <ul class="nav navbar-nav navbar-right">

                        <li><a href="{{url('/dangnhap')}}"><strong>ĐĂNG NHẬP</strong></a></li>

                    </ul>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                var selector = '.nav li';

                $(selector).on('click', function(){
                    $(selector).removeClass('active');
                    $(this).addClass('active');
                });
            });
        </script>

        @yield('content')

    </div>

    <div id="footer">
        <div class="footer-left">
            <p> Phần mềm: <br>
                <strong>Tiếp công dân và Quản lý đơn khiếu nại tố cáo <br>
                    (Phiên bản nâng cấp 2016)</strong></p>
        </div>
        <div class="footer-right">
            <p>&copy; Đề án: <strong>"Ứng dụng công nghệ thông tin, nâng cao chất lượng công tác quản lý nhà nước về tiếp công dân,
                    xử lý, giải quyết đơn khiếu nại, tố cáo trên địa bàn phú thọ"</strong></p>
        </div>
    </div>
</div>

</body>
</html>
