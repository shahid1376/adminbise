<div class="dashboard-wrapper class wysihtml5-supported">
          <div class="left-sidebar">
            <div class="row-fluid">
              <div class="span12">
                <div class="widget no-margin">
                  <div class="widget-header">
                    <div class="title">
                      Create batch 9th Registration<a data-original-title="" id="notifications">s</a>
                    </div>
                    <span class="tools">
                      <a data-original-title="" class="fs1" aria-hidden="true" data-icon=""></a>
                    </span>
                  </div>
                  <div class="widget-body">
                                     <div class="control-group">
                    <h4 class="title">
                    Create Batch:
                    </h4>
                     </div>
                     <hr>
                     <!--<div class="control-group">
                         <label class="control-label">
                        <b> Please Select the option and Provide input for Report:</b>
                         </label>
                     </div> -->
                     <div class="control-group">
                     <label class="control-label span1">
                     Select Option:
                     </label>
                     <div class="controls controls-row">
                     <label class="radio inline span1">
                     <input type="radio" name="opt" checked="checked" value="3">Group Wise <br>
                     </label>
                     <label class="radio inline span2">
                        <input type="radio" name="opt" value="2">Special Case(Board Employee) <br>
                     </label>
                      <label class="radio inline span2">
                      <input type="radio" name="opt" value="1">Special Case(Disable) 
                      </label>
                     </div>
                     </div>
                     <div class="control-group">
                     <label class="control-label span1">
                     Select Group:
                     </label>
                     <div class="controls controls-row">
                    <select id="std_group" name="std_group">
                              <option value="">-- Show All Groups --</option>
                            <option value="1">SCIENCE GROUP WITH BIOLOGY</option>
                            <option value="7">SCIENCE GROUP WITH COMPUTER SCIENCE</option>
                             <option value="2">HUMANTIES</option>
                            <option value="5">DEAF AND DUMB</option>
                       </select>
                     </div>
                     </div>
                     <div class="control-group">
                     <div class="controls controls-row">
                     <input type="submit" id="create_batch" name="create_batch" class="btn btn-large btn-info" value="Create Batch of Complete Group" onclick="return  makebatch_groupwise();" >
                     <input type="submit" id="create_batch2" name="create_batch2" class="btn btn-large btn-info" value="Create Batch Of Selected Forms" onclick="return  makebatch_formnowise();"  >
                     
                     </div>
                     </div>
                   <div id="dt_example" class="example_alt_pagination">
                           <form method="POST" id="frmchk" action="<?=base_url()?>/index.php/Registration/Make_Batch_Formwise">
                            <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">
                                            Sr.No.
                                        </th>
                                        <th style="width:5%">
                                            Form No.
                                        </th>
                                        <th style="width:20%">
                                            Name
                                        </th>
                                        <th style="width:20%">
                                            Father's Name
                                        </th>
                                        <th style="width:10%" class="hidden-phone">
                                            DOB
                                        </th>
                                        <th style="width:7%" class="hidden-phone">
                                            Subject Group
                                        </th>
                                         <th style="width:7%" class="hidden-phone">
                                            Selected Subjects
                                        </th>
                                         <th style="width:5%" class="hidden-phone">
                                            Picture
                                        </th>
                                        <th style="width:18%" class="hidden-phone">
                                            Select
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    <?php
                                  //  DebugBreak();
                                    
                                    $msg_status;
                                    if($data != false)
                                    {
                                    $n=0;  
                                    $grp_name='';                             
                                    foreach($data as $key=>$vals):
                                    $n++;
                                    $formno = !empty($vals["formNo"])?$vals["formNo"]:"N/A";
                                    $grp_name = $vals["grp_cd"];
                                    switch ($grp_name) {
                                        case '1':
                                            $grp_name = 'Science';
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

                                    echo '<tr  >
                                    <td>'.$n.'</td>
                                    <td>'.$formno.'</td>
                                    <td>'.$vals["name"].'</td>
                                    <td>'.$vals["Fname"].'</td>
                                    <td>'.$vals["Dob"].'</td>
                                    <td>'.$grp_name.'</td>
                                    <td>'.$vals["sub1_abr"].','.$vals["sub2_abr"].','.$vals["sub3_abr"].','.$vals["sub4_abr"].','.$vals["sub5_abr"].','.$vals["sub6_abr"].','.$vals["sub7_abr"].','.$vals["sub8_abr"].'</td>
                                     <td><img id="previewImg" style="width:40px; height: 40px;" src="'.base_url().'assets/uploads/'.$Inst_Id.'/'.$vals['PicPath'].'" alt="                                             Candidate Image"></td>';
                                    
                                    echo'<td>
                                    <input type="checkbox" name="chk[]" value="'.$formno.'" style="width: 34px;    height: 34px;"/></td></tr>';
                                    endforeach;
                                    }
                                    ?>


                                 
                                </tbody>
                            </table>
                             </form>
                            <div class="clearfix"></div>
                        </div>
                    <!--<label class="label label-important" style="font-size: large;">
                    Note:<br>
                     Please write "No Image" in the above search to check if any image of candidate is missing or not.<br>
                     Forms with "No Image" will not be batched. So please make sure all images are uploaded properly before creating batches. 
                    </label>-->
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script type="text/javascript">
       
       // alert(msg_cd);
        
        
        </script>