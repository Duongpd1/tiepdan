<?php
/****************************************************************
File Name       : home.blade.php
Description     : Header of home page
Creation Date   : 2016/06/10
Author          : FPT/KhanhTH
Change History  :
****************************************************************/
?>
@extends('layouts.tracuulayout')

@section('content')

    <div class="panel panel-default panel-home">
        <div class="panel-heading">
            <i class="fa fa-list fa-lg" aria-hidden="true"></i>
            THÔNG TIN CHI TIẾT GIẢI QUYẾT KHIẾU NẠI TỐ CÁO
        </div>
        <table class="table table-bordered table-hover">
            <tbody>
            @foreach($trangchudata['ketquakntc'] as $ketquakntc)
                @if($ketquakntc->donthuid == $kntcid)
                    <tr>
                        <td class="col-xs-2">
                            <label>Họ và tên:</label></td>
                        <td>
                            {{$ketquakntc->tennguoivietdon}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Địa chỉ:</label></td>
                        <td>
                            {{$ketquakntc->diachinguoiviet}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Ngày nhận đơn:</label></td>
                        <td>
                            {{$ketquakntc->ngaynhan}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Ngày quyết định:</label></td>
                        <td>
                            @if($ketquagiaiquyet[0]->ngayquyetdinh != '0000-00-00')
                            {{$ketquagiaiquyet[0]->ngayquyetdinh}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Nội dung:</label></td>
                        <td>
                            {{$ketquakntc->noidung}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Kết quả giải quyết:</label></td>
                        <td>
                            <?php echo ($ketquagiaiquyet[0]->tomtatketqua); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Văn bản trả lời:</label></td>

                        <td>
                            @if($ketquagiaiquyet[0]->vanbangiaiquyet != null)
                                <span class='glyphicon glyphicon-download-alt text-info'></span>
                                <a style='text-decoration: none; margin-left:5px' href="{{url($ketquagiaiquyet[0]->linkfile.'/'.$ketquagiaiquyet[0]->vanbangiaiquyet)}}" download>{{$ketquagiaiquyet[0]->vanbangiaiquyet}}</a>
                            @else
                                Không có văn bản đính kèm !
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td colspan="2" class="text-right">
                    <a href="{{url('/tracuu')}}" class="btn btn-xs btn-danger">
                        <span class="glyphicon glyphicon-arrow-left"></span>
                        Trở lại
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>


@endsection