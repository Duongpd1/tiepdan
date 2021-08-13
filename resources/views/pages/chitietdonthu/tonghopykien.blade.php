<div id="menu2" class="tab-pane fade">
@if(!empty($vanBanTheoDon))
    <?php
        $width = (100/count($vanBanTheoDon));
    ?>

    @foreach($vanBanTheoDon as $key => $value)
    <div style="width:{{$width.'%'}};float: left;">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{$key}}
            </div>
            <div class="panel-body" style="overflow: scroll;height: 400px">
                @foreach($value as $thongTin)
                    <div class="row" style="">
                        <div class="post clearfix">
                            <div class="user-block">
                                <div>
                                    <img class="img-circle img-bordered-sm" src="{{url('img/1496324970_88.png')}}"
                                         alt="user image">
                                    <button type="button" id="{{$thongTin->id}}"
                                            style="float: right;display: {{($thongTin->account==$accountId)?'':'none'}}"
                                            class="btn btn-xs btn-warning" onclick="chinhSuaComment(this.id)">
                                        <span class="glyphicon glyphicon-edit"></span></button>
                                </div>

                                        <span class="username">
                                            <a href="#">{{$thongTin->fullname}}
                                                .</a>
                                            <a href="#"
                                               class="pull-right btn-box-tool"></a>
                                        </span>
                                <span class="description">có ý kiến - {{date("H:i:s d/m/Y",strtotime($thongTin->create_at))}}</span>

                            </div>
                            <!-- /.user-block -->
                            <div id="ptext-{{@$thongTin->id}}">
                                <p>
                                    @if($thongTin->ykienCV != "")
                                        {{$thongTin->ykienCV}}
                                    @endif

                                </p>
                            </div>
                            <div class="form-horizontal" id="chinhSuaComment-{{@$thongTin->id}}"
                                 style="display: none">
                                <div class="form-group margin-bottom-none">
                                    <div class="col-sm-10">
                                        <input class="form-control input-sm" placeholder="y kien"
                                               id="commentYK-{{@$thongTin->id}}" name="commentYK"
                                               value="{{$thongTin->ykienCV}}">
                                    </div>
                                    <div class="col-sm-2 ">

                                        <ul class="list-inline">
                                            <li class="pull-right">
                                                <button type="button"
                                                        class="btn btn-danger pull-right btn-block btn-sm pull-right"
                                                        id="huyCommentYK" onclick="displayEdit(this.id);">Hủy
                                                </button>
                                            </li>
                                            <li class="pull-right">
                                                <button type="button"
                                                        class="btn btn-success pull-right btn-block btn-sm pull-right"
                                                        id="guiComment-{{@$thongTin->id}}"
                                                        onclick="submitChinhSuaComment(this.id);">Gửi
                                                </button>
                                            </li>
                                        </ul>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>

        </div>

    </div>
    @endforeach
@endif

</div>