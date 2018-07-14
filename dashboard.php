<?php include 'inc/header.php'; ?>

<style type="text/css">
    .main-center{
      margin: 0 auto;
      max-width: 55%;   
    }
</style>

        <div class="container">
            <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Your Profile
                        </h1>
                    </div>
            </div>
            <div class="main-center">
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                    <?php 
                        $id = Session::get('userId');
                        $query = "select * from tbl_donors where id='$id'";
                        $singleuser = $db->select($query);
                        if($singleuser){
                        while ($result = $singleuser->fetch_assoc()) {
                    ?>          
                        <div style="height:100%;width: 100%">
                        <img class="img-responsive" src="<?php echo  $result['image'];?>" alt="" />
                        </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                        <h4>
                            <?php  echo $result['full_name']; ?></h4>
                             
                             <b>Date of Birth : </b><?php  echo $result['date_of_birth']; ?>
                            <br />
                            <b>Age : </b><?php  echo $result['age']; ?>
                            <br/>
                            <b>Blood Group : </b><?php  echo $result['donor_group']; ?>
                            <br/>
                            <b>Gender : </b><?php  echo $result['gender']; ?>
                            <br/>
                            <b>Mobile Number : </b><?php  echo $result['mobile_number']; ?>
                            <br/>
                            <b>Other Phone Number : </b><?php  if($result['other_number']){echo '';}; ?>
                            <br/>
                            <b>Place : </b><?php  echo $result['place']; ?>
                            <br/>
                            <b>Island : </b><?php  echo $result['island']; ?>
                            <br/>
                            <b>Last Donation Date : </b><?php  echo $result['last_donated']; ?>
                            <br/>
                            <br/>          
                        <button type="submit" onclick="location.href = 'editprofile.php'" class="btn btn-primary">Edit Profile</button>                           
                        <?php } } ?>
                    </div>
                </div>
            </div><br><br>
        </div>
        
<?php include 'inc/footer.php'; ?>