<?php
    // session_start();
    if(isset($_GET['reff']) && $_GET['reff'] !== ''){ $_SESSION['reff'] = $_GET['reff']; } else { $_SESSION['reff'] = 'notdefined'; }
?>

<?php function navbar_(){ ?>
 
	

	<!-- Navbar Here -->



<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <a class="navbar-brand" href="#"><img class="nav-logo" src="assets/images/logo/logo.png"></a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

    <span class="navbar-toggler-icon"></span>

  </button>



  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto">

      <li class="nav-item active">

        <a class="nav-link" href="#Why">WHY GTRON <img class="slant" src="assets/images/icons/slant.svg"></a>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="#welcome">ABOUT <img class="slant" src="assets/images/icons/slant.svg"></a>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="#packages">PACKAGES <img class="slant" src="assets/images/icons/slant.svg"></a>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="#level">PLAN <img class="slant" src="assets/images/icons/slant.svg"></a>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="#roadmap">ROADMAP <img class="slant" src="assets/images/icons/slant.svg"></a>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="#faqs">FAQS</a>

      </li>

 

    </ul>

    <form class="form-inline my-2 my-lg-0">

     <!-- <button class="connect-btn btn-main"><img src="assets/images/icons/wallet.svg">Connect Wallet</button> -->
     <?php if(isset( $_SESSION['user_name'])){ ?>
                    <button class="connect-btn" id="btn-disconnect" onclick="onDisconnect()">
                        <!-- <img src="images/wallet.png" alt=""> -->
                        <img src="assets/images/icons/wallet.svg">
                        Disconnect Wallet
                    </button>
                    <?php }else{ ?>
                <button class="connect-btn" onclick="handleButtonClick(event)">
                        <!-- <img src="images/wallet.png" alt=""> -->
                        <img src="assets/images/icons/wallet.svg">
                        Connect Wallet
                    </button>
    <?php } ?>

     <button class="earth-btn"><img src="assets/images/icons/earth.svg"></button>

    </form>

  </div>

  <style>
    p.labeltext {
    font-size: 20px;
    font-weight: 900;
    margin-top: 20px;
}

button.btnconnect {
    background: none;
    border: none;
    flex: 1;
}

.modal {
  padding-top:0px;
}
.modal-top {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
}

.modal-content {
    background-color: #fefefe;
    margin: 2% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
}
  </style>

  <div id="myModal" class="modal">
    <!-- Modal content -->
        <div class="modal-content">
        <p class="labeltext">Choose your preferred wallet:</p>
        <div class="modal-top">
        <button class="btnconnect" onclick="connectWithTronlink('<?php if(isset($_GET['reff']) && $_GET['reff'] !== ''){ echo $_GET['reff']; } else { echo 'notdefined'; } ?>')">
            <img src="images/tron-link.png" alt="TronLink Logo" width="60" height="60">
            <p class="labeltext">TronLink</p>
            <p class="sublabeltext">Connect to Your TronLink</p>
        </button>
        <button class="btnconnect" id="btn-connect">
            <img src="images/wallet-connect.png" alt="WalletConnect Logo" width="60" height="60">
            <p class="labeltext">Wallet Connect</p>
            <p class="sublabeltext">Scan with WalletConnect to Connect</p>
        </button></div>
        </div>
    </div>

</nav>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script type="text/javascript" src="https://unpkg.com/web3@1.2.11/dist/web3.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/web3modal@1.9.0/dist/index.js"></script>
    <script type="text/javascript" src="https://unpkg.com/evm-chains@0.2.0/dist/umd/index.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/@walletconnect/web3-provider@1.2.1/dist/umd/index.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/fortmatic@2.0.6/dist/fortmatic.js"></script>

    <script type="text/javascript" src="main.js"></script>


<script>
  function connectWithTronlink(reff) {

if (typeof window.tronWeb === 'undefined') {
    alert("Please install TronLink or another Tron wallet extension. Other wise Please use wallet connect.");
    return;
}

if (window.tronWeb && window.tronWeb.ready) {
    // Wallet is already connected, retrieve the address
 const address = window.tronWeb.defaultAddress.base58;
 
 console.log("tron address", address)
 fetch('backend.php', {
    method: 'POST',
    body: JSON.stringify({ address: address, reff: reff, login: 1 })
  })
  .then(response => response.json())
  .then(data => {        
    console.log(data);
    if (data.status=='success') {
        Toastify({
                        text: "Your new account has been created!",
                        duration: 3000,
                        newWindow: true,
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "center", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)",
                        },
                        onClick: function(){} // Callback after click
                        }).showToast();
                        setTimeout(function(){
                            window.location.href = '../member/buy-pkg.php';
        }, 2000);
    }
    else if (data.status=='login') {
        Toastify({
            text: "You have logged in successfully!",
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            },
            onClick: function(){} // Callback after click
            }).showToast();
            setTimeout(function(){
                window.location.href = '../member/index.php';
        }, 2000);
    } else {

        Toastify({
                text: `${data.message}`,
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #FF0000, #CB4335)",
                },
                onClick: function(){} // Callback after click
                }).showToast();

    }



  })
  .catch(error => {
    // Handle any errors
    console.log("error",error)
  });

} else {

    alert("No Tron Link Wallet Available. Please use Wallet connect.")

}

}

function handleButtonClick(event) {
        // Prevent the default behavior of the button click
        event.preventDefault();

        // You can add any custom logic here
        // For example, opening a modal instead of redirecting
        openModal();
    }
  function openModal() {
      var modal = document.getElementById("myModal");
      modal.style.display = "block";
      return;
    }
    
</script>


	

<?php } ?>

	

	