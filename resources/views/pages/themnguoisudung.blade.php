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
        //document.getElementById("htab-hethong").style.display = 'block';
        var element1 = document.getElementById("nguoisudung");
        element1.classList.add("active");
        var element = document.getElementById("htab-hethong");
        element.classList.add("active");
        element.classList.add("in");

    </script>
    <div class="container-fluid" style="margin-bottom: 40px; padding: 10px 15px">
        <div class="col-background">
            <div class="panel panel-default panel-min-height">
                <div class="panel-heading text-center">THÊM NGƯỜI SỬ DỤNG</div>

                <form method="post" name="xacminh" action="submitthemnguoisudung" enctype="multipart/form-data">
                    <div class="panel-body form-horizontal">
                        @if($error = Session::get('themnguoisudung_error'))
                            <div class="form-group form-group-sm text-center">
                                <strong style="color: red"><i class="glyphicon glyphicon-warning-sign"></i>&nbsp;{{$error}}</strong>
                            </div>
                        @endif
                        <div class="form-group form-group-sm">
                            <label for="fullname" class="control-label col-xs-3">Tên người sử dụng <span class="text-danger">(*)</span></label>
                            <div class="col-xs-9">
                                <input name="fullname" type="text" maxlength="50" id="fullname" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="chucvu" class="control-label col-xs-3">
                                Chức vụ
                                <span class="text-danger">(*)</span>
                            </label>
                            <div class="col-xs-9">
                                <input name="chucvu" type="text" maxlength="30" id="chucvu" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="accountname" class="control-label col-xs-3">
                                Tên đăng nhập
                                <span class="text-danger">(*)</span>
                            </label>
                            <div class="col-xs-9">
                                <input name="accountname" type="text" maxlength="20" id="accountname" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="password" class="control-label col-xs-3">
                                Mật khẩu
                                <span class="text-danger">(*)</span>
                            </label>
                            <div class="col-xs-9">
                                <input name="password" type="password" maxlength="20" id="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="repassword" class="control-label col-xs-3">
                                Xác nhận mật khẩu
                                <span class="text-danger">(*)</span>
                            </label>
                            <div class="col-xs-9">
                                <input name="repassword" type="password" maxlength="20" id="repassword" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label for="skypeaccount" class="control-label col-xs-3">
                                Skype Account
                            </label>
                            <div class="col-xs-9">
                                <input name="skypeaccount" type="text" maxlength="100" id="skypeaccount" class="form-control">
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label for="donvidisplay" class="control-label col-xs-3">
                                Đơn vị
                                <span class="text-danger">(*)</span>
                            </label>
                            <div class="col-xs-9">
                                <div class="input-group input-group-sm">
                                    <input type="text" id="donvidisplay" name="donvidisplay" readonly="readonly" class="form-control" />
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-default" onclick="ChonDonVi()">
                                            <i class="glyphicon glyphicon-folder-open"></i>
                                            &nbsp;Chọn
                                        </button>
                                    </span>
                                </div>
                                <input type="hidden" name="donvi" id="donvi" />
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="diabandisplay" class="control-label col-xs-3">Địa bàn</label>
                            <div class="col-xs-9">
                                <div class="input-group input-group-sm">
                                    <input type="text" id="diabandisplay" name="diabandisplay" readonly="readonly" class="form-control" />
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-default" onclick="ChonDiaBan()">
                                    <i class="glyphicon glyphicon-folder-open"></i>
                                    &nbsp;Chọn
                                </button>
                            </span>
                                </div>
                                <input type="hidden" name="diaban" id="diaban" />
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="thutu" class="control-label col-xs-3">Thứ tự</label>
                            <div class="col-xs-9">
                                <input name="thutu" type="text" value="1" maxlength="3" id="thutu" class="form-control numberonly" />
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="loaitaikhoan" class="control-label col-xs-3"> Loại tài khoản</label>

                            <div class="col-xs-9">
                                <select id="loaitaikhoan" name="loaitaikhoan" class="form-control" onchange="">
                                    <option value="0">------ Chọn loại tài khoản ------</option>
                                    <option value="1">Nghiệp Vụ</option>
                                    <option value="2">Lãnh Đạo</option>
                                    <option value="3">Quản Lý Hệ Thống</option>
                                    <option value="4">Thông Tin</option>
                                    <option value="5">Tiếp Dân</option>
                                    <option value="6">Văn Thư</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group form-group-sm">
                            <label for="nhomquyen" class="control-label col-xs-3">Nhóm quyền</label>
                            <div class="col-xs-9">
                                <div id="nhomquyen">
                                    <select name="nhomquyen" onchange="selectnhomquyen(this.value)" id="nhomquyen" class="form-control">
                                        @foreach($nhomquyendata as $nhomquyen)
                                            <option value="{{$nhomquyen->id}}">{{$nhomquyen->tennhom}}</option>
                                        @endforeach
                                    </select>
                                    <div class="checkbox checkbox-primary">
                                        <table id="banggroup" class="col-xs-6">
                                            <tr>
                                                <td><span><input id="quyenxoadonthu" type="checkbox" name="quyenxoadonthu" /><label for="quyenxoadonthu">Quyền xóa đơn</label></span></td>
                                                <td><span><input id="quyenxoacongthongtin" type="checkbox" name="quyenxoacongthongtin" /><label for="quyenxoacongthongtin">Quyền xóa Cổng thông tin</label></span></td>
                                            </tr>
                                            <tr>
                                                <td><span><input id="quyenxoadanhmuc" type="checkbox" name="quyenxoadanhmuc" /><label for="quyenxoadanhmuc">Quyền xóa danh mục</label></span></td>
                                                <td><span><input id="quyenxemtheodiaban" type="checkbox" name="quyenxemtheodiaban" /><label for="quyenxemtheodiaban">Quyền xem theo địa bàn</label></span></td>
                                            </tr>
                                            <tr>
                                                <td><span><input id="quyenxoatiepdan" type="checkbox" name="quyenxoatiepdan" /><label for="quyenxoatiepdan">Quyền xóa tiếp dân</label></span></td><td></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="status" class="control-label col-xs-3">Trạng thái</label>
                            <div class="col-xs-9">
                                <div class="radio radio-primary">
                                    <table id="status" style="width:30%;">
                                        <tr>
                                            <td><input id="sudung" type="radio" name="trangthai" value="1" checked="checked" /><label for="sudung">Sử dụng</label></td>
                                            <td><input id="khongsudung" type="radio" name="trangthai" value="0" /><label for="khongsudung">Không sử dụng</label></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <div class="col-xs-9 col-xs-offset-3">
                                <button type="submit" title="Thêm" class="btn btn-sm btn-success">
                                    <span class="glyphicon glyphicon-saved" aria-hidden="true"></span>
                                    Lưu
                                </button>

                                <button type="reset" class="btn btn-sm btn-warning">
                                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                                    Nhập lại
                                </button>

                                <a href="{{url('qtdanhmucnguoisudung')}}" title="Hủy" class="btn btn-sm btn-danger">
                                    <span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
                                    Hủy
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        function ChonDiaBan()
        {
            var url ="{{url('/diabantable')}}" ;
            OpenPopupGetData(url,400,380);
        }

        function ChonDonVi()
        {
            var url ="{{url('/donvitable')}}" ;
            OpenPopupGetData(url,400,380);
        }

        var firstnhomquyen = <?php echo json_encode($nhomquyendata[0]->id); ?>;
        selectnhomquyen(firstnhomquyen);
        function selectnhomquyen(value){

            $.ajax({
                type: 'post',
                dataType: 'json',
                url:  '{{URL::to('getquyennguoisudung')}}',
                data: {
                    nhomquyenid: value
                },
                success: function (response) {

                    document.getElementById('quyenxoadonthu').checked = '';
                    document.getElementById('quyenxoatiepdan').checked = '';
                    document.getElementById('quyenxemtheodiaban').checked = '';
                    document.getElementById('quyenxoadanhmuc').checked = '';
                    document.getElementById('quyenxoacongthongtin').checked = '';

                    if(response['getquyennguoisudung_result'][0]['quyenxoadonthu'] == 1) {

                        document.getElementById('quyenxoadonthu').checked = 'checked';

                    }

                    if(response['getquyennguoisudung_result'][0]['quyenxoatiepdan'] == 1) {

                        document.getElementById('quyenxoatiepdan').checked = 'checked';

                    }

                    if(response['getquyennguoisudung_result'][0]['quyenxemtheodiaban'] == 1) {

                        document.getElementById('quyenxemtheodiaban').checked = 'checked';

                    }

                    if(response['getquyennguoisudung_result'][0]['quyenxoadanhmuc'] == 1) {

                        document.getElementById('quyenxoadanhmuc').checked = 'checked';

                    }

                    if(response['getquyennguoisudung_result'][0]['quyenxoacongthongtin'] == 1) {

                        document.getElementById('quyenxoacongthongtin').checked = 'checked';
                    }
                }
            });
        }

    </script>
@endsection
