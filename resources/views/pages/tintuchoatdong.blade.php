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
            Tin tức hoạt động
        </div>
        <?php $tintuchoatdongdata = $trangchudata['tintuchoatdong']?>

        <div id="cphContent_ctl03_UpdatePanel1">
            @foreach($tintuchoatdongdata as $tintuchoatdong)
                <div class="row bai-viet">
                    @if($tintuchoatdong->hinhanh != null)
                    <div class="col-xs-4" style="padding-left:0;"><a href="{{url('/noidungtintuchoatdong/'.$tintuchoatdong->theloai.'/'.$tintuchoatdong->id)}}"><img style='height: 110px;' src='{{url($tintuchoatdong->hinhanh)}}' alt='Image'/></a></div>
                    @else
                    <div class="col-xs-4" style="padding-left:0;"><a href="{{url('/noidungtintuchoatdong/'.$tintuchoatdong->theloai.'/'.$tintuchoatdong->id)}}"><img style='height: 110px;' src="{{url('/img/imagedefault.png')}}" alt='Image'/></a></div>
                    @endif
                    <div class="col-xs-8" style="padding-left: 0;">
                        <a href="{{url('/noidungtintuchoatdong/'.$tintuchoatdong->theloai.'/'.$tintuchoatdong->id)}}">{{$tintuchoatdong->tieude}}</a>
                        <p class="text-justify">{{$tintuchoatdong->tomtat}}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="panel-body text-center">
            <ul class="pagination">
                <li>
                    <span>Trang {{$tintuchoatdongdata->currentPage().'/'.$tintuchoatdongdata->lastPage()}}</span>
                </li>
                <li @if($tintuchoatdongdata->currentPage() == 1) class="disabled" @endif>
                    <a @if($tintuchoatdongdata->currentPage() != 1) href="{{$tintuchoatdongdata->url(1)}}" @endif>
                        <<
                    </a>
                </li>
                <li @if($tintuchoatdongdata->currentPage() == 1) class="disabled" @endif>
                    <a @if($tintuchoatdongdata->currentPage() != 1) href="{{$tintuchoatdongdata->previousPageUrl()}}" @endif>
                        <
                    </a>
                </li>
                <li class="active">
                    <span>{{$tintuchoatdongdata->currentPage()}}</span>
                </li>
                <li @if($tintuchoatdongdata->currentPage() == $tintuchoatdongdata->lastPage()) class="disabled" @endif>
                    <a @if($tintuchoatdongdata->currentPage() != $tintuchoatdongdata->lastPage()) href="{{$tintuchoatdongdata->nextPageUrl()}}" @endif>
                        >
                    </a>
                </li>
                <li @if($tintuchoatdongdata->currentPage() == $tintuchoatdongdata->lastPage()) class="disabled" @endif>

                    <a @if($tintuchoatdongdata->currentPage() != $tintuchoatdongdata->lastPage()) href="{{$tintuchoatdongdata->url($tintuchoatdongdata->lastPage())}}" @endif>
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