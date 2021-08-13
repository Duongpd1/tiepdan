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
        var element1 = document.getElementById("tttd");
        element1.classList.add("active");
        var element = document.getElementById("htab-tiepdan");
        element.classList.add("active");
        element.classList.add("in");

    </script>

    <div class="col-background">
        <div class="panel panel-default panel-min-height">
            <div class="panel-heading text-center">HIỆU CHỈNH THÔNG TIN TIẾP DÂN</div>
            <form role="form" id="themthongtintiepdan" method="post" action="submitchinhsuathongtintiepdan/{{$chitietthongtintiepdan[0]->id}}" enctype="multipart/form-data">
                {{csrf_field() }}
                <input name="accountname" type="text" id="accountname" style="display: none" value="{{$accountname = Session::get('accountname')}}">
                <div class="panel-body form-horizontal">
                    <div class="form-group form-group-sm">
                        <label for="sohieu" class="control-label col-xs-2">Số hiệu <span class="text-danger">(*)</span></label>
                        <div class="col-xs-10">
                            <input name="sohieu" type="text" maxlength="50" id="sohieu" class="form-control" value="{{$chitietthongtintiepdan[0]->sohieu}}" required>
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <label for="coquanbanhanh" class="control-label col-xs-2">Cơ quan ban hành <span class="text-danger">(*)</span></label>
                        <div class="col-xs-10">
                            <input name="coquanbanhanh" type="text" maxlength="160" id="coquanbanhanh" class="form-control" value="{{$chitietthongtintiepdan[0]->coquanbanhanh}}" required>
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <label for="ngaybanhanh" class="control-label col-xs-2">Ngày ban hành <span class="text-danger">(*)</span></label>
                        <div class="col-xs-2">
                            <div class="input-group date">
                                <input name="ngaybanhanh" type="text" value="{{$chitietthongtintiepdan[0]->ngaybanhanh}}" id="ngaybanhanh" class="form-control" placeholder="dd-mm-yyyy" data-provide="datepicker" required>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="trichdan" class="control-label col-xs-2">Trích dẫn <span class="text-danger">(*)</span></label>
                        <div class="col-xs-10">
                            <input name="trichdan" type="text" maxlength="250" id="trichdan" class="form-control" value="{{$chitietthongtintiepdan[0]->trichdan}}" required>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="fileupload" class="control-label col-xs-2">File đính kèm</label>
                        <div class="col-xs-10">
                            <input type="file" name="fileupload" id="fileupload" />
                        </div>
                    </div>
                    @if($chitietthongtintiepdan[0]->fileupload != null)
                        <div id="hienthifile" style="margin-top: 10px; margin-left: 220px" class="form-group form-group-sm">
                            <a href="{{url($chitietthongtintiepdan[0]->fileupload)}}" title='Tải về' download>
                                <img id="hinhanhdaidien" src="{{url('/img/file.png')}}" style="height:25px;width:20px"/>&nbsp;{{$chitietthongtintiepdan[0]->filename}}
                            </a>
                        </div>
                    @endif
                    <div class="form-group form-group-sm">
                        <label for="noidung" class="control-label col-xs-2">Nội dung</label>
                        <div class="col-xs-10">
                        <textarea name="noidung" rows="2" cols="20" id="noidung">{{$chitietthongtintiepdan[0]->noidung}}</textarea>
                            <script>
                                CKEDITOR.replace( 'noidung', {
                                    language: 'vi'
                                } );
                            </script>
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
                            <a href="{{url('thongtintiepdan')}}" name="btncancel" id="btncancel" title="Hủy thao tác, trở lại trang danh sách" class="btn btn-sm btn-danger">
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
