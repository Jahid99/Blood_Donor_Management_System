<?php include 'inc/header.php';?>

<section class="searchpage">

        <?php 
           if (isset($_GET['blood_group']) || $_GET['blood_group'] != NULL) {
                $blood_group = $_GET['blood_group'];
            }
         ?>

        <?php 
          $query = "SELECT * from tbl_donors WHERE donor_group='$blood_group' AND approve=1 order by id DESC";
          $donors = $db->select($query);
          if($donors){ ?>
             <center><h2 style="color:green">Showing <?php echo $blood_group; ?> blood donors</h2></center><hr>

              <div class="container">
                  <div class="row">
                          <div class="col-md-12">
                            <table class="table table-bordered" id="example">
                <thead>
                  <tr>
                    <th width="5%">No.</th>
                    <th width="8%">Full Name</th>
                    <th width="8%">Image</th>
                    <th width="8%">Date of Birth</th>
                    <th width="3%">Age</th>
                    <th width="5%">Blood Group</th>
                    <th width="3%">Gender</th>
                    <th width="8%">Mobile Number</th>
                    <th width="8%">Other Phone Number</th>
                    <th width="8%">Place</th>
                    <th width="8%">Island</th>
                    <th width="8%">Date Last Donated Blood</th>
                    <?php if(Session::get("login") == true){ ?>
                    <th width="4%">Request For Blood</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                    <?php $i=0;
                      while ($result = $donors->fetch_assoc()) { $i++;?>

                        <tr class="odd gradeX">
                          <td><?php echo $i; ?></td>
                          <td><?php echo $result['full_name']; ?></td>
                          <td><img src="<?php echo $result['image']; ?>" height="90px" width="90px"/></td>
                          <td><?php echo $result['date_of_birth']; ?></td>
                          <td><?php echo $result['age']; ?></td>
                          <td><?php echo $result['donor_group']; ?></td>
                          <td><?php echo $result['gender']; ?></td>
                          <td><?php echo $result['mobile_number']; ?></td>
                          <td><?php echo $result['other_number']; ?></td>
                          <td><?php echo $result['place']; ?></td>
                          <td><?php echo $result['island']; ?></td>
                          <td><?php echo $result['last_donated']; ?></td>
                          <?php if(Session::get("login") == true){ ?>
                          <td><a href="sendbloodrequest.php?id=<?php echo $result['id']; ?>" style="color:green">Send</a></td>
                          <?php } ?>
                        </tr>

                     <?php }
                    }else{
                      echo '<center><h2 style="color:red">No '.$blood_group.' donor found...</h2></center>';
                    }
                  

                     ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </section>

<?php include 'inc/footer.php';?>