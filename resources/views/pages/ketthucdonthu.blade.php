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
   //print_r($data1);
    //print_r($data);
    ?>
    <div id="donthu" class="col-background" style="margin-bottom: 100px;">
        <div class="panel panel-default">
            <div class="panel-heading text-center">CHI TIẾT ĐƠN</div>
            <form method="post" action="luuketthuc" enctype="multipart/form-data">
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
                                <?php
                                //echo $result['noidung'][0]->sothuly;
                                ?>
                                {{$result['noidung'][0]->sothuly}}
                            </div>
                            <div class="col-xs-5" style="padding: 0">
                                <label>Đơn do:</label>
                                <?php
                                if($result['noidung'][0]->nguondon == "dodan")
                                {
                                echo "Cá nhân chuyển đến";
                                }
                                else
                                {
                                echo "Do đơn vị chuyển đến";
                                }
                                // echo $result['noidung'][0]->nguondon;
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7" style="padding: 0">
                                <label>
                                    Người viết đơn:
                                </label>
                                <?php
                                // echo $result['noidung'][0]->tennguoivietdon;
                                ?>
                                {{$result['noidung'][0]->tennguoivietdon}}
                            </div>
                            <div class="col-xs-5" style="padding: 0">
                                <label>Địa chỉ:</label>
                                <?php
                                echo $result['noidung'][0]->diachinguoiviet;
                                ?>
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
                                    {{$result['noidung'][0]->ngaycap}}
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
                                    Lần khiếu nại:
                                </label>
                                {{$result['noidung'][0]->lankhieunai}}
                            </div>
                            <div class="col-xs-5" style="padding: 0">
                                <label>
                                    Theo dạng:
                                </label>
                                <?php
                                if($result['noidung'][0]->songuoi == 1)
                                {
                                echo "Cá nhân";
                                }
                                else
                                {
                                echo "Nhiều người";
                                }

                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7" style="padding: 0">
                                <label>
                                    Đối tượng khiếu nại/tố cáo:
                                </label>
                                <?php
                                if($result['noidung'][0]->doituongkhieunai != 0)
                                {
                                echo $tendoituongkhieunai[0]->tendoituong;
                                }
                                else
                                {
                                echo "Chưa xác định";
                                }

                                ?>
                            </div>
                            <div class="col-xs-5" style="padding: 0">
                                <label>
                                    Thẩm quyền:
                                </label>
                                @if($result['noidung'][0]->tochucgiaiquyet!=0)
                                    @for($i = 0;$i<count($quyenXL);$i++)
                                        @if($result['noidung'][0]->tochucgiaiquyet == $quyenXL[$i]->id)
                                            {{$quyenXL[$i]->tenthamquyen}}
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
                                <?php
                                $vanban = explode('/',$result['noidung'][0]->vanban);
                                ?>
                                @for($i=0;$i<count($vanban);$i++)
                                    @if($vanban[$i]!="" && $result['noidung'][0]->vanbanuyquyen!="")
                                        <a href="{{url($result['noidung'][0]->filepath."/".$vanban[$i])}}" download>
                                            <span class="glyphicon glyphicon-download-alt"></span>
                                            {{$vanban[$i]}}
                                        </a>
                                        <a href="{{url($result['noidung'][0]->filepath."/".$result['noidung'][0]->vanbanuyquyen)}}" download>
                                            <span class="glyphicon glyphicon-download-alt"></span>
                                            {{$result['noidung'][0]->vanbanuyquyen}}
                                        </a>
                                    @elseif($vanban[$i]=="" && $result['noidung'][0]->vanbanuyquyen!="")
                                        <a href="{{url($result['noidung'][0]->filepath."/".$result['noidung'][0]->vanbanuyquyen)}}" download>
                                            <span class="glyphicon glyphicon-download-alt"></span>
                                            {{$result['noidung'][0]->vanbanuyquyen}}
                                        </a>
                                    @elseif($vanban[$i]!="" && $result['noidung'][0]->vanbanuyquyen=="")
                                        <a href="{{url($result['noidung'][0]->filepath."/".$vanban[$i])}}" download="">
                                            <span class="glyphicon glyphicon-download-alt"></span>
                                            {{$vanban[$i]}}
                                        </a>
                                    @else
                                        Không có file đính kèm
                                    @endif
                                @endfor

                            </div>
                        </div>
                        <div class="row">
                        </div>

                    </td>
                </tr>

                <tr id="scrollToTop2">
                    <td class="text-bold">Phân loại, xử lý đơn</td>
                    <td>
                        @if($result['phanloai'][0]->trangthai == 1)
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
                                    <label>Hướng giải quyết:</label>
                                    @if($result['phanloai'][0]->huonggiaiquyet=="1")
                                        Thụ Lý
                                    @elseif($result['phanloai'][0]->huonggiaiquyet=="2")
                                        Trả đơn
                                    @elseif($result['phanloai'][0]->huonggiaiquyet=="3")
                                        Chuyển đơn
                                    @else
                                        Chưa xác định
                                    @endif
                                </div>
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
                                    <label>Nội dung đề xuất:</label>
                                    @if($result['phanloai'][0]->dexuat!=null)
                                        {{$result['phanloai'][0]->dexuat}}
                                    @else
                                        Chưa xác định
                                    @endif
                                </div>
                            </div>

                        @endif

                        <div class="row">
                            @if($result['noidung'][0]->ketqua==0)
                                <div class="col-xs-10" style="padding-left: 0">
                                    @if($result['phanloai'][0]->trangthai == 0)
                                        <label>Chưa phân loại, xử lý đơn</label>
                                    @endif
                                </div>
                            @endif
                        </div>

                    </td>
                </tr>

                <tr id="scrollToTop3">
                    <td class="text-bold">Theo dõi, xử lý đơn</td>
                    <td>
                        @if($result['xacminh'][0]->trangthaitheodoi == 1)
                            <div>
                                <label>Ngày quyết định xử lý:</label>
                                @if($result['theodoi'][0]->ngayquyetdinhxuly != '0000-00-00')
                                    {{$result['theodoi'][0]->ngayquyetdinhxuly}}
                                @else
                                    Chưa xác định
                                @endif
                            </div>
                            <div>
                                <label>Ngày báo cáo kết quả xác minh:</label>
                                @if($result['xacminh'][0]->ngayketthucxacminh!="0000-00-00")
                                    {{$result['xacminh'][0]->ngayketthucxacminh}}
                                @else
                                    Chưa xác định
                                @endif
                            </div>
                            <div>
                                <label>Nội dung chỉ đạo giải quyết của lãnh đạo:</label>
                                {{$result['theodoi'][0]->tomtatxuly}}
                            </div>
                            <div>
                                <label>Danh sách văn bản liên quan:</label>
                                @if($result['theodoi'][0]->filephieutrinh=="" && $result['theodoi'][0]->thongbaogiaiquyet=="" && $result['theodoi'][0]->filecoquankhac=="" && $result['xacminh'][0]->fileketquaxacminh=="")
                                    Không có tài liệu
                                @endif
                                @if($result['theodoi'][0]->filephieutrinh!="")
                                    <a href="{{url($result['theodoi'][0]->linkfile."/".$result['theodoi'][0]->filephieutrinh)}}" download="">
                                        <span class="glyphicon glyphicon-download-alt"></span>
                                        {{$result['theodoi'][0]->filephieutrinh}}
                                    </a>
                                @endif
                                @if($result['theodoi'][0]->thongbaogiaiquyet!="")
                                    <a href="{{url($result['theodoi'][0]->linkfile."/".$result['theodoi'][0]->thongbaogiaiquyet)}}" download="">
                                        <span class="glyphicon glyphicon-download-alt"></span>
                                        {{$result['theodoi'][0]->thongbaogiaiquyet}}
                                    </a>
                                @endif
                                @if($result['theodoi'][0]->filecoquankhac!="")
                                    <a href="{{url($result['theodoi'][0]->linkfile."/".$result['theodoi'][0]->filecoquankhac)}}" download="">
                                        <span class="glyphicon glyphicon-download-alt"></span>
                                        {{$result['theodoi'][0]->filecoquankhac}}
                                    </a>
                                @endif
                                @if($result['xacminh'][0]->filexacminh!="")
                                    <a href="{{url($result['xacminh'][0]->linkfile."/".$result['xacminh'][0]->filexacminh)}}" download="">
                                        <span class="glyphicon glyphicon-download-alt"></span>
                                        {{$result['xacminh'][0]->filexacminh}}
                                    </a>
                                @endif
                            </div>
                        @endif
                        <div class="row">
                            @if($result['noidung'][0]->ketqua==0)
                                <div class="col-xs-10" style="padding-left: 0">
                                    @if($result['xacminh'][0]->trangthaitheodoi == 0)
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
                        @if($result['ketqua'][0]->trangthai != 0)
                            <div>
                                <label>Số công văn:</label>
                                {{$result['ketqua'][0]->soquyetdinh}}
                            </div>
                            <div>
                                <label>Ngày quyết định:</label>
                                @if($result['ketqua'][0]->ngayquyetdinh!="0000-00-00")
                                    {{$result['ketqua'][0]->ngayquyetdinh}}
                                @else
                                    Chưa xác đinh
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
                                    Không tìm thấy tập tin đính kèm
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
                            <div class="row">
                                <div class="col-xs-6" style="padding: 0">
                                    <label>Phải thu tiền:</label>
                                    @if($result['ketqua'][0]->thutien != 0)
                                        {{$result['ketqua'][0]->thutien}}
                                    @else
                                        Không thu tiền.
                                    @endif
                                </div>
                                <div class="col-xs-6" style="padding: 0">
                                    <label>Phải trả tiền:</label>
                                    @if($result['ketqua'][0]->tratien != 0)
                                        {{$result['ketqua'][0]->tratien}}
                                    @else
                                        Không trả tiền.
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6" style="padding: 0">
                                    <label>Phải thu đất:</label>
                                    @if($result['ketqua'][0]->thudat != 0)
                                        {{$result['ketqua'][0]->thudat}}
                                    @else
                                        Không thu đất.
                                    @endif
                                </div>
                                <div class="col-xs-6" style="padding: 0">
                                    <label>Phải trả đất:</label>
                                    @if($result['ketqua'][0]->tradat != 0)
                                        {{$result['ketqua'][0]->tradat}}
                                    @else
                                        Không trả đất.
                                    @endif
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            @if($result['noidung'][0]->ketqua==0)
                                <div class="col-xs-10" style="padding-left: 0">
                                    @if($result['ketqua'][0]->trangthai == 0)
                                        <label>Chưa giải quyết đơn khiếu tố cáo</label>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </td>
                </tr>

                <tr id="scrollToTop5">
                    <td class="text-bold">Kết thúc hoặc rút đơn</td>
                    <td>

                        <div class="form-horizontal">
                            <input type="hidden" name="sothuly" id="sothuly" value="{{$result['noidung'][0]->sothuly}}">
                            <input type="hidden" name="donthuid" id="donthuid" value="{{$result['noidung'][0]->donthuid}}">

                            <div class="form-group form-group-sm">
                                <label for="ketthucdonthu" class="control-label col-xs-3">
                                    Kết thúc xử lý đơn <span class="text-danger">(*)</span>
                                </label>
                                <div class="col-xs-9">
                                    <select name="ketthucdonthu" id="ketthucdonthu" class="form-control" onchange="ShowSelectd(this);">

                                        @if($result['noidung'][0]->ketqua == RUTDONTHU)
                                            <option value="kt">Kết thúc xử lý đơn</option>
                                            <option value="rd" selected>Rút đơn</option>
                                        @else
                                            <option value="kt" selected>Kết thúc xử lý đơn</option>
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
                                                    <span class="text-danger">(*)</span>
                                                </label>
                                                <div class="col-xs-9">
                                                    @if($result['ketthuc'][0]->ngaynhan != '0000-00-00')
                                                    <input name="ngaynhan" type="text" id="ngaynhan" class="form-control" style="width:100px;" value="{{$result['ketthuc'][0]->ngaynhan}}">
                                                    @else
                                                    <input name="ngaynhan" type="text" id="ngaynhan" class="form-control" style="width:100px;">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label for="ngaytrendon" class="control-label col-xs-3">
                                                    Ngày ghi trên đơn
                                                    <span class="text-danger">(*)</span>
                                                </label>
                                                <div class="col-xs-9">
                                                    @if($result['ketthuc'][0]->ngaytrendon != '0000-00-00')
                                                    <input name="ngaytrendon" type="text" id="ngaytrendon" class="form-control" style="width:100px;" value="{{$result['ketthuc'][0]->ngaytrendon}}">
                                                    @else
                                                    <input name="ngaytrendon" type="text" id="ngaytrendon" class="form-control" style="width:100px;">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label for="lydorutdon" class="control-label col-xs-3">
                                                    Lý do rút đơn
                                                    <span class="text-danger">(*)</span>
                                                </label>
                                                <div class="col-xs-9">
                                                    <textarea name="lydorutdon" rows="5" cols="20" id="lydorutdon" class="form-control">{{$result['ketthuc'][0]->lydo}}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label for="dexuat" class="control-label col-xs-3">Đề xuất khác</label>
                                                <div class="col-xs-9">
                                                    <textarea name="dexuat" rows="5" cols="20" id="dexuat" class="form-control">{{$result['ketthuc'][0]->dexuat}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-group-sm">
                                <div class="col-xs-9 col-xs-offset-3">
                                    <input type="submit" name="btnluu" value="Lưu" id="btnluu" class="btn btn-sm btn-success">
                                    <input type="reset" value="Nhập lại" class="btn btn-sm btn-warning">
                                    <input type="button" value="Hủy" id="{{$sothuly}}" onclick="backtochitietdonthu(this.id)" class="btn btn-sm btn-danger">
                                </div>
                            </div>
                        </div>

                        <script type="text/javascript">

                            function backtochitietdonthu(sothuly){
                                var chitietdonthuurl = <?php echo json_encode(url('/chitietdonthu')); ?>;
                                window.location.href = chitietdonthuurl+'/'+sothuly;
                            }

                            $('html, body').animate({ scrollTop: $('#scrollToTop5').position().top }, 'slow');

                            $("#ctl00_ctl00_ctl04_cboKetThuDonThu").change(function () {
                                if ($("#ctl00_ctl00_ctl04_cboKetThuDonThu").val() == '0')
                                    $("#pnlRutDonThu").show();
                                else
                                    $("#pnlRutDonThu").hide();
                            });

                            $("#aspnetForm").validate({
                                rules: {
                                    ctl00$ctl00$ctl04$txtNgayNhanDon: { requiredFromObjId: { objId: 'ctl00_ctl00_ctl04_cboKetThuDonThu', data: '0' }, dateFormat: true },
                                    ctl00$ctl00$ctl04$txtNgayGhiTrenDon: { requiredFromObjId: { objId: 'ctl00_ctl00_ctl04_cboKetThuDonThu', data: '0' }, dateFormat: true },
                                    ctl00$ctl00$ctl04$txtLyDoRutDon: { requiredFromObjId: { objId: 'ctl00_ctl00_ctl04_cboKetThuDonThu', data: '0' } }
                                },
                                messages: {
                                    ctl00$ctl00$ctl04$txtNgayNhanDon: { requiredFromObjId: "Vui lòng nhập ngày nhận đơn!"},
                                    ctl00$ctl00$ctl04$txtNgayGhiTrenDon: { requiredFromObjId: "Vui lòng nhập ngày ghi trên đơn!"},
                                    ctl00$ctl00$ctl04$txtLyDoRutDon: { requiredFromObjId: "Vui lòng nhập lý do rút đơn!" }
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

        //get value select
        function ShowSelectd(d)
        {
            if (d.value == "rd")
            {
                document.getElementById("pnlRutDonThu").style='margin-top: 5px';
            }
            else
            {
                document.getElementById("pnlRutDonThu").style.display='none';
            }
        }


        //date picker
        $( function() {
            $( "#ngaynhan" ).datepicker({format: 'yyyy-mm-dd'});
            $( "#ngaytrendon" ).datepicker({format: 'yyyy-mm-dd'});
        } );

        //chon don thu


        /* check input time */


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
                str += CheckInput('vbuyquyen', "Vui lòng chọn văn bản ủy quyền.\r\n");
            }

            if ($('#lan').val() == "Lần 2") {
                str += CheckInput('donlan01', "Vui lòng chọn đơn lần 1.\r\n");
            }

            if (str.length > 0) {
                alert(str);
                return false
            }
            return true;
        }

        //
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
