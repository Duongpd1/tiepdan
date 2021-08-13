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
        var element1 = document.getElementById("donvi");
        element1.classList.add("active");
        var element = document.getElementById("htab-danhmuc");
        element.classList.add("active");
        element.classList.add("in");

    </script>

    <link rel="stylesheet" type="text/css" href="{{url('/css/jquery.treeview.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/treestyle.css')}}">

    <script src="{{url('/js/jquery.cookie.js')}}"></script>
    <script src="{{url('/js/jquery.treeview.js')}}"></script>
    <script src="{{url('/js/demo.js')}}"></script>

    <?php
    function createTreeView($array, $currentParent){

        $currLevel = 0;
        $prevLevel = -1;
        foreach ($array as $categoryId => $category){
            if ($currentParent == $category['tructhuoc']){
                if ($currLevel > $prevLevel){

                    echo " <ol class='tree'>";
                }

                if ($currLevel == $prevLevel){

                    echo " </li> ";
                }

                echo '<li> <label for="donvi"><a id="'.$category['id'].'" onclick="thongtindonvi(this.id)">'.$category['tendonvi'].'</a></label><input id="donvi" type="checkbox" />';

                if ($currLevel > $prevLevel){

                    $prevLevel = $currLevel;
                }
                $currLevel++;
                createTreeView ($array, $category['id']);
                $currLevel--;


            }
        }

        if ($currLevel == $prevLevel){

            echo "</li></ol>";
        }

    }

    $arrayCategorie = array();
    if(count($getdonvi)==0){
        echo "Not found Database";
    }else{
        $var = 0;
        while($var < count($getdonvi)){
            $arrayCategorie[$var+1]['tendonvi'] = $getdonvi[$var]->tendonvi;
            $arrayCategorie[$var+1]['tructhuoc'] = $getdonvi[$var]->tructhuoc;
            $arrayCategorie[$var+1]['id'] = $getdonvi[$var]->id;
            $var++;
        }
    }
    $quyenXoa = Session::get('quyenXoa');
    ?>

    <div class="container-fluid" style="margin-bottom: 40px; padding: 10px 15px">
        <div class="col-background">
            <div class="panel panel-default panel-min-height">
                <div class="panel-heading text-center">QUẢN TRỊ DANH MỤC ĐƠN VỊ</div>
                <div id="bangdanhmucdonvi" class="panel-body">
                    <div class="col-xs-4">
                        <div id="listdonvi" style="overflow-y: auto; height: 380px; border: 1px solid #ccc">
                            <?php createTreeView($arrayCategorie, 0); ?>
                        </div>
                        <div style="margin: 5px 0">
                            <button onclick="themdonvimoi()" class="btn btn-sm btn-success">
                                <span class="glyphicon glyphicon-plus"></span>
                                Thêm
                            </button>
                        </div>
                    </div>
                    <div class="col-xs-8" id="chitietdonvi">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Thêm mới đơn vị
                            </div>
                            <form role="form" id="themdonvi" method="post" action="themdonvi" enctype="multipart/form-data">
                                <div class="panel-body form-horizontal">
                                    <div class="form-group form-group-sm">
                                        <label for="tructhuocdisplay" class="control-label col-xs-4">Tên đơn vị trực thuộc:</label>
                                        <div class="col-xs-8">
                                            <input name="tructhuocdisplay" type="text" maxlength="50" id="tructhuocdisplay" class="form-control" value="Danh mục đơn vị" readonly/>
                                            <input name="tructhuoc" type="hidden" maxlength="50" id="tructhuoc" class="form-control" value="1"/>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="tructhuocdisplay" class="control-label col-xs-4">Tên địa bàn trực thuộc:</label>
                                        <div class="col-xs-8">
                                            <select name="diabantructhuoc" id="diabantructhuoc" class="form-control" >
                                                @for($i = 0; $i<count($getdiaban);$i++)
                                                    @if($getdiaban[$i]->tructhuoc != 0)
                                                        <option value="{{$getdiaban[$i]->id}}">{{$getdiaban[$i]->tendiaban}}</option>
                                                    @endif
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="tendonvi" class="control-label col-xs-4">Tên đơn vị <span class="text-danger">(*)</span>:</label>
                                        <div class="col-xs-8">
                                            <input name="tendonvi" type="text" maxlength="50" id="tendonvi" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="viettat" class="control-label col-xs-4">Viết tắt <span class="text-danger">(*)</span>:</label>
                                        <div class="col-xs-8">
                                            <input name="viettat" type="text" maxlength="10" id="viettat" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="thutu" class="control-label col-xs-4">Thứ tự <span class="text-danger">(*)</span>:</label>
                                        <div class="col-xs-8">
                                            <input name="thutu" type="text" value="{{$maxthutudonvi+1}}" id="thutu" class="form-control numberonly" required/>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="nguoidaidien" class="control-label col-xs-4">Người đại diện <span class="text-danger">(*)</span>:</label>
                                        <div class="col-xs-8">
                                            <select name="nguoidaidien" id="nguoidaidien" class="form-control">
                                                <option value="0">---------- Chọn người đại diện ----------</option>
                                            @foreach($nguoidaidien as $daidien)
                                                <option value="{{$daidien->accountid}}">{{$daidien->fullname}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="diachi" class="control-label col-xs-4">Địa chỉ <span class="text-danger">(*)</span>:</label>
                                        <div class="col-xs-8">
                                            <input name="diachi" type="text" maxlength="256" id="diachi" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="dienthoai" class="control-label col-xs-4">Điện thoại <span class="text-danger">(*)</span>:</label>
                                        <div class="col-xs-8">
                                            <input name="dienthoai" type="text" maxlength="20" id="dienthoai" class="form-control numberonly" required/>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="madonvi" class="control-label col-xs-4">Max hành chính (theo CSDLQG) <span class="text-danger">(*)</span>:</label>
                                        <div class="col-xs-8">
                                            <input name="madonvi" type="text" id="madonvi" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="fax" class="control-label col-xs-4">Fax:</label>
                                        <div class="col-xs-8">
                                            <input name="fax" type="text" maxlength="20" id="fax" class="form-control numberonly" />
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="email" class="control-label col-xs-4">Email:</label>
                                        <div class="col-xs-8">
                                            <input name="email" type="email" maxlength="50" id="email" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="website" class="control-label col-xs-4">Website:</label>
                                        <div class="col-xs-8">
                                            <input name="website" type="text" maxlength="256" id="website" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label class="control-label col-xs-4">Trạng thái:</label>
                                        <div class="col-xs-8">
                                            <div class="radio radio-primary">
                                                <span style="display:inline-block;width:20%;">
                                                    <input id="sudung" type="radio" name="trangthai" value="1" checked="checked" /><label for="sudung">Sử dụng</label>
                                                </span>
                                                <input id="khongsudung" type="radio" name="trangthai" value="0" /><label for="khongsudung">Không sử dụng</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <div class="col-xs-8 col-xs-offset-4">
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <span class="glyphicon glyphicon-saved"></span>
                                                Lưu
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        var currentdonvi = 1;
        function themdonvimoi(){

            $.ajax({
                type: 'post',
                dataType: 'json',
                url:  '{{URL::to('getthongtindonvitheoid')}}',
                data: {
                    donviid: currentdonvi
                },
                success: function (response) {

                    var tendonvitructhuoc = response['thongtindonvi_result'][0]['tendonvi'];
                    var nguoidaidien = response['nguoidaidien_result'];
                    var thutu = response['maxthutu_result']+1;

                    var formdonvitructhuoc = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="tructhuocdisplay" class="control-label col-xs-4">Tên đơn vị trực thuộc:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="tructhuocdisplay" type="text" maxlength="50" id="tructhuocdisplay" class="form-control" value="'+tendonvitructhuoc+'" readonly/>' +
                            '<input name="tructhuoc" type="hidden" maxlength="50" value="'+currentdonvi+'" id="tructhuoc" class="form-control"/>' +
                            '</div>' +
                            '</div>'+
                            '';

                    var formdonvi = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="tendonvi" class="control-label col-xs-4">Tên đơn vị <span class="text-danger">(*)</span>:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="tendonvi" type="text" maxlength="50" id="tendonvi" class="form-control" required/>' +
                            '</div>' +
                            '</div>';

                    var formviettat = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="viettat" class="control-label col-xs-4">Viết tắt <span class="text-danger">(*)</span>:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="viettat" type="text" maxlength="10" id="viettat" class="form-control" required/>' +
                            '</div>' +
                            '</div>'+
                            '';

                    var formthutu = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="thutu" class="control-label col-xs-4">Thứ tự <span class="text-danger">(*)</span>:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="thutu" type="text" value="'+thutu+'" id="thutu" class="form-control numberonly" required/>' +
                            '</div>' +
                            '</div>' +
                            '';
                    var selectnguoidaidien = '';
                    for(var i = 0;i<nguoidaidien.length;i++){

                        var tennguoidaidien = nguoidaidien[i]['fullname'];
                        var valuenguoidaidien = nguoidaidien[i]['accountid'];
                        selectnguoidaidien +='<option value="'+valuenguoidaidien+'">'+tennguoidaidien+'</option>';
                    }
                    var formnguoidaidien = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="nguoidaidien" class="control-label col-xs-4">Người đại diện <span class="text-danger">(*)</span>:</label>' +
                            '<div class="col-xs-8">' +
                            '<select name="nguoidaidien" id="nguoidaidien" class="form-control">' +
                            '<option value="0">---------- Chọn người đại diện ----------</option>' +
                            selectnguoidaidien +
                            '</select>' +
                            '</div>' +
                            '</div>'+
                            '';
                    var formdiachi = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="diachi" class="control-label col-xs-4">Địa chỉ <span class="text-danger">(*)</span>:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="diachi" type="text" id="diachi" class="form-control" required/>' +
                            '</div>' +
                            '</div>'+
                            '';
                    var formdienthoai = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="dienthoai" class="control-label col-xs-4">Điện thoại <span class="text-danger">(*)</span>:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="dienthoai" type="text" id="dienthoai" class="form-control" required/>' +
                            '</div>' +
                            '</div>'+
                            '';
                    var formmadonvi = '' +
                        '<div class="form-group form-group-sm">' +
                        '<label for="madonvi" class="control-label col-xs-4">Max hành chính (theo CSDLQG) <span class="text-danger">(*)</span>:</label>' +
                        '<div class="col-xs-8">' +
                        '<input name="madonvi" type="text" id="madonvi" class="form-control" required/>' +
                        '</div>' +
                        '</div>'+
                        '';
                    var formfax = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="fax" class="control-label col-xs-4">Fax:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="fax" type="text" id="fax" class="form-control" />' +
                            '</div>' +
                            '</div>'+
                            '';
                    var formemail = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="email" class="control-label col-xs-4">Email:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="email" type="email" id="email" class="form-control"/>' +
                            '</div>' +
                            '</div>'+
                            '';
                    var formwebsite = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="website" class="control-label col-xs-4">Website:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="website" type="text" id="website" class="form-control"/>' +
                            '</div>' +
                            '</div>'+
                            '';
                    var formtrangthai = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label class="control-label col-xs-4">Trạng thái:</label>' +
                            '<div class="col-xs-8">'+
                            '<div class="radio radio-primary">'+
                            '<span style="display:inline-block;width:20%;">'+
                            '<input id="sudung" type="radio" name="trangthai" value="1" checked="checked" /><label for="sudung">Sử dụng</label>'+
                            '</span>'+
                            '<input id="khongsudung" type="radio" name="trangthai" value="0" /><label for="khongsudung">Không sử dụng</label>'+
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '';
                    var formbutton = '' +
                            '<div class="form-group form-group-sm">'+
                            '<div class="col-xs-8 col-xs-offset-4">'+
                            '<button type="submit" class="btn btn-sm btn-success">'+
                            '<span class="glyphicon glyphicon-saved"></span>&nbsp;Lưu'+
                            '</div>'+
                            '</div>' +
                            '';

                    document.getElementById("chitietdonvi").innerHTML = '';
                    document.getElementById("chitietdonvi").innerHTML = '' +
                            '<div class="panel panel-default">' +
                                '<div class="panel-heading">Thêm mới đơn vị' +
                                '</div>' +
                                '<form role="form" id="themdonvi" method="post" action="themdonvi" enctype="multipart/form-data">' +
                                    '<div class="panel-body form-horizontal">' +
                                        formdonvitructhuoc +
                                        formdonvi +
                                        formviettat +
                                        formthutu +
                                        formnguoidaidien +
                                        formdiachi +
                                        formdienthoai +
                                        formmadonvi +
                                        formfax +
                                        formemail +
                                        formwebsite +
                                        formtrangthai +
                                        formbutton +
                                    '</div>' +
                                '</form>' +
                            '</div>';
                }
            });
        }

        function thongtindonvi(id){
            currentdonvi = id;
            if(id >1){

                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url:  '{{URL::to('getthongtindonvitheoid')}}',
                    data: {
                        donviid: id
                    },
                    success: function (response) {

                        var tendonvi = response['thongtindonvi_result'][0]['tendonvi'];
                        var tructhuoc = response['thongtindonvi_result'][0]['tructhuoc'];
                        var tentructhuoc = response['tendonvitructhuoc_result'];
                        var diabantructhuoc = response['thongtindonvi_result'][0]['diaban'];
                        var tendiabantructhuoc = response['tendiabantructhuoc_result'];
                        var thutu = response['thongtindonvi_result'][0]['thutu'];
                        var viettat = response['thongtindonvi_result'][0]['viettat'];
                        var tennguoidaidien = response['tennguoidaidien_result'];
                        var diachi = response['thongtindonvi_result'][0]['diachi'];
                        var dienthoai = response['thongtindonvi_result'][0]['dienthoai'];
                        var fax = response['thongtindonvi_result'][0]['fax'];
                        var email = response['thongtindonvi_result'][0]['email'];
                        var website = response['thongtindonvi_result'][0]['website'];
                        var trangthai = response['thongtindonvi_result'][0]['trangthai'];
                        var madonvi = response['thongtindonvi_result'][0]['madonvi'];
                        var noidungtrangthai = '';
                        if(trangthai == 1){
                            noidungtrangthai = '' +
                                    '<input type="text" value="Sử dụng" class="form-control" readonly>';

                        }else {
                            noidungtrangthai = '' +
                                    '<input type="text" value="Không sử dụng" class="form-control" readonly>';

                        }

                        var formdonvitructhuoc = '' +
                                '<div class="form-group form-group-sm">' +
                                    '<label for="tructhuoc" class="control-label col-xs-4">Tên đơn vị trực thuộc:</label>' +
                                    '<div class="col-xs-8">' +
                                        '<input name="tructhuoc" type="text" maxlength="50" id="tructhuoc" class="form-control" value="'+tentructhuoc+'" readonly/>' +
                                    '</div>' +
                                '</div>'+
                                '';

                        var formdiabantructhuoc = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="tructhuoc" class="control-label col-xs-4">Tên địa bàn trực thuộc:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="diabantructhuoc" type="text" maxlength="50" id="diabantructhuoc" class="form-control" value="'+tendiabantructhuoc+'" readonly/>' +
                            '</div>' +
                            '</div>'+
                            '';

                        var formdonvi = '' +
                                '<div class="form-group form-group-sm">' +
                                    '<label for="tendonvi" class="control-label col-xs-4">Tên đơn vị:</label>' +
                                    '<div class="col-xs-8">' +
                                        '<input name="tendonvi" type="text" maxlength="50" id="tendonvi" class="form-control" value="'+tendonvi+'" readonly/>' +
                                    '</div>' +
                                '</div>';

                        var formviettat = '' +
                                '<div class="form-group form-group-sm">' +
                                    '<label for="viettat" class="control-label col-xs-4">Viết tắt:</label>' +
                                    '<div class="col-xs-8">' +
                                        '<input name="viettat" type="text" maxlength="10" id="viettat" class="form-control" value="'+viettat+'" readonly/>' +
                                    '</div>' +
                                '</div>'+
                                '';

                        var formthutu = '' +
                                '<div class="form-group form-group-sm">' +
                                    '<label for="thutu" class="control-label col-xs-4">Thứ tự:</label>' +
                                    '<div class="col-xs-8">' +
                                        '<input name="thutu" type="text" value="'+thutu+'" id="thutu" class="form-control numberonly" readonly/>' +
                                    '</div>' +
                                '</div>' +
                                '';

                        var formnguoidaidien = '' +
                                '<div class="form-group form-group-sm">' +
                                    '<label for="nguoidaidien" class="control-label col-xs-4">Người đại diện:</label>' +
                                    '<div class="col-xs-8">' +
                                        '<input name="nguoidaidien" type="text" value="'+tennguoidaidien+'" id="nguoidaidien" class="form-control" readonly/>' +
                                    '</div>' +
                                '</div>'+
                                '';
                        var formdiachi = '' +
                                '<div class="form-group form-group-sm">' +
                                    '<label for="diachi" class="control-label col-xs-4">Địa chỉ:</label>' +
                                    '<div class="col-xs-8">' +
                                        '<input name="diachi" type="text" value="'+diachi+'" id="diachi" class="form-control" readonly/>' +
                                    '</div>' +
                                '</div>'+
                                '';
                        var formdienthoai = '' +
                                '<div class="form-group form-group-sm">' +
                                    '<label for="dienthoai" class="control-label col-xs-4">Điện thoại:</label>' +
                                    '<div class="col-xs-8">' +
                                        '<input name="dienthoai" type="text" value="'+dienthoai+'" id="dienthoai" class="form-control" readonly/>' +
                                    '</div>' +
                                '</div>'+
                                '';
                        var formmadonvi = '' +
                            '<div class="form-group form-group-sm">' +
                                '<label for="madonvi" class="control-label col-xs-4">Max hành chính (theo CSDLQG)</label>' +
                                '<div class="col-xs-8">' +
                                    '<input name="madonvi" type="text" value="'+madonvi+'" id="madonvi" class="form-control" readonly/>' +
                                '</div>' +
                            '</div>'+
                            '';
                        var formfax = '' +
                                '<div class="form-group form-group-sm">' +
                                    '<label for="fax" class="control-label col-xs-4">Fax:</label>' +
                                    '<div class="col-xs-8">' +
                                        '<input name="fax" type="text" value="'+fax+'" id="fax" class="form-control" readonly/>' +
                                    '</div>' +
                                '</div>'+
                                '';
                        var formemail = '' +
                                '<div class="form-group form-group-sm">' +
                                    '<label for="email" class="control-label col-xs-4">Email:</label>' +
                                    '<div class="col-xs-8">' +
                                        '<input name="email" type="email" value="'+email+'" id="email" class="form-control" readonly/>' +
                                    '</div>' +
                                '</div>'+
                                '';
                        var formwebsite = '' +
                                '<div class="form-group form-group-sm">' +
                                    '<label for="website" class="control-label col-xs-4">Website:</label>' +
                                    '<div class="col-xs-8">' +
                                        '<input name="website" type="text" value="'+website+'" id="website" class="form-control" readonly/>' +
                                    '</div>' +
                                '</div>'+
                                '';
                        var formtrangthai = '' +
                                '<div class="form-group form-group-sm">' +
                                    '<label for="website" class="control-label col-xs-4">Trạng thái:</label>' +
                                    '<div class="col-xs-8">' +
                                        noidungtrangthai+
                                    '</div>' +
                                '</div>'+
                                '';
                        var formbutton = '' +
                                '<div class="form-group form-group-sm">'+
                                    '<div class="col-xs-8 col-xs-offset-4">'+
                                        '<button onclick="chinhsuadonvi(this.value)" value="'+id+'" class="btn btn-sm btn-warning">'+
                                        '<span class="glyphicon glyphicon-edit"></span>&nbsp;Sửa'+
                                        '</button>&nbsp;'+
                                        '@if(($quyenXoa & DELDANHMUC)== DELDANHMUC)'+
                                        '<button onclick="xoadonvi(this.value)"  value="'+id+'" class="btn btn-sm btn-danger">'+
                                        '<span class="glyphicon glyphicon-trash"></span>&nbsp;Xóa'+
                                        '</button>'+
                                        '@endif'+
                                    '</div>'+
                                '</div>' +
                                '';

                        document.getElementById("chitietdonvi").innerHTML = '';
                        document.getElementById("chitietdonvi").innerHTML = '' +
                            '<div class="panel panel-default">' +
                                '<div class="panel-heading">Thông tin đơn vị</div>' +
                                '<div class="panel-body form-horizontal">' +
                                    formdonvitructhuoc +
                                    formdiabantructhuoc +
                                    formdonvi +
                                    formviettat +
                                    formthutu +
                                    formnguoidaidien +
                                    formdiachi +
                                    formdienthoai +
                                    formmadonvi +
                                    formfax +
                                    formemail +
                                    formwebsite +
                                    formtrangthai +
                                    formbutton +
                                '</div>' +
                            '</div>';

                    }
                });
            }
        }

        function xoadonvi(id){

            var isok = confirm('Bạn có muốn xóa đơn vị này không ?');
            if(isok) {

                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '{{URL::to('xoadonvi')}}',
                    data: {
                        donviid: id
                    },
                    success: function (response) {
                        window.location.reload(true);
                    }
                });
            }
        }

        function chinhsuadonvi(id){
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '{{URL::to('getthongtindonvitheoid')}}',
                data: {
                    donviid: id
                },
                success: function (response) {

                    var tendonvi = response['thongtindonvi_result'][0]['tendonvi'];
                    var tructhuoc = response['thongtindonvi_result'][0]['tructhuoc'];
                    var tentructhuoc = response['tendonvitructhuoc_result'];
                    var thutu = response['thongtindonvi_result'][0]['thutu'];
                    var viettat = response['thongtindonvi_result'][0]['viettat'];
                    var nguoidaidienid = response['thongtindonvi_result'][0]['nguoidaidien'];
                    var diachi = response['thongtindonvi_result'][0]['diachi'];
                    var dienthoai = response['thongtindonvi_result'][0]['dienthoai'];
                    var fax = response['thongtindonvi_result'][0]['fax'];
                    var email = response['thongtindonvi_result'][0]['email'];
                    var website = response['thongtindonvi_result'][0]['website'];
                    var trangthai = response['thongtindonvi_result'][0]['trangthai'];
                    var madonvi = response['thongtindonvi_result'][0]['madonvi'];

                    var formdonvitructhuoc = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="tructhuocdisplay" class="control-label col-xs-4">Tên đơn vị trực thuộc:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="tructhuocdisplay" type="text" maxlength="50" id="tructhuocdisplay" class="form-control" value="'+tentructhuoc+'" readonly/>' +
                            '<input name="tructhuoc" type="hidden" maxlength="50" id="tructhuoc" class="form-control" value="'+tructhuoc+'"/>' +
                            '</div>' +
                            '</div>'+
                            '';

                    var diabantructhuoc = response['diabantructhuoc_result'];
                    var diabanselected = response['thongtindonvi_result'][0]['diaban'];
                    var selectdiaban = '';
                    for(var i = 0;i<diabantructhuoc.length;i++){

                        var tendiaban = diabantructhuoc[i]['tendiaban'];
                        var diabanid = diabantructhuoc[i]['id'];
                        if(diabanselected == diabanid){
                            selectdiaban += '<option value="' + diabanid + '" selected>' + tendiaban + '</option>';
                        }else {
                            selectdiaban += '<option value="' + diabanid + '">' + tendiaban + '</option>';
                        }
                    }
                    var bangdiaban = '';


                    bangdiaban += '' +
                        '<select name="diabantructhuoc" id="diabantructhuoc" class="form-control">' +
                        selectdiaban +
                        '</select>' +
                        '';
                    var formdiabantructhuoc = '' +
                        '<div class="form-group form-group-sm">' +
                        '<label for="diabantructhuoc" class="control-label col-xs-4">Tên địa bàn trực thuộc: </label>' +
                        '<div class="col-xs-8">' +
                        bangdiaban +
                        '</div>' +
                        '</div>'+
                        '';



                    var formdonvi = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="tendonvi" class="control-label col-xs-4">Tên đơn vị <span class="text-danger">(*)</span>:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="tendonvi" type="text" maxlength="50" id="tendonvi" class="form-control" value="'+tendonvi+'"/>' +
                            '</div>' +
                            '</div>';

                    var formviettat = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="viettat" class="control-label col-xs-4">Viết tắt <span class="text-danger">(*)</span>:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="viettat" type="text" maxlength="10" id="viettat" class="form-control" value="'+viettat+'"/>' +
                            '</div>' +
                            '</div>'+
                            '';

                    var formthutu = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="thutu" class="control-label col-xs-4">Thứ tự <span class="text-danger">(*)</span>:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="thutu" type="text" value="'+thutu+'" id="thutu" class="form-control numberonly"/>' +
                            '</div>' +
                            '</div>' +
                            '';

                    var nguoidaidien = response['nguoidaidien_result'];
                    var selectnguoidaidien = '';
                    for(var i = 0;i<nguoidaidien.length;i++){

                        var tennguoidaidien = nguoidaidien[i]['fullname'];
                        var valuenguoidaidien = nguoidaidien[i]['accountid'];
                        if(nguoidaidienid == valuenguoidaidien){
                            selectnguoidaidien += '<option value="' + valuenguoidaidien + '" selected>' + tennguoidaidien + '</option>';
                        }else {
                            selectnguoidaidien += '<option value="' + valuenguoidaidien + '">' + tennguoidaidien + '</option>';
                        }
                    }
                    var nguoidaidienselected = '';

                    if(nguoidaidienid == 0){
                        nguoidaidienselected += '' +
                                '<select name="nguoidaidien" id="nguoidaidien" class="form-control">' +
                                '<option value="0" selected>---------- Chọn người đại diện ----------</option>' +
                                selectnguoidaidien +
                                '</select>' +
                                '';
                    }else {
                        nguoidaidienselected += '' +
                                '<select name="nguoidaidien" id="nguoidaidien" class="form-control">' +
                                '<option value="0">---------- Chọn người đại diện ----------</option>' +
                                selectnguoidaidien +
                                '</select>' +
                                '';
                    }
                    var formnguoidaidien = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="nguoidaidien" class="control-label col-xs-4">Người đại diện <span class="text-danger">(*)</span>:</label>' +
                            '<div class="col-xs-8">' +
                            nguoidaidienselected +
                            '</div>' +
                            '</div>'+
                            '';
                    var formdiachi = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="diachi" class="control-label col-xs-4">Địa chỉ <span class="text-danger">(*)</span>:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="diachi" type="text" value="'+diachi+'" id="diachi" class="form-control"/>' +
                            '</div>' +
                            '</div>'+
                            '';
                    var formdienthoai = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="dienthoai" class="control-label col-xs-4">Điện thoại <span class="text-danger">(*)</span>:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="dienthoai" type="text" value="'+dienthoai+'" id="dienthoai" class="form-control"/>' +
                            '</div>' +
                            '</div>'+
                            '';
                    var formmadonvi = '' +
                        '<div class="form-group form-group-sm">' +
                            '<label for="madonvi" class="control-label col-xs-4">Max hành chính (theo CSDLQG)<span class="text-danger">(*)</span>:</label>' +
                            '<div class="col-xs-8">' +
                                '<input name="madonvi" type="text" value="'+madonvi+'" id="madonvi" class="form-control" required/>' +
                            '</div>' +
                        '</div>'+
                        '';
                    var formfax = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="fax" class="control-label col-xs-4">Fax:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="fax" type="text" value="'+fax+'" id="fax" class="form-control"/>' +
                            '</div>' +
                            '</div>'+
                            '';
                    var formemail = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="email" class="control-label col-xs-4">Email:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="email" type="email" value="'+email+'" id="email" class="form-control"/>' +
                            '</div>' +
                            '</div>'+
                            '';
                    var formwebsite = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="website" class="control-label col-xs-4">Website:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="website" type="text" value="'+website+'" id="website" class="form-control"/>' +
                            '</div>' +
                            '</div>'+
                            '';

                    var selecttrangthai = '';
                    if(trangthai == 1){
                        selecttrangthai += '' +
                                '<span style="display:inline-block;width:20%;">'+
                                '<input id="sudung" type="radio" name="trangthai" value="1" checked="checked" /><label for="sudung">Sử dụng</label>'+
                                '</span>'+
                                '<input id="khongsudung" type="radio" name="trangthai" value="0" /><label for="khongsudung">Không sử dụng</label>'+
                                '';

                    }else {
                        selecttrangthai += '' +
                                '<span style="display:inline-block;width:20%;">'+
                                '<input id="sudung" type="radio" name="trangthai" value="1" /><label for="sudung">Sử dụng</label>'+
                                '</span>'+
                                '<input id="khongsudung" type="radio" name="trangthai" value="0" checked="checked" /><label for="khongsudung">Không sử dụng</label>'+
                                '';
                    }
                    var formtrangthai = '' +
                            '<div class="form-group form-group-sm">' +
                                '<label class="control-label col-xs-4">Trạng thái:</label>' +
                                '<div class="col-xs-8">'+
                                    '<div class="radio radio-primary">'+
                                        selecttrangthai +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                            '';
                    var formbutton = '' +
                            '<div class="form-group form-group-sm">'+
                            '<div class="col-xs-8 col-xs-offset-4">'+
                            '<button type="submit" class="btn btn-sm btn-success">'+
                            '<span class="glyphicon glyphicon-save"></span>&nbsp;Lưu'+
                            '</button>&nbsp;'+
                            '<button type="button" onclick="thongtindonvi(this.value)" value="'+id+'" class="btn btn-sm btn-danger">'+
                            '<span class="glyphicon glyphicon-ban-circle"></span>&nbsp;Hủy'+
                            '</button>'+
                            '</div>'+
                            '</div>' +
                            '';

                    document.getElementById("chitietdonvi").innerHTML = '';
                    document.getElementById("chitietdonvi").innerHTML = '' +
                            '<div class="panel panel-default">' +
                                '<div class="panel-heading">Thông tin đơn vị' +
                                '</div>' +
                                '<form role="form" id="submitchinhsuadonvi" method="post" action="chinhsuadonvi/'+id+'" enctype="multipart/form-data">' +
                                    '<div class="panel-body form-horizontal">' +
                                        formdonvitructhuoc +
                                        formdiabantructhuoc +
                                        formdonvi +
                                        formviettat +
                                        formthutu +
                                        formnguoidaidien +
                                        formdiachi +
                                        formdienthoai +
                                        formmadonvi +
                                        formfax +
                                        formemail +
                                        formwebsite +
                                        formtrangthai +
                                        formbutton +
                                    '</div>' +
                                '</form>' +
                            '</div>';
                }
            });

        }
    </script>


@endsection
