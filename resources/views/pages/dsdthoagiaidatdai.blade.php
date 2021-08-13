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

    <div id="donthu" class="col-background" style="margin-bottom: 100px;">
        <div class="panel panel-default panel-min-height">
            <div class="panel-heading text-center">DANH SÁCH ĐƠN HÒA GIẢI ĐẤT ĐAI </div>
            <div class="row" style="margin: 10px 0;">
                <div class="col-xs-4">
                    <a href="{{url('/taodthoagiaidatdai')}}" title="Tạo đơn hòa giải" class="btn btn-sm btn-success">
                        <span class="glyphicon glyphicon-plus"></span>
                        Thêm
                    </a>


                </div>
                <div id="ctl00_ctl00_pnlNhacNhoButton" class="col-xs-5 text-right">

                    <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#pnlTVHGMau">
                        <span class="glyphicon glyphicon-file"></span>
                        Tạo/Sửa mẫu tổ HG
                    </button>

                    <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                            Nhắc nhở

                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="">Quá hạn xử lý</a></li>
                            <li class="divider"></li>
                            <li>
                                <a href="">Đến hạn thẩm tra</a></li>
                            <li>
                                <a href="">Quá hạn thẩm tra</a></li>
                            <li class="divider"></li>
                            <li>
                                <a href="">Đến hạn hòa giải</a></li>
                            <li>
                                <a href="">Quá hạn hòa giải</a></li>
                        </ul>
                    </div>

                </div>
                <div id="ctl00_ctl00_pnlFilterTTXL" class="col-xs-3" style="padding-left: 0">

                    <div class="input-group input-group-sm">
                        <span class="input-group-addon">Trạng thái</span>
                        <select name="ctl00$ctl00$cboTrangThaiXuLy" onchange="" id="ctl00_ctl00_cboTrangThaiXuLy" class="form-control">
                            <option selected="selected" value="0">Tất cả</option>
                            <option value="1">Chờ xử lý</option>
                            <option value="2">Đang thẩm tra lần 1</option>
                            <option value="3">Đã hòa giải lần 1</option>
                            <option value="4">Đang thẩm tra lần 2</option>
                            <option value="5">Đã hòa giải lần 2</option>
                            <option value="6">Kết thúc</option>

                        </select>
                    </div>

                </div>
            </div>


            <div class="row" style="padding-left: 10px; padding-bottom: 10px">


                <div class="col-xs-6" style="padding-left: 0px;">
                    <a href="{{url('/chitietdonthuhoagiai')}}" class="donthuitem">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td class="col-xs-2 text-bold" style="border: 0;">Số thụ lý</td>
                                <td class="col-xs-10" style="border: 0">1</td>
                                <th scope="row" style="border: 0; padding: 0" class="text-right">
                                    <button type="submit" name="ctl00$ctl00$lstDonThu$ctrl0$ctl00$btnDelete" value="" onclick="return confirm();" id="ctl00_ctl00_lstDonThu_ctrl0_btnDelete_0" class="btn btn-xs btn-danger">
                                        <span class="glyphicon glyphicon-remove"></span>
                                        Xóa
                                    </button>
                                </th>
                            </tr>
                            <tr>
                                <td class="text-bold">Ngày gửi</td>
                                <td colspan="2"> 04/07/2016</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Ngày Nhận</td>
                                <td colspan="2"> 07/07/2016</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Người gửi</td>
                                <td colspan="2">Trần Gia Long</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Địa chỉ</td>
                                <td colspan="2">06 Phan Đình Phùng, phường 2, thành phố Đà Lạt</td>
                            </tr>


                            <tr>
                                <td class="text-bold">Nội dung</td>
                                <td colspan="2">Điểm mới trong hòa giải tranh chấp đất đai Luật năm 2013:

                                    Hòa giải tranh chấp đất đai được quy định...</td>
                            </tr>
                            </tbody>
                        </table>
                    </a>
                </div>


            </div>


            <div class="text-center">
                <div id="ctl00_ctl00_donThuDataPager">
                    <ul class="pagination">
                        <li>
                            <span>Trang 1/1</span>
                        </li>
                        <li class="disabled"><a class="aspNetDisabled">«</a>
                        </li>
                        <li class="disabled"><a class="aspNetDisabled">‹</a>
                        </li>
                        <li class="active">
                            <span>1</span>
                        </li>
                        <li class="disabled">
                            <a class="aspNetDisabled">›</a>
                        </li>
                        <li class="disabled">
                            <a class="aspNetDisabled">»</a>
                        </li>
                        <li>
                            <p style="margin-left: 15px; display: inline">Hiển thị:&nbsp;
                                <select name="ctl00$ctl00$donThuDataPager$ctl05$cmbPage" onchange="" id="ctl00_ctl00_donThuDataPager_ctl05_cmbPage" class="form-control" style="width: auto; display: inline">
                                    <option value="5">5</option>
                                    <option selected="selected" value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>

                                </select>&nbsp;dòng</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <div id="pnlTVHGMau" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div id="ctl00_ctl00_ctl01_uppnlTVHGMau" class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Tạo mẫu tổ hòa giải</h4>
                </div>

                <div class="modal-body form-horizontal panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">Chủ tịch hội đồng hòa giải</div>
                        <div class="panel-body">
                            <div class="form-group form-group-sm">
                                <label class="control-label col-xs-2">Họ tên <span class="text-danger">(*)</span></label>
                                <div class="col-xs-10">
                                    <input name="ctl00$ctl00$ctl01$txtChuTichTen" type="text" id="ctl00_ctl00_ctl01_txtChuTichTen" class="form-control">
                                    <span id="ctl00_ctl00_ctl01_rfvChuTichTen" class="field-validation-error" style="display:none;">Vui lòng nhập họ tên!</span>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-xs-2">Chức vụ</label>
                                <div class="col-xs-10">
                                    <input name="ctl00$ctl00$ctl01$txtChuTichChucVu" type="text" id="ctl00_ctl00_ctl01_txtChuTichChucVu" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-xs-2">Đơn vị</label>
                                <div class="col-xs-10">
                                    <input name="ctl00$ctl00$ctl01$txtChuTichDonVi" type="text" id="ctl00_ctl00_ctl01_txtChuTichDonVi" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Danh sách thành viên hội đồng hòa giải</div>


                        <table class="table table-bordered table-hover form-group-sm">
                            <thead>
                            <tr>
                                <th class="text-center">STT</th>
                                <th class="col-xs-4 text-center">Họ tên</th>
                                <th class="col-xs-3 text-center">Chức vụ</th>
                                <th class="col-xs-5 text-center">Đơn vị</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr class="success">
                                <th scope="row" class="text-center" style="vertical-align: middle;">#</th>
                                <td>
                                    <input name="ctl00$ctl00$ctl01$lstTVHG$ctrl0$txtAddHoTen" type="text" id="ctl00_ctl00_ctl01_lstTVHG_txtAddHoTen" class="form-control">
                                    <span id="ctl00_ctl00_ctl01_lstTVHG_rfvtxtAddHoTen" class="field-validation-error" style="display:none;">Vui lòng nhập họ tên!</span>
                                </td>
                                <td>
                                    <input name="ctl00$ctl00$ctl01$lstTVHG$ctrl0$txtAddChucVu" type="text" id="ctl00_ctl00_ctl01_lstTVHG_txtAddChucVu" class="form-control"></td>
                                <td>
                                    <input name="ctl00$ctl00$ctl01$lstTVHG$ctrl0$txtAddDonVi" type="text" id="ctl00_ctl00_ctl01_lstTVHG_txtAddDonVi" class="form-control"></td>
                                <th scope="row" style="vertical-align: middle;">
                                    <button type="submit" name="ctl00$ctl00$ctl01$lstTVHG$ctrl0$btnAddTVHG" value="" onclick="" id="ctl00_ctl00_ctl01_lstTVHG_btnAddTVHG" title="Thêm" class="btn btn-xs btn-success">
                                        <span class="glyphicon glyphicon-plus"></span>
                                        Thêm
                                    </button>
                                </th>
                            </tr>

                            </tbody>
                        </table>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" name="ctl00$ctl00$ctl01$btnSave" value="" onclick="" id="ctl00_ctl00_ctl01_btnSave" title="Lưu thay đổi" class="btn btn-sm btn-success">
                        <span class="glyphicon glyphicon-saved"></span>
                        Lưu
                    </button>
                    <button class="btn btn-sm btn-danger" data-dismiss="modal" aria-hidden="true">
                        <span class="glyphicon glyphicon-ban-circle"></span>
                        Hủy
                    </button>
                </div>
            </div>

        </div>

        <script type="text/javascript">
            function HideAlert() {
                $('#alertTVHG').fadeTo(2000, 500).slideUp(500, function () {
                    $('#alertTVHG').alert('close');
                });
            }
        </script>
    </div>

@endsection
