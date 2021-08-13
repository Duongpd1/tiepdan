<?php

namespace App\Http\Controllers\PageControllers;

use App\Model\PageModel\CongThongTinPage;
use App\Model\PageModel\DangNhapPage;
use App\Model\PageModel\DanhMucPage;
use App\Model\PageModel\HeThongPage;
use App\Model\PageModel\MauDon;
use App\Model\PageModel\TiepDanPage;
use App\Model\PageModel\TongHopPage;
use App\Model\PageModel\TraCuuPage;
use App\Model\PageModel\TrangChuPage;
use App\Model\PageModel\VanBanPage;
use App\Model\TableModel\AccountInfoTable;
use App\Model\TableModel\BaoCaoDotXuat;
use App\Model\TableModel\KetQuaTiepDanTable;
use App\Model\TableModel\LichSuGiaoXuLy;
use App\Model\TableModel\TongHopTable;
use App\Services\CSDLQGService;
use App\Services\SysCSDLQGArgService;
use Illuminate\Http\Request;
use App\Model\PageModel\ChiTietDonPage;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\PageModel\NghiepVuPage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Session;

use App\Model\TableModel\DonThuTable;
use App\Model\TableModel\VanBanTable;
use App\Model\TableModel\TheoDoiDonThuTable;

//use Symfony\Component\HttpFoundation\Session\Session;

class ChuyenVienController extends Controller
{
    /**************************************************
    Function Name	: page_chuyenvien
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_chuyenvien(Request $request)
    {
        $accountId = Session::get('accountid');

        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);

        $diabanId = $accountInfo[0]->diaban;

        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diabanId,$diaBanIdAll);


        $loaidon = TiepDanPage::GetLoaiHinh();

        $tongdonchua_GQ = NghiepVuPage::GetTongDonChuaGQ($diaBanIdAllArray,$loaidon);

        $ketQuaGiaiQuyetDon = NghiepVuPage::GetKetQuaGiaiQuyetDon($diaBanIdAllArray,$loaidon);

        $lichTiepCongDan = TiepDanPage::KetQuaTiepDanThangTheoDiaBan($diaBanIdAllArray);


        $ketquatiepdan = TiepDanPage::GetKetQuaTiepDanTheoDiaBan($diaBanIdAllArray,HIENTHI_10ITEMS);

        $value = 0;

        $donGiongNhau = TongHopPage::getDonThuCungNguoiKN($value);

        $numbDonThu = DonThuTable::getDataOfDothuOfMasterUser($accountId,$diaBanIdAllArray);

        $dataDonOfVanThu = DonThuTable::getDataDonChoVanThu($accountId);

        $dataVanBanOfVanThu = VanBanTable::getDataVanBanOfVanThu($accountId,$diabanId);

        $donvi = DanhMucPage::GetDonVi();

        $thongTinNhanVien = AccountInfoTable::getDanhSachNhanVien();

        $tabView = $request->tab ? $request->tab : '';

        return view('pages.chuyenvien',compact('tongdonchua_GQ','lichTiepCongDan','ketQuaGiaiQuyetDon','lichTiepCongDan',
            'ketquatiepdan','donGiongNhau', 'numbDonThu','dataDonOfVanThu','dataVanBanOfVanThu','donvi','thongTinNhanVien','tabView'));

    }

    /**************************************************
    Function Name	: page_denhan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_denhan($type,$diabanid)
    {

        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diabanid,$diaBanIdAll);

        $diaban = NghiepVuPage::GetDiaBan();
        $donthudata = NghiepVuPage::getAllDonThu($diaBanIdAllArray);
        $phanloaidonthudata = NghiepVuPage::getPhanLoaiDonThu($diaBanIdAllArray);
//        $giaoxacminhdonthudata = NghiepVuPage::getGiaoXacMinhDonThu();
        $ketquagiaiquyetdonthudata = NghiepVuPage::getKetQuaGiaiQuyetDonThu($phanloaidonthudata);

        $results = null;

        if($type == XULY) {

            $loai_hien_thi = 'ĐẾN HẠN XỬ LÝ';
            $thong_ke_xu_ly_theo_dia_ban = NghiepVuPage::getXuLyTheoDiaBan($diaban,$donthudata,$phanloaidonthudata,$diaBanIdAllArray);

            for($i = 0; $i<count($thong_ke_xu_ly_theo_dia_ban); $i++){

                if($thong_ke_xu_ly_theo_dia_ban[$i]['diabanid'] == $diabanid){

                    $results = $thong_ke_xu_ly_theo_dia_ban[$i]['donthuxulydenhan'];
                    break;
                }

            }

        }
//        elseif($type == XACMINH){
//
//            $loai_hien_thi = 'ĐẾN HẠN XÁC MINH';
//
//            $thong_ke_xac_minh_theo_dia_ban = NghiepVuPage::getXacMinhTheoDiaBan($diaban,$donthudata,$phanloaidonthudata,$giaoxacminhdonthudata);
//
//            for($i = 0; $i<count($thong_ke_xac_minh_theo_dia_ban); $i++){
//
//                if($thong_ke_xac_minh_theo_dia_ban[$i]['diabanid'] == $diabanid){
//
//                    $results = $thong_ke_xac_minh_theo_dia_ban[$i]['donthuxacminhdenhan'];
//                    break;
//                }
//
//            }
//
//        }
        elseif($type == GIAIQUYET){

            $loai_hien_thi = 'ĐẾN HẠN GIẢI QUYẾT';

            $thong_ke_giai_quyet_theo_dia_ban = NghiepVuPage::getGiaiQuyetTheoDiaBan($diaban,$donthudata,$phanloaidonthudata,$ketquagiaiquyetdonthudata,$diaBanIdAllArray);

            for($i = 0; $i<count($thong_ke_giai_quyet_theo_dia_ban); $i++){

                if($thong_ke_giai_quyet_theo_dia_ban[$i]['diabanid'] == $diabanid){

                    $results = $thong_ke_giai_quyet_theo_dia_ban[$i]['donthugiaiquyetdenhan'];
                    break;
                }

            }

        }else{

            $loai_hien_thi = '';
        }

        return view('pages.danhsachdonthutheodiaban',compact('loai_hien_thi','results'));

    }
    /**************************************************
    Function Name	: page_denhantong
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_denhantong($type,$loaidonId)
    {
        $accountId = Session::get('accountid');

        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);

        $diabanId = $accountInfo[0]->diaban;

        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diabanId,$diaBanIdAll);


        $result =null;
        $kind =null;
        $loai_hien_thi ='';
        if($type ==XULY)
        {
            $kind ='xuly_DH';
            $loai_hien_thi = 'ĐẾN HẠN XỬ LÝ';
            $results = NghiepVuPage::GetDataXuLy($diaBanIdAllArray,$kind,$loaidonId);
        }
        else
        {
            $kind ='giaiquyet_DH';
            $loai_hien_thi = 'ĐẾN HẠN GIẢI QUYẾT';
            $results = NghiepVuPage::GetDataGiaiQuyet($diaBanIdAllArray,$kind,$loaidonId);
        }
        return view('pages.danhsachdonthutheodiaban',compact('loai_hien_thi','results'));
    }
    /**************************************************
    Function Name	: page_quahan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_quahan($type,$diabanid)
    {
        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diabanid,$diaBanIdAll);

        $diaban = NghiepVuPage::GetDiaBan();
        $donthudata = NghiepVuPage::getAllDonThu($diaBanIdAllArray);
        $phanloaidonthudata = NghiepVuPage::getPhanLoaiDonThu($diaBanIdAllArray);
//        $giaoxacminhdonthudata = NghiepVuPage::getGiaoXacMinhDonThu();
        $ketquagiaiquyetdonthudata = NghiepVuPage::getKetQuaGiaiQuyetDonThu($phanloaidonthudata);

        $results = null;

        if($type == XULY) {

            $loai_hien_thi = 'QUÁ HẠN XỬ LÝ';
            $thong_ke_xu_ly_theo_dia_ban = NghiepVuPage::getXuLyTheoDiaBan($diaban,$donthudata,$phanloaidonthudata,$diaBanIdAllArray);

            for($i = 0; $i<count($thong_ke_xu_ly_theo_dia_ban); $i++){

                if($thong_ke_xu_ly_theo_dia_ban[$i]['diabanid'] == $diabanid){

                    $results = $thong_ke_xu_ly_theo_dia_ban[$i]['donthuxulyquahan'];
                    break;
                }

            }

        }
//        elseif($type == XACMINH){
//
//            $loai_hien_thi = 'QUÁ HẠN XÁC MINH';
//
//            $thong_ke_xac_minh_theo_dia_ban = NghiepVuPage::getXacMinhTheoDiaBan($diaban,$donthudata,$phanloaidonthudata,$giaoxacminhdonthudata,$ketquagiaiquyetdonthudata);
//
//            for($i = 0; $i<count($thong_ke_xac_minh_theo_dia_ban); $i++){
//
//                if($thong_ke_xac_minh_theo_dia_ban[$i]['diabanid'] == $diabanid){
//
//                    $results = $thong_ke_xac_minh_theo_dia_ban[$i]['donthuxacminhquahan'];
//                    break;
//                }
//
//            }
//
//        }
        elseif($type == GIAIQUYET){

            $loai_hien_thi = 'QUÁ HẠN GIẢI QUYẾT';

            $thong_ke_giai_quyet_theo_dia_ban = NghiepVuPage::getGiaiQuyetTheoDiaBan($diaban,$donthudata,$phanloaidonthudata,$ketquagiaiquyetdonthudata,$diaBanIdAllArray);

            for($i = 0; $i<count($thong_ke_giai_quyet_theo_dia_ban); $i++){

                if($thong_ke_giai_quyet_theo_dia_ban[$i]['diabanid'] == $diabanid){

                    $results = $thong_ke_giai_quyet_theo_dia_ban[$i]['donthugiaiquyetquahan'];
                    break;
                }

            }

        }else{

            $loai_hien_thi = '';
        }

        return view('pages.danhsachdonthutheodiaban',compact('loai_hien_thi','results'));
    }

    /**************************************************
    Function Name	: page_quahantong
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: Duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_quahantong($type,$loaidonId)
    {
        $accountId = Session::get('accountid');

        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);

        $diabanId = $accountInfo[0]->diaban;

        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diabanId,$diaBanIdAll);

        $result =null;
        $kind ='';
        $loai_hien_thi ='';
        if($type ==XULY)
        {
            $kind ='xuly_QH';
            $loai_hien_thi = 'QUÁ HẠN XỬ LÝ';
            $results = NghiepVuPage::GetDataXuLy($diaBanIdAllArray,$kind,$loaidonId);
        }
        else
        {
            $kind ='giaiquyet_QH';
            $loai_hien_thi = 'QUÁ HẠN GIẢI QUYẾT';
            $results = NghiepVuPage::GetDataGiaiQuyet($diaBanIdAllArray,$kind,$loaidonId);
        }
        return view('pages.danhsachdonthutheodiaban',compact('loai_hien_thi','results'));
        //return $results;
    }
    /**************************************************
    Function Name	: page_baocao
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_baocao()
    {
        $status = 0;
        $tu_Ngay = "";
        $den_Ngay = "";
        $ky_baocao = "";
        $loai_baocao = "";
        return view('pages.baocao',compact('status','tu_Ngay',
            'den_Ngay',
            'ky_baocao',
            'loai_baocao'));
    }
    /**************************************************
    Function Name	: page_detail_baocao
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_detail_baocao(Request $request)
    {

        $tu_Ngay = DonThuTable::ConvertFormatDate($request->TuNgay);
        $den_Ngay = DonThuTable::ConvertFormatDate($request->DenNgay);


        $ky_baocao = $request->KyBaoCao;
        $loai_baocao = $request->LoaiBaoCao;
        $donthu_theoky =null;

        $accountId = Session::get('accountid');
        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);
        $diabanId = $accountInfo[0]->diaban;

        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diabanId,$diaBanIdAll);
        $donthu = NghiepVuPage::getAllDonThu($diaBanIdAllArray);

        if($loai_baocao =="TongHop")
        {
            $donthu_theoky = NghiepVuPage::GetDataDonThuTheoKy($request,$donthu);

            $data_TTXL = NghiepVuPage::getBaoCaoTheoTTXL($request,$donthu);

            $data_LoaiDon = NghiepVuPage::GetBaoCaoTheoLoaiDon($request,$diaBanIdAllArray,$donthu);

            $data_LinhVuc = NghiepVuPage::GetBaoCaoTheoLinhVuc($request,$diaBanIdAllArray,$donthu);

            $data_songanh = NghiepVuPage::GetBaoCaoSoNganhTheoDiaBan($request,$diaBanIdAllArray);

            $data_khieunai = NghiepVuPage::GetBaoCaoKhieuNai($request,$diaBanIdAllArray);

            $data_tocao = NghiepVuPage::GetBaoCaoToCao($request,$diaBanIdAllArray);

            $data_DanhSach = NghiepVuPage::GetBaoCaoTheoDanhSach($request,$diaBanIdAllArray,$donthu);

//            $data_Group = NghiepVuPage::GetBaoCaoTheoGroup($donthu_theoky);

            $baocao_theohuong_xuly = NghiepVuPage::GetBaoCaoTheoHuongXuLy($donthu_theoky,$diaBanIdAllArray);

            $status = 1;
            return view('pages.baocao',compact('donthu_theoky',
                'data_TTXL',
                'status',
                'data_LoaiDon',
//                'data_Group',
                'baocao_theohuong_xuly',
                'data_LinhVuc',
                'data_songanh',
                'data_khieunai',
                'data_tocao',
                'data_DanhSach',
                'tu_Ngay',
                'den_Ngay',
                'ky_baocao',
                'loai_baocao'
            ));
//            return $data_DiaBan;
        }
        elseif($loai_baocao =="KhieuNai")
        {
            $status = 2;
            $donthu_theoky = NghiepVuPage::GetDataDonThuTheoKy($request,$donthu);

            $data_ketqua = NghiepVuPage::GetKetQuaBaoCaoKhieuNai($request,$diaBanIdAllArray);


            $danh_gia_don = NghiepVuPage::GetBaoCaoTheoDanhGia($request,$diaBanIdAllArray,$loai_baocao);

            return view('pages.baocao',compact(
                'donthu_theoky',
                'status',
                'data_ketqua',
                'danh_gia_don',
                'tu_Ngay',
                'den_Ngay',
                'ky_baocao',
                'loai_baocao'
            ));
//            return $data_ketqua;

        }
        elseif($loai_baocao =="ToCao")
        {
            $status = 3;
            $donthu_theoky = NghiepVuPage::GetDataDonThuTheoKy($request,$donthu);

            $data_tocao = NghiepVuPage::GetKetQuaBaoCaoToCao($request,$diaBanIdAllArray);
            $danh_gia_don = NghiepVuPage::GetBaoCaoTheoDanhGia($request,$diaBanIdAllArray,$loai_baocao);

            return view('pages.baocao',compact(
                'donthu_theoky',
                'status',
                'data_tocao',
                'danh_gia_don',
                'tu_Ngay',
                'den_Ngay',
                'ky_baocao',
                'loai_baocao'
            ));

        }
        elseif($loai_baocao =="TKTHTCD")
        {
            $status = 4;
            $data_tiepdan = TiepDanPage::getBaoCaoTiepDan($request,$diaBanIdAllArray);

            return view('pages.baocao',compact(
                'donthu_theoky',
                'data_tiepdan',
                'status',
                'tu_Ngay',
                'den_Ngay',
                'ky_baocao',
                'loai_baocao'
            ));
        
		}elseif("sokhieunai" == $loai_baocao || "sotocao" == $loai_baocao){

            $objWriter = NghiepVuPage::exportSoKhieuNaiToCao($tu_Ngay,$den_Ngay,$diaBanIdAllArray,$loai_baocao);
            $objWriter->save('php://output');

        }elseif("sotiepdan" == $loai_baocao){

            $objWriter = NghiepVuPage::exportSoTiepDan($tu_Ngay,$den_Ngay,$diaBanIdAllArray);
            $objWriter->save('php://output');
			
        }else{
            $status = 2;
            return view('pages.baocao',compact(
                'status',
                'donthu_theoky',
                'tu_Ngay',
                'den_Ngay',
                'ky_baocao',
                'loai_baocao'
            ));
        }

    }
    /**************************************************
    Function Name	: page_doichieugiayto
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_doichieugiayto()
    {
        return view('pages.doichieugiayto');
    }
    /////////////////////NGHIEP VU/////////////////////
    /**************************************************
    Function Name	: page_donthuxacminh
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
//    public function page_donthuxacminh()
//    {
//        $result = NghiepVuPage::getSoThuLyDonThu();
//        $loaidon = DanhMucPage::GetLoaiDon();
//        $linhvuc = DanhMucPage::GetLinhVuc();
//        return view('pages.donthuxacminh', compact('result','loaidon','linhvuc'));
//    }
    /**************************************************
    Function Name	: page_danhsachdonthu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_danhsachdonthu()
    {
        $accountId = Session::get('accountid');

        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);

        $diabanId = $accountInfo[0]->diaban;

        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diabanId,$diaBanIdAll);

        $donthuArray = NghiepVuPage::getDSDonThu($diaBanIdAllArray);
        $thongTinNhanVien = AccountInfoTable::getDanhSachNhanVien();
        return view('pages.danhsachdonthu',compact('donthuArray','thongTinNhanVien'));
    }
    /**************************************************
    Function Name	: page_danhsachxacminh
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
//    public function page_danhsachxacminh()
//    {
//        return view('pages.danhsachxacminh');
//    }

    /**************************************************
    Function Name	: page_taodonthumoi
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_taodonthumoi()
    {
        $result = NghiepVuPage::getSoThuLyDonThu();
        $donvi = DanhMucPage::GetDonVi();
        $thamquyen = DanhMucPage::GetThamQuyen();
        $danhsachdoituong = NghiepVuPage::GetDanhSachDoiTuongKhieuNai();
        $loaidon = DanhMucPage::GetLoaiDon();
        $linhvuc = DanhMucPage::GetLinhVuc();
        $diaBan = TongHopPage::TongHopThongTinDonThu('diaban','tendiaban');
        $tenDonVi = TongHopPage::TongHopThongTinDonThu('donvi','tendonvi');


        $accountId = Session::get('accountid');
        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);
        $diabanId = $accountInfo[0]->diaban;

        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diabanId,$diaBanIdAll);

        $arrayTenDiaBan = TongHopPage::TongHopTenDiaBanTheoId($diaBanIdAllArray);

        $danhSachNhanVien = NghiepVuPage::getDanhSachNhanVien();

        return view('pages.taodonthumoi',compact('result','donvi','thamquyen','danhsachdoituong','loaidon','linhvuc','arrayTenDiaBan','tenDonVi','danhSachNhanVien'));
    }

    /**************************************************
    Function Name	: getDonViTheoDiaBan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function getDonViTheoDiaBan(Request $request)
    {
        $diaBanSelect = $request->diabanid;
        $result = NghiepVuPage::getDonViTheoDiaBan($diaBanSelect);

        return response()->json(['donvitheodiaban_result' => $result]);
    }

    /**************************************************
    Function Name	: getSelected
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function getSelected(Request $request)
    {
        $result = NghiepVuPage::getSelected($request);
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
    public function getSearchDonThu($request)
    {
        if($request!="a")
        {
            $data = NghiepVuPage::getSearchDonThu($request);
        }
        else
        {
            $data = NghiepVuPage::getDSDonThu();
        }

        return view('pages.searchdonthu',compact('data'));
    }
    /**************************************************
    Function Name	: postTaoDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function postTaoDonThu(Request $request)
    {
        $loaiDonXuLy = $request->loaiCV;
        $accountId = Session::get('accountid');
        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);
        $diabanId = $accountInfo[0]->diaban;

        $donVi = $accountInfo[0]->donvi;

        $lanhDaoID = HeThongPage::GetLanhDaoTheoDiaBan($diabanId);


        $donthuid = NghiepVuPage::StoreDonThu($request,$lanhDaoID[0]->accountid,$diabanId,$accountId,$donVi);


        if($request->nguondon == 'donvi'){
            NghiepVuPage::UpdateNguonDon($donthuid,$request);
        }

         NghiepVuPage::UpdateDonNhieuNguoi($donthuid,$request);


        if($request->lan == 'L?n 2'){
            NghiepVuPage::UpdateSoLan($donthuid,$request);
        }

        NghiepVuPage::UpdateVanBanDinhKem($donthuid,$request,$accountId);

        if($request->anhdaidien !=null)
        {
            NghiepVuPage::updateImageDonThu($donthuid,$request);
        }


        $sothuly = $request->sothuly;
        $sothuly = explode('/',$sothuly);
        $sothuly = implode('-',$sothuly);


//        if($loaiDonXuLy != CV_DI)
//        {
//            for($i = 0; $i<count($lanhDaoID);$i++)
//            {
            $nguoi_nhan_id = $request->chuyenCanBo;


        if("" != $nguoi_nhan_id)
        {
            NghiepVuPage::assigneeNguoiXuLy($donthuid,$sothuly,$accountId,$nguoi_nhan_id);

        }

//            }
//        }



        if(isset($_POST['luu']))
        {
            //$resCreate = (new NghiepVuPage())->postDonThuToCSDLQG($donthuid);
            return  redirect('chitietdonthu/'.$donthuid);
        }
        else
        {
            return  redirect('taodonthumoi');
        }

    }

    /**************************************************
    Function Name	: themdoituongkhieunaitocao
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function themdoituongkhieunaitocao(Request $request)
    {
        $result = NghiepVuPage::ThemDoiTuongKhieuNaiToCao($request);
        return response()->json(['themdoituongkhieunaitocao_result' => $result]);
    }

    /**************************************************
    Function Name	: postTaoDonThuXacMinh
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
//    public function postTaoDonThuXacMinh(Request $request)
//    {
//        $result = NghiepVuPage::createDonThuXacMinh($request);
//        if($result == 1)
//        {
//            $result = NghiepVuPage::getDonThu();
//            return view('pages.chuyenvien',compact('result'));
//        }
//        $sothuly = $request->sothuly;
//        $sothuly = explode('/',$sothuly);
//        $sothuly = implode('-',$sothuly);
//
//        return  redirect('chitietdonthu/'.$sothuly);
//    }
    /**************************************************
    Function Name	: page_noidungdonthu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_noidungdonthu($donthuid)
    {

        $accountId = Session::get('accountid');
        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);
        $diabanId = $accountInfo[0]->diaban;


        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diabanId,$diaBanIdAll);

        $data = NghiepVuPage::getChinhSua($donthuid);
        $result = NghiepVuPage::getChiTietDonThu($donthuid);
        $donvi = DanhMucPage::GetDonVi();
        $thamquyen = DanhMucPage::GetThamQuyen();
        $doituong = NghiepVuPage::getDSDonThu($diaBanIdAllArray);
        $loaidon = DanhMucPage::GetLoaiDon();
        $nguoiXL = NghiepVuPage::GetFullName($diabanId);
        $linhvuc = DanhMucPage::GetLinhVuc();
        $diaban = DanhMucPage::GetDiaBan();
        $danhsachdoituong = NghiepVuPage::GetDanhSachDoiTuongKhieuNai();
        $tendiaban = NghiepVuPage::GetTenDiaBan($result['phanloai'][0]->diaban);
        $tenDonVi = NghiepVuPage::getTenDonVi($result['phanloai'][0]->donvi);
        $donViTheoDiaBan = NghiepVuPage::getDonViTheoDiaBan($result['phanloai'][0]->diaban);

        $diaBan = TongHopPage::TongHopThongTinDonThu('diaban','tendiaban');
        $arrayDonVi = TongHopPage::TongHopThongTinDonThu('donvi','tendonvi');



        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diabanId,$diaBanIdAll);
        $donthuAll = NghiepVuPage::getAllDonThu($diaBanIdAllArray);

        $arrayTenDiaBan = TongHopPage::TongHopTenDiaBanTheoId($diaBanIdAllArray);

        $vanBanTheoDon = VanBanPage::GetVanBanDonTheoId($donthuid);


        //dom thu lien quan
        $donChaThongTin = null;
        if($result['noidung'][0]->donthulanmotid !=null)
        {
            $donChaThongTin = DonThuTable::getThongTinDonThuTheoId($result['noidung'][0]->donthulanmotid);
        }



        //file
        $array_file = array();
        $num = 0;
        $file_name = explode("*",$data[0]->vanban);
        for($i = 0;$i<count($file_name);$i++)
        {
            if($file_name[$i]!=null)
            {
                $array_file[$num] = $file_name[$i];
                $num++;
            }
        }

        $lichSuXL = NghiepVuPage::GetLichSuGiaoXuLy($donthuid);



        //nguoi theo doi
        $nguoiTheoDoi = array();

        if($result['phanloai'][0]->nguoixuly != 0)
        {
            $nguoiTheoDoi[] = $result['phanloai'][0]->nguoixuly;
        }

        foreach($lichSuXL as $item)
        {
            $replace1 = false;
            $replace2 = false;
            if($nguoiTheoDoi != null)
            {
                foreach($nguoiTheoDoi as $row)
                {
                    if($row == $item->nguoiGiaoXuLy  )
                    {
                        $replace1 = true;
                    }
                    if($row == $item->nguoiXuLy )
                    {
                        $replace2 = true;
                    }
                }

                if($replace1 == false)
                {
                    $nguoiTheoDoi[] = $item->nguoiGiaoXuLy;
                }
                if($replace2 == false)
                {
                    $nguoiTheoDoi[] = $item->nguoiXuLy;
                }
            }
            else
            {

                $nguoiTheoDoi[] = $item->nguoiGiaoXuLy;
                if($item->nguoiGiaoXuLy != $item->nguoiXuLy)
                {
                    $nguoiTheoDoi[] = $item->nguoiXuLy;
                }

            }
        }

        $danhSachNhanVien = NghiepVuPage::getDanhSachNhanVien();

        $idNguoiTheoDoi = TheoDoiDonThuTable::GetNguoiTheodoiTheoDonThu($donthuid);

        if(count($idNguoiTheoDoi)>0)
        {
            foreach($idNguoiTheoDoi as $row)
            {
                $check = false;
                foreach($nguoiTheoDoi as $id)
                {
                    if($id == $row->accountid)
                    {
                        $check = true;
                    }

                }
                if($check == false)
                {
                    $nguoiTheoDoi[] = $row->accountid;
                }

            }
        }


        return view('pages.noidungdonthu',compact('data','donvi','thamquyen','doituong','result','loaidon','nguoiXL',
            'linhvuc','diaban','danhsachdoituong','sothuly','tendiaban','array_file','tenDonVi','diaBan','arrayDonVi','arrayTenDiaBan','donViTheoDiaBan','danhSachNhanVien','vanBanTheoDon','nguoiTheoDoi','donChaThongTin','donthuAll'));
    }
    /**************************************************
    Function Name	: page_luunoidung
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_luunoidung(Request $request)
    {

        NghiepVuPage::updateChinhSuaDonThu($request);



        $donthuid = $request->donthuid;
        $nguoi_nhan_id = $request->nguoixuly;
        $accountId = $request->accountid;

        if($request->nguondon == 'donvi'){
            NghiepVuPage::UpdateNguonDon($request->donthuid,$request);
        }


            NghiepVuPage::UpdateDonNhieuNguoi($donthuid,$request);


        if($request->lan == 'L?n 2'){
            NghiepVuPage::UpdateSoLan($donthuid,$request);
        }

        //file
        $file_name = ['file1','file2','file3','file4','file5'];


        $file_value = [$request->file1,$request->file2,$request->file3,$request->file4,$request->file5];

        $check_upload = true;

        if($request->file1 == null && $request->file2 == null && $request->file3 == null && $request->file4 == null && $request->file5 == null)
        {
            $check_upload = false;

        }
        if ($check_upload)
        {
            NghiepVuPage::UpdateVanBanDinhKem($donthuid,$request,$accountId);
        }
        
        if($request->anhdaidien !=null)
        {
            NghiepVuPage::updateImageDonThu($donthuid,$request);
        }


        $sothuly = $request->sothuly;
        $sothuly = explode('/',$sothuly);
        $sothuly = implode('-',$sothuly);

        if($nguoi_nhan_id != null)
        {
            NghiepVuPage::assigneeNguoiXuLy($donthuid,$sothuly,$accountId,$nguoi_nhan_id);
        }

        if(isset($_POST['save']))
        {
            //$resCreate = (new NghiepVuPage())->postDonThuToCSDLQG($donthuid);
            return  redirect('chitietdonthu/'.$donthuid);
        }
        else
        {

            return  redirect('phanloaidonthu/'.$donthuid);
        }


    }
    /**************************************************
    Function Name	: page_phanloaidonthu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_phanloaidonthu($donId)
    {
        $accountId = Session::get('accountid');
        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);
        $diabanId = $accountInfo[0]->diaban;

        $result = NghiepVuPage::getChiTietDonThu($donId);
        $tendoituongkhieunai = NghiepVuPage::GetDoiTuongKhieuNaiTheoID($result['noidung'][0]->doituongkhieunai);
        $quyenXL = DanhMucPage::GetThamQuyen();
        $donvi = DanhMucPage::GetDonVi();
        $diaban = DanhMucPage::GetDiaBan();
        $linhvuc = DanhMucPage::GetLinhVuc();
        $loaidon = DanhMucPage::GetLoaiDon();
        $nguoiXL = NghiepVuPage::GetFullName($diabanId);
        $tendiaban = NghiepVuPage::GetTenDiaBan($result['phanloai'][0]->diaban);
        $vanBanTheoDon = VanBanPage::GetVanBanDonTheoId($donId);

        $vanban = array();
        $num = 0;
        $file_explode = explode("*",$result['noidung'][0]->vanban);
        array_push($file_explode,$result['noidung'][0]->vanbanuyquyen);

        for($i = 0;$i<count($file_explode);$i++)
        {
            if($file_explode[$i] !=null)
            {
                $vanban[$num] = $file_explode[$i];
                $num++;
            }
        }

        return  view('pages.phanloaidonthu',compact('result','quyenXL','donvi','diaban','linhvuc','loaidon','nguoiXL','tendoituongkhieunai','sothuly','tendiaban','vanBanTheoDon','vanban'));
    }
    /**************************************************
    Function Name	: page_luuphanloai
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_luuphanloai(Request $request)
    {
        $accountId = Session::get('accountid');
        $result = NghiepVuPage::updatePhanLoaiDonThu($request);


        $donthuid = $request->donthuid;

        if($request->huonggiaiquyet == 3) {

            if ($request->scanphieuhd != null) {


                NghiepVuPage::updateScanPhieuHuongDan($donthuid,$request,$accountId);
            }

            if ($request->congvanchuyendon != null) {

                NghiepVuPage::updateCongVanChuyenDon($donthuid,$request,$accountId);
            }

            if ($request->tbchuyendon != null) {

                NghiepVuPage::updateThongBaoChuyenDon($donthuid,$request,$accountId);
            }

            if ($request->yeucauxl != null) {

                NghiepVuPage::updateVanBanYeuCauXuLy($donthuid, $request,$accountId);
            }

            NghiepVuPage::updateHuongGiaiQuyet($donthuid,$request);
        }

        $nguoi_nhan_id = $request->nguoixuly;
        $nguoi_gui_id = $request->accountid;
        $sothuly = $request->sothuly;
        $sothuly = explode('/',$sothuly);
        $sothuly = implode('-',$sothuly);

        NghiepVuPage::assigneeNguoiXuLy($donthuid,$sothuly,$nguoi_gui_id,$nguoi_nhan_id);


        if(isset($_POST['luu']))
        {
            return  redirect('chitietdonthu/'.$donthuid);
        }
        else
        {
            return  redirect('theodoidonthu/'.$donthuid);
        }

    }
    /**************************************************
    Function Name	: page_getdanhsachdonthuxacminh
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
//    public function page_getdanhsachdonthuxacminh(Request $request)
//    {
//        $result = NghiepVuPage::getdanhsachdonthuxacminh($request);
//        return $result;
//    }
    /**************************************************
    Function Name	: page_getdanhsachdonthu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_getdanhsachdonthu(Request $request)
    {
        $result = NghiepVuPage::getdanhsachdonthu($request);

        return $result;
    }

    /**************************************************
    Function Name	: xoaDonThu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function xoaDonThu(Request $request)
    {

        $result = NghiepVuPage::xoaDonThu($request);

        return response()->json(['xoadonthu_result' => $result]);
    }

    /**************************************************
    Function Name	: page_chitietdonthu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_chitietdonthu($donthuid)
    {
        $accountId = Session::get('accountid');
        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);
        $diabanId = $accountInfo[0]->diaban;

        $result = NghiepVuPage::getChiTietDonThu($donthuid);

        //$tendoituongkhieunai = NghiepVuPage::GetDoiTuongKhieuNaiTheoID($result['noidung'][0]->doituongkhieunai);
        $quyenXL = DanhMucPage::GetThamQuyen();
        $donvi = DanhMucPage::GetDonVi();
        $diaban = DanhMucPage::GetDiaBan();
        $linhvuc = DanhMucPage::GetLinhVuc();
        $loaidon = DanhMucPage::GetLoaiDon();
        $nguoiXL = NghiepVuPage::GetFullName($diabanId);




        $lichSuXL = NghiepVuPage::GetLichSuGiaoXuLy($donthuid);

        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diabanId,$diaBanIdAll);
        $donthuAll = NghiepVuPage::getAllDonThu($diaBanIdAllArray);

        $donLienQuan = null;

        $resultDonCon = ChiTietDonPage::GetDonConTheoId($donthuid,$result['noidung'][0]->donthulanmotid);

        $donThuIdArray =$resultDonCon['donThuId'];
        $thongTinDonCon = $resultDonCon['thongTin'];

        if($result['noidung'][0]->donthulanmotid != '')
        {

            $vanBanTheoDon = VanBanPage::GetVanBanDonTheoId($donThuIdArray);

        }
        else
        {
            $vanBanTheoDon = VanBanPage::GetVanBanDonTheoId($donthuid);
        }

        //nguoi theo doi
        $nguoiTheoDoi = array();

        if($result['phanloai'][0]->nguoixuly != 0)
        {
            $nguoiTheoDoi[] = $result['phanloai'][0]->nguoixuly;
        }


        foreach($lichSuXL as $item)
        {
            $replace1 = false;
            $replace2 = false;
            if($nguoiTheoDoi != null)
            {
                foreach($nguoiTheoDoi as $row)
                {
                    if($row == $item->nguoiGiaoXuLy  )
                    {
                        $replace1 = true;
                    }
                    if($row == $item->nguoiXuLy )
                    {
                        $replace2 = true;
                    }
                }

                if($replace1 == false)
                {
                    $nguoiTheoDoi[] = $item->nguoiGiaoXuLy;
                }
                if($replace2 == false)
                {
                    $nguoiTheoDoi[] = $item->nguoiXuLy;
                }
            }
            else
            {

                $nguoiTheoDoi[] = $item->nguoiGiaoXuLy;
                if($item->nguoiGiaoXuLy != $item->nguoiXuLy)
                {
                    $nguoiTheoDoi[] = $item->nguoiXuLy;
                }

            }
        }

        $danhSachNhanVien = NghiepVuPage::getDanhSachNhanVien();

        $idNguoiTheoDoi = TheoDoiDonThuTable::GetNguoiTheodoiTheoDonThu($donthuid);

        if(count($idNguoiTheoDoi)>0)
        {
            foreach($idNguoiTheoDoi as $row)
            {
                $nguoiTheoDoi[] = $row->accountid;
            }
        }

        //don lien quan

        $vanBanLienQuan = ChiTietDonPage::GetVanBanLienQuanTheoId($donthuid);

        $strVanBan = (new MauDon())->readTemplateTxt($donthuid);
        $tiepdanInfor = (new KetQuaTiepDanTable())->GetThongTinTheoDonId($donthuid);

//        pd($vanBanTheoDon);

        return view('pages.chitietdonthu',compact('result','quyenXL','donvi','diaban','linhvuc','loaidon','nguoiXL','nguoiTheoDoi','vanBanTheoDon','lichSuXL',
            'thongTinDonCon','danhSachNhanVien','donthuAll','vanBanLienQuan','strVanBan','tiepdanInfor'));
//        return $thongTinDonCon;
    }
    /**************************************************
    Function Name	: postCapNhatXacMinh
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function postCapNhatXacMinh(Request $request)
    {
        $result = NghiepVuPage::CapNhatXacMinh($request);
        return view('pages.danhsachxacminh');
    }

    /**************************************************
    Function Name	: page_chitietxacminhdonthu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
//    public function page_chitietxacminhdonthu($sothuly)
//    {
//        $donvi = DanhMucPage::GetDonVi();
//        $result = NghiepVuPage::getChiTietDonThuXacMinh($sothuly);
//        $user = NghiepVuPage::getDanhSachUser('donvi');
//        return view('pages.chitietxacminhdonthu', compact('result', 'user','donvi'));
//    }
    /**************************************************
    Function Name	: page_theodoidonthu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_theodoidonthu($donthuid)
    {
        $accountId = Session::get('accountid');
        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);
        $diabanId = $accountInfo[0]->diaban;

        $result = NghiepVuPage::getChiTietDonThu($donthuid);
        //$tendoituongkhieunai = NghiepVuPage::GetDoiTuongKhieuNaiTheoID($result['noidung'][0]->doituongkhieunai);
        $quyenXL = DanhMucPage::GetThamQuyen();
        $donvi = DanhMucPage::GetDonVi();
        $diaban = DanhMucPage::GetDiaBan();
        $linhvuc = DanhMucPage::GetLinhVuc();
        $loaidon = DanhMucPage::GetLoaiDon();
        $nguoiXL = NghiepVuPage::GetFullName($diabanId);

        $sothuly = $result['noidung'][0]->sothuly;
        $donvi_id = $result['phanloai'][0]->donvi;
        $diaban_id = $result['phanloai'][0]->diaban;

        $accountId = Session::get('accountid');

        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diaban_id,$diaBanIdAll);

        $nguoi_xuly_theo_dv = array();
        $nguoi_xuly = NghiepVuPage::GetNguoiXLTheoDonVi($donvi_id,$diaBanIdAllArray);
        $vanBanTheoDon = VanBanPage::GetVanBanDonTheoId($donthuid);


        $no = 0;
        for($i = 0;$i<count($nguoi_xuly);$i++)
        {
            if($nguoi_xuly[$i]->accountid != $accountId)
            {
                $nguoi_xuly_theo_dv[$no] = $nguoi_xuly[$i];
                $no++;
            }
        }

        //van ban
        $vanban = array();
        $num = 0;
        $file_explode = explode("*",$result['noidung'][0]->vanban);
        array_push($file_explode,$result['noidung'][0]->vanbanuyquyen);

        for($i = 0;$i<count($file_explode);$i++)
        {
            if($file_explode[$i] !=null)
            {
                $vanban[$num] = $file_explode[$i];
                $num++;
            }
        }


        $tendonvi = NghiepVuPage::getTenDonVi($result['xacminh'][0]->donvi);

        return view('pages.theodoidonthu',compact('result','quyenXL','donvi','diaban','linhvuc','loaidon','nguoiXL',
            'vanban','sothuly','tendonvi','nguoi_xuly_theo_dv','vanBanTheoDon'));
//        return $nguoi_xuly_theo_dv;
    }
    /**************************************************
    Function Name	: page_luutheodoi
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_luutheodoi(Request $request)
    {
        $accountId = Session::get('accountid');
        $donthuid = $request->donthuid;

        $result = NghiepVuPage::updateTheoDoiDonThu($request,$accountId);

        if($request->vanBanXL != null){

            $name = NghiepVuPage::updateFilePhieuTrinh($donthuid,$request,$accountId);
        }

        if($request->vanBanBS != null){

            NghiepVuPage::updateFileTBTL($donthuid,$request,$accountId);

        }


        if(isset($_POST['btnluu']))
        {
            return  redirect('chitietdonthu/'.$donthuid);
        }
        else
        {
            return  redirect('ketquagiaiquyetdonthu/'.$donthuid);
        }

    }
	
    /**************************************************
    Function Name	: page_ketquagiaiquyetdonthu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_ketquagiaiquyetdonthu($donthuid)
    {

        $accountId = Session::get('accountid');
        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);
        $diabanId = $accountInfo[0]->diaban;

        $result = NghiepVuPage::getChiTietDonThu($donthuid);
        $tendoituongkhieunai = NghiepVuPage::GetDoiTuongKhieuNaiTheoID($result['noidung'][0]->doituongkhieunai);
        $quyenXL = DanhMucPage::GetThamQuyen();
        $donvi = DanhMucPage::GetDonVi();
        $diaban = DanhMucPage::GetDiaBan();
        $linhvuc = DanhMucPage::GetLinhVuc();
        $loaidon = DanhMucPage::GetLoaiDon();
        $nguoiXL = NghiepVuPage::GetFullName($diabanId);

        $sothuly = $result['noidung'][0]->sothuly;

        $vanBanTheoDon = VanBanPage::GetVanBanDonTheoId($donthuid);

        //van ban
        $vanban = array();
        $num = 0;
        $file_explode = explode("*",$result['noidung'][0]->vanban);
        array_push($file_explode,$result['noidung'][0]->vanbanuyquyen);

        for($i = 0;$i<count($file_explode);$i++)
        {
            if($file_explode[$i] !=null)
            {
                $vanban[$num] = $file_explode[$i];
                $num++;
            }
        }

        $tendonvi = NghiepVuPage::getTenDonVi($result['xacminh'][0]->donvi);

        return view('pages.ketquagiaiquyetdonthu',compact('result','quyenXL','donvi','diaban','linhvuc','loaidon','nguoiXL','vanban','sothuly','tendonvi','vanBanTheoDon'));
    }
    /**************************************************
    Function Name	: page_ketthucdonthu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
//    public function page_ketthucdonthu($sothuly)
//    {
//        $result = NghiepVuPage::getChiTietDonThu($sothuly);
//        $tendoituongkhieunai = NghiepVuPage::GetDoiTuongKhieuNaiTheoID($result['noidung'][0]->doituongkhieunai);
//        $quyenXL = DanhMucPage::GetThamQuyen();
//        $donvi = DanhMucPage::GetDonVi();
//        $diaban = DanhMucPage::GetDiaBan();
//        $linhvuc = DanhMucPage::GetLinhVuc();
//        $loaidon = DanhMucPage::GetLoaiDon();
//        $nguoiXL = NghiepVuPage::GetFullName();
//        return view('pages.ketthucdonthu',compact('result','quyenXL','donvi','diaban','linhvuc','loaidon','nguoiXL','tendoituongkhieunai','sothuly'));
//    }
    /**************************************************
    Function Name	: page_deletefile
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_deletefile(Request $request)
    {
        $result = NghiepVuPage::DeleteFile($request);
        return $result;
    }
    /**************************************************
    Function Name	: page_getfile
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_getfile(Request $request)
    {
        $result = NghiepVuPage::getNameFile($request);
        return $result;
    }
    /**************************************************
    Function Name	: page_luuketquagaiquyet
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_luuketquagaiquyet(Request $request)
    {

        //            $data = NghiepVuPage::LuuGiaiQuyetDonThu($request);
        $result = NghiepVuPage::updateGiaiQuyetDonThu($request);

        $donthuid = $request->donthuid;

        if($request->vbgiaiquyet != null){

            NghiepVuPage::updateVanBanGiaiQuyet($donthuid,$request);
        }


        $sothuly = $request->sothuly;
        $sothuly = explode('/',$sothuly);
        $sothuly = implode('-',$sothuly);

        return  redirect('chitietdonthu/'.$donthuid);

    }
    /**************************************************
    Function Name	: page_luuketthuc
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
//    public function page_luuketthuc(Request $request)
//    {
//        $data = NghiepVuPage::LuuKetThuc($request);
//        $sothuly = $request->sothuly;
//        $sothuly = explode('/',$sothuly);
//        $sothuly = implode('-',$sothuly);
//        return  redirect('chitietdonthu/'.$sothuly);
//    }
    /**************************************************
    Function Name	: page_checkedit
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_checkedit(Request $request)
    {
        $result = NghiepVuPage::CheckEdit($request);
        return $result;
    }

    /**************************************************
    Function Name	: page_tracuudonthu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_tracuudonthu()
    {
        $status = 0;
        $loaidon = TraCuuPage::GetAllLoaiDon();
        $linhvuc = TraCuuPage::GetAllLinhVuc();
        $tenchudon = TongHopPage::TongHopThongTinDonThu('donthu','tennguoivietdon');
        $cmt = TongHopPage::TongHopThongTinDonThu('donthu','cmnd_hc');
        $diachi = TongHopPage::TongHopThongTinDonThu('donthu','diachinguoiviet');
        $sdt = TongHopPage::TongHopThongTinDonThu('donthu','sdt');
        $noidung = TongHopPage::TongHopThongTinDonThu('donthu','noidung');
        $diaBan = TongHopPage::TongHopThongTinDonThu('diaban','tendiaban');
        return view('pages.tracuudonthu',compact('status','loaidon','linhvuc','tenchudon','cmt','diachi','sdt','noidung','diaBan'));
    }
    /**************************************************
    Function Name	: page_tracuu_donthu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_tracuu_donthu(Request $request)
    {
        $accountId = Session::get('accountid');

        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);

        $diabanId = $accountInfo[0]->diaban;

        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diabanId,$diaBanIdAll);

        $data_tracuu = null;

        $data_tracuu = TraCuuPage::GetDataTraCuuTheoMot($request,$diaBanIdAllArray);

        return $data_tracuu;
    }

    /**************************************************
    Function Name	: filter_tracuu_donthu
    Description		:
    Argument		: $request
    Creation Date	: 2017/05/27
    Author			:
    Reviewer		:
     ***************************************************/
    public function filter_tracuu_donthu(Request $request)
    {

        $accountId = Session::get('accountid');

        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);

        $diabanId = $accountInfo[0]->diaban;

        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diabanId,$diaBanIdAll);

        $data_tracuu = null;

        $data_tracuu = TraCuuPage::GetDataTraCuuTheoFilter($request,$diaBanIdAllArray);

        return $data_tracuu;

    }
    /**************************************************
    Function Name	: page_tratiepcongdan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_tratiepcongdan()
    {
        //$loaidon = TraCuuPage::GetAllLoaiDon();
        $linhvuc = TraCuuPage::GetAllLinhVuc();
        return view('pages.tratiepcongdan',compact('linhvuc'));
    }
    /**************************************************
    Function Name	: page_tracuulichtiepdan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function page_tracuulichtiepdan(Request $request)
    {
        //$dieu_kien = $request->dieukien;
        $linhvuc = TraCuuPage::GetAllLinhVuc();
        $tracuu_tiepdan = null;
//        if($dieu_kien == "all")
//        {
//            $tracuu_tiepdan = TraCuuPage::GetTraCuuLichTiepDanAll($request,$linhvuc);
//        }
//        else
//        {
            $tracuu_tiepdan = TraCuuPage::GetTraCuuLichTiepDanOne($request,$linhvuc);
        //}

        return $tracuu_tiepdan;
    }
    /* */
    public function page_chitiettiepdan()
    {
        return view('pages.chitiettiepdan');
    }

    /* */
    public function page_datdai()
    {
        return view('pages.datdai');
    }

    /* */
    public function page_dsdthoagiaidatdai()
    {
        return view('pages.dsdthoagiaidatdai');
    }
    /* */
    public function page_dsketluanthanhtra()
    {
        return view('pages.dsketluanthanhtra');
    }
    /* */
    public function page_ketluanthanhtra()
    {
        return view('pages.ketluanthanhtra');
    }

    public function page_trogiup()
    {
        return view('pages.trogiup');
    }

    ///////////////////////CONG THONG TIN//////////////////////
    ///////////////////////MUC TIN TUC//////////////////////

    /**************************************************
    Function Name	: page_baiviet
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_baiviet()
    {
        if(Session::has('soLuongHienThi_TabCongThongTin')){

            //DO NOTHING
        } else {

            Session::put('soLuongHienThi_TabCongThongTin', HIENTHI_10ITEMS);
        }

        $soLuongHienThi_TabCongThongTin = Session::get('soLuongHienThi_TabCongThongTin');
        $result = CongThongTinPage::GetBaiVietTinTucSuKien($soLuongHienThi_TabCongThongTin);
        return view('pages.baiviet')->with('gettintucsukien',$result);
    }

    /**************************************************
    Function Name	: page_themtintucsukien
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_themtintucsukien()
    {
        return view('pages.themtintucsukien');
    }

    /**************************************************
    Function Name	: submitthemtintucsukien
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitthemtintucsukien(Request $request)
    {
        $result = CongThongTinPage::StoreBaiVietTinTucSuKien($request);
        return redirect('baiviet')->with('themtintucsukien_result', $result);
    }

    /**************************************************
    Function Name	: changetrangthaibaiviet
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function changetrangthaibaiviet(Request $request)
    {
        $result = CongThongTinPage::ChangeTrangThaiBaiViet($request);
        return response()->json(['changetrangthaibaiviet_result' => $result]);
    }

    /**************************************************
    Function Name	: xoabaiviet
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function xoabaiviet(Request $request)
    {
        $result = CongThongTinPage::XoaBaiViet($request);
        return response()->json(['xoabaiviet_result' => $result]);
    }

    /**************************************************
    Function Name	: chinhsuabaiviet
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function chinhsuabaiviet($id)
    {
        $result = CongThongTinPage::GetBaiVietTheoID($id);

        return view('pages.chinhsuabaiviet')->with('chitietbaiviet',$result);
    }

    ///////////////////////MUC GIOI THIEU//////////////////////

    /**************************************************
    Function Name	: page_gioithieu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_gioithieu()
    {
        if(Session::has('soLuongHienThi_TabCongThongTin')){

            //DO NOTHING
        } else {

            Session::put('soLuongHienThi_TabCongThongTin', HIENTHI_10ITEMS);
        }

        $soLuongHienThi_TabCongThongTin = Session::get('soLuongHienThi_TabCongThongTin');
        $result = CongThongTinPage::GetThongTinGioiThieu($soLuongHienThi_TabCongThongTin);
        return view('pages.gioithieu')->with('getthongtingioithieu',$result);
    }

    /**************************************************
    Function Name	: page_themthongtingioithieu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_themthongtingioithieu()
    {
        return view('pages.themthongtingioithieu');
    }

    /**************************************************
    Function Name	: submitthemthongtingioithieu
    Description		:
    Argument		: Request $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitthemthongtingioithieu(Request $request)
    {
        $result = CongThongTinPage::StoreBaiVietTinTucSuKien($request);
        return redirect('gioithieu')->with('themthongtingioithieu_result', $result);
    }

    /**************************************************
    Function Name	: submitchinhsuabaiviet
    Description		:
    Argument		: $id,Request $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitchinhsuabaiviet($id,Request $request)
    {
        $result = CongThongTinPage::UpdateBaiViet($id,$request);

        if(($request->theloai == CNNHIEMVU)||($request->theloai == GTCHUNG)||($request->theloai == LANHDAOPHUTHO)) {

            return redirect('gioithieu')->with('chinhsuabaiviet_result', $result);
        }else{

            return redirect('baiviet')->with('chinhsuabaiviet_result', $result);
        }
    }

    ///////////////////////MUC GOP Y CONG DAN//////////////////////

    /**************************************************
    Function Name	: page_qtgopycongdan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_qtgopycongdan()
    {
        if(Session::has('soLuongHienThi_TabCongThongTin')){

            //DO NOTHING
        } else {

            Session::put('soLuongHienThi_TabCongThongTin', HIENTHI_10ITEMS);
        }

        $soLuongHienThi_TabCongThongTin = Session::get('soLuongHienThi_TabCongThongTin');
        $result = CongThongTinPage::GetGopYCongDan($soLuongHienThi_TabCongThongTin);
        return view('pages.qtgopycongdan')->with('getgopycongdan',$result);
    }

    /**************************************************
    Function Name	: changetrangthaigopytrogiup
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function changetrangthaigopytrogiup(Request $request)
    {
        $result = CongThongTinPage::ChangeTrangThaiGopYTroGiup($request);
        return response()->json(['changetrangthai_result' => $result]);
    }

    /**************************************************
    Function Name	: xoagopytrogiup
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function xoagopytrogiup(Request $request)
    {
        $result = CongThongTinPage::XoaGopYTroGiup($request);
        return response()->json(['xoagopy_result' => $result]);

    }

    ///////////////////////MUC TRO GIUP PHAP LUAT//////////////////////

    /**************************************************
    Function Name	: page_qttrogiupphapluat
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_qttrogiupphapluat()
    {
        if(Session::has('soLuongHienThi_TabCongThongTin')){

            //DO NOTHING
        } else {

            Session::put('soLuongHienThi_TabCongThongTin', HIENTHI_10ITEMS);
        }

        $soLuongHienThi_TabCongThongTin = Session::get('soLuongHienThi_TabCongThongTin');
        $result = CongThongTinPage::GetTroGiupPhapLuat($soLuongHienThi_TabCongThongTin);
        return view('pages.qttrogiupphapluat')->with('gettrogiupphapluat',$result);
    }

    ///////////////////////MUC THONG BAO//////////////////////

    /**************************************************
    Function Name	: page_qtthongbao
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_qtthongbao()
    {
        if(Session::has('soLuongHienThi_TabCongThongTin')){

            //DO NOTHING
        } else {

            Session::put('soLuongHienThi_TabCongThongTin', HIENTHI_10ITEMS);
        }

        $soLuongHienThi_TabCongThongTin = Session::get('soLuongHienThi_TabCongThongTin');
        $result = CongThongTinPage::GetThongBao($soLuongHienThi_TabCongThongTin);
        return view('pages.qtthongbao')->with('getthongbao',$result);
    }

    /**************************************************
    Function Name	: page_themthongbao
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_themthongbao()
    {
        return view('pages.themthongbao');
    }

    /**************************************************
    Function Name	: submitthemthongbao
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitthemthongbao(Request $request)
    {
        $result = CongThongTinPage::StoreThongBao($request);
        return redirect('qtthongbao')->with('themtintucsukien_result', $result);
    }

    /**************************************************
    Function Name	: xoathongbao
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function xoathongbao(Request $request)
    {
        $result = CongThongTinPage::XoaThongBao($request);

        return response()->json(['xoathongbao_result' => $result]);
    }

    /**************************************************
    Function Name	: page_chinhsuathongbao
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_chinhsuathongbao($id)
    {
        $result = CongThongTinPage::GetThongBaoTheoID($id);
        return view('pages.chinhsuathongbao')->with('chitietthongbao',$result);
    }

    /**************************************************
    Function Name	: submitchinhsuathongbao
    Description		:
    Argument		: $id,Request $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitchinhsuathongbao($id,Request $request)
    {
        $result = CongThongTinPage::UpdateThongBao($id,$request);
        return redirect('qtthongbao')->with('chinhsuathongbao_result', $result);
    }

    ///////////////////////VAN BAN//////////////////////

    /**************************************************
    Function Name	: page_qtvanban
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_qtvanban()
    {
        $result = VanBanPage::GetVanBanPhapLuat();
        return view('pages.qtvanban')->with('getvanbanphapluat',$result);
    }

    /**************************************************
    Function Name	: page_themvanbanphapluat
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_themvanbanphapluat()
    {
        $accountId = Session::get('accountid');
        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);
        $diabanId = $accountInfo[0]->diaban;
        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diabanId,$diaBanIdAll);
        $donthuAll = NghiepVuPage::getAllDonThu($diaBanIdAllArray);

        $danhSachNhanVien = NghiepVuPage::getDanhSachNhanVien();

        return view('pages.themvanbanphapluat')->with(['danhSachNhanVien'=>$danhSachNhanVien,'donthuAll'=>$donthuAll]);
    }

    /**************************************************
    Function Name	: submitthemvanbanphapluat
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitthemvanbanphapluat(Request $request)
    {
        $accountId = Session::get('accountid');

        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);

        $diabanId = $accountInfo[0]->diaban;

        $result = VanBanPage::StoreVanBanPhapLuat($request,$accountId,$diabanId);
        return redirect('qtvanban')->with('themvanbanphapluat_result', $result);
    }

    /**************************************************
    Function Name	: xoavanban
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function xoavanban(Request $request)
    {
        $result = VanBanPage::XoaVanBan($request);
        return response()->json(['xoavanban_result' => $result]);
    }

    /**************************************************
    Function Name	: page_chinhsuavanban
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_chinhsuavanban($id)
    {
        $accountId = Session::get('accountid');
        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);
        $diabanId = $accountInfo[0]->diaban;
        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diabanId,$diaBanIdAll);
        $donthuAll = NghiepVuPage::getAllDonThu($diaBanIdAllArray);

        $result = VanBanPage::GetVanBanTheoID($id);
        $danhSachNhanVien = NghiepVuPage::getDanhSachNhanVien();
        return view('pages.chinhsuavanban')->with(['chitietvanban'=>$result,'danhSachNhanVien'=>$danhSachNhanVien,'donthuAll'=>$donthuAll]);
    }

    /**************************************************
    Function Name	: submitchinhsuavanban
    Description		:
    Argument		: $id,$request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitchinhsuavanban($id, Request $request)
    {
        $accountId = Session::get('accountid');
        $result = VanBanPage::UpdateVanBan($id,$request,$accountId);
        return redirect('qtvanban')->with('chinhsuavanban_result', $result);
    }

    ///////////////////////TIEP DAN//////////////////////

    ///////////////////////MUC LICH TIEP DAN//////////////////////

    /**************************************************
    Function Name	: page_tiepcongdan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_tiepcongdan()
    {
        if(Session::has('soLuongHienThi_TabTiepDan')){


        } else {

            Session::put('soLuongHienThi_TabTiepDan', HIENTHI_10ITEMS);
        }

        $soLuongHienThi_TabTiepDan = Session::get('soLuongHienThi_TabTiepDan');

        $accountId = Session::get('accountid');
        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);
        $diaBanId = $accountInfo[0]->diaban;
        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diaBanId,$diaBanIdAll);

        $result = TiepDanPage::GetLichTiepDan($diaBanIdAllArray,$soLuongHienThi_TabTiepDan);
        $getlichtiepdan = $result['lichtiep'];
        $lanhdao = $result['lanhdao'];

        return view('pages.tiepcongdan',compact('getlichtiepdan','lanhdao'));
    }

    /**************************************************
    Function Name	: chonHienThiSoLuongTiepDan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function chonHienThiSoLuongTiepDan(Request $request)
    {

        $valueChon = $request->valueChon;
        if($request->session()->has('soLuongHienThi_TabTiepDan')){

            $request->session()->put('soLuongHienThi_TabTiepDan', $valueChon);

        } else {

            $request->session()->put('soLuongHienThi_TabTiepDan', HIENTHI_10ITEMS);
        }
        return response()->json(['chonHienThiSoLuongTiepDan_result' => true]);
    }

    /**************************************************
    Function Name	: chonHienThiSoLuongCongThongTin
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function chonHienThiSoLuongCongThongTin(Request $request)
    {

        $valueChon = $request->valueChon;
        if($request->session()->has('soLuongHienThi_TabCongThongTin')){

            $request->session()->put('soLuongHienThi_TabCongThongTin', $valueChon);

        } else {

            $request->session()->put('soLuongHienThi_TabCongThongTin', HIENTHI_10ITEMS);
        }
        return response()->json(['chonHienThiSoLuongCongThongTin_result' => true]);
    }

    /**************************************************
    Function Name	: getDeQuyDiaBan
    Description		: get De Quy Dia Ban
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function getDeQuyDiaBan($diaBanId,$result){

        $result[] = $diaBanId;

        $diaBanCon = DanhMucPage::GetDiaBanCon($diaBanId);

        if(count($diaBanCon) > 0) {
            foreach ($diaBanCon as $diaBanConId) {
                $result = ChuyenVienController::getDeQuyDiaBan($diaBanConId->id,$result);
            }
        }

        return $result;
    }

    /**************************************************
    Function Name	: getDeQuyDonVi
    Description		: get De Quy Don Vi
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function getDeQuyDonVi($donViId,$result){

        $result[] = $donViId;

        $diaViCon = DanhMucPage::GetDonViCon($donViId);

        if(count($diaViCon) > 0) {
            foreach ($diaViCon as $diaViConId) {
                $result = ChuyenVienController::getDeQuyDonVi($diaViConId->id,$result);
            }
        }

        return $result;
    }

    /**************************************************
    Function Name	: page_themtiepcongdan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_themtiepcongdan()
    {
        return view('pages.themtiepcongdan');
    }

    /**************************************************
    Function Name	: page_chinhsuatiepcongdan
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_chinhsuatiepcongdan($id)
    {
        $chitietlichtiepdan = TiepDanPage::GetLichTiepDanTheoID($id);

        $tenDiaBan = NghiepVuPage::getTenDiaBan($chitietlichtiepdan[0]->diaban);
//        return view('pages.chinhsuatiepcongdan')->with('chitietlichtiepdan',$result);
        return view('pages.chinhsuatiepcongdan',compact('chitietlichtiepdan','tenDiaBan'));
    }

    /**************************************************
    Function Name	: submitthemtiepcongdan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitthemtiepcongdan(Request $request)
    {
        $accountId = Session::get('accountid');
        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);
        $diaBanId = $accountInfo[0]->diaban;
        $result = TiepDanPage::StoreLichTiepDan($request,$diaBanId);
        return redirect('tiepcongdan')->with('themtiepcongdan_result', $result);
    }

    /**************************************************
    Function Name	: xoalichtiepdan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function xoalichtiepdan(Request $request)
    {
        $result = TiepDanPage::XoaLichTiepDan($request);
        return response()->json(['xoalichtiepdan_result' => $result]);
    }

    /**************************************************
    Function Name	: submitchinhsuatiepcongdan
    Description		:
    Argument		: $id,$request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitchinhsuatiepcongdan($id, Request $request)
    {
        $result = TiepDanPage::UpdateLichTiepDan($id,$request);
        return redirect('tiepcongdan')->with('chinhsuatiepcongdan_result', $result);
    }

    /**************************************************
    Function Name	: getlichtiepcongdantheothang
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function getlichtiepdantheothang(Request $request)
    {
        $result = TiepDanPage::GetLichTiepDanTheoThang($request);
        return response()->json(['lichtiepdan_result' => $result]);
    }
    /**************************************************
    Function Name	: getlichtiepdantheolanhdao
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: duongpd1
    Reviewer		: PhucHM
     ***************************************************/
    public function getlichtiepdantheolanhdao(Request $request)
    {
        $result = TiepDanPage::GetLichTiepDanTheoLanhDao($request);
        //return response()->json(['lichtiepdan_result' => $result]);
        return $result;
    }

    ///////////////////////MUC THONG TIN TIEP DAN//////////////////////

    /**************************************************
    Function Name	: page_thongtintiepdan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_thongtintiepdan()
    {
        if(Session::has('soLuongHienThi_TabTiepDan')){


        } else {

            Session::put('soLuongHienThi_TabTiepDan', HIENTHI_10ITEMS);
        }

        $soLuongHienThi_TabTiepDan = Session::get('soLuongHienThi_TabTiepDan');
        $result = TiepDanPage::GetThongTinTiepDan($soLuongHienThi_TabTiepDan);
        return view('pages.thongtintiepdan')->with('getthongtintiepdan',$result);
    }

    /**************************************************
    Function Name	: page_themthongtintiepdan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_themthongtintiepdan()
    {
        return view('pages.themthongtintiepdan');
    }

    /**************************************************
    Function Name	: page_chinhsuathongtintiepdan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_chinhsuathongtintiepdan($id)
    {
        $result = TiepDanPage::GetThongTinTiepDanTheoID($id);
        return view('pages.chinhsuathongtintiepdan')->with('chitietthongtintiepdan',$result);
    }

    /**************************************************
    Function Name	: submitthemthongtintiepdan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitthemthongtintiepdan(Request $request)
    {
        $result = TiepDanPage::StoreThongTinTiepDan($request);
        return redirect('thongtintiepdan')->with('themthongtintiepdan_result', $result);
    }

    /**************************************************
    Function Name	: xoathongtintiepdan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function xoathongtintiepdan(Request $request)
    {
        $result = TiepDanPage::XoaThongTinTiepDan($request);
        return response()->json(['xoathongtintiepdan_result' => $result]);
    }

    /**************************************************
    Function Name	: changetrangthaithongtintiepdan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function changetrangthaithongtintiepdan(Request $request)
    {
        $result = TiepDanPage::ChangeTrangThaiThongTinTiepDan($request);
        return response()->json(['changetrangthai_result' => $result]);
    }

    /**************************************************
    Function Name	: submitchinhsuathongtintiepdan
    Description		:
    Argument		: $id,$request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitchinhsuathongtintiepdan($id, Request $request)
    {
        $result = TiepDanPage::UpdateThongTinTiepDan($id,$request);
        return redirect('thongtintiepdan')->with('chinhsuathongtintiepdan_result', $result);
    }

    ///////////////////////MUC DANH SACH TIEP CONG DAN//////////////////////

    /**************************************************
    Function Name	: page_danhsachtiepcongdan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_danhsachtiepcongdan()
    {
        if(Session::has('soLuongHienThi_TabTiepDan')){


        } else {

            Session::put('soLuongHienThi_TabTiepDan', HIENTHI_10ITEMS);
        }

        $soLuongHienThi_TabTiepDan = Session::get('soLuongHienThi_TabTiepDan');

        $accountId = Session::get('accountid');
        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);
        $diaBanId = $accountInfo[0]->diaban;
        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diaBanId,$diaBanIdAll);

        $ketquatiepdan = TiepDanPage::GetKetQuaTiepDanTheoDiaBan($diaBanIdAllArray,$soLuongHienThi_TabTiepDan);

        $tenloaihinh = array();
        $tenlinhvuc = array();
        $tendiaban = array();
        for($i = 0; $i<count($ketquatiepdan);$i++){
            $tenloaihinh[$i] = TiepDanPage::GetTenLoaiDon($ketquatiepdan[$i]->loaihinh);
            $tenlinhvuc[$i] = TiepDanPage::GetTenLinhVuc($ketquatiepdan[$i]->linhvuc);
            $tendiaban[$i] = TiepDanPage::GetTenDiaBan($ketquatiepdan[$i]->diaban);
        }

        return view('pages.danhsachtiepcongdan', compact('ketquatiepdan','tenloaihinh','tenlinhvuc','tendiaban'));
    }

    /**************************************************
    Function Name	: page_themdanhsachtiepcongdan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_themdanhsachtiepcongdan()
    {
        $accountId = Session::get('accountid');
        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);
        $diabanId = $accountInfo[0]->diaban;

        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diabanId,$diaBanIdAll);

        $donthuAll = NghiepVuPage::getAllDonThu($diaBanIdAllArray);

        $idMax = TiepDanPage::getIdTiepDanMax();
        $loaihinhdata = TiepDanPage::GetLoaiHinh();
        $linhvucdata = TiepDanPage::GetLinhVuc();
        $lanhDao = TongHopPage::TongHopThongTinDonThu('ketquatiepdan','lanhdao');
        $chucVu = TongHopPage::TongHopThongTinDonThu('ketquatiepdan','chucvu');
        $diaBan = TongHopPage::TongHopThongTinDonThu('diaban','tendiaban');
        $loaidon = DanhMucPage::GetLoaiDon();
        $chuTriInfo = DanhMucPage::getChuTriAll();
        return view('pages.themdanhsachtiepcongdan', compact('loaihinhdata','linhvucdata','idMax','lanhDao','chucVu','loaidon','diaBan','chuTriInfo','donthuAll','accountInfo'));
    }

    /**************************************************
    Function Name	: page_noidungdanhsachtiepcongdan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_noidungdanhsachtiepcongdan($id)
    {
        $noidungdanhsachtiepcongdan = TiepDanPage::GetKetQuaTiepDanTheoID($id);
        $tenlinhvuc = TiepDanPage::GetTenLinhVuc($noidungdanhsachtiepcongdan[0]->linhvuc);
        $tendiaban = TiepDanPage::GetTenDiaBan($noidungdanhsachtiepcongdan[0]->diaban);

        //file
        $array_file = array();
        $num = 0;
        $file_name = explode("*",$noidungdanhsachtiepcongdan[0]->vanban);
        for($i = 0;$i<count($file_name);$i++)
        {
            if($file_name[$i]!=null)
            {
                $array_file[$num] = $file_name[$i];
                $num++;
            }
        }
        return view('pages.noidungdanhsachtiepcongdan',compact('noidungdanhsachtiepcongdan','tenlinhvuc','tendiaban','array_file'));
    }

    /**************************************************
    Function Name	: submitthemdanhsachtiepcongdan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitthemdanhsachtiepcongdan(Request $request)
    {
        $accountId = Session::get('accountid');
        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);
        $diaBanId = $accountInfo[0]->diaban;
        $result = TiepDanPage::StoreDanhSachTiepDan($request,$diaBanId);

        if($result != 'fail')
        {
            TiepDanPage::UploadFileTiepDan($result,$request);
        }

        return redirect('danhsachtiepcongdan')->with('themdanhsachtiepcongdan_result',$result);
    }

    /**************************************************
    Function Name	: chinhsuadanhsachtiepcongdan
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function chinhsuadanhsachtiepcongdan($id)
    {
        $chitietdanhsachtiepcongdan = TiepDanPage::GetKetQuaTiepDanTheoID($id);
        $loaihinhdata = TiepDanPage::GetLoaiHinh();
        $linhvucdata = TiepDanPage::GetLinhVuc();
        $tendiaban = TiepDanPage::GetTenDiaBan($chitietdanhsachtiepcongdan[0]->diaban);
        $lanhDao = TongHopPage::TongHopThongTinDonThu('ketquatiepdan','lanhdao');
        $chucVu = TongHopPage::TongHopThongTinDonThu('ketquatiepdan','chucvu');
        $congDanKhac = TiepDanPage::getThongTinCongDanKhac($id);
        //file
        $array_file = array();
        $num = 0;
        $file_name = explode("*",$chitietdanhsachtiepcongdan[0]->vanban);
        for($i = 0;$i<count($file_name);$i++)
        {
            if($file_name[$i]!=null)
            {
                $array_file[$num] = $file_name[$i];
                $num++;
            }
        }

        $chuTriInfo = DanhMucPage::getChuTriAll();
        return view('pages.chinhsuadanhsachtiepcongdan',compact('chitietdanhsachtiepcongdan','loaihinhdata','linhvucdata',
            'tendiaban','lanhDao','chucVu','congDanKhac','array_file', 'chuTriInfo'));
    }

    /**************************************************
    Function Name	: submitchinhsuadanhsachtiepcongdan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitchinhsuadanhsachtiepcongdan($id, Request $request)
    {
        $result = TiepDanPage::UpdateDanhSachTiepDan($id,$request);
        if($result != 'fail')
        {
            TiepDanPage::UploadFileTiepDan($id,$request);
        }
        return redirect('danhsachtiepcongdan')->with('chinhsuadanhsachtiepcongdan_result',$result);
    }

    /**************************************************
    Function Name	: xoadanhsachtiepdan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function xoadanhsachtiepdan(Request $request)
    {
        $result = TiepDanPage::XoaDanhSachTiepDan($request->tiepdanid);
        return response()->json(['xoadanhsachtiepdan_result' => $result]);
    }

    ///////////////////////HE THONG//////////////////////

    ///////////////////////MUC NGUOI SU DUNG//////////////////////

    /**************************************************
    Function Name	: page_qtdanhmucnguoisudung
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_qtdanhmucnguoisudung()
    {
        $nguoisudung = HeThongPage::GetThongTinNguoiSuDung();
        $tennhomquyen = array();
        for($i = 0; $i<count($nguoisudung[0]['accountmanagerdata']);$i++){
            $result = HeThongPage::GetNhomNguoiSuDungTheoID($nguoisudung[0]['accountmanagerdata'][$i]->nhomquyen);

            if($result != null) {
                if (($result[0]->tennhom != null) && ($result[0]->trangthai == 1)) {

                    $tennhomquyen[$i] = $result[0]->tennhom;

                }else{

                    $tennhomquyen[$i] = 'Chua X�c �?nh Nh�m Quy?n';
                }
            }else{

                $tennhomquyen[$i] = 'Chua X�c �?nh Nh�m Quy?n';
            }
        }

        return view('pages.qtdanhmucnguoisudung', compact('nguoisudung','tennhomquyen'));
//        return $nguoisudung[0]['accountdata'][0]->accountname;
    }

    /**************************************************
    Function Name	: page_themnguoisudung
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_themnguoisudung()
    {
        $nhomquyendata = HeThongPage::GetNhomNguoiSuDungTheoType(1);
        return view('pages.themnguoisudung',compact('nhomquyendata'));
    }

    /**************************************************
    Function Name	: xoanguoisudung
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function getquyennguoisudung(Request $request)
    {
        $result = HeThongPage::GetNhomNguoiSuDungTheoID($request->nhomquyenid);
        return response()->json(['getquyennguoisudung_result' => $result]);
    }

    /**************************************************
    Function Name	: submitthemnguoisudung
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitthemnguoisudung(Request $request)
    {
        $result = HeThongPage::StoreNguoiSuDung($request);
        if($result == 'fail1') {

            $error = 'Nh?p l?i m?t kh?u kh�ng kh?p';

            return redirect('themnguoisudung')->with('themnguoisudung_error', $error);

        }elseif($result == 'fail2'){
            $error = 'T�i kho?n d� t?n t?i';

            return redirect('themnguoisudung')->with('themnguoisudung_error', $error);

        }else {
            return redirect('qtdanhmucnguoisudung')->with('themnguoisudung_result', $result);
        }
    }

    /**************************************************
    Function Name	: xoanguoisudung
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function xoanguoisudung(Request $request)
    {
        $result = HeThongPage::XoaNguoiSuDung($request->nguoisudungid);
        return response()->json(['xoanguoisudung_result' => $result]);
    }

    /**************************************************
    Function Name	: doitrangthainguoisudung
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function doitrangthainguoisudung(Request $request)
    {
        $result = HeThongPage::DoiTrangThaiNguoiSuDung($request->nguoisudungid,$request->newtrangthai);
        return response()->json(['doitrangthainguoisudung_result' => $result]);
    }

    /**************************************************
    Function Name	: chinhsuanguoisudung
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function chinhsuanguoisudung($id)
    {
        $nguoisudung = HeThongPage::GetThongTinNguoiSuDungTheoID($id);
        $nhomnguoisudungtheotype = HeThongPage::GetNhomNguoiSuDungTheoType(1);
        $nhomnguoisudungtheotypeandid = HeThongPage::GetNhomNguoiSuDungTheoTypeAndID(1,$nguoisudung[0]['accountmanagerdata'][0]->nhomquyen);

        if($nhomnguoisudungtheotypeandid != null){

            $tennhomquyen = $nhomnguoisudungtheotypeandid[0]->tennhom;
        }else{
            $tennhomquyen = 'Chua x�c d?nh nh�m quy?n';
        }

        return view('pages.chinhsuanguoisudung', compact('nguoisudung','nhomnguoisudungtheotype','tennhomquyen'));
    }

    /**************************************************
    Function Name	: submitchinhsuanguoisudung
    Description		:
    Argument		: $id, $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitchinhsuanguoisudung(Request $request,$id)
    {

        if($request->password != $request->repassword) {

            $error = 'Nh?p l?i m?t kh?u kh�ng kh?p';

            return redirect('qtdanhmucnguoisudung')->with('chinhsuanguoisudung_error', $error);

        }else {

            $result = HeThongPage::UpdateNguoiSuDung($request,$id);
            return redirect('qtdanhmucnguoisudung')->with('chinhsuanguoisudung_result', $result);
        }

    }

    ///////////////////////MUC NHOM NGUOI SU DUNG//////////////////////

    /**************************************************
    Function Name	: page_qtnhomnguoisudung
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_qtnhomnguoisudung()
    {
        $nhomnguoisudungdata = HeThongPage::GetNhomNguoiSuDung();
        return view('pages.qtnhomnguoisudung', compact('nhomnguoisudungdata'));
    }

    /**************************************************
    Function Name	: xoanhomnguoisudung
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function xoanhomnguoisudung(Request $request)
    {
        $result = HeThongPage::XoaNhomNguoiSuDung($request->nhomnguoisudungid);
        return response()->json(['xoanhomnguoisudung_result' => $result]);
    }

    /**************************************************
    Function Name	: doitrangthainguoisudung
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function doitrangthainhomnguoisudung(Request $request)
    {
        $result = HeThongPage::DoiTrangThaiNhomNguoiSuDung($request->nhomnguoisudungid,$request->newtrangthai);
        return response()->json(['doitrangthainhomnguoisudung_result' => $result]);
    }

    /**************************************************
    Function Name	: page_themnhomnguoisudung
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_themnhomnguoisudung()
    {
        return view('pages.themnhomnguoisudung');
    }

    /**************************************************
    Function Name	: page_chinhsuanhomnguoisudung
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_chinhsuanhomnguoisudung($id)
    {
        $nhomnguoisudung = HeThongPage::GetNhomNguoiSuDungTheoID($id);
        return view('pages.chinhsuanhomnguoisudung', compact('nhomnguoisudung'));
    }

    /**************************************************
    Function Name	: submitthemnhomnguoisudung
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitthemnhomnguoisudung(Request $request)
    {
        $result = HeThongPage::StoreNhomNguoiSuDung($request);
        return redirect('qtnhomnguoisudung')->with('themnhomnguoisudung_result', $result);
    }

    /**************************************************
    Function Name	: submitchinhsuanhomnguoisudung
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitchinhsuanhomnguoisudung(Request $request, $id)
    {
        $result = HeThongPage::UpdateNhomNguoiSuDung($request,$id);
        return redirect('qtnhomnguoisudung')->with('chinhsuanhomnguoisudung_result', $result);
    }

    ///////////////////////CAU HINH HE THONG//////////////////////

    /**************************************************
    Function Name	: page_cauhinhhethong
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_cauhinhhethong()
    {
        $cau_hinh = HeThongPage::getCauHinhHeThong();
        return view('pages.cauhinhhethong',compact('cau_hinh'));
    }

    /**************************************************
    Function Name	: page_cauhinhhethong
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitChinhSuaCauHinhHeThong(Request $request)
    {
        $submit_result = HeThongPage::submitChinhSuaCauHinhHeThong($request);
        return redirect('cauhinhhethong')->with('submit_result', $submit_result);
    }

    ///////////////////////DANH MUC//////////////////////

    ///////////////////////MUC DIA BAN//////////////////////

    /**************************************************
    Function Name	: page_diaban
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_diaban()
    {
        $getdiaban = DanhMucPage::GetDiaBan();
        $maxthutudiabanlv1 = DanhMucPage::GetMaxThuTu(1);

//        pd($getdiaban);

        return view('pages.diaban',compact('getdiaban','maxthutudiabanlv1'));
    }

    /**************************************************
    Function Name	: page_diabantable
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_diabantable()
    {
        $getdiaban = DanhMucPage::GetDiaBan();
        $maxthutudiabanlv1 = DanhMucPage::GetMaxThuTu(1);
        return view('pages.diabantable',compact('getdiaban','maxthutudiabanlv1'));
    }

    /**************************************************
    Function Name	: getthongtindiabantheoid
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function getthongtindiabantheoid(Request $request)
    {
        $result = DanhMucPage::GetThongTinDiaBanTheoID($request->diabanid);
        $maxthutu = DanhMucPage::GetMaxThuTu($request->diabanid);
        if($request->diabanid != 1) {
            $result2 = DanhMucPage::GetThongTinDiaBanTheoID($result[0]->tructhuoc);
            $tendiabantructhuoc = $result2[0]->tendiaban;
            return response()->json([
                'thongtindiaban_result' => $result,
                'tendiabantructhuoc_result' => $tendiabantructhuoc,
                'maxthutu_result' => $maxthutu
            ]);
        }else{
            return response()->json([
                'thongtindiaban_result' => $result,
                'maxthutu_result' => $maxthutu
            ]);
        }
    }

    /**************************************************
    Function Name	: themdiaban
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function themdiaban(Request $request)
    {
        $result = DanhMucPage::StoreDiaBan($request);
        return redirect('diaban')->with('themdiaban_result', $result);
    }

    /**************************************************
    Function Name	: xoadiaban
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function xoadiaban(Request $request)
    {
        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($request->diabanid,$diaBanIdAll);
        $result = DanhMucPage::XoaDiaBan($diaBanIdAllArray);
        return response()->json(['xoadiaban_result' => $result]);
    }

    /**************************************************
    Function Name	: chinhsuadiaban
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function chinhsuadiaban(Request $request, $id)
    {
        $result = DanhMucPage::UpdateDiaBan($request,$id);
        return redirect('diaban')->with('chinhsuadiaban_result', $result);
    }

    /**************************************************
    Function Name	: getdiabancon
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function getdiabancon(Request $request)
    {
        $result = DanhMucPage::GetDiaBanCon($request->diabanid);
        return response()->json(['diabancon_result' => $result]);
    }


    ///////////////////////MUC DON VI//////////////////////

    /**************************************************
    Function Name	: page_donvi
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_donvi()
    {
        $getdonvi = DanhMucPage::GetDonVi();
        $getdiaban = DanhMucPage::GetDiaBan();
        $maxthutudonvi = DanhMucPage::GetMaxThuTuDonVi(1);
        $nguoidaidien = DanhMucPage::GetNguoiDaiDien();

        return view('pages.donvi',compact('getdonvi','maxthutudonvi','nguoidaidien','getdiaban'));
    }

    /**************************************************
    Function Name	: themdonvi
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function themdonvi(Request $request)
    {
        $result = DanhMucPage::StoreDonVi($request);
        return redirect('donvi')->with('themdonvi_result', $result);
    }

    /**************************************************
    Function Name	: getthongtindonvitheoid
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function getthongtindonvitheoid(Request $request)
    {
        $result = DanhMucPage::GetThongTinDonViTheoID($request->donviid);
        $maxthutu = DanhMucPage::GetMaxThuTuDonVi($request->donviid);

        if($result[0]->nguoidaidien >0) {
            $tennguoidaidien = DanhMucPage::GetTenNguoiDaiDien($result[0]->nguoidaidien);
        }else{
            $tennguoidaidien = 'Kh�ng x�c d?nh';
        }
        $nguoidaidien = DanhMucPage::GetNguoiDaiDien();

        if($request->donviid != 1) {
            $result2 = DanhMucPage::GetThongTinDonViTheoID($result[0]->tructhuoc);
            $diaban = DanhMucPage::GetThongTinDiaBanTheoID($result[0]->diaban);
            $tendonvitructhuoc = $result2[0]->tendonvi;
            $tendiabantructhuoc = $diaban[0]->tendiaban;
            $diabantructhuoc = DanhMucPage::GetDiaBanTruDauMuc();
            return response()->json([
                'thongtindonvi_result' => $result,
                'tendonvitructhuoc_result' => $tendonvitructhuoc,
                'diabantructhuoc_result' => $diabantructhuoc,
                'tendiabantructhuoc_result' => $tendiabantructhuoc,
                'maxthutu_result' => $maxthutu,
                'nguoidaidien_result' => $nguoidaidien,
                'tennguoidaidien_result' => $tennguoidaidien
            ]);
        }else{
            return response()->json([
                'thongtindonvi_result' => $result,
                'maxthutu_result' => $maxthutu,
                'nguoidaidien_result' => $nguoidaidien,
                'tennguoidaidien_result' => $tennguoidaidien
            ]);
        }
    }

    /**************************************************
    Function Name	: getdonvicon
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function getdonvicon(Request $request)
    {
        $result = DanhMucPage::GetDonViCon($request->donviid);
        return response()->json(['donvicon_result' => $result]);
    }

    /**************************************************
    Function Name	: xoadonvi
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function xoadonvi(Request $request)
    {
        $diaViIdAll = [];
        $diaViIdAllArray = ChuyenVienController::getDeQuyDiaBan($request->donviid,$diaViIdAll);
        $result = DanhMucPage::XoaDonVi($diaViIdAllArray);
        return response()->json(['xoadonvi_result' => $result]);
    }

    /**************************************************
    Function Name	: chinhsuadonvi
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function chinhsuadonvi(Request $request, $id)
    {
        $result = DanhMucPage::UpdateDonVi($request,$id);
        return redirect('donvi')->with('chinhsuadonvi_result', $result);
    }

    /**************************************************
    Function Name	: page_donvitable
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_donvitable()
    {
        $getdonvi = DanhMucPage::GetDonVi();
        $maxthutudonvi = DanhMucPage::GetMaxThuTuDonVi(1);
        return view('pages.donvitable',compact('getdonvi','maxthutudonvi'));
    }

    ///////////////////////MUC LOAI DON//////////////////////

    /**************************************************
    Function Name	: page_qtdanhmucloaidon
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_qtdanhmucloaidon()
    {
        $getloaidon = DanhMucPage::GetLoaiDon();
        return view('pages.qtdanhmucloaidon',compact('getloaidon'));
    }

    /**************************************************
    Function Name	: themloaidon
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function themloaidon(Request $request)
    {
        $result = DanhMucPage::StoreLoaiDon($request);
        return redirect('qtdanhmucloaidon')->with([
           'themloaidon_result' =>  $result
        ]);
    }

    /**************************************************
    Function Name	: xoaloaidon
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function xoaloaidon(Request $request)
    {
        $result = DanhMucPage::XoaLoaiDon($request->loaidonid);
        return response()->json(['xoaloaidon_result' => $result]);
    }

    /**************************************************
    Function Name	: chinhsualoaidon
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function chinhsualoaidon($id)
    {
        $loaidon = DanhMucPage::GetLoaiDonTheoID($id);
        return view('pages.chinhsualoaidon',compact('loaidon'));
    }

    /**************************************************
    Function Name	: chinhsualoaidon
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitchinhsualoaidon(Request $request, $id)
    {
        $result = DanhMucPage::UpdateLoaiDon($request,$id);
        return redirect('qtdanhmucloaidon')->with([
            'chinhsualoaidon_result' =>  $result
        ]);
    }

    ///////////////////////MUC LINH VUC//////////////////////

    /**************************************************
    Function Name	: page_qtdanhmuclinhvuc
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_qtdanhmuclinhvuc()
    {
        $getlinhvuc = DanhMucPage::GetLinhVuc();
        return view('pages.qtdanhmuclinhvuc',compact('getlinhvuc'));
    }

    /**************************************************
    Function Name	: themlinhvuc
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function themlinhvuc(Request $request)
    {
        $result = DanhMucPage::StoreLinhVuc($request);
        return redirect('qtdanhmuclinhvuc')->with([
            'themlinhvuc_result' =>  $result
        ]);
    }

    /**************************************************
    Function Name	: xoalinhvuc
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function xoalinhvuc(Request $request)
    {
        $result = DanhMucPage::XoaLinhVuc($request->loaidonid);
        return response()->json(['xoalinhvuc_result' => $result]);
    }

    /**************************************************
    Function Name	: chinhsualinhvuc
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function chinhsualinhvuc($id)
    {
        $linhvuc = DanhMucPage::GetLinhVucTheoID($id);
        return view('pages.chinhsualinhvuc',compact('linhvuc'));
    }

    /**************************************************
    Function Name	: submitchinhsualinhvuc
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitchinhsualinhvuc(Request $request, $id)
    {
        $result = DanhMucPage::UpdateLinhVuc($request,$id);
        return redirect('qtdanhmuclinhvuc')->with([
            'chinhsualinhvuc_result' =>  $result
        ]);
    }

    ///////////////////////MUC CHU TRI//////////////////////

    /**************************************************
    Function Name	: showPageDanhMucChuTri
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function showPageDanhMucChuTri()
    {
        $getChuTri = DanhMucPage::getChuTri();
        return view('pages.qtdanhmucchutri',compact('getChuTri'));
    }

    /**************************************************
    Function Name	: getChucVuTheoId
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function getChucVuTheoId(Request $request)
    {
        $tenChucVu = DanhMucPage::getChucVuTheoId($request->id);
        return response()->json([
            'tenChucVu' => $tenChucVu
        ]);
    }

    /**************************************************
    Function Name	: xoaChuTriTheoId
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function xoaChuTriTheoId(Request $request)
    {
        $result = DanhMucPage::xoaChuTriTheoId($request->id);
        return response()->json([
            'xoaResult' => $result
        ]);
    }

    /**************************************************
    Function Name	: themChuTri
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function themChuTri(Request $request)
    {
        $result = DanhMucPage::themChuTri($request);
        return redirect('qtdanhmucchutri')->with([
            'themResult' =>  $result
        ]);
    }


    ///////////////////////MUC THAM QUYEN//////////////////////

    /**************************************************
    Function Name	: page_thamquyen
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_thamquyen()
    {
        $getthamquyen = DanhMucPage::GetThamQuyen();
        $maxthututhamquyen = DanhMucPage::GetMaxThuTuThamQuyen(1);
        return view('pages.thamquyen',compact('getthamquyen','maxthututhamquyen'));
    }

    /**************************************************
    Function Name	: themthamquyen
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function themthamquyen(Request $request)
    {
        $result = DanhMucPage::StoreThamQuyen($request);
        return redirect('thamquyen')->with('themthamquyen_result', $result);
    }

    /**************************************************
    Function Name	: getthongtinthamquyentheoid
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function getthongtinthamquyentheoid(Request $request)
    {
        $result = DanhMucPage::GetThongTinThamQuyenTheoID($request->thamquyenid);
        $maxthutu = DanhMucPage::GetMaxThuTuThamQuyen($request->thamquyenid);

        if($request->thamquyenid != 1) {
            $result2 = DanhMucPage::GetThongTinThamQuyenTheoID($result[0]->tructhuoc);
            $tenthamquyentructhuoc = $result2[0]->tenthamquyen;
            return response()->json([
                'thongtinthamquyen_result' => $result,
                'tenthamquyentructhuoc_result' => $tenthamquyentructhuoc,
                'maxthutu_result' => $maxthutu
            ]);
        }else{
            return response()->json([
                'thongtinthamquyen_result' => $result,
                'maxthutu_result' => $maxthutu
            ]);
        }
    }

    /**************************************************
    Function Name	: getthamquyencon
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function getthamquyencon(Request $request)
    {
        $result = DanhMucPage::GetThamQuyenCon($request->thamquyenid);
        return response()->json(['thamquyencon_result' => $result]);
    }

    /**************************************************
    Function Name	: xoathamquyen
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function xoathamquyen(Request $request)
    {
        $result = DanhMucPage::XoaThamQuyen($request->thamquyenid);
        return response()->json(['xoathamquyen_result' => $result]);
    }

    /**************************************************
    Function Name	: chinhsuathamquyen
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function chinhsuathamquyen(Request $request, $id)
    {
        $result = DanhMucPage::UpdateThamQuyen($request,$id);
        return redirect('thamquyen')->with('chinhsuathamquyen_result', $result);
    }

    /**************************************************
    Function Name	: page_danhsachnhanvien
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_danhsachnhanvien($id)
    {
        $danhsachnhanvien = NghiepVuPage::getDanhSachNhanVien();
        return view('pages.danhsachnhanvien', compact('danhsachnhanvien','id'));
    }

    /**************************************************
    Function Name	: checkmailbox
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function checkmailbox(Request $request)
    {
        $result = NghiepVuPage::countMailbox($request->accountid);
        return response()->json(['checkmaibox_result' => $result]);
    }

    /**************************************************
    Function Name	: page_mailbox
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_mailbox($id, Request $request)
    {
        if($request->session()->has('chonHienThiSoLuong')){


        } else {

            $request->session()->put('chonHienThiSoLuong', HIENTHI_10ITEMS);
        }

        $chonHienThiSoLuong = $request->session()->get('chonHienThiSoLuong');

//        $chonHienThiSoLuong = HIENTHI_10ITEMS;

        $hopthudendata = NghiepVuPage::getMailbox($id, THUGUIDEN, $chonHienThiSoLuong);
        $soLuongMailHopThuDen = NghiepVuPage::countHopThu($id, THUGUIDEN);
        $hopthudidata = NghiepVuPage::getMailbox($id, THUGUIDI, $chonHienThiSoLuong);
        $soLuongMailHopThuDi = NghiepVuPage::countHopThu($id, THUGUIDI);
        $mailbox_owner = $id;
        return view('pages.mailbox', compact('hopthudendata','mailbox_owner','hopthudidata','soLuongMailHopThuDen','soLuongMailHopThuDi'));
//        return $chonHienThiSoLuong;
    }

    /**************************************************
    Function Name	: chonHienThiSoLuong
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function chonHienThiSoLuong(Request $request)
    {

        $valueChon = $request->valueChon;
        if($request->session()->has('chonHienThiSoLuong')){

//
            $request->session()->put('chonHienThiSoLuong', $valueChon);

//            $chonHienThiSoLuong = $request->session()->get('chonHienThiSoLuong');

        } else {

            $request->session()->put('chonHienThiSoLuong', HIENTHI_10ITEMS);
        }
        return response()->json(['chonHienThiSoLuong_result' => true]);
    }

    /**************************************************
    Function Name	: chonHopThu
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function chonHopThu(Request $request)
    {

        if('tabHopThuDen' == $request->chonHopThu) {
            $chonHopThu = HOPTHUDEN;
        }else{
            $chonHopThu = HOPTHUDI;
        }
        if($request->session()->has('chonHopThu')){

            $request->session()->put('chonHopThu', $chonHopThu);

        } else {

            $request->session()->put('chonHopThu', HOPTHUDEN);
        }
        return response()->json(['chonHopThu_result' => true]);
    }


    /**************************************************
    Function Name	: xoamailboxtheoid
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function xoamailboxtheoid(Request $request)
    {
        $result = NghiepVuPage::xoaMailboxTheoID($request->mailid);
        return response()->json(['xoamailboxtheoid_result' => $result]);
    }

    /**************************************************
    Function Name	: page_taothuguidi
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_taothuguidi()
    {
        $danhsachnguoigui = NghiepVuPage::getDanhSachNhanVien();
        return view('pages.taothuguidi', compact('danhsachnguoigui'));
    }

    /**************************************************
    Function Name	: page_taothuguidi
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_noidungemail($id)
    {
        $donthu = NghiepVuPage::getEmailTheoID($id);
        return view('pages.noidungemail', compact('donthu'));
    }

    /**************************************************
    Function Name	: updatetrangthaimail
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function updatestatusemail(Request $request)
    {
        $result = NghiepVuPage::updateStatusEmail($request->id);
        return response()->json(['updatestatusemail_result' => $result]);
    }

    /**************************************************
    Function Name	: submittaothuguidi
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submittaothuguidi(Request $request)
    {
        $result = NghiepVuPage::sendEmail($request);
        return redirect('mailbox/'.$request->nguoigui);
    }

    /**************************************************
    Function Name	: page_detaildonthulan1
    Description		:
    Argument		: $donthuid
    Creation Date	: 2016/08/01
    Author			: duongpd1
    Reviewer		: PhucHM
     ***************************************************/
    public function page_detaildonthulan1($donthuid)
    {
        //$donthuid = $request->donthuid;
        $donthu = NghiepVuPage::GetDataDetailDonThu($donthuid);
        $quyenXL = DanhMucPage::GetThamQuyen();

        $diaban_id = $donthu['phanloai']->diaban;
        $donvi_id = $donthu['phanloai']->donvi;

        $accountId = Session::get('accountid');

        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diaban_id,$diaBanIdAll);
        $nguoi_xuly = NghiepVuPage::GetNguoiXLTheoDonVi($donvi_id,$diaBanIdAllArray);

        return view('pages.detaildonthulan1',compact('donthu','quyenXL','nguoi_xuly'));
    }

    /**************************************************
    Function Name	: exportMauDon01
    Description		:
    Argument		: $donThuId
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function exportMauDon01($donThuId){

        $objWriter = NghiepVuPage::exportMauDon01($donThuId);

        $objWriter->save('php://output');
    }

    /**************************************************
    Function Name	: exportMauDon02
    Description		:
    Argument		: $donThuId
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function exportMauDon02($donThuId){

        $objWriter = NghiepVuPage::exportMauDon02($donThuId);

        $objWriter->save('php://output');
    }

    /**************************************************
    Function Name	: exportMauDon03
    Description		:
    Argument		: $donThuId
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function exportMauDon03($donThuId){

        $objWriter = NghiepVuPage::exportMauDon03($donThuId);

        $objWriter->save('php://output');
    }

    /**************************************************
    Function Name	: exportMauDon04
    Description		:
    Argument		: $donThuId
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function exportMauDon04($donThuId){

        $objWriter = NghiepVuPage::exportMauDon04($donThuId);

        $objWriter->save('php://output');
    }

    /**************************************************
    Function Name	: exportMauDon05
    Description		:
    Argument		: $donThuId
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function exportMauDon05($donThuId){

        $objWriter = NghiepVuPage::exportMauDon05($donThuId);

        $objWriter->save('php://output');
    }

    /**************************************************
    Function Name	: exportPhieuHen
    Description		:
    Argument		: $tiepDanId
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function exportPhieuHen($tiepDanId){

        $objWriter = NghiepVuPage::exportPhieuHen($tiepDanId);

        $objWriter->save('php://output');
    }

    /**************************************************
    Function Name	: inDanhSachTiepCongDan
    Description		: in danh Sach Tiep Cong Dan
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function inDanhSachTiepCongDan(){

        $accountId = Session::get('accountid');
        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);
        $diaBanId = $accountInfo[0]->diaban;
        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diaBanId,$diaBanIdAll);

        $objWriter = NghiepVuPage::inDanhSachTiepCongDan($diaBanIdAllArray);
        $objWriter->save('php://output');
    }

    /**************************************************
    Function Name	: inDanhSachDonThu
    Description		: in Danh Sach Don Thu
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function inDanhSachDonThu(Request $request){

        $objWriter = NghiepVuPage::inDanhSachDonThu($request);
        $objWriter->save('php://output');
    }

    /**************************************************
    Function Name	: inDanhSachDonThuDHQH
    Description		: in Danh Sach Don Thu DHQH
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function inDanhSachDonThuDHQH(Request $request){

        $objWriter = NghiepVuPage::inDanhSachDonThuDHQH($request);
        $objWriter->save('php://output');
    }

    /**************************************************
    Function Name	: inLichTiepDan
    Description		: in Lich Tiep Dan
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function inLichTiepDan(){

        $accountId = Session::get('accountid');
        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);
        $diaBanId = $accountInfo[0]->diaban;
        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diaBanId,$diaBanIdAll);
        $objWriter = NghiepVuPage::inLichTiepDan($diaBanIdAllArray);
        $objWriter->save('php://output');
    }
    /**************************************************
    Function Name	: getTimKiem
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duondpd
    Reviewer		: PhucHM
     ***************************************************/
    public function getTimKiem(Request $request)
    {
        $name = $request->value;
        $data = NghiepVuPage::getSearchDonThu($name);

        return $data;
    }
	
	    /**************************************************
    Function Name	: page_baocaodotxuat
    Description		:
    Argument		: None
    Creation Date	: 2016/12/19
    Author			: NamNH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_baocaodotxuat()
    {
        $baocaos = NghiepVuPage::GetBaoCaoDotXuat();
        return view('pages.baocaodotxuat',compact('baocaos'));
    }
    /**************************************************
    Function Name	: thembaocaodotxuat
    Description		:
    Argument		: $request
    Creation Date	: 2016/12/19
    Author			: NamNH
    Reviewer		: PhucHM
     ***************************************************/
    public function thembaocaodotxuat(Request $request)
    {
        NghiepVuPage::StoreBaoCaoDotXuat($request);
        //$baocaos = NghiepVuPage::GetBaoCaoDotXuat();
        return redirect('baocaodotxuat');
    }
    /**************************************************
    Function Name	: page_taobaocaodotxuat
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: NamNH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_taobaocaodotxuat()
    {
        return view('pages.taobaocaodotxuat');
    }
    /**************************************************
    Function Name	: xoabaocao
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: NamNH
    Reviewer		: PhucHM
     ***************************************************/
    public function xoabaocao(Request $request)
    {
        $result = NghiepVuPage::XoaBaoCaoDotXuat($request);
        return $result;
//        return response()->json(['xoabaocao_result' => $result]);
    }
    /**************************************************
    Function Name	: chinhsuabaocaodotxuat
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: NamNH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_ChinhSuaBaoCaoDotXuat($baoCaoID)
    {
        $baocao = NghiepVuPage::page_ChinhSuaBaoCaoDotXuat($baoCaoID);
        return view('pages.chinhsuabaocaodotxuat',compact('baocao'));
    }
    /**************************************************
    Function Name	: SuaBaoCaoDotXuat
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: NamNH
    Reviewer		: PhucHM
     ***************************************************/
    public function SuaBaoCaoDotXuat(Request $request, $id)
    {
        NghiepVuPage::SuaBaoCaoDotXuat($request,$id);
        return redirect('baocaodotxuat');
    }
    /**************************************************
    Function Name	: donThuGiongNhau
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function donThuGiongNhau(Request $request)
    {
        $result = TraCuuPage::GetDataDonThuGiongNhau($request);
        return $result;
    }
    /**************************************************
    Function Name	: getDanhSachDonThuCungCMT
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function getDanhSachDonThuCungCMT($request)
    {
        $data = $request;
        $data = explode('*',$data);
        $value = $data[0];
        $filed = $data[1];
        $table = $data[2];
        $result = NghiepVuPage::getDonThuCungCMT($value,$filed,$table);

        return view('pages.danhsachdonthucungcmt',compact('result','filed'));

    }
    /**************************************************
    Function Name	: getDanhSachDonThuNhieuNoi
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function getDanhSachDonThuNhieuNoi($value)
    {
        $donthu = TongHopPage::getDonThuCungNguoiKN($value);
        return view('pages.danhsachdonthunhieunoi',compact('donthu','value'));
    }
    /**************************************************
    Function Name	: getChiTietDonThuNhieuNoi
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function getChiTietDonThuNhieuNoi($value)
    {
        $data = NghiepVuPage::dataChiTietDonThuNhieuNoi($value);

        return view('pages.chitietdonthunhieunoi',compact('data'));

    }
    /**************************************************
    Function Name	: getThongTinChuDon
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function getThongTinChuDon(Request $request)
    {

        $data = TongHopPage::TongHopThongTinChuDon($request);

        return view('pages.thongtinchudon',compact('data'));
    }
    /**************************************************
    Function Name	: ThemCongDanKhac
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function ThemCongDanKhac(Request $request)
    {
        $dataCD = TiepDanPage::InsertCongDanKhac($request);

        return $dataCD;
    }
    /**************************************************
    Function Name	: XoaCongDanKhac
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function XoaCongDanKhac(Request $request)
    {
        $dataCD = TiepDanPage::DeleteCongDanKhac($request);

        return $dataCD;
    }
    /**************************************************
    Function Name	: TongSoDonTrongKy
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function TongSoDonTrongKy($type1,$type2,$diabanId)
    {
        $year = date("Y");
        if($type1 == TRONG_KY)
        {
            $loai_hien_thi = "TRONG K? ".$year;
        }
        else
        {
            $loai_hien_thi = "TR�N TO�N �?A B�N";
        }
        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diabanId,$diaBanIdAll);

        $results = NghiepVuPage::GetTongDonTheoKy($type1,$type2,$diaBanIdAllArray);

        return view('pages.danhsachdonthutheodiaban',compact('loai_hien_thi','results'));
    }
    /**************************************************
    Function Name	: TongSoDonTheoPhanLoai
    Description		:
    Argument		:
    Creation Date	: 2016/12/19
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function TongSoDonTheoPhanLoai($type1,$type2,$diabanId)
    {
        $loai_hien_thi = "Theo Phan Loai";
        if($type1 == "LV")
        {
            $loai_hien_thi = 'THEO LINH V?C';
        }
        elseif($type1 == "LD")
        {
            $loai_hien_thi = 'THEO LO?I �ON';
        }
        else
        {
            $loai_hien_thi = 'THEO �?A B�N';
        }
        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diabanId,$diaBanIdAll);
        $results = NghiepVuPage::GetTongDonTrongKyTheoPhanLoai($type1,$type2,$diaBanIdAllArray);

        return view('pages.danhsachdonthutheodiaban',compact('loai_hien_thi','results'));
    }

    /**************************************************
    Function Name	: page_danhsachdonthumoicanxuly
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_danhsachdonthumoicanxuly()
    {
        $accountId = Session::get('accountid');
        $donThuDuocGiao = NghiepVuPage::getDonThuDuocGiaoTheoIdPagination($accountId);
        return view('pages.danhsachdonthumoicanxuly',compact('donThuDuocGiao'));
    }
    /**************************************************
    Function Name	: GetNguoiXuLy
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function GetNguoiXuLy(Request $request)
    {
        $diaBanId = $request->diabanId;
        $donViId = $request->donviId;
        $data = NghiepVuPage::GetDataNguoiXuLy($diaBanId,$donViId);

        return $data;
    }
    /**************************************************
    Function Name	: DanhSachKetQuaGQDon
    Description		:
    Argument		: None
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function DanhSachKetQuaGQDon($type,$loaidonId)
    {
        $accountId = Session::get('accountid');

        $accountInfo = DangNhapPage::GetDiaBanTheoAccountId($accountId);

        $diabanId = $accountInfo[0]->diaban;

        $diaBanIdAll = [];
        $diaBanIdAllArray = ChuyenVienController::getDeQuyDiaBan($diabanId,$diaBanIdAll);

        $results = NghiepVuPage::KetQuaGiaiQuyetDonTheoLoaiDon($diaBanIdAllArray,$type,$loaidonId);

        $loai_hien_thi = "K?T TH?C";
        if($type == 'DAGIAIQUYET')
        {
            $loai_hien_thi = "?? GI?I QUY?T";
        }

        return view('pages.danhsachdonthutheodiaban',compact('loai_hien_thi','results'));
    }
    /**************************************************
    Function Name	: exportPhieuCHuyenDon
    Description		:
    Argument		: None
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function exportPhieuChuyenDon(Request $request,$donThuId)
    {

        if(isset($request->type) && $request->type  == 'download')
        {
            $linkData = Session::get('download');

            if(Session::has('download'))
            {
                Session::forget('download');
            }

            return response()->download($linkData['value']);
        }
        else
        {

            if(Session::has('download'))
            {
                Session::forget('download');
            }

            $accountId = Session::get('accountid');

            $objWriter = NghiepVuPage::exportPhieuChuyenDon($donThuId,$accountId);

            $linkData = array(
                'type' => 'phieuChuyenDon',
                'value' => 'file/'.$objWriter
            );

            Session::put('download', $linkData);

            return redirect()->back();
        }
    }
    /**************************************************
    Function Name	: exportPhieuXuLy
    Description		:
    Argument		: None
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function exportPhieuXuLy(Request $request, $donThuId)
    {
        if(isset($request->type) && $request->type  == 'download')
        {
            $linkData = Session::get('download');

            if(Session::has('download'))
            {
                Session::forget('download');
            }

            return response()->download($linkData['value']);
        }
        else
        {
            if(Session::has('download'))
            {
                Session::forget('download');
            }

            $accountId = Session::get('accountid');
            $objWriter = NghiepVuPage::exportPhieuXuLy($donThuId,$accountId);

            $linkData = array(
                'type' => 'phieuXuLy',
                'value' => 'file/'.$objWriter
            );

            Session::put('download', $linkData);

            return redirect()->back();
        }
    }

    /**************************************************
    Function Name	: ChinhSuaChiTietDon
    Description		:
    Argument		: $donthuId
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function ChinhSuaChiTietDon(Request $request)
    {
        $donthuid = $request->donthuid;
        $accountId = $request->accountid;
        $results = NghiepVuPage::PostLichSuGiaoXuLy($request);

        if($request->vanBanXL != ""){

            $name = NghiepVuPage::updateFilePhieuTrinh($donthuid,$request,$accountId);
        }
        $nguoi_nhan_id = $request->nguoixuly;

        $sothuly = $request->sothuly;
        $sothuly = explode('/',$sothuly);
        $sothuly = implode('-',$sothuly);
        if($nguoi_nhan_id != null)
        {
            NghiepVuPage::assigneeNguoiXuLy($donthuid,$sothuly,$accountId,$nguoi_nhan_id);
        }

        return  redirect('chitietdonthu/'.$results);
    }

    /**************************************************
    Function Name	: SenCommentCV
    Description		:
    Argument		: $donthuId
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function SenCommentCV(Request $request)
    {
        $results = VanBanPage::PostCommentDon($request);
        return $results;
    }
    /**************************************************
    Function Name	: AutoComplete
    Description		:
    Argument		: $request
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function AutoComplete(Request $request)
    {
        return 1;
    }

    /**************************************************
    Function Name	: AutoComplete
    Description		:
    Argument		: $request
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function getNumberDonthuOfMaster(Request $request)
    {
        //$accountId = $request->accountId;

        $data = DonThuTable::getDataOfDothuOfMasterUser();

        return array($data);
    }
    /**************************************************
    Function Name	: ThemNguoiTheoDoi
    Description		:
    Argument		: $request
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function ThemNguoiTheoDoi(Request $request)
    {

        $result = TheoDoiDonThuTable::InsertNguoiTheoDoi($request);

        return $result;
    }
    /**************************************************
    Function Name	: XoaNguoiTheoDoi
    Description		:
    Argument		: $request
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function XoaNguoiTheoDoi(Request $request)
    {

        $result = TheoDoiDonThuTable::DeleteNguoiTheoDoi($request);

        return $result;
    }
    /**************************************************
    Function Name	: UpdateComment
    Description		:
    Argument		: $request
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function UpdateComment(Request $request)
    {

        $result = VanBanTable::UpdateCommentTheoId($request);

        return $result;
    }
    /**************************************************
    Function Name	: PostLuuHoSo
    Description		:
    Argument		: $request
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function PostLuuHoSo(Request $request)
    {
        $result = ChiTietDonPage::PostLuuHoSoTheoId($request);

        return $result;
    }
    /**************************************************
    Function Name	: exportPhieuHuongDan
    Description		:
    Argument		: $request
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function exportPhieuHuongDan(Request $request)
    {

        $accountId = Session::get('accountid');
        $objWriter = NghiepVuPage::ExportPhieuHuongDan($request,$accountId);

        return $objWriter;
    }
    /**************************************************
    Function Name	: exportVanBanTraLoi
    Description		:
    Argument		: $request
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function exportVanBanTraLoi(Request $request, $donThuId)
    {
        if(isset($request->type) && $request->type  == 'download')
        {
            $linkData = Session::get('download');

            if(Session::has('download'))
            {
                Session::forget('download');
            }

            return response()->download($linkData['value']);
        }
        else
        {
            if(Session::has('download'))
            {
                Session::forget('download');
            }

            $accountId = Session::get('accountid');
            $objWriter = NghiepVuPage::ExportVanBanTraLoi($donThuId,$accountId);

            $linkData = array(
                'type' => 'vanBanTraLoi',
                'value' => 'file/'.$objWriter
            );

            Session::put('download', $linkData);

            return redirect()->back();
        }
    }
    /**************************************************
    Function Name	: previewVanBan
    Description		:
    Argument		: $request
    Creation Date	: 2017/05/27
    Author			: duongpd
    Reviewer		: PhucHM
     ***************************************************/
    public function previewVanBan(Request $request){

        $aryData =array(
            'donthuId'=>$request->donthuid,
            'soKH'=>$request->soKH,
            'loaiVB'=>$request->loaiVB,
            'tieuDe'=>$request->tieuDe,
            'noiDung'=>$request->noiDung,
            'noiNhan'=>$request->noiNhan,
        );

        $result = NghiepVuPage::PreviewVanBan($aryData);

        return $result;

    }

    /*****************************
     * @param Request $request
     */

    public function exportWord(Request $request){

        $result = NghiepVuPage::exportToWord($request);

        return $result;

    }

    /***********************************
     * @param Request $request
     * @return string
     * @throws \Throwable
     */
    public function filter_tracuu_csdlqg(Request $request)
    {

        $data = $html = [];
        if($request->danhmuc == CSDLQGService::TRA_DANH_MUC){
            $arg_dm = [
                'LoaiDanhMuc' => $request->loaiDM,
                'MaTinh' => "217",
                'MaBoNganh' => '',
                'MaLoaiKhieuTo' => ''
            ];
            $data = (new CSDLQGService())->TraDanhMuc($arg_dm);

            $html = 'pages.tracuu.bang_ket_qua';

        }else{
            $arg = [
                'MaVuViec' => "",
                'TenNguoiKhieuNai' => trim($request->tenChuDon),
                'MaTinh' => "217",
                'MaHuyen' => "",
                'MaXa' => "",
                'SoDinhDanhCaNhan' => trim($request->cmt),
                'NoiDung' => ""
            ];
            $data = (new CSDLQGService())->TraThongTinDon($arg);
            $html = 'pages.tracuu.bang_ttdt';
        }
        $arrData['data'] = json_decode($data, true);

        return view($html,$arrData)->render();
    }

    /*************************
     * @param Request $request
     * @return string
     * @throws \PhpOffice\PhpWord\Exception\Exception
     */
    public function exportVanBan(Request $request)
    {
        $result = (new MauDon())->creatFile($request);

        return $result;
    }

    /***************************************
     * @param Request $request
     * @return bool|mixed|string
     */
    public function getNoiDungFromTemplateTxt(Request $request)
    {
        $strVB = (new MauDon())->readTemplateTxt($request->donthuid,$request->vbKey);

        return $strVB;
    }

    /*****************************
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadFile()
    {
        $pathToFile = FOLDERROOT.'/'.request('path','').'/'.request('fileName','');

        if(!file_exists($pathToFile))
        {
            return Redirect::back()->withErrors('Không tìm thấy file!');
        }
        else{
            return response()->download($pathToFile);
        }

    }
    public function GetAutoComplete(Request $request)
    {

        $data = (new DonThuTable())->GetAutoComplete($request);

        return View::make('pages.component.suggest', ['data' => $data, 'key' => $request->key_word, 'id' => $request->id])->render();
    }

    public function updateSoKiHieu(Request $request)
    {

        $data = (new DonThuTable())->UpdateSoKiHieuVanBan($request->id,$request->so_kihieu);

        $error = false;
        if (!$data)
        {
            $error = true;
        }

        return response()->json(
            [
                'data'   => $data,
                'error' => $error,
            ]
        );

    }

}
