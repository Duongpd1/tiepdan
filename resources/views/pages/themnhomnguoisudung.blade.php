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
    <script>
        //document.getElementById("htab-hethong").style.display = 'block';
        var element1 = document.getElementById("nhomsudung");
        element1.classList.add("active");
        var element = document.getElementById("htab-hethong");
        element.classList.add("active");
        element.classList.add("in");

    </script>

    <div class="container-fluid" style="margin-bottom: 40px; padding: 10px 15px">

        <div class="col-background">
            <div class="panel panel-default panel-min-height">
                <div class="panel-heading text-center" style="text-transform: uppercase">
                    Thêm mới nhóm người sử dụng
                </div>
                <form method="post" name="xacminh" action="submitthemnhomnguoisudung" enctype="multipart/form-data">
                    <div class="panel-body form-horizontal">
                        <div class="form-group form-group-sm">
                            <label for="tennhom" class="control-label col-xs-3">
                                Tên nhóm <span class="text-danger">(*)</span>
                            </label>
                            <div class="col-xs-9">
                                <input name="tennhom" type="text" maxlength="50" id="tennhom" class="form-control" required />
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="mota" class="control-label col-xs-3">
                                Mô tả <span class="text-danger">(*)</span>
                            </label>
                            <div class="col-xs-9">
                                <input name="mota" type="text" maxlength="255" id="mota" class="form-control" required />
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="control-label col-xs-3">Vai trò</label>
                            <div class="col-xs-9">
                                <div class="checkbox checkbox-primary">
                                    <table class="col-xs-6">
                                        <tr>
                                            <td><span><input id="quyenxoadonthu" type="checkbox" name="quyenxoadonthu" /><label for="quyenxoadonthu">Quyền xóa đơn</label></span></td>
                                            <td><span><input id="quyenxoacongthongtin" type="checkbox" name="quyenxoacongthongtin" /><label for="quyenxoacongthongtin">Quyền xóa Cổng thông tin</label></span></td>
                                        </tr>
                                        <tr>
                                            <td><span><input id="quyenxoadanhmuc" type="checkbox" name="quyenxoadanhmuc" /><label for="quyenxoadanhmuc">Quyền xóa danh mục</label></span></td>
                                            <td><span><input id="quyenxemtheodiaban" type="checkbox" name="quyenxemtheodiaban" /><label for="quyenxemtheodiaban">Quyền xem theo địa bàn</label></span></td>
                                        </tr>
                                        <tr>
                                            <td><span><input id="quyenxoatiepdan" type="checkbox" name="quyenxoatiepdan" /><label for="quyenxoatiepdan">Quyền xóa tiếp dân</label></span></td><td></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="control-label col-xs-3">Phân quyền</label>
                            <div class="col-xs-9">
                                <div>
                                    <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                        <tr>
                                            <td>
                                            </td>
                                            <td style="white-space:nowrap;">
                                                <strong style="color: red;">Nghiệp vụ:</strong>
                                            </td>
                                        </tr>
                                    </table>
                                    <div>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="donthu" id="donthu" /> <label for="donthu" style="font-size: 13px;">Đơn</label>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="danhsachdonthu" id="danhsachdonthu" /> <label for="danhsachdonthu" style="font-size: 13px;">Danh sách đơn</label>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="danhsachxacminh" id="danhsachxacminh" /> <label for="danhsachxacminh" style="font-size: 13px;">Danh sách xác minh</label>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="xacminh" id="xacminh" /> <label for="xacminh" style="font-size: 13px;">Xác minh</label>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="datdai" id="datdai" /> <label for="datdai" style="font-size: 13px;">Đất đai</label>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="danhsachdonthuvedatdai" id="danhsachdonthuvedatdai" /> <label for="danhsachdonthuvedatdai" style="font-size: 13px;">Danh sách đơn về đất đai</label>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="ketluanthanhtra" id="ketluanthanhtra" /> <label for="ketluanthanhtra" style="font-size: 13px;">Kết luận thanh tra</label>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="danhsachtheodoiketluanthanhtra" id="danhsachtheodoiketluanthanhtra" /> <label for="danhsachtheodoiketluanthanhtra" style="font-size: 13px;">Danh sách theo dõi kết luận thanh tra</label>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                        <tr>
                                            <td>
                                            </td>
                                            <td style="white-space:nowrap;">
                                                <strong style="color: red;">Báo Cáo:</strong>
                                            </td>
                                        </tr>
                                    </table>
                                    <div>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="baocao" id="baocao" /> <label for="baocao" style="font-size: 13px;">Báo cáo</label>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                        <tr>
                                            <td>
                                            </td>
                                            <td style="white-space:nowrap;">
                                                <strong style="color: red;">Tra cứu:</strong>
                                            </td>
                                        </tr>
                                    </table>
                                    <div>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="tracuudonthu" id="tracuudonthu" /> <label for="tracuudonthu" style="font-size: 13px;">Tra cứu đơn</label>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="tracuutiepdan" id="tracuutiepdan" /> <label for="tracuutiepdan" style="font-size: 13px;">Tra cứu tiếp dân</label>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                        <tr>
                                            <td>
                                            </td>
                                            <td style="white-space:nowrap;">
                                                <strong style="color: red;">Cổng thông tin:</strong>
                                            </td>
                                        </tr>
                                    </table>
                                    <div>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="tintuc" id="tintuc" /> <label for="tintuc" style="font-size: 13px;">Tin tức</label>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="gioithieu" id="gioithieu" /> <label for="gioithieu" style="font-size: 13px;">Giới thiệu</label>
                                                </td>
                                            </tr>
                                        </table>

                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="gopy" id="gopy" /> <label for="gopy" style="font-size: 13px;">Góp ý</label>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="phapluat" id="phapluat" /> <label for="phapluat" style="font-size: 13px;">Pháp luật</label>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="thongbao" id="thongbao" /> <label for="thongbao" style="font-size: 13px;">Thông báo</label>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                        <tr>
                                            <td>
                                            </td>
                                            <td style="white-space:nowrap;">
                                                <strong style="color: red;">Văn bản:</strong>
                                            </td>
                                        </tr>
                                    </table>
                                    <div>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="vanban" id="vanban" /> <label for="vanban" style="font-size: 13px;">Văn bản</label>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                        <tr>
                                            <td>
                                            </td>
                                            <td style="white-space:nowrap;">
                                                <strong style="color: red;">Danh mục:</strong>
                                            </td>
                                        </tr>
                                    </table>
                                    <div>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="linhvuc" id="linhvuc" /> <label for="linhvuc" style="font-size: 13px;">Lĩnh vực</label>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="loaidon" id="loaidon" /> <label for="loaidon" style="font-size: 13px;">Loại đơn</label>
                                                </td>
                                            </tr>
                                        </table>

                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="diaban" id="diaban" /> <label for="diaban" style="font-size: 13px;">Địa bàn</label>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="donvi" id="donvi" /> <label for="donvi" style="font-size: 13px;">Đơn vị</label>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="thamquyen" id="thamquyen" /> <label for="thamquyen" style="font-size: 13px;">Thẩm quyền</label>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                        <tr>
                                            <td>
                                            </td>
                                            <td style="white-space:nowrap;">
                                                <strong style="color: red;">Hệ thống:</strong>
                                            </td>
                                        </tr>
                                    </table>
                                    <div>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="nguoisudung" id="nguoisudung" /> <label for="nguoisudung" style="font-size: 13px;">Người sử dụng</label>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="nhomnguoisudung" id="nhomnguoisudung" /> <label for="nhomnguoisudung" style="font-size: 13px;">Nhóm người sử dụng</label>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                        <tr>
                                            <td>
                                            </td>
                                            <td style="white-space:nowrap;">
                                                <strong style="color: red;">Tiếp dân:</strong>
                                            </td>
                                        </tr>
                                    </table>
                                    <div>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="danhsachtiepcongdan" id="danhsachtiepcongdan" /> <label for="danhsachtiepcongdan" style="font-size: 13px;">Danh sách tiếp công dân</label>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="thongtintiepdan" id="thongtintiepdan" /> <label for="thongtintiepdan" style="font-size: 13px;">Thông tin tiếp dân</label>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding="0" cellspacing="0" style="border-width:0;">
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="white-space:nowrap;">
                                                    <input type="checkbox" name="lichtiepdan" id="lichtiepdan" /> <label for="lichtiepdan" style="font-size: 13px;">Lịch tiếp dân</label>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="control-label col-xs-3">Trạng thái</label>
                            <div class="col-xs-9">
                                <div class="radio radio-primary">
                                    <table id="status" class="col-xs-4">
                                        <tr>
                                            <td><input id="sudung" type="radio" name="trangthai" value="1" checked="checked" /><label for="sudung">Sử dụng</label></td>
                                            <td><input id="khongsudung" type="radio" name="trangthai" value="0" /><label for="khongsudung">Không sử dụng</label></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <div class="col-xs-9 col-xs-offset-3">
                                <button type="submit" title="Lưu" class="btn btn-sm btn-success">
                                    <span class="glyphicon glyphicon-saved" aria-hidden="true"></span>
                                    Lưu
                                </button>

                                <a type="button" href="{{url('qtnhomnguoisudung')}}"  title="Hủy" class="btn btn-sm btn-danger">
                                    <span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
                                    Hủy
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
