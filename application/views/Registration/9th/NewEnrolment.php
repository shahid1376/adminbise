<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            New Registration Form<a id="redgForm" data-original-title=""></a>
                        </div>
                       
                    </div>
                    <div class="widget-body">

                        <form class="form-horizontal no-margin" action="<?php echo base_url(); ?>/index.php/Registration/NewEnrolment_insert" method="post" enctype="multipart/form-data">
                       
                            <div class="control-group">
                                <h4 class="span4">Personal Information :</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">
                                    
                                    <label class="control-label span2" >

                                    </label> 
                                    <img id="previewImg" style="width:80px; height: 80px;" class="span2" src="<?php echo base_url(); ?>assets/img/profile.png" alt="Candidate Image">
                                </div>
                            </div>
                            <div class="control-group">
                                
                                 <label id="ErrMsg" class="control-label span2" style=" text-align: left;"><?php  echo $excep; ?></label>
                                <div class="controls controls-row">
                                    <input class="span3 hidden"  type="text" placeholder="" >  
                                    <label class="control-label span2">
                                        Image :  
                                    </label> 
                                    <input type="file" class="span4" id="image" name="image" onchange="Checkfiles()">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Candidate Name :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="cand_name" name="cand_name" placeholder="Candidate Name" value="Ayesha" >
                                    <label class="control-label span2" for="lblfather_name">
                                        Father's Name :
                                    </label> 
                                    <input class="span3" id="father_name" name="father_name" type="text" placeholder="Father's Name" value="Muhammad Aslam" required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Bay Form No :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="bay_form" name="bay_form" placeholder="Bay Form No." value="34101-7928-305-5" required="required">
                                    <label class="control-label span2" for="father_cnic">
                                        Father's CNIC :
                                    </label> 
                                    <input class="span3" id="father_cnic" name="father_cnic" type="text" placeholder="34101-1111111-1" value="34101-1111111-1" required="required">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label span1" >
                                    Date of Birth:(dd-mm-yyyy)
                                </label>

                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="dob" name="dob" placeholder="DOB" value="14-08-1947" required="required" >

                                    <label class="control-label span2" >
                                        Mobile Number :
                                    </label> 
                                    <input class="span3" id="mob_number" name="mob_number" type="text" placeholder="0300-1234567" value="0300-1234567" required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    MEDIUM:
                                </label>
                                <div class="controls controls-row">
                                    <select id="medium" class="dropdown span3" name="medium">
                                        <option value="1" selected="selected">Urdu</option>
                                        <option value="2">English</option>
                                    </select>
                                    <label class="control-label span2" >
                                        Class Roll No :
                                    </label> 
                                    <input class="span3" id="Inst_Rno" type="text" name="Inst_Rno" placeholder="" value="12" required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Mark Of Identification :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="MarkOfIden" name="MarkOfIden" value="Mole on right rand" required="required" >
                                    <label class="control-label span2" >
                                        Speciality:
                                    </label> 
                                    <select id="speciality"  class="span3" name="speciality">
                                        <option value="0">None</option>
                                        <option value="1">Deaf &amp; Dumb</option>
                                        <option value="2">Board Employee</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Nationality :
                                </label>
                                <div class="controls controls-row">  
                                    <label class="radio inline span1">
                                        <input type="radio" value="1" id="nationality" checked="checked" name="nationality"> Pakistani
                                    </label>
                                    <label class="radio inline span2">
                                        <input type="radio"  id="nationality1" value="2" name="nationality">  Non Pakistani 
                                    </label>
                                    <label class="control-label span2" for="gender1">
                                        Gender :
                                    </label> 
                                    <?php
                                   // DebugBreak();
                                       // $gen = 0;
                                       // echo $gender;
                                        if($gender == 1){
                                            echo " <label class='radio inline span1'><input type='radio' id='gender1' value='1' checked='checked' name='gender' disabled='disabled' > Male</label> 
                                            <label class='radio inline span1'><input type='radio' id='gender2' value='2'  checked='checked'  name='gender'  disabled='disabled' > Female </label> 
                                  ";
                                        }
                                        else if ($gender == 2){
                                             echo " <label class='radio inline span1'><input type='radio' id='gender1' value='1' checked='checked' name='gender' disabled='disabled' > Male</label> 
                                                    <label class='radio inline span1'><input type='radio' id='gender2' value='2'  checked='checked'  name='gender' disabled='disabled'> Female </label> ";
                                        }
                                    ?>
                                    <input type="hidden" name="gender" value="<?php echo $gender; ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Hafiz-e-Quran :
                                </label>
                                <div class="controls controls-row">
                                    <label class="radio inline span1">
                                        <input type="radio" id="hafiz1" value="1" checked="checked"   name="hafiz"> No
                                    </label>
                                    <label class="radio inline span1">
                                        <input type="radio" id="hafiz2"  value="2" name="hafiz"> Yes
                                    </label>
                                    <label class="control-label span3" >
                                        Religion :
                                    </label> 
                                    <label class="radio inline span1">
                                        <input type="radio" id="religion" class="rel_class" value="1" checked="checked" name="religion"> Muslim
                                    </label>
                                    <label class="radio inline span1">
                                        <input type="radio" id="religion1" class="rel_class" value="2" name="religion"> Non Muslim
                                    </label>
                                </div>
                            </div>
                            <div class="control-group">
                             <label class="control-label span1" >
                                    Residency :
                                </label>
                                <div class="controls controls-row">  
                              <label class="radio inline span1">
                                        <input type="radio" value="1" id="UrbanRural" checked="checked" name="UrbanRural"> Urban
                                    </label>
                                    <label class="radio inline span2">
                                        <input type="radio"  id="UrbanRural" value="2" name="UrbanRural">  Rural 
                                    </label>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Address :
                                </label>
                                <div class="controls controls-row">
                                    <textarea style="height:150px;" id="address" class="span8" name="address" required="required">G.T Road Gujranwala</textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="control-group">
                                <h4 class="span4">Exam Information :</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">
                                    <label class="control-label span2">

                                    </label> 

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Study Group :
                                </label>
                                <div class="controls controls-row">
                                    <select id="std_group" class="dropdown span6"  name="std_group">
                                        <option value="0">SELECT GROUP</option>
                                        <option value="1">SCIENCE WITH BIOLOGY</option>
                                        <option value="7">SCIENCE  WITH COMPUTER SCIENCE</option>
                                        <option value="8">SCIENCE  WITH ELECTRICAL WIRING</option>
                                        <option value="2">HUMANTIES</option>
                                        <option value="5">DEAF AND DUMB</option>
                                    </select>                                            

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span4" >
                                    <b>Choose Subjects(Elective Subjects are Enabled Only)</b>   
                                </label>
                                <div class="controls controls-row">
                                    <label class="control-label span8" >
                                    </label> 
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub1" class="span3 dropdown" name="sub1"><option value="1">Urdu</option></select> 
                                    <select id="sub2"  name="sub2" class="span3 dropdown">
                                        <option value="2">English</option></select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub3" class="span3 dropdown" name="sub3"><option value="3">Islamyat Compulsory</option></select> 
                                    <select id="sub4"  name="sub4" class="span3 dropdown">
                                        <option value="4">Pakistan Studies</option></select>
                                </div>
                            </div>    <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub5" class="span3 dropdown" name="sub5"></select> 
                                    <select id="sub6"  name="sub6" class="span3 dropdown">
                                    </select>
                                </div>
                            </div>    <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub7" class="span3 dropdown" name="sub7"></select> 
                                    <select id="sub8"  name="sub8" class="span3 dropdown">
                                    </select>
                                </div>
                            </div>

                            <div class="form-actions no-margin">
                            
                                <button type="submit" onclick="return checks()" name="btnsubmitNewEnrol" class="btn btn-large btn-info offset2">
                                    Save Form
                                </button>
                                <input type="button" class="btn btn-large btn-danger" value="Cancel" onclick="window.location='index.php';" >
                                <div class="clearfix">
                                </div>
                            </div>
                           

                        </form>
<script type="text/javascript">



function checks(){
    
  var status  =  check_NewEnrol_validation();
  //alert(status);
  if(status == 0)
  {
     // alert('Invalid information');
        // Prevent the form from sending
   
     return false;    
  }
  else
  {
       // alert('Thank You');
        return true;
          //window.location.href = <?php echo base_url(); ?>/index.php/Registration/NewEnrolment ;
  } 

   
}

</script>

                    </div>  

                </div>
            </div>
        </div>
    </div>
</div>
