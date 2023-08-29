<?php
ob_start();
include "header.php";
// insert code
	if(isset($_POST['create'])){
		if(isset($_SESSION['isOTPmatch']) && $_SESSION['isOTPmatch'] == true) {
		//OTP VALIDATION VIA SESSION SESSION['isOTPmatch'] WILL BE UPDATED AS FALSE WHENEVER USER RELOAD PAGE AND GOT TO ANOTHER PAGE AFTER SENDING OTP IN MAIL
		$_SESSION['isOTPmatch'] = false;

		$packageName = strtolower(mysqli_real_escape_string($con,$_POST['packageName']));
		$packageAmount = mysqli_real_escape_string($con,$_POST['packageAmount']);

        // $noOfDays = mysqli_real_escape_string($con,$_POST['noOfDays']);
        // $percentage = mysqli_real_escape_string($con,$_POST['percentage']);
        // $minAmount = mysqli_real_escape_string($con,$_POST['minAmount']);
        // $maxAmount = mysqli_real_escape_string($con,$_POST['maxAmount']);
        // $returnCapital = mysqli_real_escape_string($con,$_POST['returnCapital']);

        // if(empty($packageName) || empty($noOfDays) || empty($percentage) || empty($minAmount) || empty($maxAmount) || empty($returnCapital))
        // {
        //         $_SESSION['errorMsg']='Please fill all data';
		// 		header("Location: create_package.php");
		// 		exit();
        // }

		if(empty($packageName) || empty($packageAmount))
        {
                $_SESSION['errorMsg']='Please fill all data';
				header("Location: create_package.php");
				exit();
        }
        
         $file= $_FILES['file'];
	   //echo $file;
	   //exit();
	   //Image settings
        $ImgName = $file['name'];
        $ImgError = $file['error'];
        $ImgTemp = $file['tmp_name'];
        $ImgSize = $file['size'];
    
        $ImgText = explode('.',$ImgName);
        $ImgCheck = strtolower(end($ImgText));

        if(empty($ImgName))
        {
            $_SESSION['errorMsg'] = "Please select logo";
            header("Location: create_package.php");
            exit();
        }
        elseif($ImgSize > 5000000)
        {
            $_SESSION['errorMsg'] = "Image size is greater than 5MB";
            header("Location: create_package.php");
            exit();
        }
        elseif($ImgCheck=='png' || $ImgCheck=='jpg' || $ImgCheck=='jpeg')
        {
          $ImgName = preg_replace("/\s+/","", $ImgName);
            $ImgDestinationFile = 'images/packageImages/'.md5(rand()).'-'.$ImgName;
            move_uploaded_file($ImgTemp, $ImgDestinationFile);
            
           // Insert into bank table
    		// $insert = "INSERT INTO `package`(`package_name`, `no_of_days`, `percentage_per_day`, `min_amount`, `max_amount`,`image`, `capital`) 
    		// VALUES ('$packageName','$noOfDays','$percentage','$minAmount','$maxAmount','$ImgDestinationFile','$returnCapital')";
			$insert = "INSERT INTO `package`(`package_name`, `pkg_price`, `image`) 
    		VALUES ('$packageName','$packageAmount','$ImgDestinationFile')";
    		$run_insert = mysqli_query($con, $insert);
    			if(!$run_update && !$run_insert){
    				echo '<h6>'.mysqli_error( $con ).'</h6>';
    				exit();
    			}

				$_SESSION['successMsg']='Package Created Successfully.';
				header("Location: create_package.php");
				exit(); 
        
          }
         else
        {
            $_SESSION['errorMsg'] = "Image format not PNG, JPG, JPEG";
            header("Location: create_package.php");
            exit();
        }

		} 
		else {
			$_SESSION['errorMsg'] = "Please valided your email via OTP.";
			header("Location: create_package.php");
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
							<h4>Package</h4>
							<span>Package Details </span>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="page-header-breadcrumb">
						<ul class="breadcrumb-title">
							<li class="breadcrumb-item">
								<a href="index-1.htm"> <i class="feather icon-home"></i> </a>
							</li>
							<li class="breadcrumb-item"><a href="#!">Package</a> </li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- Page-header end -->
		<div class="page-body">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 ml-auto mr-auto">
						
						<div class="auth-box card">
							<div class="card-block">
								<div class="row m-b-20">
									<div class="col-md-12">
										<h3 class="text-center ">Create Package</h3>

                                    <!-- Success Message -->
                                    <?php if (isset($_SESSION['successMsg'])) {
                                    ?>
                                    <div class="alert alert-success background-success mb-0">
                                    <button type="button" class="close m-0" data-dismiss="alert" aria-label="Close">
                                    <i class="icofont icofont-close-line-circled text-white"></i>
                                    </button>
                                    <strong>Success!</strong> <?php echo $_SESSION['successMsg'] ;?>
                                    </div>
                                    <?php
                                    unset($_SESSION['successMsg']);
                                    } ?>

                                    <!-- Error Message -->
                                    <?php if (isset($_SESSION['errorMsg'])) {
                                    ?>
                                    <div class="alert alert-danger background-danger mb-0">
                                    <button type="button" class="close m-0" data-dismiss="alert" aria-label="Close">
                                    <i class="icofont icofont-close-line-circled text-white"></i>
                                    </button>
                                    <strong>Error!</strong> <?php echo $_SESSION['errorMsg'] ;?>
                                    </div>
                                    <?php
                                    unset($_SESSION['errorMsg']);
                                    } ?>


									</div>
								</div>
							</div>
							<div class="card-body">
								<form  class="md-float-material form-material" action="" enctype="multipart/form-data" method="POST">
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
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Package Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="packageName" id="packageName"  value="">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Package Amount</label>
										<div class="col-sm-9">
											<input type="number" class="form-control" name="packageAmount" id="packageAmount"  value="">
										</div>
									</div>
									<!-- <div class="form-group row">
										<label class="col-sm-3 col-form-label">No of days</label>
										<div class="col-sm-9">
											<input type="number" class="form-control" name="noOfDays" id="noOfDays"  value="">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Percentage Per Day</label>
										<div class="col-sm-9">
											<input type="number" class="form-control" name="percentage" id="percentage"  value="">
										</div>
									</div>
										<div class="form-group row">
										<label class="col-sm-3 col-form-label">Min Amount</label>
										<div class="col-sm-9">
											<input type="number" class="form-control" name="minAmount" id="minAmount"  value="">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Max Amount</label>
										<div class="col-sm-9">
											<input type="number" class="form-control" name="maxAmount" id="maxAmount"  value="">
										</div>
									</div> -->
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Image (png, jpg, jpeg only)</label>
										<div class="col-sm-9">
											<input type="file" class="form-control" name="file" id="file"  value="">
										</div>
									</div>
										<!-- <div class="form-group row">
										<label class="col-sm-3 col-form-label">Return Capital</label>
										<div class="col-sm-9">
											<select class="form-control" id="returnCapital" name="returnCapital">
											    <option value="" hidden>Select</option>
											    <option value="yes">Yes</option>
											    <option value="no">No</option>
											</select>
										</div> -->
									</div>
									<div class="form-group row">
										<div class="col-md-12">
											<button type="submit" class="btn btn-warning btn-md btn-block waves-effect text-center m-b-20" name = "create">Create</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			
			</div>
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
</script>