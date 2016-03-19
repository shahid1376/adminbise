<?php
class RollNoSlip_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function get9thStdData($inst_cd){
        //DebugBreak();
        //  $query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 9, 'iyear' => 2016, 'regpvt'=>1,));
        $query = $this->db->query("Registration..get9thStdData $inst_cd,2016,9,1,1");
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
    public function get10thStdData($inst_cd){

        //  DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $query = $this->db->query("Registration..get10thStdData $inst_cd,2016,10,1,1");
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  0;
        }
    }
    
    public function get10thStdDataDeaf($inst_cd){

        //  DebugBreak();
        $query = $this->db->get_where('matric_new..tblbiodata_DFD', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        //$query = $this->db->query("Registration..get10thStdData $inst_cd,2016,10,1,1");
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  0;
        }
    }
    
     public function get9thStdDataDeaf($inst_cd){

        //  DebugBreak();
        $query = $this->db->get_where('matric_new..tblbiodata_DFD', array('sch_cd' => $inst_cd,'class' => 9, 'iyear' => 2016, 'regpvt'=>1,));
        //$query = $this->db->query("Registration..get10thStdData $inst_cd,2016,10,1,1");
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  0;
        }
    }

    public function get10thrslipDataDeaf($rno,$class,$iyear,$sess){

        // DebugBreak();
        $query = $this->db->query("Registration..MatricSlipInfo_DEAF $rno,$class,$iyear,$sess");
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $this->db->order_by("Datesort", "ASC");
          //  $query = $this->db->query("select * from Registration..maDatesheet2016 where rno in( (select rno from Registration..maDatesheet2016  where rno=$rno))"); 
             $query = $this->db->query("Registration..MatricSlips_Deaf $rno,$class,$iyear,$sess");
            $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  false;
        }
    }
    public function get9ththrslipDataDeaf($rno,$class,$iyear,$sess){

        // DebugBreak();
        $query = $this->db->query("Registration..MatricSlipInfoP1_DEAF $rno,$class,$iyear,$sess");
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $this->db->order_by("Datesort", "ASC");
          //  $query = $this->db->query("select * from Registration..maDatesheet2016 where rno in( (select rno from Registration..maDatesheet2016  where rno=$rno))"); 
             $query = $this->db->query("Registration..MatricSlips9th_DEAF $rno,$class,$iyear,$sess,1");
            $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  false;
        }
    }
    public function get10thrslip($rno,$class,$iyear,$sess){

        // DebugBreak();
        $query = $this->db->query("Registration..MatricSlipInfo $rno,$class,$iyear,$sess");
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $this->db->order_by("Datesort", "ASC");
          //  $query = $this->db->query("select * from Registration..maDatesheet2016 where rno in( (select rno from Registration..maDatesheet2016  where rno=$rno))"); 
             $query = $this->db->query("Registration..MatricSlips $rno,$class,$iyear,$sess");
            $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  false;
        }
    }
    public function get10datesheetonly($rno,$class,$iyear,$sess)
    {
        $this->db->order_by("Datesort", "ASC");
        //  $query = $this->db->query("select * from Registration..maDatesheet2016 where rno in( (select rno from Registration..maDatesheet2016  where rno=$rno))"); 
        $query = $this->db->query("Registration..MatricSlips $rno,$class,$iyear,$sess");
        $row = $query->result_array();
        return $row;
    }
    public function get9thrslip($rno,$class,$iyear,$sess){

        $query = $this->db->query("Registration..MatricSlipInfoP1 $rno,$class,$iyear,$sess");
       
        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $query = $this->db->query("select * from Registration..maP1Datesheet2016 where rno in( (select rno from Registration..maP1Datesheet2016  where rno=$rno))"); 
            $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  false;
        }
    }

    public function get10thrslipWith_Grp_CD($class,$iyear,$sess,$group_cd,$inst_cd,$sub_cd){
        if($sub_cd == '')
            $sub_cd = -1;
        $query = $this->db->query("Registration..MatricSlipInfo_With_Grp_cd $class,$iyear,$sess,$group_cd,$inst_cd,$sub_cd");
        $rowcount = $query->num_rows();
        $row = array();
        $grpwiserow = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $this->db->order_by("Datesort", "ASC");
            if($sub_cd >0)
            {
                $query1 = $this->db->query("select * from Registration..maDatesheet2016 where rno in( (select rno from Registration..maDatesheet2016  where grp_cd = $group_cd and sub_cd = $sub_cd and sch_cd = $inst_cd))");  
                // $query1 = $this->db->get_where('Registration..maDatesheet2016', array('sch_cd' => $inst_cd,'grp_cd'=>$group_cd,'sub_cd'=>$sub_cd)); 
            }
            else
            {
                $query1 = $this->db->get_where('Registration..maDatesheet2016', array('sch_cd' => $inst_cd,'grp_cd'=>$group_cd)); 
            }
            $row['slip'] = $query1->result_array(); 
            return $row;
        }
        else
        {
            return  false;
        }
    }

    public function get9thrslipWith_Grp_CD($class,$iyear,$sess,$group_cd,$inst_cd,$sub_cd){
      if($sub_cd == '')
            $sub_cd = -1;
        $query = $this->db->query("Registration..MatricSlipInfoWithGrp_cdP1 $class,$iyear,$sess,$group_cd,$inst_cd,$sub_cd");
        $rowcount = $query->num_rows();
        $row = array();
        $grpwiserow = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $this->db->order_by("Datesort", "ASC");
           /// $query1 = $this->db->query("select * from maP1Datesheet2016 where rno in( (select distinct rno from maP1Datesheet2016 a where grp_cd = $group_cd and sub_cd = $sub_cd and sch_cd = $inst_cd))");
            if($sub_cd >0)
            {
                $query1 = $this->db->query("select * from Registration..maP1Datesheet2016 where rno in( (select rno from Registration..maP1Datesheet2016  where grp_cd = $group_cd and sub_cd = $sub_cd and sch_cd = $inst_cd))");  
               
            }
            else
            {
                $query1 = $this->db->get_where('Registration..maP1Datesheet2016', array('sch_cd' => $inst_cd,'grp_cd'=>$group_cd)); 
            }
            $row['slip'] = $query1->result_array(); 
            return $row;
        }
        else
        {
            return  false;
        }
    }

    public function getPVT10thrslip($Name,$Fname,$Fnic,$rno,$formno,$class,$iyear,$sess)
    {
        $Name  = empty($Name) ? '' : $Name;
        $Fname  = empty($Fname) ? '' : $Fname;
        $Fnic  = empty($Fnic) ? '' : $Fnic;
        $formno  = empty($formno) ? '' : $formno;
        $rno  = empty($rno) ? 0 : $rno;


        //DebugBreak();
        $query = $this->db->query("Registration..MatricSlipInfopvt '$Name','$Fname','$Fnic','$formno',$rno,$class,$iyear,$sess");
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $rno = $row['info'][0]['Rno'];
            //$query = $this->db->query("Registration..MatricSlipspvt $rno,$class,$iyear,$sess");
            $this->db->order_by("Datesort", "ASC");
            $query = $this->db->query("select * from Registration..maDatesheet2016pvt where rno in( (select rno from Registration..maDatesheet2016pvt  where rno=$rno))"); 
            $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  $rowcount;
        }
    }
    public function getPVT9thrslip($Name,$Fname,$Fnic,$rno,$formno,$class,$iyear,$sess)
    {
        $Name  = empty($Name) ? '' : $Name;
        $Fname  = empty($Fname) ? '' : $Fname;
        $Fnic  = empty($Fnic) ? '' : $Fnic;
        $formno  = empty($formno) ? '' : $formno;
        $rno  = empty($rno) ? 0 : $rno;


        //DebugBreak();
        $query = $this->db->query("Registration..MatricSlipInfopvt '$Name','$Fname','$Fnic','$formno',$rno,$class,$iyear,$sess");
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $rno = $row['info'][0]['Rno'];
            $query = $this->db->query("Registration..MatricSlips9th $rno,$class,$iyear,$sess,2");
            $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  $rowcount;
        }
    }
}
?>
