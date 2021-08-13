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
        var element1 = document.getElementById("qtthongbao");
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
    <div id="thongbao" class="col-background">

        <div class="panel panel-default panel-min-height">
            <div class="panel-heading text-center">QUẢN TRỊ VĂN BẢN THÔNG BÁO</div>
            <div class="panel-body">
                <a class="btn btn-success btn-sm" href="{{url('/themthongbao')}}" title="tạo đơn" id="btnThem"><span class="glyphicon glyphicon-plus"></span>Thêm</a>
            </div>

            <table class="table table-bordered table-hover" style="border-collapse: collapse">
                <thead>
                    <tr>
                        <th class="col-xs-4">Tiêu đề - Ngày ban hành</th>
                        <th class="col-xs-4">Nội dung</th>
                        <th class="col-xs-2">Người cập nhật</th>
                        <th class="col-xs-1">Tài liệu</th>
                        <th class="col-xs-1">Xử Lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($getthongbao as $baiviet)
                        <tr id="baiviet{{$baiviet->id}}">
                            <td>
                                <a href="{{url('/chinhsuathongbao/'.$baiviet->id)}}">
                                    {{$baiviet->tenthongbao}}
                                </a>-
                                {{convertNgay($baiviet->ngaybanhanh)}}
                            </td>
                            <td><?php echo $baiviet->noidung; ?></td>
                            <td>{{$baiviet->nguoicapnhat}}</td>

                            @if($baiviet->fileupload != null)
                                <td class="text-center">
                                    <a href="{{url($baiviet->fileupload)}}" title='Tải về' download>
                                        <span class='glyphicon glyphicon-download-alt'></span>
                                    </a>
                                </td>
                            @else
                                <td class="text-center"><span class='glyphicon glyphicon-ban-circle text-danger'></span></td>
                            @endif
                            <td class="text-center">
                                <a href="{{url('chinhsuathongbao/'.$baiviet->id)}}" title="Sửa thông báo" class="btn btn-xs btn-success">
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                </a>
                            @if(($quyenXoa & DELCONGTHONHTIN)== DELCONGTHONHTIN)
                                <button type="submit" name="btnDelete{{$baiviet->id}}" value="{{$baiviet->id}}" onclick="confirmxoabaiviet(this.value)" id="btnDelete{{$baiviet->id}}" title="Xóa thông báo" class="btn btn-xs btn-danger">
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
                        <span>Trang {{$getthongbao->currentPage().'/'.$getthongbao->lastPage()}}</span>
                    </li>
                    <li @if($getthongbao->currentPage() == 1) class="disabled" @endif>
                        <a @if($getthongbao->currentPage() != 1) href="{{$getthongbao->url(1)}}" @endif>
                            <<
                        </a>
                    </li>
                    <li @if($getthongbao->currentPage() == 1) class="disabled" @endif>
                        <a @if($getthongbao->currentPage() != 1) href="{{$getthongbao->previousPageUrl()}}" @endif>
                            <
                        </a>
                    </li>
                    <li class="active">
                        <span>{{$getthongbao->currentPage()}}</span>
                    </li>
                    <li @if($getthongbao->currentPage() == $getthongbao->lastPage()) class="disabled" @endif>
                        <a @if($getthongbao->currentPage() != $getthongbao->lastPage()) href="{{$getthongbao->nextPageUrl()}}" @endif>
                            >
                        </a>
                    </li>
                    <li @if($getthongbao->currentPage() == $getthongbao->lastPage()) class="disabled" @endif>

                        <a @if($getthongbao->currentPage() != $getthongbao->lastPage()) href="{{$getthongbao->url($getthongbao->lastPage())}}" @endif>
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
        function confirmxoabaiviet(id){

            var confirmdeletecontent = confirm('Bạn có muốn xóa thông báo này không?');

            if (confirmdeletecontent) {
                document.getElementById("baiviet" + id).style.display = 'none';
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url:  '{{URL::to('xoathongbao')}}',
                    data: {
                        thongbaoid: id
                    },
                    success: function (response) {

                    }
                });
            }
        }

        function chonHienThiSoLuong(valueChon){

            var qtthongbaoUrl = <?php echo json_encode(url('qtthongbao')) ;?>;

            $.ajax({
                type: 'post',
                dataType: 'json',
                url:  '{{URL::to('chonHienThiSoLuongCongThongTin')}}',
                data: {
                    valueChon: valueChon
                },
                success: function (response) {

//                    console.log(response);
                    window.location.href = qtthongbaoUrl;

                }
            });

        }
    </script>


@endsection
