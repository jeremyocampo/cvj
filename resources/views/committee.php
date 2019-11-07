<?php

    require_once('../mysql_connect.php');
    session_start();
    $faculty_id =  $_SESSION["faculty_id"];

    require_once('get_faculty_info.php');
    require_once('get_area_permission.php');

    date_default_timezone_set('Asia/Manila');
    $date = date('Y-m-d');
    
    $module_id = 4;

    require_once('get_permission.php');

    if(!isset($rowPermission)){

        header("Location: index.php");
    
    }

    $qPeriod = "SELECT *
    FROM period 
    WHERE end_date = '9999-12-12 00:00:00'";
    $resPeriod = mysqli_query($dbc, $qPeriod);
    $row=mysqli_fetch_array($resPeriod,MYSQLI_ASSOC); 
    $currPeriod = $row['period_id'];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title> View All Committees </title>
    
    <link rel="icon" type="image/png" href="../DAMS Icon.png"/>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../css/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="../css/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Waves Effect Css -->
    <link href="../css/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../css/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/css/style.css" rel="stylesheet">

    <link href="../css/css/themes/theme-green.css" rel="stylesheet" />
</head>

 <body class ="theme-green">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <?php
        include('navbar.php');
    ?>

    <section class="content">
        <div class="container-fluid">
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Committees </h2>
                                <small> NOTE: You will not be able to add a committee if there is no period! </small>
                            <span class="pull-right">
                                <?php
                                if(isset($currPeriod)){
                                    $qGetRow = "SELECT * FROM dams_db.purpose_of_committee pc
                                    JOIN committee c
                                    ON c.committee_id = pc.committee_id
                                    WHERE c.period_id = {$currPeriod}";
                                    $resGetRow= mysqli_query($dbc, $qGetRow);
                                    $numrow=mysqli_num_rows($resGetRow);  
                                    if(isset($currPeriod) && $numrow < 3){
                                        echo '
                                        <button type="button" class="btn btn-success btn-circle waves-effect waves-circle waves-float" style="margin-top: -20px;"data-toggle="modal" data-target="#modal1">
                                            <i class="material-icons">add</i>
                                        </button>';
                                    }
                                    else if($numrow == 3){
                                        echo '<button type="button" class="btn bg-gray btn-circle waves-effect" style="margin-top: -20px;" disabled>
                                        <i class="material-icons">add</i>
                                    </button>';
                                    }
                                }
                                else{
                                    echo '<button type="button" class="btn bg-gray btn-circle waves-effect" style="margin-top: -20px;" disabled>
                                    <i class="material-icons">add</i>
                                </button>';
                                }
                                ?>
                            </span>
                        </div>

                        <div class="body">
                            <div class="table-responsive">
                            <form action="committee-detailed.php" method="POST">
                                <?php
                                    if(isset($currPeriod)){
                                        $qcommittee= "SELECT c.committee_id, c.committee_name, concat(fi.faculty_FN, ' ', fi.faculty_LN) AS facultyname 
                                                        FROM committee c LEFT JOIN faculty_information fi
                                                        ON c.committee_head = fi.faculty_ID
                                                        WHERE c.period_id = {$currPeriod}";
                                        $rescommittee = mysqli_query($dbc, $qcommittee);

                                        $row3 = mysqli_num_rows($rescommittee);

                                        if($row3 == 0 ){
                                            echo '<center> <h4> There are no committees for this period. </h4> </center>';
                                        }

                                        else{
                                        echo '<table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Committee Name</th>
                                                        <th>Committee Head</th>
                                                    </tr>
                                                </thead> <tbody>'; 

                                                while($row=mysqli_fetch_array($rescommittee,MYSQLI_ASSOC)){
                                                    echo "<tr>
                                                            <td width=\"40%\">{$row['committee_name']}</td>
                                                            <td width=\"40%\">{$row['facultyname']}</td>
                                                            <td width=\"10%\" style=\"text-align: center\"><button type=\"submit\" name  =\"view\" class=\"btn btn-block btn-success dropdown-toggle\"  aria-haspopup=\"true\" aria-expanded=\"false\" value=\"{$row['committee_id']}\">View</td>
                                                        </tr>"; 
                                                }
                                        echo "</tbody> </table>";
                                        }
                                    }
                                    else{
                                        echo '<center> <h4> There is no on-going period. </h4> </center>';
                                    }
                                ?>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Add Committee ================================================================================================================ -->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog">
        <form id="insert_form1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card">
                        <div class="header bg-green"> 
                            <h2> Add Committee</h2>
                            <small> Fields marked with (*) are required. </small>
                         </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <label for="name">Committee Name <font color="red">*</font></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="name" class="form-control" placeholder="Enter Committee Name" required>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <label for="head">Committee Head <font color="red">*</font></label>
                                    <select class="form-control show-tick" name="head"  onchange = "getMembers(this.value)" data-live-search="true" required>
                                        <option value=""> - Select Committee Head -</option>
                                        <?php
                                            $qselect_head="SELECT fa.faculty_id, fi.faculty_FN, fi.faculty_LN
                                                            FROM faculty_account fa JOIN faculty_information fi 
                                                            ON fa.faculty_id = fi.faculty_ID
                                                            WHERE fa.if_registered = '1' AND fa.faculty_id 
                                                            NOT IN (SELECT committee_head 
                                                            FROM committee
                                                            WHERE period_id = {$currPeriod})
                                                            AND fa.faculty_id NOT IN (SELECT faculty_id FROM COMMITTEE_MEMBERS CM
                                                            JOIN COMMITTEE C ON C.COMMITTEE_ID = CM.COMMITTEE_ID
                                                            WHERE C.PERIOD_ID = {$currPeriod})";
                                            $resselect_head = mysqli_query($dbc, $qselect_head);
                                            while($row=mysqli_fetch_array($resselect_head,MYSQLI_ASSOC)){
                                                $id=$row['faculty_id'];
                                                $fname=$row['faculty_FN'];
                                                $lname=$row['faculty_LN'];
                                                echo '<option value ="'.$id.'">'.$fname. " ".$lname.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <label for="add_members">Committee Members <font color="red">*</font></label>
                                   <div name="add_members" id="add_members"> 
									 <div style="overflow: auto; width: 420px; background-color: #FFF; height: 20rem;padding-left: 2px;" class = "form-control">
                                                Select a Committee Head First
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <label for="member_roles">Committee Member Roles <font color="red">*</font></label>
                                   <div name="member_roles" id="member_roles"> 
									 <div style="overflow: auto; width: 420px; background-color: #FFF; height: 20rem;padding-left: 2px;" class = "form-control">
                                                Select Committee Members First!
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                    <div class="col-md-12">
                                    <label >Committee Tasks <font color="red">*</font> </label>
                                        <table id="tasks">
                                            <tr>
                                                <td> 
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" name="task[]" class ="form-control" placeholder="Enter Task" style="margin-right:190px;" required>   
                                                        </div>
                                                    </div>
                                                </td>
                                                <td width="10%"> </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="date" name="deadline[]" class="form-control"  style="margin-left: 8px; width: 160px;" min="<?php echo $date; ?>" required>
                                                        </div>
                                                    </div>
                                                </td>
                                              
                                                <td width="10%"> </td>
                                                <td>
                                                    <button type="button" class="btn btn-lg btn-success waves-effect" name="add_field" onclick=addField() style="margin-left: 12px; margin-bottom: 5px;">
                                                        +
                                                    </button>
                                                </td>
												
                                            </tr>
                                        </table>
                                       
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-7">
                                        <div class="demo-radio-button">
                                            <label>Area <font color="red">*</font></label>
                                            <ul>
                                                <?php            
                                                    $qIfExists = "SELECT C.committee_id, RP.purpose_id, P.committee_id, RP.purpose, MAX(CP.period_id)
                                                    FROM PERIOD CP
                                                    LEFT JOIN COMMITTEE C
                                                    ON C.period_id = {$currPeriod}
                                                    JOIN PURPOSE_OF_COMMITTEE P
                                                    ON P.committee_id = C.committee_id
                                                    RIGHT JOIN REF_PURPOSE RP
                                                    ON RP.PURPOSE_ID = P.PURPOSE_ID
                                                    GROUP BY RP.PURPOSE_ID
                                                    ";
                                                                    
                                                    $resIfExists = mysqli_query($dbc,$qIfExists);
                                                    
                                                    while($row=mysqli_fetch_array($resIfExists,MYSQLI_ASSOC)){
                                                        if(isset($row['committee_id'])){
                                                            if($row['purpose_id']==1){
                                                                if(isset($ceflag)){
                                                                    echo "<input name=\"radio_perm\" type=\"radio\" id=\"{$row['purpose_id']}\" value=\"{$row['purpose_id']}\" class=\"with-gap radio-col-green\" disabled required />
                                                                    <label for=\"{$row['purpose_id']}\">{$row['purpose']}</label>";
                                                                }     
                                                            }
                                                            if($row['purpose_id']==2){
                                                                if(isset($rflag)){
                                                                    echo "<input name=\"radio_perm\" type=\"radio\" id=\"{$row['purpose_id']}\" value=\"{$row['purpose_id']}\" class=\"with-gap radio-col-green\" disabled required />
                                                                    <label for=\"{$row['purpose_id']}\">{$row['purpose']}</label>";
                                                                }     
                                                            }
                                                            if($row['purpose_id']==3){
                                                                if(isset($fflag)){
                                                                    echo "<input name=\"radio_perm\" type=\"radio\" id=\"{$row['purpose_id']}\" value=\"{$row['purpose_id']}\" class=\"with-gap radio-col-green\" disabled required />
                                                                    <label for=\"{$row['purpose_id']}\">{$row['purpose']}</label>";
                                                                }     
                                                            }
                                                        }
                                                        else{
                                                            if($row['purpose_id']==1){
                                                                if(isset($ceflag)){
                                                                    echo "<input name=\"radio_perm\" type=\"radio\" id=\"{$row['purpose_id']}\" value=\"{$row['purpose_id']}\" class=\"with-gap radio-col-green\" required />
                                                                    <label for=\"{$row['purpose_id']}\">{$row['purpose']}</label>";
                                                                    $btnNoDisable = true;
                                                                }
                                                            }
                                                            if($row['purpose_id']==2){
                                                                if(isset($rflag)){
                                                                    echo "<input name=\"radio_perm\" type=\"radio\" id=\"{$row['purpose_id']}\" value=\"{$row['purpose_id']}\" class=\"with-gap radio-col-green\"  required />
                                                                    <label for=\"{$row['purpose_id']}\">{$row['purpose']}</label>";
                                                                    $btnNoDisable = true;
                                                                }
                                                            }
                                                            if($row['purpose_id']==3){
                                                                if(isset($fflag)){
                                                                    echo "<input name=\"radio_perm\" type=\"radio\" id=\"{$row['purpose_id']}\" value=\"{$row['purpose_id']}\" class=\"with-gap radio-col-green\" required />
                                                                    <label for=\"{$row['purpose_id']}\">{$row['purpose']}</label>";
                                                                    $btnNoDisable = true;
                                                                }
                                                            }
                                                        }                                                        

                                                    }   
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                    
                <div class="modal-footer">
                    <?php
                        if(!isset($btnNoDisable)){
                            echo '<input type="submit" id = "submit" class="btn btn-link waves-effect" value = "ADD" name="add_modal1" disabled>';
                        }
                        else{
                            echo '<input type="submit" id = "submit" class="btn btn-link waves-effect" value = "ADD" name="add_modal1">';
                        }
                    ?>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </div>        
        </div>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            $("#insert_form1").on('submit',function(event){
                event.preventDefault();
                $.ajax({
                    url:"modals/add_committee.php",
                    method:"POST",
                    data:$("#insert_form1").serialize(),
                    success:function(data)
                    {
                        $("#insert_form1")[0].reset();
                        $("#modal1").html(data);
                        alert(data);
                        window.location.reload();
                    }

                })
                $.ajax({
                    url:"addevent.php",
                    method:"POST",
                    data:$("#insert_form1").serialize(),
                    success:function(data)
                    {
                        $("#insert_form1")[0].reset();
                    }

                })
            });
            $("#add_members").on('change',function(event){
                event.preventDefault();
                $.ajax({
                    url:"modals/committee_user_roles.php",
                    method:"POST",
                    data:$("#insert_form1").serialize(),
                    success:function(data)
                    {
                        document.getElementById("member_roles").innerHTML=(data);
                    }

                })
            })
        });
    </script>
    <script>
    var i=1;
    function addField(){
        var i=1;
        var task = '<td><div class="form-group"><div class="form-line"><input type="text" name="task[]" class ="form-control" placeholder="Enter Task" style="margin-right:190px;" required></div></div></td>';
        var deadline = '<td><div class="form-group"><div class="form-line"><input type="date" name="deadline[]" class="form-control" min="<?php echo $date; ?>" style="margin-left: 8px; width: 160px;" required></div></div></td>';
       
        var space ='<td width="10%"> </td>';
        var tr='<tr id="row'+i+'">';
        var remove='<td><button type="button" name="remove" id="'+i+'" class="btn btn-lg btn-danger btn_remove" waves-effect waves-float" style="margin-left: 12px; margin-top: 5px; margin-bottom: 5px;"> - </button></td></tr>';

        var markup= tr + task + space + deadline  + space + remove;
        $("#tasks").append(markup);
        i++;
    }
	$(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();
		   
      }); 
	   function getMembers(status){
               
                if(status!=0){
					
                    var xhr = new XMLHttpRequest();
				
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById("add_members").innerHTML=(xhr.responseText);
                        }
                    }
                    xhr.open("GET", "modals/fetch_committee_members.php?q=" + status, true);
                    xhr.send();
                }

             
            }  
    </script>
    </section>

    <!-- Jquery Core Js -->
    <script src="../css/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../css/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../css/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../css/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../css/plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="../css/plugins/jquery-countto/jquery.countTo.js"></script>
    
    <!-- Custom Js -->
    <script src="../css/js/admin.js"></script>
    <script src="../css/js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="../css/js/demo.js"></script>
     
</body>

</html>

                    