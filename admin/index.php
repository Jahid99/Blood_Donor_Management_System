<?php include 'inc/header.php'; ?>
    <div class="container">
      <div class="row">
        <h2>Approve Donors</h2> <h4>Check requsted donors mobile number carefully.Make sure their number is valid.<br>Otherwise problem will occur while sending SMS.</h4><hr>

           <?php 
            if (isset($_GET['del'])) {
              $delid = $_GET['del'];
              $delquery = "delete from tbl_donors where id ='$delid'";
              $deldata = $db->delete($delquery);
              if($deldata){
                        Session::set("message","Donor Request Deleted Successfully !!!");
                        Session::set("color","success");

                    }   else {
                        Session::set("message","Donor Request Not Deleted !!!");
                    }
            }

            if (isset($_GET['approve'])) {
              $approveid = $_GET['approve'];
               $query = "UPDATE tbl_donors
                            SET
                            approve=1
                            WHERE id = '$approveid'";
                            $updated_row = $db->update($query);
                            if($updated_row){
                                Session::set("message","Donor Added Successfully !!!");
                                Session::set("color","success");
                                
                            }   else {
                                echo "<span class='label label-danger'>Donor Not Adeed !!!</span><br><br>";
                            }
            }

         ?>
         <?php   if(Session::get("message")){ ?>
                 
                <center><span class="label label-<?php 
                if(Session::get("color")){
                echo Session::get("color");
                Session::unset_it("color");
              }else{
                  echo "danger";
              }
                 ?>"><?php echo Session::get("message"); ?></span></center><br>
               <?php Session::unset_it("message");
              }
                    ?>
             <?php 
          $query = "SELECT * from tbl_donors WHERE approve=0 order by id DESC";
          $donors = $db->select($query);
          if($donors){ ?>
            <table class="table table-bordered" id="example">
                <thead>
                  <tr>
                    <th width="5%">No.</th>
                    <th width="8%">Username</th>
                    <th width="8%">Full Name</th>
                    <th width="8%">Date of Birth</th>
                    <th width="5%">Age</th>
                    <th width="5%">Blood Group</th>
                    <th width="5%">Gender</th>
                    <th width="8%">Mobile Number</th>
                    <th width="8%">Other Phone Number</th>
                    <th width="8%">Place</th>
                    <th width="8%">Island</th>
                    <th width="8%">Date Last Donated Blood</th>
                    <th width="8%">Action</th>
                    
                  </tr>
                </thead>
                <tbody>
                    <?php $i=0;
                      while ($result = $donors->fetch_assoc()) { $i++;?>

                        <tr class="odd gradeX">
                          <td><?php echo $i; ?></td>
                          <td><?php echo $result['username']; ?></td>
                          <td><?php echo $result['full_name']; ?></td>
                          <td><?php echo $result['date_of_birth']; ?></td>
                          <td><?php echo $result['age']; ?></td>
                          <td><?php echo $result['donor_group']; ?></td>
                          <td><?php echo $result['gender']; ?></td>
                          <td><?php echo $result['mobile_number']; ?></td>
                          <td><?php echo $result['other_number']; ?></td>
                          <td><?php echo $result['place']; ?></td>
                          <td><?php echo $result['island']; ?></td>
                          <td><?php echo $result['last_donated']; ?></td>
                          <td><a href="?approve=<?php echo $result['id']; ?>">Approve</a> || <a onclick="return confirm('Are you sure to delete');" href="?del=<?php echo $result['id']; ?>">Delete</a></td>
                        </tr>
                        <?php } ?>
                    
                </tbody>
              </table>
               <?php
                    }else{
                      echo '<center><h2 style="color:red">No donor request found...</h2></center>';
                    }
                  

                     ?>
              
      </div>
    </div>
       
<?php include 'inc/footer.php'; ?>