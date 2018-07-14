<?php include 'inc/header.php'; ?>


<?php 

require('../vendor/autoload.php');

$client = new \Nexmo\Client(new Nexmo\Client\Credentials\Basic('5611a0f4', 'Ahmadasdf6'));
 

 // Turn off error reporting
error_reporting(0);

 ?>
<?php 
if(isset($_GET['blood_group'])){
          
          $blood_group = $_GET['blood_group'];
  
          
      }

 ?>


      <?php       
            if ($_SERVER['REQUEST_METHOD']=='POST') {  
            $message =  $fm->validation($_POST['message']);  
            $blood_group =  $fm->validation($_POST['blood_group']);  
            $message =  mysqli_real_escape_string($db->link,$message);
            $blood_group =  mysqli_real_escape_string($db->link,$blood_group);
           
            if(empty($message) || empty($blood_group)){
              echo "<span class='label label-danger'>Message field must not be empty  !!!</span><br><br>";
            }else{

                $query = "select * from tbl_donors where donor_group='$blood_group' AND approve=1";
                $donors = $db->select($query);
                if($donors){
                while ($result = $donors->fetch_assoc()) {

                  $phone_number = $result['mobile_number'];

                     $client->message()->send([
                      'from' => '+88023423424',
                      'to' => $phone_number,
                      'text' => $message
                    ]);
                  
                }
             
              }
              

           
              Session::set("message","Message successfully sent  !!!");
            }
          }


?>
    <div class="container">
      <div class="row">
        <h2>Select a Blood group</h2><hr>
         <?php 

               if(Session::get("message")){ ?>
                  <span class="label label-success"><?php echo Session::get("message"); ?></span><br><br>
                  <?php Session::unset_it("message");
                  }

            ?>
           
          <div class="well">
               <form action="" method="POST" class="form-horizontal" role="form">
                 

                    <div class="form-group" style="padding:14px;">
                      <label for="usr">Your Message:</label>
                      <input type="text" name="message" class="form-control" id="usr" style="min-width: 100%" required>
                    </div>

                    <button class="btn btn-primary pull-right" type="submit">Send Sms</button><ul class="list-inline"><li>Select Blood group : </li><li>
                      <select name="blood_group" class="form-control" id="sel1"  required="required">
                        <option value="">Select Blood Group</option>
                        <option <?php if($blood_group=='A negative(-)'){echo 'selected';} ?> value="A negative(-)">A negative(-) blood donars</option>
                        <option <?php if($blood_group=='A positive( )'){echo 'selected';} ?> value="A positive(+)">A positive(+) blood donars</option>
                        <option <?php if($blood_group=='AB negative(-)'){echo 'selected';} ?> value="AB negative(-)">AB negative(-) blood donars</option>
                        <option <?php if($blood_group=='AB positive( )'){echo 'selected';} ?> value="AB positive(+)">AB positive(+) blood donars</option>
                        <option <?php if($blood_group=='B negative(-)'){echo 'selected';} ?> value="B negative(-)">B negative(-) blood donars</option>
                        <option <?php if($blood_group=='B positive( )'){echo 'selected';} ?> value="B positive(+)">B positive(+) blood donars</option>
                        <option <?php if($blood_group=='O negative(-)'){echo 'selected';} ?> value="O negative(-)">O negative(-) blood donars</option>
                        <option <?php if($blood_group=='O positive( )'){echo 'selected';} ?> value="O positive(+)">O positive(+) blood donars</option>
                    </select>
                    </li>
                    </ul>
                </form>
             </div>
        </div>
    </div>
       
<?php include 'inc/footer.php'; ?>