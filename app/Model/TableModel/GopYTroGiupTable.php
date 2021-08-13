<?php

namespace App\Model\TableModel;

use Faker\Provider\ka_GE\DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;

class GopYTroGiupTable extends Model
{
    /**************************************************
    Function Name	: GetGopYCongDan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetGopYCongDan($soLuongHienThi){

        $result = DB::table('gopytrogiup')
            ->where('theloai',GOPYCD)
            ->orderby('ngaygui','desc')
            ->paginate($soLuongHienThi);
        return $result;
    }

    /**************************************************
    Function Name	: StoreGopYTroGiup
    Description		:
    Argument		: $request, $type
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreGopYTroGiup($request,$type){

        try {

            date_default_timezone_set('Asia/Ho_Chi_Minh');

            DB::table('gopytrogiup')
                ->insert([
                    'theloai' => $type,
                    'hoten' => $request->hoten,
                    'cmnd' => $request->cmnd,
                    'diachi' => $request->diachi,
                    'dienthoai' => $request->dienthoai,
                    'email' => $request->email,
                    'tieude' => $request->tieude,
                    'noidung' => $request->noidung,
                    'ngaygui' => date('Y-m-d H:i:s')
                ]);

            $result = 'successful';

        } catch (Exception $e){

            $result = 'fail';

        }

        return $result;
    }

    /**************************************************
    Function Name	: ChangeTrangThaiGopYTroGiup
    Description		:
    Argument		: $id, $newtrangthai
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function ChangeTrangThaiGopYTroGiup($id, $newtrangthai){

        try {
            DB::table('gopytrogiup')
                ->where('id', $id)
                ->update([
                    'trangthai' => $newtrangthai
                ]);

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }

        return $result;
    }

    /**************************************************
    Function Name	: XoaGopYTroGiup
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaGopYTroGiup($id){

        try {

            DB::table('gopytrogiup')
                ->where('id', $id)
                ->delete();

            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }

        return $result;
    }

    /**************************************************
    Function Name	: GetTroGiupPhapLuat
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTroGiupPhapLuat($soLuongHienThi){

        $result = DB::table('gopytrogiup')
            ->where('theloai',TROGIUPPL)
            ->orderby('ngaygui','desc')
            ->paginate($soLuongHienThi);
        return $result;
    }

}
