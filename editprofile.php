<?php include 'inc/header.php'; ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Edit Your Profile
                        </h1>
                    </div>
                </div>
            <?php 
                $id = Session::get('userId');
            ?>

            <?php 
            if ($_SERVER['REQUEST_METHOD']=='POST') { 
            $username =  $fm->validation($_POST['username']);    
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

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/".$unique_image;
            if ($username == ""  || $full_name == ""|| $date_of_birth == ""|| $age == ""|| $donor_group == ""|| $gender == ""|| $mobile_number == ""|| $place == ""|| $island == ""|| $last_donated == "" ) {
                       echo "<span class='label label-danger'>Field must not be empty !!!</span><br><br>";
            }else{
            $usernamequery = "SELECT * FROM tbl_donors where username = '$username' limit 1";
            $usernamecheck = $db->select($usernamequery);
            if ($usernamecheck == false) {
             $query = "UPDATE tbl_donors
                    SET
                    username = '$username'
                    WHERE id = '$id';
            ";

                $updated_row = $db->update($query);
                if ($updated_row) {
                Session::set("message","Data Updated Successfully !!!");
                }else {
                 echo "<span class='label label-danger'>Data Updated Successfully !!!</span><br><br>";
                }
            }
            

            if (!empty($file_name)) {   
                if ($file_size >1048567) {
                 echo "<span class='error'>Image Size should be less then 1MB!
                 </span>";
                } elseif (in_array($file_ext, $permited) === false) {
                 echo "<span class='error'>You can upload only:-".implode(', ', 

                $permited)."</span>";
                } else{
                    move_uploaded_file($file_temp, $uploaded_image);
                     $mobile_number='+960'.$mobile_number;
                    $query = "UPDATE tbl_donors
                            SET
                            image = '$uploaded_image',
                            full_name = '$full_name',
                            date_of_birth = '$date_of_birth',
                            age = '$age',
                            donor_group = '$donor_group',
                            gender = '$gender',
                            mobile_number = '$mobile_number',
                            other_number = '$other_number',
                            place = '$place',
                            island = '$island',
                            last_donated = '$last_donated'
                            WHERE id = '$id';
                    ";

                    $updated_row = $db->update($query);
                        if ($updated_row) {
                        Session::set("message","Data Updated Successfully !!!");   
                            }else {
                                echo "<span class='label label-danger'>Data Not Updated !!!</span><br><br>";
                            }
                         }
                        }else{
                             $mobile_number='+960'.$mobile_number;
                            $query = "UPDATE tbl_donors
                            SET
                            full_name = '$full_name',
                            date_of_birth = '$date_of_birth',
                            age = '$age',
                            donor_group = '$donor_group',
                            gender = '$gender',
                            mobile_number = '$mobile_number',
                            other_number = '$other_number',
                            place = '$place',
                            island = '$island',
                            last_donated = '$last_donated'
                            WHERE id = '$id';
                    ";

                    $updated_row = $db->update($query);
                        if ($updated_row) {
                        Session::set("message","Data Updated Successfully !!!");   
                            }else {
                                echo "<span class='label label-danger'>Data Not Updated !!!</span><br><br>";
                            }
                        }
                    }
                }
            ?>

            <?php 

               if(Session::get("message")){ ?>
                  <span class="label label-success"><?php echo Session::get("message"); ?></span><br><br>
                  <?php Session::unset_it("message");
                  }

            ?>

            </div>
            <div class="main-center">
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <?php
                $query = "select * from tbl_donors where id='$id'";
                $singleuser = $db->select($query);
                if($singleuser){
                while ($result = $singleuser->fetch_assoc()) {
                ?>    
                   <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">
                            <tr>
                                <td>
                                    <label class="form-group">Change Avatar :   &nbsp;&nbsp; </label>
                                </td>
                                <td>
                                    <img src="<?php echo  $result['image']; ?>" height="50px" width="100px"/><br/>
                                    <input class="form-control" name="image" type="file" /><br>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label class="form-group">Username* :</label>
                                </td>
                                <td>
                                    <input name="username" class="form-control" type="text" value="<?php echo $result['username']; ?>" class="medium" /><br>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label class="form-group">Full Name* :</label>
                                </td>
                                <td>
                                    <input name="full_name" class="form-control" type="text" value="<?php echo $result['full_name']; ?>" class="medium" /><br>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label class="form-group">Date of Birth* :</label>
                                </td>
                                <td>
                                    <input name="date_of_birth" class="form-control" type="date" value="<?php echo $result['date_of_birth']; ?>" class="medium" /><br>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label class="form-group">Age* :</label>
                                </td>
                                <td>
                                    <input name="age" class="form-control" type="number" value="<?php echo $result['age']; ?>" class="medium" /><br>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label class="form-group">Blood Group* :</label>
                                </td>
                                <td>

                                    <select name="donor_group" class="form-control" id="sel1"  required="required">
                                        <option value="A negative(-)" <?php if($result['donor_group']=='A negative(-)'){echo 'selected';} ?>>A negative(-)</option>
                                        <option value="A positive(+)" <?php if($result['donor_group']=='A positive(+)'){echo 'selected';} ?>>A positive(+)</option>
                                        <option value="AB negative(-)" <?php if($result['donor_group']=='AB negative(-)'){echo 'selected';} ?>>AB negative(-)</option>
                                        <option value="AB positive(+)" <?php if($result['donor_group']=='AB positive(+)'){echo 'selected';} ?>>AB positive(+)</option>
                                        <option value="B negative(-)" <?php if($result['donor_group']=='B negative(-)'){echo 'selected';} ?>>B negative(-)</option>
                                        <option value="B positive(+)" <?php if($result['donor_group']=='B positive(+)'){echo 'selected';} ?>>B positive(+)</option>
                                        <option value="O negative(-)" <?php if($result['donor_group']=='O negative(-)'){echo 'selected';} ?>>O negative(-)</option>
                                        <option value="O positive(+)" <?php if($result['donor_group']=='O positive(+)'){echo 'selected';} ?>>O positive(+)</option>
                                    </select><br>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label class="form-group">Gender* :</label>
                                </td>
                                <td>
                                   <select name="gender" class="form-control" id="gender"  required="required">
                                        <option value="male" <?php if($result['gender']=='male'){echo 'selected';} ?>>male</option>
                                        <option value="female" <?php if($result['gender']=='female'){echo 'selected';} ?>>Female</option>
                                    </select><br>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label class="form-group">Mobile Number*  :</label>
                                </td>
                                <td>
                                    <input name="mobile_number" class="form-control" type="text" value="<?php echo $result['mobile_number']; ?>" class="medium" placeholder="Enter Your Mobile Number. Example: 9872070"/><br>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label class="form-group">Other Phone Number :</label>
                                </td>
                                <td>
                                    <input name="other_number" class="form-control" type="text" value="<?php  if($result['other_number']==0){echo '';}else{echo $result['other_number'];}; ?>" class="medium" /><br>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label class="form-group">Place* :</label>
                                </td>
                                <td>
                                    <input name="place" class="form-control" type="text" value="<?php echo $result['place']; ?>" class="medium" /><br>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label class="form-group">Island* :</label>
                                </td>
                                <td>
                                    <input name="island" class="form-control" type="text" value="<?php echo $result['island']; ?>" class="medium" /><br>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label class="form-group">Date Last Donated Blood* :</label>
                                </td>
                                <td>
                                    <input name="last_donated" class="form-control" type="date" value="<?php echo $result['last_donated']; ?>" class="medium" /><br>
                                </td>
                            </tr>
                        
                        </table>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>           
                      <?php } } ?>
                    </div>
                </div>
            </div><br><br>
            
<?php include 'inc/footer.php'; ?>