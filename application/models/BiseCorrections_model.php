<?php
class BiseCorrections_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get9thObjectionStdData(){
        
        $table1= 'Registration..maP1blockrnobranch';
        $table2= 'matric_new..tblbiodata';
        $this->db->select("$table2.rno,$table2.name,$table2.formno,$table2.dob,$table2.fname");
        $this->db->from($table2);
        //join LEFT by default
        $this->db->join($table1, "$table1.rno=$table2.rno AND $table1.class=$table2.class AND $table1.iyear=$table2.iyear  AND $table1.sess=$table2.sess");
        $this->db->where($table2.'.class = 9 and '.$table2.'.iyear=2016 and '.$table2.'.sess=1 AND '.$table1.'.isactive=1');
        $query = $this->db->get();
        $rowcount = $this->db->count_all_results();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  0;
        }
    }
      public function updateslipData($rno,$kpo){

       $data2 = array(
           'isactive'=>0,
           'kpo'=>$kpo,
           'modified_date'=>date('Y-m-d H:i:s'),
       );
       $this->db->where('rno',$rno);
       $this->db->update("Registration..maP1blockrnobranch", $data2);
    }
    
   
}
?>
