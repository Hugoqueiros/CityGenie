<?php
include '../db.connection.php';

if (isset($_POST['request'])) {
    $request = $_POST['request'];
    $request = trim($request);
    if($request == "ALL"){
        $query = "SELECT * FROM partners";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
    } else{
    $query = "SELECT * FROM partners WHERE partner_pw= '$request'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
    }

?>


    <div class="container">
        <div class="row">
            <?php
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-sm-3" style="margin-top: 20px;">
					<div class="card text-center" style="background-color: #CEDCE6; height: 325px;">
						<img class="card-img-top img-fluid" src="<?php echo utf8_encode($row['partner_image']); ?>" alt="Card image cap">
						<div class="card-block">
							<h6 class="card-title" style="margin-top: 5px;color:black"><?php echo utf8_encode($row['partner_name']); ?> </h6>
							<p class="card-text" style="color:black; margin-top:-1px"><?php echo utf8_encode($row['partner_address']); ?></p>
							<p class="card-text" style="color:black;margin-top: -15px;"><small><?php echo utf8_encode($row['partner_description']); ?></small></p>
							<p class="card-text" style="color:black;position: absolute;bottom:0px"><small><?php echo utf8_encode($row['partner_email']); ?></small></p>
							<?php if ($row['classification'] != "") { ?>
								<p class="card-text" style="color:yellow;position: absolute;bottom: 3px;right: 0px;"><small style="color:black;;text-align: -webkit-right;display: inline-flex;"><?php echo utf8_encode($row['classification']); ?></small>★</p>
							<?php } ?>
						</div>
					</div>
				</div>




            <?php } ?>
        </div>
    </div>

<?php } ?>