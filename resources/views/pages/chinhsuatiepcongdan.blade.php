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

    <div class="col-background" id="" style="margin-bottom: 100px;">
        <div class="panel panel-default panel-min-height">
            <div class="panel-heading text-center">Tra cứu đơn</div>

            <form role="form" id="tiepcongdan" name="xacminh" method="post" action="submitchinhsuatiepcongdan/{{$chitietlichtiepdan[0]->id}}" enctype="multipart/form-data">
                {{csrf_field() }}
                <input name="accountname" type="text" id="accountname" style="display: none" value="{{$accountname = Session::get('accountname')}}">
                <div class="panel-body">
                    <div class="form-horizontal">
                        {{--<div class="form-group form-group-sm">--}}
                            {{--<label for="nguoitiep" class="control-label col-xs-2">Người tiếp <span class="text-danger">(*)</span></label>--}}
                            {{--<div class="col-xs-10">--}}
                                {{--<input id="nguoitiep" name="nguoitiep" class="form-control" type="text" value="{{$chitietlichtiepdan[0]->nguoitiep}}" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <?php
                            $nguoiTiepArray = explode(',', $chitietlichtiepdan[0]->nguoitiep);
                            $chucvuArray = explode(',', $chitietlichtiepdan[0]->chucvu);
                        ?>

                        @if(1 == count($nguoiTiepArray))
                        <div class="form-group form-group-sm" id="formNguoiTiep1">
                            <label for="nguoitiep1" class="control-label col-xs-2">Người tiếp <span class="text-danger">(*)</span></label>
                            <div class="col-xs-5">
                                <input id="nguoitiep1" name="nguoitiep1" class="form-control" type="text" value="{{$nguoiTiepArray[0]}}" required>
                            </div>
                            <label for="chucvu1" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                            <div class="col-xs-3">
                                <input id="chucvu1" name="chucvu1" class="form-control" type="text" value="{{$chucvuArray[0]}}" required>
                            </div>
                            <div class="col-xs-1 text-right">
                                <span id="addNguoiTiep" class="btn btn-xs btn-success glyphicon glyphicon-plus"  style="cursor: pointer" onclick="addNguoiTiep()"></span>
                                <span id="removeNguoiTiep" class="btn btn-xs btn-danger glyphicon glyphicon-minus" onclick="removeNguoiTiep();" style="cursor: pointer"></span>
                            </div>
                        </div>
                        <div class="form-group form-group-sm" id="formNguoiTiep2" style="display: none">
                            <label for="nguoitiep2" class="control-label col-xs-2">Người tiếp 2 <span class="text-danger">(*)</span></label>
                            <div class="col-xs-5">
                                <input id="nguoitiep2" name="nguoitiep2" class="form-control" type="text">
                            </div>
                            <label for="chucvu2" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                            <div class="col-xs-3">
                                <input id="chucvu2" name="chucvu2" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="form-group form-group-sm" id="formNguoiTiep3" style="display: none">
                            <label for="nguoitiep3" class="control-label col-xs-2">Người tiếp 3 <span class="text-danger">(*)</span></label>
                            <div class="col-xs-5">
                                <input id="nguoitiep3" name="nguoitiep3" class="form-control" type="text">
                            </div>
                            <label for="chucvu3" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                            <div class="col-xs-3">
                                <input id="chucvu3" name="chucvu3" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="form-group form-group-sm" id="formNguoiTiep4" style="display: none">
                            <label for="nguoitiep4" class="control-label col-xs-2">Người tiếp 4 <span class="text-danger">(*)</span></label>
                            <div class="col-xs-5">
                                <input id="nguoitiep4" name="nguoitiep4" class="form-control" type="text">
                            </div>
                            <label for="chucvu4" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                            <div class="col-xs-3">
                                <input id="chucvu4" name="chucvu4" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="form-group form-group-sm" id="formNguoiTiep5" style="display: none">
                            <label for="nguoitiep5" class="control-label col-xs-2">Người tiếp 5 <span class="text-danger">(*)</span></label>
                            <div class="col-xs-5">
                                <input id="nguoitiep5" name="nguoitiep5" class="form-control" type="text">
                            </div>
                            <label for="chucvu5" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                            <div class="col-xs-3">
                                <input id="chucvu5" name="chucvu5" class="form-control" type="text">
                            </div>
                        </div>

                        @elseif(2 == count($nguoiTiepArray))
                            <div class="form-group form-group-sm" id="formNguoiTiep1">
                                <label for="nguoitiep1" class="control-label col-xs-2">Người tiếp <span class="text-danger">(*)</span></label>
                                <div class="col-xs-5">
                                    <input id="nguoitiep1" name="nguoitiep1" class="form-control" type="text" value="{{$nguoiTiepArray[0]}}" required>
                                </div>
                                <label for="chucvu1" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu1" name="chucvu1" class="form-control" type="text" value="{{$chucvuArray[0]}}" required>
                                </div>
                                <div class="col-xs-1 text-right">
                                    <span id="addNguoiTiep" class="btn btn-xs btn-success glyphicon glyphicon-plus"  style="cursor: pointer" onclick="addNguoiTiep()"></span>
                                    <span id="removeNguoiTiep" class="btn btn-xs btn-danger glyphicon glyphicon-minus" onclick="removeNguoiTiep();" style="cursor: pointer"></span>
                                </div>
                            </div>
                            <div class="form-group form-group-sm" id="formNguoiTiep2">
                                <label for="nguoitiep2" class="control-label col-xs-2">Người tiếp 2 <span class="text-danger">(*)</span></label>
                                <div class="col-xs-5">
                                    <input id="nguoitiep2" name="nguoitiep2" class="form-control" type="text" value="{{$nguoiTiepArray[1]}}" required>
                                </div>
                                <label for="chucvu2" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu2" name="chucvu2" class="form-control" type="text" value="{{$chucvuArray[1]}}" required>
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep3" style="display: none">
                                <label for="nguoitiep3" class="control-label col-xs-2">Người tiếp 3 <span class="text-danger">(*)</span></label>
                                <div class="col-xs-5">
                                    <input id="nguoitiep3" name="nguoitiep3" class="form-control" type="text">
                                </div>
                                <label for="chucvu3" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu3" name="chucvu3" class="form-control" type="text">
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep4" style="display: none">
                                <label for="nguoitiep4" class="control-label col-xs-2">Người tiếp 4 <span class="text-danger">(*)</span></label>
                                <div class="col-xs-5">
                                    <input id="nguoitiep4" name="nguoitiep4" class="form-control" type="text">
                                </div>
                                <label for="chucvu4" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu4" name="chucvu4" class="form-control" type="text">
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep5" style="display: none">
                                <label for="nguoitiep5" class="control-label col-xs-2">Người tiếp 5 <span class="text-danger">(*)</span></label>
                                <div class="col-xs-5">
                                    <input id="nguoitiep5" name="nguoitiep5" class="form-control" type="text">
                                </div>
                                <label for="chucvu5" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu5" name="chucvu5" class="form-control" type="text">
                                </div>
                            </div>
                        @elseif(3 == count($nguoiTiepArray))
                            <div class="form-group form-group-sm" id="formNguoiTiep1">
                                <label for="nguoitiep1" class="control-label col-xs-2">Người tiếp <span class="text-danger">(*)</span></label>
                                <div class="col-xs-5">
                                    <input id="nguoitiep1" name="nguoitiep1" class="form-control" type="text" value="{{$nguoiTiepArray[0]}}" required>
                                </div>
                                <label for="chucvu1" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu1" name="chucvu1" class="form-control" type="text" value="{{$chucvuArray[0]}}" required>
                                </div>
                                <div class="col-xs-1 text-right">
                                    <span id="addNguoiTiep" class="btn btn-xs btn-success glyphicon glyphicon-plus"  style="cursor: pointer" onclick="addNguoiTiep()"></span>
                                    <span id="removeNguoiTiep" class="btn btn-xs btn-danger glyphicon glyphicon-minus" onclick="removeNguoiTiep();" style="cursor: pointer"></span>
                                </div>
                            </div>
                            <div class="form-group form-group-sm" id="formNguoiTiep2">
                                <label for="nguoitiep2" class="control-label col-xs-2">Người tiếp 2 <span class="text-danger">(*)</span></label>
                                <div class="col-xs-5">
                                    <input id="nguoitiep2" name="nguoitiep2" class="form-control" type="text" value="{{$nguoiTiepArray[1]}}" required>
                                </div>
                                <label for="chucvu2" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu2" name="chucvu2" class="form-control" type="text" value="{{$chucvuArray[1]}}" required>
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep3">
                                <label for="nguoitiep3" class="control-label col-xs-2">Người tiếp 3 <span class="text-danger">(*)</span></label>
                                <div class="col-xs-5">
                                    <input id="nguoitiep3" name="nguoitiep3" class="form-control" type="text" value="{{$nguoiTiepArray[2]}}" required>
                                </div>
                                <label for="chucvu3" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu3" name="chucvu3" class="form-control" type="text" value="{{$chucvuArray[2]}}" required>
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep4" style="display: none">
                                <label for="nguoitiep4" class="control-label col-xs-2">Người tiếp 4 <span class="text-danger">(*)</span></label>
                                <div class="col-xs-5">
                                    <input id="nguoitiep4" name="nguoitiep4" class="form-control" type="text">
                                </div>
                                <label for="chucvu4" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu4" name="chucvu4" class="form-control" type="text">
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep5" style="display: none">
                                <label for="nguoitiep5" class="control-label col-xs-2">Người tiếp 5 <span class="text-danger">(*)</span></label>
                                <div class="col-xs-5">
                                    <input id="nguoitiep5" name="nguoitiep5" class="form-control" type="text">
                                </div>
                                <label for="chucvu5" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu5" name="chucvu5" class="form-control" type="text">
                                </div>
                            </div>
                        @elseif(4 == count($nguoiTiepArray))
                            <div class="form-group form-group-sm" id="formNguoiTiep1">
                                <label for="nguoitiep1" class="control-label col-xs-2">Người tiếp <span class="text-danger">(*)</span></label>
                                <div class="col-xs-5">
                                    <input id="nguoitiep1" name="nguoitiep1" class="form-control" type="text" value="{{$nguoiTiepArray[0]}}" required>
                                </div>
                                <label for="chucvu1" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu1" name="chucvu1" class="form-control" type="text" value="{{$chucvuArray[0]}}" required>
                                </div>
                                <div class="col-xs-1 text-right">
                                    <span id="addNguoiTiep" class="btn btn-xs btn-success glyphicon glyphicon-plus"  style="cursor: pointer" onclick="addNguoiTiep()"></span>
                                    <span id="removeNguoiTiep" class="btn btn-xs btn-danger glyphicon glyphicon-minus" onclick="removeNguoiTiep();" style="cursor: pointer"></span>
                                </div>
                            </div>
                            <div class="form-group form-group-sm" id="formNguoiTiep2">
                                <label for="nguoitiep2" class="control-label col-xs-2">Người tiếp 2 <span class="text-danger">(*)</span></label>
                                <div class="col-xs-5">
                                    <input id="nguoitiep2" name="nguoitiep2" class="form-control" type="text" value="{{$nguoiTiepArray[1]}}" required>
                                </div>
                                <label for="chucvu2" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu2" name="chucvu2" class="form-control" type="text" value="{{$chucvuArray[1]}}" required>
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep3">
                                <label for="nguoitiep3" class="control-label col-xs-2">Người tiếp 3 <span class="text-danger">(*)</span></label>
                                <div class="col-xs-5">
                                    <input id="nguoitiep3" name="nguoitiep3" class="form-control" type="text" value="{{$nguoiTiepArray[2]}}" required>
                                </div>
                                <label for="chucvu3" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu3" name="chucvu3" class="form-control" type="text" value="{{$chucvuArray[2]}}" required>
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep4">
                                <label for="nguoitiep4" class="control-label col-xs-2">Người tiếp 4 <span class="text-danger">(*)</span></label>
                                <div class="col-xs-5">
                                    <input id="nguoitiep4" name="nguoitiep4" class="form-control" type="text" value="{{$nguoiTiepArray[3]}}" required>
                                </div>
                                <label for="chucvu4" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu4" name="chucvu4" class="form-control" type="text" value="{{$chucvuArray[3]}}" required>
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep5" style="display: none">
                                <label for="nguoitiep5" class="control-label col-xs-2">Người tiếp 5 <span class="text-danger">(*)</span></label>
                                <div class="col-xs-5">
                                    <input id="nguoitiep5" name="nguoitiep5" class="form-control" type="text">
                                </div>
                                <label for="chucvu5" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu5" name="chucvu5" class="form-control" type="text">
                                </div>
                            </div>

                        @elseif(5 == count($nguoiTiepArray))
                            <div class="form-group form-group-sm" id="formNguoiTiep1">
                                <label for="nguoitiep1" class="control-label col-xs-2">Người tiếp <span class="text-danger">(*)</span></label>
                                <div class="col-xs-5">
                                    <input id="nguoitiep1" name="nguoitiep1" class="form-control" type="text" value="{{$nguoiTiepArray[0]}}" required>
                                </div>
                                <label for="chucvu1" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu1" name="chucvu1" class="form-control" type="text" value="{{$chucvuArray[0]}}" required>
                                </div>
                                <div class="col-xs-1 text-right">
                                    <span id="addNguoiTiep" class="btn btn-xs btn-success glyphicon glyphicon-plus"  style="cursor: pointer" onclick="addNguoiTiep()"></span>
                                    <span id="removeNguoiTiep" class="btn btn-xs btn-danger glyphicon glyphicon-minus" onclick="removeNguoiTiep();" style="cursor: pointer"></span>
                                </div>
                            </div>
                            <div class="form-group form-group-sm" id="formNguoiTiep2">
                                <label for="nguoitiep2" class="control-label col-xs-2">Người tiếp 2 <span class="text-danger">(*)</span></label>
                                <div class="col-xs-5">
                                    <input id="nguoitiep2" name="nguoitiep2" class="form-control" type="text" value="{{$nguoiTiepArray[1]}}" required>
                                </div>
                                <label for="chucvu2" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu2" name="chucvu2" class="form-control" type="text" value="{{$chucvuArray[1]}}" required>
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep3">
                                <label for="nguoitiep3" class="control-label col-xs-2">Người tiếp 3 <span class="text-danger">(*)</span></label>
                                <div class="col-xs-5">
                                    <input id="nguoitiep3" name="nguoitiep3" class="form-control" type="text" value="{{$nguoiTiepArray[2]}}" required>
                                </div>
                                <label for="chucvu3" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu3" name="chucvu3" class="form-control" type="text" value="{{$chucvuArray[2]}}" required>
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep4">
                                <label for="nguoitiep4" class="control-label col-xs-2">Người tiếp 4 <span class="text-danger">(*)</span></label>
                                <div class="col-xs-5">
                                    <input id="nguoitiep4" name="nguoitiep4" class="form-control" type="text" value="{{$nguoiTiepArray[3]}}" required>
                                </div>
                                <label for="chucvu4" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu4" name="chucvu4" class="form-control" type="text" value="{{$chucvuArray[3]}}" required>
                                </div>
                            </div>

                            <div class="form-group form-group-sm" id="formNguoiTiep5">
                                <label for="nguoitiep5" class="control-label col-xs-2">Người tiếp 5 <span class="text-danger">(*)</span></label>
                                <div class="col-xs-5">
                                    <input id="nguoitiep5" name="nguoitiep5" class="form-control" type="text" value="{{$nguoiTiepArray[4]}}" required>
                                </div>
                                <label for="chucvu5" class="control-label col-xs-1">Chức Vụ <span class="text-danger">(*)</span></label>
                                <div class="col-xs-3">
                                    <input id="chucvu5" name="chucvu5" class="form-control" type="text" value="{{$chucvuArray[4]}}" required>
                                </div>
                            </div>
                        @else

                        @endif

                        <div class="form-group form-group-sm">
                            <label for="diadiem" class="control-label col-xs-2">Địa điểm <span class="text-danger">(*)</span></label>
                            <div class="col-xs-10">
                                <input id="diadiem" name="diadiem" class="form-control" type="text" value="{{$chitietlichtiepdan[0]->diadiem}}" required>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="ngaytiep" class="control-label col-xs-2">Ngày tiếp </label>
                            <div class="col-xs-10 input-group input-group-sm" style="padding-left: 15px">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                </span>
                                <input id="ngaytiep" name="ngaytiep" type="text" value="{{$chitietlichtiepdan[0]->ngaytiep}}" class="form-control" placeholder="dd-mm-yyyy" data-provide="datepicker" style="width:120px;" required>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="dotxuat" class="control-label col-xs-2">Đột xuất</label>
                            <div class="col-xs-10" >
                                <div class="checkbox checkbox-primary">
                                    @if($chitietlichtiepdan[0]->dotxuat == DOTXUAT)
                                        <input id="dotxuat" type="checkbox" name="dotxuat" checked>
                                        <label for="dotxuat" style="display: inline-block !important;"></label>
                                    @else
                                        <input id="dotxuat" type="checkbox" name="dotxuat" />
                                        <label for="dotxuat" style="display: inline-block !important;"></label>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <div class="col-xs-4 col-xs-offset-2">
                                <button type="submit" name="btnok" id="btnok" title="Lưu" class="btn btn-sm btn-success">
                                    <span class="glyphicon glyphicon-saved" aria-hidden="true"></span>
                                    Lưu
                                </button>

                                <a href="{{url('tiepcongdan')}}" name="btncancel" id="btncancel" title="Hủy thao tác, trở lại trang danh sách" class="btn btn-sm btn-danger">
                                    <span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
                                    Hủy
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){

            $('#ngaytiep').datepicker({
                format:'yyyy-mm-dd'
            });

        });

        function ChonDiaBan()
        {
            var url ="{{url('/diabantable')}}" ;
            OpenPopupGetData(url,400,380);
        }

        var nguoiTiepDatabase = <?php echo json_encode($chitietlichtiepdan[0]->nguoitiep) ;?>;

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
    </script>

@endsection
