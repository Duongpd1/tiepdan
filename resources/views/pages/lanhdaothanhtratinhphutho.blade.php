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
        <?php $lanhdaothanhtratinhphuthodata = $trangchudata['lanhdaothanhtratinhphutho'];?>
        <div id="cphContent_ctl03_UpdatePanel1">
            @foreach($lanhdaothanhtratinhphuthodata as $lanhdaothanhtratinhphutho)
                <div class="row bai-viet">
                    @if($lanhdaothanhtratinhphutho->hinhanh != null)
                        <div class="col-xs-4" style="padding-left:0;"><a href="{{url('/noidunglanhdaothanhtratinhphutho/'.$lanhdaothanhtratinhphutho->theloai.'/'.$lanhdaothanhtratinhphutho->id)}}"><img style='height: 110px;' src='{{url($lanhdaothanhtratinhphutho->hinhanh)}}' alt='Image'/></a></div>
                    @else
                        <div class="col-xs-4" style="padding-left:0;"><a href="{{url('/noidunglanhdaothanhtratinhphutho/'.$lanhdaothanhtratinhphutho->theloai.'/'.$lanhdaothanhtratinhphutho->id)}}"><img style='height: 110px;' src="{{url('/img/imagedefault.png')}}" alt='Image'/></a></div>
                    @endif
                    <div class="col-xs-8" style="padding-left: 0;">
                        <a href="{{url('/noidunglanhdaothanhtratinhphutho/'.$lanhdaothanhtratinhphutho->theloai.'/'.$lanhdaothanhtratinhphutho->id)}}">{{$lanhdaothanhtratinhphutho->tieude}}</a>
                        <p class="text-justify">{{$lanhdaothanhtratinhphutho->tomtat}}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="panel-body text-center">
            <ul class="pagination">
                <li>
                    <span>Trang {{$lanhdaothanhtratinhphuthodata->currentPage().'/'.$lanhdaothanhtratinhphuthodata->lastPage()}}</span>
                </li>
                <li @if($lanhdaothanhtratinhphuthodata->currentPage() == 1) class="disabled" @endif>
                    <a @if($lanhdaothanhtratinhphuthodata->currentPage() != 1) href="{{$lanhdaothanhtratinhphuthodata->url(1)}}" @endif>
                        <<
                    </a>
                </li>
                <li @if($lanhdaothanhtratinhphuthodata->currentPage() == 1) class="disabled" @endif>
                    <a @if($lanhdaothanhtratinhphuthodata->currentPage() != 1) href="{{$lanhdaothanhtratinhphuthodata->previousPageUrl()}}" @endif>
                        <
                    </a>
                </li>
                <li class="active">
                    <span>{{$lanhdaothanhtratinhphuthodata->currentPage()}}</span>
                </li>
                <li @if($lanhdaothanhtratinhphuthodata->currentPage() == $lanhdaothanhtratinhphuthodata->lastPage()) class="disabled" @endif>
                    <a @if($lanhdaothanhtratinhphuthodata->currentPage() != $lanhdaothanhtratinhphuthodata->lastPage()) href="{{$lanhdaothanhtratinhphuthodata->nextPageUrl()}}" @endif>
                        >
                    </a>
                </li>
                <li @if($lanhdaothanhtratinhphuthodata->currentPage() == $lanhdaothanhtratinhphuthodata->lastPage()) class="disabled" @endif>

                    <a @if($lanhdaothanhtratinhphuthodata->currentPage() != $lanhdaothanhtratinhphuthodata->lastPage()) href="{{$lanhdaothanhtratinhphuthodata->url($lanhdaothanhtratinhphuthodata->lastPage())}}" @endif>
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