<?php
include_once("template-parts/footer.php");
include_once("template-parts/header_links.php");
include_once("template-parts/navbar.php");
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">

	<title>Gtron | Home</title>
  
     
  <?php echo header_links(); ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
// const main = () => {
//   const second = 1000
//   const minute = second * 60
//   const hour = minute * 60
//   const day = hour * 24
      
//   //INSERT EVENT DATE AND TIME HERE IN THIS FORMAT: 'June 1, 2023, 19:00:00'
//   const EVENTDATE = new Date('June 1, 2025, 19:00:00')
 
//   const countDown = new Date(EVENTDATE).getTime()
//   const x = setInterval(() => {

//         const now = new Date().getTime()
//         const distance = countDown - now

//         document.getElementById("days").innerText = Math.floor(distance / day)
//         document.getElementById("hours").innerText = Math.floor((distance % day) / (hour))
//         document.getElementById("minutes").innerText = Math.floor((distance % hour) / (minute))
//         document.getElementById("seconds").innerText = Math.floor((distance % minute) / second)

//       //delay in milliseconds
//       }, 0)
//   }

// main();

  </script>
  
  <style>
.navbar {
    height: 60px;
}
#banner_slider .item .robot {
    position: absolute;
    z-index: -2;
    width: 40vw;
    right: 0vw;
    top: 5vw;
    z-index: 9999;
}
   /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0, 0, 0); /* Fallback color */
  background-color: rgba(0, 0, 0, 0.5); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  margin: auto;
  padding: 0;
  width: 95%;
  max-width: 60rem;
  overflow: hidden;
  border-radius: 2px;
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s;

  font-family: "Open Sans", sans-serif;
  background: #fff;
  -webkit-box-shadow: 0px 0px 19px 3px rgba(0, 0, 0, 0.08);
  -moz-box-shadow: 0px 0px 19px 3px rgba(0, 0, 0, 0.08);
  box-shadow: 0px 0px 19px 3px rgba(0, 0, 0, 0.08);

  display: flex;
  align-items: center;
  justify-content: space-between;
}

.modal-content-left,
.modal-content-right {
  flex: 0 1 auto;
}

.modal-content-left {
  flex: 2;
}

.modal-content-left img {
  width: 40rem;
  max-width: 95%;
  margin: 0;
  padding: 0;
  display: block;
  border-radius: 2px;
}

.modal-content-right {
  flex: 2;
  max-width: 100%;
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {
    top: -300px;
    opacity: 0;
  }
  to {
    top: 0;
    opacity: 1;
  }
}

@keyframes animatetop {
  from {
    top: -300px;
    opacity: 0;
  }
  to {
    top: 0;
    opacity: 1;
  }
}

/* The Close Button */
.close,
.close-imp {
  color: #aaa;
  font-size: 2rem;
  font-weight: bold;
  padding: 0 1rem;
  border-radius: 2px;
  transition: 0.4s ease-out;
}

.close:hover,
.close:focus,
.close-imp:hover,
.close-imp:focus {
  color: #111;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  font-family: "Patua One", cursive;
  font-size: 3.5rem;
  margin: 0;
  padding: 0;
}

.modal-header p {
  margin: 0;
  padding: 0;
}

.modal-header,
.modal-body,
.modal-footer {
  padding: 0.5rem 3rem;
}

.modal-header {
  padding-top: 2rem;
}

.modal-footer {
  padding-bottom: 2rem;
}

/* ===== Page Content ===== */

.container {
  width: 100%;
}

/* The Button */

.btn-main {
  display: block;
  background: #222;
  color: #fff;
  padding: 1rem 2rem;
  border: 1px solid #222;
  font-size: 2rem;
  margin: 3rem auto;
  transition: all 0.4s ease-in;
}

.btn-main:hover {
  cursor: pointer;
  color: #222;
  background: #fff;
}</style>

 
    <script>
        $(document).ready(function() {
            // Fetch country code based on selected country
            // Get the modal
const modal = document.querySelector("#myModal");

// Get the button that opens the modal
const btn = document.querySelectorAll(".btn-main");

// Get the <span> element that closes the modal
const closeModal = document.getElementsByClassName("close")[0];

for (let i = 0; i < btn.length; i++) {
  btn[i].addEventListener("click", function () {
    modal.style.display = "block";
  });
}

// When the user clicks the button, open the modal
btn.onclick = function () {
  modal.style.display = "block";
};

// When the user clicks on <span> (x), close the modal
closeModal.onclick = function () {
  modal.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

        });
    </script>

</head>
<body>

<?php
if(isset($_POST["submit"])){


   // Form data
   $name = $_POST['name'];
   $email = $_POST['email'];
   $country = $_POST['country'];
   $phone = $_POST['phone'];
  //  $package = $_POST['package'];
   $countrycode = $_POST['countrycode'];
   
   // Create a new PHPMailer instance
   $mail = new PHPMailer;
   
   // SMTP configuration (change these values with your own)
   $mail->isSMTP();
   $mail->Host = 'mail.gtron.io';
   $mail->SMTPAuth = true;
   $mail->Username = 'no-reply@gtron.io';
   $mail->Password = 'gTron@12@';
   $mail->SMTPSecure = 'ssl';
   $mail->Port = 465;
   
   // Sender and recipient
   $mail->setFrom('no-reply@gtron.io', 'GTron');
   $mail->addAddress('gtorn2023@gmail.com', 'GTron');
   
   // Email content
   $mail->isHTML(true);
   $mail->Subject = 'Form Submission';
   $mail->Body = "Name: $name<br>Email: $email<br>Country: $country<br>Phone: $countrycode.$phone";
   
   // Send email
   if ($mail->send()) {
      ?><script>Swal.fire({
         icon: 'success',
         title: 'Congratulations!',
         text: 'You have Successfully Claimed $50 of GTron.',
         confirmButtonText: 'OK'
       })</script><?php
   } else {
      ?><script>Swal.fire({
         icon: 'error',
         title: 'Oops...',
         text: 'Something went wrong! Please try again.',
         confirmButtonText: 'OK'
       })</script><?php
   }
   
   
   }
   ?>
 <style>
 
 
 .neon-button {
  font-size: 3rem;
  color: #b38eff;
  display: inline-block;
  cursor: pointer;
  text-decoration: none;
  border: #b38eff .125em solid;
  padding: .25em 1em;
  border-radius: 0.25em;
  text-shadow: 
    0 0 0.125em hsl(0 0% 100% / 0.3),
    0 0 0.45em currentColor;
  box-shadow:
    inset 0 0 0.5em 0 #b38eff,
    0 0 0.5em 0 #b38eff;
  position: relative;
/*   transition: background-color 100ms linear; */
}

.neon-button::before {
  pointer-events: none;
  content: '';
  position: absolute;
  background: #b38eff;
  top: 120%;
  left: 0;
  width: 100%;
  height: 100%;
  
  transform: perspective(1em) rotateX(40deg) scale(1, 0.35);
  filter: blur(1em);
  opacity: 0.7;
}

.neon-button:hover, .neon-button:focus {
/*   background: #b38eff; */
  color: var(--clr-bg);
  text-shadow: none;
  border-radius: 1.5vw;
}

.neon-button::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  box-shadow: 0 0 2em 0.5em #b38eff;
  background-color: #b38eff;
  z-index: -1;
  opacity: 0;
  transition: opacity 100ms linear;
}

.neon-button:hover::before, .neon-button:focus::before {
  opacity: 1;
  border-radius: 1.5vw;
}
.neon-button:hover::after, .neon-button:focus::after {
  opacity: 1;
  border-radius: 1.5vw;
}

  .owl-nav.disabled{
    display: none !important;
  }

  .pk-btn{
    font-family: 'circularstd-medium', serif;
    float: right;
    background: #28154f;
    border: 2px solid #4b2986;
    color: #ffffff;
    font-size: 14px;
    padding: 5px;
    border-radius: 3vw;
    margin-bottom: 20px;
  }




.containerhello h1 {
  font-weight: normal;
  letter-spacing: .1em;
}

</style>   

   <!---------NAVBAR START------>
<?php echo navbar_(); ?>
<div id="countdown"></div>

<script>
  // Set the event date and time (in UTC format)
  const EVENT_DATE = new Date('2023-08-18T19:00:00Z').getTime();

  // Update the countdown every second
  const x = setInterval(() => {
    const now = new Date().getTime();
    const distance = EVENT_DATE - now;

    // Calculate days, hours, minutes, and seconds
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("days").innerHTML = days;
        document.getElementById("hours").innerHTML = hours;
        document.getElementById("minutes").innerHTML = minutes;
        document.getElementById("seconds").innerHTML = seconds;

      

    // // Display the countdown
    // document.getElementById("countdown").innerHTML =
    //   `${days}d ${hours}h ${minutes}m ${seconds}s`;

    // // If the countdown is over, display a message
    // if (distance < 0) {
    //   clearInterval(x);
    //   document.getElementById("countdown").innerHTML = "Event has started!";
    // }
  }, 1000);
</script>
   <!-----NAVBAR END---->
   <div id="myModal" class="modal">
   <div class="modal-content">

<div class="modal-content-right">

  <div class="modal-header">
    <span class="close">&times;</span>
  </div>

  <div class="modal-body form-container form-group">
  <div class="form-popup-bg">
  <div class="form-container">
    <h1>Register Now</h1>
    <p>For more information. Please complete this form.</p>
    <form id="submit" method="post" action="">
      <div class="form-group">
        <label for="">Name</label>
        <input type="text" id="name" name="name" class="form-control" required/>
      </div>
      <div class="form-group">
        <label for="">Email</label>
        <input class="form-control" name="email" id="email" type="text" required/>
      </div>
      <div class="form-group">
        <label for="">Country</label>
               <select id="country" name="country" class="form-control" required>
                           <option value="">Select Country</option>
                           <option value="Afghanistan">Afghanistan</option>
                           <option value="Åland Islands">Åland Islands</option>
                           <option value="Albania">Albania</option>
                           <option value="Algeria">Algeria</option>
                           <option value="American Samoa">American Samoa</option>
                           <option value="Andorra">Andorra</option>
                           <option value="Angola">Angola</option>
                           <option value="Anguilla">Anguilla</option>
                           <option value="Antarctica">Antarctica</option>
                           <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                           <option value="Argentina">Argentina</option>
                           <option value="Armenia">Armenia</option>
                           <option value="Aruba">Aruba</option>
                           <option value="Australia">Australia</option>
                           <option value="Austria">Austria</option>
                           <option value="Azerbaijan">Azerbaijan</option>
                           <option value="Bahamas">Bahamas</option>
                           <option value="Bahrain">Bahrain</option>
                           <option value="Bangladesh">Bangladesh</option>
                           <option value="Barbados">Barbados</option>
                           <option value="Belarus">Belarus</option>
                           <option value="Belgium">Belgium</option>
                           <option value="Belize">Belize</option>
                           <option value="Benin">Benin</option>
                           <option value="Bermuda">Bermuda</option>
                           <option value="Bhutan">Bhutan</option>
                           <option value="Bolivia">Bolivia</option>
                           <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                           <option value="Botswana">Botswana</option>
                           <option value="Bouvet Island">Bouvet Island</option>
                           <option value="Brazil">Brazil</option>
                           <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                           <option value="Brunei Darussalam">Brunei Darussalam</option>
                           <option value="Bulgaria">Bulgaria</option>
                           <option value="Burkina Faso">Burkina Faso</option>
                           <option value="Burundi">Burundi</option>
                           <option value="Cambodia">Cambodia</option>
                           <option value="Cameroon">Cameroon</option>
                           <option value="Canada">Canada</option>
                           <option value="Cape Verde">Cape Verde</option>
                           <option value="Cayman Islands">Cayman Islands</option>
                           <option value="Central African Republic">Central African Republic</option>
                           <option value="Chad">Chad</option>
                           <option value="Chile">Chile</option>
                           <option value="China">China</option>
                           <option value="Christmas Island">Christmas Island</option>
                           <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                           <option value="Colombia">Colombia</option>
                           <option value="Comoros">Comoros</option>
                           <option value="Congo">Congo</option>
                           <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                           <option value="Cook Islands">Cook Islands</option>
                           <option value="Costa Rica">Costa Rica</option>
                           <option value="Cote D'ivoire">Cote D'ivoire</option>
                           <option value="Croatia">Croatia</option>
                           <option value="Cuba">Cuba</option>
                           <option value="Cyprus">Cyprus</option>
                           <option value="Czech Republic">Czech Republic</option>
                           <option value="Denmark">Denmark</option>
                           <option value="Djibouti">Djibouti</option>
                           <option value="Dominica">Dominica</option>
                           <option value="Dominican Republic">Dominican Republic</option>
                           <option value="Ecuador">Ecuador</option>
                           <option value="Egypt">Egypt</option>
                           <option value="El Salvador">El Salvador</option>
                           <option value="Equatorial Guinea">Equatorial Guinea</option>
                           <option value="Eritrea">Eritrea</option>
                           <option value="Estonia">Estonia</option>
                           <option value="Ethiopia">Ethiopia</option>
                           <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                           <option value="Faroe Islands">Faroe Islands</option>
                           <option value="Fiji">Fiji</option>
                           <option value="Finland">Finland</option>
                           <option value="France">France</option>
                           <option value="French Guiana">French Guiana</option>
                           <option value="French Polynesia">French Polynesia</option>
                           <option value="French Southern Territories">French Southern Territories</option>
                           <option value="Gabon">Gabon</option>
                           <option value="Gambia">Gambia</option>
                           <option value="Georgia">Georgia</option>
                           <option value="Germany">Germany</option>
                           <option value="Ghana">Ghana</option>
                           <option value="Gibraltar">Gibraltar</option>
                           <option value="Greece">Greece</option>
                           <option value="Greenland">Greenland</option>
                           <option value="Grenada">Grenada</option>
                           <option value="Guadeloupe">Guadeloupe</option>
                           <option value="Guam">Guam</option>
                           <option value="Guatemala">Guatemala</option>
                           <option value="Guernsey">Guernsey</option>
                           <option value="Guinea">Guinea</option>
                           <option value="Guinea-bissau">Guinea-bissau</option>
                           <option value="Guyana">Guyana</option>
                           <option value="Haiti">Haiti</option>
                           <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                           <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                           <option value="Honduras">Honduras</option>
                           <option value="Hong Kong">Hong Kong</option>
                           <option value="Hungary">Hungary</option>
                           <option value="Iceland">Iceland</option>
                           <option value="India">India</option>
                           <option value="Indonesia">Indonesia</option>
                           <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                           <option value="Iraq">Iraq</option>
                           <option value="Ireland">Ireland</option>
                           <option value="Isle of Man">Isle of Man</option>
                           <option value="Israel">Israel</option>
                           <option value="Italy">Italy</option>
                           <option value="Jamaica">Jamaica</option>
                           <option value="Japan">Japan</option>
                           <option value="Jersey">Jersey</option>
                           <option value="Jordan">Jordan</option>
                           <option value="Kazakhstan">Kazakhstan</option>
                           <option value="Kenya">Kenya</option>
                           <option value="Kiribati">Kiribati</option>
                           <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                           <option value="Korea, Republic of">Korea, Republic of</option>
                           <option value="Kuwait">Kuwait</option>
                           <option value="Kyrgyzstan">Kyrgyzstan</option>
                           <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                           <option value="Latvia">Latvia</option>
                           <option value="Lebanon">Lebanon</option>
                           <option value="Lesotho">Lesotho</option>
                           <option value="Liberia">Liberia</option>
                           <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                           <option value="Liechtenstein">Liechtenstein</option>
                           <option value="Lithuania">Lithuania</option>
                           <option value="Luxembourg">Luxembourg</option>
                           <option value="Macao">Macao</option>
                           <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                           <option value="Madagascar">Madagascar</option>
                           <option value="Malawi">Malawi</option>
                           <option value="Malaysia">Malaysia</option>
                           <option value="Maldives">Maldives</option>
                           <option value="Mali">Mali</option>
                           <option value="Malta">Malta</option>
                           <option value="Marshall Islands">Marshall Islands</option>
                           <option value="Martinique">Martinique</option>
                           <option value="Mauritania">Mauritania</option>
                           <option value="Mauritius">Mauritius</option>
                           <option value="Mayotte">Mayotte</option>
                           <option value="Mexico">Mexico</option>
                           <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                           <option value="Moldova, Republic of">Moldova, Republic of</option>
                           <option value="Monaco">Monaco</option>
                           <option value="Mongolia">Mongolia</option>
                           <option value="Montenegro">Montenegro</option>
                           <option value="Montserrat">Montserrat</option>
                           <option value="Morocco">Morocco</option>
                           <option value="Mozambique">Mozambique</option>
                           <option value="Myanmar">Myanmar</option>
                           <option value="Namibia">Namibia</option>
                           <option value="Nauru">Nauru</option>
                           <option value="Nepal">Nepal</option>
                           <option value="Netherlands">Netherlands</option>
                           <option value="Netherlands Antilles">Netherlands Antilles</option>
                           <option value="New Caledonia">New Caledonia</option>
                           <option value="New Zealand">New Zealand</option>
                           <option value="Nicaragua">Nicaragua</option>
                           <option value="Niger">Niger</option>
                           <option value="Nigeria">Nigeria</option>
                           <option value="Niue">Niue</option>
                           <option value="Norfolk Island">Norfolk Island</option>
                           <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                           <option value="Norway">Norway</option>
                           <option value="Oman">Oman</option>
                           <option value="Pakistan">Pakistan</option>
                           <option value="Palau">Palau</option>
                           <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                           <option value="Panama">Panama</option>
                           <option value="Papua New Guinea">Papua New Guinea</option>
                           <option value="Paraguay">Paraguay</option>
                           <option value="Peru">Peru</option>
                           <option value="Philippines">Philippines</option>
                           <option value="Pitcairn">Pitcairn</option>
                           <option value="Poland">Poland</option>
                           <option value="Portugal">Portugal</option>
                           <option value="Puerto Rico">Puerto Rico</option>
                           <option value="Qatar">Qatar</option>
                           <option value="Reunion">Reunion</option>
                           <option value="Romania">Romania</option>
                           <option value="Russian Federation">Russian Federation</option>
                           <option value="Rwanda">Rwanda</option>
                           <option value="Saint Helena">Saint Helena</option>
                           <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                           <option value="Saint Lucia">Saint Lucia</option>
                           <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                           <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                           <option value="Samoa">Samoa</option>
                           <option value="San Marino">San Marino</option>
                           <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                           <option value="Saudi Arabia">Saudi Arabia</option>
                           <option value="Senegal">Senegal</option>
                           <option value="Serbia">Serbia</option>
                           <option value="Seychelles">Seychelles</option>
                           <option value="Sierra Leone">Sierra Leone</option>
                           <option value="Singapore">Singapore</option>
                           <option value="Slovakia">Slovakia</option>
                           <option value="Slovenia">Slovenia</option>
                           <option value="Solomon Islands">Solomon Islands</option>
                           <option value="Somalia">Somalia</option>
                           <option value="South Africa">South Africa</option>
                           <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                           <option value="Spain">Spain</option>
                           <option value="Sri Lanka">Sri Lanka</option>
                           <option value="Sudan">Sudan</option>
                           <option value="Suriname">Suriname</option>
                           <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                           <option value="Swaziland">Swaziland</option>
                           <option value="Sweden">Sweden</option>
                           <option value="Switzerland">Switzerland</option>
                           <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                           <option value="Taiwan">Taiwan</option>
                           <option value="Tajikistan">Tajikistan</option>
                           <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                           <option value="Thailand">Thailand</option>
                           <option value="Timor-leste">Timor-leste</option>
                           <option value="Togo">Togo</option>
                           <option value="Tokelau">Tokelau</option>
                           <option value="Tonga">Tonga</option>
                           <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                           <option value="Tunisia">Tunisia</option>
                           <option value="Turkey">Turkey</option>
                           <option value="Turkmenistan">Turkmenistan</option>
                           <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                           <option value="Tuvalu">Tuvalu</option>
                           <option value="Uganda">Uganda</option>
                           <option value="Ukraine">Ukraine</option>
                           <option value="United Arab Emirates">United Arab Emirates</option>
                           <option value="United Kingdom">United Kingdom</option>
                           <option value="United States">United States</option>
                           <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                           <option value="Uruguay">Uruguay</option>
                           <option value="Uzbekistan">Uzbekistan</option>
                           <option value="Vanuatu">Vanuatu</option>
                           <option value="Venezuela">Venezuela</option>
                           <option value="Viet Nam">Viet Nam</option>
                           <option value="Virgin Islands, British">Virgin Islands, British</option>
                           <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                           <option value="Wallis and Futuna">Wallis and Futuna</option>
                           <option value="Western Sahara">Western Sahara</option>
                           <option value="Yemen">Yemen</option>
                           <option value="Zambia">Zambia</option>
                           <option value="Zimbabwe">Zimbabwe</option>
                     </select>

      </div>
      <div class="form-group">
        <label for="">Phone Number</label>
        <!-- <input class="form-control" name="countrycode" type="text" id="countrycode" required /> -->
        <input class="form-control" name="phone" type="text" id="phone" required />
      </div>
      <div class="form-group">
      <label for="plan">Choose the Package:</label>
            <select id="package" name="package" class="form-control" required>
                <option value="">Select Package</option>
                <option value="50 usdt">$50 usdt</option>
                <option value="100 usdt">$100 usdt</option>
                <option value="250 usdt">$250 usdt</option>
                <option value="500 usdt">$500 usdt</option>
                <option value="1000 usdt">$1000 usdt</option>
                <!-- Add more plans here -->
            </select></div>
      <button id="submit" name="submit" class="pk-btn">Submit</button>
    </form>
  </div>
</div>
 </div>
</div>
</div>
</div>


<section id="banner">
<style>
h1.decs {
    font-size: 4vw!important;
    color: #51ECF1!important;
    line-height: 4vw;
}
.containerhello{
  color: #fff!important;
}

.containerhello h1 {
  font-weight: normal;
  letter-spacing: .1em;
}

.containerhello li {
  display: inline-block;
  list-style-type: none;
  font-size: 1.5em;
  padding: 1em;
}

.containerhello li span {
  display: block;
  font-size: 4.5rem;
}
</style>
   <img src="assets/images/banner_glow.png" class="banner_glow">

<div id="banner_slider">
    <div class="item">
       <img class="robot" src="assets/images/coins.png">
      <h1 id="header">Launching Soon</h1>
      <h1 class="decs">WORLDS FIRST WEB3 POWERED <br> DECENTRALIZED MLM PLATFORM.</h1>
      <div class="containerhello">
          
          <div id="countdown">
            <ul>
              <li><span id="days"></span>DAYS</li>
              <li><span id="hours"></span>HOURS</li>
              <li><span id="minutes"></span>MINUTES</li>
              <li><span id="seconds"></span>SECONDS</li>
            </ul>
        </div>
      </div>



      <hr>
   </div>
</div>


</section>
<style>
#contact label,
input,
textarea {
    display: block;
    width: 100%;
}
#contact ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

#contact li {
    padding: 0.3em;
}
#contact span {
    font-weight: 700;
    color: #102a43;
    line-height: 35px;
    line-height: 2.5rem;
    font-size: 12px;
    font-size: 0.8rem;
    text-transform: uppercase;
}
input[type="submit"] {
    background: #fc4366!important;
    color: white!important;
    font-weight: 700;
    font-size: 1.2rem;
    border-radius: 5px;
    margin-top: 1.3em;
}

.container {

    margin: 5em auto;
}
#contact form {
    background-color: #ffffff;
    padding-top: 40px;
    padding-right: 40px;
    padding-bottom: 40px;
    padding-left: 40px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    border-radius: 3px;
    overflow: hidden;
}

.required-star {
    color: #fc4366;
}

#contact input,
textarea {
    width: 100%;
    padding: 9px 20px;
    border: 1px solid #e1e2eb;
    background-color: #fff;
    color: #102a43;
    caret-color: #829ab1;
    box-sizing: border-box;
    font-size: 14px;
    font-size: 1rem;
    line-height: 29px;
    line-height: 2rem;
    box-shadow: inset 0 2px 4px 0 rgba(206, 209, 224, 0.2);
    border-radius: 3px;
    line-height: 29px;
    line-height: 2rem;
}</style>

<section id="contact">
<div class="container">


            <form id="submit" method="post" action="">
      <div class="form-group">
        <label for="">Name</label>
        <input type="text" id="name" name="name" class="form-control" required/>
      </div>
      <div class="form-group">
        <label for="">Email</label>
        <input class="form-control" name="email" id="email" type="email" required/>
      </div>
      <div class="form-group">
        <label for="">Country</label>
               <select id="country" name="country" class="form-control" required>
                           <option value="">Select Country</option>
                           <option value="Afghanistan">Afghanistan</option>
                           <option value="Åland Islands">Åland Islands</option>
                           <option value="Albania">Albania</option>
                           <option value="Algeria">Algeria</option>
                           <option value="American Samoa">American Samoa</option>
                           <option value="Andorra">Andorra</option>
                           <option value="Angola">Angola</option>
                           <option value="Anguilla">Anguilla</option>
                           <option value="Antarctica">Antarctica</option>
                           <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                           <option value="Argentina">Argentina</option>
                           <option value="Armenia">Armenia</option>
                           <option value="Aruba">Aruba</option>
                           <option value="Australia">Australia</option>
                           <option value="Austria">Austria</option>
                           <option value="Azerbaijan">Azerbaijan</option>
                           <option value="Bahamas">Bahamas</option>
                           <option value="Bahrain">Bahrain</option>
                           <option value="Bangladesh">Bangladesh</option>
                           <option value="Barbados">Barbados</option>
                           <option value="Belarus">Belarus</option>
                           <option value="Belgium">Belgium</option>
                           <option value="Belize">Belize</option>
                           <option value="Benin">Benin</option>
                           <option value="Bermuda">Bermuda</option>
                           <option value="Bhutan">Bhutan</option>
                           <option value="Bolivia">Bolivia</option>
                           <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                           <option value="Botswana">Botswana</option>
                           <option value="Bouvet Island">Bouvet Island</option>
                           <option value="Brazil">Brazil</option>
                           <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                           <option value="Brunei Darussalam">Brunei Darussalam</option>
                           <option value="Bulgaria">Bulgaria</option>
                           <option value="Burkina Faso">Burkina Faso</option>
                           <option value="Burundi">Burundi</option>
                           <option value="Cambodia">Cambodia</option>
                           <option value="Cameroon">Cameroon</option>
                           <option value="Canada">Canada</option>
                           <option value="Cape Verde">Cape Verde</option>
                           <option value="Cayman Islands">Cayman Islands</option>
                           <option value="Central African Republic">Central African Republic</option>
                           <option value="Chad">Chad</option>
                           <option value="Chile">Chile</option>
                           <option value="China">China</option>
                           <option value="Christmas Island">Christmas Island</option>
                           <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                           <option value="Colombia">Colombia</option>
                           <option value="Comoros">Comoros</option>
                           <option value="Congo">Congo</option>
                           <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                           <option value="Cook Islands">Cook Islands</option>
                           <option value="Costa Rica">Costa Rica</option>
                           <option value="Cote D'ivoire">Cote D'ivoire</option>
                           <option value="Croatia">Croatia</option>
                           <option value="Cuba">Cuba</option>
                           <option value="Cyprus">Cyprus</option>
                           <option value="Czech Republic">Czech Republic</option>
                           <option value="Denmark">Denmark</option>
                           <option value="Djibouti">Djibouti</option>
                           <option value="Dominica">Dominica</option>
                           <option value="Dominican Republic">Dominican Republic</option>
                           <option value="Ecuador">Ecuador</option>
                           <option value="Egypt">Egypt</option>
                           <option value="El Salvador">El Salvador</option>
                           <option value="Equatorial Guinea">Equatorial Guinea</option>
                           <option value="Eritrea">Eritrea</option>
                           <option value="Estonia">Estonia</option>
                           <option value="Ethiopia">Ethiopia</option>
                           <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                           <option value="Faroe Islands">Faroe Islands</option>
                           <option value="Fiji">Fiji</option>
                           <option value="Finland">Finland</option>
                           <option value="France">France</option>
                           <option value="French Guiana">French Guiana</option>
                           <option value="French Polynesia">French Polynesia</option>
                           <option value="French Southern Territories">French Southern Territories</option>
                           <option value="Gabon">Gabon</option>
                           <option value="Gambia">Gambia</option>
                           <option value="Georgia">Georgia</option>
                           <option value="Germany">Germany</option>
                           <option value="Ghana">Ghana</option>
                           <option value="Gibraltar">Gibraltar</option>
                           <option value="Greece">Greece</option>
                           <option value="Greenland">Greenland</option>
                           <option value="Grenada">Grenada</option>
                           <option value="Guadeloupe">Guadeloupe</option>
                           <option value="Guam">Guam</option>
                           <option value="Guatemala">Guatemala</option>
                           <option value="Guernsey">Guernsey</option>
                           <option value="Guinea">Guinea</option>
                           <option value="Guinea-bissau">Guinea-bissau</option>
                           <option value="Guyana">Guyana</option>
                           <option value="Haiti">Haiti</option>
                           <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                           <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                           <option value="Honduras">Honduras</option>
                           <option value="Hong Kong">Hong Kong</option>
                           <option value="Hungary">Hungary</option>
                           <option value="Iceland">Iceland</option>
                           <option value="India">India</option>
                           <option value="Indonesia">Indonesia</option>
                           <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                           <option value="Iraq">Iraq</option>
                           <option value="Ireland">Ireland</option>
                           <option value="Isle of Man">Isle of Man</option>
                           <option value="Israel">Israel</option>
                           <option value="Italy">Italy</option>
                           <option value="Jamaica">Jamaica</option>
                           <option value="Japan">Japan</option>
                           <option value="Jersey">Jersey</option>
                           <option value="Jordan">Jordan</option>
                           <option value="Kazakhstan">Kazakhstan</option>
                           <option value="Kenya">Kenya</option>
                           <option value="Kiribati">Kiribati</option>
                           <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                           <option value="Korea, Republic of">Korea, Republic of</option>
                           <option value="Kuwait">Kuwait</option>
                           <option value="Kyrgyzstan">Kyrgyzstan</option>
                           <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                           <option value="Latvia">Latvia</option>
                           <option value="Lebanon">Lebanon</option>
                           <option value="Lesotho">Lesotho</option>
                           <option value="Liberia">Liberia</option>
                           <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                           <option value="Liechtenstein">Liechtenstein</option>
                           <option value="Lithuania">Lithuania</option>
                           <option value="Luxembourg">Luxembourg</option>
                           <option value="Macao">Macao</option>
                           <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                           <option value="Madagascar">Madagascar</option>
                           <option value="Malawi">Malawi</option>
                           <option value="Malaysia">Malaysia</option>
                           <option value="Maldives">Maldives</option>
                           <option value="Mali">Mali</option>
                           <option value="Malta">Malta</option>
                           <option value="Marshall Islands">Marshall Islands</option>
                           <option value="Martinique">Martinique</option>
                           <option value="Mauritania">Mauritania</option>
                           <option value="Mauritius">Mauritius</option>
                           <option value="Mayotte">Mayotte</option>
                           <option value="Mexico">Mexico</option>
                           <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                           <option value="Moldova, Republic of">Moldova, Republic of</option>
                           <option value="Monaco">Monaco</option>
                           <option value="Mongolia">Mongolia</option>
                           <option value="Montenegro">Montenegro</option>
                           <option value="Montserrat">Montserrat</option>
                           <option value="Morocco">Morocco</option>
                           <option value="Mozambique">Mozambique</option>
                           <option value="Myanmar">Myanmar</option>
                           <option value="Namibia">Namibia</option>
                           <option value="Nauru">Nauru</option>
                           <option value="Nepal">Nepal</option>
                           <option value="Netherlands">Netherlands</option>
                           <option value="Netherlands Antilles">Netherlands Antilles</option>
                           <option value="New Caledonia">New Caledonia</option>
                           <option value="New Zealand">New Zealand</option>
                           <option value="Nicaragua">Nicaragua</option>
                           <option value="Niger">Niger</option>
                           <option value="Nigeria">Nigeria</option>
                           <option value="Niue">Niue</option>
                           <option value="Norfolk Island">Norfolk Island</option>
                           <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                           <option value="Norway">Norway</option>
                           <option value="Oman">Oman</option>
                           <option value="Pakistan">Pakistan</option>
                           <option value="Palau">Palau</option>
                           <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                           <option value="Panama">Panama</option>
                           <option value="Papua New Guinea">Papua New Guinea</option>
                           <option value="Paraguay">Paraguay</option>
                           <option value="Peru">Peru</option>
                           <option value="Philippines">Philippines</option>
                           <option value="Pitcairn">Pitcairn</option>
                           <option value="Poland">Poland</option>
                           <option value="Portugal">Portugal</option>
                           <option value="Puerto Rico">Puerto Rico</option>
                           <option value="Qatar">Qatar</option>
                           <option value="Reunion">Reunion</option>
                           <option value="Romania">Romania</option>
                           <option value="Russian Federation">Russian Federation</option>
                           <option value="Rwanda">Rwanda</option>
                           <option value="Saint Helena">Saint Helena</option>
                           <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                           <option value="Saint Lucia">Saint Lucia</option>
                           <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                           <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                           <option value="Samoa">Samoa</option>
                           <option value="San Marino">San Marino</option>
                           <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                           <option value="Saudi Arabia">Saudi Arabia</option>
                           <option value="Senegal">Senegal</option>
                           <option value="Serbia">Serbia</option>
                           <option value="Seychelles">Seychelles</option>
                           <option value="Sierra Leone">Sierra Leone</option>
                           <option value="Singapore">Singapore</option>
                           <option value="Slovakia">Slovakia</option>
                           <option value="Slovenia">Slovenia</option>
                           <option value="Solomon Islands">Solomon Islands</option>
                           <option value="Somalia">Somalia</option>
                           <option value="South Africa">South Africa</option>
                           <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                           <option value="Spain">Spain</option>
                           <option value="Sri Lanka">Sri Lanka</option>
                           <option value="Sudan">Sudan</option>
                           <option value="Suriname">Suriname</option>
                           <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                           <option value="Swaziland">Swaziland</option>
                           <option value="Sweden">Sweden</option>
                           <option value="Switzerland">Switzerland</option>
                           <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                           <option value="Taiwan">Taiwan</option>
                           <option value="Tajikistan">Tajikistan</option>
                           <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                           <option value="Thailand">Thailand</option>
                           <option value="Timor-leste">Timor-leste</option>
                           <option value="Togo">Togo</option>
                           <option value="Tokelau">Tokelau</option>
                           <option value="Tonga">Tonga</option>
                           <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                           <option value="Tunisia">Tunisia</option>
                           <option value="Turkey">Turkey</option>
                           <option value="Turkmenistan">Turkmenistan</option>
                           <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                           <option value="Tuvalu">Tuvalu</option>
                           <option value="Uganda">Uganda</option>
                           <option value="Ukraine">Ukraine</option>
                           <option value="United Arab Emirates">United Arab Emirates</option>
                           <option value="United Kingdom">United Kingdom</option>
                           <option value="United States">United States</option>
                           <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                           <option value="Uruguay">Uruguay</option>
                           <option value="Uzbekistan">Uzbekistan</option>
                           <option value="Vanuatu">Vanuatu</option>
                           <option value="Venezuela">Venezuela</option>
                           <option value="Viet Nam">Viet Nam</option>
                           <option value="Virgin Islands, British">Virgin Islands, British</option>
                           <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                           <option value="Wallis and Futuna">Wallis and Futuna</option>
                           <option value="Western Sahara">Western Sahara</option>
                           <option value="Yemen">Yemen</option>
                           <option value="Zambia">Zambia</option>
                           <option value="Zimbabwe">Zimbabwe</option>
                     </select>

      </div>
      <style>
          .phone-input {
  display: flex;
}

.countrycode {
  flex: 1;
  margin-right: 5px;
}
.phone {
  flex: 2;
}
      </style>
      <div class="form-group">
        <label for="">Phone Number</label>
        <!-- <input class="form-control" name="countrycode" type="text" id="countrycode" required /> -->
         <div class="phone-input">
    <select class="form-control countrycode" name="countrycode" id="countrycode" required>
        <option value="91">+91</option>
    <option value="93">+93</option>
    <option value="358">+358</option>
    <option value="355">+355</option>
    <option value="213">+213</option>
    <option value="1684">+1684</option>
    <option value="376">+376</option>
    <option value="244">+244</option>
    <option value="1264">+1264</option>
    <option value="672">+672</option>
    <option value="1268">+1268</option>
    <option value="54">+54</option>
    <option value="374">+374</option>
    <option value="297">+297</option>
    <option value="61">+61</option>
    <option value="43">+43</option>
    <option value="994">+994</option>
    <option value="1242">+1242</option>
    <option value="973">+973</option>
    <option value="880">+880</option>
    <option value="1246">+1246</option>
    <option value="375">+375</option>
    <option value="32">+32</option>
    <option value="501">+501</option>
    <option value="229">+229</option>
    <option value="1441">+1441</option>
    <option value="975">+975</option>
    <option value="591">+591</option>
    <option value="599">+599</option>
    <option value="387">+387</option>
    <option value="267">+267</option>
    <option value="55">+55</option>
    <option value="246">+246</option>
    <option value="673">+673</option>
    <option value="359">+359</option>
    <option value="226">+226</option>
    <option value="257">+257</option>
    <option value="855">+855</option>
    <option value="237">+237</option>
    <option value="1">+1</option>
    <option value="238">+238</option>
    <option value="1345">+1345</option>
    <option value="236">+236</option>
    <option value="235">+235</option>
    <option value="56">+56</option>
    <option value="86">+86</option>
    <option value="61">+61</option>
    <option value="672">+672</option>
    <option value="57">+57</option>
    <option value="269">+269</option>
    <option value="242">+242</option>
    <option value="242">+242</option>
    <option value="682">+682</option>
    <option value="506">+506</option>
    <option value="225">+225</option>
    <option value="385">+385</option>
    <option value="53">+53</option>
    <option value="599">+599</option>
    <option value="357">+357</option>
    <option value="420">+420</option>
    <option value="45">+45</option>
    <option value="253">+253</option>
    <option value="1767">+1767</option>
    <option value="1809">+1809</option>
    <option value="593">+593</option>
    <option value="20">+20</option>
    <option value="503">+503</option>
    <option value="240">+240</option>
    <option value="291">+291</option>
    <option value="372">+372</option>
    <option value="251">+251</option>
    <option value="500">+500</option>
    <option value="298">+298</option>
    <option value="679">+679</option>
    <option value="358">+358</option>
    <option value="33">+33</option>
    <option value="594">+594</option>
    <option value="689">+689</option>
    <option value="262">+262</option>
    <option value="241">+241</option>
    <option value="220">+220</option>
    <option value="995">+995</option>
    <option value="49">+49</option>
    <option value="233">+233</option>
    <option value="350">+350</option>
    <option value="30">+30</option>
    <option value="299">+299</option>
    <option value="1473">+1473</option>
    <option value="590">+590</option>
    <option value="1671">+1671</option>
    <option value="502">+502</option>
    <option value="44">+44</option>
    <option value="224">+224</option>
    <option value="245">+245</option>
    <option value="592">+592</option>
    <option value="509">+509</option>
    <option value="39">+39</option>
    <option value="504">+504</option>
    <option value="852">+852</option>
    <option value="36">+36</option>
    <option value="354">+354</option>
    <option value="91">+91</option>
    <option value="62">+62</option>
    <option value="98">+98</option>
    <option value="964">+964</option>
    <option value="353">+353</option>
    <option value="44">+44</option>
    <option value="972">+972</option>
    <option value="39">+39</option>
    <option value="1876">+1876</option>
    <option value="81">+81</option>
    <option value="44">+44</option>
    <option value="962">+962</option>
    <option value="7">+7</option>
    <option value="254">+254</option>
    <option value="686">+686</option>
    <option value="850">+850</option>
    <option value="82">+82</option>
    <option value="383">+383</option>
    <option value="965">+965</option>
    <option value="996">+996</option>
    <option value="856">+856</option>
    <option value="371">+371</option>
    <option value="961">+961</option>
    <option value="266">+266</option>
    <option value="231">+231</option>
    <option value="218">+218</option>
    <option value="423">+423</option>
    <option value="370">+370</option>
    <option value="352">+352</option>
    <option value="853">+853</option>
    <option value="389">+389</option>
    <option value="261">+261</option>
    <option value="265">+265</option>
    <option value="60">+60</option>
    <option value="960">+960</option>
    <option value="223">+223</option>
    <option value="356">+356</option>
    <option value="692">+692</option>
    <option value="596">+596</option>
    <option value="222">+222</option>
    <option value="230">+230</option>
    <option value="262">+262</option>
    <option value="52">+52</option>
    <option value="691">+691</option>
    <option value="373">+373</option>
    <option value="377">+377</option>
    <option value="976">+976</option>
    <option value="382">+382</option>
    <option value="1664">+1664</option>
    <option value="212">+212</option>
    <option value="258">+258</option>
    <option value="95">+95</option>
    <option value="264">+264</option>
    <option value="674">+674</option>
    <option value="977">+977</option>
    <option value="31">+31</option>
    <option value="599">+599</option>
    <option value="687">+687</option>
    <option value="64">+64</option>
    <option value="505">+505</option>
    <option value="227">+227</option>
    <option value="234">+234</option>
    <option value="683">+683</option>
    <option value="672">+672</option>
    <option value="1670">+1670</option>
    <option value="47">+47</option>
    <option value="968">+968</option>
    <option value="92">+92</option>
    <option value="680">+680</option>
    <option value="970">+970</option>
    <option value="507">+507</option>
    <option value="675">+675</option>
    <option value="595">+595</option>
    <option value="51">+51</option>
    <option value="63">+63</option>
    <option value="64">+64</option>
    <option value="48">+48</option>
    <option value="351">+351</option>
    <option value="1787">+1787</option>
    <option value="974">+974</option>
    <option value="262">+262</option>
    <option value="40">+40</option>
    <option value="7">+7</option>
    <option value="250">+250</option>
    <option value="590">+590</option>
    <option value="290">+290</option>
    <option value="1869">+1869</option>
    <option value="1758">+1758</option>
    <option value="590">+590</option>
    <option value="508">+508</option>
    <option value="1784">+1784</option>
    <option value="684">+684</option>
    <option value="378">+378</option>
    <option value="239">+239</option>
    <option value="966">+966</option>
    <option value="221">+221</option>
    <option value="381">+381</option>
    <option value="381">+381</option>
    <option value="248">+248</option>
    <option value="232">+232</option>
    <option value="65">+65</option>
    <option value="721">+721</option>
    <option value="421">+421</option>
    <option value="386">+386</option>
    <option value="677">+677</option>
    <option value="252">+252</option>
    <option value="27">+27</option>
    <option value="500">+500</option>
    <option value="211">+211</option>
    <option value="34">+34</option>
    <option value="94">+94</option>
    <option value="249">+249</option>
    <option value="597">+597</option>
    <option value="47">+47</option>
    <option value="268">+268</option>
    <option value="46">+46</option>
    <option value="41">+41</option>
    <option value="963">+963</option>
    <option value="886">+886</option>
    <option value="992">+992</option>
    <option value="255">+255</option>
    <option value="66">+66</option>
    <option value="670">+670</option>
    <option value="228">+228</option>
    <option value="690">+690</option>
    <option value="676">+676</option>
    <option value="1868">+1868</option>
    <option value="216">+216</option>
    <option value="90">+90</option>
    <option value="7370">+7370</option>
    <option value="1649">+1649</option>
    <option value="688">+688</option>
    <option value="256">+256</option>
    <option value="380">+380</option>
    <option value="971">+971</option>
    <option value="44">+44</option>
    <option value="1">+1</option>
    <option value="598">+598</option>
    <option value="998">+998</option>
    <option value="678">+678</option>
    <option value="58">+58</option>
    <option value="84">+84</option>
    <option value="1284">+1284</option>
    <option value="1340">+1340</option>
    <option value="681">+681</option>
    <option value="212">+212</option>
    <option value="967">+967</option>
    <option value="260">+260</option>
    <option value="263">+263</option>
</select>

    <input class="form-control phone" name="phone" type="text" id="phone" required />
  </div>
      </div>
      <input type="submit" id="submit" name="submit">
    </form>
</div>
</section>


<!-- <section id="Why">
  
  <img src="assets/images/arrows_1.png" class="arrows_1">
  <img src="assets/images/arrows_2.png" class="arrows_2">
  <img src="assets/images/arrows_3.png" class="arrows_3">
  <img src="assets/images/arrows_4.png" class="arrows_4">


   <div class="row">
      <div class="col-md-12 text-center">
         <h2>GLOBAL COMMUNITY</h2>
         <h1>WHY CHOOSE GTRON?</h1>
         <img src="assets/images/why_underline.png" class="why_underline">
      </div>
   </div>
   
   <div class="row">
      <div class="col-md-4">
         <img src="assets/images/icons/icon.svg" class="icon">
         <h3>Transparency</h3>
         <p>You can transparently view all 
transactions and details that 
have been made since the date
the Smart Contract was created.</p>
      </div>
      <div class="col-md-4">
         <img src="assets/images/icons/icon.svg" class="icon">
         <h3>Decentralized</h3>
         <p>GTRON is not managed by anyone, 
including its own software team. 
It is developed as a fully 
automatic system.</p>
      </div>
      <div class="col-md-4">
         <img src="assets/images/icons/icon.svg" class="icon">
         <h3>High Security</h3>
         <p>GTRON is a part of 
Blockchain technology. 
Blockchain is a secure technology 
that no hacker can access</p>
      </div>
   </div>

   <hr/>

</section>



<section id="welcome">

   <img src="assets/images/banner_glow.png" class="welcome_glow">

      <div class="row">
      <div class="col-md-4">
         <img src="assets/images/welcome.svg" class="wel-icon">
      </div>
      <div class="col-md-8">
         <p>Smart Investment Platform! At GTRON, you can invest and earn up to 200% 
on your investment with the potential for passive income. 
Our platform provides a unique opportunity for users to invest and grow
their wealth through referrals, bonus distribution, and reinvestments.</p>
      </div>
   </div>
    
    <hr/>

    <div class="row btn-row">
       <div class="col-md-6 text-left">
          <button><img src="assets/images/icons/dot.svg">100% Automatic</button>
       </div>
       <div class="col-md-6 text-right">
          <button><img src="assets/images/icons/dot.svg">100% Transparency</button>
       </div>
       <div class="col-md-6 text-left">
          <button><img src="assets/images/icons/dot.svg">Financial Freedom</button>
       </div>
       <div class="col-md-6 text-right">
          <button><img src="assets/images/icons/dot.svg">Community Driven</button>
       </div>
    </div>

    <hr/>


</section>



<section id="packages">

   <img src="assets/images/packages_bg.png" class="packages_bg">
    
    <div class="row">
       <div class="col-md-12 text-center">
          <h1>PACKAGES</h1>
          <img src="assets/images/package_underline.png" class="package_underline">
       </div>
    </div>

    <div class="row package_row">
       <div class="col-md-3"></div>
       <div class="col-md-6">
          <h2>PACKAGE</h2>
          <h2 class="float-right">CONNECT WALLET</h2>
          <br>
        
          <div class="package_div"><p><img src="assets/images/icons/box.svg" class="box">$50 usdt</p><button class="btn-main"><img src="assets/images/icons/wallet.svg">Connect Wallet</button></div>
          <div class="package_div"><p><img src="assets/images/icons/box.svg" class="box">$100 usdt</p><button class="btn-main"><img src="assets/images/icons/wallet.svg">Connect Wallet</button></div>
          <div class="package_div"><p><img src="assets/images/icons/box.svg" class="box">$250 usdt</p><button class="btn-main"><img src="assets/images/icons/wallet.svg">Connect Wallet</button></div>
          <div class="package_div"><p><img src="assets/images/icons/box.svg" class="box">$500 usdt</p><button class="btn-main"><img src="assets/images/icons/wallet.svg">Connect Wallet</button></div>
          <div class="package_div"><p><img src="assets/images/icons/box.svg" class="box">$1000 usdt</p><button class="btn-main"><img src="assets/images/icons/wallet.svg">Connect Wallet</button></div>


       </div>
       <div class="col-md-3"></div>
    </div>

</section>


<section id="level">

   <img src="assets/images/level_arrows.png" class="level_arrows">
   
   <img src="assets/images/level_glow.png" class="level_glow"> 

   <h2>EXPLANATION OF</h2>
   <h1>LEVEL INCOME</h1>
   <h3>Choose from our range of<br> flexible investment packages:</h3>

   
   <div class="row">
      <div class="col-md-6 left">
         
         <div class="row">
            <div class="col-md-4 col-4"><h2>LEVEL</h2></div>
            <div class="col-md-4 col-4"><h2>REFERAL</h2></div>
            <div class="col-md-4 col-4"><h2>ELIGIBILITY</h2></div>
         </div>
         <hr/>

         <div class="row">
            <div class="col-md-4 col-4">
               <p>1</p>
               <p>2</p>
               <p>3</p>
               <p>4</p>
               <p>5</p>
               <p>6</p>
               <p>7</p>
               <p>8</p>
               <p>9</p>
               <p>10</p>
            </div>
            <div class="col-md-4 col-4">
               <p class="white_p">50% commission</p>
               <p class="white_p">8% commission</p>
               <p class="white_p">6% commission</p>
               <p class="white_p">4% commission</p>
               <p class="white_p">3% commission</p>
               <p class="white_p">1% commission</p>
               <p class="white_p">1% commission</p>
               <p class="white_p">1% commission</p>
               <p class="white_p">0.5% commission</p>
               <p class="white_p">0.5% commission</p>
            </div>
            <div class="col-md-4 col-4">
               <p class="white_p">Unlimited Directs</p>
               <p class="white_p">2 Direct Referrals</p>
               <p class="white_p">2 Direct Referrals</p>
               <p class="white_p">2 Direct Referrals</p>
               <p class="white_p">2 Direct Referrals</p>
               <p class="white_p">2 Direct Referrals</p>
               <p class="white_p">2 Direct Referrals</p>
               <p class="white_p">2 Direct Referrals</p>
               <p class="white_p">2 Direct Referrals</p>
               <p class="white_p">2 Direct Referrals</p>
            </div>
         </div>

         <hr/>

      </div>
      <div class="col-md-6 right">
         
         <div class="bonus_div">
            <div class="top">
               <h2>Bonus Distribution</h2>
            </div>
            <div class="bottom">
               <p><img src="assets/images/icons/dash.svg" class="dash">From Every user 20% will be taken for dividend.</p>
               <p><img src="assets/images/icons/dash.svg" class="dash">As per the dividend shares we are providing 4x , 3x, 2x 
for the working and non - working user accordingly.</p>
               <p><img src="assets/images/icons/dash.svg" class="dash">For example: If someone joins with 100 USDT then 
they will be getting upto  3x i.e 300 USDT from the Dividend Pool</p>
               <p><img src="assets/images/icons/dash.svg" class="dash">Where as non working people will be sharing only 2x from the pool.</p>
               <p><img src="assets/images/icons/dash.svg" class="dash">If an user joins 4 direct referrals within 7days from registration he will be getting 4x as Dividend bonus</p>
            </div>
         </div>

      </div>
   </div>


</section>




<section id="gtron">

 <img src="assets/images/gtron_glow.png" class="gtron_glow">

   <div class="row">
      <div class="col-md-6">
         <h1>GTRON <span>COIN</span></h1>
         <p>Are you ready to step into the exciting world of cryptocurrency? 
Look no further than <span>GTRON Coin,</span></p> 

<p>the groundbreaking digital currency designed to transform 
the way we transact and empower individuals across the globe.</p> 

<p>With its innovative features and robust technology, 
<span>GTRON Coin</span> is set to redefine the future of finance.</p>
      </div>
      <div class="col-md-6">
         <img src="assets/images/coins.png" class="coins">
      </div>
   </div>
</section>




<section id="roadmap">
   
<img src="assets/images/roadmap.png" class="roadmap">

<img src="assets/images/road.png" class="road">


<div class="roads road_1 text-center">
   <h2>DECEMBER 2023</h2>
   <img src="assets/images/line.png" class="line">
   <p>Launching Gtron<br>Token</p>
</div>

<div class="roads road_2 text-center">
   <h2>APRIL 2024</h2>
   <img src="assets/images/line.png" class="line">
   <p>Centralized<br>Exchange</p>
</div>

<div class="roads road_3 text-center">
   <h2>AUGUST 2024</h2>
   <img src="assets/images/line.png" class="line">
   <p>Crypto<br>e-commerce</p>
</div>



<div class="roads road_4 text-center">
   <h2>FEBRUARY 2024</h2>
   <img src="assets/images/line.png" class="line">
   <p>Blockchain Betting<br>Games</p>
</div>

<div class="roads road_5 text-center">
   <h2>MAY 2024</h2>
   <img src="assets/images/line.png" class="line">
   <p>Amigos AI<br>Trading Bot</p>
</div>

</section>



<section id="faqs">
   
  <div class="row">
     <div class="col-md-12 text-center">
        <h1>FAQS</h1>
        <img src="assets/images/faq_line.png" class="faq_line">
     </div>
  </div>


<div id="accordion">

  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          What is Gtron?
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        Gtron is a decentralized MLM (Multi-Level Marketing) platform that leverages blockchain technology to facilitate secure, transparent, and efficient networking and business opportunities. It aims to revolutionize the MLM industry by offering a decentralized and community-driven approach to network marketing.
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
         How does Gtron work?
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        Gtron operates on a decentralized blockchain network, enabling participants to engage in MLM activities without relying on a centralized authority. The platform utilizes smart contracts to automate various MLM processes, including product sales, commission distribution, and network building. This ensures transparency, trust, and fair compensation for all participants.
    </div>
  </div></div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          How do I earn money with Gtron?
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        In Gtron, you can earn money through various channels:

Network building: As you recruit and develop a network of participants, you can earn additional commissions based on the sales generated by your downline.
Bonuses and incentives: Gtron may offer bonuses and incentives based on your performance, achieving specific targets, or qualifying for certain ranks within the MLM structure.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingFour">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
         Can I trust Gtron with my personal and financial information?
        </button>
      </h5>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
      <div class="card-body">
        Gtron prioritizes the security and privacy of its participants. By leveraging blockchain technology, the platform ensures that personal and financial information is encrypted, decentralized, and protected against unauthorized access. However, it is always advisable to exercise caution and follow best practices when sharing personal information online.
      </div>
    </div>
  </div>
</div>

</section>



<section id="ready">
   
   <div class="row">
      <div class="col-md-6 left">
         <h2>START REVOLUTION</h2>
         <h3>READY TO JOIN</h3>
         <h1>GTRON?</h1>
         <p>Connect your wallet and get your account instantly!</p>
      </div>
       <div class="col-md-6 right">
          <button class="get_started btn-main">Get Started</button>
       </div>
   </div>

</section>


<section id="smart">
   <hr/>
   <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-5">
         <h2>SMART - CONTRACT :</h2>
         <p>TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t</p>
      </div>
      <div class="col-md-5">
         <h2>SUPPORT</h2>
         <a href="mailto:gtron2023@gmail.com">gtron2023@gmail.com</a>
      </div>
   </div>
   <hr/>
</section>










 SCRIPTS ------------------------------------->

<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/sweetalert2.min.js"></script>



<script>
   $('#banner_slider').owlCarousel({
    loop:true,
    margin:10,
    dots: false,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:1,
            nav:false,
            loop:true
        }
    }
})
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



</body>
</html>