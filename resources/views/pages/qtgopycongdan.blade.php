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
        var element1 = document.getElementById("qtgopy");
        element1.classList.add("active");
        var element = document.getElementById("htab-congthongtin");
        element.classList.add("active");
        element.classList.add("in");

    </script>
    <?php
        $quyenXoa = Session::get('quyenXoa');
        $currentChonSoLuongHienThi = Session::get('soLuongHienThi_TabCongThongTin');
    ?>
    <div id="donthu" class="col-background" style="margin-bottom: 100px;">
        <div class="panel panel-default panel-min-height">
            <div class="panel-heading text-center">QUẢN TRỊ GÓP Ý CÔNG DÂN</div>
            <div class="panel-body row"></div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" style="border-collapse: collapse">
                    <thead>
                        <tr>
                            <th class="col-xs-2">Họ và tên</th>
                            <th class="col-xs-2">Địa chỉ</th>
                            <th class="col-xs-2">Số CMND/Điện thoại</th>
                            <th class="col-xs-2">Tiêu đề</th>
                            <th class="col-xs-3">Nội dung</th>
                            <th scope="row">T.Thái</th>
                            <th class="col-xs-1">Xử Lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($getgopycongdan as $gopy)
                            <tr id="gopy{{$gopy->id}}">
                                <td>{{$gopy->hoten}}</td>
                                <td>{{$gopy->diachi}}</td>
                                <td>{{$gopy->cmnd.'/'.$gopy->dienthoai}}</td>
                                <td>{{$gopy->tieude}}</td>
                                <td>{{$gopy->noidung}}</td>
                                @if($gopy->trangthai == DADUYET)
                                    <td id="trangthai{{$gopy->id}}" class="text-center"><span class='glyphicon glyphicon-ok text-success'></span></td>
                                @else
                                    <td id="trangthai{{$gopy->id}}" class="text-center"><span class='glyphicon glyphicon-ban-circle text-danger'></span></td>
                                @endif
                                <td class="text-center">
                                    <button type="submit" name="btnCancel{{$gopy->id}}" value="{{$gopy->trangthai}}" onclick="confirmduyetbaiviet('{{$gopy->id}}',this.value)" id="btnCancel{{$gopy->id}}" title="Duyệt bài viết" class="btn btn-xs btn-success">
                                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                                    </button>
                                 @if(($quyenXoa & DELCONGTHONHTIN)== DELCONGTHONHTIN)
                                    <button type="submit" name="btnDelete{{$gopy->id}}" value="{{$gopy->id}}" onclick="confirmxoabaiviet(this.value)" id="btnDelete{{$gopy->id}}" title="Xóa bài viết" class="btn btn-xs btn-danger">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </button>
                                @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-body text-center">
                <ul class="pagination">
                    <li>
                        <span>Trang {{$getgopycongdan->currentPage().'/'.$getgopycongdan->lastPage()}}</span>
                    </li>
                    <li @if($getgopycongdan->currentPage() == 1) class="disabled" @endif>
                        <a @if($getgopycongdan->currentPage() != 1) href="{{$getgopycongdan->url(1)}}" @endif>
                            <<
                        </a>
                    </li>
                    <li @if($getgopycongdan->currentPage() == 1) class="disabled" @endif>
                        <a @if($getgopycongdan->currentPage() != 1) href="{{$getgopycongdan->previousPageUrl()}}" @endif>
                            <
                        </a>
                    </li>
                    <li class="active">
                        <span>{{$getgopycongdan->currentPage()}}</span>
                    </li>
                    <li @if($getgopycongdan->currentPage() == $getgopycongdan->lastPage()) class="disabled" @endif>
                        <a @if($getgopycongdan->currentPage() != $getgopycongdan->lastPage()) href="{{$getgopycongdan->nextPageUrl()}}" @endif>
                            >
                        </a>
                    </li>
                    <li @if($getgopycongdan->currentPage() == $getgopycongdan->lastPage()) class="disabled" @endif>

                        <a @if($getgopycongdan->currentPage() != $getgopycongdan->lastPage()) href="{{$getgopycongdan->url($getgopycongdan->lastPage())}}" @endif>
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

        function confirmduyetbaiviet(id,trangthaigopy){

            if(trangthaigopy == 1) {
                var confirmhiddencontent = confirm('Bạn có muốn ẩn góp ý này không?');

                if (confirmhiddencontent) {

                    document.getElementById("trangthai" + id).innerHTML = "<span class='glyphicon glyphicon-ban-circle text-danger'>";
                    document.getElementById("btnCancel" + id).value = 0;
                    var newtrangthai = 0;
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        url:  '{{URL::to('changetrangthaigopytrogiup')}}',
                        data: {
                            gopyid: id,
                            newtrangthai: newtrangthai
                        },
                        success: function (response) {
                            alert(response['changetrangthai_result']);
                        }
                    });
                }

            }else {

                var confirmpostcontent = confirm('Bạn có muốn đăng góp ý này không?');

                if (confirmpostcontent) {
                    document.getElementById("trangthai" + id).innerHTML = "<span class='glyphicon glyphicon-ok text-success'>";
                    document.getElementById("btnCancel" + id).value = 1;
                    var newtrangthai1 = 1;
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        url:  '{{URL::to('changetrangthaigopytrogiup')}}',
                        data: {
                            gopyid: id,
                            newtrangthai: newtrangthai1
                        },
                        success: function (response) {
                            alert(response['changetrangthai_result']);
                        }
                    });
                }
            }
        }

        function confirmxoabaiviet(id){

            var confirmdeletecontent = confirm('Bạn có muốn xóa góp ý này không?');

            if (confirmdeletecontent) {
                document.getElementById("gopy" + id).style.display = 'none';
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url:  '{{URL::to('xoagopytrogiup')}}',
                    data: {
                        gopyid: id
                    },
                    success: function (response) {

//                        alert(response['xoagopy_result']);

                    }
                });
            }
        }

        function chonHienThiSoLuong(valueChon){

            var qtgopycongdanUrl = <?php echo json_encode(url('qtgopycongdan')) ;?>;

            $.ajax({
                type: 'post',
                dataType: 'json',
                url:  '{{URL::to('chonHienThiSoLuongCongThongTin')}}',
                data: {
                    valueChon: valueChon
                },
                success: function (response) {

//                    console.log(response);
                    window.location.href = qtgopycongdanUrl;

                }
            });

        }

    </script>
@endsection
