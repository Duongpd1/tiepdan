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

    <div id="donthu" class="col-background" style="margin-bottom: 100px;">
        <div class="panel panel-default">
            <div class="panel-heading text-center">CHI TIẾT TIẾP DÂN</div>
            <div class="row" style="margin: 10px 0;">
                <div class="col-xs-8">
                    <button class="btn btn-danger btn-sm" type="submit" title="tạo đơn" id="btnThem"><span class="glyphicon glyphicon-arrow-left"></span> Trở lại</button>
                    <button class="btn btn-warning btn-sm" type="submit" title="in đơn" id="btnPrint"><span class="glyphicon glyphicon-edit"></span> Sửa</button>
                </div>
            </div>
            <table class="table ">
                <tbody>
                <tr>
                    <td class="col-xs-2 text-bold" > Số thụ lý</td>
                    <td  > 2/2016</td>
                </tr>
                <tr>
                    <td class="text-bold">Ngày tiếp</td>
                    <td > 25/07/2016</td>
                </tr>
                <tr>
                    <td class="text-bold">Lần tiếp</td>
                    <td > lần 2</td>
                </tr>
                <tr>
                    <td class="text-bold">Lãnh đạo</td>
                    <td > Phan Đại Dương</td>
                </tr>
                <tr>
                    <td class="text-bold">Loại hình</td>
                    <td > Chưa xác định</td>
                </tr>
                <tr>
                    <td class="text-bold">Lĩnh vực</td>
                    <td >Lĩnh vực đất đai</td>
                </tr>
                <tr>
                    <td class="text-bold">Địa bàn</td>
                    <td >Tổ 4 </td>
                </tr>
                <tr>
                    <td class="text-bold">Nội dung</td>
                    <td >Đề nghị giải quyết..</td>
                </tr>
                <tr>
                    <td class="text-bold">Ý kiến lãnh đạo</td>
                    <td >UBND phường...</td>
                </tr>
                <tr>
                    <td class="text-bold">Kết quả giải quyết</td>
                    <td >UBND phường...</td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>

@endsection
