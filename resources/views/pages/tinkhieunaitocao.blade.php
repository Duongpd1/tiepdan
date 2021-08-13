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
            Tin khiếu nại - tố cáo
        </div>

        <?php $tinkntcdata = $trangchudata['tinkntc'];?>
        <div id="cphContent_ctl03_UpdatePanel1">
            @foreach($tinkntcdata as $tinkntc)
                <div class="row bai-viet">
                    @if($tinkntc->hinhanh != null)
                        <div class="col-xs-4" style="padding-left:0;"><a href="{{url('/noidungtinkhieunaitocao/'.$tinkntc->theloai.'/'.$tinkntc->id)}}"><img style='height: 110px;' src='{{url($tinkntc->hinhanh)}}' alt='Image'/></a></div>
                    @else
                        <div class="col-xs-4" style="padding-left:0;"><a href="{{url('/noidungtinkhieunaitocao/'.$tinkntc->theloai.'/'.$tinkntc->id)}}"><img style='height: 110px;' src="{{url('/img/imagedefault.png')}}" alt='Image'/></a></div>
                    @endif
                    <div class="col-xs-8" style="padding-left: 0;">
                        <a href="{{url('/noidungtinkhieunaitocao/'.$tinkntc->theloai.'/'.$tinkntc->id)}}">{{$tinkntc->tieude}}</a>
                        <p class="text-justify">{{$tinkntc->tomtat}}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="panel-body text-center">
            <ul class="pagination">
                <li>
                    <span>Trang {{$tinkntcdata->currentPage().'/'.$tinkntcdata->lastPage()}}</span>
                </li>
                <li @if($tinkntcdata->currentPage() == 1) class="disabled" @endif>
                    <a @if($tinkntcdata->currentPage() != 1) href="{{$tinkntcdata->url(1)}}" @endif>
                        <<
                    </a>
                </li>
                <li @if($tinkntcdata->currentPage() == 1) class="disabled" @endif>
                    <a @if($tinkntcdata->currentPage() != 1) href="{{$tinkntcdata->previousPageUrl()}}" @endif>
                        <
                    </a>
                </li>
                <li class="active">
                    <span>{{$tinkntcdata->currentPage()}}</span>
                </li>
                <li @if($tinkntcdata->currentPage() == $tinkntcdata->lastPage()) class="disabled" @endif>
                    <a @if($tinkntcdata->currentPage() != $tinkntcdata->lastPage()) href="{{$tinkntcdata->nextPageUrl()}}" @endif>
                        >
                    </a>
                </li>
                <li @if($tinkntcdata->currentPage() == $tinkntcdata->lastPage()) class="disabled" @endif>

                    <a @if($tinkntcdata->currentPage() != $tinkntcdata->lastPage()) href="{{$tinkntcdata->url($tinkntcdata->lastPage())}}" @endif>
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