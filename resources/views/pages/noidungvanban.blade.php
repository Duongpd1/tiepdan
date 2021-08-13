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
        <div class="panel-heading row" style="margin: 0">
            <div class="col-xs-8" style="padding: 0">
                <i class="fa fa-file-text fa-lg" aria-hidden="true"></i>
                Thông tin chi tiết văn bản pháp luật
            </div>
            <div class="col-xs-4 text-right" style="padding: 0">
                <a class="btn btn-xs btn-danger" href="{{url('/vanban')}}">
                    <span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span>
                    Trở lại</a>
            </div>
        </div>
        <div>
            <table class="table table-bordered table-hover" style="margin-bottom:0">
                <tbody>
                @foreach($trangchudata['vanbanphapluat'] as $vanbanphapluat)
                    @if($vanbanphapluat->id == $id)
                        <tr>
                            <td class="col-xs-3"><b>Tên văn bản</b></td>
                            <td>
                                {{$vanbanphapluat->tenvanban}}
                            </td>
                        </tr>
                        <tr>
                            <td><b>Số/Ký hiệu</b></td>
                            <td>
                                {{$vanbanphapluat->sohieu}}
                            </td>
                        </tr>
                        <tr>
                            <td><b>Trích dẫn</b></td>
                            <td>
                                <?php echo $vanbanphapluat->trichdan; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Người ký</b></td>
                            <td>
                                {{$vanbanphapluat->nguoiky}}
                            </td>
                        </tr>
                        <tr>
                            <td><b>Ngày ký</b></td>
                            <td>
                                {{$vanbanphapluat->ngaybanhanh}}
                            </td>
                        </tr>
                        <tr>
                            <td><b>Văn bản đính kèm</b></td>
                            <td>
                                @if($vanbanphapluat->filevanban != null)
                                    <span class='glyphicon glyphicon-download-alt text-info'></span>
                                    <a style='text-decoration: none; margin-left:5px' href="{{url($vanbanphapluat->filevanban)}}" title='Tải về' download>{{$vanbanphapluat->filename}}</a>
                                @else
                                    Không có văn bản đính kèm !
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection