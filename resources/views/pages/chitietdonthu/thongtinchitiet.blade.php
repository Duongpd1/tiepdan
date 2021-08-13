<div id="home" class="tab-pane fade in active">
    <div class="row">
        <div class="col-xs-9">

            <div class="row">
                <div class="col-xs-7" style="padding: 0">
                    <label>Đơn do:</label>
                    @if($result['noidung'][0]->nguondon == "dodan")
                        {{"Cá nhân chuyển đến"}}
                    @else
                        {{"Do đơn vị chuyển đến"}}
                    @endif
                </div>
                <div class="col-xs-5" style="padding: 0">
                    <label>Ngày ghi trên đơn :</label>
                    @if($result['noidung'][0]->ngayviet != "0000-00-00")
                        {{date("d/m/Y",strtotime($result['noidung'][0]->ngayviet))}}
                    @else
                        Chưa xác định
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-4" style="padding: 0">
                    <label>
                        Số CMND/Hộ chiếu:
                    </label>
                    @if($result['noidung'][0]->cmnd_hc!=null)
                        {{$result['noidung'][0]->cmnd_hc}}
                    @else
                        Chưa xác định
                    @endif
                </div>
                <div class="col-xs-3" style="padding: 0">
                    <label>
                        Ngày cấp:
                    </label>
                    @if($result['noidung'][0]->ngaycap!="0000-00-00")
                        {{convertNgay($result['noidung'][0]->ngaycap)}}
                    @else
                        Chưa xác định
                    @endif
                </div>
                <div class="col-xs-5" style="padding: 0">
                    <label>
                        Nơi cấp:
                    </label>
                    @if($result['noidung'][0]->noicap!=null)
                        {{$result['noidung'][0]->noicap}}
                    @else
                        Chưa xác định
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7" style="padding: 0">
                    <label>
                        Số Điện Thoại:
                    </label>
                    @if($result['noidung'][0]->sdt!=null)
                        {{$result['noidung'][0]->sdt}}
                    @else
                        Chưa xác định
                    @endif
                </div>

                <div class="col-xs-5" style="padding: 0">
                    <label>
                        Theo dạng:
                    </label>
                    @if($result['noidung'][0]->songuoi == \App\Model\TableModel\DonThuTable::CA_NHAN)
                        {{"Cá nhân"}}
                    @else
                        {{"Nhiều người"}}
                    @endif
                </div>
            </div>

            <div class="row" style=" {{($result['noidung'][0]->songuoi == \App\Model\TableModel\DonThuTable::TAP_THE)?'':'display:none'}}">
                <div class="col-xs-7" style="padding: 0">
                    <label>
                        Số người tham gia:
                    </label>
                    {{($result['noidung'][0]->songuoilienquan != 0)? $result['noidung'][0]->songuoilienquan:'Chưa xác định'}}
                </div>

                <div class="col-xs-5" style="padding: 0">
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12" style="padding: 0">
                    <label>Người có quyền lợi, nghĩa vụ liên quan:</label>
                    {{$result['noidung'][0]->nguoiLienQuan}}
                </div>

            </div>


        </div>

    </div>

</div>