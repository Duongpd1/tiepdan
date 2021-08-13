<div id="menu1" class="tab-pane fade">

    <div id="lichSuDivId" style="padding-top: 10px">
        @if($lichSuXL != null)
            @foreach($lichSuXL as $nguoi)
                <div>
                    <b>@foreach($nguoiXL as $nguoiTao)
                            @if($nguoi->nguoiGiaoXuLy == $nguoiTao->accountid )
                                {{$nguoiTao->fullname}} - {!! $nguoiTao->chucvu !!}
                            @endif
                        @endforeach
                        - {{date("H:i:s d/m/Y",strtotime($nguoi->dateTime))}}
                    </b>
                    <br>
                    <u>Chuyển tiếp:</u>
                    @foreach($nguoiXL as $nguoiTao)
                        @if($nguoi->nguoiXuLy == $nguoiTao->accountid )
                            {{$nguoiTao->fullname}} - {!! $nguoiTao->chucvu !!}
                        @endif
                    @endforeach
                    <br>
                    @if(!empty($nguoi->noi_dung_chuyen_tiep))
                        <u>Nội dung chuyển tiếp:</u> {!! $nguoi->noi_dung_chuyen_tiep !!}
                    @endif

                </div>

            @endforeach
        @endif
    </div>


</div>