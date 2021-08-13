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
    <link rel="stylesheet" href="{{url('/css/complete.css')}}">
@endsection
@section('js')
    <script type="text/javascript" src="{{url('/js/jquery.autocomplete.min.js')}}"></script>
@endsection
@section('content')

    <div class="contentmain" style="padding: 10px;">
        <div class="panel panel-default panel-min-height">
            <div class="panel-heading text-center">
                THÊM MỚI VĂN BẢN
            </div>
            <form role="form" id="thongbao" method="post" action="submitthemvanbanphapluat" enctype="multipart/form-data">
                {{csrf_field() }}
                <input name="accountname" type="text" id="accountname" style="display: none" value="{{$accountname = Session::get('accountname')}}">
                <div style="background-color:#FFFFFF" class="panel-body form-horizontal">
                    <div class="form-group form-group-sm">
                        <label for="tenvanban" class="control-label col-xs-2">Tên văn bản </label>
                        <div class="col-xs-10">
                            <input name="tenvanban" type="text" id="tenvanban" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="sohieu" class="control-label col-xs-2">Số hiệu </label>
                        <div class="col-xs-10">
                            <input name="sohieu" type="text" id="sohieu" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="trichdan" class="control-label col-xs-2">Trích dẫn </label>
                        <div class="col-xs-10" >
                            <textarea class="form-control" id="trichdan" name="trichdan" rows="20" cols="20"> </textarea>
                            <script>
                                CKEDITOR.replace( 'trichdan', {
                                    language: 'vi'
                                } );
                            </script>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="coquanbanhanh" class="control-label col-xs-2">Cơ quan ban hành </label>
                        <div class="col-xs-10" >
                            <input name="coquanbanhanh" type="text" id="coquanbanhanh" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="nguoiky" class="control-label col-xs-2">Người ký </label>
                        <div class="col-xs-10" >
                            <input name="nguoiky" type="text" id="nguoiky" class="form-control">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="txtNgayBanHanh" class="control-label col-xs-2">Ngày ban hành </label>
                        <div class="col-xs-3 " style="padding-left:15px">
                            <div class=" input-group input-group-sm" >

                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                <input name="ngaybanhanh" type="text"  maxlength="10" id="ngaybanhanh" class="form-control" placeholder="dd/mm/yyyy" data-provide="datepicker" style="width:120px;" >
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="input-group input-group-sm date">
                                <label for="ngayNhanId" class="input-group-addon">Ngày nhận </label>
                                <input class="form-control" type="text" id="ngayNhanId" name="ngayNhan" value="{{date('d/m/Y')}}" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm" >
                        <label for="chuyenCanBoId" class="control-label col-xs-2"> Chuyển cán bộ </label>
                        <div class="col-xs-4 " >
                            <select class="form-control" id="chuyenCanBoId" name="chuyenCanBo" >
                                <option value=""></option>
                                @foreach($danhSachNhanVien as $nhanVien)
                                    <option value="{{$nhanVien->accountid}}" }}>{{$nhanVien->fullname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-xs-2"> Đối tượng liên quan</label>

                        <div class="col-xs-10" style="padding-left: 0px">
                            <div class="row" >
                                <div id="doiTuongInput" class="col-xs-10">
                                    <input id="doiTuongId1" type="text" name="doiTuong1" class="form-control">
                                    <input id="doiTuongId2" type="text" name="doiTuong2" style="margin-top: 5px;display: none" class="form-control">
                                    <input id="doiTuongId3" type="text" name="doiTuong3" style="margin-top: 5px;display: none" class="form-control">
                                    <input id="doiTuongId4" type="text" name="doiTuong4" style="margin-top: 5px;display: none" class="form-control">
                                    <input id="doiTuongId5" type="text" name="doiTuong5" style="margin-top: 5px;display: none" class="form-control">
                                </div>
                                <div class="col-xs-1 text-right" style="padding: 0">
                                    <span id="addfile" class="btn btn-xs btn-success glyphicon glyphicon-plus"  style="cursor: pointer" onclick="AddInput()"></span>
                                    <span id="remove" class="btn btn-xs btn-danger glyphicon glyphicon-minus" onclick="RemoveInput();" style="cursor: pointer"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="donLienQuanId" class="control-label col-xs-2">Đơn liên quan </label>
                        <div class="col-xs-7" >
                            <input name="donLienQuan" type="text" id="donLienQuanId" class="form-control">
                            <input type="hidden" name="donLienQuanHide" id="donLienQuanHideId" class="form-control">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="filevanban" class="control-label col-xs-2">File đính kèm </label>
                        <div class="col-xs-10">
                            <input type="file" name="filevanban" id="filevanban">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-xs-2">Loại văn bản </label>
                        <div class="col-xs-10">
                            <div class="checkbox checkbox-primary">
                                <input id="VBAD" type="checkbox" name="VBAD"><label style="display: inline-block !important" for="VBAD"> Văn bản đến </label><br>
                                <input id="VBCD" type="checkbox" name="VBCD"><label style="display: inline-block !important" for="VBCD"> Văn bản phát hành</label><br>
                                <input id="VBPL" type="checkbox" name="VBPL"  ><label style="display: inline-block !important" for="VBPL"> Văn bản pháp luật</label><br>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <div class="col-xs-2"></div>
                        <div class="col-xs-10">
                            <button type="submit" name="btnok" id="btnok" title="Lưu" class="btn btn-sm btn-success">
                                <span class="glyphicon glyphicon-saved" aria-hidden="true"></span>
                                Lưu
                            </button>
                            <button type="reset" class="btn btn-sm btn-warning">
                                <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                                Nhập lại
                            </button>
                            <a href="{{url('qtvanban')}}" name="btncancel" id="btncancel" title="Hủy thao tác, trở lại trang danh sách" class="btn btn-sm btn-danger">
                                <span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
                                Hủy
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){

            $('#ngaybanhanh').datepicker({
                format:'dd/mm/yyyy'
            });
            $('#ngayNhanId').datepicker({
                format:'dd/mm/yyyy'
            });
        });

        //add input file
        var numInput = 1;
        function AddInput() {
            if (numInput + 1 <= 5) {
                numInput++;
                var panel = $('#doiTuongId' + numInput);
                panel.show();
            }
        }
        function RemoveInput() {
            if (numInput > 1) {
                var panel = $('#doiTuongId' + numInput);
                panel.val(null);
                panel.hide();

                numInput--;
            }
        }

        //auto complete
        var donThuAll = <?php echo json_encode($donthuAll)?>;
        var soThuLyAuto = new Array();
        createDataAuto();
        function createDataAuto ()
        {
            for(var i =0 ;i<donThuAll.length;i++)
            {
                soThuLyAuto[i] = {id:donThuAll[i]['donthuid'],value:'['+donThuAll[i]['sothuly'] +'] '+ donThuAll[i]['tennguoivietdon']+donThuAll[i]['coquanbanhanh'],data:donThuAll[i]['tennguoivietdon']}
            }

        }

        $('#donLienQuanId').autocomplete({
            lookup: soThuLyAuto,
            onSelect: function (suggestion) {
                var thehtml = suggestion.id ;
                $('#donLienQuanHideId').val(thehtml);
            }
        });
    </script>

@endsection