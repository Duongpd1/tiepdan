@extends('layouts.quantrihethonglayout')

@section('content')
    <div class="col-background" style="margin-bottom: 100px;">
        <?php
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = date("d/m/Y");
        $year = date("Y");
        $data = ($result + 1) . "/" . $year;
        ?>
        <div class="panel panel-default">
            <div class="panel-heading text-center">TẠO ĐƠN MỚI</div>
            <div class="panel-body row" style="padding: 10px 0">
                <div class="col-xs-12 text-right">
                    <button class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-print"></span>&nbsp; Kết chuyển ra mẫu <span
                                class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="{{url('maudon/PhieuXuLyDon.doc')}}" download=""><span class="caret-left"></span> In
                                phiếu xử lý đơn </a></li>
                        <li><a href="{{url('maudon/PhieuHuongDanDon.doc')}}" download=""><span
                                        class="caret-left"></span> In phiếu hướng dẫn công dân </a></li>
                        <li><a href="{{url('maudon/PhieuChuyenDon.doc')}}" download=""><span class="caret-left"></span>
                                In phiếu chuyển đơn </a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body form-horizontal">
                <form method="post" name="xacminh" action="taodonthu" enctype="multipart/form-data">
                    <div class="form-group form-group-sm">
                        <label for="sothuly" class="control-label col-xs-3"> Số thụ lý </label>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" id="sothuly" name="sothuly" value="{{$data}}"
                                   placeholder="Số/năm">
                        </div>
                        <div class="col-xs-3">
                            <div class="input-group input-group-sm date">
                                <label for="ngayviet" class="input-group-addon">Ngày viết </label>
                                <input class="form-control" type="text" id="ngayviet" name="ngayviet">
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="input-group input-group-sm date">
                                <label for="ngaynhan" class="input-group-addon">Ngày nhận </label>
                                <input class="form-control" type="text" id="ngaynhan" name="ngaynhan"
                                       value="{{$today}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="nguondon" class="control-label col-xs-3"> Nguồn đơn </label>
                        <div class="col-xs-9">
                            <select id="nguondon" name="nguondon" class="form-control" onchange="displayNguonDon(this);">
                                @foreach(\App\Model\TableModel\DonThuTable::$arrNguonDon as $key=>$value)
                                    @if($key == \App\Model\TableModel\DonThuTable::NGUON_DON_KHAC)
                                        <option value="{{$key}}" selected>{{$value}}</option>
                                    @else
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endif

                                @endforeach

                            </select>
                            <div id="ttdv" class="panel panel-default " style="margin-top: 5px; display: none">
                                <div class="panel-heading">Thông tin đơn vị chuyển đến</div>
                                <div class="panel-body">
                                    <div class="form-group form-group-sm">
                                        <label for="cvden" class="control-label col-xs-4">Số công văn ban hành </label>
                                        <div class="col-xs-2">
                                            <input class="form-control" type="text" id="cvden" name="soCVBH">
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="ngaychuyen" class="control-label col-xs-4">Ngày ban hành </label>
                                        <div class="col-xs-3">
                                            <input class="form-control" type="text" id="ngaychuyen" name="ngaychuyen">
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="coquan" class="control-label col-xs-4">Tên cơ quan ban hành </label>
                                        <div class="col-xs-8">
                                            <input class="form-control" type="text" id="coquan" name="coquan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm" id="divChuThe">
                        <label for="group" class="control-label col-xs-3"> Chủ thể </label>
                        <div class="col-xs-9">
                            <select id="group" name="group" class="form-control" onchange="showSelect(this);">
                                <option id="alone" value="{{\App\Model\TableModel\DonThuTable::CA_NHAN}}">Cá nhân
                                </option>
                                <option id="some" value="{{\App\Model\TableModel\DonThuTable::TAP_THE}}">Tập thể
                                </option>
                            </select>

                            <div style="margin-top: 15px;padding-left: 0px !important;display: none" class="col-xs-6" id="divSoNgThamGia">
                                <div class="input-group input-group-sm date">
                                    <label for="ipSoNgThamGia" class="input-group-addon">Số người tham gia</label>
                                    <input class="form-control" type="text" id="ipSoNgThamGia" name="soNguoiThamGia">
                                </div>
                            </div>

                            <div id="nhom" class="panel panel-default " style="margin-top: 61px;display: none;">
                                <div class="panel-heading">Thông tin người viết đơn</div>
                                <table class="table table-bordered table-hover" id="donnhieunguoi"
                                       style="display: none">
                                    <thead>
                                    <tr>
                                        <th class="col-xs-2 text-center">Họ tên</th>
                                        <th class="col-xs-4 text-center">Địa chỉ</th>
                                        <th class="col-xs-2 text-center">CMTND/Hộ chiếu</th>
                                        <th class="col-xs-2 text-center">Số điện thoại</th>
                                        <th class="col-xs-1 text-center">NĐDiện</th>
                                        <th class="col-xs-1 text-center">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody id="bodytable">
                                    </tbody>
                                </table>
                                <div class="panel-body">

                                    <div class="form-group form-group-sm">
                                        <label for="tenkntc" class="control-label col-xs-4">Tên chủ thể <span
                                                    class="text-danger">(*)</span> </label>
                                        <div class="col-xs-8">
                                            <input class="form-control" style="text-transform:uppercase" type="text"
                                                   id="tenkntc" name="tenkntc">
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm" id="danhSachNVDThem" style="display: none">
                                        <div class="control-label col-xs-4"></div>
                                        <div class="col-xs-8">
                                            <a id="danhSachThem" onclick="DonThuTheoNguoiViet(this);"
                                               style="cursor:pointer"><i>Danh sách đơn cùng người viết >></i></a>
                                        </div>

                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="diachikntc" class="control-label col-xs-4">Địa chỉ </label>
                                        <div class="col-xs-8">
                                            <input class="form-control" type="text" id="diachikntc" name="diachikntc">
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="cmtThemId" class="control-label col-xs-4">CMTND/Hộ chiếu </label>
                                        <div class="col-xs-4">
                                            <input class="form-control" type="text" id="cmtThemId" name="cmtThem">
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm" id="danhSachDTTrungNhauThem"
                                         style="display:none ">
                                        <div class="control-label col-xs-4"></div>
                                        <div class="col-xs-8">
                                            <a id="danhSachThem" onclick="DonThuTheoCMT(this);"
                                               style="cursor:pointer"><i>Danh sách đơn cùng số CMND/Hộ chiếu >></i></a>
                                        </div>

                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="ngayCapThemId" class="control-label col-xs-4">Ngày cấp </label>
                                        <div class="col-xs-4">
                                            <input class="form-control" type="text" id="ngayCapThemId"
                                                   placeholder="VD:01/01/2017" name="ngayCapThem">
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="noiCapThem" class="control-label col-xs-4">Nơi cấp </label>
                                        <div class="col-xs-8">
                                            <input class="form-control" type="text" id="noiCapThemId" name="noiCapThem"
                                                   value="C.A Tỉnh Phú Thọ">
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="sdtThem" class="control-label col-xs-4">Số điện thoại </label>
                                        <div class="col-xs-4">
                                            <input class="form-control" type="number" min="1" id="sdtThemId"
                                                   name="sdtThem">
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="gtThemId" class="control-label col-xs-4">Giới tính </label>
                                        <div class="col-xs-4">
                                            <select id="gtThemId" name="gioitinh" class="form-control">
                                                @foreach(\App\Model\TableModel\DonThuTable::$arrGioiTinh as $key=>$gT)
                                                    <option value="{{$key}}">{{$gT}}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                    </div>

                                    <div class="form-group form-group-sm">
                                        <label for="daidien" class="control-label col-xs-4">Là người đại diện </label>
                                        <div class="col-xs-8">
                                            <input type="checkbox" id="daidien" name="daidien">
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <div class="col-xs-8 col-xs-offset-4">
                                            <input type="button" class="btn btn-sm btn-success" value="Thêm"
                                                   id="addmore" onclick="btnThemCD(this);">
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm" style="padding-top: 1%;">
                                        <label for="vbuyquyen" class="control-label col-xs-4">Văn bản ủy quyền </label>
                                        <div class="col-xs-8">
                                            <input type="file" id="vbuyquyen" name="vbuyquyen">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                    <div id="donMotNguoi">

                        <div class="form-group form-group-sm">
                            <label for="tennguoiviet" class="control-label col-xs-3"> Họ tên người viết đơn <span
                                        class="text-danger"></span></label>

                            <div class="col-xs-9">
                                <input class="form-control" type="text" style="text-transform:uppercase"
                                       id="tennguoivietID" name="tennguoiviet">
                            </div>

                        </div>
                        <div class="form-group form-group-sm" id="danhSachNVD" style="display: none">
                            <div class="control-label col-xs-3"></div>
                            <div class="col-xs-9">
                                <a id="theoNguoiViet" onclick="DonThuTheoNguoiViet(this);" style="cursor:pointer"><i>Danh
                                        sách đơn cùng người viết >></i></a>
                            </div>

                        </div>

                        <div class="form-group form-group-sm">
                            <label for="diachi" class="control-label col-xs-3">Địa chỉ người viết đơn </label>
                            <div class="col-xs-9">
                                <input name="diachi" type="text" id="diachiID" class="form-control">
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label for="cmt" class="control-label col-xs-3">Số điện thoại</label>
                            <div class="col-xs-2">
                                <input name="sdt" type="text" min="1" id="sdtID" class="form-control">
                            </div>

                            <div class="col-xs-3">
                                <div class="input-group input-group-sm date">
                                    <label for="gioitinh" class="input-group-addon">Giới tính </label>
                                    <select id="gioitinhId" name="gioitinh" class="form-control">
                                        @foreach(\App\Model\TableModel\DonThuTable::$arrGioiTinh as $key=>$gT)
                                            <option value="{{$key}}">{{$gT}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label for="cmt" class="control-label col-xs-3">Số CMND/Hộ
                                chiếu{{--<span class="text-danger"> (*)</span>--}}</label>
                            <div class="col-xs-2">
                                <input name="cmt" type="text" maxlength="15" id="cmt"
                                       class="form-control" {{--required--}}>
                            </div>
                            <div class="col-xs-3">
                                <div class="input-group input-group-sm date">
                                    <span class="input-group-addon">Ngày cấp</span>
                                    <input name="ngaycap" type="text" maxlength="10" placeholder="VD:01/01/2017"
                                           id="ngaycapID" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">Nơi cấp</span>
                                    <input name="noicap" type="text" maxlength="50" value="C.A Tỉnh Phú Thọ"
                                           id="noicapID" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-sm" id="danhSachDTTrungNhau" style="display:none ">
                            <div class="control-label col-xs-3"></div>
                            <div class="col-xs-9">
                                <a id="theoNguoiViet" onclick="DonThuTheoCMT(this);" style="cursor:pointer"><i>Danh sách
                                        đơn cùng số CMND/Hộ chiếu >></i></a>
                            </div>

                        </div>

                        <div class="form-group form-group-sm">
                            <label for="image" class="control-label col-xs-3">Ảnh người viết đơn</label>
                            <div class="col-xs-9">
                                <input name="anhdaidien" type="file" id="image">
                            </div>
                        </div>

                    </div>

                    <div class="form-group form-group-sm" id="divLoaiDon">
                        <label for="loaidon" class="control-label col-xs-3"> Loại đơn </label>
                        <div class="col-xs-9">
                            <select class="form-control" id="loaidon" name="loaidon" onchange="displaySelect(this);">
                                <option value=""></option>
                                <option value="{{$loaidon[0]->loaidonid}}" }}>{{$loaidon[0]->tenloaidon}}</option>
                                <option value="{{$loaidon[3]->loaidonid}}" }}>{{$loaidon[3]->tenloaidon}}</option>
                                <option value="{{$loaidon[1]->loaidonid}}" }}>{{$loaidon[1]->tenloaidon}}</option>
                                <option value="{{$loaidon[2]->loaidonid}}" }}>{{$loaidon[2]->tenloaidon}}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-group-sm" id="divDoiTuong">
                        <label id="dtkhieunai" for="dtkntc" class="control-label col-xs-3"> Đối tượng trên đơn</label>
                        <div class="col-xs-9">
                            <input name="doituong" type="text" id="dtbtc" class="form-control"
                                   style="text-transform:uppercase">
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <label for="nguoiLienQuanId" class="control-label col-xs-3">Người có quyền lợi, nghĩa vụ liên
                            quan <span class="text-danger"></span></label>

                        <div class="col-xs-9">
                            <input class="form-control" type="text" style="text-transform:uppercase"
                                   id="nguoiLienQuanId" name="nguoiLienQuan">
                        </div>

                    </div>

                    <div class="form-group form-group-sm">
                        <label for="noidungdon" class="control-label col-xs-3"> Nội dung đơn </label>
                        <div class="col-xs-9">
                            <textarea class="form-control" rows="5" cols="20" id="noidungdon"
                                      name="noidungdon"></textarea>
                        </div>
                    </div>

                    <div class="form-group form-group-sm" id="divLoaiDon">
                        <label for="chuyenCanBoId" class="control-label col-xs-3"> Chuyển cán bộ </label>
                        <div class="col-xs-3">
                            <select class="form-control" id="chuyenCanBoId" name="chuyenCanBo">
                                <option value=""></option>
                                @foreach($danhSachNhanVien as $nhanVien)
                                    <option value="{{$nhanVien->accountid}}" }}>{{$nhanVien->fullname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="hanXuLyId" class="control-label col-xs-3">Hạn xử lý </label>
                        <div class="col-xs-3">
                            <div class="input-group input-group-sm date">
                                <input class="form-control" type="text" id="hanXuLyId" name="hanXuLy">
                                <label for="ngaynhan" class="input-group-addon">Ngày</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <label class="control-label col-xs-3"> Đơn/tài liệu đính kèm</label>

                        <div class="col-xs-9">
                            <div class="row">
                                <div id="fileinput" class="col-xs-10">
                                    <input id="file1" type="file" name="file1">
                                    <input id="file2" type="file" name="file2" style="margin-top: 5px;display: none">
                                    <input id="file3" type="file" name="file3" style="margin-top: 5px;display: none">
                                    <input id="file4" type="file" name="file4" style="margin-top: 5px;display: none">
                                    <input id="file5" type="file" name="file5" style="margin-top: 5px;display: none">
                                </div>
                                <div class="col-xs-2 text-right" style="padding: 0">
                                    <span id="addfile" class="btn btn-xs btn-success glyphicon glyphicon-plus"
                                          style="cursor: pointer" onclick="AddInput()"></span>
                                    <span id="remove" class="btn btn-xs btn-danger glyphicon glyphicon-minus"
                                          onclick="RemoveInput();" style="cursor: pointer"></span>
                                </div>
                            </div>
                        </div>
                        <input id="datatemp" type="hidden" name="datatemp" value="file0">
                        <input id="tableDeleteId" type="hidden" name="tableDelete">
                        <input id="tableSaveId" type="hidden" name="tableSave">
                        <input id="nguoiDaiDienSaveId" type="hidden" name="nguoiDaiDienSave">
                    </div>
                    <div class="form-group form-group-sm">
                        <div class="col-xs-9 col-xs-offset-3">
                            <input type="submit" class="btn btn-sm btn-success" value="Lưu" id="luu" name="luu"
                                   onclick="return CkeckInput();">
                            {{--<input type="submit" class="btn btn-sm btn-success" value="Lưu và tiếp tục" id="continue" name="continue" onclick="return CkeckInput();">--}}
                            <input type="reset" class="btn btn-sm btn-warning" value="Nhập lại">
                            <input type="button" class="btn btn-sm btn-danger" value="Hủy" id="huy"
                                   onclick="clickBtn(this);">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var no = 1;
        var nguoikntc_no = 1;
        var danhSachNguoiXuLy = <?php echo json_encode($danhSachNhanVien)?>;

        //get value select

        function displayNguonDon(e) {

            var cqKhac = '{{\App\Model\TableModel\DonThuTable::NGUON_DON_CO_QUAN_KHAC}}';
            if(e.value == cqKhac)
            {
                $('#ttdv').show();
            }
            else {
                $('#ttdv').hide();
            }

        }

        function showSelect(e) {

            switch (e.value) {
                case '{{\App\Model\TableModel\DonThuTable::NGUON_DON_CO_QUAN_KHAC}}':
                    $('#ttdv').show();
                    AnHienPanel('#divChuThe', false);
                    AnHienPanel('#donMotNguoi', false);
                    AnHienPanel('#divLoaiDon', false);
                    AnHienPanel('#divDoiTuong', false);
                    break;
                case "dodan":
                    $('#ttdv').hide();
                    AnHienPanel('#divChuThe', true);
                    AnHienPanel('#donMotNguoi', true);
                    AnHienPanel('#divLoaiDon', true);
                    AnHienPanel('#divDoiTuong', true);
                    break;
                case "Lần 1":
                    $('#number').hide();
                    break;
                case "Lần 2":
                    $('#number').show();
                    break;
                case'{{\App\Model\TableModel\DonThuTable::TAP_THE}}':
                    $('#nhom').show();
                    $('#divSoNgThamGia').show();
                    $('#donMotNguoi').hide();
                    break;
                case'{{\App\Model\TableModel\DonThuTable::CA_NHAN}}':
                    $('#nhom').hide();
                    $('#divSoNgThamGia').hide();
                    $('#donMotNguoi').show();
                    $('#tableDeleteId').val(null);
                    $('#tableSaveId').val(null);
                    $('#ipSoNgThamGia').val(null);
                    break;
                default:
                    break;
            }
        }

        //display select
        function displaySelect(e) {
            var str = "";

            if (e.value == 1) {
                $('#lanKN').show();
                $('#dtkhieunai').text("Đối tượng bị khiếu nại");
                $('#diachiDT').text("Địa chỉ đối tượng bị khiếu nại");
            }
            else {
                $('#lanKN').hide();
                switch (e.value) {
                    case "2":
                        $('#dtkhieunai').text("Đối tượng bị tố cáo");
                        $('#diachiDT').text("Địa chỉ đối bị tượng tố cáo");
                        break;
                    case "3":
                        $('#dtkhieunai').text("Đối tượng bị khiếu nại, tố cáo");
                        $('#diachiDT').text("Địa chỉ đối tượng bị khiếu nại, tố cáo");
                        break;
                    case "4":
                        $('#dtkhieunai').text("Cơ quan đơn vị có thẩm quyền giải quyết");
                        $('#diachiDT').text("Địa chỉ cơ quan đơn vị");
                        break;
                    default:
                        $('#dtkhieunai').text("Đối tượng trên đơn");
                        $('#diachiDT').text("Địa chỉ đối tượng trên đơn");
                }

            }

        }


        //event click button
        function clickBtn(d) {
//            console.log(d.id);
            switch (d.id) {
                case "add":
                    document.getElementById("dtkn").style = 'margin-top: 5px;';
//                    document.getElementById("add").style.display ='none';
//                    document.getElementById("close").style ='';
                    $('#close').show();
                    $('#add').hide();
                    break;
                case "close":
                    document.getElementById("dtkn").style.display = 'none';
                    document.getElementById("add").style = '';
                    document.getElementById("close").style.display = 'none';
                    break;
                case "remove":
                    if (no != 1) {
                        var input = document.getElementById("fileinput");
                        input.removeChild(input.childNodes[2]);
                        var data = document.getElementById("datatemp").value;
                        var res = data.split(".");
                        data = res[0];
                        for (var i = 0; i < res.length - 2; i++) {
                            data = data + "." + res[i + 1];
                        }
                        //                    console.log(data);
                        document.getElementById("datatemp").value = data;
                        no--;
                    }
                    break;
                case "addmore":
                    break;
                case "themdtbikntc":
                    break;
                case "huy":
                    var href = "{{url('/danhsachdonthu')}}";
                    window.location.href = href;
                    break;
                default:
                    break;
            }

        }

        /* delete row */
        function DeleteRow(d) {

            var row = d.parentNode.parentNode;
            row.parentNode.removeChild(row);
            var dataTable = document.getElementById("tabletemp").value;
            var dataRow = dataTable.split(".");
            dataRow.splice(d.id - 1, 1);

            var data = "";
            for (var count = 0; count < dataRow.length; count++) {
                if (count == 0) {
                    data = dataRow[count];
                }
                else {
                    data = data + "." + dataRow[count];
                }
            }
            document.getElementById("tabletemp").value = data;


        }


        //date picker
        $(function () {
            $("#ngayviet").datepicker({format: 'dd/mm/yyyy'});
            $("#ngaynhan").datepicker({format: 'dd/mm/yyyy'});
            $("#ngaychuyen").datepicker({format: 'dd/mm/yyyy'});
            $("#ngaycapID").datepicker({format: 'dd/mm/yyyy'});
            $("#ngayCapThemId").datepicker({format: 'dd/mm/yyyy'});
        });

        //chon don thu
        function ChonDonThu() {
            var searchValue = $('#tennguoivietID').val();
            if (searchValue.length <= 0) {
                searchValue = $('#donlan01').val();
                if (searchValue.length <= 0) {
                    searchValue = "a";
                }
            }
            var url = "{{url('/SearchDonThu')}}";
            OpenPopup(url, searchValue, 590, 400);
        }

        /* check input time */
        function validateTwoDates() {
            var dateStart = $("#ngayviet").val();
            var dateEnd = $("#ngaynhan").val();
            return (dateEnd >= dateStart);
        }


        function test() {
            if (!validateTwoDates()) {
                alert('Ngày nhận đơn phải lớn hơn ngày viết đơn!');
                document.getElementById("ngaynhan").value = "";
            }
        }

        /* Check input null*/
        function CkeckInput() {
            var str = "";

            if ($('#group').val() == '{{\App\Model\TableModel\DonThuTable::TAP_THE}}') {
                str += CheckInput('tableSaveId', "Vui lòng thêm người viết đơn!.\r\n");

            }
            else {
            }

            if (str.length > 0) {
                alert(str);
                return false
            }
            return true;
        }

        //add input file
        var numInput = 1;

        function AddInput() {
            if (numInput + 1 <= 5) {
                numInput++;
                var panel = $('#file' + numInput);
                panel.show();
            }
        }

        function RemoveInput() {
            if (numInput > 1) {
                var panel = $('#file' + numInput);
                panel.val(null);
                panel.hide();

                numInput--;
            }
        }


        //


        $('#cmt').keyup(function () {
            var cmt_value = $('#cmt').val();
            if (cmt_value != "") {
                $.ajax({
                    type: 'get',
                    url: '{{URL::to('donthugiongnhau')}}',
                    data: {
                        value: cmt_value,
                        filed: 'cmnd_hc',
                        table: 'donthu'
                    },
                    success: function (data) {

                        if (data != "") {
                            $('#danhSachDTTrungNhau').show();
                        }
                        else {
                            $('#danhSachDTTrungNhau').hide();
                        }
                    }
                });
            }

        });

        $('#cmtThemId').keyup(function () {
            var cmt_value = $('#cmtThemId').val();
            if (cmt_value != "") {
                $.ajax({
                    type: 'get',
                    url: '{{URL::to('donthugiongnhau')}}',
                    data: {
                        value: cmt_value,
                        filed: 'cmnd_hc',
                        table: 'donthu'
                    },
                    success: function (data) {

                        if (data != "") {
                            $('#danhSachDTTrungNhauThem').show();
                        }
                        else {
                            $('#danhSachDTTrungNhauThem').hide();
                        }
                    }
                });
            }

        });

        //


        function DonThuTheoCMT(d) {
            var cmtValue = "";
            if (d.id == "theoCMTThem") {
                cmtValue = $('#cmtThemId').val() + '*' + 'cmnd_hc' + '*' + 'donthu';
            }
            else {
                cmtValue = $('#cmt').val() + '*' + 'cmnd_hc' + '*' + 'donthu';
            }


            var url = "{{url('/danhSachDonThuCungCMT')}}";
            OpenPopup(url, cmtValue, 590, 400);
        }

        //auto complete

        $("#tennguoivietID").keyup(function () {
//            if(e.which == 13) {
            var tenNguoiVD = $('#tennguoivietID').val();
            if (tenNguoiVD != "") {
                $.ajax({
                    type: 'get',
                    url: '{{URL::to('donthugiongnhau')}}',
                    data: {
                        value: tenNguoiVD,
                        filed: 'tennguoivietdon',
                        table: 'donthu'
                    },
                    success: function (data) {


                        if (data != "") {
                            $('#danhSachNVD').show();
                        }
                        else {
                            $('#danhSachNVD').hide();
                        }
                    }
                });
            }
//            }
        });

        $("#tenkntc").keyup(function (e) {
//            if(e.which == 13) {
            var tenNguoiVD = $('#tenkntc').val();
            if (tenNguoiVD != "") {
                $.ajax({
                    type: 'get',
                    url: '{{URL::to('donthugiongnhau')}}',
                    data: {
                        value: tenNguoiVD,
                        filed: 'tennguoivietdon',
                        table: 'donthu'
                    },
                    success: function (data) {


                        if (data != "") {
                            $('#danhSachNVDThem').show();
                        }
                        else {
                            $('#danhSachNVDThem').hide();
                        }
                    }
                });
            }
//            }
        });

        function DonThuTheoNguoiViet(d) {
            var tenNguoiVD = "";
            if (d.id == "danhSachThem") {
                tenNguoiVD = $('#tenkntc').val() + '*' + 'tennguoivietdon' + '*' + 'donthu';
            }
            else {
                tenNguoiVD = $('#tennguoivietID').val() + '*' + 'tennguoivietdon' + '*' + 'donthu';
            }

            var url = "{{url('/danhSachDonThuCungCMT')}}";
            OpenPopup(url, tenNguoiVD, 590, 400);
        }

        //don nhieu nguoi
        var checkDaiDien = 1;
        var checkCongDan = 1;
        var lanMot = false;

        function btnThemCD(d) {
            var tenCD = $('#tenkntc').val();
            var diaChi = $('#diachikntc').val();
            var cmt = $('#cmtThemId').val();
            var ngayCap = $('#ngayCapThemId').val();
            var noiCap = $('#noiCapThemId').val();
            var sdt = $('#sdtThemId').val();
            var sothuly = $('#sothuly').val();
            var gioitinh = $('#gtThemId').val();
            var daidien = document.getElementById("daidien").checked;
            var value = "o";

            if (daidien == true) {
                value = "x";
                if (lanMot == false && checkDaiDien == 1) {
                    lanMot == true;
                    $('#tennguoivietID').val(tenCD);
                    $('#diachiID').val(diaChi);
                    $('#cmt').val(cmt);
                    $('#ngaycapID').val(ngayCap);
                    $('#noicapID').val(noiCap);
                    $('#sdtID').val(sdt);
                    $('#gioitinhId').val(gioitinh);
                    checkDaiDien++;
                }
            }
            else {
                if (lanMot == false && checkCongDan == 1) {

                    lanMot == true;
                    $('#tennguoivietID').val(tenCD);
                    $('#diachiID').val(diaChi);
                    $('#cmt').val(cmt);
                    $('#ngaycapID').val(ngayCap);
                    $('#noicapID').val(noiCap);
                    $('#sdtID').val(sdt);
                    $('#gioitinhId').val(gioitinh);
                    checkCongDan++;
                }
            }

            if (tenCD != "") {
                $.ajax({
                    type: 'get',
                    url: '{{URL::to('themcongdankhac')}}',
                    data: {
                        sothuly: sothuly,
                        tenCongDan: tenCD,
                        diaChi: diaChi,
                        cmt: cmt,
                        ngayCap: ngayCap,
                        noiCap: noiCap,
                        sodt: sdt,
                        value: value,
                        gTinh: gioitinh,
                        type: 'donthu'
                    },
                    success: function (data) {

                        if (data.length > 0) {
                            AnHienPanel('#donnhieunguoi', true);
                            $(function () {
                                $('#bodytable').append('<tr id="' + data[0] + '">' +
                                    '<td>' + data[1] + '</td>' +
                                    '<td>' + data[2] + '</td>' +
                                    '<td >' + data[3] + '</td>' +
                                    '<td >' + data[5] + '</td>' +
                                    '<td class="text-center">' + data[4] + '</td>' +
                                    '<td class="text-center">' +
                                    '<a id="' + data[0] + '.' + data[3] + '" class="text-danger" onclick="DeleteCongDan(this);">' +
                                    '<span class="glyphicon glyphicon-trash">' + '</span>' +
                                    '</a>' +
                                    '</td>' +
                                    '</tr>');
                            });


                            var valueSave = $('#tableSaveId').val();
                            var saveId = data[0];
                            if (valueSave == "") {
                                valueSave = saveId;
                            }
                            else {
                                valueSave = valueSave + '.' + saveId;
                            }
                            $('#tableSaveId').val(valueSave);

                            $('#tenkntc').val(null);
                            $('#diachikntc').val(null);
                            $('#cmtThemId').val(null);
                            $('#ngayCapThemId').val(null);
                            $('#noiCapThemId').val(null);
                            $('#sdtThemId').val(null);
                            $("#daidien").prop('checked', false);
                        }
                    }
                });
            }
            else {
                var str = "";

                str += CheckInput('tenkntc', "Vui lòng nhập tên người viết đơn.\r\n");

                if (str.length > 0) {
                    alert(str);
                }
            }


        }

        function DeleteCongDan(d) {

            var congDanId = d.id.split('.');
            congDanId = congDanId[0];

            $.ajax({
                type: 'get',
                url: '{{URL::to('xoacongdankhac')}}',
                data: {
                    congDanId: congDanId,
                    type: 'donthu'
                },
                success: function (data) {
                    if (data != "") {
                        $('#' + data).hide();
                    }

                }
            });


        }
    </script>
@endsection