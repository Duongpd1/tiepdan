<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;

class DoiTuongKhieuNaiToCaoTable extends Model
{

    /**************************************************
    Function Name	: GetDanhSachDoiTuongKhieuNai
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDanhSachDoiTuongKhieuNai(){

        $result = DB::table('doituongkhieunaitocao')
            ->orderby('tendoituong','desc')
            ->get();
        return $result;
    }

    /**************************************************
    Function Name	: StoreDoiTuongKhieuNaiToCao
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreDoiTuongKhieuNaiToCao($request){

        $result = DB::table('doituongkhieunaitocao')
            ->insertGetId([
                'tenvanban' => $request->tenvanban,
                'tendoituong' => $request->tendoituong,
                'diachi' => $request->diachi
            ]);
        return $result;
    }

    /**************************************************
    Function Name	: GetDoiTuongKhieuNaiTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDoiTuongKhieuNaiTheoID($id){

        $result = DB::table('doituongkhieunaitocao')
            ->where('id',$id)
            ->get();
        return $result;
    }
}
