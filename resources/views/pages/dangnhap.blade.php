<?php
/****************************************************************
File Name       : home.blade.php
Description     : Header of home page
Creation Date   : 2016/06/10
Author          : FPT/KhanhTH
Change History  :
 ****************************************************************/
?>
@extends('layouts.dangkydangnhaplayout')

@section('content')

    <form role="form" method="post" action="submitdangnhap">
        {{csrf_field() }}
        <div class="container-fluid main-content">
            <div class="panel panel-default panel-home" style="width: 370px; margin: 70px auto;">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
                    Đăng nhập hệ thống
                </div>

                @if($loginstatus = Session::get('loginerror'))
                    <div class="alert alert-danger" style="text-align: left; font-size: 14px; color: red; margin-top: 5px; margin-bottom: 5px">
                        <span class="glyphicon glyphicon-warning-sign"></span>&nbsp;{{ $loginstatus }}
                    </div>
                @endif

                <div style="margin-top: 10px;">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="tendangnhap" type="text" id="txtUsername" class="form-control" placeholder="Tên đăng nhập" required autofocus/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input name="matkhau" type="password" id="txtPassword" class="form-control" placeholder="Mật khẩu" required/>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-sm btn-success">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            Đăng nhập
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </form>

@endsection
