<?php
include('connect.php');
session_start();
$session_id = $_SESSION['admin_id'];
if($_SESSION['admin_id']=='') {
    header("Location:login.php");
    exit;
}
if(isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $m_name = $_POST['m_name'];
        $lastname = $_POST['lastname'];   
        $join_date = $_POST['join_date'];
        $designation = $_POST['designation'];
        $user_code = $_POST['user_code'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $bank_name = $_POST['bank_name'];
        $account_number = $_POST['account_number'];
        $pan_no = $_POST['pan_no'];
        $pf_no = $_POST['pf_no'];
        $query4 = "SELECT username FROM userprofile WHERE username='{$username}'";
        $query_run4 = mysqli_query($con,$query4) or die( mysqli_error($con));
        if(mysqli_num_rows($query_run4)==0){
            
        $query1 = "INSERT into userprofile (username,firstname,m_name,lastname,join_date,designation,uid) values ('$username','$firstname','$m_name','$lastname','$join_date','$designation','$user_code')";
        $query2 = "INSERT into credentials (id,username,password) values('$user_code','$username','$password')";
        $query3 = "INSERT into bank_details (emp_id,bank_name,account_number,pan_no,pf_no) values('$user_code','$bank_name','$account_number','$pan_no','$pf_no') ";
        
        $query_run2 = mysqli_query($con,$query2) or die( mysqli_error($con));
        $query_run1 = mysqli_query($con,$query1) or die( mysqli_error($con));
        $query_run3 = mysqli_query($con,$query3) or die( mysqli_error($con));
        if($query_run1 && $query_run2 && $query_run3){
            echo '<script>alert("New Employee Created!")</script>';
            mkdir("../assets/uploadimage/$username");
            mkdir("../assets/uploaddocument/identity/$username");
            mkdir("../assets/uploaddocument/transcript/$username");
            mkdir("../assets/uploaddocument/resume/$username");
            echo '<script>window.location.href="../core/list_employee.php"</script>';
        }
        else{
            echo '<script>alert("Request Failed")</script>';
        }
        }
        else{
            echo '<script>alert("Username Exists")</script>';
        }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Echo Green Solar</title>
    <!-- contains all header links -->
    <?php include '../core/header.php';?>
    <!-- contains all css files  -->
    <link rel="stylesheet" href="../assets/css/add_employee.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
        <!-- contains code for side navigation bar  --> 
        <?php include '../core/admin_sidenav.php';
         include('functions.php');
        ?>
        <script src="../assets/js/sidenav.js"></script>
            <div class="col-9">
                <!-- card starts  -->
                    <div class="card">
                    <div class="card-title">
                        <p class="nav">Create New Employee</p>
                    </div>
                    <form method="POST" id="addform">
                    <div class="card-body">
                        <div class="class1">
                            <div class="row">
                                <div class="col-4">
                                    <p>First Name</p>
                                    <input type="text" name="firstname" placeholder="Enter First Name">
                                </div>
                                <div class="col-4">
                                    <p>Middle Name</p>
                                    <input type="text" name="m_name" placeholder="Enter Middle Name"> 
                                </div>
                                <div class="col-4">
                                    <p>Last Name</p>
                                    <input type="text" name="lastname" placeholder="Enter Last Name"> 
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="class2">
                            <div class="row">
                                <div class="col-4">
                                    <p>Joining Date</p>
                                    <input type="date" name="join_date" placeholder="dd/mm/yyyy">
                                </div>
                                <div class="col-4">
                                    
                                    <p>Designation</p>

                                            <?php $designation_name  = get_employee_des();?>
                                            <select name="designation" >

							        		    <option value=""hidden>Select Designation</option>
							        	        <?php foreach($designation_name as $emp) { 
                                                ?>
							        		    <option value="<?php echo $emp['designation_name'];?>"><?php echo $emp['designation_name'];?></option>
							        		    <?php 
                                                    } 
                                                ?>

							        		</select>
                                </div>
                                <div class="col-4">
                                    <p>User Code</p>
                                    <input type="text" name="user_code" placeholder="Enter User Code"> 
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="class3">
                            <div class="row">
                                <div class="col-4">
                                    <p>Username</p>
                                    <input type="text" name="username" placeholder="Enter Username" > 
                                
                                </div>
                                <div class="col-4">
                                    <p>Password</p>
                                    <input type="password" name="password" placeholder="Enter Password" > 
                                </div>
                                <div class="col-4">
                                    <p>Bank Name</p>
                                    <input type="text" name="bank_name" placeholder="Enter Bank Name"> 
                                </div>
                            </div>
                            <br>
                            <div class="class4">
                                <div class="row">
                                    <div class="col-4">
                                        <p>Bank Account Number</p>
                                        <input type="text" name="account_number" placeholder="Enter Bank Account Number">
                                    </div>
                                    <div class="col-4">
                                        <p>PAN Number</p>
                                        <input type="text" name="pan_no" placeholder="Enter PAN"> 
                                    </div>
                                    <div class="col-4">
                                        <p>PF Number</p>
                                        <input type="text" name="pf_no" placeholder="Enter PF"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="class4">
                            <div class="row">
                                <div class="col-2">
                                    <div class="button1">
                                        <a href="#">
                                            <button name='submit'>Submit</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="button2">
                                        <a href="../core/list_employee.php">
                                            <button>Back to list</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <!-- card ends  -->
            </div>
        </div>
    </div>
<script type="text/javascript">
    
    (function($, W, D)
    {
        var JQUERY4U = {};

        JQUERY4U.UTIL =
                {
                    setupFormValidation: function()
                    {
                        //form validation rules
                        $("#addform").validate({
                            rules: {
                                firstname: "required",
                                m_name: "required",
                                lastname: "required",
                                username: "required",
                                user_code: "required",
                                join_date: "required",
                                designation: "required",
                                password: "required",
                                bank_name: "required",
                                account_number: "required",
                                pan_no: "required",
                                pf_no: "required",
                            },
                            messages: {
                                firstname: "<p style='color:red;font-weight:100; font-size:14px'>Please enter first name!</p>",
                                m_name: "<p style='color:red;font-weight:100; font-size:14px'>Please enter middle name!</p>",
                                lastname: "<p style='color:red;font-weight:100; font-size:14px'>Please enter last name!</p>",
                                username: "<p style='color:red;font-weight:100; font-size:14px'>Please enter username!</p>",
                                user_code: "<p style='color:red;font-weight:100; font-size:14px'>Please enter user code!</p>",
                                join_date: "<p style='color:red;font-weight:100; font-size:14px'>Please enter date of joining!</p>",
                                designation: "<p style='color:red;font-weight:100; font-size:14px'>Please select designation!</p>",
                                password: "<p style='color:red;font-weight:100; font-size:14px'>Please enter passsword!</p>",
                                bank_name: "<p style='color:red;font-weight:100; font-size:14px'>Please enter bank name!</p>",
                                account_number: "<p style='color:red;font-weight:100; font-size:14px'>Please enter account number!</p>",
                                pan_no: "<p style='color:red;font-weight:100; font-size:14px'>Please enter pan number!</p>",
                                pf_no: "<p style='color:red;font-weight:100; font-size:14px'>Please enter pf number!</p>",
								},
                            submitHandler: function(form) {
                                form.submit();
                            }
                        });
                    }
                }

        //when the dom has loaded setup form validation rules
        $(D).ready(function($) {
            JQUERY4U.UTIL.setupFormValidation();
        });

    })(jQuery, window, document);
</script>
</body>

</html>

