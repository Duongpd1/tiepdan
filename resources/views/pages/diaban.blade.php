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
        var element1 = document.getElementById("diaban");
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
        $quyenXoa = Session::get('quyenXoa');
    ?>
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

                    $id = $category['id'];
                    $tendiaban = $category['tendiaban'];
                    echo '<li> <label for="diaban"><a id="'.$id.'" onclick="thongtindiaban(this.id)">'.$tendiaban.'</a></label><input id="diaban" type="checkbox" />';

                    if ($currLevel > $prevLevel){

                        $prevLevel = $currLevel;
                    }
                    $currLevel++;
                    createTreeView ($array, $id);
                    $currLevel--;
                }
            }
            if ($currLevel == $prevLevel){

                echo "</li></ol>";
            }

        }

        $arrayCategorie = array();
        if(count($getdiaban)==0){
            echo "Not found Database";
        }else{
            $var = 0;
            while($var < count($getdiaban)){
                $arrayCategorie[$var+1]['tendiaban'] = $getdiaban[$var]->tendiaban;
                $arrayCategorie[$var+1]['tructhuoc'] = $getdiaban[$var]->tructhuoc;
                $arrayCategorie[$var+1]['id'] = $getdiaban[$var]->id;
                $arrayCategorie[$var+1]['mahanhchinh'] = $getdiaban[$var]->mahanhchinh;
                $var++;
            }
        }
    ?>

    <div class="container-fluid" style="margin-bottom: 40px; padding: 10px 15px">
        <div class="col-background">
            <div class="panel panel-default panel-min-height">
                <div class="panel-heading text-center">QUẢN TRỊ DANH MỤC ĐỊA BÀN</div>
                <div id="bangdanhmucdiaban" class="panel-body">
                    <div class="col-xs-4">
                        <div id="listdiaban" style="overflow-y: auto; height: 380px; border: 1px solid #ccc">
                            <?php createTreeView($arrayCategorie, 0); ?>
                        </div>
                        <div style="margin: 5px 0">
                            <button onclick="themdiabanmoi();" name="themdiaban" id="themdiaban" class="btn btn-sm btn-success">
                                <span class="glyphicon glyphicon-plus"></span>
                                Thêm
                            </button>
                        </div>
                    </div>
                    <div class="col-xs-8">
                        <div class="panel panel-default" id="chitietdiaban">
                            <div class="panel-heading">
                                Thêm mới địa bàn
                            </div>
                            <form role="form" id="themdiaban" method="post" action="themdiaban" enctype="multipart/form-data">
                                <div class="panel-body form-horizontal">
                                    <div class="form-group form-group-sm">
                                        <label for="tructhuochienthi" class="control-label col-xs-4">Tên địa bàn trực thuộc:</label>
                                        <div class="col-xs-8">
                                            <input name="tructhuochienthi" type="text" maxlength="50" id="tructhuochienthi" class="form-control" value="Danh mục địa bàn" readonly>
                                            <input name="tructhuoc" type="hidden" maxlength="50" id="tructhuoc" class="form-control" value="1">
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="tendiaban" class="control-label col-xs-4">Tên địa bàn <span class="text-danger">(*)</span>:</label>
                                        <div class="col-xs-8">
                                            <input name="tendiaban" type="text" maxlength="50" id="tendiaban" class="form-control" required {{(count($getdiaban)>= 15)?'readonly':''}}>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="thutu" class="control-label col-xs-4">Thứ tự:</label>
                                        <div class="col-xs-8">
                                            <input name="thutu" type="text" value="{{$maxthutudiabanlv1+1}}" id="thutu" class="form-control numberonly" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="thutu" class="control-label col-xs-4">Cấp:</label>
                                        <div class="col-xs-8">
                                            <select id="select_cap" name="chon_cap" class="form-control" {{(count($getdiaban)>= 15)?'readonly':''}}>
                                                <option value="1">Tỉnh</option>
                                                <option value="2">Thành phố</option>
                                                <option value="3">Huyện</option>
                                                <option value="4">Xã - Phường</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="mahanhchinh" class="control-label col-xs-4">Mã hành chính (theo CSDLQG)<span class="text-danger">(*)</span>:</label>
                                        <div class="col-xs-8">
                                            <input name="mahanhchinh" type="text" value="" id="mahanhchinh" class="form-control " readonly>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label class="control-label col-xs-4">Trạng thái:</label>
                                        <div class="col-xs-8">
                                            <div class="radio radio-primary">
                                                <span style="display:inline-block;width:20%;">
                                                    <input id="sudung" type="radio" name="trangthai" value="1" checked="checked" {{(count($getdiaban)>= 15)?'readonly':''}} />
                                                    <label for="sudung">Sử dụng</label>
                                                </span>
                                                <input id="khongsudung" type="radio" name="trangthai" value="0" {{(count($getdiaban)>= 15)?'readonly':''}}/>
                                                <label for="khongsudung">Không sử dụng</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <div class="col-xs-8 col-xs-offset-4">
                                            <button type="{{(count($getdiaban)>= 15)?'button':'submit'}}" name="save" value="" id="save" class="btn btn-sm btn-success">
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

        var currentdiaban = 1;

        //type dia ban
        var TINH = 1;
        var THANHPHO = 2;
        var HUYEN = 3;
        var XA_PHUONG = 4;
        function themdiabanmoi(){

            $.ajax({
                type: 'post',
                dataType: 'json',
                url:  '{{URL::to('getthongtindiabantheoid')}}',
                data: {
                    diabanid: currentdiaban
                },
                success: function (response) {

                    var tendiaban = response['thongtindiaban_result'][0]['tendiaban'];
                    var thutu = response['maxthutu_result']+1;

                    document.getElementById("chitietdiaban").innerHTML = '';
                    document.getElementById("chitietdiaban").innerHTML = '' +
                            '<div class="panel-heading">Thêm Mới Địa Bàn</div>'+
                            '<form role="form" id="themdiaban" method="post" action="themdiaban" enctype="multipart/form-data">'+
                                '<div class="panel-body form-horizontal">'+
                                    '<div class="form-group form-group-sm">'+
                                        '<label for="tructhuoc" class="control-label col-xs-4">Tên địa bàn trực thuộc:</label>'+
                                        '<div class="col-xs-8">'+
                                            '<input name="tructhuocdisplay" type="text" maxlength="50" id="tructhuocdisplay" value="'+tendiaban+'" class="form-control" readonly>'+
                                            '<input name="tructhuoc" type="text" maxlength="50" id="tructhuoc" value="'+currentdiaban+'" class="form-control" style="display: none">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group form-group-sm">'+
                                        '<label for="tendiaban" class="control-label col-xs-4">Tên địa bàn<span class="text-danger">(*)</span>:</label>'+
                                        '<div class="col-xs-8">'+
                                            '<input name="tendiaban" type="text" maxlength="50" id="tendiaban" class="form-control" required>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group form-group-sm">'+
                                        '<label for="thutu" class="control-label col-xs-4">Thứ tự:</label>'+
                                        '<div class="col-xs-8">'+
                                            '<input name="thutu" type="text" id="thutu" value="'+thutu+'" class="form-control numberonly" readonly>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group form-group-sm">'+
                                        '<label for="select_cap" class="control-label col-xs-4">Cấp:</label>'+
                                        '<div class="col-xs-8">'+
                                            '<select id="select_cap" name="chon_cap" class="form-control">'+
                                                '<option value="1">Tỉnh</option>'+
                                                '<option value="2">Thành phố</option>'+
                                                '<option value="3">Huyện</option>'+
                                                '<option value="4">Xã - Phường</option>'+
                                            '</select>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group form-group-sm">'+
                                        '<label for="mahanhchinh" class="control-label col-xs-4">Mã hành chính (theo CSDLQG)<span class="text-danger">(*)</span>:</label>'+
                                        '<div class="col-xs-8">'+
                                            '<input name="mahanhchinh" type="text"  id="mahanhchinh" class="form-control" required>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group form-group-sm">'+
                                        '<label for="trangthai" class="control-label col-xs-4">Trạng thái:</label>'+
                                        '<div class="col-xs-8">'+
                                            '<div class="radio radio-primary">'+
                                                '<span style="display:inline-block;width:20%;">' +
                                                '<input id="sudung" type="radio" name="trangthai" value="1" checked="checked" />'+
                                                '<label for="sudung">Sử dụng</label>' +
                                                '</span>' +
                                                '<input id="khongsudung" type="radio" name="trangthai" value="0" />' +
                                                '<label for="khongsudung">Không sử dụng</label>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group form-group-sm">'+
                                        '<div class="col-xs-8 col-xs-offset-4">'+
                                            '<button type="submit" name="save" value="" id="save" class="btn btn-sm btn-success">'+
                                            '<span class="glyphicon glyphicon-saved"></span>&nbsp;Lưu'+
                                            '</button>'+
                                        '</div>'+
                                    '</div>' +
                                '</div>' +
                            '</form>';
                }
            });
        }

        function thongtindiaban(id){
            currentdiaban = id;
            if(id >1){

                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url:  '{{URL::to('getthongtindiabantheoid')}}',
                    data: {
                        diabanid: id
                    },
                    success: function (response) {
                        var tendiaban = response['thongtindiaban_result'][0]['tendiaban'];
                        var tructhuoc = response['thongtindiaban_result'][0]['tructhuoc'];
                        var tentructhuoc = response['tendiabantructhuoc_result'];
                        var thutu = response['thongtindiaban_result'][0]['thutu'];
                        var trangthai = response['thongtindiaban_result'][0]['trangthai'];
                        var type = response['thongtindiaban_result'][0]['type'];
                        var matinh = response['thongtindiaban_result'][0]['mahanhchinh'];
                        var noidungtrangthai = '';
                        var selectCap = '';

                        if(trangthai == 1){
                            noidungtrangthai = '' +
                                    '<input name="trangthai" type="text" id="trangthai" value="Sử dụng" class="form-control numberonly" readonly>';

                        }else {
                            noidungtrangthai = '' +
                                    '<input name="trangthai" type="text" id="trangthai" value="Không sử dụng" class="form-control numberonly" readonly>';

                        }

                        //cap
                        if(type == TINH)
                        {
                            selectCap = '<select id="select_cap" name="chon_cap" class="form-control" readonly>'+
                                    '<option value="1" selected>Tỉnh</option>'+
                                    '<option value="2">Thành phố</option>'+
                                    '<option value="3">Huyện</option>'+
                                    '<option value="4">Xã - Phường</option>'+
                                    '</select>';
                        }
                        else if(type == THANHPHO)
                        {
                            selectCap = '<select id="select_cap" name="chon_cap" class="form-control" readonly>'+
                                    '<option value="1" >Tỉnh</option>'+
                                    '<option value="2" selected>Thành phố</option>'+
                                    '<option value="3">Huyện</option>'+
                                    '<option value="4">Xã - Phường</option>'+
                                    '</select>';
                        }
                        else if(type == HUYEN)
                        {
                            selectCap = '<select id="select_cap" name="chon_cap" class="form-control" readonly>'+
                                    '<option value="1" >Tỉnh</option>'+
                                    '<option value="2" >Thành phố</option>'+
                                    '<option value="3" selected>Huyện</option>'+
                                    '<option value="4">Xã - Phường</option>'+
                                    '</select>';
                        }
                        else
                        {
                            selectCap = '<select id="select_cap" name="chon_cap" class="form-control" readonly>'+
                                    '<option value="1" >Tỉnh</option>'+
                                    '<option value="2" >Thành phố</option>'+
                                    '<option value="3" >Huyện</option>'+
                                    '<option value="4" selected>Xã - Phường</option>'+
                                    '</select>';
                        }

                        document.getElementById("chitietdiaban").innerHTML = '';
                        document.getElementById("chitietdiaban").innerHTML = '' +
                                '<div class="panel-heading">Thông Tin Địa Bàn</div>'+
                                '<div class="panel-body form-horizontal">'+
                                    '<div class="form-group form-group-sm">'+
                                        '<label for="tructhuoc" class="control-label col-xs-4">Tên địa bàn trực thuộc:</label>'+
                                        '<div class="col-xs-8">'+
                                            '<input name="tructhuoc" type="text" maxlength="50" id="tructhuoc" value="'+tentructhuoc+'" class="form-control" readonly>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group form-group-sm">'+
                                        '<label for="tendiaban" class="control-label col-xs-4">Tên địa bàn:</label>'+
                                        '<div class="col-xs-8">'+
                                            '<input name="tendiaban" type="text" maxlength="50" id="tendiaban" value="'+tendiaban+'" class="form-control" readonly>'+
                                        '</div>'+
                                    '</div>'+

                                    '<div class="form-group form-group-sm">'+
                                        '<label for="select_cap" class="control-label col-xs-4">Cấp:</label>'+
                                        '<div class="col-xs-8">'+
                                            selectCap+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group form-group-sm">'+
                                        '<label for="mahanhchinh" class="control-label col-xs-4">Mã hành chính (theo CSDLQG)<span class="text-danger">(*)</span>:</label>'+
                                        '<div class="col-xs-8">'+
                                            '<input name="mahanhchinh" type="text" id="mahanhchinh" value="'+matinh+'" class="form-control numberonly" readonly>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group form-group-sm">'+
                                        '<label for="matinh" class="control-label col-xs-4">Thứ tự:</label>'+
                                        '<div class="col-xs-8">'+
                                            '<input name="matinh" type="text" id="matinh" value="'+thutu+'" class="form-control numberonly" readonly>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group form-group-sm">'+
                                        '<label for="trangthai" class="control-label col-xs-4">Trạng thái:</label>'+
                                        '<div class="col-xs-8">'+
                                        noidungtrangthai+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group form-group-sm">'+
                                        '<div class="col-xs-8 col-xs-offset-4">'+
                                            '<button onclick="chinhsuadiaban(this.value)" value="'+id+'" class="btn btn-sm btn-warning">'+
                                            '<span class="glyphicon glyphicon-edit"></span>&nbsp;Sửa'+
                                            '</button>&nbsp;'+
                                            '@if(($quyenXoa & DELDANHMUC)== DELDANHMUC)'+
                                            '<button onclick="xoadiaban(this.value)"  value="'+id+'" class="btn btn-sm btn-danger">'+
                                            '<span class="glyphicon glyphicon-trash"></span>&nbsp;Xóa'+
                                            '</button>'+
                                            '@endif'+
                                        '</div>'+
                                    '</div>' +
                                '</div>';
                    }
                });
            }
        }

        function xoadiaban(id){

            var isok = confirm('Bạn có muốn xóa danh mục này không ?');
            if(isok) {
                
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '{{URL::to('xoadiaban')}}',
                    data: {
                        diabanid: id
                    },
                    success: function (response) {
                        window.location.reload(true);
                    }
                });
            }
        }

        function chinhsuadiaban(id){
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '{{URL::to('getthongtindiabantheoid')}}',
                data: {
                    diabanid: id
                },
                success: function (response) {

                    var tendiaban = response['thongtindiaban_result'][0]['tendiaban'];
                    var tructhuoc = response['thongtindiaban_result'][0]['tructhuoc'];
                    var tentructhuoc = response['tendiabantructhuoc_result'];
                    var thutu = response['thongtindiaban_result'][0]['thutu'];
                    var trangthai = response['thongtindiaban_result'][0]['trangthai'];
                    var type = response['thongtindiaban_result'][0]['type'];
                    var matinh = response['thongtindiaban_result'][0]['mahanhchinh'];
                    var noidungtrangthai = '';
                    var selectCap = '';
                    if(trangthai == 1){
                        noidungtrangthai = '' +
                                '<div class="radio radio-primary">'+
                                    '<span style="display:inline-block;width:20%;">' +
                                    '<input id="sudung" type="radio" name="trangthai" value="1" checked="checked" />'+
                                    '<label for="sudung">Sử dụng</label>' +
                                    '</span>' +
                                    '<input id="khongsudung" type="radio" name="trangthai" value="0" />' +
                                    '<label for="khongsudung">Không sử dụng</label>'+
                                '</div>';
                    }else {

                        noidungtrangthai = '' +
                                '<div class="radio radio-primary">'+
                                '<span style="display:inline-block;width:20%;">' +
                                '<input id="sudung" type="radio" name="trangthai" value="1" />'+
                                '<label for="sudung">Sử dụng</label>' +
                                '</span>' +
                                '<input id="khongsudung" type="radio" name="trangthai" value="0" checked="checked" />' +
                                '<label for="khongsudung">Không sử dụng</label>'+
                                '</div>';
                    }

                    //
                    //cap
                    if(type == TINH)
                    {
                        selectCap = '<select id="select_cap" name="chon_cap" class="form-control" >'+
                                '<option value="1" selected>Tỉnh</option>'+
                                '<option value="2">Thành phố</option>'+
                                '<option value="3">Huyện</option>'+
                                '<option value="4">Xã - Phường</option>'+
                                '</select>';
                    }
                    else if(type == THANHPHO)
                    {
                        selectCap = '<select id="select_cap" name="chon_cap" class="form-control" >'+
                                '<option value="1" >Tỉnh</option>'+
                                '<option value="2" selected>Thành phố</option>'+
                                '<option value="3">Huyện</option>'+
                                '<option value="4">Xã - Phường</option>'+
                                '</select>';
                    }
                    else if(type == HUYEN)
                    {
                        selectCap = '<select id="select_cap" name="chon_cap" class="form-control" >'+
                                '<option value="1" >Tỉnh</option>'+
                                '<option value="2" >Thành phố</option>'+
                                '<option value="3" selected>Huyện</option>'+
                                '<option value="4">Xã - Phường</option>'+
                                '</select>';
                    }
                    else
                    {
                        selectCap = '<select id="select_cap" name="chon_cap" class="form-control" >'+
                                '<option value="1" >Tỉnh</option>'+
                                '<option value="2" >Thành phố</option>'+
                                '<option value="3" >Huyện</option>'+
                                '<option value="4" selected>Xã - Phường</option>'+
                                '</select>';
                    }

                    document.getElementById("chitietdiaban").innerHTML = '';
                    document.getElementById("chitietdiaban").innerHTML = ''+
                            '<div class="panel-heading">Hiệu Chỉnh Thông Tin Địa Bàn</div>'+
                            '<form role="form" method="post" action="chinhsuadiaban/'+id+'" enctype="multipart/form-data">'+
                                '<div class="panel-body form-horizontal">'+
                                    '<div class="form-group form-group-sm">'+
                                        '<label for="tructhuoc" class="control-label col-xs-4">Tên địa bàn trực thuộc:</label>'+
                                        '<div class="col-xs-8">'+
                                            '<input name="tructhuochienthi" type="text" maxlength="50" id="tructhuochienthi" value="'+tentructhuoc+'" class="form-control" readonly>'+
                                            '<input name="tructhuoc" type="text" maxlength="50" id="tructhuoc" value="'+tructhuoc+'" class="form-control" style="display: none">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group form-group-sm">'+
                                        '<label for="tendiaban" class="control-label col-xs-4">Tên địa bàn<span class="text-danger">(*)</span>:</label>'+
                                        '<div class="col-xs-8">'+
                                            '<input name="tendiaban" type="text" maxlength="50" id="tendiaban" value="'+tendiaban+'" class="form-control" required>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group form-group-sm">'+
                                        '<label for="thutu" class="control-label col-xs-4">Thứ tự<span class="text-danger">(*)</span>:</label>'+
                                        '<div class="col-xs-8">'+
                                            '<input name="thutu" type="text" id="thutu" value="'+thutu+'" class="form-control numberonly" required>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group form-group-sm">'+
                                        '<label for="select_cap" class="control-label col-xs-4">Cấp:</label>'+
                                        '<div class="col-xs-8">'+
                                            selectCap+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group form-group-sm">'+
                                        '<label for="mahanhchinh" class="control-label col-xs-4">Mã hành chính (theo CSDLQG)<span class="text-danger">(*)</span>:</label>'+
                                            '<div class="col-xs-8">'+
                                                '<input name="mahanhchinh" type="text" id="mahanhchinh" value="'+matinh+'" class="form-control " required>'+
                                            '</div>'+
                                        '</div>'+
                                    '<div class="form-group form-group-sm">'+
                                        '<label for="trangthai" class="control-label col-xs-4">Trạng thái:</label>'+
                                        '<div class="col-xs-8">'+
                                        noidungtrangthai+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group form-group-sm">'+
                                        '<div class="col-xs-8 col-xs-offset-4">'+
                                            '<button type="submit" class="btn btn-sm btn-success">'+
                                            '<span class="glyphicon glyphicon-save"></span>&nbsp;Lưu'+
                                            '</button>&nbsp;'+
                                            '<button type="button" onclick="thongtindiaban(this.value)" value="'+id+'" class="btn btn-sm btn-danger">'+
                                            '<span class="glyphicon glyphicon-ban-circle"></span>&nbsp;Hủy'+
                                            '</button>'+
                                        '</div>'+
                                    '</div>' +
                                '</form>'+
                            '</div>';
                }
            });

        }
    </script>

@endsection
