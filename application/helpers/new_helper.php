<?php defined('BASEPATH') OR exit('No direct script access allowed');
// generate pdf
function generate_pdf($name, $tpl, $data)
{
    $ci = &get_instance();
    $data['data'] = $data;
    $ci->load->view($tpl, $data);
    // Get output html
    $html = $ci->output->get_output();
  
// add external css library
   
    // Load pdf library
    $ci->load->library('pdf');
    //$ci->dompdf->set_option('isHtml5ParserEnabled', true);
    //$ci->dompdf->set_option('isRemoteEnabled', true);
    $ci->dompdf->loadHtml($html);
 
    // setup size
    $ci->dompdf->setPaper('A4', 'portrait');
    // Render the HTML as PDF
    $ci->dompdf->render();
    // Output  PDF (1 = download and 0 = preview)
    $ci->dompdf->stream($name, array("Attachment" => 0));
    exit(0);
}
?>