<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BiseCorrection extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
      
        $this->load->library('session');
        if( !$this->session->userdata('logged_in') && $this->router->method != 'login' ) {
            redirect('biselogin');
        }
    }
    public function slips9thcorrections()
    {
        $this->load->helper('url');
        $data = array(
            'isselected' => '0',
        );
        $this->load->library('session');
        $this->load->model('BiseCorrections_model');
        $NinthStdData = array('data'=>$this->BiseCorrections_model->get9thObjectionStdData());
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('BiseCorrection/slips9thcorrections.php',$NinthStdData);
        $this->load->view('common/footer.php');
    }

    public function slip9thactive()
    {
         $rno = $this->uri->segment(3);
         $this->load->model('BiseCorrections_model');
         $Logged_In_Array = $this->session->all_userdata();
         $userinfo = $Logged_In_Array['logged_in'];
         $NinthStdData = array('data'=>$this->BiseCorrections_model->updateslipData($rno,$userinfo['Inst_Id']));
         redirect('index.php/BiseCorrection/slips9thcorrections');
    }
   
   
   
}

/* End of file example.php */
/* Location: ./application/controllers/example.php */