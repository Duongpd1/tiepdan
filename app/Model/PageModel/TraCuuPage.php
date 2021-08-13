<?php

namespace App\Model\PageModel;

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

class TraCuuPage extends Model
{
    /**************************************************
    Function Name	: GetDataTraCuu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDataTraCuuTheoTatCa($request,$loaidon,$linhvuc)
    {
        $data_tracuu = TraCuuTable::DataTraCuuTheoTatCa($request,$loaidon,$linhvuc);
        return $data_tracuu;

    }
    /**************************************************
    Function Name	: GetAllLoaiDon
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetAllLoaiDon()
    {
        $loaidon = LoaiDonTable::GetLoaiDonId();
        return $loaidon;
    }
    /**************************************************
    Function Name	: GetAllLinhVuc
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetAllLinhVuc()
    {
        $linhvuc = LinhVucTable::GetLinhVucId();
        return $linhvuc;
    }
    /**************************************************
    Function Name	: GetDataTraCuuTheoMot
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDataTraCuuTheoMot($request,$diaBanIdAllArray)
    {
        $result_tracuu = TraCuuTable::DataTraCuuTheoMot($request,$diaBanIdAllArray);

        return $result_tracuu;
    }

    /**************************************************
    Function Name	: GetDataTraCuuTheoFilter
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			:
    Reviewer		:
     ***************************************************/
    public static function GetDataTraCuuTheoFilter($request,$diaBanIdAllArray)
    {
        $result_tracuu = TraCuuTable::DataTraCuuTheoFilter($request,$diaBanIdAllArray);

        return $result_tracuu;
    }
    /**************************************************
    Function Name	: GetTraCuuLichTiepDanAll
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTraCuuLichTiepDanAll($request,$linhvuc)
    {
        $tracuu_tiepdan = TraCuuTable::DataTraCuuLichTiepDanAll($request,$linhvuc);
        return $tracuu_tiepdan;
    }
    /**************************************************
    Function Name	: GetTraCuuLichTiepDanOne
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTraCuuLichTiepDanOne($request,$linhvuc)
    {
        $tiep_dan_one =TraCuuTable::DataTraCuuLichTiepDanOne($request,$linhvuc);
        return $tiep_dan_one;
    }
    /**************************************************
    Function Name	: GetDataDonThuGiongNhau
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDataDonThuGiongNhau($request)
    {
        $data_cmt = $request->value;
        $filed = $request->filed;
        $table = $request->table;
        $donthu = TraCuuTable::LocDonThuGiongNhau($data_cmt,$filed,$table);
        return $donthu;
    }
    /**************************************************
    Function Name	: GetIdDiaBanTheoTen
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetIdDiaBanTheoTen($table,$filed,$nameDB)
    {
        $diaBanId = DiaBanTable::GetDiaBanIDTheoTen($table,$filed,$nameDB);

        return $diaBanId;
    }
}
