<?php

class Registration_model extends CI_Model 
{
    public function __construct()    {

        $this->load->database(); 


    }
     
    public function Insert_NewEnorlement($data)//$father_name,$bay_form,$father_cnic,$dob,$mob_number)  
    {
       // DebugBreak();
        $name = $data['name'];
        $fname = $data['Fname'];
        $BForm = $data['BForm'];
        $FNIC = $data['FNIC'];
        $Dob = $data['Dob'];
        $CellNo = $data['CellNo'];
        $medium = $data['medium'];
        $Inst_Rno = $data['Inst_Rno'];
        $MarkOfIden = $data['MarkOfIden'];
        $Speciality = $data['Speciality'];
        $nat = $data['nat'];
        $sex = $data['sex'];
        $IsHafiz = $data['IsHafiz'];
        $rel = $data['rel'];
        $addr = $data['addr'];
        if(($data['grp_cd'] == 1) or ($data['grp_cd'] == 7) or ($data['grp_cd'] == 8) )
        {
        $grp_cd = 1;    
        }
        else if($data['grp_cd'] == 2 )
        {
        $grp_cd = 2;        
        }
        else if($data['grp_cd'] == 5 )
        {
        $grp_cd = 5;        
        }
        $sub1= $data['sub1'];
        $sub2 = $data['sub2'];
        $sub3 = $data['sub3'];
        $sub4 = $data['sub4'];
        $sub5 = $data['sub5'];
        $sub6 = $data['sub6'];
        $sub7 = $data['sub7'];
        $sub8 = $data['sub8'];
        $sub1ap1 = $data['sub1ap1'];
        $sub2ap1 = $data['sub2ap1'];
        $sub3ap1 = $data['sub3ap1'];
        $sub4ap1 = $data['sub4ap1'];
        $sub5ap1 = $data['sub5ap1'];
        $sub6ap1 = $data['sub6ap1'];
        $sub7ap1 = $data['sub7ap1'];
        $sub8ap1 = $data['sub8ap1'];
        $UrbanRural = $data['UrbanRural'];
        $Inst_cd = $data['Inst_cd'];
        $formno = $data['FormNo'];
        $RegGrp = $data['grp_cd'];
        $query = $this->db->query("Registration..MA_P1_Reg_Adm2016_sp_insert '$formno',9,2016,1,'$name','$fname','$BForm','$FNIC','$Dob','$CellNo',$medium,$Inst_Rno,'$MarkOfIden',                                               $Speciality,$nat,$sex,$rel,'$addr',$grp_cd,$sub1,$sub1ap1,$sub2,$sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,$sub7,$sub7ap1,$sub8,                                      $sub8ap1,1,0,0,0,0,$IsHafiz,$Inst_cd,$UrbanRural,$RegGrp");
        //$query = $this->db->insert('msadmissions2015', $data);//,'Fname' => $father_name,'BForm'=>$bay_form,'FNIC'=>$father_cnic,'Dob'=>$dob,'CellNo'=>$mob_number));
         return true;
    }
    public function Update_NewEnorlement($data)//$father_name,$bay_form,$father_cnic,$dob,$mob_number)  MA_P1_Reg_Adm2016_sp_Update
    {
       //DebugBreak();
        $name = $data['name'];
        $fname = $data['Fname'];
        $BForm = $data['BForm'];
        $FNIC = $data['FNIC'];
        $Dob = $data['Dob'];
        $CellNo = $data['CellNo'];
        $medium = $data['medium'];
        $Inst_Rno = $data['Inst_Rno'];
        $MarkOfIden = $data['MarkOfIden'];
        $Speciality = $data['Speciality'];
        $nat = $data['nat'];
        $sex = $data['sex'];
        $IsHafiz = $data['IsHafiz'];
        $rel = $data['rel'];
        $addr = $data['addr'];
        if(($data['grp_cd'] == 1) or ($data['grp_cd'] == 7) or ($data['grp_cd'] == 8) )
        {
        $grp_cd = 1;    
        }
        else if($data['grp_cd'] == 2 )
        {
        $grp_cd = 2;        
        }
        else if($data['grp_cd'] == 5 )
        {
        $grp_cd = 5;        
        }
        $sub1= $data['sub1'];
        $sub2 = $data['sub2'];
        $sub3 = $data['sub3'];
        $sub4 = $data['sub4'];
        $sub5 = $data['sub5'];
        $sub6 = $data['sub6'];
        $sub7 = $data['sub7'];
        $sub8 = $data['sub8'];
        $sub1ap1 = $data['sub1ap1'];
        $sub2ap1 = $data['sub2ap1'];
        $sub3ap1 = $data['sub3ap1'];
        $sub4ap1 = $data['sub4ap1'];
        $sub5ap1 = $data['sub5ap1'];
        $sub6ap1 = $data['sub6ap1'];
        $sub7ap1 = $data['sub7ap1'];
        $sub8ap1 = $data['sub8ap1'];
        $UrbanRural = $data['UrbanRural'];
        $Inst_cd = $data['Inst_cd'];
        $formno = $data['FormNo'];
        $RegGrp = $data['grp_cd'];
        $query = $this->db->query("Registration..MA_P1_Reg_Adm2016_sp_Update '$formno',9,2016,1,'$name','$fname','$BForm','$FNIC','$Dob','$CellNo',$medium,$Inst_Rno,'$MarkOfIden',                                               $Speciality,$nat,$sex,$rel,'$addr',$grp_cd,$sub1,$sub1ap1,$sub2,$sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,$sub7,$sub7ap1,$sub8,                                      $sub8ap1,1,0,0,0,0,$IsHafiz,$Inst_cd,$UrbanRural,$RegGrp");
        //$query = $this->db->insert('msadmissions2015', $data);//,'Fname' => $father_name,'BForm'=>$bay_form,'FNIC'=>$father_cnic,'Dob'=>$dob,'CellNo'=>$mob_number));
         return true;
    }
         public function EditEnrolement($inst_cd)
    {

        // DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
       $query = $this->db->query("Registration..sp_get_regInfo $inst_cd,9,2016,1");
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
           // $q1 = array('stdinfo'=>$query->result_array()) ;
//            for($i= 0; $i<$rowcount; $i++){
//            $q1['stdinfo'][$i]['sub1'];
//            }
//            $q1['stdinfo']['sub1'];
//            $q2 = $this->db->query("select SUB_ABR from tblsubject_newschm where SUB_CD in (1,2,3,4,5)");
//            $q2 = array('stdinfo_sub'=>$q2->result_array()) ;
//            $query = array('stdinfo_reg'=>$q1,'stdinfo_sub'=>$q2);
            
            
        }
        else
        {
            return  false;
        }
    }
    
         public function EditEnrolement_data($formno)
    {

        // DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
       $query = $this->db->get_where('Registration..MA_P1_Reg_Adm2016',  array('formNo' => $formno,'class'=>9,'iyear'=>2016,'sess'=>1));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }
    
    public function Delete_NewEnrolement($formno)
    {
        $data=array('isDeleted'=>1);
        $this->db->where('formNo',$formno);
        $this->db->update('Registration..MA_P1_Reg_Adm2016',$data);
        return true;
        
    }
    public function GetFormNo($Inst_Id)
    {
       // DebugBreak();
       $this->db->select('formno');
        $this->db->order_by("formno", "DESC");
        $formno = $this->db->get_where('Registration..MA_P1_Reg_Adm2016', array('sch_cd' => $Inst_Id));
        $rowcount = $formno->num_rows();
        
        if($rowcount == 0 )
        {
            $formno =  ($Inst_Id.'0001' );
           return $formno;
        }
        else
        {
             $row  = $formno->result_array();
            $formno = $row[0]['formno']+1;
            return $formno;
        }
        
    }

    public function user_info($User_info_data)
    {
        //DebugBreak();
        $Inst_cd = $User_info_data['Inst_Id'];
        $RegGrp = $User_info_data['RegGrp'];
       // $forms_id = $User_info_data['forms_id'];
         $query = $this->db->get_where('Admission_online..tblinstitutes_all',  array('Inst_cd' => $Inst_cd));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            
                   $q1         = $this->db->get_where('Registration..MA_P1_Reg_Adm2016',array('Sch_cd'=>$Inst_cd,'IsDeleted'=>0,'Batch_ID'=>0,'RegGrp'=>$RegGrp));
                   $result_1 ;
                   $nrowcount = $q1->num_rows();
                   if($nrowcount > 0)
                   {
                       $result_1 = $q1->result_array();
                   }
                   else{
                       return false;
                   }
                   $q2         = $this->db->get_where('Registration..RuleFee_Reg_Nineth',array('Rule_Fee_ID'=>1));
                   $resultarr = array("info"=>$query->result_array(),"fee"=>$result_1,"rule_fee"=>$q2->result_array());
                 return  $resultarr;
        }
        else
        {
            return  false;
        }
    }
      public function user_info_Formwise($User_info_data)
    {
        //DebugBreak();
        $Inst_cd = $User_info_data['Inst_Id'];
        $forms_id = $User_info_data['forms_id'];
         $query = $this->db->get_where('Admission_online..tblinstitutes_all',  array('Inst_cd' => $Inst_cd));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            
                   $q1         = $this->db->query("select * from Registration..MA_P1_Reg_Adm2016 where Sch_cd =$Inst_cd and isdeleted = 0 and  formNo in($forms_id)");
                   // $this->db->from('Registration..MA_P1_Reg_Adm2016');
                    //$this->db->where(array('Sch_cd'=>$Inst_cd,'IsDeleted'=>0,'Batch_ID'=>0));
                   // $this->db->where_in('formNo',$forms_id);
                   

                   //$q1         = $this->db->where_in('Registration..MA_P1_Reg_Adm2016',array('Sch_cd'=>$Inst_cd,'IsDeleted'=>0,'Batch_ID'=>0,'formno'=>$forms_id));
                   //$q1 = $this->db->get();
                   //$result_1 = $q1->result_array();
                   $nrowcount = $q1->num_rows();
                   if($nrowcount > 0)
                   {
                       $result_1 = $q1->result_array();
                   }
                   $q2         = $this->db->get_where('Registration..RuleFee_Reg_Nineth',array('Rule_Fee_ID'=>1));
                   $resultarr = array("info"=>$query->result_array(),"fee"=>$result_1,"rule_fee"=>$q2->result_array());
                 return  $resultarr;
        }
        else
        {
            return  false;
        }
    }
    public function getreulefee($ruleID)
    {
        $q2         = $this->db->get_where('Registration..RuleFee_Reg_Nineth',array('Rule_Fee_ID'=>$ruleID));
        $resultarr = $q2->result_array();
    }
    public function Batch_Insertion($data){
       // DebugBreak();
        
        $inst_cd = $data['inst_cd'];
        $total_fee = $data['total_fee'];
        $processing_fee = $data['proces_fee'];
        $reg_fee = $data['reg_fee'];
        $TotalRegFee = $data['TotalRegFee'];
        $TotalLatefee = $data['TotalLatefee'];
        $Totalprocessing_fee = $data['Totalprocessing_fee'];
        $forms_id = $data['forms_id'];
        $todaydate = $data['todaydate'];
        $total_std = $data['total_std'];
//        EXEC Batch_Create @Inst_Cd = ".$user->inst_cd.",@UserId = ".$user->get_currentUser_ID()."@Amount = ".$tot_fee.",@Total_ProcessingFee = ".$prs_fee.",@Total_RegistrationFee = ".$reg_fee.",@Total_LateRegistrationFee =".$late_fee.",@Total_LateAdmissionFee = 0,@Valid_Date = '$today',@form_ids = '$forms_id'"
         $query = $this->db->query("Registration..Batch_Create_9th_2016 $inst_cd,$reg_fee,$processing_fee,$total_std,$total_fee,$TotalRegFee,$Totalprocessing_fee,$TotalLatefee,'$todaydate','$forms_id'");
    }
    public function Batch_List($data)
    {
        //DebugBreak();
          $inst_cd = $data['Inst_Id'];
          $q2         = $this->db->get_where('Registration..fl_reg_batch_test',array('Inst_Cd'=>$inst_cd));
          $result = $q2->result_array();
          return $result;
    }
    public function return_pdf($fetch_data)
    {
       // DebugBreak();
        $Inst_cd = $fetch_data['Inst_cd'];
        $Batch_Id = $fetch_data['Batch_Id'];
        $query = $this->db->query("Registration..sp_get_reg_return_formInfo $Inst_cd,$Batch_Id");
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }
    public function Print_Form_Groupwise($fetch_data){
         $Inst_cd = $fetch_data['Inst_cd'];
        $Grp_cd = $fetch_data['grp_cd'];
        $query = $this->db->query("Registration..sp_get_reg_Print_Form $Inst_cd,$Grp_cd");
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }
        public function Print_Form_Formnowise($fetch_data){
          //  debugbreak();
         $Inst_cd = $fetch_data['Inst_cd'];
         $start_formno = $fetch_data['start_formno'];
         $end_formno = $fetch_data['end_formno'];
        $query = $this->db->query("Registration..sp_get_reg_Print_Form_formnowise $Inst_cd,'$start_formno','$end_formno'");
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }
    
        public function revenue_pdf($fetch_data)
    {
        //DebugBreak();
        
        $Inst_cd = $fetch_data['Inst_cd'];
        $Batch_Id = $fetch_data['Batch_Id'];
        
           $this->db->select('name, Fname, IsReAdm,regFee,RegProcessFee');
           $this->db->from('Registration..MA_P1_Reg_Adm2016');
           $this->db->where(array('Sch_cd' => $Inst_cd,'Batch_ID'=>$Batch_Id));
           $result_1 = $this->db->get()->result();
        //$query = $this->db->get_where('Registration..MA_P1_Reg_Adm2016',  array('Sch_cd' => $Inst_cd,'Batch_ID'=>$Batch_Id));
        //$rowcount = $query->num_rows();
        //if($rowcount > 0)
        //{
            //$q = $query->result_array();
            $query_1 = $this->db->get_where('Registration..fl_reg_batch_test',  array('Inst_Cd' => $Inst_cd,'Batch_ID'=>$Batch_Id));
            $rowcount = $query_1->num_rows();
            if($rowcount > 0){
           $query_1 = $query_1->result_array();
            
            return $result = array('stdinfo'=>$result_1, 'batch_info'=>$query_1);    
          //  }
            
        }
        else
        {
            return  false;
        }
    }

}
?>
