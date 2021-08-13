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
    <script>
        //document.getElementById("htab-danhmuc").style.display = 'block';
        var element1 = document.getElementById("dstcd");
        element1.classList.add("active");
        var element = document.getElementById("htab-tiepdan");
        element.classList.add("active");
        element.classList.add("in");

    </script>

    <?php

        $quyenXoa = Session::get('quyenXoa');

        function convertNgay($ngayTuDatabase){
            $ngayExplore = explode('-',$ngayTuDatabase);
            $ngay = $ngayExplore[2];
            $thang = $ngayExplore[1];
            $nam = $ngayExplore[0];
            return $ngay.'/'.$thang.'/'.$nam;
        }
        $currentChonSoLuongHienThi = Session::get('soLuongHienThi_TabTiepDan');
    ?>

    <div id="donthu" class="col-background" style="margin-bottom: 100px;">
        <div class="panel panel-default">
            <div class="panel-heading text-center">DANH SÁCH TIẾP CÔNG DÂN</div>
            <div class="row" style="margin: 10px 0;">
                <div class="col-xs-11">
                    <a role="button" href="{{url('/themdanhsachtiepcongdan')}}" class="btn btn-success btn-sm" title="tạo danh sách tiếp dân" id="btnThem"><span class="glyphicon glyphicon-plus"></span>Thêm</a>
                    <a class="btn btn-info btn-sm" href="{{url('/inDanhSachTiepCongDan')}}"><span class="glyphicon glyphicon-print"></span> &nbsp;In</a>
                </div>
            </div>
            <div class="row" style="padding-left: 10px;padding-bottom: 10px;">
                <?php $countketqua = 0; ?>
                @foreach($ketquatiepdan as $ketqua)
                <div class="col-xs-6" style="padding-left: 0px">
                    <a class="donthuitem" onclick="xemDonThu({{$ketqua->tiepdanid}})">
                        <table class="table" >
                            <tbody>
                            <tr>
                                <td class="col-xs-3 text-bold" style="border: 0;"> Ngày tiếp</td>
                                <td colspan="2" style="border: 0;">{{convertNgay($ketqua->ngaytiep)}}</td>
                                <td class="text-right" style="border: 0;">
                                    <a type="button" href="{{url('noidungdanhsachtiepcongdan/'.$ketqua->tiepdanid)}}" title="Xem" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-eye-open"></span></a>
                                    <a type="button" href="{{url('chinhsuadanhsachtiepcongdan/'.$ketqua->tiepdanid)}}" title="Sửa" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                                @if(($quyenXoa & DELTIEPDAN)== DELTIEPDAN)
                                    <button type="button" onclick="xoadanhsachtiepdan(this.id)" id="{{$ketqua->tiepdanid}}" title="Sửa" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-bold">Lần tiếp</td>
                                <td colspan="3">Lần {{$ketqua->lantiep}}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Người tiếp dân</td>
                                <td colspan="3">{{mb_strtoupper($ketqua->lanhdao)}}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Tên công dân</td>
                                <td colspan="3">{{mb_strtoupper($ketqua->congdan)}}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Địa chỉ</td>
                                <td colspan="3">{{$ketqua->diachi}}</td>
                            </tr>
                            <tr>
                                <td class="col-xs-3 text-bold">Chủ thể</td>
                                <td class="col-xs-3 ">
                                    @if($ketqua->chuthe == 1)
                                        Cá nhân
                                    @else
                                        Tập thể
                                    @endif
                                </td>
                                <td class="col-xs-3 text-bold text-right" style="padding-right: 10px">Lĩnh vực</td>
                                <td class="col-xs-3 ">{{$tenlinhvuc[$countketqua]}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </a>
                </div>
                <?php $countketqua++; ?>
                @endforeach
            </div>
            <div class="panel-body text-center">
                <ul class="pagination">
                    <li>
                        <span>Trang {{$ketquatiepdan->currentPage().'/'.$ketquatiepdan->lastPage()}}</span>
                    </li>
                    <li @if($ketquatiepdan->currentPage() == 1) class="disabled" @endif>
                        <a @if($ketquatiepdan->currentPage() != 1) href="{{$ketquatiepdan->url(1)}}" @endif>
                            <<
                        </a>
                    </li>
                    <li @if($ketquatiepdan->currentPage() == 1) class="disabled" @endif>
                        <a @if($ketquatiepdan->currentPage() != 1) href="{{$ketquatiepdan->previousPageUrl()}}" @endif>
                            <
                        </a>
                    </li>
                    <li class="active">
                        <span>{{$ketquatiepdan->currentPage()}}</span>
                    </li>
                    <li @if($ketquatiepdan->currentPage() == $ketquatiepdan->lastPage()) class="disabled" @endif>
                        <a @if($ketquatiepdan->currentPage() != $ketquatiepdan->lastPage()) href="{{$ketquatiepdan->nextPageUrl()}}" @endif>
                            >
                        </a>
                    </li>
                    <li @if($ketquatiepdan->currentPage() == $ketquatiepdan->lastPage()) class="disabled" @endif>

                        <a @if($ketquatiepdan->currentPage() != $ketquatiepdan->lastPage()) href="{{$ketquatiepdan->url($ketquatiepdan->lastPage())}}" @endif>
                            >>
                        </a>

                    </li>
                    <li>
                        <p style="margin-left: 15px;display: inline">Hiển thị:
                            <select id="hienthi" class="form-control" style="width: auto;display: inline;" onchange="chonHienThiSoLuong(this.value)">

                                @if(HIENTHI_10ITEMS == $currentChonSoLuongHienThi)
                                    <option value="10" selected="selected">10</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                @elseif(HIENTHI_50ITEMS == $currentChonSoLuongHienThi)
                                    <option value="10">10</option>
                                    <option value="50" selected="selected">50</option>
                                    <option value="100">100</option>
                                @elseif(HIENTHI_100ITEMS == $currentChonSoLuongHienThi)
                                    <option value="10">10</option>
                                    <option value="50">50</option>
                                    <option value="100" selected="selected">100</option>
                                @endif
                            </select>
                            dòng
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        function xoadanhsachtiepdan(id){

            var confirmdeletecontent = confirm('Bạn có muốn xóa danh sách này không?');

            if (confirmdeletecontent) {
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url:  '{{URL::to('xoadanhsachtiepdan')}}',
                    data: {
                        tiepdanid: id
                    },
                    success: function (response) {
//                        alert(response['xoabaiviet_result']);
                        window.location.reload(true);
                    }
                });
            }
        }

        function  xemDonThu(id){

            var noidungdanhsachtiepcongdan_url = <?php echo json_encode(url('noidungdanhsachtiepcongdan')); ?>;
            window.location.href = noidungdanhsachtiepcongdan_url+'/'+id;
        }

        function chonHienThiSoLuong(valueChon){

            var danhSachTiepCongDanUrl = <?php echo json_encode(url('danhsachtiepcongdan')) ;?>;

            $.ajax({
                type: 'post',
                dataType: 'json',
                url:  '{{URL::to('chonHienThiSoLuongTiepDan')}}',
                data: {
                    valueChon: valueChon
                },
                success: function (response) {

//                    console.log(response);
                    window.location.href = danhSachTiepCongDanUrl;

                }
            });

        }
    </script>

@endsection
