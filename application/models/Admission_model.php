<?php
  class Admission_model extends CI_Model 
  {
      public function __construct()    {
     
        $this->load->database(); 
    }
    
	public function countStudents($inst_cd){
		// "SELECT count(*) as total FROM fl_reg_form where  Inst_Cd = '".$inst_code."'"
		$query = $this->db->get_where('Admission_Online..adm_reg_ma2016', array('sch_cd' => $inst_cd));
		$rowcount = $query->num_rows();
		return $rowcount;
	}
	
	public function insertRecord($data){
		// insert new data in adm_reg_ma2016
		$query = $this->db->insert("Admission_Online..adm_reg_ma2016", $data);
		$data2 = array('isSubmit'=>1);
		$this->db->where('rno',$data['rno']);
		$this->db->update("fl_dataforMa15", $data2);
	}
	
	public function deleteRecord($rno,$inst_cd){
		// insert new data in adm_reg_ma2016
		//$data = array('isDeleted'=>true);
		$this->db->set('isDeleted',true);
		$this->db->where(array('rno'=>$rno,'sch_cd'=>$inst_cd));
		$this->db->update("Admission_Online..adm_reg_ma2016");
		$data = array('isSubmit'=>0);
		$this->db->where('rno',$rno);
		$this->db->update("fl_dataforMa15", $data);
	}
	
	
    public function getStudentsData($inst_cd){
		//SELECT * FROM  fl_dataforMa15 WHERE  (isSubmit is null or isSubmit= 0) and class = 9 and iyear = 2014 and sch_cd = ".$user->inst_cd
		$query = $this->db->get_where('fl_dataforMa15', array('sch_cd' => $inst_cd,'class' => 9, 'iyear' => 2014, 'isSubmit'=>0));
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

    public function getAdmissionData($rno, $inst_cd){
		//SELECT * FROM  fl_dataforMa15 WHERE  (isSubmit is null or isSubmit= 0) and class = 9 and iyear = 2014 and sch_cd = ".$user->inst_cd
		$query = $this->db->get_where('fl_dataforMa15', array('rno' => $rno, 'sch_cd' => $inst_cd,'class' => 9, 'iyear' => 2014, 'isSubmit'=>0));
		$rowcount = $query->num_rows();
		if($rowcount > 0)
		{
			return $query->row_array();
		}
		else
		{
		   return  false;
		}
	}
    public function getEditFormsList($inst_cd){
		//SELECT * FROM  fl_dataforMa15 WHERE  (isSubmit is null or isSubmit= 0) and class = 9 and iyear = 2014 and sch_cd = ".$user->inst_cd
		$query = $this->db->get_where('Admission_Online..adm_reg_ma2016', array('sch_cd' => $inst_cd,'class' => 9, 'iyear' => 2014, 'isDeleted'=>false));
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

	function GetMSubName($_sub_cd) 
	{
		$ret_val = "";
		if($_sub_cd == 1)  $ret_val = "URDU";
		else if($_sub_cd == 2)  $ret_val = "ENGLISH";
		else if($_sub_cd == 3)  $ret_val = "ISLAMIYAT (COMPULSORY)";
		else if($_sub_cd == 4)  $ret_val = "PAKISTAN STUDIES";
		else if($_sub_cd == 5)  $ret_val = "MATHEMATICS";
		else if($_sub_cd == 6)  $ret_val = "PHYSICS";
		else if($_sub_cd == 7)  $ret_val = "CHEMISTRY";
		else if($_sub_cd == 8)  $ret_val = "BIOLOGY";
		else if($_sub_cd == 9)  $ret_val = "GENERAL SCIENCE";
		else if($_sub_cd == 11)  $ret_val = "GEOGRAPHY OF PAKISTAN";
		else if($_sub_cd == 18)  $ret_val = "ART/ART & MODEL DRAWING";
		else if($_sub_cd == 22)  $ret_val = "ARABIC";
		else if($_sub_cd == 23)  $ret_val = "PERSIAN";
		else if($_sub_cd == 36)  $ret_val = "PUNJABI";
		else if($_sub_cd == 20)  $ret_val = "ISLAMIC HISTORY";
		else if($_sub_cd == 21)  $ret_val = "HISTORY OF PAKISTAN/ HISTORY OF INDO PAK";
		else if($_sub_cd == 78)  $ret_val = "COMPUTER SCIENCE";
		else if($_sub_cd == 12)  $ret_val = "HOUSE HOLD ACCOUNTS & ITS RELATED PROBLEMS";
		else if($_sub_cd == 13)  $ret_val = "ELEMENTS OF HOME ECONOMICS";
		else if($_sub_cd == 14)  $ret_val = "PHYSIOLOGY & HYGIENE";
		else if($_sub_cd == 15)  $ret_val = "GEOMETRICAL & TECHNICAL DRAWING";
		else if($_sub_cd == 16)  $ret_val = "GEOLOGY";
		else if($_sub_cd == 17)  $ret_val = "ASTRONOMY & SPACE SCIENCE";
		else if($_sub_cd == 19)  $ret_val = "ISLAMIC STUDIES";
		else if($_sub_cd == 27)  $ret_val = "FOOD AND NUTRITION";
		else if($_sub_cd == 28)  $ret_val = "ART IN HOME ECONOMICS";
		else if($_sub_cd == 29)  $ret_val = "MANAGEMENT FOR BETTER HOME";
		else if($_sub_cd == 30)  $ret_val = "CLOTHING & TEXTILES";
		else if($_sub_cd == 31)  $ret_val = "CHILD DEVELOPMENT AND FAMILY LIVING";
		else if($_sub_cd == 32)  $ret_val = "MILITARY SCIENCE";
		else if($_sub_cd == 33)  $ret_val = "COMMERCIAL GEOGRAPHY";
		else if($_sub_cd == 34)  $ret_val = "URDU LITERATURE";
		else if($_sub_cd == 35)  $ret_val = "ENGLISH LITERATURE";
		else if($_sub_cd == 37)  $ret_val = "EDUCATION";
		else if($_sub_cd == 38)  $ret_val = "ELEMENTARY NURSING & FIRST AID";
		else if($_sub_cd == 39)  $ret_val = "PHOTOGRAPHY";
		else if($_sub_cd == 40)  $ret_val = "HEALTH & PHYSICAL EDUCATION";
		else if($_sub_cd == 41)  $ret_val = "CALIGRAPHY";
		else if($_sub_cd == 42)  $ret_val = "LOCAL (COMMUNITY) CRAFTS";
		else if($_sub_cd == 43)  $ret_val = "ELECTRICAL WIRING";
		else if($_sub_cd == 44)  $ret_val = "RADIO ELECTRONICS";
		else if($_sub_cd == 45)  $ret_val = "COMMERCE";
		else if($_sub_cd == 46)  $ret_val = "AGRICULTURE";
		else if($_sub_cd == 53)  $ret_val = "ANIMAL PRODUCTION";
		else if($_sub_cd == 54)  $ret_val = "PRODUCTIVE INSECTS AND FISH CULTURE";
		else if($_sub_cd == 55)  $ret_val = "HORTICULTURE";
		else if($_sub_cd == 56)  $ret_val = "PRINCIPLES OF HOME ECONOMICS";
		else if($_sub_cd == 57)  $ret_val = "RELATED ACT";
		else if($_sub_cd == 58)  $ret_val = "HAND AND MACHINE EMBROIDERY";
		else if($_sub_cd == 59)  $ret_val = "DRAFTING AND GARMENT MAKING";
		else if($_sub_cd == 60)  $ret_val = "HAND & MACHINE KNITTING & CROCHEING";
		else if($_sub_cd == 61)  $ret_val = "STUFFED TOYS AND DOLL MAKING";
		else if($_sub_cd == 62)  $ret_val = "CONFECTIONERY AND BAKERY";
		else if($_sub_cd == 63)  $ret_val = "PRESERVATION OF FRUITS,VEGETABLES & OTHER FOODS";
		else if($_sub_cd == 64)  $ret_val = "CARE AND GUIDENCE OF CHILDREN";
		else if($_sub_cd == 65)  $ret_val = "FARM HOUSE HOLD MANAGEMENT";
		else if($_sub_cd == 66)  $ret_val = "ARITHEMATIC";
		else if($_sub_cd == 67)  $ret_val = "BAKERY";
		else if($_sub_cd == 68)  $ret_val = "CARPET MAKING";
		else if($_sub_cd == 69)  $ret_val = "DRAWING";
		else if($_sub_cd == 70)  $ret_val = "EMBORIDERY";
		else if($_sub_cd == 71)  $ret_val = "HISTORY";
		else if($_sub_cd == 72)  $ret_val = "TAILORING";
		else if($_sub_cd == 24)  $ret_val = "GEOGRAPHY";
		else if($_sub_cd == 25)  $ret_val = "ECONOMICS";
		else if($_sub_cd == 26)  $ret_val = "CIVICS";
		else if($_sub_cd == 47)  $ret_val = "BOOK KEEPING & ACCOUNTANCY";
		else if($_sub_cd == 48)  $ret_val = "WOOD WORK (FURNITURE MAKING)";
		else if($_sub_cd == 49)  $ret_val = "GENERAL AGRICULTURE";
		else if($_sub_cd == 50)  $ret_val = "FARM ECONOMICS";
		else if($_sub_cd == 52)  $ret_val = "LIVE STOCK FARMING";
		else if($_sub_cd == 73)  $ret_val = "TYPE WRITING";
		else if($_sub_cd == 74)  $ret_val = "WEAVING";
		else if($_sub_cd == 75)  $ret_val = "SECRETARIAL PRACTICE";
		else if($_sub_cd == 76)  $ret_val = "CANDLE MAKING";
		else if($_sub_cd == 77)  $ret_val = "SECRETARIAL PRACTICE AND CORRESPONDANCE";
		else if($_sub_cd == 10)  $ret_val = "FOUNDATION OF EDUCATION";
		else if($_sub_cd == 51)  $ret_val = "ETHICS";
		else if($_sub_cd == 79)  $ret_val = "WOOD WORK (BOAT MAKING)";
		else if($_sub_cd == 80)  $ret_val = "PRINCIPLES OF ARITHMATIC";
		else if($_sub_cd == 81)  $ret_val = "SEERAT-E-RASOOL";
		else if($_sub_cd == 82)  $ret_val = "AL-QURAAN";
		else if($_sub_cd == 83)  $ret_val = "POULTRY FARMING";
		else if($_sub_cd == 84)  $ret_val = "ART & MODEL DRAWING";
		else if($_sub_cd == 85)  $ret_val = "BUSINESS STUDIES";
		else if($_sub_cd == 86)  $ret_val = "HADEES & FIQAH";
		else if($_sub_cd == 87)  $ret_val = "ENVIRONMENTAL STUDIES";
		else if($_sub_cd == 88)  $ret_val = "REFRIGERATION AND AIR CONDITIONING";
		else if($_sub_cd == 89)  $ret_val = "FISH FARMING";
		else if($_sub_cd == 90)  $ret_val = "COMPUTER HARDWARE";
		else if($_sub_cd == 91)  $ret_val = "BEAUTICIAN";
		else if($_sub_cd == 92)  $ret_val = "General Math";    
		return $ret_val ;             
	}
	
	public function getSelected($row, $status)
	{
		if ($row == $status) {
			return 'selected="selected"';
		}
	}
	
	public function getSubjects($rno, $inst_cd){
		//SELECT * FROM ".DB_PREFIX."dataforMa15 WHERE class= 9 and iYear = 2014 and rno = $rno and sch_cd= ".$user->inst_cd
		$query = $this->db->get_where('fl_dataforMa15', array('rno' => $rno, 'sch_cd' => $inst_cd,'class' => 9, 'iyear' => 2014));
		
		
		//exit(print_r($query->result_array()));
		$rr = $query->result_array()[0];
		
		$examtype = $rr['exam_type'];
		$grp_cd = $rr['grp_cd'];
		$catp1 = $rr['catp1'];
		$catp2 = $rr['catp2'];
		$is_pakistani = $rr['nat'];
		
		
		if($examtype ==5 || $examtype ==2) 
		{
			if( !($catp1==4 or $catp2==4)) 
			{
				$result = '<div class="control-group"><div class="controls controls-row"><table width="100%">';	
				//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ sub1__ 1st Row
					$result .= ' <tr>
									<td colspan="2">
									   <select id="sub1p1"  class="dropdown span12" name="sub1p1">';
									   
											if($rr["sub1pf1"]== 1)
											{
											 $result  .= '<option value="0">NONE</option>';
											}
											else
											{
											 $result  .= '<option value="'.$rr["sub1"].'" ' . $this->getSelected($rr["sub1"],$rr["sub1"]).'>'.$this->GetMSubName( $rr["sub1"]).'</option>';	
											  if($rr["sub1st1"]!= 2)
											 $result  .= '<option value="0">NONE</option>';
											  
											}											
					$result .= ' 	</select>	</td>
					
									<td colspan="2">
									   <select id="sub1p2"  class="dropdown span8" name="sub1p2">';
											 $result  .= '<option value="'.$rr["sub1"].'" '.$this->getSelected($rr["sub1"],$rr["sub1"]).'>'.$this->GetMSubName( $rr["sub1"]).'</option>';										   
					$result .= ' 	   </select>					   
									</td>
									</tr>';
				//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ sub2__  2nd Row	
				   $result .= '	<tr>
									<td colspan="2">
									   <select id="sub2p1"  class="dropdown span12" name="sub2p1">';
											if($rr["sub2pf1"]== 1)
											{
											$result  .= '<option value="0">NONE</option>';
											}
											else
											{
											  $result  .= '<option value="'.$rr["sub2"].'" '.$this->getSelected($rr["sub2"],$rr["sub2"]).'>'.$this->GetMSubName( $rr["sub2"]).'</option>';	
											 if($rr["sub2st1"]!= 2)
												$result  .= '<option value="0">NONE</option>';	
											}
					$result .= '</select>					   
									</td>
									<td colspan="2">
									   <select id="sub2p2"  class="dropdown span8" name="sub2p2">
											<option value="'.$rr["sub2"].'" '.$this->getSelected($rr["sub2"],$rr["sub2"]).'>'.$this->GetMSubName( $rr["sub2"]).'</option>
									   </select>					   
									</td>
								</tr>';
				//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ sub3__  3rd Row
				   $result .= '<tr>
									<td colspan="2">
									   <select id="sub3p1"  class="dropdown span12" name="sub3p1">';
									   if($rr["sub3pf1"]== 1)
											{
											$result  .= '<option value="0">NONE</option>';
											}
									   else
										   {
											  $result  .= '<option value="'.$rr["sub3"].'" '.$this->getSelected($rr["sub3"],$rr["sub3"]).'>'.$this->GetMSubName( $rr["sub3"]).'</option>';	
												if($rr["sub3st1"]!= 2)
												$result  .= '<option value="0">NONE</option>';	
										   }
				
					$result .= '	</select>					   
											</td>
											<td colspan="2">
											  <select id="sub3p2"  class="dropdown span8" name="sub3p2">
											  <option value="'.$rr["sub3"].'" '.$this->getSelected($rr["sub3"],$rr["sub3"]).'>'.$this->GetMSubName( $rr["sub3"]).'</option>
											  </select>					   
											</td>
											</tr>';
				//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ sub8__   8th Row
				   $result .= '<tr>
									 <td colspan="2">
										<select id="sub8p1"  class="dropdown span12" name="sub8p1">';
											if($rr["sub8pf1"]== 1)
											{
											$result  .= '<option value="0">NONE</option>';
											}
											else
											{
											 $result  .= '<option value="'.$rr["sub8"].'" '.$this->getSelected($rr["sub8"],$rr["sub8"]).'>'.$this->GetMSubName( $rr["sub8"]).'</option>';												 
											 if($rr["sub8st1"]!= 2)
											 $result  .= '<option value="0">NONE</option>';	
											}
					$result .= '</select>
									</td>
									<td colspan="2">
									   <select id="sub8p2"  class="dropdown span8" name="sub8p2">
											<option value="'.$rr["sub8"].'" '.$this->getSelected($rr["sub8"],$rr["sub8"]).'>'.$this->GetMSubName( $rr["sub8"]).'</option>
									   </select>					   
									</td>
								</tr>';							
				//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ sub4__  4th Row 
				   $result .= '<tr>
									 <td colspan="2">
										<select id="sub4p1"  class="dropdown span12" name="sub4p1">';
											if($rr["sub4pf1"]== 1)
											{
											$result  .= '<option value="0">NONE</option>';
											}
											else
											{
											 $result  .= '<option value="'.$rr["sub4"].'" '.$this->getSelected($rr["sub4"],$rr["sub4"]).'>'.$this->GetMSubName( $rr["sub4"]).'</option>';												 
											 if($rr["sub4st1"]!= 2)
											 $result  .= '<option value="0">NONE</option>';	
											}
					$result .= '</select>
									</td>
									<td colspan="2">
									   <select id="sub4p2"  class="dropdown span8" name="sub4p2">
											<option value="'.$rr["sub4"].'" '.$this->getSelected($rr["sub4"],$rr["sub4"]).'>'.$this->GetMSubName( $rr["sub4"]).'</option>
									   </select>					   
									</td>
								</tr>';
				//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ sub5__   5th Row 
				   $result .= '<tr>
									 <td colspan="2">
									  <select id="sub5p1"  class="dropdown span12" name="sub5p1">';
											if($rr["sub5pf1"]== 1)
											{
											$result  .= '<option value="0">NONE</option>';
											}
											else
											{
											 $result  .= '<option value="'.$rr["sub5"].'" '.$this->getSelected($rr["sub5"],$rr["sub5"]).'>'.$this->GetMSubName( $rr["sub5"]).'</option>';												 
											 if($rr["sub5st1"]!= 2)
											 $result  .= '<option value="0">NONE</option>';	
											} 
					$result .= '</select>					   
									</td>
									 <td colspan="2">
									   <select id="sub5p2"  class="dropdown span8" name="sub5p2">
											<option value="'.$rr["sub5"].'" '.$this->getSelected($rr["sub5"],$rr["sub5"]).'>'.$this->GetMSubName( $rr["sub5"]).'</option>
									   </select>					   
									</td>
									</tr>'; 
									
				//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ sub6__   6th Row 
				   $result .= '<tr>
									<td colspan="2">
									   <select id="sub6p1"  class="dropdown span12" name="sub6p1">';
											if($rr["sub6pf1"]== 1)
											{
											$result  .= '<option value="0">NONE</option>';
											}
											else
											{
											 $result  .= '<option value="'.$rr["sub6"].'" '.$this->getSelected($rr["sub6"],$rr["sub6"]).'>'.$this->GetMSubName( $rr["sub6"]).'</option>';	
											 if($rr["sub6st1"]!= 2)
											 $result  .= '<option value="0">NONE</option>';	
											}
					$result .= '</select>							   
									</td>
									<td colspan="2">
									   <select id="sub6p2"  class="dropdown span8" name="sub6p2">
											<option value="'.$rr["sub6"].'" '.$this->getSelected($rr["sub6"],$rr["sub6"]).'>'.$this->GetMSubName( $rr["sub6"]).'</option>
									   </select>					   
									</td>
								</tr>';
				//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ sub7__   7th Row 
					$result .= '<tr>
									<td colspan="2">
									  <select id="sub7p1"  class="dropdown span12" name="sub7p1">';
											if($rr["sub7pf1"]== 1)
											{
											$result  .= '<option value="0">NONE</option>';
											}
											else
											{
											 $result  .= '<option value="'.$rr["sub7"].'" '.$this->getSelected($rr["sub7"],$rr["sub7"]).'>'.$this->GetMSubName( $rr["sub7"]).'</option>';	
											  if($rr["sub7st1"]!= 2)
											 $result  .= '<option value="0">NONE</option>';	
											}
					$result .= '</select>						   
									</td>
									<td colspan="2">
									   <select id="sub7p2"  class="dropdown span8" name="sub7p2">
									   <option value="'.$rr["sub7"].'" '.$this->getSelected($rr["sub7"],$rr["sub7"]).'>'.$this->GetMSubName( $rr["sub7"]).'</option>
									   </select>					   
									</td>
								</tr>';
				//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ End of Subjects Table 								
					   $result .= '</table></div></div>';
			  }
			//========================== for AAMA KHASA 
		} elseif ($examtype ==8)
		$result='<h1>Appeared in Next Session with Rno-Sess-Year=> '.$rr['nextRno1'].'-'. ($rr['nextSess1']==1?'An':'Sup').'-'.$rr['nextYear1']. '</h1>';
			//================== End AAMA khasa
		return $result;	
	}
}
?>
