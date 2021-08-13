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
            <i class="fa fa-search fa-lg" aria-hidden="true"></i>
            KẾT QUẢ XỬ LÝ ĐƠN KHIẾU NẠI TỐ CÁO
        </div>
        <div class="panel-body">
            <div class="input-group input-group-sm">
                <span class="input-group-addon">Tìm kiếm</span>
                <input name="timkiemketquaxulykntc" type="text" id="timkiemketquaxulykntc" class="form-control" placeholder="Tìm tên công dân, số thụ lý..." />
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
        <div id="ketquaxulykntc">
            <div class="ketqua-kntc">
                <ul>
                    @foreach($trangchudata['xulydonthukntc'] as $xulydonthukntc)
                        <li>
                            <p>
                                <label>Họ và tên: </label>
                                {{$xulydonthukntc->tennguoivietdon}}
                            </p>
                            <p>
                                <label>Địa chỉ: </label>
                                {{$xulydonthukntc->diachinguoiviet}}
                            </p>
                            <p>
                                <label>Nội dung: </label>
                                {{$xulydonthukntc->noidung}}
                            </p>
                            <p>
                                <label>Ngày nhận đơn: </label>
                                {{$xulydonthukntc->ngaynhan}}
                            </p>
                            <p class="detail">
                                <a href="{{url('/noidungxulydonthukhieunaitocao/'.$xulydonthukntc->donthuid)}}">Xem chi tiết &raquo;</a>
                            </p>
                        </li>
                    @endforeach
                </ul>
            </div>


            <div class="panel-body text-center">
                <ul class="pagination">
                    <li>
                        <span>Trang {{$trangchudata['xulydonthukntc']->currentPage().'/'.$trangchudata['xulydonthukntc']->lastPage()}}</span>
                    </li>
                    <li @if($trangchudata['xulydonthukntc']->currentPage() == 1) class="disabled" @endif>
                        <a @if($trangchudata['xulydonthukntc']->currentPage() != 1) href="{{$trangchudata['xulydonthukntc']->url(1)}}" @endif>
                            <<
                        </a>
                    </li>
                    <li @if($trangchudata['xulydonthukntc']->currentPage() == 1) class="disabled" @endif>
                        <a @if($trangchudata['xulydonthukntc']->currentPage() != 1) href="{{$trangchudata['xulydonthukntc']->previousPageUrl()}}" @endif>
                            <
                        </a>
                    </li>
                    <li class="active">
                        <span>{{$trangchudata['xulydonthukntc']->currentPage()}}</span>
                    </li>
                    <li @if($trangchudata['xulydonthukntc']->currentPage() == $trangchudata['xulydonthukntc']->lastPage()) class="disabled" @endif>
                        <a @if($trangchudata['xulydonthukntc']->currentPage() != $trangchudata['xulydonthukntc']->lastPage()) href="{{$trangchudata['xulydonthukntc']->nextPageUrl()}}" @endif>
                            >
                        </a>
                    </li>
                    <li @if($trangchudata['xulydonthukntc']->currentPage() == $trangchudata['xulydonthukntc']->lastPage()) class="disabled" @endif>

                        <a @if($trangchudata['xulydonthukntc']->currentPage() != $trangchudata['xulydonthukntc']->lastPage()) href="{{$trangchudata['xulydonthukntc']->url($trangchudata['xulydonthukntc']->lastPage())}}" @endif>
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
        $('#timkiemketquaxulykntc').on('keypress', function(e) {
            if(e.which == 13) {

                searchResult();
            }
        });

        function searchResult(){

            var value = document.getElementById('timkiemketquaxulykntc').value;
            if(value != " ") {
                if (value.length > 0) {
                    $.ajax({
                        type: 'get',
                        url: '{{URL::to('searchketquaxulykntc')}}',
                        data: {
                            keysearch: value
                        },
                        success: function (response) {
                            var ketqua = response['search_result'];
                            var soluongketqua = ketqua.length;
                            if(soluongketqua > 0){
                                document.getElementById('ketquaxulykntc').innerHTML = '';

                                var noidungtiepdan = '';

                                for (var i = 0; i < soluongketqua; i++) {
                                    var tennguoivietdon = ketqua[i]['tennguoivietdon'];
                                    var diachinguoiviet = ketqua[i]['diachinguoiviet'];
                                    var noidung = ketqua[i]['noidung'];
                                    var ngaynhan = ketqua[i]['ngaynhan'];
                                    var id = ketqua[i]['donthuid'];
                                    var noidungxulykntcurl = <?php echo json_encode(url('/noidungxulydonthukhieunaitocao')); ?>;
                                    var ketquaxulykntcurl = <?php echo json_encode(url('/ketquaxulydonthukhieunaitocao')); ?>;
                                    var xemchitiet = '' +
                                            '<a href="'+noidungxulykntcurl+'/'+id+'">Xem chi tiết »</a>' +
                                            '';

                                    noidungtiepdan += '' +
                                            '<li>' +
                                            '<p>' +
                                            '<label>Họ và tên:&nbsp; </label>' +
                                            tennguoivietdon +
                                            '</p>' +
                                            '<p>' +
                                            '<label>Địa chỉ:&nbsp; </label>' +
                                            diachinguoiviet +
                                            '</p>' +
                                            '<p>' +
                                            '<label>Nội dung:&nbsp; </label>' +
                                            noidung +
                                            '</p>' +
                                            '<p>' +
                                            '<label>Ngày nhận đơn:&nbsp; </label>' +
                                            ngaynhan +
                                            '</p>' +
                                            '<p class="detail">' +
                                            xemchitiet +
                                            '</p>' +
                                            '</li>' +
                                            '';
                                }

                                document.getElementById('ketquaxulykntc').innerHTML = '' +
                                        '<div id="ketquaxulykntc">' +
                                        '<div class="ketqua-kntc">' +
                                        '<ul>' +
                                        noidungtiepdan +
                                        '</ul>' +
                                        '</div>' +
                                        '<a href="'+ketquaxulykntcurl+'" class="btn btn-xs btn-danger">'+
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