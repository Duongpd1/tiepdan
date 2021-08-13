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
        var element1 = document.getElementById("xm");
        element1.classList.add("active");
        var element = document.getElementById("htab-nghiepvu");
        element.classList.add("active");
        element.classList.add("in");

    </script>
    <?php
    $data = $result;
    ?>
    <div class="col-background" style="margin-bottom: 100px;">
        <div class="panel panel-default" >
            <form method="post" name="xacminh" action="taodonthuxacminh" enctype="multipart/form-data">
                <div class="panel-heading text-center">TẠO ĐƠN XÁC MINH</div>
                <div class="panel-body" id="ND">

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#div1">Nội dung đơn</a></li>
                        <li><a data-toggle="tab" href="#div2">Giao xác minh</a></li>
                    </ul>

                    <div class="tab-content" style="border: 1px solid #ddd;border-top: 0;padding: 10px;">
                        <div class="tab-pane fade in active" id="div1">
                            <div class="form-group form-horizontal">
                                <div class="form-group form-group-sm">
                                    <label for="sothuly" class="control-label col-xs-3" > Số thụ lý <span class="text-danger">(*)</span></label>
                                    <div class="col-xs-2">
                                        <input type="text" class="form-control " value="<?php echo $data;?>" name="sothuly" id="sothuly">
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="input-group input-group-sm date" >
                                            <label for="ngaynhan" class="input-group-addon">Ngày nhận <span class="text-danger">(*)</span></label>
                                            <input class="form-control" type="text" id="ngaynhan" name="ngaynhan">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="group" class="control-label col-xs-3">Đơn nhiều người <span class="text-danger">(*)</span></label>

                                    <div class="col-xs-9">
                                        <select class="form-control" id="group" name="group">
                                            <option value="0">Cá nhân</option>
                                            <option value="1">Nhiều người</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="tennguoiviet" class="control-label col-xs-3">Họ tên người viết đơn <span class="text-danger">(*)</span></label>

                                    <div class="col-xs-9">
                                        <input class="form-control" type="text" id="tennguoiviet" name="tennguoiviet">
                                    </div>

                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="diachi" class="control-label col-xs-3">Địa chỉ người viết đơn <span class="text-danger">(*)</span></label>

                                    <div class="col-xs-9">
                                        <input class="form-control" type="text" id="diachi" name="diachi">
                                    </div>

                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="cmt" class="control-label col-xs-3">Số CMND/ Hộ chiếu <span class="text-danger">(*)</span></label>

                                    <div class="col-xs-2">
                                        <input class="form-control" type="text" id="cmt" name="cmt">
                                    </div>
                                    <div class="col-xs-3">
                                        <div  class="input-group input-group-sm date">
                                            <label for="ngaycap" class="input-group-addon">Ngày cấp</label>
                                            <input class="form-control" type="text" id="ngaycap" name="ngaycap">
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="input-group input-group-sm date">
                                            <label for="noicap" class="input-group-addon">Nơi cấp</label>
                                            <input class="form-control" type="text" id="noicap" name="noicap">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="lankhieunai" class="control-label col-xs-3"> Lần khiếu nại <span class="text-danger">(*)</span></label>

                                    <div class="col-xs-9">
                                        <select class="form-control" onchange="" id="lankhieunai" name="lankhieunai">
                                            <option value="0">Lần 1</option>
                                            <option value="1">Lần 2</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="noidungdon" class="control-label col-xs-3"> Nội dung ghi trên đơn <span class="text-danger">(*)</span></label>

                                    <div class="col-xs-9">
                                        <textarea class="form-control" rows="5" cols="20" id="noidungdon" name="noidungdon"></textarea>
                                    </div>

                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="loaidon" class="control-label col-xs-3"> Loại đơn <span class="text-danger">(*)</span></label>
                                    <div class="col-xs-9">
                                        <select class="form-control" id="loaidon" name="loaidon">
                                            @for($i = 0; $i<count($loaidon);$i++)
                                            <option value="{{$loaidon[$i]->loaidonid}}">{{$loaidon[$i]->tenloaidon}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="linhvuc" class="control-label col-xs-3"> Lĩnh vực <span class="text-danger">(*)</span></label>
                                    <div class="col-xs-9">
                                        <select name="linhvuc" id="linhvuc" class="form-control">
                                            @for($i = 0; $i<count($linhvuc);$i++)
                                            <option value="{{$linhvuc[$i]->linhvucid}}">{{$linhvuc[$i]->tenlinhvuc}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="diabandisplay" class="control-label col-xs-3"> Địa bàn <span class="text-danger">(*)</span></label>
                                    <div class="col-xs-9">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" readonly="readonly" id="diabandisplay" name="diabandisplay">
                                            <input type="hidden" name="diaban" id="diaban"/>
                                         <span class="input-group-btn">
                                             <button type="button" class="btn btn-sm btn-default" onclick="ChonDiaBan()">
                                                 <span class="glyphicon glyphicon-folder-open"></span>
                                                 &nbsp;Chọn
                                             </button>
                                         </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="div2">
                            <div class="form-group form-horizontal">
                                <div class="form-group form-group-sm">
                                    <label for="ngaybatdau" class="control-label col-xs-3" > Ngày bắt đầu xác minh <span class="text-danger">(*)</span></label>
                                    <div class="col-xs-3">
                                        <input type="text" class="form-control " id="ngaybatdau" name="ngaybatdau">
                                    </div>
                                    <label for="ngayketthuc" class="control-label col-xs-3" > Ngày kết thúc xác minh <span class="text-danger">(*)</span></label>
                                    <div class="col-xs-3">
                                        <input type="text" class="form-control " id="ngayketthuc" name="ngayketthuc" onchange="test();">
                                    </div>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label for="donvidisplay" class="control-label col-xs-3"> Đơn vị xác minh <span class="text-danger">(*)</span></label>
                                    <div class="col-xs-9">
                                        <div class="input-group input-group-sm">
                                            <input type="text" id="donvidisplay" name="donvidisplay" readonly="readonly" class="form-control" />
                                            <input type="hidden" class="form-control" id="donvi" name="donvi">
                                       <span class="input-group-btn">
                                           <button type="button" class="btn btn-sm btn-default" onclick="ChonDonVi()">
                                               <span class="glyphicon glyphicon-folder-open"></span>
                                               &nbsp;Chọn
                                           </button>
                                       </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label class="control-label col-xs-3"> Nội dung giao xác minh <span class="text-danger">(*)</span></label>

                                    <div class="col-xs-9">
                                        <textarea class="form-control" rows="5" cols="20" id="noidungxacminhnoidungxacminh" name="noidungxacminh"></textarea>
                                    </div>

                                </div>

                                <div class="form-group form-group-sm">
                                    <label class="control-label col-xs-3"> File QĐ giao xác minh <span class="text-danger">(*)</span></label>
                                    <div class="col-xs-9">
                                        <input class="form-control" type="file" id="filexacminh" name="filexacminh">
                                    </div>
                                </div>
                                <div class="form-group form-group-sm">
                                    <div class="col-xs-9 col-xs-offset-3">
                                        <input type="submit" class="btn btn-sm btn-success" value="Lưu" id="luu" onclick="return CkeckInput();">
                                        <input type="reset" class="btn btn-sm btn-warning" value="Nhập lại" >
                                        <input type="button" class="btn btn-sm btn-danger" value="Hủy" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">

        function buttonclick()
        {
            alert("1111");
        }

        $(document).ready(function () {

            $('#ngaynhan').datepicker({
                format: "yyyy-mm-dd"
            });
            $('#ngaybatdau').datepicker({
                format: "yyyy-mm-dd"
            });
            $('#ngayketthuc').datepicker({
                format: "yyyy-mm-dd"
            });
            $('#ngaycap').datepicker({
                format: "yyyy-mm-dd"
            });

            $('#toNgay').datepicker({
                format: "dd/mm/yyyy"
            });

            $('#ngay').datepicker({
                format: "dd/mm/yyyy"
            });

        });

        function ChonDiaBan()
        {
            var url ="{{url('/diabantable')}}" ;
            OpenPopupGetData(url,400,380);
        }

        function ChonDonVi()
        {
            var url ="<?php echo e(url('/donvitable')); ?>" ;
            OpenPopupGetData(url,400,380);
        }

        //check ngay xac minh
        /* check input time */
        function validateTwoDates() {
            var dateStart = $("#ngaybatdau").val();
            var dateEnd = $("#ngayketthuc").val();
            return(dateEnd >= dateStart);
        }


        function test(){
            if (! validateTwoDates()) {
                alert('Ngày kết thúc xác minh phải lơn hơn hoặc bằng ngày bắt đầu xác minh!');
                document.getElementById("ngayketthuc").value = "";
            }
        }

        /* Check input null*/
        function CkeckInput() {
            var str = "";
            str += CheckInput('sothuly', "Vui lòng nhập số thụ lý.\r\n");
            str += CheckInput('tennguoiviet', "Vui lòng nhập tên người gửi.\r\n");
            str += CheckInput('diachi', "Vui lòng nhập địa chỉ người gửi.\r\n");
            str += CheckInput('noidungdon', "Vui lòng nhập nội dung đơn.\r\n");
            str += CheckInput('cmt', "Vui lòng nhập số chúng minh nhân dân.\r\n");
            str += CheckInput('lankhieunai', "Vui lòng chọn lần khiếu nại.\r\n");
            str += CheckInput('linhvuc', "Vui lòng chọn lần khiếu nại.\r\n");
            str += CheckInput('diaban', "Vui lòng chọn địa bàn.\r\n");
            str += CheckInput('ngaybatdau', "Vui lòng nhập ngày bắt đầu xác minh.\r\n");
            str += CheckInput('ngayketthuc', "Vui lòng nhập ngày kết thúc xác minh.\r\n");
            str += CheckInput('donvi', "Vui lòng chọn địa bàn.\r\n");
            str += CheckInput('noidungxacminhnoidungxacminh', "Vui lòng nhập nội dung giao xác minh.\r\n");
            str += CheckInput('filexacminh', "Vui lòng chọn file xác minh.\r\n");

//            if ($('#nguondon').val() == "donvi") {
//                str += CheckInput('cvden', "Vui lòng nhập số công văn đến.\r\n");
//                str += CheckInput('ngaychuyen', "Vui lòng nhập ngày chuyển đơn.\r\n");
//                str += CheckInput('coquan', "Vui lòng chọn đơn vị chuyển đơn.\r\n");
//            }
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

    </script>

@endsection
