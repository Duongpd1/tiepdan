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
            <i class="fa fa-file-text fa-lg" aria-hidden="true"></i>
            &nbsp;VĂN BẢN
        </div>
        <div class="panel-body">
            <div class="input-group input-group-sm">
                <span class="input-group-addon">Tìm kiếm</span>
                <input name="timkiemvanban" type="text" id="timkiemvanban" class="form-control" placeholder="Số hiệu" />
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
        <div id="bangvanban">
            <table class="table table-bordered table-hover" style="border-collapse: collapse">
                <thead>
                <tr>
                    <th class="text-center col-md-2">Số hiệu</th>
                    <th class="text-center col-md-2">Ngày ký</th>
                    <th class="text-center col-md-9">Trích dẫn</th>
                </tr>
                </thead>
                <tbody>
                @foreach($trangchudata['vanbanphapluat'] as $vanbanphapluat)
                <tr>
                    <td>
                        {{$vanbanphapluat->sohieu}}
                    </td>
                    <td>
                        {{$vanbanphapluat->ngaybanhanh}}
                    </td>
                    <td>
                        <a href="{{url('/vanbanphapluat/'.$vanbanphapluat->id)}}">
                            <?php echo $vanbanphapluat->trichdan; ?>
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

            <div class="panel-body text-center">
                <ul class="pagination">
                    <li>
                        <span>Trang {{$trangchudata['vanbanphapluat']->currentPage().'/'.$trangchudata['vanbanphapluat']->lastPage()}}</span>
                    </li>
                    <li @if($trangchudata['vanbanphapluat']->currentPage() == 1) class="disabled" @endif>
                        <a @if($trangchudata['vanbanphapluat']->currentPage() != 1) href="{{$trangchudata['vanbanphapluat']->url(1)}}" @endif>
                            <<
                        </a>
                    </li>
                    <li @if($trangchudata['vanbanphapluat']->currentPage() == 1) class="disabled" @endif>
                        <a @if($trangchudata['vanbanphapluat']->currentPage() != 1) href="{{$trangchudata['vanbanphapluat']->previousPageUrl()}}" @endif>
                            <
                        </a>
                    </li>
                    <li class="active">
                        <span>{{$trangchudata['vanbanphapluat']->currentPage()}}</span>
                    </li>
                    <li @if($trangchudata['vanbanphapluat']->currentPage() == $trangchudata['vanbanphapluat']->lastPage()) class="disabled" @endif>
                        <a @if($trangchudata['vanbanphapluat']->currentPage() != $trangchudata['vanbanphapluat']->lastPage()) href="{{$trangchudata['vanbanphapluat']->nextPageUrl()}}" @endif>
                            >
                        </a>
                    </li>
                    <li @if($trangchudata['vanbanphapluat']->currentPage() == $trangchudata['vanbanphapluat']->lastPage()) class="disabled" @endif>

                        <a @if($trangchudata['vanbanphapluat']->currentPage() != $trangchudata['vanbanphapluat']->lastPage()) href="{{$trangchudata['vanbanphapluat']->url($trangchudata['vanbanphapluat']->lastPage())}}" @endif>
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
        $('#timkiemvanban').on('keypress', function(e) {
            if(e.which == 13) {

                searchResult();
            }
        });

        function searchResult(){

            var value = document.getElementById('timkiemvanban').value;
            if(value != " ") {
                if (value.length > 0) {
                    $.ajax({
                        type: 'get',
                        url: '{{URL::to('searchvanban')}}',
                        data: {
                            keysearch: value
                        },
                        success: function (response) {
                            var ketqua = response['search_result'];
                            var soluongketqua = ketqua.length;
                            if(soluongketqua > 0){
                                document.getElementById('bangvanban').innerHTML = '';
                                var noidungketqua = '';
                                var vanbanphapluaturl = <?php echo json_encode(url('/vanbanphapluat')); ?>;
                                var vanbanurl = <?php echo json_encode(url('/vanban')); ?>;
                                for (var i = 0; i < soluongketqua; i++) {
                                    var sohieu = ketqua[i]['sohieu'];
                                    var ngayky = ketqua[i]['ngaybanhanh'];
                                    var trichdan = ketqua[i]['trichdan'];
                                    var id = ketqua[i]['id'];

                                    noidungketqua += '<tr>'+
                                        '<td>'+
                                        sohieu+
                                        '</td>'+
                                        '<td>'+
                                        ngayky+
                                        '</td>'+
                                        '<td>'+
                                            '<a href="'+vanbanphapluaturl+'/'+id+'">'+
                                            trichdan+
                                            '</a>'+
                                        '</td>'+
                                        '</tr>';

                                }
                                document.getElementById('bangvanban').innerHTML = ''+
                                    '<table class="table table-bordered table-hover" style="border-collapse: collapse">'+
                                    '<thead>'+
                                    '<tr>'+
                                    '<th class="text-center col-md-2">Số hiệu</th>'+
                                    '<th class="text-center col-md-2">Ngày ký</th>'+
                                    '<th class="text-center col-md-9">Trích dẫn</th>'+
                                    '</tr>'+
                                    '</thead>'+
                                    '<tbody>'+
                                    noidungketqua+
                                    '<tr>'+
                                        '<td colspan="3" class="text-right">'+
                                        '<a href="'+vanbanurl+'" class="btn btn-xs btn-danger">'+
                                        '<span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Trở lại'+
                                        '</a>'+
                                        '</td>'+
                                    '</tr>'+
                                    '</tbody>'+
                                    '</table>';
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