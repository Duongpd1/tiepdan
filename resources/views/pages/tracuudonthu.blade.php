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
    <link rel="stylesheet" href="{{url('/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{url('/css/complete.css')}}">
@endsection
@section('js')
    <script type="text/javascript" src="{{url('/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/jquery.autocomplete.min.js')}}"></script>
@endsection
@section('content')

    <div class="col-background" id="" style="margin-bottom: 100px;">
        <div class="panel panel-default panel-min-height">

            <div class="panel-heading text-center">Tra cứu</div>
            <div class="panel-body">
                <div class="form-horizontal">
                    <div class="form-group form-group-sm">
                        <label class="control-label col-xs-2">Tên chủ đơn</label>
                        <div class="col-xs-3">
                            <input id="tenChuDon" class="form-control input_complete" name="tennguoivietdon" type="text">
                        </div>
                        <label class="control-label col-xs-2">Địa chỉ</label>
                        <div class="col-xs-5">
                            <input id="diachi" class="form-control input_complete" name="diachi" type="text">
                        </div>

                    </div>

                    <div class="form-group form-group-sm">
                        <label class="control-label col-xs-2">CMND/Hộ chiếu</label>
                        <div class="col-xs-3">
                            <input id="cmt" class="form-control input_complete" name="cmt" min="1" type="text">
                        </div>
                        <label class="control-label col-xs-2">Nội dung</label>
                        <div class="col-xs-5">
                            <input id="noidung" class="form-control input_complete" name="noidung" type="text">
                        </div>

                    </div>

                    <div class="form-group form-group-sm">
                        <label class="control-label col-xs-2">Số điện thoại</label>
                        <div class="col-xs-3">
                            <input id="sdtID" class="form-control input_complete" name="sdt"  min="1" type="number">
                        </div>
                        <label class="control-label col-xs-2">Địa bàn</label>
                        <div class="col-xs-5">
                            <input type="text" name="diaban" id="Diaban" class="input_complete form-control"/>
                        </div>

                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-xs-2">Danh mục (CSDL quốc gia)</label>
                        <div class="col-xs-3">
                            <select id="csdlQGId" class="form-control" onchange="loaiDMType()">
                                <option value="0">------- Chọn kiểu tra cứu ------</option>
                                <option value="{{\App\Services\CSDLQGService::TRA_DANH_MUC}}">Danh mục</option>
                                <option value="{{\App\Services\CSDLQGService::TRA_TT_DON}}">Thông Tin Đơn</option>
                            </select>
                        </div>

                        <label class="control-label col-xs-2 " id="lbLoaiDM" style="display: none">Loại danh mục</label>
                        <div class="col-xs-5" id="dvLoaiDm" style="display: none">
                            <select class="form-control" id="loaiDMId">
                                @foreach(\App\Services\CSDLQGService::$arrLoaiDanhMuc as $key => $val)
                                    <option value="{{$key}}">{{$val}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-group form-group-sm">
                        {{--<div class="col-xs-8 col-xs-offset-1">--}}
                            {{--<input id="inputTimKiemId" class="form-control input_complete" name="inputTimKiem" type="text" placeholder="tìm theo : tên người viết đơn, số thụ lý, địa chỉ người viết, nội dung đơn, địa bàn, CMND" onchange="Finding();">--}}
                        {{--</div>--}}
                        <div class="col-xs-12" style="text-align: center">
                            {{--<button class="btn btn-sm btn-success" type="button" id="btnSearch" onclick="Finding();" title="Tìm"><span class="glyphicon glyphicon-search"></span>Tìm</button>--}}
                            <button class="btn btn-sm btn-success" type="button" id="btnSearch" onclick="filterDonthu();" title="Tìm" ><span class="glyphicon glyphicon-search"></span>Tìm</button>
                            <button class="btn btn-sm btn-info" type="button" id="btnSearchCSDL" onclick="traCuuCSDL();" title="Tìm" > <span class="glyphicon glyphicon-search"></span>Tìm trên CSDL quốc gia</button>
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <div class=" col-xs-offset-5">
                            <label id="ketqua" class="control-label col-xs-5 text-danger" style="text-align: left;">

                            </label>
                        </div>

                    </div>

                </div>
            </div>

            <div id="dataCSDL" style="display: none">

            </div>

            <table id="danhsach" class="table table-bordered table-hover" style="display: none;width: 100%">
                <thead>
                {{--<tr>--}}
                    {{--<th>No.</th>--}}
                    {{--<th>Số thụ lý</th>--}}
                    {{--<th>Người viết đơn</th>--}}
                    {{--<th>Địa chỉ</th>--}}
                    {{--<th>Nội dung</th>--}}

                {{--</tr>--}}

                <tr>
                    <th>STT</th>
                    <th>Số thụ lý</th>
                    <th>Nội dung</th>
                    <th>Người cập nhật</th>
                    <th>Ngày nhận </th>
                    <th>Cán bộ xử lý</th>
                    <th>Hạn xử lý </th>
                    <th>Thời gian xử lý còn lại </th>
                    <th>Trạng thái </th>
                </tr>

                </thead>
                <tbody id="table">


                </tbody>
            </table>



        </div>
    </div>
    <script>

        var THULY =1;
        var TRADON =2;
        var CHUYENDON =3;

        var tenChuDon = <?php echo json_encode($tenchudon);?>;
        var noiDung = <?php echo json_encode($noidung);?>;
        var cmt = <?php echo json_encode($cmt);?>;
        var diaChi = <?php echo json_encode($diachi);?>;
        var soDT = <?php echo json_encode($sdt);?>;

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
                var value = $('#DK' + numPanel);
                dk.val(null);
                value.val(null);
                panel.hide();
                numPanel--;
            }
        }
        //ngay
        $( function() {
            $( "#ngayvalue1" ).datepicker({format: 'yyyy-mm-dd'});
            $( "#ngayvalue2" ).datepicker({format: 'yyyy-mm-dd'});

        } );

        //check
        function validateTwoDates() {
            var dateStart = $("#ngayvalue1").val();
            var dateEnd = $("#ngayvalue2").val();
            return(dateEnd >= dateStart);
        }


        function test(){
            if (! validateTwoDates()) {
                alert('Ngày nhận đơn phải lớn hơn ngày viết đơn!');
                document.getElementById("ngayvalue2").value = "";
            }
        }



        //click finding
        function Finding()
        {
            // bien

            //so thu ly
            var valueTimKiem =$('#inputTimKiemId').val();
            //get data
            $.ajax({
                type: 'get',
                url: '{{URL::to('tracuu_donthu')}}',
                data: {
                    value:valueTimKiem
                },
                success: function (data) {

                    if (data!="")
                    {

                        document.getElementById("table").innerHTML = "";
                        $('#danhsach').show();

                        for (var j = 0;j<data['don'].length;j++)
                        {

                            var donthuId = data['don'][j]['donthuid'];
                            ShowTable_data(data['don'][j],donthuId);

                        }

                        //tiep dan
                        for (var ii = 0;ii<data['tiepdan'].length;ii++){
                            var tiepDanId = data['tiepdan'][ii]['tiepdanid'];
                            ShowTiepDan(data['tiepdan'][ii],tiepDanId);
                        }

                        var tong = data['don'].length+data['tiepdan'].length;



                        document.getElementById('ketqua').innerText = 'Có '+tong+' đơn tìm được' ;


                    }
                    else
                    {
                        document.getElementById('ketqua').innerText = 'Không tìm thấy đơn nào!';
                        $('#danhsach').hide();
                    }



                }
            });
        }

        function filterDonthu()
        {
            // bien

            //so thu ly
            var valueTimKiem =$('#inputTimKiemId').val();
            //get data
            $.ajax({
                type: 'post',
                url: '{{URL::to('tracuu_donthu')}}',
                data: {
                    tenChuDon:$('#tenChuDon').val(),
                    cmt:$('#cmt').val(),
                    sdtID:$('#sdtID').val(),
                    diachi:$('#diachi').val(),
                    noidung:$('#noidung').val(),
                    tenChuDon:$('#tenChuDon').val(),
                    Diaban:$('#Diaban').val(),
                },
                success: function (data) {

                    console.log(data);

                    if (data!="")
                    {

                        document.getElementById("table").innerHTML = "";
                        $('#danhsach').show();

                        for (var j = 0;j<data['don'].length;j++)
                        {
                            ShowTable2_data(data['don'][j], j+1);
                        }

                        var tong = data['don'].length;

                        document.getElementById('ketqua').innerText = 'Có '+tong+' đơn tìm được' ;

                    }
                    else
                    {
                        document.getElementById('ketqua').innerText = 'Không tìm thấy đơn nào!';
                        $('#danhsach').hide();
                    }



                }
            });
        }

        //show table data
        function ShowTable_data(result,donthuid)
        {
            var huongXuLy = "";
            if (result['huonggiaiquyet'] == THULY)
            {
                huongXuLy = "Thụ lý";
            }
            else if(result['huonggiaiquyet'] == TRADON){
                huongXuLy = "Trả đơn";
            }
            else {
                huongXuLy = "Chuyển đơn";
            }

            var url = "{{url('/chitietdonthu')}}"+'/'+donthuid;
            $(function(){
                $('#table').append(
                    '<tr>'+
                    '<td >'+'<a href="'+url+'">'+result['sothuly']+'</a>'+'</td>'+
                    '<td>'+result['tennguoivietdon'] +'</td>'+
                    '<td>'+ result['diachinguoiviet']+'</td>'+
                    '<td>'+ result['noidung']+'</td>'+
                    '</tr>'
                );
            });

        }

        //show table data
        function ShowTable2_data(result, stt)
        {
            var url = "{{url('/chitietdonthu')}}"+'/'+result['donthuid'];
            var timeConLai = result['ngay_con_lai_view']['day'] + 'day';

            if(result['ngay_con_lai_view']['type'])
            {
                timeConLai = 'quá hạn';
            }

            var trangThaiXuly = 'chờ xử lý';

            if(result['trangthaixuly'] == {{DANGXULY}})
            {
                trangThaiXuly = 'đang xử lý';
            }
            if(result['trangthaixuly'] == {{DAGIAIQUYET}})
            {
                trangThaiXuly = 'đã giải quyết';
            }

            $(function(){
                $('#table').append(
                    '<tr>'+
                        '<td>'+ stt +'</td>'+
                        '<td >'+'<a href="'+url+'">'+result['sothuly']+'</a>'+'</td>'+
                        '<td>'+result['noidung'] +'</td>'+
                        '<td></td>'+
                        '<td>'+ result['ngay_nhan_view']+'</td>'+
                        '<td></td>'+
                        '<td>'+ result['han_xu_ly_view']+'</td>'+
                        '<td>'+ timeConLai +'</td>'+
                        '<td>'+ trangThaiXuly +'</td>'+
                    '</tr>'
                );
            });

        }

        //tiep dan
        function ShowTiepDan(tiepDan,tiepDanId)
        {
            var tiepURL = "{{url('noidungdanhsachtiepcongdan')}}"+'/'+tiepDanId;
            $(function(){
                $('#table').append(
                    '<tr>'+
                    '<td >'+'<a href="'+tiepURL+'">'+tiepDan['sothuly']+'</a>'+'</td>'+
                    '<td>'+tiepDan['congdan'] +'</td>'+
                    '<td>'+ tiepDan['diachi']+'</td>'+
                    '<td>'+ tiepDan['noidung']+'</td>'+
                    '</tr>'
                );
            });
        }

        $(document).ready(function(){

            var table = $('#danhsach').DataTable({
                "bPaginate":      false,
                "bFilter":        false,
                "info":           false,
                "ordering":       false,
                "paging":         false,
                "columnDefs": [
                    { "width": "5%", "targets": 0 },
                    { "width": "30%", "targets": 1 },
                    { "width": "20%", "targets": 1 },
                    { "width": "45%", "targets": 1 },
                ],
                "scrollCollapse": true,
                dom : 'l<"#add">frtip'
            });

        });


        //
        var tenChuDon = <?php echo json_encode($tenchudon)?>;
        var diaChi = <?php echo json_encode($diachi)?>;
        var noiDung = <?php echo json_encode($noidung)?>;
        var diaBan = <?php echo json_encode($diaBan)?>;

        $('#tenChuDon').autocomplete({
            lookup: tenChuDon,
        });

        $('#diachi').autocomplete({
            lookup: diaChi,
        });

        $('#noidung').autocomplete({
            lookup: noiDung,
        });

        $('#Diaban').autocomplete({
            lookup: diaBan,
        });
        
        function loaiDMType() {
            $valLoai = $('#csdlQGId').val();

            if($valLoai == 1){
                AnHienPanel('#dvLoaiDm',true);
                AnHienPanel('#lbLoaiDM',true);
            }else {
                AnHienPanel('#dvLoaiDm',false);
                AnHienPanel('#lbLoaiDM',false);
            }
        }

        function traCuuCSDL() {
            $.ajax({
                type: 'post',
                url: '{{URL::to('tracuu_csdlqg')}}',
                data: {
                    tenChuDon:$('#tenChuDon').val(),
                    cmt:$('#cmt').val(),
                    noidung:$('#noidung').val(),
                    danhmuc:$('#csdlQGId').val(),
                    loaiDM:$('#loaiDMId').val()

                },
                success: function (data) {
                    if (data!="")
                    {
                        AnHienPanel('#dataCSDL',true);
                        $('#dataCSDL').html('');
                        $('#dataCSDL').append(data);
                    }
                    else
                    {
                        AnHienPanel('#dataCSDL',false);
                        $('#dataCSDL').html('');

                    }



                }
            });
        }

    </script>
@endsection
