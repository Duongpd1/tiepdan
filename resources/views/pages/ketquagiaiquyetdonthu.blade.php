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
        var element1 = document.getElementById("hs");
        element1.classList.add("active");
        var element = document.getElementById("htab-nghiepvu");
        element.classList.add("active");
        element.classList.add("in");

    </script>
    <?php
        //print_r($result['theodoi']);
        //print_r($result['xacminh']);
        function convertNgay($ngayTuDatabase){
            $ngayExplore = explode('-',$ngayTuDatabase);
            $ngay = $ngayExplore[2];
            $thang = $ngayExplore[1];
            $nam = $ngayExplore[0];
            return $ngay.'-'.$thang.'-'.$nam;
        }
    ?>
    <div id="donthu" class="col-background" style="margin-bottom: 100px;">
        <div class="panel panel-default">
            <div class="panel-heading text-center">CHI TIẾT ĐƠN</div>
            <form method="post" action="luuketquagaiquyet" enctype="multipart/form-data" id="formKQ">
            <div class="panel-body row" style="padding: 10px 0">
                <div class="col-xs-6">
                    <button type="button" name="back" value="" onclick="ClickBTN(this);" id="back" title="Trở lại" class="btn btn-sm btn-danger">
                        <span class="glyphicon glyphicon-arrow-left"></span>
                        Trở lại
                    </button>
                </div>
                {{--<div class="col-xs-6 text-right">--}}
                    {{--<button class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown">--}}
                        {{--<span class="glyphicon glyphicon-print"></span>--}}
                        {{--In phiếu <span class="caret"></span>--}}
                    {{--</button>--}}
                    {{--<ul class="dropdown-menu dropdown-menu-right">--}}
                        {{--<li><a href="" onclick=""><span class="caret-left"></span> Phiếu đề xuất xử lý đơn</a></li>--}}
                        {{--<li><a href="" onclick=""><span class="caret-left"></span> Phiếu hướng dẫn chuyển đơn</a></li>--}}
                        {{--<li><a href="" onclick=""><span class="caret-left"></span> Phiếu trả đơn thư</a></li>--}}
                        {{--<li><a href="" onclick=""><span class="caret-left"></span> Thông báo thụ lý đơn cho cá nhân</a></li>--}}
                        {{--<li><a href="" onclick=""><span class="caret-left"></span> Thông báo thụ lý đơn - do cơ quan khác chuyển đến</a></li>--}}
                        {{--<li><a href="" onclick=""><span class="caret-left"></span> Thông báo không thụ lý đơn - do cơ quan khác chuyển đến</a></li>--}}
                        {{--<li><a href="" onclick=""><span class="caret-left"></span> Quyết định giải quyết đơn thư lần 1</a></li>--}}
                        {{--<li><a href="" onclick=""><span class="caret-left"></span> Quyết định giải quyết đơn thư lần 2</a></li>--}}
                        {{--<li><a href="" onclick=""><span class="caret-left"></span> Phiếu chuyển đơn tố cáo</a></li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            </div>

            <table class="table table-bordered">
                <tbody>
                <tr id="scrollToTop1">
                    <td class="col-xs-2 text-bold">Nội dung đơn</td>
                    <td>

                        <div class="row">
                            <div class="col-xs-7" style="padding: 0">
                                <label>Số thụ lý:</label>
                                {{$result['noidung'][0]->sothuly}}
                            </div>
                            <div class="col-xs-5" style="padding: 0">
                                <label>Đơn do:</label>
                                @if($result['noidung'][0]->nguondon == "dodan")
                                    {{"Cá nhân chuyển đến"}}
                                @else
                                    {{"Do đơn vị chuyển đến"}}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7" style="padding: 0">
                                <label>
                                    Người viết đơn:
                                </label>
                                {{mb_strtoupper($result['noidung'][0]->tennguoivietdon)}}
                            </div>
                            <div class="col-xs-5" style="padding: 0">
                                <label>Địa chỉ:</label>
                                {{$result['noidung'][0]->diachinguoiviet}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4" style="padding: 0">
                                <label>
                                    Số CMND/Hộ chiếu:
                                </label>
                                @if($result['noidung'][0]->cmnd_hc!=null)
                                    {{$result['noidung'][0]->cmnd_hc}}
                                @else
                                    Chưa xác định
                                @endif
                            </div>
                            <div class="col-xs-3" style="padding: 0">
                                <label>
                                    Ngày cấp:
                                </label>
                                @if($result['noidung'][0]->ngaycap!="0000-00-00")
                                    {{convertNgay($result['noidung'][0]->ngaycap)}}
                                @else
                                    Chưa xác định
                                @endif
                            </div>
                            <div class="col-xs-5" style="padding: 0">
                                <label>
                                    Nơi cấp:
                                </label>
                                @if($result['noidung'][0]->noicap!=null)
                                    {{$result['noidung'][0]->noicap}}
                                @else
                                    Chưa xác định
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7" style="padding: 0">
                                <label>
                                    Số Điện Thoại:
                                </label>
                                @if($result['noidung'][0]->sdt!=null)
                                    {{$result['noidung'][0]->sdt}}
                                @else
                                    Chưa xác định
                                @endif
                            </div>

                            <div class="col-xs-5" style="padding: 0">
                                <label>
                                    Lần khiếu nại:
                                </label>
                                {{$result['noidung'][0]->lankhieunai}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-7" style="padding: 0">
                                <label>
                                    @if($result['phanloai'][0]->loaidon == 1)
                                        Đối tượng bị khiếu nại:
                                    @elseif($result['phanloai'][0]->loaidon == 2)
                                        Đối tượng bị tố cáo:
                                    @elseif($result['phanloai'][0]->loaidon == 3)
                                        Đối tượng trên đơn:
                                    @elseif($result['phanloai'][0]->loaidon == 4 || $result['phanloai'][0]->loaidon == 5)
                                        Đối tượng bị kiến nghị:
                                    @endif
                                </label>
                                @if($result['noidung'][0]->doituongkhieunai != null)
                                    {{mb_strtoupper($result['noidung'][0]->doituongkhieunai)}}
                                @else
                                    {{"Chưa xác định"}}
                                @endif
                            </div>
                            <div class="col-xs-5" style="padding: 0">
                                <label>
                                    Theo dạng:
                                </label>
                                @if($result['noidung'][0]->songuoi == 0)
                                    {{"Cá nhân"}}
                                @else
                                    {{"Nhiều người"}}
                                @endif
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-xs-12" style="padding: 0">
                                <label>
                                    Nội dung đơn:
                                </label>
                                <?php
                                echo $result['noidung'][0]->noidung;
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="padding: 0">
                                <p>
                                    <label>
                                        Văn bản đính kèm:
                                    </label>
                                </p>
                                @if($vanban != null)
                                    @for($i=0;$i<count($vanban);$i++)
                                        <a href="{{url($result['noidung'][0]->filepath."/".$vanban[$i])}}" download>
                                            <span class="glyphicon glyphicon-download-alt"></span>
                                            {{$vanban[$i]}}
                                        </a>
                                    @endfor
                                @else
                                    {{"Không có file đính kèm"}}
                                @endif

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-7" style="padding: 0">
                                <div>
                                    <label>Ảnh người viết đơn :</label>
                                </div>
                                @if($result['noidung'][0]->image != null)
                                    <div>
                                        <img src="{{url(FOLDERROOT.'/'.$result['noidung'][0]->filepath."/".$result['noidung'][0]->image)}}" style="width: 150px;height: 200px;" alt="Ảnh đại diện">
                                    </div>
                                @else
                                    <div>Chưa có ảnh người viết đơn!</div>
                                @endif

                            </div>

                        </div>


                    </td>
                </tr>

                <tr id="scrollToTop2">
                    <td class="col-xs-2 text-bold">Phân loại đơn</td>
                    <td>
                        @if($result['phanloai'][0]->trangthai == DAPHANLOAI  )
                            <div class="row">
                                <div class="col-xs-7" style="padding: 0">
                                    <label>Loại đơn:</label>
                                    @if($result['phanloai'][0]->loaidon != null)
                                        @for($i = 0;$i<count($loaidon);$i++)
                                            @if($result['phanloai'][0]->loaidon == $loaidon[$i]->loaidonid)
                                                {{$loaidon[$i]->tenloaidon}}
                                            @endif
                                        @endfor
                                    @else
                                        Chưa xác định
                                    @endif
                                </div>
                                <div class="col-xs-5" style="padding: 0">
                                    <label>Lĩnh vực:</label>
                                    @if($result['phanloai'][0]->linhvuc != null)
                                        @for($i = 0;$i<count($linhvuc);$i++)
                                            @if($result['phanloai'][0]->linhvuc == $linhvuc[$i]->linhvucid)
                                                {{$linhvuc[$i]->tenlinhvuc}}
                                            @endif
                                        @endfor
                                    @else
                                        Chưa xác định
                                    @endif
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-xs-7" style="padding: 0">
                                    <label>Tại địa bàn:</label>
                                    @if($result['phanloai'][0]->diaban != null)
                                        @for($i = 0;$i<count($diaban);$i++)
                                            @if($result['phanloai'][0]->diaban == $diaban[$i]->id)
                                                {{$diaban[$i]->tendiaban}}
                                            @endif
                                        @endfor
                                    @else
                                        Chưa xác định
                                    @endif
                                </div>

                                <div class="col-xs-5" style="padding: 0">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-7" style="padding: 0">
                                    <label>Hướng giải quyết:</label>
                                    @if($result['phanloai'][0]->huonggiaiquyet== THULY)
                                        Thụ Lý
                                    @elseif($result['phanloai'][0]->huonggiaiquyet== TRADON)
                                        Trả đơn
                                    @elseif($result['phanloai'][0]->huonggiaiquyet== CHUYENDON)
                                        Chuyển đơn
                                    @else
                                        Chưa xác định!
                                    @endif
                                </div>

                                @if($result['phanloai'][0]->huonggiaiquyet== CHUYENDON)
                                    <div class="col-xs-5" style="padding: 0">
                                        <label>Đơn vị:</label>
                                        @if($result['phanloai'][0]->donvichuyenden != null)
                                            @for($i = 0 ;$i<count($donvi);$i++)
                                                @if($result['phanloai'][0]->donvichuyenden == $donvi[$i]->id)
                                                    {{$donvi[$i]->tendonvi}}
                                                @endif
                                            @endfor
                                        @else
                                            Chưa xác định
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-xs-12" style="padding: 0">
                                    <label>Người xử lý:</label>
                                    @if($result['phanloai'][0]->nguoixuly != null)
                                        @for($i = 0;$i<count($nguoiXL);$i++)
                                            @if($result['phanloai'][0]->nguoixuly == $nguoiXL[$i]->accountid)
                                                {{$nguoiXL[$i]->fullname}}
                                            @endif
                                        @endfor
                                    @else
                                        Chưa xác định
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12" style="padding: 0">
                                    <label>
                                        Đề xuất trong phiếu trình:
                                    </label>
                                    @if($result['phanloai'][0]->dexuat != "")
                                        {{$result['phanloai'][0]->dexuat}}
                                    @else
                                        Chưa xác định
                                    @endif
                                </div>
                            </div>

                            <div class="row">


                                @if($vanBanTheoDon != null)
                                    @foreach($vanBanTheoDon as $vanBan)
                                        @if($vanBan->trangThai == DAPHANLOAI)
                                            <div>

                                                @foreach($nguoiXL as $nguoiTao)
                                                    @if($vanBan->account == $nguoiTao->accountid )
                                                        <h5 style="border-bottom: 1px dotted #bbb">
                                                            <span style="float: left;color: #3377c7"># </span>
                                                            <span style="font-weight: bold">Được thêm bởi <span style="color: #3377c7">{{$nguoiTao->fullname}}</span> trong  <span style="color: #3377c7">{{$vanBan->title}}</span></span>
                                                        </h5>
                                                    @endif
                                                @endforeach

                                                <div class="col-xs-12" style="padding: 0">
                                                    <label>
                                                        Văn bản:
                                                    </label>
                                                    @foreach($vanBan->vanban as $row)
                                                        <a href="{{url($row->linkfile."/".$row->tenvanban)}}" download="">
                                                            <span class="glyphicon glyphicon-download-alt"></span>
                                                            {{$row->tenvanban}}
                                                        </a>
                                                    @endforeach

                                                </div>

                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        @else
                            <div class="col-xs-10" >
                                <label>Chưa xác định</label>
                            </div>
                        @endif


                    </td>
                </tr>

                <tr id="scrollToTop3">
                    <td class="text-bold">Theo dõi, xử lý đơn</td>
                    <td>
                        @if($result['noidung'][0]->trangthaixuly == DANGGIAIQUYET || $result['noidung'][0]->trangthaixuly == DAGIAIQUYET )

                            @if($vanBanTheoDon != null)
                                @foreach($vanBanTheoDon as $vanBan)
                                    @if($vanBan->trangThai == DANGTHEODOI)
                                        <div>

                                            @foreach($nguoiXL as $nguoiTao)
                                                @if($vanBan->account == $nguoiTao->accountid )
                                                    <h5 style="border-bottom: 1px dotted #bbb">
                                                        <span style="float: left;color: #3377c7"># </span>
                                                        <span style="font-weight: bold">Được thêm bởi <span style="color: #3377c7">{{$nguoiTao->fullname}}</span> lúc  <span style="color: #3377c7">{{date("H:i:s d-m-Y",strtotime($vanBan->title))}}</span></span>
                                                    </h5>
                                                @endif
                                            @endforeach

                                            <div class="col-xs-12" style="padding: 0">
                                                <label>
                                                    Giao xử lý của lãnh đạo Ban:
                                                </label>
                                                @if($vanBan->giaoxulycualanhdao != "")
                                                    {{$vanBan->giaoxulycualanhdao}}
                                                @else
                                                    Chưa xác định
                                                @endif
                                            </div>
                                            <div class="col-xs-12" style="padding: 0">
                                                <label>
                                                    Ý kiến CV:
                                                </label>
                                                @if($vanBan->ykienCV != "")
                                                    {{$vanBan->ykienCV}}
                                                @else
                                                    Chưa xác định
                                                @endif
                                            </div>
                                            <div class="col-xs-12" style="padding: 0">
                                                <label>
                                                    Ghi chú:
                                                </label>
                                                @if($vanBan->ghichu != "")
                                                    {{$vanBan->ghichu}}
                                                @else
                                                    Chưa xác định
                                                @endif
                                            </div>
                                            <div class="col-xs-12" style="padding: 0">
                                                <label>
                                                    Văn bản:
                                                </label>
                                                @foreach($vanBan->vanban as $row)
                                                    <a href="{{url($row->linkfile."/".$row->tenvanban)}}" download="">
                                                        <span class="glyphicon glyphicon-download-alt"></span>
                                                        {{$row->tenvanban}}
                                                    </a>
                                                @endforeach

                                            </div>

                                        </div>
                                    @endif
                                @endforeach

                            @endif

                        @endif
                        <div class="row">
                            @if($result['noidung'][0]->ketqua==0)
                                <div class="col-xs-10" style="padding-left: 0">
                                    @if($result['theodoi'][0]->ngayquyetdinhxuly == '0000-00-00')
                                        <label>Chưa theo dõi, xử lý đơn khiếu tố cáo</label>
                                    @endif
                                </div>

                            @endif
                        </div>
                    </td>
                </tr>

                <tr id="scrollToTop4">
                    <td class="text-bold">Kết quả giải quyết đơn</td>
                    <td>
                        <div class="form-horizontal">
                            <input type="hidden" name="sothuly" id="sothuly" value="{{$result['noidung'][0]->sothuly}}">
                            <input type="hidden" name="donthuid" id="donthuid" value="{{$result['noidung'][0]->donthuid}}">

                            <div class="form-group form-group-sm">
                                <label for="soquyetdinh" class="control-label col-xs-3">Số quyết định </label>
                                <div class="col-xs-3">
                                    @if($result['ketqua'][0]->soquyetdinh != 0)
                                    <input name="soquyetdinh" type="text" id="soquyetdinh" class="form-control" style="width:100px;" value="{{$result['ketqua'][0]->soquyetdinh}}" >
                                    @else
                                    <input name="soquyetdinh" type="text" id="soquyetdinh" class="form-control" style="width:100px;" >
                                    @endif
                                </div>
                                <label for="ngayquyetdinh" class="control-label col-xs-3">Ngày quyết định kết quả </label>
                                <div class="col-xs-3">
                                    @if($result['ketqua'][0]->ngayquyetdinh != '0000-00-00')
                                        <input name="ngayquyetdinh" type="text" id="ngayquyetdinh" class="form-control"  style="width:100px;" value="{{ date("d-m-Y",strtotime($result['ketqua'][0]->ngayquyetdinh))}}" >
                                    @else
                                        <input name="ngayquyetdinh" type="text" id="ngayquyetdinh" class="form-control"  style="width:100px;" >
                                    @endif
                                </div>
                            </div>

                            <div class="form-group form-group-sm">
                                <label for="tieude" class="control-label col-xs-3">Tiêu đề quyết định giải quyết </label>
                                <div class="col-xs-9">
                                    <input name="tieude" type="text" id="tieude" class="form-control" value="{{$result['ketqua'][0]->tieude}}" >
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="ketquanoidung" class="control-label col-xs-3">Tóm tắt kết quả giải quyết </label>
                                <div class="col-xs-9">
                                    <textarea id="ketGQ" name="ketquanoidung" rows="5" cols="20" >{{$result['ketqua'][0]->tomtatketqua}}</textarea>
                                    <script>
                                        CKEDITOR.replace( 'ketquanoidung', {
                                            language: 'vi'
                                        } );
                                    </script>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-xs-3">File scan VB giải quyết</label>
                                <div class="col-xs-9">
                                    <input type="file" name="vbgiaiquyet" id="vbgiaiquyet">
                                </div>
                                @if($result['ketqua'][0]->vanbangiaiquyet != null)
                                    <div class="col-xs-9" style="margin-top: 10px">
                                        <a href="{{url($result['ketqua'][0]->linkfile.'/'.$result['ketqua'][0]->vanbangiaiquyet)}}" title='Tải về' download>
                                            <img src="{{url('/img/file.png')}}" style="height:25px;width:20px"/>&nbsp;{{$result['ketqua'][0]->vanbangiaiquyet}}
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="danhgiadonthu" class="control-label col-xs-3">Đánh giá đơn </label>
                                <div class="col-xs-9">
                                    <select name="danhgiadonthu" id="danhgiadonthu" class="form-control">
                                        @if($result['ketqua'][0]->danhgiadonthu=="2")
                                            <option value="1">Đúng toàn bộ</option>
                                            <option value="2" selected="selected">Đúng một phần</option>
                                            <option value="3">Sai</option>
                                        @elseif($result['ketqua'][0]->danhgiadonthu=="3")
                                            <option value="1">Đúng toàn bộ</option>
                                            <option value="2">Đúng một phần</option>
                                            <option value="3" selected="selected">Sai</option>
                                        @else
                                            <option value="1" selected="selected">Đúng toàn bộ</option>
                                            <option value="2">Đúng một phần</option>
                                            <option value="3">Sai</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            {{--<div class="form-group form-group-sm">--}}
                                {{--<label class="control-label col-xs-3">Các mục phải thu</label>--}}
                                {{--<div class="col-xs-9">--}}
                                    {{--<div class="input-group input-group-sm">--}}
                                        {{--<span class="input-group-addon">Phải thu tiền</span>--}}
                                        {{--<input name="phaithutien" type="text" id="phaithutien" class="form-control" value="{{$result['ketqua'][0]->thutien}}">--}}
                                        {{--<span class="input-group-addon">Phải trả tiền</span>--}}
                                        {{--<input name="phaitratien" type="text" value="{{$result['ketqua'][0]->tratien}}" id="phaitratien" class="form-control">--}}
                                        {{--<span class="input-group-addon">ĐVT 1.000 VNĐ</span>--}}
                                    {{--</div>--}}
                                    {{--<div class="input-group input-group-sm" style="margin-top: 15px">--}}
                                        {{--<span class="input-group-addon">Phải thu đất</span>--}}
                                        {{--<input name="phaithudat" type="text" value="{{$result['ketqua'][0]->thudat}}" id="phaithudat" class="form-control">--}}
                                        {{--<span class="input-group-addon">Phải trả đất</span>--}}
                                        {{--<input name="phaitradat" type="text" value="{{$result['ketqua'][0]->tradat}}" id="phaitradat" class="form-control">--}}
                                        {{--<span class="input-group-addon">Đơn vị tính m²</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group form-group-sm">
                                <label class="control-label col-xs-3">
                                    Kết thúc xử lý đơn
                                </label>
                                <div class="col-xs-9">
                                    <select name="ketthucdonthu" id="ketthucdonthu" class="form-control" onchange="ShowSelectd(this);">
                                        @if($result['noidung'][0]->ketqua == RUTDONTHU)
                                            <option value=""></option>
                                            <option value="kt">Kết thúc xử lý đơn</option>
                                            <option value="rd" selected>Rút đơn</option>

                                        @elseif($result['noidung'][0]->ketqua ==  KETTHUCDONTHU)
                                            <option value=""></option>
                                            <option value="kt" selected>Kết thúc xử lý đơn</option>
                                            <option value="rd">Rút đơn</option>
                                        @else
                                            <option value="" selected></option>
                                            <option value="kt" >Kết thúc xử lý đơn</option>
                                            <option value="rd">Rút đơn</option>
                                        @endif

                                    </select>

                                @if($result['noidung'][0]->ketqua == RUTDONTHU)
                                    <div class="panel panel-default" id="pnlRutDonThu" style="margin-top: 5px">
                                @else
                                    <div class="panel panel-default" id="pnlRutDonThu" style="display: none; margin-top: 5px">
                                @endif
                                        <div class="panel-heading">Thông tin rút đơn</div>
                                        <div class="panel-body">
                                            <div class="form-group form-group-sm">
                                                <label for="ngaynhan" class="control-label col-xs-3">
                                                    Ngày nhận đơn
                                                </label>
                                                <div class="col-xs-9">
                                                    @if($result['noidung'][0]->ketqua == RUTDONTHU)
                                                        <input name="ngaynhan" type="text" id="ngaynhan" class="form-control" style="width:100px;" value="{{ date("d-m-Y",strtotime($result['ketthuc'][0]->ngaynhan))}}" >
                                                    @else
                                                        <input name="ngaynhan" type="text" id="ngaynhan" class="form-control" style="width:100px;" >
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label for="ngaytrendon" class="control-label col-xs-3">
                                                    Ngày ghi trên đơn
                                                </label>
                                                <div class="col-xs-9">
                                                    @if($result['noidung'][0]->ketqua == RUTDONTHU)
                                                        <input name="ngaytrendon" type="text" id="ngaytrendon" class="form-control" style="width:100px;" value="{{date("d-m-Y",strtotime($result['ketthuc'][0]->ngaytrendon))}}" >
                                                    @else
                                                        <input name="ngaytrendon" type="text" id="ngaytrendon" class="form-control" style="width:100px;" >
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label for="lydorutdon" class="control-label col-xs-3">
                                                    Lý do rút đơn
                                                </label>
                                                <div class="col-xs-9">
                                                    @if($result['noidung'][0]->ketqua == RUTDONTHU)
                                                    <textarea name="lydorutdon" rows="5" cols="20" id="lydorutdon" class="form-control" >{{$result['ketthuc'][0]->lydo}}</textarea>
                                                    @else
                                                    <textarea name="lydorutdon" rows="5" cols="20" id="lydorutdon" class="form-control" ></textarea>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label for="dexuat" class="control-label col-xs-3">Đề xuất khác</label>
                                                <div class="col-xs-9">
                                                    @if($result['noidung'][0]->ketqua == RUTDONTHU)
                                                    <textarea name="dexuat" rows="5" cols="20" id="dexuat" class="form-control">{{$result['ketthuc'][0]->dexuat}}</textarea>
                                                    @else
                                                    <textarea name="dexuat" rows="5" cols="20" id="dexuat" class="form-control"></textarea>
                                                    @endif


                                                </div>
                                            </div>
                                            @if($result['noidung'][0]->ketqua == RUTDONTHU || $result['phanloai'][0]->loaidon == 1)
                                                <div class="form-group form-group-sm">
                                                    <label for="dexuat" class="control-label col-xs-3">Quyết định đình chỉ giải quyết khiếu nại</label>
                                                    <div class="col-xs-9">

                                                        <input name="dinhchikn" rows="5" cols="20" id="dinhchikn" class="form-control">

                                                    </div>
                                                </div>
                                            @endif
                                            @if($result['noidung'][0]->ketqua == RUTDONTHU || $result['phanloai'][0]->loaidon == 2)
                                                <div class="form-group form-group-sm">
                                                    <label for="dexuat" class="control-label col-xs-3">Thông báo chấm dứt tố cáo</label>
                                                    <div class="col-xs-9">

                                                        <input name="chamduttc" rows="5" cols="20" id="chamduttc" class="form-control">

                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                {{--@endif--}}
                                </div>
                            </div>

                            <div class="form-group form-group-sm">
                                <div class="col-xs-9 col-xs-offset-3">
                                    <input type="submit" name="btnluu" value="Lưu" id="btnluu" class="btn btn-sm btn-success" >
                                    <input type="reset" value="Nhập lại" class="btn btn-sm btn-warning">
                                    <input type="button" value="Hủy" id="{{$result['noidung'][0]->donthuid}}" onclick="backtochitietdonthu(this.id)" class="btn btn-sm btn-danger">
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">

                            function backtochitietdonthu(donthuid){
                                var chitietdonthuurl = <?php echo json_encode(url('/chitietdonthu')); ?>;
                                window.location.href = chitietdonthuurl+'/'+donthuid;
                            }

                            $('html, body').animate({ scrollTop: $('#scrollToTop4').position().top }, 'slow');

                            $("#formKQ").validate({
                                rules: {
                                    ketGQ: {required: true },
                                    ngayquyetdinh: {required: true, dateFormat: true},
                                    soquyetdinh: {required: true },
                                    tieude: {required: true }
                                },
                                messages: {
                                    ketGQ: {required: "Vui lòng nhập số quyết định!"},
                                    ngayquyetdinh: {required: "Vui lòng nhập ngày quyết định!" },
                                    soquyetdinh: {required: "Vui lòng nhập số quyết định!" },
                                    tieude: {required: "Tiêu đề quyết định giải quyết!" }
                                },
                                success: function (label) {
                                    label.remove();
                                }
                            });
                        </script>

                    </td>
                </tr>
                </tbody>
            </table>
            </form>
        </div>

    </div>

    <script>


        //date picker
        $( function() {
            $( "#ngayviet" ).datepicker({format: 'dd-mm-yyyy'});
            $( "#ngaynhan" ).datepicker({format: 'dd-mm-yyyy'});
            $( "#ngaychuyen" ).datepicker({format: 'dd-mm-yyyy'});
            $( "#ngayquyetdinh" ).datepicker({format: 'dd-mm-yyyy'});
            $( "#ngaytrendon" ).datepicker({format: 'dd-mm-yyyy'});
        } );


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
//            str += CheckInput('ketGQ', "Vui lòng nhập tóm tắt kết quả giải quyết.\r\n");

            if ($('#ketthucdonthu').val() == "rd") {
                str += CheckInput('ngaynhan', "Vui lòng nhập ngày nhận đơn.\r\n");
                str += CheckInput('ngaytrendon', "Vui lòng nhập ngày trên đơn.\r\n");
                str += CheckInput('lydorutdon', "Vui lòng điền lý do rút đơn.\r\n");
//                str += CheckInput('vbuyquyen', "Vui lòng chọn văn bản ủy quyền.\r\n");
            }

            str += CheckInput('ketthucdonthu', "Vui lòng chọn kết thúc đơn.\r\n");


            if (str.length > 0) {
                alert(str);
                return false
            }
            return true;
        }
        //click
        function ClickBTN(d)
        {
            switch (d.id)
            {
                case "back":
                    window.location.href = "{{url('/danhsachdonthu')}}";
                    break;
                default:

                    break;
            }
        }

        //get value select
        function ShowSelectd(d)
        {
            if (d.value == "rd")
            {
//                document.getElementById("pnlRutDonThu").style='margin-top: 5px';
                $('#pnlRutDonThu').show();
            }
            else
            {
//                document.getElementById("pnlRutDonThu").style.display='none';
                $('#pnlRutDonThu').hide();
            }
        }
    </script>

@endsection
