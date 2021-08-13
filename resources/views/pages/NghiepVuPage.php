<?php

namespace App\Model\PageModel;

use App\Model\TableModel\AccountInfoTable;
use App\Model\TableModel\DiaBanTable;
use App\Model\TableModel\DoiTuongKhieuNaiToCaoTable;
use App\Model\TableModel\DonViTable;
use App\Model\TableModel\GiaoXacMinhTable;
use App\Model\TableModel\KetQuaGiaiQuyetTable;
use App\Model\TableModel\KetQuaTiepDanTable;
use App\Model\TableModel\LichTiepDanTable;
use App\Model\TableModel\MailboxTable;
use App\Model\TableModel\PhanLoaiDonThuTable;
use App\Model\TableModel\TheoDoiDonThuTable;
use App\Model\TableModel\ThongTinRutDonThuTable;
use Illuminate\Database\Eloquent\Model;
use App\Model\TableModel\DonThuTable;
use App\Model\TableModel\BaoCaoTable;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\DB;

class NghiepVuPage extends Model
{
    /**************************************************
    Function Name	: getDSDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function getDSDonThu()
    {
        $dsDonThu= DonThuTable::getTTDonThu();
        return $dsDonThu;
    }

    /**************************************************
    Function Name	: GetDonThuTrangChu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDonThuTrangChu()
    {
        $result = DonThuTable::GetDonThuTrangChu();
        return $result;
    }

    /**************************************************
    Function Name	: getSelected
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function getSelected($request)
    {
        $valueSelect = $request->status;
        $result = DonThuTable::getDataSelected($valueSelect);
        return $result;
    }
    /**************************************************
    Function Name	: getDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function getDonThu()
    {
        $donthu = DonThuTable::getTTDonthu();
        $phanloai = DonThuTable::getPhanLoai($donthu);
        $theodoi = DonThuTable::getTheoDoi($donthu);
        $ketqua = DonThuTable::getKetQuaGQ($donthu);
        $xacminh = DonThuTable::getXacMinh($donthu);

        $dataResult = array(
            'donthu'      => $donthu,
            'phanloai'      => $phanloai,
            'theodoi'      => $theodoi,
            'ketqua'      => $ketqua,
            'xacminh'      => $xacminh
        );

        return $dataResult;
    }

    /**************************************************
    Function Name	: xoaDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function xoaDonThu($request)
    {

        DonThuTable::xoaDonThu($request->donthuid);
        PhanLoaiDonThuTable::xoaDonThu($request->donthuid);
        TheoDoiDonThuTable::xoaDonThu($request->donthuid);
        GiaoXacMinhTable::xoaDonThu($request->donthuid);
        KetQuaGiaiQuyetTable::xoaDonThu($request->donthuid);
        ThongTinRutDonThuTable::xoaDonThu($request->donthuid);

        $result = 'successful';

        return $result;
    }

    /**************************************************
    Function Name	: createDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function createDonThu($request)
    {
        $sothuly = $request->sothuly;
        $ngayviet = $request->ngayviet;
        $ngaynhan = $request->ngaynhan;
        $nguondon = $request->nguondon;
        if($nguondon == 'dodan') {
            $cvden = $request->cvden;
            $ngaychuyen = $request->ngaychuyen;
            $coquan = $request->coquan;
        }else{
            $cvden = '';
            $ngaychuyen = '';
            $coquan = '';
        }
        $group = $request->group;
        $tennguoiviet = $request->tennguoiviet;
        $lan = $request->lan;
        $dtkntc = $request->dtkntc;
        $giaiquyet = $request->giaiquyet;
        $noidung = $request->noidungdon;
        $cmt = $request->cmt;
        $ngaycap = $request->ngaycap;
        $noicap = $request->noicap;
        $diachi = $request->diachi;
        $file = '';
//        $inputfile = $request->datatemp;
        $datatable = $request->tabletemp;
//        $arrayinput = explode(".",$inputfile);


        //create direction
        $input = Input::all();
        if($sothuly!=null)
        {
            $name = explode('/',$sothuly);
            $folder_name ="donthu_".$name[0]."_".$name[1];
        }
        else
        {
            $folder_name ="donthu_";
        }

        $file_path = FOLDERROOT."/file/".$folder_name;
        $linkfile = '/file'.'/'.$folder_name;
        // $temp = " ";
//        if(!is_dir($file_path)) {
//            mkdir($file_path, 0700);
//        }
        $vbuyquyen = array_get($input,'vbuyquyen');
        /* van ban uy quyen*/
        $filevVanban = "";
        if($vbuyquyen!=null)
        {
            $filevVanban= $vbuyquyen->getClientOriginalName();
            $vbuyquyen->move($file_path, $filevVanban);
        }

//        for($var = 0; $var < count($arrayinput); $var++)
//        {
//            $file1 = array_get($input,$arrayinput[$var]);
//
//            /* file attach*/
//            if($file1!=null)
//            {
//                // RENAME THE UPLOAD WITH RANDOM NUMBER
//                $fileName = $file1->getClientOriginalName();
//                // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
//                $file1->move($file_path, $fileName);
//                $file[$var] = $fileName;
//            }
//
//        }
//        if($file != "")
//        {
//            $file = implode("/", $file);
//        }

        if($request->file0 != null) {
            //create direction
            $filevanban = array_get($input, 'file0');
            // RENAME THE UPLOAD WITH RANDOM NUMBER
            $fileName = $filevanban->getClientOriginalName();
            // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
            $filevanban->move($file_path, $fileName);

            $file = $fileName;
        }

        //data table
        if($datatable!=null)
        {
            $datatable = explode('.',$datatable);
        }
        $result = DonThuTable::insertDonThu($sothuly,$ngayviet,$ngaynhan,$nguondon,$cvden,$ngaychuyen,$coquan,$group,$tennguoiviet
        ,$lan,$dtkntc,$giaiquyet,$noidung,$file,$datatable,$cmt,$ngaycap,$noicap,$diachi,$filevVanban,$linkfile);
        return $result;

    }

    /**************************************************
    Function Name	: StoreDonThu
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function StoreDonThu($request)
    {
        $result = DonThuTable::StoreDonThu($request);
        return $result;
    }

    /**************************************************
    Function Name	: updateDonThu
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateChinhSuaDonThu($request)
    {
        $result = DonThuTable::updateChinhSuaDonThu($request);
        return $result;
    }

    /**************************************************
    Function Name	: UpdateNguonDon
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateNguonDon($id,$request)
    {
        DonThuTable::UpdateNguonDon($id,$request);
    }

    /**************************************************
    Function Name	: UpdateSoLan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateSoLan($id,$request)
    {
        DonThuTable::UpdateSoLan($id,$request);
    }

    /**************************************************
    Function Name	: UpdateDonNhieuNguoi
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateDonNhieuNguoi($id,$request)
    {
        DonThuTable::UpdateDonNhieuNguoi($id,$request);
    }

    /**************************************************
    Function Name	: UpdateVanBanDinhKem
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function UpdateVanBanDinhKem($id,$request)
    {
        DonThuTable::UpdateVanBanDinhKem($id,$request);
    }

    /**************************************************
    Function Name	: UpdateVanBanDinhKem
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateScanPhieuHuongDan($id,$request)
    {
        PhanLoaiDonThuTable::updateScanPhieuHuongDan($id,$request);
    }

    /**************************************************
    Function Name	: updateCongVanChuyenDon
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateCongVanChuyenDon($id,$request)
    {
        PhanLoaiDonThuTable::updateCongVanChuyenDon($id,$request);
    }

    /**************************************************
    Function Name	: updateThongBaoChuyenDon
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateThongBaoChuyenDon($id,$request)
    {
        PhanLoaiDonThuTable::updateThongBaoChuyenDon($id,$request);
    }

    /**************************************************
    Function Name	: updateVanBanYeuCauXuLy
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateVanBanYeuCauXuLy($id,$request)
    {
        PhanLoaiDonThuTable::updateVanBanYeuCauXuLy($id,$request);
    }

    /**************************************************
    Function Name	: updateFilePhieuTrinh
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateFilePhieuTrinh($id,$request)
    {
        TheoDoiDonThuTable::updateFilePhieuTrinh($id,$request);
    }

    /**************************************************
    Function Name	: updateFileTBTL
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateFileTBTL($id,$request)
    {
        TheoDoiDonThuTable::updateFileTBTL($id,$request);
    }

    /**************************************************
    Function Name	: updateVanBanGiaiQuyet
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateVanBanGiaiQuyet($id,$request)
    {
        KetQuaGiaiQuyetTable::updateVanBanGiaiQuyet($id,$request);
    }

    /**************************************************
    Function Name	: updateFileTBGQCD
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateFileTBGQCD($id,$request)
    {
        TheoDoiDonThuTable::updateFileTBGQCD($id,$request);
    }

    /**************************************************
    Function Name	: updateFileQDXM
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateFileQDXM($id,$request)
    {
        GiaoXacMinhTable::updateFileQDXM($id,$request);
    }

    /**************************************************
    Function Name	: updateHuongGiaiQuyet
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateHuongGiaiQuyet($id,$request)
    {
        PhanLoaiDonThuTable::updateHuongGiaiQuyet($id,$request);
    }


    /**************************************************
    Function Name	: UpdateVanBanDinhKem
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDanhSachDoiTuongKhieuNai()
    {
        $result = DoiTuongKhieuNaiToCaoTable::GetDanhSachDoiTuongKhieuNai();
        return $result;
    }

    /**************************************************
    Function Name	: ThemDoiTuongKhieuNaiToCao
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function ThemDoiTuongKhieuNaiToCao($request)
    {
        $result = DoiTuongKhieuNaiToCaoTable::StoreDoiTuongKhieuNaiToCao($request);
        return $result;
    }

    /**************************************************
    Function Name	: GetDonThuTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDonThuTheoID($id)
    {
        $result = DonThuTable::GetDonThuTheoID($id);
        return $result;
    }

    /**************************************************
    Function Name	: GetDoiTuongKhieuNaiTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDoiTuongKhieuNaiTheoID($id)
    {
        $result = DoiTuongKhieuNaiToCaoTable::GetDoiTuongKhieuNaiTheoID($id);
        return $result;
    }

    /**************************************************
    Function Name	: getSearchDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function getSearchDonThu($searchValue)
    {
        $result = DonThuTable::getDataSearch($searchValue);
        return $result;
    }


    /**************************************************
    Function Name	: createDonThuXacMinh
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
//    public static function createDonThuXacMinh($request)
//    {
//        $sothuly = $request->sothuly;
//        $ngaynhan = $request->ngaynhan;
//        $group = $request->group;
//        $tennguoiviet = $request->tennguoiviet;
//        $diachi = $request->diachi;
//        $chungminhthunhandan = $request->cmt;
//        $ngaycap = $request->ngaycap;
//        $noicap = $request->noicap;
//        $lankhieunai = $request->lankhieunai;
//        $loaidon = $request->loaidon;
//        $linhvuc = $request->linhvuc;
//        $diaban = $request->diaban;
//        $ngaybatdau = $request->ngaybatdau;
//        $ngayketthuc = $request->ngayketthuc;
//        $donvi = $request->donvi;
//        $noidungdon = $request->noidungdon;
//        $noidungxacminh = $request->noidungxacminh;
//        $file = "";
//
//
//        //create direction
//        $input = Input::all();
//
//
//        $file1 = array_get($input,'filexacminh');
//        if($sothuly!=null)
//        {
//            $name = explode('/',$sothuly);
//            $folder_name ="donthuxacminh_".$name[0]."_".$name[1];
//        }
//        else
//        {
//            $folder_name ="donthuxacminh_";
//        }
//
//        $file_path = FOLDERROOT."/file/".$folder_name;
//        $linkfile = '/file'.'/'.$folder_name;
//        // $temp = " ";
//
//        if($file1!=null)
//        {
////            if(!is_dir($file_path)) {
////                mkdir($file_path, 0700);
////            }
//
//            // RENAME THE UPLOAD WITH RANDOM NUMBER
//            $fileName = $file1->getClientOriginalName();
//            // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
//            $file1->move($file_path, $fileName);
//            $file = $fileName;
//        }
//        $donthuid = DonThuTable::insertDonThuXacMinh($sothuly, $ngaybatdau, $ngayketthuc, $donvi, $noidungxacminh,
//            $file,$linkfile,$ngaynhan,$tennguoiviet,$diachi,$chungminhthunhandan,$ngaycap,$noicap,$lankhieunai,$group);
//        $result = DonThuTable::insertPhanLoaiDonThu($sothuly, $loaidon, $linhvuc, $diaban,$donthuid);
//        $result = DonThuTable::updateDonThu($sothuly, $tennguoiviet, $diachi, $chungminhthunhandan, $ngaycap,
//            $noicap, $lankhieunai, $noidungdon, $group,$donthuid);
//        return $result;
//
//    }

    /**************************************************
    Function Name	: getSoThuLyDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function getSoThuLyDonThu()
    {
        $result = DonThuTable::getSoThuLyDonThu();
        if($result!=null)
        {
            $result = $result->donthuid;
        }
        else
        {
            $result = null;
        }

        return $result;
    }

    /**************************************************
    Function Name	: getChinhSua
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function getChinhSua($donthuid)
    {
        $result = DonThuTable::getDataChinhSua($donthuid);
        return $result;
    }
    /**************************************************
    Function Name	: changeDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function changeDonThu($request)
    {
        $sothuly = $request->sothuly;
        $ngayviet = $request->ngayviet;
        $ngaynhan = $request->ngaynhan;
        $nguondon = $request->nguondon;
        $cvden = $request->cvden;
        $ngaychuyen = $request->ngaychuyen;
        $coquan = $request->coquan;
        $group = $request->group;
        $tennguoiviet = $request->tennguoiviet;
        $lan = $request->lan;
        $dtkntc = $request->dtkntc;
        $giaiquyet = $request->giaiquyet;
        $noidung = $request->noidungdon;
        $cmt = $request->cmt;
        $ngaycap = $request->ngaycap;
        $noicap = $request->noicap;
        $diachi = $request->diachi;
        $file = "";
        $inputfile = $request->datatemp;
        $datatable = $request->tabletemp;
        $arrayinput = explode(".",$inputfile);

        //create direction
        $input = Input::all();


        for($var = 0; $var < count($arrayinput); $var++)
        {
            $file1 = array_get($input,$arrayinput[$var]);
            $vbuyquyen = array_get($input,'vbuyquyen');
            if($sothuly!=null)
            {
                $name = explode('/',$sothuly);
                $folder_name ="donthu_".$name[0]."_".$name[1];
            }
            else
            {
                $folder_name ="donthu_";
            }

            $file_path = FOLDERROOT."/file/".$folder_name;
            $linkfile = '/file'.'/'.$folder_name;
            // $temp = " ";
//            if(!is_dir($file_path)) {
//                mkdir($file_path, 0700);
//            }
            /* file attach*/
            if($file1!=null)
            {
                // RENAME THE UPLOAD WITH RANDOM NUMBER
                $fileName = $file1->getClientOriginalName();
                // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
                $file1->move($file_path, $fileName);
                $file[count($file)] = $fileName;
            }

            /* van ban uy quyen*/
            $filevVanban = "";
            if($vbuyquyen!=null)
            {
                $filevVanban= $vbuyquyen->getClientOriginalName();
                $vbuyquyen->move($folder_name, $filevVanban);
            }

        }
        if($file != "")
        {
            $file = implode("/", $file);
        }
        //data table
        if($datatable!=null)
        {
            $datatable = explode('.',$datatable);
        }
        $result = DonThuTable::saveDonThu($sothuly,$ngayviet,$ngaynhan,$nguondon,$cvden,$ngaychuyen,$coquan,$group,$tennguoiviet
            ,$lan,$dtkntc,$giaiquyet,$noidung,$file,$datatable,$cmt,$ngaycap,$noicap,$diachi,$filevVanban,$linkfile);
        return $result;

    }
    /**************************************************
    Function Name	: getdanhsachdonthuxacminh
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function getdanhsachdonthuxacminh($request)
    {
        $next = 0;
        $nextall = 1;
        $prev = 2;
        $prevall = 3;
        $trangthai = $request->trangthai;
        $viewby = $request->viewby;
        $lasttable = $request->lasttable;
        $action = $request->action;
        $arrayxacminh = DonThuTable::getdatadonthu('giaoxacminh','trangthai',$trangthai);

        $arraydata = null;
        $count = 0;

        if($action == $next) {
            if ($lasttable < count($arrayxacminh)) {
                for ($i = $lasttable; $i < count($arrayxacminh); $i++) {
                    if ($count < $viewby) {
                        $data = DonThuTable::getdatadonthu('donthu', 'sothuly', $arrayxacminh[$i]->sothuly);
                        //return  $arrayxacminh[$i]->sothuly;
                        $arraydata[$count]['sothuly'] = $arrayxacminh[$i]->sothuly;
                        $arraydata[$count]['nguoiviet'] = $data[count($data) - 1]->tennguoivietdon;
                        $arraydata[$count]['diachi'] = $data[count($data) - 1]->diachinguoiviet;
                        $arraydata[$count]['ngaygui'] = $data[count($data) - 1]->ngaynhan;
                        $arraydata[$count]['ngaybatdau'] = $arrayxacminh[$i]->ngaybatdau;
                        $arraydata[$count]['ngayketthuc'] = $arrayxacminh[$i]->ngayketthuc;
                        $arraydata[$count]['ngayketthucxacminh'] = $arrayxacminh[$i]->ngayketthucxacminh;
                        $arraydata[$count]['noidungdonthu'] = $data[count($data) - 1]->noidung;
                        $arraydata[$count]['noidungxacminh'] = $arrayxacminh[$i]->noidung;
                        $count++;
                    }
                }
            }
            $lasttable = $lasttable + $count;
        }
        else if($action == $nextall)
        {
            if(count($arrayxacminh) > $viewby)
            {
                $lasttable =count($arrayxacminh) - $viewby;
            }
            else
            {
                $lasttable = 0;
            }
            if ($lasttable < count($arrayxacminh)) {
                for ($i = $lasttable; $i < count($arrayxacminh); $i++) {
                    if ($count < $viewby) {
                        $data = DonThuTable::getdatadonthu('donthu', 'sothuly', $arrayxacminh[$i]->sothuly);
                        //return  $arrayxacminh[$i]->sothuly;
                        $arraydata[$count]['sothuly'] = $arrayxacminh[$i]->sothuly;
                        $arraydata[$count]['nguoiviet'] = $data[count($data) - 1]->tennguoivietdon;
                        $arraydata[$count]['diachi'] = $data[count($data) - 1]->diachinguoiviet;
                        $arraydata[$count]['ngaygui'] = $data[count($data) - 1]->ngaynhan;
                        $arraydata[$count]['ngaybatdau'] = $arrayxacminh[$i]->ngaybatdau;
                        $arraydata[$count]['ngayketthuc'] = $arrayxacminh[$i]->ngayketthuc;
                        $arraydata[$count]['ngayketthucxacminh'] = $arrayxacminh[$i]->ngayketthucxacminh;
                        $arraydata[$count]['noidungdonthu'] = $data[count($data) - 1]->noidung;
                        $arraydata[$count]['noidungxacminh'] = $arrayxacminh[$i]->noidung;
                        $count++;
                    }
                }
            }
            $lasttable = $lasttable + $count;
        }
        else if($action == $prev)
        {
            $limit = 0;
            if(count($arrayxacminh) > $viewby)
            {
                $limit = count($arrayxacminh)-$viewby;
            }
            for($i = $lasttable; $i > $limit; $i--)
            {
                if ($count < $viewby) {
                    $data = DonThuTable::getdatadonthu('donthu', 'sothuly', $arrayxacminh[$i]->sothuly);
                    //return  $arrayxacminh[$i]->sothuly;
                    $arraydata[$count]['sothuly'] = $arrayxacminh[$i]->sothuly;
                    $arraydata[$count]['nguoiviet'] = $data[count($data) - 1]->tennguoivietdon;
                    $arraydata[$count]['diachi'] = $data[count($data) - 1]->diachinguoiviet;
                    $arraydata[$count]['ngaygui'] = $data[count($data) - 1]->ngaynhan;
                    $arraydata[$count]['ngaybatdau'] = $arrayxacminh[$i]->ngaybatdau;
                    $arraydata[$count]['ngayketthuc'] = $arrayxacminh[$i]->ngayketthuc;
                    $arraydata[$count]['ngayketthucxacminh'] = $arrayxacminh[$i]->ngayketthucxacminh;
                    $arraydata[$count]['noidungdonthu'] = $data[count($data) - 1]->noidung;
                    $arraydata[$count]['noidungxacminh'] = $arrayxacminh[$i]->noidung;
                    $count++;
                }
            }
            $lasttable = $lasttable - $count;
        }
        else if($action == $prevall)
        {
            if ($lasttable < count($arrayxacminh)) {
                for ($i = $lasttable; $i < count($arrayxacminh); $i++) {
                    if ($count < $viewby) {
                        $data = DonThuTable::getdatadonthu('donthu', 'sothuly', $arrayxacminh[$i]->sothuly);
                        //return  $arrayxacminh[$i]->sothuly;
                        $arraydata[$count]['sothuly'] = $arrayxacminh[$i]->sothuly;
                        $arraydata[$count]['nguoiviet'] = $data[count($data) - 1]->tennguoivietdon;
                        $arraydata[$count]['diachi'] = $data[count($data) - 1]->diachinguoiviet;
                        $arraydata[$count]['ngaygui'] = $data[count($data) - 1]->ngaynhan;
                        $arraydata[$count]['ngaybatdau'] = $arrayxacminh[$i]->ngaybatdau;
                        $arraydata[$count]['ngayketthuc'] = $arrayxacminh[$i]->ngayketthuc;
                        $arraydata[$count]['ngayketthucxacminh'] = $arrayxacminh[$i]->ngayketthucxacminh;
                        $arraydata[$count]['noidungdonthu'] = $data[count($data) - 1]->noidung;
                        $arraydata[$count]['noidungxacminh'] = $arrayxacminh[$i]->noidung;
                        $count++;
                    }
                }
            }
            $lasttable = $lasttable + $count;
        }

        $arrayresult = array(
            'arraydata' => $arraydata,
            'lasttable' => $lasttable,
            'trangthai' => $trangthai
        );
        return $arrayresult;

    }

    /**************************************************
    Function Name	: getdanhsachdonthu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function getdanhsachdonthu($request)
    {
        $next = 0;
        $nextall = 1;
        $prev = 2;
        $prevall = 3;
        $changeview = 4;
        $trangthai = $request->trangthai;
        $viewby = $request->viewby;
        $lasttable = $request->lasttable;
        $action = $request->action;
        $acountid = $request->acountid;
        $starttable = $request->starttable;

        $acountinfo = AccountInfoTable::GetAccountInfoTheoID($acountid);


        $diabanid = $acountinfo[0]->diaban;
//        $diabaninfo = DiaBanTable::GetThongTinDiaBanTheoID($diabanid);
//
//        $tructhuocid = $diabaninfo[0]->tructhuoc;


        $diabanarray = DiaBanTable::GetDiaBanTrucThuoc($diabanid);

        $arraydonthu = DonThuTable::getdatadonthu('donthu','trangthaixuly',$trangthai, $diabanarray);
        $maxindex = count($arraydonthu);



        $arraydata = null;
        $count = 0;
        //return $arraydonthu;

        if($action == $next) {
//            return "1";
            if ($lasttable < count($arraydonthu)) {
//                $data = DonThuTable::getdatadonthu('donthu', 'trangthaixuly', $trangthai,$diabanarray);
                for ($i = $lasttable; $i < count($arraydonthu); $i++) {
                    if ($count < $viewby) {
                        $arraydata[$count]['sothuly'] = $arraydonthu[$i]->sothuly;
                        $arraydata[$count]['nguoiviet'] = $arraydonthu[$i]->tennguoivietdon;
                        $arraydata[$count]['diachi'] = $arraydonthu[$i]->diachinguoiviet;
                        $arraydata[$count]['ngaygui'] = $arraydonthu[$i]->ngaynhan;
                        $arraydata[$count]['noidungdonthu'] = $arraydonthu[$i]->noidung;
                        $arraydata[$count]['trangthai'] = $arraydonthu[$i]->trangthaixuly;
                        $arraydata[$count]['donthuid'] = $arraydonthu[$i]->donthuid;
                        $count++;
                    }
                }
                $lasttable = $lasttable + $count;
            }
        }
        else if($action == $nextall)
        {
            if(count($arraydonthu) > $viewby)
            {
                $lasttabletemp = count($arraydonthu) - $viewby;
                if($lasttable > $lasttabletemp)
                {
                    $lasttable = $lasttable;
                }
                else
                {
                    $lasttable = $lasttabletemp;
                }
            }
            else
            {
                $lasttable = 0;
            }
            if ($lasttable < count($arraydonthu)) {
//                $data = DonThuTable::getdatadonthu('donthu', 'trangthaixuly', $trangthai,$diabanarray);
                for ($i = $lasttable; $i < count($arraydonthu); $i++) {
                    if ($count < $viewby) {
//                        $data = DonThuTable::getdatadonthu('donthu', 'sothuly', $arraydonthu[$i]->sothuly,$diabanarray);
                        $arraydata[$count]['sothuly'] = $arraydonthu[$i]->sothuly;
                        $arraydata[$count]['nguoiviet'] = $arraydonthu[$i]->tennguoivietdon;
                        $arraydata[$count]['diachi'] = $arraydonthu[$i]->diachinguoiviet;
                        $arraydata[$count]['ngaygui'] = $arraydonthu[$i]->ngaynhan;
                        $arraydata[$count]['noidungdonthu'] = $arraydonthu[$i]->noidung;
                        $arraydata[$count]['trangthai'] = $arraydonthu[$i]->trangthaixuly;
                        $arraydata[$count]['donthuid'] = $arraydonthu[$i]->donthuid;
                        $count++;
                    }
                }
                $lasttable = $lasttable + $count;
            }
        }
        else if($action == $prev)
        {

            $limit = 0;
            if($lasttable > 0 && $lasttable > $viewby) {
//                if (count($arraydonthu) > $viewby) {
//                    $limit = count($arraydonthu) - $viewby;
//                }
              $limit = $lasttable - $viewby;
                for ($i = $lasttable-1; $i > $limit-1; $i--) {
                    if ($count < $viewby) {
//                    $data = DonThuTable::getdatadonthu('donthu', 'sothuly', $arraydonthu[$i]->sothuly);
                        //return  $arrayxacminh[$i]->sothuly;
                        $arraydata[$count]['sothuly'] = $arraydonthu[$i]->sothuly;
                        $arraydata[$count]['nguoiviet'] = $arraydonthu[$i]->tennguoivietdon;
                        $arraydata[$count]['diachi'] = $arraydonthu[$i]->diachinguoiviet;
                        $arraydata[$count]['ngaygui'] = $arraydonthu[$i]->ngaynhan;
                        $arraydata[$count]['noidungdonthu'] = $arraydonthu[$i]->noidung;
                        $arraydata[$count]['trangthai'] = $arraydonthu[$i]->trangthaixuly;
                        $arraydata[$count]['donthuid'] = $arraydonthu[$i]->donthuid;
                        $count++;
                    }
                }
            }
            if($lasttable == $count)
            {
                $lasttable = $count;
            }
            else{
                $lasttable = $lasttable - $count + 1;
            }
        }
        else if($action == $prevall)
        {
            if ($lasttable < count($arraydonthu)) {
//                $data = DonThuTable::getdatadonthu('donthu', 'trangthaixuly', $trangthai,$diabanarray);
                for ($i = 0; $i < count($arraydonthu); $i++) {
                    if ($count < $viewby) {
//                        $data = DonThuTable::getdatadonthu('donthu', 'sothuly', $arraydonthu[$i]->sothuly);
                        //return  $arrayxacminh[$i]->sothuly;
                        $arraydata[$count]['sothuly'] = $arraydonthu[$i]->sothuly;
                        $arraydata[$count]['nguoiviet'] = $arraydonthu[$i]->tennguoivietdon;
                        $arraydata[$count]['diachi'] = $arraydonthu[$i]->diachinguoiviet;
                        $arraydata[$count]['ngaygui'] = $arraydonthu[$i]->ngaynhan;
                        $arraydata[$count]['noidungdonthu'] = $arraydonthu[$i]->noidung;
                        $arraydata[$count]['trangthai'] = $arraydonthu[$i]->trangthaixuly;
                        $arraydata[$count]['donthuid'] = $arraydonthu[$i]->donthuid;
                        $count++;
                    }
                }
                $lasttable = $viewby;
            }
        }
        else if($action = $changeview)
        {
            $count = 0;
            for ($i = $starttable; $i < count($arraydonthu); $i++) {
                if ($count < $viewby) {
//                        $data = DonThuTable::getdatadonthu('donthu', 'sothuly', $arraydonthu[$i]->sothuly,$diabanarray);
                    $arraydata[$count]['sothuly'] = $arraydonthu[$i]->sothuly;
                    $arraydata[$count]['nguoiviet'] = $arraydonthu[$i]->tennguoivietdon;
                    $arraydata[$count]['diachi'] = $arraydonthu[$i]->diachinguoiviet;
                    $arraydata[$count]['ngaygui'] = $arraydonthu[$i]->ngaynhan;
                    $arraydata[$count]['noidungdonthu'] = $arraydonthu[$i]->noidung;
                    $arraydata[$count]['trangthai'] = $arraydonthu[$i]->trangthaixuly;
                    $arraydata[$count]['donthuid'] = $arraydonthu[$i]->donthuid;
                    $count++;
                }
            }
            $lasttable = $starttable + $count;
        }

        if($lasttable > $viewby)
        {
            $starttable = $lasttable - $viewby;
        }
        else
        {
            $starttable = 0;
        }
        $arrayresult = array(
            'arraydata' => $arraydata,
            'lasttable' => $lasttable,
            'trangthai' => $trangthai,
            'starttable' => $starttable,
            'viewby'    => $viewby,
            'arraydonthu'=>$arraydonthu,
            'maxindex'  => $maxindex
        );
        return $arrayresult;
    }
    /**************************************************
    Function Name	: getChiTietDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function getChiTietDonThu($donthuid)
    {
        $result = DonThuTable::getDataChiTiet($donthuid);
        return $result;
    }

    /**************************************************
    Function Name	: getChiTietDonThuXacMinh
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
//    public static function getChiTietDonThuXacMinh($sothuly)
//    {
//        $array = explode("-",$sothuly);
//        if(count($array) == 2)
//        {
//            $sothuly = implode("/",$array);
//        }
//        $result = DonThuTable::getdatadonthu('giaoxacminh','sothuly',$sothuly);
//        return $result[0];
//    }
    /**************************************************
    Function Name	: getDanhSachUser
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function getDanhSachUser($donvi)
    {
        $result = AccountInfoTable::GetDataUserInfo($donvi);
        return $result;
    }
    /**************************************************
    Function Name	: CapNhatXacMinh
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
//    public static function CapNhatXacMinh($request)
//    {
//        $chuaKetThuc = 0;
//        $tvXacMinh = "";
//
//        $sothuly = $request->sothuly;
//        $truongdoan = $request->cboTruongDoanXM;
//        $phodoan = $request->cboPhoDoanXM;
//
//        if($request->lstThanhVienXM != null)
//        {
//            $tvXacMinh = $request->lstThanhVienXM;
//        }
//
//        $ketqua = $request->cboKetThuc;
//
//        $file = "";
//        $txtKetQuaXM = "";
//        $txtKetLuanXM = "";
//        $txtKienNghiBHQDGQ = "";
//        $arrayinput =array("fileQDTLDXM","fileBienBanGapGoDoiThoai","fileDSTLDoNguoiKNCungCap","fileBaoCaoKQXacMinh");
//
//        //create direction
//        $input = Input::all();
//
//
//        for($var = 0; $var < count($arrayinput); $var++)
//        {
//            $file1 = array_get($input,$arrayinput[$var]);
//            if($sothuly!=null)
//            {
//                $name = explode('/',$sothuly);
//                $folder_name ="donthuxacminh_".$name[0]."_".$name[1];
//            }
//            else
//            {
//                $folder_name ="donthuxacminh_";
//            }
//
//            $file_path = FOLDERROOT."/file/".$folder_name;
//            $linkfile = '/file'.'/'.$folder_name;
//            // $temp = " ";
////            if(!is_dir($file_path)) {
////                mkdir($file_path, 0700);
////            }
//            /* file attach*/
//            if($file1!=null)
//            {
//                // RENAME THE UPLOAD WITH RANDOM NUMBER
//                $fileName = $file1->getClientOriginalName();
//                // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
//                $file1->move($file_path, $fileName);
//                $file[$var] = $fileName;
//            }
//            else
//            {
//                $file[$var] = "";
//            }
//            //$count++;
//        }
//        $fileQDTLDXM = $file[0];
//        $fileBienBanGapGoDoiThoai = $file[1];
//        $fileDSTLDoNguoiKNCungCap = $file[2];
//        $fileBaoCaoKQXacMinh = $file[3];
//
//        if($ketqua != $chuaKetThuc)
//        {
//            $txtKetQuaXM = $request->txtKetQuaXM;
//            $txtKetLuanXM = $request->txtKetLuanXM;
//            $txtKienNghiBHQDGQ = $request->txtKienNghiBHQDGQ;
//        }
//
//        DonThuTable::InsertDoanXacMinh($sothuly, $truongdoan, $phodoan,
//            $tvXacMinh,$fileQDTLDXM,
//            $fileBienBanGapGoDoiThoai, $fileDSTLDoNguoiKNCungCap,$linkfile);
//
//        $date = date("Y-m-d");
//        DonThuTable::UpdateGiaoXacMinh($sothuly,$ketqua,$fileBaoCaoKQXacMinh,
//            $txtKetQuaXM,$txtKetLuanXM,$txtKienNghiBHQDGQ,$date,$linkfile);
//
//
//        return null;
//    }
    /**************************************************
    Function Name	: postPhanLoaiDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function postPhanLoaiDonThu($request)
    {
        $sothuly = $request->sothuly;
        $loaidon = $request->loaidon;
        $linhvuc = $request->linhvuc;
        $diaban = $request->diaban1;
        $huonggiaiquyet = $request->huonggiaiquyet;
        $chuyendi = $request->chuyendi;
        $donvichuyendon = $request->donvichuyendon;
        $dexuatphieutrinh = $request->dexuatphieutrinh;
        $nguoixuly = $request->nguoixuly;


        $file = "";
        $arrayinput =array("scanphieuhd","cvchuyendon","tbchuyendon","yeucauxl");

        //create direction
        $input = Input::all();


        for($var = 0; $var < count($arrayinput); $var++)
        {
            $file1 = array_get($input,$arrayinput[$var]);
            if($sothuly!=null)
            {
                $name = explode('/',$sothuly);
                $folder_name ="phanloai".$name[0]."_".$name[1];
            }
            else
            {
                $folder_name ="";
            }

            $file_path = FOLDERROOT."/file/".$folder_name;
             $linkfile = '/file'.'/'.$folder_name;
//            if(!is_dir($file_path)) {
//                mkdir($file_path, 0700);
//            }
            /* file attach*/
            if($file1!=null)
            {
                // RENAME THE UPLOAD WITH RANDOM NUMBER
                $fileName = $file1->getClientOriginalName();
                // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
                $file1->move($file_path, $fileName);
                $file[$var] = $fileName;
            }
            else
            {
                $file[$var] = "";
            }
            //$count++;
        }

        $filePhieuHD = $file[0];
        $fileCVChuyenDon = $file[1];
        $fileTBChuyenDon = $file[2];
        $fileYeuCauXL = $file[3];

        $data = DonThuTable::savePhanLoaiDonThu($sothuly,$loaidon,$linhvuc,$diaban,$huonggiaiquyet,$chuyendi,$donvichuyendon,$dexuatphieutrinh,
               $nguoixuly,$filePhieuHD,$fileCVChuyenDon,$fileTBChuyenDon,$fileYeuCauXL,$folder_name,$linkfile);
        return $data;
    }

    /**************************************************
    Function Name	: updatePhanLoaiDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updatePhanLoaiDonThu($request)
    {
        $data = PhanLoaiDonThuTable::updatePhanLoaiDonThu($request);
        return $data;
    }

    /**************************************************
    Function Name	: getNameFile
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function getNameFile($request)
    {
        $sothuly = $request->sothuly;
        $data =DonThuTable::getDataFileDonThu($sothuly);
        return $data;
    }
    /**************************************************
    Function Name	: DeleteFile
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function DeleteFile($request)
    {
        $sothuly = $request->sothuly;
        $table = $request->tablefile;
        $position = $request->position;

        $result = DonThuTable::fileDelete($sothuly,$table,$position);
        return $result;
    }

    /**************************************************
    Function Name	: LuuTheoDoiDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function LuuTheoDoiDonThu($request)
    {


        $sothuly = $request->sothuly;
        $ngayQD = $request->ngayQD;
        $tomtatQDXL = $request->tomtatQDXL;

        $ngaybatdau = $request->ngaybatdau;
        $ngayketthuc = $request->ngayketthuc;
        $donvi = $request->donvi1;
        $noidunggiaoXM = $request->noidunggiaoXM;


        //upload file
        $file = "";
        $fileQDXM = "";
        $arrayinput =array("filephieutrinh","fileTBTL","fileTBGQCD");

        //create direction
        $input = Input::all();
        if($sothuly!=null)
        {
            $name = explode('/',$sothuly);
            $folder_name ="theodoidonthu_".$name[0]."_".$name[1];
            $folder ="donthuxacminh_".$name[0]."_".$name[1];
        }
        else
        {
            $folder_name ="";
        }
        $file_path = FOLDERROOT."/file/".$folder_name;
        $file_pathXM = FOLDERROOT."/file/".$folder;
        $linkfile = '/file'.'/'.$folder_name;
        $linkfileXM = '/file'.'/'.$folder;

        $fileXM = array_get($input,'fileQDXM');
        if($fileXM != null)
        {
            $fileNameXM = $fileXM->getClientOriginalName();
            $fileXM->move($file_pathXM, $fileNameXM);
            $fileQDXM = $fileNameXM;
        }


        for($var = 0; $var < count($arrayinput); $var++)
        {
            $file1 = array_get($input,$arrayinput[$var]);
//            if(!is_dir($file_path)) {
//                mkdir($file_path, 0700);
//            }
            /* file attach*/
            if($file1!=null)
            {
                // RENAME THE UPLOAD WITH RANDOM NUMBER
                $fileName = $file1->getClientOriginalName();
                // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
                $file1->move($file_path, $fileName);
                $file[$var] = $fileName;
            }
            else
            {
                $file[$var] = "";
            }
            //$count++;
        }
        $filephieutrinh = $file[0];
        $fileTBTL = $file[1];
        $fileTBGQCD = $file[2];
        //$fileQDXM = $file[3];

        $result = DonThuTable::SaveTheoDoiDonThu($sothuly,$ngayQD,$tomtatQDXL,$filephieutrinh,$fileTBTL,$fileTBGQCD,$ngaybatdau,
            $ngayketthuc,$donvi,$noidunggiaoXM,$fileQDXM,$linkfile,$linkfileXM);

        return $result;
    }

    /**************************************************
    Function Name	: updateTheoDoiDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateTheoDoiDonThu($request)
    {
        $result = TheoDoiDonThuTable::updateTheoDoiDonThu($request);

        return $result;
    }

    /**************************************************
    Function Name	: updateGiaoXacMinh
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateGiaoXacMinh($request)
    {
        $result = GiaoXacMinhTable::updateGiaoXacMinh($request);

        return $result;
    }

    /**************************************************
    Function Name	: LuuGiaiQuyetDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function LuuGiaiQuyetDonThu($request)
    {
        $sothuly = $request->sothuly;
        $soquyetdinh = $request->soquyetdinh;
        $ngayquyetdinh = $request->ngayquyetdinh;
        $tieude = $request->tieude;
        $ketquanoidung = $request->ketquanoidung;
        $danhgiadonthu = $request->danhgiadonthu;
        $phaithutien = $request->phaithutien;
        $phaitratien = $request->phaitratien;
        $phaithudat = $request->phaithudat;
        $phaitradat = $request->phaitradat;

        /*upload file*/
        $file ="";
        $input = Input::all();

        $file1 = array_get($input,'vbgiaiquyet');
        if($sothuly!=null)
        {
            $name = explode('/',$sothuly);
            $folder_name ="vbgiaiquyet".$name[0]."_".$name[1];
        }
        else
        {
            $folder_name ="";
        }

        $file_path = FOLDERROOT."/file/".$folder_name;
        $linkfile = '/file'.'/'.$folder_name;
//        if(!is_dir($file_path)) {
//            mkdir($file_path, 0700);
//        }
        /* file attach*/
        if($file1!=null)
        {
            // RENAME THE UPLOAD WITH RANDOM NUMBER
            $fileName = $file1->getClientOriginalName();
            // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
            $file1->move($file_path, $fileName);
            $file = $fileName;
        }

        $result = DonThuTable::GiaiQuyetDonThu($sothuly,$soquyetdinh,$ngayquyetdinh,$tieude,$ketquanoidung,$danhgiadonthu,
            $phaithutien,$phaitratien,$phaithudat,$phaitradat,$file,$linkfile);

        return $result;
    }

    /**************************************************
    Function Name	: LuuGiaiQuyetDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateGiaiQuyetDonThu($request)
    {
        $result = KetQuaGiaiQuyetTable::updateGiaiQuyetDonThu($request);

        $donthuid = $request->donthuid;

        if($request->dinhchikn !=null)
        {
            ThongTinRutDonThuTable::updateDinhChiGiaiQuyetKhieuNai($donthuid,$request->dinhchikn);
        }

        if($request->chamduttc !=null)
        {
            ThongTinRutDonThuTable::updateChamDutToCao($donthuid,$request->chamduttc);
        }

        return $result;
    }

    /**************************************************
    Function Name	: LuuKetThuc
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function LuuKetThuc($request)
    {
        $result = DonThuTable::KetThucDonThu($request);

        return $result;
    }
    /**************************************************
    Function Name	: checkEdit
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function CheckEdit($request)
    {
        $value = $request->thuly;
        $phanloai = $request->table1;
        $theodoi = $request->table2;
        $giaiquyet = $request->table3;
        $result = DonThuTable::EditCheck($value,$phanloai,$theodoi,$giaiquyet);
        return $result;
    }

    /**************************************************
    Function Name	: GetFullName
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetFullName()
    {
        $name = DonThuTable::GetName();
        return $name;
    }
    /**************************************************
    Function Name	: GetPhanLoai
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetPhanLoai()
    {
        $data = DonThuTable::DataPhanLoai();
        return $data;
    }
    /**************************************************
    Function Name	: GetPhanLoai
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDiaBan()
    {
        $result = DonThuTable::DataDiaBan();
        return $result;
    }

    /**************************************************
    Function Name	: getTenDiaBan
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function getTenDiaBan($id)
    {
        $tendiaban = DiaBanTable::GetTenDiaBan($id);
        return $tendiaban;
    }

    /**************************************************
    Function Name	: getTenDonVi
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function getTenDonVi($id)
    {
        $tendonvi = DonViTable::GetTenDonVi($id);
        return $tendonvi;
    }

    /**************************************************
    Function Name	: getDanhSachNhanVien
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getDanhSachNhanVien()
    {
        $result = AccountInfoTable::getDanhSachNhanVien();
        return $result;
    }

    /**************************************************
    Function Name	: countMailbox
    Description		:
    Argument		: $accountid
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function countMailbox($accountid)
    {
        $result = MailboxTable::countMailbox($accountid);
        return $result;
    }

    /**************************************************
    Function Name	: getMailbox
    Description		:
    Argument		: $accountid
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getMailbox($accountid, $type, $chonHienThiSoLuong)
    {
        $result = MailboxTable::getMailbox($accountid, $type, $chonHienThiSoLuong);
        return $result;
    }

    /**************************************************
    Function Name	: countHopThu
    Description		:
    Argument		: $accountid
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function countHopThu($accountid, $loaithu)
    {
        $result = MailboxTable::countHopThu($accountid, $loaithu);
        return $result;
    }

    /**************************************************
    Function Name	: xoaMailboxTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function xoaMailboxTheoID($id)
    {
        $result = MailboxTable::xoaMailboxTheoID($id);
        return $result;
    }

    /**************************************************
    Function Name	: getEmailTheoID
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getEmailTheoID($id)
    {
        $result = MailboxTable::getEmailTheoID($id);
        return $result;
    }

    /**************************************************
    Function Name	: updateStatusEmail
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateStatusEmail($id)
    {
       $result = MailboxTable::updateStatusEmail($id);

        return $result;
    }

    /**************************************************
    Function Name	: sendEmail
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function sendEmail($request)
    {
        $tennguoigui = AccountInfoTable::GetFullName($request->nguoigui);
        $tennguoinhan = AccountInfoTable::GetFullName($request->nguoinhan);
        $result = MailboxTable::sendEmail($request,$tennguoigui,$tennguoinhan);
        return $result;
    }

    /**************************************************
    Function Name	: assigneeNguoiXuLy
    Description		:
    Argument		: $donthuid,$sothuly,$nguoiguiid,$nguoinhanid
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function assigneeNguoiXuLy($donthuid,$sothuly,$nguoiguiid,$nguoi_xuly_id)
    {

        //get name nguoi dai dien
//        $nguoiDaiDien = DonViTable::GetThongTinDonViTheoID($donviId);

        $tennguoigui = AccountInfoTable::GetFullName($nguoiguiid);


        $tennguoinhan = AccountInfoTable::GetFullName($nguoi_xuly_id);


//        die;
        $title = '[Thông báo] Xử lý Đơn Thư Khiếu Nại Tố Cáo';
        $start = '<p>';
        $header = 'Chào anh/chị '.$tennguoinhan.'&nbsp;<br /><br />';
        $body = 'Hiện đang có đơn cần anh/chị giải quyết. Chi tiết đơn theo link bên dưới:'.'&nbsp;<br />';
        $donthulink = '<a href='.url('chitietdonthu').'/'.$donthuid.'>'.url('chitietdonthu').'/'.$donthuid.'</a>'.'&nbsp;<br /><br />';
        $footer = 'Xin cảm ơn'.'&nbsp;<br />';
        $chuky = $tennguoigui.'&nbsp;<br />';
        $end = '</p>';
        $noidung = array(
            'tennguoigui' => $tennguoigui,
            'tennguoinhan' => $tennguoinhan,
            'tieude' => $title,
            'noidung' => $start.$header.$body.$donthulink.$footer.$chuky.$end,
            'nguoiguiid' => $nguoiguiid,
            'nguoinhanid' => $nguoi_xuly_id
        );
        $result = MailboxTable::assigneeNguoiXuLy($noidung);
        return $result;
    }

    /**************************************************
    Function Name	: GetTongDonChuaGQ
    Description		:
    Argument		: None
    Creation Date	: 2016/09/20
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTongDonChuaGQ($diaBanIdAllArray)
    {
        $result = DonThuTable::DataTongDonChuaGQ($diaBanIdAllArray);

        return $result;
    }
    /**************************************************
    Function Name	: GetTongDonSixMonth
    Description		:
    Argument		: None
    Creation Date	: 2016/09/20
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTongDonSixMonth($diaBanIdAllArray)
    {
        $result = DonThuTable::DataTongDonSauThang($diaBanIdAllArray);

        return $result;
    }
    /**************************************************
    Function Name	: GetTongDonPhanLoai
    Description		:
    Argument		: None
    Creation Date	: 2016/09/20
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTongDonPhanLoai($diaBanIdAllArray)
    {
        $result = DonThuTable::DataTongDonPhanLoai($diaBanIdAllArray);

        return $result;
    }

    /**************************************************
    Function Name	: getAllDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getAllDonThu($diaBanIdAll)
    {
//        $result = DonThuTable::getAllDonThu($diabanId);
        $result = DonThuTable::GetDonThuTheoDiaBan($diaBanIdAll);
        return $result;
    }

    /**************************************************
    Function Name	: getPhanLoaiDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getPhanLoaiDonThu($diaBanIdAllArray)
    {
        $result = PhanLoaiDonThuTable::getPhanLoaiDonThu($diaBanIdAllArray);
        return $result;
    }

    /**************************************************
    Function Name	: getGiaoXacMinhDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getGiaoXacMinhDonThu()
    {
        $result = GiaoXacMinhTable::getGiaoXacMinhDonThu();
        return $result;
    }

    /**************************************************
    Function Name	: getKetQuaGiaiQuyetDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getKetQuaGiaiQuyetDonThu($phanloaidonthudata)
    {
        $result = KetQuaGiaiQuyetTable::getKetQuaGiaiQuyetDonThu($phanloaidonthudata);
        return $result;
    }

    /**************************************************
    Function Name	: getXuLyTheoDiaBan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getXuLyTheoDiaBan($diaban,$donthudata,$phanloaidonthudata,$diaBanIdAllArray)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = date("Y-m-d");
        $day_xl = 3;
        $day_qh = 10;
        $date_xuly = date("Y-m-d", strtotime("$today - $day_xl day"));
        $date_qh = date("Y-m-d", strtotime("$today - $day_qh day"));

        $thong_ke_xu_ly_theo_dia_ban = array();

        for($i = 1; $i<count($diaban);$i++){
            $diabanid = $diaban[$i]->id;
            $tendiaban = $diaban[$i]->tendiaban;

            $count_DH = 0;
            $count_QH = 0;
            $don_thu_dia_ban_xu_ly_DH = array();
            $don_thu_dia_ban_xu_ly_QH = array();
            //Xu Ly Theo Dia Ban
            for($j = 0; $j<count($phanloaidonthudata);$j++){

                if($donthudata[$j]->trangthaixuly == DANGXULY) {

                    $ngaynhan = $donthudata[$j]->ngaynhan;
                    if ($phanloaidonthudata[$j]->diaban == $diabanid) {

                        //Den Han
                        if($date_qh <= $ngaynhan && $ngaynhan <= $date_xuly){
//                        if ($today >= $ngaynhan && $ngaynhan >= $date_xuly) {

                            $don_thu_dia_ban_xu_ly_DH[$count_DH] = $donthudata[$j];

                            $count_DH++;

                        } //Qua Han
                        elseif ($ngaynhan < $date_qh) {

                            $don_thu_dia_ban_xu_ly_QH[$count_QH] = $donthudata[$j];

                            $count_QH++;
                        }
                    }

                    if ($diabanid == $diaBanIdAllArray[0] && $phanloaidonthudata[$j]->diaban == 0) {

                        //Den Han
//                        if ($today >= $ngaynhan && $ngaynhan >= $date_xuly) {
                        if($date_qh <= $ngaynhan && $ngaynhan <= $date_xuly){

                            $don_thu_dia_ban_xu_ly_DH[$count_DH] = $donthudata[$j];

                            $count_DH++;

                        } //Qua Han
                        elseif ($ngaynhan < $date_qh) {

                            $don_thu_dia_ban_xu_ly_QH[$count_QH] = $donthudata[$j];

                            $count_QH++;
                        }

                    }
                }
            }

            $thong_ke_xu_ly_theo_dia_ban[$i-1] = array(
                'diabanid' => $diabanid,
                'tendiaban' => $tendiaban,
                'soxulydenhan' => $count_DH,
                'soxulyquahan' => $count_QH,
                'donthuxulydenhan' => $don_thu_dia_ban_xu_ly_DH,
                'donthuxulyquahan' => $don_thu_dia_ban_xu_ly_QH
            );
        }

        return $thong_ke_xu_ly_theo_dia_ban;
    }

    /**************************************************
    Function Name	: getXacMinhTheoDiaBan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getXacMinhTheoDiaBan($diaban,$donthudata,$phanloaidonthudata,$giaoxacminhdonthudata,$ketquagiaiquyetdonthudata)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = date("Y-m-d");
        $day_xl = 3;
        $day_qh = 10;
        $date_xuly = date("Y-m-d", strtotime("$today - $day_xl day"));
        $date_qh = date("Y-m-d", strtotime("$today -$day_qh day"));

        $thong_ke_xac_minh_theo_dia_ban = array();

        for($i = 1; $i<count($diaban);$i++){
            $diabanid = $diaban[$i]->id;
            $tendiaban = $diaban[$i]->tendiaban;

            $count_DH = 0;
            $count_QH = 0;
            $don_thu_dia_ban_xac_minh_DH = array();
            $don_thu_dia_ban_xac_minh_QH = array();
            //Xu Ly Theo Dia Ban
            for($j = 0; $j<count($phanloaidonthudata);$j++){

                if($donthudata[$j]->trangthaixuly == DANGGIAIQUYET && $ketquagiaiquyetdonthudata[$j]->ngayquyetdinhxuly=="0000-00-00") {

                    $ngayketthuc = $giaoxacminhdonthudata[$j]->ngayketthuc;
                    if ($phanloaidonthudata[$j]->diaban == $diabanid ) {

                        //Den Han
//                        if ($today >= $ngayketthuc && $ngayketthuc >= $date_xuly) {
                        if($date_qh <= $ngayketthuc && $ngayketthuc <= $date_xuly){

                            $don_thu_dia_ban_xac_minh_DH[$count_DH] = $donthudata[$j];

                            $count_DH++;

                        } //Qua Han
                        elseif ($ngayketthuc < $date_qh) {

                            $don_thu_dia_ban_xac_minh_QH[$count_QH] = $donthudata[$j];

                            $count_QH++;
                        }
                    }

                    if ($diabanid == 2 && $phanloaidonthudata[$j]->diaban == 0) {

                        //Den Han
//                        if ($today >= $ngayketthuc && $ngayketthuc >= $date_xuly) {
                        if($date_qh <= $ngayketthuc && $ngayketthuc <= $date_xuly){

                            $don_thu_dia_ban_xac_minh_DH[$count_DH] = $donthudata[$j];

                            $count_DH++;

                        } //Qua Han
                        elseif ($ngayketthuc < $date_qh) {

                            $don_thu_dia_ban_xac_minh_QH[$count_QH] = $donthudata[$j];

                            $count_QH++;
                        }

                    }
                }
            }

            $thong_ke_xac_minh_theo_dia_ban[$i-1] = array(
                'diabanid' => $diabanid,
                'tendiaban' => $tendiaban,
                'soxacminhdenhan' => $count_DH,
                'soxacminhquahan' => $count_QH,
                'donthuxacminhdenhan' => $don_thu_dia_ban_xac_minh_DH,
                'donthuxacminhquahan' => $don_thu_dia_ban_xac_minh_QH
            );
        }

        return $thong_ke_xac_minh_theo_dia_ban;
    }

    /**************************************************
    Function Name	: getGiaiQuyetTheoDiaBan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getGiaiQuyetTheoDiaBan($diaban,$donthudata,$phanloaidonthudata,$ketquagiaiquyetdonthudata,$diaBanIdAllArray)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = date("Y-m-d");
        $day_xl = 3;
        $day_qh = 10;
        $date_xuly = date("Y-m-d", strtotime("$today - $day_xl day"));
        $date_qh = date("Y-m-d", strtotime("$today -$day_qh day"));

        $thong_ke_giai_quyet_theo_dia_ban = array();

        for($i = 1; $i<count($diaban);$i++){
            $diabanid = $diaban[$i]->id;
            $tendiaban = $diaban[$i]->tendiaban;

            $count_DH = 0;
            $count_QH = 0;
            $don_thu_dia_ban_giai_quyet_DH = array();
            $don_thu_dia_ban_giai_quyet_QH = array();
            //Xu Ly Theo Dia Ban
            for($j = 0; $j<count($phanloaidonthudata);$j++){

                if($donthudata[$j]->trangthaixuly == DANGGIAIQUYET) {

                    $ngayquyetdinh = $ketquagiaiquyetdonthudata[$j]->ngayquyetdinhxuly;

                    if($ngayquyetdinh != '0000-00-00') {

                        if ($phanloaidonthudata[$j]->diaban == $diabanid) {

                            //Den Han
                            if($date_qh <= $ngayquyetdinh && $ngayquyetdinh <= $date_xuly){

                                $don_thu_dia_ban_giai_quyet_DH[$count_DH] = $donthudata[$j];

                                $count_DH++;

                            } //Qua Han
                            elseif ($ngayquyetdinh < $date_qh) {

                                $don_thu_dia_ban_giai_quyet_QH[$count_QH] = $donthudata[$j];

                                $count_QH++;
                            }
                        }

                        if ($diabanid == $diaBanIdAllArray[0] && $phanloaidonthudata[$j]->diaban == 0) {

                            //Den Han
                            if($date_qh <= $ngayquyetdinh && $ngayquyetdinh <= $date_xuly){

                                $don_thu_dia_ban_giai_quyet_DH[$count_DH] = $donthudata[$j];

                                $count_DH++;

                            } //Qua Han
                            elseif ($ngayquyetdinh < $date_qh) {

                                $don_thu_dia_ban_giai_quyet_QH[$count_QH] = $donthudata[$j];

                                $count_QH++;
                            }

                        }
                    }
                }
            }

            $thong_ke_giai_quyet_theo_dia_ban[$i-1] = array(
                'diabanid' => $diabanid,
                'tendiaban' => $tendiaban,
                'sogiaiquyetdenhan' => $count_DH,
                'sogiaiquyetquahan' => $count_QH,
                'donthugiaiquyetdenhan' => $don_thu_dia_ban_giai_quyet_DH,
                'donthugiaiquyetquahan' => $don_thu_dia_ban_giai_quyet_QH
            );
        }

        return $thong_ke_giai_quyet_theo_dia_ban;
    }
    /**************************************************
    Function Name	: getBaoCaoTheoTTXL
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDataDonThuTheoKy($request,$donthu)
    {
        $donthu_theoky = BaoCaoTable::DataDonThuTheoKy($request->TuNgay,$request->DenNgay,$donthu);
        return $donthu_theoky;
    }
    /**************************************************
    Function Name	: getBaoCaoTheoTTXL
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function getBaoCaoTheoTTXL($request,$donthu)
    {
        $result = BaoCaoTable::BaoCaoTheoTTXL($request->TuNgay,$request->DenNgay,$donthu);

        return $result;

    }
    /**************************************************
    Function Name	: GetBaoCaoTheoLoaiDon
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetBaoCaoTheoLoaiDon($request,$diaBanIdAllArray,$donthu)
    {
        $data_loaidon = BaoCaoTable::BaoCaoTheoLoaiDon($request->TuNgay,$request->DenNgay,$diaBanIdAllArray,$donthu);

        return $data_loaidon;

    }
    /**************************************************
    Function Name	: GetBaoCaoTheoGroup
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetBaoCaoTheoGroup($donthu_theoky)
    {
        $donthu_canhan=array();
        $donthu_tapthe=array();
        for($i = 0;$i<count($donthu_theoky);$i++)
        {
            if($donthu_theoky[$i]->songuoi==0)
            {
                array_push($donthu_canhan,$donthu_theoky[$i]);
            }
            else
            {
                array_push($donthu_tapthe,$donthu_theoky[$i]);
            }
        }
         $array_group = array(
             'canhan'=>$donthu_canhan,
             'tapthe'=>$donthu_tapthe,
         );

        return $array_group;
    }
    /**************************************************
    Function Name	: GetBaoCaoTheoNguon
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetBaoCaoTheoHuongXuLy($donthu_theoky,$diaBanIdAllArray)
    {
        $phanloai = DB::table('phanloaidonthu')
            ->whereIn('diaban',$diaBanIdAllArray)
            ->get();
        $donthu_xuly =array();
        $thuLy = array();
        $count_thyly = 0;
        $traDon = array();
        $count = 0;

        for($i = 0;$i<count($donthu_theoky);$i++)
        {
            for($j = 0 ;$j<count($phanloai);$j++)
            {
                if($donthu_theoky[$i]->donthuid == $phanloai[$j]->donthuid)
                {
                    if($phanloai[$j]->huonggiaiquyet == THULY)
                    {
                        $thuLy[$count_thyly] = $donthu_theoky[$i];
                        $count_thyly++;
                    }
                    elseif($phanloai[$j]->huonggiaiquyet == TRADON || $phanloai[$j]->huonggiaiquyet == CHUYENDON)
                    {
                        $traDon[$count] = $donthu_theoky[$i];
                        $count++;
                    }
                    else
                    {
                        //do not thing
                    }
                }
            }
        }

        $donthu_xuly= array(
            "thuly"=>$thuLy,
            "tra_chuyen"=>$traDon
        );

        return $donthu_xuly;

    }
    /**************************************************
    Function Name	: GetBaoCaoTheoNguon
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetBaoCaoTheoLinhVuc($request,$diaBanIdAllArray,$donthu)
    {
        $baocao_linhvuc = BaoCaoTable::BaoCaoTheoLinhVuc($request->TuNgay,$request->DenNgay,$diaBanIdAllArray,$donthu);

        return $baocao_linhvuc;

    }
    /**************************************************
    Function Name	: GetBaoCaoTheoDiaBan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetBaoCaoSoNganhTheoDiaBan($request,$diaBanIdAllArray)
    {
        $baocao_songanh = BaoCaoTable::BaoCaoSoNganhTheoDiaBan($request->TuNgay,$request->DenNgay,$diaBanIdAllArray);

        return $baocao_songanh;

    }
    /**************************************************
    Function Name	: GetBaoCaoTheoDanhSach
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetBaoCaoTheoDanhSach($request,$diaBanIdAllArray,$donthu)
    {
        $baocao_danhsach = BaoCaoTable::BaoCaoTheoDanhSach($request->TuNgay, $request->DenNgay,$diaBanIdAllArray,$donthu);

        return $baocao_danhsach;

    }
    /**************************************************
    Function Name	: GetDataXuLy
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDataXuLy($tongdonchua_GQ,$donthudata,$kind)
    {
        $data = $tongdonchua_GQ [$kind];
      return   $data;
    }
    /**************************************************
    Function Name	: GetDataXuLy
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDataXacMinh($tongdonchua_GQ,$donthudata,$kind)
    {
        $data = null;
        $no =0;
        for($i =0;$i<count($tongdonchua_GQ[$kind]);$i++)
        {
            for($j = 0;$j<count($tongdonchua_GQ[$kind][$i]);$j++)
            {
                $data[$no] = $tongdonchua_GQ[$kind][$i][$j];
                $no++;
            }

        }

        $results =null;
        $num =0;
        for($i = 0; $i<count($data);$i++)
        {
            for($j = 0;$j<count($donthudata);$j++)
            {
                if($data[$i]->donthuid == $donthudata[$j]->donthuid)
                {
                    $results[$num]=$donthudata[$j];
                    $num++;
                }
            }
        }
        return $results;
    }
    /**************************************************
    Function Name	: GetDataXuLy
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDataGiaiQuyet($tongdonchua_GQ,$donthudata,$kind)
    {
        $results =null;
        $num =0;
        for($i = 0; $i<count($tongdonchua_GQ[$kind]);$i++)
        {
            for($j = 0;$j<count($donthudata);$j++)
            {
                if($tongdonchua_GQ[$kind][$i]->donthuid == $donthudata[$j]->donthuid)
                {
                    $results[$num]=$donthudata[$j];
                    $num++;
                }
            }
        }
        return $results;
    }
    /**************************************************
    Function Name	: GetDataDetailDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetDataDetailDonThu($donthuid)
    {
        $data = DonThuTable::GetDataDetail($donthuid);
        return $data;
    }
    /**************************************************
    Function Name	: GetNguoiXLTheoDonVi
    Description		:
    Argument		: $donviId
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetNguoiXLTheoDonVi($donviId,$diaBanIdAllArray)
    {
        $nguoi_xuly = AccountInfoTable::GetAccountInfoTheoDonVi($donviId,$diaBanIdAllArray);

        return $nguoi_xuly;
    }

    /**************************************************
    Function Name	: exportMauDon01
    Description		: export Mau Don 01
    Argument		: $donThuId
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function exportMauDon01($donThuId)
    {

        $thongTinDonThu = DonThuTable::getThongTinDonThuTheoId($donThuId);
        $phanLoaiDonThu = PhanLoaiDonThuTable::getNguoiXuLyDonThuTheoDonThuId($donThuId);
        $nguoiXuLyDonThu = AccountInfoTable::GetFullName($phanLoaiDonThu->nguoixuly);
        $objWriter = MauDon::mauDon01($thongTinDonThu, $nguoiXuLyDonThu);

        return $objWriter;
    }

    /**************************************************
    Function Name	: exportMauDon02
    Description		: export Mau Don 02
    Argument		: $donThuId
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function exportMauDon02($donThuId)
    {

        $thongTinDonThu = DonThuTable::getThongTinDonThuTheoId($donThuId);
        $phanLoaiDonThu = PhanLoaiDonThuTable::getNguoiXuLyDonThuTheoDonThuId($donThuId);
        $objWriter = MauDon::mauDon02($thongTinDonThu, $phanLoaiDonThu->dexuat);

        return $objWriter;
    }

    /**************************************************
    Function Name	: exportMauDon03
    Description		: export Mau Don 03
    Argument		: $donThuId
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function exportMauDon03($donThuId)
    {

        $thongTinDonThu = DonThuTable::getThongTinDonThuTheoId($donThuId);
        $phanLoaiDonThu = PhanLoaiDonThuTable::getNguoiXuLyDonThuTheoDonThuId($donThuId);
        $tenDonViChuyenDen = DonViTable::GetTenDonVi($phanLoaiDonThu->donvichuyenden);
        $objWriter = MauDon::mauDon03($thongTinDonThu, $tenDonViChuyenDen);

        return $objWriter;
    }

    /**************************************************
    Function Name	: exportMauDon04
    Description		: export Mau Don 04
    Argument		: $donThuId
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function exportMauDon04($donThuId)
    {

        $thongTinDonThu = DonThuTable::getThongTinDonThuTheoId($donThuId);
        $phanLoaiDonThu = PhanLoaiDonThuTable::getNguoiXuLyDonThuTheoDonThuId($donThuId);
        $tenDonViChuyenDen = DonViTable::GetTenDonVi($phanLoaiDonThu->donvichuyenden);
        $objWriter = MauDon::mauDon04($thongTinDonThu, $tenDonViChuyenDen);

        return $objWriter;
    }

    /**************************************************
    Function Name	: exportMauDon05
    Description		: export Mau Don 05
    Argument		: $donThuId
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function exportMauDon05($donThuId)
    {

        $thongTinDonThu = DonThuTable::getThongTinDonThuTheoId($donThuId);
        $phanLoaiDonThu = PhanLoaiDonThuTable::getNguoiXuLyDonThuTheoDonThuId($donThuId);
        $tenDonViChuyenDen = DonViTable::GetTenDonVi($phanLoaiDonThu->donvichuyenden);
        $objWriter = MauDon::mauDon05($thongTinDonThu, $tenDonViChuyenDen);

        return $objWriter;
    }

    /**************************************************
    Function Name	: exportPhieuHen
    Description		: export Phieu Hen
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function exportPhieuHen($tiepDanId)
    {
        $ketQuaTiepDan = KetQuaTiepDanTable::GetKetQuaTiepDanTheoID($tiepDanId);
        $objWriter = MauDon::mauPhieuHen($ketQuaTiepDan);

        return $objWriter;
    }

    /**************************************************
    Function Name	: inDanhSachTiepCongDan
    Description		: in danh Sach Tiep Cong Dan
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function inDanhSachTiepCongDan($diaBanIdAllArray){

        $ketquatiepdan = KetQuaTiepDanTable::GetKetQuaTiepDanTheoDiaBanAll($diaBanIdAllArray);
        $objWriter = MauDon::danhSachTiepCongDan($ketquatiepdan);

        return $objWriter;
    }

    /**************************************************
    Function Name	: inDanhSachDonThu
    Description		: in Danh Sach Don Thu
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function inDanhSachDonThu($request){

        $trangthai = $request->trangThai_InDanhSachDonThuForm;
        $accountId = $request->accountId_InDanhSachDonThuForm;
        $acountinfo = AccountInfoTable::GetAccountInfoTheoID($accountId);
        $diabanid = $acountinfo[0]->diaban;
        $diabanarray = DiaBanTable::GetDiaBanTrucThuoc($diabanid);
        $arraydonthu = DonThuTable::getdatadonthu('donthu','trangthaixuly',$trangthai, $diabanarray);
        $objWriter = MauDon::inDanhSachDonThu($arraydonthu);

        return $objWriter;
    }

    /**************************************************
    Function Name	: inDanhSachDonThuDHQH
    Description		: in Danh Sach Don Thu DHQH
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function inDanhSachDonThuDHQH($request){

        $donThuData = $request->donThuData_inDanhSachDonThuDHQHForm;
        $objWriter = MauDon::inDanhSachDonThu(json_decode($donThuData));

        return $objWriter;
    }

    /**************************************************
    Function Name	: inLichTiepDan
    Description		: in Lich Tiep Dan
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function inLichTiepDan($diaBanIdAllArray){

        $lichTiepDan = LichTiepDanTable::GetLichTiepDanTheoDiaBanAll($diaBanIdAllArray);

        $objWriter = MauDon::inLichTiepDan($lichTiepDan);

        return $objWriter;
    }
    /**************************************************
    Function Name	: GetTatCaDonThuTheoDiaBan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetTatCaDonThuTheoDiaBan($diaBanIdAllArray)
    {
        $result = DonThuTable::GetTatCaDonThu($diaBanIdAllArray);

        return $result;
    }
    /**************************************************
    Function Name	: updateImageDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function updateImageDonThu($donthuid,$request)
    {
        DonThuTable::updateImage($donthuid,$request);
    }
    /**************************************************
    Function Name	: GetBaoCaoKhieuNai
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetBaoCaoKhieuNai($request,$diaBanIdAllArray)
    {
        $data = BaoCaoTable::TongHopDonThuKhieuNaiTheDiaBan($request->TuNgay,$request->DenNgay,$diaBanIdAllArray);

        return $data;
    }
    /**************************************************
    Function Name	: GetBaoCaoToCao
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetBaoCaoToCao($request,$diaBanIdAllArray)
    {
        $data = BaoCaoTable::TongHopDonThuToCaoTheDiaBan($request->TuNgay,$request->DenNgay,$diaBanIdAllArray);

        return $data;
    }
    /**************************************************
    Function Name	: GetBaoCaoTheoDanhGia
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetBaoCaoTheoDanhGia($request,$diaBanIdAllArray,$loai_baocao)
    {
        $danh_gia = BaoCaoTable::BaoCaoTheoDanhGia($request->TuNgay,$request->DenNgay,$diaBanIdAllArray,$loai_baocao);

        return $danh_gia;
    }
    /**************************************************
    Function Name	: GetKetQuaBaoCaoKhieuNai
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetKetQuaBaoCaoKhieuNai($request,$diaBanIdAllArray)
    {
        $data_ketqua = BaoCaoTable::BaoCaoKetQuaKhieuNai($request->TuNgay,$request->DenNgay,$diaBanIdAllArray);

        return $data_ketqua;
    }

    /**************************************************
    Function Name	: GetKetQuaBaoCaoToCao
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public static function GetKetQuaBaoCaoToCao($request,$diaBanIdAllArray)
    {
        $data_ketqua = BaoCaoTable::BaoCaoKetQuaToCao($request->TuNgay,$request->DenNgay,$diaBanIdAllArray);

        return $data_ketqua;
    }

}
