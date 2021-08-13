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
        var element1 = document.getElementById("hethong");
        element1.classList.add("active");
        var element = document.getElementById("htab-hethong");
        element.classList.add("active");
        element.classList.add("in");

    </script>

    <div class="col-background" id="" style="margin-bottom: 100px;">
        <div class="panel panel-default panel-min-height">
            <div class="panel-heading text-center">Cấu hình hệ thống</div>
            <form role="form" id="cauhinhhethong" method="post" action="submitchinhsuacauhinhhethong" enctype="multipart/form-data">
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="form-group form-group-sm">
                            <label for="tenmaychucsdl" class="control-label col-xs-3">Tên máy chủ CSDL <span class="text-danger">(*)</span></label>
                            <div class="col-xs-9">
                                <input class="form-control" type="text" maxlength="100" id="tenmaychucsdl" name="tenmaychucsdl" value="{{$cau_hinh->tenmaychucsdl}}">
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="tencsdl" class="control-label col-xs-3">Tên CSDL <span class="text-danger">(*)</span></label>
                            <div class="col-xs-9">
                                <input class="form-control" type="text" maxlength="100" id="tencsdl" name="tencsdl" value="{{$cau_hinh->tencsdl}}">
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="taikhoancsdl" class="control-label col-xs-3">Tài khoản CSDL <span class="text-danger">(*)</span></label>
                            <div class="col-xs-9">
                                <input class="form-control" type="text" maxlength="100" id="taikhoancsdl" name="taikhoancsdl" value="{{$cau_hinh->taikhoancsdl}}">
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="matkhaucsdl" class="control-label col-xs-3">Mật khẩu CSDL <span class="text-danger">(*)</span></label>
                            <div class="col-xs-9">
                                <input class="form-control" type="password" id="matkhaucsdl" name="matkhaucsdl" maxlength="30">
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="emailcsdl" class="control-label col-xs-3">Email <span class="text-danger">(*)</span></label>
                            <div class="col-xs-9">
                                <input class="form-control" type="email" id="emailcsdl" name="emailcsdl" maxlength="200" value="{{$cau_hinh->emailcsdl}}">
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="matkhauemail" class="control-label col-xs-3">Mật khẩu Email <span class="text-danger">(*)</span></label>
                            <div class="col-xs-9">
                                <input class="form-control" type="password" id="matkhauemail" name="matkhauemail">
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="thumucupload" class="control-label col-xs-3">Thư mục Upload <span class="text-danger">(*)</span></label>
                            <div class="col-xs-9">
                                <input class="form-control" type="text" maxlength="200" id="thumucupload" name="thumucupload" value="{{$cau_hinh->thumucupload}}">
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="capdiaban" class="control-label col-xs-3">Cấp địa bàn </label>
                            <div class="col-xs-9">
                                <select class="form-control" id="capdiaban" name="capdiaban">
                                    <option value="{{$cau_hinh->capdiaban}}">{{$cau_hinh->capdiaban}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <div class="col-xs-9 col-xs-offset-3">
                                <button class="btn btn-sm btn-success" type="submit" title="Lưu">
                                    <span class="glyphicon glyphicon-save"></span>
                                    Lưu
                                </button>

                                <button type="button" class="btn btn-sm btn-warning" onclick="resetPage()">
                                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                                    Nhập lại
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        function resetPage(){
            window.location.reload(true);
        }


        $("#cauhinhhethong").validate({
            rules: {
                tenmaychucsdl: { required: true},
                tencsdl: { required: true },
                taikhoancsdl: { required: true },
                matkhaucsdl: { required: true },
                emailcsdl: { required: true, email: true },
                matkhauemail: { required: true },
                thumucupload: { required: true }
            },
            messages: {
                tenmaychucsdl: { required: "Vui lòng nhập tên máy chủ CSDL!" },
                tencsdl: { required: "Vui lòng nhập tên CSDL!" },
                taikhoancsdl: { required: "Vui lòng nhập tài khoản kết nối CSDL!" },
                matkhaucsdl: { required: "Vui lòng nhập mật khẩu kết nối CSDL!" },
                emailcsdl: { required: "Vui lòng nhập địa chỉ Email!", email: "Email không hợp lệ!" },
                matkhauemail: { required: "Vui lòng nhập mật khẩu Email!" },
                thumucupload: { required: "Vui lòng nhập thư mục Upload!" }
            },
            success: function (label) {
                label.remove();
            }
        });

    </script>

@endsection
