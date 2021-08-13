<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;

class ThamQuyenTable extends Model
{

    /**************************************************
    Function Name	: GetThamQuyen
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetThamQuyen(){

        $result = DB::table('thamquyen')
            ->orderby('tructhuoc','asc')
            ->get();
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
    public static function StoreThamQuyen($request){

        try {
            DB::table('thamquyen')
                ->insert([
                    'tenthamquyen' => $request->tenthamquyen,
                    'tructhuoc' => $request->tructhuoc,
                    'thutu' => $request->thutu,
                    'diachi' => $request->diachi,
                    'dienthoai' => $request->dienthoai,
                    'trangthai' => $request->trangthai
                ]);

            $result = 'successful';
        }catch (Exception $e){

            $result = 'fail';
        }

        return $result;
    }

    /**************************************************
    Function Name	: GetMaxThuTu
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetMaxThuTu($id){

        $result = DB::table('thamquyen')
            ->where('tructhuoc',$id)
            ->max('thutu');
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
    public static function GetThongTinThamQuyenTheoID($id){

        $result = DB::table('thamquyen')
            ->where('id',$id)
            ->get();
        return $result;
    }

    /**************************************************
    Function Name	: XoaThamQuyen
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaThamQuyen($id){

        try {
            DB::table('thamquyen')
                ->where('id', $id)
                ->delete();

            $result = 'successful';
        }catch (Exception $e){

            $result = 'fail';
        }
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
    public static function GetThamQuyenCon($id){

        $result = DB::table('thamquyen')
            ->where('tructhuoc',$id)
            ->get();
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
    public static function UpdateThamQuyen($request,$id){

        $result = DB::table('thamquyen')
            ->where('id', $id)
            ->update([
                'tenthamquyen' => $request->tenthamquyen,
                'tructhuoc' => $request->tructhuoc,
                'thutu' => $request->thutu,
                'diachi' => $request->diachi,
                'dienthoai' => $request->dienthoai,
                'trangthai' => $request->trangthai
            ]);
        return $result;
    }
}
