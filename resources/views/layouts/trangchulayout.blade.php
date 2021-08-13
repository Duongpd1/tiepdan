<?php
/****************************************************************
File Name       : trangchulayout.blade.php
Description     : layout for all pages
Creation Date   : 2016/06/10
Author          : FPT/KhanhTH
Change History  :
 ****************************************************************/
?>
<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" type="text/css" href="{{url('/css/ketquagq.css')}}"/>


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

    if($accountpermission != CONGDAN){

        if($accountpermission != THONGTIN){

            $chuyenvienpage = url('/chuyenvien');
            header('Location:'.$chuyenvienpage);
            exit();
        }else{
            $baivietpage = url('/baiviet');
            header('Location:'.$baivietpage);
            exit();
        }
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



        <div class="container-fluid row main-content" style="font-size: 13px;">
            <div class="col-xs-8 panel-group">

                @yield('content')

                <!-- Slide liên kết website -->
                <div class="panel panel-default panel-home">
                    <div id="LinkedWebsiteCarousel" class="carousel slide multi-item-carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="row">
                                    <div class="col-xs-4" style="padding-left:0; padding-right: 10px;">
                                        <a target="_blank" href="http://www.chinhphu.vn/portal/page/portal/chinhphu/trangchu">
                                            <img src="{{url('/img/Content/images/v2/cpvn.png')}}" alt="Image" class="img-responsive img-slide" /></a>
                                    </div>
                                    <div class="col-xs-4" style="padding-left: 0; padding-right: 10px;">
                                        <a target="_blank" href="http://thanhtra.gov.vn/Pages/Home.aspx">
                                            <img src="{{url('/img/Content/images/v2/ttcp.png')}}" alt="Image" class="img-responsive img-slide" /></a>
                                    </div>
                                    <div class="col-xs-4" style="padding-left: 0; padding-right: 10px;">
                                        <a target="_blank" href="http://tphcm.chinhphu.vn/">
                                            <img src="{{url('/img/Content/images/v2/cthcm.png')}}" alt="Image" class="img-responsive img-slide" /></a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-xs-4" style="padding-left: 0; padding-right: 10px;">
                                        <a target="_blank" href="http://thanglong.chinhphu.vn/">
                                            <img src="{{url('/img/Content/images/v2/cthn.png')}}" alt="Image" class="img-responsive img-slide" /></a>
                                    </div>
                                    <div class="col-xs-4" style="padding-left: 0; padding-right: 10px;">
                                        <a target="_blank" href="http://www.baophutho.vn/">
                                            <img src="{{url('/img/BDT.png')}}" alt="Image" class="img-responsive img-slide" /></a>
                                    </div>
                                    <div class="col-xs-4" style="padding-left: 0; padding-right: 10px;">
                                        <a target="_blank" href="http://phutho.gov.vn/home">
                                            <img src="{{url('/img/UBND.png')}}" alt="Image" class="img-responsive img-slide" /></a>
                                    </div>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#LinkedWebsiteCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                            <a class="right carousel-control" href="#LinkedWebsiteCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function () {

                        var clickEvent = false;
                        $('#homeCarousel').carousel({
                            interval: 4000
                        }).on('click', '.list-group a', function () {
                            window.location.href = this.href;
                            //clickEvent = false;
                            //$('.list-group a').removeClass('active');
                            //$(this).addClass('active');
                        }).on('slid.bs.carousel', function (e) {
                            if (!clickEvent) {
                                var count = $('#homeCarousel .list-group').children().length - 1;
                                var current = $('#homeCarousel .list-group a.active');
                                current.removeClass('active').next().addClass('active');
                                var id = parseInt(current.data('slide-to'));
                                if (count == id) {
                                    $('#homeCarousel .list-group a').first().addClass('active');
                                }
                            }
                            clickEvent = false;
                        });
                    })

                    $(window).load(function () {
                        var objToSet = $('#homeCarousel .list-group-item');
                        if (objToSet.length > 3) {
                            var boxheight = $('#homeCarousel .carousel-inner').innerHeight();
                            var itemlength = $('#homeCarousel .item').length;
                            var triggerheight = Math.round(boxheight / itemlength + 1);
                            objToSet.outerHeight(triggerheight);
                        }
                    });
                </script>
            </div>

            <div class="col-xs-4 panel-group">

                <div class="panel panel-default panel-home">
                    <div class="panel-heading">
                        <i class="fa fa-newspaper-o fa-lg" aria-hidden="true"></i>
                        Thông báo
                    </div>

                    <div class="news-scroll" style="height: 223px;">
                        <ul>

                            @foreach($trangchudata['thongbao'] as $thongbaodata)
                            <li>
                                <a href="{{url('/baivietthongbao/'.$thongbaodata->id)}}">{{$thongbaodata->tenthongbao}}</a>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                </div>

                <!-- Right Menu -->

                <div class="panel panel-default panel-home">
                    <div class="panel-image">
                        <a href="{{url('/tracuu')}}">
                            <img src='{{url('/img/Content/images/v2/kqkntc.png')}}' />
                        </a>
                        <a href="{{url('/lichtiepcongdan')}}">
                            <img src='{{url('/img/Content/images/v2/ltd.png')}}' />
                        </a>
                        <a href="{{url('/vanban')}}">
                            <img src='{{url('/img/Content/images/v2/vbpl.png')}}' />
                        </a>
                        <a href="{{url('/congdandenghitrogiupphapluat')}}">
                            <img src="{{url('/img/Content/images/v2/tgpl.png')}}" />
                        </a>
                        <a href="{{url('/lienhe')}}">
                            <img src="{{url('/img/Content/images/v2/gycd.png')}}" style="margin-bottom: 0" />
                        </a>
                    </div>
                </div>

                <div class="panel panel-default panel-home">
                    <div class="panel-image">
                        <a target="_blank" href="http://media.chinhphu.vn/video/chuyen-muc-ban-tin-chinh-phu-tuan-qua-23">
                            <img src="{{url('/img/Content/images/v2/chinhphu.png')}}" style="margin-bottom: 0" />
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script type="text/javascript">
        //<![CDATA[
        $('#ulTitleNews > li:first-child').addClass('active');$('#slideNewsInner > div:first-child').addClass('active')//]]>
    </script>

    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

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
