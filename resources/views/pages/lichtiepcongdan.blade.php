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

    <style type="text/css">
        a.MonthForSelect:hover { cursor: pointer; color: #000; }
    </style>

    <div id="lichtiepcongdan" class="panel panel-default panel-home">

        <div class="panel-heading">
            <i class="fa fa-calendar fa-lg" aria-hidden="true"></i>
            &nbsp;LỊCH TIẾP CÔNG DÂN NĂM
            <span id="namhientai">{{date('Y')}}</span>
        </div>
        <div style="padding: 10px 0">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <button type="submit" name="nam" value="13" id="nam" class="btn btn-info" onclick="getlichtiepdan(this.value)">
                        Năm
                    </button>
                </div>

                <div class="btn-group" role="group">
                    <button type="submit" name="thang1" value="1" id="thang1" class="btn btn-default" onclick="getlichtiepdan(this.value)">T1</button>
                </div>

                <div class="btn-group" role="group">
                    <button type="submit" name="thang2" value="2" id="thang2" class="btn btn-default" onclick="getlichtiepdan(this.value)">T2</button>
                </div>

                <div class="btn-group" role="group">
                    <button type="submit" name="thang3" value="3" id="thang3" class="btn btn-default" onclick="getlichtiepdan(this.value)">T3</button>
                </div>

                <div class="btn-group" role="group">
                    <button type="submit" name="thang4" value="4" id="thang4" class="btn btn-default" onclick="getlichtiepdan(this.value)">T4</button>
                </div>

                <div class="btn-group" role="group">
                    <button type="submit" name="thang5" value="5" id="thang5" class="btn btn-default" onclick="getlichtiepdan(this.value)">T5</button>
                </div>

                <div class="btn-group" role="group">
                    <button type="submit" name="thang6" value="6" id="thang6" class="btn btn-default" onclick="getlichtiepdan(this.value)">T6</button>
                </div>

                <div class="btn-group" role="group">
                    <button type="submit" name="thang7" value="7" id="thang7" class="btn btn-default" onclick="getlichtiepdan(this.value)">T7</button>
                </div>

                <div class="btn-group" role="group">
                    <button type="submit" name="thang8" value="8" id="thang8" class="btn btn-default" onclick="getlichtiepdan(this.value)">T8</button>
                </div>

                <div class="btn-group" role="group">
                    <button type="submit" name="thang9" value="9" id="thang9" class="btn btn-default" onclick="getlichtiepdan(this.value)">T9</button>
                </div>

                <div class="btn-group" role="group">
                    <button type="submit" name="thang10" value="10" id="thang10" class="btn btn-default" onclick="getlichtiepdan(this.value)">T10</button>
                </div>

                <div class="btn-group" role="group">
                    <button type="submit" name="thang11" value="11" id="thang11" class="btn btn-default" onclick="getlichtiepdan(this.value)">T11</button>
                </div>

                <div class="btn-group" role="group">
                    <button type="submit" name="thang12" value="12" id="thang12" class="btn btn-default" onclick="getlichtiepdan(this.value)">T12</button>
                </div>

            </div>
            <div id="updateprocess" class="text-center" style="display:none;margin-top: 10px">

                <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                <span class="sr-only">Đang tải...</span>

            </div>
        </div>

        <div id="banglichtiepdan">

            <table class="table table-bordered table-hover" style="border-collapse: collapse">
                <thead>
                <tr>
                    <th class="text-center col-xs-2">Ngày tiếp</th>
                    <th class="text-center col-xs-4">Người tiếp</th>
                    <th class="text-center col-xs-6">Địa điểm</th>
                </tr>
                </thead>
                <tbody>
                @if($lichtiepcongdandata['thang1'] != null)
                    <tr>
                        <td colspan="3" class="text-center"><b>Tháng 1</b></td>
                    </tr>
                    @foreach($lichtiepcongdandata['thang1'] as $thang1data)
                        <tr>
                            <td class="text-center">
                                {{$thang1data->ngaytiep}}
                            </td>
                            <td>
                                {{$thang1data->nguoitiep}}
                            </td>
                            <td>
                                {{$thang1data->diadiem}}
                            </td>
                        </tr>
                    @endforeach
                @endif

                @if($lichtiepcongdandata['thang2'] != null)
                    <tr>
                        <td colspan="3" class="text-center"><b>Tháng 2</b></td>
                    </tr>
                    @foreach($lichtiepcongdandata['thang2'] as $thang2data)
                        <tr>
                            <td class="text-center">
                                {{$thang2data->ngaytiep}}
                            </td>
                            <td>
                                {{$thang2data->nguoitiep}}
                            </td>
                            <td>
                                {{$thang2data->diadiem}}
                            </td>
                        </tr>
                    @endforeach
                @endif

                @if($lichtiepcongdandata['thang3'] != null)
                    <tr>
                        <td colspan="3" class="text-center"><b>Tháng 3</b></td>
                    </tr>
                    @foreach($lichtiepcongdandata['thang3'] as $thang3data)
                        <tr>
                            <td class="text-center">
                                {{$thang3data->ngaytiep}}
                            </td>
                            <td>
                                {{$thang3data->nguoitiep}}
                            </td>
                            <td>
                                {{$thang3data->diadiem}}
                            </td>
                        </tr>
                    @endforeach
                @endif

                @if($lichtiepcongdandata['thang4'] != null)
                    <tr>
                        <td colspan="3" class="text-center"><b>Tháng 4</b></td>
                    </tr>
                    @foreach($lichtiepcongdandata['thang4'] as $thang4data)
                        <tr>
                            <td class="text-center">
                                {{$thang4data->ngaytiep}}
                            </td>
                            <td>
                                {{$thang4data->nguoitiep}}
                            </td>
                            <td>
                                {{$thang4data->diadiem}}
                            </td>
                        </tr>
                    @endforeach
                @endif

                @if($lichtiepcongdandata['thang5'] != null)
                    <tr>
                        <td colspan="3" class="text-center"><b>Tháng 5</b></td>
                    </tr>
                    @foreach($lichtiepcongdandata['thang5'] as $thang5data)
                        <tr>
                            <td class="text-center">
                                {{$thang5data->ngaytiep}}
                            </td>
                            <td>
                                {{$thang5data->nguoitiep}}
                            </td>
                            <td>
                                {{$thang5data->diadiem}}
                            </td>
                        </tr>
                    @endforeach
                @endif

                @if($lichtiepcongdandata['thang6'] != null)
                    <tr>
                        <td colspan="3" class="text-center"><b>Tháng 6</b></td>
                    </tr>
                    @foreach($lichtiepcongdandata['thang6'] as $thang6data)
                        <tr>
                            <td class="text-center">
                                {{$thang6data->ngaytiep}}
                            </td>
                            <td>
                                {{$thang6data->nguoitiep}}
                            </td>
                            <td>
                                {{$thang6data->diadiem}}
                            </td>
                        </tr>
                    @endforeach
                @endif

                @if($lichtiepcongdandata['thang7'] != null)
                    <tr>
                        <td colspan="3" class="text-center"><b>Tháng 7</b></td>
                    </tr>
                    @foreach($lichtiepcongdandata['thang7'] as $thang7data)
                        <tr>
                            <td class="text-center">
                                {{$thang7data->ngaytiep}}
                            </td>
                            <td>
                                {{$thang7data->nguoitiep}}
                            </td>
                            <td>
                                {{$thang7data->diadiem}}
                            </td>
                        </tr>
                    @endforeach
                @endif

                @if($lichtiepcongdandata['thang8'] != null)
                    <tr>
                        <td colspan="3" class="text-center"><b>Tháng 8</b></td>
                    </tr>
                    @foreach($lichtiepcongdandata['thang8'] as $thang8data)
                        <tr>
                            <td class="text-center">
                                {{$thang8data->ngaytiep}}
                            </td>
                            <td>
                                {{$thang8data->nguoitiep}}
                            </td>
                            <td>
                                {{$thang8data->diadiem}}
                            </td>
                        </tr>
                    @endforeach
                @endif

                @if($lichtiepcongdandata['thang9'] != null)
                    <tr>
                        <td colspan="3" class="text-center"><b>Tháng 9</b></td>
                    </tr>
                    @foreach($lichtiepcongdandata['thang9'] as $thang9data)
                        <tr>
                            <td class="text-center">
                                {{$thang9data->ngaytiep}}
                            </td>
                            <td>
                                {{$thang9data->nguoitiep}}
                            </td>
                            <td>
                                {{$thang9data->diadiem}}
                            </td>
                        </tr>
                    @endforeach
                @endif

                @if($lichtiepcongdandata['thang10'] != null)
                    <tr>
                        <td colspan="3" class="text-center"><b>Tháng 10</b></td>
                    </tr>
                    @foreach($lichtiepcongdandata['thang10'] as $thang10data)
                        <tr>
                            <td class="text-center">
                                {{$thang10data->ngaytiep}}
                            </td>
                            <td>
                                {{$thang10data->nguoitiep}}
                            </td>
                            <td>
                                {{$thang10data->diadiem}}
                            </td>
                        </tr>
                    @endforeach
                @endif

                @if($lichtiepcongdandata['thang11'] != null)
                    <tr>
                        <td colspan="3" class="text-center"><b>Tháng 11</b></td>
                    </tr>
                    @foreach($lichtiepcongdandata['thang11'] as $thang11data)
                        <tr>
                            <td class="text-center">
                                {{$thang11data->ngaytiep}}
                            </td>
                            <td>
                                {{$thang11data->nguoitiep}}
                            </td>
                            <td>
                                {{$thang11data->diadiem}}
                            </td>
                        </tr>
                    @endforeach
                @endif

                @if($lichtiepcongdandata['thang12'] != null)
                    <tr>
                        <td colspan="3" class="text-center"><b>Tháng 12</b></td>
                    </tr>
                    @foreach($lichtiepcongdandata['thang12'] as $thang12data)
                        <tr>
                            <td class="text-center">
                                {{$thang12data->ngaytiep}}
                            </td>
                            <td>
                                {{$thang12data->nguoitiep}}
                            </td>
                            <td>
                                {{$thang12data->diadiem}}
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function getlichtiepdan(thang){

            if(thang == 13){

                window.location.reload(true);

            }else{

                $.ajax({
                    type: 'get',
                    url: '{{URL::to('selectlichtiepdantheothang')}}',
                    data: {
                        thang: thang
                    },
                    success: function (response) {
                        var ketqua = response['select_result'];
                        var soluongketqua = ketqua.length;
                        if(soluongketqua > 0){
                            document.getElementById("banglichtiepdan").innerHTML='';
                            var noidungketqua = '';

                            for (var i = 0; i < soluongketqua; i++) {
                                var ngaytiep = ketqua[i]['ngaytiep'];
                                var nguoitiep = ketqua[i]['nguoitiep'];
                                var diadiem = ketqua[i]['diadiem'];
                                var id = ketqua[i]['id'];

                                noidungketqua += '<tr>'+
                                        '<td>'+
                                        ngaytiep+
                                        '</td>'+
                                        '<td>'+
                                        nguoitiep+
                                        '</td>'+
                                        '<td>'+
                                        diadiem +
                                        '</td>'+
                                        '</tr>';
                            }
                            document.getElementById('banglichtiepdan').innerHTML = ''+
                                    '<table class="table table-bordered table-hover" style="border-collapse: collapse">'+
                                    '<thead>'+
                                    '<tr>'+
                                    '<th class="text-center col-xs-2">Ngày tiếp</th>'+
                                    '<th class="text-center col-xs-4">Người tiếp</th>'+
                                    '<th class="text-center col-xs-6">Địa điểm</th>'+
                                    '</tr>'+
                                    '</thead>'+
                                    '<tbody>'+
                                    '<td colspan="3" class="text-center"><b>Tháng '+thang+'</b></td>'+
                                    noidungketqua+
                                    '</tbody>'+
                                    '</table>';
                        }else {

                            document.getElementById('banglichtiepdan').innerHTML = '<div class="text-center"><span class="glyphicon glyphicon-ok text-success"></span>&nbsp;Không tìm thấy lịch tiếp dân nào !!!</div>';
                        }
                    }
                });

            }
        }
    </script>


@endsection