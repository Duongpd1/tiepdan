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
        var element1 = document.getElementById("thamquyen");
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

                $id = $category['id'];
                $tenthamquyen = $category['tenthamquyen'];
                echo '<li> <label for="thamquyen"><a id="'.$id.'" onclick="thongtinthamquyen(this.id)">'.$tenthamquyen.'</a></label><input id="thamquyen" type="checkbox" />';

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
    if(count($getthamquyen)==0){
        echo "Not found Database";
    }else{
        $var = 0;
        while($var < count($getthamquyen)){
            $arrayCategorie[$var+1]['tenthamquyen'] = $getthamquyen[$var]->tenthamquyen;
            $arrayCategorie[$var+1]['tructhuoc'] = $getthamquyen[$var]->tructhuoc;
            $arrayCategorie[$var+1]['id'] = $getthamquyen[$var]->id;
            $var++;
        }
    }
    $quyenXoa = Session::get('quyenXoa');
    ?>

    <div class="container-fluid" style="margin-bottom: 40px; padding: 10px 15px">
        <div class="col-background">
            <div class="panel panel-default panel-min-height">
                <div class="panel-heading text-center">QUẢN TRỊ DANH MỤC THẨM QUYỀN</div>
                <div class="panel-body">
                    <div class="col-xs-4">
                        <div style="overflow-y: auto;height: 380px;border:1px solid #ccc ;">
                            <?php createTreeView($arrayCategorie, 0); ?>
                        </div>
                        <div style="margin: 5px 0">
                            <button onclick="themthamquyenmoi()" class="btn btn-sm btn-success">
                                <span class="glyphicon glyphicon-plus"></span>
                                Thêm
                            </button>
                        </div>
                    </div>
                    <div class="col-xs-8" id="chitietthamquyen">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Thêm mới thẩm quyền
                            </div>
                            <form role="form" id="themthamquyen" method="post" action="themthamquyen" enctype="multipart/form-data">
                                <div class="panel-body form-horizontal">
                                    <div class="form-group form-group-sm">
                                        <label for="tructhuocdisplay" class="control-label col-xs-4">Tên thẩm quyền trực thuộc <span class="text-danger">(*)</span>:</label>
                                        <div class="col-xs-8">
                                            <input name="tructhuocdisplay" type="text" maxlength="256" id="tructhuocdisplay" class="form-control" value="Danh mục thẩm quyển" readonly/>
                                            <input name="tructhuoc" type="hidden" maxlength="256" id="tructhuoc" class="form-control" value="1" />
                                        </div>
                                    </div>

                                    <div class="form-group form-group-sm">
                                        <label for="tenthamquyen" class="control-label col-xs-4">Tên thẩm quyền <span class="text-danger">(*)</span>:</label>
                                        <div class="col-xs-8">
                                            <input name="tenthamquyen" type="text" maxlength="256" id="tenthamquyen" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="form-group form-group-sm">
                                        <label for="diachi" class="control-label col-xs-4">Địa chỉ <span class="text-danger">(*)</span>:</label>
                                        <div class="col-xs-8">
                                            <input name="diachi" type="text" maxlength="256" id="diachi" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="form-group form-group-sm">
                                        <label for="dienthoai" class="control-label col-xs-4">Điện thoại <span class="text-danger">(*)</span>:</label>
                                        <div class="col-xs-8">
                                            <input name="dienthoai" type="text" maxlength="20" id="dienthoai" class="form-control numberonly" />
                                        </div>
                                    </div>

                                    <div class="form-group form-group-sm">
                                        <label for="thutu" class="control-label col-xs-4">Thứ tự <span class="text-danger">(*)</span>:</label>
                                        <div class="col-xs-8">
                                            <input name="thutu" type="text" value="{{$maxthututhamquyen+1}}" id="thutu" class="form-control numberonly" />
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

        var currentthamquyen = 1;

        function themthamquyenmoi(){

            $.ajax({
                type: 'post',
                dataType: 'json',
                url:  '{{URL::to('getthongtinthamquyentheoid')}}',
                data: {
                    thamquyenid: currentthamquyen
                },
                success: function (response) {

                    var tenthamquyentructhuoc = response['thongtinthamquyen_result'][0]['tenthamquyen'];
                    var thutu = response['maxthutu_result']+1;

                    var formdonvitructhuoc = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="tructhuocdisplay" class="control-label col-xs-4">Tên thẩm quyền trực thuộc:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="tructhuocdisplay" type="text" maxlength="50" id="tructhuocdisplay" class="form-control" value="'+tenthamquyentructhuoc+'" readonly/>' +
                            '<input name="tructhuoc" type="hidden" maxlength="50" value="'+currentthamquyen+'" id="tructhuoc" class="form-control"/>' +
                            '</div>' +
                            '</div>'+
                            '';

                    var formdonvi = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="tenthamquyen" class="control-label col-xs-4">Tên thẩm quyền <span class="text-danger">(*)</span>:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="tenthamquyen" type="text" maxlength="50" id="tenthamquyen" class="form-control" required/>' +
                            '</div>' +
                            '</div>';

                    var formthutu = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="thutu" class="control-label col-xs-4">Thứ tự <span class="text-danger">(*)</span>:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="thutu" type="text" value="'+thutu+'" id="thutu" class="form-control numberonly" required/>' +
                            '</div>' +
                            '</div>' +
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

                    document.getElementById("chitietthamquyen").innerHTML = '';
                    document.getElementById("chitietthamquyen").innerHTML = '' +
                            '<div class="panel panel-default">' +
                            '<div class="panel-heading">Thêm mới thẩm quyền' +
                            '</div>' +
                            '<form role="form" id="themthamquyen" method="post" action="themthamquyen" enctype="multipart/form-data">' +
                            '<div class="panel-body form-horizontal">' +
                            formdonvitructhuoc +
                            formdonvi +
                            formthutu +
                            formdiachi +
                            formdienthoai +
                            formtrangthai +
                            formbutton +
                            '</div>' +
                            '</form>' +
                            '</div>';
                }
            });
        }


        function thongtinthamquyen(id){
            currentthamquyen = id;
            if(id >1){

                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url:  '{{URL::to('getthongtinthamquyentheoid')}}',
                    data: {
                        thamquyenid: id
                    },
                    success: function (response) {

                        var tenthamquyen = response['thongtinthamquyen_result'][0]['tenthamquyen'];
                        var tructhuoc = response['thongtinthamquyen_result'][0]['tructhuoc'];
                        var tentructhuoc = response['tenthamquyentructhuoc_result'];
                        var thutu = response['thongtinthamquyen_result'][0]['thutu'];
                        var diachi = response['thongtinthamquyen_result'][0]['diachi'];
                        var dienthoai = response['thongtinthamquyen_result'][0]['dienthoai'];
                        var trangthai = response['thongtinthamquyen_result'][0]['trangthai'];
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
                                '<label for="tructhuoc" class="control-label col-xs-4">Tên thẩm quyền trực thuộc:</label>' +
                                '<div class="col-xs-8">' +
                                '<input name="tructhuoc" type="text" maxlength="50" id="tructhuoc" class="form-control" value="'+tentructhuoc+'" readonly/>' +
                                '</div>' +
                                '</div>'+
                                '';

                        var formdonvi = '' +
                                '<div class="form-group form-group-sm">' +
                                '<label for="tendonvi" class="control-label col-xs-4">Tên thẩm quyền:</label>' +
                                '<div class="col-xs-8">' +
                                '<input name="tendonvi" type="text" maxlength="50" id="tendonvi" class="form-control" value="'+tenthamquyen+'" readonly/>' +
                                '</div>' +
                                '</div>';

                        var formthutu = '' +
                                '<div class="form-group form-group-sm">' +
                                '<label for="thutu" class="control-label col-xs-4">Thứ tự:</label>' +
                                '<div class="col-xs-8">' +
                                '<input name="thutu" type="text" value="'+thutu+'" id="thutu" class="form-control numberonly" readonly/>' +
                                '</div>' +
                                '</div>' +
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
                                '<button onclick="chinhsuathamquyen(this.value)" value="'+id+'" class="btn btn-sm btn-warning">'+
                                '<span class="glyphicon glyphicon-edit"></span>&nbsp;Sửa'+
                                '</button>&nbsp;'+
                                '@if(($quyenXoa & DELDANHMUC)== DELDANHMUC)'+
                                '<button onclick="xoathamquyen(this.value)"  value="'+id+'" class="btn btn-sm btn-danger">'+
                                '<span class="glyphicon glyphicon-trash"></span>&nbsp;Xóa'+
                                '</button>'+
                                '@endif'+
                                '</div>'+
                                '</div>' +
                                '';

                        document.getElementById("chitietthamquyen").innerHTML = '';
                        document.getElementById("chitietthamquyen").innerHTML = '' +
                                '<div class="panel panel-default">' +
                                '<div class="panel-heading">Thông tin thẩm quyền</div>' +
                                '<div class="panel-body form-horizontal">' +
                                formdonvitructhuoc +
                                formdonvi +
                                formthutu +
                                formdiachi +
                                formdienthoai +
                                formtrangthai +
                                formbutton +
                                '</div>' +
                                '</div>' +
                                '';

                    }
                });
            }
        }

        function xoathamquyen(id){

            var isok = confirm('Bạn có muốn xóa thẩm quyền này không ?');
            if(isok) {

                confirmxoa(id);
                xoathamquyentheoid(id);
                window.location.reload(true);
            }
        }

        function confirmxoa(id){

            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '{{URL::to('getthamquyencon')}}',
                data: {
                    thamquyenid: id
                },
                success: function (response) {

                    var ketqua = response['thamquyencon_result'];
                    if(ketqua.length >0) {
                        for (var i = 0; i < ketqua.length; i++) {
                            var idcon = ketqua[i]['id'];
                            xoathamquyentheoid(idcon);
                            confirmxoa(idcon);
                        }
                    }
                }
            });
        }

        function xoathamquyentheoid(id){

            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '{{URL::to('xoathamquyen')}}',
                data: {
                    thamquyenid: id
                },
                success: function (response) {

                }
            });
        }

        function chinhsuathamquyen(id){
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '{{URL::to('getthongtinthamquyentheoid')}}',
                data: {
                    thamquyenid: id
                },
                success: function (response) {

                    var tenthamquyen = response['thongtinthamquyen_result'][0]['tenthamquyen'];
                    var tructhuoc = response['thongtinthamquyen_result'][0]['tructhuoc'];
                    var tentructhuoc = response['tenthamquyentructhuoc_result'];
                    var thutu = response['thongtinthamquyen_result'][0]['thutu'];
                    var diachi = response['thongtinthamquyen_result'][0]['diachi'];
                    var dienthoai = response['thongtinthamquyen_result'][0]['dienthoai'];
                    var trangthai = response['thongtinthamquyen_result'][0]['trangthai'];

                    var formdonvitructhuoc = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="tructhuocdisplay" class="control-label col-xs-4">Tên thẩm quyền trực thuộc:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="tructhuocdisplay" type="text" maxlength="50" id="tructhuocdisplay" class="form-control" value="'+tentructhuoc+'" readonly/>' +
                            '<input name="tructhuoc" type="hidden" maxlength="50" id="tructhuoc" class="form-control" value="'+tructhuoc+'"/>' +
                            '</div>' +
                            '</div>'+
                            '';

                    var formdonvi = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="tenthamquyen" class="control-label col-xs-4">Tên thẩm quyền <span class="text-danger">(*)</span>:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="tenthamquyen" type="text" maxlength="50" id="tenthamquyen" class="form-control" value="'+tenthamquyen+'"/>' +
                            '</div>' +
                            '</div>';

                    var formthutu = '' +
                            '<div class="form-group form-group-sm">' +
                            '<label for="thutu" class="control-label col-xs-4">Thứ tự <span class="text-danger">(*)</span>:</label>' +
                            '<div class="col-xs-8">' +
                            '<input name="thutu" type="text" value="'+thutu+'" id="thutu" class="form-control numberonly"/>' +
                            '</div>' +
                            '</div>' +
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
                            '<button type="button" onclick="thongtinthamquyen(this.value)" value="'+id+'" class="btn btn-sm btn-danger">'+
                            '<span class="glyphicon glyphicon-ban-circle"></span>&nbsp;Hủy'+
                            '</button>'+
                            '</div>'+
                            '</div>' +
                            '';

                    document.getElementById("chitietthamquyen").innerHTML = '';
                    document.getElementById("chitietthamquyen").innerHTML = '' +
                            '<div class="panel panel-default">' +
                            '<div class="panel-heading">Thông tin đơn vị' +
                            '</div>' +
                            '<form role="form" id="submitchinhsuathamquyen" method="post" action="chinhsuathamquyen/'+id+'" enctype="multipart/form-data">' +
                            '<div class="panel-body form-horizontal">' +
                            formdonvitructhuoc +
                            formdonvi +
                            formthutu +
                            formdiachi +
                            formdienthoai +
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
