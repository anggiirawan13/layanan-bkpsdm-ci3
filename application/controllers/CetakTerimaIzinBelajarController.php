<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CetakTerimaIzinBelajarController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PdfModel', 'createpdf');
    }
    public function index()
    {
        $data['title'] = 'Konfirmasi Pengajuan Izin Belajar';
        // $data['getInfo'] = $this->createpdf->getContent();
        $this->load->view('template/admin/daftar_konfirmasi_izin_belajar', $data);
    }

    // generate PDF File
    public function terimaAjuIzinBelajar()
    {
        $data = array();
        $htmlContent = '';
        $id_izin_belajar = $this->input->GET('id');

        $data['info'] = $this->createpdf->getTerimaAjuIzinBelajar($id_izin_belajar);
        $htmlContent = $this->load->view('template/cetak/terima_izin_belajar', $data, TRUE);

        $createPDFFile = time() . '.pdf';
        $this->createPDF($createPDFFile, $htmlContent);
        redirect($createPDFFile);
    }

    // create pdf file 
    public function createPDF($fileName, $html)
    {
        ob_start();
        // Include the main TCPDF library (search for installation path).
        $this->load->library('pdf');
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // $pdf = new TCPDF();
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('BKPSDM Kota Palembang');
        $pdf->SetTitle('Laporan Izin Belajar');
        $pdf->SetSubject('Laporan Izin Belajar');
        $pdf->SetKeywords('Pengajuan Izin Belajar');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);

        // set auto page breaks
        //$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 0);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // set font
        $pdf->SetFont('dejavusans', '', 10);

        // add a page
        $pdf->AddPage();

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // reset pointer to the last page
        $pdf->lastPage();
        ob_end_clean();
        //Close and output PDF documentf
        // $pdf->Output();
        $pdf->Output('C:/xampp/htdocs/layanan_bkpsdm/' . $fileName, 'F');
        //  $pdf->Output($fileName, 'F');
    }
}
