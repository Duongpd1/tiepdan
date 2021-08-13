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

        #searchfield {
            display: block;
            width: 100%;
            text-align: center;
            margin-bottom: 35px;
        }

        #searchfield form {
            display: inline-block;
            background: #eeefed;
            padding: 0;
            margin: 0;
            padding: 5px;
            border-radius: 3px;
            margin: 5px 0 0 0;
        }

        #searchfield form .biginput {
            width: 600px;
            height: 40px;
            padding: 0 10px 0 10px;
            background-color: #fff;
            border: 1px solid #c8c8c8;
            border-radius: 3px;
            color: #aeaeae;
            font-weight: normal;
            font-size: 1.5em;
            -webkit-transition: all 0.2s linear;
            -moz-transition: all 0.2s linear;
            transition: all 0.2s linear;
        }

        #searchfield form .biginput:focus {
            color: #858585;
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
    //print_r($result['theodoi']);
    //print_r($result['xacminh']);
    $quyenXoa = Session::get('quyenXoa');
    $chinh_sua = Session::get('accountpermission');
    $accountId = Session::get('accountid');
    $diaBan_Acc = Session::get('diaban');


    function convertNgay($ngayTuDatabase)
    {
        $ngayExplore = explode('-', $ngayTuDatabase);
        $ngay = $ngayExplore[2];
        $thang = $ngayExplore[1];
        $nam = $ngayExplore[0];
        return $ngay . '/' . $thang . '/' . $nam;
    }
    ?>
    <div id="donthu" class="col-background" style="margin-bottom: 200px;">
        <form method="post" action="postchitietdonthu" enctype="multipart/form-data" id="theodoiform">

            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-default">


                        <div class="panel-heading text-center">THÔNG TIN CHÍNH</div>
                        <div class="panel-body row" style="">

                            <div class="col-xs-2" style="padding: 0">
                                <span style="color: #3377c7"># {{$result['noidung'][0]->sothuly}}</span>

                            </div>

                            <div class="col-xs-6">
                                <div class="row">
                                    <div class="col-xs-3" style="padding: 0">
                                        <input type="radio" id="choXuLyId" name="optradio" value="{{CHOXULY}}"
                                               {{($result['noidung'][0]->trangthaixuly == CHOXULY)?'checked':''}} disabled="disabled">
                                        Chờ xử lý
                                    </div>
                                    <div class="col-xs-3" style="padding: 0">
                                        <input type="radio" id="dangXuLyId" name="optradio" value="{{DANGXULY}}"
                                               {{($result['noidung'][0]->trangthaixuly == DANGXULY)?'checked':''}} disabled="disabled">
                                        Đang xử lý
                                    </div>
                                    <div class="col-xs-3" style="padding: 0">
                                        <input type="radio" id="daXuLyId" name="optradio" value="{{DAGIAIQUYET}}"
                                               {{($result['noidung'][0]->trangthaixuly == DAGIAIQUYET)?'checked':''}} disabled="disabled">
                                        Đã xử lý
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 text-right" style="display:none">
                                <button class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown">
                                    <span class="glyphicon glyphicon-print"></span>&nbsp; Kết chuyển ra mẫu <span
                                            class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    {{--<li><a href="{{url('exportMauDon01/'.$result['noidung'][0]->donthuid)}}" ><span class="caret-left"></span> Phiếu thụ lý giải quyết khiếu nại</a></li>--}}
                                    {{--<li><a href="{{url('exportMauDon02/'.$result['noidung'][0]->donthuid)}}" download=""><span class="caret-left"></span> Phiếu không thụ lý giải quyết khiếu nại</a></li>--}}
                                    {{--<li><a href="{{url('exportMauDon03/'.$result['noidung'][0]->donthuid)}}" download=""><span class="caret-left"></span> Phiếu hướng dẫn chuyển đơn</a></li>--}}
                                    {{--<li><a href="{{url('exportMauDon04/'.$result['noidung'][0]->donthuid)}}"><span class="caret-left"></span> Phiếu trả đơn</a></li>--}}
                                    {{--<li><a href="{{url('exportMauDon05/'.$result['noidung'][0]->donthuid)}}"><span class="caret-left"></span> Phiếu chuyển đơn tố cáo</a></li>--}}
                                    {{--<li><a href="{{url('maudon/ThongBaoKhongThuLy_CoQuan.docx')}}" download=""><span class="caret-left"></span> Thông báo không thụ lý đơn - do cơ quan khác chuyển đến</a></li>--}}
                                    {{--<li><a href="{{url('maudon/QuyetDinhGiaiQuyetLan1.docx')}}" download=""><span class="caret-left"></span> Quyết định giải quyết đơn thư lần 1</a></li>--}}
                                    {{--<li><a href="{{url('maudon/QuyetDinhGiaiQuyetLan2.docx')}}" download=""><span class="caret-left"></span> Quyết định giải quyết đơn thư lần 2</a></li>--}}
                                    <li><a href="{{url('exportVanBanTraLoi/'.$result['noidung'][0]->donthuid)}}"><span
                                                    class="caret-left"></span> Văn bản trả lời công dân</a></li>
                                    <li><a href="{{url('exportPhieuXuLy/'.$result['noidung'][0]->donthuid)}}"><span
                                                    class="caret-left"></span> In phiếu xử lý đơn </a></li>
                                    <li><a href="{{url('exportPhieuHuongDan/'.$result['noidung'][0]->donthuid)}}"><span
                                                    class="caret-left"></span> In phiếu hướng dẫn công dân </a></li>
                                    <li><a href="{{url('exportPhieuChuyenDon/'.$result['noidung'][0]->donthuid)}}"><span
                                                    class="caret-left"></span> In phiếu chuyển đơn </a></li>
                                </ul>
                            </div>
                        </div>

                        <table class="table ">
                            <tbody>
                            <tr id="scrollToTop1">
                                <td>
                                    <div class="row">
                                        <div class="col-xs-9">

                                            <div class="row">
                                                <div class="col-xs-7" style="padding: 0">
                                                    <label>Ngày nhận đơn:</label>
                                                    {{($result['noidung'][0]->ngaynhan!='0000-00-00')?date("d/m/Y",strtotime($result['noidung'][0]->ngaynhan)):'Chưa xác định'}}
                                                </div>
                                                <div class="col-xs-5" style="padding: 0">
                                                    <label>Ngày giao xử lý đơn :</label>

                                                    {{($result['noidung'][0]->ngayGiaoXuLy != '0000-00-00 00:00:00')?date("d/m/Y",strtotime($result['noidung'][0]->ngayGiaoXuLy)):'Chưa xác định'}}

                                                </div>
                                            </div>
                                            <div class="row"
                                                 style="display:{{($result['noidung'][0]->nguondon == "dodan")?'none':''}}">
                                                <div class="col-xs-7" style="padding: 0">
                                                    <label>Đơn vị chuyển đến:</label>
                                                    @if($result['noidung'][0]->coquanbanhanh != "")
                                                        {{$result['noidung'][0]->coquanbanhanh}}
                                                    @endif
                                                </div>
                                                <div class="col-xs-5" style="padding: 0">
                                                    <label>Số công văn đến:</label>
                                                    @if($result['noidung'][0]->socongvanden != "")
                                                        {{$result['noidung'][0]->socongvanden}}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row"
                                                 style="display:{{($result['noidung'][0]->nguondon == "dodan")?'none':''}}">
                                                <div class="col-xs-7" style="padding: 0">
                                                    <label>Ngày ban hành:</label>
                                                    {{($result['noidung'][0]->ngaychuyendon !='0000-00-00')?date("d/m/Y",strtotime($result['noidung'][0]->ngaychuyendon)):''}}
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

                                            </div>
                                            <div class="row">
                                                <div class="col-xs-7" style="padding: 0">
                                                    <label>Người xử lý:</label>
                                                    @for($i = 0; $i<count($nguoiXL);$i++)
                                                        {{($result['phanloai'][0]->nguoixuly == $nguoiXL[$i]->accountid)?$nguoiXL[$i]->fullname:''}}
                                                    @endfor
                                                </div>
                                                <div class="col-xs-5" style="padding: 0">
                                                    <label>Hướng giải quyết:</label>
                                                    {{($result['phanloai'][0]->huonggiaiquyet==THULY)?'Thụ lý đơn thuộc thẩm quyền':''}}
                                                    {{($result['phanloai'][0]->huonggiaiquyet==TRADON)?'Trả đơn và hướng dẫn':''}}
                                                    {{($result['phanloai'][0]->huonggiaiquyet==CHUYENDON)?'Chuyển đơn':''}}
                                                    {{($result['phanloai'][0]->huonggiaiquyet==HUONGDAN)?'Hướng dẫn':''}}
                                                    {{($result['phanloai'][0]->huonggiaiquyet==DONDOC)?'Đôn đốc giải quyết đơn quá hạn':''}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12" style="padding: 0">
                                                    <label>
                                                        Nội dung đơn:
                                                    </label>
                                                    {{($result['noidung'][0]->noidung!="")?$result['noidung'][0]->noidung:'Chưa xác định!'}}

                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xs-2 col-md-3">
                                            <a href="#" class="thumbnail" style="height: 180px; width: 150px">
                                                <img src="{{(isset($result['noidung'][0]->image) && trim($result['noidung'][0]->image) != '' ) ? (url(FOLDERROOT.'/'.$result['noidung'][0]->filepath."/".$result['noidung'][0]->image)): (url('img/user.png')) }}"
                                                     alt="{{($result['noidung'][0]->image != null)?'':'Chua co anh dai dien'}}"
                                                     style="height: 100%; width: 100%">
                                            </a>
                                        </div>

                                    </div>

                                </td>

                            </tr>
                            @if(0!= count($thongTinDonCon))
                                <tr id="danhSachDonLienQuan">
                                    <td>

                                        <div class="box-footer"
                                             style="display:{{(0!= count($thongTinDonCon))?'':'none'}}} ">
                                            <div class="row">
                                                <div class="col-xs-7" style="padding: 0">
                                                    <label>Đơn liên quan </label>
                                                </div>
                                            </div>
                                            @foreach($thongTinDonCon as $donCon)
                                                @if($donCon->donthuid != $result['noidung'][0]->donthuid)
                                                    <div class="row">
                                                        <div class="col-xs-9" style="padding: 0">
                                                            <li>.
                                                                <a href="{{url('chitietdonthu/'.$donCon->donthuid)}}">[{{$donCon->sothuly}}
                                                                    ]</a>
                                                                <label>{{($donCon->tennguoivietdon != "")?$donCon->tennguoivietdon:$donCon->coquanbanhanh}}</label>
                                                                <label> được tạo bởi
                                                                    @foreach($nguoiXL as $nguoiTao)
                                                                        @if($donCon->nguoinhap == $nguoiTao->accountid )
                                                                            {{$nguoiTao->fullname}}
                                                                        @endif
                                                                    @endforeach
                                                                </label>
                                                                <label>Vào lúc <span
                                                                            style="color: #3377c7">{{date("H:i:s d/m/Y",strtotime($donCon->create_at))}}</span></label>
                                                            </li>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                    </td>
                                </tr>
                            @endif
                            {{--@if($diaBan_Acc == $result['phanloai'][0]->diaban)--}}
                            @if(1)
                                <tr id="danhSachAction">
                                    <td>
                                        @include('pages.chitietdonthu.group_button')
                                    </td>
                                </tr>

                                <tr id="scrollToTop3">
                                    <td>
                                        <div class="row">

                                            <div class="col-md-6" style="display: none" id="divChuyenCanBo">

                                                <div class="form-group">
                                                    <label>Cán bộ xử lý </label>
                                                    <select name="nguoixuly" id="nguoixuly" class="form-control">
                                                        <option value="">---------- Chọn người xử lý ---------</option>
                                                        @for($i = 0; $i<count($nguoiXL);$i++)

                                                            <option value="{{$nguoiXL[$i]->accountid}}" {{($nguoiXL[$i]->accountid == $result['phanloai'][0]->nguoixuly)?'selected':''}}>{{$nguoiXL[$i]->fullname}}</option>

                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{($chinh_sua == LANHDAO )?'Ý kiến giao việc và chỉ đạo':'Ý kiến giải quyết'}} </label>
                                                    <textarea name="yKienCD" rows="5" cols="5" id="yKienCD"
                                                              class="form-control"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Văn bản kèm theo </label>
                                                    <input type="file" name="vanBanXL" id="vanBanXL">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Chuyển</button>
                                                    <button type="button" class="btn btn-danger" id="huyChuyenCanBo"
                                                            onclick="displayEdit(this.id);">Hủy
                                                    </button>
                                                </div>
                                            </div>
                                            @include('pages.chitietdonthu.vanbanphucdap')
                                        </div>
                                        <div class="row" style="display: none" id="divLuuHoSo">

                                            <div class="col-md-6">

                                                <div class="form-group" id="searchfield">
                                                    <label>Hồ sơ </label>
                                                    <input type="text" name="hoSoData" id="hoSoDataId"
                                                           class="form-control">
                                                    <input type="hidden" name="hoSoValueId" id="hoSoId"
                                                           class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-primary" id="luuHoSoId"
                                                            onclick="displayEdit(this.id)">Lưu hồ sơ
                                                    </button>
                                                    <button type="button" class="btn btn-danger" id="huyLuuHoSo"
                                                            onclick="displayEdit(this.id)">Hủy
                                                    </button>
                                                </div>
                                            </div>


                                        </div>
                                    </td>
                                </tr>
                            @endif

                            <tr id="scrollToTop3">

                                <td>

                                    <div>
                                        <h4 style="border-bottom: 1px outset #bbb">

                                        </h4>
                                    </div>

                                    <input type="text" class="form-control" style="display: none" id="sothuly"
                                           name="sothuly" value="{{$result['noidung'][0]->sothuly}}">
                                    <input type="hidden" name="donthuid" id="donthuid"
                                           value="{{$result['noidung'][0]->donthuid}}">
                                    <input type="text" class="form-control" style="display: none" id="accountid"
                                           name="accountid" value="{{Session::get('accountid')}}">
                                    <div id="divXuLy" class="form-horizontal" style="display:none">

                                        <div class="form-group form-group-sm">
                                            <label for="huonggiaiquyet" class="control-label col-xs-3">Hướng giải
                                                quyết</label>
                                            <div class="col-xs-5">
                                                <select name="huonggiaiquyet" id="huonggiaiquyet" class="form-control"
                                                        onchange="Display(this);">
                                                    <option value="{{THULY}}" {{($result['phanloai'][0]->huonggiaiquyet==THULY)?'selected':''}}>
                                                        Thụ lý đơn thuộc thẩm quyền
                                                    </option>
                                                    <option value="{{TRADON}}" {{($result['phanloai'][0]->huonggiaiquyet==TRADON)?'selected':''}}>
                                                        Trả đơn và hướng dẫn
                                                    </option>
                                                    <option value="{{CHUYENDON}}" {{($result['phanloai'][0]->huonggiaiquyet==CHUYENDON)?'selected':''}}>
                                                        Chuyển đơn
                                                    </option>
                                                    <option value="{{HUONGDAN}}" {{($result['phanloai'][0]->huonggiaiquyet==HUONGDAN)?'selected':''}}>
                                                        Hướng dẫn
                                                    </option>
                                                    <option value="{{DONDOC}}" {{($result['phanloai'][0]->huonggiaiquyet==DONDOC)?'selected':''}}>
                                                        Đôn đốc giải quyết đơn quá hạn
                                                    </option>
                                                </select>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row" id="btnXuLy">

                                        <ul class="list-inline">
                                            <li class="pull-right"><a id="editCommentId" onclick="displayEdit(this.id);"
                                                                      href="#" class="link-blue text-md"><i
                                                            class="fa fa-comments-o margin-r-5"></i> Ý kiến</a></li>
                                        </ul>

                                    </div>
                                    <div class="row" style="display: none" id="commentId">
                                        <div class="form-horizontal">
                                            <div class="form-group margin-bottom-none">
                                                <div class="col-sm-10">
                                                    <input class="form-control input-sm" placeholder="y kien"
                                                           id="commentInput" name="comment">
                                                </div>
                                                <div class="col-sm-2 ">

                                                    <ul class="list-inline">
                                                        <li class="pull-right">
                                                            <button type="button"
                                                                    class="btn btn-danger pull-right btn-block btn-sm pull-right"
                                                                    id="huyCommentId" onclick="displayEdit(this.id);">
                                                                Hủy
                                                            </button>
                                                        </li>
                                                        <li class="pull-right">
                                                            <button type="button"
                                                                    class="btn btn-success pull-right btn-block btn-sm pull-right"
                                                                    id="guiComment" onclick="displayEdit(this.id);">Gửi
                                                            </button>
                                                        </li>
                                                    </ul>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>

                            <tr id="scrollToTop4">

                                <td>
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#home">Thông tin chi tiết</a></li>
                                        <li><a data-toggle="tab" href="#menu1">Lịch sử giao xử lý </a></li>
                                        <li><a data-toggle="tab" href="#menu2">Tổng hợp ý kiến</a></li>
                                        <li><a data-toggle="tab" href="#menu3">Tổng hợp văn bản</a></li>
                                        <li><a data-toggle="tab" href="#menu4">Người theo dõi</a></li>
                                        <li><a data-toggle="tab" href="#menu5">Kết quả tiêp dân</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        @include('pages.chitietdonthu.thongtinchitiet')
                                        @include('pages.chitietdonthu.lichsugiaoxuly')
                                        @include('pages.chitietdonthu.tonghopykien')
                                        @include('pages.chitietdonthu.tonghopvanban')
                                        @include('pages.chitietdonthu.nguoitheodoi')
                                        @if(!empty($tiepdanInfor))
                                            @include('pages.tiepdan.thongtintiepdan')
                                        @endif
                                    </div>

                                </td>
                            </tr>
                            <tr id="hienThiVanBan" style="display:none;">
                                <td id="preview_vanban"
                                    style="font-size: 15px !important;font-family: 'Helvetica Neue, Helvetica, Arial, sans-serif'">

                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </form>
        {{--<form method="post" action="{{route('export_word')}}" enctype="multipart/form-data">--}}
        {{--<input type="hidden" name="htmlString" id="htmlstring" value="">--}}
        {{--<input type="submit" id="MyButton" value="Generate Docx">--}}

        {{--</form>--}}

    </div>
    <script>

        $('#MyButton').click(function () {
            //get your Div HTML tring
            var s = $('#preview_vanban').html();
            console.log(s);
            $('#htmlstring').val(s);
        });
        //edit pages
        var sothuly = <?php echo json_encode($result['noidung'][0]->sothuly);?>;
        var donthuid = <?php echo json_encode($result['noidung'][0]->donthuid);?>;

        var accountId = $('#accountid').val();
        var donthuId = $('#donthuid').val();

        var CHUAPHANLOAI = 0;
        var DAPHANLOAI = 1;

        function EditPages(d) {
            switch (d.id) {
                case "noidung":
                    window.location.href = "{{url('/noidungdonthu')}}" + "/" + d.value;
                    break;
                case "phanLoai":
                    window.location.href = "{{url('/phanloaidonthu')}}" + "/" + d.value;
                    break;
                case "theodoi":
                    $.ajax({
                        type: 'get',
                        url: '{{URL::to('checkedit')}}',
                        data: {
                            thuly: donthuid,
                            table1: "phanloaidonthu",
                            table2: "theodoidonthu",
                            table3: "ketquagiaiquyet"
                        },
                        success: function (data) {

                            if (data['phanloai'][0]['trangthai'] == CHUAPHANLOAI) {
                                window.location.href = "{{url('/phanloaidonthu')}}" + "/" + d.value;

                            }
                            else {
                                window.location.href = "{{url('/theodoidonthu')}}" + "/" + d.value;

                            }

                        }
                    });
                    //
                    break;
                case "ketqua":
                    $.ajax({
                        type: 'get',
                        url: '{{URL::to('checkedit')}}',
                        data: {
                            thuly: donthuid,
                            table1: "phanloaidonthu",
                            table2: "theodoidonthu",
                            table3: "ketquagiaiquyet"
                        },
                        success: function (data) {

                            if (data['phanloai'][0]['trangthai'] == CHUAPHANLOAI) {
                                window.location.href = "{{url('/phanloaidonthu')}}" + "/" + d.value;

                            }
                            else {

                                window.location.href = "{{url('/ketquagiaiquyetdonthu')}}" + "/" + d.value;
                            }
                        }
                    });
                    //
                    break;
                case "ketthuc":
                    $.ajax({
                        type: 'get',
                        url: '{{URL::to('checkedit')}}',
                        data: {
                            thuly: donthuid,
                            table1: "phanloaidonthu",
                            table2: "theodoidonthu",
                            table3: "ketquagiaiquyet"
                        },
                        success: function (data) {
                            // console.log(data['giaiquyet'][0]);
                            if (data['phanloai'][0]['trangthai'] == CHUAPHANLOAI) {
                                window.location.href = "{{url('/phanloaidonthu')}}" + "/" + d.value;
                            }
                            else if (data['giaiquyet'][0]['tomtatketqua'] == "") {
                                window.location.href = "{{url('/ketquagiaiquyetdonthu')}}" + "/" + d.value;
                            }
                            else {
                                window.location.href = "{{url('/ketthucdonthu')}}" + "/" + d.value;
                            }
                        }
                    });
                    //
                    break;
                default:
                    window.location.href = "{{url('/danhsachdonthu')}}";
                    break;
            }

        }

        function xoadanhsachdonthu(id) {

            var confirmdeletecontent = confirm('Bạn có muốn xóa đơn này không?');

            if (confirmdeletecontent) {
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '{{URL::to('xoadonthu')}}',
                    data: {
                        donthuid: id
                    },
                    success: function (response) {

                        window.location.href = "{{url('/danhsachdonthu')}}";
                    }
                });
            }
        }


        function displayEdit(d) {
            switch (d) {
                case 'imgPencil':
                    AnHienPanel('#divXuLy', true);
                    AnHienPanel('#btnXuLy', false);
                    break;
                case 'huyEdit':
                    location.reload();
                    break;
                case 'huyCommentId':
                    location.reload();
                    break;
                case 'editCommentId':
                    AnHienPanel('#commentId', true);
                    AnHienPanel('#btnXuLy', false);
                    break;
                case 'guiComment':

                    var comment = $('#commentInput').val();
                    $.ajax({
                        type: 'post',
                        url: '{{URL::to('senComment')}}',
                        data: {
                            donthuId: donthuId,
                            accountId: accountId,
                            comment: comment
                        },
                        success: function (data) {

                            window.location.href = "{{url('/chitietdonthu')}}" + "/" + donthuId;
                        }
                    });
                    break;
                case 'xemId':
                    AnHienPanel('#xemId', false);
                    AnHienPanel('#anId', true);
                    AnHienPanel('#lichSuDivId', true);
                    break;
                case 'anId':
                    AnHienPanel('#xemId', true);
                    AnHienPanel('#anId', false);
                    AnHienPanel('#lichSuDivId', false);
                    break;
                case 'themTheoDoi':
                    AnHienPanel('#divChonTen', true);
                    AnHienPanel('#themTheoDoi', false);
                    break;
                case 'btnChuyenCBK':
                    AnHienPanel('#divChuyenCanBo', true);
                    break;
                case 'btnLuuHoSo':
                    AnHienPanel('#divLuuHoSo', true);
                    break;
                case 'btnChinhSua':
                    window.location.href = "{{url('/noidungdonthu')}}" + "/" + donthuId;
                    break;
                case 'btnVanBanPhucDap':
                    AnHienPanel('#divVanBanPhucDap', true);
                    break;
                case 'huyChuyenCanBo':
                    AnHienPanel('#divChuyenCanBo', false);
                    break;
                case 'luuHoSoId':
                    var hoSoId = $('#hoSoId').val();

                    $.ajax({
                        type: 'post',
                        url: '{{URL::to('postLuuHoSo')}}',
                        data: {
                            donthuId: donthuId,
                            accountId: accountId,
                            hoSoId: hoSoId
                        },
                        success: function (data) {
                            if ('successful' == data) {
                                window.location.href = "{{url('/chitietdonthu')}}" + "/" + hoSoId;
                            }
                            else {
                                window.location.href = "{{url('/chitietdonthu')}}" + "/" + donthuId;
                            }

                        }
                    });

                    break;
                case 'huyLuuHoSo':
                    window.location.href = "{{url('/chitietdonthu')}}" + "/" + donthuId;
                    break;
                case 'huyCommentYK':
                    window.location.href = "{{url('/chitietdonthu')}}" + "/" + donthuId;
                default:
                    break;
            }

        }

        function luuThemNguoiThepDoi() {
            var idNguoiTheoDoi = $('#selectNguoiTD').val();
            $.ajax({
                type: 'post',
                url: '{{URL::to('themNguoiTheoDoi')}}',
                data: {
                    donthuId: donthuId,
                    accountId: idNguoiTheoDoi
                    //comment: comment
                },
                success: function (data) {

                    if (data != "") {
                        $('#spanId').append(data[0].fullname + ',');
                        location.reload();
                    }

                    AnHienPanel('#divChonTen', false);
                    AnHienPanel('#themTheoDoi', true);

                }
            });

        }

        var donThuAll = <?php echo json_encode($donthuAll)?>;
        var soThuLyAuto = new Array();
        createDataAuto();

        function createDataAuto() {
            for (var i = 0; i < donThuAll.length; i++) {
                soThuLyAuto[i] = {
                    id: donThuAll[i]['donthuid'],
                    value: '[' + donThuAll[i]['sothuly'] + '] ' + donThuAll[i]['tennguoivietdon'] + donThuAll[i]['coquanbanhanh'],
                    data: donThuAll[i]['tennguoivietdon']
                }
            }

        }

        $('#hoSoDataId').autocomplete({
            lookup: soThuLyAuto,
            onSelect: function (suggestion) {
                var thehtml = suggestion.id;
                $('#hoSoId').val(thehtml);
            }
        });

        <?php $dataLink = Session::has('download') ? Session::get('download') : false; ?>

        @if( Session::has('download'))

        @if($dataLink['type'] == 'phieuXuLy')

        $(document).ready(function () {
            window.location.href = '{{url('exportPhieuXuLy/'.$result['noidung'][0]->donthuid).'?type=download'}}';
        });

        @endif

        @if($dataLink['type'] == 'phieuChuyenDon')

        $(document).ready(function () {
            window.location.href = '{{url('exportPhieuChuyenDon/'.$result['noidung'][0]->donthuid).'?type=download'}}';
        });

        @endif

        @if($dataLink['type'] == 'phieuHuongDan')

        $(document).ready(function () {
            window.location.href = '{{url('exportPhieuHuongDan/'.$result['noidung'][0]->donthuid).'?type=download'}}';
        });

        @endif

        @if($dataLink['type'] == 'vanBanTraLoi')

        $(document).ready(function () {
            window.location.href = '{{url('exportPhieuHuongDan/'.$result['noidung'][0]->donthuid).'?type=download'}}';
        });

        @endif

        @endif

        //delete nguoi theo doi
        function deleteNguoiTheoDoi(accountId) {
            $.ajax({
                type: 'post',
                url: '{{URL::to('xoaNguoiTheoDoi')}}',
                data: {
                    donthuId: donthuId,
                    accountId: accountId

                },
                success: function (data) {


                    if (data == 'successful') {
                        var div = document.getElementById("h5." + accountId);
                        div.parentNode.removeChild(div);
                    }


                }
            });
        }

        function chinhSuaComment(commentId) {
            AnHienPanel('#ptext-' + commentId, false);
            AnHienPanel('#' + commentId, false);
            AnHienPanel('#chinhSuaComment-' + commentId, true);
        }

        function submitChinhSuaComment(commentId) {
            $strSplit = commentId.split("-", 2);
            $idComment = $strSplit[1];

            $value = $('#commentYK-' + $idComment).val();

            $.ajax({
                type: 'post',
                url: '{{URL::to('updatedComment')}}',
                data: {
                    commentId: $idComment,
                    comment: $value

                },
                success: function (data) {


                    if (data == 'successful') {
                        location.reload();
                    }

                }
            });
        }

        //fill noi dung van abn

        function displayNoiDungVB(id) {
            var soKH = $('#soVanBanId').val();
            var loaiVB = $('#loaiVanBanId').val();
            var tieuDe = $('#tieuDeId').val();
            var noiDung = $('#noiDungVanBanId').val();
            var txtYkdx = $('#teYKDXId').val();

            var textTieuDe = "";
            if (loaiVB == 'phieuHD') {
                textTieuDe = '<h2 class="text-center">PHIẾU HƯỚNG DẪN</h2>';
            }
            else if (loaiVB == 'phieuCD') {
                textTieuDe = '<h2 class="text-center">PHiẾU CHUYỂN ĐƠN</h2>';
            }
            else if (loaiVB == 'baoCaoDX') {
                textTieuDe = '<h2 class="text-center">BÁO CÁO ĐỀ XUẤT</h2>';
            }
            else if (loaiVB == 'quyetDXL') {
                textTieuDe = '<h2 class="text-center">QUYẾT ĐỊNH GIẢI QUYẾT</h2>';
            }

            switch (id) {
                case 'xemTruocND':

                    AnHienPanel('#hienThiVanBan', true);
                    $.ajax({
                        type: 'post',
                        url: '{{URL::to('previewVanBan')}}',
                        data: {
                            donthuid: donthuid,
                            soKH: soKH,
                            loaiVB: loaiVB,
                            tieuDe: tieuDe,
                            noiDung: noiDung,
                            txtYkdx: txtYkdx
                        },
                        success: function (data) {

                            $('#preview_vanban').html('');
                            $('#preview_vanban').append(data);
                        }
                    });

                    break;
                case 'xuatVB':
                    $.ajax({
                        type: 'post',
                        url: '{{URL::to('exportVanBan')}}',
                        data: {
                            donthuid: donthuid,
                            soKH: soKH,
                            loaiVB: loaiVB,
                            tieuDe: tieuDe,
                            noiDung: noiDung,
                            txtYkdx: txtYkdx,
                            accountId: accountId
                        },
                        success: function (data) {

                            window.location.reload();
                        }
                    });
                    break;
                case 'huyVB':
                    //
                    $('#soVanBanId').val(null);
                    $('#loaiVanBanId').val(null);
                    $('#tieuDeId').val(null);
                    $('#noiDungVanBanId').val(null);

                    //
                    $('#tdSoKH').html('');
                    $('#divLoaiVB').html('');
                    $('#divTieuDe').html('');
                    $('#divNoiDung').html('');
                    //
                    AnHienPanel('#hienThiVanBan', false);
                    AnHienPanel('#divVanBanPhucDap', false);
                    break;
                default:
                    break;
            }


        }

        function changeTemplate(obj) {

            $.ajax({
                type: 'post',
                url: '{{URL::to('getNoiDungFromTemplate')}}',
                data: {
                    donthuid: donthuid,
                    vbKey: obj.value
                },
                success: function (data) {

                    $('#noiDungVanBanId').val(data);


                }
            });

            if (obj.value == {{\App\Model\PageModel\MauDon::VB_BCDX}}) {
                AnHienPanel('#divYKDX', true);
            }
            else {
                AnHienPanel('#divYKDX', false);
            }
            if (obj.value == {{\App\Model\PageModel\MauDon::VB_PCD}})
            {
                AnHienPanel('#dia_chi_nhan', true);
            }
            else {
                AnHienPanel('#dia_chi_nhan', false);
            }

        }

        function changeDonviNhan(obj) {
            var don_vi = document.getElementById('op_donvi_'+obj.value).innerHTML;
            var text = 'Kính gửi: '+ don_vi;
            // $('#dia_chi_nhan').show();
            $('#tieuDeId').val(text);
            $('#ten_don_vi_id').val(don_vi);
        }

    </script>

@endsection
