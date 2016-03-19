<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admission extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');   
    }
    public function index()
    {
        $data = array(
            'isselected' => '3',
        );
        $this->load->view('common/header.php');
        $this->load->view('common/menu.php',$data);
        $this->load->view('Admission/Admission.php');
        $this->load->view('common/footer.php');
    }
    public function StudentsData()
	{    
		$this->load->library('session');
		$user = $this->session->get_userdata('logged_in'); 
		$this->load->model('Admission_model'); 
		//$stdData = $this->Admission_model->getStudentsData($user['logged_in']['Inst_Id']);
		$stdData = array(
				'data' => $this->Admission_model->getStudentsData($user['logged_in']['Inst_Id'])
				);
        $data = array(
            'isselected' => '3'
        );
        $this->commonheader($data);
        $this->load->view('Admission/9th/StudentsData.php',$stdData);
        $this->commonfooter(array('files'=>array('validate.NewEnrolment.js')));
    }
	
	public function uploadFile ($rno, $inst_code, $file_field = null, $check_image = false, $random_name = false, $pic_name, $whitelist_ext, $whitelist_type, $path)
	{
		$out = array('error'=>null);
		if (!$file_field) $out['error'][] = "Please specify a valid form field name";           
		if (!$path)       $out['error'][] = "Please specify a valid upload path";               
		if (count($out['error'])>0) return $out;
	  
		//Make sure that there is a file
		if((!empty($_FILES[$file_field])) && ($_FILES[$file_field]['error'] == 0)) 
		{
			// Get filename
			$file_info = pathinfo($_FILES[$file_field]['name']);
			$name = $file_info['filename'];
			$ext = $file_info['extension'];
			//Check file has the right extension
			if (!in_array($ext, $whitelist_ext)) $out['error'][] = "Invalid file Extension";
			//Check that the file is of the right type
			if (!in_array($_FILES[$file_field]["type"], $whitelist_type)) $out['error'][] = "Invalid file Type";
			//If $check image is set as true
			if ($check_image) 
			{
				if (!getimagesize($_FILES[$file_field]['tmp_name'])) 
					$out['error'][] = "Uploaded file is not a valid image";
			}

			$newname =  $pic_name.'.'.$ext;
			//Check if file already exists on server
			if (file_exists($path.$newname))
				   unlink($path.$newname);
			if (count($out['error'])>0) return $out;
			if (move_uploaded_file($_FILES[$file_field]['tmp_name'], $path.$newname)) 
			{
				//Successfully uploaded file.
				$out['filepath'] = $path;
				$out['filename'] = $newname;
				return $out;
			} 
			else  $out['error'][] = "Server Error!";
	  } 
	  else 
	  {
		$out['error'][] = "No file uploaded";
		return $out;
	  }
	}
	
    public function ReAdmission($rno=0)
    {
		//if(!intval($rno)>0){//directt code here.}
		$this->load->library('session');
		$this->load->model('Admission_model'); 
		$user = $this->session->get_userdata('logged_in'); 
		$inst_code = $user['logged_in']['Inst_Id'];
		$stdRoll = $rno; $error = "";
		$rno = (int)$stdRoll;
		if(isset($_POST['save'])){
			$target_path =  'assets/uploads/' ; // UPLOADS;
			$target_path = 'assets/uploads/'.$inst_code.'/';
			if (!file_exists($target_path)){
				mkdir($target_path, 0777, true);
			}
			$countStudents = $this->Admission_model->countStudents($inst_code);
			$formNo = $inst_code . str_pad(intval($countStudents)+1, 4, "0", STR_PAD_LEFT);
			
			$new_name = "";
			if(!empty($_FILES['image']['name']))
			{
				$limit_size = 20000;
				$file_size = $_FILES['image']['size'];
				$sizekb = $file_size/1000;
				if($file_size >= $limit_size) 
				{ 
				 $error = "Your file size is over limit. Your file size = $sizekb kb File size limit = 20kb. Please try Again!";
				}
				if(empty($error)){
					$whitelist_ext = array('jpeg', 'jpg', 'gif', 'JPEG', 'JPG');
					$whitelist_type = array('image/jpeg', 'image/jpg',  'image/JPEG', 'image/JPG');
					$file = $this->uploadFile($rno, $inst_code, 'image', true, true, $formNo, $whitelist_ext, $whitelist_type, $target_path);
					
					if (is_array($file['error'])) 
					{
						foreach($file['error'] as $msg) {$error .= "<br />".$msg;}
						exit($error);
					} else {
						$newFileName = $file['filename'];
						// exit($newFileName);
						extract($_POST);
						$data = array(
							'rno'=>$rno,
							'class'=>$class,
							'iYear'=>$iYear,
							'sess'=>$sess,
							'regNo'=>$regNo,
							'formNo'=>$formNo,
							'strRegNo'=>$strRegNo,
							'schm'=>$schm,
							'classRno'=>$classRno,
							'schGrade'=>$schGrade,
							'name'=>$name,
							'fName'=>$fName,
							'bForm'=>$bForm,
							'addr'=>$addr,
							'fNic'=>$fNic,
							'markOfIden'=>$markOfIden,
							'rel'=>$rel,
							'dob'=>$dob,
							'sex'=>$sex,
							'med'=>$med,
							'nat'=>$nat,
							'isHafiz'=>$isHafiz,
							'speciality'=>$speciality,
							'ruralOrUrban'=>$ruralOrUrban,
							'dist_cd'=>$dist_cd,
							'teh_cd'=>$teh_cd,
							'cat09'=>$cat09,
							'cat10'=>$cat10,
							'grp_cd'=>$grp_cd,
							'Sch_cd'=>$inst_code,
							'sub1Ap1' => $sub1p1,
							'sub1Ap2' => $sub1p2,
							'sub2Ap1' => $sub2p1,
							'sub2Ap2' => $sub2p2, 
							'sub3Ap1' => $sub3p1,
							'sub3Ap2' => $sub3p2, 
							'sub4Ap1' => $sub4p1,
							'sub4Ap2' => $sub4p2, 
							'sub5Ap1' => $sub5p1,
							'sub5Ap2' => $sub5p2, 
							'sub6Ap1' => $sub6p1,
							'sub6Ap2' => $sub6p2, 
							'sub7Ap1' => $sub7p1,
							'sub7Ap2' => $sub7p2, 
							'sub8Ap1' => $sub8p1,
							'sub8Ap2' => $sub8p2, 
							'mobNo' => $MobNo,
							'picPath' => $newFileName,
							'isDeleted' => 0
						);
						$this->Admission_model->insertRecord($data);
					}
				}
			}
		}
		if($rno > 0 ){
			$stdData = array(
				'error' => $error,
				'data' => $this->Admission_model->getAdmissionData($rno, $user['logged_in']['Inst_Id']),
				'subjects' => $this->Admission_model->getSubjects($rno, $user['logged_in']['Inst_Id'])
				);
			$data = array(
				'isselected' => '3'
				);
			$jsFiles = array(
				'files'=>array('validate.NewEnrolment.js'));
			$this->commonheader($data);
			$this->load->view('Admission/9th/ReAdmission.php',$stdData);
			$this->commonfooter($jsFiles);
		}
    }
	
	public function deleteRecord($rno){
		$rno = intval($rno);
		if($rno > 0){
			$this->load->library('session');
			$this->load->model('Admission_model'); 
			$user = $this->session->get_userdata('logged_in'); 
			$inst_code = $user['logged_in']['Inst_Id'];
			$this->Admission_model->deleteRecord($rno, $inst_code);
			$this->EditForms();
		}
	}
    
	public function EditForms()
    {
		$this->load->library('session');
		$this->load->model('Admission_model'); 
		$user = $this->session->get_userdata('logged_in'); 
		$inst_code = $user['logged_in']['Inst_Id'];
		$data = array(
			'data' => $this->Admission_model->getEditFormsList($inst_code),
			'isselected' => '3'
		);
        $this->commonheader($data);
        $this->load->view('Admission/9th/EditForms.php');
        $this->commonfooter();
    }

	public function PrintForm($formNo)
    {
		$this->load->model('Admission_model'); 
		$this->Admission_model->printForm($formNo);
    }
	
    public function BatchList()
    {
		$data = array(
            'isselected' => '3'
        );
        $this->commonheader($data);
        $this->load->view('Admission/9th/BatchList.php');
        $this->commonfooter();
    }
    public function ProofReading()
    {
       $data = array(
            'isselected' => '3'
        );
        $this->commonheader($data);
        $this->load->view('Admission/9th/ProofReading.php');
        $this->commonfooter();
    }
    public function CreateBatch()
    {
        $this->load->library('session');
        $this->load->model('Admission_model'); 
        $user = $this->session->get_userdata('logged_in'); 
        $inst_code = $user['logged_in']['Inst_Id'];
        $data = array(
            'data' => $this->Admission_model->getEditFormsList($inst_code),
            'isselected' => '3'
        );
        
         /* $data = array(
            'isselected' => '3'
        );  */
        
        $this->commonheader($data);
        $this->load->view('Admission/9th/CreateBatch.php');
        $this->commonfooter();
    }
    public function FormPrinting()
    {
       $data = array(
            'isselected' => '3'
        );
        $this->commonheader($data);
        $this->load->view('Admission/9th/FormPrinting.php');
        $this->commonfooter();
    }
    
    public function commonheader($data)
    {
         $this->load->view('common/header.php');
        $this->load->view('common/menu.php',$data);
    } 
     public function commonfooter($arrfilePath=array())
     {
          $data = $arrfilePath;
          $this->load->view('common/footer.php',$data);
     }
}