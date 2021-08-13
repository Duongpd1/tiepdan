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
        var element1 = document.getElementById("tttd");
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

    <div class="col-background">
        <div id="thongtintiepdan" class="panel panel-default panel-min-height">
            <div class="panel-heading text-center">THÔNG TIN TIẾP DÂN</div>
            <div class="panel-body">
                <a role="button" href="{{url('/themthongtintiepdan')}}" class="btn btn-success btn-sm" title="tạo đơn" id="btnThem"><span class="glyphicon glyphicon-plus"></span>Thêm</a>
            </div>

            <table class="table table-bordered table-hover" style="border-collapse: collapse">
                <thead>
                    <tr>
                        <th class="col-xs-1 text-center">Số hiệu</th>
                        <th class="col-xs-2 text-center">Ngày ban hành</th>
                        <th class="col-xs-3 text-center">Cơ quan ban hành</th>
                        <th class="col-xs-3 text-center">Trích dẫn</th>
                        <th class="col-xs-1 text-center">Văn bản</th>
                        <th class="col-xs-1 text-center">Trạng thái</th>
                        <th class="col-xs-1 text-center">Xử lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($getthongtintiepdan as $baiviet)
                        <tr id="thongtintiepdan{{$baiviet->id}}">
                            <td  class="text-center">{{$baiviet->sohieu}}</td>
                            <td class="text-center">{{convertNgay($baiviet->ngaybanhanh)}}</td>
                            <td>{{$baiviet->coquanbanhanh}}</td>
                            <td>
                                <a href="{{url('/chinhsuathongtintiepdan/'.$baiviet->id)}}">
                                    {{$baiviet->trichdan}}
                                </a>
                            </td>

                            @if($baiviet->fileupload != null)
                                <td class="text-center">
                                    <a href="{{url($baiviet->fileupload)}}" title='Tải về' download class="btn btn-xs btn-info">
                                        <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
                                    </a>
                                </td>
                            @else
                                <td class="text-center"><span class='glyphicon glyphicon-ban-circle text-danger'></span></td>
                            @endif

                            @if($baiviet->trangthai == DADUYET)
                                <td id="trangthai{{$baiviet->id}}" class="text-center"><span class='glyphicon glyphicon-ok text-success'></span></td>
                            @else
                                <td id="trangthai{{$baiviet->id}}" class="text-center"><span class='glyphicon glyphicon-ban-circle text-danger'></span></td>
                            @endif

                            <td class="text-center">
                                <button type="submit" name="btnCancel{{$baiviet->id}}" value="{{$baiviet->trangthai}}" onclick="confirmduyetbaiviet('{{$baiviet->id}}',this.value)" id="btnCancel{{$baiviet->id}}" title="Duyệt thông tin tiếp dân" class="btn btn-xs btn-success">
                                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                                </button>
                            @if(($quyenXoa & DELTIEPDAN)== DELTIEPDAN)
                                <button type="submit" name="btnDelete{{$baiviet->id}}" value="{{$baiviet->id}}" onclick="confirmxoabaiviet(this.value)" id="btnDelete{{$baiviet->id}}" title="Xóa xóa thông tin tiếp dân" class="btn btn-xs btn-danger">
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
                        <span>Trang {{$getthongtintiepdan->currentPage().'/'.$getthongtintiepdan->lastPage()}}</span>
                    </li>
                    <li @if($getthongtintiepdan->currentPage() == 1) class="disabled" @endif>
                        <a @if($getthongtintiepdan->currentPage() != 1) href="{{$getthongtintiepdan->url(1)}}" @endif>
                            <<
                        </a>
                    </li>
                    <li @if($getthongtintiepdan->currentPage() == 1) class="disabled" @endif>
                        <a @if($getthongtintiepdan->currentPage() != 1) href="{{$getthongtintiepdan->previousPageUrl()}}" @endif>
                            <
                        </a>
                    </li>
                    <li class="active">
                        <span>{{$getthongtintiepdan->currentPage()}}</span>
                    </li>
                    <li @if($getthongtintiepdan->currentPage() == $getthongtintiepdan->lastPage()) class="disabled" @endif>
                        <a @if($getthongtintiepdan->currentPage() != $getthongtintiepdan->lastPage()) href="{{$getthongtintiepdan->nextPageUrl()}}" @endif>
                            >
                        </a>
                    </li>
                    <li @if($getthongtintiepdan->currentPage() == $getthongtintiepdan->lastPage()) class="disabled" @endif>

                        <a @if($getthongtintiepdan->currentPage() != $getthongtintiepdan->lastPage()) href="{{$getthongtintiepdan->url($getthongtintiepdan->lastPage())}}" @endif>
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
        function confirmduyetbaiviet(id,trangthaibaiviet){
            if(trangthaibaiviet == 1) {
                var confirmhiddencontent = confirm('Bạn có muốn ẩn thông tin tiếp dân này không');

                if (confirmhiddencontent) {

                    document.getElementById("trangthai" + id).innerHTML = "<span class='glyphicon glyphicon-ban-circle text-danger'>";
                    document.getElementById("btnCancel" + id).value = 0;
                    var newtrangthai = 0;
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        url:  '{{URL::to('changetrangthaithongtintiepdan')}}',
                        data: {
                            thongtintiepdanid: id,
                            newtrangthai: newtrangthai
                        },
                        success: function (response) {
//                            alert(response['changetrangthai_result']);
                        }
                    });
                }

            }else {

                var confirmpostcontent = confirm('Bạn có muốn đăng thông tin tiếp dân này không');

                if (confirmpostcontent) {
                    document.getElementById("trangthai" + id).innerHTML = "<span class='glyphicon glyphicon-ok text-success'>";
                    document.getElementById("btnCancel" + id).value = 1;
                    var newtrangthai1 = 1;
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        url:  '{{URL::to('changetrangthaithongtintiepdan')}}',
                        data: {
                            thongtintiepdanid: id,
                            newtrangthai: newtrangthai1
                        },
                        success: function (response) {
//                            alert(response['changetrangthai_result']);
                        }
                    });
                }
            }
        }

        function confirmxoabaiviet(id){

            var confirmdeletecontent = confirm('Bạn có muốn xóa thông tin tiếp dân này không?');

            if (confirmdeletecontent) {
                document.getElementById("thongtintiepdan" + id).style.display = 'none';
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url:  '{{URL::to('xoathongtintiepdan')}}',
                    data: {
                        thongtintiepdanid: id
                    },
                    success: function (response) {
//                        alert(response['xoathongtintiepdan_result']);
                    }
                });
            }
        }

        function chonHienThiSoLuong(valueChon){

            var thongTinTiepDanUrl = <?php echo json_encode(url('thongtintiepdan')) ;?>;

            $.ajax({
                type: 'post',
                dataType: 'json',
                url:  '{{URL::to('chonHienThiSoLuongTiepDan')}}',
                data: {
                    valueChon: valueChon
                },
                success: function (response) {

//                    console.log(response);
                    window.location.href = thongTinTiepDanUrl;

                }
            });

        }

    </script>

@endsection
