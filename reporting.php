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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
	<div class="header"><img src="ok.png"></div>
	<div class="header-text">This form allows us to initiate the event you wish to report</div>
	<form method="POST">
	<div class="input">
		<input type="text" name="name" class="form-control" id="name" placeholder="Your Name">
		<span id="namespan" style="color:red"></span>
		<input type="text" name="number" class="form-control" id="number" onkeyup="sendOTP()" placeholder="Your Number">
	</div>
	<div class="">
	By requesting & using an OTP, you hereby agree to terms of use of the <b>Emergency Contact Service Platform</b>
	</div>
	<div id="numberVerify" class="input otp">
		<input type="text" id="otp" onkeyup="checkOTP()" class="form-control" placeholder="OTP">
	</div>
	</form>
	<div>Once your number is validated, we will call you and then patch you on a conference call with the emergency contact for the QR code scanned</div>
	<div class="note">Please note, all the calls are recorded </div>
	<div class="sticky-position">
		<div class="sticky-footer">
			<div class="term-privacy">Terms | Privacy</div>
			<hr>
		</div>
	</div>
	<!-- Design and Developed By WEB IT SERVICES (www.web-it-services.com) -->
</div>
</body>
</html>
<style>
body{
	margin:0;
	color:#6a6f8c;
	background:#fff;
	font:600 16px/18px 'Open Sans',sans-serif;
}
.container{
	padding:58px;
}
.header{
	padding-top : 23px;
}
.header-text{
	padding-top : 14px
}
.input{
	padding: 20px 0;
}
input[type=text] {
	color:#fff;
    width: 80%;
	height:40px;
    padding: 12px 20px;
    margin: 8px 0;
    font-size: 14px;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    background: #2B4469;
    box-sizing: border-box;
  }
  .otp input[type=text]{
	color:#fff;
    width: 55%;
	height:40px;
    padding: 12px 20px;
    margin: 8px 0;
    font-size: 14px;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    background: #2B4469;
    box-sizing: border-box;
  }
  .note{
	  padding: 15px 0;
	  color:#F52525;
  }
  .sticky-footer{
	  max-height:100px;
	  position: absolute;
	  margin-top: 30px;
	  /* bottom: 15px; */
  }
  .term-privacy{
	  padding-bottom:-2px;
  }
  hr{
	border: 4px solid green;
	opacity: 1;
  }
  .sticky-position{
	position: relative;
   }
</style>
<script>
	var ses = null;
	function sendOTP() {
		var number = document.getElementById('number').value;
		var name = document.getElementById('name').value;
		console.log(name.length)
		if(name.length == 0){
			document.getElementById('namespan').innerHTML = 'Enter Your Name First Please.';
		}else{
			document.getElementById('namespan').style.display = "none";
			if(number.length == 10){
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
		}
		console.log(number.length)
		
	}
	
	function checkOTP() {
		console.log(ses)
		var otp = document.getElementById('otp').value;
		console.log(otp.length)
		if(otp.length == 6){
			var url = "https://2factor.in/API/V1/fda7bc0b-20f9-11e7-929b-00163ef91450/SMS/VERIFY/" + ses + "/" + otp;

			var xhr = new XMLHttpRequest();
			xhr.open("GET", url);

			xhr.setRequestHeader("Accept", "application/json");

			xhr.onreadystatechange = function () {
			if (xhr.readyState === 4) {
				console.log(xhr.status);
				console.log((xhr.responseText));
				if(xhr.status == 200){
					alert("OTP Verified")
					document.getElementById('numberVerify').innerHTML = '<button type="submit" name="add" class="btn btn-primary">Connect</button>';
				}
			}};

			xhr.send();
		}
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