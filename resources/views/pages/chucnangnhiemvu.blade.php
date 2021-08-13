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
            Chức năng- Nhiệm vụ
        </div>
        <?php $chucnangnhiemvudata = $trangchudata['chucnangnhiemvu']?>
        <div id="cphContent_ctl03_UpdatePanel1">
            @foreach($chucnangnhiemvudata as $chucnangnhiemvu)
                <div class="row bai-viet">
                    @if($chucnangnhiemvu->hinhanh != null)
                        <div class="col-xs-4" style="padding-left:0;"><a href="{{url('/noidungchucnangnhiemvu/'.$chucnangnhiemvu->theloai.'/'.$chucnangnhiemvu->id)}}"><img style='height: 110px;' src='{{url($chucnangnhiemvu->hinhanh)}}' alt='Image'/></a></div>
                    @else
                        <div class="col-xs-4" style="padding-left:0;"><a href="{{url('/noidungchucnangnhiemvu/'.$chucnangnhiemvu->theloai.'/'.$chucnangnhiemvu->id)}}"><img style='height: 110px;' src="{{url('/img/imagedefault.png')}}" alt='Image'/></a></div>
                    @endif
                    <div class="col-xs-8" style="padding-left: 0;">
                        <a href="{{url('/noidungchucnangnhiemvu/'.$chucnangnhiemvu->theloai.'/'.$chucnangnhiemvu->id)}}">{{$chucnangnhiemvu->tieude}}</a>
                        <p class="text-justify">{{$chucnangnhiemvu->tomtat}}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="panel-body text-center">
            <ul class="pagination">
                <li>
                    <span>Trang {{$chucnangnhiemvudata->currentPage().'/'.$chucnangnhiemvudata->lastPage()}}</span>
                </li>
                <li @if($chucnangnhiemvudata->currentPage() == 1) class="disabled" @endif>
                    <a @if($chucnangnhiemvudata->currentPage() != 1) href="{{$chucnangnhiemvudata->url(1)}}" @endif>
                        <<
                    </a>
                </li>
                <li @if($chucnangnhiemvudata->currentPage() == 1) class="disabled" @endif>
                    <a @if($chucnangnhiemvudata->currentPage() != 1) href="{{$chucnangnhiemvudata->previousPageUrl()}}" @endif>
                        <
                    </a>
                </li>
                <li class="active">
                    <span>{{$chucnangnhiemvudata->currentPage()}}</span>
                </li>
                <li @if($chucnangnhiemvudata->currentPage() == $chucnangnhiemvudata->lastPage()) class="disabled" @endif>
                    <a @if($chucnangnhiemvudata->currentPage() != $chucnangnhiemvudata->lastPage()) href="{{$chucnangnhiemvudata->nextPageUrl()}}" @endif>
                        >
                    </a>
                </li>
                <li @if($chucnangnhiemvudata->currentPage() == $chucnangnhiemvudata->lastPage()) class="disabled" @endif>

                    <a @if($chucnangnhiemvudata->currentPage() != $chucnangnhiemvudata->lastPage()) href="{{$chucnangnhiemvudata->url($chucnangnhiemvudata->lastPage())}}" @endif>
                        >>
                    </a>

                </li>
                <li>
                    <p style="margin-left: 15px;display: inline">Hiển thị:
                        <select id="hienthi" class="form-control" style="width: auto;display: inline;" onchange="">
                            <option value="10" selected="selected">10</option>
                        </select>
                        dòng
                    </p>
                </li>
            </ul>
        </div>
    </div>
@endsection