<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;


class TongHopTable extends Model
{
    /**************************************************
    Function Name	: DonThuCungNguoiKN
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function DonThuCungNguoiKN($field)
    {

        $data = DB::table('donthu')
            ->groupBy($field)
            ->get();

        $results = array();
        $donthu = array();

        foreach($data as $row)
        {
            $results = DB::table('donthu')
                ->where('cmnd_hc',$row->cmnd_hc)
                ->where('tennguoivietdon','like','%'.$row->tennguoivietdon.'%')
                ->where('noidung','like','%'.$row->noidung.'%')
                ->where('doituongkhieunai','like','%'.$row->doituongkhieunai.'%')
                ->get();

            if(count($results)>= 2)
            {
                $donthu[] = $results;
            }
        }


        return $donthu;
    }
    /**************************************************
    Function Name	: DonThuCungNoiDung
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function DonThuCungNoiDung($field)
    {
        $result = DB::table('donthu')
            ->where($field,'<>','')
            ->groupBy($field)
//            ->paginate(10)
            ->pluck($field);


        $data = array();

        foreach($result as $row)
        {
            $listData = DB::table('donthu')->where($field,$row)->pluck('donthuid');

            if(count($listData) >= 2)
            {
                    $data[] = array(
                        $field => $row,
                        'total' => count($listData),
                        'listData' => $listData
                    );
//                $data[] = $listData;
            }

        }


        return $data;
    }
    /**************************************************
    Function Name	: DonThuCungDoiTuongTC
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function DonThuCungDoiTuongTC($field)
    {
        $result = DB::table('donthu')
            ->where($field,'<>','')
            ->groupBy($field)
//            ->paginate(10)
            ->pluck($field);


        $data = array();

        foreach($result as $row)
        {
            $listData = DB::table('donthu')->where($field,$row)->pluck('donthuid');

            if(count($listData) >= 2)
            {
                    $data[] = array(
                        $field => $row,
                        'total' => count($listData),
                        'listData' => $listData
                    );
//                $data[] = $listData;
            }

        }


        return $data;
    }
    /**************************************************
    Function Name	: ThongTinChuDon
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function ThongTinChuDon($tenChuDon,$cmt)
    {
        $data = DB::table('donthu')
            ->where('tennguoivietdon',$tenChuDon)
            ->where('cmnd_hc',$cmt)
            ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
            ->join('loaidon', 'phanloaidonthu.loaidon', '=', 'loaidon.loaidonid')
            ->select('donthu.*', 'loaidon.tenloaidon')
            ->orderBy('ngaynhan', 'asc')
            ->get();

        $tiepDanData = DB::table('ketquatiepdan')
            ->where('congdan',$tenChuDon)
            ->where('cmt',$cmt)
            ->join('loaidon', 'ketquatiepdan.loaihinh', '=', 'loaidon.loaidonid')
            ->select('ketquatiepdan.*', 'loaidon.tenloaidon')
            ->orderBy('ngaytiep', 'asc')
            ->get();

        $array = array(
            'tenchudon'=>$tenChuDon,
            'donthu'=>$data,
            'tiepdan'=>$tiepDanData
        );
        return $array;
    }
    /**************************************************
    Function Name	: ThongTinDonThu
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function ThongTinDonThu($table,$field)
    {
        $data = DB::table($table)
            ->groupBy($field)
            ->pluck($field);

        return $data;
    }
}
