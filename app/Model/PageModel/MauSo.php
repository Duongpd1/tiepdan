<?php
/**
 * Created by PhpStorm.
 * User: Green
 * Date: 11/29/2016
 * Time: 9:28 PM
 */

namespace App\Model\PageModel;

use App\Model\TableModel\AccountInfoTable;
use Illuminate\Database\Eloquent\Model;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Border;
use PHPExcel_RichText;
use PHPExcel_Style_Color;

class MauSo extends Model
{

    /**************************************************
    Function Name	: mauSoTiepDan
    Description		: mau So Tiep Dan
    Argument		: $ketquatiepdan
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function mauSoTiepDan($ketquatiepdan)
    {
        $fileName = 'SoTiepDan';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $activeSheet = $objPHPExcel->getActiveSheet();

        //Header
        $activeSheet->setCellValue('A1', 'Stt');
        $activeSheet->setCellValue('B1', 'Ngày');
        $activeSheet->setCellValue('C1', 'Họ tên-Địa chỉ-Số CMND của công dân');
        $activeSheet->setCellValue('D1', 'Hình thức');
        $activeSheet->setCellValue('D2', 'Trình bày miệng');
        $activeSheet->setCellValue('E2', 'Trình bày kèm đơn');
        $activeSheet->setCellValue('F1', 'Nội dung trình bày');
        $activeSheet->setCellValue('G1', 'Phân loại');
        $activeSheet->setCellValue('G2', 'Khiếu nại');
        $activeSheet->setCellValue('H2', 'Tố cáo');
        $activeSheet->setCellValue('I2', 'Phản ánh, dân nguyện');
        $activeSheet->setCellValue('J1', 'Xử lý');
        $activeSheet->setCellValue('J2', 'Để lại giải quyết');
        $activeSheet->setCellValue('K2', 'Trả lại đơn và hướng dẫn');
        $activeSheet->setCellValue('L2', 'Chuyển đơn');
        $activeSheet->setCellValue('M1', 'Họ và tên lãnh đạo tiếp công dân');
        $activeSheet->setCellValue('N1', 'Công dân được tiếp ký tên');
        $activeSheet->setCellValue('O1', 'Ghi chú');

        //merger cell
        $activeSheet->mergeCells('A1:A2');
        $activeSheet->mergeCells('B1:B2');
        $activeSheet->mergeCells('C1:C2');
        $activeSheet->mergeCells('D1:E1');
        $activeSheet->mergeCells('F1:F2');
        $activeSheet->mergeCells('G1:I1');
        $activeSheet->mergeCells('J1:L1');
        $activeSheet->mergeCells('M1:M2');
        $activeSheet->mergeCells('N1:N2');
        $activeSheet->mergeCells('O1:O2');

        //Set Style
        $blobStyle = array(
            'font' => array('bold' => true)
        );

        $alignmentCenterCenterStyle = array(
            'alignment' => array(
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' =>\PHPExcel_Style_Alignment::VERTICAL_CENTER)
        );

        $borderStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $activeSheet->getStyle('A1:O1')->applyFromArray($blobStyle);
        $activeSheet->getStyle('A2:O2')->applyFromArray($blobStyle);
        $activeSheet->getStyle('A1:O1')->applyFromArray($alignmentCenterCenterStyle);
        $activeSheet->getStyle('A2:O2')->applyFromArray($alignmentCenterCenterStyle);
        $activeSheet->getStyle('A1:O1')->applyFromArray($borderStyle);
        $activeSheet->getStyle('A2:O2')->applyFromArray($borderStyle);
        $activeSheet->getStyle('A1:O1')->getAlignment()->setWrapText(true);
        $activeSheet->getStyle('A2:O2')->getAlignment()->setWrapText(true);

        //Set width

        $addNuber = 1;
        $activeSheet->getColumnDimension('A')->setWidth(3.13+$addNuber);
        $activeSheet->getColumnDimension('B')->setWidth(7.38+$addNuber);
        $activeSheet->getColumnDimension('C')->setWidth(15.63+$addNuber);
        $activeSheet->getColumnDimension('D')->setWidth(8.13+$addNuber);
        $activeSheet->getColumnDimension('E')->setWidth(8.13+$addNuber);
        $activeSheet->getColumnDimension('F')->setWidth(15.63+$addNuber);
        $activeSheet->getColumnDimension('G')->setWidth(8.38+$addNuber);
        $activeSheet->getColumnDimension('H')->setWidth(8.38+$addNuber);
        $activeSheet->getColumnDimension('I')->setWidth(8.38+$addNuber);
        $activeSheet->getColumnDimension('J')->setWidth(8.38+$addNuber);
        $activeSheet->getColumnDimension('K')->setWidth(8.38+$addNuber);
        $activeSheet->getColumnDimension('L')->setWidth(8.38+$addNuber);
        $activeSheet->getColumnDimension('M')->setWidth(18.25+$addNuber);
        $activeSheet->getColumnDimension('N')->setWidth(18.25+$addNuber);
        $activeSheet->getColumnDimension('O')->setWidth(7.75+$addNuber);

        //Set height
        $activeSheet->getRowDimension('1')->setRowHeight(15.75);
        $activeSheet->getRowDimension('2')->setRowHeight(63);

        foreach($ketquatiepdan as $rowNumber => $rowValue){

            $stt = $rowNumber+1;
            $rowPos = $rowNumber+3;
            $activeSheet->setCellValue('A'.$rowPos, $stt);
            $activeSheet->setCellValue('B'.$rowPos, date("d/m/Y", strtotime($rowValue->ngaytiep)));
            $activeSheet->setCellValue('C'.$rowPos, $rowValue->congdan.' - '.$rowValue->diachi);
            $activeSheet->setCellValue('F'.$rowPos, $rowValue->noidung);
            $activeSheet->setCellValue('M'.$rowPos, $rowValue->lanhdao);

            //Set style
            $activeSheet->getStyle('A'.$rowPos.':O'.$rowPos)->applyFromArray($alignmentCenterCenterStyle);
            $activeSheet->getStyle('A'.$rowPos.':O'.$rowPos)->applyFromArray($borderStyle);
            $activeSheet->getStyle('A'.$rowPos.':O'.$rowPos)->getAlignment()->setWrapText(true);

        }

        //Save excel file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename ='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        return $objWriter;
    }

    /**************************************************
    Function Name	: mauSoKhieuNai
    Description		: mau So Khieu Nai
    Argument		: $tu_Ngay,$den_Ngay
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function mauSoKhieuNai($donKhieuNai)
    {
        $fileName = 'SoKhieuNai';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $activeSheet = $objPHPExcel->getActiveSheet();

        //Header
        $activeSheet->setCellValue('A1', 'Stt');
        $activeSheet->setCellValue('B1', 'Ngày nhận đơn');
        $activeSheet->setCellValue('C1', 'Họ tên, địa chỉ người khiếu nại');
        $activeSheet->setCellValue('D1', 'Nội dung
khiếu nại');
        $activeSheet->setCellValue('E1', 'Phân loại
khiếu nại');
        $activeSheet->setCellValue('H1', 'Họ tên cán bộ được phân công thụ lý giải quyết (ký nhận)');
        $activeSheet->setCellValue('I1', 'Quyết định
thụ lý');
        $activeSheet->setCellValue('I2', 'Số');
        $activeSheet->setCellValue('J2', 'Ngày');
        $activeSheet->setCellValue('K1', 'Thời hạn giải quyết tố cáo (từ ngày đến ngày)');
        $activeSheet->setCellValue('L1', 'Quyết định giải quyết khiếu nại');
        $activeSheet->setCellValue('L2', 'Số');
        $activeSheet->setCellValue('M2', 'Ngày');
        $activeSheet->setCellValue('N1', 'Tóm tắt kết quả giải quyết');
        $activeSheet->setCellValue('O1', 'Phần theo dõi sau khi ban hành kết luận giải quyết');
        $activeSheet->setCellValue('O2', 'Tên cơ quan nhà nước cấp trên quan sát việc giải quyết có văn bản yêu cầu bổ sung hoặc điều chỉnh lại kết luận giải quyết');
        $activeSheet->setCellValue('P2', 'UBND Quận ban hành QĐ giải quyết lần 2 theo hướng giữ nguyên toàn bộ QĐ hoặc sửa đổi một phần QĐ giải quyết');

        //merger cell
        $activeSheet->mergeCells('A1:A2');
        $activeSheet->mergeCells('B1:B2');
        $activeSheet->mergeCells('C1:C2');
        $activeSheet->mergeCells('D1:D2');
        $activeSheet->mergeCells('E1:G1');
        $activeSheet->mergeCells('H1:H2');
        $activeSheet->mergeCells('I1:J1');
        $activeSheet->mergeCells('K1:K2');
        $activeSheet->mergeCells('L1:M1');
        $activeSheet->mergeCells('O1:P1');

        //Set Style

        $font12SizeStyle = array(
            'font'  => array(
                'bold'  => true,
                'size'  => 12,
                'name'  => 'Times New Roman'
            ));

        $font10SizeStyle = array(
            'font'  => array(
                'bold'  => true,
                'size'  => 10,
                'name'  => 'Times New Roman'
            ));

        $alignmentCenterCenterStyle = array(
            'alignment' => array(
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' =>\PHPExcel_Style_Alignment::VERTICAL_CENTER)
        );

        $borderStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $activeSheet->getStyle('A1:N1')->applyFromArray($font12SizeStyle);
        $activeSheet->getStyle('A2:N2')->applyFromArray($font12SizeStyle);
        $activeSheet->getStyle('O1:P1')->applyFromArray($font10SizeStyle);
        $activeSheet->getStyle('O2:P2')->applyFromArray($font10SizeStyle);
        $activeSheet->getStyle('A1:P1')->applyFromArray($alignmentCenterCenterStyle);
        $activeSheet->getStyle('A2:P2')->applyFromArray($alignmentCenterCenterStyle);
        $activeSheet->getStyle('A1:P1')->applyFromArray($borderStyle);
        $activeSheet->getStyle('A2:P2')->applyFromArray($borderStyle);
        $activeSheet->getStyle('A1:P1')->getAlignment()->setWrapText(true);
        $activeSheet->getStyle('A2:P2')->getAlignment()->setWrapText(true);

        //Set width

        $addNuber = 1;
        $activeSheet->getColumnDimension('A')->setWidth(3.13+$addNuber);
        $activeSheet->getColumnDimension('B')->setWidth(7.38+$addNuber);
        $activeSheet->getColumnDimension('C')->setWidth(18.63+$addNuber);
        $activeSheet->getColumnDimension('D')->setWidth(21.5+$addNuber);
        $activeSheet->getColumnDimension('E')->setWidth(5.13+$addNuber);
        $activeSheet->getColumnDimension('F')->setWidth(5.13+$addNuber);
        $activeSheet->getColumnDimension('G')->setWidth(5.13+$addNuber);
        $activeSheet->getColumnDimension('H')->setWidth(15.63+$addNuber);
        $activeSheet->getColumnDimension('I')->setWidth(8.13+$addNuber);
        $activeSheet->getColumnDimension('J')->setWidth(6.75+$addNuber);
        $activeSheet->getColumnDimension('K')->setWidth(8.38+$addNuber);
        $activeSheet->getColumnDimension('L')->setWidth(8.13+$addNuber);
        $activeSheet->getColumnDimension('M')->setWidth(6.75+$addNuber);
        $activeSheet->getColumnDimension('N')->setWidth(14.63+$addNuber);
        $activeSheet->getColumnDimension('O')->setWidth(14.13+$addNuber);
        $activeSheet->getColumnDimension('P')->setWidth(14.13+$addNuber);

        //Set height
        $activeSheet->getRowDimension('1')->setRowHeight(38.25);
        $activeSheet->getRowDimension('2')->setRowHeight(89.25);

        foreach($donKhieuNai as $rowNumber => $rowValue){

            $stt = $rowNumber+1;
            $rowPos = $rowNumber+3;
            $activeSheet->setCellValue('A'.$rowPos, $stt);
            $activeSheet->setCellValue('B'.$rowPos, date("d/m/Y", strtotime($rowValue->ngaynhan)));
            $activeSheet->setCellValue('C'.$rowPos, $rowValue->tennguoivietdon.', '.$rowValue->diachinguoiviet);
            $activeSheet->setCellValue('D'.$rowPos, $rowValue->noidung);

            if('' != $rowValue->nguoixuly) {

                $activeSheet->setCellValue('H' . $rowPos, AccountInfoTable::GetFullName($rowValue->nguoixuly));
            }

            //Set style
            $activeSheet->getStyle('A'.$rowPos.':P'.$rowPos)->applyFromArray($alignmentCenterCenterStyle);
            $activeSheet->getStyle('A'.$rowPos.':P'.$rowPos)->applyFromArray($borderStyle);
            $activeSheet->getStyle('A'.$rowPos.':P'.$rowPos)->getAlignment()->setWrapText(true);

        }


        //Save excel file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename ='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        return $objWriter;
    }

    /**************************************************
    Function Name	: mauSoToCao
    Description		: mau So To Cao
    Argument		: $tu_Ngay,$den_Ngay
    Creation Date	: 2016/08/01
    Author			: KhanhTH
    Reviewer		: PhucHM
     ***************************************************/
    public static function mauSoToCao($donToCao)
    {
        $fileName = 'SoToCao';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $activeSheet = $objPHPExcel->getActiveSheet();

        //Header
        $activeSheet->setCellValue('A1', 'Stt');
        $activeSheet->setCellValue('B1', 'Ngày nhận đơn, phiếu chuyển');
        $activeSheet->setCellValue('C1', 'Họ tên, địa chỉ
người tố cáo');
        $activeSheet->setCellValue('D1', 'Nội dung tố cáo');
        $activeSheet->setCellValue('E1', 'Phân loại tố cáo');
        $activeSheet->setCellValue('E2', 'Hối lộ');
        $activeSheet->setCellValue('F2', 'Lợi dụng chức quyền');
        $activeSheet->setCellValue('G2', 'Vi phạm tài chính và
kinh tế');
        $activeSheet->setCellValue('H2', 'Khác');
        $activeSheet->setCellValue('I1', 'Họ tên cán bộ được phân công thụ lý giải quyết');
        $activeSheet->setCellValue('J1', 'Quyết định thụ lý');
        $activeSheet->setCellValue('J2', 'Số');
        $activeSheet->setCellValue('K2', 'Ngày');
        $activeSheet->setCellValue('L1', 'Thời hạn giải quyết tố cáo
(từ ngày đến ngày)');
        $activeSheet->setCellValue('M1', 'Báo cáo kết quả
(kết luận) giải quyết tố cáo');
        $activeSheet->setCellValue('M2', 'Số');
        $activeSheet->setCellValue('N2', 'Ngày');
        $activeSheet->setCellValue('O1', 'Tóm tắt
kết quả
giải quyết');
        $activeSheet->setCellValue('P1', 'Phần theo dõi sau khi ban hành kết luận giải quyết');
        $activeSheet->setCellValue('P2', 'Tên cơ quan nhà nước cấp trên quan sát việc giải quyết có văn bản yêu cầu bổ sung hoặc điều chỉnh lại kết luận giải quyết');
        $activeSheet->setCellValue('Q1', 'Ghi chú');


        //merger cell
        $activeSheet->mergeCells('A1:A2');
        $activeSheet->mergeCells('B1:B2');
        $activeSheet->mergeCells('C1:C2');
        $activeSheet->mergeCells('D1:D2');
        $activeSheet->mergeCells('E1:H1');
        $activeSheet->mergeCells('I1:I2');
        $activeSheet->mergeCells('J1:K1');
        $activeSheet->mergeCells('L1:L2');
        $activeSheet->mergeCells('M1:N1');
        $activeSheet->mergeCells('O1:O2');

        //Set Style

        $font12SizeStyle = array(
            'font'  => array(
                'bold'  => true,
                'size'  => 12,
                'name'  => 'Times New Roman'
            ));

        $font10SizeStyle = array(
            'font'  => array(
                'bold'  => true,
                'size'  => 10,
                'name'  => 'Times New Roman'
            ));

        $alignmentCenterCenterStyle = array(
            'alignment' => array(
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' =>\PHPExcel_Style_Alignment::VERTICAL_CENTER)
        );

        $borderStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $activeSheet->getStyle('A1:O1')->applyFromArray($font12SizeStyle);
        $activeSheet->getStyle('J2:N2')->applyFromArray($font12SizeStyle);
        $activeSheet->getStyle('E2:H2')->applyFromArray($font10SizeStyle);
        $activeSheet->getStyle('P1:P2')->applyFromArray($font10SizeStyle);
        $activeSheet->getStyle('Q1')->applyFromArray($font12SizeStyle);
        $activeSheet->getStyle('A1:Q1')->applyFromArray($alignmentCenterCenterStyle);
        $activeSheet->getStyle('A2:Q2')->applyFromArray($alignmentCenterCenterStyle);
        $activeSheet->getStyle('A1:Q1')->applyFromArray($borderStyle);
        $activeSheet->getStyle('A2:Q2')->applyFromArray($borderStyle);
        $activeSheet->getStyle('A1:Q1')->getAlignment()->setWrapText(true);
        $activeSheet->getStyle('A2:Q2')->getAlignment()->setWrapText(true);

        //Set width
        $addNuber = 1;
        $activeSheet->getColumnDimension('A')->setWidth(3.13+$addNuber);
        $activeSheet->getColumnDimension('B')->setWidth(7.38+$addNuber);
        $activeSheet->getColumnDimension('C')->setWidth(17.63+$addNuber);
        $activeSheet->getColumnDimension('D')->setWidth(21.5+$addNuber);
        $activeSheet->getColumnDimension('E')->setWidth(5.13+$addNuber);
        $activeSheet->getColumnDimension('F')->setWidth(5.13+$addNuber);
        $activeSheet->getColumnDimension('G')->setWidth(5.13+$addNuber);
        $activeSheet->getColumnDimension('H')->setWidth(5.13+$addNuber);
        $activeSheet->getColumnDimension('I')->setWidth(14.13+$addNuber);
        $activeSheet->getColumnDimension('J')->setWidth(9.38+$addNuber);
        $activeSheet->getColumnDimension('K')->setWidth(9.38+$addNuber);
        $activeSheet->getColumnDimension('L')->setWidth(8.38+$addNuber);
        $activeSheet->getColumnDimension('M')->setWidth(9.38+$addNuber);
        $activeSheet->getColumnDimension('N')->setWidth(9.38+$addNuber);
        $activeSheet->getColumnDimension('O')->setWidth(14.13+$addNuber);
        $activeSheet->getColumnDimension('P')->setWidth(13.63+$addNuber);
        $activeSheet->getColumnDimension('Q')->setWidth(8.38+$addNuber);

        //Set height
        $activeSheet->getRowDimension('1')->setRowHeight(38.25);
        $activeSheet->getRowDimension('2')->setRowHeight(89.25);

        foreach($donToCao as $rowNumber => $rowValue){

            $stt = $rowNumber+1;
            $rowPos = $rowNumber+3;
            $activeSheet->setCellValue('A'.$rowPos, $stt);
            $activeSheet->setCellValue('B'.$rowPos, date("d/m/Y", strtotime($rowValue->ngaynhan)));
            $activeSheet->setCellValue('C'.$rowPos, $rowValue->tennguoivietdon.', '.$rowValue->diachinguoiviet);
            $activeSheet->setCellValue('D'.$rowPos, $rowValue->noidung);

            if('' != $rowValue->nguoixuly) {

                $activeSheet->setCellValue('I' . $rowPos, AccountInfoTable::GetFullName($rowValue->nguoixuly));
            }

            //Set style
            $activeSheet->getStyle('A'.$rowPos.':Q'.$rowPos)->applyFromArray($alignmentCenterCenterStyle);
            $activeSheet->getStyle('A'.$rowPos.':Q'.$rowPos)->applyFromArray($borderStyle);
            $activeSheet->getStyle('A'.$rowPos.':Q'.$rowPos)->getAlignment()->setWrapText(true);

        }


        //Save excel file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename ='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        return $objWriter;
    }
}