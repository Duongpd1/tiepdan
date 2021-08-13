<?php

/****************************************************************
File Name       : PagesController.php
Description     : Control all pages
Creation Date   : 2016/06/10
Author          : FPT/KhanhTH
Change History  :
 ****************************************************************/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\User;
use Session;
use Cookie;
use App\Http\Controllers\Controller;
use App\TableUserManager;
use App\TableUserHistory;
use App\TableGenerateHistory;
use App\TableProject;
use App\TableFolder;
use App\TableFile;
use App\TableFunction;
use App\TableFunctionCall;
use App\UserGenerateDatabases;
use App\Common;
use Symfony\Component\Console\Helper\Table;
use DateTime;
use Date;

use Validator;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Border;

class PagesController extends Controller
{
    public function page_logout(){
        return view('pages.logout');
    }
    public function page_quenmk(){
        return view('pages.quenmk');
    }

    public function page_quanlyHT(){
        return view('pages.quanlyhethong');
    }
    public function page_lanhdao(){
        return view('pages.lanhdao');
    }
    public function page_chuyenvien(){
        return view('pages.chuyenvien');
    }
    public function page_congdan(){
        return view('pages.congdan');
    }
    public function page_thongtincanhan(){
        return view('pages.thongtincanhan');
    }
    public function page_quanlynguoidung(){
        return view('pages.quanlynguoidung');
    }
    public function page_lichsuchinhsua(){
        return view('pages.lichsuchinhsua');
    }
    public function page_tonghopbaocao(){
        return view('pages.tonghopbaocao');
    }
    public function page_pheduyet(){
        return view('pages.pheduyet');
    }
    public function page_baocao(){
        return view('pages.baocao');
    }
    public function page_doichieugiayto(){
        return view('pages.doichieugiayto');
    }
    public function page_tracuudonthu(){
        return view('pages.tracuudonthu');
    }
    public function page_taodonthumoi(){
        return view('pages.taodonthumoi');
    }
	public function page_taovanbanmoi(){
        return view('pages.taovanbanmoi');
    }




}
