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
    ?>
    <div id="donthu" class="col-background" style="margin-bottom: 100px;">
        <div class="panel panel-default">
            <div class="panel-heading text-center">CHI TIẾT ĐƠN</div>
            <form method="post" action="" enctype="multipart/form-data">
            <div class="panel-body row" style="padding: 10px 0">
                <div class="col-xs-6">
                    <button type="button" name="back" value="" onclick="ClickBTN(this);" id="back" title="Trở lại" class="btn btn-sm btn-danger">
                        <span class="glyphicon glyphicon-arrow-left"></span>
                        Trở lại
                    </button>
                </div>
                <div class="col-xs-6 text-right">
                    <button class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-print"></span>
                        In phiếu <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="" onclick=""><span class="caret-left"></span> Phiếu đề xuất xử lý đơn</a></li>
                        <li><a href="" onclick=""><span class="caret-left"></span> Phiếu hướng dẫn chuyển đơn</a></li>
                        <li><a href="" onclick=""><span class="caret-left"></span> Phiếu trả đơn</a></li>
                        <li><a href="" onclick=""><span class="caret-left"></span> Thông báo thụ lý đơn cho cá nhân</a></li>
                        <li><a href="" onclick=""><span class="caret-left"></span> Thông báo thụ lý đơn - do cơ quan khác chuyển đến</a></li>
                        <li><a href="" onclick=""><span class="caret-left"></span> Thông báo không thụ lý đơn - do cơ quan khác chuyển đến</a></li>
                        <li><a href="" onclick=""><span class="caret-left"></span> Quyết định giải quyết đơn lần 1</a></li>
                        <li><a href="" onclick=""><span class="caret-left"></span> Quyết định giải quyết đơn lần 2</a></li>
                        <li><a href="" onclick=""><span class="caret-left"></span> Phiếu chuyển đơn tố cáo</a></li>
                    </ul>
                </div>
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
                                @if($result['noidung'][0]->nguondon=="dodan")
                                    Cá nhân chuyển đến
                                @else
                                    Do đơn vị chuyển đến
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7" style="padding: 0">
                                <label>
                                    Người viết đơn:
                                </label>
                                {{$result['noidung'][0]->tennguoivietdon}}
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
                                    Chưa xác định!
                                @endif
                            </div>
                            <div class="col-xs-3" style="padding: 0">
                                <label>
                                    Ngày cấp:
                                </label>
                                @if($result['noidung'][0]->ngaycap!="0000-00-00")
                                    {{$result['noidung'][0]->ngaycap}}
                                @else
                                    Chưa xac định!
                                @endif
                            </div>
                            <div class="col-xs-5" style="padding: 0">
                                <label>
                                    Nơi cấp:
                                </label>
                                @if($result['noidung'][0]->noicap!=null)
                                    {{$result['noidung'][0]->noicap}}
                                @else
                                    Chưa xác định!
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
                                @if($result['noidung'][0]->songuoi=="0")
                                    Cá nhân
                                @else
                                    Nhiều người
                                @endif

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7" style="padding: 0">
                                <label>
                                    Đối tượng khiếu nại/tố cáo:
                                </label>
                                @if($result['noidung'][0]->doituongkhieunai!=null)
                                    {{$result['noidung'][0]->doituongkhieunai}}
                                @else
                                    chưa xác định
                                @endif

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
                                    Chưa xác định!
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="padding: 0">
                                <label>
                                    Nội dung đơn:
                                </label>
                                {{$result['noidung'][0]->noidung}}
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
                                        Không có file đính kèm!
                                    @endif
                                @endfor

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-right" style="padding: 0">

                            </div>
                        </div>


                    </td>
                </tr>

                <tr id="scrollToTop2">
                    <td class="text-bold">Phân loại, xử lý đơn</td>
                    <td>



                        @if($result['phanloai'][0]->loaidon!=null)
                            <div class="row">
                                <div class="col-xs-7" style="padding: 0">
                                    <label>Loại đơn:</label>
                                    @for($i = 0;$i<count($loaidon);$i++)
                                        @if($result['phanloai'][0]->loaidon == $loaidon[$i]->loaidonid)
                                            {{$loaidon[$i]->tenloaidon}}
                                        @endif
                                    @endfor
                                </div>
                                <div class="col-xs-5" style="padding: 0">
                                    <label>Lĩnh vực:</label>
                                    @for($i = 0;$i<count($linhvuc);$i++)
                                        @if($result['phanloai'][0]->linhvuc == $linhvuc[$i]->linhvucid)
                                            {{$linhvuc[$i]->tenlinhvuc}}
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-7" style="padding: 0">
                                    <label>Tại địa bàn:</label>
                                    {{$result['phanloai'][0]->diaban}}
                                    @for($i = 0;$i<count($diaban);$i++)
                                        @if($result['phanloai'][0]->diaban == $diaban[$i]->id)
                                            {{$diaban[$i]->tendiaban}}
                                        @endif
                                    @endfor
                                </div>
                                <div class="col-xs-5" style="padding: 0">
                                    <label>Hướng giải quyết:</label>
                                    @if($result['phanloai'][0]->huonggiaiquyet!=null)
                                        {{$result['phanloai'][0]->huonggiaiquyet}}
                                    @else
                                        Chưa xác định!
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12" style="padding: 0">
                                    <label>Người xử lý:</label>
                                    @if($result['phanloai'][0]->nguoixuly!=null)
                                        {{$result['phanloai'][0]->nguoixuly}}
                                    @else
                                        Chưa xác định!
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12" style="padding: 0">
                                    <label>Nội dung đề xuất:</label>
                                    @if($result['phanloai'][0]->dexuat!=null)
                                        {{$result['phanloai'][0]->dexuat}}
                                    @else
                                        Chưa xác định!
                                    @endif
                                </div>
                            </div>
                        @endif


                        <div class="row">
                            <div class="col-xs-10" style="padding-left: 0">

                            </div>
                            <div class="col-xs-2 text-right" style="padding-right: 0">

                            </div>
                        </div>

                    </td>
                </tr>

                <tr id="scrollToTop3">
                    <td class="text-bold">Theo dõi, xử lý đơn</td>
                    <td>
                        @if($result['xacminh'][0]->noidung!="")
                            <div>
                                <label>Ngày quyết định xử lý:</label>
                                {{$result['xacminh'][0]->ngayketthuc}}
                            </div>
                            <div>
                                <label>Ngày báo cáo kết quả xác minh:</label>
                                {{$result['xacminh'][0]->ngayketthucxacminh}}
                            </div>
                            <div>
                                <label>Nội dung chỉ đạo giải quyết của lãnh đạo:</label>
                                {{$result['theodoi'][0]->tomtatxuly}}
                            </div>
                            <div>
                                <label>Danh sách văn bản liên quan:</label>
                                @if($result['theodoi'][0]->filephieutrinh=="" && $result['theodoi'][0]->thongbaogiaiquyet=="" && $result['theodoi'][0]->filecoquankhac=="" && $result['xacminh'][0]->fileketquaxacminh=="")
                                    Không có ài liệu!
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
                                @if($result['xacminh'][0]->fileketquaxacminh!="")
                                    <a href="{{url($result['xacminh'][0]->linkfile."/".$result['xacminh'][0]->fileketquaxacminh)}}" download="">
                                        <span class="glyphicon glyphicon-download-alt"></span>
                                        {{$result['xacminh'][0]->fileketquaxacminh}}
                                    </a>
                                @endif
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-xs-10" style="padding-left: 0">

                            </div>
                            <div class="col-xs-2 text-right" style="padding-right: 0">

                            </div>
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
                                    {{$result['ketqua'][0]->ngayquyetdinh}}
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
                            <div class="row">
                                <div class="col-xs-6" style="padding: 0">
                                    <label>Phải thu tiền:</label>
                                    @if($result['ketqua'][0]->thutien)
                                        {{$result['ketqua'][0]->thutien}}
                                    @else
                                        Không thu tiền.
                                    @endif
                                </div>
                                <div class="col-xs-6" style="padding: 0">
                                    <label>Phải trả tiền:</label>
                                    @if($result['ketqua'][0]->tratien)
                                        {{$result['ketqua'][0]->tratien}}
                                    @else
                                        Không trả tiền.
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6" style="padding: 0">
                                    <label>Phải thu đất:</label>
                                    @if($result['ketqua'][0]->thudat)
                                        {{$result['ketqua'][0]->thudat}}
                                    @else
                                        Không thu đất.
                                    @endif
                                </div>
                                <div class="col-xs-6" style="padding: 0">
                                    <label>Phải trả đất:</label>
                                    @if($result['ketqua'][0]->tradat)
                                        {{$result['ketqua'][0]->tradat}}
                                    @else
                                        Không trả đất.
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-xs-10" style="padding-left: 0">

                            </div>
                            <div class="col-xs-2 text-right" style="padding-right: 0">

                            </div>
                        </div>

                    </td>
                </tr>

                <tr id="scrollToTop5">
                    <td class="text-bold">Kết thúc hoặc rút đơn</td>
                    <td>
                        @if($result['noidung'][0]->ketqua==1)

                            <div>
                                <label>Đã kết thúc xử lý đơn</label>
                            </div>
                        @elseif($result['noidung'][0]->ketqua==2)
                        <div>
                            <label>Ngày ghi trên đơn rút khiếu nại/tố cáo:</label>
                            {{$result['ketthuc'][0]->ngaytrendon}}
                        </div>
                        <div>
                            <label>Ngày nhận đơn rút khiếu nại/tố cáo:</label>
                            {{$result['ketthuc'][0]->ngaynhan}}
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
