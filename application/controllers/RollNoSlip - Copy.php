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
        
       // $studeninfo['data']['info'][0]['errmessage'] = 'slip problem';
       
      /*  $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->setHeaderData('',0,'','',array(0,0,0), array(255,255,255) );  
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetTitle('Matric Roll Number Slips 2016');
        $pdf->SetHeaderMargin(2);
        $pdf->SetTopMargin(6);
        $pdf->setFooterMargin(1);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->SetFont('helvetica', '', 8);
         $pdf->SetAuthor('BiseGrw');
         $pdf->SetMargins(4, 6, 4, true);
        $pdf->AddPage();*/
       
       $this->load->library('PDFF');
        $pdf=new PDFF('P','in',"A4");   
         $pdf->SetAutoPageBreak(true,2);
         //$pdf->SetTopMargin(1);
         
       
       // $html = $this->load->view('RollNoSlip/MatricRollNo', $studeninfo['data']['info'][0], true);   
       // $pdf->writeHTML($html, true, false, true, false, '');  
       $pdf->AddPage();

       //$html = $this->load->view('RollNoSlip/MatricRollNoCombine',  $tempdata['info'], true);   
       $this->makepdf($pdf, $studeninfo['data']['info'][0]);
        $pdf->Output($rno.'.pdf', 'I');
        
        if($class == 10)
            redirect('RollNoSlip/TenthStd');
        else if($class == 9)
            redirect('RollNoSlip/NinthStd');

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
       /* $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->setHeaderData('',0,'','',array(0,0,0), array(255,255,255) );  
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetTitle('Matric Roll Number Slips 2016');
        $pdf->SetHeaderMargin(2);
        $pdf->setFooterMargin(1);
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->SetAuthor('BiseGrw');
        $pdf->SetMargins(4, 6, 4, true);*/
        
        $this->load->library('PDFF');
        $pdf=new PDFF('P','in',"A4");   
         $pdf->SetAutoPageBreak(true,2);
        // $pdf->Open();
       // $pdf->SetMargins(25.4,25.4,25.4,25.4);
        
        
        $Inst_Id = $user['Inst_Id'];

        $this->load->model('RollNoSlip_model');
        $sub_cd = '';
        if($grp_cd == 1)
        {
            $sub_cd = 8;
            $grp_cd =1;
        }
        else if($grp_cd == 7)
        {
            $sub_cd = 78;
            $grp_cd =1;
        }
        else if($grp_cd == 8)
        {
            $sub_cd = 43;
            $grp_cd = 1;
        }
        $studeninfo = array('data'=>$this->RollNoSlip_model->get10thrslipWith_Grp_CD($class,$year,$sess,$grp_cd,$Inst_Id,$sub_cd));


        $template_pdf = '';
        $totalslips = count($studeninfo['data']['slip']);
        $studentslip  = array();
        $tempdata  = array();
        for($i =0 ; $i <count($studeninfo['data']['info']); $i++)
        {
          
            $rno = $studeninfo['data']['info'][$i]['Rno'];
            $tempdata['info'] = array();
            $temp = "$rno@$class@$sess@$year@$Inst_Id";
            $image =  $this->set_barcode($temp);
            $studeninfo['data']['info'][$i]['barcode'] = $image;
             $tempdata['info'] = $studeninfo['data']['info'][$i];
            for($j =0 ; $j <$totalslips; $j++)
            {
               if($rno == $studeninfo['data']['slip'][$j]['rno'])
                {
                   $tempdata['info']['slips'][] = $studeninfo['data']['slip'][$j];
                }
            }
            if(count($tempdata['info'])>0)
            {
                $pdf->AddPage();
                
                //$html = $this->load->view('RollNoSlip/MatricRollNoCombine',  $tempdata['info'], true);   
                $this->makepdf($pdf,$tempdata['info']);
              
               break;  
            }
            
          
         
        }
        $pdf->Output($Inst_Id.'.pdf', 'I');

       
        /* if($this->html2pdf->create('downlaod')) {
        if($class == 10)
        redirect('RollNoSlip/TenthStd');
        else if($class == 9)
        redirect('RollNoSlip/NinthStd');
        }      */      

    }
    
    
    private function makepdf($pdf,$info)
    {
        if($info['Session'] ==1) $Session= 'ANNUAL'; else $Session='SUPPLY';
        if($info['errmessage'] == null) $errmessage = '(PROVISIONALLY)'; else{ $errmessage = ' (PROVISIONALLY OBJECTION SLIP)';};

        if($info['grp_cd'] == 1)  $grp_cd = 'SCIENCE'; else if($info['grp_cd'] == 2) $grp_cd='GENERAL';
            if($info['Gender']==1) $Gender= 'MALE'; else if($info['Gender']==2) $Gender= 'FEMALE';
            // $filepath = base_url().'assets/'.$info['picpath'];
            $filepath = 'assets/img/download.jpg';


        $fontSize = 8; 
        $marge    = .4;   // between barcode and hri in pixel
        $bx        = 3.97;  // barcode center
        $by        = .75;  // barcode center
        $height   = 0.35;   // barcode height in 1D ; module size in 2D
        $width    = .0135;  // barcode height in 1D ; not use in 2D
        $angle    = 0;   // rotation in degrees

        $code     = '222020';     // barcode (CP852 encoding for Polish and other Central European languages)
        $type     = 'code128';
        $black    = '000000'; // color in hex
        $Y = 3;
        $pdf->SetTextColor(0 ,0,0);
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(22.2,7.2);
        $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE & SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");
        // $pdf->SetFont('Arial','R',10);
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(26.2,10.9);
        $pdf->Cell(0, 0.2, "ROLL NUMBER SLIP (WITH DATE SHEET) FOR S.S.C $Session EXAMINATION, ".$info["Year"], 0.25, "C");  

        $pdf->Image("assets/img/icon2.png",5.0,3.0, 20.65,18.65, "PNG");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(68,15.2);
        $pdf->Cell(0, 0.2, $errmessage, 0.25, "C"); 



        $pdf->SetXY(40.2,21.2);
        $pdf->Image("assets/pdfs/".$info['barcode'],126.0,15.1, 43.65,5.65, "PNG");  

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(138.0,26.1);
        $pdf->Cell(0, 0.2, $grp_cd, 0.25, "C");

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(133.0,31.1);
        $pdf->Cell(29.5,6.2,'',1,0,'C',0); 
        $pdf->SetXY(133.0,34.1);
        $pdf->Cell(0, 0.2, "SCHEME = 1100 ", 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(172.2,13.2);
        $pdf->Cell(0, 0.2, "FormNo: ", 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(185.2,13.2);
        $pdf->Cell(0, 0.2, $info['formno'], 0.25, "C");


        $pdf->SetXY(40.2,21.2);
        $pdf->Image($filepath,173.0,15.1, 30.65,30.65, "jpg");  

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(182.2,48.2);
        $pdf->Cell(0, 0.2, $Gender, 0.25, "C");


        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,21.2);
        $pdf->Cell(0, 0.2, "ROLL NO.               :", 0.25, "C");


        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(40.9,14.2+ $Y);
        $pdf->Cell(14.5,6.2,'',1,0,'C',0); 
        $pdf->SetXY(40.8,17.4+ $Y);
        $pdf->Cell(0, 0.2, $info['Rno'], 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,23.2 + + $Y);
        $pdf->Cell(0, 0.2, "NAME                      :", 0.25, "C");


        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(40.2,23.2+ $Y);
        $pdf->Cell(0, 0.2, $info['Name'], 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,28.2+ $Y);
        $pdf->Cell(0, 0.2, "FATHER'S NAME    :", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(40.2,28.2+ $Y);
        $pdf->Cell(0, 0.2, $info['FathersName'], 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,33.2+ $Y);
        $pdf->Cell(0, 0.2, "DATE OF BIRTH     :", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(40.2,33.2+ $Y);
        $pdf->Cell(0, 0.2, $info['DOB'], 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,38.2+ $Y);
        $pdf->Cell(0, 0.2, "CENTER                  :", 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(40.2,36.2+ $Y);
        $pdf->MultiCell(130, 5, $info['cent_cd'].'-'.$info['Cent_Name'],0);
        if($info['errmessage'] == null) 
        {
            $isthird = 0;
            $ispratical = 0;
            $countter = 0;
            $part2sub = '';
            $part2html = '';
            $countter9 = 0;
            $part1sub = '';
            $part1html = '';
            $noteimageheight =66; 
            if(@$info['slips'][0]['subp2count']>0) {

                $xx= 46.2+ $Y;
                $boxWidth = 150.0;
                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(10.2,50.2+ $Y);
                $pdf->SetFillColor(240,240,240);
                $pdf->Cell($boxWidth,5,'THEORY = PART - II',1,0,'C',1);
                $pdf->SetFillColor(255,255,255);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(10.2,55.2+ $Y);
                $pdf->Cell(8,5,'Sr#',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(18.2,55.2+ $Y);
                $pdf->Cell(85,5,'SUBJECT(S)',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(100,55.2+ $Y);
                $pdf->Cell(20,5,'DATE',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(120.1,55.2+ $Y);
                $pdf->Cell(20,5,'DAY',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(140,55.2+ $Y);
                $pdf->Cell(20,5,'TIME',1,0,'C',1);


                for($k = 0; $k<$info['slips'][0]['subp2count']; $k++) { 
                    if($info['slips'][$k]['class'] == 10) {
                        $countter++;
                        $Y = $Y + 4;

                        $pdf->SetFont('Arial','',8);
                        $pdf->SetXY(10.2,55.2+ $Y);
                        $pdf->Cell(8,5,$countter,1,0,'C',1);

                        $pdf->SetFont('Arial','',8);
                        $pdf->SetXY(18.2,55.2+ $Y);
                        $pdf->Cell(85,5,$info['slips'][$k]['sub_Name'],1,0,'L',1);

                        $pdf->SetFont('Arial','',8);
                        $pdf->SetXY(100,55.2+ $Y);
                        $pdf->Cell(20,5,$info['slips'][$k]['Date2'],1,0,'C',1);

                        $pdf->SetFont('Arial','',8);
                        $pdf->SetXY(120.1,55.2+ $Y);
                        $pdf->Cell(20,5,$info['slips'][$k]['Day'],1,0,'C',1);

                        $pdf->SetFont('Arial','',8);
                        $pdf->SetXY(140,55.2+ $Y);
                        $pdf->Cell(20,5,$info['slips'][$k]['TIME'],1,0,'C',1);

                    }
                }
            }
            // THEOROR PART I SUBJECT TABLE

            if(@$info['slips'][$countter]['subp1count'] > 0)
            {

                $boxWidth = 150.0;
                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(10.2,62.2+ $Y);
                $pdf->SetFillColor(240,240,240);
                $pdf->Cell($boxWidth,5,'THEORY = PART - I',1,0,'C',1);
                $pdf->SetFillColor(255,255,255);
                $Y = $Y + 12;
                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(10.2,55.2+ $Y);
                $pdf->Cell(8,5,'Sr#',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(18.2,55.2+ $Y);
                $pdf->Cell(85,5,'SUBJECT(S)',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(100,55.2+ $Y);
                $pdf->Cell(20,5,'DATE',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(120.1,55.2+ $Y);
                $pdf->Cell(20,5,'DAY',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(140,55.2+ $Y);
                $pdf->Cell(20,5,'TIME',1,0,'C',1);

                if(@$info['slips'][$countter]['subp1count'] >4)
                    $noteimageheight = $noteimageheight+13;
                for($l = 0; $l<$info['slips'][$countter]['subp1count']; $l++) { 
                    if($info['slips'][$l+$countter]['class'] == 9) {
                        $countter9++;

                        $Y = $Y + 4;

                        $pdf->SetFont('Arial','',8);
                        $pdf->SetXY(10.2,55.2+ $Y);
                        $pdf->Cell(8,5,$countter9,1,0,'C',1);

                        $pdf->SetFont('Arial','',8);
                        $pdf->SetXY(18.2,55.2+ $Y);
                        $pdf->Cell(85,5,$info['slips'][$l+$countter]['sub_Name'],1,0,'L',1);

                        $pdf->SetFont('Arial','',8);
                        $pdf->SetXY(100,55.2+ $Y);
                        $pdf->Cell(20,5,$info['slips'][$l+$countter]['Date2'],1,0,'C',1);

                        $pdf->SetFont('Arial','',8);
                        $pdf->SetXY(120.1,55.2+ $Y);
                        $pdf->Cell(20,5,$info['slips'][$l+$countter]['Day'],1,0,'C',1);

                        $pdf->SetFont('Arial','',8);
                        $pdf->SetXY(140,55.2+ $Y);
                        $pdf->Cell(20,5, $info['slips'][$l+$countter]['TIME'],1,0,'C',1);


                    }
                }

            }
            else
            {
                // DebugBreak();

                $Y = 18+ $Y;
            }

            // INSTRUCTION PICTURE 
            $pdf->SetXY(40.2,21.2);
            $pdf->Image("assets/img/Note.jpg",165.0,50.1, 40.65,$noteimageheight, "JPG");  

            // PRACTICAL BOX
            $tprcount = $countter+$countter9;
            $prcount = 0;
            $pathtml = '';
            $partsubhtml = '';
            if(@$info['slips'][$tprcount]['prcount'] > 0)
            {

                $ispratical =1;
                $boxWidth = 195.0;
                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(10.2,65.2+ $Y);
                $pdf->SetFillColor(240,240,240);
                $pdf->Cell($boxWidth,5,'PRACTICAL = PART - II',1,0,'C',1);
                $pdf->SetFillColor(255,255,255);
                $Y = $Y + 15;
                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(10.2,55.2+ $Y);
                $pdf->Cell(8,5,'Sr#',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(18.2,55.2+ $Y);
                $pdf->Cell(54,5,'Subject(S)',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(72.2,55.2+ $Y);
                $pdf->Cell(94,5,'Laboratory',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(166.2,55.2+ $Y);
                $pdf->Cell(15,5,'Date',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(181.3,55.2+ $Y);
                $pdf->Cell(14,5,'Time',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(195.1,55.2+ $Y);
                $pdf->Cell(10,5,'Batch',1,0,'C',1);
                $isthird = 0;
                $pdf->SetWidths(array(8,54,94,15,14,10));
                $pdf->SetFont('Arial','',7);
                for($l = 0; $l<$info['slips'][$tprcount]['prcount']; $l++) 
                { 
                    $prcount++;
                    if($l ==0)
                    {
                        $Y = $Y +5;
                    }
                    else
                    {
                        $lablen = strlen($info['slips'][$l+$tprcount]['lab_Name']);
                        // DebugBreak();
                        if($lablen>63 && $lablen<110)
                        {
                            $Y = $Y + 10.0;
                        }
                        else if($lablen>110)
                        {
                            $Y = $Y + 15.0; 
                            $isthird =1; 
                        }
                        else
                        {
                            $Y = $Y +5;   
                        }

                    }
                    $pdf->SetXY(10.2,55.2+ $Y);
                    $pdf->Row(array($prcount,$info['slips'][$l+$tprcount]['sub_Name'],$info['slips'][$l+$tprcount]['lab_Name'],$info['slips'][$l+$tprcount]['Date2'],$info['slips'][$l+$tprcount]['TIME'],$info['slips'][$l+$tprcount]['batch']));


                }
            }


            if($isthird ==1)
                $Y = $Y+10;
            else 
                $Y = $Y+5;

            if($ispratical == 0)
            {
                $Y = 50+ $Y;  
            }
            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(10.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, "Official Name:", 0.25, "C");

            $pdf->SetFont('Arial','BU',7);
            $pdf->SetXY(30.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, $info['emp_cd'].'-'.$info['emp_name'], 0.25, "C");

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(90.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, "Candidate's Signature: ", 0.25, "C");

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(125.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, "___________________ ", 0.25, "C");

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(165.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, "Printing Date:", 0.25, "C");

            $pdf->SetFont('Arial','U',9);
            $pdf->SetXY(185.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, date('d-m-Y'), 0.25, "C");


            // Roll no. box
            $rnostr = $info['Rno'];
            $rnostr1 = substr($rnostr,0,1);
            $rnostr2 = substr($rnostr,1,1);
            $rnostr3 = substr($rnostr,2,1);
            $rnostr4 = substr($rnostr,3,1);
            $rnostr5 = substr($rnostr,4,1);
            $rnostr6 = substr($rnostr,5,1);
            $boxWidth = 48;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,70+ $Y);

            $pdf->Cell($boxWidth,5,'ROLL NO',1,0,'C',1);
            $pdf->SetFillColor(255,255,255);
            $Y = $Y + 20;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell(8,6,$rnostr1,1,0,'C',1);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(18,55+ $Y);
            $pdf->Cell(8,6,$rnostr2,1,0,'C',1);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(26,55+ $Y);
            $pdf->Cell(8,6,$rnostr3,1,0,'C',1);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell(8,6,$rnostr4,1,0,'C',1);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell(8,6,$rnostr5,1,0,'C',1);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell(8,6,$rnostr6,1,0,'C',1);


            $bubble0ps1 = '0.JPG';
            $bubble0ps2 = '0.JPG';
            $bubble0ps3 = '0.JPG';
            $bubble0ps4 = '0.JPG';
            $bubble0ps5 = '0.JPG';
            $bubble0ps6 = '0.JPG';

            $bubble1ps1 = '1.JPG';
            $bubble1ps2 = '1.JPG';
            $bubble1ps3 = '1.JPG';
            $bubble1ps4 = '1.JPG';
            $bubble1ps5 = '1.JPG';
            $bubble1ps6 = '1.JPG';

            $bubble2ps1 = '2.JPG';
            $bubble2ps2 = '2.JPG';
            $bubble2ps3 = '2.JPG';
            $bubble2ps4 = '2.JPG';
            $bubble2ps5 = '2.JPG';
            $bubble2ps6 = '2.JPG';

            $bubble3ps1 = '3.JPG';
            $bubble3ps2 = '3.JPG';
            $bubble3ps3 = '3.JPG';
            $bubble3ps4 = '3.JPG';
            $bubble3ps5 = '3.JPG';
            $bubble3ps6 = '3.JPG';

            $bubble4ps1 = '4.JPG';
            $bubble4ps2 = '4.JPG';
            $bubble4ps3 = '4.JPG';
            $bubble4ps4 = '4.JPG';
            $bubble4ps5 = '4.JPG';
            $bubble4ps6 = '4.JPG';

            $bubble5ps1 = '5.JPG';
            $bubble5ps2 = '5.JPG';
            $bubble5ps3 = '5.JPG';
            $bubble5ps4 = '5.JPG';
            $bubble5ps5 = '5.JPG';
            $bubble5ps6 = '5.JPG';

            $bubble6ps1 = '6.JPG';
            $bubble6ps2 = '6.JPG';
            $bubble6ps3 = '6.JPG';
            $bubble6ps4 = '6.JPG';
            $bubble6ps5 = '6.JPG';
            $bubble6ps6 = '6.JPG';

            $bubble7ps1 = '7.JPG';
            $bubble7ps2 = '7.JPG';
            $bubble7ps3 = '7.JPG';
            $bubble7ps4 = '7.JPG';
            $bubble7ps5 = '7.JPG';
            $bubble7ps6 = '7.JPG';

            $bubble8ps1 = '8.JPG';
            $bubble8ps2 = '8.JPG';
            $bubble8ps3 = '8.JPG';
            $bubble8ps4 = '8.JPG';
            $bubble8ps5 = '8.JPG';
            $bubble8ps6 = '8.JPG';

            $bubble9ps1 = '9.JPG';
            $bubble9ps2 = '9.JPG';
            $bubble9ps3 = '9.JPG';
            $bubble9ps4 = '9.JPG';
            $bubble9ps5 = '9.JPG';
            $bubble9ps6 = '9.JPG';

            //region for 0 bubbling 
            if($rnostr1 == 0) {
                $bubble0ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 0)
            {
                $bubble0ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 0)
            {
                $bubble0ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 0)
            {
                $bubble0ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 0)
            {
                $bubble0ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 0)
            {
                $bubble0ps6 = 'bubble.JPG';
            }
            //endregion 

            // for 1 bubbling
            if($rnostr1 == 1) {
                $bubble1ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 1)
            {
                $bubble1ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 1)
            {
                $bubble1ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 1)
            {
                $bubble1ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 1)
            {
                $bubble1ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 1)
            {
                $bubble1ps6 = 'bubble.JPG';
            }
            // end bubbling 1 

            // for 2 bubbling
            if($rnostr1 == 2) {
                $bubble2ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 2)
            {
                $bubble2ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 2)
            {
                $bubble2ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 2)
            {
                $bubble2ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 2)
            {
                $bubble2ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 2)
            {
                $bubble2ps6 = 'bubble.JPG';
            }
            // end bubbling 2 

            // for 3 bubbling
            if($rnostr1 == 3) {
                $bubble3ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 3)
            {
                $bubble3ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 3)
            {
                $bubble3ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 3)
            {
                $bubble3ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 3)
            {
                $bubble3ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 3)
            {
                $bubble3ps6 = 'bubble.JPG';
            }
            // end bubbling 3 


            // for 4 bubbling
            if($rnostr1 == 4) {
                $bubble4ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 4)
            {
                $bubble4ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 4)
            {
                $bubble4ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 4)
            {
                $bubble4ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 4)
            {
                $bubble4ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 4)
            {
                $bubble4ps6 = 'bubble.JPG';
            }
            // end bubbling 4 

            // for 5 bubbling
            if($rnostr1 == 5) {
                $bubble5ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 5)
            {
                $bubble5ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 5)
            {
                $bubble5ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 5)
            {
                $bubble5ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 5)
            {
                $bubble5ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 5)
            {
                $bubble5ps6 = 'bubble.JPG';
            }
            // end bubbling 5 

            // for 6 bubbling
            if($rnostr1 == 6) {
                $bubble6ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 6)
            {
                $bubble6ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 6)
            {
                $bubble6ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 6)
            {
                $bubble6ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 6)
            {
                $bubble6ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 6)
            {
                $bubble6ps6 = 'bubble.JPG';
            }
            // end bubbling 6 


            // for 7 bubbling
            if($rnostr1 == 7) {
                $bubble7ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 7)
            {
                $bubble7ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 7)
            {
                $bubble7ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 7)
            {
                $bubble7ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 7)
            {
                $bubble7ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 7)
            {
                $bubble7ps6 = 'bubble.JPG';
            }
            // end bubbling 7 

            // for 8 bubbling
            if($rnostr1 == 8) {
                $bubble8ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 8)
            {
                $bubble8ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 8)
            {
                $bubble8ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 8)
            {
                $bubble8ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 8)
            {
                $bubble8ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 8)
            {
                $bubble8ps6 = 'bubble.JPG';
            }
            // end bubbling 8 

            // for 9 bubbling
            if($rnostr1 == 9) {
                $bubble9ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 9)
            {
                $bubble9ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 9)
            {
                $bubble9ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 9)
            {
                $bubble9ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 9)
            {
                $bubble9ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 9)
            {
                $bubble9ps6 = 'bubble.JPG';
            }

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );


            $pdf->Image("assets/img/256.JPG",60.0, $Y-12, 147.65,72.65, "JPG");  

            $pdf->Image("assets/img/headsign.jpg",10.0,258, 72,24, "JPG");  
          //  $pdf->Image("assets/img/headsign.jpg",10.0,267, 82,15, "JPG");  

            $pdf->Image("assets/img/CE_Signature.png",170.0,263, 22,22, "PNG"); 

            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(160,289);
            $pdf->Cell(0, 0.2, "CONTROLLER OF EXAMINATIONS", 0.25, "C");


            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(10,285);
            $pdf->Cell(0, 0.2, "Institute Name :", 0.25, "C");
            $pdf->SetFont('Arial','B',7);
            $pdf->SetXY(32,283.4);
            $pdf->MultiCell(180, 3, $info['inst_cd']."-".$info['inst_name'], 0, "L",0);


            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(10,289.3);
            $pdf->Cell(0, 0.2, "Zone                  :", 0.25, "C");

            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(32,288);
            $pdf->MultiCell(90, 3, $info['Zone_Code']."-".$info['Zone_Name'], 0, "L",0);

            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(80,289);
            $pdf->Cell(0, 0.2, "Teh    :", 0.25, "C");

            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(90,289);
            $pdf->Cell(0, 0.2,$info['teh_name'], 0.25, "C");

            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(120,289);
            $pdf->Cell(0, 0.2, "Distt  :", 0.25, "C");

            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(130,289);
            $pdf->Cell(0, 0.2,$info['dist_name'], 0.25, "C");            
        }
        else
        {
            $message = 'Slip is not issued due to '.$info['errmessage'];
            $pdf->SetFont('Arial','B',16);
            $pdf->SetXY(40,60);
            $pdf->SetTextColor(255 ,0,0);
            $pdf->Cell(0, 0.2,$message, 0.25, "C");   
        }

    }
    
    private function makepdf22($pdf,$info)
    {
        if($info['Session'] ==1) $Session= 'ANNUAL'; else $Session='SUPPLY';
        if($info['errmessage'] == null) $errmessage = '(PROVISIONALLY)'; else{ $errmessage = ' (PROVISIONALLY OBJECTION SLIP)';};
        
        if($info['grp_cd'] == 1)  $grp_cd = 'SCIENCE'; else if($info['grp_cd'] == 2) $grp_cd='GENERAL';
        if($info['Gender']==1) $Gender= 'MALE'; else if($info['Gender']==2) $Gender= 'FEMALE';
         //$filepath = base_url().'assets/'.$info['picpath'];
         $filepath = 'assets/img/no_image.png';
        
       $html = '<table width="100%">
        <tr>
        <td width="10%"> <img src="assets/img/icon2.png" alt="" style="width:130px; height:80px" ></td>
        <td width="95%" align="left" >  
        <table>
            <tr>
                <td align="left" colspan="2"><label style="font-size: 12px;"><b>BOARD OF INTERMEDIATE & SECONDARY EDUCATION, GUJRANWALA</b></label> </td>
            </tr>
            <tr>
                <td width="6%"></td>
                <td style="line-height: 7px;font-size: 9px;" align="left" width="94%">ROLL NUMBER SLIP (WITH DATE SHEET) FOR S.S.C '.$Session.' EXAMINATION, '.$info["Year"].'   </td>
            </tr>
            <tr>
                <td width="30%"></td>
                <td style="line-height: 11px;font-size: 9px; font-weight: bold;" width="70%" align="left"> '.$errmessage.'</td>
            </tr>
        </table>
        </td>

        </tr>
        <tr><td colspan="2" style="line-height: -4px;"></td></tr>
       </table>';
         $pdf->writeHTML($html, true, false, true, false, ''); 
          $pdf->SetXY(4, 18);           
         $html='<table width="100%"  cellpadding="1" cellspacing="0">
            <tr>
            <td  width="60%">
                <table width="100%">
                    <tr>
                        <td width="20%"><label ><strong style="font-size: 9px;">ROLL NO </strong></label></td>
                        <td width="1%" style="line-height: 15px;"><label style="font-size: 11px;">:</label></td>
                        <td   width="16%" style="border: 1px solid black;line-height: 15px;" align="center"><strong style="font-size: 11px;"> '.$info['Rno'].'</strong></td>
                        <td width="63%"></td>
                    </tr>
                    <tr>
                        <td width="20%"><label >NAME</label></td>
                        <td width="80%" colspan="3"><label style="font-size: 11px;" >: '.$info['Name'].'</label></td>

                    </tr>
                    <tr>
                        <td width="20%"><label >FATHER\'s NAME</label></td>
                        <td width="80%" colspan="2"><label style="font-size: 11px;">: '.$info['FathersName'].'</label></td>

                    </tr>
                    <tr>
                        <td width="20%"><label >DATE OF BIRTH </label></td>
                        <td width="80%" colspan="2"><label style="font-size: 11px;">:  '.$info['DOB'].'</label></td>
                    </tr>
                    <tr>
                        <td width="20%" style="line-height: 10px;" ><label><strong style="font-size: 9px;">CENTER</strong></label></td>
                        <td width="80%" style="line-height: 10px;" colspan="2"><label><strong style="font-size: 9px;">: '.$info['cent_cd'].'-'.$info['Cent_Name']. '</strong></label></td>
                    </tr>
                </table>
            </td>
            <td width="40%">
                <table width="100%">
                    <tr>
                        <td align="left" width="60%" style=" " > 
                            <table>
                                <tr>
                                    <td colspan="3"> <img align="middle" alt="" src="assets/pdfs/'.$info['barcode'].'" style="width:200px;height: 20px;" /></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="3"><b style="font-size: 10px;">'.$grp_cd.'</b></td>
                                </tr>
                                <tr>
                                    <td colspan="3"> </td>
                                </tr>

                                <tr>
                                    <td width="15%"></td>
                                    <td  align="center" width="70%"><p style="border: 1px solid black; line-height: 13px;font-size: 10px;" > SCHEME=1100</p></td>
                                    <td width="15%"></td>

                                </tr>
                            </table>
                        </td> 
                        <td  align="right" width="40%" >
                            <table>
                                <tr>
                                    <td  align="center" style="font-weight: bold">FormNo:'.$info['formno'].'</td>
                                </tr>

                                <tr>
                                  <td  align="center" > <img alt="" src="'.$filepath.'"  style="width:200px;"></td>
                                </tr>
                                <tr>
                                    <td align="center" style="font-weight: bold">'.$Gender.'</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
            </tr>
            </table>';
          $pdf->writeHTML($html, true, false, true, false, ''); 
          //$pdf->SetMargins(10, 20, 10, true);
          //$pdf->SetMargins(4, -6, 4, true);
          $pdf->SetXY(4, 56);
          if($info['errmessage'] == null) 
          {
               $countter = 0;
               $part2sub = '';
               $part2html = '';
               if(@$info['slips'][0]['subp2count']>0) {
                        for($k = 0; $k<$info['slips'][0]['subp2count']; $k++) { 
                        if($info['slips'][$k]['class'] == 10) {
                            $countter++;
                           $part2sub.='<tr>
                                <td align="center">'.$countter.'</td>
                                <td>  '.$info['slips'][$k]['sub_Name'].'</td>
                                <td  align="center" >'. $info['slips'][$k]['Date2'].'</td>
                                <td align="center">'.$info['slips'][$k]['Day'].'</td>
                                <td align="center" >'. $info['slips'][$k]['TIME'].'</td>
                            </tr>';
                           } 
                        }
                       $part2html= '<tr>
                            <td>
                                <table   border="1"  cellpadding="1" cellspacing="0" width="100%"  >
                                    <tr style="background-color: #D0D0D0 ;">
                                        <td align="center" colspan="5" >
                                            <label Style="text-align:center; font-weight: bold;">THEORY = PART - II </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="5%" align="center" ><b>Sr#</b></td>
                                        <td width="60%" align="center"><b>SUBJECT(s)</b> </td>
                                        <td align="center" width="12%"><b>DATE</b></td>
                                        <td width="13%" align="center"><b>DAY</b></td>
                                        <td  align="center" width="10%"><b>TIME</b></td>
                                    </tr>

                                    '.$part2sub.'

                                </table>
                            </td>
                        </tr>';
                    }
           $countter9 = 0;
             $part1sub = '';
               $part1html = '';
                    if(@$info['slips'][$countter]['subp1count'] > 0)
                    {
                    for($l = 0; $l<$info['slips'][$countter]['subp1count']; $l++) { 

                        if($info['slips'][$l+$countter]['class'] == 9) {
                            $countter9++;
                           $part1sub.='<tr>
                                <td align="center" >'.$countter9.'</td>
                                <td >  '.$info['slips'][$l+$countter]['sub_Name'].'</td>
                                <td align="center">'.$info['slips'][$l+$countter]['Date2'].'</td>
                                <td align="center">'.$info['slips'][$l+$countter]['Day'].'</td>
                                <td align="center">'. $info['slips'][$l+$countter]['TIME'].'</td>
                            </tr>';
                            } 
                    }                        
                        
                       $part1html='<tr>
                            <td>
                                <table   border="1" width="100%"  >
                                    <tr class="noBorder" height="2px" style="background-color:#D0D0D0;">
                                        <td align="center" colspan="5" ><label Style="text-align:center; font-weight: bold;">THEORY = PART - I </label></td>
                                    </tr>
                                    <tr>
                                        <td width="5%" align="center" ><b>Sr#</b></td>
                                        <td width="60%" align="center"><b>SUBJECT(s)</b> </td>
                                        <td align="center" width="12%"><b>DATE</b></td>
                                        <td width="13%" align="center"><b>DAY</b></td>
                                        <td  align="center" width="10%"><b>TIME</b></td>
                                    </tr>
                                   '.$part1sub.'
                                </table>
                            </td>
                        </tr>';
             
                    }
              
           $html='<table  width="100%" cellpadding="1" cellspacing="0" >
                    <tr>
                        <td width="77%">
                            <table>
                            '.$part2html.'
                            <tr><td style="line-height: 5px;"></td></tr>
                            '.$part1html.'
                            </table>
                        </td>
                        <td width="1%"></td>
                        <td width="22%">
                        <img src="assets/img/Note.jpg"  style="width:200px;height:360px;" >
                        </td>
                    </tr>
                    <tr><td colspan="3" style="line-height: 3px;"></td></tr>
                </table>';
             
             $pdf->writeHTML($html, true, false, true, false, '');  
         
    $tprcount = $countter+$countter9;
    $prcount = 0;
    $pathtml = '';
    $partsubhtml = '';
    if(@$info['slips'][$tprcount]['prcount'] > 0)
    {
        
        
         for($l = 0; $l<$info['slips'][$tprcount]['prcount']; $l++) 
            { 
                $prcount++;
                $partsubhtml.='<tr >
                    <td align="center" >'.$prcount.'</td>
                    <td>  '.$info['slips'][$l+$tprcount]['sub_Name'].'</td>
                    <td>'. $info['slips'][$l+$tprcount]['lab_Name'].'</td>
                    <td align="center">'. $info['slips'][$l+$tprcount]['Date2'].'</td>
                    <td align="center">'.$info['slips'][$l+$tprcount]['TIME'].'</td>
                    <td align="center">'.$info['slips'][$l+$tprcount]['batch'].'</td>
                </tr>';
          }       
        
        
       $pathtml ='<table   border="1"   width="100%"  >
            <tr style="background-color: #D0D0D0 ;">
                <td align="center" colspan="6" ><label Style="text-align:center; font-weight: bold;">PRACTICAL = PART - II </label> </td>
            </tr>
            <tr>
                <td width="4%" align="center"><b>Sr#</b></td>
                <td width="26%" align="center"><b>Subject(s)</b></td>
                <td width="48%" align="center"><b>Laboratory</b></td>
                <td width="9%" align="center"><b>Date</b></td>
                <td width="7%" align="center"><b>Time</b></td>
                <td width="6%" align="center"><b>Batch</b></td>
            </tr>
        '.$partsubhtml.'
        </table>';
        }
         $pdf->SetXY(4, 138);   
         $pdf->writeHTML($pathtml, true, false, true, false, '');  
         
        $html= '<table width="100%" >
        <tr><td></td><td></td></tr>
        <tr>
            <td width="47%" align="left">
                Official Name: <b><u>'. $info['emp_cd'].'-'.$info['emp_name'].'</u></b>
            </td>
            <td width="35%" align="center">
                Candidate\'s Signature: ______________________
            </td>  
            <td width="18%" align="right">
                Printing Date: <u>'. date('d-m-Y').'</u>
            </td>              
        </tr>
    </table>';
         $pdf->writeHTML($html, true, false, true, false, ''); 
         
         $rnostr = $info['Rno'];
         $rnostr1 = substr($rnostr,0,1);
         $rnostr2 = substr($rnostr,1,1);
         $rnostr3 = substr($rnostr,2,1);
         $rnostr4 = substr($rnostr,3,1);
         $rnostr5 = substr($rnostr,4,1);
         $rnostr6 = substr($rnostr,5,1);

         $bubble0ps1 = '0.JPG';
         $bubble0ps2 = '0.JPG';
         $bubble0ps3 = '0.JPG';
         $bubble0ps4 = '0.JPG';
         $bubble0ps5 = '0.JPG';
         $bubble0ps6 = '0.JPG';

         $bubble1ps1 = '1.JPG';
         $bubble1ps2 = '1.JPG';
         $bubble1ps3 = '1.JPG';
         $bubble1ps4 = '1.JPG';
         $bubble1ps5 = '1.JPG';
         $bubble1ps6 = '1.JPG';

         $bubble2ps1 = '2.JPG';
         $bubble2ps2 = '2.JPG';
         $bubble2ps3 = '2.JPG';
         $bubble2ps4 = '2.JPG';
         $bubble2ps5 = '2.JPG';
         $bubble2ps6 = '2.JPG';

         $bubble3ps1 = '3.JPG';
         $bubble3ps2 = '3.JPG';
         $bubble3ps3 = '3.JPG';
         $bubble3ps4 = '3.JPG';
         $bubble3ps5 = '3.JPG';
         $bubble3ps6 = '3.JPG';

         $bubble4ps1 = '4.JPG';
         $bubble4ps2 = '4.JPG';
         $bubble4ps3 = '4.JPG';
         $bubble4ps4 = '4.JPG';
         $bubble4ps5 = '4.JPG';
         $bubble4ps6 = '4.JPG';

         $bubble5ps1 = '5.JPG';
         $bubble5ps2 = '5.JPG';
         $bubble5ps3 = '5.JPG';
         $bubble5ps4 = '5.JPG';
         $bubble5ps5 = '5.JPG';
         $bubble5ps6 = '5.JPG';

         $bubble6ps1 = '6.JPG';
         $bubble6ps2 = '6.JPG';
         $bubble6ps3 = '6.JPG';
         $bubble6ps4 = '6.JPG';
         $bubble6ps5 = '6.JPG';
         $bubble6ps6 = '6.JPG';

         $bubble7ps1 = '7.JPG';
         $bubble7ps2 = '7.JPG';
         $bubble7ps3 = '7.JPG';
         $bubble7ps4 = '7.JPG';
         $bubble7ps5 = '7.JPG';
         $bubble7ps6 = '7.JPG';

         $bubble8ps1 = '8.JPG';
         $bubble8ps2 = '8.JPG';
         $bubble8ps3 = '8.JPG';
         $bubble8ps4 = '8.JPG';
         $bubble8ps5 = '8.JPG';
         $bubble8ps6 = '8.JPG';

         $bubble9ps1 = '9.JPG';
         $bubble9ps2 = '9.JPG';
         $bubble9ps3 = '9.JPG';
         $bubble9ps4 = '9.JPG';
         $bubble9ps5 = '9.JPG';
         $bubble9ps6 = '9.JPG';

         //region for 0 bubbling 
         if($rnostr1 == 0) {
             $bubble0ps1 = 'bubble.JPG'; 
         }
         if($rnostr2 == 0)
         {
             $bubble0ps2 = 'bubble.JPG';
         }
         if($rnostr3 == 0)
         {
             $bubble0ps3 = 'bubble.JPG';
         }
         if($rnostr4 == 0)
         {
             $bubble0ps4 = 'bubble.JPG';
         }
         if($rnostr5 == 0)
         {
             $bubble0ps5 = 'bubble.JPG';
         }
         if($rnostr6 == 0)
         {
             $bubble0ps6 = 'bubble.JPG';
         }
         //endregion 

         // for 1 bubbling
         if($rnostr1 == 1) {
             $bubble1ps1 = 'bubble.JPG'; 
         }
         if($rnostr2 == 1)
         {
             $bubble1ps2 = 'bubble.JPG';
         }
         if($rnostr3 == 1)
         {
             $bubble1ps3 = 'bubble.JPG';
         }
         if($rnostr4 == 1)
         {
             $bubble1ps4 = 'bubble.JPG';
         }
         if($rnostr5 == 1)
         {
             $bubble1ps5 = 'bubble.JPG';
         }
         if($rnostr6 == 1)
         {
             $bubble1ps6 = 'bubble.JPG';
         }
         // end bubbling 1 

         // for 2 bubbling
         if($rnostr1 == 2) {
             $bubble2ps1 = 'bubble.JPG'; 
         }
         if($rnostr2 == 2)
         {
             $bubble2ps2 = 'bubble.JPG';
         }
         if($rnostr3 == 2)
         {
             $bubble2ps3 = 'bubble.JPG';
         }
         if($rnostr4 == 2)
         {
             $bubble2ps4 = 'bubble.JPG';
         }
         if($rnostr5 == 2)
         {
             $bubble2ps5 = 'bubble.JPG';
         }
         if($rnostr6 == 2)
         {
             $bubble2ps6 = 'bubble.JPG';
         }
         // end bubbling 2 

         // for 3 bubbling
         if($rnostr1 == 3) {
             $bubble3ps1 = 'bubble.JPG'; 
         }
         if($rnostr2 == 3)
         {
             $bubble3ps2 = 'bubble.JPG';
         }
         if($rnostr3 == 3)
         {
             $bubble3ps3 = 'bubble.JPG';
         }
         if($rnostr4 == 3)
         {
             $bubble3ps4 = 'bubble.JPG';
         }
         if($rnostr5 == 3)
         {
             $bubble3ps5 = 'bubble.JPG';
         }
         if($rnostr6 == 3)
         {
             $bubble3ps6 = 'bubble.JPG';
         }
         // end bubbling 3 


         // for 4 bubbling
         if($rnostr1 == 4) {
             $bubble4ps1 = 'bubble.JPG'; 
         }
         if($rnostr2 == 4)
         {
             $bubble4ps2 = 'bubble.JPG';
         }
         if($rnostr3 == 4)
         {
             $bubble4ps3 = 'bubble.JPG';
         }
         if($rnostr4 == 4)
         {
             $bubble4ps4 = 'bubble.JPG';
         }
         if($rnostr5 == 4)
         {
             $bubble4ps5 = 'bubble.JPG';
         }
         if($rnostr6 == 4)
         {
             $bubble4ps6 = 'bubble.JPG';
         }
         // end bubbling 4 

         // for 5 bubbling
         if($rnostr1 == 5) {
             $bubble5ps1 = 'bubble.JPG'; 
         }
         if($rnostr2 == 5)
         {
             $bubble5ps2 = 'bubble.JPG';
         }
         if($rnostr3 == 5)
         {
             $bubble5ps3 = 'bubble.JPG';
         }
         if($rnostr4 == 5)
         {
             $bubble5ps4 = 'bubble.JPG';
         }
         if($rnostr5 == 5)
         {
             $bubble5ps5 = 'bubble.JPG';
         }
         if($rnostr6 == 5)
         {
             $bubble5ps6 = 'bubble.JPG';
         }
         // end bubbling 5 

         // for 6 bubbling
         if($rnostr1 == 6) {
             $bubble6ps1 = 'bubble.JPG'; 
         }
         if($rnostr2 == 6)
         {
             $bubble6ps2 = 'bubble.JPG';
         }
         if($rnostr3 == 6)
         {
             $bubble6ps3 = 'bubble.JPG';
         }
         if($rnostr4 == 6)
         {
             $bubble6ps4 = 'bubble.JPG';
         }
         if($rnostr5 == 6)
         {
             $bubble6ps5 = 'bubble.JPG';
         }
         if($rnostr6 == 6)
         {
             $bubble6ps6 = 'bubble.JPG';
         }
         // end bubbling 6 


         // for 7 bubbling
         if($rnostr1 == 7) {
             $bubble7ps1 = 'bubble.JPG'; 
         }
         if($rnostr2 == 7)
         {
             $bubble7ps2 = 'bubble.JPG';
         }
         if($rnostr3 == 7)
         {
             $bubble7ps3 = 'bubble.JPG';
         }
         if($rnostr4 == 7)
         {
             $bubble7ps4 = 'bubble.JPG';
         }
         if($rnostr5 == 7)
         {
             $bubble7ps5 = 'bubble.JPG';
         }
         if($rnostr6 == 7)
         {
             $bubble7ps6 = 'bubble.JPG';
         }
         // end bubbling 7 

         // for 8 bubbling
         if($rnostr1 == 8) {
             $bubble8ps1 = 'bubble.JPG'; 
         }
         if($rnostr2 == 8)
         {
             $bubble8ps2 = 'bubble.JPG';
         }
         if($rnostr3 == 8)
         {
             $bubble8ps3 = 'bubble.JPG';
         }
         if($rnostr4 == 8)
         {
             $bubble8ps4 = 'bubble.JPG';
         }
         if($rnostr5 == 8)
         {
             $bubble8ps5 = 'bubble.JPG';
         }
         if($rnostr6 == 8)
         {
             $bubble8ps6 = 'bubble.JPG';
         }
         // end bubbling 8 

         // for 9 bubbling
         if($rnostr1 == 9) {
             $bubble9ps1 = 'bubble.JPG'; 
         }
         if($rnostr2 == 9)
         {
             $bubble9ps2 = 'bubble.JPG';
         }
         if($rnostr3 == 9)
         {
             $bubble9ps3 = 'bubble.JPG';
         }
         if($rnostr4 == 9)
         {
             $bubble9ps4 = 'bubble.JPG';
         }
         if($rnostr5 == 9)
         {
             $bubble9ps5 = 'bubble.JPG';
         }
         if($rnostr6 == 9)
         {
             $bubble9ps6 = 'bubble.JPG';
         }
            $html='<table width="100%"  >
        <tr>
            <td width="20%">
                <table border="1" >
                    <tr>
                        <td colspan="6" align="center" style="line-height: 15px;font-size: 12px;"><b>ROLL NO</b></td>
                    </tr>
                    <tr>
                        <td align="center" style="line-height: 20px;font-size: 12px;"><b>'.$rnostr1.'</b></td>
                        <td  align="center" style="line-height: 20px;font-size: 12px;"><b>'. $rnostr2.'</b></td>
                        <td align="center" style="line-height: 20px;font-size: 12px;"><b>'. $rnostr3.'</b></td>
                        <td align="center" style="line-height: 20px;font-size: 12px;"><b>'. $rnostr4.'</b></td>
                        <td align="center" style="line-height: 20px;font-size: 12px;"><b>'. $rnostr5.'</b></td>
                        <td align="center" style="line-height: 20px;font-size: 12px;"><b>'. $rnostr6.'</b></td>
                    </tr>
                    <tr class="noBorder">
                        <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/'.$bubble0ps1.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/'. $bubble0ps2.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/'. $bubble0ps3.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/'. $bubble0ps4.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/'. $bubble0ps5.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/'. $bubble0ps6.'" style="width:12px;text-align: center;"/></td>
                    </tr>
                    <tr class="noBorder">
                        <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/'.$bubble1ps1.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/'. $bubble1ps2.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/'. $bubble1ps3.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/'. $bubble1ps4.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/'. $bubble1ps5.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/'. $bubble1ps6.'" style="width:12px;text-align: center;"/></td>
                    </tr>
                    <tr class="noBorder">
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'.$bubble2ps1.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble2ps2.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble2ps3.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble2ps4.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble2ps5.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble2ps6.'" style="width:12px;text-align: center;"/></td>
                    </tr>

                    <tr class="noBorder">
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'.$bubble3ps1.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble3ps2.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble3ps3.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble3ps4.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble3ps5.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble3ps6.'" style="width:12px;text-align: center;"/></td>
                    </tr>

                    <tr class="noBorder">
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'.$bubble4ps1.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble4ps2.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble4ps3.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble4ps4.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble4ps5.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble4ps6.'" style="width:12px;text-align: center;"/></td>
                    </tr>

                    <tr class="noBorder">
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'.$bubble5ps1.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble5ps2.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble5ps3.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble5ps4.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble5ps5.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble5ps6.'" style="width:12px;text-align: center;"/></td>
                    </tr>

                    <tr class="noBorder">
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'.$bubble6ps1.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble6ps2.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble6ps3.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble6ps4.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble6ps5.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble6ps6.'" style="width:12px;text-align: center;"/></td>
                    </tr>

                    <tr class="noBorder">
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'.$bubble7ps1.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble7ps2.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble7ps3.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble7ps4.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble7ps5.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble7ps6.'" style="width:12px;text-align: center;"/></td>
                    </tr>

                    <tr class="noBorder">
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'.$bubble8ps1.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble8ps2.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble8ps3.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble8ps4.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble8ps5.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble8ps6.'" style="width:12px;text-align: center;"/></td>
                    </tr>

                    <tr class="noBorder">
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'.$bubble9ps1.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble9ps2.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble9ps3.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble9ps4.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble9ps5.'" style="width:12px;text-align: center;"/></td>
                        <td align="center" style="line-height: 18px"><img alt="" src="assets/img/'. $bubble9ps6.'" style="width:12px;text-align: center;"/></td>
                    </tr>


                </table>
            </td>
            <td width="80%" align="right">
                <img alt="" src="assets/img/256.JPG" style="width:500px;height:245px;   text-align: right;" />
            </td>
        </tr>
    </table>';
   $pdf->writeHTML($html, true, false, true, false, ''); 
   $pdf->SetXY(4, 250);
    $html= '<table>
        <tr>
            <td width="72%">
                <table style="width:100%; height: 1%;"  cellpadding="0" cellspacing="0">

                    <tr>
                        <td width="100%" colspan="6"><img src="assets/img/headsign.jpg" style="height: 60px;width:200px" alt=""></td>
                    </tr>
                    <tr>
                        <td width="16%"><label style="font-size: 8px; font-weight: bold;">Institute Name</label></td>
                        <td width="84%" colspan="5"><label style="font-size: 8px; font-weight: bold;">:'. $info['inst_cd']."-".$info['inst_name'].'</label></td>
                    </tr>

                    <tr>
                        <td width="15%"><label >Zone</label></td>
                        <td width="25%"><label>  :'. $info['Zone_Code']."-".$info['Zone_Name'].'</label></td>
                        <td width="5%"><label >Teh</label></td>
                        <td width="20%"><label>:'. $info['teh_name'].'</label></td>
                        <td width="5%"><label >Distt</label></td>
                        <td width="30%"><label>:'. $info['dist_name'].'</label></td>
                    </tr>
                </table>
            </td>
            <td width="27%" align="center">
                <table>
                    <tr>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center"> <img src="assets/img/CE_Signature.png" style="height: 70px;" alt=""></td>
                    </tr>
                    <tr> <td align="center">CONTROLLER OF EXAMINATIONS</td></tr>
                </table>
            </td>
        </tr>
    </table>';
         
      $pdf->writeHTML($html, true, false, true, false, '');    
         
         
    }
          else
          {
            $html='<table>
                <tr>
                <td align="center" style="font-size: 22px; font-weight: bold;color:red"> Slip is not issued due to '.$info['errmessage'].'</td>
                </tr>
            </table>';
            $pdf->writeHTML($html, true, false, true, false, ''); 
          }
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
        //DebugBreak()  ;
        $this->load->helper('url');
        //Load the library
        //   $this->load->library('html2pdf');

        $rno = $this->uri->segment(3);
        $sess=1;
        $class =9;
        $year=2016;

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];

        $Inst_Id = $user['Inst_Id'];
        //DebugBreak();
        $this->load->model('RollNoSlip_model');
        $studeninfo = array('data'=>$this->RollNoSlip_model->get9thrslip($rno,$class,$year,$sess));
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
         $pdf->SetAuthor('BiseGrw');
     $pdf->SetMargins(4, 6, 4, true);
        $pdf->AddPage();
       
        //DebugBreak();
        $html = $this->load->view('RollNoSlip/NinthRollNo', $studeninfo['data']['info'][0], true);   
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
    public function NinthRollNoGroupwise()
    {
        // DebugBreak()  ;
        $this->load->helper('url');
        //Load the library
        $this->load->library('html2pdf');

        $grp_cd = $this->uri->segment(3);
        $sess=1;
        $class =9;
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
        $studeninfo = array('data'=>$this->RollNoSlip_model->get9thrslipWith_Grp_CD($class,$year,$sess,$grp_cd,$Inst_Id));


        $template_pdf = '';
        $totalslips = count($studeninfo['data']['slip']);
        $studentslip  = array();


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
            $html = $this->load->view('RollNoSlip/NinthRollNo', $studeninfo['data']['info'][$i], true);   
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