<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;

class LichTiepDanTable extends Model
{

    /**************************************************
    Function Name	: GetLichTiepDan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLichTiepDan($diaBanIdAllArray,$soLuongHienThi){

        $nam = date('Y');
        $lichtiep = DB::table('lichtiepdan')
            ->where('ngaytiep', '>=', $nam . '-1-1')
            ->where('ngaytiep', '<=', $nam . '-12-31')
            ->whereIn('diaban', $diaBanIdAllArray)
            ->orderby('ngaytiep','desc')
            ->paginate($soLuongHienThi);
        $result = DB::table('lichtiepdan')
            ->where('ngaytiep', '>=', $nam . '-1-1')
            ->where('ngaytiep', '<=', $nam . '-12-31')
            ->whereIn('diaban', $diaBanIdAllArray)
            ->orderby('ngaytiep','desc')
            ->get();
        $nguoitiep =array();
        $replace =0;
        for($i = 0;$i<count($result);$i++)
        {
           if($nguoitiep != null)
           {
               for($j = 0;$j<count($nguoitiep);$j++)
               {
                   $replace = 0;
                   if($nguoitiep[$j] == $result[$i]->nguoitiep )
                   {
                       $replace = 1;
                       break;
                   }
               }
               if($replace ==0)
               {
                   array_push($nguoitiep,$result[$i]->nguoitiep);
               }
           }
            else
            {
                array_push($nguoitiep,$result[$i]->nguoitiep);
            }
        }

        $array = array(
            'lichtiep'=>$lichtiep,
            'lanhdao'=>$nguoitiep
        );

        return $array;
    }

    /**************************************************
    Function Name	: GetLichTiepDanTheoDiaBanAll
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLichTiepDanTheoDiaBanAll($diaBanIdAllArray){

        $result = DB::table('lichtiepdan')
            ->whereIn('diaban', $diaBanIdAllArray)
            ->orderby('ngaytiep','desc')
            ->get();

        return $result;
    }

    /**************************************************
    Function Name	: StoreLichTiepDan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreLichTiepDan($request,$diaBanId){

        try {

            if($request->dotxuat == 'on'){

                $dotxuat = DOTXUAT;
            }else{

                $dotxuat = KHONGDOTXUAT;
            }

            $nguoiTiep = '';
            if (null != $request->nguoitiep1){
                $nguoiTiep = $request->nguoitiep1;
            }

            if (null != $request->nguoitiep2){
                $nguoiTiep .= ', '.$request->nguoitiep2;
            }

            if (null != $request->nguoitiep3){
                $nguoiTiep .= ', '.$request->nguoitiep3;
            }

            if (null != $request->nguoitiep4){
                $nguoiTiep .= ', '.$request->nguoitiep4;
            }

            if (null != $request->nguoitiep5){
                $nguoiTiep .= ', '.$request->nguoitiep5;
            }

            $chucvu = '';
            if (null != $request->chucvu1){
                $chucvu = $request->chucvu1;
            }

            if (null != $request->chucvu2){
                $chucvu .= ', '.$request->chucvu2;
            }

            if (null != $request->chucvu3){
                $chucvu .= ', '.$request->chucvu3;
            }

            if (null != $request->chucvu4){
                $chucvu .= ', '.$request->chucvu4;
            }

            if (null != $request->chucvu5){
                $chucvu .= ', '.$request->chucvu5;
            }

            DB::table('lichtiepdan')
                ->insert([
                    'nguoitiep' => $nguoiTiep,
                    'chucvu' => $chucvu,
                    'diaban' => $diaBanId,
                    'diadiem' => $request->diadiem,
                    'ngaytiep' => $request->ngaytiep,
                    'dotxuat' => $dotxuat,
                    'nguoicapnhat' => $request->accountname
                ]);

            $result = 'successful';

        } catch (Exception $e){

            $result = 'fail';

        }

        return $result;
    }

    /**************************************************
    Function Name	: XoaLichTiepDan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaLichTiepDan($id){
        try {
            DB::table('lichtiepdan')
                ->where('id', $id)
                ->delete();

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }
        return $result;
    }

    /**************************************************
    Function Name	: GetLichTiepDanTheoID
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLichTiepDanTheoID($id){

        $result = DB::table('lichtiepdan')
            ->where('id',$id)
            ->get();
        return $result;
    }

    /**************************************************
    Function Name	: UpdateVanBan
    Description		:
    Argument		: $id, $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateLichTiepDan($id, $request){

        try {

            if($request->dotxuat == 'on'){

                $dotxuat = DOTXUAT;
            }else{

                $dotxuat = KHONGDOTXUAT;
            }

            $nguoiTiep = '';
            if (null != $request->nguoitiep1){
                $nguoiTiep = $request->nguoitiep1;
            }

            if (null != $request->nguoitiep2){
                $nguoiTiep .= ', '.$request->nguoitiep2;
            }

            if (null != $request->nguoitiep3){
                $nguoiTiep .= ', '.$request->nguoitiep3;
            }

            if (null != $request->nguoitiep4){
                $nguoiTiep .= ', '.$request->nguoitiep4;
            }

            if (null != $request->nguoitiep5){
                $nguoiTiep .= ', '.$request->nguoitiep5;
            }

            $chucvu = '';
            if (null != $request->chucvu1){
                $chucvu = $request->chucvu1;
            }

            if (null != $request->chucvu2){
                $chucvu .= ', '.$request->chucvu2;
            }

            if (null != $request->chucvu3){
                $chucvu .= ', '.$request->chucvu3;
            }

            if (null != $request->chucvu4){
                $chucvu .= ', '.$request->chucvu4;
            }

            if (null != $request->chucvu5){
                $chucvu .= ', '.$request->chucvu5;
            }

            DB::table('lichtiepdan')
                ->where('id', $id)
                ->update([
                    'nguoitiep' => $nguoiTiep,
                    'chucvu' => $chucvu,
                    'diadiem' => $request->diadiem,
                    'ngaytiep' => $request->ngaytiep,
                    'dotxuat' => $dotxuat,
                    'nguoicapnhat' => $request->accountname
                ]);

            $result = 'successful';

        } catch (Exception $e){

            $result = 'fail';

        }

        return $result;
    }

    /**************************************************
    Function Name	: GetLichTiepDanTheoThang
    Description		:
    Argument		: $thang, $nam
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLichTiepDanTheoThang($thang, $nam){

        if($thang == 13) {

            $result = DB::table('lichtiepdan')
                ->orderby('ngaytiep', 'desc')
                ->get();
        }else {

            $result = DB::table('lichtiepdan')
                ->where('ngaytiep', '>=', $nam . '-' . $thang . '-1')
                ->where('ngaytiep', '<=', $nam . '-' . $thang . '-31')
                ->orderby('ngaytiep', 'desc')
                ->get();
        }
        return $result;
    }

    /**************************************************
    Function Name	: GetLichTiepDanTheoNam
    Description		:
    Argument		: $nam
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLichTiepDanTheoNam($nam){

        $result = DB::table('lichtiepdan')
            ->where('ngaytiep', '>=', $nam . '-1-1')
            ->where('ngaytiep', '<=', $nam . '-12-31')
            ->orderby('ngaytiep', 'desc')
            ->get();
        return $result;
    }

    /**************************************************
    Function Name	: GetLichTiepDanTheoLanhDao
    Description		:
    Argument		: $name
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLichTiepDanTheoLanhDao($name,$nam)
    {

        $result = DB::table('lichtiepdan')
            ->where('nguoitiep',$name )
            ->where('ngaytiep', '>=', $nam . '-1-1')
            ->where('ngaytiep', '<=', $nam . '-12-31')
            ->orderby('ngaytiep', 'desc')
            ->get();

        return $result;
    }

    /**************************************************
    Function Name	: GetLichTiepDanThangTheoDiaBan
    Description		:
    Argument		: $name
    Creation Date	: 2017/05/26
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLichTiepDanThangTheoDiaBan($diaBanArray,$thang, $nam)
    {
        if($thang == 13) {

            $result = DB::table('lichtiepdan')
                ->orderby('ngaytiep', 'desc')
                ->whereIn('diaban',$diaBanArray)
                ->get();
        }else {

            $result = DB::table('lichtiepdan')
                ->where('ngaytiep', '>=', $nam . '-' . $thang . '-1')
                ->where('ngaytiep', '<=', $nam . '-' . $thang . '-31')
                ->whereIn('diaban',$diaBanArray)
                ->orderby('ngaytiep', 'desc')
                ->get();
        }
        return $result;
    }


}
