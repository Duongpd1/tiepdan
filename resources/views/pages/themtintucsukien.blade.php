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
        var element1 = document.getElementById("baiviet");
        element1.classList.add("active");
        var element = document.getElementById("htab-congthongtin");
        element.classList.add("active");
        element.classList.add("in");
    </script>

    <div id="donthu" class="col-background" style="margin-bottom: 100px;">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                THÊM TIN TỨC - SỰ KIỆN
            </div>

            <form role="form" id="tintucsukien" method="post" action="submitthemtintucsukien" enctype="multipart/form-data">
                {{csrf_field() }}
                <input name="accountname" type="text" id="accountname" style="display: none" value="{{$accountname = Session::get('accountname')}}">
                <div class="panel-body form-horizontal">
                    <div class="form-group form-group-sm">
                        <label for="theloai" class="control-label col-xs-2">Nhóm thể loại <span class="text-danger">(*)</span></label>
                        <div class="col-xs-10">
                            <select name="theloai" id="theloai" class="form-control">
                                {{--<option value="0" selected>Hỏi - đáp</option>--}}
                                {{--<option value="1">Mẫu đơn KNTC</option>--}}
                                {{--<option value="2">Quy định của PL về KNTC</option>--}}
                                <option value="3">Tin khiếu nại-tố cáo</option>
                                <option value="4">Tin Tiếp công dân</option>
                                <option value="5">Tin tức hoạt đông</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="ngaydang" class="control-label col-xs-2">Ngày đăng <span class="text-danger">(*)</span></label>
                        <div class="col-xs-10">
                            <input name="ngaydang" type="text" value="{{date('Y-m-d')}}" id="ngaydang" class="form-control" placeholder="dd-mm-yyyy" data-provide="datepicker" style="width:120px;">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tieude" class="control-label col-xs-2">Tiêu đề <span class="text-danger">(*)</span></label>
                        <div class="col-xs-10">
                            <input name="tieude" type="text" maxlength="250" id="tieude" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="hinhanh" class="control-label col-xs-2">Hình ảnh</label>
                        <div class="col-xs-10">
                            <input type="file" name="hinhanh" id="hinhanh" onkeypress="return false;" onkeyup="return false;" onpaste="return false;">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="chuthichanh" class="control-label col-xs-2">Chú thích hình ảnh</label>
                        <div class="col-xs-10">
                            <input name="chuthichanh" type="text" maxlength="160" id="chuthichanh" class="form-control">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="nguontin" class="control-label col-xs-2">Nguồn tin</label>
                        <div class="col-xs-10">
                            <input name="nguontin" type="text" maxlength="160" id="nguontin" class="form-control">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="trangthai" class="control-label col-xs-2">Trạng thái</label>
                        <div class="col-xs-10">
                            <input id="trangthai" type="checkbox" name="trangthai" checked="checked">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="tomtat" class="control-label col-xs-2">Tóm tắt <span class="text-danger">(*)</span></label>
                        <div class="col-xs-10">
                            <textarea name="tomtat" rows="4" cols="20" id="tomtat" class="form-control" required></textarea>
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
                        <div class="col-xs-10 col-xs-offset-2">
                            <button type="submit" name="btnok" id="btnok" title="Lưu" class="btn btn-sm btn-success">
                                <span class="glyphicon glyphicon-saved" aria-hidden="true"></span>
                                Lưu
                            </button>

                            <button type="reset" class="btn btn-sm btn-warning">
                                <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                                Nhập lại
                            </button>

                            <a href="{{url('baiviet')}}" name="btncancel" id="btncancel" title="Hủy thao tác, trở lại trang danh sách" class="btn btn-sm btn-danger">
                                <span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
                                Hủy
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){

                $('#ngaydang').datepicker({
                    format:'yyyy-mm-dd'
                });

            });
        </script>

    </div>

@endsection
