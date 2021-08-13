<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use DB;

class KetQuaGiaiQuyetKNTCTable extends Model
{
    public static function GetKetQuaKNTC(){
        $ketqua = DB::table('ketquagiaiquyetkntc')
            ->get();

        return $ketqua;
    }
}
