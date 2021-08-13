<?php

namespace App\Model\TableModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Input;
use App\Model\TableModel\PhanLoaiDonThuTable;
use Session;
use App\Model\PageModel\DangNhapPage;

class DonThuTable extends Model
{

    const NGUON_DON_BUU_CHINH = 1;
    const NGUON_DON_CO_QUAN_KHAC = 4;
    const NGUON_DON_EMAIL = 20;
    const NGUON_DON_CONG_TAC_TIEP_DAN = 21;
    const NGUON_DON_KHAC = 23;
    const GT_NAM = 1;
    const GT_NU = 2;

    const CA_NHAN = 1;
    const TAP_THE = 2;

    public static $arrGioiTinh = [
        self::GT_NAM => "Nam",
        self::GT_NU => "Nữ",
    ];
    protected $table = 'donthu';
    public $timestamps = false;

    public static $arrNguonDon = [
        self::NGUON_DON_BUU_CHINH => 'Bưu chính',
        self::NGUON_DON_CO_QUAN_KHAC => 'Cơ quan khác chuyển tới',
        self::NGUON_DON_EMAIL => 'Email',
        self::NGUON_DON_KHAC => 'Khác'
    ];


    /**************************************************
     * Function Name    : getTTDonthu
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function getTTDonthu($diaBanIdAllArray)
    {

        $value = DB::table('donthu')
            ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
            ->whereIn('phanloaidonthu.diaban', $diaBanIdAllArray)
            ->orderBy('create_at', 'desc')
            ->get();
        return $value;
    }

    /**************************************************
     * Function Name    : GetDonThuTrangChu
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function GetDonThuTrangChu()
    {
        $result = DB::table('donthu')
            ->orderBy('ngaynhan', 'desc')
            ->paginate(10);
        return $result;
    }

    /**************************************************
     * Function Name    : getDataSelected
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function getDataSelected($valueSelect)
    {
        $result = DB::table('donthu')
            ->where('trangthaixuly', $valueSelect)
            ->get();
        return $result;
    }

    /**************************************************
     * Function Name    : getPhanLoai
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function getPhanLoai($donthuid)
    {
        $loaidon = null;
        for ($i = 0; $i < count($donthuid); $i++) {
            $loaidon[$i] = DB::table('phanloaidonthu')
                ->where('donthuid', $donthuid[$i]->donthuid)
                //->orderBy('ngaynhan', 'desc')
                ->get();
        }

        return $loaidon;
    }

    /**************************************************
     * Function Name    : getTheoDoi
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function getTheoDoi($donthuid)
    {
        $theodoi = null;
        for ($i = 0; $i < count($donthuid); $i++) {
            $theodoi[$i] = DB::table('theodoidonthu')
                ->where('donthuid', $donthuid[$i]->donthuid)
                ->get();
        }

        return $theodoi;
    }

    /**************************************************
     * Function Name    : getKetQuaGQ
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function getKetQuaGQ($donthuid)
    {
        $ketqua = null;
        for ($i = 0; $i < count($donthuid); $i++) {
            $ketqua[$i] = DB::table('ketquagiaiquyet')
                ->where('donthuid', $donthuid[$i]->donthuid)
                ->get();
        }

        return $ketqua;
    }

    /**************************************************
     * Function Name    : getXacMinh
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function getXacMinh($donthuid)
    {
        $xacminh = null;
        for ($i = 0; $i < count($donthuid); $i++) {
            $xacminh[$i] = DB::table('giaoxacminh')
                ->where('donthuid', $donthuid[$i]->donthuid)
                ->get();
        }

        return $xacminh;
    }

    /**************************************************
     * Function Name    : insertDonThu
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function insertDonThu($sothuly, $ngayviet, $ngaynhan, $nguondon, $cvden, $ngaychuyen, $coquan, $group, $tennguoiviet
        , $lan, $dtkntc, $giaiquyet, $noidung, $file, $datatable, $cmt, $ngaycap, $noicap, $diachi, $filevVanban, $folder_name)
    {
        $id = DB::table('donthu')
            ->insertGetId([
                'sothuly' => $sothuly,
                'ngayviet' => $ngayviet,
                'ngaynhan' => $ngaynhan,
                'nguondon' => $nguondon,
                'socongvanden' => $cvden,
                'ngaychuyendon' => $ngaychuyen,
                'donvi' => $coquan,
                'songuoi' => $group,
                'tennguoivietdon' => $tennguoiviet,
                'lankhieunai' => $lan,
                'doituongkhieunai' => $dtkntc,
                'tochucgiaiquyet' => $giaiquyet,
                'noidung' => $noidung,
                'vanban' => $file,
                'cmnd_hc' => $cmt,
                'ngaycap' => $ngaycap,
                'noicap' => $noicap,
                'diachinguoiviet' => $diachi,
                'trangthaixuly' => '1',
                'vanbanuyquyen' => $filevVanban,
                'filepath' => $folder_name
            ]);

        //nguoi dai dien
        if ($datatable != null || trim($datatable) != "") {
            for ($i = 0; $i < count($datatable); $i++) {
                $data[$i] = explode('-', $datatable[$i]);
            }

            for ($j = 0; $j < count($data); $j++) {
                DB::table('nguoidaidien')
                    ->insert([
                        'sothuly' => $sothuly,
                        'tennguoidaidien' => $data[$j][0],
                        'diachinguoidaidien' => $data[$j][1],
                        'nguoidaidien' => $data[$j][2]
                    ]);
            }

        }


        //phan loai
        DB::table('phanloaidonthu')
            ->insert([
                'sothuly' => $sothuly
            ]);
        //theo doi don thu
        DB::table('theodoidonthu')
            ->insert([
                'sothuly' => $sothuly
            ]);
        //giao xac minh
        DB::table('giaoxacminh')
            ->insert([
                'sothuly' => $sothuly
            ]);
        //ket qua giai quyet
        DB::table('ketquagiaiquyet')
            ->insert([
                'sothuly' => $sothuly
            ]);
        //thong tin rut don
        DB::table('thongtinrutdonthu')
            ->insert([
                'sothuly' => $sothuly
            ]);

        return $sothuly;
    }

    /**************************************************
     * Function Name    : StoreDonThu
     * Description        :
     * Argument        : $request
     * Creation Date    : 2016/08/01
     * Author            : KhanhTH
     * Reviewer        : PhucHM
     ***************************************************/
    public static function StoreDonThu($request, $lanhDaoID, $diabanId, $accountId, $donVi)
    {

        $year = date("Y");

        $ngayviet = DonThuTable::ConvertFormatDate($request->ngayviet);

        $ngaynhan = DonThuTable::ConvertFormatDate($request->ngaynhan);

        $ngaycap = DonThuTable::ConvertFormatDate($request->ngaycap);


        $nguondon = $request->nguondon;
        $songuoi = $request->group;
        $tennguoiviet = mb_strtoupper($request->tennguoiviet, 'UTF-8');
        $cmt = $request->cmt;
        $sdt = $request->sdt;


        $noicap = $request->noicap;
        $diachi = $request->diachi;
        $noidung = trim($request->noidungdon);
        $doituongkntc = mb_strtoupper($request->doituong, 'UTF-8');

        //loai cv

        //co quan chuyen den
        $soCVBanHanh = $request->soCVBH;
        $ngayBanHanh = DonThuTable::ConvertFormatDate($request->ngaychuyen);
        $tenCQBanHanh = $request->coquan;

        //loai don
        $loaiDon = $request->loaidon;

        //han xu ly
        $hanXuLy = $request->hanXuLy;

        //nguoi co quyen loi va nghia vu lien quan
        $nguoiLienQuan = $request->nguoiLienQuan;


        $donthuid = DB::table('donthu')
            ->insertGetId([
//                'sothuly'=>$sothuly_new,
                'ngayviet' => $ngayviet,
                'ngaynhan' => $ngaynhan,
                'nguondon' => $nguondon,
                'songuoi' => $songuoi,
                'tennguoivietdon' => $tennguoiviet,
                'cmnd_hc' => $cmt,
                'sdt' => $sdt,
                'gioitinh' => $request->gioitinh,
                'ngaycap' => $ngaycap,
                'noicap' => $noicap,
                'diachinguoiviet' => $diachi,
                'doituongkhieunai' => $doituongkntc,
                'noidung' => $noidung,
                'trangthaixuly' => CHOXULY,
                'nguoinhap' => $accountId,
                'socongvanden' => $soCVBanHanh,
                'ngaychuyendon' => $ngayBanHanh,
                'coquanbanhanh' => $tenCQBanHanh,
                'thoihanxuly' => $hanXuLy,
                'nguoiLienQuan' => $nguoiLienQuan,
                'songuoilienquan' => (!empty($request->soNguoiThamGia)) ? intval($request->soNguoiThamGia) : 0
            ]);
        //insert so thu ly

        $array_sothuly = [$donthuid, $year];
        $sothuly_new = implode("/", $array_sothuly);

        DB::table('donthu')
            ->where('donthuid', $donthuid)
            ->update(['sothuly' => $sothuly_new]);


        //phan loai


        DB::table('phanloaidonthu')
            ->insert([
                'donthuid' => $donthuid,
                'sothuly' => $sothuly_new,
                'nguoixuly' => $request->chuyenCanBo,
                'diaban' => $diabanId,
                'loaidon' => $loaiDon,
                'donvi' => $donVi
            ]);

        if ($accountId != $request->chuyenCanBo) {
            DB::table('lichsugiaoxuly')
                ->insert([
                    'donthuid' => $donthuid,
                    'nguoiGiaoXuLy' => $accountId,
                    'nguoiXuLy' => $request->chuyenCanBo,
                    'don_vi_nhan' => $donVi
                ]);
        }


        //theo doi don thu
        DB::table('theodoidonthu')
            ->insert([
                'donthuid' => $donthuid,
                'sothuly' => $sothuly_new
            ]);
        //giao xac minh
        DB::table('giaoxacminh')
            ->insert([
                'donthuid' => $donthuid,
                'sothuly' => $sothuly_new
            ]);
        //ket qua giai quyet
        DB::table('ketquagiaiquyet')
            ->insert([
                'donthuid' => $donthuid,
                'sothuly' => $sothuly_new
            ]);
        //thong tin rut don
        DB::table('thongtinrutdonthu')
            ->insert([
                'donthuid' => $donthuid,
                'sothuly' => $sothuly_new
            ]);

        return $donthuid;
    }

    /**************************************************
     * Function Name    : updateDonThu
     * Description        :
     * Argument        : $request
     * Creation Date    : 2016/08/01
     * Author            : KhanhTH
     * Reviewer        : PhucHM
     ***************************************************/
    public static function updateChinhSuaDonThu($request)
    {
        try {
            $donthuid = $request->donthuid;
            $sothuly = $request->sothuly;
            $ngayviet = DonThuTable::ConvertFormatDate($request->ngayviet);

            $ngaynhan = DonThuTable::ConvertFormatDate($request->ngaynhan);
            $nguondon = $request->nguondon;
            $songuoi = $request->group;
            $tennguoiviet = mb_strtoupper($request->tennguoiviet, 'UTF-8');
            $cmt = $request->cmt;
            $ngaycap = DonThuTable::ConvertFormatDate($request->ngaycap);
            $noicap = $request->noicap;
            $diachi = $request->diachi;
            $noidung = trim($request->noidungdon);
            $doituongkntc = mb_strtoupper($request->doituong, 'UTF-8');
            $soDT = $request->sdt;
            $trangThaiXL = $request->trangthaixuly;

            $accountId = $request->accountid;
            $nguoiXL = $request->nguoixuly;
            $yKienCV = $request->yKienCD;
            $huongGiaiQuyet = $request->huonggiaiquyet;
            $hanXuLy = $request->hanXuLy;

            $idDonCha = $request->luuDonChaValue;


            //loai don
            $loaiDon = $request->loaidon;

            //nguoi co quyen loi nghia vu lien quan
            $nguoiLienQuan = $request->nguoiLienQuan;


            DB::table('donthu')
                ->where('donthuid', $donthuid)
                ->where('sothuly', $sothuly)
                ->update([
                    'ngayviet' => $ngayviet,
                    'ngaynhan' => $ngaynhan,
                    'nguondon' => $nguondon,
                    'songuoi' => $songuoi,
                    'tennguoivietdon' => $tennguoiviet,
                    'cmnd_hc' => $cmt,
                    'ngaycap' => $ngaycap,
                    'noicap' => $noicap,
                    'diachinguoiviet' => $diachi,
                    'doituongkhieunai' => $doituongkntc,
                    'noidung' => $noidung,
                    'donthulanmotid' => $idDonCha,
                    'sdt' => $soDT,
                    'gioitinh' => $request->gioitinh,
                    'trangthaixuly' => $trangThaiXL,
                    'thoihanxuly' => $hanXuLy,
                    'nguoiLienQuan' => $nguoiLienQuan,
                    'songuoilienquan' => (!empty($request->soNguoiThamGia)) ? intval($request->soNguoiThamGia) : 0

                ]);

            if ($accountId != $nguoiXL) {
                DB::table('lichsugiaoxuly')
                    ->insert([
                        'donthuid' => $donthuid,
                        'nguoiGiaoXuLy' => $accountId,
                        'nguoiXuLy' => $nguoiXL,
                        'noi_dung_chuyen_tiep' => $yKienCV
                    ]);
                $status = DB::table('donthu')->where('donthuid', $donthuid)->value('trangthaixuly');
                if ($status < DANGXULY) {
                    DB::table('donthu')
                        ->where('donthuid', $donthuid)
                        ->update([
                            'trangthaixuly' => DANGXULY
                        ]);
                }
            }


            if ($yKienCV != "") {
                DB::table('quanlyvanban')
                    ->insert([
                        'donthuid' => $donthuid,
                        'account' => $accountId,
                        'ykienCV' => $yKienCV,
                        'type' => COMMENT,
                    ]);
            }


            DB::table('phanloaidonthu')
                ->where('donthuid', $donthuid)
                ->update([
                    'huonggiaiquyet' => $huongGiaiQuyet,
                    'nguoixuly' => $nguoiXL,
                    'loaidon' => $loaiDon

                ]);

            $result = 'successful';
        } catch (Exception $e) {

            $result = 'fail';
        }

        return $result;
    }

    /**************************************************
     * Function Name    : UpdateNguonDon
     * Description        :
     * Argument        : $id, $request
     * Creation Date    : 2016/08/01
     * Author            : KhanhTH
     * Reviewer        : PhucHM
     ***************************************************/
    public static function UpdateNguonDon($id, $request)
    {
        DB::table('donthu')
            ->where('donthuid', $id)
            ->update([
                'socongvanden' => $request->cvden,
                'ngaychuyendon' => DonThuTable::ConvertFormatDate($request->ngaychuyen),
                'coquanbanhanh' => $request->coquan,
            ]);
    }

    /**************************************************
     * Function Name    : UpdateDonNhieuNguoi
     * Description        :
     * Argument        : $id, $request
     * Creation Date    : 2016/08/01
     * Author            : KhanhTH
     * Reviewer        : PhucHM
     ***************************************************/
    public static function UpdateDonNhieuNguoi($id, $request)
    {

        $sothuly = DB::table('donthu')
            ->where('donthuid', $id)
            ->value('sothuly');

        //nguoi dai dien
        $idSave = $request->tableSave;

        if ($idSave != null) {
            $arrayIdSave = explode('.', $idSave);

            $arrayIdSaveData = array();
            foreach ($arrayIdSave as $row) {
                $arrayIdSaveData[] = (int)$row;
            }

            DB::table('nguoidaidien')
                ->where('donthuid', $id)
                ->whereIn('id', $arrayIdSaveData)
                ->update(['enable' => ENABLE]);
        } else {
            $checkDD = DonThuTable::CheckNguoiDaiDien($id, $request->idNguoiDaiDien);

            if ($checkDD == false) {
                DB::table('nguoidaidien')
                    ->insert([
                        'donthuid' => $id,
                        'sothuly' => $sothuly,
                        'tennguoidaidien' => mb_strtoupper($request->tennguoiviet, 'UTF-8'),
                        'diachinguoidaidien' => $request->diachi,
                        'cmt' => $request->cmt,
                        'ngaycap' => $request->ngaycap,
                        'noicap' => $request->noicap,
                        'sdt' => $request->sdt,
                        'nguoidaidien' => "x",
                        'enable' => ENABLE
                    ]);
            } else {
                DB::table('nguoidaidien')
                    ->where('id', $request->idNguoiDaiDien)
                    ->update([
                        'donthuid' => $id,
                        'sothuly' => $sothuly,
                        'tennguoidaidien' => mb_strtoupper($request->tennguoiviet, 'UTF-8'),
                        'diachinguoidaidien' => $request->diachi,
                        'cmt' => $request->cmt,
                        'ngaycap' => $request->ngaycap,
                        'noicap' => $request->noicap,
                        'sdt' => $request->sdt,
                        'nguoidaidien' => "x",
                        'enable' => ENABLE
                    ]);
            }


        }


        //delete
        $idDelete = $request->tableDelete;
        if ($idDelete != null) {
            $arrayIdDelete = explode('.', $idDelete);

            DB::table('nguoidaidien')
                ->where('donthuid', $id)
                ->whereIn('id', $arrayIdDelete)
                ->delete();
        }
        //delete where filed enable = UNENABLE
        DB::table('nguoidaidien')
            ->where('donthuid', $id)
            ->where('enable', UNENABLE)
            ->delete();

        //save change edit
        $valueChange = $request->nguoiDaiDienSave;
        if ($valueChange != null) {
            $valueChange = explode('.', $valueChange);

            $idChange = $valueChange[0];
            $nguoiDD = $valueChange[1];

            DB::table('nguoidaidien')
                ->where('id', $idChange)
                ->where('donthuid', $id)
                ->update([
                    'nguoidaidien' => $nguoiDD,
                    'tennguoidaidien' => mb_strtoupper($request->tennguoiviet, 'UTF-8'),
                    'diachinguoidaidien' => $request->diachi,
                    'cmt' => $request->cmt,
                    'ngaycap' => $request->ngaycap,
                    'noicap' => $request->noicap,
                    'sdt' => $request->sdt
                ]);
        }

        //create direction
        $input = Input::all();
        if ($sothuly != null) {
            $name = explode('/', $sothuly);
            $folder_name = "donthu_" . $name[0] . "_" . $name[1];
        } else {
            $folder_name = "donthu_";
        }

        $file_path = FOLDERROOT . "/file/" . $folder_name;
        $linkfile = '/file' . '/' . $folder_name;

        if ($request->vbuyquyen != null) {
            $vbuyquyen = array_get($input, 'vbuyquyen');
            $filevanbanuyquyen = $vbuyquyen->getClientOriginalName();
            $vbuyquyen->move($file_path, $filevanbanuyquyen);

            DB::table('donthu')
                ->where('donthuid', $id)
                ->update([
                    'vanbanuyquyen' => $filevanbanuyquyen,
                    'filepath' => $linkfile,
                ]);
        }
    }

    /**************************************************
     * Function Name    : UpdateSoLan
     * Description        :
     * Argument        : $id, $request
     * Creation Date    : 2016/08/01
     * Author            : KhanhTH
     * Reviewer        : PhucHM
     ***************************************************/
    public static function UpdateSoLan($id, $request)
    {
        DB::table('donthu')
            ->where('donthuid', $id)
            ->update([
                'donthulanmotid' => $request->ctl00_hidIdDT,
            ]);
    }

    /**************************************************
     * Function Name    : UpdateVanBanDinhKem
     * Description        :
     * Argument        : $id, $request
     * Creation Date    : 2016/08/01
     * Author            : KhanhTH
     * Reviewer        : PhucHM
     ***************************************************/
    public static function UpdateVanBanDinhKem($id, $request, $accountId)
    {
        $sothuly = DB::table('donthu')
            ->where('donthuid', $id)
            ->value('sothuly');

        $file_value = null;
        $file_name = ['file1', 'file2', 'file3', 'file4', 'file5'];

        //create direction
        $input = Input::all();
        if ($sothuly != null) {
            $name = explode('/', $sothuly);
            $folder_name = "donthu_" . $name[0] . "_" . $name[1];
        } else {
            $folder_name = "donthu_";
        }

        $file_path = FOLDERROOT . "/file/" . $folder_name;
        $linkfile = '/file' . '/' . $folder_name;

        for ($i = 0; $i < count($file_name); $i++) {
            //create direction
            $filevanban = array_get($input, $file_name[$i]);
            if ($filevanban != null) {
                // RENAME THE UPLOAD WITH RANDOM NUMBER
                $filevanbandinhkem = $filevanban->getClientOriginalName();
                // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
                $filevanban->move($file_path, $filevanbandinhkem);
                $file_value[$i] = $filevanbandinhkem;
            } else {
                $file_value[$i] = "";
            }
        }
        //noi mang
        $array_file = implode("*", $file_value);


        DB::table('donthu')
            ->where('donthuid', $id)
            ->update([
                'vanban' => $array_file,
                'filepath' => $linkfile,
            ]);

        foreach ($file_value as $file) {
            if ($file != "") {
                DB::table('quanlyvanban')
                    ->insert([
                        'donthuid' => $id,
                        'tenvanban' => $file,
                        'linkfile' => $linkfile,
                        'type' => INSERTFILE,
                        'account' => $accountId,
                        'trangthai' => DANGTHEODOI
                    ]);
            }

        }

    }

    /**************************************************
     * Function Name    : GetDonThuTheoID
     * Description        :
     * Argument        : $id
     * Creation Date    : 2016/08/01
     * Author            : KhanhTH
     * Reviewer        : PhucHM
     ***************************************************/
    public static function GetDonThuTheoID($id)
    {
        $noidung = DB::table('donthu')
            ->where('donthuid', $id)
            ->get();
        $phanloai = DB::table('phanloaidonthu')
            ->where('donthuid', $id)
            ->get();
        $theodoi = DB::table('theodoidonthu')
            ->where('donthuid', $id)
            ->get();
        $ketqua = DB::table('ketquagiaiquyet')
            ->where('donthuid', $id)
            ->get();
        $xacminh = DB::table('giaoxacminh')
            ->where('donthuid', $id)
            ->get();
        $ketthuc = DB::table('thongtinrutdonthu')
            ->where('donthuid', $id)
            ->get();
        $dataResult = array(
            'noidung' => $noidung,
            'phanloai' => $phanloai,
            'theodoi' => $theodoi,
            'ketqua' => $ketqua,
            'xacminh' => $xacminh,
            'ketthuc' => $ketthuc
        );
        return $dataResult;
    }

    /**************************************************
     * Function Name    : getDataSearch
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function getDataSearch($searchValue)
    {
        $result = DB::table('donthu')
            ->where('tennguoivietdon', 'REGEXP', $searchValue)
            ->get();
        return $result;

    }

    /**************************************************
     * Function Name    : getSoThuLyDonThu
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function getSoThuLyDonThu()
    {
        $result = DB::table('donthu')
            ->orderBy('donthuid', 'desc')
            ->first();
        return $result;
    }

    /**************************************************
     * Function Name    : insertDonThuXacMinh
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function insertDonThuXacMinh($sothuly, $ngaybatdau, $ngayketthuc, $donvi,
                                               $noidung, $filexacminh, $linkfile, $ngaynhan,
                                               $tennguoiviet, $diachi, $chungminhthunhandan, $ngaycap, $noicap, $lankhieunai, $group)
    {
        $check = DonThuTable::checkDonThu('giaoxacminh', $sothuly);
        $result = null;
        $donthuid = null;
        if ($check == true) {
            $result = DB::table('giaoxacminh')
                ->where('sothuly', $sothuly)
                ->update(['ngaybatdau' => $ngaybatdau,
                    'ngayketthuc' => $ngayketthuc,
                    'donvi' => $donvi,
                    'noidung' => $noidung,
                    'filexacminh' => $filexacminh,
                    'linkfile' => $linkfile]);

            DB::table('donthu')
                ->where('sothuly', $sothuly)
                ->update(['trangthaixuly' => DANGGIAIQUYET]);

            $donthuid = DB::table('donthu')
                ->where('sothuly', $sothuly)
                ->value('donthuid');

        } else {
            $donthuid = DB::table('donthu')
                ->insertGetId([
                    'sothuly' => $sothuly,
                    'ngaynhan' => $ngaynhan,
                    'songuoi' => $group,
                    'tennguoivietdon' => $tennguoiviet,
                    'diachinguoiviet' => $diachi,
                    'cmnd_hc' => $chungminhthunhandan,
                    'ngaycap' => $ngaycap,
                    'noicap' => $noicap,
                    'lankhieunai' => $lankhieunai,
                    'noidung' => $noidung,
                    'vanban' => $filexacminh,
                    'filepath' => $linkfile,
                    'trangthaixuly' => DANGGIAIQUYET
                ]);

            $result = DB::table('giaoxacminh')
                ->insert([
                    'donthuid' => $donthuid,
                    'sothuly' => $sothuly,
                    'ngaybatdau' => $ngaybatdau,
                    'ngayketthuc' => $ngayketthuc,
                    'donvi' => $donvi,
                    'noidung' => $noidung,
                    'filexacminh' => $filexacminh,
                    'linkfile' => $linkfile,
                    'trangthaitheodoi' => DATHEODOI
                ]);

            //phan loai
            DB::table('phanloaidonthu')
                ->insert([
                    'donthuid' => $donthuid,
                    'sothuly' => $sothuly
                ]);
            //theo doi don thu
            DB::table('theodoidonthu')
                ->insert([
                    'donthuid' => $donthuid,
                    'sothuly' => $sothuly
                ]);
            //ket qua giai quyet
            DB::table('ketquagiaiquyet')
                ->insert([
                    'donthuid' => $donthuid,
                    'sothuly' => $sothuly
                ]);
            //thong tin rut don
            DB::table('thongtinrutdonthu')
                ->insert([
                    'donthuid' => $donthuid,
                    'sothuly' => $sothuly
                ]);

        }


        return $donthuid;
    }

    /**************************************************
     * Function Name    : insertPhanLoaiDonThu
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function insertPhanLoaiDonThu($sothuly, $loaidon, $linhvuc, $diaban, $donthuid)
    {
        $check = DonThuTable::checkDonThu('phanloaidonthu', $sothuly);
        $result = null;
        if ($check == true) {
            $result = DB::table('phanloaidonthu')
                ->where('sothuly', $sothuly)
                ->where('donthuid', $donthuid)
                ->update(['loaidon' => $loaidon,
                    'linhvuc' => $linhvuc,
                    'diaban' => $diaban,
                    'trangthai' => DAPHANLOAI
                ]);
        } else {
            $result = DB::table('phanloaidonthu')
                ->insert([
                    'donthuid' => $donthuid,
                    'sothuly' => $sothuly,
                    'loaidon' => $loaidon,
                    'linhvuc' => $linhvuc,
                    'diaban' => $diaban,
                    'trangthai' => DAPHANLOAI
                ]);
        }
        return $result;
    }

    /**************************************************
     * Function Name    : checkDonThu
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function checkDonThu($table, $sothuly)
    {
        $result = DB::table($table)
            ->where('sothuly', $sothuly)
            ->count();

        if ($result == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**************************************************
     * Function Name    : updateDonThu
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function updateDonThu($sothuly, $tennguoivietdon,
                                        $diachinguoivietdon, $cmnd_hc,
                                        $ngaycap, $noicap, $lankhieunai,
                                        $noidung, $songuoi, $donthuid)
    {
        $result = DB::table('donthu')
            ->where('sothuly', $sothuly)
            ->where('donthuid', $donthuid)
            ->update(['tennguoivietdon' => $tennguoivietdon,
                'diachinguoiviet' => $diachinguoivietdon,
                'cmnd_hc' => $cmnd_hc,
                'ngaycap' => $ngaycap,
                'noicap' => $noicap,
                'lankhieunai' => $lankhieunai,
                'noidung' => $noidung,
                'trangthaixuly' => '3',
                'songuoi' => $songuoi]);
        return $sothuly;
    }

    /**************************************************
     * Function Name    : getDataChinhSua
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function getDataChinhSua($donthuid)
    {
        $donthu = DB::table('donthu')
            ->where('donthuid', $donthuid)
            ->get();
        return $donthu;
    }

    /**************************************************
     * Function Name    : saveDonThu
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function saveDonThu($sothuly, $ngayviet, $ngaynhan, $nguondon, $cvden, $ngaychuyen, $coquan, $group, $tennguoiviet
        , $lan, $dtkntc, $giaiquyet, $noidung, $file, $datatable, $cmt, $ngaycap, $noicap, $diachi, $filevVanban, $folder_name)
    {
        DB::table('donthu')
            ->where('sothuly', $sothuly)
            ->update(['ngayviet' => $ngayviet, 'ngaynhan' => $ngaynhan, 'nguondon' => $nguondon,
                'socongvanden' => $cvden, 'ngaychuyendon' => $ngaychuyen, 'donvi' => $coquan, 'songuoi' => $group,
                'tennguoivietdon' => $tennguoiviet, 'lankhieunai' => $lan, 'doituongkhieunai' => $dtkntc,
                'tochucgiaiquyet' => $giaiquyet, 'noidung' => $noidung, 'vanban' => $file, 'cmnd_hc' => $cmt,
                'ngaycap' => $ngaycap, 'noicap' => $noicap, 'diachinguoiviet' => $diachi, 'trangthaixuly' => '1', 'vanbanuyquyen' => $filevVanban,
                'filepath' => $folder_name]);

        //nguoi dai dien

        if ($datatable != null || $datatable != "") {
            for ($i = 0; $i < count($datatable); $i++) {
                $data[$i] = explode('-', $datatable[$i]);
            }

            for ($j = 0; $j < count($data); $j++) {
                DB::table('nguoidaidien')
                    ->where('sothuly', $sothuly)
                    ->update([
                            'tennguoidaidien' => $data[$j][0],
                            'diachinguoidaidien' => $data[$j][1],
                            'nguoidaidien' => $data[$j][2]]
                    );
            }

        }
        return $sothuly;
    }

    /**************************************************
     * Function Name    : getdatadonthu
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function getdatadonthu($table, $thuoctinh, $value, $diabanarray)
    {
        $tatca = 0;
        $size = count($diabanarray);
//        $sothuly = array();
//        $countsothuly = 0;
//        for($i = 0; $i < $size; $i++)
//        {
        $donthuarray = PhanLoaiDonThuTable::getSoThuLyDonThu($diabanarray);
//            if($sothulytemp != "" && count($sothulytemp)>0) {
//                for ($y = 0; $y < count($sothulytemp); $y++) {
//                    $sothuly[$countsothuly] = array('sothuly' => $sothulytemp[$y]);
//                    $countsothuly++;
//                }
//            }
//        }
//        return $thuoctinh;
        if ($value == $tatca) {
            $result = DB::table($table)
//                ->where($thuoctinh, $value)
                ->whereIn('donthuid', $donthuarray)
                ->orderBy('ngaynhan', 'desc')
                ->get();
        } else {
            $result = DB::table($table)
                ->where($thuoctinh, $value)
                ->whereIn('donthuid', $donthuarray)
                ->orderBy('ngaynhan', 'desc')
                ->get();
        }
        return $result;
    }

    /**************************************************
     * Function Name    : getDataChiTiet
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function getDataChiTiet($donthuid)
    {

        $noidung = DB::table('donthu')
            ->where('donthuid', $donthuid)
            ->get();
        $phanloai = DB::table('phanloaidonthu')
            ->where('donthuid', $donthuid)
            ->get();
        $theodoi = DB::table('theodoidonthu')
            ->where('donthuid', $donthuid)
            ->get();
        $ketqua = DB::table('ketquagiaiquyet')
            ->where('donthuid', $donthuid)
            ->get();
        $xacminh = DB::table('giaoxacminh')
            ->where('donthuid', $donthuid)
            ->get();

        $ketthuc = DB::table('thongtinrutdonthu')
            ->where('donthuid', $donthuid)
            ->get();

        $nguoidaidien = DB::table('nguoidaidien')
            ->where('donthuid', $donthuid)
            ->where('enable', ENABLE)
            ->get();

        $checkNguoDaidien = DB::table('nguoidaidien')
            ->where('donthuid', $donthuid)
            ->where('enable', ENABLE)
            ->where('nguoidaidien', 'like', '%x%')
            ->get();
        $checkDaiDien = DB::table('nguoidaidien')
            ->where('donthuid', $donthuid)
            ->get();
        $dataResult = array(
            'noidung' => $noidung,
            'phanloai' => $phanloai,
            'theodoi' => $theodoi,
            'ketqua' => $ketqua,
            'xacminh' => $xacminh,
            'ketthuc' => $ketthuc,
            'nguoidaidien' => $nguoidaidien,
            'checkDD' => count($checkNguoDaidien),
            'checkDaiDien' => count($checkDaiDien)

        );
        return $dataResult;
    }

    /**************************************************
     * Function Name    : InsertDoanXacMinh
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function InsertDoanXacMinh($sothuly, $truongdoan, $phodoan,
                                             $tvXacMinh, $fileQDTLDXM,
                                             $fileBienBanGapGoDoiThoai, $fileDSTLDoNguoiKNCungCap, $linkfile)
    {
        $check = DonThuTable::checkDonThu('doanxacminh', $sothuly);
        $result = null;
        if ($check == true) {
            $result = DB::table('doanxacminh')
                ->where('sothuly', $sothuly)
                ->update(['tentruongdoan' => $truongdoan,
                    'tenphodoan' => $phodoan,
                    'tenthanhvien' => $tvXacMinh,
                    'filethanhlap' => $fileQDTLDXM,
                    'filebienbangapgo' => $fileBienBanGapGoDoiThoai,
                    'danhsachtailieu' => $fileDSTLDoNguoiKNCungCap,
                    'linkfile' => $linkfile
                ]);
        } else {
            $result = DB::table('doanxacminh')
                ->insert([
                    'sothuly' => $sothuly,
                    'tentruongdoan' => $truongdoan,
                    'tenphodoan' => $phodoan,
                    'tenthanhvien' => $tvXacMinh,
                    'filethanhlap' => $fileQDTLDXM,
                    'filebienbangapgo' => $fileBienBanGapGoDoiThoai,
                    'danhsachtailieu' => $fileDSTLDoNguoiKNCungCap,
                    'linkfile' => $linkfile
                ]);
        }
        return $result;
    }

    /**************************************************
     * Function Name    : UpdateGiaoXacMinh
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function UpdateGiaoXacMinh($sothuly, $ketqua, $fileBaoCaoKQXacMinh,
                                             $txtKetQuaXM, $txtKetLuanXM, $txtKienNghiBHQDGQ, $date, $linkfile)
    {
        $result = DB::table('giaoxacminh')
            ->where('sothuly', $sothuly)
            ->update(['trangthai' => $ketqua,
                'ketquaxacminh' => $txtKetQuaXM,
                'ketluanxacminh' => $txtKetLuanXM,
                'kiennghi' => $txtKienNghiBHQDGQ,
                'fileketquaxacminh' => $fileBaoCaoKQXacMinh,
                'ngayketthucxacminh' => $date,
                'linkfile' => $linkfile
            ]);
        return $result;
    }

    /**************************************************
     * Function Name    : GetKetQuaKNTC
     * Description        :
     * Argument        : None
     * Creation Date    : 2016/08/01
     * Author            : KhanhTH
     * Reviewer        : PhucHM
     ***************************************************/
    public static function GetKetQuaKNTC()
    {
        $result = DB::table('donthu')
            ->where('trangthaixuly', DAGIAIQUYET)
            ->orderby('ngayviet', 'desc')
            ->paginate(10);
        return $result;
    }

    /**************************************************
     * Function Name    : GetDonThu
     * Description        :
     * Argument        : None
     * Creation Date    : 2016/08/01
     * Author            : KhanhTH
     * Reviewer        : PhucHM
     ***************************************************/
    public static function GetDonThu($type)
    {
        $result = DB::table('donthu')
            ->whereIn('trangthaixuly', $type)
            ->orderby('ngayviet', 'desc')
            ->paginate(5);
        return $result;
    }

    /**************************************************
     * Function Name    : savePhanLoaiDonThu
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function savePhanLoaiDonThu($sothuly, $loaidon, $linhvuc, $diaban, $huonggiaiquyet, $chuyendi, $donvichuyendon, $dexuatphieutrinh,
                                              $nguoixuly, $filePhieuHD, $fileCVChuyenDon, $fileTBChuyenDon, $fileYeuCauXL, $filePath, $linkfile)
    {
        DB::table('phanloaidonthu')
            ->where('sothuly', $sothuly)
            ->update(['loaidon' => $loaidon,
                'linhvuc' => $linhvuc,
                'diaban' => $diaban,
                'huonggiaiquyet' => $huonggiaiquyet,
                'socongvanchuyendi' => $chuyendi,
                'donvichuyenden' => $donvichuyendon,
                'dexuat' => $dexuatphieutrinh,
                'nguoixuly' => $nguoixuly,
                'vbyeucauxuly' => $fileYeuCauXL,
                'filehuongdan' => $filePhieuHD,
                'congvanchuyendon' => $fileCVChuyenDon,
                'tbchuyendon' => $fileTBChuyenDon,
                'linkfile' => $linkfile
            ]);

        DB::table('donthu')
            ->where('sothuly', $sothuly)
            ->update(['trangthaixuly' => "2"]);


//        DB::table('donthu')
//            ->where('sothuly',$sothuly)
//            ->update(['filepath'=>$filePath]);

        return $sothuly;
    }

    /**************************************************
     * Function Name    : updatePhanLoaiDonThu
     * Description        :
     * Argument        : $request
     * Creation Date    : 2016/08/01
     * Author            : KhanhTH
     * Reviewer        : PhucHM
     ***************************************************/
    public static function updatePhanLoaiDonThu($request)
    {
        try {
            $donthuid = $request->donthuid;
            $loaidon = $request->loaidon;
            $linhvuc = $request->linhvuc;
            $diaban = $request->diaban;
            $huonggiaiquyet = $request->huonggiaiquyet;
            $dexuatphieutrinh = $request->dexuatphieutrinh;
            $nguoixuly = $request->nguoixuly;

            DB::table('phanloaidonthu')
                ->where('donthuid', $donthuid)
                ->update([
                    'loaidon' => $loaidon,
                    'linhvuc' => $linhvuc,
                    'diaban' => $diaban,
                    'huonggiaiquyet' => $huonggiaiquyet,
                    'dexuat' => $dexuatphieutrinh,
                    'nguoixuly' => $nguoixuly,
                ]);

            DB::table('donthu')
                ->where('donthuid', $donthuid)
                ->update(['trangthaixuly' => DANGXULY]);

            $result = 'successful';

        } catch (Exception $e) {

            $result = 'fail';

        }
        return $result;
    }

    /**************************************************
     * Function Name    : getDataFileDonThu
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function getDataFileDonThu($sothuly)
    {
        $filePL1 = DB::table('phanloaidonthu')
            ->where('sothuly', $sothuly)
            ->value('filehuongdan');

        $filePL2 = DB::table('phanloaidonthu')
            ->where('sothuly', $sothuly)
            ->value('congvanchuyendon');

        $filePL3 = DB::table('phanloaidonthu')
            ->where('sothuly', $sothuly)
            ->value('tbchuyendon');

        $filePL4 = DB::table('phanloaidonthu')
            ->where('sothuly', $sothuly)
            ->value('vbyeucauxuly');

        $fileXM1 = DB::table('giaoxacminh')
            ->where('sothuly', $sothuly)
            ->value('filexacminh');

        $fileXM2 = DB::table('giaoxacminh')
            ->where('sothuly', $sothuly)
            ->value('fileketquaxacminh');

        $fileTD1 = DB::table('theodoidonthu')
            ->where('sothuly', $sothuly)
            ->value('filephieutrinh');
        $fileTD2 = DB::table('theodoidonthu')
            ->where('sothuly', $sothuly)
            ->value('thongbaogiaiquyet');
        $fileTD3 = DB::table('theodoidonthu')
            ->where('sothuly', $sothuly)
            ->value('filecoquankhac');

        $arrayPL1 = array($filePL1, "phanloaidonthu", "filehuongdan");
        $arrayPL2 = array($filePL2, "phanloaidonthu", "congvanchuyendon");
        $arrayPL3 = array($filePL3, "phanloaidonthu", "tbchuyendon");
        $arrayPL4 = array($filePL4, "phanloaidonthu", "vbyeucauxuly");
        $arrayXM1 = array($fileXM1, "giaoxacminh", "filexacminh");
        $arrayXM2 = array($fileXM2, "giaoxacminh", "fileketquaxacminh");
        $arrayTD1 = array($fileTD1, "theodoidonthu", "filephieutrinh");
        $arrayTD2 = array($fileTD2, "theodoidonthu", "thongbaogiaiquyet");
        $arrayTD3 = array($fileTD3, "theodoidonthu", "filecoquankhac");

        $fileArray = array(
            '0' => $arrayPL1,
            '1' => $arrayPL2,
            '2' => $arrayPL3,
            '3' => $arrayPL4,
            '4' => $arrayXM1,
            '5' => $arrayXM2,
            '6' => $arrayTD1,
            '7' => $arrayTD2,
            '8' => $arrayTD3
        );
        return $fileArray;
    }

    /**************************************************
     * Function Name    : fileDelete
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function fileDelete($sothuly, $table, $position)
    {
        DB::table($table)
            ->where('sothuly', $sothuly)
            ->update([$position => '']);
        return "successful";
    }

    /**************************************************
     * Function Name    : SaveTheoDoiDonThu
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function SaveTheoDoiDonThu($sothuly, $ngayQD, $tomtatQDXL, $filephieutrinh, $fileTBTL, $fileTBGQCD, $ngaybatdau,
                                             $ngayketthuc, $donvi, $noidunggiaoXM, $fileQDXM, $linkfile, $linkfileXM)
    {


        DB::table('theodoidonthu')
            ->where('sothuly', $sothuly)
            ->update(['ngayquyetdinhxuly' => $ngayQD, 'tomtatxuly' => $tomtatQDXL,
                'filephieutrinh' => $filephieutrinh, 'thongbaogiaiquyet' => $fileTBTL, 'filecoquankhac' => $fileTBGQCD, 'linkfile' => $linkfile]);


        DB::table('giaoxacminh')
            ->where('sothuly', $sothuly)
            ->update(['ngaybatdau' => $ngaybatdau,
                'ngayketthuc' => $ngayketthuc,
                'donvi' => $donvi,
                'noidung' => $noidunggiaoXM,
                'filexacminh' => $fileQDXM,
                'linkfile' => $linkfileXM]);


        DB::table('donthu')
            ->where('sothuly', $sothuly)
            ->update(['trangthaixuly' => "3"]);


//        DB::table('donthu')
//        ->where('sothuly',$sothuly)
//        ->update(['filepath'=>$folder_name]);

        return $sothuly;

    }

    /**************************************************
     * Function Name    : GiaiQuyetDonThu
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function GiaiQuyetDonThu($sothuly, $soquyetdinh, $ngayquyetdinh, $tieude, $ketquanoidung, $danhgiadonthu,
                                           $phaithutien, $phaitratien, $phaithudat, $phaitradat, $file, $linkfile)
    {

        DB::table('ketquagiaiquyet')
            ->where('sothuly', $sothuly)
            ->update(['soquyetdinh' => $soquyetdinh,
                'ngayquyetdinh' => $ngayquyetdinh,
                'tieude' => $tieude,
                'tomtatketqua' => $ketquanoidung,
                'vanbangiaiquyet' => $file,
                'thutien' => $phaithutien,
                'tratien' => $phaitratien,
                'thudat' => $phaithudat,
                'tradat' => $phaitradat,
                'danhgiadonthu' => $danhgiadonthu,
                'linkfile' => $linkfile
            ]);

        DB::table('donthu')
            ->where('sothuly', $sothuly)
            ->update(['trangthaixuly' => "4"]);

//        DB::table('donthu')
//            ->where('sothuly',$sothuly)
//            ->update(['filepath'=>$folder_name]);

        return $sothuly;
    }

    /**************************************************
     * Function Name    : KetThucDonThu
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function KetThucDonThu($request)
    {

        $donthuid = $request->donthuid;
        $sothuly = $request->sothuly;
        $ketthucdonthu = $request->ketthucdonthu;
        $ngaynhan = $request->ngaynhan;
        $ngaytrendon = $request->ngaytrendon;
        $lydorutdon = $request->lydorutdon;
        $dexuat = $request->dexuat;

        if ($ketthucdonthu == "kt") {
            DB::table('donthu')
                ->where('donthuid', $donthuid)
                ->update(['ketqua' => KETTHUCDONTHU]);
        } else {
            DB::table('donthu')
                ->where('donthuid', $donthuid)
                ->update(['ketqua' => RUTDONTHU]);

            DB::table('thongtinrutdonthu')
                ->where('donthuid', $donthuid)
                ->update([
                    'ngaynhan' => $ngaynhan,
                    'ngaytrendon' => $ngaytrendon,
                    'lydo' => $lydorutdon,
                    'dexuat' => $dexuat
                ]);
        }

        DB::table('donthu')
            ->where('donthuid', $donthuid)
            ->update(['trangthaixuly' => KETTHUC]);
        return $sothuly;
    }

    /**************************************************
     * Function Name    : SearchKetQuaKNTC
     * Description        :
     * Argument        : $keysearch
     * Creation Date    : 2016/08/01
     * Author            : KhanhTH
     * Reviewer        : PhucHM
     ***************************************************/
    public static function SearchKetQuaKNTC($keysearch)
    {


        $result = DB::table('donthu')
            ->whereIn('trangthaixuly', [DANGGIAIQUYET, DAGIAIQUYET])
            ->where('tennguoivietdon', 'like', '%' . $keysearch . '%')
            ->orwhere('sothuly', 'like', '%' . $keysearch . '%')
            ->get();
        return $result;
    }


    /**************************************************
     * Function Name    : SearchKetQuaXuLyKNTC
     * Description        :
     * Argument        : $keysearch
     * Creation Date    : 2016/08/01
     * Author            : KhanhTH
     * Reviewer        : PhucHM
     ***************************************************/
    public static function SearchKetQuaXuLyKNTC($keysearch)
    {

        $result = DB::table('donthu')
            ->whereIn('trangthaixuly', [CHOXULY, DANGXULY])
            ->where('tennguoivietdon', 'like', '%' . $keysearch . '%')
            ->orwhere('sothuly', 'like', '%' . $keysearch . '%')
            ->get();
        return $result;
    }


    /**************************************************
     * Function Name    : GetName
     * Description        :
     * Argument        : $keysearch
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function GetName($diabanId)
    {
        $result = DB::table('accountinfo')
//            ->where('diaban', $diabanId)
            ->get();

        return $result;

    }

    /**************************************************
     * Function Name    : EditCheck
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function EditCheck($value, $phanloai, $theodoi, $giaiquyet)
    {
        $result1 = DB::table($phanloai)
            ->where('donthuid', $value)
            ->get();
        $result2 = DB::table($theodoi)
            ->where('donthuid', $value)
            ->get();
        $result3 = DB::table($giaiquyet)
            ->where('donthuid', $value)
            ->get();
        $array = array(
            'phanloai' => $result1,
            'theodoi' => $result2,
            'giaiquyet' => $result3
        );
        return $array;
    }

    /**************************************************
     * Function Name    : DataDiaBan
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function DataDiaBan()
    {
        $diaban = DB::table('diaban')->get();
        return $diaban;
    }

    /**************************************************
     * Function Name    : DataPhanLoai
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function DataPhanLoai()
    {
        $today = date("Y-m-d");
        $day_xl = 3;
        $day_qh = 10;
        //$month = 90;
        $date_xuly = date("Y-m-d", strtotime("$today -$day_xl day"));
        $date_qh = date("Y-m-d", strtotime("$today -$day_qh day"));

        $diaban_id = DB::table('diaban')->get();
        $donthu = DB::table('donthu')->get();
        //phan loai don thu id theo dia ban
        $id_donthu = array();
        $no = 0;
        for ($i = 1; $i < count($diaban_id); $i++) {
            $id_donthu[$no][0] = $diaban_id[$i]->id;
            $id_donthu[$no][1] = DB::table('phanloaidonthu')->where('diaban', $diaban_id[$i]->id)->pluck('donthuid');
            $no++;
        }


        return $id_donthu;
    }

    /**************************************************
     * Function Name    : DataTongDonChuaGQ
     * Description        :
     * Argument        :
     * Creation Date    : 2016/09/20
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function DataTongDonChuaGQ($diaBanIdAllArray, $loaidon)
    {
        $toDay = date('Y-m-d');
        $lastThreeDay = date('Y-m-d', time() - 3 * 24 * 60 * 60);
        $lastTenDay = date('Y-m-d', time() - 10 * 24 * 60 * 60);

        $donThu = array();

        foreach ($loaidon as $item) {
            $donThu[] = (object)array(
                'item' => $item,
                'xulyDH' => DB::table('donthu')
                    ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
                    ->whereIn('phanloaidonthu.diaban', $diaBanIdAllArray)
                    ->whereBetween('ngaynhan', [$lastThreeDay, $toDay])
                    ->where('phanloaidonthu.loaidon', $item->loaidonid)
                    ->where('trangthaixuly', CHOXULY)->get(),
                'xulyQH' => DB::table('donthu')
                    ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
                    ->whereIn('phanloaidonthu.diaban', $diaBanIdAllArray)
                    ->where('ngaynhan', '<', $lastThreeDay)
                    ->where('phanloaidonthu.loaidon', $item->loaidonid)
                    ->where('trangthaixuly', CHOXULY)->get(),
                'giaiquyetDH' => DB::table('donthu')
                    ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
                    ->join('theodoidonthu', 'donthu.donthuid', '=', 'theodoidonthu.donthuid')
                    ->whereIn('phanloaidonthu.diaban', $diaBanIdAllArray)
                    ->whereBetween('ngaynhan', [$lastTenDay, $toDay])
                    ->where('phanloaidonthu.loaidon', $item->loaidonid)
                    ->where('trangthaixuly', DANGXULY)
                    ->get(),
                'giaiquyetQH' => DB::table('donthu')
                    ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
                    ->join('theodoidonthu', 'donthu.donthuid', '=', 'theodoidonthu.donthuid')
                    ->whereIn('phanloaidonthu.diaban', $diaBanIdAllArray)
                    ->where('ngaynhan', '<', $lastTenDay)
                    ->where('phanloaidonthu.loaidon', $item->loaidonid)
                    ->where('trangthaixuly', DANGXULY)
                    ->get()
            );
        }


        return $donThu;


    }

    /**************************************************
     * Function Name    : DataTongDonSauThang
     * Description        :
     * Argument        :
     * Creation Date    : 2016/09/20
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function DataTongDonSauThang($diaBanIdAllArray)
    {
        //date
        $year = date("Y");
        $dang_xuly = array();
        $dang_giaiquyet = array();
        $da_giaiquyet = array();
        $giai_quyet_lan_1 = array();
        $giai_quyet_lan_2 = array();
        $donthu_nam = array();
        $date_result = array();
        $num = 0;

        $donthu_array = DonThuTable::GetDonThuTheoDiaBan($diaBanIdAllArray);

        if ($donthu_array != null) {
            for ($i = 0; $i < count($donthu_array); $i++) {
                $soThuLy = explode("/", $donthu_array[$i]->sothuly);
                $nam = $soThuLy[1];
                if ($nam == $year) {
                    $donthu_nam[$num] = $donthu_array[$i];
                    $num++;
                }
            }

            //
            if ($donthu_nam != null) {
                for ($j = 0; $j < count($donthu_nam); $j++) {
                    if ($donthu_nam[$j]->trangthaixuly == DANGXULY) {
                        array_push($dang_xuly, $donthu_nam[$j]);
                    } elseif ($donthu_nam[$j]->trangthaixuly == DANGGIAIQUYET) {
                        array_push($dang_giaiquyet, $donthu_nam[$j]);
                    } elseif ($donthu_nam[$j]->trangthaixuly == DAGIAIQUYET) {
                        array_push($da_giaiquyet, $donthu_nam[$j]);
                    }
                }
            }

            //
            if ($da_giaiquyet != null) {
                for ($i = 0; $i < count($da_giaiquyet); $i++) {
                    if ($da_giaiquyet[$i]->donthulanmotid != 0) {
                        $result = DonThuTable::CheckDonDaGQLanMotTheoId($da_giaiquyet[$i]->donthulanmotid);

                        if ($result == true) {

                            array_push($giai_quyet_lan_2, $da_giaiquyet[$i]);
                        } else {
                            array_push($giai_quyet_lan_1, $da_giaiquyet[$i]);
                        }
                    } else {
                        array_push($giai_quyet_lan_1, $da_giaiquyet[$i]);
                    }
                }
            }

            $date_result = array(
                'dangXL' => $dang_xuly,
                'dangGQ' => $dang_giaiquyet,
                'daGQ' => $da_giaiquyet,
                'gq_lan1' => $giai_quyet_lan_1,
                'gq_lan2' => $giai_quyet_lan_2,
                'tongdonthu' => $donthu_nam
            );
        } else {
            $date_result = array(
                'dangXL' => "",
                'dangGQ' => "",
                'daGQ' => "",
                'gq_lan1' => "",
                'gq_lan2' => "",
                'tongdonthu' => ""
            );
        }


        return $date_result;

    }

    /**************************************************
     * Function Name    : DataTongDonPhanLoai
     * Description        :
     * Argument        :
     * Creation Date    : 2016/09/20
     * Author            : duongpd
     * Reviewer        : PhucHM
     ***************************************************/
    public static function DataTongDonPhanLoai($diaBanIdAllArray)
    {

        $loaidon = DB::table('loaidon')->get();
        $linhvuc = DB::table('linhvuc')->get();
        $diaban = DB::table('diaban')->get();

        $donthu_phanloai = DB::table('phanloaidonthu')
            ->whereIn('diaban', $diaBanIdAllArray)
            ->get();

        $diaban_phanloai = array();
        $loaidon_phanloai = array();
        $linhvuc_phanloai = array();

        $data_return = array();

        //data dia ban

        $no = 0;
        for ($i = 1; $i < count($diaban); $i++) {
            for ($j = 0; $j < count($diaBanIdAllArray); $j++) {
                if ($diaban[$i]->id == $diaBanIdAllArray[$j]) {
                    $diaban_phanloai[$no][0] = $diaban[$i]->id;
                    $diaban_phanloai[$no][1] = $diaban[$i]->tendiaban;
                    $diaban_phanloai[$no][2] = DB::table('phanloaidonthu')->where('diaban', $diaban[$i]->id)->get();
                    $no++;
                }

            }


        }

        //loai don


        //$num = 0;
        for ($i = 0; $i < count($loaidon); $i++) {

            $loaidon_phanloai[$i][0] = $loaidon[$i]->loaidonid;
            $loaidon_phanloai[$i][1] = $loaidon[$i]->tenloaidon;
            $loaidon_phanloai[$i][2] = DB::table('phanloaidonthu')
                ->whereIn('diaban', $diaBanIdAllArray)
                ->where('loaidon', $loaidon[$i]->loaidonid)
                ->get();

        }


        //linh vuc


        //$var = 0;
        for ($i = 0; $i < count($linhvuc); $i++) {

            $linhvuc_phanloai[$i][0] = $linhvuc[$i]->linhvucid;
            $linhvuc_phanloai[$i][1] = $linhvuc[$i]->tenlinhvuc;
            $linhvuc_phanloai[$i][2] = DB::table('phanloaidonthu')
                ->whereIn('diaban', $diaBanIdAllArray)
                ->where('linhvuc', $linhvuc[$i]->linhvucid)
                ->get();

        }


        $data_return = array(
            'diaban_phanloai' => $diaban_phanloai,
            'loaidon_phanloai' => $loaidon_phanloai,
            'linhvuc_phanloai' => $linhvuc_phanloai
        );

        return $data_return;
    }

    /**************************************************
     * Function Name    : getAllDonThu
     * Description        :
     * Argument        : None
     * Creation Date    : 2016/08/01
     * Author            : KhanhTH
     * Reviewer        : PhucHM
     ***************************************************/
    public static function getAllDonThu()
    {
        $result = DB::table('donthu')
            ->get();
        return $result;
    }

    /**************************************************
     * Function Name    : xoaDonThu
     * Description        :
     * Argument        : $request
     * Creation Date    : 2016/08/01
     * Author            : KhanhTH
     * Reviewer        : PhucHM
     ***************************************************/
    public static function xoaDonThu($donthuid)
    {
        try {
            DB::table('donthu')
                ->where('donthuid', $donthuid)
                ->delete();

            $result = 'successful';

        } catch (Exception $e) {

            $result = 'fail';
        }
        return $result;
    }

    /**************************************************
     * Function Name    : GetDataDetail
     * Description        :
     * Argument        : donthuid
     * Creation Date    : 2016/08/01
     * Author            : KhanhTH
     * Reviewer        : PhucHM
     ***************************************************/
    public static function GetDataDetail($donthuid)
    {
        $donthu = DB::table('donthu')->where('donthuid', $donthuid)->first();
        $phanloai = DB::table('phanloaidonthu')->where('donthuid', $donthuid)->first();
        $theodoi = DB::table('theodoidonthu')->where('donthuid', $donthuid)->first();
        $array = array(
            'donthu' => $donthu,
            'phanloai' => $phanloai,
            'theodoi' => $theodoi
        );
        return $array;
    }

    /**************************************************
     * Function Name    : getThongTinDonThuTheoId
     * Description        :
     * Argument        : $donThuId
     * Creation Date    : 2016/08/01
     * Author            : KhanhTH
     * Reviewer        : PhucHM
     ***************************************************/
    public static function getThongTinDonThuTheoId($donThuId)
    {

        $donthu = DB::table('donthu')
            ->where('donthuid', $donThuId)
            ->first();

        return $donthu;
    }

    /**************************************************
     * Function Name    : GetDonThuTheoDiaBan
     * Description        :
     * Argument        : $diabanId
     * Creation Date    : 2016/08/01
     * Author            : KhanhTH
     * Reviewer        : PhucHM
     ***************************************************/
    public static function GetDonThuTheoDiaBan($diaBanIdAllArray)
    {

        $donthu = DB::table('donthu')
            ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
            ->whereIn('phanloaidonthu.diaban', $diaBanIdAllArray)
            ->get();

        return $donthu;
    }

    /**************************************************
     * Function Name    : GetTatCaDonThu
     * Description        :
     * Argument        : $diabanId
     * Creation Date    : 2016/08/01
     * Author            : KhanhTH
     * Reviewer        : PhucHM
     ***************************************************/
    public static function GetTatCaDonThu($diaBanIdAllArray)
    {
        $donthu = DonThuTable::GetDonThuTheoDiaBan($diaBanIdAllArray);


        $donthu_xuly = array();

        $donthu_DGQ = array();
        $donthu_GQ = array();
        $giai_quyet_lan1 = array();
        $giai_quyet_lan2 = array();
        $no = 0;
        $num = 0;
        $var = 0;


        $result = array();

        if ($donthu != null) {
            //dang xu ly
            for ($i = 0; $i < count($donthu); $i++) {
                if ($donthu[$i]->trangthaixuly == DANGXULY) {
                    $donthu_xuly[$no] = $donthu[$i];
                    $no++;
                } elseif ($donthu[$i]->trangthaixuly == DANGGIAIQUYET) {
                    $donthu_DGQ[$var] = $donthu[$i];
                    $var++;
                } elseif ($donthu[$i]->trangthaixuly == DAGIAIQUYET) {
                    $donthu_GQ[$num] = $donthu[$i];
                    $num++;
                }
            }

            if ($donthu_GQ != null) {
                for ($j = 0; $j < count($donthu_GQ); $j++) {
                    if ($donthu_GQ[$j]->donthulanmotid != 0) {
                        $check_don = DonThuTable::CheckDonDaGQLanMotTheoId($donthu_GQ[$j]->donthulanmotid);

                        if ($check_don == true) {
                            array_push($giai_quyet_lan2, $donthu_GQ[$j]);
                        } else {
                            array_push($giai_quyet_lan1, $donthu_GQ[$j]);
                        }
                    } else {
                        array_push($giai_quyet_lan1, $donthu_GQ[$j]);
                    }

                }
            }


        }

        //array return
        $result = array(
            'xuly' => $donthu_xuly,
            'giaiquyet' => $donthu_DGQ,
            'dagiaiquyet' => $donthu_GQ,
            'gq_lan1' => $giai_quyet_lan1,
            'gq_lan2' => $giai_quyet_lan2,
            'tongdon' => count($donthu)
        );

        return $result;

    }

    /**************************************************
     * Function Name    : updateImage
     * Description        :
     * Argument        : $donthuid, $request
     * Creation Date    : 2016/08/01
     * Author            : KhanhTH
     * Reviewer        : PhucHM
     ***************************************************/
    public static function updateImage($donthuid, $request)
    {
        $sothuly = DB::table('donthu')
            ->where('donthuid', $donthuid)
            ->value('sothuly');

        $file_value = null;

        //create direction
        $input = Input::all();
        if ($sothuly != null) {
            $name = explode('/', $sothuly);
            $folder_name = "donthu_" . $name[0] . "_" . $name[1];
        } else {
            $folder_name = "donthu_";
        }

        $file_path = FOLDERROOT . "/file/" . $folder_name;
        $linkfile = '/file' . '/' . $folder_name;


        //create direction
        $filevanban = array_get($input, 'anhdaidien');
        if ($filevanban != null) {
            // RENAME THE UPLOAD WITH RANDOM NUMBER
            $filevanbandinhkem = $filevanban->getClientOriginalName();
            // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
            $filevanban->move($file_path, $filevanbandinhkem);
            $file_value = $filevanbandinhkem;
        } else {
            $file_value = "";
        }


        DB::table('donthu')
            ->where('donthuid', $donthuid)
            ->update([
                'image' => $file_value,
                'filepath' => $linkfile,
            ]);
    }


    /**************************************************
     * Function Name    : GetDonThuKhieuNaiTheoDiaBan
     * Description        :
     * Argument        : $tu_Ngay,$den_Ngay,$diaBanIdArray
     * Creation Date    : 2016/08/01
     * Author            : KhanhTH
     * Reviewer        : PhucHM
     ***************************************************/
    public static function GetDonThuKhieuNaiTheoDiaBan($tuNgay, $denNgay, $diaBanIdArray)
    {
        $donthu = DB::table('donthu')
            ->where('ngaynhan', '>=', $tuNgay)
            ->where('ngaynhan', '<=', $denNgay)
            ->whereIn('diaban', $diaBanIdArray)
            ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
            ->join('loaidon', 'phanloaidonthu.loaidon', '=', 'loaidon.loaidonid')
            ->get();

        $donKhieuNai = [];
        $donToCao = [];
        foreach ($donthu as $rowNumber => $rowValue) {

            if ('Đơn khiếu nại' == $rowValue->tenloaidon) {
                $donKhieuNai[] = $rowValue;
            } elseif ('Đơn tố cáo' == $rowValue->tenloaidon) {
                $donToCao[] = $rowValue;
            }
        }

        $result = (object)array(
            'khieuNai' => $donKhieuNai,
            'toCao' => $donToCao
        );

        return $result;

    }

    /**************************************************
     * Function Name    : CheckDonDaGQLanMotTheoId
     * Description        :
     * Argument        : $tu_Ngay,$den_Ngay,$diaBanIdArray
     * Creation Date    : 2016/08/01
     * Author            : duongpd1
     * Reviewer        : PhucHM
     ***************************************************/
    public static function CheckDonDaGQLanMotTheoId($donthuId)
    {
        $result = DB::table('donthu')
            ->where('donthuid', $donthuId)
            ->where('trangthaixuly', DAGIAIQUYET)
            ->count();

        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**************************************************
     * Function Name    : CheckDonDaGQLanMotTheoId
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd1
     * Reviewer        : PhucHM
     ***************************************************/
    public static function getDonThuTheoCMT($value, $filed, $table)
    {
        if ($filed == 'cmt' || $filed == 'cmnd_hc') {
            $data = DB::table($table)
                ->where($filed, $value)
                ->get();
        } else {
            $data = DB::table($table)
                ->where($filed, 'like', '%' . $value . '%')
                ->get();
        }


        return $data;
    }

    /**************************************************
     * Function Name    : InsertDonThuNhieuNguoi
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd1
     * Reviewer        : PhucHM
     ***************************************************/
    public static function InsertDonThuNhieuNguoi($request)
    {
        $sothuly = explode('/', $request->sothuly);
        $tiepDanId = $sothuly[0];

        $tenCongDan = mb_strtoupper($request->tenCongDan, 'UTF-8');
        $diaChi = $request->diaChi;
        $cmt = $request->cmt;
        $ngayCap = DonThuTable::ConvertFormatDate($request->ngayCap);
        $noiCap = $request->noiCap;
        $soDT = $request->sodt;
        $nguoiDaiDien = $request->value;

        $congDanId = DB::table('nguoidaidien')
            ->insertGetId([
                'donthuid' => $tiepDanId,
                'sothuly' => $request->sothuly,
                'tennguoidaidien' => $tenCongDan,
                'diachinguoidaidien' => $diaChi,
                'cmt' => $cmt,
                'ngaycap' => $ngayCap,
                'noicap' => $noiCap,
                'sdt' => $soDT,
                'nguoidaidien' => $nguoiDaiDien,
                'gioitinh' => $request->gTinh,
                'enable' => UNENABLE
            ]);

        $result = [$congDanId, $tenCongDan, $diaChi, $cmt, $nguoiDaiDien, $soDT];

        return $result;
    }

    /**************************************************
     * Function Name    : CheckNguoiDaiDien
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd1
     * Reviewer        : PhucHM
     ***************************************************/
    public static function CheckNguoiDaiDien($donthuid, $iD)
    {
        $result = DB::table('nguoidaidien')
            ->where('donthuid', $donthuid)
            ->where('id', $iD)
            ->get();

        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**************************************************
     * Function Name    : DataTongSoDonTheoKy
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd1
     * Reviewer        : PhucHM
     ***************************************************/
    public static function DataTongSoDonTheoKy($type1, $type2, $diaBanIdAllArray)
    {
        $year = date("Y");
        $donthuArray = DB::table('donthu')
            ->where('trangthaixuly', $type2)
            ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
            ->select('donthu.*', 'phanloaidonthu.huonggiaiquyet')
            ->whereIn('phanloaidonthu.diaban', $diaBanIdAllArray)
            ->get();
        $data = array();

        if ($type1 == TRONG_KY) {
            foreach ($donthuArray as $donthu) {
                $nam = explode('/', $donthu->sothuly);
                if ($nam[1] == $year) {
                    $data[] = $donthu;
                }
            }

        } else {
            $data = $donthuArray;
        }


        return $data;
    }

    /**************************************************
     * Function Name    : DonThuGiaiQuyetTheoLan
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd1
     * Reviewer        : PhucHM
     ***************************************************/
    public static function DonThuGiaiQuyetTheoLan($type1, $type2, $diaBanIdAllArray)
    {
        $year = date("Y");
        $data = array();
        $donthu_trong_ky = array();

        $donthuArray = DB::table('donthu')
            ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
            ->select('donthu.*', 'phanloaidonthu.huonggiaiquyet')
            ->where('trangthaixuly', DAGIAIQUYET)
            ->whereIn('phanloaidonthu.diaban', $diaBanIdAllArray)
            ->get();

        if ($type1 == TRONG_KY) {
            foreach ($donthuArray as $don) {
                $nam = explode('/', $don->sothuly);
                if ($nam[1] == $year) {
                    $donthu_trong_ky[] = $don;
                }
            }
        } else {
            $donthu_trong_ky = $donthuArray;
        }

        foreach ($donthu_trong_ky as $donthu) {
            if ($donthu->donthulanmotid != 0) {
                $result = DonThuTable::CheckDonDaGQLanMotTheoId($donthu->donthulanmotid);

                if ($result == true) {

                    $data[] = $donthu;
                } else {

                    $data[] = $donthu;
                }
            } else {

                $data[] = $donthu;
            }
        }


        return $data;

    }

    /**************************************************
     * Function Name    : DonThuTrongKyTheoPhanLoai
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd1
     * Reviewer        : PhucHM
     ***************************************************/
    public static function DonThuTrongKyTheoPhanLoai($field, $type2, $diaBanIdAllArray)
    {

        $donthuArray = DB::table('donthu')
            ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
            ->where($field, $type2)
            ->whereIn('phanloaidonthu.diaban', $diaBanIdAllArray)
            ->get();

        return $donthuArray;
    }

    /**************************************************
     * Function Name    : KetQuaGiaiQuyetDon
     * Description        :
     * Argument        :
     * Creation Date    : 2016/08/01
     * Author            : duongpd1
     * Reviewer        : PhucHM
     ***************************************************/
    public static function KetQuaGiaiQuyetDon($diaBanIdAllArray, $loaidon)
    {
        $donThu = array();

        foreach ($loaidon as $item) {
            $donThu[] = (object)array(
                'item' => $item,
                'DangGQ' => DB::table('donthu')
                    ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
                    ->whereIn('phanloaidonthu.diaban', $diaBanIdAllArray)
                    ->where('phanloaidonthu.loaidon', $item->loaidonid)
                    ->where('trangthaixuly', DANGXULY)
                    ->get(),
                'DaGQ' => DB::table('donthu')
                    ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
                    ->whereIn('phanloaidonthu.diaban', $diaBanIdAllArray)
                    ->where('phanloaidonthu.loaidon', $item->loaidonid)
                    ->where('trangthaixuly', DAGIAIQUYET)
                    ->get(),
                'KetThuc' => DB::table('donthu')
                    ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
                    ->join('theodoidonthu', 'donthu.donthuid', '=', 'theodoidonthu.donthuid')
                    ->whereIn('phanloaidonthu.diaban', $diaBanIdAllArray)
                    ->where('phanloaidonthu.loaidon', $item->loaidonid)
                    ->where('trangthaixuly', KETTHUC)
                    ->get()
            );
        }

        return $donThu;
    }

    /**************************************************
     * Function Name    : GetDonXuLy
     * Description        :
     * Argument        :
     * Creation Date    : 2017/05/27
     * Author            : duongpd1
     * Reviewer        : PhucHM
     ***************************************************/
    public static function GetDonXuLy($diaBanIdAll, $type, $loaidonId)
    {

        $toDay = date('Y-m-d');
        $lastThreeDay = date('Y-m-d', time() - 3 * 24 * 60 * 60);
        $lastSevenDay = date('Y-m-d', time() - 7 * 24 * 60 * 60);

        if ($type == 'xuly_DH') {
            $donThu = DB::table('donthu')
                ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
                ->whereIn('phanloaidonthu.diaban', $diaBanIdAll)
                ->whereBetween('ngaynhan', [$lastThreeDay, $toDay])
                ->where('phanloaidonthu.loaidon', $loaidonId)
                ->whereIn('trangthaixuly', [CHOXULY, DANGXULY])
                ->paginate(10);

        } else {
            $donThu = DB::table('donthu')
                ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
                ->whereIn('phanloaidonthu.diaban', $diaBanIdAll)
                ->where('ngaynhan', '<', $lastThreeDay)
                ->where('phanloaidonthu.loaidon', $loaidonId)
                ->whereIn('trangthaixuly', [CHOXULY, DANGXULY])
                ->paginate(10);


        }

        return $donThu;
    }

    /**************************************************
     * Function Name    : GetDonGiaiQuyet
     * Description        :
     * Argument        :
     * Creation Date    : 2017/05/27
     * Author            : duongpd1
     * Reviewer        : PhucHM
     ***************************************************/
    public static function GetDonGiaiQuyet($diaBanIdAll, $type, $loaidonId)
    {
        $toDay = date('Y-m-d');
        $lastThreeDay = date('Y-m-d', time() - 3 * 24 * 60 * 60);
        $lastSevenDay = date('Y-m-d', time() - 7 * 24 * 60 * 60);

        if ($type == 'giaiquyet_DH') {
            $donThu = DB::table('donthu')
                ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
                ->join('theodoidonthu', 'donthu.donthuid', '=', 'theodoidonthu.donthuid')
                ->whereIn('phanloaidonthu.diaban', $diaBanIdAll)
                ->whereBetween('theodoidonthu.ngayquyetdinhxuly', [$lastSevenDay, $toDay])
                ->where('phanloaidonthu.loaidon', $loaidonId)
                ->where('trangthaixuly', DANGGIAIQUYET)
                ->paginate(10);
        } else {
            $donThu = DB::table('donthu')
                ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
                ->join('theodoidonthu', 'donthu.donthuid', '=', 'theodoidonthu.donthuid')
                ->whereIn('phanloaidonthu.diaban', $diaBanIdAll)
                ->where('theodoidonthu.ngayquyetdinhxuly', '<', $lastSevenDay)
                ->where('phanloaidonthu.loaidon', $loaidonId)
                ->where('trangthaixuly', DANGGIAIQUYET)
                ->paginate(10);
        }

        return $donThu;
    }

    /**************************************************
     * Function Name    : DanhSachKetQuaGiaiQuyetDon
     * Description        :
     * Argument        :
     * Creation Date    : 2017/05/27
     * Author            : duongpd1
     * Reviewer        : PhucHM
     ***************************************************/
    public static function DanhSachKetQuaGiaiQuyetDon($diaBanIdAllArray, $type, $loaidonId)
    {
        if ($type == 'DAGIAIQUYET') {
            $donThu = DB::table('donthu')
                ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
                ->join('theodoidonthu', 'donthu.donthuid', '=', 'theodoidonthu.donthuid')
                ->whereIn('phanloaidonthu.diaban', $diaBanIdAllArray)
                ->where('phanloaidonthu.loaidon', $loaidonId)
                ->where('trangthaixuly', DAGIAIQUYET)
                ->paginate(10);
        } else {
            $donThu = DB::table('donthu')
                ->join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
                ->join('theodoidonthu', 'donthu.donthuid', '=', 'theodoidonthu.donthuid')
                ->whereIn('phanloaidonthu.diaban', $diaBanIdAllArray)
                ->where('phanloaidonthu.loaidon', $loaidonId)
                ->where('trangthaixuly', KETTHUC)
                ->paginate(10);
        }

        return $donThu;
    }

    /**************************************************
     * Function Name    : ConvertFormatDate
     * Description        :
     * Argument        :
     * Creation Date    : 2017/05/27
     * Author            : duongpd1
     * Reviewer        : PhucHM
     ***************************************************/
    public static function ConvertFormatDate($date)
    {

        if ($date != "" && $date != '0000-00-00') {
            $ngayExplore = explode('/', $date);
            $ngay = $ngayExplore[0];
            $thang = $ngayExplore[1];
            $nam = $ngayExplore[2];
            return $nam . '-' . $thang . '-' . $ngay;
        } else {
            return '0000-00-00';
        }

    }

    /**************************************************
     * Function Name    : getDataOfDothuOfMasterUser
     * Description        :
     * Argument        :
     * Creation Date    : 2017/06/05
     * Author            : duongpd1
     * Reviewer        : PhucHM
     ***************************************************/
    public static function getDataOfDothuOfMasterUser($accountId = false)
    {
        if (!$accountId) {
            $accountId = Session::get('accountid');

        }
        if (!$accountId) {
            return false;
        }
        $accountpermission = Session::get('accountpermission');

        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);

        $diabanId = $accountInfo[0]->diaban;


        $allDonThuId = PhanLoaiDonThuTable::where('nguoixuly', $accountId)->pluck('donthuid')->toArray();

        $data = DonThuTable::whereIn('donthuid', $allDonThuId)->orderBy('create_at', 'desc')->get()->groupBy('trangthaixuly');
        $done = DonThuTable::whereIn('trangthaixuly', [DAGIAIQUYET,KETTHUC])->orderBy('donthuid', 'desc')->get();

        if ($accountpermission == TIEPDAN) {

            $donDangXL = DonThuTable::join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
                ->where('phanloaidonthu.diaban', $diabanId)
                ->where('donthu.trangthaixuly', DANGXULY)
                ->orderBy('create_at', 'desc')
                ->get();

        } else {

            $donDangXL = DonThuTable::join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
                ->where('phanloaidonthu.nguoixuly', $accountId)
                ->whereIn('donthu.trangthaixuly', [DANGXULY])
                ->orderBy('create_at', 'desc')
                ->get();
        }


        $result = (object)array(
            'choXuLy' => isset($data[0]) ? $data[0] : array(),
            'dangXuLy' => isset($donDangXL) ? $donDangXL : array(),
            'daXuLy' => isset($done) ? $done : array(),
        );

        return $result;
    }

    /**************************************************
     * Function Name    : getDataDonChoVanThu
     * Description        :
     * Argument        :
     * Creation Date    : 2017/06/05
     * Author            : duongpd1
     * Reviewer        : PhucHM
     ***************************************************/
    public static function getDataDonChoVanThu($accountId = false)
    {
        if (!$accountId) {
            $accountId = Session::get('accountid');
        }
        if (!$accountId) {
            return false;
        }

        $data = DonThuTable::join('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
            ->where('nguoinhap', $accountId)
            ->orderBy('create_at', 'desc')
            ->get();


        return $data;

    }

    /*********************************
     * @param $donId
     * @return mixed
     */
    public function getDataToBuildArg($donId)
    {
        $data = DB::table('donthu')
            ->where('donthu.donthuid', $donId)
            ->leftJoin('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
            ->leftJoin('diaban', 'phanloaidonthu.diaban', '=', 'diaban.id')
            ->leftJoin('donvi', 'phanloaidonthu.donvi', '=', 'donvi.id')
            ->leftJoin('linhvuc', 'phanloaidonthu.linhvuc', '=', 'linhvuc.linhvucid')
            ->leftJoin('loaidon', 'phanloaidonthu.loaidon', '=', 'loaidon.loaidonid')
            ->select('donthu.*', 'phanloaidonthu.*', 'diaban.mahanhchinh', 'donvi.madonvi', 'loaidon.maloaidon', 'linhvuc.malinhvuc')
            ->get();

        return $data;
    }

    /***************************
     * @return false|string
     */
    public function getNgayNhanViewAttribute()
    {
        return date("d/m/Y", strtotime($this->ngaynhan));
    }

    /*********************
     * @return false|string
     */
    public function getHanXuLyViewAttribute()
    {
        $hanXuLy = 10;
        if ("" != $this->thoihanxuly) {
            $hanXuLy = (int)str_replace(' ', '', $this->thoihanxuly);
        }

        return date("d/m/Y", strtotime($this->ngaynhan) + $hanXuLy * 24 * 60 * 60);
    }

    /**************************
     * @return object
     */
    public function getNgayConLaiViewAttribute()
    {
        $hanXuLy1 = 10;
        if ("" != $this->thoihanxuly) {
            $hanXuLy1 = (int)str_replace(' ', '', $this->thoihanxuly);
        }

        $day = (int)(((strtotime($this->ngaynhan) + $hanXuLy1 * 24 * 60 * 60) - strtotime(date('Y-m-d H:i:s'))) / (24 * 60 * 60));

        $year = date('Y', ((strtotime($this->ngaynhan) + $hanXuLy1 * 24 * 60 * 60))) - date('Y');

        $month = date('m', ((strtotime($this->ngaynhan) + $hanXuLy1 * 24 * 60 * 60))) - date('m');

        $yearAbc = abs($year);
        if ($month >= 0) {
            $yearAbc = abs($year) + 1;
        }

        $month = abs($yearAbc) * 12 + abs($month);

        return (object)array(
            'type' => ($day >= 0) ? 1 : 2,
            'day' => abs($day),
            'month' => abs($month),
            'year' => abs($year)
        );
    }

    protected $appends = ['ngay_nhan_view', 'han_xu_ly_view', 'ngay_con_lai_view'];

    /************
     * @param $dId
     * @param $arg
     * @return mixed
     */
    public function _update($dId, $arg)
    {
        $result = DB::table($this->table)->where('donthuid', $dId)->update($arg);

        return $result;
    }

    public function getAllInforDon($donId)
    {

        $result = DB::table($this->table)
            ->where('donthu.donthuid', $donId)
            ->leftJoin('phanloaidonthu', 'donthu.donthuid', '=', 'phanloaidonthu.donthuid')
            ->leftJoin('loaidon', 'phanloaidonthu.loaidon', '=', 'loaidon.loaidonid')
            ->leftJoin('donvi', 'phanloaidonthu.donvi', '=', 'donvi.id')
            ->leftJoin('accountinfo', 'donvi.nguoidaidien', '=', 'accountinfo.accountid')
            ->select('donthu.*', 'donvi.tendonvi', 'accountinfo.fullname', 'loaidon.tenloaidon')
            ->get();
        $arrData = [];
        if (!empty($result)) {
            $arrData = object_to_array($result);
        }

        return $arrData;

    }

    public function GetAutoComplete($filter)
    {
        $keyword = isset($filter->keyword) ? $filter->keyword : '';
        $result = DB::table($this->table)
            ->where(function ($subQuery) use ($keyword) {
//                $subQuery->where('donthuid','REGEXP','%'.$keyword.'%')
                $subQuery->Where('tennguoivietdon', 'like', '%' . $keyword . '%');
//                    ->orWhere('noidung', 'REGEXP', '%'.$keyword.'%');
            })->orderBy('donthuid', 'desc')->get();

        return $result;
    }

    public function UpdateSoKiHieuVanBan($id,$val)
    {
        $result = DB::table('quanlyvanban')
            ->where('id',$id)
            ->update(['so_kihieu'=>$val]);

        return $result;
    }
}
