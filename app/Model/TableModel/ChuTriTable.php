<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;

class ChuTriTable extends Model
{
    /**************************************************
    Function Name	: getChuTri
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getChuTri(){

        $result = DB::table('chutri')
            ->orderby('tenChuTri','asc')
            ->paginate(10);

        return $result;
    }

    /**************************************************
    Function Name	: getChuTriAll
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getChuTriAll(){

        $result = DB::table('chutri')
            ->orderby('tenChuTri','asc')
            ->get();

        return $result;
    }

    /**************************************************
    Function Name	: getChucVuTheoId
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getChucVuTheoId($id){

        $result = DB::table('chutri')
            ->where('id', $id)
            ->value('chucVu');
        return $result;
    }

    /**************************************************
    Function Name	: xoaChuTriTheoId
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function xoaChuTriTheoId($id){

        try
        {
            DB::table('chutri')
                ->where('id', $id)
                ->delete();
            $result = 'successful';

        }catch (Exception $e){

            $result = 'fail';
        }
        return $result;
    }

    /**************************************************
    Function Name	: themChuTri
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function themChuTri($request){

        try {
            DB::table('chutri')
                ->insert([
                    'tenChuTri' => mb_strtoupper($request->tenchutri,'UTF-8'),
                    'chucVu' => $request->chucvu,
                ]);

            $result = 'successful';
        }catch (Exception $e){

            $result = 'fail';
        }

        return $result;
    }

}
