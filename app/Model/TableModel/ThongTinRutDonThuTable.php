<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;

class ThongTinRutDonThuTable extends Model
{
    /**************************************************
    Function Name	: xoaDonThu
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function xoaDonThu($donthuid)
    {
        try {
            DB::table('thongtinrutdonthu')
                ->where('donthuid', $donthuid)
                ->delete();

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }
        return $result;
    }
    /**************************************************
    Function Name	: updateDinhChiGiaiQuyetKhieuNai
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
      public static function updateDinhChiGiaiQuyetKhieuNai($donthuId,$quyetdinh)
      {
          DB::table('thongtinrutdonthu')
              ->where('donthuid',$donthuId)
              ->update(['dinhchigiaiquyetkhieunai'=>$quyetdinh]);
      }
    /**************************************************
    Function Name	: updateChamDutToCao
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateChamDutToCao($donthuId,$thongbao)
    {
        DB::table('thongtinrutdonthu')
            ->where('donthuid',$donthuId)
            ->update(['thongbaochamduttocao'=>$thongbao]);
    }
}
