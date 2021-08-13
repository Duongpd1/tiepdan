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
            <div class="panel panel-default panel-min-height">
                <div class="panel-heading text-center">SOẠN THƯ MỚI</div>

                <form method="post" name="xacminh" action="submittaothuguidi" enctype="multipart/form-data">
                    <div class="panel-body form-horizontal">
                        <div class="form-group form-group-sm">
                            <label for="nguoinhan" class="control-label col-xs-2">Tới <span class="text-danger">(*)</span></label>
                            <div class="col-xs-10">
                                <select id="nguoinhan" name="nguoinhan" class="form-control">
                                    @foreach($danhsachnguoigui as $nguoigui)
                                        @if($nguoigui->accountid != Session::get('accountid'))
                                            <option  value="{{$nguoigui->accountid}}">{{$nguoigui->fullname}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="nguoigui" id="nguoigui" class="form-control" value="{{Session::get('accountid')}}">
                        </div>

                        <div class="form-group form-group-sm">
                            <label for="tieude" class="control-label col-sm-2">Chủ đề <span class="text-danger">(*)</span></label>
                            <div class="col-xs-10">
                                <input name="tieude" type="text" maxlength="200" id="tieude" class="form-control">
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label class="control-label col-xs-2">File đính kèm</label>
                            <div class="col-xs-10">
                                <input type="file" name="filedinhkem" id="filedinhkem" />
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="noidung" class="control-label col-xs-2">Nội dung</label>
                            <div class="col-xs-10">
                                <textarea name="noidung" rows="2" cols="20" id="noidung"></textarea>
                                <script>
                                    CKEDITOR.replace( 'noidung', {
                                        language: 'vi'
                                    } );
                                </script>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <div class="col-xs-10 col-xs-offset-2">
                                <button type="submit" title="Thêm" class="btn btn-sm btn-success">
                                    <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                                    &nbsp;Gửi đi
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function(){

            $('#ngaytiep').datepicker({
                format:'yyyy-mm-dd'
            });

        });

        function ChonDiaBan()
        {
            var url ="{{url('/diabantable')}}" ;
            OpenPopupGetData(url,400,380);
        }

        NumberOnly();

    </script>

@endsection
