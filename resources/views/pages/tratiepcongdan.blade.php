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
        var element1 = document.getElementById("qttracuctiepdan");
        element1.classList.add("active");
        var element = document.getElementById("htab-tracuu");
        element.classList.add("active");
        element.classList.add("in");

    </script>
    <div class="col-background" id="" style="margin-bottom: 100px;">
        <div class="panel panel-default panel-min-height">
            <form method="" name="xacminh" action="" enctype="multipart/form-data">
            <div class="panel-heading text-center">Tra cứu lịch tiếp dân</div>
            <div class="panel-body">
                <div class="form-horizontal">

                    <div class="form-group form-group-sm">
                        <label class="control-label col-xs-2">Số thụ lý</label>
                        <div class="col-xs-3">
                            <div class="input-group input-group-sm">
                                {{--<span class="input-group-addon">Từ</span>--}}
                                <input name="Sothuly_tu" type="text"  id="sothuly_tu" class="form-control">
                                {{--<span class="input-group-addon">Đến</span>--}}
                                {{--<input name="Sothuly_den" type="number" min="1" maxlength="8" id="sothuly_den" class="form-control">--}}
                            </div>
                        </div>
                        <label class="control-label col-xs-2">Ngày tiếp</label>
                        <div class="col-xs-5">
                            <div class="input-group input-group-sm">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">Từ</span>
                                    <input name="ngaytiep_tu" type="text"  id="ngaytiep_tu" class="form-control">
                                    <span class="input-group-addon">Đến</span>
                                    <input name="ngaytiep_den" type="text"  id="ngaytiep_den" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-xs-2">Chủ thể</label>
                        <div class="col-xs-3">
                            <select name="loaihinh" id="loaihinh" class="form-control">
                                <option value="">---------Chọn loại hình-----------</option>
                                <option value="1">Cá nhân</option>
                                <option value="2">Tập thể</option>
                            </select>
                        </div>
                        <label class="control-label col-xs-2">Địa bàn</label>
                        <div class="col-xs-5">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" readonly="readonly" id="diabandisplay" name="diabandisplay">
                                <input type="hidden" name="diaban" id="dia_ban"/>
                                     <span class="input-group-btn">
                                         <button type="button" class="btn btn-sm btn-default" onclick="ChonDiaBan()">
                                             <span class="glyphicon glyphicon-folder-open"></span>
                                             &nbsp;Chọn
                                         </button>
                                     </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-xs-2">Lĩnh vực</label>
                        <div class="col-xs-3">
                            <select name="linhvuc" id="linh_vuc" class="form-control">
                                <option value="">---------Chọn lĩnh vực-----------</option>
                                @for($i = 0;$i <count($linhvuc);$i++)
                                    <option value="{{$linhvuc[$i]->linhvucid}}">{{$linhvuc[$i]->tenlinhvuc}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm" id="panel1">
                        <div class="col-xs-2">
                            <select class="form-control" name="ChonDK" id="chondk1">
                                <option value=""> Chọn điều kiện</option>
                                <option value="congdan"> Họ và tên</option>
                                <option value="lanhdao"> Họ và tên người tiếp</option>
                                <option value="diachi"> Địa chỉ công dân</option>
                                <option value="noidung"> Nội dung</option>
                            </select>
                        </div>
                        <div class="col-xs-10">
                            <div class="input-group input-group-sm">
                                <input type="text" id="dk1" class="form-control" placeholder="Nhập giá trị tìm kiếm...">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-success" onclick="AddPanel();"><span class="glyphicon glyphicon-plus"></span></button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="RemovePanel();"><span class="glyphicon glyphicon-remove"></span></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm" id="panel2" style="display: none">
                        <div class="col-xs-2">
                            <select class="form-control" name="ChonDK" id="chondk2">
                                <option value=""> Chọn điều kiện</option>
                                <option value="congdan"> Họ và tên</option>
                                <option value="lanhdao"> Họ và tên người tiếp</option>
                                <option value="diachi"> Địa chỉ công dân</option>
                                <option value="noidung"> Nội dung</option>
                            </select>
                        </div>
                        <div class="col-xs-10">
                            <input type="text" id="dk2" class="form-control" placeholder="Nhập giá trị tìm kiếm...">
                        </div>
                    </div>
                    <div class="form-group form-group-sm" id="panel3" style="display: none">
                        <div class="col-xs-2">
                            <select class="form-control" name="ChonDK" id="chondk3">
                                <option value=""> Chọn điều kiện</option>
                                <option value="congdan"> Họ và tên</option>
                                <option value="lanhdao"> Họ và tên người tiếp</option>
                                <option value="diachi"> Địa chỉ công dân</option>
                                <option value="noidung"> Nội dung</option>
                            </select>
                        </div>
                        <div class="col-xs-10">
                            <input type="text" id="dk3" class="form-control" placeholder="Nhập giá trị tìm kiếm...">
                        </div>
                    </div>
                    <div class="form-group form-group-sm" id="panel4" style="display: none">
                        <div class="col-xs-2">
                            <select class="form-control" name="ChonDK" id="chondk4">
                                <option value=""> Chọn điều kiện</option>
                                <option value="congdan"> Họ và tên</option>
                                <option value="lanhdao"> Họ và tên người tiếp</option>
                                <option value="diachi"> Địa chỉ công dân</option>
                                <option value="noidung"> Nội dung</option>
                            </select>
                        </div>
                        <div class="col-xs-10">
                            <input type="text" id="dk4" class="form-control" placeholder="Nhập giá trị tìm kiếm...">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <div class="col-xs-4 col-xs-offset-2">
                            <button class="btn btn-sm btn-success" type="button" onclick="Finding();" id="btnSearch" title="Tìm"><span class="glyphicon glyphicon-search"></span>Tìm</button>
                            <button class="btn btn-sm btn-warning" type="reset" id="btnreset" title="reset"><span class="glyphicon glyphicon-refresh"></span>Nhập lại</button>
                        </div>
                        <div id="ctl00_UpdateProgress01" class="col-xs-1" style="display:none;" role="status" aria-hidden="true">
                            <img src="{{url('/img/loading.gif')}}" style="width: 28px; height: 28px;">
                        </div>
                            <label id="label_co" class="control-label col-xs-5 text-danger" style="text-align: left;">

                            </label>
                    </div>
                </div>
            </div>

            <table id="danhsach" class="table table-bordered table-hover" style="display: none;">
                <thead>
                <tr>
                    <th>Số thụ lý</th>
                    <th>Lãnh đạo</th>
                    <th>Công dân</th>
                    <th>Ngày tiếp</th>
                    <th>Lĩnh vực</th>
                    <th>Nội dung</th>
                </tr>
                </thead>
                <tbody id="table">



                </tbody>
            </table>
                </form>
        </div>
    </div>

    <script>
        //chon dia ban

        function ChonDiaBan()
        {
            var url ="{{url('/diabantable')}}" ;
            OpenPopupGetData(url,400,380);
        }

        //
        var numPanel = 1;
        function AddPanel() {
            if (numPanel + 1 <= 4) {
                numPanel++;
                var panel = $('#panel' + numPanel);
                panel.show();
            }
        }
        function RemovePanel() {
            if (numPanel > 1) {
                var panel = $('#panel' + numPanel);
                var dk = $('#chondk' + numPanel);
                var input_value = $('#dk' + numPanel);
//                console.log(input_value);
                dk.val(null);
                input_value.val(null);
                panel.hide();
                numPanel--;
//                console.log("value: "+input_value.val());
            }
        }
        //ngay
        $( function() {
            $( "#ngaytiep_tu" ).datepicker({format: 'yyyy-mm-dd'});
            $( "#ngaytiep_den" ).datepicker({format: 'yyyy-mm-dd'});

        } );

        //click button tim
        //fuction
        function Finding()
        {
            // bien
//            var dieu_kien ="";
//            if (document.getElementById("status_1").checked)
//            {
//                dieu_kien = document.getElementById("status_1").value;
//            }
//            else if (document.getElementById("status_2").checked)
//            {
//                dieu_kien = document.getElementById("status_2").value;
//            }
            var tu_sothuly =null,
//                den_sothuly =null,
                ngay_tiep_tu = null,
                    ngay_tiep_den =null,
                    phanloai = null,
                    giatri_pl = null,
                    chon_dk = null,
                    reg = null,
                    gia_tri = null;
             tu_sothuly =document.getElementById("sothuly_tu").value;
//             den_sothuly =document.getElementById("sothuly_den").value;
             ngay_tiep_tu =document.getElementById("ngaytiep_tu").value;
             ngay_tiep_den =document.getElementById("ngaytiep_den").value;
             phanloai = ['loaihinh','linhvuc','diaban'];
             giatri_pl = [document.getElementById("loaihinh").value,document.getElementById("linh_vuc").value,document.getElementById("dia_ban").value];
             chon_dk =[document.getElementById("chondk1").value,document.getElementById("chondk2").value,
                document.getElementById("chondk3").value,document.getElementById("chondk4").value];
             reg = ['REGEXP','REGEXP','REGEXP','REGEXP'];
             gia_tri =[document.getElementById("dk1").value,document.getElementById("dk2").value
                ,document.getElementById("dk3").value,document.getElementById("dk4").value];
            //get data
            $.ajax({
                type: 'get',
                url: '{{URL::to('tracuulichtiepdan')}}',
                data: {
                   // dieukien:dieu_kien,
                    sothulytu: tu_sothuly,
//                    sothulyden: den_sothuly,
                    ngaytu: ngay_tiep_tu,
                    ngayden: ngay_tiep_den,
                    loai:phanloai,
                    loaigt:giatri_pl,
                    select:chon_dk,
                    regexp:reg,
                    value:gia_tri

                },
                success: function (data) {
                    console.log(data);
                    if (data!="")
                    {

                        document.getElementById('label_co').innerText = 'Kết quả: '+data.length+' đơn';
                        document.getElementById("table").innerHTML = "";
                        for (var i = 0;i<data.length;i++)
                        {
                            if (data[i]['lichtiep']!=null)
                            {
//                                document.getElementById('danhsach').style='';
                                $('#danhsach').show();
                                ShowTable_data(data[i]);
                            }

                        }
                        //ShowTable_data(data);
                    }
                    else
                    {
                        document.getElementById('label_co').innerText = 'Không tìm thấy đơn nào!';
//                        document.getElementById("danhsach").style.display='none';
                        $('#danhsach').hide();
                    }

                }
            });
        }

        //show table data
        function ShowTable_data(result)
        {

            var url = "{{url('/noidungdanhsachtiepcongdan')}}"+'/'+result['lichtiep']['tiepdanid'];
            $(function(){
                $('#table').append('<tr>'+
                        '<td>'+'<a href="'+url+'">'+ result['lichtiep']['sothuly']+'</a>'+'</td>'+
                        '<td>'+result['lichtiep']['lanhdao'] +'</td>'+
                        '<td>'+result['lichtiep']['congdan'] +'</td>'+
                        '<td>'+ result['lichtiep']['ngaytiep']+'</td>'+
                        '<td>'+ result['tenlinhvuc']+'</td>'+
                        '<td>'+ result['lichtiep']['noidung']+'</td>'+
                        '</tr>'
                );
            });

        }
        //
        $('#sothuly_tu').bind('keydown', function (event) {
            switch (event.keyCode) {
                case 8:  // Backspace
                case 9:  // Tab
                case 13: // Enter
                case 37: // Left
                case 38: // Up
                case 39: // Right
                case 40: // Down
                    break;
                default:
                    var regex = new RegExp("^[0-9]+$");
                    var key = event.key;
                    if (!regex.test(key)) {
                        event.preventDefault();
                        return false;
                    }
                    break;
            }
        });
    </script>
@endsection
