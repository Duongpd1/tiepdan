<?php
/****************************************************************
File Name       : home.blade.php
Description     : Header of home page
Creation Date   : 2016/06/10
Author          : FPT/KhanhTH
Change History  :
 ****************************************************************/
?>
@extends('layouts.quantrihethonglayout')

@section('content')
    <script>
        //document.getElementById("htab-danhmuc").style.display = 'block';
        var element1 = document.getElementById("hs");
        element1.classList.add("active");
        var element = document.getElementById("htab-nghiepvu");
        element.classList.add("active");
        element.classList.add("in");

    </script>
    <style>
        /* Dropdown Button */
        .dropbtn {
            background-color: #fff;
            border-color: #2e6da4;
            color: black;
            padding: 6px;
            font-size: 12px;
            cursor: pointer;
            border: solid 1px #ccc;
            border-radius: 3px;
            margin-top: 1px;
        }

        /* The container <div> - needed to position the dropdown content */
        .dropdown {
            position: relative;
            display: inline-block;

        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 250px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 100;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 6px 12px;
            text-decoration: none;
            display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {background-color: #f1f1f1}

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Change the background color of the dropdown button when the dropdown content is shown */
        .dropdown:hover .dropbtn {
            background-color: #f1f1f1;
        }
    </style>

    <div id="donthu" class="col-background" style="margin-bottom: 100px;">
        <div class="btn-group-vertical btn-group-xs" style="position: fixed; z-index: 999999999; right: 5px;">
            <a href="" class="btn btn-xs btn-default" title="Nội dung đơn"><span class="text-info">Nội dung đơn</span></a>
            <a href="" class="btn btn-xs btn-default" title="Quyết định thẩm tra"><span class="text-info">Quyết định TT</span></a>
            <a href="" class="btn btn-xs btn-default" title="Kết quả thẩm tra"><span class="text-info">Kết quả TT</span></a>
            <a href="" class="btn btn-xs btn-default" title="Thành lập hội đồng hòa giải"><span class="text-info">Hội Đồng HG</span></a>
            <a href="" class="btn btn-xs btn-default" title="Tổ chức hòa giải"><span class="text-info">Tổ chức HG</span></a>
            <a href="" class="btn btn-xs btn-default" title="Bổ sung sau hòa giải lần 1"><span class="text-info">BS sau HG</span></a>
            <a href="" class="btn btn-xs btn-default" title="Thành lập hội đồng hòa giải lần 2"><span class="text-info">Hội Đồng HG 2</span></a>
            <a href="" class="btn btn-xs btn-default" title="Tổ chức hòa giải lần 2"><span class="text-info">Tổ chức HG 2</span></a>
        </div>

        <div class="panel panel-default panel-min-height">
            <div class="panel-heading text-center">CHI TIẾT ĐƠN HÒA GIẢI</div>
            <div class="panel-body">
                <button type="submit" name="ctl00$ctl00$btnTroLai" value="" id="ctl00_ctl00_btnTroLai" title="Trở lại" class="btn btn-sm btn-danger pull-left">
                    <span class="glyphicon glyphicon-arrow-left"></span>
                    Trở lại
                </button>
                <div class="dropdown" style="margin-left: 10px;">
                    <button class="dropbtn" style="margin-top: 0px;" onclick="return false;"><span class="glyphicon glyphicon-print text-info"></span> Danh sách báo cáo </button>
                    <div class="dropdown-content">
                        <a id="ctl00_ctl00_BaoCao_HG_BienBan" href="">Báo cáo biên bản hòa giải</a>
                        <a id="ctl00_ctl00_Bao_HG_CaoThamTra" href="">Báo cáo thẩm tra hòa giải</a>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <tbody>
                <tr id="step1">
                    <td class="col-xs-2">
                        <label>Nội dung đơn</label>
                    </td>
                    <td>

                        <div class="row">
                            <div class="col-sm-6">
                                <label>Số thụ lý: </label>
                                1
                            </div>
                            <div class="col-sm-6">
                                <label>Người tạo đơn: </label>
                                Quản trị hệ thống
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label>Ngày gửi: </label>
                                04/07/2016
                            </div>
                            <div class="col-sm-6">
                                <label>Ngày nhận: </label>
                                07/07/2016
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Người yêu cầu:</label>

                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr class="table-header-background">
                                        <th class="text-center">STT</th>
                                        <th class="col-xs-3 text-center">Họ tên</th>
                                        <th class="col-xs-1 text-center">G.Tính</th>
                                        <th class="col-xs-6 text-center">Địa chỉ</th>
                                        <th class="col-xs-2 text-center">Số CMND</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <th scope="row" class="text-center">1</th>
                                        <td>Trần Gia Long</td>
                                        <td class="text-center">Nam</td>
                                        <td>06 Phan Đình Phùng, phường 2, thành phố Đà Lạt</td>
                                        <td>19003377</td>
                                    </tr>

                                    </tbody>
                                </table>


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Danh sách bên liên quan:</label>

                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr class="table-header-background">
                                        <th class="text-center">STT</th>
                                        <th class="col-xs-3 text-center">Họ tên</th>
                                        <th class="col-xs-1 text-center">G.Tính</th>
                                        <th class="col-xs-6 text-center">Địa chỉ</th>
                                        <th class="col-xs-2 text-center">Số CMND</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <th scope="row" class="text-center">1</th>
                                        <td>Nguyễn Bảo Đại</td>
                                        <td class="text-center">Nam</td>
                                        <td>08 Phan Đình Phùng, phường 2, thành phố Đà Lạt</td>
                                        <td>19009988</td>
                                    </tr>

                                    </tbody>
                                </table>


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Nội dung: </label>
                                <div class="content-detail">
                                    <p>Điểm mới trong hòa giải tranh chấp đất đai <a href="">Luật năm 2013</a>:</p>

                                    <p>Hòa giải tranh chấp đất đai được quy định tại điều 202 – <a href="">Luật Đất đai 2013</a>, điều 88 – <a href="">Nghị định 43/2014/NĐ-CP</a> cụ thể như sau:</p>

                                    <p>Thứ nhất, thời hạn hòa giải: được pháp luật quy định là 45 ngày, kể từ ngày nhận được đơn yêu cầu giải quyết tranh chấp đất đai. Trong đó, theo quy định tại điều 135 – <a href="">Luật đất đai năm 2003</a> là 30 ngày. Luật mới mở rộng thời hạn hòa giải tranh chấp hơn.</p>

                                    <p>Thứ hai, trách nhiệm của ủy ban nhân dân cấp xã trong việc thực hiện hòa giải:</p>

                                    <p><em>-Thẩm tra, xác minh tìm hiểu nguyên nhân phát sinh tranh chấp, thu thập giấy tờ, tài liệu có liên quan do các bên cung cấp về nguồn gốc đất, quá trình sử dụng đất và hiện trạng sử dụng đất;</em></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Văn bản đính kèm: </label>

                                Không có văn bản đính kèm.

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <a href="" class="btn btn-sm btn-warning" title="Thay đổi thông tin">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    Sửa
                                </a>
                            </div>
                        </div>

                    </td>
                </tr>
                <tr id="step2">
                    <td>
                        <label>Quyết định Thẩm tra</label>
                    </td>
                    <td>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Người thẩm tra:</label>
                                Quản trị hệ thống
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Ngày quyết định thẩm tra: </label>
                                07/07/2016
                            </div>
                            <div class="col-sm-6">
                                <label>Ngày hết hạn thẩm tra: </label>
                                07/08/2016
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Văn bản quyết định thẩm tra:</label>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr class="table-header-background">
                                        <th>STT</th>
                                        <th class="col-xs-11 text-center">Tên văn bản</th>
                                        <th class="col-xs-1 text-center">Tải về</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row" class="text-center">1</th>
                                        <td>123_4.doc</td>
                                        <td class="text-center"><a href="" title="Tải về">
                                                <span class="glyphicon glyphicon-download-alt"></span>
                                            </a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-10">

                            </div>
                            <div id="ctl00_ctl00_ctl01_pnlUpdate" class="col-sm-2 text-right">

                                <a href="" class="btn btn-sm btn-warning" title="Thay đổi thông tin">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    Sửa
                                </a>

                            </div>
                        </div>
                    </td>
                </tr>
                <tr id="step3">
                    <td>
                        <label>Kết quả Thẩm tra</label>
                    </td>
                    <td>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Ngày báo cáo kết quả: </label>
                                07/07/2016
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Nội dung tóm tắt kết quả thẩm tra:</label>
                                <div class="content-detail">
                                    <p><em>Thành lập Hội đồng hòa giải tranh chấp đất đai để thực hiện hòa giải. Thành phần Hội đồng gồm: Chủ tịch hoặc Phó Chủ tịch UBND là Chủ tịch Hội đồng; đại diện Ủy ban Mặt trận Tổ quốc xã, phường, thị trấn; tổ trưởng tổ dân phố đối với khu vực đô thị; trưởng thôn, ấp đối với khu vực nông thôn; đại diện của một số hộ dân sinh sống lâu đời tại xã, phường, thị trấn biết rõ về nguồn gốc và quá trình sử dụng đối với thửa đất đó; cán bộ địa chính, cán bộ tư pháp xã, phường, thị trấn. Tùy từng trường hợp cụ thể, có thể mời đại diện Hội Nông dân, Hội Phụ nữ, Hội Cựu chiến binh, Đoàn Thanh niên Cộng sản Hồ Chí Minh;</em></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Văn bản báo cáo kết quả thẩm tra:</label>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr class="table-header-background">
                                        <th>STT</th>
                                        <th class="col-xs-11 text-center">Tên văn bản</th>
                                        <th class="col-xs-1 text-center">Tải về</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row" class="text-center">1</th>
                                        <td>00_DSC_2565.png</td>
                                        <td class="text-center"><a href="" title="Tải về">
                                                <span class="glyphicon glyphicon-download-alt"></span>
                                            </a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-sm-10">

                            </div>
                            <div id="ctl00_ctl00_ctl02_pnlUpdate" class="col-sm-2 text-right">

                                <a href="" class="btn btn-sm btn-warning" title="Thay đổi thông tin">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    Sửa
                                </a>

                            </div>
                        </div>

                    </td>
                </tr>
                <tr id="step4">
                    <td>
                        <label>Thành lập hội đồng hòa giải</label>
                    </td>
                    <td>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Ngày tổ chức hòa giải:</label>
                                07/07/2016
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Chủ tịch hội đồng hòa giải: </label>

                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr class="table-header-background">
                                        <th class="text-center">STT</th>
                                        <th class="col-sm-3 text-center">Họ tên</th>
                                        <th class="col-sm-4 text-center">Chức vụ</th>
                                        <th class="col-sm-5 text-center">Đơn vị</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>
                                            Trần Cao Nguyên</td>
                                        <td>
                                            Chủ tịch</td>
                                        <td>
                                            UBND Phường 2</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Danh sách thành viên: </label>

                                Không có thành viên!

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Văn bản quyết định thành lập tổ hòa giải:</label>
                                Không có văn bản quyết định thành lập tổ hòa giải.
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-10">

                            </div>
                            <div id="ctl00_ctl00_ctl03_pnlUpdate" class="col-sm-2 text-right">

                                <a href="" class="btn btn-sm btn-warning" title="Thay đổi thông tin">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    Sửa
                                </a>

                            </div>
                        </div>

                    </td>
                </tr>
                <tr id="step5">
                    <td>
                        <label>Tổ chức hòa giải</label>
                    </td>
                    <td>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Ngày tổ chức hòa giải:</label>
                                07/07/2016
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Danh sách hội đồng hòa giải: </label>

                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr class="table-header-background">
                                        <th class="text-center">STT</th>
                                        <th class="col-sm-3 text-center">Họ tên</th>
                                        <th class="col-sm-3 text-center">Chức vụ</th>
                                        <th class="col-sm-5 text-center">Đơn vị</th>
                                        <th class="col-sm-1 text-center">Th.Gia</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr class="success">
                                        <th scope="row" class="text-center">1</th>
                                        <td class="text-bold">Trần Cao Nguyên</td>
                                        <td class="text-bold">Chủ tịch</td>
                                        <td class="text-bold">UBND Phường 2</td>
                                        <td class="text-center">
                                            <span class="glyphicon glyphicon-ok text-success"></span>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Người yêu cầu:</label>

                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr class="table-header-background">
                                        <th class="text-center">STT</th>
                                        <th class="col-xs-3 text-center">Họ tên</th>
                                        <th class="col-xs-1 text-center">G.Tính</th>
                                        <th class="col-xs-5 text-center">Địa chỉ</th>
                                        <th class="col-xs-2 text-center">Số CMND</th>
                                        <th class="col-xs-1 text-center">Th.Gia</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <th scope="row" class="text-center">1</th>
                                        <td>Trần Gia Long</td>
                                        <td class="text-center">Nam</td>
                                        <td>06 Phan Đình Phùng, phường 2, thành phố Đà Lạt</td>
                                        <td>19003377</td>
                                        <td class="text-center">
                                            <span class="glyphicon glyphicon-ok text-success"></span>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Danh sách bên liên quan:</label>

                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr class="table-header-background">
                                        <th class="text-center">STT</th>
                                        <th class="col-xs-3 text-center">Họ tên</th>
                                        <th class="col-xs-1 text-center">G.Tính</th>
                                        <th class="col-xs-5 text-center">Địa chỉ</th>
                                        <th class="col-xs-2 text-center">Số CMND</th>
                                        <th class="col-xs-1 text-center">Th.Gia</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <th scope="row" class="text-center">1</th>
                                        <td>Nguyễn Bảo Đại</td>
                                        <td class="text-center">Nam</td>
                                        <td>08 Phan Đình Phùng, phường 2, thành phố Đà Lạt</td>
                                        <td>19009988</td>
                                        <td class="text-center">
                                            <span class="glyphicon glyphicon-ok text-success"></span>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Văn bản biên bản buổi hòa giải:</label>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr class="table-header-background">
                                        <th>STT</th>
                                        <th class="col-xs-11 text-center">Tên văn bản</th>
                                        <th class="col-xs-1 text-center">Tải về</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row" class="text-center">1</th>
                                        <td>01_DSC_2565.png</td>
                                        <td class="text-center"><a href="" title="Tải về">
                                                <span class="glyphicon glyphicon-download-alt"></span>
                                            </a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Nội dung hòa giải:</label>
                                <div class="content-detail"><p>Thứ tư, bổ sung quy định sau thời hạn 10 ngày, kể từ ngày lập biên bản hòa giải thành&nbsp;mà các bên tranh chấp có ý kiến bằng văn bản về nội dung khác với nội dung đã thống nhất trong biên bản hòa giải thành, thì Chủ tịch UBND cấp xã tổ chức lại cuộc họp Hội đồng hòa giải để xem xét giải quyết đối với ý kiến bổ sung và phải lập biên bản hòa giải thành hoặc không thành. Điều này <a href="https://luatduonggia.vn/luat-dat-dai-so-13-2003-qh11">Luật đất đai 2003</a> chưa đề cập đến. Đây là điểm mới tiến bộ, để bảo vệ tốt nhất quyền của các bên tranh chấp.</p></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Kết quả hòa giải:</label>
                                Thành.
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-10">

                            </div>
                            <div id="ctl00_ctl00_ctl04_pnlUpdate" class="col-sm-2 text-right">

                                <a href="" class="btn btn-sm btn-warning" title="Thay đổi thông tin">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    Sửa
                                </a>

                            </div>
                        </div>

                    </td>
                </tr>
                <tr id="step6">
                    <td>
                        <label>Bổ sung sau hòa giải lần 1</label>
                    </td>
                    <td>


                        <div class="row">
                            <div class="col-sm-10">

                            </div>
                            <div id="ctl00_ctl00_ctl05_pnlUpdate" class="col-sm-2 text-right">

                                <a href="" class="btn btn-sm btn-warning" title="Thay đổi thông tin">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    Sửa
                                </a>

                            </div>
                        </div>

                    </td>
                </tr>
                <tr id="step7">
                    <td>
                        <label>Thành lập hội đồng hòa giải lần 2</label>
                    </td>
                    <td>


                        <div class="row">
                            <div class="col-sm-10">

                            </div>

                        </div>

                    </td>
                </tr>
                <tr id="step8">
                    <td>
                        <label>Tổ chức hòa giải lần 2</label>
                    </td>
                    <td>


                        <div class="row">
                            <div class="col-sm-10">

                            </div>

                        </div>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
