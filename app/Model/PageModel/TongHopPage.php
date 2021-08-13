<?php

namespace App\Model\PageModel;

use App\Model\TableModel\TongHopTable;
use Illuminate\Database\Eloquent\Model;
use App\Model\TableModel\AccountInfoTable;
use App\Model\TableModel\DiaBanTable;
use App\Model\TableModel\DoiTuongKhieuNaiToCaoTable;
use App\Model\TableModel\DonViTable;
use App\Model\TableModel\GiaoXacMinhTable;
use App\Model\TableModel\KetQuaGiaiQuyetTable;
use App\Model\TableModel\MailboxTable;
use App\Model\TableModel\PhanLoaiDonThuTable;
use App\Model\TableModel\TheoDoiDonThuTable;
use App\Model\TableModel\DonThuTable;
use App\Model\TableModel\BaoCaoTable;
use App\Model\TableModel\TraCuuTable;
use App\Model\TableModel\LoaiDonTable;
use App\Model\TableModel\LinhVucTable;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Request;

class TongHopPage extends Model
{
    /**************************************************
    Function Name	: getDonThuNhieuNoi
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function getDonThuCungNguoiKN($value)
    {
        $field ="";
        if($value == 0)
        {
            $field = 'cmnd_hc';
            $result = TongHopTable::DonThuCungNguoiKN($field);
        }
        elseif($value == 1)
        {
            $field = 'noidung';
            $result = TongHopTable::DonThuCungNoiDung($field);
        }
        else
        {
            $field = 'doituongkhieunai';
            $result = TongHopTable::DonThuCungDoiTuongTC($field);
        }


        return $result;
    }
    /**************************************************
    Function Name	: TongHopThongTinChuDon
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function TongHopThongTinChuDon($request)
    {
        $tenChuDon = $request->tenchudon;
        $cmt = $request->cmt;

        $result = TongHopTable::ThongTinChuDon($tenChuDon,$cmt);

        return $result;

    }
    /**************************************************
    Function Name	: TongHopThongTinDonThu
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function TongHopThongTinDonThu($table,$field)
    {
        $data = TongHopTable::ThongTinDonThu($table,$field);

        return $data;
    }
    /**************************************************
    Function Name	: TongHopTenDiaBanTheoId
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function TongHopTenDiaBanTheoId($arrayDiaBan)
    {
        $result = DiaBanTable::GetTenDiaBanTheoArrayId($arrayDiaBan);

        return $result;
    }

}
