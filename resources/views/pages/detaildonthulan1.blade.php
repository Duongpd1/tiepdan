<!DOCTYPE html>
<!-- saved from url=(0105)http://kntc.huesoft.com.vn:8088/CompDenu/DetailDonThuLan1.aspx?objID=12516CDC-A458-42D5-86CE-FA8F487D46EF -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><title>
        Chi tiết đơn
    </title>
    <style type="text/css">
        body { margin: 0; padding: 0; font-size: 12px; font-family: Arial, Verdana, 'Times New Roman'; }
        p { margin: 3px auto; padding: 0; }
        span.left { width: 34%; font-weight: bold; float: left; }
        span.right { width: 66%; float: left; text-align: justify; }
        h2 { font-size: 15px; font-weight: bold; color: #0b73f7; margin: 5px 0; padding: 3px; text-transform:uppercase; text-align: center; }
    </style>
</head>
<body>
<form method="post" action="" id="form1">
    <div class="aspNetHidden">
        <input type="hidden" name="" id="" value="">
    </div>

    <div style="border: 1px solid #0034dc; margin: 5px; padding: 0 5px;">
        <h2>Chi tiết đơn</h2>
        <p><span class="left">Số thụ lý:</span> <span id="lblSoThuLy" class="right">{{$donthu['donthu']->sothuly}}</span></p>
        <p><span class="left">Người viết đơn:</span> <span id="lblNguoiVietDon" class="right">{{mb_strtoupper($donthu['donthu']->tennguoivietdon)}}</span></p>
        <p><span class="left">Địa chỉ:</span> <span id="lblDiaChi" class="right">{{$donthu['donthu']->diachinguoiviet}}</span></p>
        <p><span class="left">Đơn do:</span> <span id="lblDonDo" class="right">
                @if($donthu['donthu']->nguondon == "dodan")
                    Cá nhân chuyển đến
                @else
                    Do đơn vị chuyển đến
                @endif
            </span></p>
        <p><span class="left">Theo dạng:</span> <span id="lblDangDon" class="right">
                @if($donthu['donthu']->songuoi == \App\Model\TableModel\DonThuTable::CA_NHAN)
                    Cá nhân
                @else
                    Tập thể
                @endif
            </span></p>
        <p><span class="left">Đối tượng khiếu nại:</span> <span id="lblDoiTuongKN" class="right">
                @if($donthu['donthu']->doituongkhieunai!=null)
                {{mb_strtoupper($donthu['donthu']->doituongkhieunai)}}
                @else
                    Chưa xác định!
                @endif
            </span></p>
        <p><span class="left">Người Xử lý:</span> <span id="lblCaNhanToChucGiaiQuyet" class="right">

            @if($donthu['phanloai']->nguoixuly!=null)
                @for($i = 0;$i<count($nguoi_xuly);$i++)
                    @if($donthu['phanloai']->nguoixuly == $nguoi_xuly[$i]->accountid)
                        {{$nguoi_xuly[$i]->fullname}}
                    @endif
                @endfor
            @else
                Chưa xác định
            @endif
            </span>
        </p>
        <p><span class="left">Nội dung đơn:</span> <span id="lblNoiDungDonThu" class="right">{{$donthu['donthu']->noidung}}</span></p>
        <!-- phân loại -->
        <p><span class="left">Hướng giải quyết:</span> <span id="lblHuongGiaiQuyet" class="right">
                @if($donthu['phanloai']->huonggiaiquyet=="1")
                    Thụ Lý
                @elseif($donthu['phanloai']->huonggiaiquyet=="2")
                    Trả đơn
                @elseif($donthu['phanloai']->huonggiaiquyet=="3")
                    Chuyển đơn
                @else
                    Chưa xác định
                @endif
            </span></p>
        <!-- theo dõi xử lý -->
        <p><span class="left">Nội dung giải quyết của lãnh đạo:</span> <span id="lblNoiDungGiaiQuyet" class="right">{{$donthu['phanloai']->dexuat}}</span></p>
        <!-- Kết quả giải quyết -->
        <p style="clear:both; padding-bottom: 5px;"></p>
    </div>
</form>


</body></html>