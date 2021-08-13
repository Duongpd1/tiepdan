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
//        var element1 = document.getElementById("taobaocaodotxuat");
//        element1.classList.add("active");
//        var element = document.getElementById("htab-baocao");
//        element.classList.add("active");
//        element.classList.add("in");

    </script>

    <div class="container-fluid" style="margin-bottom: 40px; padding: 10px 15px">
        <div class="col-background">
            <div id="quantribaocaodotxuat" class="panel panel-default panel-min-height">
                <div class="panel-heading text-center">TẠO BÁO CÁO ĐỘT XUẤT</div>
                <form role="form" id="thembaocaodotxuat" method="post" action="thembaocaodotxuat" enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <div class="form-group form-group-sm">
                                <label for="tenloaidon" class="control-label col-xs-2">Tên báo cáo <span class="text-danger">(*)</span></label>
                                <div class="col-xs-10">
                                    <input id="tenloaidon" name="tenloaidon" class="form-control" type="text"  required>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="mota" class="control-label col-xs-2">Mô tả <span class="text-danger">(*)</span></label>
                                <div class="col-xs-10">
                                    <input id="mota" name="mota" class="form-control" type="text"  required>
                                </div>
                            </div>

                            <div class="form-group form-group-sm">
                                <label for="filebaocao" class="control-label col-xs-2">Báo Cáo <span class="text-danger">(*)</span></label>
                                <div class="col-xs-10">
                                    <input id="filebaocao" name="filebaocao" class="form-control" type="file" required>
                                </div>
                            </div>


                            <div class="form-group form-group-sm">
                                <div class="col-xs-4 col-xs-offset-2">
                                    <button type="submit" name="btnok" id="btnok" title="Lưu" class="btn btn-sm btn-success">
                                        <span class="glyphicon glyphicon-saved" aria-hidden="true"></span>
                                        Lưu
                                    </button>

                                    <a href="{{url('baocaodotxuat')}}" name="btncancel" id="btncancel" title="Hủy thao tác, trở lại trang danh sách" class="btn btn-sm btn-danger">
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
