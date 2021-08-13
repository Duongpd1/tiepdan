<?php

namespace App\Model\TableModel;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Mockery\CountValidator\Exception;

class CauHinhHeThongTable extends Model
{
    /**************************************************
    Function Name	: getCauHinhHeThong
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getCauHinhHeThong(){

        $result = DB::table('cauhinhhethong')
            ->first();

        return $result;
    }

    /**************************************************
    Function Name	: submitChinhSuaCauHinhHeThong
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function submitChinhSuaCauHinhHeThong($request){

        DB::table('cauhinhhethong')
            ->where('id',1)
            ->update([
                'tenmaychucsdl' => $request->tenmaychucsdl,
                'tencsdl' => $request->tencsdl,
                'taikhoancsdl' => $request->taikhoancsdl,
                'matkhaucsdl' => $request->matkhaucsdl,
                'emailcsdl' => $request->emailcsdl,
                'matkhauemail' => $request->matkhauemail,
                'thumucupload' => $request->thumucupload,
                'capdiaban' => $request->capdiaban

            ]);

        $result = 'successful';

        return $result;
    }
}
