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
@section('css')
    <link rel="stylesheet" href="{{url('/css/jquery.dataTables.min.css')}}">
@endsection
@section('js')
    <script type="text/javascript" src="{{url('/js/jquery.dataTables.min.js')}}"></script>
@endsection

@section('content')
    <?php


        if(Session::has('accountid')){

            $accountname = Session::get('accountname');
            $accountid = Session::get('accountid');
            $accountpermission = Session::get('accountpermission');

        }
    $sttDangXl = 1;
    ?>


    <div id="donthu" class="col-background" style="margin-bottom: 100px;">
        <div class="panel panel-default">
            <div class="panel-heading text-center">DANH SÁCH ĐƠN KHIẾU NẠI TỐ CÁO</div>
            <div class="row" style="margin: 10px 0;">
                @if($accountpermission == CHUYENVIEN || $accountpermission == TIEPDAN)
                <div class="col-xs-8">
                    <button class="btn btn-success btn-sm" type="button" title="tạo đơn" id="btnThem" onclick="btnOnClick(this);"><span class="glyphicon glyphicon-plus"></span>Thêm</button>
                    <a type="button" onclick="btnOnClick(this);" id="btnPrint" title="In" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-print"></span>&nbsp;In</a>

                    <form id="inDanhSachDonThuForm" role="form" action="{{url('inDanhSachDonThu')}}" method="post">
                        <input type="hidden" id="trangThai_InDanhSachDonThuForm" name="trangThai_InDanhSachDonThuForm" value="0">
                        <input type="hidden" id="accountId_InDanhSachDonThuForm" name="accountId_InDanhSachDonThuForm" value="{{Session::get('accountid')}}">
                    </form>
                </div>
                @endif

            </div>

            <div class="panel-body text-center">
                <table id="danhSachDonDangXL" class="table table-bordered table-hover" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Số thụ lý</th>
                        <th>Nội dung</th>
                        <th>Tên người viết đơn</th>
                        <th>Người cập nhật</th>
                        <th>Ngày nhận </th>
                        <th>Cán bộ xử lý</th>
                        <th>Trạng thái </th>

                    </tr>
                    </thead>
                    <tbody id="bodyDangXuLy">
                    @if(0 !=count($donthuArray))
                        @foreach($donthuArray as $row)
                            <tr>
                                <td>{{$sttDangXl}}</td>
                                <td>
                                    <a href="{{url('/chitietdonthu/'.$row->donthuid)}}"> {{$row->sothuly}}</a>
                                </td>
                                <td>{{str_limit($row->noidung, $limit = 45, $end = '...')}}</td>
                                <td>{{$row->tennguoivietdon}}</td>
                                <td>
                                    @foreach($thongTinNhanVien as $nhanVien)
                                        @if($nhanVien->accountid == $row->nguoinhap )
                                            {{$nhanVien->fullname}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    {{date('d/m/Y',strtotime($row->ngaynhan))}}
                                </td>
                                <td>
                                    @foreach($thongTinNhanVien as $nhanVien)
                                        @if($nhanVien->accountid == $row->nguoixuly )
                                            {{$nhanVien->fullname}}
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    {{($row->trangthaixuly == CHOXULY)?'chờ xử lý':''}}
                                    {{($row->trangthaixuly == DANGXULY)?'đang xử lý':''}}
                                    {{($row->trangthaixuly == DAGIAIQUYET)?'đã giải quyết':''}}
                                </td>

                            </tr>
                            <?php $sttDangXl++; ?>
                        @endforeach
                    @else

                    @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>

        $(document).ready(function(){

            var table = $('#danhSachDonDangXL').DataTable({
                "language": {
                    "search": "Tìm kiếm:",
                    "emptyTable":     "Không có kết quả nào!",
                    "info":           "Hiển thị từ _START_ đến _END_ của _TOTAL_ mẫu tin",
                    "lengthMenu":     "Hiển thị _MENU_ dòng",
                    "infoEmpty":      "Hiển thị từ 0 đến 0 của 0 mẫu tin"
                }
            } );

        });

    </script>

@endsection
