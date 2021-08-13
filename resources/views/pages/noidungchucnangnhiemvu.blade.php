<?php
/****************************************************************
File Name       : home.blade.php
Description     : Header of home page
Creation Date   : 2016/06/10
Author          : FPT/KhanhTH
Change History  :
****************************************************************/
?>
@extends('layouts.trangchulayout')

@section('content')

    <div class="panel panel-default panel-home">
        <div class="panel-heading">
            <i class="fa fa-newspaper-o fa-lg" aria-hidden="true"></i>
            Chi tiết Chức năng - Nhiệm vụ
        </div>
        @foreach($trangchudata['chucnangnhiemvu'] as $chucnangnhiemvu)
            @if($chucnangnhiemvu->id == $id)
                <div class="page-title">
                    <h4>{{$chucnangnhiemvu->tieude}}</h4>
                </div>
                <p style="margin: 5px 0; text-align: justify">
                    <label>Ngày gửi:</label>
                    {{$chucnangnhiemvu->ngaydang}}
                </p>
                <div class="text-justify">
                    <label>
                        {{$chucnangnhiemvu->tomtat}}
                    </label>
                </div>
                <div class="bai-viet-noi-dung">
                    <?php echo $chucnangnhiemvu->noidung; ?>
                </div>
                <div class="row" style="margin: 0; padding-top: 10px">
                    <p class="col-xs-6" style="padding-left: 0">
                        <label>Người cập nhật:</label>
                        {{$chucnangnhiemvu->nguoicapnhat}}
                    </p>
                    <p class="col-xs-6 text-right" style="padding-right: 0">
                        <label>Nguồn:</label> {{$chucnangnhiemvu->nguontin}}
                    </p>
                </div>
            @endif
        @endforeach

        <div style='padding: 5px 5px; font-weight: bold'>Các bài viết gần đây:</div>
        <ul>
            @foreach($trangchudata['chucnangnhiemvu'] as $chucnangnhiemvu)
                @if($chucnangnhiemvu->id != $id)
                    <li>
                        <a href="{{url('/noidungchucnangnhiemvu/'.$chucnangnhiemvu->theloai.'/'.$chucnangnhiemvu->id)}}">{{$chucnangnhiemvu->tieude}} ({{$chucnangnhiemvu->ngaydang}})</a>
                    </li>
                @endif
            @endforeach
        </ul>

    </div>
@endsection