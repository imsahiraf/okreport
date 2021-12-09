<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Oye Kidhar - Emergency</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="OKWale Official Dashboard" name="description" />
<meta content="Web IT services" name="author" />
<!-- App favicon -->
<link rel="shortcut icon" href="https://admin.okwale.com/assets/images/ok.jpeg">

</head>
<body>
<div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">OK Wale</label>
		<form class="login-form" method="POST">
			<div class="sign-in-htm">
				<div class="group">
					<label for="user" class="label">Your Name</label>
					<input name="name" type="text" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Phone Number</label>
					<input name="number" type="number" id="number" class="input">
					<button onclick="return sendOTP()" id="verified" type="button" class="button">Send OTP</button>
				</div>
				<div class="group" id="numberVerify">
					<label for="pass" class="label">OTP</label>
					<input name="number" type="number" id="otp" class="input">
					<button onclick="return checkOTP()" type="button" class="button" required>Confirm OTP</button>
				</div>
				<div class="group">
					<button type="submit" class="button" name="add">Submit</button>
				</div>
			</div>
			<div class="sign-up-htm">
				<p>OK wale provide emergency help to everyone</p>
                <p>OK wale is under Oye Kidhar Pvt Ltd</p>
                <p style="padding-top:50px">Design and developed with love by <a href="https://web-it-services.com/" target="_blank">Web IT Services</a></p>
			</div>
		</form>
	</div>
</div>
</body>
</html>
<style>
body{
	margin:0;
	color:#6a6f8c;
	background:#c8c8c8;
	font:600 16px/18px 'Open Sans',sans-serif;
}
*,:after,:before{box-sizing:border-box}
.clearfix:after,.clearfix:before{content:'';display:table}
.clearfix:after{clear:both;display:block}
a{color:inherit;text-decoration:none}

.login-wrap{
	width:100%;
	margin:auto;
	max-width:525px;
	min-height:670px;
	position:relative;
	background:url(https://raw.githubusercontent.com/khadkamhn/day-01-login-form/master/img/bg.jpg) no-repeat center;
	box-shadow:0 12px 15px 0 rgba(0,0,0,.24),0 17px 50px 0 rgba(0,0,0,.19);
}
.login-html{
	width:100%;
	height:100%;
	position:absolute;
	padding:90px 70px 50px 70px;
	background:rgba(40,57,101,.9);
}
.login-html .sign-in-htm,
.login-html .sign-up-htm{
	top:0;
	left:0;
	right:0;
	bottom:0;
	position:absolute;
	transform:rotateY(180deg);
	backface-visibility:hidden;
	transition:all .4s linear;
}
.login-html .sign-in,
.login-html .sign-up,
.login-form .group .check{
	display:none;
}
.login-html .tab,
.login-form .group .label,
.login-form .group .button{
	text-transform:uppercase;
}
.login-html .tab{
	font-size:22px;
	margin-right:15px;
	padding-bottom:5px;
	margin:0 15px 10px 0;
	display:inline-block;
	border-bottom:2px solid transparent;
}
.login-html .sign-in:checked + .tab,
.login-html .sign-up:checked + .tab{
	color:#fff;
	border-color:#1161ee;
}
.login-form{
	min-height:345px;
	position:relative;
	perspective:1000px;
	transform-style:preserve-3d;
}
.login-form .group{
	margin-bottom:15px;
}
.login-form .group .label,
.login-form .group .input,
.login-form .group .button{
	width:100%;
	color:#fff;
	display:block;
}
.login-form .group .input,
.login-form .group .button{
	border:none;
	padding:15px 20px;
	border-radius:25px;
	background:rgba(255,255,255,.1);
}
.login-form .group input[data-type="password"]{
	text-security:circle;
	-webkit-text-security:circle;
}
.login-form .group .label{
	color:#aaa;
	font-size:12px;
}
.login-form .group .button{
	background:#1161ee;
}
.login-form .group label .icon{
	width:15px;
	height:15px;
	border-radius:2px;
	position:relative;
	display:inline-block;
	background:rgba(255,255,255,.1);
}
.login-form .group label .icon:before,
.login-form .group label .icon:after{
	content:'';
	width:10px;
	height:2px;
	background:#fff;
	position:absolute;
	transition:all .2s ease-in-out 0s;
}
.login-form .group label .icon:before{
	left:3px;
	width:5px;
	bottom:6px;
	transform:scale(0) rotate(0);
}
.login-form .group label .icon:after{
	top:6px;
	right:0;
	transform:scale(0) rotate(0);
}
.login-form .group .check:checked + label{
	color:#fff;
}
.login-form .group .check:checked + label .icon{
	background:#1161ee;
}
.login-form .group .check:checked + label .icon:before{
	transform:scale(1) rotate(45deg);
}
.login-form .group .check:checked + label .icon:after{
	transform:scale(1) rotate(-45deg);
}
.login-html .sign-in:checked + .tab + .sign-up + .tab + .login-form .sign-in-htm{
	transform:rotate(0);
}
.login-html .sign-up:checked + .tab + .login-form .sign-up-htm{
	transform:rotate(0);
}

.hr{
	height:2px;
	margin:60px 0 50px 0;
	background:rgba(255,255,255,.2);
}
.foot-lnk{
	text-align:center;
}
</style>
<script>
	var ses = null;
	function sendOTP() {
		var number = document.getElementById('number').value;
		var url = "https://2factor.in/API/V1/fda7bc0b-20f9-11e7-929b-00163ef91450/SMS/+91" + number + "/AUTOGEN/otp_new";

		var xhr = new XMLHttpRequest();
		xhr.open("GET", url);

		xhr.setRequestHeader("Accept", "application/json");

		xhr.onreadystatechange = function () {
		if (xhr.readyState === 4) {
			console.log(xhr.status);
			// console.log((xhr.responseText));
			result = JSON.parse(xhr.responseText);
			
			ses = result.Details;

		}};

		xhr.send();

	}
	
	function checkOTP() {
		console.log(ses)
		var otp = document.getElementById('otp').value;
		var url = "https://2factor.in/API/V1/fda7bc0b-20f9-11e7-929b-00163ef91450/SMS/VERIFY/" + ses + "/" + otp;

		var xhr = new XMLHttpRequest();
		xhr.open("GET", url);

		xhr.setRequestHeader("Accept", "application/json");

		xhr.onreadystatechange = function () {
		if (xhr.readyState === 4) {
			console.log(xhr.status);
			console.log((xhr.responseText));
			if(xhr.status == 200){
				document.getElementById('numberVerify').innerHTML = "OTP Verified";
				document.getElementById("verified").style.display = "none"; 
			}
		}};

		xhr.send();
	}
</script>
<?php 
$id = $_GET['id'];
if(isset($_POST['add'])){
	$reportno = "REPORT".rand(00000,999999);
    $id = $_GET['id'];
    $name=$_POST["name"];
	$number=$_POST["number"];
	$_SESSION['number'] = $number;
	// $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$actual_link = "https://report.okwale.com/d8c452200092";
	$connect = httpGet("https://us-east-1.aws.webhooks.mongodb-realm.com/api/client/v2.0/app/application-0-aqwyr/service/okapp-users/incoming_webhook/qrget?user_url=$actual_link");
	$connect = json_decode($connect, TRUE);
	print_r($connect);
	$emer = $emergency = '';
	$x = 1;
	foreach($connect as $c1){
		// print_r($c1) ;
		if(empty($c1)){
			echo "Not";
		}else{
			// print_r($connect[0]); 
			if($x === 1){
				$emergency .= '"'.$c1['em_numb'].'"';
				$emname = $c1['em_name'];
				$emnum = $c1['em_numb'];
				$emer .= '{"name":"'.$emname.'","number":"'.$emnum.'"}';
			}else{
				$emergency .= ',"'.$c1['em_numb'].'"';
				$emname = $c1['em_name'];
				$emnum = $c1['em_numb'];
				$emer .= ',{"name":"'.$emname.'","number":"'.$emnum.'"}';
			}
			$x++;
		}
		
	}
	$emergencynumber = '['.$emergency.']';
	$emergencydetails = '['.$emer.']';
	// echo $emergencynumber;echo $emergencydetails;
	// echo '[{"name":"'.$emlist.'","number":"'.$emergency.'"}]';
	$ref = httpGet("https://us-east-1.aws.webhooks.mongodb-realm.com/api/client/v2.0/app/application-0-aqwyr/service/okapp-users/incoming_webhook/removeEvent?ref=$number");
	$ref = json_decode($ref, TRUE);
	foreach($ref as $r1){
		// print_r($r1) ;
	}
	$reference_id = httpGet("https://us-east-1.aws.webhooks.mongodb-realm.com/api/client/v2.0/app/application-0-aqwyr/service/okapp-users/incoming_webhook/urlidget?url=$actual_link");
	$reference_id = json_decode($reference_id, TRUE);
	$reportingname = $reference_id;
	$postEm = httpPost("https://us-east-1.aws.webhooks.mongodb-realm.com/api/client/v2.0/app/application-0-aqwyr/service/okapp-users/incoming_webhook/setEvent",array("numbers"=>$emergencynumber,"numbMap"=>$emergencydetails,"reportingname"=>$reportingname,"name"=>$name,"refid"=>$number));
	$postEm = json_decode($postEm, TRUE);
	if($postEm){
		echo '<script>alert("Report sent! Please wait until the call gets connected.");</script>';
	}
	$callnow = httpGet("https://www.kookoo.in/outbound/outbound.php?phone_no=$number&api_key=KK61b84dd1689af190886c8988dc8d1ca9&url=https://us-east-1.aws.webhooks.mongodb-realm.com/api/client/v2.0/app/application-0-aqwyr/service/okapp-users/incoming_webhook/calltesting&caller_id=912250647347&callback_url=https://us-east-1.aws.webhooks.mongodb-realm.com/api/client/v2.0/app/application-0-aqwyr/service/okapp-users/incoming_webhook/callTest");
	$callnow = json_decode($callnow, TRUE);
	echo '<script>document.location="confirm.php"</script>';
	if($callnow){
		echo '<script>alert("Thank you for using our services");</script>';
	}
}

function httpPost($url, $data){
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
function httpGet($url){
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	curl_close($curl);
	return $response;
	}
?>