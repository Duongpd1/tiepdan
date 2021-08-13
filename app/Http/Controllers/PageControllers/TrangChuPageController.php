<?php

namespace App\Http\Controllers\PageControllers;

use App\Http\Controllers\Controller;

use App\Model\PageModel\DanhMucPage;
use App\Model\PageModel\TrangChuPage;
use Illuminate\Http\Request;

use App\Http\Requests;


class TrangChuPageController extends Controller
{
    /**************************************************
    Function Name	: page_trangchu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function page_trangchu(){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        return view('pages.trangchu',compact('trangchudata'));
    }

    /**************************************************
    Function Name	: page_gioithieuchung
    Description		:
    Argument		: $typeid,$id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_gioithieuchung(){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        return view('pages.gioithieuchung',compact('trangchudata','id'));
    }

    /**************************************************
    Function Name	: page_noidunggioithieuchung
    Description		:
    Argument		: $typeid,$id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_noidunggioithieuchung($typeid,$id){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        return view('pages.noidunggioithieuchung',compact('trangchudata','id'));
    }

    /**************************************************
    Function Name	: page_chucnangnhiemvu
    Description		:
    Argument		: $typeid,$id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_chucnangnhiemvu(){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        return view('pages.chucnangnhiemvu',compact('trangchudata'));

    }

    /**************************************************
    Function Name	: page_noidungchucnangnhiemvu
    Description		:
    Argument		: $typeid,$id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_noidungchucnangnhiemvu($typeid,$id){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        return view('pages.noidungchucnangnhiemvu',compact('trangchudata','id'));
    }

    /**************************************************
    Function Name	: page_lanhdaothanhtratinhphutho
    Description		:
    Argument		: $typeid,$id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_lanhdaothanhtratinhphutho(){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        return view('pages.lanhdaothanhtratinhphutho',compact('trangchudata','id'));

    }

    /**************************************************
    Function Name	: page_noidunglanhdaothanhtratinhphutho
    Description		:
    Argument		: $typeid,$id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_noidunglanhdaothanhtratinhphutho($typeid,$id){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        return view('pages.noidunglanhdaothanhtratinhphutho',compact('trangchudata','id'));

    }

    /**************************************************
    Function Name	: page_tintiepcongdan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_tintiepcongdan(){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        return view('pages.tintiepcongdan',compact('trangchudata'));

    }

    /**************************************************
    Function Name	: page_noidungthongtintiepdan
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_noidungthongtintiepdan($typeid,$id){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        return view('pages.noidungthongtintiepdan',compact('trangchudata','id'));

    }

    /**************************************************
    Function Name	: page_tintuchoatdong
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_tintuchoatdong(){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
//        $tintuchoatdongdata = TrangChuPage::GetBaiVietTinTucHoatDong();
        return view('pages.tintuchoatdong',compact('trangchudata'));
    }

    /**************************************************
    Function Name	: page_noidungtintuchoatdong
    Description		:
    Argument		: $typeid, $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_noidungtintuchoatdong($typeid, $id){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
//        $tintuchoatdongdata = TrangChuPage::GetNoiDungBaiVietTinTucHoatDong();
        return view('pages.noidungtintuchoatdong',compact('trangchudata','id'));
    }

    /**************************************************
    Function Name	: page_lienhe
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_lienhe(){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        return view('pages.lienhe',compact('trangchudata'));
    }

    /**************************************************
    Function Name	: submitlienhe
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submitlienhe(Request $request){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        $submitgopytrogiup = TrangChuPage::StoreGopYTroGiup($request,GOPYCD);
        return redirect('lienhe')->with(['trangchudata' => $trangchudata, 'submitgopytrogiup_result' => $submitgopytrogiup]);
    }

    /**************************************************
    Function Name	: page_congdandenghitrogiupphapluat
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_congdandenghitrogiupphapluat(){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        return view('pages.congdandenghitrogiupphapluat',compact('trangchudata'));

    }

    /**************************************************
    Function Name	: submittrogiupphapluat
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function submittrogiupphapluat(Request $request){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        $submittrogiupphapluat = TrangChuPage::StoreGopYTroGiup($request,TROGIUPPL);
        return redirect('congdandenghitrogiupphapluat')->with(['trangchudata' => $trangchudata, 'submittrogiupphapluat_result' => $submittrogiupphapluat]);
    }

    /**************************************************
    Function Name	: page_vanban
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_vanban(){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        return view('pages.vanban',compact('trangchudata'));
    }

    /**************************************************
    Function Name	: page_noidungvanban
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_noidungvanban($id){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        return view('pages.noidungvanban',compact('trangchudata', 'id'));
    }

    /**************************************************
    Function Name	: searchvanban
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function searchvanban(Request $request){

        $result = TrangChuPage::SearchVanBan($request);
        return response()->json(['search_result' => $result]);
    }

    /**************************************************
    Function Name	: page_tracuu
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_tracuu(){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        return view('pages.tracuu',compact('trangchudata'));

    }

    /**************************************************
    Function Name	: page_lichtiepcongdan
    Description		:
    Argument		: None
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_lichtiepcongdan(){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        $lichtiepcongdandata = TrangChuPage::GetLichTiepCongDan();
        return view('pages.lichtiepcongdan',compact('trangchudata','lichtiepcongdandata'));
    }

    /**************************************************
    Function Name	: selectlichtiepdantheothang
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function selectlichtiepdantheothang(Request $request){

        $result = TrangChuPage::SelectLichTiepDanTheoThang($request);
        return response()->json(['select_result' => $result]);
    }

    /**************************************************
    Function Name	: page_baivietthongbao
    Description		:
    Argument		: $id
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_baivietthongbao($id){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        return view('pages.baivietthongbao',compact('trangchudata','id'));
    }

    /**************************************************
    Function Name	: page_chitietgiaiquyetkntc
    Description		:
    Argument		: $kntcid
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_chitietgiaiquyetkntc($kntcid){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        $ketquagiaiquyet = TrangChuPage::GetKetQuaGiaiQuyetTheoID($kntcid);
        return view('pages.chitietgiaiquyetkntc',compact('trangchudata','kntcid','ketquagiaiquyet'));

    }

/////////////////////////KET QUA XU LÝ DON THU KHIEU NAI TO CAO////////////////////////////

    /**************************************************
    Function Name	: page_ketquaxulydonthukhieunaitocao
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_ketquaxulydonthukhieunaitocao(){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        return view('pages.ketquaxulydonthukhieunaitocao',compact('trangchudata'));
    }

    /**************************************************
    Function Name	: page_noidungxulydonthukhieunaitocao
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_noidungxulydonthukhieunaitocao($donthukntcid){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        $thongtintheodoidonthu = TrangChuPage::GetTheoDoiDonThuTheoID($donthukntcid);
        return view('pages.noidungxulydonthukhieunaitocao',compact('trangchudata','donthukntcid','thongtintheodoidonthu'));

    }

/////////////////////////KET QUA TIEP DAN////////////////////////////

    /**************************************************
    Function Name	: page_ketquatiepdan
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_ketquatiepdan(){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        return view('pages.ketquatiepdan',compact('trangchudata'));

    }

    /**************************************************
    Function Name	: page_noidungketquatiepdan
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_noidungketquatiepdan($tiepdanid){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        $ketquatiepdan = TrangChuPage::GetKetQuaTiepDanTheoID($tiepdanid);
        $tenloaihinh = TrangChuPage::GetTenLoaiDon($ketquatiepdan[0]->loaihinh);
        $tenlinhvuc = TrangChuPage::GetTenLinhVuc($ketquatiepdan[0]->linhvuc);
        $tendiaban = TrangChuPage::GetTenDiaBan($ketquatiepdan[0]->diaban);
        return view('pages.noidungketquatiepdan',compact('trangchudata','tiepdanid','tenloaihinh','tenlinhvuc','tendiaban'));
    }

    /**************************************************
    Function Name	: searchketquatiepdan
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function searchketquatiepdan(Request $request){

        $result = TrangChuPage::SearchKetQuaTiepDan($request);
        return response()->json(['search_result' => $result]);
    }

    /**************************************************
    Function Name	: searchketquakntc
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function searchketquakntc(Request $request){

        $result = TrangChuPage::SearchKetQuaKNTC($request);
        return response()->json(['search_result' => $result]);
    }

    /**************************************************
    Function Name	: searchketquaxulykntc
    Description		:
    Argument		: $request
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function searchketquaxulykntc(Request $request){

        $result = TrangChuPage::SearchKetQuaXuLyKNTC($request);
        return response()->json(['search_result' => $result]);
    }

    /**************************************************
    Function Name	: page_tinkhieunaitocao
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_tinkhieunaitocao(){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        return view('pages.tinkhieunaitocao',compact('trangchudata'));

    }

    /**************************************************
    Function Name	: page_noidungtinkhieunaitocao
    Description		:
    Argument		:
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public function page_noidungtinkhieunaitocao($typeid,$id){

        $trangchudata = TrangChuPage::GetBaiVietTrangChu();
        return view('pages.noidungtinkhieunaitocao',compact('trangchudata','id'));

    }


    function page_tablediaban()
    {
        $diaban = DanhMucPage::GetDiaBan();
        return view('pages.tablediaban',compact('diaban'));
    }

    function page_tabledonvi()
    {
        $donvi = DanhMucPage::GetDonVi();
        return view('pages.tabledonvi',compact('donvi'));
    }


}
