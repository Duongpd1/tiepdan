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
        var element1 = document.getElementById("baocao");
        element1.classList.add("active");
        var element = document.getElementById("htab-baocao");
        element.classList.add("active");
        element.classList.add("in");

    </script>

    <div class="col-background" style="margin-bottom: 100px;">
        <form id="baocao" novalidate="novalidate" method="post" action="detail_baocao">
        <div class="panel panel-default panel-min-height">
            <div class="panel-heading text-center">BÁO CÁO</div>
            <?php
            //print_r($results);
            ?>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-2" style="padding-left: 0">

                        <div class="form-group form-group-sm">
                            <select name="KyBaoCao" id="KyBaoCao" class="form-control">
                                <option value="">Chọn kỳ báo cáo</option>
                                <option value="T01">Tháng 01</option>
                                <option value="T02">Tháng 02</option>
                                <option value="T03">Tháng 03</option>
                                <option value="T04">Tháng 04</option>
                                <option value="T05">Tháng 05</option>
                                <option value="T06">Tháng 06</option>
                                <option value="T07">Tháng 07</option>
                                <option value="T08">Tháng 08</option>
                                <option value="T09">Tháng 09</option>
                                <option value="T10">Tháng 10</option>
                                <option value="T11">Tháng 11</option>
                                <option value="T12">Tháng 12</option>
                                <option value="Q1">Quý I</option>
                                <option value="Q2">Quý II</option>
                                <option value="Q3">Quý III</option>
                                <option value="Q4">Quý IV</option>
                                <option value="6TDN">6 tháng đầu năm</option>
                                {{--<option value="6TCN">6 tháng cuối năm</option>--}}
                                <option value="NN">Cả năm</option>
                                <option value="0">Khác</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-xs-5" style="padding-left: 0">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Từ ngày</span>
                            <input name="TuNgay" type="text"  id="TuNgay" class="form-control"  >
                            <span class="input-group-addon">Đến ngày</span>
                            <input name="DenNgay" type="text"  id="DenNgay" class="form-control" >
                        </div>
                    </div>
                    <div class="col-xs-4" style="padding: 0">
                        <div class="form-group form-group-sm">
                            <select name="LoaiBaoCao" id="LoaiBaoCao" class="form-control">
                                <option value="">Chọn loại báo cáo</option>
                                <option value="TongHop">1. Báo cáo tổng hợp tình hình đơn</option>
                                <option value="KhieuNai">2. Tổng hợp giải quyết đơn khiếu nại</option>
                                <option value="ToCao">3. Tổng hợp giải quyết đơn tố cáo</option>
                                <option value="TKTHTCD">4. Thống kê tình hình tiếp công dân</option>
                                <option value="sotiepdan">5. Kết xuất sổ tiếp dân</option>
                                <option value="sokhieunai">6. Kết xuất sổ khiếu nại</option>
                                <option value="sotocao">7. Kết xuất sổ tố cáo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-1 text-right" style="padding:0">
                        <input type="submit" name="TimKiem" value="Xem" id="TimKiem" class="btn btn-sm btn-success">
                    </div>
                </div>

                @if($status !=0 )
                    @if($donthu_theoky!=null)

                <div class="row">
                    <div style="text-align: center; color: #f00">
                    </div>
                            <span id="ctl00_ReportViewer1_ReportViewer">
                                <div id="ctl00_ReportViewer1"  style="overflow: auto">

                                    <table cellpadding="0" cellspacing="0" id="ctl00_ReportViewer1_fixedTable">
                                <tbody>
                            @if($loai_baocao =="TongHop" )
                                <tr>

                                    <td style="vertical-align:top;">
                                        <div  style="width: 100%;padding-top: 10px;">
                                            <div style="padding-left: 15px">
                                                <label class="control-label " style="border: none"> Tổng số đơn trong kỳ:</label>
                                                <label class="control-label text-right" >{{count($donthu_theoky)}}</label>
                                            </div>

                                        </div>
                                        <div class="" style="width: 100%;">
                                            <div class="col-sm-4">
                                                <div>
                                                    <label class="control-label " style="border: none">Trang thái xử lý đơn</label>
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td style="background-color: #5bc0de">Trạng thái</td>
                                                            <td style="background-color: #5bc0de">Số lượng</td>
                                                            <td style="background-color: #5bc0de">Tỷ lệ</td>
                                                        </tr>
                                                        {{--@if($data_TTXL['TTXL_DangXL']!=null)--}}
                                                            <tr>
                                                                <td>Chờ xử lý</td>
                                                                <td class="text-right">{{count($data_TTXL['TTXL_ChoXL'])}}</td>
                                                                <td class="text-right">{{floor((count($data_TTXL['TTXL_ChoXL'])/count($donthu_theoky))*100)}}%</td>
                                                            </tr>
                                                        {{--@endif--}}
                                                        {{--@if($data_TTXL['TTXL_DangGQ']!=null)--}}
                                                            <tr>
                                                                <td>Đang xử lý</td>
                                                                <td class="text-right">{{count($data_TTXL['TTXL_DangXL'])}}</td>
                                                                <td class="text-right">{{floor((count($data_TTXL['TTXL_DangXL'])/count($donthu_theoky))*100)}}%</td>
                                                            </tr>
                                                        {{--@endif--}}
                                                        {{--@if($data_TTXL['TTXL_DaGQ']!=null)--}}
                                                            <tr>
                                                                <td>Đã giải quyết</td>
                                                                <td class="text-right">{{count($data_TTXL['TTXL_DaGQ'])}}</td>
                                                                <td class="text-right">{{floor((count($data_TTXL['TTXL_DaGQ'])/count($donthu_theoky))*100)}}%</td>
                                                            </tr>
                                                        {{--@endif--}}
                                                    </table>
                                                </div>
                                                <div >
                                                    <label class="control-label "> Tiếp nhận phân loại đơn khiếu nại tố cáo</label>
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td style="background-color: #5bc0de">Loại đơn</td>
                                                            <td style="background-color: #5bc0de">Số lượng</td>
                                                            <td style="background-color: #5bc0de">Tỷ lệ</td>
                                                        </tr>
                                                        @for($i = 0;$i<count($data_LoaiDon);$i++)
                                                            {{--@if($data_LoaiDon[$i]['sodon_co_loaidon']!=0)--}}
                                                                <tr>
                                                                    <td>{{$data_LoaiDon[$i]['ten_loaidon']}}</td>
                                                                    <td class="text-right">{{$data_LoaiDon[$i]['sodon_co_loaidon']}}</td>
                                                                    <td class="text-right">{{floor(($data_LoaiDon[$i]['sodon_co_loaidon']/count($donthu_theoky))*100)}}%</td>
                                                                </tr>
                                                            {{--@endif--}}
                                                        @endfor
                                                        {{--@if($data_TTXL['TTXL_ChoXL']!=null)--}}
                                                            <tr>
                                                                <td>Tổng số đơn</td>
                                                                <td class="text-right">{{count($donthu_theoky)}}</td>
                                                                <td class="text-right"></td>
                                                            </tr>
                                                        {{--@endif--}}
                                                    </table>
                                                </div>

                                            </div>
                                            {{--<div class="col-sm-3" style="">--}}
                                                {{--<div>--}}
                                                    {{--<label class="control-label "> Chi tiết xử lý đơn</label>--}}
                                                    {{--<table class="table table-bordered">--}}
                                                        {{--<tr>--}}
                                                            {{--<td style="background-color: #5bc0de">Loại đơn</td>--}}
                                                            {{--<td style="background-color: #5bc0de">Số lượng</td>--}}
                                                            {{--<td style="background-color: #5bc0de">Tỷ lệ</td>--}}
                                                        {{--</tr>--}}
                                                        {{--@if($baocao_theohuong_xuly['thuly']!=null)--}}
                                                            {{--<tr>--}}
                                                                {{--<td>Để lại giải quyết</td>--}}
                                                                {{--<td class="text-right">{{count($baocao_theohuong_xuly['thuly'])}}</td>--}}
                                                                {{--<td class="text-right">{{floor((count($baocao_theohuong_xuly['thuly'])/count($donthu_theoky))*100)}}%</td>--}}
                                                            {{--</tr>--}}
                                                        {{--@endif--}}
                                                        {{--@if($baocao_theohuong_xuly['tra_chuyen']!=null)--}}
                                                            {{--<tr>--}}
                                                                {{--<td>Xử lý chuyển trả</td>--}}
                                                                {{--<td class="text-right">{{count($baocao_theohuong_xuly['tra_chuyen'])}}</td>--}}
                                                                {{--<td class="text-right">{{floor((count($baocao_theohuong_xuly['tra_chuyen'])/count($donthu_theoky))*100)}}%</td>--}}
                                                            {{--</tr>--}}
                                                        {{--@endif--}}
                                                        {{--<tr>--}}
                                                            {{--<td>Tổng số</td>--}}
                                                            {{--<td class="text-right">{{count($donthu_theoky)}}</td>--}}
                                                            {{--<td class="text-right"></td>--}}
                                                        {{--</tr>--}}
                                                    {{--</table>--}}
                                                {{--</div>--}}

                                            {{--</div>--}}
                                            <div class="col-sm-3" style="">
                                                <div>
                                                    <label class="control-label "> Theo Địa Bàn</label>
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td style="background-color: #5bc0de">Địa bàn</td>
                                                            <td style="background-color: #5bc0de">Loại đơn</td>
                                                            <td style="background-color: #5bc0de">Số lượng</td>
                                                        </tr>


                                                        <tr>
                                                            <td rowspan="2" class="">Cấp thành phố</td>
                                                            <td class="text-left">Khiếu nại</td>
                                                            <td class="text-right">{{count($data_khieunai['kn_tp'])}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Tố cáo</td>
                                                            <td class="text-right">{{count($data_tocao['tc_tp'])}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td rowspan="2" class="">Cấp huyện</td>
                                                            <td class="text-left">Khiếu nại</td>
                                                            <td class="text-right">{{count($data_khieunai['kn_huyen'])}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Tố cáo</td>
                                                            <td class="text-right">{{count($data_tocao['tc_huyen'])}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td rowspan="2" class="">Cấp sở ngành</td>
                                                            <td class="text-left">Khiếu nại</td>
                                                            <td class="text-right">{{count($data_songanh['so_nganh_kn'])}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Tố cáo</td>
                                                            <td class="text-right">{{count($data_songanh['so_nganh_tc'])}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td rowspan="2" class="">Cấp xã</td>
                                                            <td class="text-left">Khiếu nại</td>
                                                            <td class="text-right">{{count($data_khieunai['kn_xa'])}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Tố cáo</td>
                                                            <td class="text-right">{{count($data_tocao['tc_xa'])}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td  class="">Tổng số</td>
                                                            <td class="text-right">{{count($donthu_theoky)}}</td>
                                                            <td class="text-left"></td>
                                                        </tr>


                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="width: 100%;">
                                            <div class="col-sm-11" style="">
                                                <div>
                                                    <label class="control-label "> Danh Sách Đơn Thư Trong Kỳ</label>
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td  style="background-color: #5bc0de">Số thụ lý</td>
                                                            <td   style="background-color: #5bc0de">Họ và tên</td>
                                                            <td  style="background-color: #5bc0de">Địa chỉ</td>
                                                            <td  style="background-color: #5bc0de">Ngày gửi</td>
                                                            <td style="background-color: #5bc0de">Loại đơn</td>
                                                            <td style="background-color: #5bc0de">Lĩnh vực</td>
                                                            <td style="background-color: #5bc0de">Nội dung</td>
                                                            <td style="background-color: #5bc0de">TTXL</td>
                                                        </tr>

                                                        @if($data_DanhSach!=null)
                                                            @for($i =0;$i<count($data_DanhSach);$i++)
                                                                <tr>
                                                                    <td>{{$data_DanhSach[$i]['sothuly']}}</td>
                                                                    <td>{{$data_DanhSach[$i]['donthu']->tennguoivietdon}}</td>
                                                                    <td>{{$data_DanhSach[$i]['donthu']->diachinguoiviet}}</td>
                                                                    <td>{{$data_DanhSach[$i]['donthu']->ngaynhan}}</td>
                                                                    <td>{{$data_DanhSach[$i]['tenloaidon']}}</td>
                                                                    <td>{{$data_DanhSach[$i]['tenlinhvuc']}}</td>
                                                                    <td>{{$data_DanhSach[$i]['donthu']->noidung}}</td>
                                                                    @if($data_DanhSach[$i]['donthu']->trangthaixuly == 1)
                                                                    <td>Đang chờ xử lý</td>
                                                                    @elseif($data_DanhSach[$i]['donthu']->trangthaixuly ==2)
                                                                        <td>Đang xử lý</td>
                                                                    @elseif($data_DanhSach[$i]['donthu']->trangthaixuly ==3)
                                                                        <td>Đang giải quyết</td>
                                                                    @elseif($data_DanhSach[$i]['donthu']->trangthaixuly ==4)
                                                                        <td>Đã giải quyết</td>
                                                                    @elseif($data_DanhSach[$i]['donthu']->trangthaixuly ==5)
                                                                        <td>Kết thúc</td>
                                                                    @endif
                                                                </tr>
                                                            @endfor
                                                        @endif

                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @elseif($loai_baocao =="KhieuNai")
                                <tr>
                                    @if(count($data_ketqua['tongdon_gq'])!=0)
                                    <td>
                                        <div  style="width: 100%;padding-top: 10px;">
                                            <div style="padding-left: 15px">
                                                <label class="control-label " style="border: none"> Tổng số đơn đã giải quyết / tổng số đơn khiếu nại thuộc thẩm quyền trong kỳ:</label>
                                                <label class="control-label text-right" >{{count($data_ketqua['tongdon_gq'])}}/{{count($data_ketqua['tongdon'])}}</label>
                                                <label class="control-label text-right" > đạt tỉ lệ {{floor((count($data_ketqua['tongdon_gq'])/count($data_ketqua['tongdon']))*100)}}%</label>
                                            </div>

                                        </div>
                                        <div class="" style="width: 100%;">
                                            <div class="col-sm-11">
                                                <div>
                                                    <label class="control-label " style="border: none">Đánh giá đơn</label>
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td style="background-color: #5bc0de" class="text-center">Đánh giá</td>
                                                            <td style="background-color: #5bc0de" class="text-center">Số lượng</td>
                                                            <td style="background-color: #5bc0de" class="text-center">Tỷ lệ</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Đơn khiếu nại đúng</td>
                                                            <td class="text-center">{{count($danh_gia_don['dung'])}}</td>
                                                            @if(count($data_ketqua['tongdon_gq'])!= 0)
                                                            <td class="text-center">{{floor((count($danh_gia_don['dung'])/count($data_ketqua['tongdon_gq']))*100)}}%</td>
                                                            @else
                                                                <td class="text-center">0%</td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <td>Đơn khiếu nại đúng một phần</td>
                                                            <td class="text-center">{{count($danh_gia_don['dung_mot_phan'])}}</td>

                                                            @if(count($data_ketqua['tongdon_gq'])!= 0)
                                                                <td class="text-center">{{floor((count($danh_gia_don['dung_mot_phan'])/count($data_ketqua['tongdon_gq']))*100)}}%</td>
                                                            @else
                                                                <td class="text-center">0%</td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <td>Đơn khiếu nại sai</td>
                                                            <td class="text-center">{{count($danh_gia_don['sai'])}}</td>

                                                            @if(count($data_ketqua['tongdon_gq'])!= 0)
                                                                <td class="text-center">{{floor((count($danh_gia_don['sai'])/count($data_ketqua['tongdon_gq']))*100)}}%</td>
                                                            @else
                                                                <td class="text-center">0%</td>
                                                            @endif
                                                        </tr>

                                                    </table>
                                                </div>
                                                <div >
                                                    <label class="control-label "> Kết quả giải quyết đơn khiếu nại</label>
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td style="background-color: #5bc0de" class="text-center">Địa bàn</td>
                                                            <td style="background-color: #5bc0de" class="text-center">Kết quả</td>
                                                            <td style="background-color: #5bc0de" class="text-center">Tỷ lệ</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cấp Thành phố</td>
                                                            @if(count($data_ketqua['kq_tp'])!= 0)
                                                            <td class="text-center">{{count($data_ketqua['kn_tp'])}}/{{count($data_ketqua['kq_tp'])}}</td>
                                                            <td class="text-center">{{floor((count($data_ketqua['kn_tp'])/count($data_ketqua['kq_tp']))*100)}}%</td>
                                                            @else
                                                                <td class="text-center">0</td>
                                                                <td class="text-center">0%</td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <td>Cấp quận-huyên</td>
                                                            @if(count($data_ketqua['kq_huyen'])!= 0)
                                                            <td class="text-center">{{count($data_ketqua['kn_huyen'])}}/{{count($data_ketqua['kq_huyen'])}}</td>
                                                            <td class="text-center">{{floor((count($data_ketqua['kn_huyen'])/count($data_ketqua['kq_huyen']))*100)}}%</td>
                                                            @else
                                                                <td class="text-center">0</td>
                                                                <td class="text-center">0%</td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <td>Cấp sở-ngành </td>
                                                            @if(count($data_ketqua['kq_tp'])!= 0)
                                                            <td class="text-center">{{count($data_ketqua['tongdon_gq'])}}/{{count($data_ketqua['tongdon'])}}</td>
                                                            <td class="text-center">{{floor((count($data_ketqua['tongdon_gq'])/count($data_ketqua['tongdon']))*100)}}%</td>
                                                            @else
                                                                <td class="text-center">0</td>
                                                                <td class="text-center">0%</td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <td>Cấp xã phương</td>
                                                            @if(count($data_ketqua['kq_xa'])!= 0)
                                                            <td class="text-center">{{count($data_ketqua['kn_xa'])}}/{{count($data_ketqua['kq_xa'])}}</td>
                                                            <td class="text-center">{{floor((count($data_ketqua['kn_xa'])/count($data_ketqua['kq_xa']))*100)}}%</td>
                                                            @else
                                                                <td class="text-center">0</td>
                                                                <td class="text-center">0%</td>
                                                            @endif
                                                        </tr>


                                                    </table>
                                                </div>

                                            </div>


                                        </div>
                                    </td>
                                    @else
                                        <td>
                                            <p class="text-center text-danger">Không tìm thấy dữ liệu!</p>
                                        </td>
                                    @endif
                                </tr>
                            @elseif($loai_baocao =="ToCao")
                                <tr>
                                    @if(count($data_tocao['tongdon_gq'])!=0)
                                    <td>
                                        <div  style="width: 100%;padding-top: 10px;">
                                            <div style="padding-left: 15px">
                                                <label class="control-label " style="border: none"> Tổng số đơn tố cáo đã giải quyết / tổng số đơn tố cáo thuộc thẩm quyền trong kỳ:</label>
                                                <label class="control-label text-right" >{{count($data_tocao['tongdon_gq'])}}/{{count($data_tocao['tongdon'])}}</label>
                                                <label class="control-label text-right" > đạt tỉ lệ {{floor((count($data_tocao['tongdon_gq'])/count($data_tocao['tongdon']))*100)}}%</label>
                                            </div>

                                        </div>
                                        <div class="" style="width: 100%;">
                                            <div class="col-sm-11">
                                                <div>
                                                    <label class="control-label " style="border: none">Đánh giá đơn</label>
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td style="background-color: #5bc0de" class="text-center">Đánh giá</td>
                                                            <td style="background-color: #5bc0de" class="text-center">Số lượng</td>
                                                            <td style="background-color: #5bc0de" class="text-center">Tỷ lệ</td>
                                                        </tr>
                                                        <tr>
                                                            <td >Đơn tố cáo  đúng</td>
                                                            <td class="text-center">{{count($danh_gia_don['dung'])}}</td>
                                                            @if(count($data_tocao['tongdon_gq'])!= 0)
                                                                <td class="text-center">{{floor((count($danh_gia_don['dung'])/count($data_tocao['tongdon_gq']))*100)}}%</td>
                                                            @else
                                                                <td class="text-center">0%</td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <td >Đơn tố cáo đúng một phần</td>
                                                            <td class="text-center">{{count($danh_gia_don['dung_mot_phan'])}}</td>

                                                            @if(count($data_tocao['tongdon_gq'])!= 0)
                                                                <td class="text-center">{{floor((count($danh_gia_don['dung_mot_phan'])/count($data_tocao['tongdon_gq']))*100)}}%</td>
                                                            @else
                                                                <td class="text-center">0%</td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <td>Đơn tố cáo sai</td>
                                                            <td class="text-center">{{count($danh_gia_don['sai'])}}</td>

                                                            @if(count($data_tocao['tongdon_gq'])!= 0)
                                                                <td class="text-center">{{floor((count($danh_gia_don['sai'])/count($data_tocao['tongdon_gq']))*100)}}%</td>
                                                            @else
                                                                <td class="text-center">0%</td>
                                                            @endif
                                                        </tr>

                                                    </table>
                                                </div>
                                                <div >
                                                    <label class="control-label "> Kết quả giải quyết đơn tố cáo</label>
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td style="background-color: #5bc0de" class="text-center">Địa bàn</td>
                                                            <td style="background-color: #5bc0de; " class="text-center">Kết quả</td>
                                                            <td style="background-color: #5bc0de" class="text-center">Tỷ lệ</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cấp Thành phố</td>
                                                            @if(count($data_tocao['kq_tp'])!= 0)
                                                                <td class="text-center">{{count($data_tocao['tc_tp'])}}/{{count($data_tocao['kq_tp'])}}</td>
                                                                <td class="text-center">{{floor((count($data_tocao['tc_tp'])/count($data_tocao['kq_tp']))*100)}}%</td>
                                                            @else
                                                                <td class="text-center">0</td>
                                                                <td class="text-center">0%</td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <td>Cấp quận-huyên</td>
                                                            @if(count($data_tocao['kq_huyen'])!= 0)
                                                                <td class="text-center">{{count($data_tocao['tc_huyen'])}}/{{count($data_tocao['kq_huyen'])}}</td>
                                                                <td class="text-center">{{floor((count($data_tocao['tc_huyen'])/count($data_tocao['kq_huyen']))*100)}}%</td>
                                                            @else
                                                                <td class="text-center">0</td>
                                                                <td class="text-center">0%</td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <td>Cấp sở-ngành </td>
                                                            @if(count($data_tocao['kq_tp'])!= 0)
                                                                <td class="text-center">{{count($data_tocao['tongdon_gq'])}}/{{count($data_tocao['tongdon'])}}</td>
                                                                <td class="text-center">{{floor((count($data_tocao['tongdon_gq'])/count($data_tocao['tongdon']))*100)}}%</td>
                                                            @else
                                                                <td class="text-center">0</td>
                                                                <td class="text-center">0%</td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <td>Cấp xã phương</td>
                                                            @if(count($data_tocao['kq_xa'])!= 0)
                                                                <td class="text-center">{{count($data_tocao['tc_xa'])}}/{{count($data_tocao['kq_xa'])}}</td>
                                                                <td class="text-center">{{floor((count($data_tocao['tc_xa'])/count($data_tocao['kq_xa']))*100)}}%</td>
                                                            @else
                                                                <td class="text-center">0</td>
                                                                <td class="text-center">0%</td>
                                                            @endif
                                                        </tr>


                                                    </table>
                                                </div>

                                            </div>


                                        </div>
                                    </td>
                                    @else
                                        <td>
                                            <p class="text-center text-danger">Không tìm thấy dữ liệu!</p>
                                        </td>
                                    @endif
                                </tr>
                            @endif
                                </tbody>
                            </table>
                        </div>
                    </span>

            </div>
                    @elseif($loai_baocao =="TKTHTCD")
                        @if($data_tiepdan['tong']!=null)
                            <div  style="width: 100%;padding-top: 10px;">
                                <div style="padding-left: 15px">
                                    <label class="control-label " style="border: none"> Kết quả tiếp công dân trong kỳ:</label>
                                    <label class="control-label text-right" >{{count($data_tiepdan['tong'])}} lượt</label>
                                </div>
                                <div class="" style="width: 100%;">
                                    <div class="col-sm-11">
                                        <div >
                                            <label class="control-label "> Kết quả tiếp công dân</label>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td style="background-color: #5bc0de" class="text-center">Địa bàn</td>
                                                    <td style="background-color: #5bc0de; " class="text-center">Lượt tiếp</td>
                                                </tr>
                                                <tr>
                                                    <td>Cấp Thành phố tiếp công dân</td>
                                                    @if($data_tiepdan['tiepdan_tp']!=null)
                                                        <td class="text-center">{{count($data_tiepdan['tiepdan_tp'])}}</td>
                                                    @else
                                                        <td class="text-center">0</td>
                                                    @endif

                                                </tr>
                                                <tr>
                                                    <td>Cấp quận- huyện tiếp</td>
                                                    @if($data_tiepdan['tiepdan_huyen']!=null)
                                                        <td class="text-center">{{count($data_tiepdan['tiepdan_huyen'])}}</td>
                                                    @else
                                                        <td class="text-center">0</td>
                                                    @endif

                                                </tr>
                                                <tr>
                                                    <td>Cấp sở, ban, ngành tiếp </td>
                                                    @if($data_tiepdan['tong']!=null)
                                                        <td class="text-center">{{count($data_tiepdan['tong'])}}</td>
                                                    @else
                                                        <td class="text-center">0</td>
                                                    @endif

                                                </tr>
                                                <tr>
                                                    <td>Cấp xã, phường tiếp</td>
                                                    @if($data_tiepdan['tiepdan_xa']!=null)
                                                        <td class="text-center">{{count($data_tiepdan['tiepdan_xa'])}}</td>
                                                    @else
                                                        <td class="text-center">0</td>
                                                    @endif

                                                </tr>


                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @else
                            <p class="text-center text-danger">Không tìm thấy dữ liệu!</p>
                        @endif

                    @else

                    <p class="text-center text-danger">Không tìm thấy dữ liệu!</p>
                    @endif

                @endif
            </div>
        </div>
        </form>
    </div>
    <script type="text/javascript">

        $( function() {
            $( "#TuNgay" ).datepicker({format: 'dd/mm/yyyy'});
            $( "#DenNgay" ).datepicker({format: 'dd/mm/yyyy'});

        } );
        $("#baocao").validate({
            rules: {
                KyBaoCao: {required: true},
                //TuNgay: {required: true, dateFormat: true },
                //DenNgay: {required: true, dateFormat: true},
                LoaiBaoCao: {required: true}
            },
            messages: {
                KyBaoCao: {required: "Vui lòng chọn kỳ báo cáo!"},
                //TuNgay: {required: "" },
                //DenNgay: { required: ""},
                LoaiBaoCao: {required: "Vui lòng chọn loại báo cáo!" }
            },
            success: function (label) {
                label.remove();
            }
        });

        $(function () { Install(); });

        function Install() {
            var txtTuNgay = $('#TuNgay');
            var txtDenNgay = $('#DenNgay');

            var year = new Date().getFullYear();

            txtTuNgay.keyup(function () {
                $('KyBaoCao').val('0');
            })
            txtDenNgay.keyup(function () {
                $('#KyBaoCao').val('0');
            })

            $('#KyBaoCao').change(function () {
                switch ($('#KyBaoCao').val()) {
                    case 'T01': txtTuNgay.val('01/01/'+year ); txtDenNgay.val('01/31/'+year ); break;
                    case 'T02': txtTuNgay.val('01/02/'+year); txtDenNgay.val(new Date(year, 2, 0).getDate() +'/02/'+year); break;
                    case 'T03': txtTuNgay.val('01/03/'+year); txtDenNgay.val('31/03/'+year); break;
                    case 'T04': txtTuNgay.val('01/04/'+year); txtDenNgay.val('30/04/'+year); break;
                    case 'T05': txtTuNgay.val('01/05/'+year); txtDenNgay.val('31/05/'+year); break;
                    case 'T06': txtTuNgay.val('01/06/'+year); txtDenNgay.val('30/06/'+year); break;
                    case 'T07': txtTuNgay.val('01/07/'+year); txtDenNgay.val('31/07/'+year); break;
                    case 'T08': txtTuNgay.val('01/08/'+year); txtDenNgay.val('31/08/'+year); break;
                    case 'T09': txtTuNgay.val('01/09/'+year); txtDenNgay.val('30/09/'+year); break;
                    case 'T10': txtTuNgay.val('01/10/'+year); txtDenNgay.val('31/10/'+year); break;
                    case 'T11': txtTuNgay.val('01/11/'+year); txtDenNgay.val('30/11/'+year); break;
                    case 'T12': txtTuNgay.val('01/12/'+year); txtDenNgay.val('31/12/'+year); break;

                    case 'Q1': txtTuNgay.val('01/01/'+year); txtDenNgay.val('31/03/'+year); break;
                    case 'Q2': txtTuNgay.val('01/04/'+year); txtDenNgay.val('30/06/'+year); break;
                    case 'Q3': txtTuNgay.val('01/07/'+year); txtDenNgay.val('30/09/'+year); break;
                    case 'Q4': txtTuNgay.val('01/10/'+year); txtDenNgay.val('31/12/'+year); break;

                    case '6TDN': txtTuNgay.val('01/01/'+year); txtDenNgay.val('30/06/'+year); break;
                    case '6TCN': txtTuNgay.val('01/07/'+year); txtDenNgay.val('31/12/'+year); break;

                    case 'NN': txtTuNgay.val('01/01/'+year); txtDenNgay.val('31/12/'+year); break;
                    default: txtTuNgay.val(''); txtDenNgay.val(''); break;
                }
            })
        }

        //set value
        var status = <?php echo json_encode($status);?>;

        if (status!=0)
        {
            var tungay = <?php echo json_encode(date("d/m/Y",strtotime($tu_Ngay)));?>;
            var denngay = <?php echo json_encode(date("d/m/Y",strtotime($den_Ngay)));?>;
            var kybaocao = <?php echo json_encode($ky_baocao);?>;
            var loaibaocao = <?php echo json_encode($loai_baocao);?>;
            document.getElementById('TuNgay').value = tungay;
            document.getElementById('DenNgay').value = denngay;
            document.getElementById('KyBaoCao').value = kybaocao;
            if (loaibaocao!=null)
            {
                document.getElementById('LoaiBaoCao').value = loaibaocao;
            }


        }

        function downloadMauDon(value){
            var maudon_url = <?php echo json_encode(url('maudon'));?>;
            if(value == 'sotiepdan'){
                window.location.href = maudon_url + '/' + 'SoTiepDan.docx';
            }
        }


    </script>
@endsection
