<?php include 'inc/header.php';?>

<section class="homepage">

        <div class="container">
            <div class="row">
                    <div class="col-md-12">
                    <?php 
            if ($_SERVER['REQUEST_METHOD']=='POST') {  
            $name =  $fm->validation($_POST['name']);    
            $blood_type =  $fm->validation($_POST['blood_type']);    
            $atoll =  $fm->validation($_POST['atoll']);  
            $contact =  $fm->validation($_POST['contact']);  
            $priority =  $fm->validation($_POST['priority']);  
            $island =  $fm->validation($_POST['island']);  
            $comment =  $fm->validation($_POST['comment']);  

            $name =  mysqli_real_escape_string($db->link,$name);
            $blood_type =  mysqli_real_escape_string($db->link,$blood_type);
            $atoll =  mysqli_real_escape_string($db->link,$atoll);
            $contact =  mysqli_real_escape_string($db->link,$contact);
            $priority =  mysqli_real_escape_string($db->link,$priority);
            $island =  mysqli_real_escape_string($db->link,$island);
            $comment =  mysqli_real_escape_string($db->link,$comment);
         
           if(empty($name) || empty($blood_type) || empty($atoll) || empty($contact) || empty($priority) || empty($island) || empty($comment) ){
            echo "<span class='label label-danger'>Field must not be empty  !!!</span><br><br>";
           }else{
            $contact='+960'.$contact;
           $query = "INSERT INTO  tbl_blood_request(name,blood_type,atoll,contact,priority,island,comment) VALUES ('$name','$blood_type','$atoll','$contact','$priority','$island','$comment')";
                $userinsert = $db->insert($query);
                if($userinsert){
                   echo "<center><span class='label label-success'>Request Successfully Sent...!!!</span></center><br><br>";
            
                          }    
            }
          }
  
            ?>
                        <form action="search.php" class="form-horizontal" role="form" method="get">
            <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Search:</label>
      <div class="col-md-7">          
         <select name="blood_group" class="form-control" id="sel1"  required="required">
                <option value="">Select Blood Group</option>
                <option value="A negative(-)">A negative(-) blood donars</option>
                <option value="A positive(+)">A positive(+) blood donars</option>
                <option value="AB negative(-)">AB negative(-) blood donars</option>
                <option value="AB positive(+)">AB positive(+) blood donars</option>
                <option value="B negative(-)">B negative(-) blood donars</option>
                <option value="B positive(+)">B positive(+) blood donars</option>
                <option value="O negative(-)">O negative(-) blood donars</option>
                <option value="O positive(+)">O positive(+) blood donars</option>
      </select>
      </div>
      <div class="col-md-3">
      <input type="submit" value="Search" class="btn btn-link navy-bg request_blood"/>
      </div>

    </div>
        </form>
                    </div>
            </div>
        </div>

<div class="container">
            <div class="row">
        <div class="col-md-12">
      <center><h2>Latest Donors</h2></center><hr>
      </div>
      </div>
        </div>

    <div class="container">
            <div class="row">
            <?php 
                $query = "SELECT * from tbl_donors WHERE approve=1 order by id DESC LIMIT 20";
                        $donors = $db->select($query);
                        if($donors){
                          $i=0;
                        while ($result = $donors->fetch_assoc()) { $i++;?>

           
                <div class="col-md-2 col-xs-6 <?php if($i==1 || $i==6 || $i==11  || $i==16 ){echo 'col-md-offset-1';} ?>">           
                   <div><img src="<?php echo $result['image']; ?>" alt="" height="140" width="140"/></div><br>
                    <p><?php echo substr($result['full_name'],0,15); ?><br>
                       <?php echo substr($result['mobile_number'],0,20); ?><br>
                       <?php echo $result['donor_group']; ?></p>
                </div>

                <?php } } ?>
            </div>
      </div>
        
        </section><hr>

        <section id="request" class="comments gray-section" style="margin-top: 10px;padding-top:30px;">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center wow zoomIn animated" style="visibility: visible;">
                    <i class="fa fa-tint" style="color:#ff424a;font-size: 60px"></i>
                    <h1>
                        Looking for Blood?
                    </h1>
                    <div class="testimonials-text">
                        <i>"Kindly leave us the required information and we will contact you shortly."</i>
                    </div><br>
                    <button style="padding:10px;" type="button" class="btn btn-link navy-bg request_blood" data-toggle="modal" data-target="#myModal">Request now</button>
                </div>
            </div>
        </div>
    </section><hr>

<section class="navy-section testimonials" style="margin-top: 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                     <?php 
          $query = "SELECT * from tbl_blood_request WHERE approve=1 order by id DESC LIMIT 1";
          $donors = $db->select($query);
          if($donors){ 
            while ($result = $donors->fetch_assoc()) {?>
                    <h1>Currenlty Looking for..</h1>
                    <h2><?php echo $result['blood_type']; ?> blood for <?php echo $result['name']; ?></h2>
                        <p><?php echo $result['atoll']; ?>, <?php echo $result['island']; ?>. <?php echo $result['priority']; ?></p>
            <?php } } ?>
                </div>
            </div>
                       
                    <div class="row text-center m-t-lg" style="margin-bottom:-10px;">
                <a href="viewallrequests.php" class="btn btn-danger">View All</a>
            </div>
            </section><br>

    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myLargeModalLabel">Request Donors</h4>
            </div>
            <form method="POST" action="" accept-charset="UTF-8" data-remote-request="" id="req_form">
            <div class="modal-body">
                <div id="mbody">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group name">
                                <label for="name" class="control-label">Full Name</label>
                                <input class="form-control" placeholder="Contact name" name="name" type="text" required>

                                <span class="help-block name"></span>
                            </div>
                            <div class="form-group blood_type">
                                <label for="blood_type" class="control-label">Blood Group</label>
                                <select class="form-control" name="blood_type" required> <option value="A negative(-)">A negative(-)</option>
                    <option value="A positive(+)">A positive(+)</option>
                    <option value="AB negative(-)">AB negative(-)</option>
                    <option value="AB positive(+)">AB positive(+)</option>
                    <option value="B negative(-)">B negative(-)</option>
                    <option value="B positive(+)">B positive(+)</option>
                    <option value="O negative(-)">O negative(-)</option>
                    <option value="O positive(+)">O positive(+)</option>
                    </select>
                                <span class="help-block blood_type"></span>
                            </div>
                            <div class="form-group atoll_id">
                                <lable class="control-label">Atoll</lable>
                                <select class="form-control" id="atoll_id" name="atoll" onchange="myFunction()" required><option value="Male City">Male City</option><option value="Fuvahmulah City">Fuvahmulah City</option><option value="Addu City">Addu City</option><option value="HDh-Haa Dhaalu">HDh-Haa Dhaalu</option><option value="HA-Haa Alif">HA-Haa Alif</option><option value="Sh-Shaviyani">Sh-Shaviyani</option><option value="N-Noonu">N-Noonu</option><option value="R-Raa">R-Raa</option><option value="B-Baa">B-Baa</option><option value="Lh-Lhaviyani">Lh-Lhaviyani</option><option value="AA-Alif Alif">AA-Alif Alif</option><option value="ADh-Alif Dhaalu">ADh-Alif Dhaalu</option><option value="V-Vaavu">V-Vaavu</option><option value="M-Meemu">M-Meemu</option><option value="F-Faafu">F-Faafu</option><option value="D-Dhaalu">D-Dhaalu</option><option value="Th-Thaa">Th-Thaa</option><option value="L-Laamu">L-Laamu</option><option value="GA-Gaafu Alif">GA-Gaafu Alif</option><option value="GDh-Gaafu Dhaalu">GDh-Gaafu Dhaalu</option><option value="K- Kaafu">K- Kaafu</option></select>
                                <span class="help-block atoll_id"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group contact">
                                <label for="contact" class="control-label">Contact Number</label>
                                <input data-mask="9999999" class="form-control" placeholder="Contact Number" name="contact" type="text" required>
                                <span class="help-block contact"></span>
                            </div>
                            <div class="form-group priority">
                                <label for="priority" class="control-label">Priority</label>
                                <select class="form-control" name="priority" required><option value="Urgent">Urgent</option><option value="Normal">Normal</option></select>
                                <span class="help-block priority"></span>
                            </div>
                            <div class="form-group island_id">
                                <lable for="island_id" class="control-label">Island</lable>
                                <div id="island">
                                    <select class="form-control" id="island_id" name="island" required><option value="Male">Male</option><option value="Hulhumale">Hulhumale</option><option value="Villimale">Villimale</option></select>
                                </div>
                                
                                <span class="help-block island_id"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group comment">
                        <label for="comment" class="control-label">Remarks/Comments</label>
                        <textarea class="form-control" rows="6" placeholder="Comment..." name="comment" cols="50" required></textarea>
                            <span class="help-block comment"></span>
                    </div>
                </div>
                <div class="row text-center">
                    <span id="result" class="text-navy">All Fields are required</span>
                </div>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-link navy-bg">Send</button>
            </div>
            </form>
        </div>
    </div>
  </div>

<script src="js/loadislands.js"></script>

<?php include 'inc/footer.php';?>