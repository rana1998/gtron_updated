<?php 
    include "header.php";

    if(isset($_POST['submit']))
    {
        if(isset($_SESSION['isOTPmatch']) && $_SESSION['isOTPmatch'] == true) {
        //OTP VALIDATION VIA SESSION SESSION['isOTPmatch'] WILL BE UPDATED AS FALSE WHENEVER USER RELOAD PAGE AND GOT TO ANOTHER PAGE AFTER SENDING OTP IN MAIL
        $_SESSION['isOTPmatch'] = false;

        $currentEmail = $_POST['currentEmail'];
        $newEmail = $_POST['newEmail'];
        
        if(empty($currentEmail))
        {
            $_SESSION['reject']='Wrong Access';
            header("location:change_email.php");
            exit();
        }
        elseif(empty($newEmail))
        {
             $_SESSION['reject']='Please Enter Email';
            header("location:change_email.php");
            exit();
        }
        else
        {
            $q="select * from user_registration where email='$newEmail'";
            $result= mysqli_query($con,$q);
            if(mysqli_num_rows($result)>0)
            {
                $_SESSION['reject']='Sorry! email already exist';
                header("location:change_email.php");
                exit();
            }
            else
            {
                $q="update user_registration set email='$newEmail' where email='$currentEmail'";
                $result2=mysqli_query($con,$q);
                
                
                  //insert into admin log
                    $activityMessage= 'Email changed form '.$currentEmail.' email to '.$newEmail.' email';
                    $adminNameSession = $_SESSION['admin_name'];
                    $qyy="INSERT INTO `admin_log`(`user_name`, `activity`) 
                          VALUES ('$adminNameSession','$activityMessage')";
                    $result = mysqli_query($con,$qyy);
                    
                
                if($result2==TRUE)
                {
                   $_SESSION['successMsg']='Email Update Successfully';
                    header("location:change_email.php");
                    exit(); 
                }
            }
            
            
        }

        } 
        else {
            $_SESSION['reject']='Please valided your email via OTP.';
            header("location:change_email.php");
            exit();
        }

    }

?>  

                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                                <!-- Page-header start -->
                                <div class="page-header">
                                    <div class="row align-items-end">
                                        <div class="col-lg-8">
                                            <div class="page-header-title">
                                                <div class="d-inline">
                                                    <h4>Change Email</h4>
                                                    <span>Update user new email</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="page-header-breadcrumb">
                                                <ul class="breadcrumb-title">
                                                    <li class="breadcrumb-item">
                                                        <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                                    </li>
                                                    <li class="breadcrumb-item"><a href="#!">Change Email</a> </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Page-header end -->

                                <div class="page-body">
                                    <div class="row">
                                        <div class="col-12">
                                             <?php if(isset($_SESSION['successMsg'])):  ?>
                                        <div class="alert alert-success background-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="icofont icofont-close-line-circled text-white"></i>
                                            </button>
                                            <strong>Success!</strong> <?php echo $_SESSION['successMsg'];  ?>
                                        </div>
                                        <?php 
                                                        unset($_SESSION['successMsg']);
                                                        endif; ?>

                                            <?php
                                                if(isset($_SESSION['reject'])): ?>
                                        <div class="alert alert-danger background-danger">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="icofont icofont-close-line-circled text-white"></i>
                                            </button>
                                            <strong>Rejected!</strong> <?php echo $_SESSION['reject'];  ?>
                                        </div>
                                        <?php
                                        unset($_SESSION['reject']);
                                        
                                        endif; ?>
                                        </div>
                                        <div class="col-12">
                                         <div class="card">
                                             
<!--                                    <div class="card-header table-card-header">
                                            <h5></h5>
                                        </div>
 -->                                        <div class="card-block">
                                            <div class="dt-responsive table-responsive">
                            <table id="basic-btn" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Status</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $select= "SELECT * FROM `user_registration`";
                                      $res=mysqli_query($con,$select);
                                      if (!$res) {
                                         mysqli_error($con);
                                      }
                                      $x = 1;
                                    while($data=mysqli_fetch_array($res)) {



                                       ?>
                                    <tr>
                                      <td><?php echo $x++; ?></td>
                                      <td><?php echo $data['user_name']; ?></td>
                                      <td><?php echo $data['full_name']; ?></td>
                                      <td><?php echo $data['email'];?></td>
                                   
                                      <td><?php ?>
                                      <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?=$x?>">
                                              Update Email
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal<?=$x?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel<?=$x?>">Update Email</h5>
                                                  </div>
                                                  <div class="modal-body">
                                                   <form method="post">
                                                        <!-- START OTP VALIDATION -->
                                                        <div class="mb-3">
                                                            <input type="hidden" value="" id="gtron-wallet"/>
                                                            <div class="input-group "> 
                                                                <input type="hidden" value="<?php echo $_SESSION['admin_name'];?>" id="owner" />
                                                                <input type="text" name="otpCode" class="form-control" id="admin-mail" value="<?php echo $_SESSION['admin_email'];?>" placeholder="Otp Code Sent on Email" >
                                                                <button class="btn btn-secondary sendOtpEmail" type="button" >SEND OTP</button>
                                                            </div>
                                                            <p class="text-success otpSendSuccessMessage"></p>
                                                            <p class="text-danger otpSendErrorMessage"></p>

                                                            <div class="input-group ">
                                                                <input type="text" class="form-control" id="otp-value" placeholder="Enter Otp and confirm">
                                                                <button class="btn btn-secondary confirmOtp" type="button" >CONFIRM OTP</button>
                                                            </div>
                                                            <p class="text-success confirmOtpSuccessMessage"></p>
                                                            <p class="text-danger confirmOtpErrorMessage"></p>
                                                        </div>
                                                        <!-- END OTP VALIDATION -->
                                                        <div class="row p-2 mx-auto">
                                                        <div>
                                                            <label>Current Email</label>
                                                            <input type="email" name="currentEmail" value="<?=$data['email']?>" readonly class="form-control">  
                                                        </div>
                                                        <br>
                                                        <div>
                                                            <label>New Email</label>
                                                            <input type="email" name="newEmail" class="form-control">
                                                        </div>
                                                        
                                                    </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                                   </form>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                      </td>
                                      
                                    </tr>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                   <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Status</th> 
                                    </tr>
                                </tfoot>                                
                            </table>
                                </div>
                            </div>
                        </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


 <?php include "footer.php"; ?>

 <script>
	// START OTP VALIDATION
	$(".sendOtpEmail").click(function(){
        let sendMail = 'Email Send';
        let owner = document.getElementById('owner').value;
        let email = document.getElementById('admin-mail').value;
		if(email == ''){
            alert("please enter valid enail");
            return;
        }

        $(".sendOtpEmail").prop('disabled', true);
        $(".sendOtpEmail").text('Processing');
        $.post("./ajax/ajax_admin_otp_generator.php",{otp_send:sendMail, owner:owner, email:email}).done(function (feedback) {
            if(feedback == 'Email Sent Successfully') {
                $('.otpSendSuccessMessage').text(feedback);
                $('.otpSendErrorMessage').text('');
            } else {
                $('.otpSendSuccessMessage').text('');
                $('.otpSendErrorMessage').text("Oops something went wrong!");
            }
            $(".sendOtpEmail").prop('disabled', false);
            $(".sendOtpEmail").text('SEND OTP');
            // ...
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            console.error(textStatus, errorThrown);
            alert("Error occurred during the AJAX request. Check the console for details.");
        })
    })

    $(".confirmOtp").click(function(){
        var userInptOTP = document.getElementById('otp-value').value;
        let owner = document.getElementById('owner').value;
        let email = document.getElementById('admin-mail').value;
        if(userInptOTP == ''){
            alert("please enter valid otp");
            return;
        } 
        $(".confirmOtp").prop('disabled', true);
        $(".confirmOtp").text('Processing');
        $.post("./ajax/ajax_admin_otp_confirmation.php",{action:"confirm-otp",userInptOTP:userInptOTP, owner:owner, email:email}).done(function (feedback) {
            if(feedback == 'success') {
                $('.confirmOtpSuccessMessage').text(feedback);
                $('.confirmOtpErrorMessage').text('')
            } else {
                $('.confirmOtpSuccessMessage').text('');
                $('.confirmOtpErrorMessage').text(feedback);
            }
            $(".confirmOtp").prop('disabled', false);
            $(".confirmOtp").text('CONFIRM OTP');
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            console.error(textStatus, errorThrown);
            alert("Error occurred during the AJAX request. Check the console for details.");
        })
    })
	// END OTP VALIDATION
</script>