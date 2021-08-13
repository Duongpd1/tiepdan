<?php
/****************************************************************
File Name       : route.php
Description     : Here is where you can register all of the routes for an application.
It's a breeze. Simply tell Laravel the URIs it should respond to
and give it the controller to call when that URI is requested.
Creation Date   : 2016/06/10
Author          : FPT/KhanhTH
Change History  :
 ****************************************************************/

/////////////////////////TRANG CHU////////////////////////////
Route::get('/', function () {
    return redirect('trangchu');
});

Route::get('trangchu','PageControllers\TrangChuPageController@page_trangchu');

/////////////////////////GIOI THIEU CHUNG////////////////////////////
Route::get('gioithieuchung','PageControllers\TrangChuPageController@page_gioithieuchung');
Route::get('noidunggioithieuchung/{typeid}/{id}','PageControllers\TrangChuPageController@page_noidunggioithieuchung');

/////////////////////////CHUC NANG NHIEM VU////////////////////////////
Route::get('chucnangnhiemvu','PageControllers\TrangChuPageController@page_chucnangnhiemvu');
Route::get('noidungchucnangnhiemvu/{typeid}/{id}','PageControllers\TrangChuPageController@page_noidungchucnangnhiemvu');

/////////////////////////LANH DAO THANH TRA TINH PHU THO////////////////////////////
Route::get('lanhdaothanhtratinhphutho','PageControllers\TrangChuPageController@page_lanhdaothanhtratinhphutho');
Route::get('noidunglanhdaothanhtratinhphutho/{typeid}/{id}','PageControllers\TrangChuPageController@page_noidunglanhdaothanhtratinhphutho');

/////////////////////////TIN TUC HOAT DONG////////////////////////////
Route::get('tintuchoatdong','PageControllers\TrangChuPageController@page_tintuchoatdong');
Route::get('noidungtintuchoatdong/{typeid}/{id}','PageControllers\TrangChuPageController@page_noidungtintuchoatdong');

/////////////////////////LIEN HE (GOP Y)////////////////////////////
Route::get('lienhe','PageControllers\TrangChuPageController@page_lienhe');
Route::post('submitlienhe','PageControllers\TrangChuPageController@submitlienhe');

/////////////////////////TRO GIUP PHAP LUAT////////////////////////////
Route::get('congdandenghitrogiupphapluat','PageControllers\TrangChuPageController@page_congdandenghitrogiupphapluat');
Route::post('submittrogiupphapluat','PageControllers\TrangChuPageController@submittrogiupphapluat');

/////////////////////////THONG BAO////////////////////////////
Route::get('baivietthongbao/{id}','PageControllers\TrangChuPageController@page_baivietthongbao');

/////////////////////////VAN BAN////////////////////////////
Route::get('vanban','PageControllers\TrangChuPageController@page_vanban');
Route::get('vanbanphapluat/{id}','PageControllers\TrangChuPageController@page_noidungvanban');
Route::get('searchvanban','PageControllers\TrangChuPageController@searchvanban');

/////////////////////////MUC TRA CUU////////////////////////////
/////////////////////////LICH TIEP CONG DAN////////////////////////////
Route::get('lichtiepcongdan','PageControllers\TrangChuPageController@page_lichtiepcongdan');
Route::get('selectlichtiepdantheothang','PageControllers\TrangChuPageController@selectlichtiepdantheothang');

/////////////////////////KET QUA TIEP DAN////////////////////////////
Route::get('ketquatiepdan','PageControllers\TrangChuPageController@page_ketquatiepdan');
Route::get('noidungketquatiepdan/{tiepdanid}','PageControllers\TrangChuPageController@page_noidungketquatiepdan');
Route::get('searchketquatiepdan','PageControllers\TrangChuPageController@searchketquatiepdan');

/////////////////////////CHI TIET GIAI QUYET KHIEU NAI TO CAO////////////////////////////
Route::get('tracuu','PageControllers\TrangChuPageController@page_tracuu');
Route::get('ketquakntc/{kntcid}','PageControllers\TrangChuPageController@page_chitietgiaiquyetkntc');
Route::get('searchketquakntc','PageControllers\TrangChuPageController@searchketquakntc');

/////////////////////////KET QUA XU LÝ DON THU KHIEU NAI TO CAO////////////////////////////
Route::get('ketquaxulydonthukhieunaitocao','PageControllers\TrangChuPageController@page_ketquaxulydonthukhieunaitocao');
Route::get('noidungxulydonthukhieunaitocao/{donthukntcid}','PageControllers\TrangChuPageController@page_noidungxulydonthukhieunaitocao');
Route::get('searchketquaxulykntc','PageControllers\TrangChuPageController@searchketquaxulykntc');

/////////////////////////DANG NHAP////////////////////////////
Route::get('dangnhap','PageControllers\DangNhapPageController@page_dangnhap');
Route::post('submitdangnhap','PageControllers\DangNhapPageController@submitdangnhap');

/////////////////////////THOAT////////////////////////////
Route::get('thoat', function () {

    Session::flush();
    return redirect('/dangnhap');
});

/////////////////////////QUEN MAT KHAU////////////////////////////
Route::get('doimatkhau','PageControllers\DoiMatKhauController@page_doimatkhau');
Route::post('submitdoimatkhau','PageControllers\DoiMatKhauController@page_submitdoimatkhau');

/////////////////////////TIN TIEP CONG DAN////////////////////////////
Route::get('tintiepcongdan','PageControllers\TrangChuPageController@page_tintiepcongdan');
Route::get('noidungthongtintiepdan/{typeid}/{id}','PageControllers\TrangChuPageController@page_noidungthongtintiepdan');

/////////////////////////TIN KHIEU NAI TO CAO////////////////////////////
Route::get('tinkhieunaitocao','PageControllers\TrangChuPageController@page_tinkhieunaitocao');
Route::get('noidungtinkhieunaitocao/{typeid}/{id}','PageControllers\TrangChuPageController@page_noidungtinkhieunaitocao');

//Route::get('traloicongbo','PageControllers\TrangChuPageController@page_traloicongbo');

/////////////////////////CHUYEN VIEN////////////////////////////
Route::get('chuyenvien','PageControllers\ChuyenVienController@page_chuyenvien');
Route::get('denhan/{type}/{diabanid}','PageControllers\ChuyenVienController@page_denhan')->middleware('Permission2TabTrangChu');
Route::get('quahan/{type}/{diabanid}','PageControllers\ChuyenVienController@page_quahan')->middleware('Permission2TabTrangChu');
Route::get('denhan_all/{type}/{loaidonId}','PageControllers\ChuyenVienController@page_denhantong')->middleware('Permission2TabTrangChu');
Route::get('quahan_all/{type}/{loaidonId}','PageControllers\ChuyenVienController@page_quahantong')->middleware('Permission2TabTrangChu');
Route::get('gettongdon/{type1}/{type2}/{diabanId}','PageControllers\ChuyenVienController@TongSoDonTrongKy')->middleware('Permission2TabTrangChu');
Route::get('gettongdontheophanloai/{type1}/{type2}/{diabanId}','PageControllers\ChuyenVienController@TongSoDonTheoPhanLoai')->middleware('Permission2TabTrangChu');
Route::get('ketQuaGQKNTC/{type}/{loaidonId}','PageControllers\ChuyenVienController@DanhSachKetQuaGQDon')->middleware('Permission2TabTrangChu');

/////////////////////////CONG THONG TIN////////////////////////////
/////////////////////////MUC TIN TUC////////////////////////////
Route::get('baiviet','PageControllers\ChuyenVienController@page_baiviet')->middleware('Permission2TabCongThongTin');
Route::get('themtintucsukien','PageControllers\ChuyenVienController@page_themtintucsukien')->middleware('Permission2TabCongThongTin');
Route::post('submitthemtintucsukien','PageControllers\ChuyenVienController@submitthemtintucsukien');
Route::post('changetrangthaibaiviet','PageControllers\ChuyenVienController@changetrangthaibaiviet');
Route::post('xoabaiviet','PageControllers\ChuyenVienController@xoabaiviet');
Route::get('chinhsuabaiviet/{id}','PageControllers\ChuyenVienController@chinhsuabaiviet')->middleware('Permission2TabCongThongTin');

/////////////////////////MUC GIOI THIEU////////////////////////////
Route::get('gioithieu','PageControllers\ChuyenVienController@page_gioithieu')->middleware('Permission2TabCongThongTin');
Route::get('themthongtingioithieu','PageControllers\ChuyenVienController@page_themthongtingioithieu')->middleware('Permission2TabCongThongTin');
Route::post('submitthemthongtingioithieu','PageControllers\ChuyenVienController@submitthemthongtingioithieu');
Route::post('chinhsuabaiviet/submitchinhsuabaiviet/{id}','PageControllers\ChuyenVienController@submitchinhsuabaiviet');

/////////////////////////MUC GOP Y CONG DAN////////////////////////////
Route::get('qtgopycongdan','PageControllers\ChuyenVienController@page_qtgopycongdan')->middleware('Permission2TabCongThongTin');

/////////////////////////MUC TRO GIUP PHAP LUAT////////////////////////////
Route::get('qttrogiupphapluat','PageControllers\ChuyenVienController@page_qttrogiupphapluat')->middleware('Permission2TabCongThongTin');
Route::post('changetrangthaigopytrogiup','PageControllers\ChuyenVienController@changetrangthaigopytrogiup');
Route::post('xoagopytrogiup','PageControllers\ChuyenVienController@xoagopytrogiup');

/////////////////////////MUC THONG BAO////////////////////////////
Route::get('qtthongbao','PageControllers\ChuyenVienController@page_qtthongbao')->middleware('Permission2TabCongThongTin');
Route::get('chinhsuathongbao/{id}','PageControllers\ChuyenVienController@page_chinhsuathongbao')->middleware('Permission2TabCongThongTin');
Route::get('themthongbao','PageControllers\ChuyenVienController@page_themthongbao')->middleware('Permission2TabCongThongTin');
Route::post('submitthemthongbao','PageControllers\ChuyenVienController@submitthemthongbao');
Route::post('xoathongbao','PageControllers\ChuyenVienController@xoathongbao');
Route::post('chinhsuathongbao/submitchinhsuathongbao/{id}','PageControllers\ChuyenVienController@submitchinhsuathongbao');
Route::post('chonHienThiSoLuongCongThongTin','PageControllers\ChuyenVienController@chonHienThiSoLuongCongThongTin');

/////////////////////////VAN BAN////////////////////////////
Route::get('qtvanban','PageControllers\ChuyenVienController@page_qtvanban')->middleware('Permission2TabCongThongTin');
Route::get('themvanbanphapluat','PageControllers\ChuyenVienController@page_themvanbanphapluat');
Route::post('submitthemvanbanphapluat','PageControllers\ChuyenVienController@submitthemvanbanphapluat');
Route::post('xoavanban','PageControllers\ChuyenVienController@xoavanban');
Route::get('chinhsuavanban/{id}','PageControllers\ChuyenVienController@page_chinhsuavanban')->middleware('Permission2TabCongThongTin');
Route::post('chinhsuavanban/submitchinhsuavanban/{id}','PageControllers\ChuyenVienController@submitchinhsuavanban');

/*=============================================================== PAGE TIEP DAN ===============================================================*/
/*-------------------------------------------- LICH TIEP DAN --------------------------------------------*/
Route::get('tiepcongdan','PageControllers\ChuyenVienController@page_tiepcongdan')->middleware('check_TabTiepDan');
Route::get('themtiepcongdan','PageControllers\ChuyenVienController@page_themtiepcongdan')->middleware('check_TabTiepDan');
Route::get('chinhsuatiepcongdan/{id}','PageControllers\ChuyenVienController@page_chinhsuatiepcongdan')->middleware('check_TabTiepDan');
Route::post('submitthemtiepcongdan','PageControllers\ChuyenVienController@submitthemtiepcongdan')->middleware('check_TabTiepDan');
Route::post('xoalichtiepdan','PageControllers\ChuyenVienController@xoalichtiepdan')->middleware('check_TabTiepDan');
Route::post('chinhsuatiepcongdan/submitchinhsuatiepcongdan/{id}','PageControllers\ChuyenVienController@submitchinhsuatiepcongdan')->middleware('check_TabTiepDan');
Route::post('getlichtiepdantheothang','PageControllers\ChuyenVienController@getlichtiepdantheothang')->middleware('check_TabTiepDan');
Route::post('getlichtiepdantheolanhdao','PageControllers\ChuyenVienController@getlichtiepdantheolanhdao')->middleware('check_TabTiepDan');

/*-------------------------------------------- THONG TIN TIEP DAN --------------------------------------------*/
Route::get('thongtintiepdan','PageControllers\ChuyenVienController@page_thongtintiepdan')->middleware('check_TabTiepDan');
Route::get('themthongtintiepdan','PageControllers\ChuyenVienController@page_themthongtintiepdan')->middleware('check_TabTiepDan');
Route::get('chinhsuathongtintiepdan/{id}','PageControllers\ChuyenVienController@page_chinhsuathongtintiepdan')->middleware('check_TabTiepDan');
Route::post('chinhsuathongtintiepdan/submitchinhsuathongtintiepdan/{id}','PageControllers\ChuyenVienController@submitchinhsuathongtintiepdan')->middleware('check_TabTiepDan');
Route::post('submitthemthongtintiepdan','PageControllers\ChuyenVienController@submitthemthongtintiepdan')->middleware('check_TabTiepDan');
Route::post('changetrangthaithongtintiepdan','PageControllers\ChuyenVienController@changetrangthaithongtintiepdan')->middleware('check_TabTiepDan');
Route::post('xoathongtintiepdan','PageControllers\ChuyenVienController@xoathongtintiepdan')->middleware('check_TabTiepDan');

/*-------------------------------------------- DANH SACH TIEP DAN --------------------------------------------*/
Route::get('danhsachtiepcongdan','PageControllers\ChuyenVienController@page_danhsachtiepcongdan')->middleware('check_TabTiepDan');
Route::get('themdanhsachtiepcongdan','PageControllers\ChuyenVienController@page_themdanhsachtiepcongdan')->middleware('check_TabTiepDan');
Route::get('noidungdanhsachtiepcongdan/{id}','PageControllers\ChuyenVienController@page_noidungdanhsachtiepcongdan')->middleware('check_TabTiepDan');
Route::post('submitthemdanhsachtiepcongdan','PageControllers\ChuyenVienController@submitthemdanhsachtiepcongdan')->middleware('check_TabTiepDan');
Route::get('chinhsuadanhsachtiepcongdan/{id}','PageControllers\ChuyenVienController@chinhsuadanhsachtiepcongdan')->middleware('check_TabTiepDan');
Route::post('chinhsuadanhsachtiepcongdan/submitchinhsuadanhsachtiepcongdan/{id}','PageControllers\ChuyenVienController@submitchinhsuadanhsachtiepcongdan')->middleware('check_TabTiepDan');
Route::post('xoadanhsachtiepdan','PageControllers\ChuyenVienController@xoadanhsachtiepdan')->middleware('check_TabTiepDan');
Route::post('chonHienThiSoLuongTiepDan','PageControllers\ChuyenVienController@chonHienThiSoLuongTiepDan');


/*=============================================================== PAGE BAO CAO ===============================================================*/
Route::get('baocao','PageControllers\ChuyenVienController@page_baocao')->middleware('check_tabBaoCao');
Route::post('detail_baocao','PageControllers\ChuyenVienController@page_detail_baocao')->middleware('check_tabBaoCao');
Route::get('baocaodotxuat','PageControllers\ChuyenVienController@page_baocaodotxuat')->middleware('check_tabBaoCao');
Route::get('taobaocaodotxuat','PageControllers\ChuyenVienController@page_taobaocaodotxuat')->middleware('check_tabBaoCao');
Route::post('thembaocaodotxuat','PageControllers\ChuyenVienController@thembaocaodotxuat')->middleware('check_tabBaoCao');
Route::post('xoabaocao','PageControllers\ChuyenVienController@xoabaocao')->middleware('check_tabBaoCao');
Route::post('chinhsuabaocaodotxuat/suabaocaodotxuat/{id}','PageControllers\ChuyenVienController@SuaBaoCaoDotXuat')->middleware('check_tabBaoCao');
Route::get('chinhsuabaocaodotxuat/{id}','PageControllers\ChuyenVienController@page_ChinhSuaBaoCaoDotXuat')->middleware('check_tabBaoCao');

/*=============================================================== PAGE TRA CUU ===============================================================*/
/*-------------------------------------------- TRA CUU DON THU --------------------------------------------*/
Route::get('tracuudonthu','PageControllers\ChuyenVienController@page_tracuudonthu')->middleware('check_tabBaoCao');
Route::get('tracuu_donthu','PageControllers\ChuyenVienController@page_tracuu_donthu')->middleware('check_tabBaoCao');

Route::post('tracuu_donthu','PageControllers\ChuyenVienController@filter_tracuu_donthu')->middleware('check_tabBaoCao');
Route::post('tracuu_csdlqg','PageControllers\ChuyenVienController@filter_tracuu_csdlqg')->middleware('check_tabBaoCao');
/*-------------------------------------------- TRA CUU TIEP CONG DAN --------------------------------------------*/
Route::get('tratiepcongdan','PageControllers\ChuyenVienController@page_tratiepcongdan')->middleware('check_tabBaoCao');
Route::get('tracuulichtiepdan','PageControllers\ChuyenVienController@page_tracuulichtiepdan')->middleware('check_tabBaoCao');


/*=============================================================== PAGE DANH MUC ===============================================================*/
/*-------------------------------------------- DIA BAN --------------------------------------------*/                                          //
Route::get('diaban','PageControllers\ChuyenVienController@page_diaban')->middleware('check_tabHeThong');                             //
Route::post('getthongtindiabantheoid','PageControllers\ChuyenVienController@getthongtindiabantheoid');                                         //
Route::post('themdiaban','PageControllers\ChuyenVienController@themdiaban');                                                                   //
Route::post('xoadiaban','PageControllers\ChuyenVienController@xoadiaban');                                                                     //
Route::post('chinhsuadiaban/{id}','PageControllers\ChuyenVienController@chinhsuadiaban');                                                      //
Route::post('getdiabancon','PageControllers\ChuyenVienController@getdiabancon');                                                               //
Route::get('diabantable','PageControllers\ChuyenVienController@page_diabantable');                   //

/*-------------------------------------------- DON VI --------------------------------------------*/
Route::get('donvi','PageControllers\ChuyenVienController@page_donvi')->middleware('check_tabHeThong');
Route::post('themdonvi','PageControllers\ChuyenVienController@themdonvi');
Route::post('getthongtindonvitheoid','PageControllers\ChuyenVienController@getthongtindonvitheoid');
Route::get('donvitable','PageControllers\ChuyenVienController@page_donvitable');
Route::post('getdonvicon','PageControllers\ChuyenVienController@getdonvicon');
Route::post('xoadonvi','PageControllers\ChuyenVienController@xoadonvi');
Route::post('chinhsuadonvi/{id}','PageControllers\ChuyenVienController@chinhsuadonvi');

/*-------------------------------------------- LOAI DON --------------------------------------------*/
Route::get('qtdanhmucloaidon','PageControllers\ChuyenVienController@page_qtdanhmucloaidon')->middleware('check_tabHeThong');
Route::post('themloaidon','PageControllers\ChuyenVienController@themloaidon');
Route::post('xoaloaidon','PageControllers\ChuyenVienController@xoaloaidon');
Route::get('chinhsualoaidon/{id}','PageControllers\ChuyenVienController@chinhsualoaidon')->middleware('check_tabHeThong');
Route::post('chinhsualoaidon/submitchinhsualoaidon/{id}','PageControllers\ChuyenVienController@submitchinhsualoaidon');

/*-------------------------------------------- LINH VUC --------------------------------------------*/
Route::get('qtdanhmuclinhvuc','PageControllers\ChuyenVienController@page_qtdanhmuclinhvuc')->middleware('check_tabHeThong');
Route::post('themlinhvuc','PageControllers\ChuyenVienController@themlinhvuc');
Route::post('xoalinhvuc','PageControllers\ChuyenVienController@xoalinhvuc');
Route::get('chinhsualinhvuc/{id}','PageControllers\ChuyenVienController@chinhsualinhvuc')->middleware('check_tabHeThong');
Route::post('chinhsualinhvuc/submitchinhsualinhvuc/{id}','PageControllers\ChuyenVienController@submitchinhsualinhvuc');

/*-------------------------------------------- THAM QUYEN --------------------------------------------*/
Route::get('thamquyen','PageControllers\ChuyenVienController@page_thamquyen')->middleware('check_tabHeThong');
Route::post('themthamquyen','PageControllers\ChuyenVienController@themthamquyen');
Route::post('getthongtinthamquyentheoid','PageControllers\ChuyenVienController@getthongtinthamquyentheoid');
Route::post('getthamquyencon','PageControllers\ChuyenVienController@getthamquyencon');
Route::post('xoathamquyen','PageControllers\ChuyenVienController@xoathamquyen');
Route::post('chinhsuathamquyen/{id}','PageControllers\ChuyenVienController@chinhsuathamquyen');

/*-------------------------------------------- CHU TRI --------------------------------------------*/
Route::get('qtdanhmucchutri','PageControllers\ChuyenVienController@showPageDanhMucChuTri')->middleware('check_tabHeThong');
Route::post('getChucVuTheoId','PageControllers\ChuyenVienController@getChucVuTheoId');
Route::post('xoaChuTriTheoId','PageControllers\ChuyenVienController@xoaChuTriTheoId');
Route::post('themChuTri','PageControllers\ChuyenVienController@themChuTri');

/*=============================================================== END PAGE DANH MUC ===============================================================*/


/////////////////////////TRO GIUP////////////////////////////
Route::get('trogiup','PageControllers\ChuyenVienController@page_trogiup');

/*=============================================================== PAGE HE THONG ===============================================================*/
/*-------------------------------------------- NGUOI SU DUNG --------------------------------------------*/
Route::get('qtdanhmucnguoisudung','PageControllers\ChuyenVienController@page_qtdanhmucnguoisudung')->middleware('check_tabHeThong');
Route::get('themnguoisudung','PageControllers\ChuyenVienController@page_themnguoisudung')->middleware('check_tabHeThong');
Route::post('submitthemnguoisudung','PageControllers\ChuyenVienController@submitthemnguoisudung');
Route::post('xoanguoisudung','PageControllers\ChuyenVienController@xoanguoisudung');
Route::post('doitrangthainguoisudung','PageControllers\ChuyenVienController@doitrangthainguoisudung');
Route::post('getquyennguoisudung','PageControllers\ChuyenVienController@getquyennguoisudung');
Route::get('chinhsuanguoisudung/{id}','PageControllers\ChuyenVienController@chinhsuanguoisudung')->middleware('check_tabHeThong');
Route::post('chinhsuanguoisudung/submitchinhsuanguoisudung/{id}','PageControllers\ChuyenVienController@submitchinhsuanguoisudung');
Route::get('cauhinhhethong','PageControllers\ChuyenVienController@page_cauhinhhethong')->middleware('check_tabHeThong');
Route::post('submitchinhsuacauhinhhethong','PageControllers\ChuyenVienController@submitChinhSuaCauHinhHeThong');

/*-------------------------------------------- NHOM NGUOI SU DUNG --------------------------------------------*/
Route::get('qtnhomnguoisudung','PageControllers\ChuyenVienController@page_qtnhomnguoisudung')->middleware('check_tabHeThong');
Route::post('xoanhomnguoisudung','PageControllers\ChuyenVienController@xoanhomnguoisudung');
Route::post('doitrangthainhomnguoisudung','PageControllers\ChuyenVienController@doitrangthainhomnguoisudung');
Route::get('themnhomnguoisudung','PageControllers\ChuyenVienController@page_themnhomnguoisudung')->middleware('check_tabHeThong');
Route::get('chinhsuanhomnguoisudung/{id}','PageControllers\ChuyenVienController@page_chinhsuanhomnguoisudung')->middleware('check_tabHeThong');
Route::post('submitthemnhomnguoisudung','PageControllers\ChuyenVienController@submitthemnhomnguoisudung');
Route::post('chinhsuanhomnguoisudung/submitchinhsuanhomnguoisudung/{id}','PageControllers\ChuyenVienController@submitchinhsuanhomnguoisudung');
/*=============================================================== END PAGE HE THONG ===============================================================*/


Route::get('doichieugiayto','PageControllers\ChuyenVienController@page_doichieugiayto');

/////////////////////////NGHIEP VU///////////////////////////
Route::get('donthuxacminh','PageControllers\ChuyenVienController@page_donthuxacminh');
Route::get('danhsachdonthu','PageControllers\ChuyenVienController@page_danhsachdonthu')->middleware('Permission2TabNghiepVu');
Route::get('danhsachxacminh','PageControllers\ChuyenVienController@page_danhsachxacminh');
Route::get('datdai','PageControllers\ChuyenVienController@page_datdai');
Route::get('taodonthumoi','PageControllers\ChuyenVienController@page_taodonthumoi')->middleware('Permission2TabNghiepVu');

Route::get('dsdthoagiaidatdai','PageControllers\ChuyenVienController@page_dsdthoagiaidatdai');
Route::get('dsketluanthanhtra','PageControllers\ChuyenVienController@page_dsketluanthanhtra');
Route::get('ketluanthanhtra','PageControllers\ChuyenVienController@page_ketluanthanhtra');
Route::get('donthugiongnhau','PageControllers\ChuyenVienController@donThuGiongNhau');
Route::post('getDonViTheoDiaBan','PageControllers\ChuyenVienController@getDonViTheoDiaBan');
Route::get('danhsachdonthumoicanxuly','PageControllers\ChuyenVienController@page_danhsachdonthumoicanxuly')->middleware('Permission2TabNghiepVu');
Route::get('GetNguoiXuLy','PageControllers\ChuyenVienController@GetNguoiXuLy');

/////////////////////////CHAT///////////////////////////
Route::get('danhsachnhanvien/{id}','PageControllers\ChuyenVienController@page_danhsachnhanvien');

/////////////////////////MAIL///////////////////////////
Route::post('checkmailbox','PageControllers\ChuyenVienController@checkmailbox');
Route::get('mailbox/{id}','PageControllers\ChuyenVienController@page_mailbox');
Route::post('xoamailboxtheoid','PageControllers\ChuyenVienController@xoamailboxtheoid');
Route::get('taothuguidi','PageControllers\ChuyenVienController@page_taothuguidi');
Route::get('noidungemail/{id}','PageControllers\ChuyenVienController@page_noidungemail');
Route::post('updatestatusemail','PageControllers\ChuyenVienController@updatestatusemail');
Route::post('submittaothuguidi','PageControllers\ChuyenVienController@submittaothuguidi');
Route::post('chonHienThiSoLuong','PageControllers\ChuyenVienController@chonHienThiSoLuong');
Route::post('chonHopThu','PageControllers\ChuyenVienController@chonHopThu');


/*chi tiet don thu*/
Route::get('chitietdonthu/{donthuid}','PageControllers\ChuyenVienController@page_chitietdonthu')->middleware('Permission2TabNghiepVu');
Route::post('chitietdonthu/{postchitietdonthu}','PageControllers\ChuyenVienController@ChinhSuaChiTietDon');
Route::post('xoadonthu','PageControllers\ChuyenVienController@xoaDonThu');

/* chinh sua noi dung don thu*/
Route::get('chinhsuadonthu','PageControllers\ChuyenVienController@page_chinhsuadonthu');
Route::get('noidungdonthu/{donthuid}','PageControllers\ChuyenVienController@page_noidungdonthu')->middleware('Permission2TabNghiepVu');
Route::post('noidungdonthu/{luunoidung}','PageControllers\ChuyenVienController@page_luunoidung');

/* chinh sua phan loai don thu*/
Route::get('phanloaidonthu/{donthuid}','PageControllers\ChuyenVienController@page_phanloaidonthu')->middleware('Permission2TabNghiepVu');
//Route::get('getdanhsachdonthuxacminh','PageControllers\ChuyenVienController@page_getdanhsachdonthuxacminh');

Route::post('phanloaidonthu/{luuphanloai}','PageControllers\ChuyenVienController@page_luuphanloai');
/* chinh sua theo doi don thu */
Route::get('theodoidonthu/{donthuid}','PageControllers\ChuyenVienController@page_theodoidonthu')->middleware('Permission2TabNghiepVu');

Route::post('theodoidonthu/{luutheodoi}','PageControllers\ChuyenVienController@page_luutheodoi');


/*delete file*/
Route::post('deletefile','PageControllers\ChuyenVienController@page_deletefile');
Route::get('getfile','PageControllers\ChuyenVienController@page_getfile');

/*ket qua giai quyet don thu*/
Route::get('ketquagiaiquyetdonthu/{donthuid}','PageControllers\ChuyenVienController@page_ketquagiaiquyetdonthu')->middleware('Permission2TabNghiepVu');

Route::post('ketquagiaiquyetdonthu/{luuketquagaiquyet}','PageControllers\ChuyenVienController@page_luuketquagaiquyet');
/*ket thuc don thu*/
Route::get('ketthucdonthu/{sothuly}','PageControllers\ChuyenVienController@page_ketthucdonthu')->middleware('Permission2TabNghiepVu');
Route::post('ketthucdonthu/{luuketthuc}','PageControllers\ChuyenVienController@page_luuketthuc');

/* get danh sach don thu*/
Route::get('getdanhsachdonthu','PageControllers\ChuyenVienController@page_getdanhsachdonthu')->middleware('Permission2TabNghiepVu');

/*getdata when select in list don thu*/
Route::get('selected','PageControllers\ChuyenVienController@getSelected')->middleware('Permission2TabNghiepVu')->middleware('Permission2TabNghiepVu');

/*search don thu*/
Route::get('SearchDonThu/{request}','PageControllers\ChuyenVienController@getSearchDonThu')->middleware('Permission2TabNghiepVu');
Route::get('timkiem','PageControllers\ChuyenVienController@getTimKiem')->middleware('Permission2TabNghiepVu');
/*tao don thu*/
Route::post('taodonthu','PageControllers\ChuyenVienController@postTaoDonThu');
Route::get('themdoituongkhieunaitocao','PageControllers\ChuyenVienController@themdoituongkhieunaitocao');
/*tao don thu xac minh*/
Route::post('taodonthuxacminh','PageControllers\ChuyenVienController@postTaoDonThuXacMinh');
/*table dia ban and don vi*/
Route::get('tablediaban','PageControllers\TrangChuPageController@page_tablediaban');
Route::get('tabledonvi','PageControllers\TrangChuPageController@page_tabledonvi');

/*  cap nhat xac minh */
Route::post('chitietxacminhdonthu/{capnhatxacminh}','PageControllers\ChuyenVienController@postCapNhatXacMinh');
/*chi tiet xac minh don thu*/
Route::get('chitietxacminhdonthu/{sothuly}','PageControllers\ChuyenVienController@page_chitietxacminhdonthu');
Route::get('detaildonthulan1/{id}','PageControllers\ChuyenVienController@page_detaildonthulan1');

/*them don thu*/
//Route::get('themdonthu','PageControllers\ChuyenVienController@page_themdonthu');

Route::get('chitiettiepdan','PageControllers\ChuyenVienController@page_chitiettiepdan');
Route::get('checkedit','PageControllers\ChuyenVienController@page_checkedit');

///////////////////////EXPORT MAU DON/////////////////////////////////
Route::get('exportMauDon01/{donThuId}','PageControllers\ChuyenVienController@exportMauDon01');
Route::get('exportMauDon02/{donThuId}','PageControllers\ChuyenVienController@exportMauDon02');
Route::get('exportMauDon03/{donThuId}','PageControllers\ChuyenVienController@exportMauDon03');
Route::get('exportMauDon04/{donThuId}','PageControllers\ChuyenVienController@exportMauDon04');
Route::get('exportMauDon05/{donThuId}','PageControllers\ChuyenVienController@exportMauDon05');
Route::get('exportPhieuChuyenDon/{donThuId}','PageControllers\ChuyenVienController@exportPhieuChuyenDon');
Route::get('exportPhieuXuLy/{donThuId}','PageControllers\ChuyenVienController@exportPhieuXuLy');
Route::get('exportPhieuHuongDan/{donThuId}','PageControllers\ChuyenVienController@exportPhieuHuongDan');
Route::get('exportVanBanTraLoi/{donThuId}','PageControllers\ChuyenVienController@exportVanBanTraLoi');
Route::post('exportVanBan','PageControllers\ChuyenVienController@exportWord');
Route::post('previewVanBan','PageControllers\ChuyenVienController@previewVanBan');

//////////////////////EXPORT PHIEU HEN//////////////////////////////////
Route::get('exportPhieuHen/{tiepDanId}','PageControllers\ChuyenVienController@exportPhieuHen');

//////////////////////IN DANH SACH//////////////////////////////////
Route::get('inDanhSachTiepCongDan','PageControllers\ChuyenVienController@inDanhSachTiepCongDan');
Route::post('inDanhSachDonThu','PageControllers\ChuyenVienController@inDanhSachDonThu');
Route::post('inDanhSachDonThuDHQH','PageControllers\ChuyenVienController@inDanhSachDonThuDHQH');
Route::get('inLichTiepDan','PageControllers\ChuyenVienController@inLichTiepDan');

//////////////////////DANH SACH DON THU TRUNG NHAU//////////////////////////////////
Route::get('danhSachDonThuCungCMT/{request}','PageControllers\ChuyenVienController@getDanhSachDonThuCungCMT')->middleware('Permission2TabNghiepVu');
Route::get('danhsachdonthunhieunoi/{value}','PageControllers\ChuyenVienController@getDanhSachDonThuNhieuNoi');
Route::get('chitietdonthunhieunoi/{value}','PageControllers\ChuyenVienController@getChiTietDonThuNhieuNoi');


Route::get('thongtinchudon/{tenchudon}/{cmt}','PageControllers\ChuyenVienController@getThongTinChuDon');

Route::get('themcongdankhac','PageControllers\ChuyenVienController@ThemCongDanKhac');
Route::get('xoacongdankhac','PageControllers\ChuyenVienController@XoaCongDanKhac');
Route::post('senComment','PageControllers\ChuyenVienController@SenCommentCV');

Route::get('autoComplete','PageControllers\ChuyenVienController@AutoComplete');

Route::post('getNumberDonthuOfMaster','PageControllers\ChuyenVienController@getNumberDonthuOfMaster');
Route::post('themNguoiTheoDoi','PageControllers\ChuyenVienController@ThemNguoiTheoDoi');
Route::post('xoaNguoiTheoDoi','PageControllers\ChuyenVienController@XoaNguoiTheoDoi');
Route::post('updatedComment','PageControllers\ChuyenVienController@UpdateComment');

/*-------------------------------------------- CHI TIET DON --------------------------------------------*/
Route::post('postLuuHoSo','PageControllers\ChuyenVienController@PostLuuHoSo');
Route::post('exportWord',array('as' => 'export_word', 'uses' => 'PageControllers\ChuyenVienController@exportWord'));
Route::post('getNoiDungFromTemplate',array('as' => 'get_noi_dung', 'uses' => 'PageControllers\ChuyenVienController@getNoiDungFromTemplateTxt'));
Route::post('update-sokihieu',array('as' => 'update_sokihieu', 'uses' => 'PageControllers\ChuyenVienController@updateSoKiHieu'));

/////////////////////////VAN BAN///////////////////////////
//Route::get('taovanbanmoi','PageControllers\VanBanController@page_taovanbanmoi')->middleware('Permission2TabNghiepVu');
//Route::post('postTaoVanBanPhatHanh','PageControllers\VanBanController@postTaoVanBanPhatHanh');


/////////////////////////TEST AND FIX BUG///////////////////////////
//Route::get('fixBUG','PageControllers\ChuyenVienController@page_fixbug');
Route::get('downLoad',array('as'=>'down_load','uses'=>'PageControllers\ChuyenVienController@downloadFile'));
Route::get('autoComplete',array('as'=>'auto_complete','uses'=>'PageControllers\ChuyenVienController@GetAutoComplete'));
Route::get('test','TestController@page_test');



