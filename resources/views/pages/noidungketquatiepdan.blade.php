<?php
/****************************************************************
File Name       : home.blade.php
Description     : Header of home page
Creation Date   : 2016/06/10
Author          : FPT/KhanhTH
Change History  :
****************************************************************/
?>
@extends('layouts.tracuulayout')

@section('content')

    <div class="panel panel-default panel-home">
        <div class="panel-heading">
            <i class="fa fa-list fa-lg" aria-hidden="true"></i>
            Chi tiết tiếp dân
        </div>
        <div>
            <table class="table table-bordered table-hover" style="margin-bottom: 0">
                <tbody>

                @foreach($trangchudata['ketquatiepdan'] as $ketquatiepdan)
                    @if($ketquatiepdan->tiepdanid == $tiepdanid)
                        <tr>
                            <td class="col-sm-2 text-bold"><b>Số thụ lý</b></td>
                            <td>
                                {{$ketquatiepdan->sothuly}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold"><b>Ngày tiếp</b></td>
                            <td>
                                {{$ketquatiepdan->ngaytiep}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold"><b>Lần tiếp</b></td>
                            <td>
                                {{$ketquatiepdan->lantiep}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold"><b>Lãnh đạo</b></td>
                            <td>
                                {{$ketquatiepdan->lanhdao}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold"><b>Công dân</b></td>
                            <td>
                                {{$ketquatiepdan->congdan}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold"><b>Địa chỉ</b></td>
                            <td>
                                {{$ketquatiepdan->diachi}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold"><b>Loại hình</b></td>
                            <td>
                                {{$tenloaihinh}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold"><b>Lĩnh vực</b></td>
                            <td>
                                {{$tenlinhvuc}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold"><b>Địa bàn</b></td>
                            <td>
                                {{$tendiaban}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold"><b>Nội dung</b></td>
                            <td>
                                {{$ketquatiepdan->noidung}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold"><b>Ý kiến lãnh đạo</b></td>
                            <td>
                                {{$ketquatiepdan->ykienlanhdao}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold"><b>Kết quả giải quyết</b></td>
                            <td>
                                {{$ketquatiepdan->ketquagiaiquyet}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right">
                                <a href="{{url('/ketquatiepdan')}}" class="btn btn-xs btn-danger">
                                    <span class="glyphicon glyphicon-arrow-left"></span>
                                    Trở lại
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection