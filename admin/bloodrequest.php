<?php include 'inc/header.php'; ?>
    <div class="container">
      <div class="row">
        <h2>Approve Blood Requests</h2><hr>

           <?php 
            if (isset($_GET['del'])) {
              $delid = $_GET['del'];
              $delquery = "delete from tbl_blood_request where id ='$delid'";
              $deldata = $db->delete($delquery);
              if($deldata){
                        Session::set("message","Blood Request Deleted Successfully !!!");
                        Session::set("color","success");

                    }   else {
                        Session::set("message","Blood Request Not Deleted !!!");
                    }
            }

            if (isset($_GET['approve'])) {
              $approveid = $_GET['approve'];
               $query = "UPDATE tbl_blood_request
                            SET
                            approve=1
                            WHERE id = '$approveid'";
                            $updated_row = $db->update($query);
                            if($updated_row){
                                Session::set("message","Blood Request Added Successfully !!!");
                                Session::set("color","success");
                                
                            }   else {
                                echo "<span class='label label-danger'>Blood Request Not Adeed !!!</span><br><br>";
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
          $query = "SELECT * from tbl_blood_request WHERE approve=0 order by id DESC";
          $donors = $db->select($query);
          if($donors){ ?>
            <table class="table table-bordered" id="example">
                <thead>
                  <tr>
                    <th width="5%">No.</th>
                    <th width="8%">Name</th>
                    <th width="5%">Blood Group</th>
                    <th width="8%">Atoll</th>
                    <th width="8%">Mobile Number</th>
                    <th width="5%">Priority</th>
                    <th width="5%">Island</th>
                    <th width="8%">Comment</th>
                    <th width="8%">Action</th>
                    
                  </tr>
                </thead>
                <tbody>
                    <?php $i=0;
                      while ($result = $donors->fetch_assoc()) { $i++;?>

                        <tr class="odd gradeX">
                          <td><?php echo $i; ?></td>
                          <td><?php echo $result['name']; ?></td>
                          <td><?php echo $result['blood_type']; ?></td>
                          <td><?php echo $result['atoll']; ?></td>
                          <td><?php echo $result['contact']; ?></td>
                          <td><?php echo $result['priority']; ?></td>
                          <td><?php echo $result['island']; ?></td>
                          <td><?php echo $result['comment']; ?></td>
                          <td><a href="?approve=<?php echo $result['id']; ?>">Approve</a> || <a onclick="return confirm('Are you sure to delete');" href="?del=<?php echo $result['id']; ?>">Delete</a></td>
                        </tr>
                        <?php } ?>
                    
                </tbody>
              </table>
               <?php
                    }else{
                      echo '<center><h2 style="color:red">No blood request found...</h2></center>';
                    }
                  

                     ?>
              
      </div>
    </div>
       
<?php include 'inc/footer.php'; ?>