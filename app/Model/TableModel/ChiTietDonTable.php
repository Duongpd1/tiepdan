<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;
use App\Model\TableModel\DonThuTable;

class ChiTietDonTable extends Model
{
    /**************************************************
    Function Name	: InsertLuuHoSoTheoId
    Description		:
    Argument		: $request
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function InsertLuuHoSoTheoId($request)
    {
        try {
            DB::table('vanbanlienquan')
                ->insert([
                    'donthuid' => $request->donthuId,
                    'donLienQuanId' => $request->hoSoId,
                    'nguoiLuu' => $request->accountId,
                ]);

            $result = 'successful';
        }catch (Exception $e){

            $result = 'fail';
        }

        return $result;
    }

    /**************************************************
    Function Name	: GetThongTinVanBanLienQuan
    Description		:
    Argument		: $donThuId
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThongTinVanBanLienQuan($donThuId)
    {
        $result = array();

        $dataDonLienQuan = DB::table('vanbanlienquan')
                        ->where('donLienQuanId',$donThuId)
                        ->get();

        foreach($dataDonLienQuan as $row)
        {
            $data = (object) DonThuTable::getThongTinDonThuTheoId($row->donthuid);

            $result[] = (object) array(
                'donThuId'=>$row->donthuid,
                'soThuLy'=>$data->sothuly,
                'tenNguoiViet'=>$data->tennguoivietdon,
                'tenCoQuan'=>$data->coquanbanhanh,
                'nguoiLuu'=>$row->nguoiLuu,
                'time'=>$row->create_at
            );
        }

        return $result;
    }
    /**************************************************
    Function Name	: GetThongTinDonCon
    Description		:
    Argument		: $donThuId
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThongTinDonCon($donThuId,$donLienQuan = false)
    {
        $result = array();
        $result_array = array();
        $array = array();
        if(!$donLienQuan)
        {
            $array[] = $donThuId;
            $result =  DB::table('donthu')
                ->where('donthulanmotid',$donThuId)
                ->get();
        }
        else {

            $donThuArray = [];
            $donThuArray2 = [];

            $arrayDon_1 = ChiTietDonTable::GetDeQuiTheoDonThuLienQuan($donLienQuan,$donThuArray);
            $arrayDon_2 = ChiTietDonTable::GetDeQuiDonThu($donThuId,$donThuArray2);

            $array = array_merge($arrayDon_1,$arrayDon_2);


            $result = DB::table('donthu')
                ->whereIn('donthuid', $array)
//                ->orWhere('donthulanmotid', $donLienQuan)
                ->get();
        }

        $result_array = array(
            'donThuId'=>$array,
            'thongTin'=>$result
        );


        return $result_array;
    }
    /**************************************************
    Function Name	: GetDeQuiDonThuId
    Description		:
    Argument		: $donThuId
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDeQuiTheoDonThuLienQuan($donThuId,$result)
    {
        $result[] = $donThuId;

        $donThu = DonThuTable::getThongTinDonThuTheoId($donThuId);

        if(!empty($donThu)) {

            $result = ChiTietDonTable::GetDeQuiTheoDonThuLienQuan($donThu->donthulanmotid,$result);

        }

        return $result;
    }

    /**************************************************
    Function Name	: GetDeQuiDonThuId
    Description		:
    Argument		: $donThuId
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDeQuiDonThu($donThuId,$result)
    {
        $result[] = $donThuId;

        $donThu = DB::table('donthu')
            ->where('donthulanmotid', $donThuId)
            ->first();

        if(!empty($donThu)) {

            $result = ChiTietDonTable::GetDeQuiDonThu($donThu->donthuid,$result);

        }

        return $result;
    }
}
