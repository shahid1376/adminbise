<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {
    /**
    * Index Page for this controller.
    *
    * Maps to the following URL
    *         http://example.com/index.php/welcome
    *    - or -
    *         http://example.com/index.php/welcome/index
    *    - or -
    * Since this controller is set as the default controller in
    * config/routes.php, it's displayed at http://example.com/
    *
    * So any other public methods not prefixed with an underscore will
    * map to /index.php/welcome/<method_name>
    * @see http://codeigniter.com/user_guide/general/urls.html
    */
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');   
    }
    public function index()
    {
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$userinfo);
        $this->load->view('Registration/Registration.php');
        $this->load->view('common/footer.php');
    }

    public function NewEnrolment_insert()
    {


        $this->load->model('Registration_model');
        //DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->commonheader($userinfo);
        $error = array();

        // $this->Registration_model->Insert_NewEnorlement($data);    
        $formno = $this->Registration_model->GetFormNo($Inst_Id);//, $fname);//$_POST['username'],$_POST['password']);

        // $return_to_view = $this->load->view('Registration/9th/NewEnrolment.php',$error);
        //$this->load->library('upload', $config);
        // DebugBreak();
        // $myupload = $_FILES['image']['name'];
        //$this->form_validation->set_rules('name', 'Name', 'trim|required');
        // $this->form_validation->set_rules('code', 'Code', 'trim|required');
        $target_path = './assets/uploads/'.$Inst_Id.'/';
        if (!file_exists($target_path)){
            mkdir($target_path, 0777, true);
        }
        $config['upload_path']   = $target_path;
        $config['allowed_types'] = 'jpg|png';
        $config['max_size']      = '20';
        $config['max_width']     = '260';
        $config['max_height']    = '290';
        $config['file_name']     = $formno;
        //$config['new_image']    = $formno.'.JPEG';

        $this->load->library('upload', $config);

        //  DebugBreak();
        if(isset($_FILES['image'])) {
            if ( !$this->upload->do_upload('image',FALSE))
            {
                //  $this->form_validation->set_message('checkdoc', $data['error'] = $this->upload->display_errors());
                if($_FILES['image']['error'] != 4)
                {
                    $error['excep']= 'Please Upload Your Picture with Proper Format';
                    $this->load->view('Registration/9th/NewEnrolment.php',$error);
                    return;
                }

            }
        }
        else
        {

            $data['excep']= 'Please Upload Your Picture';
            $this->load->view('Registration/9th/NewEnrolment.php',$data);
            return;
        }
        // DebugBreak();
        //  $this->upload->do_upload($myupload);
        // if ( ! $this->upload->do_upload())
        //        {
        //            //$error = array('error' => $this->upload->display_errors());
        //
        //            $error['excep'][0] = 'Please Enter Your Picture';
        //            $this->load->view('Registration/9th/NewEnrolment.php',$error);
        //           // $this->load->view('upload_form', $error);
        //        }
        //        else
        //        {
        //            $data = array('upload_data' => $this->upload->data());
        //
        //            $this->load->view('upload_success', $data);
        //        }
        //DebugBreak();
        if (!isset($Inst_Id))
        {
            //$error['excep'][1] = 'Please Login!';
            $this->load->view('login/login.php');
        }
        if(@$_POST['cand_name'] == '' )
        {
            $error['excep'] = 'Please Enter Your Name';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if (@$_POST['father_name'] == '')
        {
            $error['excep']= 'Please Enter Your Father Name';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }

        else if(@$_POST['bay_form'] == '' )
        {
            $error['excep'] = 'Please Enter Your Bay Form No.';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if(@$_POST['father_cnic'] == '')
        {
            $error['excep'] = 'Please Enter Your Father CNIC';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if (@$_POST['dob'] == '')
        {
            $error['excep'] = 'Please Enter Your Father Date of Birth';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if(@$_POST['mob_number'] == '')
        {
            $error['excep'] = 'Please Enter Your Mobile Number';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if(@$_POST['medium'] == 0)
        {
            $error['excep'] = 'Please Select Your Medium';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if(@$_POST['Inst_Rno']== '')
        {
            $error['excep'] = 'Please Enter Your Roll Number';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if(@$_POST['MarkOfIden']== '')
        {
            $error['excep'] = 'Please Enter Your Mark of Identification';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }

        /* else if((@$_POST['speciality'] != '0')or (@$_POST['speciality'] != '1') or (@$_POST['speciality'] != '2'))
        {
        $error['excep'] = 'Please Enter Your Speciality';
        $this->load->view('Registration/9th/NewEnrolment.php',$error);
        }*/
        else if((@$_POST['medium'] != '1') and (@$_POST['medium'] != '2') )
        {
            $error['excep'] = 'Please Select Your medium';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if((@$_POST['nationality'] != '1') and (@$_POST['nationality'] != '2') )
        {
            $error['excep'] = 'Please Select Your Nationality';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if((@$_POST['gender'] != '1') and (@$_POST['gender'] != '2'))
        {
            $error['excep'] = 'Please Select Your Gender';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if((@$_POST['hafiz']!= '1') and (@$_POST['hafiz']!= '2'))
        {
            $error['excep'] = 'Please Select Your Hafiz-e-Quran option';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if((@$_POST['religion'] != '1') and (@$_POST['religion'] != '2'))
        {
            $error['excep'] = 'Please Select Your religion'; 
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if((@$_POST['UrbanRural'] != '1') and (@$_POST['UrbanRural'] != '2'))
        {
            $error['excep'] = 'Please Select Your Residency'; 
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if(@$_POST['address'] =='')
        {
            $error['excep'] = 'Please Enter Your Address'; 
            $this->load->view('Registration/9th/NewEnrolment.php',$error);   
            return;
        }
        else if(@$_POST['std_group'] == 0)
        {
            $error['excep'] = 'Please Select Your Study Group';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if(@$_POST['sub1'] == 0)
        {
            $error['excep'] = 'Please Select Subject 1';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if(@$_POST['sub2'] == 0)
        {
            $error['excep'] = 'Please Select Subject 2';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if(@$_POST['sub3'] == 0)
        {
            $error['excep'] = 'Please Select Subject 3';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if(@$_POST['sub4'] == 0)
        {
            $error['excep'] = 'Please Select Subject 3';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if(@$_POST['sub4'] == 0)
        {
            $error['excep'] = 'Please Select Subject 4';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if(@$_POST['sub5'] == 0)
        {
            $error['excep'] = 'Please Select Subject 5';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if(@$_POST['sub6'] == 0)
        {
            $error['excep'] = 'Please Select Subject 6';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if(@$_POST['sub7'] == 0)
        {
            $error['excep'] = 'Please Select Subject 7';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else if(@$_POST['sub8'] == 0)
        {
            $error['excep'] = 'Please Select Subject 8';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            return;
        }
        else

        {

            // $name = 'Waseem Saleem';
            // $fname = 'Muhammad Saleem'; 
            $sub1ap1 = 0;
            $sub2ap1 = 0;
            $sub3ap1 = 0;
            $sub4ap1 = 0;
            $sub5ap1 = 0;
            $sub6ap1 = 0;
            $sub7ap1 = 0;
            $sub8ap1 = 0;
            if(@$_POST['sub1'] != 0)
            {
                $sub1ap1 = 1;    
            }
            if(@$_POST['sub2'] != 0)
            {
                $sub2ap1 = 1;    
            }
            if(@$_POST['sub3'] != 0)
            {
                $sub3ap1 = 1;    
            }
            if(@$_POST['sub4'] != 0)
            {
                $sub4ap1 = 1;    
            }
            if(@$_POST['sub5'] != 0)
            {
                $sub5ap1 = 1;    
            }
            if(@$_POST['sub6'] != 0)
            {
                $sub6ap1 = 1;    
            }
            if(@$_POST['sub7'] != 0)
            {
                $sub7ap1 = 1;    
            }
            if(@$_POST['sub8'] != 0)
            {
                $sub8ap1 = 1;    
            }
            $data = array(
                'name' =>$this->input->post('cand_name'),
                'Fname' =>$this->input->post('father_name'),
                'BForm' =>$this->input->post('bay_form'),
                'FNIC' =>$this->input->post('father_cnic'),
                'Dob' =>$this->input->post('dob'),
                'CellNo' =>$this->input->post('mob_number'),
                'medium' =>$this->input->post('medium'),
                'Inst_Rno' =>$this->input->post('Inst_Rno'),
                'MarkOfIden' =>$this->input->post('MarkOfIden'),
                'Speciality' =>$this->input->post('speciality'),
                'nat' =>$this->input->post('nationality'),
                'sex' =>$this->input->post('gender'),
                'IsHafiz' =>$this->input->post('hafiz'),
                'rel' =>$this->input->post('religion'),
                'addr' =>$this->input->post('address'),
                'grp_cd' =>$this->input->post('std_group'),
                'sub1' =>$this->input->post('sub1'),
                'sub2' =>$this->input->post('sub2'),
                'sub3' =>$this->input->post('sub3'),
                'sub4' =>$this->input->post('sub4'),
                'sub5' =>$this->input->post('sub5'),
                'sub6' =>$this->input->post('sub6'),
                'sub7' =>$this->input->post('sub7'),
                'sub8' =>$this->input->post('sub8'),
                'sub1ap1' => ($sub1ap1),
                'sub2ap1' => ($sub2ap1),
                'sub3ap1' => ($sub3ap1),
                'sub4ap1' => ($sub4ap1),
                'sub5ap1' => ($sub5ap1),
                'sub6ap1' => ($sub6ap1),
                'sub7ap1' => ($sub7ap1),
                'sub8ap1' => ($sub8ap1),
                'UrbanRural' =>$this->input->post('UrbanRural'),
                'Inst_cd' =>($Inst_Id),
                'FormNo' =>($formno)





            );
            $logedIn = $this->Registration_model->Insert_NewEnorlement($data);//, $fname);//$_POST['username'],$_POST['password']);
            if($logedIn != false)
            {  
                //  $sess_array = array(
                //                    'Inst_Id' => $logedIn['Inst_cd'] ,
                //                    'edu_lvl' => $logedIn['edu_lvl'],
                //                    'Name' => $logedIn['Name'],
                //                );
                //                $this->load->library('session');
                //                $this->session->set_userdata('logged_in', $sess_array);      
                //$this->load->model('Admission_model');
                //                $myfuns = $this->Admission_model->sum(5,5);
                //                $this->load->model('Admission_model');
                //                $minus = $this->Admission_model->minus(10,4);
                echo 'Data Saved Successfully !';
                //redirect('dashboard', 'refresh');

                //  $this->load->view('dashboard/dashboard.php');
                // $session_data = $this->session->userdata('logged_in');
            }
            else
            {     
                echo 'Data NOT Saved Successfully !';
                //$this->load->view('Registration/9th/NewEnrolment.php');

            } 
        }

        //$this->load->view('common/header.php');
        // $this->load->view('common/menu.php',$data);
        //$this->load->view('Registration/Registration.php');
        $this->load->view('common/footer.php');
    }
    public function NewEnrolment()
    {    
        //DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '2',
        );
        //  DebugBreak();
        $error = array();
        $error['excep'] = '';
        $error['gender'] = $userinfo['gender'];
        $error['isrural'] = $userinfo['isrural'];
        $this->commonheader($data);
        $this->load->view('Registration/9th/NewEnrolment.php',$error);
        // $this->load->view('common/footer.php');
        $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js")));
        // if(@$_POST['cand_name'] != '' )//&& @$_POST['father_name'] != '' && @$_POST['bay_form'] != '' && @$_POST['father_cnic'] != '' && @$_POST['dob'] != '' && @$_POST['mob_number'] != '') //{   



        //}



    }
    public function NewEnrolment_EditForm($formno)
    {    
        // DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '2',
        );
        $error = array();
        $error['excep'] = '';
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $this->load->model('Registration_model');
        $RegStdData = array('data'=>$this->Registration_model->EditEnrolement_data($formno));
        $this->load->view('common/menu.php',$data);
        $this->load->view('Registration/9th/Edit_Enrolement_form.php',$RegStdData);

        // $this->load->view('common/footer.php');
        $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js")));
        // if(@$_POST['cand_name'] != '' )//&& @$_POST['father_name'] != '' && @$_POST['bay_form'] != '' && @$_POST['father_cnic'] != '' && @$_POST['dob'] != '' && @$_POST['mob_number'] != '') //{   



        //}



    }
    public function NewEnrolment_update()
    {
        //DebugBreak();

        $this->load->model('Registration_model');

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->commonheader($userinfo);
        $error = array();
        //DebugBreak();
        // $this->Registration_model->Insert_NewEnorlement($data);    
        $formno =  $_POST['formNo'];  //$this->Registration_model->GetFormNo($Inst_Id);//, $fname);//$_POST['username'],$_POST['password']);

        // $return_to_view = $this->load->view('Registration/9th/NewEnrolment.php',$error);
        //$this->load->library('upload', $config);
        // DebugBreak();
        // $myupload = $_FILES['image']['name'];
        //$this->form_validation->set_rules('name', 'Name', 'trim|required');
        // $this->form_validation->set_rules('code', 'Code', 'trim|required');
        $target_path = './assets/uploads/'.$Inst_Id.'/';
        if (!file_exists($target_path)){
            mkdir($target_path, 0777, true);
        }
        $config['upload_path']   = $target_path;
        $config['allowed_types'] = 'jpg|png';
         $config['max_size']     = '20';
        $config['max_width']     = '260';
        $config['max_height']    = '290';
        $config['overwrite']     = TRUE;
        $config['file_name']     = $formno;
        //$config['new_image']    = $formno.'.JPEG';

        $this->load->library('upload', $config);

        //  DebugBreak();
        if(isset($_FILES['image'])) {
            if ( !$this->upload->do_upload('image',FALSE))
            {
                //  $this->form_validation->set_message('checkdoc', $data['error'] = $this->upload->display_errors());
                if($_FILES['image']['error'] != 4)
                {
                    $error['excep']= 'Please Upload Your Picture with Proper Format';
                    $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
                    return;
                }

            }
        }
        else
        {

            $data['excep']= 'Please Upload Your Picture';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$data);
            return;
        }
        // DebugBreak();
        //  $this->upload->do_upload($myupload);
        // if ( ! $this->upload->do_upload())
        //        {
        //            //$error = array('error' => $this->upload->display_errors());
        //
        //            $error['excep'][0] = 'Please Enter Your Picture';
        //            $this->load->view('Registration/9th/NewEnrolment.php',$error);
        //           // $this->load->view('upload_form', $error);
        //        }
        //        else
        //        {
        //            $data = array('upload_data' => $this->upload->data());
        //
        //            $this->load->view('upload_success', $data);
        //        }
        //DebugBreak();
        if (!isset($Inst_Id))
        {
            //$error['excep'][1] = 'Please Login!';
            $this->load->view('login/login.php');
        }
        if(@$_POST['cand_name'] == '' )
        {
            $error['excep'] = 'Please Enter Your Name';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if (@$_POST['father_name'] == '')
        {
            $error['excep']= 'Please Enter Your Father Name';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }

        else if(@$_POST['bay_form'] == '' )
        {
            $error['excep'] = 'Please Enter Your Bay Form No.';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if(@$_POST['father_cnic'] == '')
        {
            $error['excep'] = 'Please Enter Your Father CNIC';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if (@$_POST['dob'] == '')
        {
            $error['excep'] = 'Please Enter Your Father Date of Birth';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if(@$_POST['mob_number'] == '')
        {
            $error['excep'] = 'Please Enter Your Mobile Number';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if(@$_POST['medium'] == 0)
        {
            $error['excep'] = 'Please Select Your Medium';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if(@$_POST['Inst_Rno']== '')
        {
            $error['excep'] = 'Please Enter Your Roll Number';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if(@$_POST['MarkOfIden']== '')
        {
            $error['excep'] = 'Please Enter Your Mark of Identification';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }

        /* else if((@$_POST['speciality'] != '0')or (@$_POST['speciality'] != '1') or (@$_POST['speciality'] != '2'))
        {
        $error['excep'] = 'Please Enter Your Speciality';
        $this->load->view('Registration/9th/NewEnrolment.php',$error);
        }*/
        else if((@$_POST['medium'] != '1') and (@$_POST['medium'] != '2') )
        {
            $error['excep'] = 'Please Select Your medium';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if((@$_POST['nationality'] != '1') and (@$_POST['nationality'] != '2') )
        {
            $error['excep'] = 'Please Select Your Nationality';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if((@$_POST['gender'] != '1') and (@$_POST['gender'] != '2'))
        {
            $error['excep'] = 'Please Select Your Gender';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if((@$_POST['hafiz']!= '1') and (@$_POST['hafiz']!= '2'))
        {
            $error['excep'] = 'Please Select Your Hafiz-e-Quran option';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if((@$_POST['religion'] != '1') and (@$_POST['religion'] != '2'))
        {
            $error['excep'] = 'Please Select Your religion'; 
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if((@$_POST['UrbanRural'] != '1') and (@$_POST['UrbanRural'] != '2'))
        {
            $error['excep'] = 'Please Select Your Residency'; 
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if(@$_POST['address'] =='')
        {
            $error['excep'] = 'Please Enter Your Address'; 
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);   
            return;
        }
        else if(@$_POST['std_group'] == 0)
        {
            $error['excep'] = 'Please Select Your Study Group';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if(@$_POST['sub1'] == 0)
        {
            $error['excep'] = 'Please Select Subject 1';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if(@$_POST['sub2'] == 0)
        {
            $error['excep'] = 'Please Select Subject 2';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if(@$_POST['sub3'] == 0)
        {
            $error['excep'] = 'Please Select Subject 3';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if(@$_POST['sub4'] == 0)
        {
            $error['excep'] = 'Please Select Subject 3';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if(@$_POST['sub4'] == 0)
        {
            $error['excep'] = 'Please Select Subject 4';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if(@$_POST['sub5'] == 0)
        {
            $error['excep'] = 'Please Select Subject 5';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if(@$_POST['sub6'] == 0)
        {
            $error['excep'] = 'Please Select Subject 6';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if(@$_POST['sub7'] == 0)
        {
            $error['excep'] = 'Please Select Subject 7';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else if(@$_POST['sub8'] == 0)
        {
            $error['excep'] = 'Please Select Subject 8';
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$error);
            return;
        }
        else

        {

            // $name = 'Waseem Saleem';
            // $fname = 'Muhammad Saleem'; 
            $sub1ap1 = 0;
            $sub2ap1 = 0;
            $sub3ap1 = 0;
            $sub4ap1 = 0;
            $sub5ap1 = 0;
            $sub6ap1 = 0;
            $sub7ap1 = 0;
            $sub8ap1 = 0;
            if(@$_POST['sub1'] != 0)
            {
                $sub1ap1 = 1;    
            }
            if(@$_POST['sub2'] != 0)
            {
                $sub2ap1 = 1;    
            }
            if(@$_POST['sub3'] != 0)
            {
                $sub3ap1 = 1;    
            }
            if(@$_POST['sub4'] != 0)
            {
                $sub4ap1 = 1;    
            }
            if(@$_POST['sub5'] != 0)
            {
                $sub5ap1 = 1;    
            }
            if(@$_POST['sub6'] != 0)
            {
                $sub6ap1 = 1;    
            }
            if(@$_POST['sub7'] != 0)
            {
                $sub7ap1 = 1;    
            }
            if(@$_POST['sub8'] != 0)
            {
                $sub8ap1 = 1;    
            }
            $data = array(
                'name' =>$this->input->post('cand_name'),
                'Fname' =>$this->input->post('father_name'),
                'BForm' =>$this->input->post('bay_form'),
                'FNIC' =>$this->input->post('father_cnic'),
                'Dob' =>$this->input->post('dob'),
                'CellNo' =>$this->input->post('mob_number'),
                'medium' =>$this->input->post('medium'),
                'Inst_Rno' =>$this->input->post('Inst_Rno'),
                'MarkOfIden' =>$this->input->post('MarkOfIden'),
                'Speciality' =>$this->input->post('speciality'),
                'nat' =>$this->input->post('nationality'),
                'sex' =>$this->input->post('gender'),
                'IsHafiz' =>$this->input->post('hafiz'),
                'rel' =>$this->input->post('religion'),
                'addr' =>$this->input->post('address'),
                'grp_cd' =>$this->input->post('std_group'),
                'sub1' =>$this->input->post('sub1'),
                'sub2' =>$this->input->post('sub2'),
                'sub3' =>$this->input->post('sub3'),
                'sub4' =>$this->input->post('sub4'),
                'sub5' =>$this->input->post('sub5'),
                'sub6' =>$this->input->post('sub6'),
                'sub7' =>$this->input->post('sub7'),
                'sub8' =>$this->input->post('sub8'),
                'sub1ap1' => ($sub1ap1),
                'sub2ap1' => ($sub2ap1),
                'sub3ap1' => ($sub3ap1),
                'sub4ap1' => ($sub4ap1),
                'sub5ap1' => ($sub5ap1),
                'sub6ap1' => ($sub6ap1),
                'sub7ap1' => ($sub7ap1),
                'sub8ap1' => ($sub8ap1),
                'UrbanRural' =>$this->input->post('UrbanRural'),
                'Inst_cd' =>($Inst_Id),
                'FormNo' =>($formno)



            );
            $logedIn = $this->Registration_model->Update_NewEnorlement($data);//, $fname);//$_POST['username'],$_POST['password']);
            if($logedIn != false)
            {  
                //  $sess_array = array(
                //                    'Inst_Id' => $logedIn['Inst_cd'] ,
                //                    'edu_lvl' => $logedIn['edu_lvl'],
                //                    'Name' => $logedIn['Name'],
                //                );
                //                $this->load->library('session');
                //                $this->session->set_userdata('logged_in', $sess_array);      
                //$this->load->model('Admission_model');
                //                $myfuns = $this->Admission_model->sum(5,5);
                //                $this->load->model('Admission_model');
                //                $minus = $this->Admission_model->minus(10,4);
                //$RegStdData = array('data'=>$this->Registration_model->EditEnrolement($user['Inst_Id']));
                //$userinfo = $Logged_In_Array['logged_in'];
                // $this->load->view('Registration/9th/EditForms.php');
                $this->session->set_flashdata('error', '3');
                redirect('Registration/EditForms');
                return;

                echo 'Data Saved Successfully !';
                //redirect('dashboard', 'refresh');

                //  $this->load->view('dashboard/dashboard.php');
                // $session_data = $this->session->userdata('logged_in');
            }
            else
            {     
                echo 'Data NOT Saved Successfully !';
                //$this->load->view('Registration/9th/NewEnrolment.php');

            } 
        }

        //$this->load->view('common/header.php');
        // $this->load->view('common/menu.php',$data);
        //$this->load->view('Registration/Registration.php');
        $this->load->view('common/footer.php');
    }
    public function NewEnrolment_Delete($formno){
        // DebugBreak();
        $this->load->model('Registration_model');
        $RegStdData = array('data'=>$this->Registration_model->Delete_NewEnrolement($formno));
        $this->load->library('session');
        $this->session->set_flashdata('error', '2');
        redirect('Registration/EditForms');
        return;
    }
    public function ReAdmission()
    {
        $data = array(
            'isselected' => '2',

        );
        $this->commonheader($data);
        $this->load->view('Registration/9th/ReAdmission.php');
        $this->commonfooter();
    }
    public function EditForms()
    {
        // DebugBreak();
        $data = array(
            'isselected' => '2',

        );
        $msg = $this->uri->segment(3);

        $this->load->library('session');
        if($msg == FALSE){

            $error_msg = $this->session->flashdata('error');    
        }
        else{
            $error_msg = $msg;
        }

        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_model');
        $RegStdData = array('data'=>$this->Registration_model->EditEnrolement($user['Inst_Id']));
        $RegStdData['msg_status'] = $error_msg;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('Registration/9th/EditForms.php',$RegStdData);
        $this->load->view('common/footer.php');



    }
    public function BatchList()
    {
        // DebugBreak();
        $data = array(
            'isselected' => '2',

        );
        // $this->commonheader($data);
        $this->load->model('Registration_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];
        //$page_name  = "Create Batch";
        $data1 = array('Inst_Id'=>$Inst_Id);
        $user_info  =  $this->Registration_model->Batch_List($data1);
        $user_info_arr = array('info'=>$user_info);
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);

        $this->load->view('Registration/9th/BatchList.php',$user_info_arr);


        $this->load->view('common/footer.php');
        //$this->commonheader($data);
        //  $this->load->view('Registration/9th/BatchList.php');
        //$this->commonfooter();
    }
    public function ProofReading()
    {
        $data = array(
            'isselected' => '2',

        );
        $this->commonheader($data);
        $this->load->view('Registration/9th/ProofReading.php');
        $this->commonfooter();
    }
    public function CreateBatch()
    {
        //  DebugBreak();
        $data = array(
            'isselected' => '2',

        );
        $msg = $this->uri->segment(3);

        $this->load->library('session');
        if($this->session->flashdata('error')){

            $error_msg = $this->session->flashdata('error');    
        }
        else{
            $error_msg = 0;
        }

        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_model');
        $RegStdData = array('data'=>$this->Registration_model->EditEnrolement($user['Inst_Id']));
        $RegStdData['msg_status'] = $error_msg;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('Registration/9th/CreateBatch.php',$RegStdData);
        $this->load->view('common/footer.php');



    }
    public function Make_Batch_Group_wise()
    {
        // DebugBreak();
        $RegGrp = $this->uri->segment(3);
        $this->load->model('Registration_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];
        $page_name  = "Create Batch";
        $User_info_data = array('Inst_Id'=>$Inst_Id,'RegGrp'=>$RegGrp);
        $user_info  =  $this->Registration_model->user_info($User_info_data); //$db->first("SELECT * FROM  Admission_online..tblinstitutes_all WHERE Inst_Cd = " .$user->inst_cd);
        if($user_info == false)
        {
            $this->session->set_flashdata('error', '3');
            redirect('Registration/CreateBatch');
            return;
        }
        $is_gov            =  $user_info['info'][0]['IsGovernment'];  //getValue("IsGovernment", " Admission_online..tblinstitutes_all", "Inst_cd =".$user->inst_cd);
        /*====================  Counting Fee  ==============================*/
        $processing_fee = 0;
        $reg_fee           = '';
        $Lreg_fee          = '';
        $TotalRegFee = 0;
        $TotalLatefee = 0;
        $Totalprocessing_fee = 0;
        $netTotal = 0;
        /*====================  Counting Fee  ==============================*/    
        //DebugBreak();
        $rule_fee = $user_info['rule_fee'];
        if($user_info['info'][0]['affiliation_date'] != null)
        {
            $lastdate  = date('Y-m-d',strtotime($user_info['info'][0]['affiliation_date'])) ;
            if(date('Y-m-d')<=$lastdate)
            {
                $rule_fee  =  $this->Registration_model->getreulefee(1); 
            }
        }
        else 
        {
            $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;

        }
        if($is_gov == 1)
        {
            $reg_fee = 0;
            $Lreg_fee = $rule_fee[0]['Fine'];
            $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];
        }
        else
        {
            $reg_fee = $rule_fee[0]['Reg_Fee'];
            $Lreg_fee = $rule_fee[0]['Fine'];
            $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];

        }
        // DebugBreak();
        $q1 = $user_info['fee'];
        $total_std = 0;
        foreach($q1 as $k=>$v) 
        {
            $ids[] = $v["formNo"];
            $total_std++;
            if(date('Y-m-d', strtotime($v["edate"] ))<= $lastdate) 
            {
                if($v["Spec"] == 1 || $v["Spec"] ==  2)
                {
                    $TotalRegFee =  0;
                    $reg_fee = 0;
                    $TotalLatefee = $TotalLatefee + $Lreg_fee;
                    $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
                }
                else 
                {
                    $TotalRegFee = $TotalRegFee + $reg_fee;
                    $TotalLatefee = $TotalLatefee + $Lreg_fee;
                    $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
                } 
            } 
            else
            {
                $reg_fee = $rule_fee[0]['Reg_Fee'];
                $TotalRegFee = $TotalRegFee + $reg_fee;
                $TotalLatefee = $TotalLatefee + $Lreg_fee;
                $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
            } // end of Else

            $netTotal = (int)$netTotal +$reg_fee + $Lreg_fee+$processing_fee;
        }


        $forms_id   = implode(",",$ids);        
        $tot_fee     = $Totalprocessing_fee+$TotalRegFee+$TotalLatefee;
        // $challan_No = 0;
        $today = date("Y-m-d H:i:s");
        $data = array('inst_cd'=>$Inst_Id,'total_fee'=>$tot_fee,'proces_fee'=>$processing_fee,'reg_fee'=>$reg_fee,'TotalRegFee'=>$TotalRegFee,'TotalLatefee'=>$TotalLatefee,'Totalprocessing_fee'=>$Totalprocessing_fee,'forms_id'=>$forms_id,'todaydate'=>$today,'total_std'=>$total_std);
        $this->Registration_model->Batch_Insertion($data); 
        redirect('Registration/BatchList');
        return;
        // $result    = $db->query(" EXEC Batch_Create @Inst_Cd = ".$user->inst_cd.",@UserId = ".$user->get_currentUser_ID()."@Amount = ".$tot_fee.",@Total_ProcessingFee = ".$prs_fee.",@Total_RegistrationFee = ".$reg_fee.",@Total_LateRegistrationFee =".$late_fee.",@Total_LateAdmissionFee = 0,@Valid_Date = '$today',@form_ids = '$forms_id'");

        // redirect_to("create-batch.php");


        //  $iselectricalactive = getValue("iselectricalallow", "Admission_online..tblinstitutes_all", "Inst_cd =".$user->inst_cd); 
    }
    public function Make_Batch_Formwise()
    {
        //DebugBreak();
        if(!empty($_POST["chk"]))
        {

            $forms_id =   "'".implode("','",$_POST["chk"])."'";    
        }
        else{
            return;
        }

        $RegGrp = $this->uri->segment(3);
        $this->load->model('Registration_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];
        $page_name  = "Create Batch";
        $User_info_data = array('Inst_Id'=>$Inst_Id,'forms_id'=>$forms_id);
        $user_info  =  $this->Registration_model->user_info_Formwise($User_info_data); //$db->first("SELECT * FROM  Admission_online..tblinstitutes_all WHERE Inst_Cd = " .$user->inst_cd);
        $is_gov            =  $user_info['info'][0]['IsGovernment'];  //getValue("IsGovernment", " Admission_online..tblinstitutes_all", "Inst_cd =".$user->inst_cd);
        /*====================  Counting Fee  ==============================*/
        $processing_fee = 0;
        $reg_fee           = '';
        $Lreg_fee          = '';
        $TotalRegFee = 0;
        $TotalLatefee = 0;
        $Totalprocessing_fee = 0;
        $netTotal = 0;
        /*====================  Counting Fee  ==============================*/    
        //DebugBreak();
        $rule_fee = $user_info['rule_fee'];
        if($user_info['info'][0]['affiliation_date'] != null)
        {
            $lastdate  = date('Y-m-d',strtotime($user_info['info'][0]['affiliation_date'])) ;
            if(date('Y-m-d')<=$lastdate)
            {
                $rule_fee  =  $this->Registration_model->getreulefee(1); 
            }
        }
        else 
        {
            $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;

        }
        if($is_gov == 1)
        {
            $reg_fee = 0;
            $Lreg_fee = $rule_fee[0]['Fine'];
            $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];
        }
        else
        {
            $reg_fee = $rule_fee[0]['Reg_Fee'];
            $Lreg_fee = $rule_fee[0]['Fine'];
            $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];

        }
        // DebugBreak();
        $q1 = $user_info['fee'];
        $total_std = 0;
        foreach($q1 as $k=>$v) 
        {
            $ids[] = $v["formNo"];
            $total_std++;
            if(date('Y-m-d', strtotime($v["edate"] ))<= $lastdate) 
            {
                if($v["Spec"] == 1 || $v["Spec"] ==  2)
                {
                    $TotalRegFee =  0;
                    $reg_fee = 0;
                    $TotalLatefee = $TotalLatefee + $Lreg_fee;
                    $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
                }
                else 
                {
                    $TotalRegFee = $TotalRegFee + $reg_fee;
                    $TotalLatefee = $TotalLatefee + $Lreg_fee;
                    $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
                } 
            } 
            else
            {
                $reg_fee = $rule_fee[0]['Reg_Fee'];
                $TotalRegFee = $TotalRegFee + $reg_fee;
                $TotalLatefee = $TotalLatefee + $Lreg_fee;
                $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
            } // end of Else

            $netTotal = (int)$netTotal +$reg_fee + $Lreg_fee+$processing_fee;
        }


        $forms_id   = implode(",",$ids);        
        $tot_fee     = $Totalprocessing_fee+$TotalRegFee+$TotalLatefee;
        // $challan_No = 0;
        $today = date("Y-m-d H:i:s");
        $data = array('inst_cd'=>$Inst_Id,'total_fee'=>$tot_fee,'proces_fee'=>$processing_fee,'reg_fee'=>$reg_fee,'TotalRegFee'=>$TotalRegFee,'TotalLatefee'=>$TotalLatefee,'Totalprocessing_fee'=>$Totalprocessing_fee,'forms_id'=>$forms_id,'todaydate'=>$today,'total_std'=>$total_std);
        $this->Registration_model->Batch_Insertion($data); 
        redirect('Registration/BatchList');
        return;
    }
    public function FormPrinting(){
        
        $this->load->library('session');
        //DebugBreak();
      if(!( $this->session->flashdata('error'))){

            $error_msg = "0";    
        }
        else{
            $error_msg = $this->session->flashdata('error');
        }
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '2',
        );
        //  DebugBreak();
        $error = array();
        $error['excep'] = '';
        $error['gender'] = $userinfo['gender'];
        $error['isrural'] = $userinfo['isrural'];
        $error['error_msg'] = $error_msg;
        $this->commonheader($data);
        $this->load->view('Registration/9th/FormPrinting.php',$error);
        // $this->load->view('common/footer.php');
        $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js")));

        //$this->load->model('Registration_model');
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
    public function return_pdf()
    {
        

        $Condition = $this->uri->segment(4);
        /*
        $Condition  1 == Batch Id wise printing.
        2 == Final Group wise prining.
        3 == Final Formno wise Printing.
        4 == Proof reading Group wise Printing.
        5 == Proof reading Formno wise Printing.
        */
       // DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_model');
        if($Condition == "1")
        {
            $Batch_Id = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
            $result = array('data'=>$this->Registration_model->return_pdf($fetch_data),'inst_Name'=>$user['inst_Name']);    
        }
        else if($Condition == "2")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd);
            $result = array('data'=>$this->Registration_model->Print_Form_Groupwise($fetch_data));
        
        }
         
        else if($Condition == "3")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);


            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno);
            $result = array('data'=>$this->Registration_model->Print_Form_Formnowise($fetch_data));
        }
        else if($Condition == "4")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd);
            $result = array('data'=>$this->Registration_model->Print_Form_Groupwise($fetch_data),'inst_Name'=>$user['inst_Name']);

        }
        else if($Condition == "5")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno);
            $result = array('data'=>$this->Registration_model->Print_Form_Formnowise($fetch_data),'inst_Name'=>$user['inst_Name']);

        }

         // DebugBreak();
        if(empty($result['data'])){
             $this->session->set_flashdata('error', $Condition);
                redirect('Registration/FormPrinting');
                return;
            
        }
        $temp = $user['Inst_Id'].'09-2016-18';
        $image =  $this->set_barcode($temp);
       // $pdf->Image(base_url().'assets/pdfs/'.'/'.$image,6.3,0.5, 1.8, 0.20, "PNG");
        //$studeninfo['data']['info'][0]['barcode'] = $image;
        $this->load->library('PDF_Rotate');


        $pdf = new PDF_Rotate('P','in',"A4");
             $pdf->Rotate(0,-1,-1);
          //   $pdf->SetFont('Arial','B',50);
//             $pdf->SetTextColor(255,192,203);
//             $pdf->Rotate(35,190,'W a t e r m a r k   d e m o',45);
        $pdf->SetMargins(0.5,0.5,0.5);
        $lmargin =0.5;
        $rmargin =7.5;
        $topMargin = 0.5;
        $countofrecords=14;
        $title=1.0;
        $cnt=0; $ln[0]=1.5;
        $SR=1;
        while($cnt<15) 
        {
            $cnt++;
            $ln[$cnt]=$ln[$cnt-1]+ 0.6;  //0.5;
        }
      
        $i = 4;
        $result = $result['data'] ;
       // DebugBreak();
        foreach ($result as $key=>$data) 
        {
            //DebugBreak();
            //DebugBreak();
            $i++;
            $countofrecords=$countofrecords+1;
            if($countofrecords==15) {
                $countofrecords=0;

                $pdf->AddPage();

            //     $pdf->SetFont('Arial','B',50);
//                 $pdf->SetTextColor(255,192,203);
//                 $pdf->Rotate(35,190,'W a t e r m a r k   d e m o',45);


                if($Condition==4 or $Condition == 5)
                {
                    $pdf->Image( base_url().'assets/img/PROOF_READ.jpg' ,1,3.5 , 6,4 , "JPG");     
                }
                
                $pdf->SetFont('Arial','U',14);
                $pdf->SetXY( 0.4,0.2);
                $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");

                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(1.7,0.4);
                $pdf->Cell(0, 0.25, "MATRIC PART-I ENROLMENT RETURN SESSION (2016-2018)", 0.25, "C");

                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(2.6,0.4);
                $pdf->Image(base_url().'assets/pdfs/'.'/'.$image,6.3,0.5, 1.8, 0.20, "PNG"); 
                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(1.7,0.6);
                $pdf->Cell(0, 0.25,$user['Inst_Id']. "-". $user['inst_Name'], 0.25, "C");

                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(6.9,0.8);
                $pdf->Cell(0, 0.25,  'Gender: '. ($data['sex']?"MALE":"FEMALE" ), 0.25, "C");
                $grp_name = $data["RegGrp"];
                switch ($grp_name) {
                    case '1':
                        $grp_name = 'SCIENCE WITH BIOLOGY';
                        break;
                    case '7':
                        $grp_name = 'SCIENCE  WITH COMPUTER SCIENCE';
                        break;
                    case '8':
                        $grp_name = 'SCIENCE  WITH ELECTRICAL WIRING';
                        break;
                    case '2':
                        $grp_name = 'Humanities';
                        break;
                    case '5':
                        $grp_name = 'Deaf and Dumb';
                        break;
                    default:
                        $grp_name = "No Group Selected.";
                }
                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(2.5,0.8);
                $pdf->Cell(0, 0.25,  'Group: '.$grp_name, 0.25, "C");


                $pdf->rect($lmargin,1,$rmargin,10.5);                //the main rectangle box
                $cnt=-1;

                while($cnt<15) 
                { 
                    $cnt++;
                    $pdf->Line($lmargin, $ln[$cnt],$rmargin+.5,$ln[$cnt]);    
                }


                $col1=$lmargin+.3;    
                $col2=$col1+0.9;    
                $col3=$col2+1.8;
                $col4=$col3+1.1;    
                $col5=$col4+1.0;    
                $col6=$col5+1.8;

                $pdf->Line($col1,$title,$col1,$ln[15]);
                $pdf->Line($col2,$title,$col2,$ln[15]);
                $pdf->Line($col3,$title,$col3,$ln[15]);
                $pdf->Line($col4,$title,$col4,$ln[15]);
                $pdf->Line($col5,$title,$col5,$ln[15]);
                $pdf->Line($col6,$title,$col6,$ln[15]);

                $pdf->SetFont('Arial','B',9);
                $pdf->Text($lmargin+.03,$title+.3,"Sr#");    //$pdf->Text(3,3,"TEXT TO DISPLAY");
                $pdf->Text($col1+.2,$title+.3,"FormNo.");

                $pdf->Text($col2+.1,$title+.2,"Name / Father`s Name");
                $pdf->Text($col2+.1,$title+.4,"Mobile No");

                $pdf->Text($col3+.1,$title+.2,"Bay Form No"); 
                $pdf->Text($col3+.1,$title+.4,"Father CNIC");

                $pdf->Text($col4+.1,$title+.2,"Date Of Birth");
                $pdf->Text($col4+.1,$title+.4,"Relegion");

                $pdf->Text($col5+.1,$title+.3,"Subjects");

                $pdf->Text($col6+.1,$title+.3,"Picture");
            }

            $dob = date("d-m-Y", strtotime($data["Dob"]));
            $adm = date("d-m-Y", strtotime($data["edate"]));

            //============================ Values ==========================================            
            $pdf->SetFont('Arial','',10);    
            $pdf->Text($lmargin+.1  , $ln[$countofrecords]+0.3 , $SR);                 // Sr No
            $pdf->Text($col1+.05    , $ln[$countofrecords]+0.3,$data["formNo"]);       // Form No

            $pdf->SetFont('Arial','B',8);    
            $pdf->Text($col2+.1,$ln[$countofrecords]+0.2,strtoupper($data["name"]));
            $pdf->SetFont('Arial','',8);                
            $pdf->Text($col2+.1,$ln[$countofrecords]+0.4,strtoupper($data["Fname"]));
            $pdf->SetFont('Arial','',7.5);                
            $pdf->Text($col2+.1,$ln[$countofrecords]+0.55,strtolower($data["CellNo"]));
            $pdf->SetFont('Arial','',8);
            $pdf->Text($col3+.1,$ln[$countofrecords]+0.2,strtoupper($data["BForm"]));
            $pdf->Text($col3+.1,$ln[$countofrecords]+0.4,strtoupper($data["FNIC"]));

            $pdf->Text($col4+.1,$ln[$countofrecords]+0.2,strtoupper($data["Dob"]));
            $pdf->Text($col4+.1,$ln[$countofrecords]+0.4,strtoupper($data["rel"]==1?"Muslim":"Non-Muslim"));

            $pdf->SetFont('Arial','B',7);    
            //            $pdf->Text($col5+.05,$ln[$countofrecords]+0.2,GroupName($data["Grp_Cd"]));
            $pdf->Text($col5+.05,$ln[$countofrecords]+0.2,  $data["sub1_abr"].','.$data["sub2_abr"].','.$data["sub3_abr"].','.$data["sub4_abr"]);
            $pdf->SetFont('Arial','',7);    
            $pdf->Text($col5+.05,$ln[$countofrecords]+0.4,$data["sub5_abr"].','.$data["sub6_abr"].','.$data["sub7_abr"].','.$data["sub8_abr"]);

            $pdf->Image(base_url().'assets/uploads/'.$data["Sch_cd"].'/'.$data["PicPath"],$col6+0.05,$ln[$countofrecords]+0.05 , 0.50, 0.50, "JPG"); 

            ++$SR;


            //Certified that I have checked all the relevant record of the students and the particulars as mentioned above are correct.
            $pdf->SetFont('Arial','',8);
            $pdf->Text($lmargin+.5,10.8,"Certified that I have checked all the relevant record of the students and the particulars as mentioned above are correct.");
            //$pdf->Text($lmargin+.5,11,"Signature _____________________");
            $pdf->SetFont('Arial','',10);
            $pdf->Text($rmargin-2.5,11.2,"_____________________________________");
            $pdf->Text($rmargin-2.5,11.4,"Signature of Head of Institution with Stamp");
            $pdf->Text($lmargin+0.5,11.4,'Print Date: '. date('d-m-Y H:i:s'));    

        }
        $pdf->Output();
    }
    public function revenue_pdf()
    {
        //  DebugBreak();
        $Batch_Id = $this->uri->segment(3);
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_model');
        $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
        $temp = $user['Inst_Id'].'09-2016-18';
        $image =  $this->set_barcode($temp);
        $data = array('data'=>$this->Registration_model->revenue_pdf($fetch_data),'inst_Name'=>$user['inst_Name'],'inst_cd'=>$user['Inst_Id'],'barcode'=>$image);
        $this->load->view('Registration/9th/RevenueForm.php',$data);
    }

    public function commonheader($data)
    {
        $this->load->view('common/header.php',$data);
        $this->load->view('common/menu.php',$data);
    } 
    public function commonfooter($data)
    {
        $this->load->view('common/footer.php',$data);
    }
    
    public function Print_Registration_Form_Final_Groupwise(){}
    public function Print_Registration_Form_Final_Formwise(){}
    
    public function Print_Registration_Form_Proofreading_Groupwise(){
       
     //  DebugBreak();
        $Condition = $this->uri->segment(4);
        
        $this->load->library('session');
        
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_model');
        
        if($Condition == "1")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd);
            $result = array('data'=>$this->Registration_model->Print_Form_Groupwise($fetch_data),'inst_Name'=>$user['inst_Name']);
        }
        else if($Condition == "2")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno);
            $result = array('data'=>$this->Registration_model->Print_Form_Formnowise($fetch_data),'inst_Name'=>$user['inst_Name']);
            //Print_Form_Formnowise
        }
        
        
        
        
         $this->load->library('PDF_Rotate');


        $pdf = new PDF_Rotate('P','in',"A4");
  //      $this->load->library('PDFF');
//        $pdf=new PDFF('P','in',"A4");  
        $pdf->SetMargins(0.5,0.5,0.5);
        $grp_cd = $this->uri->segment(3);
        
         
  $fontSize = 10;
  $marge    = .4;   // between barcode and hri in pixel
  $x        = 7.5;  // barcode center
  $y        = 1.2;  // barcode center
  $height   = 0.35;   // barcode height in 1D ; module size in 2D
  $width    = .013;  // barcode height in 1D ; not use in 2D
  $angle    = 0;   // rotation in degrees
  
  $type     = 'code128';
  $black    = '000000'; // color in hex
  // DebugBreak();
   $result = $result['data'] ;
//if(!empty($result)):
foreach ($result as $key=>$data) 
{
        
    //First Page ---class instantiation    
   //$pdf = new FPDF_BARCODE("P","in","A4");
  $pdf->AddPage();
  $Y = 0.5;
     // DebugBreak();
    //
   
     $pdf->SetFillColor(0,0,0);
   $pdf->SetDrawColor(0,0,0); 
     //$code     = $data['formNo'];     // barcode (CP852 encoding for Polish and other Central European languages)

   //$bardata = Barcode::fpdf($pdf, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);
   
   //$len = $pdf->GetStringWidth("12345678");
  //Barcode::rotate(-$len / 2, ($bardata['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
  // added charest conversion to enable correct display of text encoded in barcode
  //$pdf->Image($x + $xt, $y + $yt, "12345678", $angle,10,"JPG");
   $temp = $data['formNo'].'@09@2016@1';
   $image =  $this->set_barcode($temp);
   //$pdf->Image($x + $xt, $y + $yt, "12345678", $angle,10,"JPG");
   $pdf->Image(base_url().'assets/pdfs/'.'/'.$image,6.0, 1.2  ,1.8,0.20,"PNG");
   // $pdf->Image(base_url().'assets/pdfs/'.'/'.$image,6.3,0.5, 1.8, 0.20, "PNG");
    
    $pdf->SetFont('Arial','U',16);
    $pdf->SetXY( 1.2,0.2);
    $pdf->Cell(0, 0.2, "Board Of Intermediate and Secondary Education,Gujranwala", 0.25, "C");
    $pdf->Image(base_url()."assets/img/logo.jpg",0.05,0.2, 0.75,0.75, "JPG", "http://www.bisegrw.com");

   

    $pdf->SetFont('Arial','',10);
    $pdf->SetXY(1.7,0.4);
    $pdf->Cell(0, 0.25, " REGISTRATION FORM FOR SSC/MATRIC SESSION 2016-2018", 0.25, "C");
    $pdf->Image(base_url(). 'assets/img/PROOF_READ.jpg' ,1,3.5 , 6,4 , "JPG");     
//--------------- Proof Read
     $ProofReed = "(PROOF READ) (Not for Board) ";
     $pdf->SetXY(3,0.8);
     $pdf->SetFont("Arial",'',12);
     $pdf->Cell(0, 0.25, $ProofReed  ,0,'C');
     
//--------------------------- Form No & Rno
     $pdf->SetXY(0.2,0.5+$Y);
     $pdf->SetFont('Arial','',10);
     $pdf->Cell( 0.5,0.5,"Form No: _______________",0,'L');
 
     $pdf->SetXY(0.8,0.5+$Y);
     $pdf->SetFont('Arial','IB',12);
     $pdf->Cell( 0.5,0.5,$data['formNo'],0,'L');
    
//--------------------------- Institution Code and Name   $user['Inst_Id']. "-". $user['inst_Name']
      $pdf->SetXY(0.2,0.85+$Y);
     $pdf->SetFont('Arial','',10);
     $pdf->Cell( 0.5,0.5,"Institution Code/Name:",0,'L');
     
     $pdf->SetFont('Arial','B',10);
     $pdf->SetXY(1.75,0.85+$Y);
     $pdf->Cell(0.5,0.5,  $user['Inst_Id']. "-". $user['inst_Name'],0,'L');    
 
//------ Picture Box on Centre      
       $pdf->SetXY(7, $Y +1.75);
       $pdf->Cell(1.25,1.4,'',1,0,'C',0);
      //  $exists = is_file(UPLOADS.$user->inst_cd.'/'.$data["PicPath"]);
//            if($exists) {
//                $img = "uploads/".$user->inst_cd."/".$data["PicPath"];
//                $ext = "JPG";
//            }else{
//                $img = "images/no_image.png";
//                $ext = "PNG";
//            }
//       $pdf->Image( $img,7, 1.75+ $Y, 1.25, 1.4, $ext);
      $pdf->Image(base_url().'assets/uploads/'.$data["Sch_cd"].'/'.$data["PicPath"],7, 1.75+ $Y, 1.25, 1.4, "JPG"); 
      $pdf->SetFont('Arial','',10);
     
//------------- Personal Infor Box
//====================================================================================================================
    
    $x = 0.55;
    $pdf->SetFont('Arial','B',10);
    $pdf->SetXY(0.2,1.28+$Y);
    $pdf->SetFillColor(240,240,240);
    $pdf->Cell(8,0.3,'PERSONAL INFORMATION',1,0,'L',1);
    $Y = 0.3;
//--------------------------- 1st line 
     $pdf->SetFont('Arial','',10);
     $pdf->SetXY(0.5,1.65+$Y);
     $pdf->Cell( 0.5,0.5,"Name:",0,'L');
     $pdf->SetFont('Arial','B',10);
     $pdf->SetXY(1.5,1.65+$Y);
     $pdf->Cell(0.5,0.5,  strtoupper($data["name"]),0,'L');
    //--------------------------- FATHER NAME 
    $pdf->SetXY(3.5+$x,1.65+$Y);
     $pdf->SetFont('Arial','',10);
     $pdf->Cell( 0.5,0.5,"Father Name:.",0,'L');
     $pdf->SetFont('Arial','B',10);
     $pdf->SetXY(4.5+$x,1.65+$Y);
     $pdf->Cell(0.5,0.5, strtoupper($data["Fname"]),0,'L');
     
    
//--------------------------- 3rd line 
    $pdf->SetXY(0.5,$Y+ 2);
     $pdf->SetFont('Arial','',10);
     $pdf->Cell( 0.5,0.5,"Date Of Birth:",0,'L');
     $pdf->SetFont('Arial','B',10);
     $pdf->SetXY(1.5,2+$Y);
    $pdf->Cell(0.5,0.5,$data["Dob"],0,'L');     
//    $pdf->Cell(0.5,0.5,$data["Rel"]==1?"Muslim":"Non-Muslim",0,'L');
     
      $pdf->SetXY(3.5+$x,2+$Y);
     $pdf->SetFont('Arial','',10);
     $pdf->Cell( 0.5,0.5,"Gender:",0,'L');
            $pdf->SetFont('Arial','B',10);
             $pdf->SetXY(4.5+$x,2+$Y);
             $pdf->Cell(0.5,0.5,$data["sex"]==1?"MALE":"FEMALE",0,'L');            
//--------------------------- BAY FORM NO line 
    $pdf->SetXY(0.5,$Y+2.35);
     $pdf->SetFont('Arial','',10);
     $pdf->Cell( 0.5,0.5,"Bay Form No:",0,'L');
           $pdf->SetFont('Arial','B',10);
             $pdf->SetXY(1.5,$Y+2.35);
             $pdf->Cell(0.5,0.5,$data["BForm"],0,'L');
          

     $pdf->SetXY(3.5+$x,$Y+2.35);
     $pdf->SetFont('Arial','',10);
     $pdf->Cell(0.5,0.5,"Father CNIC:",0,'R');
          $pdf->SetFont('Arial','B',10);
             $pdf->SetXY(4.5+$x,$Y+2.35);
             $pdf->Cell(0.5,0.5,$data["FNIC"],0,'L');
//---------------------------  
    $pdf->SetXY(0.5,$Y+2.7);
     $pdf->SetFont('Arial','',10);
     $pdf->Cell( 0.5,0.5,"Speciality:",0,'L');
             $pdf->SetFont('Arial','B',10);
             $pdf->SetXY(1.5,$Y+2.7);
             $pdf->Cell(0.5,0.5, ($data["spl_cd"]),0,'L');

     $pdf->SetXY(3.5+$x,$Y+2.7);
     $pdf->SetFont('Arial','',10);
     $pdf->Cell(0.5,0.5,"Locality:",0,'R');
            $pdf->SetFont('Arial','B',10);
             $pdf->SetXY(4.5+$x,$Y+2.7);
             $pdf->Cell(0.5,0.5,$data["RuralORUrban"]==0?"Urban":"Rural",0,'L');
 
//--------------------------- Gender Nationality 
    $pdf->SetXY(0.5,$Y+3.05);
     $pdf->SetFont('Arial','',10);
     $pdf->Cell( 0.5,0.5,"Medium:",0,'L');
               $pdf->SetFont('Arial','B',10);
             $pdf->SetXY(1.5,$Y+3.05);
             $pdf->Cell(0.5,0.5,$data["med"]==1?"Urdu":"English",0,'L');            
            
    $pdf->SetXY(3.5+$x,$Y+3.05);
     $pdf->SetFont('Arial','',10);
     $pdf->Cell( 0.5,0.5,"Nationality:",0,'L');
               $pdf->SetFont('Arial','B',10);
             $pdf->SetXY(4.5+$x,$Y+3.05);
            $pdf->Cell(0.5,0.5,$data["nat"]==1?"PAKISTANI":"NON-PAKISTANI",0,'R');             
//--------------------------- id mark and Medium 
    $pdf->SetXY(0.5,$Y+3.40);
     $pdf->SetFont('Arial','',10);
     $pdf->Cell( 0.5,0.5,"Ident Mark:",0,'L');
               $pdf->SetFont('Arial','B',10);
             $pdf->SetXY(1.5,$Y+3.40);
             $pdf->Cell(0.5,0.5,$data["markOfIden"],0,'L');
            
    $pdf->SetXY(3.5+$x,$Y+3.40);
     $pdf->SetFont('Arial','',10);
     $pdf->Cell( 0.5,0.5,"Religion:",0,'L');
               $pdf->SetFont('Arial','B',10);
             $pdf->SetXY(4.5+$x,$Y+3.40);
            $pdf->Cell(0.5,0.5,$data["rel"]==1?"Muslim":"Non-Muslim",0,'L');            
//             $pdf->Cell(0.5,0.5, $data["MobNo"],0,'L');
 //----- Contact No.    
     $pdf->SetXY(0.5,$Y+3.75);
     $pdf->SetFont('Arial','',10);
     $pdf->Cell( 0.5,0.5,"Mobile No:",0,'L');
               $pdf->SetFont('Arial','B',10);
             $pdf->SetXY(1.5,$Y+3.75);
             $pdf->Cell(0.5,0.5, $data["CellNo"],0,'L');
            
 
     $pdf->SetXY(0.5,$Y+4.1);
     $pdf->SetFont('Arial','',10);
     $pdf->Cell( 0.5,0.5,"Address:",0,'L');
            $pdf->SetFont('Arial','b',10);
             $pdf->SetXY(1.5,$Y + 4.1);
             $pdf->Cell(0.5,0.5, strtoupper($data["addr"]),0,'L');
//========================================  Exam Info ===============================================================================            
$sY = -1.2;//0.5;
    $pdf->SetXY(0.2,6.1+$sY);
    $pdf->SetFillColor(240,240,240);
    $pdf->Cell(8,0.3,'SUBJECT INFORMATION',1,0,'L',1);

//--------------------------- Subject Group
 $grp_name = $data["RegGrp"];
                switch ($grp_name) {
                    case '1':
                        $grp_name = 'SCIENCE WITH BIOLOGY';
                        break;
                    case '7':
                        $grp_name = 'SCIENCE  WITH COMPUTER SCIENCE';
                        break;
                    case '8':
                        $grp_name = 'SCIENCE  WITH ELECTRICAL WIRING';
                        break;
                    case '2':
                        $grp_name = 'Humanities';
                        break;
                    case '5':
                        $grp_name = 'Deaf and Dumb';
                        break;
                    default:
                        $grp_name = "No Group Selected.";
                }
    $pdf->SetXY(0.5,6.45+$sY);
     $pdf->SetFont('Arial','',10);
     $pdf->Cell( 0.5,0.5,"Subject Group:",0,'L');
          $pdf->SetFont('Arial','B',10);
         $pdf->SetXY(1.5,6.45+$sY);
         $pdf->Cell(0.5,0.5, ($grp_name),0,'L');

    $y = $sY - 0.3;
    $x = 1;
//--------------------------- Subjects
           $pdf->SetFont('Arial','',10);
//DebugBreak();
//------------- sub 1 & 5
            $pdf->SetXY(0.5,7.05+$y);
             $pdf->Cell(0.5,0.5, '1. '.($data['sub1_NAME']),0,'L');
            $pdf->SetXY(3+$x,7.05+$y);
             $pdf->Cell(0.5,0.5, '5. '.($data['sub5_NAME']),0,'L');
//------------- sub 2 & 6
             $pdf->SetXY(0.5,7.35+$y);
             $pdf->Cell(0.5,0.5, '2. '.($data['sub2_NAME']),0,'L');
            $pdf->SetXY(3+$x,7.35+$y);
             $pdf->Cell(0.5,0.5, '6. '.($data['sub6_NAME']),0,'R');
//------------- sub 3 & 7
            $pdf->SetXY(0.5,7.70+$y);
             $pdf->Cell(0.5,0.5,  '3. '.($data['sub3_NAME']),0,'L');
            $pdf->SetXY(3+$x,7.70+$y);
             $pdf->Cell(0.5,0.5, '7. '.($data['sub7_NAME']),0,'R');
//------------- sub 4 & 8
            $pdf->SetXY(0.5,8.05+$y);
             $pdf->Cell(0.5,0.5, '4. '.($data['sub4_NAME']),0,'L');
             $pdf->SetXY(3+$x,8.05+$y);
             $pdf->Cell(0.5,0.5, '8. '.($data['sub8_NAME']),0,'L');

 
  $pdf->SetFont('Arial','UI',10);  
  $pdf->SetXY(5.6,  6.9);
  $date = time($data['edate']); 
  $pdf->Cell(8,0.24,'Feeding Date: '. date('d-m-Y H:i:s', $date) ,0,'L','');
  
//date_format($$data['EDate'], 'd/m/Y H:i:s');

  $pdf->SetXY(5.6,  7.2);
  $pdf->Cell(8,0.24,'Print Date: '. date('d-m-Y H:i:s'),0,'L','');
  
 //======================================================================================
}
//else:
//    echo "No Record Found For Processing...";
//endif;    

//echo 'Some thing is not  ok    '; die();

    
//$filename="Admission_Forms_". $inst_cd."_".GetInterGroup($grp).'_'. ($sex== 1?'MALE': 'FEMALE') .  ".pdf";    

//$filename="Reg_Forms_". ".pdf";
//$pdf->Output($filename,'D');
$pdf->Output();
    }
    public function Print_Registration_Form_Proofreading_Formwise(){}
}
