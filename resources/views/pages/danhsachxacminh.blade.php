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
        <div class="panel panel-default">
            <div class="panel-heading text-center">DANH SÁCH ĐƠN XÁC MINH</div>
            <div class="row" style="margin: 10px 0;">
                <div class="col-xs-8">
                </div>
                <div class="col-xs-4">
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon">Trạng thái</span>
                        <select class="form-control" id="TTXL" onchange="ChangeStatus()">
                            <option value="1">Đã xác minh</option>
                            <option value="0" selected="selected">Chưa xác minh</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-left: 10px;padding-bottom: 10px;" id="viewTable">
            </div>
            <div class="panel-body text-center">
                <ul class="pagination">
                    <li>
                        <span>Trang1/1</span>
                    </li>
                    <li>
                        <a onclick="NextPage('prevall')" > << </a>
                    </li>
                    <li>
                        <a onclick="NextPage('prev')" > < </a>
                    </li>
                    <li class="active">
                        <span>1</span>
                    </li>
                    <li>
                        <a onclick="NextPage('next')" > > </a>
                    </li>
                    <li>
                        <a onclick="NextPage('nextall')" > >> </a>
                    </li>
                    <li>
                        <p style="margin-left: 15px;display: inline">HIển thị:
                            <select class="form-control" style="width: auto;display: inline;" onchange="ChangeViewBy()" id="selectView">
                                <option value="5">5</option>
                                <option value="10" selected="selected">10</option>
                                <option value="25" >25</option>
                                <option value="50" >50</option>
                            </select>
                            dòng
                        </p>
                    </li>
                </ul>
            </div>
        </div>

    </div>

    <script>
        var next = 0;
        var nextall = 1;
        var prev = 2;
        var prevall = 3;


        var status = 0;
        var viewBy = 10;
        var lasttable = 0;
        var actionpage = next;
        getdata();

        function ChangeStatus()
        {
            var selectBox = document.getElementById("TTXL");
            status = selectBox.options[selectBox.selectedIndex].value;
            getdata();
            //alert(status);
        }

        function ChangeViewBy()
        {
            var selectBox = document.getElementById("selectView");
            viewBy = selectBox.options[selectBox.selectedIndex].value;
            //alert(viewBy);
        }

        function NextPage(action)
        {
            switch (action)
            {
                case 'prevall':
                    lasttable = 0;
                    actionpage = prevall;
                    getdata();
                    break;
                case 'prev':
                    actionpage = prev;
                    if(lasttable > 0)
                    {
                        getdata();
                    }
                    break;
                case 'next':
                    actionpage = next;
                    getdata();
                    break;
                case 'nextall':
                    actionpage = nextall;
                    getdata();
                    break;
            }

        }

        function getdata()
        {
            $.ajax({
                type: 'get',
                url: '{{URL::to('getdanhsachdonthuxacminh')}}',
                data: {
                    trangthai: status,
                    viewby: viewBy,
                    lasttable: lasttable,
                    action:actionpage
                },
                success: function (data) {
                    var obj = data.arraydata;
                    $("#viewTable").html("");
                    if(obj != null) {
                        for (var count = 0; count < obj.length; count++) {
                            var str = obj[count]['sothuly'].split("/");
                            if(str.length ==2) {
                                str = str[0] + '-' + str[1];
                            }
                            else
                            {
                                str = "";
                            }
                            drawtable(str, obj[count]);
                        }
                    }
                }
            });
        }

        function drawtable(id, object)
        {
            if(status == 0)
            {
                object['ngayketthucxacminh'] = 'Chưa Xác Định';
            }

            var new_noidungdonthu = '';
            if(object['noidungdonthu'].length > 150){

                new_noidungdonthu = object['noidungdonthu'].substr(0,150)+'...';
            }else {
                new_noidungdonthu = object['noidungdonthu'];
            }

            $("#viewTable").append(
                    '<div class="col-xs-6" style="padding-left: 0px;">' +
                        '<a href="{{url('/chitietxacminhdonthu')}}'+'/'+id+'" class="donthuitem" style="height: 270px">' +
                            '<table class="table" >'+
                                '<tbody>'+
                                    '<tr>'+
                                        '<td class="col-xs-3 text-bold" style="border-top: 0;"> Người viết đơn </td>' +
                                        '<td  style="border-top: 0;" colspan="3">'+ object['nguoiviet'] +'</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td class="text-bold">Địa chỉ</td>'+
                                        '<td colspan="3">'+object['diachi']+'</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td class="text-bold">Ngày gửi</td>'+
                                        '<td >'+ object['ngaygui']+'</td>'+
                                        '<td class="text-bold"> Ngày hoàn thành</td>'+
                                        '<td > '+object['ngayketthucxacminh']+'</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td class="text-bold">Ngày bắt đầu</td>'+
                                        '<td >'+object['ngaybatdau']+'</td>'+
                                        '<td class="text-bold"> Ngày kết thúc</td>'+
                                        '<td >'+object['ngayketthuc']+'</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td class="text-bold">Nội dung ĐT</td>'+
                                        '<td colspan="3">'+new_noidungdonthu+'</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td class="text-bold">Nội dung giao xác minh</td>'+
                                        '<td colspan="3">'+object['noidungxacminh']+'</td>'+
                                    '</tr>'+
                                '</tbody>'+
                            '</table>'+
                        '</a>'+
                    '</div>');
        }

    </script>

@endsection
