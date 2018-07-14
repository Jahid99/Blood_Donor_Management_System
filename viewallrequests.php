<?php include 'inc/header.php';?>

<section class="navy-section testimonials" style="margin-top: 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                     <?php 
          $query = "SELECT * from tbl_blood_request WHERE approve=1 order by id DESC";
          $donors = $db->select($query);
          if($donors){ 
            $i=0;
            while ($result = $donors->fetch_assoc()) {$i++?>
                    <h2><?php echo $result['blood_type']; ?> blood for <?php echo $result['name']; ?></h2>
                        <p><?php echo $result['atoll']; ?>, <?php echo $result['island']; ?>. <?php echo $result['priority']; ?></p>
                        
                        <?php if(($donors->num_rows)!=$i){echo '<hr>';} ?>
                       
            <?php } } ?>
                </div>
            </div>
                     
            </section><br>


<?php include 'inc/footer.php';?>