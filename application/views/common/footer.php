<footer>
    <p>
        &copy; BiseAdmin 2015
    </p>
</footer>
<script src="<?php echo base_url(); ?>assets/js/wysiwyg/wysihtml5-0.3.0.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.scrollUp.js"></script>
<script src="<?php echo base_url(); ?>assets/js/wysiwyg/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/date-picker/date.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/date-picker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/clockface.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.bootstrap.wizard.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/alertify.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.fancybox.pack.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<?php 
if(isset($files)){
    foreach($files as $file){
        echo '<script type="text/javascript" src="'.base_url().'assets/js/'.$file.'"></script>';
    }
}
?> 
<script type="">
    $(document).ready(function () {
        $('#data-table').dataTable({
            "sPaginationType": "full_numbers"
        });
         $('#data-tablereg').dataTable({
            "sPaginationType": "full_numbers"
        });
    });

</script>
<script type="">
    function downloadslip(rno,isdownload)
    {
        $('.mPageloader').show();
        window.location.href = '<?=base_url()?>/index.php/RollNoSlip/MatricRollNo/'+rno+'/'+isdownload

        if(isdownload == 1)
        {
            $('.mPageloader').hide();
        }
    }
    function downloadslip9th(rno,isdownload)
    {
        $('.mPageloader').show();
        window.location.href = '<?=base_url()?>/index.php/RollNoSlip/NinthRollNo/'+rno+'/'+isdownload
        if(isdownload == 1)
        {
            $('.mPageloader').hide();
        }
    }
    function downloadgroupwise(isdownload)
    {
        $('.mPageloader').show();
        window.location.href = '<?=base_url()?>/index.php/RollNoSlip/MatricRollNoGroupwise/'+$("#std_group").val()+'/'+isdownload

        if(isdownload == 1)
        {
            $('.mPageloader').hide();
        }
    }
    function downloadgroupwise9th(isdownload)
    {
        $('.mPageloader').show();
        window.location.href = '<?=base_url()?>/index.php/RollNoSlip/NinthRollNoGroupwise/'+$("#std_group").val()+'/'+isdownload
        if(isdownload == 1)
        {
            $('.mPageloader').hide();
        }
    }
</script>

<script type="">
    var myOptions = {
        val1 : 'text1',
        val2 : 'text2'
    };
    var sub1_Pak_options = {
        1 : 'Urdu'
    }
    var sub1_NonPak_options = 
    {
        1 : 'Geogrophy Of Pakistan',
        11 : 'Urdu'
    }
    var sub3_Muslim = 
    {
        3 :'Islamyat Compulsory'
    }
    var sub3_Non_Muslim = 
    {
        51 : 'ETHICS',
        3  :'Islamyat Compulsory'
    }
    var sub5_Hum = 
    {
        92 : 'GENERAL MATHEMATICS' 
    }
    var sub6_Hum = 
    {
        9 : 'GENERAL SCIENCE'  
    }
    var sub7_Hum = 
    {
        0 : 'NOT SELECTED',
        37: 'EDUCATION',
        26: 'CIVICS',
        25: 'ECONOMICS',
        14: 'PHYSIOLOGY & HYGIENE',
        24: 'GEOGRAPHY',
        21: 'HISTORY OF PAKISTAN',
        35: 'ENGLISH LITERATURE',
        34: 'URDU LITERATURE',
        19: 'ADVANCED ISLAMIC STUDIES',
        87: 'ENVIRONMENTAL STUDIES',
        33: 'COMMERCIAL GEOGRAPHY',
        22: 'ARABIC',
        23: 'PERSIAN',
        36: 'PUNJABI',
        20: 'ISLAMIC HISTORY',
        83: 'POULTRY FARMING',
        40: 'HEALTH & PHYSICAL EDUCATION',
        78: 'COMPUTER SCIENCE'
    }
    var sub8_Hum = 
    {
        0 : 'NOT SELECTED',
        37: 'EDUCATION',
        26: 'CIVICS',
        25: 'ECONOMICS',
        14: 'PHYSIOLOGY & HYGIENE',
        24: 'GEOGRAPHY',
        21: 'HISTORY OF PAKISTAN',
        35: 'ENGLISH LITERATURE',
        34: 'URDU LITERATURE',
        19: 'ADVANCED ISLAMIC STUDIES',
        87: 'ENVIRONMENTAL STUDIES',
        33: 'COMMERCIAL GEOGRAPHY',
        22: 'ARABIC',
        23: 'PERSIAN',
        36: 'PUNJABI',
        20: 'ISLAMIC HISTORY',
        83: 'POULTRY FARMING',
        40: 'HEALTH & PHYSICAL EDUCATION',
        78: 'COMPUTER SCIENCE'
    }
    var sub5_Deaf = 
    {
        66: 'ARITHMETIC'

    }
    var sub6_Deaf = 
    {
        0: 'NOT SELECTED',
        72 : 'TAILORING',
        67 : 'BAKERY',
        68 : 'CARPET MAKING',
        78 : 'COMPUTER SCIENCES',
        69 : 'DRAWING',
        70 : 'EMBORIDERY',
        40 : 'HEALTH & PHYSICAL EDUCATION',
        73 : 'TYPE WRITING',
        74 : 'WEAVING'
    }
    var sub7_Deaf = 
    {
        0: 'NOT SELECTED',
        72 : 'TAILORING',
        67 : 'BAKERY',
        68 : 'CARPET MAKING',
        78 : 'COMPUTER SCIENCES',
        69 : 'DRAWING',
        70 : 'EMBORIDERY',
        40 : 'HEALTH & PHYSICAL EDUCATION',
        73 : 'TYPE WRITING',
        74 : 'WEAVING'
    }
    var sub8_Deaf = 
    {
        0: 'NOT SELECTED',
        72 : 'TAILORING',
        67 : 'BAKERY',
        68 : 'CARPET MAKING',
        78 : 'COMPUTER SCIENCES',
        69 : 'DRAWING',
        70 : 'EMBORIDERY',
        40 : 'HEALTH & PHYSICAL EDUCATION',
        73 : 'TYPE WRITING',
        74 : 'WEAVING'
    }

    function downloadslip(rno)
    {
        window.location.href = '<?=base_url()?>/index.php/RollNoSlip/MatricRollNo/'+rno
    }
    function EditForm(formrno)
    {
        window.location.href = '<?=base_url()?>/index.php/Registration/NewEnrolment_EditForm/'+formrno
    }
    function ReturnForm(Batch_ID)
    {
        window.location.href = '<?=base_url()?>/index.php/Registration/return_pdf/'+Batch_ID + '/1'
    }
    function ReturnForm_Final_groupwise(grp_cd){
        window.location.href = '<?=base_url()?>/index.php/Registration/return_pdf/'+grp_cd + '/2'
    }
    function ReturnForm_Final_Formnowise(startformno,endformno){
        window.location.href = '<?=base_url()?>/index.php/Registration/return_pdf/'+startformno + '/3' +'/'+endformno +'/';
    }
    function ReturnForm_ProofReading_groupwise(grp_cd){
        window.location.href =  '<?=base_url()?>/index.php/Registration/return_pdf/'+grp_cd + '/4'
    }
    function ReturnForm_ProofReading_Formnowise(startformno,endformno){
        window.location.href = '<?=base_url()?>/index.php/Registration/return_pdf/'+startformno + '/5' +'/'+endformno+'/';
    }
    
      function Print_Registration_Form_Proofreading_Groupwise(grp_cd){
        window.location.href =  '<?=base_url()?>/index.php/Registration/Print_Registration_Form_Proofreading_Groupwise/'+grp_cd + '/1'
    }
     function Print_Registration_Form_Proofreading_Formnowise(startformno,endformno){
        window.location.href =  '<?=base_url()?>/index.php/Registration/Print_Registration_Form_Proofreading_Groupwise/'+startformno + '/2' +'/'+endformno+'/';
    }
    $('#get_report').click( function(){
       debugger;
      var option =  $('input[type=radio][name=opt]:checked').val(); 
     // alert(option);
     // return;
      if(option == "1")
      {
          var std_group = $('#std_group').val();
          if(std_group == "0"){
              alertify.error("Please Select a Group First !");
              return;
          }
          ReturnForm_Final_groupwise(std_group);
      }
      else if(option =="2")
      {
          var startformno = $('#strt_formNo').val();
          var endformno = $('#ending_formNo').val();
          if((startformno.length < 10 ||  startformno.length > 10) && (endformno.length < 10 ||  endformno.length > 10))
          {
              alertify.error("Invalid Form No.");
              return;
          }
          ReturnForm_Final_Formnowise(startformno,endformno);
      }
      else{
          return;
      }
    })
    $('#get_Proof').click( function(){
       debugger;
      var option =  $('input[type=radio][name=opt]:checked').val(); 
     // alert(option);
     // return;
      if(option == "1")
      {
          var std_group = $('#std_group').val();
          if(std_group == "0"){
              alertify.error("Please Select a Group First !");
              return;
          }
          ReturnForm_ProofReading_groupwise(std_group);
      }
      else if(option =="2")
      {
          var startformno = $('#strt_formNo').val();
          var endformno = $('#ending_formNo').val();
          if((startformno.length < 10 ||  startformno.length > 10) && (endformno.length < 10 ||  endformno.length > 10))
          {
              alertify.error("Invalid Form No.");
              return;
          }
          ReturnForm_ProofReading_Formnowise(startformno,endformno);
      }
      else{
          return;
      }
    })
    $('#get_Proof_reg').click( function(){
       debugger;
      var option =  $('input[type=radio][name=opt]:checked').val(); 
     // alert(option);
     // return;
      if(option == "1")
      {
          var std_group = $('#std_group').val();
          if(std_group == "0"){
              alertify.error("Please Select a Group First !");
              return;
          }
          Print_Registration_Form_Proofreading_Groupwise(std_group);
      }
      else if(option =="2")
      {
          var startformno = $('#strt_formNo').val();
          var endformno = $('#ending_formNo').val();
          if((startformno.length < 10 ||  startformno.length > 10) && (endformno.length < 10 ||  endformno.length > 10))
          {
              alertify.error("Invalid Form No.");
              return;
          }
          Print_Registration_Form_Proofreading_Formnowise(startformno,endformno);
      }
      else{
          return;
      }
    })
    //    
       
       
    
    function RevenueForm(Batch_ID)
    {
        window.location.href = '<?=base_url()?>/index.php/Registration/revenue_pdf/'+Batch_ID
    }
    
    $(document).ready(function() {
    console.log("Jquery working....");
    $('input[type=radio][name=opt]').change(function() {
        if (this.value == '1') {
           // alert("Allot Thai Gayo Bhai");
            $('#formnowise_selected').css('display','none');
            $('#grp_selected').css('display','block');
        }
        else if (this.value == '2') {
            $('#grp_selected').css('display','none');
            $('#formnowise_selected').css('display','block');
           // $('.news').css('display','block');
          //  alert("Transfer Thai Gayo");
        }
    });
});
    
    function DeleteForm(formrno)
    {
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {
            if (e) {
                // user clicked "ok"
                window.location.href ='<?php echo base_url(); ?>Registration/NewEnrolment_Delete/'+formrno;
            } else {
                // user clicked "cancel"

            }
        });
        // window.location.href = '<?=base_url()?>/index.php/RollNoSlip/MatricRollNo/'+formrno
    }
    function downloadslip9th(rno)
    {
        window.location.href = '<?=base_url()?>/index.php/RollNoSlip/NinthRollNo/'+rno
    }
    function downloadgroupwise()
    {
        window.location.href = '<?=base_url()?>/index.php/RollNoSlip/MatricRollNoGroupwise/'+$("#std_group").val()
    }

    function load_Bio_CS_Sub()
    {
        var NationalityVal = $("input[name=nationality]:checked").val();
        console.log(NationalityVal);
        $('#sub1').empty();
        if(NationalityVal == "1")
        {
            console.log("Hi Pakistani ");
            $.each(sub1_Pak_options, function(val, text) {
                $('#sub1').append( new Option(text,val) );
            }); 

        }
        else if (NationalityVal == "2")
        {
            console.log("Hi Foreigner Welcom to Pakistan :) ");
            $.each(sub1_NonPak_options, function(val, text) {
                $('#sub1').append( new Option(text,val) );
            }); 
        }

        // Check Religion and select sub........
        $("#sub3").empty();
        var Religion = $("input[name=religion]:checked").val();
        //console.log(Religion);
        console.log(Religion);
        if(Religion == "1")
        {
            console.log("Hi Muslim :)");
            $.each(sub3_Muslim,function(val,text){
                $("#sub3").append(new Option(text,val));
            });

        }
        else if(Religion == "2")
        {
            console.log("Hi Non-Muslim :)");
            $.each(sub3_Non_Muslim,function(val,text){
                $("#sub3").append(new Option(text,val));
            });
        }

        // Subject 5 ,6 ,7 and 8
        $("#sub5").empty();
        $("#sub6").empty();
        $("#sub7").empty();
        $("#sub8").empty();

        $("#sub5").append(new Option('MATHEMATICS',5));
        $("#sub6").append(new Option('PHYSICS',6));
        $("#sub7").append(new Option('CHEMISTRY',7));

    }

    function Hum_Deaf_Subjects()
    {
        var NationalityVal = $("input[name=nationality]:checked").val();
        console.log(NationalityVal);
        $('#sub1').empty();
        if(NationalityVal == "1")
        {
            console.log("Hi Pakistani ");
            $.each(sub1_Pak_options, function(val, text) {
                $('#sub1').append( new Option(text,val) );
            }); 

        }
        else if (NationalityVal == "2")
        {
            console.log("Hi Foreigner Welcom to Pakistan :) ");
            $.each(sub1_NonPak_options, function(val, text) {
                $('#sub1').append( new Option(text,val) );
            }); 
        }

        // Check Religion and select sub........
        $("#sub3").empty();
        var Religion = $("input[name=religion]:checked").val();
        //console.log(Religion);
        console.log(Religion);
        if(Religion == "1")
        {
            console.log("Hi Muslim :)");
            $.each(sub3_Muslim,function(val,text){
                $("#sub3").append(new Option(text,val));
            });

        }
        else if(Religion == "2")
        {
            console.log("Hi Non-Muslim :)");
            $.each(sub3_Non_Muslim,function(val,text){
                $("#sub3").append(new Option(text,val));
            });
        }

        $("#sub5").empty();
        $("#sub6").empty();
        $("#sub7").empty();
        $("#sub8").empty();


    }
    $("#std_group").change(function(){

        // alert('hello  Sweet Heart ! I love You UMMMMAH :) ') 
        var grp_cd = $("#std_group").val();
        //alert(grp_cd);

        // If Science with Biology group selected then 
        if(grp_cd == "1")
        {

            // Check Nationality and select appropriate Subject1 against candidate Nationality :)
            load_Bio_CS_Sub();
            $("#sub8").append(new Option('Biology',8));


            // alert("Your are a - " + radioValue);




        }
        else if(grp_cd == "7")
        {
            load_Bio_CS_Sub();
            $("#sub8").append(new Option('COMPUTER SCIENCE',78));
            //    alert('hello  Sweet Heart ! I love You UMMMMAH :) ') 
        }
        else if (grp_cd == "8")
        {
            load_Bio_CS_Sub();
            $("#sub8").append(new Option('ELECTRICAL WIRING (OPT)',43));
            //ELECTRICAL WIRING (OPT)
        }

        else if(grp_cd == "2")
        {
            Hum_Deaf_Subjects();
            $.each(sub5_Hum,function(val,text){
                $("#sub5").append(new Option(text,val));
            });
            $.each(sub6_Hum,function(val,text){
                $("#sub6").append(new Option(text,val));
            });
            $.each(sub7_Hum,function(val,text){
                $("#sub7").append(new Option(text,val));
            });
            $.each(sub8_Hum,function(val,text){
                $("#sub8").append(new Option(text,val));
            });
            var Gender = $("input[name=gender]:checked").val();
            //console.log(Religion);
            console.log(Gender);
            if(Gender == "2")
            {
                console.log("Hi Miss :)");

                $("#sub8").append(new Option('ELEMENTS OF HOME ECONOMICS',13));
            }
            else
            {
                // alert('i am removed');
                dropdownElement.find('sub8[value=13]').remove();


            }


        }
        else if(grp_cd == "5")
        {
            Hum_Deaf_Subjects();
            $.each(sub5_Deaf,function(val,text){
                $("#sub5").append(new Option(text,val));
            });
            $.each(sub6_Deaf,function(val,text){
                $("#sub6").append(new Option(text,val));
            });
            $.each(sub7_Deaf,function(val,text){
                $("#sub7").append(new Option(text,val));
            });
            $.each(sub8_Deaf,function(val,text){
                $("#sub8").append(new Option(text,val));
            });
        }
        else if (grp_cd == "0")
        {
            remove_subjects();
        }
        function remove_subjects()
        {
            $("#sub5").empty();
            $("#sub6").empty();
            $("#sub7").empty();
            $("#sub8").empty();
        }

    });

    //   $("#registration").validate();
    $("#cand_name").focus();
    /*
    ===========================================
    MASKINGS Settings
    ===========================================
    */
    $("#bay_form,#father_cnic").mask("99999-9999999-9",{placeholder:"_"});
    $("#dob,#dateofadmission").mask("99-99-9999",{placeholder:"_"});
    $("#mob_number").mask("9999-9999999",{placeholder:"_"});

    // $("#registration").validate();
    $("#cand_name").focus();

    function  check_NewEnrol_validation(){
        var name =  $('#cand_name').val();
        var dist_cd= $('#dist option:selected').val();
        var teh_cd= $('#teh').val();
        var zone_cd= $('#zone').val();
        var pp_cent= $('#pp_cent').val();           
        var sub6p1 = $('#sub5').val();
        var sub6p2 = $('#sub6').val();           
        var sub7p1 = $('#sub7').val();
        var sub7p2 = $('#sub8').val();                      
        var ex_type = $('#exam_type').val();
        var mobNo = $('#mob_number').val();
        var bFormNo = $('#bay_form').val();
        var grp_cd = $('#std_group').val();
        var brd_cd = $('#brd_cd').val();
        var fName = $('#father_name').val();
        var FNic = $('#father_cnic').val();
        var dob = $('#dob').val();
        var address = $('#address').val();
        var image = $('#image').val();
        var MarkOfIdent = $('#MarkOfIden').val();
        var Inst_Rno = $('#Inst_Rno').val();
        var status = 0;
        // alert('sub6 '+sub6p1+ ' and '+ sub6p2);
        if(name == "" ||  name == undefined){
            $('#ErrMsg').show();  
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your  Name </b>");    

            $('#cand_name').focus(); 
            return status;
        }
        else if(fName == "" || fName == undefined){
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your Father's Name  </b>");    
            $('#father_name').focus(); 
            return status;
        }   

        else if(bFormNo == "" || bFormNo == 0 || bFormNo == undefined)
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your bay-Form</b>"); 
            $('#bay_form').focus();  
            return status; 
        }
        else if(FNic == "" || FNic.length == undefined )
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your Father's CNIC</b>"); 
            $('#father_cnic').focus();  
            return status; 
        }

        else if(dob == "" || dob.length == undefined)
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your Date of Birth</b>"); 
            $('#dob').focus(); 
            return status;  
        }

        else if(mobNo == "" || mobNo == 0 || mobNo == undefined)
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your Mobile No.</b>"); 
            $('#mob_number').focus();   
            return status;  
        }
        else if(Inst_Rno == "" || Inst_Rno == 0 || Inst_Rno== undefined)
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your Institute Roll No.</b>"); 
            $('#Inst_Rno').focus();   
            return status;  
        }
        else if(MarkOfIdent == "" || MarkOfIdent == 0 || MarkOfIdent == undefined)
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your Mark of Indentification</b>"); 
            $('#MarkOfIden').focus();   
            return status;  
        }
        else if(address == "" || address == 0 || address.length ==undefined )
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your Address</b>"); 
            $('#address').focus(); 
            return status;    
        }

        /*                  else  if ($("#dist").find('option:selected').val() < 1) 
        {

        alert('Please select District '); 
        $("#dist").focus();

        return status;  
        }

        else   if ($("#teh").find('option:selected').val() < 1) {

        alert('Please select Tehsil');                          
        $("#teh").focus();
        return status;  
        }
        else  if ($("#zone").find('option:selected').val() < 1) {

        alert('Please select Zone. ');                          
        $("#zone").focus();
        return status;  
        }
        */

        else   if ($("#std_group").find('option:selected').val() < 1) 
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your Study Group</b>"); 
            // alert('Study Group not selected ');                          
            $("#std_group").focus();
            return status;  
        }
        else   if ($("#sub3").find('option:selected').val() < 1) 
        {
            $('#ErrMsg').show(); 
            alert('Plesae select  Subject');                          
            $("#sub3").focus();

            return status;  
        }
        else   if ($("#sub5").find('option:selected').val() < 1) 
        {
            $('#ErrMsg').show(); 
            alert('Plesae select Subject');                          
            $("#sub5").focus();

            return status;  
        }

        else   if ($("#sub6").find('option:selected').val() < 1) 
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Plesae select 6th Subject  </b>"); 
            // alert('Plesae select 6th Subject  ');                          
            $("#sub6").focus();
            return status;  
        }

        else   if ($("#sub7").find('option:selected').val() < 1) 
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Plesae select 7th Subject  </b>"); 
            //alert('Plesae select 7th Subject ');                          
            $("#sub7").focus();
            return status;  
        }

        else   if ($("#sub8").find('option:selected').val() < 1) 
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Plesae select 8th Subject  </b>"); 
            //alert('Plesae select 8th Subject ');                          
            $("#sub8").focus();
            return status;  
        }

        status = 1;
        return status;




    }
    /*
    ===========================================
    Validations
    ===========================================
    */
    var nationality = $('input:radio[name="nationality"]:checked').val();
    if(nationality == 1) {
        $("#bay_form","#father_cnic").mask("99999-9999999-9",{placeholder:"_"});
    }else{
        $("#bay_form","#father_cnic").mask("****************************",{placeholder:""});
    }

    $('input:radio[name="nationality"]').change(function(){
        if($(this).val() == 1) {
            $("#father_cnic").mask("99999-9999999-9",{placeholder:"_"});
            $("#bay_form").mask("99999-9999999-9",{placeholder:"_"});
        }else{
            //$("#father_cnic").mask("****************************",{placeholder:""});
            $("#father_cnic").unmask();
            $("#bay_form").unmask();
        }
    });

    var is_muslim    = $('input:radio[name="religion"]:checked').val();  
    var is_pakistani = $('input:radio[name="nationality"]:checked').val(); 
    var gender = $('input:radio[name="gender"]:checked').val(); 
    var id           = $('#std_group').val();
</script>

<script type="">
 var msg_cd = "<?php  echo $msg_status;  ?>";
if(msg_cd == "0")
        {
         //  alert("alertify.success(Hello )");
        }
        else if(msg_cd == "3"){
            alertify.error("No Students in this Group!");
        }
        function makebatch_groupwise(){
            if($("#std_group").val() == "" )
            {
               alertify.error("Please Select Group First!") ;
            }
            else{
                window.location.href = '<?=base_url()?>/index.php/Registration/Make_Batch_Group_wise/'+$("#std_group").val();
            }
        }
        function makebatch_formnowise(){
            if( $('input[name="chk[]"]:checked').length > 0 )
            {
                 $( "#frmchk" ).submit();
            }
            else
            {
                alertify.error("Please Select Forms First!") ;
                return false;
            }
        }
        </script>
</body>
</html>