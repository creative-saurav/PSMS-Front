<?php
	require_once('header.php');
?>
<?php 
	// if(isset($_POST['save_change'])){
    //     $name = $_POST["st_name"];
    //     $roll = $_POST["st_roll"];
    //     $mobile = $_POST["st_mobile"];


    //     if(empty($name)){
    //         $error = "Name is required!";
    //     }
    //     else if(empty($roll)){
    //         $error = "Roll is required!";
    //     }
    //     else{
            
    //         $statement = $pdo->prepare("UPDATE * FROM  students  WHERE id=?");
    //         $update = $statement->execute(array($user_Id));
    //         if($update== true){
    //             $succes = "Student Data Update Successfully!";
    //             header("location:index.php ?update=success");
    //         }
    //         else{
    //             $succes = "Data Update Failed!";
    //         }

    //     }
        

    // }

	$user_Id = $_SESSION['st_loggedin'][0]["id"]; 

	$stm=$pdo->prepare("SELECT * FROM students WHERE id=?");
	$stm->execute(array($user_Id));
	$result = $stm->fetchAll(PDO::FETCH_ASSOC);

	$name=$result[0]["name"];
	$email=$result[0]["email"];
	$email_status = $result[0]["is_email_verified"];
	$mobile=$result[0]["mobile"];
	$mobile_stauts=$result[0]["is_mobile_verified"];
	$father_name=$result[0]["father_name"];
	$father_mobile=$result[0]["father_mobile"];
	$mother_name=$result[0]["mother_name"];
	$gender=$result[0]["gender"];
	$birthday=$result[0]["birthday"];
	$address=$result[0]["address"];
	$roll=$result[0]["roll"];
	$current_class=$result[0]["current_class"];
	$regi_date=$result[0]["registration_date"];



?>
	<!--Main container start -->
	<main class="ttr-wrapper">
		<div class="container-fluid">
			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Update Profile</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>Update Profile</li>
				</ul>
			</div>	
			<div class="row">
				<!-- Your Profile Views Chart -->
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title">
							<h4>Update Profile</h4>
						</div>
						<div class="widget-inner">
							<form class="edit-profile m-b30">
								<div class="">

								<?php if(isset($error)):?>
					<div class="alert alert-danger">
						<?php echo $error;?>
					</div>
					<?php endif;?>

					<?php if(isset($success)):?>
					<div class="alert alert-success">
						<?php echo $success;?>
					</div>
					<?php endif;?>

									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Name</label>
										<div class="col-sm-7">
											<input class="form-control" type="text" value="<?php echo $name ;?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Email</label>
										<div class="col-sm-7">
											<input class="form-control" type="email" value="<?php echo $email ;?>" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Mobile Number</label>
										<div class="col-sm-7">
											<input class="form-control" type="text" value="<?php echo $mobile ;?>" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Father's Name</label>
										<div class="col-sm-7">
											<input class="form-control" type="text" value="<?php echo $father_name ;?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Father's Number</label>
										<div class="col-sm-7">
											<input class="form-control" type="text" value=" <?php echo $father_mobile ;?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Mother's Name</label>
										<div class="col-sm-7">
											<input class="form-control" type="text" value="<?php echo $mother_name ;?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Gender</label>
										<div class="col-sm-7">
											<input class="form-control" type="text" value="<?php echo $gender ;?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Birthday</label>
										<div class="col-sm-7">
											<input class="form-control" type="text" value="<?php echo $birthday ;?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Adress</label>
										<div class="col-sm-7">
											<input class="form-control" type="text" value="<?php echo $address ;?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Roll</label>
										<div class="col-sm-7">
											<input class="form-control" type="text" value="<?php echo $roll ;?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Current Class</label>
										<div class="col-sm-7">
											<input class="form-control" type="text" value="<?php echo $current_class ;?>">
										</div>
									</div>

									
									<div class="seperator"></div>
								<div class="">
									<div class="">
										<div class="row">
											<div class="col-sm-2">
											</div>
											<div class="col-sm-7">
												<button type="submit" name="save_change" class="btn">Save changes</button>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- Your Profile Views Chart END-->
			</div>
		</div>
	</main>
	<div class="ttr-overlay"></div>

<?php 
	require_once('footer.php');
?>