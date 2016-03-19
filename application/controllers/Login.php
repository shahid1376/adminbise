<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

/**
* Index Page for this controller.
*
* Maps to the following URL
* 		http://example.com/index.php/welcome
*	- or -
* 		http://example.com/index.php/welcome/index
*	- or -
* Since this controller is set as the default controller in
* config/routes.php, it's displayed at http://example.com/
*
* So any other public methods not prefixed with an underscore will
* map to /index.php/welcome/<method_name>
* @see http://codeigniter.com/user_guide/general/urls.html
*/
public function index()
{
    $this->load->helper('url');
    $data = array(
        'user_status' => ''                     

    );


    if(@$_POST['username'] != '' && @$_POST['password'] != '')
    {   
        $blockinst[] = 362014;
        for($i = 0; $i<count($blockinst); $i++)
        {
            if($blockinst[$i] == $_POST['username'])
            {
                $data = array(
                    'user_status' => 4                     
                );
                $this->load->view('login/login.php',$data); 
                return false; 
            }

        }
       // DebugBreak();
        $this->load->model('login_model'); 
        $logedIn = $this->login_model->auth($_POST['username'],$_POST['password']);

        if($logedIn != false)
        {  
            if($logedIn['edu_lvl'] == 2)
            {
                $data = array(
                    'user_status' => 1                     
                );
                $this->load->view('login/login.php',$data);
            }
            else if($logedIn['IsActive'] == 0)
            {
                $data = array(
                    'user_status' => 3                     
                );
                $this->load->view('login/login.php',$data);
            }
            else
            {
                $deafinst[] = 111285;
                $deafinst[] = 161208;
                $deafinst[] = 162283;
                $deafinst[] = 111285;
                $deafinst[] = 112384;
                $deafinst[] = 121271;
                $deafinst[] = 161208;
                $deafinst[] = 162283;
                $deafinst[] = 311025;
                $this->load->model('RollNoSlip_model');
                $isdeaf = 0;
                if(!in_array($_POST['username'],$deafinst))
                {
                    $tenthstd = $this->RollNoSlip_model->get10thStdData($_POST['username']);
                    $ninththstd = $this->RollNoSlip_model->get9thStdData($_POST['username']);
                    $isdeaf = 0;
                }
                else
                {
                    $tenthstd = $this->RollNoSlip_model->get10thStdDataDeaf($_POST['username']);
                     $ninththstd = $this->RollNoSlip_model->get9thStdDataDeaf($_POST['username']);
                    $isdeaf= 1;
                }

                if($tenthstd == 0 && $ninththstd == 0)
                {
                    $data = array(
                        'user_status' => 6                     
                    );
                    $this->load->view('login/login.php',$data);

                }
                else{
                    $sess_array = array(
                        'Inst_Id' => $logedIn['Inst_cd'] ,
                        'edu_lvl' => $logedIn['edu_lvl'],
                        'inst_Name' => $logedIn['Name'],
                        'gender' => $logedIn['Gender'],
                        'isrural' => $logedIn['IsRural'],
                        'isdeaf' => $isdeaf,
                        'isboardoperator' => 0
                    );
                    $this->load->library('session');
                    $this->session->set_userdata('logged_in', $sess_array); 
                    redirect('index.php/Registration/','refresh');
                   // if(count($ninththstd)>0)
//                        redirect('index.php/RollNoSlip/NinthStd', 'refresh'); 
//                    else if(count($tenthstd)>0)
//                        redirect('index.php/RollNoSlip/TenthStd', 'refresh'); 
                }

            }




        }
        else
        {  
            $data = array(
                'user_status' => 1                     
            );
            $this->load->view('login/login.php',$data);

        }
    }
    else
    {
        $this->load->view('login/login.php',$data);
    }

}
public function biselogin()
{
    $this->load->helper('url');
    $data = array(
        'user_status' => ''                     

    );
    if(@$_POST['username'] != '' && @$_POST['password'] != '')
    {   
        $this->load->model('login_model'); 
        $logedIn = $this->login_model->biseauth($_POST['username'],$_POST['password']);
        if($logedIn != false)
        {  
            $sess_array = array(
                'Inst_Id' => $logedIn['inst_cd'] ,
                'edu_lvl' => $logedIn['edu_lvl'],
                'inst_Name' => $logedIn['inst_name'],
                'isdeaf' => 0,
                'isboardoperator' => 1,
            );
            $this->load->library('session');
            $this->session->set_userdata('logged_in', $sess_array); 
             redirect('index.php/BiseCorrection/slips9thcorrections', 'refresh'); 
        }
        else
        {  
            $data = array(
                'user_status' => 1                     
            );
            $this->load->view('login/biselogin.php',$data);

        }
    }
    else
    {
        $this->load->view('login/biselogin.php',$data);
    }

}

function logout()
{
    $this->load->helper('url');
    $newdata = array(
        'Inst_Id'  =>'',
        'edu_lvl' => '',
        'inst_Name' => FALSE,
    );
    $this->load->library('session');
    $this->session->unset_userdata($newdata);
    $this->session->sess_destroy();
    redirect('index.php/login','refresh');
    // redirect('/index.php/index');

    //$this->redirect('login','refresh');
}

}
/*'Inst_Id' => $logedIn->Inst_cd,
'edu_lvl' => $logedIn->edu_lvl,
'Name' => $logedIn->name,*/