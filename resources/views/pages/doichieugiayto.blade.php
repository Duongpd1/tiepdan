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

    <div class="panel panel-primary">
        <div class="panel-heading" style="text-align: center;font-size: 16px;">Đơn Mới Nhất</div>
        <div class="panel-body">
            <div style="width: 930px;border: 1px solid #2e6da4">
                <ul style="padding-left: 6px;">
                    <li class="display">Nguoi gui:</li>
                    <li class="display">tran huy khanh</li>
                </ul>
                <ul style="padding-left: 6px;">
                    <li class="display">Dia chi:</li>
                    <li class="display">Phu tho</li>
                </ul>
                <ul style="padding-left: 6px;">
                    <li class="display">Ngay gui:</li>
                    <li class="display">20/06/2016</li>
                </ul>
                <ul style="padding-left: 6px;">
                    <li class="display">Trang thao xu ly:</li>
                    <li class="display">Cho xu ly</li>
                </ul>
                <ul style="padding-left: 6px;">
                    <li class="display">Tom tat noi dung:</li>
                    <li class="display">khieu nai ve quyen su dung dat</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
