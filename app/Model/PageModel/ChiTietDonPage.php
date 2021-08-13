<?php

namespace App\Model\PageModel;

use Illuminate\Database\Eloquent\Model;
use App\Model\TableModel\ChiTietDonTable;


class ChiTietDonPage extends Model
{
    /**************************************************
    Function Name	: PostLuuHoSoTheoId
    Description		:
    Argument		: $request
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function PostLuuHoSoTheoId($request)
    {
        $result = ChiTietDonTable::InsertLuuHoSoTheoId($request);

        return $result;
    }

    /**************************************************
    Function Name	: GetVanBanLienQuanTheoId
    Description		:
    Argument		: $donThuId
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetVanBanLienQuanTheoId($donThuId)
    {
        $result = ChiTietDonTable::GetThongTinVanBanLienQuan($donThuId);

        return $result;
    }
    /**************************************************
    Function Name	: GetDonConTheoId
    Description		:
    Argument		: $donThuId
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDonConTheoId($donThuId,$donLienQuanId = false)
    {
        if(!$donLienQuanId)
        {
            $result = ChiTietDonTable::GetThongTinDonCon($donThuId);

        }
        else
        {

            $result = ChiTietDonTable::GetThongTinDonCon($donThuId,$donLienQuanId);
        }


        return $result;
    }
}
