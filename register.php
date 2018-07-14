<?php 
include 'lib/Session.php';

?>
<?php include 'config/config.php';?>
<?php include 'lib/Database.php';?>
<?php include 'helpers/Format.php';?>
<?php 
        $db = new Database();
        $fm = new Format();  
        Session::init();   
        $config = require('config.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Blood Donor Management System</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">


    <!-- Fonts from Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>

  <!-- Website Font style -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
        <!-- Fonts from Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>

  <!-- Website Font style -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
      <style type="text/css">
    /*
/* Created by Filipe Pina
 * Specific styles of signin, register, component
 */
/*
 * General styles
 */

body, html{
     height: 100%;
  background-repeat: no-repeat;
  background-color: #d3d3d3;
  font-family: 'Oxygen', sans-serif;
}

.main{
  margin-top: 70px;
}

h1.title { 
  font-size: 50px;
  font-family: 'Passion One', cursive; 
  font-weight: 400; 
}

hr{
  width: 10%;
  color: #fff;
}

.form-group{
  margin-bottom: 15px;
}

label{
  margin-bottom: 15px;
}

input,
input::-webkit-input-placeholder {
    font-size: 11px;
    padding-top: 3px;
}

.main-login{
  background-color: #fff;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);

}

.main-center{
  margin-top: 30px;
  margin: 0 auto;
  max-width: 330px;
    padding: 40px 40px;

}

.login-button{
  margin-top: 5px;
}

.login-register{
  font-size: 11px;
  text-align: center;
}

html,
body {
    margin:0;
    padding:0;
    height:100%;
}
#wrapper {
    min-height:100%;
    position:relative;
}
#content {
    padding-bottom:100px; /* Height of the footer element */
}
#footer {
   
    width:100%;
    
    position:absolute;
    bottom:0;
    left:0;
}

  </style>
  <script src='https://www.google.com/recaptcha/api.js'></script>
   <script>
       function onSubmit(token) {
         document.getElementById("demo-form").submit();
       }
     </script>
</head><!--/head-->
<body>
<div id="wrapper">
    <header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="logo"></a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo SITE_URL;?>">Home</a></li>
                    <li class="active"><a href="register.php">Register</a></li>
                            <li><a href="login.php">Login</a></li>
                </ul>
            </div>
        </div>
    </header><!--/header-->

    <div id="content">
        <section id="recent-works">
    <div class="container">
        <div class="row">

             <div class="main-login main-center" style="margin-top: 71px">
              <center><h4 style="margin-top: -17px">Complete Your Registration</h4></center>
               <?php 
            if ($_SERVER['REQUEST_METHOD']=='POST') {  
        
class Recaptcha{
  
  public function __construct(){
        $this->config = require('config.php');
    }

  public function verifyResponse($recaptcha){
    
    $remoteIp = $this->getIPAddress();

    // Discard empty solution submissions
    if (empty($recaptcha)) {
      return array(
        'success' => false,
        'error-codes' => 'missing-input',
      );
    }

    $getResponse = $this->getHTTP(
      array(
        'secret' => $this->config['secret-key'],
        'remoteip' => $remoteIp,
        'response' => $recaptcha,
      )
    );

    // get reCAPTCHA server response
    $responses = json_decode($getResponse, true);

    if (isset($responses['success']) and $responses['success'] == true) {
      $status = true;
    } else {
      $status = false;
      $error = (isset($responses['error-codes'])) ? $responses['error-codes']
        : 'invalid-input-response';
    }

    return array(
      'success' => $status,
      'error-codes' => (isset($error)) ? $error : null,
    );
  }


  private function getIPAddress(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
    {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
    } 
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
    {
     $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } 
    else 
    {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    
    return $ip;
  }

  private function getHTTP($data){
    
    $url = 'https://www.google.com/recaptcha/api/siteverify?'.http_build_query($data);
    $response = file_get_contents($url);

    return $response;
  }
}

$recaptcha = $_POST['g-recaptcha-response'];

$object = new Recaptcha();
$response = $object->verifyResponse($recaptcha);

if(isset($response['success']) and $response['success'] != true) {
  echo "An Error Occured and Error code is :".$response['error-codes'];
}else {
  
   $username =  $fm->validation($_POST['username']);  
            $password =  $fm->validation($_POST['password']);  
            $password = password_hash($password, PASSWORD_BCRYPT);  
            $full_name =  $fm->validation($_POST['full_name']);  
            $date_of_birth =  $fm->validation($_POST['date_of_birth']);  
            $age =  $fm->validation($_POST['age']);  
            $donor_group =  $fm->validation($_POST['donor_group']);  
            $gender =  $fm->validation($_POST['gender']);  
            $mobile_number =  $fm->validation($_POST['mobile_number']);  
            $other_number =  $fm->validation($_POST['other_number']);  
            $place =  $fm->validation($_POST['place']);  
            $island =  $fm->validation($_POST['island']);  
            $last_donated =  $fm->validation($_POST['last_donated']);  

            $username =  mysqli_real_escape_string($db->link,$username);
            $password =  mysqli_real_escape_string($db->link,$password);
            $full_name =  mysqli_real_escape_string($db->link,$full_name);
            $date_of_birth =  mysqli_real_escape_string($db->link,$date_of_birth);
            $age =  mysqli_real_escape_string($db->link,$age);
            $donor_group =  mysqli_real_escape_string($db->link,$donor_group);
            $gender =  mysqli_real_escape_string($db->link,$gender);
            $mobile_number =  mysqli_real_escape_string($db->link,$mobile_number);
            $other_number =  mysqli_real_escape_string($db->link,$other_number);
            $place =  mysqli_real_escape_string($db->link,$place);
            $island =  mysqli_real_escape_string($db->link,$island);
            $last_donated =  mysqli_real_escape_string($db->link,$last_donated);
            
         
           if(empty($username) || empty($password) || empty($full_name) || empty($date_of_birth) || empty($age)|| empty($donor_group)|| empty($gender)|| empty($mobile_number)|| empty($place)|| empty($island)|| empty($last_donated)){
            echo "<span class='label label-danger'>Required fields must not be empty  !!!</span><br><br>";
           }else{
           $mailquery = "SELECT * FROM tbl_donors where username = '$username' limit 1";
           $mailcheck = $db->select($mailquery);
           if ($mailcheck != false) {
            echo "<span class='label label-danger'>Username Already exists  !!!</span><br><br>";
           }else{
               $mobile_number='+960'.$mobile_number;
           
               $query = "INSERT INTO  tbl_donors(username,password,full_name,date_of_birth,age,donor_group,gender,mobile_number,other_number,place,island,last_donated) VALUES ('$username','$password','$full_name','$date_of_birth','$age','$donor_group','$gender','$mobile_number','$other_number','$place','$island','$last_donated')";
                $userinsert = $db->insert($query);
                if($userinsert){
                  Session::set("message","Registration successful !!!");
            Session::set("color","success");
            echo "<script>window.location='login.php'</script>";  
            exit();
                }   else {
                  Session::set("message","Registration successful !!!");
            Session::set("color","success");
            echo "<script>window.location='login.php'</script>";  
            exit();
                    }
                }                
                } 
}
}
            
  
            ?>
              <form class="form-horizontal" method="post" id="demo-form" action="">   

            <div class="form-group">
              <label for="username" class="cols-sm-2 control-label">Username*</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="username" id="username"  placeholder="Enter your Username" required />
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="password" class="cols-sm-2 control-label">Password*</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                  <input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password" required/>
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label for="full_name" class="cols-sm-2 control-label">Full Name*</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="full_name" id="full_name"  placeholder="Enter Your Full Name" required/>
                </div>
              </div>
            </div>

             <div class="form-group">
              <label for="date_of_birth" class="cols-sm-2 control-label">Date of Birth*</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"  placeholder="Enter The Date You Last Donated Blood" required/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="age" class="cols-sm-2 control-label">Age*</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="number" class="form-control" name="age" id="age"  placeholder="Enter Your Age" required/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="blood_group" class="cols-sm-2 control-label">Blood Group*</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <select name="donor_group" class="form-control" id="sel1"  required="required">
                    <option value="A negative(-)">A negative(-)</option>
                    <option value="A positive(+)">A positive(+)</option>
                    <option value="AB negative(-)">AB negative(-)</option>
                    <option value="AB positive(+)">AB positive(+)</option>
                    <option value="B negative(-)">B negative(-)</option>
                    <option value="B positive(+)">B positive(+)</option>
                    <option value="O negative(-)">O negative(-)</option>
                    <option value="O positive(+)">O positive(+)</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="gender" class="cols-sm-2 control-label">Gender*</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <select name="gender" class="form-control" id="gender"  required="required">
                    <option value="male">male</option>
                    <option value="female">Female</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="mobile_number" class="cols-sm-2 control-label">Mobile Number*  :</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="mobile_number" id="mobile_number"  placeholder="Enter Your Mobile Number. Example: 9872070" required/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="other_number" class="cols-sm-2 control-label">Other Phone Number</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="other_number" id="other_number"  placeholder="Enter Your Other Phone Number"/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="place" class="cols-sm-2 control-label">Place*</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="place" id="place"  placeholder="Enter Your Place Name" required/>
                </div>
              </div>
            </div>

             <div class="form-group">
              <label for="island" class="cols-sm-2 control-label">Island*</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="island" id="island"  placeholder="Enter Your Island Name" required/>
                </div>
              </div>
            </div>

             <div class="form-group">
              <label for="last_donated" class="cols-sm-2 control-label">Date Last Donated Blood*</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="date" class="form-control" name="last_donated" id="last_donated"  placeholder="Enter The Date You Last Donated Blood" required/>
                </div>
              </div>
            </div>

            <div class="form-group ">
              <button class="btn btn-primary btn-lg btn-block login-button g-recaptcha" data-sitekey="<?php echo $config['client-key']; ?>"
    data-callback="onSubmit">Register</button>
            </div>
          </form>
          </div>
        </div>
    </div>
</section>
</div>
    <div id="footer">
  <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-12"><center>
                    Copyright &copy; 2017 All rights reserved</center>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
    </div>
</body>
</html>