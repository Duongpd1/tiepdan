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
            Tin tức hoạt đông
        </div>
        <?php $tintuchoatdongdata = $trangchudata['tintuchoatdong']?>
        @foreach($tintuchoatdongdata as $tintuchoatdong)
            @if($tintuchoatdong->id == $id)
                <div class="page-title">
                    <h4>
                        {{$tintuchoatdong->tieude}}
                    </h4>
                </div>
                <p style="margin: 5px 0; text-align: justify">
                    <label>Ngày gửi:</label>
                    {{$tintuchoatdong->ngaydang}}
                </p>
                <div class="text-justify">
                    <label>
                        {{$tintuchoatdong->tomtat}}
                    </label>
                </div>
                <div class="bai-viet-noi-dung">
                    <?php echo $tintuchoatdong->noidung; ?>
                </div>
                <div class="row" style="margin: 0; padding-top: 10px">
                    <p class="col-xs-6" style="padding-left: 0">
                        <label>Người cập nhật:</label> {{$tintuchoatdong->nguoicapnhat}}
                    </p>
                    <p class="col-xs-6 text-right" style="padding-right: 0">
                        <label>Nguồn:</label> {{$tintuchoatdong->nguontin}}
                    </p>
                </div>
            @endif
        @endforeach

        <p><label>Các tin khác</label></p>
            <ul>
                @foreach($tintuchoatdongdata as $tintuchoatdong)
                    @if($tintuchoatdong->id != $id)
                        <li>
                            <a href="{{url('/noidungtintuchoatdong/'.$tintuchoatdong->theloai.'/'.$tintuchoatdong->id)}}"> {{$tintuchoatdong->tieude}}</a><span> ({{$tintuchoatdong->ngaydang}})</span>
                        </li>
                    @endif
                @endforeach
            </ul>
    </div>

@endsection