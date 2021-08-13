<div class="row" >
    <div class="col-xs-2">
        <table>
            <tbody>
            <tr><td class="text-center">VĂN PHÒNG UBND</td></tr>
            <tr><td class="text-center">TỈNH PHÚ THỌ</td></tr>
            <tr><td class="text-center" id="tdSoKH"> </td></tr>
            </tbody>
        </table>
    </div>
    <div class="col-xs-10 text-center">
        <table style="float: right">
            <tbody>
            <tr><td >CỘNG HÒA XÃ HỘ CHỦ NGHĨA VIÊT NAM</td></tr>
            <tr><td >Độc lập - Tự do - Hạnh phúc</td></tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-xs-12" id="divLoaiVB">
        <h2 class="text-center" style="margin-bottom: 0px !important;">{{$tenVB}}</h2>
    </div>
</div>
<div class="row">
    <div class="col-xs-12" id="divTieuDe">
        <h2 class="text-center" style="margin-top: 0px !important;" >{{$tieuDe}}</h2>
    </div>
</div>
<div class="row">
    <div class="col-xs-12" >
        @if(isset($line))
            @foreach($line as $row)
                <p class="text-left">{{$row}}</p>
            @endforeach
        @endif
    </div>
</div>
@if(isset($path_1))
<div class="row">
    <div class="col-xs-12" id="">
        <h4 style="font-weight: bold;text-transform: uppercase">{{$path_1}}</h4>
    </div>
</div>
@endif
<div class="row">
    <div class="col-xs-12" id="divNoiDung">
        <p>{{$noiDung}}</p>
    </div>
</div>
<div class="row">
    <div class="col-xs-2">
        <table>
            <tbody>
            <tr>
                <td id="">

                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-xs-10 text-center">
        <table style="float: right">
            <tbody>
            <tr><td >Người ký</td></tr>
            <tr><td ></td></tr>
            </tbody>
        </table>
    </div>

</div>