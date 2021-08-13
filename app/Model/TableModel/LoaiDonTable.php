<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;

class LoaiDonTable extends Model
{
    /**************************************************
    Function Name	: GetLoaiDon
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLoaiDon(){

        $result = DB::table('loaidon')
            ->orderby('tenloaidon','asc')
            ->paginate(10);

        return $result;
    }

    /**************************************************
    Function Name	: GetTatCaLoaiDon
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTatCaLoaiDon(){

        $result = DB::table('loaidon')
            ->orderby('tenloaidon','asc')
            ->get();

        return $result;
    }

    /**************************************************
    Function Name	: StoreLoaiDon
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreLoaiDon($request){

        try {

            DB::table('loaidon')
                ->insert([
                    'tenloaidon' => $request->tenloaidon,
                    'mota' => $request->mota,
                    'maloaidon' => $request->maloaidon,
                    'trangthai' => 1
                ]);

            $result = 'successful';
        }catch (Exception $e){

            $result = 'fail';

        }
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
    public static function XoaLoaiDon($id){

        try {
            DB::table('loaidon')
                ->where('loaidonid', $id)
                ->delete();

            $result = 'successful';
        }catch (Exception $e){

            $result = 'fail';

        }
        return $result;
    }

    /**************************************************
    Function Name	: GetLoaiDonTheoID
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLoaiDonTheoID($id){

        $result = DB::table('loaidon')
            ->where('loaidonid',$id)
            ->get();

        return $result;
    }

    /**************************************************
    Function Name	: UpdateLoaiDon
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateLoaiDon($request,$id){

        try {

            DB::table('loaidon')
                ->where('loaidonid',$id)
                ->update([
                    'tenloaidon' => $request->tenloaidon,
                    'mota' => $request->mota,
                    'maloaidon' => $request->maloaidon,
                    'trangthai' => $request->trangthai
                ]);

            $result = 'successful';
        }catch (Exception $e){

            $result = 'fail';

        }
        return $result;
    }

    /**************************************************
    Function Name	: GetTenLoaiDon
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTenLoaiDon($loaidonid){

        $result = DB::table('loaidon')
            ->where('loaidonid',$loaidonid)
            ->value('tenloaidon');

        return $result;
    }
    /**************************************************
    Function Name	: GetLoaiDonId
    Description		:
    Argument		: none
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLoaiDonId()
    {
        $result = DB::table('loaidon')
            ->get();

        return $result;
    }
}
