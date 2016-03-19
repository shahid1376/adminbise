<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            Form Printing 9th Registration<a data-original-title="" id="notifications">s</a>
                        </div>
                        <span class="tools">
                            <a data-original-title="" class="fs1" aria-hidden="true" data-icon=""></a>
                        </span>
                    </div>
                    <div class="widget-body">
                        <div class="control-group">
                            <h4 class="title">
                                Reports:
                            </h4>
                        </div>
                        <hr>
                        <div class="control-group">
                            <label class="control-label">
                                <b> Please Select the option and Provide input for Report:</b>
                            </label>
                        </div>
                        <div class="control-group">
                            <label class="control-label span1">
                                Select Option:
                            </label>
                            <div class="controls controls-row">
                                <label class="radio inline span1">
                                    <input type="radio" name="opt" checked="checked" value="1">Group Wise <br>
                                </label>
                                <label class="radio inline span2">
                                    <input type="radio" name="opt"  value="2">Form No. Wise
                                </label>
                            </div>
                        </div>
                        <div class="control-group" id="grp_selected">
                            <label class="control-label span1">
                                Select Group:
                            </label>
                            <div class="controls controls-row">
                                <select id="std_group"   class="dropdown span3"  name="std_group">
                                    <option value="0">SELECT GROUP</option>
                                    <option value="1">SCIENCE GROUP WITH BIOLOGY</option>
                                    <option value="7">SCIENCE GROUP WITH COMPUTER SCIENCE</option>
                                    <option value="8">SCIENCE GROUP WITH ELECTRICAL WIRING(OPT)</option>
                                    <option value="2">HUMANTIES</option>
                                    <option value="5">DEAF AND DUMB</option>
                                </select>
                            </div>
                        </div>
                        <div style="display: none;" id="formnowise_selected" >
                        <div class="control-group" >
                        <div class="controls controls-row">
                        <label class="control-label span1">Starting Form No.</label>
                        <input type="text" id="strt_formNo"> 
                        </div>
                        </div>
                         <div class="control-group" >
                        <div class="controls controls-row">
                        <label class="control-label span1">Ending Form No.</label>
                        <input type="text" id="ending_formNo"> 
                        </div>
                        </div>
                        </div>
                      </div>
                        <div class="control-group">
                            <div class="controls controls-row">
                                <input type="submit" name="get_report" id="get_report"class="btn btn-large btn-info" value="Final Print of Return">
                                <input type="submit" name="get_Proof" class="btn btn-large btn-info " id="get_Proof" value="Get Proof Print of Return">
                                <input type="submit" name="get_Proof_reg" id="get_Proof_reg" class="btn btn-large btn-info "  value="Get Proof Print Registration From">
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls control-group">
                                <label class="control-label label label-important" style="font-size: large;"> 
                                    Instructions: 1-Please Use A-4 Size (80 gram) Paper to Print All Documents/Reports.
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="">
var error = '<?php echo $error_msg; ?>';
            if(error == "0"){
               // alert('hello');
            }
            else{
                alert(error);
            }


</script>
