<div id="menu4" class="tab-pane fade">

    <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">

            @if($nguoiTheoDoi != null)
                @foreach($nguoiTheoDoi as $item)

                    @foreach($nguoiXL as $nguoiTao)
                        @if($item == $nguoiTao->accountid )

                            <h5 id="h5.{{$nguoiTao->accountid}}"><span style="color: #3377c7">{{$nguoiTao->fullname}}</span> <span id="{{$nguoiTao->accountid}}" class="glyphicon glyphicon-trash" aria-hidden="true" onclick="deleteNguoiTheoDoi(this.id)"></span></h5>
                        @endif
                    @endforeach

                @endforeach
            @endif

            <div id="divChonTen" style="display: none">

                <select style="width:180px;" id="selectNguoiTD">
                    <option value=""></option>
                    @foreach($danhSachNhanVien as $nhanVien)
                        <option value="{{$nhanVien->accountid}}">{{$nhanVien->fullname}}</option>
                    @endforeach
                </select>
                <button type="button" id="luuTheoDoi" class="btn-success " onclick="luuThemNguoiThepDoi()">Lưu</button>
                <button id="huyThem" class="btn-warning">Hủy</button>
            </div>

        </div>
        <!-- /.box-body -->
    </div>
</div>