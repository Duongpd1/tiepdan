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
    <div class="container-fluid" style="margin-bottom: 40px; padding: 10px 15px">
        <div class="col-background">
            <div class="panel panel-default panel-min-height">
                <div class="panel-heading text-center">
                    @if($donthu[0]->loaithu == THUGUIDEN)
                        CHI TIẾT THƯ ĐẾN
                    @else
                        CHI TIẾT THƯ ĐÃ GỬI
                    @endif
                </div>

                <div class="panel-body">
                    <a type="button" href="{{url('mailbox/'.Session::get('accountid'))}}" title="Trở lại" class="btn btn-sm btn-danger">
                        <span class="glyphicon glyphicon-arrow-left"></span>
                        Trở lại
                    </a>
                </div>

                <table class="table table-hover">
                    <tbody>
                    @if($donthu[0]->sohuu == Session::get('accountid'))
                        <script>
                            var emailid = <?php echo json_decode($donthu[0]->id); ?>;

                            updateStatusEmail(emailid);

                            function updateStatusEmail(id){
                                $.ajax({
                                    type: 'post',
                                    dataType: 'json',
                                    url:  '{{URL::to('updatestatusemail')}}',
                                    data: {
                                        id: id
                                    },
                                    success: function (response) {
                                    }
                                });
                            }
                        </script>
                    <tr>
                        @if($donthu[0]->loaithu == THUGUIDEN)
                            <td class="col-sm-2 text-bold">Người gửi</td>
                            <td>{{$donthu[0]->nguoigui}}</td>
                        @else
                            <td class="col-sm-2 text-bold">Người nhận</td>
                            <td>{{$donthu[0]->nguoinhan}}</td>
                        @endif
                    </tr>
                    <tr>
                        <td class="col-sm-2 text-bold">Ngày gửi</td>
                        <td>{{$donthu[0]->ngaygui}}</td>
                    </tr>
                    <tr>
                        <td class="col-sm-2 text-bold">Chủ đề</td>
                        <td>{{$donthu[0]->tieude}}</td>
                    </tr>
                    <tr>
                        <td class="col-sm-2 text-bold">File đính kèm</td>
                        @if($donthu[0]->filedinhkem != null)
                        <td>
                            <a href="{{$donthu[0]->filepath."/".$donthu[0]->filedinhkem}}" download="">
                                <span class="glyphicon glyphicon-download-alt"></span>
                                {{$donthu[0]->filedinhkem}}
                            </a>
                        </td>
                        @else
                        <td>Không có file đính kèm</td>
                        @endif
                    </tr>
                    <tr>
                        <td class="col-sm-2 text-bold">Nội dung</td>
                        <td><?php echo $donthu[0]->noidung; ?></td>
                    </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
