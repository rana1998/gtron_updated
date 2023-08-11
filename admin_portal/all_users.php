<?php 

    include "header.php";
// Login User Account from Admin Panel
    if (isset($_GET['id']) && $_GET['action']=='Login') {
    $id = $_GET['id'];
    $select = "SELECT * FROM user_registration WHERE id  = '$id'";
    $run=mysqli_query($con,$select);

        if(!$run){
            echo mysqli_error($con);
        }else{
            $row = mysqli_fetch_array($run);
            $_SESSION['user_name'] = $row['user_name'];
            header("Location: ../member/index.php");
            exit();
        }
}

// Blocked User

        if (isset($_GET['id']) && $_GET['action']=='Block') {
            if(isset($_SESSION['isOTPmatch']) && $_SESSION['isOTPmatch'] == true) {
                //OTP VALIDATION VIA SESSION SESSION['isOTPmatch'] WILL BE UPDATED AS FALSE WHENEVER USER RELOAD PAGE AND GOT TO ANOTHER PAGE AFTER SENDING OTP IN MAIL
                $_SESSION['isOTPmatch'] = false;
        $id = $_GET['id'];
        $update = "UPDATE user_registration SET login_status = 'Block' WHERE id ='$id'";
        $run=mysqli_query($con,$update);

            if(!$run){
                echo mysqli_error($con);
            }else{
                $_SESSION['successMsg'] = "User login status is blocked";
                header("Location: all_users.php");
                exit();
            }

        } 
        else {
            $_SESSION['errorMsg'] = 'Please valided your email via OTP.';
            header("Location: all_users.php");
            exit();
        }

}else if  (isset($_GET['id']) && $_GET['action']=='Unblock'){
    if(isset($_SESSION['isOTPmatch']) && $_SESSION['isOTPmatch'] == true) {
        //OTP VALIDATION VIA SESSION SESSION['isOTPmatch'] WILL BE UPDATED AS FALSE WHENEVER USER RELOAD PAGE AND GOT TO ANOTHER PAGE AFTER SENDING OTP IN MAIL
        $_SESSION['isOTPmatch'] = false;
     $id = $_GET['id'];
        $update = "UPDATE user_registration SET login_status = 'Unblock' WHERE id ='$id'";
        $run=mysqli_query($con,$update);

            if(!$run){
                echo mysqli_error($con);
            }else{
            $_SESSION['successMsg'] = "User login status is Unblocked";
                header("Location: all_users.php");
                exit();

            }
            
        }else {
                $_SESSION['errorMsg'] = 'Please valided your email via OTP.';
                header("Location: all_users.php");
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
                                                    <h4>List of All Users</h4>
                                                    <span>Following are the list of all users </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="page-header-breadcrumb">
                                                <ul class="breadcrumb-title">
                                                    <li class="breadcrumb-item">
                                                        <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                                    </li>
                                                    <li class="breadcrumb-item"><a href="#!">All Users</a> </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Page-header end -->

                                <div class="page-body">
                          <div class="row">
                                            <div class="col-sm-12">
                                                <!-- HTML5 Export Buttons table start -->
                                                <div class="card">
                                                     <div class="card-header table-card-header">
                                                                <!-- Sussess Message  -->
                                                        <?php if (isset($_SESSION['successMsg'])) {
                                                        ?>
                                                        <div class="alert alert-success background-success">
                                                            <button type="button" class="close m-0" data-dismiss="alert" aria-label="Close">
                                                            <i class="icofont icofont-close-line-circled text-default"></i>
                                                            </button>
                                                            <strong>Success!</strong> <?php echo $_SESSION['successMsg'];?>
                                                        </div>
                                                        <?php
                                                        unset($_SESSION['successMsg']);
                                                        } ?>


                                                    </div>
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="basic-btn" class="table table-striped table-bordered nowrap" data-page-length='100'>
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Full Name</th>
                                                                        <th>User Name</th>
                                                                        <th>Sponsor Name</th>
                                                                        <th>Email</th>
                                                                        <th>Phone</th>
                                                                        <th>Status</th>
                                                                        <th>OTP</th>
                                                                        <th>Datetime</th>
                                                                        <th>Login Status</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                        <?php 
                        $sql = "SELECT * FROM  user_registration";
                        $result = mysqli_query($con, $sql);
                        $x= 1;
                        while ( $data = mysqli_fetch_array($result)):
                            $id = $data['id'];
                            $status = $data['status'];
                            $loginStatus = $data['login_status'];
    // echo "$pos";
                        ?>
                                                            <tr>
                                                                <td><?php echo $x++;  ?></td>
                                                                <td><?php echo $data['full_name'];  ?></td>
                                                                <td><?php echo $data['user_name'];  ?></td>
                                                                <td><?php echo $data['sponsor_name'];  ?></td>
                                                                <td><?php echo $data['email'];  ?></td>
                                                                <td><?php echo $data['mobile'];  ?></td>
                                                                
                                                                
                                                        
                                                                <td><?php if ($status == 'Approved') {
  	            echo "<span class=\"badge badge-success\">Approved</span>"; 
  	            }
  	            
  	            elseif ($status != 'Approved') {
  	            echo "<span class=\"badge badge-warning text-white \">$status</span>";
  	            }
  	            
  	            
  	            ?></td>
                                                                
                                                                
                                                                
                                                                
                                                                <td><?php echo $data['otp_code']  ?></td>
                                                                <!-- <td><?php echo date('Y-m-d',strtotime($data['date']) );  ?></td> -->
                                                                <td><?php echo date('Y-m-d:h-m-s',strtotime($data['date']) );  ?></td>

                                                                
                                                                
                                                                <td><?php if ($loginStatus == 'Unblock') {
  	            echo "<span class=\"badge badge-success\">Active</span>"; 
  	            }
  	            
  	            elseif ($loginStatus != 'Unblocked') {
  	            echo "<span class=\"badge badge-danger text-white \">Blocked</span>";
  	            }
  	            
  	            
  	            ?></td>
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                <td>
                                                                    <?php if($data['login_status'] == 'Unblock'): ?>
                                                                        <button class="btn btn-outline-danger btn-sm block-button"
                                                                                data-user-id="<?php echo $id; ?>"
                                                                                data-action-type-id="Block"
                                                                                data-toggle="modal"
                                                                                data-target="#otpModal">
                                                                            Block
                                                                        </button>
                                                                    <!-- <a href="all_users.php?id=<?php echo $id ; ?>&action=Block" class="btn btn-outline-danger btn-sm" >Block</a> -->

                                                                     <?php elseif($data['login_status'] == 'Block'): ?>
                                                                        <button class="btn btn-outline-danger btn-sm block-button"
                                                                                data-user-id="<?php echo $id; ?>"
                                                                                data-action-type-id="Unblock"
                                                                                data-toggle="modal"
                                                                                data-target="#otpModal">
                                                                                Unblock
                                                                        </button>
                                                                    <!-- <a href="all_users.php?id=<?php echo $id ; ?>&action=Unblock" class="btn btn-outline-success btn-sm" >Unblock</a> -->

                                                                     <?php endif; ?>   
                                                                     <!-- <button class="btn btn-outline-info btn-sm block-button"
                                                                                data-user-id="<?php echo $id; ?>"
                                                                                data-action-type-id="Login"
                                                                                data-toggle="modal"
                                                                                data-target="#otpModal">
                                                                                Login
                                                                    </button> -->
                                                                    <a href="all_users.php?id=<?php echo $id ; ?>&action=Login" class="btn btn-outline-info btn-sm" target= "_blank" >Login</a>

                                                                </td>
                                                            </tr>
                        <?php endwhile; ?>                                    
                                                        </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Full Name</th>
                                                                        <th>User Name</th>
                                                                        <th>Sponsor Name</th>
                                                                        <th>Email</th>
                                                                        <th>Phone</th>
                                                                        <th>Status</th>
                                                                        <th>OTP</th>
                                                                        <th>Date</th>
                                                                        <th>Login Status</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- HTML5 Export Buttons end -->
                                            </div>
                                        </div>


                                </div>
                            </div>
                        </div>

                        <!-- OTP MODAL START -->
                        <div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="otpModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="otpModalLabel">Send OTP via Email</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <!-- <form id="otpForm">
                                            <input type="email" name="email" placeholder="Email Address" required>
                                            <button type="submit" class="btn btn-primary">Send OTP</button>
                                        </form> -->
                                        <!-- START OTP VALIDATION -->
                                        <div class="mb-3">
                                            <input type="hidden" value="" id="gtron-wallet"/>
                                            <div class="input-group "> 
                                                <input type="hidden" value="" id="userid" />
                                                <input type="hidden" value="" id="action-type-id" />
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

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- OTP MODAL END -->

                        



<?php
    include "footer.php";
?>

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
                // Perform another AJAX request to block the user
                var userId = document.getElementById('userid').value;
                let action = document.getElementById('action-type-id').value;
                var postUrl = `all_users.php?id=${userId}&action=${action}`;
                window.location.href = postUrl;

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

<script>
    $(document).ready(function() {
        $('.block-button').click(function() {
            var userId = $(this).data('user-id');
            var actiontype = $(this).data('action-type-id');
            document.getElementById('userid').value = userId;
            document.getElementById('action-type-id').value = actiontype;
            $('#otpModal').modal('show');
        });
    });

</script>