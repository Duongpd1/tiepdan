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

    <?php
        function convertNgay($ngayTuDatabase){
            $ngayExplore = explode('-',$ngayTuDatabase);
            $ngay = $ngayExplore[2];
            $thang = $ngayExplore[1];
            $nam = $ngayExplore[0];
            return $ngay.'/'.$thang.'/'.$nam;
        }
    $quyenXoa = Session::get('quyenXoa');

    ?>

    <div id="donthu" class="col-background" style="margin-bottom: 100px;">
        <div class="panel panel-default">
            <div class="panel-heading text-center">QUẢN TRỊ VĂN BẢN</div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-9" style="padding-left: 0">
                        <a href="{{url('themvanbanphapluat')}}" name="btnThem" id="btnThem" title="Thêm" class="btn btn-sm btn-success">
                            <span class="glyphicon glyphicon-plus"></span> Thêm
                        </a>
                    </div>
                    <div class="col-xs-3 input-group input-group-sm">
                        <label for="loaivanban" class="input-group-addon">Loại văn bản</label>
                        <select name="loaivanban" id="loaivanban" class="form-control">
                            {{--<option selected="selected" value="ALL">Tất cả</option>--}}
                            {{--<option value="VBAD">Văn bản &#225;p dụng (VBAD)</option>--}}
                            {{--<option value="VBCD">Văn bản chỉ đạo (VBCD)</option>--}}
                            <option value="2" selected>Văn bản pháp luật (VBPL)</option>
                        </select>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-hover" style="border-collapse: collapse">
                <thead>
                <tr>
                    <th class="text-center col-xs-2">Số hiệu</th>
                    <th class="text-center col-xs-3">Tên văn bản</th>
                    <th class="text-center col-xs-5">Trích dẫn</th>
                    <th class="text-center col-xs-1">Ngày ký</th>
                    <th class="col-xs-1">Xử Lý</th>
                </tr>
                </thead>
                <tbody>
                @foreach($getvanbanphapluat as $baiviet)
                    <tr id="vanban{{$baiviet->id}}">
                        <td>
                            <a href="{{url('/chinhsuavanban/'.$baiviet->id)}}">
                                {{$baiviet->sohieu}}
                            </a>
                        </td>
                        <td>{{$baiviet->tenvanban}}</td>
                        <td><?php echo $baiviet->trichdan; ?></td>
                        <td>{{($baiviet->ngaybanhanh!= '0000-00-00')?convertNgay($baiviet->ngaybanhanh):''}}</td>
                        <td class="text-center">
                            <a href="{{url('chinhsuavanban/'.$baiviet->id)}}" title="Sửa văn bản" class="btn btn-xs btn-success">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </a>

                            <button value="{{$baiviet->id}}" onclick="confirmxoabaiviet(this.value)" title="Xóa văn bản" class="btn btn-xs btn-danger" style="display:{{($quyenXoa == DELCONGTHONHTIN)?'':'none'}}">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="panel-body text-center">
                <ul class="pagination">
                    <li>
                        <span>Trang {{$getvanbanphapluat->currentPage().'/'.$getvanbanphapluat->lastPage()}}</span>
                    </li>
                    <li @if($getvanbanphapluat->currentPage() == 1) class="disabled" @endif>
                        <a @if($getvanbanphapluat->currentPage() != 1) href="{{$getvanbanphapluat->url(1)}}" @endif>
                            <<
                        </a>
                    </li>
                    <li @if($getvanbanphapluat->currentPage() == 1) class="disabled" @endif>
                        <a @if($getvanbanphapluat->currentPage() != 1) href="{{$getvanbanphapluat->previousPageUrl()}}" @endif>
                            <
                        </a>
                    </li>
                    <li class="active">
                        <span>{{$getvanbanphapluat->currentPage()}}</span>
                    </li>
                    <li @if($getvanbanphapluat->currentPage() == $getvanbanphapluat->lastPage()) class="disabled" @endif>
                        <a @if($getvanbanphapluat->currentPage() != $getvanbanphapluat->lastPage()) href="{{$getvanbanphapluat->nextPageUrl()}}" @endif>
                            >
                        </a>
                    </li>
                    <li @if($getvanbanphapluat->currentPage() == $getvanbanphapluat->lastPage()) class="disabled" @endif>

                        <a @if($getvanbanphapluat->currentPage() != $getvanbanphapluat->lastPage()) href="{{$getvanbanphapluat->url($getvanbanphapluat->lastPage())}}" @endif>
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

    <script>
        function confirmxoabaiviet(id){

            var confirmdeletecontent = confirm('Bạn có muốn xóa văn bản này không?');

            if (confirmdeletecontent) {
                document.getElementById("vanban" + id).style.display = 'none';
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url:  '{{URL::to('xoavanban')}}',
                    data: {
                        vanbanid: id
                    },
                    success: function (response) {
//                        alert(response['xoavanban_result']);
                    }
                });
            }
        }
    </script>

@endsection
