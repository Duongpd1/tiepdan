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
        var element1 = document.getElementById("dd");
        element1.classList.add("active");
        var element = document.getElementById("htab-nghiepvu");
        element.classList.add("active");
        element.classList.add("in");

    </script>
<div class="col-background" style="margin-bottom: 100px;">
    <div class="panel panel-default" >
        <div class="panel-heading text-center">TẠO ĐƠN HÒA GIẢI ĐẤT ĐAI</div>
        <div class="panel-body">
            <div class="form-horizontal">
                <div class="form-group form-group-sm">
                    <label class="control-label col-xs-3">Số thụ lý <span class="text-danger">(*)</span></label>
                    <div class="col-xs-1">
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-xs-8">
                        <span style="padding-top: 6px;display: none">Vui lòng nhập số thụ lý!</span>
                        <span style="padding-top: 6px;display: none">Số thụ lý đã tồn tại!</span>
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="control-label col-xs-3">Ngày viết <span class="text-danger">(*)</span></label>

                    <div class="col-xs-2">
                        <div class="input-group date">
                            <input class="form-control" placeholder="dd/mm/yyyy" type="text">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                        </div>
                    </div>
                    <label class="control-label col-xs-2">Ngày nhận <span class="text-danger">(*)</span></label>
                    <div class="col-xs-2">
                        <div class="input-group date">
                            <input class="form-control" placeholder="dd/mm/yyyy" type="text">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <span style="padding-top: 6px;display: none"> Ngày nhận đơn phải sau ngày viết đơn!</span>

                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <label class="control-label col-xs-3">Người yêu cầu <span class="text-danger">(*)</span></label>
                    <div class="col-xs-9">
                        <div class="panel-group" style="margin-top: 0px;margin-bottom: 0px;">
                            <div class="panel panel-default">
                                <div class="panel-heading row">
                                    <div class="col-xs-10" style="padding-left: 0px">Thông tin người yêu cầu</div>
                                    <div class="col-xs-2 text-right" style="padding-right:0px;">
                                        <button class="btn btn-xs btn-danger" onclick="" type="button" style="display: none">Đóng</button>
                                        <button class="btn btn-xs btn-success" onclick="" type="button">Thêm</button>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-default panel" style="display: none">
                                <div class="panel-heading">Thêm người yêu cầu</div>
                                <div class="panel-body">
                                    <div class="form-group form-group-sm">
                                        <label class="control-label col-xs-2">Họ tên <span class="text-danger">(*)</span></label>
                                        <div class="col-xs-10">
                                            <input class="form-control" type="text">
                                            <span style="display: none">Vui lòng nhập họ tên người yêu cầu!</span>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label class="control-label col-xs-2">Giới tính <span class="text-danger">(*)</span></label>
                                        <div class="col-xs-10">
                                            <div class="btn-group">
                                                <label class="btn btn-default active">
                                                    <input type="radio"  value="true"> Nam
                                                </label>
                                                <label class="btn btn-default ">
                                                    <input type="radio" value="false"> Nữ
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label class="control-label col-xs-2">Địa chỉ <span class="text-danger">(*)</span></label>
                                        <div class="col-xs-10">
                                            <input class="form-control" type="text">
                                            <span style="display: none">Vui lòng nhập địa chỉ!</span>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label class="control-label col-xs-2">Số giấy tờ <span class="text-danger">(*)</span></label>
                                        <div class="col-xs-10">
                                            <div class="input-group input-group-sm">
                                                <input class="form-control" type="text">
                                                <span class="input-group-addon">Ngày cấp</span>
                                                <input class="form-control" type="text">
                                                <span class="input-group-addon">Nơi cấp</span>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <div class="col-xs-10 col-xs-offset-2">
                                            <button class="btn btn-sm btn-success" type="submit" onclick="">
                                                <span class="glyphicon glyphicon-ok"></span> Lưu
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span style="padding-top: 6px;display: none"> Vui lòng nhập danh sách người yêu cầu!</span>
                </div>
                <div class="form-group form-group-sm">
                    <label class="control-label col-xs-3">Danh sách các bên liên quan <span class="text-danger">(*)</span></label>
                    <div class="col-xs-9">
                        <div class="panel-group" style="margin-top: 0px;margin-bottom: 0px;">
                            <div class="panel panel-default">
                                <div class="panel-heading row">
                                    <div class="col-xs-10" style="padding-left: 0px">Thông tin các bên liên quan</div>
                                    <div class="col-xs-2 text-right" style="padding-right:0px;">
                                        <button class="btn btn-xs btn-danger" onclick="" type="button" style="display:  none">Đóng</button>
                                        <button class="btn btn-xs btn-success" onclick="" type="button">Thêm</button>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-default panel" style="display: none">
                                <div class="panel-heading">Thông tin các bên liên quan</div>
                                <div class="panel-body">
                                    <div class="form-group form-group-sm">
                                        <label class="control-label col-xs-2">Họ tên <span class="text-danger">(*)</span></label>
                                        <div class="col-xs-10">
                                            <input class="form-control" type="text">
                                            <span style="display: none">Vui lòng nhập họ tên người yêu cầu!</span>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label class="control-label col-xs-2">Giới tính <span class="text-danger">(*)</span></label>
                                        <div class="col-xs-10">
                                            <div class="btn-group">
                                                <label class="btn btn-default active">
                                                    <input type="radio"  value="true"> Nam
                                                </label>
                                                <label class="btn btn-default ">
                                                    <input type="radio" value="false"> Nữ
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label class="control-label col-xs-2">Địa chỉ <span class="text-danger">(*)</span></label>
                                        <div class="col-xs-10">
                                            <input class="form-control" type="text">
                                            <span style="display: none">Vui lòng nhập địa chỉ!</span>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label class="control-label col-xs-2">Số giấy tờ <span class="text-danger">(*)</span></label>
                                        <div class="col-xs-10">
                                            <div class="input-group input-group-sm">
                                                <input class="form-control" type="text">
                                                <span class="input-group-addon">Ngày cấp</span>
                                                <input class="form-control" type="text">
                                                <span class="input-group-addon">Nơi cấp</span>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <div class="col-xs-10 col-xs-offset-2">
                                            <button class="btn btn-sm btn-success" type="submit" onclick="">
                                                <span class="glyphicon glyphicon-ok"></span> Lưu
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span style="padding-top: 6px;display: none"> Vui lòng nhập danh sách các bên liên quan!</span>
                </div>
                <div class="form-group form-group-sm"  >
                    <label class="control-label col-xs-3">Nội dung đơn <span class="text-danger">(*)</span></label>
                    <div class="col-xs-9">
                        <textarea class="form-control" rows="5" cols="20" ></textarea>
                        <div class="cke_1"></div>
                    </div>

                </div>
                <div class="form-group form-group-sm" >
                    <label class="col-xs-3 control-label">Văn bản đính kèm</label>
                    <div class="col-xs-9">
                        <div class="row">
                            <div class="col-xs-10" style="padding-left: 0px">
                                <input style="padding-bottom: 5px;" type="file">
                                <span style="display: none">Vui lòng chọn văn bản thấp hơn 10MB</span>
                                <input style="padding-bottom: 5px;display: none" type="file">
                                <span style="display: none">Vui lòng chọn văn bản thấp hơn 10MB</span>
                                <input style="padding-bottom: 5px;display: none" type="file">
                                <span style="display: none">Vui lòng chọn văn bản thấp hơn 10MB</span>
                                <input style="padding-bottom: 5px;display: none" type="file">
                                <span style="display: none">Vui lòng chọn văn bản thấp hơn 10MB</span>
                                <input style="padding-bottom: 5px;display: none" type="file">
                                <span style="display: none">Vui lòng chọn văn bản thấp hơn 10MB</span>
                                <input style="padding-bottom: 5px;display: none" type="file">
                                <span style="display: none">Vui lòng chọn văn bản thấp hơn 10MB</span>
                                <input style="padding-bottom: 5px;display: none" type="file">
                                <span style="display: none">Vui lòng chọn văn bản thấp hơn 10MB</span>

                            </div>
                            <div class="col-xs-2 text-right" style="padding-right: 0px">
                                <span class="text-success glyphicon glyphicon-plus" onclick="" style="cursor: pointer" title="Thêm"></span>
                                <span class="text-danger glyphicon glyphicon-minus" onclick="" style="cursor: pointer" title="Xóa"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <div class="col-xs-9 col-xs-offset-3">
                        <button class="btn btn-sm btn-success" type="submit" id="btnsave" title="lưu"><span class="glyphicon glyphicon-save"></span> Lưu</button>
                        <button class="btn btn-sm btn-success" type="submit" id="btnsave2" title="Lưu và tiếp tục"><span class="glyphicon glyphicon-save"></span> Lưu và tiếp tục</button>
                        <button class="btn btn-sm btn-warning" type="reset" id="btnnhaplai" title="Nhập lại"><span class="glyphicon glyphicon-refresh"></span> Nhập lại</button>
                        <button class="btn btn-sm btn-danger" type="submit" id="btnnhaplai" title="Hủy"><span class="glyphicon glyphicon-ban-circle"></span> Hủy</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#fromNgay').datepicker({
                format: "dd/mm/yyyy"
            });

            $('#toNgay').datepicker({
                format: "dd/mm/yyyy"
            });

            $('#ngay').datepicker({
                format: "dd/mm/yyyy"
            });

        });

        function divShow(id){
            var tbID = id.id;
            switch (tbID){
                case "1":
                    document.getElementById("ND").style.display='block';
                    document.getElementById("GXM").style.display='none';
                    document.getElementById("1").style.color='#DC143C';
                    document.getElementById("2").style.color='#002a80';
                    break;
                case "2":
                    document.getElementById("ND").style.display='none';
                    document.getElementById("GXM").style.display='block';
                    document.getElementById("LV").style.display='none';
                    document.getElementById("2").style.color='#DC143C';
                    document.getElementById("1").style.color='#002a80';
                    break;
                default:
                    break;
            }
        }
    </script>

@endsection
