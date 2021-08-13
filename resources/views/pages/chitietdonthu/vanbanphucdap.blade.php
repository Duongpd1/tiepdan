<div class="col-md-6" style="display: none" id="divVanBanPhucDap">
    <div class="form-group">
        <table width="100%">
            <tbody>
            <tr>
                <td style="width:50%">

                    <label>Số KH </label>
                    <input name="" type="text" id="soVanBanId" class="form-control" style="text-transform:uppercase">

                </td>
                <td>&nbsp;</td>
                <td style="width:50%">
                    <label>Loại văn bản</label>
                    <select class="form-control" id="loaiVanBanId" onchange="changeTemplate(this)">
                        @foreach(\App\Model\PageModel\MauDon::$arryVanBan as $key=>$val)
                            <option value="{{$key}}">{{$val}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    {{--<div class="form-group" style="display: none" id="dia_chi_nhan">--}}
        {{--<label>Nơi Nhận: </label>--}}
        {{--<select class="form-control" id="donvi_nhan" onchange="changeDonviNhan(this);">--}}
            {{--@foreach($donvi as $val)--}}
                {{--<option value="{!! $val->id !!}" id="op_donvi_{!! $val->id !!}">{!! $val->tendonvi !!}</option>--}}
            {{--@endforeach--}}

        {{--</select>--}}
        {{--<input type="hidden" id="ten_don_vi_id" name="ten_don_vi_name">--}}
    {{--</div>--}}
    <div class="form-group">
        <label>Kính gửi: </label>
        <input type="text" name="" id="tieuDeId" class="form-control"
               value="{{$result['noidung'][0]->tennguoivietdon}},{{$result['noidung'][0]->diachinguoiviet}}">
    </div>
    <div class="form-group">
        <label>Nội dung </label>
        <textarea name="noiDungVanBan" rows="5" cols="5" id="noiDungVanBanId"
                  class="form-control">{{$strVanBan}}</textarea>
    </div>
    <div class="form-group" style="display: none" id="divYKDX">
        <label>Ý kiến đề xuất </label>
        <textarea name="teYKDX" rows="5" cols="5" id="teYKDXId" class="form-control">Căn cứ nội dung đơn và thẩm quyền giải quyết, đề xuất:</textarea>
    </div>

    <div class="form-group">
        <button type="button" class="btn btn-primary" id="xemTruocND" onclick="displayNoiDungVB(this.id)">Xem trươc
        </button>
        <button type="button" class="btn btn-primary" id="xuatVB" onclick="displayNoiDungVB(this.id)">Xuất văn bản
        </button>
        <button type="button" class="btn btn-danger" id="huyVB" onclick="displayNoiDungVB(this.id)">Hủy</button>
    </div>
</div>