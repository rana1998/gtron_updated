<?php
	include "header.php";
    // exit();
// Getting user details from user_registration table 
	if(isset($_GET['id']) && $_GET['id'] != ''){
		$getid = $_GET['id'];
		$select = "SELECT * FROM pre_registration WHERE id = '$getid'";
		$selrun = mysqli_query($con, $select);
		if(mysqli_num_rows($selrun) >0){
		$data = mysqli_fetch_array($selrun);
		$user_name = $data['user_name'];
        $id = $data['id'];
        $email = $data['email'];
        $country = $data['country'];
        $contact_no = $data['contact_no'];
        $referral_link = $data['referral_link'];
        $user_referral_id = $data['user_referral_id'];
        $referrer_user_id = $data['referrer_user_id'];
        $reffered_user_count = $data['reffered_user_count'];  // Note the typo in the key name
        $gtron = $data['gtron'];
        $registration_date = $data['registration_date'];
        $is_24hour_later_email_sent	 = $data['is_24hour_later_email_sent'];

		
		// echo "$user_name";

        // exit();
		
		}
        else{
			$_SESSION['errorMsg'] = "Invalid Request.";
			header("Location: user_level_distribution.php");
			exit();
		}
	}else{
			$_SESSION['errorMsg'] = "Invalid Request.";
			header("Location: user_level_distribution.php");
			exit();
	}


// Update Current Balance and ROI Balance in user_registration table

if(isset($_POST['update'])){

	// if(isset($_SESSION['isOTPmatch']) && $_SESSION['isOTPmatch'] == true) {
		//OTP VALIDATION VIA SESSION SESSION['isOTPmatch'] WILL BE UPDATED AS FALSE WHENEVER USER RELOAD PAGE AND GOT TO ANOTHER PAGE AFTER SENDING OTP IN MAIL
		// $_SESSION['isOTPmatch'] = false;

        $user_id = $_POST['user_id'];
        $email = $_POST['email'];
        $country = $_POST['country'];
        $contact_no = $_POST['contact_no'];
        $referral_link = $_POST['referral_link'];
        $user_referral_id = $_POST['user_referral_id'];
        $referrer_user_id = $_POST['referrer_user_id'];
        $reffered_user_count = $_POST['reffered_user_count']; // Note the typo in the key name
        $gtron = $_POST['gtron'];
        $registration_date = $_POST['registration_date'];
        $level = $_POST['level'];
        $parent_id = 0;

        //To parent 
        if($referrer_user_id != '') {
            $query = "SELECT *
            FROM pre_registration
            WHERE user_referral_id = '$referrer_user_id'
            LIMIT 1";

            $result = mysqli_query($con, $query);

            if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
            // Use $row to access individual column values
            // For example: $userReferralID = $row['user_referral_id'];
             $parent_id = $row['id'];

            // Prepare the SQL query
            $select = "SELECT COUNT(*) AS descendant_count FROM user_hierarchy WHERE parent_user_id = '$parent_id'";

            // Execute the query
            $result = mysqli_query($con, $select);

            if ($result) {
                // Fetch the result
                $row = mysqli_fetch_assoc($result);
                
                // Get the descendant count
                $descendant_count = $row['descendant_count'];
                
                // Use the descendant count as needed
                // echo "Descendant count: " . $descendant_count;
                if($descendant_count >= 5) {
                    $_SESSION['errorMsg'] = "only 5 direct user allowed.";
                    header("Location: user_level_distribution.php");
                    exit();
                }
            } else {
                // Handle query error
                // echo "Error executing query: " . mysqli_error($con);
                $_SESSION['errorMsg'] = "Error executing query: " . mysqli_error($con);
                header("Location: user_level_distribution.php");
                exit();
            }

            if($descendant_count >= 5) {
                $_SESSION['errorMsg'] = "only 5 directuser allowed.";
                header("Location: user_level_distribution.php");
                exit();
                // return;
            }

            } else {
            // No matching row found
            // echo "No matching row found.";
            // Insert failed
            $_SESSION['errorMsg'] = "No matching row found.";
            header("Location: user_level_distribution.php");
            exit();
            }
            mysqli_free_result($result);

            } else {
            // Query execution failed
            // echo "Error executing query: " . mysqli_error($con);
            $_SESSION['errorMsg'] = "Error executing query: " . mysqli_error($con);
            header("Location: user_level_distribution.php");
            exit();
            }
        }
        

        $insert_query = "INSERT INTO user_hierarchy 
                 (`user_id`,`user_name`, `email`, `parent_user_id`,`country`, `contact_no`, `referral_link`, `user_referral_id`, 
                 `referrer_user_id`, `reffered_user_count`, `gtron`, `registration_date`, `user_level`, `is_24hour_later_email_sent`)
                 VALUES
                 ('$user_id','$user_name', '$email', '$parent_id','$country', '$contact_no', '$referral_link', '$user_referral_id', 
                 '$referrer_user_id', '$reffered_user_count', '$gtron', '$registration_date', '$level', '$is_24hour_later_email_sent')";

                // print_r($insert_query);
                // exit();

            // Run the query
            if (mysqli_query($con, $insert_query)) {
                // Insert successful
                $_SESSION['successMsg'] = "User registration successful.";
                header("Location: user_level_distribution.php");
                // header("Location: edit_user_level_distribution.php?id=$getid");
                exit();
            } else {
                // Insert failed
                $_SESSION['errorMsg'] = "User registration failed.";
                header("Location: user_level_distribution.php");
                // header("Location: edit_user_level_distribution.php?id=$getid");
                exit();
            }
	// } 
	// else {
	// 	$_SESSION['errorMsg'] = "Please valided your email via OTP.";
	// 	header("Location: user_level_distribution.php?id=$getid");
	// 	exit();
	// }
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
							<h4>Update user level</h4>
							<span>Update user level</span>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="page-header-breadcrumb">
						<ul class="breadcrumb-title">
							<li class="breadcrumb-item">
								<a href="index-1.htm"> <i class="feather icon-home"></i> </a>
							</li>
							<li class="breadcrumb-item"><a href="#!">user level</a> </li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- Page-header end -->
		<div class="page-body">
			<div class="row">
				<div class="col-md-6 ml-auto mr-auto">
					<form class="md-float-material form-material" method = "POST">
						<div class="auth-box card">
							<div class="card-block">
								<div class="row m-b-20">
									<div class="col-md-12">
										<h3 class="text-center">user level</h3>
									</div>
								</div>
								<div class="row m-b-20">
									<div class="col-md-12 text-center">
                                    
			                            <!-- Error Message  -->
			                    <?php if (isset($_SESSION['errorMsg'])) {
			                    ?>
			                    <div class="alert alert-danger background-danger">
			                        <button type="button" class="close m-0" data-dismiss="alert" aria-label="Close">
			                        <i class="icofont icofont-close-line-circled text-default"></i>
			                        </button>
			                        <strong>Error!</strong> <?php echo $_SESSION['errorMsg'];?>
			                    </div>
			                    <?php
			                    unset($_SESSION['errorMsg']);
			                    } ?>
								</div>
							</div>

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

								<div class="form-group form-primary">
									<label>Username</label>
									<input type = "text" name="user_name" class="form-control" value = "<?php echo $user_name; ?>" readonly/>
								</div>
                                <div class="form-group form-primary">
									<label>Userid</label>
									<input type = "text" name="user_id" class="form-control" value = "<?php echo $id; ?>" readonly/>
								</div>
                                <div class="form-group form-primary">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" readonly/>
                                </div>

                                <div class="form-group form-primary">
                                    <label>Country</label>
                                    <input type="text" name="country" class="form-control" value="<?php echo $country; ?>" readonly/>
                                </div>

                                <div class="form-group form-primary">
                                    <label>Contact Number</label>
                                    <input type="text" name="contact_no" class="form-control" value="<?php echo $contact_no; ?>" readonly/>
                                </div>

                                <div class="form-group form-primary">
                                    <label>Referral Link</label>
                                    <input type="text" name="referral_link" class="form-control" value="<?php echo $referral_link; ?>" readonly/>
                                </div>

                                <div class="form-group form-primary">
                                    <label>User Referral ID</label>
                                    <input type="text" name="user_referral_id" class="form-control" value="<?php echo $user_referral_id; ?>" readonly/>
                                </div>

                                <div class="form-group form-primary">
                                    <label>Referrer User ID</label>
                                    <input type="text" name="referrer_user_id" class="form-control" value="<?php echo $referrer_user_id; ?>" readonly/>
                                </div>

                                <div class="form-group form-primary">
                                    <label>Referred User Count</label>
                                    <input type="text" name="reffered_user_count" class="form-control" value="<?php echo $reffered_user_count; ?>" readonly/>
                                </div>

                                <div class="form-group form-primary">
                                    <label>Gtron</label>
                                    <input type="text" name="gtron" class="form-control" value="<?php echo $gtron; ?>" readonly/>
                                </div>

                                <div class="form-group form-primary">
                                    <label>Registration Date</label>
                                    <input type="text" name="registration_date" class="form-control" value="<?php echo $registration_date; ?>" readonly/>
                                </div>

                                <div class="form-group form-primary">
                                    <label>Level</label>
                                    <input type="text" name="level" class="form-control" value="" />
                                </div>
								
								<div class="row m-t-30">
									<div class="col-md-12">
										<button type="submit" id="submitButton" class="btn btn-warning btn-md btn-block waves-effect text-center m-b-20" name = "update">Update</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				</div> <!-- .row -->
			</div>
		</div>
	</div>
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

	    $('#enterAmount').on("keyup",function()
	    {
	        var enterAmount = $('#enterAmount');
	        var updateAmount = $('#updateAmount');
	        var currentBalance  = $('#currentBalance');
	        var submitButton = $('#submitButton');
	        var type = $('#type');
	       // alert(enterAmount+' '+updateAmount+' '+currentBalance+' '+submitButton);
	       // alert(type.val());
	        if(type.val()==='')
	        {
	            $('#typeError').text('Plese select type first');

	        }
	        else if(type.val()==='Credit')
	        {
	            $('#typeError').text('');
	            
	            if(enterAmount.val() ==='')
    	        {
    	            updateAmount.val('');
    	            submitButton.show();
    	        }
    	        else
    	        {
    	            updateAmount.val(parseInt(currentBalance.val()) + parseInt(enterAmount.val()));
    	            submitButton.show();
    	            
    	        }
	        }
	        else if(type.val()==='Debit')
	        {
	            $('#typeError').text('');
	            
	            if(enterAmount.val() ==='')
    	        {
    	            updateAmount.val('');
    	            submitButton.show();
    	        }
    	        else if(parseInt(enterAmount.val())  > parseInt(currentBalance.val()))
    	        {
    	            updateAmount.val('Available balance is low');
    	            submitButton.hide();
    	        }
    	        else
    	        {
    	             updateAmount.val(parseInt(currentBalance.val()) - parseInt(enterAmount.val()));
    	            submitButton.show();
    	        }
	        }
	        
	        
	    })
	</script>