<?php
ini_set('error_reporting', 0);
ini_set('display_errors', false);
 
require_once "config.php";
 
// session_start();
 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Send Payment Sketch Iconic</title>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../assets/images/fav.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
                    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <style type="text/css">
                        
                        body, *{
                            font-family: 'Poppins', sans-serif;
                        }
                        .form-control:not([readonly]):focus {
    color: #495057;
    background-color: #fff;
    border-color: #02fdc4;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgb(2 253 196 / 27%);
}
.btn-primary {
    color: #000;
    background-color: #02fdc4;
    border-color: #02fdc4;
}
.btn-primary:hover, .btn-primary:focus {
    color: #fff;
    background-color: #0cb18b !important;
    border-color: #0cb18b !important;
}
#desc{
    background: #e9ecef;
    padding: 10px;
    border-radius: .25rem;
    border: 1px solid #ced4da;
    min-height: 100px;
}
.alert:not(.alert-danger):not(.alert-success){
    display: none;
    
}
                    </style>
                     <?php include '../global.php'?>
</head>
<body>
<?php 
if(isset($_GET['token']) && !empty($_GET['token'])){
include_once 'db-connect.php';
$sql = "SELECT * FROM orders WHERE link_token = '" . $_GET['token'] . "'";
$result = $db->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $name = $row['project_name'];
    $email = $row['email'];
    $description = $row['description'];
    $item_price = $row['item_price'];
    $item_price_currency = $row['item_price_currency'];
    $payment_s = $row['payment_status'];
    if($row['payment_status'] == "succeeded")
    {
        echo "<h1 style='text-align:center'>Already Paid</h1>";die;
    }
}
?><div class="panel container col-md-6 py-5">
    <img src="../assets/images/logo.png" class="mb-4" style="width: 300px;">
    <h2>Payment Details</h2>
    <div class="panel-body">
        <!-- Display errors returned by createToken -->
        <div id="paymentResponse"></div>
        
        <!-- Payment form -->
        <form action="charge.php" class="row" method="POST" id="payment-form">
            <div class="form-group col-md-6">
                <label>Amount Payable</label>
                <input type="number" name="amount" id="amount" class="field form-control" placeholder="Enter amount" required=""  readonly="" value="<?= $item_price ?>">
            </div><div class="form-group col-md-6">
                <label>Currency</label>
                <input type="text" name="currency" readonly class="form-control" id="currency" required="" value="<?= $item_price_currency ?>" readonly>                
            </div>
            <div class="form-group col-md-12">
                <label>Client's Name</label>
                <input type="text" name="p_name" id="p_name" readonly="" value="<?= $name ?>" class="field form-control" placeholder="Enter name" required="" >
                <input type="hidden" name="link_token" id="link_token" value="<?= $_GET['token'] ?>">
            </div>
            <?php if(!empty($description)) : ?>
            <div class="form-group col-md-12">
            <div  id="desc">
               <?= $description ;  ?>
            </div>
            </div>
            <?php endif; ?>
            <div class="form-group col-md-12">      
            <h2 class="my-2">Card Holder's Details</h2>
            </div>  
            <div class="form-group col-md-6">
                <label>First Name</label>
                <input type="text" name="fname"  id="fname" class="field form-control" placeholder="Enter First Name" required="">
            </div>   
            <div class="form-group col-md-6">
                <label>Last  Name</label>
                <input type="text" name="lname"  id="lname" class="field form-control" placeholder="Enter Last Name" required="">
            </div>    
            <div class="form-group col-md-6">
                <label>Email</label>
                <input type="email" name="email" value="<?= $email ?>" id="email" class="field form-control" placeholder="Enter email" required="">
            </div>
            <div class="form-group col-md-6">
                <label>Phone</label>
                <input type="tel" name="phone"  id="phone" class="field form-control" placeholder="Enter Phone" required="">
            </div>
            <div class="form-group col-md-12">      
            <h2 class="my-2">Billing Details</h2>
            </div>  
            <div class="form-group col-md-6">
                <label>Address Line 1</label>
                <input type="text" name="address"  id="address" class="field form-control" placeholder="Enter Address" >
            </div>  
            <div class="form-group col-md-6">
                <label>Address Line 2</label>
                <input type="text" name="address2"  id="address2" class="field form-control" placeholder="Enter Address" >
            </div>
            <div class="form-group col-md-6">
                <label>City</label>
                <input type="text" name="city"  id="city" class="field form-control" placeholder="Enter City" >
            </div>
            <div class="form-group col-md-6">
                <label>State / Province</label>
                <input type="text" name="state"  id="state" class="field form-control" placeholder="Enter State / Province" >
            </div>
            <div class="form-group col-md-6">
                <label>Zip / Postal Code</label>
                <input type="text" name="zip"  id="zip" class="field form-control" placeholder="Enter Zip" >
            </div>
            <div class="form-group col-md-6">
                <label>Country</label>
                <select name="country"  id="country" class="field form-control" placeholder="Enter Country">
                   <option value="Afganistan">Afghanistan</option>
                   <option value="Albania">Albania</option>
                   <option value="Algeria">Algeria</option>
                   <option value="American Samoa">American Samoa</option>
                   <option value="Andorra">Andorra</option>
                   <option value="Angola">Angola</option>
                   <option value="Anguilla">Anguilla</option>
                   <option value="Antigua & Barbuda">Antigua & Barbuda</option>
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
                   <option value="Bonaire">Bonaire</option>
                   <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                   <option value="Botswana">Botswana</option>
                   <option value="Brazil">Brazil</option>
                   <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                   <option value="Brunei">Brunei</option>
                   <option value="Bulgaria">Bulgaria</option>
                   <option value="Burkina Faso">Burkina Faso</option>
                   <option value="Burundi">Burundi</option>
                   <option value="Cambodia">Cambodia</option>
                   <option value="Cameroon">Cameroon</option>
                   <option value="Canada">Canada</option>
                   <option value="Canary Islands">Canary Islands</option>
                   <option value="Cape Verde">Cape Verde</option>
                   <option value="Cayman Islands">Cayman Islands</option>
                   <option value="Central African Republic">Central African Republic</option>
                   <option value="Chad">Chad</option>
                   <option value="Channel Islands">Channel Islands</option>
                   <option value="Chile">Chile</option>
                   <option value="China">China</option>
                   <option value="Christmas Island">Christmas Island</option>
                   <option value="Cocos Island">Cocos Island</option>
                   <option value="Colombia">Colombia</option>
                   <option value="Comoros">Comoros</option>
                   <option value="Congo">Congo</option>
                   <option value="Cook Islands">Cook Islands</option>
                   <option value="Costa Rica">Costa Rica</option>
                   <option value="Cote DIvoire">Cote DIvoire</option>
                   <option value="Croatia">Croatia</option>
                   <option value="Cuba">Cuba</option>
                   <option value="Curaco">Curacao</option>
                   <option value="Cyprus">Cyprus</option>
                   <option value="Czech Republic">Czech Republic</option>
                   <option value="Denmark">Denmark</option>
                   <option value="Djibouti">Djibouti</option>
                   <option value="Dominica">Dominica</option>
                   <option value="Dominican Republic">Dominican Republic</option>
                   <option value="East Timor">East Timor</option>
                   <option value="Ecuador">Ecuador</option>
                   <option value="Egypt">Egypt</option>
                   <option value="El Salvador">El Salvador</option>
                   <option value="Equatorial Guinea">Equatorial Guinea</option>
                   <option value="Eritrea">Eritrea</option>
                   <option value="Estonia">Estonia</option>
                   <option value="Ethiopia">Ethiopia</option>
                   <option value="Falkland Islands">Falkland Islands</option>
                   <option value="Faroe Islands">Faroe Islands</option>
                   <option value="Fiji">Fiji</option>
                   <option value="Finland">Finland</option>
                   <option value="France">France</option>
                   <option value="French Guiana">French Guiana</option>
                   <option value="French Polynesia">French Polynesia</option>
                   <option value="French Southern Ter">French Southern Ter</option>
                   <option value="Gabon">Gabon</option>
                   <option value="Gambia">Gambia</option>
                   <option value="Georgia">Georgia</option>
                   <option value="Germany">Germany</option>
                   <option value="Ghana">Ghana</option>
                   <option value="Gibraltar">Gibraltar</option>
                   <option value="Great Britain">Great Britain</option>
                   <option value="Greece">Greece</option>
                   <option value="Greenland">Greenland</option>
                   <option value="Grenada">Grenada</option>
                   <option value="Guadeloupe">Guadeloupe</option>
                   <option value="Guam">Guam</option>
                   <option value="Guatemala">Guatemala</option>
                   <option value="Guinea">Guinea</option>
                   <option value="Guyana">Guyana</option>
                   <option value="Haiti">Haiti</option>
                   <option value="Hawaii">Hawaii</option>
                   <option value="Honduras">Honduras</option>
                   <option value="Hong Kong">Hong Kong</option>
                   <option value="Hungary">Hungary</option>
                   <option value="Iceland">Iceland</option>
                   <option value="Indonesia">Indonesia</option>
                   <option value="India">India</option>
                   <option value="Iran">Iran</option>
                   <option value="Iraq">Iraq</option>
                   <option value="Ireland">Ireland</option>
                   <option value="Isle of Man">Isle of Man</option>
                   <option value="Israel">Israel</option>
                   <option value="Italy">Italy</option>
                   <option value="Jamaica">Jamaica</option>
                   <option value="Japan">Japan</option>
                   <option value="Jordan">Jordan</option>
                   <option value="Kazakhstan">Kazakhstan</option>
                   <option value="Kenya">Kenya</option>
                   <option value="Kiribati">Kiribati</option>
                   <option value="Korea North">Korea North</option>
                   <option value="Korea Sout">Korea South</option>
                   <option value="Kuwait">Kuwait</option>
                   <option value="Kyrgyzstan">Kyrgyzstan</option>
                   <option value="Laos">Laos</option>
                   <option value="Latvia">Latvia</option>
                   <option value="Lebanon">Lebanon</option>
                   <option value="Lesotho">Lesotho</option>
                   <option value="Liberia">Liberia</option>
                   <option value="Libya">Libya</option>
                   <option value="Liechtenstein">Liechtenstein</option>
                   <option value="Lithuania">Lithuania</option>
                   <option value="Luxembourg">Luxembourg</option>
                   <option value="Macau">Macau</option>
                   <option value="Macedonia">Macedonia</option>
                   <option value="Madagascar">Madagascar</option>
                   <option value="Malaysia">Malaysia</option>
                   <option value="Malawi">Malawi</option>
                   <option value="Maldives">Maldives</option>
                   <option value="Mali">Mali</option>
                   <option value="Malta">Malta</option>
                   <option value="Marshall Islands">Marshall Islands</option>
                   <option value="Martinique">Martinique</option>
                   <option value="Mauritania">Mauritania</option>
                   <option value="Mauritius">Mauritius</option>
                   <option value="Mayotte">Mayotte</option>
                   <option value="Mexico">Mexico</option>
                   <option value="Midway Islands">Midway Islands</option>
                   <option value="Moldova">Moldova</option>
                   <option value="Monaco">Monaco</option>
                   <option value="Mongolia">Mongolia</option>
                   <option value="Montserrat">Montserrat</option>
                   <option value="Morocco">Morocco</option>
                   <option value="Mozambique">Mozambique</option>
                   <option value="Myanmar">Myanmar</option>
                   <option value="Nambia">Nambia</option>
                   <option value="Nauru">Nauru</option>
                   <option value="Nepal">Nepal</option>
                   <option value="Netherland Antilles">Netherland Antilles</option>
                   <option value="Netherlands">Netherlands (Holland, Europe)</option>
                   <option value="Nevis">Nevis</option>
                   <option value="New Caledonia">New Caledonia</option>
                   <option value="New Zealand">New Zealand</option>
                   <option value="Nicaragua">Nicaragua</option>
                   <option value="Niger">Niger</option>
                   <option value="Nigeria">Nigeria</option>
                   <option value="Niue">Niue</option>
                   <option value="Norfolk Island">Norfolk Island</option>
                   <option value="Norway">Norway</option>
                   <option value="Oman">Oman</option>
                   <option value="Pakistan">Pakistan</option>
                   <option value="Palau Island">Palau Island</option>
                   <option value="Palestine">Palestine</option>
                   <option value="Panama">Panama</option>
                   <option value="Papua New Guinea">Papua New Guinea</option>
                   <option value="Paraguay">Paraguay</option>
                   <option value="Peru">Peru</option>
                   <option value="Phillipines">Philippines</option>
                   <option value="Pitcairn Island">Pitcairn Island</option>
                   <option value="Poland">Poland</option>
                   <option value="Portugal">Portugal</option>
                   <option value="Puerto Rico">Puerto Rico</option>
                   <option value="Qatar">Qatar</option>
                   <option value="Republic of Montenegro">Republic of Montenegro</option>
                   <option value="Republic of Serbia">Republic of Serbia</option>
                   <option value="Reunion">Reunion</option>
                   <option value="Romania">Romania</option>
                   <option value="Russia">Russia</option>
                   <option value="Rwanda">Rwanda</option>
                   <option value="St Barthelemy">St Barthelemy</option>
                   <option value="St Eustatius">St Eustatius</option>
                   <option value="St Helena">St Helena</option>
                   <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                   <option value="St Lucia">St Lucia</option>
                   <option value="St Maarten">St Maarten</option>
                   <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                   <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                   <option value="Saipan">Saipan</option>
                   <option value="Samoa">Samoa</option>
                   <option value="Samoa American">Samoa American</option>
                   <option value="San Marino">San Marino</option>
                   <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                   <option value="Saudi Arabia">Saudi Arabia</option>
                   <option value="Senegal">Senegal</option>
                   <option value="Seychelles">Seychelles</option>
                   <option value="Sierra Leone">Sierra Leone</option>
                   <option value="Singapore">Singapore</option>
                   <option value="Slovakia">Slovakia</option>
                   <option value="Slovenia">Slovenia</option>
                   <option value="Solomon Islands">Solomon Islands</option>
                   <option value="Somalia">Somalia</option>
                   <option value="South Africa">South Africa</option>
                   <option value="Spain">Spain</option>
                   <option value="Sri Lanka">Sri Lanka</option>
                   <option value="Sudan">Sudan</option>
                   <option value="Suriname">Suriname</option>
                   <option value="Swaziland">Swaziland</option>
                   <option value="Sweden">Sweden</option>
                   <option value="Switzerland">Switzerland</option>
                   <option value="Syria">Syria</option>
                   <option value="Tahiti">Tahiti</option>
                   <option value="Taiwan">Taiwan</option>
                   <option value="Tajikistan">Tajikistan</option>
                   <option value="Tanzania">Tanzania</option>
                   <option value="Thailand">Thailand</option>
                   <option value="Togo">Togo</option>
                   <option value="Tokelau">Tokelau</option>
                   <option value="Tonga">Tonga</option>
                   <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                   <option value="Tunisia">Tunisia</option>
                   <option value="Turkey">Turkey</option>
                   <option value="Turkmenistan">Turkmenistan</option>
                   <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                   <option value="Tuvalu">Tuvalu</option>
                   <option value="Uganda">Uganda</option>
                   <option value="United Kingdom">United Kingdom</option>
                   <option value="Ukraine">Ukraine</option>
                   <option value="United Arab Erimates">United Arab Emirates</option>
                   <option selected value="United States of America">United States of America</option>
                   <option value="Uraguay">Uruguay</option>
                   <option value="Uzbekistan">Uzbekistan</option>
                   <option value="Vanuatu">Vanuatu</option>
                   <option value="Vatican City State">Vatican City State</option>
                   <option value="Venezuela">Venezuela</option>
                   <option value="Vietnam">Vietnam</option>
                   <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                   <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                   <option value="Wake Island">Wake Island</option>
                   <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                   <option value="Yemen">Yemen</option>
                   <option value="Zaire">Zaire</option>
                   <option value="Zambia">Zambia</option>
                   <option value="Zimbabwe">Zimbabwe</option>
                </select>
            </div>
            
            <div class="form-group col-md-12">
            <h2 class="my-2">Card Details</h2>
             </div>
            <div class="col-12">
            <div class="row">
                <div id="card-field" class="col-md-12"></div>
            </div>
        </div>
        <div class="col-12 mt-5">
            <button type="submit" class="btn btn-block btn-primary" id="payBtn">Submit Payment</button>
            <button type="button" disabled class="btn btn-block d-none btn-primary" id="proces">Processing <div class="spinner-border text-primary"></div></button>
            <div class="mt-5 alert " id="card-errors"></div>
            <div class="mt-5 alert" id="payment-errors" class=""></div>
        </div>

        </form>
    </div>
</div>
<!-- Stripe JS library -->
<script src="https://js.stripe.com/v3/"></script>
<script>
const config = {
    publishable_key: "<?= config('publishable_key') ?>",
};
 
let stripe = Stripe(config.publishable_key);
let elements = stripe.elements();
let card = elements.create("card");
 
card.mount("#card-field");

 
let form = document.getElementById('payment-form');
let errors = document.getElementById('card-errors');
 
form.addEventListener('submit', function(evt){
    
    evt.preventDefault();
    $('#payBtn').addClass('d-none');
    $('#proces').removeClass('d-none');
    stripe.createPaymentMethod('card', card).then(function(result) {
        if (result.error) {
            errors.textContent = result.error.message;
            $('#card-errors').addClass('alert-danger');
            $('#payBtn').removeClass('d-none');
            $('#proces').addClass('d-none');
            return;
        }
        errors.textContent = "";
        $('#card-errors').removeClass('alert-danger');
 
        fetch('create_payment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                payment_method_id: result.paymentMethod.id,
                email: document.getElementById('email').value,
                country: document.getElementById('country').value,
                zip: document.getElementById('zip').value,
                state: document.getElementById('state').value,
                city: document.getElementById('city').value,
                address2: document.getElementById('address2').value,
                address: document.getElementById('address').value,
                phone: document.getElementById('phone').value,
                link_token: document.getElementById('link_token').value,
                p_name: document.getElementById('p_name').value,
                currency: document.getElementById('currency').value,
                amount: document.getElementById('amount').value,
                firstname: document.getElementById('fname').value,
                lastname: document.getElementById('lname').value,
            })
        })
        .then(function(responseBody) {
            return responseBody.json();
            
        })
        .then(handleServerResponse);
    });
});
 
function handleServerResponse(response) {
    // console.log(response);
    if (response.error) {
        document.getElementById("payment-errors").textContent = response.error.message;
        if(response.error.message == "FAIL")
        {
            window.location = ('https://sketchiconic.com/payment/fail.php');
        }

        
    $('#proces').addClass('d-none');
    $('#payBtn').removeClass('d-none');
    $('#payment-errors').removeClass('alert-success');
    $('#payment-errors').addClass('alert-danger');
    } else if (response.requires_action) {
        document.getElementById("payment-errors").textContent = "Requires action";
        // Use Stripe.js to handle required card action
        $('#payment-errors').removeClass('alert-danger');
        $('#payment-errors').addClass('alert-success');
        handleAction(response);
    } else {
        document.getElementById("payment-errors").textContent = "Success!";
        $('#payment-errors').removeClass('alert-danger');
        $('#payment-errors').addClass('alert-success');
        document.getElementById("payment-form").submit();
    }
}
 
function handleAction(response) {
    stripe.handleCardAction(
        response.payment_intent_client_secret
    ).then(function(result) {
        if (result.error) {
            document.getElementById("payment-errors").textContent = result.error.message;
        $('#payment-errors').addClass('alert-danger');
        $('#payment-errors').removeClass('alert-success');
        $('#proces').addClass('d-none');
        $('#payBtn').removeClass('d-none');
        } else {
            // The card action has been handled
            // The PaymentIntent can be confirmed again on the server
            fetch('confirm_payment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    payment_intent_id: result.paymentIntent.id,
                })
            }).then(function(confirmResult) {
                return confirmResult.json();
            }).then(handleServerResponse);
        }
    });
}
</script>

<?php 
    }
    else{
        echo '<div class="container col-md-6 py-5">No Record Found';
    } 
}
else{
    echo '<div class="container col-md-6 py-5">No Token Found</div>';
} 

?>

</body>

</html>