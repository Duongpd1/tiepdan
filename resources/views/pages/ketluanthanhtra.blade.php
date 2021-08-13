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
        //document.getElementById("htab-danhmuc").style.display = 'block';
        var element1 = document.getElementById("kltt");
        element1.classList.add("active");
        var element = document.getElementById("htab-nghiepvu");
        element.classList.add("active");
        element.classList.add("in");

    </script>

    <div class="col-background" style="margin-bottom: 100px;">
        <div class="panel panel-default">
            <div class="panel-heading text-center">TẠO THEO DÕI KẾT LUẬN THANH TRA</div>
            <div class="panel-body">
                <div class="form-horizontal">
                    <div id="ctl00_UpdatePanelKLTT">

                        <div class="form-group form-group-sm">
                            <div class="col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Kết luận thanh tra</div>
                                    <div class="panel-body">
                                        <input type="hidden" name="ctl00$MaKLTT" id="ctl00_MaKLTT">
                                        <input type="hidden" name="ctl00$IsToChuc" id="ctl00_IsToChuc" value="ToChuc">
                                        <div class="form-group form-group-sm">
                                            <label class="control-label col-xs-2">Số <span class="text-danger">(*)</span></label>
                                            <div class="input-group input-group-sm col-xs-10" style="padding-left:15px; padding-right: 15px;">
                                                <input name="ctl00$SoKLTT" value="1" id="ctl00_SoKLTT" class="form-control" type="number" onkeypress="return (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57) || event.charCode == 0" oninput="handleEventVerifyKLTT()" style="border-right:none;">
                                                <label class="input-group-addon" style="border-right:none;">Kí hiệu </label>
                                                <input name="ctl00$KiHieuKLTT" type="text" id="ctl00_KiHieuKLTT" class="form-control" oninput="handleEventVerifyKLTT()" style="border-right:none;">
                                                <label class="input-group-addon" style="border-right:none;">Ngày </label>
                                                <input name="ctl00$NgayKLTT" type="text" id="ctl00_NgayKLTT" class="form-control" onchange="handleEventVerifyKLTT()" placeholder="dd/mm/yyyy" style="width: 100%;">
                                                <span class="input-group-btn">
                                                    <button id="btnXacThucKLTT" title="Xác thực kết luận thanh tra" disabled="" onclick="xacThucKLTT(event)" type="button" class="btn btn-xs btn-info" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                                        <i class="glyphicon glyphicon-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                            <div class="row">
                                                <label id="errorMessageOfSoKLTT" class="error hide col-xs-offset-2" style="padding-left:15px;"></label>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-sm">
                                            <label class="control-label col-xs-2">Thời hạn thanh tra <span class="text-danger">(*)</span></label>
                                            <div class="input-group input-group-sm col-xs-10" style="padding-left:15px; padding-right: 15px;">
                                                <input name="ctl00$ThoiHanKiemTra" type="text" id="ctl00_ThoiHanKiemTra" class="form-control" placeholder="dd/mm/yyyy" style="width: 100%;">
                                                <label class="input-group-addon" style="border-left: none; border-right: none;">Loại thanh tra</label>
                                                <select name="ctl00$LoaiThanhTra" id="ctl00_LoaiThanhTra" class="form-control">
                                                    <option value="1">Tài chính, đất đai</option>
                                                    <option value="2">Hành chính</option>
                                                    <option value="3">Hình sự</option>
                                                    <option value="4">Kiến nghị khác</option>

                                                </select>
                                            </div>
                                            <div class="row">
                                                <label id="errorMessageOfThoiHanThanhTra" class="error hide col-xs-offset-2" style="padding-left:15px;">Vui lòng nhập thời hạn kiểm tra</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-sm">
                                            <label class="control-label col-xs-2">Tên đoàn thanh tra <span class="text-danger">(*)</span></label>
                                            <div class="col-xs-10">
                                                <input name="ctl00$TenDoanKLTT" type="text" id="ctl00_TenDoanKLTT" class="form-control">
                                                <label class="error hide">Vui lòng nhập tên kết luận thanh tra</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-sm">
                                            <label class="control-label col-xs-2">Nội dung <span class="text-danger">(*)</span></label>
                                            <div class="col-xs-10">
                                                <textarea id="nd1" class="form-control" rows="20" cols="20"></textarea>
                                                <script>
                                                    CKEDITOR.replace( 'nd1', {
                                                        language: 'vi'
                                                    } );
                                                </script>
                                                <label id="NoiDungError" class="error hide">Vui lòng nhập nội dung kết luận thanh tra</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-sm">
                                            <label class="control-label col-xs-2">File kết luận thanh tra <span class="text-danger">(*)</span></label>
                                            <div class="col-xs-10">
                                                <input type="file" name="ctl00$FileUploadKLTT" id="ctl00_FileUploadKLTT">
                                                <span id="fileDinhKemKLTT"></span>
                                                <input type="hidden" name="ctl00$TenQuyetDinhXacThuc" id="ctl00_TenQuyetDinhXacThuc">
                                                <label class="error hide">Vui lòng chọn file kết luận thanh tra</label>
                                            </div>
                                        </div>
                                        <div id="messageAlertVerifyKLTT" class="alert hidden" style="position:fixed; right:0; bottom: 0; z-index:99; margin: 0; margin-right:90px;">
                                            <strong><span id="ctl00_MessageAlertKLTT"></span></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="ctl00_UpdatePanelDTTD">

                        <div class="form-group form-group-sm">
                            <div class="col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Đối tượng theo dõi</div>
                                    <div class="panel-body">
                                        <input type="hidden" name="ctl00$MaDTTD" id="ctl00_MaDTTD">
                                        <div class="form-group form-group-sm">
                                            <label class="control-label col-xs-2">Đối tượng</label>
                                            <div class="col-xs-10">
                                                <select id="selectDoiTuong_DoiTuongTheoDoi" class="form-control" style="width: 12%;">
                                                    <option value="DonVi">Đơn vị</option>
                                                    <option value="CaNhan">Cá nhân</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-sm">
                                            <label class="control-label col-xs-2"><span id="hoTen_DoiTuongTheoDoi">Tên đơn vị </span> <span class="text-danger">(*)</span></label>
                                            <div class="col-xs-10">
                                                <input name="ctl00$TenDTTD" type="text" id="ctl00_TenDTTD" class="form-control">
                                                <label class="error hide">Vui lòng nhập họ tên/tên đơn vị đối tượng theo dõi</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-sm">
                                            <label class="control-label col-xs-2"><span id="soCMND_DoiTuongTheoDoi">Số đăng ký </span><span class="text-danger">(*)</span></label>
                                            <div class="col-xs-10" style="padding: 0 15px 0 15px;">
                                                <div class="input-group input-group-sm">
                                                    <input name="ctl00$CMNDDTTD" type="text" id="ctl00_CMNDDTTD" class="form-control" oninput="handleEventVerifyDTTD()" style="border-right:none;">
                                                    <span class="input-group-addon" style="border-right:none;">Ngày cấp</span>
                                                    <input name="ctl00$NgayCapDTTD" type="text" id="ctl00_NgayCapDTTD" class="form-control" style="border-right-style: none; width: 100%;" placeholder="dd/mm/yyyy">
                                                    <span class="input-group-addon" style="border-right:none;">Nơi cấp</span>
                                                    <input name="ctl00$NoiCapDTTD" type="text" id="ctl00_NoiCapDTTD" class="form-control">
                                                        <span class="input-group-btn">
                                                            <button id="btnXacThucDTTD" onclick="xacThucDTTD(event)" disabled="" type="button" title="Xác thực đối tượng theo dõi" class="btn btn-xs btn-info" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                                                <i class="glyphicon glyphicon-search"></i>
                                                            </button>
                                                        </span>
                                                </div>
                                                <div class="row">
                                                    <label class="error hide">Vui lòng nhập đầy đủ thông tin CMND/Số đăng ký đối tượng theo dõi</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-sm">
                                            <label class="control-label col-xs-2">Địa chỉ <span class="text-danger">(*)</span></label>
                                            <div class="col-xs-10">
                                                <input name="ctl00$DiaChiDTTD" type="text" id="ctl00_DiaChiDTTD" class="form-control">
                                                <label class="error hide">Vui lòng nhập địa chỉ đối tượng theo dõi</label>
                                            </div>
                                        </div>
                                        <div id="nguoiDaiDienForm">
                                            <div class="form-group form-group-sm">
                                                <label class="control-label col-xs-2">Họ tên người đại diện</label>
                                                <div class="col-xs-10">
                                                    <input name="ctl00$HoTenDTTD" type="text" id="ctl00_HoTenDTTD" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="control-label col-xs-2">Giấy tờ tùy thân người đại diện</label>
                                                <div class="col-xs-10 input-group input-group-sm" style="padding: 0 15px 0 15px;">
                                                    <input name="ctl00$SoCMNDNguoiDaiDien" type="text" id="ctl00_SoCMNDNguoiDaiDien" class="form-control" oninput="handleEventVerifyNguoiDaiDien()" style="border-right:none;">
                                                    <span class="input-group-addon" style="border-right:none;">Ngày cấp</span>
                                                    <input name="ctl00$NgayCapCMNDNguoiDaiDien" type="text" id="ctl00_NgayCapCMNDNguoiDaiDien" class="form-control" style="border-right-style: none; width: 100%;" placeholder="dd/mm/yyyy">
                                                    <span class="input-group-addon" style="border-right:none;">Nơi cấp</span>
                                                    <input name="ctl00$NoiCapCMNDNguoiDaiDien" type="text" id="ctl00_NoiCapCMNDNguoiDaiDien" class="form-control">
                                                        <span class="input-group-btn">
                                                            <button id="btnXacThucNDD" onclick="xacThucNDD(event)" disabled="" type="button" class="btn btn-xs btn-info" title="Xác thực người đại diện" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                                                <i class="glyphicon glyphicon-search"></i>
                                                            </button>
                                                        </span>
                                                    <input type="hidden" name="ctl00$MaNguoiDaiDien" id="ctl00_MaNguoiDaiDien">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="control-label col-xs-2">Địa chỉ người đại diện</label>
                                                <div class="col-xs-10">
                                                    <input name="ctl00$DiaChiNguoiDaiDien" type="text" id="ctl00_DiaChiNguoiDaiDien" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="messageAlertVerifyDTTD" class="alert hidden" style="position:fixed; right:0; bottom: 0; z-index:99; margin: 0; margin-right:90px;">
                                            <strong><span id="ctl00_MessageAlertDTTD"></span></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group form-group-sm">
                        <div class="col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Nội dung theo dõi</div>
                                <div class="panel-body">
                                    <div id="NoiDungTaiChinhDatDai" style="">
                                        <div class="form-group form-group-sm">
                                            <label class="control-label col-xs-2">Phải thu tiền</label>
                                            <div class="col-xs-4">
                                                <div class="input-group input-group-sm">
                                                    <input name="ctl00$PhaiThuTienDTTD" id="ctl00_PhaiThuTienDTTD" class="form-control" type="number" onkeypress="return (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57) || event.charCode == 0">
                                                    <span class="input-group-addon">1000VNĐ</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-sm">
                                            <label class="control-label col-xs-2">Thông tin chi tiết phải thu tiền</label>
                                            <div class="col-xs-10">
                                                <input name="ctl00$ChiTietThuTienDTTD" type="text" id="ctl00_ChiTietThuTienDTTD" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group form-group-sm">
                                            <label class="control-label col-xs-2">Phải thu đất</label>
                                            <div class="col-xs-4">
                                                <div class="input-group input-group-sm">
                                                    <input name="ctl00$PhaiThuDatDTTD" id="ctl00_PhaiThuDatDTTD" class="form-control" type="number" onkeypress="return (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57) || event.charCode == 0">
                                                    <span class="input-group-addon">m<sup>2</sup></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-sm">
                                            <label class="control-label col-xs-2">Thông tin chi tiết phải thu đất</label>
                                            <div class="col-xs-10">
                                                <input name="ctl00$ChiTietThuDatDTTD" type="text" id="ctl00_ChiTietThuDatDTTD" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm" style="display: none">
                                        <label class="control-label col-xs-2">Nội dung khác</label>
                                        <div class="col-xs-10">
                                            <textarea id="ndkhac" class="form-control" cols="20" rows="20"></textarea>
                                            <script>
                                                CKEDITOR.replace( 'ndkhac', {
                                                    language: 'vi'
                                                } );
                                            </script>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm" style="margin-left: 0px;">
                        <div class="col-xs-10 col-xs-offset-2">
                            <button type="submit" name="ctl00$BtnLuu" value="" onclick="return checkValidate();" id="ctl00_BtnLuu" title="Lưu" class="btn btn-sm btn-success">
                                <span class="glyphicon glyphicon-saved"></span> Lưu
                            </button>
                            <button type="submit" name="ctl00$BtnReset" value="" id="ctl00_BtnReset" class="btn btn-sm btn-warning" title="Nhập lại">
                                <span class="glyphicon glyphicon-refresh"></span> Nhập lại
                            </button>
                            <button type="submit" name="ctl00$BtnHuy" value="" id="ctl00_BtnHuy" title="Hủy" class="btn btn-sm btn-danger">
                                <span class="glyphicon glyphicon-ban-circle"></span> Hủy
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
