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
        var element1 = document.getElementById("dstcd");
        element1.classList.add("active");
        var element = document.getElementById("htab-tiepdan");
        element.classList.add("active");
        element.classList.add("in");

    </script>
    <div class="container-fluid" style="margin-bottom: 40px; padding: 10px 15px">
        <div class="col-background">
            <div class="panel panel-default panel-min-height">
                <div class="panel-heading text-center">HIỆU CHỈNH DANH SÁCH TIẾP CÔNG DÂN</div>

                <form method="post" name="xacminh" action="submitchinhsuadanhsachtiepcongdan/{{$chitietdanhsachtiepcongdan[0]->tiepdanid}}" enctype="multipart/form-data">
                    <div class="panel-body form-horizontal">
                        <div class="form-group form-group-sm">
                            <label for="sothuly" class="control-label col-sm-3">Số thụ lý </label>
                            <div class="col-sm-2">
                                <input name="sothuly" type="text" maxlength="20" id="sothuly" class="form-control" value="{{$chitietdanhsachtiepcongdan[0]->sothuly}}" readonly>
                            </div>
                            <label for="ngaytiep" class="control-label col-sm-2">Ngày tiếp </label>
                            <div class="col-sm-2">
                                <input name="ngaytiep" type="text" value="{{$chitietdanhsachtiepcongdan[0]->ngaytiep}}" maxlength="10" id="ngaytiep" class="form-control" required/>
                            </div>
                            <label for="lantiep" class="control-label col-sm-2">Lần tiếp <span class="text-danger">(*)</span></label>
                            <div class="col-sm-1">
                                <input name="lantiep" type="text" value="{{$chitietdanhsachtiepcongdan[0]->lantiep}}" maxlength="2" id="lantiep" class="form-control numberonly" required/>
                            </div>
                        </div>

                        <div class="form-group form-group-sm" id="formChuTri" >
                            <label for="chuTri" class="control-label col-xs-3">Chủ trì <span class="text-danger">(*)</span></label>
                            <div class="col-xs-4">
                                <input id="chuTri" name="chuTri" class="form-control" style="text-transform:uppercase" type="text" list="chuTriList" value="{{$chitietdanhsachtiepcongdan[0]->chutri}}" required>
                                <datalist id="chuTriList">
                                    @foreach($chuTriInfo as $chuTri)
                                        <option id="{{$chuTri->id}}" value="{{$chuTri->tenChuTri}}">
                                    @endforeach
                                </datalist>
                            </div>
                            <label for="chucVuCT" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                            <div class="col-xs-3">
                                <input id="chucVuCT" name="chucVuCT" class="form-control" type="text" required value="{{$chitietdanhsachtiepcongdan[0]->chucvuchutri}}">
                            </div>
                        </div>

                        <?php
                        $nguoiTiepArray = explode(',', $chitietdanhsachtiepcongdan[0]->lanhdao);
                        $chucvuArray = explode(',', $chitietdanhsachtiepcongdan[0]->chucvu);
                        ?>

                        @if(1 == count($nguoiTiepArray))
                            <div class="form-group form-group-sm" id="formNguoiTiep1">
                                <label for="nguoitiep1" class="control-label col-xs-3">Người tham gia 1 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep1" name="nguoitiep1" style="text-transform:uppercase" class="form-control autoLanhDao" type="text" value="{{$nguoiTiepArray[0]}}" >
                                </div>
                                <label for="chucvu1" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu1" name="chucvu1" class="form-control chucVuClass" type="text" value="{{$chucvuArray[0]}}" >
                                </div>
                                <div class="col-xs-1 text-right">
                                    <span id="addNguoiTiep" class="btn btn-xs btn-success glyphicon glyphicon-plus"  style="cursor: pointer" onclick="addNguoiTiep()"></span>
                                    <span id="removeNguoiTiep" class="btn btn-xs btn-danger glyphicon glyphicon-minus" onclick="removeNguoiTiep();" style="cursor: pointer"></span>
                                </div>
                            </div>
                            <div class="form-group form-group-sm" id="formNguoiTiep2" style="display: none">
                                <label for="nguoitiep2" class="control-label col-xs-3">Người tham gia 2 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep2" name="nguoitiep2" style="text-transform:uppercase" class="form-control autoLanhDao" type="text">
                                </div>
                                <label for="chucvu2" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu2" name="chucvu2" class="form-control chucVuClass" type="text">
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep3" style="display: none">
                                <label for="nguoitiep3" class="control-label col-xs-3">Người tham gia 3 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep3" name="nguoitiep3" style="text-transform:uppercase" class="form-control autoLanhDao" type="text">
                                </div>
                                <label for="chucvu3" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu3" name="chucvu3" class="form-control chucVuClass" type="text">
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep4" style="display: none">
                                <label for="nguoitiep4" class="control-label col-xs-3">Người tham gia 4 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep4" name="nguoitiep4" style="text-transform:uppercase" class="form-control autoLanhDao" type="text">
                                </div>
                                <label for="chucvu4" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu4" name="chucvu4" class="form-control chucVuClass" type="text">
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep5" style="display: none">
                                <label for="nguoitiep5" class="control-label col-xs-3">Người tham gia 5</label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep5" name="nguoitiep5" style="text-transform:uppercase" class="form-control autoLanhDao" type="text">
                                </div>
                                <label for="chucvu5" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu5" name="chucvu5" class="form-control chucVuClass" type="text">
                                </div>
                            </div>

                        @elseif(2 == count($nguoiTiepArray))
                            <div class="form-group form-group-sm" id="formNguoiTiep1">
                                <label for="nguoitiep1" class="control-label col-xs-3">Người tham gia 1 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep1" name="nguoitiep1" style="text-transform:uppercase" class="form-control autoLanhDao" type="text" value="{{$nguoiTiepArray[0]}}" >
                                </div>
                                <label for="chucvu1" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu1" name="chucvu1" class="form-control chucVuClass" type="text" value="{{$chucvuArray[0]}}" >
                                </div>
                                <div class="col-xs-1 text-right">
                                    <span id="addNguoiTiep" class="btn btn-xs btn-success glyphicon glyphicon-plus"  style="cursor: pointer" onclick="addNguoiTiep()"></span>
                                    <span id="removeNguoiTiep" class="btn btn-xs btn-danger glyphicon glyphicon-minus" onclick="removeNguoiTiep();" style="cursor: pointer"></span>
                                </div>
                            </div>
                            <div class="form-group form-group-sm" id="formNguoiTiep2">
                                <label for="nguoitiep2" class="control-label col-xs-3">Người tham gia 2 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep2" name="nguoitiep2" style="text-transform:uppercase" class="form-control autoLanhDao" type="text" value="{{$nguoiTiepArray[1]}}" >
                                </div>
                                <label for="chucvu2" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu2" name="chucvu2" class="form-control chucVuClass" type="text" value="{{$chucvuArray[1]}}" >
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep3" style="display: none">
                                <label for="nguoitiep3" class="control-label col-xs-3">Người tham gia 3 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep3" name="nguoitiep3" style="text-transform:uppercase" class="form-control autoLanhDao" type="text">
                                </div>
                                <label for="chucvu3" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu3" name="chucvu3" class="form-control chucVuClass" type="text">
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep4" style="display: none">
                                <label for="nguoitiep4" class="control-label col-xs-3">Người tham gia 4 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep4" name="nguoitiep4" style="text-transform:uppercase" class="form-control autoLanhDao" type="text">
                                </div>
                                <label for="chucvu4" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu4" name="chucvu4" class="form-control chucVuClass" type="text">
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep5" style="display: none">
                                <label for="nguoitiep5" class="control-label col-xs-3">Người tham gia 5 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep5" name="nguoitiep5" style="text-transform:uppercase" class="form-control autoLanhDao" type="text">
                                </div>
                                <label for="chucvu5" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu5" name="chucvu5" class="form-control chucVuClass" type="text">
                                </div>
                            </div>
                        @elseif(3 == count($nguoiTiepArray))
                            <div class="form-group form-group-sm" id="formNguoiTiep1">
                                <label for="nguoitiep1" class="control-label col-xs-3">Người tham gia 1 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep1" name="nguoitiep1" style="text-transform:uppercase" class="form-control autoLanhDao" type="text" value="{{$nguoiTiepArray[0]}}" >
                                </div>
                                <label for="chucvu1" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu1" name="chucvu1" class="form-control chucVuClass" type="text" value="{{$chucvuArray[0]}}" >
                                </div>
                                <div class="col-xs-1 text-right">
                                    <span id="addNguoiTiep" class="btn btn-xs btn-success glyphicon glyphicon-plus"  style="cursor: pointer" onclick="addNguoiTiep()"></span>
                                    <span id="removeNguoiTiep" class="btn btn-xs btn-danger glyphicon glyphicon-minus" onclick="removeNguoiTiep();" style="cursor: pointer"></span>
                                </div>
                            </div>
                            <div class="form-group form-group-sm" id="formNguoiTiep2">
                                <label for="nguoitiep2" class="control-label col-xs-3">Người tham gia 2 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep2" name="nguoitiep2" style="text-transform:uppercase" class="form-control autoLanhDao" type="text" value="{{$nguoiTiepArray[1]}}" >
                                </div>
                                <label for="chucvu2" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu2" name="chucvu2" class="form-control chucVuClass" type="text" value="{{$chucvuArray[1]}}" >
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep3">
                                <label for="nguoitiep3" class="control-label col-xs-3">Người tham gia 3 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep3" name="nguoitiep3" style="text-transform:uppercase" class="form-control autoLanhDao" type="text" value="{{$nguoiTiepArray[2]}}" >
                                </div>
                                <label for="chucvu3" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu3" name="chucvu3" class="form-control chucVuClass" type="text" value="{{$chucvuArray[2]}}" >
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep4" style="display: none">
                                <label for="nguoitiep4" class="control-label col-xs-3">Người tham gia 4 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep4" name="nguoitiep4" style="text-transform:uppercase" class="form-control autoLanhDao" type="text">
                                </div>
                                <label for="chucvu4" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu4" name="chucvu4" class="form-control chucVuClass" type="text">
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep5" style="display: none">
                                <label for="nguoitiep5" class="control-label col-xs-3">Người tham gia 5 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep5" name="nguoitiep5" style="text-transform:uppercase" class="form-control autoLanhDao" type="text">
                                </div>
                                <label for="chucvu5" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu5" name="chucvu5" class="form-control chucVuClass" type="text">
                                </div>
                            </div>

                        @elseif(4 == count($nguoiTiepArray))
                            <div class="form-group form-group-sm" id="formNguoiTiep1">
                                <label for="nguoitiep1" class="control-label col-xs-3">Người tham gia 1 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep1" name="nguoitiep1" style="text-transform:uppercase" class="form-control autoLanhDao" type="text" value="{{$nguoiTiepArray[0]}}" >
                                </div>
                                <label for="chucvu1" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu1" name="chucvu1" class="form-control chucVuClass" type="text" value="{{$chucvuArray[0]}}" >
                                </div>
                                <div class="col-xs-1 text-right">
                                    <span id="addNguoiTiep" class="btn btn-xs btn-success glyphicon glyphicon-plus"  style="cursor: pointer" onclick="addNguoiTiep()"></span>
                                    <span id="removeNguoiTiep" class="btn btn-xs btn-danger glyphicon glyphicon-minus" onclick="removeNguoiTiep();" style="cursor: pointer"></span>
                                </div>
                            </div>
                            <div class="form-group form-group-sm" id="formNguoiTiep2">
                                <label for="nguoitiep2" class="control-label col-xs-3">Người tham gia 2 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep2" name="nguoitiep2" style="text-transform:uppercase" class="form-control autoLanhDao" type="text" value="{{$nguoiTiepArray[1]}}" >
                                </div>
                                <label for="chucvu2" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu2" name="chucvu2" class="form-control chucVuClass" type="text" value="{{$chucvuArray[1]}}" >
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep3">
                                <label for="nguoitiep3" class="control-label col-xs-3">Người tham gia 3 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep3" name="nguoitiep3" style="text-transform:uppercase" class="form-control autoLanhDao" type="text" value="{{$nguoiTiepArray[2]}}" >
                                </div>
                                <label for="chucvu3" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu3" name="chucvu3" class="form-control chucVuClass" type="text" value="{{$chucvuArray[2]}}" >
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep4">
                                <label for="nguoitiep4" class="control-label col-xs-3">Người tham gia 4 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep4" name="nguoitiep4" style="text-transform:uppercase" class="form-control autoLanhDao" type="text" value="{{$nguoiTiepArray[3]}}" >
                                </div>
                                <label for="chucvu4" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu4" name="chucvu4" class="form-control chucVuClass" type="text" value="{{$chucvuArray[3]}}" >
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep5" style="display: none">
                                <label for="nguoitiep5" class="control-label col-xs-3">Người tham gia 5 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep5" name="nguoitiep5" style="text-transform:uppercase" class="form-control autoLanhDao" type="text">
                                </div>
                                <label for="chucvu5" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu5" name="chucvu5" class="form-control chucVuClass" type="text">
                                </div>
                            </div>

                        @elseif(5 == count($nguoiTiepArray))
                            <div class="form-group form-group-sm" id="formNguoiTiep1">
                                <label for="nguoitiep1" class="control-label col-xs-3">Người tham gia 1 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep1" name="nguoitiep1" style="text-transform:uppercase" class="form-control autoLanhDao" type="text" value="{{$nguoiTiepArray[0]}}" >
                                </div>
                                <label for="chucvu1" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu1" name="chucvu1" class="form-control chucVuClass" type="text" value="{{$chucvuArray[0]}}" >
                                </div>
                                <div class="col-xs-1 text-right">
                                    <span id="addNguoiTiep" class="btn btn-xs btn-success glyphicon glyphicon-plus"  style="cursor: pointer" onclick="addNguoiTiep()"></span>
                                    <span id="removeNguoiTiep" class="btn btn-xs btn-danger glyphicon glyphicon-minus" onclick="removeNguoiTiep();" style="cursor: pointer"></span>
                                </div>
                            </div>
                            <div class="form-group form-group-sm" id="formNguoiTiep2">
                                <label for="nguoitiep2" class="control-label col-xs-3">Người tham gia 2 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep2" name="nguoitiep2" style="text-transform:uppercase" class="form-control autoLanhDao" type="text" value="{{$nguoiTiepArray[1]}}" >
                                </div>
                                <label for="chucvu2" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu2" name="chucvu2" class="form-control chucVuClass" type="text" value="{{$chucvuArray[1]}}" >
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep3">
                                <label for="nguoitiep3" class="control-label col-xs-3">Người tham gia 3 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep3" name="nguoitiep3" style="text-transform:uppercase" class="form-control autoLanhDao" type="text" value="{{$nguoiTiepArray[2]}}" >
                                </div>
                                <label for="chucvu3" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu3" name="chucvu3" class="form-control chucVuClass" type="text" value="{{$chucvuArray[2]}}" >
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep4">
                                <label for="nguoitiep4" class="control-label col-xs-3">Người tham gia 4 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep4" name="nguoitiep4" style="text-transform:uppercase" class="form-control autoLanhDao" type="text" value="{{$nguoiTiepArray[3]}}" >
                                </div>
                                <label for="chucvu4" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu4" name="chucvu4" class="form-control chucVuClass" type="text" value="{{$chucvuArray[3]}}" >
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep5">
                                <label for="nguoitiep5" class="control-label col-xs-3">Người tham gia 5 </label>
                                <div class="col-xs-4">
                                    <input id="nguoitiep5" name="nguoitiep5" style="text-transform:uppercase" class="form-control autoLanhDao" type="text" value="{{$nguoiTiepArray[4]}}" >
                                </div>
                                <label for="chucvu5" class="control-label col-xs-1">Chức Vụ </label>
                                <div class="col-xs-3">
                                    <input id="chucvu5" name="chucvu5" class="form-control chucVuClass" type="text" value="{{$chucvuArray[4]}}" >
                                </div>
                            </div>
                        @else

                        @endif
                        <div class="form-group form-group-sm">
                            <label for="chuthe" class="control-label col-xs-3">Chủ thể </label>
                            <div class="col-xs-9">
                                <select name="chuthe" id="chuthe" class="form-control" onchange="showHinhThuc(this)">
                                    @if($chitietdanhsachtiepcongdan[0]->chuthe == 1)
                                        <option value="1" selected>Cá nhân</option>
                                        <option value="2">Tập thể</option>
                                    @else
                                        <option value="1">Cá nhân</option>
                                        <option value="2" selected>Tập thể</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-group-sm" id="nhom" style="{{($chitietdanhsachtiepcongdan[0]->chuthe == 1)?'display: none;':''}}">
                            <label for="tencongdan" class="control-label col-sm-3">Thông tin công dân </label>
                            <div class="col-sm-9">
                                <div class="panel-heading">Thông tin các công dân khác</div>
                                <table  class="table table-bordered table-hover" id="congDanThamGia" style="{{( count($congDanKhac)>0)? '':'display: none'}}">
                                    <thead>
                                    <tr>
                                        <th class="col-xs-3 text-center">Họ tên</th>
                                        <th class="col-xs-4 text-center">Địa chỉ</th>
                                        <th class="col-xs-2 text-center">CMTND/Hộ chiếu</th>
                                        <th class="col-xs-2 text-center">Số điện thoại</th>
                                        <th class="col-xs-1 text-center">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody id="bodytable">
                                    @foreach($congDanKhac as $congDan)
                                        @if($congDan->enable == ENABLE)
                                            <tr id="{{$congDan->id}}">
                                                <td id="ten_{{$congDan->id}}">{{$congDan->tencongdan}}</td>
                                                <td id="diachi_{{$congDan->id}}">{{$congDan->diachi}}</td>
                                                <td id="cmt_{{$congDan->id}}">{{$congDan->cmt}}</td>
                                                <td id="sdt_{{$congDan->id}}">{{($congDan->sdt!=null)?$congDan->sdt:''}}</td>
                                                <td class="text-center"><a id="{{$congDan->id}}.{{$congDan->cmt}}" class="{{($congDan->tencongdan == $chitietdanhsachtiepcongdan[0]->congdan )?'text-warning':'text-danger'}}" onclick="{{($congDan->tencongdan == $chitietdanhsachtiepcongdan[0]->congdan )?'ChinhSuaCongDan(this);':'DeleteCongDan(this);'}}"><span class="glyphicon glyphicon-trash {{($congDan->tencongdan == $chitietdanhsachtiepcongdan[0]->congdan )?'text-warning glyphicon-edit':'glyphicon-trash'}}"></span></a></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="panel-body">
                                    <div class="form-group form-group-sm">
                                        <label for="congDanKhac" class="control-label col-xs-4">Họ tên công dân </label>
                                        <div class="col-xs-8">
                                            <input class="form-control" type="text" style="text-transform:uppercase" id="congDanKhac" name="tenCDKhac">
                                        </div>
                                    </div>
                                    @foreach($congDanKhac as $congDan)
                                        @if($congDan->enable == ENABLE && $congDan->tencongdan == $chitietdanhsachtiepcongdan[0]->congdan)
                                            <input class="form-control" type="hidden"  name="idChuDon" value="{{$congDan->id}}">
                                        @endif
                                    @endforeach
                                    <div class="form-group form-group-sm" id="danhSachNVDThem" style="display: none">
                                        <div class="control-label col-xs-4"></div>
                                        <div class="col-xs-8">
                                            <a id="danhSachThem" onclick="DonThuTheoNguoiViet(this);" style="cursor:pointer"><i>Danh sách đơn cùng người viết >></i></a>
                                        </div>

                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="diachikntc" class="control-label col-xs-4">Địa chỉ </label>
                                        <div class="col-xs-8">
                                            <input class="form-control" type="text" id="diachikntc" name="diachikntc">
                                        </div>
                                    </div>

                                    <div class="form-group form-group-sm">
                                        <label for="cmt_Id" class="control-label col-xs-4">Số CMND/Hộ chiếu </label>
                                        <div class="col-xs-8">
                                            <input name="cmt_1" type="text" maxlength="15" id="cmt_Id" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm" id="danhSachDTTrungNhauThem" style="display:none ">
                                        <div class="control-label col-xs-4"></div>
                                        <div class="col-xs-8">
                                            <a id="danhSachThemCMT" onclick="DonThuTheoCMT(this);" style="cursor:pointer"><i>Danh sách đơn cùng số CMND/Hộ chiếu >></i></a>
                                        </div>

                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="ngayCap_Id" class="control-label col-xs-4">Ngày cấp </label>
                                        <div class="col-xs-8">
                                            <input name="ngayCap_1" type="text" maxlength="15" id="ngayCap_Id" class="form-control" placeholder="VD: 2017-01-01">
                                        </div>
                                    </div>

                                    <div class="form-group form-group-sm">
                                        <label for="noiCapId" class="control-label col-xs-4">Nơi cấp </label>
                                        <div class="col-xs-8">
                                            <input name="noiCap_1" type="text" maxlength="15" id="noiCapId" class="form-control" value="C.A Tỉnh Phú Thọ">
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="sdtId" class="control-label col-xs-4">Số điện thoại  </label>
                                        <div class="col-xs-8">
                                            <input name="sdt_1" type="number" min="1" maxlength="15" id="sdtId" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <div class="col-xs-8 col-xs-offset-4">
                                            <input type="button" class="btn btn-sm btn-success" value="Thêm" id="addmore" onclick="btnThemCD(this);">
                                            <input type="button" class="btn btn-sm btn-warning" value="luu" id="saveEdit" onclick="btnLuuEdit(this);" style="display:none">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div  id="congDanDon" style="{{($chitietdanhsachtiepcongdan[0]->chuthe == 1)?'':'display: none;'}}">

                        <div class="form-group form-group-sm">
                            <label for="tencongdan" class="control-label col-sm-3">Họ tên công dân <span class="text-danger">(*)</span></label>
                            <div class="col-sm-9">
                                <input name="tencongdan" id="tencongdanId" style="text-transform:uppercase" class="form-control" type="text" value="{{$chitietdanhsachtiepcongdan[0]->congdan}}" required>
                            </div>
                        </div>
                            <div class="form-group form-group-sm" id="danhSachNVD" style="display: none">
                                <div class="control-label col-xs-3"></div>
                                <div class="col-xs-9">
                                    <a id="theoNguoiViet" onclick="DonThuTheoNguoiViet(this);" style="cursor:pointer"><i>Danh sách đơn cùng người viết >></i></a>
                                </div>

                            </div>
                        <div class="form-group form-group-sm">
                            <label for="cmt" class="control-label col-xs-3">Số CMND/Hộ chiếu</label>
                            <div class="col-xs-2">
                                <input name="cmt" type="text" maxlength="15" id="cmtId" class="form-control" value="{{$chitietdanhsachtiepcongdan[0]->cmt}}" >
                            </div>
                            <div class="col-xs-3">
                                <div class="input-group input-group-sm date" >
                                    <span class="input-group-addon">Ngày cấp</span>
                                    <input name="ngaycap" type="text" maxlength="10" id="ngaycapId" class="form-control" placeholder="VD:2017-01-01" value="{{$chitietdanhsachtiepcongdan[0]->ngaycap}}">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">Nơi cấp</span>
                                    <input name="noicap" type="text" maxlength="50" id="noicapId" class="form-control" value="{{$chitietdanhsachtiepcongdan[0]->noicap}}">
                                </div>
                            </div>
                        </div>
                            <div class="form-group form-group-sm" id="danhSachDTTrungNhau" style="display:none ">
                                <div class="control-label col-xs-3"></div>
                                <div class="col-xs-9">
                                    <a id="theoCMT" onclick="DonThuTheoCMT(this);" style="cursor:pointer"><i>Danh sách đơn cùng số CMND/Hộ chiếu >></i></a>
                                </div>

                            </div>
                        <div class="form-group form-group-sm">
                            <label for="tencongdan" class="control-label col-sm-3">Số điện thoại  </label>
                            <div class="col-sm-5">
                                <input name="sdt" id="sdt_id" class="form-control" type="number" min="0" value="{{$chitietdanhsachtiepcongdan[0]->sdt}}">
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label for="diachi" class="control-label col-xs-3">Địa chỉ </label>
                            <div class="col-xs-9">
                                <input name="diachi" type="text" maxlength="200" id="diachiId" class="form-control" value="{{$chitietdanhsachtiepcongdan[0]->diachi}}" >
                            </div>
                        </div>
                        </div>



                        <div class="form-group form-group-sm">
                            <label for="linhvuc" class="control-label col-xs-3">Lĩnh Vực </label>
                            <div class="col-xs-9">
                                <select name="linhvuc" id="linhvuc" class="form-control">
                                    <option value=""></option>
                                    @foreach($linhvucdata as $linhvuc)
                                        @if($chitietdanhsachtiepcongdan[0]->linhvuc == $linhvuc->linhvucid)
                                            <option value="{{$linhvuc->linhvucid}}" selected>{{$linhvuc->tenlinhvuc}}</option>
                                        @else
                                            <option value="{{$linhvuc->linhvucid}}">{{$linhvuc->tenlinhvuc}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="doiTuong" class="control-label col-xs-3">Đối tượng</label>
                            <div class="col-xs-9">
                                <input name="doituong" type="text" maxlength="200" id="doiTuong" class="form-control" value="{{$chitietdanhsachtiepcongdan[0]->doituong}}" >
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label for="noidung" class="control-label col-xs-3">Nội dung công dân trình bày</label>
                            <div class="col-xs-9">
                                <textarea class="form-control" rows="3" cols="20" id="noidung" name="noidung" >{{$chitietdanhsachtiepcongdan[0]->noidung}}</textarea>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label for="coQuanDaGQ_ID" class="control-label col-xs-3">Cơ quan đã giải quyết </label>
                            <div class="col-xs-9">

                                <input name="coQuanDaGQ" type="text"  id="coQuanDaGQ_ID" class="form-control" value="{{$chitietdanhsachtiepcongdan[0]->coquandagiaiquyet}}">
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label for="noiDungDaGQ_ID" class="control-label col-xs-3">Nội dung đã giải quyết </label>
                            <div class="col-xs-9">
                                <textarea class="form-control" rows="3" cols="20" id="noiDungDaGQ_ID" name="noiDungDaGQ"  >{{$chitietdanhsachtiepcongdan[0]->noidungdagiaiquyet}}</textarea>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label for="vuongMacDN_Id" class="control-label col-xs-3">Vướng mắc và đề nghị giải quyết </label>
                            <div class="col-xs-9">
                                <textarea class="form-control" rows="3" cols="20" id="vuongMacDN_Id" name="vuongMacDN" >{{$chitietdanhsachtiepcongdan[0]->vuongmacdenghi}}</textarea>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label for="ketquagiaiquyet" class="control-label col-xs-3">Đề xuất xử lý của cán bộ tiếp dân</label>
                            <div class="col-xs-9">
                                <textarea class="form-control" rows="3" cols="20" id="ketquagiaiquyet" name="ketquagiaiquyet">{{$chitietdanhsachtiepcongdan[0]->ketquagiaiquyet}}</textarea>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label for="ykienlanhdao" class="control-label col-xs-3">Kết luận của chủ trì cuộc tiếp dân</label>
                            <div class="col-xs-9">
                                <textarea class="form-control" rows="3" cols="20" id="ykienlanhdao" name="ykienlanhdao" >{{$chitietdanhsachtiepcongdan[0]->ykienlanhdao}}</textarea>
                            </div>
                        </div>




                        <div class="form-group form-group-sm">
                            <label class="control-label col-xs-3"> Tài liệu đính kèm</label>

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
                                        <span id="addfile" class="btn btn-xs btn-success glyphicon glyphicon-plus"  style="cursor: pointer" onclick="AddInput()"></span>
                                        <span id="remove" class="btn btn-xs btn-danger glyphicon glyphicon-minus" onclick="RemoveInput();" style="cursor: pointer"></span>
                                    </div>
                                    @if($array_file!= null)

                                        <div id="hienthifile" class="col-xs-10" style="margin-top: 10px">
                                            @for($i = 0;$i<count($array_file);$i++)
                                                <a href="{{url($chitietdanhsachtiepcongdan[0]->filepath."/".$array_file[$i])}}" title='Tải về' download>
                                                    <img id="hinhanhdaidien" src="{{url('/img/file.png')}}" style="height:25px;width:20px"/>&nbsp;{{$array_file[$i]}}
                                                </a>
                                            @endfor
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <input id="tabletemp" type="hidden" name="tabletemp" >
                        <input id="dataSaveId" type="hidden" name="dataSave" >
                        <input id="dataDeleteId" type="hidden" name="dataDelete" >


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

                                <a href="{{url('danhsachtiepcongdan')}}" title="Hủy" class="btn btn-sm btn-danger">
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

        $(document).ready(function(){

            $('#ngaytiep').datepicker({
                format:'yyyy-mm-dd'
            });

            $('#ngaycap').datepicker({
                format:'yyyy-mm-dd'
            });

            $('#ngayCap_Id').datepicker({
                format:'yyyy-mm-dd'
            });

        });

        function ChonDiaBan()
        {
            var url ="{{url('/diabantable')}}" ;
            OpenPopupGetData(url,400,380);
        }

        NumberOnly();

        var nguoiTiepDatabase = <?php echo json_encode($chitietdanhsachtiepcongdan[0]->lanhdao) ;?>;

        var nguoiTiepDatabaseArray = nguoiTiepDatabase.split(",");

        //add input file
        var soNguoi = nguoiTiepDatabaseArray.length;
        function addNguoiTiep() {

            if (soNguoi < 5) {
                soNguoi = soNguoi + 1;
                var formNguoiTiep = $('#formNguoiTiep' + soNguoi);
                formNguoiTiep.show();

                var nguoiTiep = $('#nguoitiep' + soNguoi);
                nguoiTiep.prop('required',true);

                var chucVu = $('#chucvu' + soNguoi);
                chucVu.prop('required',true);
            }
        }
        function removeNguoiTiep() {

            if (soNguoi > 1) {
                var nguoiTiep = $('#nguoitiep' + soNguoi);
                nguoiTiep.prop('required',false);
                nguoiTiep.val('');

                var chucVu = $('#chucvu' + soNguoi);
                chucVu.prop('required',false);
                chucVu.val('');

                var formNguoiTiep = $('#formNguoiTiep' + soNguoi);
                formNguoiTiep.hide();
                soNguoi = soNguoi - 1;
            }

        }

        function showHinhThuc(d)
        {
            if(d.id == "loaihinh" ){
                if(d.value == "1")
                {
                    AnHienPanel('#hinhThuc1',true);
                    AnHienPanel('#hinhThuc2',false);
                }
                else if(d.value == "2")
                {
                    AnHienPanel('#hinhThuc2',true);
                    AnHienPanel('#hinhThuc1',false);
                }
                else
                {
                    AnHienPanel('#hinhThuc1',false);
                    AnHienPanel('#hinhThuc2',false);
                }
            }
            else {
                if(d.value == "2" ){
                    AnHienPanel('#nhom',true);
                    AnHienPanel('#congDanDon',false);
                }
                else {
                    AnHienPanel('#nhom',false);
                    AnHienPanel('#congDanDon',true);
                    resetThongTin();
                }
            }
        }

        var stt = 1;
        function btnThemCD(d)
        {
            var tenCD = $('#congDanKhac').val();
            var diaChi = $('#diachikntc').val();
            var cmt = $('#cmt_Id').val();
            var ngayCap = $('#ngayCap_Id').val();
            var noiCap = $('#noiCapId').val();
            var sdt = $('#sdt_Id').val();
            var sothuly = $('#sothuly').val();

            if(tenCD!="")
            {
                $.ajax({
                    type: 'get',
                    url:  '{{URL::to('themcongdankhac')}}',
                    data: {
                        sothuly:sothuly,
                        tenCongDan:tenCD,
                        diaChi: diaChi,
                        cmt:cmt,
                        ngayCap:ngayCap,
                        noiCap:noiCap,
                        sodt:sdt,
                        type:'tiepdan'
                    },
                    success: function (data) {

                        if (data.length>0)
                        {
                            var sdt = '';
                            if(data[4]!= null)
                            {
                                sdt = data[4];
                            }
                            AnHienPanel('#congDanThamGia',true);
                            $(function () {
                                $('#bodytable').append('<tr id="'+data[0]+'">' +
                                        '<td>' + data[1] + '</td>' +
                                        '<td>' + data[2] + '</td>' +
                                        '<td >' + data[3] + '</td>' +
                                        '<td >' + sdt + '</td>' +
                                        '<td class="text-center">' +
                                        '<a id="' + data[0] + '.'+data[3]+'" class="text-danger" onclick="DeleteCongDan(this);">' +
                                        '<span class="glyphicon glyphicon-trash">' + '</span>' +
                                        '</a>' +
                                        '</td>' +
                                        '</tr>');
                            });

                            var valueSave = $('#dataSaveId').val();
                            var saveId = data[0];
                            if(valueSave == "")
                            {
                                valueSave = saveId;
                            }
                            else
                            {
                                valueSave = valueSave+'.'+saveId;
                            }
                            $('#dataSaveId').val(valueSave);

                            $('#congDanKhac').val(null);
                            $('#diachikntc').val(null);
                            $('#cmt_Id').val(null);
                            $('#ngayCap_Id').val(null);
                            $('#noiCapId').val(null);
                            $('#sdtId').val(null);
                        }
                    }
                });
            }
            else
            {
                var str = "";

                str += CheckInput('congDanKhac', "Vui lòng nhập tên công dân.\r\n");

                if (str.length > 0) {
                    alert(str);
                }
            }
        }

        function DeleteCongDan(d)
        {

            var congDanId =  d.id.split('.');
            congDanId = congDanId[0];

            var valueDelete = $('#dataDeleteId').val();
            var deleteId = congDanId;
            if(valueDelete == "")
            {
                valueDelete = deleteId;
            }
            else
            {
                valueDelete = valueDelete+'.'+deleteId;
            }
            $('#dataDeleteId').val(valueDelete);

            $('#'+congDanId).hide();
        }

        var lanhDao = <?php echo json_encode($lanhDao);?>;
        var chucVu = <?php echo json_encode($chucVu);?>;

        $( function() {
            $( ".autoLanhDao" ).autocomplete({
                lookup: lanhDao
            });
        } );

        $( function() {
            $( ".chucVuClass" ).autocomplete({
                lookup: chucVu
            });
        } );

        //chinh sua cong dan
        var editId = "";
        function ChinhSuaCongDan(d)
        {
            editId =  d.id.split('.');
            editId = editId[0];
            var tenEdit =  $('#tencongdanId').val();
            var diaChiEdit =  $('#diachiId').val();
            var cmtEdit =  $('#cmtId').val();
            var ngayCapEdit =   $('#ngaycapId').val();
            var noiCapEdit =   $('#noicapId').val();
            var sdtEdit =   $('#sdt_id').val();

            $('#congDanKhac').val(tenEdit);
            $('#diachikntc').val(diaChiEdit);
            $('#cmt_Id').val(cmtEdit);
            $('#ngayCap_Id').val(ngayCapEdit);
            $('#noiCapId').val(noiCapEdit);
            $('#sdtId').val(sdtEdit);

            AnHienPanel('#saveEdit',true);
            AnHienPanel('#addmore',false);


        }

        //save
        function btnLuuEdit(d)
        {
            var tenSave =  $('#congDanKhac').val();
            var diaChiSave =  $('#diachikntc').val();
            var cmtSave =  $('#cmt_Id').val();
            var ngayCapSave =   $('#ngayCap_Id').val();
            var noiCapSave =   $('#noiCapId').val();
            var sdtSave =   $('#sdtId').val();

            $('#tencongdanId').val(tenSave);
            $('#diachiId').val(diaChiSave);
            $('#cmtId').val(cmtSave);
            $('#ngaycapId').val(ngayCapSave);
            $('#noicapId').val(noiCapSave);
            $('#sdt_id').val(sdtSave);

            $('#ten_'+editId).html(tenSave);
            $('#diachi_'+editId).html(diaChiSave);
            $('#cmt_'+editId).html(cmtSave);
            $('#sdt_'+editId).html(sdtSave);

            $('#congDanKhac').val(null);
            $('#diachikntc').val(null);
            $('#cmt_Id').val(null);
            $('#ngayCap_Id').val(null);
            $('#noiCapId').val(null);
            $('#sdtId').val(null);

            AnHienPanel('#saveEdit',false);
            AnHienPanel('#addmore',true);
        }

        //reset
        var dataCongDan = <?php echo json_encode($chitietdanhsachtiepcongdan[0]);?>;
        function resetThongTin()
        {

            $('#dataDeleteId').val(null);
            $('#dataSaveId').val(null);

            $('#tencongdanId').val(dataCongDan['congdan']);
            $('#diachiId').val(dataCongDan['diachi']);
            $('#cmtId').val(dataCongDan['cnt']);
            $('#ngaycapId').val(dataCongDan['ngaycap']);
            $('#noicapId').val(dataCongDan['noicap']);
            $('#sdt_id').val(dataCongDan['sdt']);

            $('#ten_'+editId).html(dataCongDan['congdan']);
            $('#diachi_'+editId).html(dataCongDan['diachi']);
            $('#cmt_'+editId).html(dataCongDan['cmt']);
            $('#sdt_'+editId).html(dataCongDan['sdt']);

        }


        //

        $('#cmt_Id').keyup(function(){
            var cmt_value= $('#cmt_Id').val();
            if(cmt_value != "")
            {
                $.ajax({
                    type: 'get',
                    url: '{{URL::to('donthugiongnhau')}}',
                    data: {
                        value:cmt_value,
                        filed:'cmnd_hc',
                        table:'donthu'
                    },
                    success: function (data) {

                        if(data != "")
                        {
                            $('#danhSachDTTrungNhauThem').show();
                        }
                        else
                        {
                            $('#danhSachDTTrungNhauThem').hide();
                        }
                    }
                });
            }

        });
        //
        $('#cmtId').keyup(function(){
            var cmt_value= $('#cmtId').val();
            if(cmt_value != "")
            {
                $.ajax({
                    type: 'get',
                    url: '{{URL::to('donthugiongnhau')}}',
                    data: {
                        value:cmt_value,
                        filed:'cmnd_hc',
                        table:'donthu'
                    },
                    success: function (data) {

                        console.log(data);
                        if(data != "")
                        {
                            $('#danhSachDTTrungNhau').show();
                        }
                        else
                        {
                            $('#danhSachDTTrungNhau').hide();
                        }
                    }
                });
            }

        });

        function DonThuTheoCMT(d)
        {
            var  cmtValue ="";
            if (d.id == "danhSachThemCMT")
            {
                cmtValue = $('#cmt_Id').val()+'*'+'cmnd_hc'+'*'+'donthu';
            }
            else
            {
                cmtValue = $('#cmtId').val()+'*'+'cmnd_hc'+'*'+'donthu';
            }


            var url ="{{url('/danhSachDonThuCungCMT')}}";
            OpenPopup(url,cmtValue,590,400);
        }

        //ten cong dan
        $("#congDanKhac").keyup(function() {
//            if(e.which == 13) {
            var tenNguoiVD = $('#congDanKhac').val();
            if(tenNguoiVD != "")
            {
                $.ajax({
                    type: 'get',
                    url: '{{URL::to('donthugiongnhau')}}',
                    data: {
                        value:tenNguoiVD,
                        filed:'tennguoivietdon',
                        table:'donthu'
                    },
                    success: function (data) {

                        if(data != "")
                        {
                            $('#danhSachNVDThem').show();
                        }
                        else
                        {
                            $('#danhSachNVDThem').hide();
                        }
                    }
                });
            }
//            }
        });

        $("#tencongdanId").keyup(function() {
//            if(e.which == 13) {
            var tenNguoiVD = $('#tencongdanId').val();
            if(tenNguoiVD != "")
            {
                $.ajax({
                    type: 'get',
                    url: '{{URL::to('donthugiongnhau')}}',
                    data: {
                        value:tenNguoiVD,
                        filed:'tennguoivietdon',
                        table:'donthu'
                    },
                    success: function (data) {
                        if(data != "")
                        {
                            $('#danhSachNVD').show();
                        }
                        else
                        {
                            $('#danhSachNVD').hide();
                        }
                    }
                });
            }
//            }
        });

        function DonThuTheoNguoiViet(d)
        {
            var  tenNguoiVD = "";
            if (d.id == "danhSachThem")
            {
                tenNguoiVD = $('#congDanKhac').val()+'*'+'tennguoivietdon'+'*'+'donthu';
            }
            else
            {
                tenNguoiVD = $('#tencongdanId').val()+'*'+'tennguoivietdon'+'*'+'donthu';
            }

            var url ="{{url('/danhSachDonThuCungCMT')}}";
            OpenPopup(url,tenNguoiVD,590,400);
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

        $(function() {
            $('#chuTri').on('input',function() {
                var opt = $('option[value="'+$(this).val()+'"]');
                if(opt.length)
                {
                    $.ajax({
                        type: 'post',
                        url:  '{{URL::to('getChucVuTheoId')}}',
                        data: {
                            id: opt.attr('id')
                        },
                        success: function (response) {

                            $('#chucVuCT').val(response['tenChucVu']);
                        }

                    });
                }
                else{
                    $('#chucVuCT').val("");
                }
            });
        });

    </script>

@endsection
