<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

//Permission
define("CONGDAN", 0);
define("CHUYENVIEN", 1);
define("LANHDAO", 2);
define("QUANLYHETHONG", 3);
define("THONGTIN", 4);
define("TIEPDAN", 5);
define("VANTHU", 6);

//Quyen Xoa va xem
define("NO_DEL", 0);
define("DELDONTHU", 1);
define("DELDANHMUC", 2);
define("DELTIEPDAN", 4);
define("DELCONGTHONHTIN", 8);
define("VIEWTHEODIABAN", 16);

//Status
define("CHUAKICHHOAT", 0);
define("KICHHOAT", 1);

//Nhom Quyen
define("NHOMNGHIEPVU", 0);
define("NHOMHETHONG", 1);
define("NHOMLANHDAO", 2);
define("NHOMCONGTHONGTIN", 3);
define("NHOMVANTHU", 4);

//Bai Viet
define("HOIDAP", 0);
define("MAUDONKNTC", 1);
define("QDPLVEKNTC", 2);
define("KNTC", 3);
define("TIEPCD", 4);
define("TTHOATDONG", 5);
define("CNNHIEMVU", 6);
define("GTCHUNG", 7);
define("LANHDAOPHUTHO", 8);


//Trang Thai Bai Viet
define("DADUYET", 1);
define("CHUADUYET", 0);

//Lien He va Tro Giup
define("GOPYCD", 0);
define("TROGIUPPL", 1);

//Van Ban
define("VBAD", 0);
define("VBCD", 1);
define("VBPL", 2);

//Tiep Dan
define("KHONGDOTXUAT", 0);
define("DOTXUAT", 1);

//TRANG THAI XU LY DON THU
define("CHOXULY", 0);
define("DANGXULY", 1);
define("DANGGIAIQUYET", 2);
define("DAGIAIQUYET", 3);
define("KETTHUC", 5);

//Phan loai
define("CHUAPHANLOAI", 0);
define("DAPHANLOAI", 1);
define("DANGTHEODOI", 2);

//Giai Quyet
define("CHUATHEODOI", 0);
define("DATHEODOI", 1);

//Mailbox
define("CHUADOC", 0);
define("DADOC", 1);

define("THUNHAP", 0);
define("THUGUIDI", 1);
define("THUGUIDEN", 2);

//Ket thuc don thu
define("CHUAKETTHUC", 0);
define("KETTHUCDONTHU", 1);
define("RUTDONTHU", 2);


define("XULY", 1);
define("XACMINH", 2);
define("GIAIQUYET", 3);

//Mau Don
define("BANTIEPDAN_MAUDON","Ban tiếp dân Tỉnh Phú Thọ");
define("PHUTHO_MAUDON","Phú Thọ");

//So luong hien thi
define("HIENTHI_10ITEMS",10);
define("HIENTHI_50ITEMS",50);
define("HIENTHI_100ITEMS",100);

//Chon Hop Thu
define("HOPTHUDI",1);
define("HOPTHUDEN",2);

//Config path server
//Dev
define("FOLDERROOT", '../public');
//Server
//define("FOLDERROOT", '../public_html');


//Huong giai quyet
define("THULY",1);
define("TRADON",2);
define("CHUYENDON",3);
define("HUONGDAN",4);
define("DONDOC",5);

//Cac cap
define("TINH",1);
define("THANH_PHO",2);
define("HUYEN",3);
define("XA",4);

//Danh gia don thu
define("DUNG",1);
define("DUNG_MOT_PHAN",2);
define("SAI",3);

//Trang thai xu ly don thu
define("DENHAN_XL",1);
define("QUAHAN_XL",2);
define("DENHAN_GQ",3);
define("QUAHAN_GQ",4);

//Them tiep cong dan
define("UNENABLE",0);
define("ENABLE",1);

//loai hinh
define("KHIEUNAI",1);
define("TOCAO",2);

//hinh thuc
define("KN_QUYETDINH_HC",1);
define("KN_HANHVI_HC",2);
define("TC_CBCC",3);
define("TC_LVQLNN",4);

//tham quyen
define("THUOC_THAMQUYEN",1);
define("VUOT_THAMQUYEN",2);

// De xuat huong giai quyet
define("LUU",1);
define("HDCD",2);
define("CD",3);
define("TL",4);

//loai tong don
define("TRONG_KY",1);
define("CA_NAM",2);
define("DA_GQ_LAN_1",3);
define("DA_GQ_LAN_2",4);

//comment
define('INSERTFILE',1);
define('COMMENT',0);
//loaiCV
define('CV_DEN',0);
define('CV_DI',1);

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
}
