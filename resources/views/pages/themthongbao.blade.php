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
        var element1 = document.getElementById("qtthongbao");
        element1.classList.add("active");
        var element = document.getElementById("htab-congthongtin");
        element.classList.add("active");
        element.classList.add("in");

    </script>

    <div id="thongbao" class="col-background" style="margin-bottom: 100px;">
        <div class="panel panel-default">
            <div class="panel-heading text-center">THÊM MỚI VĂN BẢN THÔNG BÁO</div>

            <form role="form" id="thongbao" method="post" action="submitthemthongbao" enctype="multipart/form-data">
                {{csrf_field() }}
                <input name="accountname" type="text" id="accountname" style="display: none" value="{{$accountname = Session::get('accountname')}}">
                <div class="panel-body form-horizontal">
                    <div class="form-group form-group-sm">
                        <label class="control-label col-xs-2" for="tenthongbao">
                            Tên thông báo
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-xs-10">
                            <input name="tenthongbao" type="text" maxlength="160" id="tenthongbao" class="form-control">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-xs-2" for="ngaybanhanh">
                            Ngày ban hành
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-xs-10">
                            <input name="ngaybanhanh" type="text" value="{{date('Y-m-d')}}" maxlength="10" id="ngaybanhanh" class="form-control" placeholder="dd-mm-yyyy" data-provide="datepicker" style="width:120px;">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="noidung" class="control-label col-xs-2">Nội dung <span class="text-danger">(*)</span></label>
                        <div class="col-xs-10">
                            <textarea id="noidung" name="noidung" rows="10" cols="20" class="form-control" required></textarea>
                            <script>
                                CKEDITOR.replace( 'noidung', {
                                    language: 'vi'
                                } );
                            </script>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-xs-2">File đính kèm</label>
                        <div class="col-xs-10">
                            <input type="file" name="fileupload" id="fileupload">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <div class="col-xs-10 col-xs-offset-2">
                            <button type="submit" name="btnok" id="btnok" title="Lưu" class="btn btn-sm btn-success">
                                <span class="glyphicon glyphicon-saved" aria-hidden="true"></span>
                                Lưu
                            </button>
                            <button type="reset" class="btn btn-sm btn-warning">
                                <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                                Nhập lại
                            </button>
                            <a href="{{url('qtthongbao')}}" name="btncancel" id="btncancel" title="Hủy thao tác, trở lại trang danh sách" class="btn btn-sm btn-danger">
                                <span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
                                Hủy
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){

            $('#ngaybanhanh').datepicker({
                format:'yyyy-mm-dd'
            });

        });
    </script>

@endsection
