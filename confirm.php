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
<link rel="shortcut icon" href="https://admin.okwale.com/assets/images/ok.jpeg">

</head>
<body>
<div class="container">
	<div class="header"><img src="okwale.png"></div>
	<div class="header-text">Your event has been successfully reported.</div>
	<hr align="left">
	<div class="p1">While we make an attempt to initiate the call immediately, there could be delays due to network congestion or other issues beyond our control</div>
	<div class="p2">Please stand-by while we connect with you first and then patch you on a call with the emergency contacts</div>
	<div class="p3">Please give us your feedback</div>
	<div class="status">
		<form method="POST">
			<button onclick="connected()" class="btn btn-primary">Call Completed</button>
			<button name="add" type="submit" class="btn btn-primary">Call Dropped</button>
		</form>
	</div>
	<div class="sticky-footer">
		<div class="term-privacy">Terms | Privacy</div>
		<hr>
	</div>
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
	padding-top: 39px;
}
.header-text{
	padding-top:60px;
	width:60%
}
hr{
	width:100px;
	border: 4px solid green;
	opacity: 1;
}
.p1{
	padding-top:29px
}
.p2{
	padding-top:13px
}
.p3{
	padding-top:20px
}
.status{
	position: relative;
	padding-top:13px
}
.sticky-footer{
	max-height:100px;
	position: fixed;
	bottom: 15px;
}
.term-privacy{
	padding-bottom:-2px;
}
.btn-primary{
	background: #2B4469;
}
</style>
<script>
function connected(){
    alert("Thank you for using out services!")
}
</script>
<?php 
// $id = $_GET['id'];
if(isset($_POST['add'])){
    $number = $_SESSION['number'];
	$callnow = httpGet("https://www.kookoo.in/outbound/outbound.php?phone_no=$number&api_key=KK61b84dd1689af190886c8988dc8d1ca9&url=https://us-east-1.aws.webhooks.mongodb-realm.com/api/client/v2.0/app/application-0-aqwyr/service/okapp-users/incoming_webhook/calltesting&caller_id=912250647347&callback_url=https://us-east-1.aws.webhooks.mongodb-realm.com/api/client/v2.0/app/application-0-aqwyr/service/okapp-users/incoming_webhook/callTest");
	$callnow = json_decode($callnow, TRUE);
	// echo '<script>alert('.$callnow.');</script>';
	echo '<script>document.location="confirm.php"</script>';
}

function httpGet($url){
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	curl_close($curl);
	return $response;
	}
?>