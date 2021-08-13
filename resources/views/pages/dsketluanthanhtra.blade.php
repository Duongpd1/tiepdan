<?php
/****************************************************************
File Name       : home.blade.php
Description     : Header of home page
Creation Date   : 2016/06/10
Author          : FPT/KhanhTH
Change History  :
 ****************************************************************/
?>
@extends('layouts.quantrihethonglayout')

@section('content')
    <style>
        /* Dropdown Button */
        .dropbtn {
            background-color: #fff;
            border-color: #2e6da4;
            color: black;
            padding: 6px;
            font-size: 12px;
            cursor: pointer;
            border: solid 1px #ccc;
            border-radius: 3px;
            margin-top: 1px;
        }

        /* The container <div> - needed to position the dropdown content */
        .dropdown {
            position: relative;
            display: inline-block;

        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 395px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 100;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 6px 12px;
            text-decoration: none;
            display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {background-color: #f1f1f1}

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Change the background color of the dropdown button when the dropdown content is shown */
        .dropdown:hover .dropbtn {
            background-color: #f1f1f1;
        }

    </style>

    <script>
        //document.getElementById("htab-danhmuc").style.display = 'block';
        var element1 = document.getElementById("hs");
        element1.classList.add("active");
        var element = document.getElementById("htab-nghiepvu");
        element.classList.add("active");
        element.classList.add("in");

    </script>
    <div id="ctl00_ctl00_updateListTheoDoiKLTT" class="col-background" style="margin-bottom: 100px;">

        <div class="panel panel-default">
            <div class="panel-heading text-center">
                DANH SÁCH THEO DÕI KẾT LUẬN THANH TRA

            </div>
            <div class="col-xs-3" style="margin-top:10px; margin-bottom: 10px">
                <form method="get" action="ketluanthanhtra">
                    <button type="submit" name="ctl00$ctl00$btnThem" value="" id="ctl00_ctl00_btnThem" title="Tạo theo dõi kết luận thanh tra" class="btn btn-sm btn-success">
                        <span class="glyphicon glyphicon-plus"></span>
                        Thêm
                    </button>
                </form>

            </div>
            <div class="col-xs-6" style="margin-top:8px; margin-bottom: 10px; padding-right:9px;">
                <div class="dropdown pull-right">
                    <button class="dropbtn" onclick="return false;">Danh sách nhắc nhở theo dõi <span class="badge badge-warning">0</span> <span class="caret"></span></button>
                    <div class="dropdown-content">
                        <a id="ctl00_ctl00_denHanBaoCaoTheoDoiItem" href="javascript:__doPostBack()" style="display:none;">Đến hạn báo cáo theo dõi <span class="badge badge-warning"></span></a>
                        <a id="ctl00_ctl00_quaHanBaoCaoTheoDoiItem" href="javascript:__doPostBack()" style="display:none;">Quá hạn báo cáo theo dõi <span class="badge badge-warning"></span></a>
                        <a id="ctl00_ctl00_canDonDocItem" href="javascript:__doPostBack()" style="display:none;">Cần đôn đốc <span class="badge badge-warning"></span></a>
                        <a id="ctl00_ctl00_denHanBaoCaoDonDocItem" href="javascript:__doPostBack()" style="display:none;">Đến hạn báo cáo đôn đốc <span class="badge badge-warning"></span></a>
                        <a id="ctl00_ctl00_quaHanBaoCaoDonDocItem" href="javascript:__doPostBack()" style="display:none;">Quá hạn báo cáo đôn đốc <span class="badge badge-warning"></span></a>
                        <a id="ctl00_ctl00_canKiemTraItem" href="javascript:__doPostBack()" style="display:none;">Cần kiểm tra <span class="badge badge-warning"></span></a>
                        <a id="ctl00_ctl00_denHanBaoCaoKiemTraItem" href="javascript:__doPostBack()" style="display:none;">Đến hạn báo cáo kiểm tra <span class="badge badge-warning"></span></a>
                        <a id="ctl00_ctl00_quaHanBaoCaoKiemTraItem" href="javascript:__doPostBack()" style="display:none;">Quá hạn báo cáo kiểm tra <span class="badge badge-warning"></span></a>
                    </div>
                </div>
                <div class="dropdown pull-right" style="margin-right: 10px;">
                    <button class="dropbtn" onclick="return false;"><span class="glyphicon glyphicon-print text-info"></span> Danh sách báo cáo </button>
                    <div class="dropdown-content">
                        <a id="ctl00_ctl00_BaoCaoTongHopTheoDoiUser" href="javascript:__doPostBack()">Tổng Hợp Theo Dõi Theo Người Sử dụng</a>
                        <a id="ctl00_ctl00_BaoCaoTongHopTheoDoiPB" href="javascript:__doPostBack()">Tổng Hợp Theo Dõi Theo Phòng Ban</a>
                        <a id="ctl00_ctl00_BaoCaoTongHopTheoDoiHCHSPB" href="javascript:__doPostBack()">Tổng Hợp Theo Dõi Hành Chính Hình Sự Theo Phòng Ban</a>
                        <a id="ctl00_ctl00_BaoCaoTongHopTheoDoiHCHSUser" href="javascript:__doPostBack()">Tổng Hợp Theo Dõi Hành Chính Hình Sự Theo Người Sử Dụng</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-3" style="margin-top:10px; margin-bottom: 10px; padding-right: 10px;">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Trạng thái</span>
                    <select name="ctl00$ctl00$dropdownTrangThai" onchange="javascript:setTimeout()" id="ctl00_ctl00_dropdownTrangThai" class="form-control">
                        <option selected="selected" value="ALL">Tất cả</option>
                        <option value="1">Đang theo dõi</option>
                        <option value="2">Cần đôn đốc</option>
                        <option value="3">Đang đôn đốc</option>
                        <option value="4">Cần kiểm tra</option>
                        <option value="5">Đang kiểm tra</option>
                        <option value="6">Cần kết luận</option>
                        <option value="7">Kết Thúc</option>

                    </select>
                </div>
            </div>

            <div class="panel-body text-center">
                <div class="row">
                    <div id="ctl00_ctl00_TheoDoiKLTTDataPager">

                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>

        /*
         function setTitleNhacNhoTheoDoi(contentOfTitle) {
         $('#NhacNhoTheoDoi_Title').html(contentOfTitle);
         }
         */

        $(document).ready(function (event) {

            $('.dropdown').hover(function (event) {

            });

        });

    </script>

@endsection
