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
        var element1 = document.getElementById("nhomsudung");
        element1.classList.add("active");
        var element = document.getElementById("htab-hethong");
        element.classList.add("active");
        element.classList.add("in");

    </script>

    <div class="container-fluid" style="margin-bottom: 40px; padding: 10px 15px">
        <div class="col-background">
            <div id="quantrinhomnguoisudung" class="panel panel-default panel-min-height">
                <div class="panel-heading text-center">QUẢN TRỊ DANH MỤC NHÓM NGƯỜI SỬ DỤNG</div>
                <div class="panel-body">
                    <a role="button" href="{{url('/themnhomnguoisudung')}}" class="btn btn-success btn-sm" title="tạo nhóm người sử dụng" id="btnThem"><span class="glyphicon glyphicon-plus"></span>Thêm</a>
                </div>

                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="col-xs-1 text-center">STT</th>
                        <th class="col-xs-3">Tên nhóm</th>
                        <th class="col-xs-6">Mô Tả</th>
                        <th class="col-xs-1 text-center">Trạng thái</th>
                        <th class="col-xs-1">Xử lý</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $countnhom = 0;?>

                    @foreach($nhomnguoisudungdata as $nhomnguoisudung)
                        <?php $countnhom++;?>
                        <tr>
                            <td class="text-center">{{$countnhom}}</td>
                            <td>{{$nhomnguoisudung->tennhom}}</td>
                            <td>{{$nhomnguoisudung->mota}}</td>
                            @if($nhomnguoisudung->trangthai == 0)
                                <td class="text-center"><span class='glyphicon glyphicon-ban-circle text-danger'></span></td>
                            @else
                                <td class="text-center"><span class='glyphicon glyphicon-ok text-success'></span></td>
                            @endif
                            <td class="text-center">
                                <button type="button" id="{{$nhomnguoisudung->id}}" value="{{$nhomnguoisudung->trangthai}}" onclick="doitrangthainhomnguoisudung(this.id,this.value)" title="Đổi trạng thái nhóm người sử dụng" class="btn btn-xs btn-success">
                                    <span class="glyphicon glyphicon-refresh"></span>
                                </button>
                                <a href="{{url('chinhsuanhomnguoisudung/'.$nhomnguoisudung->id)}}" class="btn btn-xs btn-warning" title="Sửa">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                <button type="button" value="{{$nhomnguoisudung->id}}" onclick="xoanhomnguoisudung(this.value)" title="Xóa nhóm người sử dụng" class="btn btn-xs btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="panel-body text-center">
                    <ul class="pagination">
                        <li>
                            <span>Trang {{$nhomnguoisudungdata->currentPage().'/'.$nhomnguoisudungdata->lastPage()}}</span>
                        </li>
                        <li @if($nhomnguoisudungdata->currentPage() == 1) class="disabled" @endif>
                            <a @if($nhomnguoisudungdata->currentPage() != 1) href="{{$nhomnguoisudungdata->url(1)}}" @endif>
                                <<
                            </a>
                        </li>
                        <li @if($nhomnguoisudungdata->currentPage() == 1) class="disabled" @endif>
                            <a @if($nhomnguoisudungdata->currentPage() != 1) href="{{$nhomnguoisudungdata->previousPageUrl()}}" @endif>
                                <
                            </a>
                        </li>
                        <li class="active">
                            <span>{{$nhomnguoisudungdata->currentPage()}}</span>
                        </li>
                        <li @if($nhomnguoisudungdata->currentPage() == $nhomnguoisudungdata->lastPage()) class="disabled" @endif>
                            <a @if($nhomnguoisudungdata->currentPage() != $nhomnguoisudungdata->lastPage()) href="{{$nhomnguoisudungdata->nextPageUrl()}}" @endif>
                                >
                            </a>
                        </li>
                        <li @if($nhomnguoisudungdata->currentPage() == $nhomnguoisudungdata->lastPage()) class="disabled" @endif>

                            <a @if($nhomnguoisudungdata->currentPage() != $nhomnguoisudungdata->lastPage()) href="{{$nhomnguoisudungdata->url($nhomnguoisudungdata->lastPage())}}" @endif>
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
        function doitrangthainhomnguoisudung(id,value){

            var newtrangthai = 0;
            var confirmdoitrangthai = false;
            if(value == 1){
                newtrangthai = 0;
                confirmdoitrangthai = confirm('Bạn muốn ẩn nhóm người sử dụng này đúng không?');
            }else{
                newtrangthai = 1;
                confirmdoitrangthai = confirm('Bạn muốn dùng nhóm người sử dụng này đúng không?');
            }

            if (confirmdoitrangthai) {
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '{{URL::to('doitrangthainhomnguoisudung')}}',
                    data: {
                        nhomnguoisudungid: id,
                        newtrangthai: newtrangthai
                    },
                    success: function (response) {

                        if (response['doitrangthainhomnguoisudung_result'] == 'successful') {
                            window.location.reload(true);
                        } else {

                        }
                    }
                });
            }
        }

        function xoanhomnguoisudung(id){

            var confirmxoa = confirm('Bạn có muốn nhóm người sử dụng này không?');

            if (confirmxoa) {
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url:  '{{URL::to('xoanhomnguoisudung')}}',
                    data: {
                        nhomnguoisudungid: id
                    },
                    success: function (response) {

                        if(response['xoanhomnguoisudung_result'] == 'successful') {
                            window.location.reload(true);
                        }else {

                        }
                    }
                });
            }
        }

    </script>

@endsection
