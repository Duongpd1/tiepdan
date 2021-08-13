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
        var element1 = document.getElementById("loaidon");
        element1.classList.add("active");
        var element = document.getElementById("htab-danhmuc");
        element.classList.add("active");
        element.classList.add("in");

    </script>

    <div class="container-fluid" style="margin-bottom: 40px; padding: 10px 15px">
        <div class="col-background">
            <div id="quantridanhmucloaidon" class="panel panel-default panel-min-height">
                <div class="panel-heading text-center">HIỆU CHỈNH LOẠI ĐƠN</div>
                <form role="form" id="tiepcongdan" method="post" action="submitchinhsualoaidon/{{$loaidon[0]->loaidonid}}" enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <div class="form-group form-group-sm">
                                <label for="tenloaidon" class="control-label col-xs-2">Tên loại đơn <span class="text-danger">(*)</span></label>
                                <div class="col-xs-10">
                                    <input id="tenloaidon" name="tenloaidon" class="form-control" type="text" value="{{$loaidon[0]->tenloaidon}}" required>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="mota" class="control-label col-xs-2">Mô tả <span class="text-danger">(*)</span></label>
                                <div class="col-xs-10">
                                    <input id="mota" name="mota" class="form-control" type="text" value="{{$loaidon[0]->mota}}" required>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="maloaidon" class="control-label col-xs-2">Mã (theo CSDLQG) <span class="text-danger">(*)</span></label>
                                <div class="col-xs-10">
                                    <input id="maloaidon" name="maloaidon" class="form-control" type="text" value="{{$loaidon[0]->maloaidon}}" required>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="dotxuat" class="control-label col-xs-2">Trạng thái:</label>
                                <div class="col-xs-10" >
                                    <div class="radio radio-primary">
                                        @if($loaidon[0]->trangthai == 1)
                                            <span style="display:inline-block;width:10%;">
                                                <input id="sudung" type="radio" name="trangthai" value="1" checked="checked" />
                                                <label for="sudung">Sử dụng</label>
                                            </span>
                                            <input id="khongsudung" type="radio" name="trangthai" value="0" />
                                            <label for="khongsudung">Không sử dụng</label>
                                        @else
                                            <span style="display:inline-block;width:10%;">
                                                <input id="sudung" type="radio" name="trangthai" value="1" />
                                                <label for="sudung">Sử dụng</label>
                                            </span>
                                            <input id="khongsudung" type="radio" name="trangthai" value="0" checked="checked" />
                                            <label for="khongsudung">Không sử dụng</label>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-group-sm">
                                <div class="col-xs-4 col-xs-offset-2">
                                    <button type="submit" name="btnok" id="btnok" title="Lưu" class="btn btn-sm btn-success">
                                        <span class="glyphicon glyphicon-saved" aria-hidden="true"></span>
                                        Lưu
                                    </button>

                                    <a href="{{url('qtdanhmucloaidon')}}" name="btncancel" id="btncancel" title="Hủy thao tác, trở lại trang danh sách" class="btn btn-sm btn-danger">
                                        <span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
                                        Hủy
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
