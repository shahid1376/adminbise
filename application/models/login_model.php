<?php
class Login_model extends CI_Model {
    public function __construct() {
        $this->load->database(); 
    }
    public function auth($username,$password) 
    {
       // DebugBreak();
        //$query = $this->db->get_where('Admission_online..tblInstitutes_all', array('Inst_cd' => $username,'Inst_pwd' => $password));
		$query = $this->db->get_where('Admission_online..tblInstitutes_all', array('Inst_cd' => $username,'Inst_pwd' => $password));
		$rowcount = $query->num_rows();
		if($rowcount >0)
		{
			 return $query->row_array();
		}
		else
		{
		   return  false;; 
		}
    }
      public function biseauth($username,$password) 
    {
       // DebugBreak();
        //$query = $this->db->get_where('Admission_online..tblInstitutes_all', array('Inst_cd' => $username,'Inst_pwd' => $password));
        $query = $this->db->get_where('Admission_online..tblInstitutes_all', array('Inst_cd' => $username,'Inst_pwd' => $password));
        $rowcount = $query->num_rows();
        if($rowcount >0)
        {
             return $query->row_array();
        }
        else
        {
           return  false;; 
        }
    }
}
?>
