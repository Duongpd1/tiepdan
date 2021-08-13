<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;

class DiaBanTable extends Model
{

    /**************************************************
    Function Name	: GetDiaBan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDiaBan(){

        $result = DB::table('diaban')
            ->orderby('tructhuoc','asc')
            ->get();
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
    public static function GetDiaBanTruDauMuc(){

        $result = DB::table('diaban')
            ->where('tructhuoc','<>',0)
            ->orderby('tructhuoc','asc')
            ->get();
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
    public static function GetThongTinDiaBanTheoID($id){

        $result = DB::table('diaban')
            ->where('id',$id)
            ->get();
        return $result;
    }

    /**************************************************
    Function Name	: GetMaxThuTuLv1
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetMaxThuTu($id){

        $result = DB::table('diaban')
            ->where('tructhuoc',$id)
            ->max('thutu');
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
    public static function StoreDiaBan($request){

        try {
            DB::table('diaban')
                ->insert([
                    'tendiaban' => $request->tendiaban,
                    'tructhuoc' => $request->tructhuoc,
                    'thutu' => $request->thutu,
                    'trangthai' => $request->trangthai,
                    'type' => $request->chon_cap,
                    'mahanhchinh'=>$request->mahanhchinh
                ]);

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }
        return $result;
    }

    /**************************************************
    Function Name	: XoaDiaBan
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaDiaBan($diaBanIdAllArray){

        try {
            DB::table('diaban')
                ->whereIn('id', $diaBanIdAllArray)
                ->delete();

            $result = 'successful';
        }catch (Exception $e){

            $result = 'fail';
        }
        return $result;
    }

    /**************************************************
    Function Name	: UpdateDiaBan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateDiaBan($request,$id){


        $result = DB::table('diaban')
            ->where('id', $id)
            ->update([
                'tendiaban' => $request->tendiaban,
                'tructhuoc' => $request->tructhuoc,
                'thutu' => $request->thutu,
                'trangthai' => $request->trangthai,
                'type' => $request->chon_cap,
                'mahanhchinh'=>$request->mahanhchinh
            ]);
        return $result;
    }

    /**************************************************
    Function Name	: GetDiaBanCon
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDiaBanCon($id){

        $result = DB::table('diaban')
            ->where('tructhuoc',$id)
            ->get();
        return $result;
    }

    /**************************************************
    Function Name	: GetTenDiaBan
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTenDiaBan($id){

        $result = DB::table('diaban')
            ->where('id',$id)
            ->value('tendiaban');
        return $result;
    }

    /**************************************************
    Function Name	: GetDiaBanTrucThuoc
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: namnh
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDiaBanTrucThuoc($diabanid){
        $result = array();
        $result[0] = $diabanid;
        $datatemp = $result;
        for($k=0;$k < 3;$k++)
        {
            if($datatemp != "" && count($datatemp)>0)
            {
                $querry = $datatemp;

                $datatemp = DB::table('diaban')
                    ->whereIn ('tructhuoc',$querry)
                    ->pluck('id');
                if($datatemp == "")
                {
                    return $result;
                }

                $result = array_merge($result, $datatemp);
            }

        }
        return $result;
    }
    /**************************************************
    Function Name	: GetDiaBanIDTheoTen
    Description		:
    Argument		: $name
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDiaBanIDTheoTen($table,$filed,$nameDB)
    {
        $tenDB = trim($nameDB);
        $id = DB::table($table)
            ->where($filed,'like','%'.$tenDB.'%')
            ->value('id');

        return $id;
    }
    /**************************************************
    Function Name	: GetTenDiaBanTheoArrayId
    Description		:
    Argument		: $name
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTenDiaBanTheoArrayId($arrayDiaBan)
    {
        $result = DB::table('diaban')
            ->whereIn('id',$arrayDiaBan)
            ->get();

        return $result;
    }
}
