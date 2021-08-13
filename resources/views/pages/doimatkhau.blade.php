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

    <div class="container-fluid" style="margin-bottom: 40px; padding: 10px 15px;width: 900px">

        <div class="col-background">
            <form role="form" action="submitdoimatkhau" method="post">
                <div class="panel panel-default panel-min-height">
                    <div class="panel-heading text-center">Thay đổi mật khẩu</div>
                    <div class="panel-body form-horizontal">
                        <div id="doimatkhauerror" class="text-center text-danger" style="margin-bottom: 10px">

                            @if($doi_mat_khau_error = Session::get('doi_mat_khau_error'))
                                <span class="glyphicon glyphicon-warning-sign"></span>&nbsp;{{$doi_mat_khau_error}} !!!
                            @endif
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="matkhaucu" class="control-label col-xs-3">
                                Mật khẩu hiện tại
                                <span class="text-danger">(*)</span>
                            </label>
                            <div class="col-xs-9">
                                {{csrf_field()}}
                                <input name="accountid" type="hidden" id="accountid" class="form-control" value="{{Session::get('accountid')}}">
                                <input name="matkhaucu" type="password" maxlength="50" id="matkhaucu" class="form-control" required autofocus>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="matkhaumoi" class="control-label col-xs-3">
                                Mật khẩu mới
                                <span class="text-danger">(*)</span>
                            </label>
                            <div class="col-xs-9">
                                <input name="matkhaumoi" type="password" maxlength="50" id="matkhaumoi" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="nhaplaimatkhaumoi" class="control-label col-xs-3">
                                Nhập lại mật khẩu mới
                                <span class="text-danger">(*)</span>
                            </label>
                            <div class="col-xs-9">
                                <input name="nhaplaimatkhaumoi" type="password" maxlength="50" id="nhaplaimatkhaumoi" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <div class="col-xs-9 col-xs-offset-3">
                                <button type="submit"  class="btn btn-sm btn-success">
                                    <span class="glyphicon glyphicon-saved" aria-hidden="true"></span>
                                    Lưu
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

@endsection