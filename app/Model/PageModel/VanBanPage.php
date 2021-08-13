<?php

namespace App\Model\PageModel;

use App\Model\TableModel\TheoDoiDonThuTable;
use App\Model\TableModel\VanBanTable;
use Illuminate\Database\Eloquent\Model;


class VanBanPage extends Model
{

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
    public static function StoreVanBanPhapLuat($request,$accountId,$diabanId)
    {
        $id = VanBanTable::StoreVanBanPhapLuat($request,$accountId,$diabanId);

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
    public static function UpdateVanBan($id,$request,$accountId)
    {
        $ret = VanBanTable::UpdateVanBan($id,$request,$accountId);

        if(($ret != 'fail')&&($request->filevanban != null)){

            $ret = VanBanTable::StoreFileVanBan($id);
        }

        return $ret;
    }

    /**************************************************
    Function Name	: GetVanBanDonTheoId
    Description		:
    Argument		: $donId
    Creation Date	: 2017/05/28
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetVanBanDonTheoId($donId)
    {
        $results = VanBanTable::StoreVanBanDon($donId);

        return $results;
    }

    /**************************************************
    Function Name	: PostCommentDon
    Description		:
    Argument		: $donId
    Creation Date	: 2017/05/28
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function PostCommentDon($request)
    {
        $results = TheoDoiDonThuTable::InsertComment($request);

        return $results;
    }
    /**************************************************
    Function Name	: getVanBanTheoDon
    Function Name	:
    Description		:
    Argument		: $donId
    Creation Date	: 2017/08/22
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function getVanBanTheoDon()
    {

    }

}
