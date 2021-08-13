<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;

class LinhVucTable extends Model
{
    /**************************************************
    Function Name	: GetLinhVuc
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLinhVuc(){

        $result = DB::table('linhvuc')
            ->orderby('tenlinhvuc','asc')
            ->paginate(10);

        return $result;
    }

    /**************************************************
    Function Name	: GetTatCaLinhVuc
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTatCaLinhVuc(){

        $result = DB::table('linhvuc')
            ->orderby('tenlinhvuc','asc')
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
    public static function StoreLinhVuc($request){

        try {

            DB::table('linhvuc')
                ->insert([
                    'tenlinhvuc' => $request->tenlinhvuc,
                    'viettat' => $request->viettat,
                    'malinhvuc' => $request->malinhvuc,
                    'trangthai' => 1
                ]);

            $result = 'successful';
        }catch (Exception $e){

            $result = 'fail';

        }
        return $result;
    }

    /**************************************************
    Function Name	: XoaLinhVuc
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function XoaLinhVuc($id){

        try {
            DB::table('linhvuc')
                ->where('linhvucid', $id)
                ->delete();

            $result = 'successful';
        }catch (Exception $e){

            $result = 'fail';

        }
        return $result;
    }

    /**************************************************
    Function Name	: GetLinhVucTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLinhVucTheoID($id){

        $result = DB::table('linhvuc')
            ->where('linhvucid',$id)
            ->get();

        return $result;
    }

    /**************************************************
    Function Name	: UpdateLinhVuc
    Description		:
    Argument		: $request,$id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateLinhVuc($request,$id){

        try {

            DB::table('linhvuc')
                ->where('linhvucid',$id)
                ->update([
                    'tenlinhvuc' => $request->tenlinhvuc,
                    'viettat' => $request->viettat,
                    'malinhvuc' => $request->malinhvuc,
                    'trangthai' => $request->trangthai
                ]);

            $result = 'successful';
        }catch (Exception $e){

            $result = 'fail';

        }
        return $result;
    }

    /**************************************************
    Function Name	: GetTenLinhVuc
    Description		:
    Argument		: $linhvucid
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTenLinhVuc($linhvucid){

        $result = DB::table('linhvuc')
            ->where('linhvucid',$linhvucid)
            ->value('tenlinhvuc');

        return $result;
    }
    /**************************************************
    Function Name	: GetLinhVucId
    Description		:
    Argument		: none
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetLinhVucId()
    {
        $result = DB::table('linhvuc')
            ->get();

        return $result;
    }

}
