<?php

namespace App\Model\PageModel;

use App\Model\TableModel\GopYTroGiupTable;
use App\Model\TableModel\ThongBaoTable;
use App\Model\TableModel\TinTucSuKienTable;
use App\Model\TableModel\VanBanTable;
use Illuminate\Database\Eloquent\Model;


class CongThongTinPage extends Model
{
    /**************************************************
    Function Name	: GetBaiVietTinTucSuKien
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetBaiVietTinTucSuKien($soLuongHienThi)
    {
        $result = TinTucSuKienTable::GetBaiVietTinTucSuKien($soLuongHienThi);
        return $result;
    }

    /**************************************************
    Function Name	: StoreBaiVietTinTucSuKien
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreBaiVietTinTucSuKien($request)
    {
        $id = TinTucSuKienTable::StoreBaiVietTinTucSuKien($request);

        $ret = $id;

        if(($id != 'fail')&&($request->hinhanh != null)){

            $ret = TinTucSuKienTable::StoreAnhBaiViet($id,$request->chuthichanh);

        }

        if($ret != 'fail'){

            $ret = 'successful';
        }


        return $ret;
    }

    /**************************************************
    Function Name	: ChangeTrangThaiBaiViet
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function ChangeTrangThaiBaiViet($request)
    {
        $result = TinTucSuKienTable::ChangeTrangThaiBaiViet($request);
        return $result;
    }

    /**************************************************
    Function Name	: XoaBaiViet
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaBaiViet($request)
    {
        $result = TinTucSuKienTable::XoaBaiViet($request);
        return $result;
    }

    /**************************************************
    Function Name	: GetBaiVietTheoID
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetBaiVietTheoID($id)
    {
        $result = TinTucSuKienTable::GetBaiVietTheoID($id);
        return $result;
    }

    /**************************************************
    Function Name	: GetThongTinGioiThieu
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThongTinGioiThieu($soLuongHienThi)
    {
        $result = TinTucSuKienTable::GetThongTinGioiThieu($soLuongHienThi);
        return $result;
    }

    /**************************************************
    Function Name	: UpdateBaiViet
    Description		:
    Argument		: $id, $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateBaiViet($id,$request)
    {
        $ret = TinTucSuKienTable::UpdateBaiViet($id,$request);

        if(($ret != 'fail')&&($request->hinhanh != null)){

            $ret = TinTucSuKienTable::StoreAnhBaiViet($id,$request->chuthichanh);
        }

        return $ret;
    }

    /**************************************************
    Function Name	: GetGopYCongDan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetGopYCongDan($soLuongHienThi)
    {
        $result = GopYTroGiupTable::GetGopYCongDan($soLuongHienThi);
        return $result;
    }

    /**************************************************
    Function Name	: ChangeTrangThaiGopYTroGiup
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function ChangeTrangThaiGopYTroGiup($request)
    {
        $result = GopYTroGiupTable::ChangeTrangThaiGopYTroGiup($request->gopyid,$request->newtrangthai);
        return $result;
    }

    /**************************************************
    Function Name	: XoaGopYTroGiup
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaGopYTroGiup($request)
    {
        $result = GopYTroGiupTable::XoaGopYTroGiup($request->gopyid);

        return $result;
    }

    /**************************************************
    Function Name	: GetTroGiupPhapLuat
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTroGiupPhapLuat($soLuongHienThi)
    {
        $result = GopYTroGiupTable::GetTroGiupPhapLuat($soLuongHienThi);
        return $result;
    }

    /**************************************************
    Function Name	: GetThongBao
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThongBao($soLuongHienThi)
    {
        $result = ThongBaoTable::GetThongBao($soLuongHienThi);
        return $result;
    }

    /**************************************************
    Function Name	: StoreThongBao
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreThongBao($request)
    {
        $id = ThongBaoTable::StoreThongBao($request);

        $ret = $id;

        if(($id != 'fail')&&($request->fileupload != null)){

            $ret = ThongBaoTable::StoreFileUpload($id);

        }

        if($ret != 'fail'){

            $ret = 'successful';
        }


        return $ret;
    }

    /**************************************************
    Function Name	: XoaThongBao
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaThongBao($request)
    {
        $result = ThongBaoTable::XoaThongBao($request->thongbaoid);

        return $result;
    }

    /**************************************************
    Function Name	: GetThongBaoTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThongBaoTheoID($id)
    {
        $result = ThongBaoTable::GetThongBaoTheoID($id);
        return $result;
    }

    /**************************************************
    Function Name	: UpdateThongBao
    Description		:
    Argument		: $id, $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateThongBao($id,$request)
    {
        $ret = ThongBaoTable::UpdateThongBao($id,$request);

        if(($ret != 'fail')&&($request->fileupload != null)){

            $ret = ThongBaoTable::StoreFileUpload($id);
        }

        return $ret;
    }

    /**************************************************
    Function Name	: GetVanBanPhapLuat
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetVanBanPhapLuat()
    {
        $result = VanBanTable::GetVanBan(VBPL);
        return $result;
    }

    /**************************************************
    Function Name	: StoreVanBanPhapLuat
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreVanBanPhapLuat($request)
    {
        $id = VanBanTable::StoreVanBanPhapLuat($request);

        $ret = $id;

        if(($id != 'fail')&&($request->filevanban != null)){

            $ret = VanBanTable::StoreFileVanBan($id);

        }

        if($ret != 'fail'){

            $ret = 'successful';
        }


        return $ret;
    }

    /**************************************************
    Function Name	: XoaVanBan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaVanBan($request)
    {
        $result = VanBanTable::XoaVanBan($request->vanbanid);

        return $result;
    }

    /**************************************************
    Function Name	: GetVanBanTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetVanBanTheoID($id)
    {
        $result = VanBanTable::GetVanBanTheoID($id);
        return $result;
    }

    /**************************************************
    Function Name	: UpdateVanBan
    Description		:
    Argument		: $id,$request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateVanBan($id,$request)
    {
        $ret = VanBanTable::UpdateVanBan($id,$request);

        if(($ret != 'fail')&&($request->filevanban != null)){

            $ret = VanBanTable::StoreFileVanBan($id);
        }

        return $ret;
    }

}
