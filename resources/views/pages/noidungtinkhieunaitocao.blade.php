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
            <i class="fa fa-newspaper-o fa-lg" aria-hidden="true"></i>
            CHI TIẾT TIN KHIẾU NAI - TỐ CÁO
        </div>
        @foreach($trangchudata['tinkntc'] as $tinkntc)
            @if($tinkntc->id == $id)
                <div class="page-title">
                    <h4>{{$tinkntc->tieude}}</h4>
                </div>
                <p style="margin: 5px 0; text-align: justify">
                    <label>Ngày gửi:</label>
                    {{$tinkntc->ngaydang}}
                </p>
                <div class="text-justify">
                    <label>
                        {{$tinkntc->tomtat}}
                    </label>
                </div>
                <div class="bai-viet-noi-dung">
                    <?php echo $tinkntc->noidung; ?>
                </div>
                <div class="row" style="margin: 0; padding-top: 10px">
                    <p class="col-xs-6" style="padding-left: 0">
                        <label>Người cập nhật:</label>
                        {{$tinkntc->nguoicapnhat}}
                    </p>
                    <p class="col-xs-6 text-right" style="padding-right: 0">
                        <label>Nguồn:</label> {{$tinkntc->nguontin}}
                    </p>
                </div>
            @endif
        @endforeach

        <div style='padding: 5px 5px; font-weight: bold'>Các bài viết gần đây:</div>
        <ul>
            @foreach($trangchudata['tinkntc'] as $tinkntc)
                @if($tinkntc->id != $id)
                    <li>
                        <a href="{{url('/noidungtinkhieunaitocao/'.$tinkntc->theloai.'/'.$tinkntc->id)}}">{{$tinkntc->tieude}} ({{$tinkntc->ngaydang}})</a>
                    </li>
                @endif
            @endforeach
        </ul>

    </div>
@endsection