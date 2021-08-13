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
            THÔNG TIN CHI TIẾT XỬ LÝ ĐƠN KHIẾU NẠI TỐ CÁO
        </div>
        <table class="table table-bordered table-hover">
            <tbody>
            @foreach($trangchudata['xulydonthukntc'] as $xulydonthukntc)
                @if($xulydonthukntc->donthuid == $donthukntcid)
                    <tr>
                        <td class="col-xs-2">
                            <label>Họ tên:</label></td>
                        <td>
                            {{$xulydonthukntc->tennguoivietdon}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Địa chỉ:</label></td>
                        <td>
                            {{$xulydonthukntc->diachinguoiviet}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Nội dung đơn:</label></td>
                        <td>
                            {{$xulydonthukntc->noidung}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Ngày nhận:</label></td>
                        <td>
                            {{$xulydonthukntc->ngaynhan}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Ngày xử lý:</label></td>
                        <td>
                            @if($thongtintheodoidonthu[0]->ngayquyetdinhxuly != '0000-00-00')
                            {{$thongtintheodoidonthu[0]->ngayquyetdinhxuly}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Kết quả xử lý:</label>
                        </td>
                        <td>
                            {{$thongtintheodoidonthu[0]->tomtatxuly}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Văn bản trả lời:</label>
                        </td>
                        <td>
                            @if($thongtintheodoidonthu[0]->thongbaogiaiquyet != '')
                                <span class='glyphicon glyphicon-download-alt text-info'></span>
                                <a style='text-decoration: none; margin-left:5px' href="{{url($thongtintheodoidonthu[0]->linkfile.'/'.$thongtintheodoidonthu[0]->thongbaogiaiquyet)}}" download>{{$thongtintheodoidonthu[0]->thongbaogiaiquyet}}</a>
                            @else
                                Không có văn bản trả lời!
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
        <div class="panel-footer">
            <div class="text-right">
                <a href="{{url('/ketquaxulydonthukhieunaitocao')}}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-arrow-left"></span>Trở lại</a>
            </div>
        </div>
    </div>

@endsection