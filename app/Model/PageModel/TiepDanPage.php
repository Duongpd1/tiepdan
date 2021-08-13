<?php

namespace App\Model\PageModel;

use App\Model\TableModel\DiaBanTable;
use App\Model\TableModel\DonThuTable;
use App\Model\TableModel\KetQuaTiepDanTable;
use App\Model\TableModel\LichTiepDanTable;
use App\Model\TableModel\LinhVucTable;
use App\Model\TableModel\LoaiDonTable;
use App\Model\TableModel\ThongTinTiepDanTable;
use Illuminate\Database\Eloquent\Model;


class TiepDanPage extends Model
{

    /**************************************************
    Function Name	: StoreLichTiepDan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreLichTiepDan($request,$diaBanId)
    {
        $result = LichTiepDanTable::StoreLichTiepDan($request,$diaBanId);

        return $result;
    }

    /**************************************************
    Function Name	: GetLichTiepDan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLichTiepDan($diaBanIdAllArray,$soLuongHienThi)
    {
        $result = LichTiepDanTable::GetLichTiepDan($diaBanIdAllArray,$soLuongHienThi);
        return $result;
    }

    /**************************************************
    Function Name	: XoaLichTiepDan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaLichTiepDan($request)
    {
        $result = LichTiepDanTable::XoaLichTiepDan($request->lichtiepid);

        return $result;
    }

    /**************************************************
    Function Name	: GetLichTiepDanTheoID
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLichTiepDanTheoID($id)
    {
        $result = LichTiepDanTable::GetLichTiepDanTheoID($id);
        return $result;
    }

    /**************************************************
    Function Name	: UpdateLichTiepDan
    Description		:
    Argument		: $id,$request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateLichTiepDan($id,$request)
    {
        $ret = LichTiepDanTable::UpdateLichTiepDan($id,$request);

        return $ret;
    }

    /**************************************************
    Function Name	: GetLichTiepDanTheoThang
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLichTiepDanTheoThang($request)
    {
        $result = LichTiepDanTable::GetLichTiepDanTheoThang($request->thang, $request->nam);
        return $result;
    }
    /**************************************************
    Function Name	: GetLichTiepDanTheoLanhDao
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLichTiepDanTheoLanhDao($request)
    {
        $result = LichTiepDanTable::GetLichTiepDanTheoLanhDao($request->name,$request->nam);
        return $result;
    }

    /**************************************************
    Function Name	: StoreThongTinTiepDan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreThongTinTiepDan($request)
    {
        $id = ThongTinTiepDanTable::StoreThongTinTiepDan($request);

        $ret = $id;

        if(($id != 'fail')&&($request->fileupload != null)){

            $ret = ThongTinTiepDanTable::StoreFileThongTinTiepDan($id);

        }

        if($ret != 'fail'){

            $ret = 'successful';
        }


        return $ret;
    }

    /**************************************************
    Function Name	: GetThongTinTiepDan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThongTinTiepDan($soLuongHienThi)
    {
        $result = ThongTinTiepDanTable::GetThongTinTiepDan($soLuongHienThi);
        return $result;
    }

    /**************************************************
    Function Name	: XoaThongTinTiepDan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaThongTinTiepDan($request)
    {
        $result = ThongTinTiepDanTable::XoaThongTinTiepDan($request->thongtintiepdanid);

        return $result;
    }

    /**************************************************
    Function Name	: ChangeTrangThaiThongTinTiepDan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function ChangeTrangThaiThongTinTiepDan($request)
    {
        $result = ThongTinTiepDanTable::ChangeTrangThaiThongTinTiepDan($request->thongtintiepdanid,$request->newtrangthai);
        return $result;
    }

    /**************************************************
    Function Name	: GetThongTinTiepDanTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThongTinTiepDanTheoID($id)
    {
        $result = ThongTinTiepDanTable::GetThongTinTiepDanTheoID($id);
        return $result;
    }

    /**************************************************
    Function Name	: UpdateThongTinTiepDan
    Description		:
    Argument		: $id,$request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateThongTinTiepDan($id,$request)
    {
        $ret = ThongTinTiepDanTable::UpdateThongTinTiepDan($id,$request);

        if(($ret != 'fail')&&($request->fileupload != null)){

            $ret = ThongTinTiepDanTable::StoreFileThongTinTiepDan($id);
        }

        return $ret;
    }

    /**************************************************
    Function Name	: GetKetQuaTiepDan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetKetQuaTiepDanTheoDiaBan($diaBanIdAllArray,$soLuongHienThi)
    {
        $result = KetQuaTiepDanTable::GetKetQuaTiepDanTheoDiaBan($diaBanIdAllArray,$soLuongHienThi);
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
    Function Name	: GetLoaiHinh
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLoaiHinh(){

        $result = LoaiDonTable::GetTatCaLoaiDon();
        return $result;
    }

    /**************************************************
    Function Name	: GetLinhVuc
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLinhVuc(){

        $result = LinhVucTable::GetTatCaLinhVuc();
        return $result;
    }

    /**************************************************
    Function Name	: StoreDanhSachTiepDan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreDanhSachTiepDan($request,$diaBanId)
    {
        $result = KetQuaTiepDanTable::StoreDanhSachTiepDan($request,$diaBanId);

        return $result;
    }

    /**************************************************
    Function Name	: GetKetQuaTiepDanTheoID
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetKetQuaTiepDanTheoID($id)
    {
        $result = KetQuaTiepDanTable::GetKetQuaTiepDanTheoID($id);

        return $result;
    }

    /**************************************************
    Function Name	: UpdateDanhSachTiepCongDan
    Description		:
    Argument		: $id,$request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateDanhSachTiepDan($id,$request)
    {
        $ret = KetQuaTiepDanTable::UpdateDanhSachTiepDan($id,$request);

        return $ret;
    }

    /**************************************************
    Function Name	: XoaDanhSachTiepDan
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaDanhSachTiepDan($id)
    {
        $ret = KetQuaTiepDanTable::XoaDanhSachTiepDan($id);

        return $ret;
    }
    /**************************************************
    Function Name	: getIdTiepDanMax
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function getIdTiepDanMax()
    {
        $result = KetQuaTiepDanTable::getTiepDanID();

        if($result!= null)
        {
            $result = $result->tiepdanid;
        }
        else
        {
            $result = null;
        }

        return $result;
    }
    /**************************************************
    Function Name	: getBaoCaoTiepDan
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function getBaoCaoTiepDan($request,$diaBanIdAllArray)
    {
        $data_ketqua = KetQuaTiepDanTable::BaoCaoTiepDan($request->TuNgay,$request->DenNgay,$diaBanIdAllArray);

        return $data_ketqua;
    }
    /**************************************************
    Function Name	: getBaoCaoTiepDan
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLichTiepDanTheoNam($request)
    {
        $result = LichTiepDanTable::GetLichTiepDanTheoNam($request->name,$request->thang,$request->nam);
        return $result;
    }
    /**************************************************
    Function Name	: getThongTinCongDanKhac
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function getThongTinCongDanKhac($tiepdaId)
    {
        $data = KetQuaTiepDanTable::ThongTinCongDanKhac($tiepdaId);

        return $data;
    }
    /**************************************************
    Function Name	: InsertCongDanKhac
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function InsertCongDanKhac($request)
    {
        $type = $request->type;
        if($type == 'tiepdan')
        {
            $data = KetQuaTiepDanTable::AddThongTinCongDanKhac($request);
        }
        else
        {
            $data = DonThuTable::InsertDonThuNhieuNguoi($request);
        }


        return $data;
    }
    /**************************************************
    Function Name	: DeleteCongDanKhac
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function DeleteCongDanKhac($request)
    {
        $congDanId = $request->congDanId;
        $type = $request->type;
        $data = KetQuaTiepDanTable::DeleteThongTinCongDanKhac($congDanId,$type);


        return $data;
    }
    /**************************************************
    Function Name	: UploadFileTiepDan
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function UploadFileTiepDan($iD,$request)
    {
        KetQuaTiepDanTable::InsertFileDinhKem($iD,$request);
    }
    /**************************************************
    Function Name	: KetQuaTiepDanThangTheoDiaBan
    Description		:
    Argument		:
    Creation Date	: 2015/05/25
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function KetQuaTiepDanThangTheoDiaBan($diaBanIdAllArray)
    {

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $nam = date('Y');
        $thang1data = LichTiepDanTable::GetLichTiepDanThangTheoDiaBan($diaBanIdAllArray,1,$nam);
        $thang2data = LichTiepDanTable::GetLichTiepDanThangTheoDiaBan($diaBanIdAllArray,2,$nam);
        $thang3data = LichTiepDanTable::GetLichTiepDanThangTheoDiaBan($diaBanIdAllArray,3,$nam);
        $thang4data = LichTiepDanTable::GetLichTiepDanThangTheoDiaBan($diaBanIdAllArray,4,$nam);
        $thang5data = LichTiepDanTable::GetLichTiepDanThangTheoDiaBan($diaBanIdAllArray,5,$nam);
        $thang6data = LichTiepDanTable::GetLichTiepDanThangTheoDiaBan($diaBanIdAllArray,6,$nam);
        $thang7data = LichTiepDanTable::GetLichTiepDanThangTheoDiaBan($diaBanIdAllArray,7,$nam);
        $thang8data = LichTiepDanTable::GetLichTiepDanThangTheoDiaBan($diaBanIdAllArray,8,$nam);
        $thang9data = LichTiepDanTable::GetLichTiepDanThangTheoDiaBan($diaBanIdAllArray,9,$nam);
        $thang10data = LichTiepDanTable::GetLichTiepDanThangTheoDiaBan($diaBanIdAllArray,10,$nam);
        $thang11data = LichTiepDanTable::GetLichTiepDanThangTheoDiaBan($diaBanIdAllArray,11,$nam);
        $thang12data = LichTiepDanTable::GetLichTiepDanThangTheoDiaBan($diaBanIdAllArray,12,$nam);

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
}
