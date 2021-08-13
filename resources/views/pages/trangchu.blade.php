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

    <!-- Tin tức sự kiện -->

    <div class="panel panel-default row carousel slide" data-ride="carousel" id="homeCarousel" style='margin-bottom: 5px;'>
        <div class="col-xs-8" style="padding: 0;">
            <div class="carousel-inner">
                <?php
                $counttintuc = count($trangchudata['tintuchoatdong']);
                if($counttintuc>5){
                    $sobaitintuc = 5;
                }else{
                    $sobaitintuc = $counttintuc;
                }
                ?>
                @for ($i = 0; $i < $sobaitintuc; $i++)

                    <?php

                        $summary =  explode(" ",$trangchudata['tintuchoatdong'][$i]->tomtat);
                        $tomtat = '';
                        if(count($summary)>60){
                            for($j =0; $j<count($summary);$j++){

                                if($j>60){

                                    $tomtat.=$summary[$j];
                                    break;

                                }else{

                                    $tomtat.=$summary[$j].' ';
                                }
                            }
                            $tomtat.='...';

                        }else{

                            $tomtat =  $trangchudata['tintuchoatdong'][$i]->tomtat;
                        }

                    ?>

                    @if($i == 0)
                        <div class="item  active">
                    @else
                        <div class="item">
                    @endif
                        @if($trangchudata['tintuchoatdong'][$i]->hinhanh != null)
                            <a href="{{url('/noidungtintuchoatdong/'.$trangchudata['tintuchoatdong'][$i]->theloai.'/'.$trangchudata['tintuchoatdong'][$i]->id)}}">
                                <img src="{{url($trangchudata['tintuchoatdong'][$i]->hinhanh)}}" />
                            </a>
                        @else
                            <a href="{{url('/noidungtintuchoatdong/'.$trangchudata['tintuchoatdong'][$i]->theloai.'/'.$trangchudata['tintuchoatdong'][$i]->id)}}">
                                <img src="{{url('/img/imagedefault.png')}}" />
                            </a>
                        @endif
                            <div class="carousel-caption">
                                <a style="font-weight: bold" href="{{url('/noidungtintuchoatdong/'.$trangchudata['tintuchoatdong'][$i]->theloai.'/'.$trangchudata['tintuchoatdong'][$i]->id)}}">
                                    {{$trangchudata['tintuchoatdong'][$i]->tieude}}
                                </a>
                                <p style="text-transform: capitalize; margin-top: 2px; text-align: justify">

                                    {{$tomtat}}
                                </p>
                            </div>
                        </div>
                @endfor

            </div>
        </div>

        <div class="col-xs-4" style="padding: 0">
            <ul class="list-group">
                @for ($i = 0; $i < $sobaitintuc; $i++)
                    <?php

                        $title =  explode(" ",$trangchudata['tintuchoatdong'][$i]->tieude);
                        $tieude = '';
                        if(count($title)>10){
                            for($j =0; $j<count($title);$j++){

                                if($j>10){

                                    $tieude.=$title[$j];
                                    break;

                                }else{

                                    $tieude.=$title[$j].' ';
                                }
                            }
                            $tieude.='...';

                        }else{

                            $tieude =  $trangchudata['tintuchoatdong'][$i]->tieude;
                        }

                    ?>

                    @if($i == 0)
                        <a data-target="#homeCarousel" data-slide-to="{{$i}}" class="list-group-item  active" href="{{url('/noidungtintuchoatdong/'.$trangchudata['tintuchoatdong'][$i]->theloai.'/'.$trangchudata['tintuchoatdong'][$i]->id)}}">{{$tieude}}</a>
                    @else
                        <a data-target="#homeCarousel" data-slide-to="{{$i}}" class="list-group-item" href="{{url('/noidungtintuchoatdong/'.$trangchudata['tintuchoatdong'][$i]->theloai.'/'.$trangchudata['tintuchoatdong'][$i]->id)}}">{{$tieude}}</a>
                    @endif

                @endfor

            </ul>
        </div>
    </div>

    <!-- Đơn thư -->
    <div class="panel panel-default panel-home">
        <div class="panel-heading">
            <i class="fa fa-envelope fa-lg" aria-hidden="true"></i>
            ĐƠN
        </div>

        <div class="list-group">
            @foreach($trangchudata['xulydonthukntc'] as $ketquakntc)
                <a class="list-group-item" href="{{url('/noidungxulydonthukhieunaitocao/'.$ketquakntc->donthuid)}}">{{$ketquakntc->noidung}} -<i> Người gửi: {{$ketquakntc->tennguoivietdon}}</i></a>
            @endforeach
        </div>

    </div>

    <!-- Văn bản pháp luật -->


    <div class="panel panel-default panel-home">
        <div class="panel-heading">
            <i class="fa fa-file-text fa-lg" aria-hidden="true"></i>
            VĂN BẢN PHÁP LUẬT
        </div>

        <div id="listGroupVanBan" class="list-group">
            @foreach($trangchudata['vanbanphapluat'] as $vanbanphapluat)
                <a class="list-group-item" href="{{url('/vanbanphapluat/'.$vanbanphapluat->id)}}">{{$vanbanphapluat->tenvanban}}</a>
            @endforeach
        </div>
    </div>

@endsection