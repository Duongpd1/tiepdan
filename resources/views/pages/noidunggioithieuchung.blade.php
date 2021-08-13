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
            Giới thiệu chung
        </div>
        @foreach($trangchudata['gioithieuchung'] as $gioithieuchung)
            @if($gioithieuchung->id == $id)
                <div class="page-title">
                    <h4>{{$gioithieuchung->tieude}}</h4>
                </div>
                <p style="margin: 5px 0; text-align: justify">
                    <label>Ngày gửi:</label>
                    {{$gioithieuchung->ngaydang}}
                </p>
                <div class="text-justify">
                    <label>
                        {{$gioithieuchung->tomtat}}
                    </label>
                </div>
                <div class="bai-viet-noi-dung">
                    <?php echo $gioithieuchung->noidung; ?>
                </div>
                <div class="row" style="margin: 0; padding-top: 10px">
                    <p class="col-xs-6" style="padding-left: 0">
                        <label>Người cập nhật:</label>
                        {{$gioithieuchung->nguoicapnhat}}
                    </p>
                    <p class="col-xs-6 text-right" style="padding-right: 0">
                        <label>Nguồn:</label> {{$gioithieuchung->nguontin}}
                    </p>
                </div>
            @endif
        @endforeach

        <div style='padding: 5px 5px; font-weight: bold'>Các bài viết gần đây:</div>
        <ul>
            @foreach($trangchudata['gioithieuchung'] as $gioithieuchung)
                @if($gioithieuchung->id != $id)
                    <li>
                        <a href="{{url('/noidunggioithieuchung/'.$gioithieuchung->theloai.'/'.$gioithieuchung->id)}}">{{$gioithieuchung->tieude}} ({{$gioithieuchung->ngaydang}})</a>
                    </li>
                @endif
            @endforeach
        </ul>

    </div>

@endsection