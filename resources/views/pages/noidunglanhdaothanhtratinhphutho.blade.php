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
            LÃNH ĐẠO THANH TRA TỈNH PHÚ THỌ
        </div>
        @foreach($trangchudata['lanhdaothanhtratinhphutho'] as $lanhdaothanhtratinhphutho)
            @if($lanhdaothanhtratinhphutho->id == $id)
                <div class="page-title">
                    <h4>{{$lanhdaothanhtratinhphutho->tieude}}</h4>
                </div>
                <p style="margin: 5px 0; text-align: justify">
                    <label>Ngày gửi:</label>
                    {{$lanhdaothanhtratinhphutho->ngaydang}}
                </p>
                <div class="text-justify">
                    <label>
                        {{$lanhdaothanhtratinhphutho->tomtat}}
                    </label>
                </div>
                <div class="bai-viet-noi-dung">
                    <?php echo $lanhdaothanhtratinhphutho->noidung; ?>
                </div>
                <div class="row" style="margin: 0; padding-top: 10px">
                    <p class="col-xs-6" style="padding-left: 0">
                        <label>Người cập nhật:</label>
                        {{$lanhdaothanhtratinhphutho->nguoicapnhat}}
                    </p>
                    <p class="col-xs-6 text-right" style="padding-right: 0">
                        <label>Nguồn:</label> {{$lanhdaothanhtratinhphutho->nguontin}}
                    </p>
                </div>
            @endif
        @endforeach

        <div style='padding: 5px 5px; font-weight: bold'>Các bài viết gần đây:</div>
        <ul>
            @foreach($trangchudata['lanhdaothanhtratinhphutho'] as $lanhdaothanhtratinhphutho)
                @if($lanhdaothanhtratinhphutho->id != $id)
                    <li>
                        <a href="{{url('/noidunglanhdaothanhtratinhphutho/'.$lanhdaothanhtratinhphutho->theloai.'/'.$lanhdaothanhtratinhphutho->id)}}">{{$lanhdaothanhtratinhphutho->tieude}} ({{$lanhdaothanhtratinhphutho->ngaydang}})</a>
                    </li>
                @endif
            @endforeach
        </ul>

    </div>
@endsection