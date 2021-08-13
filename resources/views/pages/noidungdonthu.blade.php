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
    <link rel="stylesheet" href="{{url('/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{url('/css/complete.css')}}">
@endsection
@section('js')
    <script type="text/javascript" src="{{url('/js/jquery.autocomplete.min.js')}}"></script>
@endsection
@section('style')
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 13px;
            line-height: 1.42857143;
            color: #333;
            background-color: #fff;
        }
    </style>

@endsection
@section('content')
    <script>
        //document.getElementById("htab-danhmuc").style.display = 'block';
//        var element1 = document.getElementById("hs");
//        element1.classList.add("active");
//        var element = document.getElementById("htab-nghiepvu");
//        element.classList.add("active");
//        element.classList.add("in");

    </script>
    <?php
        $quyenXoa = Session::get('quyenXoa');
        $lanhDaoPermision = Session::get('accountpermission');
        //print_r($data[0]);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        function convertNgay($ngayTuDatabase){
            $ngayExplore = explode('-',$ngayTuDatabase);
            $ngay = $ngayExplore[2];
            $thang = $ngayExplore[1];
            $nam = $ngayExplore[0];
            return $ngay.'/'.$thang.'/'.$nam;
        }
    ?>
    <div id="donthu" class="col-background" style="margin-bottom: 100px;">
        <form method="post" name="xacminh" action="luunoidung" enctype="multipart/form-data">
        <div class="row">
            <div class="panel-body row" style="padding: 10px 0">
                <div class="col-xs-6">
                    <button type="button" name="back" value="" onclick="clickBtn(this);" id="back" title="Trở lại" class="btn btn-sm btn-danger">
                        <span class="glyphicon glyphicon-arrow-left"></span>
                        Trở lại
                    </button>
                </div>

            </div>
            <div class="col-md-3">

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Người theo dõi </h3>
                        <a id="themTheoDoi" style="float: right;cursor: pointer;" onclick="displayEdit(this.id)">Thêm </a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <h5><span style="color: #3377c7" id="spanId">
                            @if($nguoiTheoDoi != null)
                                    @foreach($nguoiTheoDoi as $item)

                                        @foreach($nguoiXL as $nguoiTao)
                                            @if($item == $nguoiTao->accountid )
                                                {{$nguoiTao->fullname}},
                                            @endif
                                        @endforeach

                                    @endforeach
                                @endif
                            </span></h5>
                        <div id="divChonTen" style="display: none">

                            <select style="width:180px;" id="selectNguoiTD">
                                <option value=""></option>
                                @foreach($danhSachNhanVien as $nhanVien)
                                    <option value="{{$nhanVien->accountid}}">{{$nhanVien->fullname}}</option>
                                @endforeach
                            </select>
                            <button type="button" id="luuTheoDoi" class="btn-success " onclick="luuThemNguoiThepDoi()">Lưu</button>
                            <button id="huyThem" class="btn-warning">Hủy</button>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">CHI TIẾT ĐƠN</div>
                        <div class="panel-body row" style="padding: 10px 0">
                            <div class="col-xs-2" style="padding: 0">
                                <span style="color: #3377c7"># {{$data[0]->sothuly}}</span>

                            </div>

                        </div>

                        <table class="table table-bordered">
                            <tbody>
                            <tr id="scrollToTop1">
                                <td>
                                    <div class="panel-body form-horizontal">

                                        <div class="form-group form-group-sm">
                                            <label for="sothuly"  class="control-label col-xs-2"> Số TT </label>
                                            <div class="col-xs-2">
                                                <input type="text" class="form-control"  id="sothuly" name="sothuly" value="{{$data[0]->sothuly}}" readonly>
                                                <input type="hidden" class="form-control"  id="donthuid" name="donthuid" value="{{$data[0]->donthuid}}">
                                                <input type="text" class="form-control" style="display: none" id="accountid" name="accountid" value="{{Session::get('accountid')}}">
                                            </div>
                                            <div class="col-xs-4">
                                                <div class="input-group input-group-sm date">
                                                    <label for="ngayviet" class="input-group-addon">Ngày ghi trên đơn </label>
                                                    @if($data[0]->ngayviet !="0000-00-00")
                                                        <input class="form-control" type="text" id="ngayviet" name="ngayviet" value="{{convertNgay($data[0]->ngayviet)}}" required>
                                                    @else
                                                        <input class="form-control" type="text" id="ngayviet" name="ngayviet" value="" >
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <div class="input-group input-group-sm date">
                                                    <label for="ngaynhan" class="input-group-addon">Ngày nhận đơn</label>
                                                    <input class="form-control" type="text" id="ngaynhan" name="ngaynhan" value="{{convertNgay($data[0]->ngaynhan)}}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-sm"  style="display:{{($lanhDaoPermision == VANTHU)?'none':''}}">
                                            <label for="ngayGiaoXL" class="control-label col-xs-3">Ngày giao xử lý đơn </label>
                                            <div class="col-xs-4">
                                                <div class="input-group input-group-sm date">
                                                    <input class="form-control" type="text" id="ngayGiaoXLId" name="ngayGiaoXL" value="{{($data[0]->ngayGiaoXuLy != '0000-00-00 00:00:00')?date("d/m/Y",strtotime($data[0]->ngayGiaoXuLy)):''}}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-sm"  style="display:{{($lanhDaoPermision == VANTHU)?'none':''}}">
                                            <label for="hanXuLyId" class="control-label col-xs-3">Hạn xử lý </label>
                                            <div class="col-xs-4">
                                                <div class="input-group input-group-sm date">
                                                    <input class="form-control" type="text" id="hanXuLyId" name="hanXuLy" value="{{$data[0]->thoihanxuly}}" >
                                                    <label for="ngaynhan" class="input-group-addon">Ngày</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-sm" id="trangthaiId" style="display:{{($lanhDaoPermision == VANTHU)?'none':''}}">
                                            <label for="lan" class="control-label col-xs-3"> Trạng thái xử lý </label>
                                            <div class="col-xs-4">
                                                <select id="trangthaixuly" name="trangthaixuly" class="form-control" >

                                                    <option id="CHOXULY" value="{{CHOXULY}}" {{($data[0]->trangthaixuly == CHOXULY)?'selected':''}}>Chờ xử lý</option>
                                                    <option id="DANGXULY" value="{{DANGXULY}}" {{($data[0]->trangthaixuly == DANGXULY)?'selected':''}}>Đang xử lý</option>
                                                    <option id="DAGIAIQUYET" value="{{DAGIAIQUYET}}" {{($data[0]->trangthaixuly == DAGIAIQUYET)?'selected':''}} style="{{($lanhDaoPermision == TIEPDAN || $lanhDaoPermision == LANHDAO)?'':'display:none'}}">Đã giải quyết</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-sm"  style="display:{{($lanhDaoPermision == VANTHU)?'none':''}}">
                                            <label for="lan" class="control-label col-xs-3"> Đơn liên quan </label>
                                            <div class="col-xs-9">
                                                <input type="text" id="donChaId" name="donCha" class="form-control" value="{{($donChaThongTin != null)?'['.$donChaThongTin->sothuly.'] '.$donChaThongTin->tennguoivietdon.$donChaThongTin->coquanbanhanh:''}}">
                                                <input type="hidden" name="luuDonChaValue" id="luuDonChaId" class="form-control">
                                            </div>
                                        </div>
                                            <div class="form-group form-group-sm">
                                                <label for="nguondon" class="control-label col-xs-3"> Nguồn đơn </label>
                                                <div class="col-xs-9">
                                                    <select id="nguondon" name="nguondon" class="form-control" onchange="displayNguonDon(this);">
                                                        @foreach(\App\Model\TableModel\DonThuTable::$arrNguonDon as $key=>$value)
                                                            @if($data[0]->nguondon == \App\Model\TableModel\DonThuTable::NGUON_DON_KHAC)
                                                                <option value="{{$key}}" selected>{{$value}}</option>
                                                            @else
                                                                <option value="{{$key}}">{{$value}}</option>
                                                            @endif

                                                        @endforeach

                                                    </select>

                                                    <div id="ttdv" class="panel panel-default" style="margin-top: 5px;{{($data[0]->nguondon == \App\Model\TableModel\DonThuTable::NGUON_DON_CO_QUAN_KHAC)?'':'display: none;'}}">

                                                        <div class="panel-heading">Thông tin đơn vị chuyển đến</div>
                                                        <div class="panel-body">
                                                            <div class="form-group form-group-sm">
                                                                <label for="cvden" class="control-label col-xs-4">Số công văn chuyển đến </label>
                                                                <div class="col-xs-8">
                                                                    <input class="form-control" type="text" id="cvden" name="cvden" value="{{$data[0]->socongvanden}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label for="ngaychuyen" class="control-label col-xs-4">Ngày ban hành </label>
                                                                <div class="col-xs-8">
                                                                    <input class="form-control" type="text" id="ngaychuyen" name="ngaychuyen" value="@if($data[0]->ngaychuyendon != '0000-00-00'){{convertNgay($data[0]->ngaychuyendon)}}@endif">
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label for="coquan" class="control-label col-xs-4">Tên cơ quan ban hành </label>
                                                                <div class="col-xs-8">
                                                                    <input class="form-control" type="text" id="coquan" name="coquan" value="{{$data[0]->coquanbanhanh}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label for="group" class="control-label col-xs-3"> Chủ thể </label>

                                                <div class="col-xs-9">
                                                    <select id="group" name="group" class="form-control" onchange="showSelect(this);">
                                                        <option id="alone" value="{{\App\Model\TableModel\DonThuTable::CA_NHAN}}" {{($data[0]->songuoi == \App\Model\TableModel\DonThuTable::CA_NHAN)?'selected':''}}>Cá nhân
                                                        </option>
                                                        <option id="some" value="{{\App\Model\TableModel\DonThuTable::TAP_THE}}" {{($data[0]->songuoi == \App\Model\TableModel\DonThuTable::TAP_THE)?'selected':''}}>Tập thể
                                                        </option>
                                                    </select>
                                                    <div style="margin-top: 15px;padding-left: 0px !important;{{($data[0]->songuoi == \App\Model\TableModel\DonThuTable::TAP_THE)?'':'display: none'}}" class="col-xs-6" id="divSoNgThamGia">
                                                        <div class="input-group input-group-sm date">
                                                            <label for="ipSoNgThamGia" class="input-group-addon">Số người tham gia</label>
                                                            <input class="form-control" type="text" id="ipSoNgThamGia" name="soNguoiThamGia" value="{{$data[0]->songuoilienquan}}">
                                                        </div>
                                                    </div>
                                                    <div id="nhom" class="panel panel-default" style="margin-top: 60px;{{($data[0]->songuoi == \App\Model\TableModel\DonThuTable::CA_NHAN)?'display: none;':''}}">
                                                        <div class="panel-heading">Thông tin người viết đơn</div>
                                                        <table  class="table table-bordered table-hover" id="donnhieunguoi" style="border-collapse: collapse;{{(count($result['nguoidaidien'] )>0)?'':'display:none;'}}">

                                                            <thead>
                                                            <tr>
                                                                <th class="col-xs-2 text-center">Họ tên</th>
                                                                <th class="col-xs-4 text-center">Địa chỉ</th>
                                                                <th class="col-xs-2 text-center">CMTND/Hộ chiếu</th>
                                                                <th class="col-xs-2 text-center">Số điện thoại</th>
                                                                <th class="col-xs-1 text-center">NĐDiện</th>
                                                                <th class="col-xs-1 text-center">Xử lý</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="bodytable">
                                                            @foreach($result['nguoidaidien'] as $nguoidaidien)
                                                                @if($nguoidaidien->enable == ENABLE)
                                                                    <tr id="{{$nguoidaidien->id}}">
                                                                        <td id="ten_{{$nguoidaidien->id}}">{{$nguoidaidien->tennguoidaidien}}</td>
                                                                        <td id="diachi_{{$nguoidaidien->id}}">{{$nguoidaidien->diachinguoidaidien}}</td>
                                                                        <td id="cmt_{{$nguoidaidien->id}}">{{$nguoidaidien->cmt}}</td>
                                                                        <td id="sdt_{{$nguoidaidien->id}}">{{($nguoidaidien->sdt == 0 ) ? '' : $nguoidaidien->sdt}}</td>
                                                                        <td id="nDD_{{$nguoidaidien->id}}"class="text-center">{{$nguoidaidien->nguoidaidien}}</td>

                                                                        <td class="text-center"><a id="{{$nguoidaidien->id}}.{{$nguoidaidien->cmt}}" class="{{($nguoidaidien->tennguoidaidien == $data[0]->tennguoivietdon && $nguoidaidien->diachinguoidaidien == $data[0]->diachinguoiviet ) ? 'text-warning' : 'text-danger'}}" onclick="{{($nguoidaidien->tennguoidaidien == $data[0]->tennguoivietdon && $nguoidaidien->diachinguoidaidien == $data[0]->diachinguoiviet ) ? 'editNguoiDaiDien(this);' : 'DeleteCongDan(this);'}}"><span class="glyphicon {{($nguoidaidien->tennguoidaidien == $data[0]->tennguoivietdon  && $nguoidaidien->diachinguoidaidien == $data[0]->diachinguoiviet) ? 'glyphicon-edit' : 'glyphicon-trash'}}"></span></a></td>

                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                        <div class="panel-body">
                                                            <div class="form-group form-group-sm">
                                                                <label for="tenkntc" class="control-label col-xs-4">Họ tên người viết đơn  <span class="text-danger">(*)</span></label>
                                                                <div class="col-xs-8">
                                                                    <input class="form-control" style="text-transform:uppercase" type="text" id="tenkntc" name="tenkntc">
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm" id="danhSachNVDThem" style="display: none">
                                                                <div class="control-label col-xs-4"></div>
                                                                <div class="col-xs-8">
                                                                    <a id="danhSachThem" onclick="DonThuTheoNguoiViet(this);" style="cursor:pointer"><i>Danh sách đơn cùng người viết >></i></a>
                                                                </div>

                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label for="diachikntc" class="control-label col-xs-4">Địa chỉ người viết đơn </label>
                                                                <div class="col-xs-8">
                                                                    <input class="form-control" type="text" id="diachikntc" name="diachikntc">
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label for="cmtThemId" class="control-label col-xs-4">CMTND/Hộ chiếu </label>
                                                                <div class="col-xs-4">
                                                                    <input class="form-control" type="text" id="cmtThemId" name="cmtThem">
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm" id="danhSachDTTrungNhauThem" style="display:none ">
                                                                <div class="control-label col-xs-4"></div>
                                                                <div class="col-xs-8">
                                                                    <a id="theoCMTThem" onclick="DonThuTheoCMT(this);" style="cursor:pointer"><i>Danh sách đơn cùng số CMND/Hộ chiếu >></i></a>
                                                                </div>

                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label for="ngayCapThemId" class="control-label col-xs-4">Ngày cấp </label>
                                                                <div class="col-xs-4">
                                                                    <input class="form-control" type="text" id="ngayCapThemId" placeholder="VD:01/01/2017"name="ngayCapThem">
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label for="noiCapThem" class="control-label col-xs-4">Nơi cấp </label>
                                                                <div class="col-xs-8">
                                                                    <input class="form-control" type="text" id="noiCapThemId" name="noiCapThem" value="C.A Tỉnh Phú Thọ" >
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label for="sdtThem" class="control-label col-xs-4">Số điện thoại </label>
                                                                <div class="col-xs-4">
                                                                    <input class="form-control" type="text" min="1" id="sdtThemId" name="sdtThem">
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label for="gtThemId" class="control-label col-xs-4">Giới tính </label>
                                                                <div class="col-xs-4">
                                                                    <select id="gtThemId" name="gioitinh" class="form-control">
                                                                        @foreach(\App\Model\TableModel\DonThuTable::$arrGioiTinh as $key=>$gT)
                                                                            <option value="{{$key}}">{{$gT}}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>

                                                            </div>

                                                            <div class="form-group form-group-sm" >
                                                                <label for="daidien" class="control-label col-xs-4">Là người đại diện </label>
                                                                <div class="col-xs-8">
                                                                    <input type="checkbox" id="daidien"  name="daidien">
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm" >
                                                                <div class="col-xs-8 col-xs-offset-4">
                                                                    <input type="button" class="btn btn-sm btn-success" value="Thêm" id="addmore" onclick="btnThemCD(this);">
                                                                    <input type="button" class="btn btn-sm btn-warning" value="luu" id="saveEdit" onclick="btnLuuEdit(this);" style="display:none">
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm" style="padding-top: 1%;">
                                                                <label for="vbuyquyen" class="control-label col-xs-4">Văn bản ủy quyền </label>
                                                                <div class="col-xs-8">
                                                                    <input type="file" id="vbuyquyen" name="vbuyquyen">
                                                                    @if($data[0]->vanbanuyquyen != null)
                                                                        <div id="hienthifilevbuyquyen" class="col-xs-8" style="margin-top: 10px">
                                                                            <a href="{{url($data[0]->filepath.$data[0]->vanbanuyquyen)}}" title='Tải về' download>
                                                                                <img src="{{url('/img/file.png')}}" style="height:25px;width:20px"/>&nbsp;{{$data[0]->vanbanuyquyen}}
                                                                            </a>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="donMotNguoi" style="{{($data[0]->songuoi == \App\Model\TableModel\DonThuTable::CA_NHAN)?'':'display:none;'}}">

                                                <div class="form-group form-group-sm">
                                                    <label for="tennguoiviet" class="control-label col-xs-3"> Họ tên người viết đơn <span class="text-danger">(*)</span></label>
                                                    <div class="col-xs-9">
                                                        <input class="form-control" type="text" id="tennguoivietID" name="tennguoiviet" style="text-transform:uppercase" value="{{$data[0]->tennguoivietdon}}" >
                                                    </div>

                                                </div>
                                                @foreach($result['nguoidaidien'] as $nguoidaidien)
                                                    @if($nguoidaidien->enable == ENABLE && $nguoidaidien->tennguoidaidien == $data[0]->tennguoivietdon)
                                                        <input  type="hidden" id="idNguoiDaiDienId" name="idNguoiDaiDien"  value="{{$nguoidaidien->id}}" >
                                                        <input  type="hidden" id="valueNguoiDaiDienId" name="valueNguoiDaiDien"  value="{{$nguoidaidien->nguoidaidien}}" >
                                                    @endif
                                                @endforeach

                                                <div class="form-group form-group-sm" id="danhSachNVD" style="display: none">
                                                    <div class="control-label col-xs-3"></div>
                                                    <div class="col-xs-9">
                                                        <a id="theoNguoiViet" onclick="DonThuTheoNguoiViet(this);" style="cursor:pointer"><i>Danh sách đơn cùng người viết >></i></a>
                                                    </div>

                                                </div>

                                                <div class="form-group form-group-sm">
                                                    <label for="diachi" class="control-label col-xs-3">Địa chỉ người viết đơn </label>
                                                    <div class="col-xs-9">
                                                        <input name="diachi" type="text" id="diachiID" class="form-control" value="{{$data[0]->diachinguoiviet}}">
                                                    </div>
                                                </div>

                                                <div class="form-group form-group-sm">
                                                    <label for="sdt" class="control-label col-xs-3">Số điện thoại</label>
                                                    <div class="col-xs-2">
                                                        <input name="sdt" type="text" maxlength="20" id="sdtID" class="form-control" value="{{($data[0]->sdt == 0) ? '' : $data[0]->sdt}}">
                                                    </div>

                                                    <div class="col-xs-3">
                                                        <div class="input-group input-group-sm date">
                                                            <label for="gioitinh" class="input-group-addon">Giới tính </label>
                                                            <select id="gioitinhId" name="gioitinh" class="form-control">
                                                                @foreach(\App\Model\TableModel\DonThuTable::$arrGioiTinh as $key=>$gT)
                                                                    <option value="{{$key}}" {{($data[0]->gioitinh == $key)?'selected':''}}>{{$gT}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group form-group-sm">
                                                    <label for="cmt" class="control-label col-xs-3">Số CMND/Hộ chiếu </label>
                                                    <div class="col-xs-2">
                                                        <input name="cmt" type="text" maxlength="15" id="cmt" class="form-control" value="{{$data[0]->cmnd_hc}}">
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <div class="input-group input-group-sm date">
                                                            <span class="input-group-addon">Ngày cấp</span>
                                                            @if($data[0]->ngaycap != '0000-00-00')
                                                                <input name="ngaycap" type="text" maxlength="10" id="ngaycapID" class="form-control" value="{{date("d/m/Y",strtotime($data[0]->ngaycap))}}" placeholder="VD:01/01/2017">
                                                            @else
                                                                <input name="ngaycap" type="text" maxlength="10" id="ngaycapID" class="form-control" placeholder="VD:01-01-2017" value="">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-addon">Nơi cấp</span>
                                                            <input name="noicap" type="text" maxlength="50" id="noicapID" class="form-control" value="{{$data[0]->noicap}}">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm" id="danhSachDTTrungNhau" style="display: none">
                                                    <div class="control-label col-xs-3"></div>
                                                    <div class="col-xs-9">
                                                        <a id="danhsachCMT" onclick="DonThuTheoCMT(this);" style="cursor:pointer"><i>Danh sách đơn cùng số CMND/Hộ chiếu >></i></a>
                                                    </div>

                                                </div>

                                                <div class="form-group form-group-sm">
                                                    <label for="image" class="control-label col-xs-3" >Ảnh người viết đơn</label>
                                                    <div class="col-xs-9">
                                                        <input name="anhdaidien" type="file" id="image" >
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group form-group-sm">
                                                <label for="loaidon" class="control-label col-xs-3"> Loại đơn </label>
                                                <div class="col-xs-9">
                                                    <select class="form-control" id="loaidon" name="loaidon" onchange="displaySelect(this);">
                                                        <option value=""></option>
                                                        @for($i = 0; $i<count($loaidon);$i++)
                                                            <option value="{{$loaidon[$i]->loaidonid}}" {{($result['phanloai'][0]->loaidon == $loaidon[$i]->loaidonid)?'selected':''}}>{{$loaidon[$i]->tenloaidon}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label id="dtkhieunai" for="dtkntc" class="control-label col-xs-3" >
                                                    Đối tượng trên đơn
                                                </label>
                                                <div class="col-xs-9">
                                                    <input name="doituong" type="text" id="dtbtc" style="text-transform:uppercase" class="form-control" value="{{$data[0]->doituongkhieunai}}">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label for="nguoiLienQuanId" class="control-label col-xs-3">Người có quyền lợi, nghĩa vụ liên quan <span class="text-danger"></span></label>

                                                <div class="col-xs-9">
                                                    <input class="form-control" type="text" style="text-transform:uppercase" id="nguoiLienQuanId" name="nguoiLienQuan" value="{{$data[0]->nguoiLienQuan}}">
                                                </div>

                                            </div>

                                            <div class="form-group form-group-sm">
                                                <label for="noidungdon" class="control-label col-xs-3"> Nội dung ghi trên đơn </label>

                                                <div class="col-xs-9">
                                                    <textarea class="form-control" rows="5" cols="20" id="noidungdon" name="noidungdon">{{$data[0]->noidung}}</textarea>
                                                </div>

                                            </div>
                                        <div class="form-group form-group-sm" style="display:{{($lanhDaoPermision == VANTHU)?'none':''}}">
                                            <label for="nguoixuly" class="control-label col-xs-3">Người xử lý <span class="text-danger">(*)</span></label>
                                            <div class="col-xs-4">
                                                <select name="nguoixuly" id="nguoixuly" class="form-control">
                                                    <option value="">---------- Chọn người xử lý ---------</option>
                                                    @for($i = 0; $i<count($nguoiXL);$i++)

                                                        <option value="{{$nguoiXL[$i]->accountid}}" {{($result['phanloai'][0]->nguoixuly == $nguoiXL[$i]->accountid)?'selected':''}}>{{$nguoiXL[$i]->fullname}}</option>

                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-sm" style="display:{{($lanhDaoPermision == VANTHU)?'none':''}}">
                                            <label for="huonggiaiquyet" class="control-label col-xs-3">Hướng giải quyết</label>
                                            <div class="col-xs-4">
                                                <select name="huonggiaiquyet" id="huonggiaiquyet" class="form-control" onchange="Display(this);">
                                                    <option value="{{THULY}}" {{($result['phanloai'][0]->huonggiaiquyet==THULY)?'selected':''}}>Thụ lý đơn thuộc thẩm quyền</option>
                                                    <option value="{{TRADON}}" {{($result['phanloai'][0]->huonggiaiquyet==TRADON)?'selected':''}}>Trả đơn và hướng dẫn</option>
                                                    <option value="{{CHUYENDON}}" {{($result['phanloai'][0]->huonggiaiquyet==CHUYENDON)?'selected':''}}>Chuyển đơn</option>
                                                    <option value="{{HUONGDAN}}" {{($result['phanloai'][0]->huonggiaiquyet==HUONGDAN)?'selected':''}}>Hướng dẫn</option>
                                                    <option value="{{DONDOC}}" {{($result['phanloai'][0]->huonggiaiquyet==DONDOC)?'selected':''}}>Đôn đốc giải quyết đơn quá hạn</option>

                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group form-group-sm" style="display:{{($lanhDaoPermision == VANTHU)?'none':''}}">
                                            <label for="yKienCD" class="control-label col-xs-3">Ý kiến giao việc và chỉ đạo</label>
                                            <div class="col-xs-9">
                                                <textarea name="yKienCD" rows="5" cols="5" id="yKienCD" class="form-control"></textarea>
                                            </div>
                                        </div>
                                            <div class="form-group form-group-sm">
                                                <label class="control-label col-xs-3"> Văn bản đính kèm</label>
                                                <div class="col-xs-9">
                                                    <div class="row">
                                                        <div id="fileinput" class="col-xs-10">
                                                            <input id="file1" type="file" name="file1">
                                                            <input id="file2" type="file" name="file2" style="margin-top: 5px;display: none">
                                                            <input id="file3" type="file" name="file3" style="margin-top: 5px;display: none">
                                                            <input id="file4" type="file" name="file4" style="margin-top: 5px;display: none">
                                                            <input id="file5" type="file" name="file5" style="margin-top: 5px;display: none">
                                                        </div>
                                                        <div class="col-xs-2 text-right" style="padding: 0">
                                                            <span id="addfile" class="btn btn-xs btn-success glyphicon glyphicon-plus"  style="cursor: pointer" onclick="AddInput()"></span>
                                                            <span id="remove" class="btn btn-xs btn-danger glyphicon glyphicon-minus" onclick="RemoveInput();" style="cursor: pointer"></span>
                                                        </div>
                                                        @if($array_file!= null)

                                                            <div id="hienthifile" class="col-xs-10" style="margin-top: 10px">
                                                                @for($i = 0;$i<count($array_file);$i++)
                                                                    <a href="{{url($data[0]->filepath."/".$array_file[$i])}}" title='Tải về' download>
                                                                        <img id="hinhanhdaidien" src="{{url('/img/file.png')}}" style="height:25px;width:20px"/>&nbsp;{{$array_file[$i]}}
                                                                    </a>
                                                                @endfor
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <input id="tabletemp" type="hidden" name="tabletemp" >
                                                <input id="tableDeleteId" type="hidden" name="tableDelete" >
                                                <input id="tableSaveId" type="hidden" name="tableSave" >
                                                <input id="nguoiDaiDienSaveId" type="hidden" name="nguoiDaiDienSave">
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <div class="col-xs-offset-3 col-xs-9">
                                                    <input type="submit" name="save" value="Lưu"  id="save" class="btn btn-sm btn-success">
                                                    <input type="button" value="Hủy" id="{{$result['noidung'][0]->donthuid}}" onclick="backtochitietdonthu(this.id)" class="btn btn-sm btn-danger">
                                                </div>
                                            </div>
                                    </div>
                                </td>
                            </tr>


                            </tbody>
                        </table>

                </div>
            </div>
            </div>
        </form>
    </div>

    <script>
        var no =1;
        var nguoikntc_no = 1;
        var danhSachNguoiXuLy = <?php echo json_encode($danhSachNhanVien)?>;
        var donThuAll = <?php echo json_encode($donthuAll)?>;

        //get value select

        var donThu = <?php echo json_encode($result['noidung'][0])?>;

        function displayNguonDon(e) {

            var cqKhac = '{{\App\Model\TableModel\DonThuTable::NGUON_DON_CO_QUAN_KHAC}}';
            if(e.value == cqKhac)
            {
                $('#ttdv').show();

            }
            else {
                $('#ttdv').hide();

            }

        }

        function showSelect(e)
        {

            switch (e.value)
            {
                case "donvi":
                    $('#ttdv').show();
                    break;
                case "dodan":
                    $('#ttdv').hide();
                    break;
                case "Lần 1":
                    $('#number').hide();
                    break;
                case "Lần 2":
                    $('#number').show();
                    break;
                case'{{\App\Model\TableModel\DonThuTable::TAP_THE}}':
                    $('#nhom').show();
                    $('#divSoNgThamGia').show();
                    $('#donMotNguoi').hide();
                    break;
                case'{{\App\Model\TableModel\DonThuTable::CA_NHAN}}':
                    $('#nhom').hide();
                    $('#divSoNgThamGia').hide();
                    $('#donMotNguoi').show();
                    resetThongTin();
                    break;
                default:
                    break;
            }
        }

        function displaySelect(e)
        {
            var str = "";

            if(e.value == 1)
            {
                $('#lanKN').show();
                $('#dtkhieunai').text("Đối tượng bị khiếu nại");
                $('#diachiDT').text("Địa chỉ đối bị tượng khiếu nại");
            }
            else
            {
                $('#lanKN').hide();
                switch(e.value) {
                    case "2":
                        $('#dtkhieunai').text("Đối tượng bị tố cáo");
                        $('#diachiDT').text("Địa chỉ đối bị tượng tố cáo");
                        break;
                    case "3":
                        $('#dtkhieunai').text("Đối tượng bị khiếu nại, tố cáo");
                        $('#diachiDT').text("Địa chỉ đối tượng bị khiếu nại, tố cáo");
                        break;
                    case "4":
                        $('#dtkhieunai').text("Cơ quan đơn vị có thẩm quyền giải quyết");
                        $('#diachiDT').text("Địa chỉ cơ quan đơn vị");
                        break;
                    default:
                        $('#dtkhieunai').text("Đối tượng trên đơn");
                        $('#diachiDT').text("Địa chỉ đối tượng trên đơn");
                }

            }

        }

        function diaBanSelect(e) {

            if(e.value == "")
            {
                var noidungbangdonvi = '';
                noidungbangdonvi += '' +
                    '<select class="form-control" id="donviID" name="donvi" onchange="donViSelect(this)">' +
                    '</select>' +
                    '';

                document.getElementById("bangdonvi").innerHTML = '';
                document.getElementById("bangdonvi").innerHTML = noidungbangdonvi;

                GetNguoiXuLy("","");

            }else {
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '{{URL::to('getDonViTheoDiaBan')}}',
                    data: {
                        diabanid: e.value
                    },
                    success: function (response) {
                        var donvidata = response['donvitheodiaban_result'];

                        var selectdonvi = '';
                        for (var i = 0; i < donvidata.length; i++) {

                            var tendonvi = donvidata[i]['tendonvi'];
                            var donviid = donvidata[i]['id'];
                            selectdonvi += '<option value="' + donviid + '">' + tendonvi + '</option>';
                        }

                        var noidungbangdonvi = '';
                        noidungbangdonvi += '' +
                            '<select class="form-control" id="donviID" name="donvi" onchange="donViSelect(this)">' +
                            selectdonvi +
                            '</select>' +
                            '';

                        document.getElementById("bangdonvi").innerHTML = '';
                        document.getElementById("bangdonvi").innerHTML = noidungbangdonvi;


                        var diaBanId = $('#diabanID').val();
                        var donViIdFirst =  $('#donviID').find("option:first-child").val();

                        GetNguoiXuLy(diaBanId,donViIdFirst);
                    }
                });
            }

        }

        //event click button
        function clickBtn(d)
        {
//            console.log(d.id);
            switch (d.id)
            {
                case "add":
                    document.getElementById("dtkn").style ='margin-top: 5px;';
                    document.getElementById("add").style.display ='none';
                    document.getElementById("close").style ='';
                    break;
                case "close":
                    document.getElementById("dtkn").style.display ='none';
                    document.getElementById("add").style ='';
                    document.getElementById("close").style.display ='none';
                    break;
                case "addmore":
                    document.getElementById("donnhieunguoi").style = '';
                    var tenkntc = document.getElementById("tenkntc").value;
                    var diachikntc = document.getElementById("diachikntc").value;
                    var daidien = document.getElementById("daidien").checked;
                    var value = "o";
                    if((tenkntc.trim() != '' )&&(diachikntc.trim() != '')){
                        //console.log(daidien);
                        if (daidien == true) {
                            value = "x";
                        }
                        var data = document.getElementById("tabletemp").value;
                        var temp = tenkntc + "-" + diachikntc + "-" + value;
                        if (data == "") {
                            data = temp;
                        }
                        else {
                            data = data + "." + temp;
                        }
                        document.getElementById("tabletemp").value = data;
                        $(function () {
                            $('#bodytable').append('<tr>' +
                                    '<td>' + tenkntc + '</td>' +
                                    '<td>' + diachikntc + '</td>' +
                                    '<td class="text-center">' + value + '</td>' +
                                    '<td class="text-center">' +
                                    '<a id="' + nguoikntc_no + '" class="text-danger" onclick="DeleteRow(this);">' +
                                    '<span class="glyphicon glyphicon-trash">' + '</span>' +
                                    '</a>' +
                                    '</td>' +
                                    '</tr>');
                        });
                        nguoikntc_no++;
                    }else{
                        alert('Mời nhập tên và địa chỉ người khiếu nại/tố cáo');
                    }
                    break;
                case "themdtbikntc":
                    var doituongkntc = document.getElementById("dtbikntc").value;
                    var tenvanbankntc = document.getElementById("vbkntc").value;
                    var dichidoituongkntc = document.getElementById("dcdtbikntc").value;

                    if(doituongkntc.trim() != '') {

                        $.ajax({
                            type: 'get',
                            dataType: 'json',
                            url:  '{{URL::to('themdoituongkhieunaitocao')}}',
                            data: {
                                tenvanban:tenvanbankntc,
                                tendoituong: doituongkntc,
                                diachi:dichidoituongkntc
                            },
                            success: function (response) {
//                            alert(response['themdoituongkhieunaitocao_result']);

                                var doituongkntcid = response['themdoituongkhieunaitocao_result'];

                                $(function () {
                                    $('#dtkntc').append('<option value="' + doituongkntcid + '">' + doituongkntc + '</option>');
                                });
                                document.getElementById("dtkn").style.display = 'none';
                                document.getElementById("add").style = '';
                                document.getElementById("close").style.display = 'none';
                            }
                        });
                    }else {
                        alert('Mời nhập tên đối tượng khiếu nại');
                    }
                    break;
                case "huy":
                    var href = "{{url('/danhsachdonthu')}}";
                    window.location.href = href;
                    break;
                case"continue":
                    window.location.href = "{{url('/phanloaidonthu')}}"+"/"+d.value;
                    break;
                case "back":
                    window.location.href = "{{url('/danhsachdonthu')}}";
                    break;
                default:
                    break;
            }

        }
        /* delete row */
        function DeleteRow(d)
        {

            var row = d.parentNode.parentNode;
            row.parentNode.removeChild(row);
            var dataTable = document.getElementById("tabletemp").value;
            var dataRow = dataTable.split(".");
            dataRow.splice(d.id-1,1);

            var data = "";
            for(var count = 0; count < dataRow.length; count++)
            {
                if(count == 0)
                {
                    data = dataRow[count];
                }
                else
                {
                    data = data + "." + dataRow[count];
                }
            }
            document.getElementById("tabletemp").value = data;


        }


        //date picker
        $( function() {
            $( "#ngayviet" ).datepicker({format: 'dd/mm/yyyy'});
            $( "#ngaynhan" ).datepicker({format: 'dd/mm/yyyy'});
            $( "#ngaychuyen" ).datepicker({format: 'dd/mm/yyyy'});
            $( "#ngaycapID" ).datepicker({format: 'dd/mm/yyyy'});
            $( "#ngayCapThemId" ).datepicker({format: 'dd/mm/yyyy'});
            $( "#ngayGiaoXLId" ).datepicker({format: 'dd/mm/yyyy'});
        } );

        //chon don thu
        function ChonDonThu()
        {
            var  searchValue = $('#tennguoiviet').val();
            if (searchValue.length <= 0)
            {
                searchValue = $('#donlan01').val();
                if(searchValue.length <=0)
                {
                    searchValue ="a";
                }
            }
            var url ="{{url('/SearchDonThu')}}";
            OpenPopup(url,searchValue,590,400);
        }

        /* check input time */
        function validateTwoDates() {
            var dateStart = $("#ngayviet").val();
            var dateEnd = $("#ngaynhan").val();
            return(dateEnd >= dateStart);
        }


        function test(){
            if (! validateTwoDates()) {
                alert('Ngày nhận đơn phải lớn hơn ngày viết đơn!');
                document.getElementById("ngaynhan").value = "";
            }
        }

        /* Check input null*/
        function CkeckInput() {
            var str = "";
            str += CheckInput('sothuly', "Vui lòng nhập số thụ lý.\r\n");
            str += CheckInput('ngayviet', "Vui lòng nhập ngày viết đơn.\r\n");
            str += CheckInput('ngaynhan', "Vui lòng nhập ngày nhận đơn.\r\n");
            str += CheckInput('tennguoiviet', "Vui lòng nhập tên người gửi.\r\n");
            str += CheckInput('diachi', "Vui lòng nhập địa chỉ người gửi.\r\n");
            str += CheckInput('noidungdon', "Vui lòng nhập nội dung đơn.\r\n");

            if ($('#nguondon').val() == "donvi") {
                str += CheckInput('cvden', "Vui lòng nhập số công văn đến.\r\n");
                str += CheckInput('ngaychuyen', "Vui lòng nhập ngày chuyển đơn.\r\n");
                str += CheckInput('coquan', "Vui lòng chọn đơn vị chuyển đơn.\r\n");
            }
            if ($('#group').val() == "1") {
                str += CheckInput('tenkntc', "Vui lòng nhập họ tên người khiếu nại/tố cáo.\r\n");
                str += CheckInput('diachikntc', "Vui lòng nhập địa chỉ người khiếu nại/tố cáo.\r\n");
                str += CheckInput('daidien', "Vui lòng chọn người đại diện.\r\n");
//                str += CheckInput('vbuyquyen', "Vui lòng chọn văn bản ủy quyền.\r\n");
            }

            if ($('#lan').val() == "Lần 2") {
                str += CheckInput('donlan01', "Vui lòng chọn đơn lần 1.\r\n");
            }

            if (str.length > 0) {
                alert(str);
                return false;
            }
            return true;
        }

        function backtochitietdonthu(donthuid){
            var chitietdonthuurl = <?php echo json_encode(url('/chitietdonthu')); ?>;
            window.location.href = chitietdonthuurl+'/'+donthuid;
        }

        //

        //
        function ChonDiaBan()
        {
            var url ="{{url('/diabantable')}}" ;
            OpenPopupGetData(url,400,380);
        }
        //
        function ChonDonVi()
        {
            var url ="<?php echo e(url('/donvitable')); ?>" ;
            OpenPopupGetData(url,400,380);
        }
        //file input
        //add input file
        var numInput = 1;
        function AddInput() {
            if (numInput + 1 <= 5) {
                numInput++;
                var panel = $('#file' + numInput);
                panel.show();
            }
        }
        function RemoveInput() {
            if (numInput > 1) {
                var panel = $('#file' + numInput);
                panel.val(null);
                panel.hide();
                numInput--;
            }
        }

        //
        $('#sothuly').bind('keydown', function (event) {
            switch (event.keyCode) {
                case 8:  // Backspace
                case 9:  // Tab
                case 13: // Enter
                case 37: // Left
                case 38: // Up
                case 39: // Right
                case 40: // Down
                    break;
                default:
                    var regex = new RegExp("^[0-9,/]+$");
                    var key = event.key;
                    if (!regex.test(key)) {
                        event.preventDefault();
                        return false;
                    }
                    break;
            }
        });

        function popupWindow(d) {
            var id = $('#ctl00_hidIdDT').val();
            var url = "{{url('/detaildonthulan1')}}";
            var path = url+"/"+id;
            var myWindow = null;
            if (id!= "")
            {
                myWindow = window.open(path, "","width=500,height=500");
            }
            else
            {

            }

        }

        //auto complete

        $('#cmtThemId').keyup(function(){
            var cmt_value= $('#cmtThemId').val();
            if(cmt_value != "")
            {
                $.ajax({
                    type: 'get',
                    url: '{{URL::to('donthugiongnhau')}}',
                    data: {
                        value:cmt_value,
                        filed:'cmnd_hc',
                        table:'donthu'
                    },
                    success: function (data) {

                        if(data != "")
                        {
                            $('#danhSachDTTrungNhauThem').show();
                        }
                        else
                        {
                            $('#danhSachDTTrungNhauThem').hide();
                        }
                    }
                });
            }

        });



        $('#cmt').keyup(function(){
            var cmt_value= $('#cmt').val();
            if(cmt_value != "")
            {
                $.ajax({
                    type: 'get',
                    url: '{{URL::to('donthugiongnhau')}}',
                    data: {
                        value:cmt_value,
                        filed:'cmnd_hc',
                        table:'donthu'
                    },
                    success: function (data) {

                        if(data != "")
                        {
                            $('#danhSachDTTrungNhau').show();
                        }
                        else
                        {
                            $('#danhSachDTTrungNhau').hide();
                        }
                    }
                });
            }

        });

        $("#tenkntc").keyup(function(e) {
//            if(e.which == 13) {
                var tenNguoiVD = $('#tenkntc').val();
                if(tenNguoiVD != "")
                {
                    $.ajax({
                        type: 'get',
                        url: '{{URL::to('donthugiongnhau')}}',
                        data: {
                            value:tenNguoiVD,
                            filed:'tennguoivietdon',
                            table:'donthu'
                        },
                        success: function (data) {


                            if(data != "")
                            {
                                $('#danhSachNVDThem').show();
                            }
                            else
                            {
                                $('#danhSachNVDThem').hide();
                            }
                        }
                    });
                }
//            }
        });


        $("#tennguoivietID").keyup(function(e) {
//            if(e.which == 13) {
            var tenNguoiVD = $('#tennguoivietID').val();
            if(tenNguoiVD != "")
            {
                $.ajax({
                    type: 'get',
                    url: '{{URL::to('donthugiongnhau')}}',
                    data: {
                        value:tenNguoiVD,
                        filed:'tennguoivietdon',
                        table:'donthu'
                    },
                    success: function (data) {


                        if(data != "")
                        {
                            $('#danhSachNVD').show();
                        }
                        else
                        {
                            $('#danhSachNVD').hide();
                        }
                    }
                });
            }
//            }
        });

        function DonThuTheoNguoiViet(d)
        {
            var  tenNguoiVD = "";
            if (d.id == "danhSachThem")
            {
                tenNguoiVD = $('#tenkntc').val()+'*'+'tennguoivietdon'+'*'+'donthu';
            }
            else
            {
                tenNguoiVD = $('#tennguoivietID').val()+'*'+'tennguoivietdon'+'*'+'donthu';
            }


            var url ="{{url('/danhSachDonThuCungCMT')}}";
            OpenPopup(url,tenNguoiVD,700,400);
        }

        function DonThuTheoCMT(d)
        {
            var  cmtValue ="";
            if (d.id == "theoCMTThem")
            {
                cmtValue = $('#cmtThemId').val()+'*'+'cmnd_hc'+'*'+'donthu';
            }
            else
            {
                cmtValue = $('#cmt').val()+'*'+'cmnd_hc'+'*'+'donthu';
            }


            var url ="{{url('/danhSachDonThuCungCMT')}}";
            OpenPopup(url,cmtValue,590,400);
        }

        //don nhieu nguoi
        var checkDD = <?php echo json_encode($result['checkDD']);?>;
        var checkNhomNguoi = <?php echo json_encode($result['checkDaiDien']);?>;
        var checkDaiDien = 1;
        var checkCongDan = 1;
        var lanMot = false;

        if (checkDD > 0)
        {
            lanMot == true;
            checkDaiDien = 2;
        }

        if(checkNhomNguoi >0)
        {
            lanMot == true;
            checkCongDan = 2;
        }

        function btnThemCD(d)
        {
            var tenCD = $('#tenkntc').val();
            var diaChi = $('#diachikntc').val();
            var cmt = $('#cmtThemId').val();
            var ngayCap = $('#ngayCapThemId').val();
            var noiCap = $('#noiCapThemId').val();
            var sdt = $('#sdtThemId').val();
            var sothuly = $('#sothuly').val();
            var daidien = document.getElementById("daidien").checked;
            var value = "o";

            if (daidien == true) {
                value = "x";
                if (lanMot==false && checkDaiDien == 1)
                {
                    lanMot == true;
                    $('#tennguoivietID').val(tenCD);
                    $('#diachiID').val(diaChi);
                    $('#cmt').val(cmt);
                    $('#ngaycapID').val(ngayCap);
                    $('#noicapID').val(noiCap);
                    $('#sdtID').val(sdt);
                    checkDaiDien++;
                }
            }
            else {
                if(lanMot == false && checkCongDan== 1){
                    lanMot == true;
                    $('#tennguoivietID').val(tenCD);
                    $('#diachiID').val(diaChi);
                    $('#cmt').val(cmt);
                    $('#ngaycapID').val(ngayCap);
                    $('#noicapID').val(noiCap);
                    $('#sdtID').val(sdt);
                    checkCongDan++;
                }
            }

            if(tenCD !="")
            {
                $.ajax({
                    type: 'get',
                    url:  '{{URL::to('themcongdankhac')}}',
                    data: {
                        sothuly:sothuly,
                        tenCongDan:tenCD,
                        diaChi: diaChi,
                        cmt:cmt,
                        ngayCap:ngayCap,
                        noiCap:noiCap,
                        sodt:sdt,
                        value:value,
                        type:'donthu'
                    },
                    success: function (data) {

                        if (data.length>0)
                        {
                            var sdt = '';
                            if(data[5]!= null)
                            {
                                sdt = data[5];
                            }
                            AnHienPanel('#donnhieunguoi',true);
                            $(function () {
                                $('#bodytable').append('<tr id="'+data[0]+'">' +
                                        '<td>' + data[1] + '</td>' +
                                        '<td>' + data[2] + '</td>' +
                                        '<td >' + data[3] + '</td>' +
                                        '<td >' + sdt + '</td>' +
                                        '<td class="text-center">' + data[4] + '</td>' +
                                        '<td class="text-center">' +
                                        '<a id="' + data[0] + '.'+data[3]+'" class="text-danger" onclick="DeleteCongDan(this);">' +
                                        '<span class="glyphicon glyphicon-trash">' + '</span>' +
                                        '</a>' +
                                        '</td>' +
                                        '</tr>');
                            });

                            var valueSave = $('#tableSaveId').val();
                            var saveId = data[0];
                            if(valueSave == "")
                            {
                                valueSave = saveId;
                            }
                            else
                            {
                                valueSave = valueSave+'.'+saveId;
                            }
                            $('#tableSaveId').val(valueSave);

                            $('#tenkntc').val(null);
                            $('#diachikntc').val(null);
                            $('#cmtThemId').val(null);
                            $('#ngayCapThemId').val(null);
                            $('#noiCapThemId').val(null);
                            $('#sdtThemId').val(null);
                            $("#daidien").prop('checked', false);
                        }
                    }
                });
            }
            else
            {
                var str = "";

                str += CheckInput('tenkntc', "Vui lòng nhập tên người viết đơn.\r\n");

                if (str.length > 0) {
                    alert(str);
                }
            }


        }

        function DeleteCongDan(d)
        {

            var congDanId =  d.id.split('.');
            congDanId = congDanId[0];
            var valueDelete = $('#tableDeleteId').val();
            var deleteId = congDanId;
            if(valueDelete == "")
            {
                valueDelete = deleteId;
            }
            else
            {
                valueDelete = valueDelete+'.'+deleteId;
            }
            $('#tableDeleteId').val(valueDelete);

            $('#'+congDanId).hide();

        }

        //edit nguoi dai dien
        var editId = "";
        function editNguoiDaiDien(d)
        {
             editId =  d.id.split('.');
            editId = editId[0];


           var tenEdit  = $('#tennguoivietID').val();
           var diaChiEdit =  $('#diachiID').val();
           var cmtEdit = $('#cmt').val();
           var ngayCapEdit = $('#ngaycapID').val();
           var noiCapEdit = $('#noicapID').val();
           var sdtEdit = $('#sdtID').val();

            $('#tenkntc').val(tenEdit);
            $('#diachikntc').val(diaChiEdit);
            $('#cmtThemId').val(cmtEdit);
            $('#ngayCapThemId').val(ngayCapEdit);
            $('#noiCapThemId').val(noiCapEdit);
            $('#sdtThemId').val(sdtEdit);
            if (checkDD >0)
            {
                $("#daidien").prop('checked', true);
            }

            AnHienPanel('#saveEdit',true);
            AnHienPanel('#addmore',false);
        }

        //luu edit
        function btnLuuEdit()
        {
          var tenSave =  $('#tenkntc').val();
          var diaChiSave =  $('#diachikntc').val();
          var cmtSave =  $('#cmtThemId').val();
          var ngayCapsave =   $('#ngayCapThemId').val();
          var noiCapThemSave =   $('#noiCapThemId').val();
          var sdtThemSave =   $('#sdtThemId').val();


            var daiDienSave = document.getElementById("daidien").checked;
            var nDDValue = "o";
             var checkDDSave = editId+'.'+nDDValue;

            if (daiDienSave == true)
            {
                nDDValue = "x";
                checkDDSave = editId+'.'+nDDValue;
            }

           $('#nguoiDaiDienSaveId').val(checkDDSave);

            $('#tennguoivietID').val(tenSave);
            $('#diachiID').val(diaChiSave);
            $('#cmt').val(cmtSave);
            $('#ngaycapID').val(ngayCapsave);
            $('#noicapID').val(noiCapThemSave);
            $('#sdtID').val(sdtThemSave);

            $('#ten_'+editId).html(tenSave);
            $('#diachi_'+editId).html(diaChiSave);
            $('#cmt_'+editId).html(cmtSave);
            $('#sdt_'+editId).html(sdtThemSave);
            $('#nDD_'+editId).html(nDDValue);

            $('#tenkntc').val(null);
            $('#diachikntc').val(null);
            $('#cmtThemId').val(null);
            $('#ngayCapThemId').val(null);
            $('#noiCapThemId').val(null);
            $('#sdtThemId').val(null);
            $("#daidien").prop('checked', false);

            AnHienPanel('#saveEdit',false);
            AnHienPanel('#addmore',true);

        }

        //reset
        function resetThongTin()
        {

            $('#tableDeleteId').val(null);
            $('#tableSaveId').val(null);

            $('#tennguoivietID').val(donThu['tennguoivietdon']);
            $('#diachiID').val(donThu['diachinguoiviet']);
            $('#cmt').val(donThu['cmnd_hc']);
            $('#ngaycapID').val(donThu['ngaycap']);
            $('#noicapID').val(donThu['noicap']);
            $('#sdtID').val(donThu['adt']);

            $('#ten_'+editId).html(donThu['tennguoivietdon']);
            $('#diachi_'+editId).html(donThu['diachinguoiviet']);
            $('#cmt_'+editId).html(donThu['cmnd_hc']);
            $('#sdt_'+editId).html(donThu['adt']);

            var checkDD_xo = $('#valueNguoiDaiDienId').val();

            $('#nDD_'+editId).html(checkDD_xo);
        }

        //don vi select
        function donViSelect(e)
        {
            var iddb = $('#diabanID').val();
            var valueDV = e.value;
            GetNguoiXuLy(iddb,valueDV);
        }
        //get nguoi xu ly

        function GetNguoiXuLy(diaBanId,donViId)
        {

            if(donViId != "")
            {
                $.ajax({
                    type: 'get',
                    url:  '{{URL::to('GetNguoiXuLy')}}',
                    data: {
                        diabanId:diaBanId,
                        donviId:donViId
                    },
                    success: function (data) {

                        var selectNguoiXuLy = '';
                        for (var i = 0; i < data.length; i++) {

                            var tenNguoiXuLy = data[i]['fullname'];
                            var accuntId = data[i]['accountid'];
                            selectNguoiXuLy += '<option  value="'+accuntId+'">' +tenNguoiXuLy+'</option>';
                        }

                        var noidungbangnguoixuly = '';
                        noidungbangnguoixuly += '' +
                                '<select name="nguoixuly" id="nguoixulyID" class="form-control" >' +
                                selectNguoiXuLy +
                                '</select>' +
                                '';

                        document.getElementById("bangnguoixuly").innerHTML = '';
                        document.getElementById("bangnguoixuly").innerHTML = noidungbangnguoixuly;
                    }
                });
            }
            else
            {
                var selectName = '';
                for (var i = 0; i < danhSachNguoiXuLy.length; i++) {

                    var fullName = danhSachNguoiXuLy[i]['fullname'];
                    var idAccount = danhSachNguoiXuLy[i]['accountid'];
                    selectName += '<option  value="'+idAccount+'">' +fullName+'</option>';
                }

                var tablenguoixuly = '';
                tablenguoixuly += '' +
                        '<select name="nguoixuly" id="nguoixulyID" class="form-control" >' +
                        selectName +
                        '</select>' +
                        '';

                document.getElementById("bangnguoixuly").innerHTML = '';
                document.getElementById("bangnguoixuly").innerHTML = tablenguoixuly;
            }
        }

        //auto complete

        var soThuLyAuto = new Array();
        createDataAuto();
        function createDataAuto ()
        {
            for(var i =0 ;i<donThuAll.length;i++)
            {
                soThuLyAuto[i] = {id:donThuAll[i]['donthuid'],value:'['+donThuAll[i]['sothuly']+'] '+donThuAll[i]['tennguoivietdon']+donThuAll[i]['coquanbanhanh'],data:donThuAll[i]['tennguoivietdon']}
            }

        }

        $('#donChaId').autocomplete({
            lookup: soThuLyAuto,
            onSelect: function (suggestion) {
                var thehtml = suggestion.id ;
                $('#luuDonChaId').val(thehtml);
            }
        });

        var donthuId = $('#donthuid').val();
        function luuThemNguoiThepDoi()
        {
            var idNguoiTheoDoi= $('#selectNguoiTD').val();
            $.ajax({
                type: 'post',
                url: '{{URL::to('themNguoiTheoDoi')}}',
                data: {
                    donthuId: donthuId,
                    accountId: idNguoiTheoDoi
                    //comment: comment
                },
                success: function (data) {

                    if(data != "")
                    {
                        $('#spanId').append(data[0].fullname+',');
                    }

                    AnHienPanel('#divChonTen',false);
                    AnHienPanel('#themTheoDoi',true);

                }
            });

        }

        function displayEdit(d)
        {

            switch (d)
            {
                case 'themTheoDoi':
                    AnHienPanel('#divChonTen',true);
                    AnHienPanel('#themTheoDoi',false);
                    break;
                default:
                    break;
            }

        }

    </script>

@endsection
