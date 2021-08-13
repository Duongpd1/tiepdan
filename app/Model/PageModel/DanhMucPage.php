<?php

namespace App\Model\PageModel;

use App\Model\TableModel\AccountInfoTable;
use App\Model\TableModel\ChuTriTable;
use App\Model\TableModel\DiaBanTable;
use App\Model\TableModel\DonViTable;
use App\Model\TableModel\LinhVucTable;
use App\Model\TableModel\LoaiDonTable;
use App\Model\TableModel\ThamQuyenTable;
use Illuminate\Database\Eloquent\Model;


class DanhMucPage extends Model
{

    /////////////////////////MUC DIA BAN////////////////////////////

    /**************************************************
    Function Name	: GetDiaBan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDiaBan()
    {
        $result = DiaBanTable::GetDiaBan();

        return $result;
    }

    /**************************************************
    Function Name	: GetThongTinDiaBanTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThongTinDiaBanTheoID($id)
    {
        $result = DiaBanTable::GetThongTinDiaBanTheoID($id);

        return $result;
    }

    /**************************************************
    Function Name	: GetMaxThuTu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetMaxThuTu($id)
    {
        $result = DiaBanTable::GetMaxThuTu($id);

        return $result;
    }

    /**************************************************
    Function Name	: StoreDiaBan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreDiaBan($request)
    {
        $result = DiaBanTable::StoreDiaBan($request);

        return $result;
    }

    /**************************************************
    Function Name	: XoaDiaBan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaDiaBan($diaBanIdAllArray)
    {
        $result = DiaBanTable::XoaDiaBan($diaBanIdAllArray);

        return $result;
    }

    /**************************************************
    Function Name	: UpdateDiaBan
    Description		:
    Argument		: $request,$id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateDiaBan($request,$id)
    {
        $result = DiaBanTable::UpdateDiaBan($request,$id);

        return $result;
    }

    /**************************************************
    Function Name	: GetDiaBanCon
    Description		:
    Argument		: $request,$id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDiaBanCon($id)
    {
        $result = DiaBanTable::GetDiaBanCon($id);

        return $result;
    }

    /**************************************************
    Function Name	: GetDiaBan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDiaBanTruDauMuc()
    {
        $result = DiaBanTable::GetDiaBanTruDauMuc();

        return $result;
    }

    /////////////////////////MUC DON VI////////////////////////////

    /**************************************************
    Function Name	: GetDonVi
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDonVi()
    {
        $result = DonViTable::GetDonVi();

        return $result;
    }

    /**************************************************
    Function Name	: StoreDonVi
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreDonVi($request)
    {
        $result = DonViTable::StoreDonVi($request);

        return $result;
    }

    /**************************************************
    Function Name	: GetThongTinDonViTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThongTinDonViTheoID($id)
    {
        $result = DonViTable::GetThongTinDonViTheoID($id);

        return $result;
    }

    /**************************************************
    Function Name	: GetMaxThuTuDonVi
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetMaxThuTuDonVi($id)
    {
        $result = DonViTable::GetMaxThuTu($id);

        return $result;
    }

    /**************************************************
    Function Name	: GetTenNguoiDaiDien
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTenNguoiDaiDien($nguoidaidienid)
    {
        $result = AccountInfoTable::GetFullName($nguoidaidienid);

        return $result;
    }

    /**************************************************
    Function Name	: GetNguoiDaiDien
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetNguoiDaiDien()
    {
        $result = AccountInfoTable::getDanhSachNhanVien();

        return $result;
    }

    /**************************************************
    Function Name	: GetDonViCon
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDonViCon($id)
    {
        $result = DonViTable::GetDonViCon($id);

        return $result;
    }

    /**************************************************
    Function Name	: XoaDonVi
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaDonVi($diaViIdAllArray)
    {
        $result = DonViTable::XoaDonVi($diaViIdAllArray);

        return $result;
    }

    /**************************************************
    Function Name	: UpdateDonVi
    Description		:
    Argument		: $request,$id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateDonVi($request,$id)
    {
        $result = DonViTable::UpdateDonVi($request,$id);

        return $result;
    }

    /////////////////////////MUC LOAI DON////////////////////////////

    /**************************************************
    Function Name	: GetLoaiDon
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLoaiDon()
    {
        $result = LoaiDonTable::GetLoaiDon();

        return $result;
    }

    /**************************************************
    Function Name	: StoreLoaiDon
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreLoaiDon($request)
    {
        $result = LoaiDonTable::StoreLoaiDon($request);

        return $result;
    }

    /**************************************************
    Function Name	: XoaLoaiDon
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaLoaiDon($id)
    {
        $result = LoaiDonTable::XoaLoaiDon($id);

        return $result;
    }

    /**************************************************
    Function Name	: GetLoaiDonTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLoaiDonTheoID($id)
    {
        $result = LoaiDonTable::GetLoaiDonTheoID($id);

        return $result;
    }

    /**************************************************
    Function Name	: UpdateLoaiDon
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateLoaiDon($request,$id)
    {
        $result = LoaiDonTable::UpdateLoaiDon($request,$id);

        return $result;
    }

    /////////////////////////MUC LINH VUC////////////////////////////

    /**************************************************
    Function Name	: GetLinhVuc
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLinhVuc()
    {
        $result = LinhVucTable::GetLinhVuc();

        return $result;
    }

    /**************************************************
    Function Name	: StoreLinhVuc
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreLinhVuc($request)
    {
        $result = LinhVucTable::StoreLinhVuc($request);

        return $result;
    }

    /**************************************************
    Function Name	: XoaLinhVuc
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaLinhVuc($id)
    {
        $result = LinhVucTable::XoaLinhVuc($id);

        return $result;
    }

    /**************************************************
    Function Name	: GetLinhVucTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLinhVucTheoID($id)
    {
        $result = LinhVucTable::GetLinhVucTheoID($id);

        return $result;
    }

    /**************************************************
    Function Name	: UpdateLinhVuc
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateLinhVuc($request,$id)
    {
        $result = LinhVucTable::UpdateLinhVuc($request,$id);

        return $result;
    }

    /////////////////////////MUC THAM QUYEN////////////////////////////

    /**************************************************
    Function Name	: GetThamQuyen
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThamQuyen()
    {
        $result = ThamQuyenTable::GetThamQuyen();

        return $result;
    }

    /**************************************************
    Function Name	: StoreThamQuyen
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreThamQuyen($request)
    {
        $result = ThamQuyenTable::StoreThamQuyen($request);

        return $result;
    }

    /**************************************************
    Function Name	: GetMaxThuTuThamQuyen
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetMaxThuTuThamQuyen($id)
    {
        $result = ThamQuyenTable::GetMaxThuTu($id);

        return $result;
    }

    /**************************************************
    Function Name	: GetThongTinThamQuyenTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThongTinThamQuyenTheoID($id)
    {
        $result = ThamQuyenTable::GetThongTinThamQuyenTheoID($id);

        return $result;
    }

    /**************************************************
    Function Name	: GetThamQuyenCon
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThamQuyenCon($id)
    {
        $result = ThamQuyenTable::GetThamQuyenCon($id);

        return $result;
    }

    /**************************************************
    Function Name	: XoaDonVi
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaThamQuyen($id)
    {
        $result = ThamQuyenTable::XoaThamQuyen($id);

        return $result;
    }

    /**************************************************
    Function Name	: UpdateThamQuyen
    Description		:
    Argument		: $request,$id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateThamQuyen($request,$id)
    {
        $result = ThamQuyenTable::UpdateThamQuyen($request,$id);

        return $result;
    }

    /////////////////////////MUC CHU TRI////////////////////////////

    /**************************************************
    Function Name	: getChuTri
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getChuTri()
    {
        $result = ChuTriTable::getChuTri();

        return $result;
    }

    /**************************************************
    Function Name	: getChuTriAll
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getChuTriAll()
    {
        $result = ChuTriTable::getChuTriAll();

        return $result;
    }

    /**************************************************
    Function Name	: getChucVuTheoId
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getChucVuTheoId($id)
    {
        $result = ChuTriTable::getChucVuTheoId($id);

        return $result;
    }

    /**************************************************
    Function Name	: xoaChuTriTheoId
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function xoaChuTriTheoId($id)
    {
        $result = ChuTriTable::xoaChuTriTheoId($id);

        return $result;
    }

    /**************************************************
    Function Name	: themChuTri
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function themChuTri($request)
    {
        $result = ChuTriTable::themChuTri($request);

        return $result;
    }
}
