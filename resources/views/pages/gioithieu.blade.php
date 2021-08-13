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
        var element1 = document.getElementById("qtgioithieu");
        element1.classList.add("active");
        var element = document.getElementById("htab-congthongtin");
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
            return $ngay.'-'.$thang.'-'.$nam;
        }

        $currentChonSoLuongHienThi = Session::get('soLuongHienThi_TabCongThongTin');
    ?>
    <div id="donthu" class="col-background" style="margin-bottom: 100px;">
        <div class="panel panel-default panel-min-height">
            <div class="panel-heading text-center">QUẢN TRỊ BÀI VIẾT</div>

            <div class="panel-body row">
                <div class="col-xs-8">
                    <a role="button" href="{{url('/themthongtingioithieu')}}" class="btn btn-success btn-sm" title="tạo đơn" id="btnThem"><span class="glyphicon glyphicon-plus"></span>Thêm</a>
                </div>
                <div class="col-xs-4"></div>
            </div>
            <table class="table table-bordered table-hover" style="border-collapse: collapse">
                <thead>
                <tr>
                    <th class="col-xs-4">Tiêu đề/Ngày cập nhật</th>
                    <th class="col-xs-6">Tóm tắt nội dung</th>
                    <th class="col-xs-1">Trạng thái</th>
                    <th class="col-xs-1">Xử Lý</th>
                </tr>
                </thead>
                <tbody>

                @foreach($getthongtingioithieu as $baiviet)
                    <tr id="baiviet{{$baiviet->id}}">
                        <td>
                            <a href="{{url('/chinhsuabaiviet/'.$baiviet->id)}}">
                                {{$baiviet->tieude}}
                            </a>-
                            {{convertNgay($baiviet->ngaydang)}}
                        </td>
                        <td>{{$baiviet->tomtat}}</td>

                        @if($baiviet->trangthai == DADUYET)
                            <td id="trangthai{{$baiviet->id}}" class="text-center"><span class='glyphicon glyphicon-ok text-success'></span></td>
                        @else
                            <td id="trangthai{{$baiviet->id}}" class="text-center"><span class='glyphicon glyphicon-ban-circle text-danger'></span></td>
                        @endif
                        <td class="text-center">
                            <button type="submit" name="btnCancel{{$baiviet->id}}" value="{{$baiviet->trangthai}}" onclick="confirmduyetbaiviet('{{$baiviet->id}}',this.value)" id="btnCancel{{$baiviet->id}}" title="Duyệt bài viết" class="btn btn-xs btn-success">
                                <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                            </button>
                        @if(($quyenXoa & DELCONGTHONHTIN)== DELCONGTHONHTIN)
                            <button type="submit" name="btnDelete{{$baiviet->id}}" value="{{$baiviet->id}}" onclick="confirmxoabaiviet(this.value)" id="btnDelete{{$baiviet->id}}" title="Xóa bài viết" class="btn btn-xs btn-danger">
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
                        <span>Trang {{$getthongtingioithieu->currentPage().'/'.$getthongtingioithieu->lastPage()}}</span>
                    </li>
                    <li @if($getthongtingioithieu->currentPage() == 1) class="disabled" @endif>
                        <a @if($getthongtingioithieu->currentPage() != 1) href="{{$getthongtingioithieu->url(1)}}" @endif>
                            <<
                        </a>
                    </li>
                    <li @if($getthongtingioithieu->currentPage() == 1) class="disabled" @endif>
                        <a @if($getthongtingioithieu->currentPage() != 1) href="{{$getthongtingioithieu->previousPageUrl()}}" @endif>
                            <
                        </a>
                    </li>
                    <li class="active">
                        <span>{{$getthongtingioithieu->currentPage()}}</span>
                    </li>
                    <li @if($getthongtingioithieu->currentPage() == $getthongtingioithieu->lastPage()) class="disabled" @endif>
                        <a @if($getthongtingioithieu->currentPage() != $getthongtingioithieu->lastPage()) href="{{$getthongtingioithieu->nextPageUrl()}}" @endif>
                            >
                        </a>
                    </li>
                    <li @if($getthongtingioithieu->currentPage() == $getthongtingioithieu->lastPage()) class="disabled" @endif>

                        <a @if($getthongtingioithieu->currentPage() != $getthongtingioithieu->lastPage()) href="{{$getthongtingioithieu->url($getthongtingioithieu->lastPage())}}" @endif>
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
                var confirmhiddencontent = confirm('Bạn có muốn ẩn bài viết này không');

                if (confirmhiddencontent) {

                    document.getElementById("trangthai" + id).innerHTML = "<span class='glyphicon glyphicon-ban-circle text-danger'>";
                    document.getElementById("btnCancel" + id).value = 0;
                    var newtrangthai = 0;
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        url:  '{{URL::to('changetrangthaibaiviet')}}',
                        data: {
                            baivietid: id,
                            newtrangthai: newtrangthai
                        },
                        success: function (response) {

                        }
                    });
                }

            }else {

                var confirmpostcontent = confirm('Bạn có muốn đăng bài viết này không');

                if (confirmpostcontent) {
                    document.getElementById("trangthai" + id).innerHTML = "<span class='glyphicon glyphicon-ok text-success'>";
                    document.getElementById("btnCancel" + id).value = 1;
                    var newtrangthai1 = 1;
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        url:  '{{URL::to('changetrangthaibaiviet')}}',
                        data: {
                            baivietid: id,
                            newtrangthai: newtrangthai1
                        },
                        success: function (response) {

                        }
                    });
                }
            }
        }

        function confirmxoabaiviet(id){

            var confirmdeletecontent = confirm('Bạn có muốn xóa bài viết này không?');

            if (confirmdeletecontent) {
                document.getElementById("baiviet" + id).style.display = 'none';
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url:  '{{URL::to('xoabaiviet')}}',
                    data: {
                        baivietid: id
                    },
                    success: function (response) {

                    }
                });
            }
        }

        function chonHienThiSoLuong(valueChon){

            var gioiThieuUrl = <?php echo json_encode(url('gioithieu')) ;?>;

            $.ajax({
                type: 'post',
                dataType: 'json',
                url:  '{{URL::to('chonHienThiSoLuongCongThongTin')}}',
                data: {
                    valueChon: valueChon
                },
                success: function (response) {

//                    console.log(response);
                    window.location.href = gioiThieuUrl;

                }
            });

        }

    </script>

@endsection