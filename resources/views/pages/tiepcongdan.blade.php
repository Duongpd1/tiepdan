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
        var element1 = document.getElementById("ltd");
        element1.classList.add("active");
        var element = document.getElementById("htab-tiepdan");
        element.classList.add("active");
        element.classList.add("in");

    </script>
    <?php
            //print_r($lanhdao);
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

    <div id="ctl00_ctl00_updateGrvDonThu" class="col-background">

        <div class="panel panel-default panel-min-height">
            <div class="panel-heading text-center">
                DANH SÁCH LỊCH TIẾP DÂN
            </div>
            <div class="panel-body">
                <div class="col-xs-5" style="padding-left: 0">
                    <a role="button" href="{{url('/themtiepcongdan')}}" class="btn btn-success btn-sm" title="tạo đơn" id="btnThem"><span class="glyphicon glyphicon-plus"></span>Thêm</a>
                    <a type="button" href="{{url('inLichTiepDan')}}" title="In" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-print"></span>&nbsp;In</a>
                </div>
                <div style="margin: 0 0 0 0; padding-right: 8px" class="input-group input-group-sm col-xs-7">
                    <span class="input-group-addon">Người Tiếp:</span>
                    <select name="nguoitiep" id = "nguoitiep" class="form-control" onchange="getlichtiepdantheolanhdao(this.value)">
                        <option value="all">Tất cả</option>
                        @for($i = 0;$i<count($lanhdao);$i++)
                        <option value="{{$lanhdao[$i]}}">{{$lanhdao[$i]}}</option>
                        @endfor
                    </select>
                    <span class="input-group-addon">Tháng: </span>
                    <select name="thang" id="thang" class="form-control" style="border-right: none" onchange="getlichtiepcongdantheothang(this.value)">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option selected="selected" value="13">Tất cả </option>
                    </select>
                    <span style="border-right: none" class="input-group-addon">Năm: </span>
                    <?php $nam = date('Y'); ?>
                    <select name="nam" id="nam" class="form-control" onchange="">
                        {{--<option value="{{$nam-1}}">{{$nam-1}}</option>--}}
                        <option selected="selected" value="{{$nam}}">{{$nam}}</option>
                        {{--<option value="{{$nam+1}}">{{$nam+1}}</option>--}}
                    </select>
                </div>
            </div>
            <div id="banglichtiep">
                <table class="table table-bordered table-hover" style="border-collapse: collapse">
                    <thead>
                        <tr>
                            <th class="col-xs-1 text-center">Ngày Tiếp</th>
                            <th class="col-xs-3 text-center">Người tiếp</th>
                            <th class="col-xs-2 text-center">Chức Vụ</th>
                            <th class="col-xs-4 text-center">Địa điểm</th>
                            <th class="col-xs-1 text-center">Đột xuất</th>
                            <th class="col-xs-1 text-center">Xử lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($getlichtiepdan as $baiviet)
                            <tr id="lichtiep{{$baiviet->id}}">
                                <td>{{convertNgay($baiviet->ngaytiep)}}</td>
                                <td>{{$baiviet->nguoitiep}}</td>
                                <td>{{$baiviet->chucvu}}</td>
                                <td>{{$baiviet->diadiem}}</td>

                                @if($baiviet->dotxuat == DOTXUAT)
                                    <td class="text-center"><span class='glyphicon glyphicon-ok text-success'></span></td>
                                @else
                                    <td class="text-center"><span class='glyphicon glyphicon-ban-circle text-danger'></span></td>
                                @endif
                                <td class="text-center">
                                    <a role="button" href="{{url('chinhsuatiepcongdan/'.$baiviet->id)}}"  title="Chỉnh sửa lịch tiếp dân" class="btn btn-xs btn-success">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </a>
                                 @if(($quyenXoa & DELTIEPDAN)== DELTIEPDAN)
                                    <button type="submit" value="{{$baiviet->id}}" onclick="confirmxoabaiviet(this.value)" title="Xóa lịch tiếp dân" class="btn btn-xs btn-danger">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </button>
                                 @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="panel-body text-center">
                    <ul class="pagination">
                        <li>
                            <span>Trang {{$getlichtiepdan->currentPage().'/'.$getlichtiepdan->lastPage()}}</span>
                        </li>
                        <li @if($getlichtiepdan->currentPage() == 1) class="disabled" @endif>
                            <a @if($getlichtiepdan->currentPage() != 1) href="{{$getlichtiepdan->url(1)}}" @endif>
                                <<
                            </a>
                        </li>
                        <li @if($getlichtiepdan->currentPage() == 1) class="disabled" @endif>
                            <a @if($getlichtiepdan->currentPage() != 1) href="{{$getlichtiepdan->previousPageUrl()}}" @endif>
                                <
                            </a>
                        </li>
                        <li class="active">
                            <span>{{$getlichtiepdan->currentPage()}}</span>
                        </li>
                        <li @if($getlichtiepdan->currentPage() == $getlichtiepdan->lastPage()) class="disabled" @endif>
                            <a @if($getlichtiepdan->currentPage() != $getlichtiepdan->lastPage()) href="{{$getlichtiepdan->nextPageUrl()}}" @endif>
                                >
                            </a>
                        </li>
                        <li @if($getlichtiepdan->currentPage() == $getlichtiepdan->lastPage()) class="disabled" @endif>

                            <a @if($getlichtiepdan->currentPage() != $getlichtiepdan->lastPage()) href="{{$getlichtiepdan->url($getlichtiepdan->lastPage())}}" @endif>
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

    <script>

        function convertNgay(ngayTuDatabase){

            var ngayTuDatabaseArray =  ngayTuDatabase.split("-");
            var ngay = ngayTuDatabaseArray[2];
            var thang = ngayTuDatabaseArray[1];
            var nam = ngayTuDatabaseArray[0];

            return ngay+"-"+thang+"-"+nam;
        }


        function confirmxoabaiviet(id){

            var confirmdeletecontent = confirm('Bạn có muốn xóa lịch tiếp dân này không?');

            if (confirmdeletecontent) {
                document.getElementById("lichtiep" + id).style.display = 'none';
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url:  '{{URL::to('xoalichtiepdan')}}',
                    data: {
                        lichtiepid: id
                    },
                    success: function (response) {
//                        alert(response['xoalichtiepdan_result']);
                    }
                });
            }
        }

        function getlichtiepcongdantheothang(thang){

            if(thang != 13) {
                var nam = document.getElementById('nam').value;
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '{{URL::to('getlichtiepdantheothang')}}',
                    data: {
                        thang: thang,
                        nam: nam
                    },
                    success: function (response) {

                        var ketqua = response['lichtiepdan_result'];
                        var soluongketqua = ketqua.length;
                        if (soluongketqua > 0) {
                            document.getElementById('banglichtiep').innerHTML = '';
                            var noidungketqua = '';
                            var lichtiepurl = <?php echo json_encode(url('/chinhsuatiepcongdan')); ?>;
                            for (var i = 0; i < soluongketqua; i++) {
                                var ngaytiep = convertNgay(ketqua[i]['ngaytiep']);
                                var nguoitiep = ketqua[i]['nguoitiep'];
                                var diadiem = ketqua[i]['diadiem'];
                                var dotxuat = ketqua[i]['dotxuat'];
                                var id = ketqua[i]['id'];
                                var noidungdotxuat = '';
                                if (dotxuat == 1) {

                                    noidungdotxuat = '<td class="text-center"><span class="glyphicon glyphicon-ok text-success"></span></td>';

                                } else {

                                    noidungdotxuat = '<td class="text-center"><span class="glyphicon glyphicon-ban-circle text-danger"></span></td>';

                                }

                                noidungketqua += '<tr>' +
                                        '<td>' +
                                        ngaytiep +
                                        '</td>' +
                                        '<td>' +
                                        nguoitiep +
                                        '</td>' +
                                        '<td>' +
                                        diadiem +
                                        '</td>' +
                                        noidungdotxuat +
                                        '<td class="text-center">' +
                                        '<a role="button" href="' + lichtiepurl + '/' + id + '" title="Chỉnh sửa lịch tiếp dân" class="btn btn-xs btn-success">' +
                                        '<span class="glyphicon glyphicon-edit" aria-hidden="true">' +
                                        '</span>' +
                                        '</a>' + '&nbsp' +
                                        '<button type="submit" value="' + id + '" onclick="confirmxoabaiviet(this.value)" title="Xóa lịch tiếp dân" class="btn btn-xs btn-danger">' +
                                        '<span class="glyphicon glyphicon-trash" aria-hidden="true">' +
                                        '</span>' +
                                        '</button>' +
                                        '</td>' +
                                        '</tr>';
                            }
                            document.getElementById('banglichtiep').innerHTML = '' +
                                    '<table class="table table-bordered table-hover" style="border-collapse: collapse">' +
                                    '<thead>' +
                                    '<tr>' +
                                    '<th class="text-center col-xs-1">Ngày Tiếp</th>' +
                                    '<th class="text-center col-xs-3">Người tiếp</th>' +
                                    '<th class="text-center col-xs-6">Địa điểm</th>' +
                                    '<th class="text-center col-xs-1">Đột xuất</th>' +
                                    '<th class="col-xs-1">Xử Lý</th>' +
                                    '</tr>' +
                                    '</thead>' +
                                    '<tbody>' +
                                    noidungketqua +
                                    '</tbody>' +
                                    '</table>';
                        }else {

                            document.getElementById('banglichtiep').innerHTML = '<div class="text-center"><span class="glyphicon glyphicon-ok text-success"></span>&nbsp;Không tìm thấy lịch tiếp dân nào !!!</div>';
                        }

                        $("#nguoitiep").val('all');
                    }
                });
            }else {

                window.location.reload(true);
            }
        }

        //get lich tiep dan theo lanh dao
        function getlichtiepdantheolanhdao(lanhdao)
        {
            if (lanhdao != "all")
            {
                var nam = document.getElementById('nam').value;
                $.ajax({
                    type: 'post',
                    //dataType: 'json',
                    url: '{{URL::to('getlichtiepdantheolanhdao')}}',
                    data: {
                        name: lanhdao,
                        nam: nam
                    },
                    success: function (response) {

                        console.log(response);
                       // var ketqua = response['lichtiepdan_result'];
                        var soluongketqua = response.length;
                        if (soluongketqua > 0) {
                            document.getElementById('banglichtiep').innerHTML = '';
                            var noidungketqua = '';
                            var lichtiepurl = <?php echo json_encode(url('/chinhsuatiepcongdan')); ?>;
                            for (var i = 0; i < soluongketqua; i++) {
                                var ngaytiep = convertNgay(response[i]['ngaytiep']);
                                var nguoitiep = response[i]['nguoitiep'];
                                var diadiem = response[i]['diadiem'];
                                var dotxuat = response[i]['dotxuat'];
                                var id = response[i]['id'];
                                var noidungdotxuat = '';
                                if (dotxuat == 1) {

                                    noidungdotxuat = '<td class="text-center"><span class="glyphicon glyphicon-ok text-success"></span></td>';

                                } else {

                                    noidungdotxuat = '<td class="text-center"><span class="glyphicon glyphicon-ban-circle text-danger"></span></td>';

                                }

                                noidungketqua += '<tr>' +
                                        '<td>' +
                                        ngaytiep +
                                        '</td>' +
                                        '<td>' +
                                        nguoitiep +
                                        '</td>' +
                                        '<td>' +
                                        diadiem +
                                        '</td>' +
                                        noidungdotxuat +
                                        '<td class="text-center">' +
                                        '<a role="button" href="' + lichtiepurl + '/' + id + '" title="Chỉnh sửa lịch tiếp dân" class="btn btn-xs btn-success">' +
                                        '<span class="glyphicon glyphicon-edit" aria-hidden="true">' +
                                        '</span>' +
                                        '</a>' + '&nbsp' +
                                        '<button type="submit" value="' + id + '" onclick="confirmxoabaiviet(this.value)" title="Xóa lịch tiếp dân" class="btn btn-xs btn-danger">' +
                                        '<span class="glyphicon glyphicon-trash" aria-hidden="true">' +
                                        '</span>' +
                                        '</button>' +
                                        '</td>' +
                                        '</tr>';
                            }
                            document.getElementById('banglichtiep').innerHTML = '' +
                                    '<table class="table table-bordered table-hover" style="border-collapse: collapse">' +
                                    '<thead>' +
                                    '<tr>' +
                                    '<th class="text-center col-xs-1">Ngày Tiếp</th>' +
                                    '<th class="text-center col-xs-3">Người tiếp</th>' +
                                    '<th class="text-center col-xs-6">Địa điểm</th>' +
                                    '<th class="text-center col-xs-1">Đột xuất</th>' +
                                    '<th class="col-xs-1">Xử Lý</th>' +
                                    '</tr>' +
                                    '</thead>' +
                                    '<tbody>' +
                                    noidungketqua +
                                    '</tbody>' +
                                    '</table>';
                        }else {

                            document.getElementById('banglichtiep').innerHTML = '<div class="text-center"><span class="glyphicon glyphicon-ok text-success"></span>&nbsp;Không tìm thấy lịch tiếp dân nào !!!</div>';
                        }

                        $("#thang").val(13);

                    }
                });
            }
            else
            {
                window.location.reload(true);
            }

        }

        function chonHienThiSoLuong(valueChon){

            var tiepCongDanUrl = <?php echo json_encode(url('tiepcongdan')) ;?>;

            $.ajax({
                type: 'post',
                dataType: 'json',
                url:  '{{URL::to('chonHienThiSoLuongTiepDan')}}',
                data: {
                    valueChon: valueChon
                },
                success: function (response) {

//                    console.log(response);
                    window.location.href = tiepCongDanUrl;

                }
            });

        }

    </script>

@endsection
