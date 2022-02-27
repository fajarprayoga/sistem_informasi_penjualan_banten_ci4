<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Product_model;
use Dompdf\Dompdf;

class Report extends Controller
{

    function __construct() {
        $this->db = db_connect();
        $this->product_model = new Product_model();
    }

    public function product()
   {

        // return view('report/product');
        return view('report/product');
        // dd($this->request->getGet());
        // $this->product_model->get;
    }

    public function generateProduct()
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
}