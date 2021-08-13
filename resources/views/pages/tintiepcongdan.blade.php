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
            Tin Tiếp công dân
        </div>

        <?php $tintiepdandata = $trangchudata['tintiepdan'];?>
        <div id="cphContent_ctl03_UpdatePanel1">
            @foreach($tintiepdandata as $lanhdaothanhtratinhphutho)
                <div class="row bai-viet">
                    @if($lanhdaothanhtratinhphutho->hinhanh != null)
                        <div class="col-xs-4" style="padding-left:0;"><a href="{{url('/noidungthongtintiepdan/'.$lanhdaothanhtratinhphutho->theloai.'/'.$lanhdaothanhtratinhphutho->id)}}"><img style='height: 110px;' src='{{url($lanhdaothanhtratinhphutho->hinhanh)}}' alt='Image'/></a></div>
                    @else
                        <div class="col-xs-4" style="padding-left:0;"><a href="{{url('/noidungthongtintiepdan/'.$lanhdaothanhtratinhphutho->theloai.'/'.$lanhdaothanhtratinhphutho->id)}}"><img style='height: 110px;' src="{{url('/img/imagedefault.png')}}" alt='Image'/></a></div>
                    @endif
                    <div class="col-xs-8" style="padding-left: 0;">
                        <a href="{{url('/noidungthongtintiepdan/'.$lanhdaothanhtratinhphutho->theloai.'/'.$lanhdaothanhtratinhphutho->id)}}">{{$lanhdaothanhtratinhphutho->tieude}}</a>
                        <p class="text-justify">{{$lanhdaothanhtratinhphutho->tomtat}}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="panel-body text-center">
            <ul class="pagination">
                <li>
                    <span>Trang {{$tintiepdandata->currentPage().'/'.$tintiepdandata->lastPage()}}</span>
                </li>
                <li @if($tintiepdandata->currentPage() == 1) class="disabled" @endif>
                    <a @if($tintiepdandata->currentPage() != 1) href="{{$tintiepdandata->url(1)}}" @endif>
                        <<
                    </a>
                </li>
                <li @if($tintiepdandata->currentPage() == 1) class="disabled" @endif>
                    <a @if($tintiepdandata->currentPage() != 1) href="{{$tintiepdandata->previousPageUrl()}}" @endif>
                        <
                    </a>
                </li>
                <li class="active">
                    <span>{{$tintiepdandata->currentPage()}}</span>
                </li>
                <li @if($tintiepdandata->currentPage() == $tintiepdandata->lastPage()) class="disabled" @endif>
                    <a @if($tintiepdandata->currentPage() != $tintiepdandata->lastPage()) href="{{$tintiepdandata->nextPageUrl()}}" @endif>
                        >
                    </a>
                </li>
                <li @if($tintiepdandata->currentPage() == $tintiepdandata->lastPage()) class="disabled" @endif>

                    <a @if($tintiepdandata->currentPage() != $tintiepdandata->lastPage()) href="{{$tintiepdandata->url($tintiepdandata->lastPage())}}" @endif>
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