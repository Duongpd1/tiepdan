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
        var element1 = document.getElementById("baocaodotxuat");
        element1.classList.add("active");
        var element = document.getElementById("htab-baocao");
        element.classList.add("active");
        element.classList.add("in");

    </script>

    <div class="container-fluid" style="margin-bottom: 40px; padding: 10px 15px">
        <div class="col-background">
            <div id="quantridanhmucloaidon" class="panel panel-default panel-min-height">
                <div class="panel-heading text-center">BÁO CÁO ĐỘT XUẤT</div>
                <div class="panel-body row">
                    <div class="col-xs-8">
                        <a role="button" href="{{url('/taobaocaodotxuat')}}" class="btn btn-success btn-sm" title="tạo báo cáo đột xuất" id="btnThem"><span class="glyphicon glyphicon-plus"></span>Thêm</a>
                    </div>
                    <div class="col-xs-4"></div>
                </div>
                <form role="form" method="post" action="thembaocaodotxuat" enctype="multipart/form-data">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="col-xs-1 text-center">STT</th>
                                <th class="col-xs-3">Tên báo cáo</th>
                                <th class="col-xs-4">Mô tả</th>
                                <th class="col-xs-1">Tải Báo Cáo</th>
                                <th class="col-xs-1">Xử lý</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            $count = 0;
//                            $quyenXoa = Session::get('quyenXoa');
                        ?>
                        @foreach($baocaos as $baocao)
                            <?php
                            $count++;
                            ?>
                            <tr>
                                <td class="text-center">{{$count}}</td>
                                <td>{{$baocao->tenloaidon}}</td>
                                <td>{{$baocao->mota}}</td>
                                <td>
                                    <a href="{{url("file/baocaodotxuat/".$baocao->filename)}}" download>
                                        <span class="glyphicon glyphicon-download-alt"></span>
                                        Tải Xuống
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{url('chinhsuabaocaodotxuat/'.$baocao->id)}}" title="Sửa" class="btn btn-xs btn-warning">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </a>
                                        <button type="button" onclick="xoabaocao(this.value)" value="{{$baocao->id}}" title="Xóa" class="btn btn-xs btn-danger">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
                <div class="panel-body text-center">
                    <ul class="pagination">
                        <li>
                            <span>Trang {{$baocaos->currentPage().'/'.$baocaos->lastPage()}}</span>
                        </li>
                        <li @if($baocaos->currentPage() == 1) class="disabled" @endif>
                            <a @if($baocaos->currentPage() != 1) href="{{$baocaos->url(1)}}" @endif>
                                <<
                            </a>
                        </li>
                        <li @if($baocaos->currentPage() == 1) class="disabled" @endif>
                            <a @if($baocaos->currentPage() != 1) href="{{$baocaos->previousPageUrl()}}" @endif>
                                <
                            </a>
                        </li>
                        <li class="active">
                            <span>{{$baocaos->currentPage()}}</span>
                        </li>
                        <li @if($baocaos->currentPage() == $baocaos->lastPage()) class="disabled" @endif>
                            <a @if($baocaos->currentPage() != $baocaos->lastPage()) href="{{$baocaos->nextPageUrl()}}" @endif>
                                >
                            </a>
                        </li>
                        <li @if($baocaos->currentPage() == $baocaos->lastPage()) class="disabled" @endif>

                            <a @if($baocaos->currentPage() != $baocaos->lastPage()) href="{{$baocaos->url($baocaos->lastPage())}}" @endif>
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

        $( function() {
            $( "#NgayTao" ).datepicker({format: 'yyyy-mm-dd'});

        } );
        function xoabaocao(id){

            var isok = confirm('Bạn có muốn xóa loại đơn này không');
            if(isok) {
                $.ajax({
                    type: 'post',
//                    dataType: 'json',
                    url: '{{URL::to('xoabaocao')}}',
                    data: {
                        baocaoid: id
                    },
                    success: function (response) {

//                        console.log(response);
                        if(response== "success")
                        {
                            window.location.reload(true);
                        }
                    }
                });
            }
        }

    </script>
@endsection
