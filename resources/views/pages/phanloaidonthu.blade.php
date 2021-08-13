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
    date_default_timezone_set('Asia/Ho_Chi_Minh');
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
            <form method="post" name="xacminh" action="luuphanloai" enctype="multipart/form-data" id="aspnetForm">
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
                    <td class="text-bold">Phân loại, xử lý đơn</td>
                    <td>
                        <input type="text" class="form-control" style="display: none" id="sothuly" name="sothuly" value="{{$result['noidung'][0]->sothuly}}">
                        <input type="text" class="form-control" style="display: none" id="donthuid" name="donthuid" value="{{$result['noidung'][0]->donthuid}}">
                        <input type="text" class="form-control" style="display: none" id="accountid" name="accountid" value="{{Session::get('accountid')}}">
                        <div class="form-horizontal">

                            <div class="form-group form-group-sm">
                                <label for="loaidon" class="control-label col-xs-3">Loại đơn<span class="text-danger">(*)</span></label>
                                <div class="col-xs-9">
                                    <select name="loaidon" id="loaidon" class="form-control">
                                        <option value="0">---------- Chọn loại đơn ----------</option>
                                        @foreach($loaidon as $loaidonitem)
                                            @if($result['phanloai'][0]->loaidon == $loaidonitem->loaidonid)
                                                <option value="{{$loaidonitem->loaidonid}}" selected>{{$loaidonitem->tenloaidon}}</option>
                                            @else
                                                <option value="{{$loaidonitem->loaidonid}}">{{$loaidonitem->tenloaidon}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="linhvuc" class="control-label col-xs-3">Lĩnh vực<span class="text-danger">(*)</span></label>
                                <div class="col-xs-9">
                                    <select name="linhvuc" id="linhvuc" class="form-control">
                                        <option value="0">---------- Chọn lĩnh vực ----------</option>
                                        @foreach($linhvuc as $linhvucitem)
                                            @if($result['phanloai'][0]->linhvuc == $linhvucitem->linhvucid)
                                                <option value="{{$linhvucitem->linhvucid}}" selected>{{$linhvucitem->tenlinhvuc}}</option>
                                            @else
                                                <option value="{{$linhvucitem->linhvucid}}">{{$linhvucitem->tenlinhvuc}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="diabandisplay" class="control-label col-xs-3">Địa bàn</label>
                                <div class="col-xs-9">
                                    <select name="diaban" id="diaban" class="form-control">
                                        @foreach($diaban as $diaBanItem)
                                            @if($diaBanItem->id != 1)
                                                @if($result['phanloai'][0]->diaban == $diaBanItem->id)
                                                    <option value="{{$diaBanItem->id}}" selected>{{$diaBanItem->tendiaban}}</option>
                                                @else
                                                    <option value="{{$diaBanItem->id}}" >{{$diaBanItem->tendiaban}}</option>
                                                @endif
                                            @else
                                                <option value=""></option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="huonggiaiquyet" class="control-label col-xs-3">Hướng giải quyết</label>
                                <div class="col-xs-9">
                                    <select name="huonggiaiquyet" id="huonggiaiquyet" class="form-control" onchange="Display(this);">
                                    @if($result['phanloai'][0]->huonggiaiquyet=="2")
                                        <option value="1">Thụ lý</option>
                                        <option value="2" selected>Trả đơn</option>
                                        <option value="3">Chuyển đơn</option>
                                    @elseif($result['phanloai'][0]->huonggiaiquyet=="3")
                                        <option value="1">Thụ lý</option>
                                        <option value="2">Trả đơn</option>
                                        <option value="3" selected>Chuyển đơn</option>
                                    @else
                                        <option value="1" selected>Thụ lý</option>
                                        <option value="2">Trả đơn</option>
                                        <option value="3">Chuyển đơn</option>
                                    @endif
                                    </select>

                                    @if($result['phanloai'][0]->huonggiaiquyet=="3")
                                    <div class="panel panel-default" id="pnlDVChuyenDon" style="margin-top: 5px">
                                    @else
                                    <div class="panel panel-default" id="pnlDVChuyenDon" style="margin-top: 5px; display: none">
                                    @endif
                                        <div class="panel-heading">Đơn vị nhận đơn</div>
                                        <div class="panel-body">
                                            <div class="form-group form-group-sm">
                                                <label for="chuyendi" class="control-label col-xs-5">
                                                    Số công văn chuyển đi
                                                    <span class="text-danger">(*)</span>:
                                                </label>
                                                <div class="col-xs-7">
                                                    <input name="chuyendi" type="text" id="chuyendi" class="form-control" value="{{$result['phanloai'][0]->socongvanchuyendi}}">
                                                </div>
                                            </div>

                                            <div class="form-group form-group-sm">
                                                <label for="donvichuyendon" class="control-label col-xs-5">
                                                    Đơn vị chuyển đến
                                                    <span class="text-danger">(*)</span>:
                                                </label>
                                                <div class="col-xs-7">
                                                    <select name="donvichuyendon" id="donvichuyendon" class="form-control">
                                                        <option value="0">---------- Chọn đơn vị ----------</option>
                                                        @foreach($donvi as $donviitem)
                                                            @if($donviitem->id>1)
                                                                @if($result['phanloai'][0]->donvichuyenden == $donviitem->id)
                                                                <option value="{{$donviitem->id}}" selected>{{$donviitem->tendonvi}}</option>
                                                                @else
                                                                <option value="{{$donviitem->id}}" >{{$donviitem->tendonvi}}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group form-group-sm">
                                                <label class="control-label col-xs-5">File scan phiếu hướng dẫn:</label>
                                                <div class="col-xs-7">
                                                    <input type="file" name="scanphieuhd" id="scanphieuhd" style="width:311px;">
                                                </div>

                                                @if($result['phanloai'][0]->filehuongdan != null)
                                                    <div id="hienthifilehuongdan" class="col-xs-7" style="margin-top: 10px">
                                                        <a href="{{url($result['phanloai'][0]->linkfile.'/'.$result['phanloai'][0]->filehuongdan)}}" title='Tải về' download>
                                                            <img src="{{url('/img/file.png')}}" style="height:25px;width:20px"/>&nbsp;{{$result['phanloai'][0]->filehuongdan}}
                                                        </a>
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="control-label col-xs-5">File scan công văn chuyển đơn:</label>
                                                <div class="col-xs-7">
                                                    <input type="file" name="cvchuyendon" id="cvchuyendon" style="width:311px;">
                                                </div>
                                                @if($result['phanloai'][0]->congvanchuyendon != null)
                                                    <div id="hienthifilecongvanchuyendon" class="col-xs-7" style="margin-top: 10px">
                                                        <a href="{{url($result['phanloai'][0]->linkfile.'/'.$result['phanloai'][0]->congvanchuyendon)}}" title='Tải về' download>
                                                            <img src="{{url('/img/file.png')}}" style="height:25px;width:20px"/>&nbsp;{{$result['phanloai'][0]->congvanchuyendon}}
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="control-label col-xs-5">File văn bản thông báo chuyển đơn:</label>
                                                <div class="col-xs-7">
                                                    <input type="file" name="tbchuyendon" id="tbchuyendon" style="width:311px;">
                                                </div>
                                                @if($result['phanloai'][0]->tbchuyendon != null)
                                                    <div id="hienthifiletbchuyendon" class="col-xs-7" style="margin-top: 10px">
                                                        <a href="{{url($result['phanloai'][0]->linkfile.'/'.$result['phanloai'][0]->tbchuyendon)}}" title='Tải về' download>
                                                            <img src="{{url('/img/file.png')}}" style="height:25px;width:20px"/>&nbsp;{{$result['phanloai'][0]->tbchuyendon}}
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="control-label col-xs-5">File văn bản yêu cầu cấp dưới xử lý:</label>
                                                <div class="col-xs-7">
                                                    <input type="file" name="yeucauxl" id="yeucauxl" style="width:311px;">
                                                </div>
                                                @if($result['phanloai'][0]->vbyeucauxuly != null)
                                                    <div id="hienthifiletbchuyendon" class="col-xs-7" style="margin-top: 10px">
                                                        <a href="{{url($result['phanloai'][0]->linkfile.'/'.$result['phanloai'][0]->vbyeucauxuly)}}" title='Tải về' download>
                                                            <img src="{{url('/img/file.png')}}" style="height:25px;width:20px"/>&nbsp;{{$result['phanloai'][0]->vbyeucauxuly}}
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label for="dexuatphieutrinh" class="control-label col-xs-3">Đề xuất trong phiếu trình</label>
                                <div class="col-xs-9">
                                    <textarea name="dexuatphieutrinh" rows="5" cols="10" id="dexuatphieutrinh" class="form-control">{{$result['phanloai'][0]->dexuat}}</textarea>
                                </div>
                            </div>


                            <div class="form-group form-group-sm">
                                <div class="col-xs-9 col-xs-offset-3">
                                    <input type="submit" name="luu" value="Lưu" id="luu" class="btn btn-sm btn-success" onchange="">
                                    <input type="submit" class="btn btn-sm btn-success" value="Lưu và tiếp tục" id="continue" name="continue" >
                                    <input type="reset" value="Nhập lại" class="btn btn-sm btn-warning">
                                    <input type="button" value="Hủy" id="{{$result['noidung'][0]->sothuly}}" onclick="backtochitietdonthu(this.id)" class="btn btn-sm btn-danger">
                                </div>
                            </div>
                        </div>

                        <script type="text/javascript">
                            function backtochitietdonthu(sothuly){
                                var chitietdonthuurl = <?php echo json_encode(url('/chitietdonthu')); ?>;
                                window.location.href = chitietdonthuurl+'/'+sothuly;
                            }

                            $('html, body').animate({ scrollTop: $('#scrollToTop2').position().top }, 'slow');
                            $(function () {
                                $("#btnInPhieu").click(function () { $("#pnlInPhieu").slideToggle(350); });

                                $('#ctl00_ctl00_ctl01_cboHuongGiaiQuyet').change(function () {
                                    if ($('#ctl00_ctl00_ctl01_cboHuongGiaiQuyet').val() == "3")
                                        $('#pnlDVChuyenDon').show();
                                    else
                                        $('#pnlDVChuyenDon').hide();
                                })
                            })

                            $("#aspnetForm").validate({
                                rules: {
                                    loaidon: {required: true },
                                    linhvuc: {required: true },
                                    nguoixuly: {required: true },
                                    ctl00$ctl00$ctl01$txtSoCVChuyenDi: { requiredFromObjId: { objId: 'ctl00_ctl00_ctl01_cboHuongGiaiQuyet', data: '3' } },
                                    ctl00$ctl00$ctl01$cboDonViChuyenDon: { requiredFromObjId: { objId: 'ctl00_ctl00_ctl01_cboHuongGiaiQuyet', data: '3' } }
                                },
                                messages: {
                                    loaidon: {required: "Vui lòng chọn loại đơn!"},
                                    linhvuc: {required: "Vui lòng chọn lĩnh vực!" },
                                    nguoixuly: {required: "Vui lòng chọn người xử lý!" },
                                    ctl00$ctl00$ctl01$txtSoCVChuyenDi: { requiredFromObjId: "Vui lòng nhập số công văn chuyển đơn!" },
                                    ctl00$ctl00$ctl01$cboDonViChuyenDon: { requiredFromObjId: "Vui lòng chọn đơn vị chuyển đơn!" }
                                },
                                success: function (label) {
                                    label.remove();
                                }
                            });

                            function KiemTraNhapDuLieuStep2() {
                                var str = "";
                                var kq = true;
                                if ($('#ctl00_ctl00_ctl01_cboHuongGiaiQuyet').val() == '3') {
                                    if ($('#ctl00_ctl00_ctl01_txtSoCVChuyenDi').val().length <= 0) { str += "Vui lòng nhập số công văn chuyển đi.\r\n"; kq = false; }
                                    if ($('#ctl00_ctl00_ctl01_cboDonViChuyenDon').val().length <= 0) { str += "Vui lòng chọn đơn vị chuyển đơn.\r\n"; kq = false; }
                                }
                                if (str.length > 0) alert(str);
                                return kq;
                            }
                        </script>
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
                                                        <span style="font-weight: bold">Được thêm bởi <span style="color: #3377c7">{{$nguoiTao->fullname}}</span> lúc <span style="color: #3377c7">{{date("H:i:s d-m-Y",strtotime($vanBan->title))}}</span></span>
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

                        @endif
                        @if($result['noidung'][0]->ketqua== KETTHUCDONTHU)

                            <div>
                                <label>Đã kết thúc xử lý đơn</label>
                            </div>
                        @elseif($result['noidung'][0]->ketqua== RUTDONTHU)
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
                            @if($result['phanloai'][0]->loaidon == 1)
                                <div>
                                    <label>Quyết định đình chỉ giải quyết khiếu nại:</label>
                                    {{$result['ketthuc'][0]->dinhchigiaiquyetkhieunai}}
                                </div>
                            @endif

                            @if($result['phanloai'][0]->loaidon == 2)
                                <div>
                                    <label>Thông báo chấm dứt tố cáo:</label>
                                    {{$result['ketthuc'][0]->thongbaochamduttocao}}
                                </div>
                            @endif
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
        /*hien thi don vi nhan don*/
        function Display(d)
        {
            if (d.value=="3")
            {
               document.getElementById("pnlDVChuyenDon").style='margin-top: 5px;';
            }
        }

        function ChonDiaBan()
        {
            var url ="{{url('/diabantable')}}" ;
            OpenPopupGetData(url,400,380);
        }

        /* Check input null*/
        function CkeckInput() {
            var str = "";
            str += CheckInput('loaidon', "Vui lòng nhập số thụ lý.\r\n");
            str += CheckInput('ngayviet', "Vui lòng nhập ngày viết đơn.\r\n");
            str += CheckInput('ngaynhan', "Vui lòng nhập ngày nhận đơn.\r\n");
            str += CheckInput('tennguoiviet', "Vui lòng nhập tên người gửi.\r\n");
            str += CheckInput('diachi', "Vui lòng nhập địa chỉ người gửi.\r\n");
            str += CheckInput('noidungdon', "Vui lòng nhập nội dung đơn.\r\n");

            if ($('#loaidon').val() == "") {
                str =  "Vui lòng nhập số công văn đến.\r\n";
            }
//            if ($('#group').val() == "1") {
//                str += CheckInput('tenkntc', "Vui lòng nhập họ tên người khiếu nại/tố cáo.\r\n");
//                str += CheckInput('diachikntc', "Vui lòng nhập địa chỉ người khiếu nại/tố cáo.\r\n");
//                //str += CheckInput('daidien', "Vui lòng chọn người đại diện.\r\n");
//                str += CheckInput('vbuyquyen', "Vui lòng chọn văn bản ủy quyền.\r\n");
//            }
//
//            if ($('#lan').val() == "Lần 2") {
//                str += CheckInput('donlan01', "Vui lòng chọn đơn thư lần 1.\r\n");
//            }

            if (str.length > 0) {
                alert(str);
                return false
            }
            return true;
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
    </script>

@endsection
