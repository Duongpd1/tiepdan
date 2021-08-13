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
            Thông Báo
        </div>
        @foreach($trangchudata['thongbao'] as $thongbaodata)
            @if($thongbaodata->id == $id)
                <div class='page-title' align="justify" style="margin-top: 20px"><h4><strong>{{$thongbaodata->tenthongbao}}</strong></h4></div>

                <p style="margin: 5px 0; text-align: justify">
                    <label>Ngày gửi:</label>
                    {{$thongbaodata->ngaybanhanh}}
                </p>

                <div class="bai-viet-noi-dung">
                    <?php echo $thongbaodata->noidung ;?>
                </div>

                <div class="row" style="margin: 0; padding-top: 10px">
                    <p class="col-xs-6" style="padding-left: 0">
                        <label>Người cập nhật:</label>
                        {{$thongbaodata->nguoicapnhat}}
                    </p>
                </div>
                <div>
                    <label>File đính kèm:&nbsp; </label>
                    @if($thongbaodata->fileupload != null)
                        <span class='glyphicon glyphicon-download-alt text-info'></span>
                        <a style='text-decoration: none; margin-left:5px' href="{{url($thongbaodata->fileupload)}}" title='Tải về' download>{{$thongbaodata->filename}}</a>
                    @else
                        Không có file đính kèm
                    @endif
                </div>
            @endif
        @endforeach
        <div style='padding: 5px 5px; font-weight: bold'>Các thông báo khác:</div>
        <ul>
        @foreach($trangchudata['thongbao'] as $thongbaodata)
            @if($thongbaodata->id != $id)
                <li>
                    <a href="{{url('/baivietthongbao/'.$thongbaodata->id)}}">{{$thongbaodata->tenthongbao}} ({{$thongbaodata->ngaybanhanh}})</a>
                </li>
            @endif
        @endforeach
        </ul>

    </div>
@endsection