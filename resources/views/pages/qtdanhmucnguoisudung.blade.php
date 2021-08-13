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
        //document.getElementById("htab-hethong").style.display = 'block';
        var element1 = document.getElementById("nguoisudung");
        element1.classList.add("active");
        var element = document.getElementById("htab-hethong");
        element.classList.add("active");
        element.classList.add("in");

    </script>
    <div class="container-fluid" style="margin-bottom: 40px; padding: 10px 15px">
        <div class="col-background">
            <div id="quantringuoisudung" class="panel panel-default panel-min-height">
                <div class="panel-heading text-center">QUẢN TRỊ DANH MỤC NGƯỜI SỬ DỤNG</div>
                <div class="panel-body">
                    <div class="toolbar">
                        <a role="button" href="{{url('/themnguoisudung')}}" class="btn btn-success btn-sm" title="tạo đơn" id="btnThem"><span class="glyphicon glyphicon-plus"></span>Thêm</a>
                    </div>
                </div>

                <?php
                    $accountdata = $nguoisudung[0]['accountdata'];
                    $accountinfodata = $nguoisudung[0]['accountinfodata'];
                    $accountmanagerdata = $nguoisudung[0]['accountmanagerdata'];
                    $tendonvidata = $nguoisudung[0]['tendonvidata'];

                    $datalength = count($accountdata);
                ?>

                <table class="table table-bordered table-hover" style="border-collapse: collapse">
                    <thead>
                        <tr>
                            <th>Tên đăng nhập</th>
                            <th>Tên hiển thị</th>
                            <th>Chức vụ</th>
                            <th>Đơn vị</th>
                            <th>Quyền</th>
                            <th>Trạng thái</th>
                            <th>Xử lý</th>
                        </tr>
                    </thead>
                    <tbody>

                    @for($i = 0; $i<$datalength; $i++)
                        <tr>
                            <td>{{$accountdata[$i]->accountname}}</td>
                            <td>{{$accountinfodata[$i]->fullname}}</td>
                            <td>{{$accountinfodata[$i]->chucvu}}</td>
                            <td>{{$tendonvidata[$i]}}</td>
                            <td>{{$tennhomquyen[$i]}}</td>
                            @if($accountdata[$i]->status == 1)
                                <td class="text-center"><span class='glyphicon glyphicon-ok text-success'></span></td>
                            @else
                                <td class="text-center"><span class='glyphicon glyphicon-ban-circle text-danger'></span></td>
                            @endif
                            <td class="text-center">
                                <button type="button" id="{{$accountdata[$i]->accountid}}" value="{{$accountdata[$i]->status}}" onclick="doitrangthainguoisudung(this.id,this.value)" title="Đổi trạng thái người sử dụng" class="btn btn-xs btn-success">
                                    <span class="glyphicon glyphicon-refresh"></span>
                                </button>
                                <a href="{{url('chinhsuanguoisudung/'.$accountdata[$i]->accountid)}}" class="btn btn-xs btn-warning" title="Sửa">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                <button type="button" value="{{$accountdata[$i]->accountid}}" onclick="xoanguoisudung(this.value)" title="Xóa người sử dụng" class="btn btn-xs btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </td>
                        </tr>
                    @endfor
                    </tbody>
                </table>

                <div class="panel-body text-center">
                    <ul class="pagination">
                        <li>
                            <span>Trang {{$accountdata->currentPage().'/'.$accountdata->lastPage()}}</span>
                        </li>
                        <li @if($accountdata->currentPage() == 1) class="disabled" @endif>
                            <a @if($accountdata->currentPage() != 1) href="{{$accountdata->url(1)}}" @endif>
                                <<
                            </a>
                        </li>
                        <li @if($accountdata->currentPage() == 1) class="disabled" @endif>
                            <a @if($accountdata->currentPage() != 1) href="{{$accountdata->previousPageUrl()}}" @endif>
                                <
                            </a>
                        </li>
                        <li class="active">
                            <span>{{$accountdata->currentPage()}}</span>
                        </li>
                        <li @if($accountdata->currentPage() == $accountdata->lastPage()) class="disabled" @endif>
                            <a @if($accountdata->currentPage() != $accountdata->lastPage()) href="{{$accountdata->nextPageUrl()}}" @endif>
                                >
                            </a>
                        </li>
                        <li @if($accountdata->currentPage() == $accountdata->lastPage()) class="disabled" @endif>

                            <a @if($accountdata->currentPage() != $accountdata->lastPage()) href="{{$accountdata->url($accountdata->lastPage())}}" @endif>
                                >>
                            </a>

                        </li>
                        <li>
                            <p style="margin-left: 15px;display: inline">Hiển thị:
                                <select id="hienthi" class="form-control" style="width: auto;display: inline;" onchange="">
                                    <option value="10" selected="selected">10</option>
                                </select>
                                dòng
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        function doitrangthainguoisudung(id,value){

            var newtrangthai = 0;
            var confirmdoitrangthai = false;
            if(value == 1){
                newtrangthai = 0;
                confirmdoitrangthai = confirm('Bạn muốn ngừng sử dụng account nhân viên này đúng không?');
            }else{
                newtrangthai = 1;
                confirmdoitrangthai = confirm('Bạn muốn sử dụng account nhân viên này đúng không?');
            }

            if (confirmdoitrangthai) {
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '{{URL::to('doitrangthainguoisudung')}}',
                    data: {
                        nguoisudungid: id,
                        newtrangthai: newtrangthai
                    },
                    success: function (response) {

                        if (response['doitrangthainguoisudung_result'] == 'successful') {
                            window.location.reload(true);
                        } else {

                        }
                    }
                });
            }
        }

        function xoanguoisudung(id){

            var confirmxoa = confirm('Bạn có muốn xóa nhân viên này không?');

            if (confirmxoa) {
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url:  '{{URL::to('xoanguoisudung')}}',
                    data: {
                        nguoisudungid: id
                    },
                    success: function (response) {

                        if(response['xoanguoisudung_result'] == 'successful') {
                            window.location.reload(true);
                        }else {

                        }
                    }
                });
            }
        }

    </script>
@endsection
