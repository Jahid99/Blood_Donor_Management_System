<?php include 'inc/header.php';?>

  <?php 
   if (isset($_GET['id'])) {
      $id = $_GET['id'];
    }
  ?>

<?php 

require('vendor/autoload.php');

$client = new \Nexmo\Client(new Nexmo\Client\Credentials\Basic('5611a0f4', 'Ahmadasdf6'));
 

 // Turn off error reporting
error_reporting(0);

 ?>

<section class="homepage">


<div class="container">
            <div class="row">
        <div class="col-md-12">
      <center><h2>Send message to the donor for blood</h2></center><hr>
      </div>
      </div>
        </div>

    <div class="container">
            <div class="row">

  <?php       
            if ($_SERVER['REQUEST_METHOD']=='POST') {  
            $message =  $fm->validation($_POST['message']);  
            $message =  mysqli_real_escape_string($db->link,$message);
           
            if(empty($message)){
              echo "<span class='label label-danger'>Message field must not be empty  !!!</span><br><br>";
            }else{

                $query = "select * from tbl_donors where id='$id'";
                $donor = $db->select($query);
                if($donor){
                while ($result = $donor->fetch_assoc()) {

                  $phone_number = $result['mobile_number'];
                  
                }
              }
              

              $client->message()->send([
                'from' => '+88023423424',
                'to' => $phone_number,
                'text' => $message
              ]);
              
              echo "<span class='label label-success'>Message successfully sent  !!!</span><br><br>";
            }
          }


    ?>
                <form action="" method="POST">
                  <div class="form-group">
                    <label for="comment">Your Message:</label>
                     <input type="text" class="form-control" name="message" id="comment"  placeholder="Enter Your Message Here..." required/>
                  </div>
                  <div class="form-group ">
                    <button type="submit" class="btn btn-primary btn-lg">Send</button>
                  </div>
              </form>
            </div>
      </div>
        
    </section>

<?php include 'inc/footer.php';?>