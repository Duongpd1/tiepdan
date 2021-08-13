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
        //print_r($filearray[0][1]);
        //print_r($nguoi_xuly_theo_dv);
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
            <form method="post" name="xacminh" action="luutheodoi" enctype="multipart/form-data" id="theodoiform">
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
                                @if($result['noidung'][0]->songuoi == 1)
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
                                                            <span style="font-weight: bold">Được thêm bởi <span style="color: #3377c7">{{$nguoiTao->fullname}}</span> lúc  <span style="color: #3377c7">{{date("H:i:s d-m-Y",strtotime($vanBan->title))}}</span></span>
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
                        <div class="form-horizontal">
                            <input type="hidden" name="sothuly" id="sothuly" value="{{$result['noidung'][0]->sothuly}}">
                            <input type="hidden" name="donthuid" id="donthuid" value="{{$result['noidung'][0]->donthuid}}">
                            <input type="text" class="form-control" style="display: none" id="accountid" name="accountid" value="{{Session::get('accountid')}}">

                            <div class="form-group form-group-sm">
                                <label for="cvDen" class="control-label col-xs-3">
                                    Tên, số hiệu VB
                                    <span class="text-danger"></span>:
                                </label>
                                <div class="col-xs-3">
                                    <input name="cvDen" type="text" id="cvDen" class="form-control" value="">
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="deXuatDV" class="control-label col-xs-3">Giao xử lý của lãnh đạo ban</label>
                                <div class="col-xs-9">
                                    <textarea name="baocaoDV" rows="5" cols="5" id="baocaoDV" class="form-control">{{$result['theodoi'][0]->dexuatdonvi}}</textarea>
                                </div>
                            </div>


                            <div class="form-group form-group-sm">
                                <label for="yKienCD" class="control-label col-xs-3">Ý kiến CV</label>
                                <div class="col-xs-9">
                                    <textarea name="yKienCD" rows="5" cols="5" id="yKienCD" class="form-control">{{$result['theodoi'][0]->ykienchidao}}</textarea>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="deXuatTW" class="control-label col-xs-3">Ghi chú</label>
                                <div class="col-xs-9">
                                    <textarea name="deXuatTW" rows="5" cols="5" id="deXuatTW" class="form-control">{{$result['theodoi'][0]->dexuatlentrunguong}}</textarea>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-xs-3">Văn bản xử lý</label>
                                <div class="col-xs-9">
                                    <input type="file" name="vanBanXL" id="vanBanXL">
                                </div>

                            </div>

                            <div class="form-group form-group-sm">
                                <label class="control-label col-xs-3">Văn bản bổ sung</label>
                                <div class="col-xs-9">
                                    <input type="file" name="vanBanBS" id="vanBanBS">
                                </div>

                            </div>

                            <div class="form-group form-group-sm" style="margin-top: 10px">
                                <div class="col-xs-9 col-xs-offset-3">
                                    <input type="submit" name="btnluu" value="Lưu" id="btnluu" class="btn btn-sm btn-success" >
                                    <input type="submit" class="btn btn-sm btn-success" value="Lưu và tiếp tục" id="continue" name="btntiep" >
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

                            $('html, body').animate({ scrollTop: $('#scrollToTop3').position().top }, 'slow');

                            function SelectDonVi() {
                                OpenPopup('', 'objID=ctl00_ctl00_ctl02_txtDonVi&hidId=ctl00_ctl00_ctl02_hidDonVi', 375, 370);
                            }

                            $("#theodoiform").validate({
                                rules: {
                                    ngayQD: {required: true, dateFormat: true}
                                },
                                messages: {
                                    ngayQD: {required: "Vui lòng nhập ngày quyết định!" }
                                },
                                success: function (label) {
                                    label.remove();
                                }
                            });

                        </script>
                    </td>
                </tr>

                <tr id="scrollToTop4">
                    <td class="text-bold">Kết quả giải quyết đơn</td>
                    <td>
                        @if($result['ketqua'][0]->tomtatketqua!="")
                            <div>
                                <label>Số công văn:</label>
                                {{$result['ketqua'][0]->soquyetdinh}}
                            </div>
                            <div>
                                <label>Ngày quyết định:</label>
                                @if($result['ketqua'][0]->ngayquyetdinh!="0000-00-00")
                                    {{convertNgay($result['ketqua'][0]->ngayquyetdinh)}}
                                @else
                                    Chưa xác đinh!
                                @endif
                            </div>
                            <div>
                                <label>Nội dung tóm  tắt:</label>
                                {{$result['ketqua'][0]->tieude}}
                            </div>
                            <div>
                                <label>Kết quả giải quyết:</label>
                                <?php
                                echo $result['ketqua'][0]->tomtatketqua;
                                ?>
                            </div>
                            <div>
                                <label>File quyết định giải quyết:</label>
                                @if($result['ketqua'][0]->vanbangiaiquyet!="")
                                    <a href="{{url($result['ketqua'][0]->linkfile."/".$result['ketqua'][0]->vanbangiaiquyet)}}" download="">
                                        <span class="glyphicon glyphicon-download-alt"></span>
                                        {{$result['ketqua'][0]->vanbangiaiquyet}}
                                    </a>
                                @else
                                    Không tìm thấy tập tin đính kèm!
                                @endif
                            </div>
                            <div>
                                <label>Đánh giá đơn:</label>
                                @if($result['ketqua'][0]->danhgiadonthu=="1")
                                    Đúng toàn bộ.
                                @elseif($result['ketqua'][0]->danhgiadonthu=="2")
                                    Đúng một phần.
                                @else
                                    Không đúng.
                                @endif
                            </div>
                            {{--<div class="row">--}}
                                {{--<div class="col-xs-6" style="padding: 0">--}}
                                    {{--<label>Phải thu tiền:</label>--}}
                                    {{--@if($result['ketqua'][0]->thutien)--}}
                                        {{--{{$result['ketqua'][0]->thutien}}--}}
                                    {{--@else--}}
                                        {{--Không thu tiền.--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                                {{--<div class="col-xs-6" style="padding: 0">--}}
                                    {{--<label>Phải trả tiền:</label>--}}
                                    {{--@if($result['ketqua'][0]->tratien)--}}
                                        {{--{{$result['ketqua'][0]->tratien}}--}}
                                    {{--@else--}}
                                        {{--Không trả tiền.--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-xs-6" style="padding: 0">--}}
                                    {{--<label>Phải thu đất:</label>--}}
                                    {{--@if($result['ketqua'][0]->thudat)--}}
                                        {{--{{$result['ketqua'][0]->thudat}}--}}
                                    {{--@else--}}
                                        {{--Không thu đất.--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                                {{--<div class="col-xs-6" style="padding: 0">--}}
                                    {{--<label>Phải trả đất:</label>--}}
                                    {{--@if($result['ketqua'][0]->tradat)--}}
                                        {{--{{$result['ketqua'][0]->tradat}}--}}
                                    {{--@else--}}
                                        {{--Không trả đất.--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        @endif
                        @if($result['noidung'][0]->ketqua==1)

                            <div>
                                <label>Đã kết thúc xử lý đơn</label>
                            </div>
                        @elseif($result['noidung'][0]->ketqua==2)
                            <div class="row">
                                <div class="col-xs-6" style="padding: 0">
                                    <label>Ngày ghi trên đơn rút khiếu nại/tố cáo:</label>
                                    {{convertNgay($result['ketthuc'][0]->ngaytrendon)}}
                                </div>
                                <div class="col-xs-6" style="padding: 0">
                                    <label>Ngày nhận đơn rút khiếu nại/tố cáo:</label>
                                    {{convertNgay($result['ketthuc'][0]->ngaynhan)}}
                                </div>
                            </div>
                            <div>
                                <label>Lý do rút đơn khiếu nại/tố cáo:</label>
                                {{$result['ketthuc'][0]->lydo}}
                            </div>
                            <div>
                                <label>Đề xuất khác của người rút đơn:</label>
                                {{$result['ketthuc'][0]->dexuat}}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-xs-10" style="padding-left: 0">
                                @if($result['ketqua'][0]->tomtatketqua=="")
                                    <label>Chưa giải quyết đơn khiếu tố cáo</label>
                                @endif
                            </div>
                            <div class="col-xs-2 text-right" style="padding-right: 0">

                            </div>
                        </div>

                    </td>
                </tr>

                </tbody>
            </table>
            </form>
        </div>

    </div>

    <script>

        //get value select
        var thuly =<?php echo json_encode($result['noidung'][0]->sothuly);?>;
        var filepath =<?php echo json_encode($result['noidung'][0]->filepath);?>;

        ShowFile(thuly);
        //console.log(filearray);
        //event click button

        //show file
        function ShowFile(d)
        {
            $.ajax({
                type: 'get',
                url: '{{URL::to('getfile')}}',
                data: {
                    sothuly:d
                },
                success: function (result) {

                    for (var i =0; i<result.length;i++)
                    {
                        if (result[i][0]!=null && result[i][0]!="")
                        {
                            var url = "{{url('/file')}}"+"/"+filepath+"/"+result[i][0];
                            $(function(){
                                $('#table_file').append(' <tr id="'+i+'">'+
                                        '<td>'+
                                        '<a href="'+url+'" download>'+
                                        '<span class="glyphicon glyphicon-download-alt"></span>'+
                                        result[i][0]+
                                        '</a>'+
                                        '</td>'+
                                        '<td class="col-xs-1 text-center">'+
                                        '<a onclick="deleteFile(this);" id="'+result[i][2]+'" title="'+i+'" name="'+result[i][1]+'" class="text-danger" style="vertical-align: middle">'+
                                        '<span class="glyphicon glyphicon-trash"></span>'+
                                        '</a>'+
                                        '</td>'+
                                        '</tr>');
                            });
                        }

                    }


                }
            });
        }
        //delete file
         function deleteFile(d)
         {
             $.ajax({
                 type: 'post',
                 url: '{{URL::to('deletefile')}}',
                 data: {
                 sothuly:thuly,
                 tablefile: d.name,
                 position: d.id
                 },
                 success: function (result) {
                    if (result=="successful")
                    {
                        //ShowFile(thuly);
                        var div = document.getElementById(d.title);
                        div.parentNode.removeChild(div);
                    }
                 }
             });


         }

        //date picker
        $( function() {
            //$( "#ngayqd" ).datepicker({format: 'yyyy-mm-dd'});
            $( "#ngaybatdau" ).datepicker({format: 'yyyy-mm-dd'});
            $( "#ngayketthuc" ).datepicker({format: 'yyyy-mm-dd'});
            $( "#ngayQD" ).datepicker({format: 'yyyy-mm-dd'});
        } );

        /* check input time */
        function validateTwoDates() {
            var dateStart = $("#ngaybatdau").val();
            var dateEnd = $("#ngayketthuc").val();
            return(dateEnd >= dateStart);
        }


        function test(){
            if (! validateTwoDates()) {
                alert('Ngày nhận đơn phải lớn hơn ngày viết đơn!');
                document.getElementById("ngayketthuc").value = "";
            }
        }

        /* Check input null*/
        var CHUYEN_DON = 3;

        function CkeckInput() {
            var str = "";

            str += CheckInput('ngayQD', "Vui lòng nhập ngày quyết định xử lý.\r\n");
            str += CheckInput('tomtatQDXL', "Vui lòng nhập tóm tắt quyết định xử lý.\r\n");

            if ($('#huonggiaiquyet').val() == CHUYEN_DON) {
                str += CheckInput('chuyendi', "Vui lòng nhập số công văn chuyển đi.\r\n");
                str += CheckInput('donvichuyendon', "Vui lòng chọn đơn vị chuyển đến.\r\n");
            }

            str += CheckInput('nguoixuly', "Vui lòng chọn người xử lý.\r\n");


            if (str.length > 0) {
                alert(str);
                return false
            }
            return true;
        }

        function ChonDonVi()
        {
            var url ="{{url('/donvitable')}}" ;
            OpenPopupGetData(url,400,380);
        }

        //click button
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
        //
        function Display(d)
        {
            if (d.value=="3")
            {
                document.getElementById("pnlDVChuyenDon").style='margin-top: 5px;';
            }
            else
            {
                document.getElementById("pnlDVChuyenDon").style.display = 'none';
            }
        }
    </script>

@endsection
