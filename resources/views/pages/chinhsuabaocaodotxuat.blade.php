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
    <div class="container-fluid" style="margin-bottom: 40px; padding: 10px 15px">
        <div class="col-background">
            <div id="quantribaocaodotxuat" class="panel panel-default panel-min-height">
                <div class="panel-heading text-center">CHỈNH SỬA BÁO CÁO ĐỘT XUẤT</div>
                <form role="form" id="suabaocaodotxuat" method="post" action="suabaocaodotxuat/{{$baocao[0]->id}}" enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <div class="form-group form-group-sm">
                                <label for="tenloaidon" class="control-label col-xs-2">Tên báo cáo <span class="text-danger">(*)</span></label>
                                <div class="col-xs-10">
                                    <input id="tenloaidon" name="tenloaidon" class="form-control" type="text" value="{{$baocao[0]->tenloaidon}}" required>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="mota" class="control-label col-xs-2">Mô tả <span class="text-danger">(*)</span></label>
                                <div class="col-xs-10">
                                    <input id="mota" name="mota" class="form-control" type="text" value="{{$baocao[0]->mota}}" required>
                                </div>
                            </div>

                            <div class="form-group form-group-sm">
                                <label for="mota" class="control-label col-xs-2">Báo Cáo <span class="text-danger">(*)</span></label>
                                <div class="col-xs-10">
                                    <a href="{{url("file/baocaodotxuat/".$baocao[0]->filename)}}" download>
                                        <span class="glyphicon glyphicon-download-alt"></span>
                                        {{$baocao[0]->filename}}
                                    </a>
                                </div>
                            </div>

                            <div class="form-group form-group-sm">
                                <label for="filebaocao" class="control-label col-xs-2">Báo Cáo Thay Thế <span class="text-danger">(*)</span></label>
                                <div class="col-xs-10">
                                    <input id="filebaocao" name="filebaocao" class="form-control" type="file">
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
