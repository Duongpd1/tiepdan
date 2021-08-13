<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use DB;

class XuLyDonThuKNTCTable extends Model
{
    public static function GetXuLyDonThuKNTC(){
        $ketqua = DB::table('xulydonthukntc')
            ->get();

        return $ketqua;
    }
}
