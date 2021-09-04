<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Vietpro Mobile Shop - Administrator</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); }
if(isset($_SESSION['locked']))
{
    $differ = time() - $_SESSION['locked'];
    if( $differ > 6 ) {
        unset($_SESSION['locked']);
        unset($_SESSION['login_attempts']);
    }

}
if(isset($_POST["sbm"])){

	$mail=$_POST["mail"];
	$pass=$_POST["pass"];
	$sql="SELECT * FROM user WHERE user_mail='$mail' AND user_pass='$pass'";
	$query=mysqli_query($conn,$sql);
	$row=mysqli_num_rows($query);
	// $_SESSION["mail"]="vietpro.edu.vn@gmail.com";
    // $_SESSION["pass"]="123456";
	// $mail==$_SESSION["mail"]&&$pass==$_SESSION["pass"]
	if($row>0){
		$_SESSION["mail"]=$mail;
		$_SESSION["pass"]=$pass;
		header("location:index.php");
    }else{
//        if(isset($_SESSION["login_attempts"])){
            $_SESSION["login_attempts"] += 1;
//        }
	    $errorrs='<div class="alert alert-danger">Tài khoản không hợp lệ !</div>';
	}
}
?>
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Vietpro Mobile Shop - Administrator</div>
				<div class="panel-body">
					<!-- <div class="alert alert-danger">Tài khoản không hợp lệ !</div> -->
					<?php if(isset($errorrs)){echo $errorrs;} ?>
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="mail" type="email" autofocus value="<?= isset($_POST['mail'])?$_POST['mail']:'';  ?>">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Mật khẩu" name="pass" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Nhớ tài khoản
								</label>
							</div>
                            <?php
                                if(isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] > 2) {
                                    $_SESSION['locked'] = time();
                                    $count =time() - $_SESSION['locked'];
                                    echo '<p id="demo">Waiting for 6 seconds</p>';
//                                    echo header("refresh: 6");
                                }
                                else {
                            ?>
							<button type="submit" class="btn btn-primary" name="sbm">Đăng nhập</button>
						    <?php }  ?>
                        </fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
<script>
    setTimeout(myTimeout1, 1000)
    setTimeout(myTimeout2, 2000)
    setTimeout(myTimeout3, 3000)
    setTimeout(myTimeout4, 4000)
    setTimeout(myTimeout5, 5000)
    setTimeout(myTimeout6, 6000)

    function myTimeout1() {
        document.getElementById("demo").innerHTML = "1 seconds";
    }
    function myTimeout2() {
        document.getElementById("demo").innerHTML = "2 seconds";
    }
    function myTimeout3() {
        document.getElementById("demo").innerHTML = "3 seconds";
    }
    function myTimeout4() {
        document.getElementById("demo").innerHTML = "4 seconds";
    }
    function myTimeout5() {
        document.getElementById("demo").innerHTML = "5 seconds";
    }
    function myTimeout6() {
        document.getElementById("demo").innerHTML = "6 seconds";
    }
</script>
</body>

</html>


