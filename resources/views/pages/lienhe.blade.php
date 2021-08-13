<?php
/****************************************************************
File Name       : home.blade.php
Description     : Header of home page
Creation Date   : 2016/06/10
Author          : FPT/KhanhTH
Change History  :
****************************************************************/
?>
@extends('layouts.trangchulayout')

@section('content')
    <div class="panel panel-default panel-home">
        <div class="panel-heading">
            <i class="fa fa-question-circle fa-lg" aria-hidden="true"></i>
            Liên Hệ
        </div>
        <div class="panel-body" style="padding-bottom: 0">
            <span>Địa chỉ: Đường Nguyễn Tất Thành, Phường Tân Dân, TP. Việt Trì, Tỉnh Phú Thọ</span><br />
            <span>Điện thoại: 0210.3812494</span><br />
            <span>Fax: 0210.3811485</span><br />
        </div>
        <hr style="margin-bottom: 0" />
        <form role="form" method="post" action="submitlienhe">
            <div id="lienhe" class="form-horizontal">
                @if (session('submitgopytrogiup_result'))
                    <div style="margin-top: 10px; margin-left: 40%">
                        <label class="text-success"><span class='glyphicon glyphicon-ok'></span> Cảm ơn bạn đã góp ý !!! </label>
                    </div>
                @endif
                <p style="margin: 8px; padding: 0; text-align: right; font-style: italic">Trường có dấu <span class="text-danger">(*)</span> là bắt buộc.</p>
                <div class="form-group form-group-sm">
                    <label for="hoten" class="control-label col-sm-2">Họ và tên <span class="text-danger">(*)</span></label>
                    <div class="col-sm-10">
                        <input name="hoten" type="text" id="hoten" class="form-control" required>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <label for="cmnd" class="control-label col-sm-2">Số CMND <span class="text-danger">(*)</span></label>
                    <div class="col-sm-10">
                        <input name="cmnd" type="text" id="cmnd" class="form-control" required>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <label for="diachi" class="control-label col-sm-2">Địa chỉ</label>
                    <div class="col-sm-10">
                        <input name="diachi" type="text" maxlength="200" id="diachi" class="form-control" />
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <label for="dienthoai" class="control-label col-sm-2">Điện thoại</label>
                    <div class="col-sm-10">
                        <input name="dienthoai" type="text" maxlength="30" id="dienthoai" class="form-control" />
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <label for="email" class="control-label col-sm-2">Email</label>
                    <div class="col-sm-10">
                        <input name="email" type="email" id="email" class="form-control">
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <label for="tieude" class="control-label col-sm-2">Tiêu đề <span class="text-danger">(*)</span></label>
                    <div class="col-sm-10">
                        <input name="tieude" type="text" id="tieude" class="form-control" required>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <label for="noidung" class="control-label col-sm-2">Nội dung <span class="text-danger">(*)</span></label>
                    <div class="col-sm-10">
                        <textarea name="noidung" rows="10" cols="7" id="noidung" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" id="btnOK" class="btn btn-sm btn-success">
                            <i class="glyphicon glyphicon-saved" aria-hidden="true"></i>
                            Gửi
                        </button>
                        <button type="reset" class="btn btn-sm btn-warning">
                            <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                            Nhập lại
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection