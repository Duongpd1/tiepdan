<div id="menu5" class="tab-pane fade">
    <div class="row">
        <div class="col-xs-9">

            <div class="row">
                <div class="col-xs-7" style="padding: 0">
                    <label>Ngày tiếp:</label>
                    @if($tiepdanInfor[0]['ngaytiep'] != "0000-00-00")
                        {{date('d/m/Y',strtotime($tiepdanInfor[0]['ngaytiep']))}}
                    @else
                        Chưa xác định
                    @endif
                </div>
                <div class="col-xs-5" style="padding: 0">
                    <label>Lần tiếp :</label>
                    {{$tiepdanInfor[0]['lantiep']}}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-7" style="padding: 0">
                    <label>
                        Chủ trì:
                    </label>
                    {{$tiepdanInfor[0]['chutri']}}
                </div>
                <div class="col-xs-5" style="padding: 0">
                    <label>
                        Chức vụ:
                    </label>
                    {{$tiepdanInfor[0]['chucvuchutri']}}
                </div>
            </div>
            {{--<div class="row">--}}
                {{--<div class="col-xs-7" style="padding: 0">--}}
                    {{--<label>--}}
                        {{--Người tham gia:--}}
                    {{--</label>--}}
                    {{--{{$tiepdanInfor[0]['chucvuchutri']}}--}}
                {{--</div>--}}

                {{--<div class="col-xs-5" style="padding: 0">--}}
                    {{--<label>--}}
                        {{--Chức vụ:--}}
                    {{--</label>--}}
                    {{--@if($result['noidung'][0]->songuoi == \App\Model\TableModel\DonThuTable::CA_NHAN)--}}
                        {{--{{"Cá nhân"}}--}}
                    {{--@else--}}
                        {{--{{"Nhiều người"}}--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="row" style="">
                <div class="col-xs-12" style="padding: 0">
                    <label>
                        Cơ quan đã giải quyết:
                    </label>
                    {{(!empty($tiepdanInfor[0]['coquandagiaiquyet']))? $tiepdanInfor[0]['coquandagiaiquyet']:'Chưa xác định'}}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12" style="padding: 0">
                    <label>Nội dung đã giải quyết:</label>
                    {{(!empty($tiepdanInfor[0]['noidungdagiaiquyet']))? $tiepdanInfor[0]['noidungdagiaiquyet']:'Chưa xác định'}}
                </div>

            </div>

            <div class="row">
                <div class="col-xs-12" style="padding: 0">
                    <label>Vướng mắc đề nghị đã giải quyết:</label>
                    {{(!empty($tiepdanInfor[0]['vuongmacdenghi']))? $tiepdanInfor[0]['vuongmacdenghi']:'Chưa xác định'}}
                </div>

            </div>
            <div class="row">
                <div class="col-xs-12" style="padding: 0">
                    <label>Đề xuất xử lý của cán bộ tiếp dân:</label>
                    {{(!empty($tiepdanInfor[0]['ketquagiaiquyet']))? $tiepdanInfor[0]['ketquagiaiquyet']:'Chưa xác định'}}
                </div>

            </div>

            <div class="row">
                <div class="col-xs-12" style="padding: 0">
                    <label>Kết luận của chỉ trì cuộc tiếp dân:</label>
                    {{(!empty($tiepdanInfor[0]['ykienlanhdao']))? $tiepdanInfor[0]['ykienlanhdao']:'Chưa xác định'}}
                </div>

            </div>


        </div>

    </div>

</div>