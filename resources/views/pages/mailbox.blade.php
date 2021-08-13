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

    if(Session::has('chonHopThu')){


    } else {

        Session::put('chonHopThu', HOPTHUDEN);
    }

    $currentaccount = Session::get('accountid');
    $currentChonSoLuongHienThi = Session::get('chonHienThiSoLuong');
    $currentHopThu = Session::get('chonHopThu');

    if($mailbox_owner != $currentaccount){
        $dangnhappage = url('/mailbox/'.$currentaccount);
        header('Location:'.$dangnhappage);
        exit();
    }

    ?>

    <div id="donthu" class="col-background" style="margin-bottom: 100px;">
        <ul class="nav nav-pills" id="ulHopThu">
            @if(HOPTHUDEN == $currentHopThu)
                <li class="active" onclick="chonHopThu(this.id)" id="tabHopThuDen"><a data-toggle="pill" href="#hopthuden">Hộp thư đến ({{$soLuongMailHopThuDen}})</a></li>
                <li onclick="chonHopThu(this.id)" id="tabHopThuDi"><a data-toggle="pill" href="#hopthudi">Thư đã gửi ({{$soLuongMailHopThuDi}})</a></li>
            @else
                <li onclick="chonHopThu(this.id)" id="tabHopThuDen"><a data-toggle="pill" href="#hopthuden">Hộp thư đến ({{$soLuongMailHopThuDen}})</a></li>
                <li class="active" onclick="chonHopThu(this.id)" id="tabHopThuDi"><a data-toggle="pill" href="#hopthudi">Thư đã gửi ({{$soLuongMailHopThuDi}})</a></li>
            @endif
        </ul>
        <div class="tab-content">
            @if(HOPTHUDEN == $currentHopThu)
            <div id="hopthuden" class="tab-pane fade in active">
            @else
            <div id="hopthuden" class="tab-pane fade">
            @endif
                <div class="panel panel-default" style="margin-top: 10px">
                    <div class="panel-heading text-center">HỘP THƯ ĐẾN</div>
                    <div class="row" style="margin: 10px 0;">
                        <div class="col-xs-8">
                            <a role="button" href="{{url('/taothuguidi')}}" class="btn btn-success btn-sm" title="tạo thư mới" id="btnThem"><span class="glyphicon glyphicon-plus"></span> Soạn thư</a>
                        </div>
                    </div>
                    <div class="row" style="padding-left: 10px;padding-bottom: 10px;">
                        <?php $countketqua = 0; ?>
                        @foreach($hopthudendata as $hopthuden)
                        <div class="col-xs-6" style="padding-left: 0px">
                            <a class="hopthuden">
                                <table class="table" id="hopThuDenTable">
                                    <tbody>
                                    <tr>
                                        <td class="col-xs-3 text-bold" style="border: 0;">Người gửi</td>
                                        <td colspan="2" style="border: 0;">{{$hopthuden->nguoigui}}</td>
                                        <td class="text-right" style="border: 0;">
                                            @if($hopthuden->trangthai == CHUADOC)
                                                <img src="{{url('/img/new_mail.png')}}" width="50" height="25">
                                            @endif
                                            <a type="button" href="{{url('noidungemail/'.$hopthuden->id)}}" title="Xem" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-eye-open"></span></a>
                                            <button type="button" onclick="xoamailboxtheoid(this.id)" id="{{$hopthuden->id}}" title="Sửa" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Ngày gửi</td>
                                        <td colspan="3">{{$hopthuden->ngaygui}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Chủ Đề</td>
                                        <td colspan="3"><strong style="color: red">{{$hopthuden->tieude}}</strong></td>
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
                                <span>Trang {{$hopthudendata->currentPage().'/'.$hopthudendata->lastPage()}}</span>
                            </li>
                            <li @if($hopthudendata->currentPage() == 1) class="disabled" @endif>
                                <a @if($hopthudendata->currentPage() != 1) href="{{$hopthudendata->url(1)}}" @endif>
                                    <<
                                </a>
                            </li>
                            <li @if($hopthudendata->currentPage() == 1) class="disabled" @endif>
                                <a @if($hopthudendata->currentPage() != 1) href="{{$hopthudendata->previousPageUrl()}}" @endif>
                                    <
                                </a>
                            </li>
                            <li class="active">
                                <span>{{$hopthudendata->currentPage()}}</span>
                            </li>
                            <li @if($hopthudendata->currentPage() == $hopthudendata->lastPage()) class="disabled" @endif>
                                <a @if($hopthudendata->currentPage() != $hopthudendata->lastPage()) href="{{$hopthudendata->nextPageUrl()}}" @endif>
                                    >
                                </a>
                            </li>
                            <li @if($hopthudendata->currentPage() == $hopthudendata->lastPage()) class="disabled" @endif>

                                <a @if($hopthudendata->currentPage() != $hopthudendata->lastPage()) href="{{$hopthudendata->url($hopthudendata->lastPage())}}" @endif>
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

            @if(HOPTHUDEN == $currentHopThu)
                <div id="hopthudi" class="tab-pane fade">
            @else
                <div id="hopthudi" class="tab-pane fade in active">
            @endif
                <div class="panel panel-default" style="margin-top: 10px">
                    <div class="panel-heading text-center">THƯ ĐÃ GỬI</div>
                    <div class="row" style="margin: 10px 0;">
                        <div class="col-xs-8">
                            <a role="button" href="{{url('/taothuguidi')}}" class="btn btn-success btn-sm" title="tạo thư mới" id="btnThem"><span class="glyphicon glyphicon-plus"></span> Soạn thư</a>
                        </div>
                    </div>
                    <div class="row" style="padding-left: 10px;padding-bottom: 10px;">
                        <?php $countketqua = 0; ?>
                        @foreach($hopthudidata as $hopthudi)
                            <div class="col-xs-6" style="padding-left: 0px">
                                <a class="hopthuden">
                                    <table class="table" id="hopThuDiTable">
                                        <tbody>
                                        <tr>
                                            <td class="col-xs-3 text-bold" style="border: 0;">Người nhận</td>
                                            <td colspan="2" style="border: 0;">{{$hopthudi->nguoinhan}}</td>
                                            <td class="text-right" style="border: 0;">
                                                <a type="button" href="{{url('noidungemail/'.$hopthudi->id)}}" title="Xem" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-eye-open"></span></a>
                                                <button type="button" onclick="xoamailboxtheoid(this.id)" id="{{$hopthudi->id}}" title="Sửa" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold">Ngày gửi</td>
                                            <td colspan="3">{{$hopthudi->ngaygui}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold">Chủ Đề</td>
                                            <td colspan="3"><strong style="color: red">{{$hopthudi->tieude}}</strong></td>
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
                                <span>Trang {{$hopthudidata->currentPage().'/'.$hopthudidata->lastPage()}}</span>
                            </li>
                            <li @if($hopthudidata->currentPage() == 1) class="disabled" @endif>
                                <a @if($hopthudidata->currentPage() != 1) href="{{$hopthudidata->url(1)}}" @endif>
                                    <<
                                </a>
                            </li>
                            <li @if($hopthudidata->currentPage() == 1) class="disabled" @endif>
                                <a @if($hopthudidata->currentPage() != 1) href="{{$hopthudidata->previousPageUrl()}}" @endif>
                                    <
                                </a>
                            </li>
                            <li class="active">
                                <span>{{$hopthudidata->currentPage()}}</span>
                            </li>
                            <li @if($hopthudidata->currentPage() == $hopthudidata->lastPage()) class="disabled" @endif>
                                <a @if($hopthudidata->currentPage() != $hopthudidata->lastPage()) href="{{$hopthudidata->nextPageUrl()}}" @endif>
                                    >
                                </a>
                            </li>
                            <li @if($hopthudidata->currentPage() == $hopthudidata->lastPage()) class="disabled" @endif>

                                <a @if($hopthudidata->currentPage() != $hopthudidata->lastPage()) href="{{$hopthudidata->url($hopthudidata->lastPage())}}" @endif>
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
        </div>
    </div>

    <script>

        function xoamailboxtheoid(id){

            var confirmdeletecontent = confirm('Bạn có muốn xóa thư này không?');

            if (confirmdeletecontent) {
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url:  '{{URL::to('xoamailboxtheoid')}}',
                    data: {
                        mailid: id
                    },
                    success: function (response) {
//                        alert(response['xoabaiviet_result']);
                        window.location.reload(true);
                    }
                });
            }
        }

        function chonHienThiSoLuong(valueChon){

            var mailBoxUrl = <?php echo json_encode(url('/mailbox/'.Session::get('accountid'))) ;?>;

            $.ajax({
                type: 'post',
                dataType: 'json',
                url:  '{{URL::to('chonHienThiSoLuong')}}',
                data: {
                    valueChon: valueChon
                },
                success: function (response) {

//                    console.log(response);
                    window.location.href = mailBoxUrl;

                }
            });

        }

        function chonHopThu(chonHopThu){

            if('tabHopThuDen' == chonHopThu) {
                $('#tabHopThuDen').addClass('active');
                $('#hopthuden').addClass('in active');
                $('#tabHopThuDi').removeClass('active');
                $('#hopthudi').removeClass('in active');
            }else {
                $('#tabHopThuDi').addClass('active');
                $('#hopthudi').addClass('in active');
                $('#tabHopThuDen').removeClass('active');
                $('#hopthuden').removeClass('in active');

            }

            $.ajax({
                type: 'post',
                dataType: 'json',
                url:  '{{URL::to('chonHopThu')}}',
                data: {
                    chonHopThu: chonHopThu
                },
                success: function (response) {

                }
            });


        }
    </script>

@endsection
