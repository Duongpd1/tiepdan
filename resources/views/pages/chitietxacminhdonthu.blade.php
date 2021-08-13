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

    <?php
            $data = $result;
            $user = $user;
            //print_r($donvi);

            function drawComBoBox($data)
            {
                for($count = 0; $count < count($data); $count++)
                {
                    echo '<option value = "'.$data[$count]->accountid.'">' . $data[$count]->fullname . '</option>';
                }
            }
    ?>

    <script>
        //document.getElementById("htab-danhmuc").style.display = 'block';
        var element1 = document.getElementById("hs");
        element1.classList.add("active");
        var element = document.getElementById("htab-nghiepvu");
        element.classList.add("active");
        element.classList.add("in");

    </script>

    <form id="form" name="form" role="form" class="col-background"  method="POST" style="margin-bottom: 100px;" action="capnhatxacminh" enctype="multipart/form-data">
        <div class="panel panel-default panel-min-height">
            <div class="panel-heading text-center">CẬP NHẬT XÁC MINH ĐƠN THƯ</div>
            <div class="panel-body form-horizontal">
                <div class="form-group form-group-sm">
                    <label class="control-label col-sm-3">Đơn vị xác minh</label>
                    <div class="col-sm-7" style="padding-top: 6px">
                        @for($i =0;$i<count($donvi);$i++)
                            @if($data->donvi == $donvi[$i]->id)
                                {{$donvi[$i]->tendonvi}}
                            @endif
                        @endfor
                    </div>
                    <input name="sothuly" id="sothuly" value="{{$data->sothuly}}" style="display: none">
                    <div class="col-sm-2 text-right"><a href="" id="{{$data->donthuid}}" onclick="popupWindow(this);">Xem đơn</a></div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="control-label col-sm-3">Ngày bắt đầu xác minh</label>
                    <div class="col-sm-9" style="padding-top: 6px">
                        <?php echo $data->ngaybatdau;?>
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="control-label col-sm-3">Ngày kết thúc xác minh</label>
                    <div class="col-sm-9" style="padding-top: 6px">
                        <?php echo $data->ngayketthuc;?>
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="control-label col-sm-3">File quyết định giao xác minh</label>
                    <div class="col-sm-9" style="padding-top: 6px">
                        <?php
                            if($data->filexacminh == null || $data->filexacminh =="")
                                {
                                    echo 'Không có tài liệu!';
                                }
                            else
                                {
                                    echo $data->filexacminh;
                                }
                        ?>
                    </div>
                </div>

                <div class="form-group form-group-sm" style="border-bottom: 1px dashed #b6b6b6; margin-bottom: 8px">
                    <label class="control-label col-sm-3">Nội dung giao xác minh</label>
                    <div class="col-sm-9" style="padding-top: 6px">
                        <?php
                            echo $data->noidung;
                        ?>
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="control-label col-sm-3">Tên trưởng đoàn xác minh</label>
                    <div class="col-sm-9">
                        <select id="cboTruongDoanXM" name="cboTruongDoanXM" class="form-control">
                            <option value="">---------- Chọn trưởng đoàn xác minh -----------</option>
                            <?php
                                drawComBoBox($user);
                            ?>

                        </select>
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="control-label col-sm-3">Tên phó đoàn xác minh</label>
                    <div class="col-sm-9">
                        <select id="cboPhoDoanXM" name="cboPhoDoanXM" class="form-control">
                            <option value="">---------- Chọn phó đoàn xác minh --------------</option>
                            <?php
                                drawComBoBox($user);
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="control-label col-sm-3">Tên thành viên xác minh</label>
                    <div class="col-sm-9">
                        <select size="6" name="lstThanhVienXM" multiple="multiple" id="lstThanhVienXM" class="form-control">
                            <?php
                                drawComBoBox($user);
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group form-group-sm" style="border-bottom: 1px dashed #b6b6b6; margin-bottom: 8px; padding-bottom: 5px">
                    <label class="control-label col-sm-3">File quyết định thành lập đoàn xác minh</label>
                    <div class="col-sm-9">
                        <input type="file" name="fileQDTLDXM" id="fileQDTLDXM">
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="control-label col-sm-3">File scan biên bản gặp gỡ đối thoại</label>
                    <div class="col-sm-9">
                        <input type="file" name="fileBienBanGapGoDoiThoai" id="fileBienBanGapGoDoiThoai">
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="control-label col-sm-3">File D.Sách TL do người KNTC cung cấp</label>
                    <div class="col-sm-9">
                        <input type="file" name="fileDSTLDoNguoiKNCungCap" id="fileDSTLDoNguoiKNCungCap">
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label class="control-label col-sm-3">Kết thúc xác minh đơn</label>
                    <div class="col-sm-9">
                        <select name="cboKetThuc" id="cboKetThuc" class="form-control" onchange="ChangeKetQua()">
                            <option selected="selected" value="0">Chưa kết thúc</option>
                            <option value="1">Kết thúc</option>

                        </select>
                    </div>
                </div>

                <div style="display:none;" id="showPanelGroup" name="showPanelGroup">
                    <div class="form-group form-group-sm showpanel" style="display: block;">
                        <label class="control-label col-sm-3">Kết quả xác minh <span style="color: #f00">(*)</span></label>
                        <div class="col-sm-9">
                            <textarea name=txtKetQuaXM" rows="5" cols="20" id="txtKetQuaXM" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group form-group-sm showpanel" style="display: block;">
                        <label class="control-label col-sm-3">Kết luận xác minh <span style="color: #f00">(*)</span></label>
                        <div class="col-sm-9">
                            <textarea name="txtKetLuanXM" rows="5" cols="20" id="txtKetLuanXM" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group form-group-sm showpanel" style="display: block;">
                        <label class="control-label col-sm-3">Kiến nghị ban hành QĐ xác minh <span style="color: #f00">(*)</span></label>
                        <div class="col-sm-9">
                            <textarea name="txtKienNghiBHQDGQ" rows="5" cols="20" id="txtKienNghiBHQDGQ" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group form-group-sm showpanel" style="display: block;">
                        <label class="control-label col-sm-3">File scan báo cáo kết quả xác minh <span style="color: #f00">(*)</span></label>
                        <div class="col-sm-9">
                            <input type="file" name="fileBaoCaoKQXacMinh" id="fileBaoCaoKQXacMinh"><input type="hidden" name="ctl00$ctl00$hidFile" id="ctl00_ctl00_hidFile">
                        </div>
                    </div>
                </div>


                <div class="form-group form-group-sm">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" title="Lưu" class="btn btn-sm btn-success">
                            <span class="glyphicon glyphicon-saved" aria-hidden="true"></span>
                            Lưu
                        </button>

                        <button type="reset" class="btn btn-sm btn-warning">
                            <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                            Nhập lại
                        </button>

                        <button type="submit" name="ctl00$ctl00$btnCancel" value="" id="ctl00_ctl00_btnCancel" title="Hủy, trở về trang danh sách" class="btn btn-sm btn-danger">
                            <span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
                            Hủy
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </form>

    <script>
        function ChangeKetQua()
        {
            var value = $('#cboKetThuc option:selected').val();
            //alert(value);
            //document.getElementById("showPanelGroup");
            if(value == 0)
            {
                document.getElementById("showPanelGroup").style.display = 'none';
            }
            else
            {
                document.getElementById("showPanelGroup").style.display = 'block';
            }
        }

        //open pop up


        function popupWindow(d) {
            var id = d.id;
            var url = "{{url('/detaildonthulan1')}}";
            var path = url+"/"+id;
            var myWindow = window.open(path, "","width=500,height=500");
        }
    </script>

@endsection
