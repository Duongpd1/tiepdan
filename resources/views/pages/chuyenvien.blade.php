@extends('layouts.quantrihethonglayout')

@section('css')
    <link rel="stylesheet" href="{{url('/css/jquery.dataTables.min.css')}}">
@endsection
@section('js')
    <script type="text/javascript" src="{{url('/js/jquery.dataTables.min.js')}}"></script>
@endsection
@section('style')
    <style>
        .panel-home { padding: 10px; }
        .panel-home .panel-heading { background: #2b579a; color: #fff; text-transform: uppercase; font-weight: bold; }
        .panel-home .list-group-item { border: 0; text-align: justify; padding: 7px 15px; }
        .panel-home .list-group-item:before { font-family: FontAwesome,sans-serif; content: "\f105"; color: #2b5698; font-weight: bold; margin: 0 5px 0 -10px; }

        .panel-home a.list-group-item:hover,
        .panel-home a.list-group-item:active,
        .panel-home a.list-group-item:focus { background: darkgray; }

        .panel-home .panel-image img { width: 100%; height: auto; margin-bottom: 5px; /*border: 3px solid #ddd;*/ }

        .list-group { margin: 0; }
        .list-group-item { border-radius: 0; cursor: pointer; text-align: justify; padding: 5px 10px; }
        .list-group-item a { color: #000; text-decoration: none; }
        .list-group .active { background-color: transparent; }
        .list-group .active a { color: #fff; text-decoration: none; }
        .panel-heading{height: 37px}
    </style>
@endsection

@section('content')
    <?php
        $year = date("Y");
        if($loginsuccessful = Session::get('loginstatus')){

            $soDonThuMoiDuocGiao = $loginsuccessful['soDonThuMoiDuocGiao'];
        }
        else {
            $soDonThuMoiDuocGiao = 0;
        }

    function convertNgay($ngayTuDatabase){
        $ngayExplore = explode('-',$ngayTuDatabase);
        $ngay = $ngayExplore[2];
        $thang = $ngayExplore[1];
        $nam = $ngayExplore[0];
        return $ngay.'/'.$thang.'/'.$nam;
    }
    $currentChonSoLuongHienThi = Session::get('soLuongHienThi_TabTiepDan');
    $permission = Session::get('accountpermission');
    $sttDangXl = 1;
    $sttChoXl = 1;
    $sttKetThuc = 1;
    $sttDonDen = 1;
    $sttDonDi = 1;
    $sttVBPH = 1;
    $toDay = date('Y-m-d');

    function soNgayConLai($ngayNhan)
    {
        $dayLimit = date("Y-m-d",strtotime($ngayNhan)+10*24*60*60 );
        $toDay2 = date('Y-m-d');
        $days = (strtotime($dayLimit) - strtotime($toDay2))/(60*60*24);

        return $days;
    }

    ?>

    <div class="container-fluid" style="font-size: 12px;padding-top: 0.5%;padding-left: 0px;padding-right: 0px;">

        {{--<div class="col-xs-3 panel-group" >--}}

            {{--<div class="panel panel-default panel-home" style="display: {{($permission != VANTHU)?'':'none'}}">--}}
                {{--<div class="panel-heading">--}}
                    {{--<i aria-hidden="true" class="fa fa-list-alt fa-lg"></i>--}}
                    {{--Đơn khiếu nại/Tố cáo--}}
                {{--</div>--}}

                {{--<div class="list-group">--}}
                    {{--<a class="list-group-item" id="vanBanChoXuLyId" onclick="chonHienThiKetQua(this)" style="display: {{($permission == CHUYENVIEN)?'none':''}}">Đơn chờ xử lý--}}
                        {{--<span id="numbVanBanChoXuly" style="float: right; background-color: #DD4B39; color: white; padding-left: 10px; padding-right: 10px; border-radius: 5px; font-weight: 600">--}}
                             {{--{{ count($numbDonThu->choXuLy) }}--}}
                        {{--</span>--}}
                    {{--</a>--}}
                    {{--<a class="list-group-item" id="vanBanDangXuLy" onclick="chonHienThiKetQua(this)"> {{($permission == CHUYENVIEN)?'Đơn chờ xử lý':'Đơn đang xử lý'}}--}}
                        {{--<span id="numbVanBanDangXuly" style="float: right; background-color: #DD4B39; color: white; padding-left: 10px; padding-right: 10px; border-radius: 5px; font-weight: 600">--}}
                            {{--{{ count($numbDonThu->dangXuLy) }}--}}
                        {{--</span>--}}
                    {{--</a>--}}
                    {{--<a class="list-group-item" onclick="chonHienThiKetQua(this)" id="xuLyDon" style="display: none"><span></span>Xử lý đơn khiếu nại, kiến nghị, phản ánh, tố cáo</a>--}}
                    {{--<a class="list-group-item" id="quyetDinhGQ" onclick="chonHienThiKetQua(this)" style="display: none">Quyết định giải quyết KNTC</a>--}}
                    {{--<a class="list-group-item" id="donNhieuNoi" onclick="chonHienThiKetQua(this)" style="display: none">Đơn gửi nhiều nơi</a>--}}

                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="panel panel-default panel-home" style="display: {{($permission != VANTHU)?'':'none'}}">--}}
                {{--<div class="panel-heading panel-primary">--}}
                    {{--<i aria-hidden="true" class="fa fa-newspaper-o fa-lg"></i>--}}
                    {{--Tiếp dân--}}
                {{--</div>--}}

                {{--<div class="list-group">--}}
                    {{--<a class="list-group-item" id="ketQuaTD" onclick="chonHienThiKetQua(this)">Kết quả tiếp dân</a>--}}
                    {{--<a class="list-group-item" id="lichTD" onclick="chonHienThiKetQua(this)">Lịch tiếp dân</a>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="panel panel-default panel-home" style="display: {{($permission != VANTHU)?'':''}}">--}}
                {{--<div class="panel-heading panel-primary">--}}
                    {{--<i aria-hidden="true" class="fa fa-newspaper-o fa-lg"></i>--}}
                    {{--Kho lưu trữ--}}
                {{--</div>--}}

                {{--<div class="list-group">--}}
                    {{--<a class="list-group-item" id="donKetThuc" onclick="chonHienThiKetQua(this)">Hồ sơ đơn</a>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="panel panel-default panel-home" >--}}
                {{--<div class="panel-heading panel-primary">--}}
                    {{--<i aria-hidden="true" class="fa fa-newspaper-o fa-lg"></i>--}}
                    {{--Lịch sử--}}
                {{--</div>--}}

                {{--<div class="list-group">--}}
                    {{--<a class="list-group-item" id="donDen" onclick="chonHienThiKetQua(this)" style="display: {{($permission == VANTHU)?'':'none'}}">Danh sách văn bản đến</a>--}}
                    {{--<a class="list-group-item" id="donDi" onclick="chonHienThiKetQua(this)">Danh sách văn bản đi</a>--}}
                    {{--<a class="list-group-item" id="vanBanPhatHanh" onclick="chonHienThiKetQua(this)">Văn bản phát hành</a>--}}
                {{--</div>--}}
            {{--</div>--}}




        {{--</div>--}}

        {{--<div class="col-xs-9 panel-group" >--}}

            <div class="panel panel-default panel-home" id="donXuLy" style="display: none">
                <div class="panel-heading" style="background: #fffbe6">
                    <strong style="color: #0b73f7">Đơn chưa giải quyết </strong>
                    {{--<strong style="color: red"> đơn</strong>--}}
                </div>
                <table class="table table-hover table-bordered" style="font-size: 13px;">
                    <thead>
                    <th>Loại đơn</th>
                    <th>Đến hạn xử lý</th>
                    <th>Quá hạn xử lý</th>
                    <th>Đến hạn giải quyết</th>
                    <th>Quá hạn giải quyết</th>
                    </thead>

                    <tbody>
                    @foreach($tongdonchua_GQ as $row)
                    <tr>
                        <td>{{$row->item->tenloaidon}}</td>
                        <td class="text-center">
                            @if(count($row->xulyDH) != 0)
                                <a class="text-primary" href="{{url('denhan_all/'.XULY.'/'.$row->item->loaidonid)}}">
                                    {{count($row->xulyDH)}}
                                </a>
                            @else
                                0
                            @endif
                        </td>
                        <td class="text-center">
                            @if(count($row->xulyQH)!= 0)
                                <a class="text-danger" href="{{url('quahan_all/'.XULY.'/'.$row->item->loaidonid)}}">
                                    {{count($row->xulyQH)}}
                                </a>
                            @else
                                0
                            @endif

                        </td>
                        <td class="text-center">
                            @if(count($row->giaiquyetDH) != 0)
                                <a class="text-primary" href="{{url('denhan_all/'.GIAIQUYET.'/'.$row->item->loaidonid)}}">
                                    {{count($row->giaiquyetDH)}}
                                </a>
                            @else
                                0
                            @endif

                        </td>
                        <td class="text-center">
                            @if(count($row->giaiquyetQH) != 0)
                                <a class="text-danger" href="{{url('quahan_all/'.GIAIQUYET.'/'.$row->item->loaidonid)}}">
                                    {{count($row->giaiquyetQH)}}
                                </a>
                            @else
                                0
                            @endif

                        </td>
                    </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>

            <div class="panel panel-default panel-home" id="donGiaiQuyet" style="display: {{($permission != VANTHU)?'none':'none'}}">
                <div class="panel-heading" style="background: #fffbe6">
                    <strong style="color: #0b73f7">Quyết định giải quyết KNTC </strong>
                    {{--<strong style="color: red"> đơn</strong>--}}
                </div>
                <table class="table table-hover table-bordered" style="font-size: 13px;">
                    <thead>
                    <th>Loại đơn</th>
                    {{--<th>Đang giải quyết</th>--}}
                    <th>Đã giải quyết</th>
                    <th>Kết thúc</th>

                    </thead>

                    <tbody>
                    @foreach($ketQuaGiaiQuyetDon as $row)
                        <tr>
                            <td>{{$row->item->tenloaidon}}</td>
                            {{--<td class="text-center">--}}
                                {{--@if(count($row->DangGQ) != 0)--}}
                                    {{--<a class="text-primary" href="">--}}
                                        {{--{{count($row->DangGQ)}}--}}
                                    {{--</a>--}}
                                {{--@else--}}
                                    {{--0--}}
                                {{--@endif--}}
                            {{--</td>--}}
                            <td class="text-center">
                                @if(count($row->DaGQ)!= 0)
                                    <a class="text-primary" href="{{url('ketQuaGQKNTC/DAGIAIQUYET/'.$row->item->loaidonid)}}">
                                        {{count($row->DaGQ)}}
                                    </a>
                                @else
                                    0
                                @endif

                            </td>
                            <td class="text-center">
                                @if(count($row->KetThuc) != 0)
                                    <a class="text-primary" href="{{url('ketQuaGQKNTC/KETTHUC/'.$row->item->loaidonid)}}">
                                        {{count($row->KetThuc)}}
                                    </a>
                                @else
                                    0
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>

            <div id="lichtiepcongdan" class="panel panel-default panel-home" style="display: {{($permission != VANTHU)?'none':'none'}}">

                <div class="panel-heading" style="background: #fffbe6;color:#0b73f7 ">
                    LỊCH TIẾP CÔNG DÂN NĂM
                    <span id="namhientai">{{date('Y')}}</span>
                </div>
                <div style="padding: 10px 0">
                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                            <button type="submit" name="nam" value="13" id="nam" class="btn btn-info" >
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
                        @if($lichTiepCongDan['thang1'] != null)
                            <tr>
                                <td colspan="3" class="text-center"><b>Tháng 1</b></td>
                            </tr>
                            @foreach($lichTiepCongDan['thang1'] as $thang1data)
                                <tr>
                                    <td class="text-center">
                                        {{convertNgay($thang1data->ngaytiep)}}
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

                        @if($lichTiepCongDan['thang2'] != null)
                            <tr>
                                <td colspan="3" class="text-center"><b>Tháng 2</b></td>
                            </tr>
                            @foreach($lichTiepCongDan['thang2'] as $thang2data)
                                <tr>
                                    <td class="text-center">
                                        {{date("d/m/Y",strtotime($thang2data->ngaytiep))}}
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

                        @if($lichTiepCongDan['thang3'] != null)
                            <tr>
                                <td colspan="3" class="text-center"><b>Tháng 3</b></td>
                            </tr>
                            @foreach($lichTiepCongDan['thang3'] as $thang3data)
                                <tr>
                                    <td class="text-center">
                                        {{date("d/m/Y",strtotime($thang3data->ngaytiep))}}
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

                        @if($lichTiepCongDan['thang4'] != null)
                            <tr>
                                <td colspan="3" class="text-center"><b>Tháng 4</b></td>
                            </tr>
                            @foreach($lichTiepCongDan['thang4'] as $thang4data)
                                <tr>
                                    <td class="text-center">
                                        {{date("d/m/Y",strtotime($thang4data->ngaytiep))}}
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

                        @if($lichTiepCongDan['thang5'] != null)
                            <tr>
                                <td colspan="3" class="text-center"><b>Tháng 5</b></td>
                            </tr>
                            @foreach($lichTiepCongDan['thang5'] as $thang5data)
                                <tr>
                                    <td class="text-center">
                                        {{date("d/m/Y",strtotime($thang5data->ngaytiep))}}
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

                        @if($lichTiepCongDan['thang6'] != null)
                            <tr>
                                <td colspan="3" class="text-center"><b>Tháng 6</b></td>
                            </tr>
                            @foreach($lichTiepCongDan['thang6'] as $thang6data)
                                <tr>
                                    <td class="text-center">
                                        {{date("d/m/Y",strtotime($thang6data->ngaytiep))}}
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

                        @if($lichTiepCongDan['thang7'] != null)
                            <tr>
                                <td colspan="3" class="text-center"><b>Tháng 7</b></td>
                            </tr>
                            @foreach($lichTiepCongDan['thang7'] as $thang7data)
                                <tr>
                                    <td class="text-center">
                                        {{date("d/m/Y",strtotime($thang7data->ngaytiep))}}
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

                        @if($lichTiepCongDan['thang8'] != null)
                            <tr>
                                <td colspan="3" class="text-center"><b>Tháng 8</b></td>
                            </tr>
                            @foreach($lichTiepCongDan['thang8'] as $thang8data)
                                <tr>
                                    <td class="text-center">
                                        {{date("d/m/Y",strtotime($thang8data->ngaytiep))}}
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

                        @if($lichTiepCongDan['thang9'] != null)
                            <tr>
                                <td colspan="3" class="text-center"><b>Tháng 9</b></td>
                            </tr>
                            @foreach($lichTiepCongDan['thang9'] as $thang9data)
                                <tr>
                                    <td class="text-center">
                                        {{date("d/m/Y",strtotime($thang9data->ngaytiep))}}
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

                        @if($lichTiepCongDan['thang10'] != null)
                            <tr>
                                <td colspan="3" class="text-center"><b>Tháng 10</b></td>
                            </tr>
                            @foreach($lichTiepCongDan['thang10'] as $thang10data)
                                <tr>
                                    <td class="text-center">
                                        {{date("d/m/Y",strtotime($thang10data->ngaytiep))}}
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

                        @if($lichTiepCongDan['thang11'] != null)
                            <tr>
                                <td colspan="3" class="text-center"><b>Tháng 11</b></td>
                            </tr>
                            @foreach($lichTiepCongDan['thang11'] as $thang11data)
                                <tr>
                                    <td class="text-center">
                                        {{date("d/m/Y",strtotime($thang11data->ngaytiep))}}
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

                        @if($lichTiepCongDan['thang12'] != null)
                            <tr>
                                <td colspan="3" class="text-center"><b>Tháng 12</b></td>
                            </tr>
                            @foreach($lichTiepCongDan['thang12'] as $thang12data)
                                <tr>
                                    <td class="text-center">
                                        {{date("d/m/Y",strtotime($thang12data->ngaytiep))}}
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

            <div class="panel panel-default" id="bangKetQuaTD" style="display: {{($permission != VANTHU)?'none':'none'}}">
                <div class="panel-heading ">DANH SÁCH TIẾP CÔNG DÂN</div>
                <div class="ketqua-kntc">
                    <table id="danhSachKetQuaTDId" class="table table-bordered table-hover" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Người Tiếp</th>
                            <th>Ngày tiếp</th>
                            <th>Công dân </th>
                            <th>Nội dung công dân đã trình bày</th>
                            <th>Nội dung đã giải quyết</th>
                            <th>Vướng mắc và đề nghị đã giải quyết </th>
                            <th>Kết luận của chủ trì cuộc tiếp dân</th>

                        </tr>
                        </thead>
                        <tbody >
                        @if(0 !=count($ketquatiepdan))
                            <?php $sttKQTD=1; ?>
                            @foreach($ketquatiepdan as $ketqua)
                                <tr>
                                    <td>{{$sttKQTD}}</td>
                                    <td>{{$ketqua->lanhdao}}</td>
                                    <td>{{convertNgay($ketqua->ngaytiep)}}</td>
                                    <td>{{$ketqua->congdan}}</td>
                                    <td> <a href="{{url('/noidungdanhsachtiepcongdan/'.$ketqua->tiepdanid)}}">{{$ketqua->noidung}}</a></td>
                                    <td>{{$ketqua->noidungdagiaiquyet}}</td>
                                    <td>{{$ketqua->	vuongmacdenghi}}</td>
                                    <td>{{$ketqua->ketquagiaiquyet}}</td>
                                </tr>
                                <?php $sttKQTD++; ?>
                            @endforeach
                        @else
                            <tr >

                                <td class="text-center text-danger" colspan="8">Không có lịch tiếp công dân nào! </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                </div>

            </div>

            <div class="panel panel-default" id="donGiongNhau" style="display: {{($permission != VANTHU)?'none':'none'}}">
                <div class="panel-heading ">ĐƠN GỬI NHIỀU NƠI</div>
                <div class="ketqua-kntc">
                    <ul>
                        @foreach($donGiongNhau as $listData)
                            @foreach($listData as $row)
                            <li>
                                <p>
                                    <label>Người viết đơn: </label>
                                    {{$row->tennguoivietdon}}
                                </p>
                                <p>
                                    <label>Ngày Nhận: </label>
                                    {{convertNgay($row->ngaynhan)}}
                                </p>
                                <p>
                                    <label>Địa chỉ: </label>
                                    {{$row->diachinguoiviet}}
                                </p>
                                <p>
                                    <label>Nội dung: </label>
                                    {{str_limit($row->noidung, $limit = 45, $end = '...')}}
                                </p>
                                <p class="detail">
                                    <a href="{{url('/chitietdonthu/'.$row->donthuid)}}">Xem chi tiết »</a>
                                </p>
                            </li>
                                @endforeach
                        @endforeach

                    </ul>

                </div>

            </div>

            <div class="panel panel-default" id="donChoXuLy" style="display: {{($permission != VANTHU && $permission != CHUYENVIEN)?'':'none'}}">
                <div class="panel-heading ">ĐƠN CHỜ XỬ LÝ</div>
                <div class="ketqua-kntc">

                        <table id="danhSachDonChoXL" class="table table-bordered table-hover" style="width: 100%;">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Số thụ lý</th>
                                <th>Nội dung</th>
                                <th>Tên người viết đơn</th>
                                <th>Người cập nhật</th>
                                <th>Ngày nhận </th>
                                <th>Cán bộ xử lý</th>
                                <th>Hạn xử lý </th>
                                <th>Thời gian xử lý còn lại </th>
                                <th>Trạng thái </th>

                            </tr>
                            </thead>
                            <tbody id="bodyChoXuLy">
                            @if(0 !=count($numbDonThu->choXuLy))
                                @foreach($numbDonThu->choXuLy as $row)
                                    <tr>
                                        <td>{{$sttChoXl}}</td>
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
                                            {{$row->ngay_nhan_view}}
                                        </td>
                                        <td>
                                            @foreach($thongTinNhanVien as $nhanVien)
                                                @if($nhanVien->accountid == $row->nguoixuly )
                                                    {{$nhanVien->fullname}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{$row->han_xu_ly_view}}</td>
                                        <td>
                                            {{($row->ngay_con_lai_view->type  == 2)?'quá hạn':$row->ngay_con_lai_view->day .' ngày'}}
                                        </td>
                                        <td>
                                            {{($row->trangthaixuly == CHOXULY)?'chờ xử lý':''}}
                                            {{($row->trangthaixuly == DANGXULY)?'đang xử lý':''}}
                                            {{($row->trangthaixuly == DAGIAIQUYET)?'đã giải quyết':''}}
                                        </td>

                                    </tr>
                                    <?php $sttChoXl++; ?>
                                @endforeach
                            @else

                            @endif
                            </tbody>
                        </table>



                </div>

            </div>

            <div class="panel panel-default" id="donDangXuLy" style="display: {{($permission != VANTHU && $permission != TIEPDAN && $permission != QUANLYHETHONG && $permission != LANHDAO )?'':'none'}}">
                <div class="panel-heading "> {{($permission == CHUYENVIEN)?'ĐƠN CHỜ XỬ LÝ':'ĐƠN ĐANG XỬ LÝ'}} </div>
                <div class="ketqua-kntc">

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
                                <th>Hạn xử lý </th>
                                <th>Thời gian xử lý còn lại </th>
                                <th>Trạng thái </th>

                            </tr>
                            </thead>
                            <tbody id="bodyDangXuLy">
                            @if(0 !=count($numbDonThu->dangXuLy))
                                @foreach($numbDonThu->dangXuLy as $row)
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
                                            {{$row->ngay_nhan_view}}
                                        </td>
                                        <td>
                                            @foreach($thongTinNhanVien as $nhanVien)
                                                @if($nhanVien->accountid == $row->nguoixuly )
                                                    {{$nhanVien->fullname}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{$row->han_xu_ly_view}}</td>
                                        <td>
                                            {{($row->ngay_con_lai_view->type  == 2)?'quá hạn':$row->ngay_con_lai_view->day .' ngày'}}
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

            <div class="panel panel-default" id="danhSachHS" style="display: {{($permission != VANTHU)?'none':'none'}}">
                <div class="panel-heading ">HỒ SƠ LƯU TRỮ </div>
                <div class="ketqua-kntc" style="padding-top: 2%">
                    <table id="danhsach" class="table table-bordered table-hover" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Số thụ lý</th>
                            <th>Nội dung</th>
                            <th>Tên người viết đơn</th>
                            <th>Người cập nhật</th>
                            <th>Ngày nhận </th>
                            <th>Cán bộ xử lý</th>
                            <th>Hạn xử lý </th>
                            <th>Thời gian xử lý còn lại </th>
                            <th>Trạng thái </th>

                        </tr>
                        </thead>
                        <tbody id="table">
                        @if(0 !=count($numbDonThu->daXuLy))
                            @foreach($numbDonThu->daXuLy as $row)
                                <tr>
                                    <td>{{$sttKetThuc}}</td>
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
                                        {{$row->ngay_nhan_view}}
                                    </td>
                                    <td>
                                        @foreach($thongTinNhanVien as $nhanVien)
                                            @if($nhanVien->accountid == $row->nguoixuly )
                                                {{$nhanVien->fullname}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{$row->han_xu_ly_view}}</td>
                                    <td>
                                        {{($row->ngay_con_lai_view->type  == 2)?'quá hạn':$row->ngay_con_lai_view->day .' ngày'}}
                                    </td>
                                    <td>
                                        {{($row->trangthaixuly == CHOXULY)?'chờ xử lý':''}}
                                        {{($row->trangthaixuly == DANGXULY)?'đang xử lý':''}}
                                        {{($row->trangthaixuly == DAGIAIQUYET)?'đã giải quyết':''}}
                                    </td>

                                </tr>
                                <?php $sttKetThuc++; ?>
                            @endforeach
                        @else

                        @endif
                        </tbody>
                    </table>

                </div>

            </div>

            <div class="panel panel-default" id="danhSachDonDen" style="display: {{($permission == VANTHU)?'':'none'}}">
                <div class="panel-heading ">DANH SÁCH ĐƠN ĐẾN </div>
                <div class="ketqua-kntc" style="padding-top: 2%">
                    <table id="tableDonDen" class="table table-bordered table-hover" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Số Thụ lý</th>
                            <th>Nội dung</th>
                            <th>Tên người viết đơn</th>
                            <th>Ngày nhận</th>
                            <th>Cán bộ xử lý</th>
                            <th>Trạng thái </th>


                        </tr>
                        </thead>
                        <tbody id="table">
                        @if(0 !=count($dataDonOfVanThu))
                            @foreach($dataDonOfVanThu as $row)
                                <tr>
                                    <td>{{$sttDonDen}}</td>
                                    <td>
                                        <a href="{{url('/chitietdonthu/'.$row->donthuid)}}"> {{$row->sothuly}}</a>
                                    </td>
                                    <td>{{$row->noidung}}</td>
                                    <td>{{$row->tennguoivietdon}}</td>
                                    <td>{{date("d/m/Y",strtotime($row->ngaynhan))}}</td>
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
                                <?php $sttDonDen++ ?>
                            @endforeach
                        @else

                        @endif
                        </tbody>
                    </table>

                </div>

            </div>

            <div class="panel panel-default" id="danhSachDonDi" style="display: none">
                <div class="panel-heading ">DANH SÁCH VĂN BẢN ĐẾN CƠ QUAN </div>
                <div class="ketqua-kntc" style="padding-top: 2%">
                    <table id="tableDonDi" class="table table-bordered table-hover" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Số văn bản</th>
                            <th>Tên văn bản</th>
                            <th>Trích yếu</th>
                            <th>Ngày ban hành</th>
                            <th>Cơ quan ban hành</th>
                            <th>Người nhập</th>
                            <th>Ngày nhận </th>
                            <th>Chuyển cán bộ </th>

                        </tr>
                        </thead>
                        <tbody id="table">
                        @if(0 !=count($dataVanBanOfVanThu->vanBanDen))
                            @foreach($dataVanBanOfVanThu->vanBanDen as $row)
                                <tr>
                                    <td>{{$sttDonDi}}</td>
                                    <td>
                                        <a href="{{url('/chinhsuavanban/'.$row->id)}}"> {{$row->sohieu}}</a>
                                    </td>
                                    <td>{{$row->tenvanban}}</td>
                                    <td>{{$row->trichdan}}</td>
                                    <td>{{($row->ngaybanhanh !='0000-00-00')?date("d/m/Y",strtotime($row->ngaybanhanh)):''}}</td>
                                    <td>{{$row->coquanbanhanh }}</td>
                                    <td>
                                        {{date("d/m/Y",strtotime($row->ngayNhan))}}
                                    </td>
                                    <td>
                                        @foreach($thongTinNhanVien as $nhanVien)
                                            @if($nhanVien->accountid == $row->accountId )
                                                {{$nhanVien->fullname}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($thongTinNhanVien as $nhanVien)
                                            @if($nhanVien->accountid == $row->canBoNhan )
                                                {{$nhanVien->fullname}}
                                            @endif
                                        @endforeach
                                    </td>


                                </tr>
                                <?php $sttDonDi++ ?>
                            @endforeach
                        @else

                        @endif
                        </tbody>
                    </table>

                </div>

            </div>
            <div class="panel panel-default" id="danhSachVanBan" style="display: none">
                <div class="panel-heading ">DANH SÁCH VĂN BẢN PHÁT HÀNH </div>
                <div class="ketqua-kntc" style="padding-top: 2%">
                    <table id="tableVanBan" class="table table-bordered table-hover" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Số văn bản</th>
                            <th>Tên văn bản</th>
                            <th>Trích yếu</th>
                            <th>Ngày ban hành</th>
                            <th>Cơ quan ban hành</th>
                            <th>Người nhập</th>
                            <th>Ngày nhận </th>
                            <th>Chuyển cán bộ </th>

                        </tr>
                        </thead>
                        <tbody id="table">
                        @if(0 !=count($dataVanBanOfVanThu->vanBanPhatHanh))
                            @foreach($dataVanBanOfVanThu->vanBanPhatHanh as $row)
                                <tr>
                                    <td>{{$sttVBPH}}</td>
                                    <td>
                                        <a href="{{url('/chinhsuavanban/'.$row->id)}}"> {{$row->sohieu}}</a>
                                    </td>
                                    <td>{{$row->tenvanban}}</td>
                                    <td>{{$row->trichdan}}</td>
                                    <td>{{($row->ngaybanhanh !='0000-00-00')?date("d/m/Y",strtotime($row->ngaybanhanh)):''}}</td>
                                    <td>{{$row->coquanbanhanh }}</td>
                                    <td>
                                        {{date("d/m/Y",strtotime($row->ngayNhan))}}
                                    </td>
                                    <td>
                                        @foreach($thongTinNhanVien as $nhanVien)
                                            @if($nhanVien->accountid == $row->accountId )
                                                {{$nhanVien->fullname}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($thongTinNhanVien as $nhanVien)
                                            @if($nhanVien->accountid == $row->canBoNhan )
                                                {{$nhanVien->fullname}}
                                            @endif
                                        @endforeach
                                    </td>


                                </tr>
                                <?php $sttVBPH++ ?>
                            @endforeach
                        @else

                        @endif
                        </tbody>
                    </table>

                </div>

            </div>
        </div>


    {{--</div>--}}
    <script>

        var CHOXULY = 0;
        var DANGXULY = 1;
        var DAGIAIQUYET = 3;

        showPopupDonThu();

        $(document).ready(function(){
            $(".nav-tabs a").click(function(){
                $(this).tab("show");
            });


        });

        function showPopupDonThu() {
            if("{{$soDonThuMoiDuocGiao}}" > 0)
            {
                $.notify({
                    title: '<strong> Thông Báo: </strong>',
                    message: 'Có '+ "{{$soDonThuMoiDuocGiao}}" + " đơn cần bạn giải quyết.<br>"+"<a href=\"{{url("danhsachdonthumoicanxuly")}}\">Xem chi tiết</a>"
                },{
                    animate: {
                        enter: 'animated fadeInDown',
                        exit: 'animated fadeOutUp'
                    },
                    type: 'danger',
                    delay: 0
                });
            }
        }

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


        function chonHienThiKetQua(e)
        {

            switch (e.id)
            {
                case 'xuLyDon':
                    AnHienPanel('#donXuLy',true);
                    AnHienPanel('#donGiaiQuyet',false);
                    AnHienPanel('#donGiongNhau',false);
                    AnHienPanel('#bangKetQuaTD',false);
                    AnHienPanel('#lichtiepcongdan',false);
                    AnHienPanel('#donChoXuLy',false);
                    AnHienPanel('#donDangXuLy',false);
                    AnHienPanel('#danhSachHS',false);
                    AnHienPanel('#danhSachDonDi',false);
                    AnHienPanel('#danhSachVanBan',false);
                    break;
                case 'quyetDinhGQ':
                    AnHienPanel('#donXuLy',false);
                    AnHienPanel('#donGiaiQuyet',true);
                    AnHienPanel('#donGiongNhau',false);
                    AnHienPanel('#bangKetQuaTD',false);
                    AnHienPanel('#lichtiepcongdan',false);
                    AnHienPanel('#donChoXuLy',false);
                    AnHienPanel('#donDangXuLy',false);
                    AnHienPanel('#danhSachHS',false);
                    AnHienPanel('#danhSachDonDi',false);
                    AnHienPanel('#danhSachVanBan',false);
                    break;
                case 'donNhieuNoi':
                    AnHienPanel('#donXuLy',false);
                    AnHienPanel('#donGiaiQuyet',false);
                    AnHienPanel('#donGiongNhau',true);
                    AnHienPanel('#bangKetQuaTD',false);
                    AnHienPanel('#lichtiepcongdan',false);
                    AnHienPanel('#donChoXuLy',false);
                    AnHienPanel('#donDangXuLy',false);
                    AnHienPanel('#danhSachHS',false);
                    AnHienPanel('#danhSachDonDi',false);
                    AnHienPanel('#danhSachVanBan',false);
                    break;
                case 'ketQuaTD':
                    AnHienPanel('#donXuLy',false);
                    AnHienPanel('#donGiaiQuyet',false);
                    AnHienPanel('#donGiongNhau',false);
                    AnHienPanel('#bangKetQuaTD',true);
                    AnHienPanel('#lichtiepcongdan',false);
                    AnHienPanel('#donChoXuLy',false);
                    AnHienPanel('#donDangXuLy',false);
                    AnHienPanel('#danhSachHS',false);
                    AnHienPanel('#danhSachDonDi',false);
                    AnHienPanel('#danhSachVanBan',false);
                    break;
                case 'lichTD':
                    AnHienPanel('#donXuLy',false);
                    AnHienPanel('#donGiaiQuyet',false);
                    AnHienPanel('#donGiongNhau',false);
                    AnHienPanel('#bangKetQuaTD',false);
                    AnHienPanel('#lichtiepcongdan',true);
                    AnHienPanel('#donChoXuLy',false);
                    AnHienPanel('#donDangXuLy',false);
                    AnHienPanel('#danhSachHS',false);
                    AnHienPanel('#danhSachDonDi',false);
                    AnHienPanel('#danhSachVanBan',false);
                    break;
                case 'vanBanChoXuLyId':
                    AnHienPanel('#donXuLy',false);
                    AnHienPanel('#donGiaiQuyet',false);
                    AnHienPanel('#donGiongNhau',false);
                    AnHienPanel('#bangKetQuaTD',false);
                    AnHienPanel('#lichtiepcongdan',false);
                    AnHienPanel('#donChoXuLy',true);
                    AnHienPanel('#donDangXuLy',false);
                    AnHienPanel('#danhSachHS',false);
                    AnHienPanel('#danhSachDonDi',false);
                    AnHienPanel('#danhSachVanBan',false);
                    break;
                case 'vanBanDangXuLy':
                    AnHienPanel('#donXuLy',false);
                    AnHienPanel('#donGiaiQuyet',false);
                    AnHienPanel('#donGiongNhau',false);
                    AnHienPanel('#bangKetQuaTD',false);
                    AnHienPanel('#lichtiepcongdan',false);
                    AnHienPanel('#donChoXuLy',false);
                    AnHienPanel('#donDangXuLy',true);
                    AnHienPanel('#danhSachHS',false);
                    AnHienPanel('#danhSachDonDi',false);
                    AnHienPanel('#danhSachVanBan',false);
                    break;
                case 'donKetThuc':
                    AnHienPanel('#donXuLy',false);
                    AnHienPanel('#donGiaiQuyet',false);
                    AnHienPanel('#donGiongNhau',false);
                    AnHienPanel('#bangKetQuaTD',false);
                    AnHienPanel('#lichtiepcongdan',false);
                    AnHienPanel('#donChoXuLy',false);
                    AnHienPanel('#donDangXuLy',false);
                    AnHienPanel('#danhSachHS',true);
                    AnHienPanel('#danhSachDonDi',false);
                    AnHienPanel('#danhSachVanBan',false);
                    break;
                case 'donDen':
                    AnHienPanel('#donXuLy',false);
                    AnHienPanel('#donGiaiQuyet',false);
                    AnHienPanel('#donGiongNhau',false);
                    AnHienPanel('#bangKetQuaTD',false);
                    AnHienPanel('#lichtiepcongdan',false);
                    AnHienPanel('#donChoXuLy',false);
                    AnHienPanel('#donDangXuLy',false);
                    AnHienPanel('#danhSachHS',false);
                    AnHienPanel('#danhSachDonDen',true);
                    AnHienPanel('#danhSachDonDi',false);
                    AnHienPanel('#danhSachVanBan',false);
                    break;
                case 'donDi':
                    AnHienPanel('#donXuLy',false);
                    AnHienPanel('#donGiaiQuyet',false);
                    AnHienPanel('#donGiongNhau',false);
                    AnHienPanel('#bangKetQuaTD',false);
                    AnHienPanel('#lichtiepcongdan',false);
                    AnHienPanel('#donChoXuLy',false);
                    AnHienPanel('#donDangXuLy',false);
                    AnHienPanel('#danhSachHS',false);
                    AnHienPanel('#danhSachDonDen',false);
                    AnHienPanel('#danhSachDonDi',true);
                    AnHienPanel('#danhSachVanBan',false);
                    break;
                case 'vanBanPhatHanh':
                    AnHienPanel('#donXuLy',false);
                    AnHienPanel('#donGiaiQuyet',false);
                    AnHienPanel('#donGiongNhau',false);
                    AnHienPanel('#bangKetQuaTD',false);
                    AnHienPanel('#lichtiepcongdan',false);
                    AnHienPanel('#donChoXuLy',false);
                    AnHienPanel('#donDangXuLy',false);
                    AnHienPanel('#danhSachHS',false);
                    AnHienPanel('#danhSachDonDen',false);
                    AnHienPanel('#danhSachDonDi',false);
                    AnHienPanel('#danhSachVanBan',true);
                    break;
                default:

                    break;
            }
        }

        function chonHienThiKetQua2(value)
        {
            console.log(value);
            switch (value)
            {
                case 'xuLyDon':
                    AnHienPanel('#donXuLy',true);
                    AnHienPanel('#donGiaiQuyet',false);
                    AnHienPanel('#donGiongNhau',false);
                    AnHienPanel('#bangKetQuaTD',false);
                    AnHienPanel('#lichtiepcongdan',false);
                    AnHienPanel('#donChoXuLy',false);
                    AnHienPanel('#donDangXuLy',false);
                    AnHienPanel('#danhSachHS',false);
                    AnHienPanel('#danhSachDonDi',false);
                    AnHienPanel('#danhSachVanBan',false);
                    break;
                case 'quyetDinhGQ':
                    AnHienPanel('#donXuLy',false);
                    AnHienPanel('#donGiaiQuyet',true);
                    AnHienPanel('#donGiongNhau',false);
                    AnHienPanel('#bangKetQuaTD',false);
                    AnHienPanel('#lichtiepcongdan',false);
                    AnHienPanel('#donChoXuLy',false);
                    AnHienPanel('#donDangXuLy',false);
                    AnHienPanel('#danhSachHS',false);
                    AnHienPanel('#danhSachDonDi',false);
                    AnHienPanel('#danhSachVanBan',false);
                    break;
                case 'donNhieuNoi':
                    AnHienPanel('#donXuLy',false);
                    AnHienPanel('#donGiaiQuyet',false);
                    AnHienPanel('#donGiongNhau',true);
                    AnHienPanel('#bangKetQuaTD',false);
                    AnHienPanel('#lichtiepcongdan',false);
                    AnHienPanel('#donChoXuLy',false);
                    AnHienPanel('#donDangXuLy',false);
                    AnHienPanel('#danhSachHS',false);
                    AnHienPanel('#danhSachDonDi',false);
                    AnHienPanel('#danhSachVanBan',false);
                    break;
                case 'ketQuaTD':
                    AnHienPanel('#donXuLy',false);
                    AnHienPanel('#donGiaiQuyet',false);
                    AnHienPanel('#donGiongNhau',false);
                    AnHienPanel('#bangKetQuaTD',true);
                    AnHienPanel('#lichtiepcongdan',false);
                    AnHienPanel('#donChoXuLy',false);
                    AnHienPanel('#donDangXuLy',false);
                    AnHienPanel('#danhSachHS',false);
                    AnHienPanel('#danhSachDonDi',false);
                    AnHienPanel('#danhSachVanBan',false);
                    break;
                case 'lichTD':
                    AnHienPanel('#donXuLy',false);
                    AnHienPanel('#donGiaiQuyet',false);
                    AnHienPanel('#donGiongNhau',false);
                    AnHienPanel('#bangKetQuaTD',false);
                    AnHienPanel('#lichtiepcongdan',true);
                    AnHienPanel('#donChoXuLy',false);
                    AnHienPanel('#donDangXuLy',false);
                    AnHienPanel('#danhSachHS',false);
                    AnHienPanel('#danhSachDonDi',false);
                    AnHienPanel('#danhSachVanBan',false);
                    break;
                case 'vanBanChoXuLyId':
                    AnHienPanel('#donXuLy',false);
                    AnHienPanel('#donGiaiQuyet',false);
                    AnHienPanel('#donGiongNhau',false);
                    AnHienPanel('#bangKetQuaTD',false);
                    AnHienPanel('#lichtiepcongdan',false);
                    AnHienPanel('#donChoXuLy',true);
                    AnHienPanel('#donDangXuLy',false);
                    AnHienPanel('#danhSachHS',false);
                    AnHienPanel('#danhSachDonDi',false);
                    AnHienPanel('#danhSachVanBan',false);
                    break;
                case 'vanBanDangXuLy':
                    AnHienPanel('#donXuLy',false);
                    AnHienPanel('#donGiaiQuyet',false);
                    AnHienPanel('#donGiongNhau',false);
                    AnHienPanel('#bangKetQuaTD',false);
                    AnHienPanel('#lichtiepcongdan',false);
                    AnHienPanel('#donChoXuLy',false);
                    AnHienPanel('#donDangXuLy',true);
                    AnHienPanel('#danhSachHS',false);
                    AnHienPanel('#danhSachDonDi',false);
                    AnHienPanel('#danhSachVanBan',false);
                    break;
                case 'donKetThuc':
                    AnHienPanel('#donXuLy',false);
                    AnHienPanel('#donGiaiQuyet',false);
                    AnHienPanel('#donGiongNhau',false);
                    AnHienPanel('#bangKetQuaTD',false);
                    AnHienPanel('#lichtiepcongdan',false);
                    AnHienPanel('#donChoXuLy',false);
                    AnHienPanel('#donDangXuLy',false);
                    AnHienPanel('#danhSachHS',true);
                    AnHienPanel('#danhSachDonDi',false);
                    AnHienPanel('#danhSachVanBan',false);
                    break;
                case 'donDen':
                    AnHienPanel('#donXuLy',false);
                    AnHienPanel('#donGiaiQuyet',false);
                    AnHienPanel('#donGiongNhau',false);
                    AnHienPanel('#bangKetQuaTD',false);
                    AnHienPanel('#lichtiepcongdan',false);
                    AnHienPanel('#donChoXuLy',false);
                    AnHienPanel('#donDangXuLy',false);
                    AnHienPanel('#danhSachHS',false);
                    AnHienPanel('#danhSachDonDen',true);
                    AnHienPanel('#danhSachDonDi',false);
                    AnHienPanel('#danhSachVanBan',false);
                    break;
                case 'donDi':
                    AnHienPanel('#donXuLy',false);
                    AnHienPanel('#donGiaiQuyet',false);
                    AnHienPanel('#donGiongNhau',false);
                    AnHienPanel('#bangKetQuaTD',false);
                    AnHienPanel('#lichtiepcongdan',false);
                    AnHienPanel('#donChoXuLy',false);
                    AnHienPanel('#donDangXuLy',false);
                    AnHienPanel('#danhSachHS',false);
                    AnHienPanel('#danhSachDonDen',false);
                    AnHienPanel('#danhSachDonDi',true);
                    AnHienPanel('#danhSachVanBan',false);
                    break;
                case 'vanBanPhatHanh':
                    AnHienPanel('#donXuLy',false);
                    AnHienPanel('#donGiaiQuyet',false);
                    AnHienPanel('#donGiongNhau',false);
                    AnHienPanel('#bangKetQuaTD',false);
                    AnHienPanel('#lichtiepcongdan',false);
                    AnHienPanel('#donChoXuLy',false);
                    AnHienPanel('#donDangXuLy',false);
                    AnHienPanel('#danhSachHS',false);
                    AnHienPanel('#danhSachDonDen',false);
                    AnHienPanel('#danhSachDonDi',false);
                    AnHienPanel('#danhSachVanBan',true);
                    break;
                default:

                    break;
            }
        }

        var numbDonthuChoXuLy ={{ count($numbDonThu->choXuLy) }};

        var numbDonthuDangXuLy ={{ count($numbDonThu->dangXuLy) }};

        {{--function updateNumbDonThu()--}}
        {{--{--}}
            {{--$.ajax({--}}
                {{--type: 'post',--}}
                {{--url:  '{{URL::to('getNumberDonthuOfMaster')}}',--}}
                {{--data: {},--}}
                {{--success: function (data)--}}
                {{--{--}}
                    {{--if( data[0].choXuLy.length != numbDonthuChoXuLy || data[0].dangXuLy.length != numbDonthuDangXuLy)--}}
                    {{--{--}}

                        {{--$('#numbVanBanChoXuly').html(data[0].choXuLy.length);--}}

                        {{--$('#numbVanBanDangXuly').html(data[0].dangXuLy.length);--}}

                        {{--numbDonthuChoXuLy = data[0].choXuLy.length;--}}

                        {{--numbDonthuDangXuLy = data[0].dangXuLy.length;--}}

                        {{--danhSachDonXuLy(data[0].choXuLy,"bodyChoXuLy");--}}
                        {{--danhSachDonXuLy(data[0].dangXuLy,"bodyDangXuLy");--}}

                    {{--}--}}
                {{--}--}}
            {{--});--}}

            {{--setTimeout(updateNumbDonThu, 5000);--}}

        {{--}--}}

        {{--$(document).ready(function(){--}}
            {{--updateNumbDonThu();--}}
        {{--});--}}

        function danhSachDonXuLy(donthu,idDiv)
        {
            document.getElementById(idDiv).innerHTML = '';

            var bodyDatahtml = '' ;
            var stt=null;
            var trangThaiXL= '';


            for(var i = 0; i< donthu.length;i++)
            {
                var url = <?php echo json_encode(url('/chitietdonthu')); ?>;
                //trang thai xu ly
                if(donthu[i].trangthaixuly == CHOXULY)
                {
                    trangThaiXL = 'chờ xử lý';

                }
                else if(donthu[i].trangthaixuly == DANGXULY)
                {
                    trangThaiXL = 'đang xử lý';

                }
                else
                {
                    trangThaiXL = 'đã giải quyết';
                }



                var id = donthu[i].donthuid;

                bodyDatahtml = bodyDatahtml +
                       ' <tr>'+
                        '<td>'+(i+1)+'</td>'+
                        '<td>'+'<a href="'+url+'/'+id+'">'+donthu[i].sothuly+'</a></td>'+
                        '<td>'+donthu[i].noidung.substring(0,40)+'</td>'+
                        '<td>'+ NguoiCapNhat(donthu[i].nguoinhap)+'</td>'+
                        '<td>'+donthu[i].ngay_nhan_view+'</td>'+
                        '<td>'+ donthu[i].han_xu_ly_view+'</td>'+
                        '<td>'+ HanXuLyConLai(donthu[i].ngay_con_lai_view)+'</td>'+
                        '<td>'+ trangThaiXL+'</td>'+

                        '</tr>';
            }

            document.getElementById(idDiv).innerHTML = bodyDatahtml;

        }


        $(document).ready(function(){

            var table = $('#danhsach').DataTable({
                "bSort": true,
                "language": {
                    "search": "Tìm kiếm:",
                    "emptyTable":     "Không có kết quả nào!",
                    "info":           "Hiển thị từ _START_ đến _END_ của _TOTAL_ mẫu tin",
                    "lengthMenu":     "Hiển thị _MENU_ dòng",
                    "infoEmpty":      "Hiển thị từ 0 đến 0 của 0 mẫu tin"
                }

            } );



            //table don den
            var tableDonDen = $('#danhSachDonChoXL').DataTable({
                "bSort": true,
                "language": {
                    "search": "Tìm kiếm:",
                    "emptyTable":     "Không có kết quả nào!",
                    "info":           "Hiển thị từ _START_ đến _END_ của _TOTAL_ mẫu tin",
                    "lengthMenu":     "Hiển thị _MENU_ dòng",
                    "infoEmpty":      "Hiển thị từ 0 đến 0 của 0 mẫu tin"
                }

            } );

            //don di
            var tableDonDi = $('#danhSachDonDangXL').DataTable({
                "bSort": true,
                "language": {
                    "search": "Tìm kiếm:",
                    "emptyTable":     "Không có kết quả nào!",
                    "info":           "Hiển thị từ _START_ đến _END_ của _TOTAL_ mẫu tin",
                    "lengthMenu":     "Hiển thị _MENU_ dòng",
                    "infoEmpty":      "Hiển thị từ 0 đến 0 của 0 mẫu tin"
                }

            } );

            //don dang xu ly danhSachDonDangXL

            var tabledanhSachKetQuaTDId = $('#danhSachKetQuaTDId').DataTable({
                "language": {
                    "search": "Tìm kiếm:",
                    "emptyTable":     "Không có kết quả nào!",
                    "info":           "Hiển thị từ _START_ đến _END_ của _TOTAL_ mẫu tin",
                    "lengthMenu":     "Hiển thị _MENU_ dòng",
                    "infoEmpty":      "Hiển thị từ 0 đến 0 của 0 mẫu tin"
                },
                "bSort": true
            } );


            // tableDonDen
            var tableDonDen = $('#tableDonDen').DataTable({
                "language": {
                    "search": "Tìm kiếm:",
                    "emptyTable":     "Không có kết quả nào!",
                    "info":           "Hiển thị từ _START_ đến _END_ của _TOTAL_ mẫu tin",
                    "lengthMenu":     "Hiển thị _MENU_ dòng",
                    "infoEmpty":      "Hiển thị từ 0 đến 0 của 0 mẫu tin"
                },
                "bSort": true
            } );

            //tableDonDi
            var tableDonDi = $('#tableDonDi').DataTable({
                "language": {
                    "search": "Tìm kiếm:",
                    "emptyTable":     "Không có kết quả nào!",
                    "info":           "Hiển thị từ _START_ đến _END_ của _TOTAL_ mẫu tin",
                    "lengthMenu":     "Hiển thị _MENU_ dòng",
                    "infoEmpty":      "Hiển thị từ 0 đến 0 của 0 mẫu tin"
                },
                "bSort": true
            } );

            //tableVanBan

            var tableVanBan = $('#tableVanBan').DataTable({
                "bSort": true,
                "language": {
                    "search": "Tìm kiếm:",
                    "emptyTable":     "Không có kết quả nào!",
                    "info":           "Hiển thị từ _START_ đến _END_ của _TOTAL_ mẫu tin",
                    "lengthMenu":     "Hiển thị _MENU_ dòng",
                    "infoEmpty":      "Hiển thị từ 0 đến 0 của 0 mẫu tin"
                }

            } );
        });


        //nguoi cap nhat
        var danhSachNV = <?php echo json_encode($thongTinNhanVien)?>;
        function NguoiCapNhat(nhanVienId)
        {
            var tenNhanVien = "";
            for (var i = 0; i < danhSachNV.length;i++ )
            {
                if(danhSachNV[i].accountid == nhanVienId)
                {
                    tenNhanVien = danhSachNV[i].fullname;
                }
            }

            return tenNhanVien;

        }

        //han xu ly con lai

        function HanXuLyConLai(hanConLai)
        {
            if (hanConLai.type == 2)
            {
                return "quá hạn";
            }
            else
            {
                return hanConLai.day +" ngày";
            }

        }

        @if(trim($tabView) != '')

            $(document).ready(function() {
                chonHienThiKetQua2('{{ $tabView }}');
            });

        @endif

    </script>
@endsection