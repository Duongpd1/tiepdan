<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;

class DonViTable extends Model
{
    protected $table = 'donvi';
    /**************************************************
    Function Name	: GetDiaBan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDonVi(){

        $result = DB::table('donvi')
//            ->where('tructhuoc','<>',0)
            ->orderby('tructhuoc','asc')
            ->get();
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
    public static function GetThongTinDonViTheoID($id){

        $result = DB::table('donvi')
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

        $result = DB::table('donvi')
            ->where('tructhuoc',$id)
            ->max('thutu');
        return $result;
    }

    /**************************************************
    Function Name	: StoreDiaBan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreDonVi($request){

        try {
            DB::table('donvi')
                ->insert([
                    'tendonvi' => $request->tendonvi,
                    'tructhuoc' => $request->tructhuoc,
                    'diaban' => $request->diabantructhuoc,
                    'thutu' => $request->thutu,
                    'viettat' => $request->viettat,
                    'nguoidaidien' => $request->nguoidaidien,
                    'diachi' => $request->diachi,
                    'dienthoai' => $request->dienthoai,
                    'fax' => $request->fax,
                    'email' => $request->email,
                    'website' => $request->website,
                    'trangthai' => $request->trangthai,
                    'madonvi' => $request->madonvi
                ]);

            $result = 'successful';
        }catch (Exception $e){

            $result = 'fail';
        }

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
    public static function XoaDonVi($diaViIdAllArray){

        try {
            DB::table('donvi')
                ->whereIn('id', $diaViIdAllArray)
                ->delete();

            $result = 'successful';
        }catch (Exception $e){

            $result = 'fail';
        }
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
    public static function UpdateDonVi($request,$id){

        $result = DB::table('donvi')
            ->where('id', $id)
            ->update([
                'tendonvi' => $request->tendonvi,
                'tructhuoc' => $request->tructhuoc,
                'diaban' => $request->diabantructhuoc,
                'thutu' => $request->thutu,
                'viettat' => $request->viettat,
                'nguoidaidien' => $request->nguoidaidien,
                'diachi' => $request->diachi,
                'dienthoai' => $request->dienthoai,
                'fax' => $request->fax,
                'email' => $request->email,
                'website' => $request->website,
                'trangthai' => $request->trangthai,
                'madonvi' => $request->madonvi
            ]);
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
    public static function GetDonViCon($id){

        $result = DB::table('donvi')
            ->where('tructhuoc',$id)
            ->get();
        return $result;
    }

    /**************************************************
    Function Name	: GetTenDonVi
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTenDonVi($id){

        $result = DB::table('donvi')
            ->where('id',$id)
            ->value('tendonvi');
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
    public static function getDonViTheoDiaBan($diabanid){

        if($diabanid != "")
        {
            $result = DB::table('donvi')
                ->where('diaban',$diabanid)
                ->get();
        }
        else
        {
            $result = DB::table('donvi')
                ->get();
        }

        return $result;
    }

}
