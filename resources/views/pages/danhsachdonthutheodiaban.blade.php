<?php
/****************************************************************
File Name       : home.blade.php
Description     : Header of home page
Creation Date   : 2016/06/10
Author          : FPT/KhanhTH
Change History  :
 ****************************************************************/
?>
@extends('layouts.quantrihethonglayout')

@section('content')
    <?php
    ?>
    <script>
        //document.getElementById("htab-danhmuc").style.display = 'block';
        var element1 = document.getElementById("hs");
        element1.classList.add("active");
        var element = document.getElementById("htab-nghiepvu");
        element.classList.add("active");
        element.classList.add("in");

    </script>

    <div id="donthu" class="col-background" style="margin-bottom: 100px;">
        <div class="panel panel-default">
            <div class="panel-heading text-center">DANH SÁCH ĐƠN KHIẾU NẠI TỐ CÁO - {{$loai_hien_thi}}</div>
            <div class="row" style="margin: 10px 0;">
                <div class="col-xs-8">
                    <a href="{{url('taodonthumoi')}}" class="btn btn-success btn-sm" type="button" title="tạo đơn" id="btnThem"><span class="glyphicon glyphicon-plus"></span>Thêm</a>
                    <a class="btn btn-info btn-sm" onclick="btnOnClick(this);" id="btnPrint">&nbsp;In <span class="glyphicon glyphicon-print"></span></a>

                    <form id="inDanhSachDonThuDHQHForm" role="form" action="{{url('inDanhSachDonThuDHQH')}}" method="post">
                        <input type="hidden" id="donThuData_inDanhSachDonThuDHQHForm" name="donThuData_inDanhSachDonThuDHQHForm" value="{{json_encode($results)}}">
                    </form>
                </div>
                <div class="col-xs-4">
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon">Trạng thái</span>
                        <select class="form-control" id="TTXL" onchange="">
                            <option value="0">Tất cả</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-left: 10px; padding-bottom: 10px">

                @foreach($results as $result)
                <div class="col-xs-6" style="padding-left: 0px;">
                    <?php

                    $sothuly = $result->sothuly;
                    $sothuly = explode('/',$sothuly);
                    $sothuly = implode('-',$sothuly);
                    if(strlen($result->noidung) > 150){

                        $new_noidung = substr($result->noidung,0,150).'...';
                    }else{
                        $new_noidung = $result->noidung;
                    }

                    ?>
                    <a href="{{url('/chitietdonthu/'.$result->donthuid)}}" class="donthuitem">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td class="col-xs-3 text-bold" style="border: 0;">Người viết đơn</td>
                                <td style="border: 0">{{mb_strtoupper($result->tennguoivietdon)}}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Địa chỉ</td>
                                <td>{{$result->diachinguoiviet}}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Ngày gửi</td>
                                <td>{{$result->ngayviet}}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Trạng thái</td>
                                @if($result->trangthaixuly == CHOXULY)
                                    <td>Chờ xử lý</td>
                                @elseif($result->trangthaixuly == DANGXULY)
                                    <td>Đang xử lý</td>
                                @elseif($result->trangthaixuly == DANGGIAIQUYET)
                                    <td>Đang giải quyết</td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                            <tr>
                                <td class="text-bold">Nội dung</td>
                                <td>{{$new_noidung}}</td>
                            </tr>
                            </tbody>
                        </table>

                    </a>
                </div>
                @endforeach
            </div>

            <div class="panel-body text-center">
                <ul class="pagination">
                    <li>
                        <span>Trang {{$results->currentPage().'/'.$results->lastPage()}}</span>
                    </li>
                    <li @if($results->currentPage() == 1) class="disabled" @endif>
                        <a @if($results->currentPage() != 1) href="{{$results->url(1)}}" @endif>
                            <<
                        </a>
                    </li>
                    <li @if($results->currentPage() == 1) class="disabled" @endif>
                        <a @if($results->currentPage() != 1) href="{{$results->previousPageUrl()}}" @endif>
                            <
                        </a>
                    </li>
                    <li class="active">
                        <span>{{$results->currentPage()}}</span>
                    </li>
                    <li @if($results->currentPage() == $results->lastPage()) class="disabled" @endif>
                        <a @if($results->currentPage() != $results->lastPage()) href="{{$results->nextPageUrl()}}" @endif>
                            >
                        </a>
                    </li>
                    <li @if($results->currentPage() == $results->lastPage()) class="disabled" @endif>

                        <a @if($results->currentPage() != $results->lastPage()) href="{{$results->url($results->lastPage())}}" @endif>
                            >>
                        </a>

                    </li>

                </ul>
            </div>
        </div>
    </div>

    <script>
        function btnOnClick(d)
        {
            switch (d.id)
            {
                case "btnPrint":
                    $( "#inDanhSachDonThuDHQHForm" ).submit();
                    break;
                default:
                    break;
            }
        }

    </script>

@endsection
