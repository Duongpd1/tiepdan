<?php
/****************************************************************
File Name       : home.blade.php
Description     : Header of home page
Creation Date   : 2016/06/10
Author          : FPT/KhanhTH
Change History  :
****************************************************************/
?>
@extends('layouts.tracuulayout')

@section('content')

    <div id="cphContent_ctl00_UpdatePanel1" class="panel panel-default panel-home">

        <div class="panel-heading">
            <i class="fa fa-list-alt fa-lg" aria-hidden="true"></i>
            Danh sách tiếp dân
        </div>
        <div class="panel-body">
            <div class="input-group input-group-sm">
                <span class="input-group-addon">Tìm kiếm</span>
                <input name="timkiemketquatiepdan" type="text" id="timkiemketquatiepdan" class="form-control" placeholder="Tìm tên công dân, số thụ lý..." />
                <span class="input-group-btn">
                    <button onclick="searchResult()" class="btn btn-sm">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </span>
            </div>
        </div>
        <div style="margin-top: 10px; margin-left: 40%">
            <label id="hienthithongbao" class="text-success"></label>
        </div>
        <div id="ketquatiepcongdan">
            <div class="ketqua-kntc">
                <ul>
                    @foreach($trangchudata['ketquatiepdan'] as $ketquatiepdan)
                        <li>
                            <p>
                                <label>Ngày tiếp: </label>
                                {{$ketquatiepdan->ngaytiep}}
                            </p>
                            <p>
                                <label>Lần tiếp: </label>
                                {{$ketquatiepdan->lantiep}}
                            </p>
                            <p>
                                <label>Người tiếp: </label>
                                {{$ketquatiepdan->lanhdao}}
                            </p>
                            <p>
                                <label>Tên công dân: </label>
                                {{$ketquatiepdan->congdan}}
                            </p>
                            <p class="detail">
                                <a href="{{url('/noidungketquatiepdan/'.$ketquatiepdan->tiepdanid)}}">Xem chi tiết »</a>
                            </p>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="panel-body text-center">
                <ul class="pagination">
                    <li>
                        <span>Trang {{$trangchudata['ketquatiepdan']->currentPage().'/'.$trangchudata['ketquatiepdan']->lastPage()}}</span>
                    </li>
                    <li @if($trangchudata['ketquatiepdan']->currentPage() == 1) class="disabled" @endif>
                        <a @if($trangchudata['ketquatiepdan']->currentPage() != 1) href="{{$trangchudata['ketquatiepdan']->url(1)}}" @endif>
                            <<
                        </a>
                    </li>
                    <li @if($trangchudata['ketquatiepdan']->currentPage() == 1) class="disabled" @endif>
                        <a @if($trangchudata['ketquatiepdan']->currentPage() != 1) href="{{$trangchudata['ketquatiepdan']->previousPageUrl()}}" @endif>
                            <
                        </a>
                    </li>
                    <li class="active">
                        <span>{{$trangchudata['ketquatiepdan']->currentPage()}}</span>
                    </li>
                    <li @if($trangchudata['ketquatiepdan']->currentPage() == $trangchudata['ketquatiepdan']->lastPage()) class="disabled" @endif>
                        <a @if($trangchudata['ketquatiepdan']->currentPage() != $trangchudata['ketquatiepdan']->lastPage()) href="{{$trangchudata['ketquatiepdan']->nextPageUrl()}}" @endif>
                            >
                        </a>
                    </li>
                    <li @if($trangchudata['ketquatiepdan']->currentPage() == $trangchudata['ketquatiepdan']->lastPage()) class="disabled" @endif>

                        <a @if($trangchudata['ketquatiepdan']->currentPage() != $trangchudata['ketquatiepdan']->lastPage()) href="{{$trangchudata['ketquatiepdan']->url($trangchudata['ketquatiepdan']->lastPage())}}" @endif>
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
    </div>

    <script>
        $('#timkiemketquatiepdan').on('keypress', function(e) {
            if(e.which == 13) {

                searchResult();
            }
        });

        function searchResult(){

            var value = document.getElementById('timkiemketquatiepdan').value;
            if(value != " ") {
                if (value.length > 0) {
                    $.ajax({
                        type: 'get',
                        url: '{{URL::to('searchketquatiepdan')}}',
                        data: {
                            keysearch: value
                        },
                        success: function (response) {
                            var ketqua = response['search_result'];
                            var soluongketqua = ketqua.length;
                            if(soluongketqua > 0){
                                document.getElementById('ketquatiepcongdan').innerHTML = '';

                                var noidungtiepdan = '';

                                for (var i = 0; i < soluongketqua; i++) {
                                    var ngaytiep = ketqua[i]['ngaytiep'];
                                    var lantiep = ketqua[i]['lantiep'];
                                    var lanhdao = ketqua[i]['lanhdao'];
                                    var congdan = ketqua[i]['congdan'];
                                    var id = ketqua[i]['tiepdanid'];
                                    var noidungketquatiepdanurl = <?php echo json_encode(url('/noidungketquatiepdan')); ?>;
                                    var ketquatiepdandanurl = <?php echo json_encode(url('/ketquatiepdan')); ?>;
                                    var xemchitiet = '' +
                                            '<a href="'+noidungketquatiepdanurl+'/'+id+'">Xem chi tiết »</a>' +
                                            '';

                                    noidungtiepdan += '' +
                                            '<li>' +
                                            '<p>' +
                                            '<label>Ngày tiếp:&nbsp; </label>' +
                                            ngaytiep +
                                            '</p>' +
                                            '<p>' +
                                            '<label>Lần tiếp:&nbsp; </label>' +
                                            lantiep +
                                            '</p>' +
                                            '<p>' +
                                            '<label>Người tiếp:&nbsp; </label>' +
                                            lanhdao +
                                            '</p>' +
                                            '<p>' +
                                            '<label>Tên công dân:&nbsp; </label>' +
                                            congdan +
                                            '</p>' +
                                            '<p class="detail">' +
                                            xemchitiet +
                                            '</p>' +
                                            '</li>' +
                                            '';
                                }

                                document.getElementById('ketquatiepcongdan').innerHTML = '' +
                                        '<div id="ketquatiepcongdan">' +
                                        '<div class="ketqua-kntc">' +
                                        '<ul>' +
                                            noidungtiepdan +
                                        '</ul>' +
                                        '</div>' +
                                        '<a href="'+ketquatiepdandanurl+'" class="btn btn-xs btn-danger">'+
                                        '<span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Trở lại'+
                                        '</a>'+
                                        '</div>' +
                                        '';
                            }
                            document.getElementById('hienthithongbao').innerHTML = 'Tìm thấy ' + soluongketqua + ' kết quả';
                        }
                    });
                }
                else {
                    $("#result").html("");
                }
            }
        }

    </script>

@endsection