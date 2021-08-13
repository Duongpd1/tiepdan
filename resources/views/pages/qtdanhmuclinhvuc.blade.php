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
        var element1 = document.getElementById("linhvuc");
        element1.classList.add("active");
        var element = document.getElementById("htab-danhmuc");
        element.classList.add("active");
        element.classList.add("in");

    </script>

    <div class="container-fluid" style="margin-bottom: 40px; padding: 10px 15px">
        <div class="col-background">
            <div id="quantridanhmucloaidon" class="panel panel-default panel-min-height">
                <div class="panel-heading text-center">QUẢN TRỊ DANH MỤC LĨNH VỰC</div>
                <form role="form" method="post" action="themlinhvuc" enctype="multipart/form-data">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="col-xs-1 text-center">STT</th>
                            <th class="col-xs-5">Tên lĩnh vực</th>
                            <th class="col-xs-3">Viết tắt</th>
                            <th class="col-xs-3">Mã (theo CSDLQG)</th>
                            <th class="col-xs-1">Trạng thái</th>
                            <th class="col-xs-1">Xử lý</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="form-group form-group-sm success">

                            <td class="text-center" style="vertical-align: middle">
                                <label for="tenlinhvuc" class="control-label">Thêm</label></td>
                            <td>
                                <input name="tenlinhvuc" type="text" maxlength="100" id="tenlinhvuc" class="form-control" required>
                            </td>
                            <td>
                                <input name="viettat" type="text" maxlength="10" id="viettat" class="form-control" required>
                            </td>
                            <td>
                                <input name="malinhvuc" type="text"  id="malinhvuc" class="form-control" required>
                            </td>
                            <td>&nbsp;</td>
                            <td class="text-center" style="vertical-align: middle">
                                <button type="submit" title="Thêm" class="btn btn-xs btn-success">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    Thêm
                                </button>
                            </td>
                        </tr>
                        <?php
                        $count = 0;
                        $quyenXoa = Session::get('quyenXoa');
                        ?>
                        @foreach($getlinhvuc as $linhvuc)
                            <?php
                            $count++;
                            ?>
                            <tr>
                                <td class="text-center">{{$count}}</td>
                                <td>{{$linhvuc->tenlinhvuc}}</td>
                                <td>{{$linhvuc->viettat}}</td>
                                <td>{{$linhvuc->malinhvuc}}</td>
                                @if($linhvuc->trangthai == 1)
                                    <td class="text-center"><span class='glyphicon glyphicon-ok text-success'></span></td>
                                @else
                                    <td class="text-center"><span class='glyphicon glyphicon-ban-circle text-danger'></span></td>
                                @endif
                                <td class="text-center">
                                    <a href="{{url('chinhsualinhvuc/'.$linhvuc->linhvucid)}}" title="Sửa" class="btn btn-xs btn-warning">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </a>
                                @if(($quyenXoa & DELDANHMUC)== DELDANHMUC)
                                    <button type="button" onclick="xoalinhvuc(this.value)" value="{{$linhvuc->linhvucid}}" title="Xóa" class="btn btn-xs btn-danger">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </button>
                                @endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </form>
                <div class="panel-body text-center">
                    <ul class="pagination">
                        <li>
                            <span>Trang {{$getlinhvuc->currentPage().'/'.$getlinhvuc->lastPage()}}</span>
                        </li>
                        <li @if($getlinhvuc->currentPage() == 1) class="disabled" @endif>
                            <a @if($getlinhvuc->currentPage() != 1) href="{{$getlinhvuc->url(1)}}" @endif>
                                <<
                            </a>
                        </li>
                        <li @if($getlinhvuc->currentPage() == 1) class="disabled" @endif>
                            <a @if($getlinhvuc->currentPage() != 1) href="{{$getlinhvuc->previousPageUrl()}}" @endif>
                                <
                            </a>
                        </li>
                        <li class="active">
                            <span>{{$getlinhvuc->currentPage()}}</span>
                        </li>
                        <li @if($getlinhvuc->currentPage() == $getlinhvuc->lastPage()) class="disabled" @endif>
                            <a @if($getlinhvuc->currentPage() != $getlinhvuc->lastPage()) href="{{$getlinhvuc->nextPageUrl()}}" @endif>
                                >
                            </a>
                        </li>
                        <li @if($getlinhvuc->currentPage() == $getlinhvuc->lastPage()) class="disabled" @endif>

                            <a @if($getlinhvuc->currentPage() != $getlinhvuc->lastPage()) href="{{$getlinhvuc->url($getlinhvuc->lastPage())}}" @endif>
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

        function xoalinhvuc(id){

            var isok = confirm('Bạn có muốn xóa lĩnh vực này không');
            if(isok) {
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '{{URL::to('xoalinhvuc')}}',
                    data: {
                        loaidonid: id
                    },
                    success: function (response) {
                        window.location.reload(true);
                    }
                });
            }
        }

    </script>

@endsection
