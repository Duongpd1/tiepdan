<?php

namespace App\Model\PageModel;

use App\Model\TableModel\ContentsTable;
use App\Model\TableModel\DiaBanTable;
use App\Model\TableModel\DonThuTable;
use App\Model\TableModel\GopYTroGiupTable;
use App\Model\TableModel\KetQuaGiaiQuyetKNTCTable;
use App\Model\TableModel\KetQuaGiaiQuyetTable;
use App\Model\TableModel\KetQuaTiepDanTable;
use App\Model\TableModel\LichTiepDanTable;
use App\Model\TableModel\LinhVucTable;
use App\Model\TableModel\LoaiDonTable;
use App\Model\TableModel\TheoDoiDonThuTable;
use App\Model\TableModel\ThongBaoTable;
use App\Model\TableModel\ThongTinTiepDanTable;
use App\Model\TableModel\TinTucSuKienTable;
use App\Model\TableModel\VanBanPhapLuatTable;
use App\Model\TableModel\VanBanTable;
use App\Model\TableModel\XuLyDonThuKNTCTable;
use Illuminate\Database\Eloquent\Model;


class TrangChuPage extends Model
{
    /**************************************************
    Function Name	: GetBaiVietTrangChu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetBaiVietTrangChu()
    {
        $thongbaodata = ThongBaoTable::GetThongBaoTrangChu();
        $gioithieuchungdata = TinTucSuKienTable::GetBaiVietTheoTheLoaiTrangChu(GTCHUNG);
        $chucnangnhiemvudata = TinTucSuKienTable::GetBaiVietTheoTheLoaiTrangChu(CNNHIEMVU);
        $lanhdaothanhtratinhphutho = TinTucSuKienTable::GetBaiVietTheoTheLoaiTrangChu(LANHDAOPHUTHO);
        $tintuchoatdongdata = TinTucSuKienTable::GetBaiVietTheoTheLoaiTrangChu(TTHOATDONG);
        $tintiepdandata = TinTucSuKienTable::GetBaiVietTheoTheLoaiTrangChu(TIEPCD);
        $tinkntcdata = TinTucSuKienTable::GetBaiVietTheoTheLoaiTrangChu(KNTC);
        $vanbanphapluatdata = VanBanTable::GetVanBan(VBPL);
//        $thongtintiepdandata = ThongTinTiepDanTable::GetThongTinTiepDan();
//        $ketquakntcdata = KetQuaGiaiQuyetKNTCTable::GetKetQuaKNTC();
//        $ketquakntcdata = DonThuTable::GetKetQuaKNTC();
        $donthugiaiquyettype = [DANGGIAIQUYET,DAGIAIQUYET,KETTHUC];
        $ketquakntcdata = DonThuTable::GetDonThu($donthugiaiquyettype);
        $donthuxulytype = [CHOXULY,DANGXULY];
        $xulydonthukntcdata = DonThuTable::GetDonThu($donthuxulytype);
//        $xulydonthukntcdata = XuLyDonThuKNTCTable::GetXuLyDonThuKNTC();
        $ketquatiepdandata = KetQuaTiepDanTable::GetKetQuaTiepDan();

        $trangchudata = array(
            'thongbao' => $thongbaodata,
            'gioithieuchung' => $gioithieuchungdata,
            'chucnangnhiemvu' => $chucnangnhiemvudata,
            'lanhdaothanhtratinhphutho' => $lanhdaothanhtratinhphutho,
            'tintuchoatdong' => $tintuchoatdongdata,
            'vanbanphapluat' => $vanbanphapluatdata,
            'tintiepdan' => $tintiepdandata,
            'tinkntc' => $tinkntcdata,
            'ketquakntc' => $ketquakntcdata,
            'xulydonthukntc' => $xulydonthukntcdata,
            'ketquatiepdan' => $ketquatiepdandata
        );
        return $trangchudata;
    }

    /**************************************************
    Function Name	: GetBaiVietTinTucHoatDong
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetBaiVietTinTucHoatDong(){

        $tintuchoatdongdata = TinTucSuKienTable::GetBaiVietTinTucHoatDong();
        return $tintuchoatdongdata;
    }

    /**************************************************
    Function Name	: GetNoiDungBaiVietTinTucHoatDong
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetNoiDungBaiVietTinTucHoatDong(){

        $tintuchoatdongdata = TinTucSuKienTable::GetBaiVietTinTucHoatDong();
        return $tintuchoatdongdata;
    }

    /**************************************************
    Function Name	: StoreGopYTroGiup
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreGopYTroGiup($request,$type){

        $result = GopYTroGiupTable::StoreGopYTroGiup($request,$type);
        return $result;
    }

    /**************************************************
    Function Name	: SearchVanBan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function SearchVanBan($request){

        $result = VanBanTable::SearchVanBan($request->keysearch);
        return $result;
    }

    /**************************************************
    Function Name	: GetLichTiepCongDan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLichTiepCongDan(){

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $nam = date('Y');
        $thang1data = LichTiepDanTable::GetLichTiepDanTheoThang(1,$nam);
        $thang2data = LichTiepDanTable::GetLichTiepDanTheoThang(2,$nam);
        $thang3data = LichTiepDanTable::GetLichTiepDanTheoThang(3,$nam);
        $thang4data = LichTiepDanTable::GetLichTiepDanTheoThang(4,$nam);
        $thang5data = LichTiepDanTable::GetLichTiepDanTheoThang(5,$nam);
        $thang6data = LichTiepDanTable::GetLichTiepDanTheoThang(6,$nam);
        $thang7data = LichTiepDanTable::GetLichTiepDanTheoThang(7,$nam);
        $thang8data = LichTiepDanTable::GetLichTiepDanTheoThang(8,$nam);
        $thang9data = LichTiepDanTable::GetLichTiepDanTheoThang(9,$nam);
        $thang10data = LichTiepDanTable::GetLichTiepDanTheoThang(10,$nam);
        $thang11data = LichTiepDanTable::GetLichTiepDanTheoThang(11,$nam);
        $thang12data = LichTiepDanTable::GetLichTiepDanTheoThang(12,$nam);

        $result = array(
            'thang1' => $thang1data,
            'thang2' => $thang2data,
            'thang3' => $thang3data,
            'thang4' => $thang4data,
            'thang5' => $thang5data,
            'thang6' => $thang6data,
            'thang7' => $thang7data,
            'thang8' => $thang8data,
            'thang9' => $thang9data,
            'thang10' => $thang10data,
            'thang11' => $thang11data,
            'thang12' => $thang12data

        );
        return $result;
    }

    /**************************************************
    Function Name	: SelectLichTiepDanTheoThang
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function SelectLichTiepDanTheoThang($request){

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $nam = date('Y');
        $result = LichTiepDanTable::GetLichTiepDanTheoThang($request->thang,$nam);
        return $result;
    }

    /**************************************************
    Function Name	: GetKetQuaGiaiQuyetTheoID
    Description		:
    Argument		: $donthuid
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetKetQuaGiaiQuyetTheoID($donthuid){

        $result = KetQuaGiaiQuyetTable::GetKetQuaGiaiQuyetTheoID($donthuid);
        return $result;
    }

    /**************************************************
    Function Name	: GetKetQuaTiepDanTheoID
    Description		:
    Argument		: $tiepdanid
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetKetQuaTiepDanTheoID($tiepdanid){

        $result = KetQuaTiepDanTable::GetKetQuaTiepDanTheoID($tiepdanid);
        return $result;
    }

    /**************************************************
    Function Name	: GetTenLoaiDon
    Description		:
    Argument		: $loaidonid
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTenLoaiDon($loaidonid){

        $result = LoaiDonTable::GetTenLoaiDon($loaidonid);
        return $result;
    }

    /**************************************************
    Function Name	: GetTenLinhVuc
    Description		:
    Argument		: $linhvucid
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTenLinhVuc($linhvucid){

        $result = LinhVucTable::GetTenLinhVuc($linhvucid);
        return $result;
    }

    /**************************************************
    Function Name	: GetTenDiaBan
    Description		:
    Argument		: $tiepdanid
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTenDiaBan($diabanid){

        $result = DiaBanTable::GetTenDiaBan($diabanid);
        return $result;
    }

    /**************************************************
    Function Name	: SearchKetQuaTiepDan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function SearchKetQuaTiepDan($request){

        $result = KetQuaTiepDanTable::SearchKetQuaTiepDan($request->keysearch);
        return $result;
    }

    /**************************************************
    Function Name	: SearchKetQuaKNTC
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function SearchKetQuaKNTC($request){

        $result = DonThuTable::SearchKetQuaKNTC($request->keysearch);
        return $result;
    }

    /**************************************************
    Function Name	: SearchKetQuaXuLyKNTC
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function SearchKetQuaXuLyKNTC($request){

        $result = DonThuTable::SearchKetQuaXuLyKNTC($request->keysearch);
        return $result;
    }

    /**************************************************
    Function Name	: GetTheoDoiDonThuTheoID
    Description		:
    Argument		: $donthuid
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTheoDoiDonThuTheoID($donthuid){

        $result = TheoDoiDonThuTable::GetTheoDoiDonThuTheoID($donthuid);
        return $result;
    }
}
