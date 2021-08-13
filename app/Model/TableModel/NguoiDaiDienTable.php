<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NguoiDaiDienTable extends Model
{
    //
    protected $table = 'nguoidaidien';

    /***********************
     * @return mixed
     */
    private function _query()
    {
        $query = DB::table($this->table);

        return $query;
    }

    /**************************************
     * @param $donId
     * @return mixed
     */
    public function getDataNDDfromId($donId)
    {
        $result = $this->_query()
            ->where('donthuid',$donId)
            ->get();

        return $result;
    }
}
