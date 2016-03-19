<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RollNoSlip extends CI_Controller {
    function __construct()
    {
        //DebugBreak();

        parent::__construct();
        $this->load->helper('url');
        //this condition checks the existence of session if user is not accessing  
        //login method as it can be accessed without user session
        $this->load->library('session');
        if( !$this->session->userdata('logged_in') && $this->router->method != 'login' ) {
            redirect('login');
        }
    }
    public function index()
    {

        $this->load->helper('url');
        $data = array(
            'isselected' => '4',
        );
        // DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('RollNoSlip/Index.php');
        $this->load->view('common/footer.php');


    }

    public function NinthStd(){
        $this->load->helper('url');
        $data = array(
            'isselected' => '4',
        );
        //  DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('RollNoSlip_model');
        $NinthStdData = array('data'=>$this->RollNoSlip_model->get9thStdData($user['Inst_Id']));
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('RollNoSlip/9thGrid.php',$NinthStdData);
        $this->load->view('common/footer.php');
    }
    public function TenthStd(){
        $this->load->helper('url');
        $data = array(
            'isselected' => '4',
        );
        //DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('RollNoSlip_model');
        $TenthStdData = array('data'=>$this->RollNoSlip_model->get10thStdData($user['Inst_Id']));
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('RollNoSlip/MatricGrid.php',$TenthStdData);
        $this->load->view('common/footer.php');
    }
    public function MatricRollNo()
    {
        //DebugBreak()  ;
        $this->load->helper('url');
        //Load the library
        //   $this->load->library('html2pdf');

        $rno = $this->uri->segment(3);
        $sess=1;
        $class =10;
        $year=2016;

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];

        $Inst_Id = $user['Inst_Id'];

        $this->load->model('RollNoSlip_model');
        $studeninfo = array('data'=>$this->RollNoSlip_model->get10thrslip($rno,$class,$year,$sess));
        /* 
        $this->html2pdf->folder('./assets/pdfs/');
        //Set the filename to save/download as
        $this->html2pdf->filename($rno.'.pdf');
        //Set the paper defaults
        $this->html2pdf->paper('a4', 'portrait');*/
        //I'm just using rand() function for data example
        $temp = "$rno@$class@$sess@$year@$Inst_Id";
        $image =  $this->set_barcode($temp);
        $studeninfo['data']['info'][0]['barcode'] = $image;
        //Load html view
        //$this->html2pdf->html($this->load->view('RollNoSlip/MatricRollNo', $studeninfo['data'], true,array(0, 0, 0, 0)));

        //if($this->html2pdf->create('save')) {
        //DebugBreak();
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->setHeaderData('',0,'','',array(0,0,0), array(255,255,255) );  
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetTitle('Pdf Example');
        $pdf->SetHeaderMargin(1);
        $pdf->SetTopMargin(1);
        $pdf->setFooterMargin(1);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->SetFont('helvetica', '', 8);
        $pdf->AddPage();
        $pdf->SetAuthor('BiseGrw');
        $pdf->SetMargins(-1, 1, 4, true);
        //DebugBreak();
        $html = $this->load->view('RollNoSlip/MatricRollNo', $studeninfo['data']['info'][0], true);   
        $pdf->writeHTML($html, true, false, true, false, '');  
        $pdf->Output($rno.'.pdf', 'I');
        // if($this->html2pdf->create('downlaod')) {
        // $this->load->view('RollNoSlip/MatricRollNo', $studeninfo['data'], true,array(0, 0, 0, 0));
        // return false;
        if($class == 10)
            redirect('RollNoSlip/TenthStd');
        else if($class == 9)
            redirect('RollNoSlip/NinthStd');
            //   }            

    }

    public function MatricRollNoGroupwise()
    {
        // DebugBreak()  ;
        $this->load->helper('url');
        //Load the library
        $this->load->library('html2pdf');

        $grp_cd = $this->uri->segment(3);
        $sess=1;
        $class =10;
        $year=2016;

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];

        //DebugBreak();
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->setHeaderData('',0,'','',array(0,0,0), array(255,255,255) );  
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetTitle('Matric Roll Number Slip');
        $pdf->SetHeaderMargin(1);
        $pdf->SetTopMargin(1);
        $pdf->setFooterMargin(1);
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->SetAuthor('BiseGrw');
        $pdf->SetMargins(4, 1, 4, true);
        $Inst_Id = $user['Inst_Id'];

        $this->load->model('RollNoSlip_model');
        // DebugBreak();
        $studeninfo = array('data'=>$this->RollNoSlip_model->get10thrslipWith_Grp_CD($class,$year,$sess,$grp_cd,$Inst_Id));


        $template_pdf = '';
        $totalslips = count($studeninfo['data']['slip']);
        $studentslip  = array();

        //DebugBreak();
        for($i =0 ; $i <count($studeninfo['data']['info']); $i++)
        {
            $pdf->AddPage();
            $rno = $studeninfo['data']['info'][$i]['Rno'];
            $temp = "$rno@$class@$sess@$year@$Inst_Id";
            $image =  $this->set_barcode($temp);
            $studeninfo['data']['info'][$i]['barcode'] = $image;
            for($j =0 ; $j <$totalslips; $j++)
            {
                if($rno == $studeninfo['data']['slip'][$j]['rno'])
                {
                    $studeninfo['data']['info'][$i]['slips'][] = $studeninfo['data']['slip'][$j];
                }
            }
            // DebugBreak();
            $html = $this->load->view('RollNoSlip/MatricRollNoCombine', $studeninfo['data']['info'][$i], true);   
            $pdf->writeHTML($html, true, false, true, false, '');    
            if($i ==0)
                break;
              
        }
        
        $pdf->Output('pdfexample.pdf', 'I');

        //$this->html2pdf->html($this->load->view('RollNoSlip/MatricRollNoCombine', $studeninfo['data'], true));
        //  $this->html2pdf->html($template_pdf);

        /* if($this->html2pdf->create('downlaod')) {
        if($class == 10)
        redirect('RollNoSlip/TenthStd');
        else if($class == 9)
        redirect('RollNoSlip/NinthStd');
        }      */      

    }

    private function set_barcode($code)
    {
        //DebugBreak()  ;
        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');

        // $config = new Zend_Config(array(
        //          'barcode'        => 'code39',
        //            'barcodeParams'  => array('text' => 'TestCode', 'barHeight'=>30, 'factor'=>2),
        //              'renderer'       => 'image',
        //               'rendererParams' => array('imageType' => 'gif'),
        //               ));

        $file = Zend_Barcode::draw('code128','image', array('text' => $code,'drawText'=>false), array());
        //$code = $code;
        $store_image = imagepng($file,"./assets/pdfs/{$code}.png");
        return $code.'.png';
        //generate barcode
        // $imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$code), array());
        //  $imageResource = Zend_Barcode::draw('code128', 'image', array('text'=>$code), array());
        //file_put_contents($filename, $imageResource);
        // return $filename;
        //imagegif($imageResource->draw(), 'barcode-img/barcode.gif');
        // file_put_contents($filename, $imageResource);
        // return $imageResource;
    }

    public function NinthRollNo()
    {
        // DebugBreak()  ;
        $this->load->helper('url');
        //Load the library
        $this->load->library('html2pdf');

        $rno = $this->uri->segment(3);
        $sess=1;
        $class =9;
        $year=2015;

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];

        $Inst_Id = $user['Inst_Id'];

        $this->load->model('RollNoSlip_model');
        $studeninfo = array('data'=>$this->RollNoSlip_model->get9thrslip($rno,$class,$year,$sess));
        //$this->input->get('your_get_variable', TRUE);

        $this->html2pdf->folder('./assets/pdfs/');
        //Set the filename to save/download as
        $this->html2pdf->filename($rno.'.pdf');
        //Set the paper defaults
        $this->html2pdf->paper('a4', 'portrait');
        //I'm just using rand() function for data example
        $temp = "$rno@$class@$sess@$year@$Inst_Id";
        $image =  $this->set_barcode($temp);
        $studeninfo['data']['barcode'] = $image;
        //Load html view
        $this->html2pdf->html($this->load->view('RollNoSlip/NinthRollNo', $studeninfo['data'], true,array(0, 0, 0, 0)));

        //if($this->html2pdf->create('save')) {
        if($this->html2pdf->create('downlaod')) 
        {
            $this->load->view('RollNoSlip/NinthRollNo', $studeninfo['data'], true,array(0, 0, 0, 0));
            return false;
            if($class == 10)
                redirect('RollNoSlip/TenthStd');
            else if($class == 9)
                redirect('RollNoSlip/NinthStd');
        }            

    }
    // private function set_barcode($code)
    //    {
    //        //load library
    //        $this->load->library('zend');
    //        //load in folder Zend
    //        $this->zend->load('Zend/Barcode');
    //        //generate barcode
    //        Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
    //    }
    //    
    //public function mail_pdf()
    //    {
    //        //Load the library
    //        $this->load->library('html2pdf');
    //        
    //        $this->html2pdf->folder('./assets/pdfs/');
    //        $this->html2pdf->filename('email_test.pdf');
    //        $this->html2pdf->paper('a4', 'portrait');
    //        
    //        $data = array(
    //            'title' => 'PDF Created',
    //            'message' => 'Hello World!'
    //        );
    //        //Load html view
    //        $this->html2pdf->html($this->load->view('pdf', $data, true));
    //        
    //        //Check that the PDF was created before we send it
    //        if($path = $this->html2pdf->create('save')) {
    //            
    //            $this->load->library('email');
    //
    //            $this->email->from('your@example.com', 'Your Name');
    //            $this->email->to('someone@example.com'); 
    //            
    //            $this->email->subject('Email PDF Test');
    //            $this->email->message('Testing the email a freshly created PDF');    
    //
    //            $this->email->attach($path);
    //
    //            $this->email->send();
    //            
    //            echo $this->email->print_debugger();
    //                        
    //        }
    //        
    //    } 
}

/* End of file example.php */
/* Location: ./application/controllers/example.php */