<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Category_model;
use App\Models\Product_model;
use App\Models\Sub_Category_Model;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf;

class Report extends Controller
{

    function __construct() {
        $this->db = db_connect();
        $this->product_model = new Product_model();
    }




    public function product()
   {
       $products = $this->product_model->getProduct();
       $filename = date('y-m-d-H-i-s'). '-qadr-labs-report';

       // instantiate and use the dompdf class
       $dompdf = new Dompdf();

       // load HTML content
       $dompdf->loadHtml(view('report/product'));

       // (optional) setup the paper size and orientation
       $dompdf->setPaper('A4', 'landscape');

       // render html as PDF
       $dompdf->render();

       // output the generated pdf
       $dompdf->stream($filename);
    }

//     public function product()
//     {
//        $products = $this->product_model->getProduct();

//         // ambil data transaction dari database
//         // panggil class Sreadsheet baru
//         $spreadsheet = new Spreadsheet;
//         // Buat custom header pada file excel
//         $spreadsheet->setActiveSheetIndex(0)
//                     ->setCellValue('A1', 'No')
//                     ->setCellValue('B1', 'Product')
//                     ->setCellValue('C1', 'Date')
//                     ->setCellValue('D1', 'Price');
//         // define kolom dan nomor
//         $kolom = 2;
//         $nomor = 1;
//         // tambahkan data transaction ke dalam file excel
//         foreach($products as $data) {

//             $spreadsheet->setActiveSheetIndex(0)
//                         ->setCellValue('A' . $kolom, $nomor)
//                         ->setCellValue('B' . $kolom, $data['product_name'])
//                         ->setCellValue('C' . $kolom, $data['product_status'])
//                         ->setCellValue('D' . $kolom, "Rp. ".number_format($data['product_price']));

//             $kolom++;
//             $nomor++;

//         }
//         // download spreadsheet dalam bentuk excel .xlsx
//         $writer = new Xlsx($spreadsheet);

//         header('Content-Type: application/vnd.ms-excel');
//         header('Content-Disposition: attachment;filename="Laporan_Transaction.xlsx"');
//         header('Cache-Control: max-age=0');

//         $writer->save('php://output');
//    }
}