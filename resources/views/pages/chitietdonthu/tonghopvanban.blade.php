<div id="menu3" class="tab-pane fade">
    <!---Van Ban Lien quan --->
    @if(count($vanBanTheoDon) != 0)
        @foreach($vanBanTheoDon as $fileVB)
            @foreach($fileVB as $file)
                @if($file->type == INSERTFILE)
                    <div>

                        <h5 style="border-bottom: 1px dotted #bbb">
                            <span style="float: left;color: #3377c7"># </span>
                            <span style="font-weight: bold">Được thêm bởi <span style="color: #3377c7">{{$file->fullname}}</span> lúc  <span style="color: #3377c7"></span></span>
                        </h5>


                        <div class="col-xs-12" style="padding: 0">
                            <label>
                                Văn bản:
                            </label>

                            <a href="{{route('down_load',['path'=>$file->linkfile,'fileName'=>$file->tenvanban,'Id'=>$file->id])}}" >
                                {{$file->tenvanban}} @if(!empty($file->so_kihieu)) - Số Kí Hiệu: {!! $file->so_kihieu !!} @endif
                            </a>
                            @if(empty($file->so_kihieu))
                            <button type="button"  class="btn btn-xs btn-primary" id="btn_them_{!! $file->id !!}" onclick="objVanBan.clickButton('{!! $file->id !!}')">Thêm</button>
                            <button type="button" style="display: none" class="btn btn-xs btn-success" id="btn_save_{!! $file->id !!}" onclick="objVanBan.addSoKyHieu('{!! $file->id !!}')">Lưu</button>
                            <button type="button" style="display: none" class="btn btn-xs btn-danger" id="btn_huy_{!! $file->id !!}" onclick="objVanBan.huyThemSoKiHieu();">Hủy</button>
                            <input type="text" name="so_kihieu" id="so_kihieu_{!! $file->id !!}" value="" placeholder="Số ký hiệu" style="display: none">
                            @endif

                        </div>

                    </div>
                @endif

            @endforeach


        @endforeach
    @endif

    @if ($errors->any())
        {{ implode('', $errors->all(':message')) }}
    @endif

</div>
<script type="text/javascript">

    var objVanBan = {
        clickButton:function (id) {
            $('#so_kihieu_'+id).show();
            $('#btn_them_'+id).hide();
            $('#btn_save_'+id).show();
            $('#btn_huy_'+id).show();
        },
        addSoKyHieu:function (obj) {

            var so_kihieu = $('#so_kihieu_'+obj).val();

            if(so_kihieu != '')
            {
                $.ajax({
                    type: 'post',
                    url: '{{route('update_sokihieu')}}',
                    data: {
                        id: obj,
                        so_kihieu: so_kihieu

                    },
                    success: function (data) {

                        if(!data.error)
                        {
                            window.location.reload();
                        }else {
                            alert('Vui lòng thử lại!')
                        }

                    }
                });
            }else {
                alert('Vui lòng nhập số kí hiệu');
            }


        },
        huyThemSoKiHieu:function () {
            window.location.reload();
        }
    };

</script>