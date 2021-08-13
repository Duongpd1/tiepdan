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

    <?php
        function convertNgay($ngayTuDatabase){
            $ngayExplore = explode('-',$ngayTuDatabase);
            $ngay = $ngayExplore[2];
            $thang = $ngayExplore[1];
            $nam = $ngayExplore[0];
            return $ngay.'/'.$thang.'/'.$nam;
        }
    ?>
    <div class="container-fluid" style="margin-bottom: 40px; padding: 10px 15px">
        <div class="col-background">
            <div class="panel panel-default panel-min-height">
                <div class="panel-heading text-center">CHI TIẾT TIẾP DÂN</div>
                <div class="panel-body">
                    <a type="button" href="{{url('danhsachtiepcongdan')}}" title="Trở lại" class="btn btn-sm btn-danger">
                        <span class="glyphicon glyphicon-arrow-left"></span>
                        Trở lại
                    </a>
                    <a type="button" href="{{url('chinhsuadanhsachtiepcongdan/'.$noidungdanhsachtiepcongdan[0]->tiepdanid)}}" title="Sửa" class="btn btn-sm btn-warning">
                        <span class="glyphicon glyphicon-edit"></span>
                        Sửa
                    </a>
                    <a type="button" href="{{url('exportPhieuHen/'.$noidungdanhsachtiepcongdan[0]->tiepdanid)}}" title="In phiếu hẹn" class="btn btn-sm btn-info">
                        <span class="glyphicon glyphicon-print"></span>
                        In Phiếu Hẹn
                    </a>
                </div>

                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <td class="col-sm-2 text-bold">Số thụ lý</td>
                        <td>{{$noidungdanhsachtiepcongdan[0]->sothuly}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Ngày tiếp</td>
                        <td>{{($noidungdanhsachtiepcongdan[0]->ngaytiep == '0000-00-00')?'Chưa xác định!':convertNgay($noidungdanhsachtiepcongdan[0]->ngaytiep)}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Lần tiếp</td>
                        <td>Lần {{$noidungdanhsachtiepcongdan[0]->lantiep}}</td>
                    </tr>

                    <tr>
                        <td class="text-bold">Chủ trì</td>
                        <td>{{mb_strtoupper($noidungdanhsachtiepcongdan[0]->chutri)}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Chức vụ</td>
                        <td>{{$noidungdanhsachtiepcongdan[0]->chucvuchutri}}</td>
                    </tr>

                    <tr>
                        <td class="text-bold">Người tham gia</td>
                        <td>{{($noidungdanhsachtiepcongdan[0]->lanhdao != null)? mb_strtoupper($noidungdanhsachtiepcongdan[0]->lanhdao):'Chưa xác định!'}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Chức vụ</td>
                        <td>{{($noidungdanhsachtiepcongdan[0]->chucvu !=null)?$noidungdanhsachtiepcongdan[0]->chucvu:'Chưa xác định!'}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">{{($noidungdanhsachtiepcongdan[0]->chuthe == 1)?'Công dân':'Công dân đại diện'}} </td>
                        <td>{{mb_strtoupper($noidungdanhsachtiepcongdan[0]->congdan)}}</td>
                    </tr>

                    <tr>
                        <td class="text-bold">Số CMND/Hộ chiếu</td>
                        <td>{{$noidungdanhsachtiepcongdan[0]->cmt}}</td>
                    </tr>

                    <tr>
                        <td class="text-bold">Ngày cấp</td>
                        <td>{{($noidungdanhsachtiepcongdan[0]->ngaycap == '0000-00-00')?'Chưa xác đinh!':convertNgay($noidungdanhsachtiepcongdan[0]->ngaycap)}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Nơi cấp</td>
                        <td>{{$noidungdanhsachtiepcongdan[0]->noicap}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Số điện thoại</td>
                        <td>{{$noidungdanhsachtiepcongdan[0]->sdt}}</td>
                    </tr>

                    <tr>
                        <td class="text-bold">Địa chỉ </td>
                        <td>{{$noidungdanhsachtiepcongdan[0]->diachi}}</td>
                    </tr>

                    <tr>
                        <td class="text-bold">Chủ thể</td>
                        @if($noidungdanhsachtiepcongdan[0]->chuthe == 1)
                        <td>Cá nhân</td>
                        @else
                        <td>Tập thể</td>
                        @endif
                    </tr>
                    <tr>
                        <td class="text-bold">Lĩnh vực</td>
                        <td>{{($tenlinhvuc!=null)?$tenlinhvuc:'Chưa xác định!'}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Địa bàn</td>
                        <td>{{($tendiaban!=null)?$tendiaban:'Chưa xác định!'}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Đối tượng</td>
                        @if($noidungdanhsachtiepcongdan[0]->doituong != null)
                            <td>{{mb_strtoupper($noidungdanhsachtiepcongdan[0]->doituong)}}</td>
                        @else
                            <td>Chưa xác định!</td>
                        @endif
                    </tr>
                    <tr>
                        <td class="text-bold">Nội dung công dân trình bày</td>
                        <td>{{($noidungdanhsachtiepcongdan[0]->noidung!=null)?$noidungdanhsachtiepcongdan[0]->noidung:'Chưa xác định!'}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Cơ quan đã giải quyết</td>
                        <td>{{($noidungdanhsachtiepcongdan[0]->coquandagiaiquyet!=null)?$noidungdanhsachtiepcongdan[0]->coquandagiaiquyet:'Chưa xác định'}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Nội dung đã giải quyết</td>
                        <td>{{($noidungdanhsachtiepcongdan[0]->noidungdagiaiquyet!=null)?$noidungdanhsachtiepcongdan[0]->noidungdagiaiquyet:'Chưa xác định!'}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Vướng mắc và đề nghị giải quyết</td>
                        <td>{{($noidungdanhsachtiepcongdan[0]->vuongmacdenghi!=null)?$noidungdanhsachtiepcongdan[0]->vuongmacdenghi:'Chưa xác đinh!'}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Đề xuất xử lý của cán bộ tiếp dân</td>
                        <td>{{($noidungdanhsachtiepcongdan[0]->ketquagiaiquyet!=null)?$noidungdanhsachtiepcongdan[0]->ketquagiaiquyet:'Chưa xác định!'}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Kết luận của chủ trì cuộc tiếp dân</td>
                        <td>{{($noidungdanhsachtiepcongdan[0]->ykienlanhdao!=null)?$noidungdanhsachtiepcongdan[0]->ykienlanhdao:'Chưa xác định!'}}</td>
                    </tr>


                    <tr>
                        <td class="text-bold">File đính kèm</td>
                        @if($array_file != "")
                            <td id="hienthifile" class="col-xs-10" style="margin-top: 10px">
                                @for($i = 0;$i<count($array_file);$i++)
                                    <a href="{{url($noidungdanhsachtiepcongdan[0]->filepath."/".$array_file[$i])}}" title='Tải về' download>
                                        <img id="hinhanhdaidien" src="{{url('/img/file.png')}}" style="height:25px;width:20px"/>&nbsp;{{$array_file[$i]}}
                                    </a>
                                @endfor
                            </td>
                        @else
                            <td>Không có file đính kèm!</td>
                        @endif
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
