<?php
	require_once('header.php');
?>
<?php 
	

	$user_id = $_SESSION['st_loggedin'][0]["id"]; 

	$stm=$pdo->prepare("SELECT * FROM students WHERE id=?");
	$stm->execute(array($user_id));
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
	$photo=$result[0]["profile"];

	// User details Update
	if(isset($_POST['save_change'])){
        $name = $_POST["name"];
        $father_name = $_POST["father_name"];
        $father_mobile = $_POST["father_mobile"];
        $mother_name = $_POST["mother_name"];
        $gender = $_POST["gender"];
        $birthday = $_POST["birthday"];
        $address = $_POST["address"];
        $photo_name = $_FILES["photo"]["name"];


        if(empty($name)){
            $error = "Name is required!";
        }
        else if(empty($father_name)){
            $error = "Father Name is required!";
        }
        else{
            
			if(!empty($photo_name)){
				$target_dir = "assets/students/";
                $target_file = $target_dir . basename($_FILES["photo"]["name"]);
				$extension= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				// $size =$_FILES["photo"]["size"];	

				if($extension != "jpg" && $extension != "png" && $extension != "jpeg"){
					$error = "Photo Must be jpg or png or jepg!";

				}
				// else if($size > 500000){
				// 	$error = "Photo Must be 5 mb !";
				// }
				else{
					$temp_name =$_FILES["photo"]["tmp_name"];
					$final_path =$target_dir ."user_id_". $user_id.".".$extension;
					move_uploaded_file($temp_name, $final_path);    
				}
				
			}
			else{
				$final_path = Student('profile',$user_id);
			}
			// Update data
			$update = $pdo->prepare("UPDATE students SET name=?,father_name=?,father_mobile=?,mother_name=?,gender=?,birthday=?,address=?,profile=? WHERE id=? ");
			$update->execute(array(
				$name,
				$father_name,
				$father_mobile,
				$mother_name,
				$gender,
				$birthday,
				$address,
				$final_path,
				$user_id
			));
			$success = "profile update succesfully!";

        }
        
    }

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
						<div class="widget-inner">
							<form class="edit-profile m-b30" method="POST" enctype="multipart/form-data">
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
											<input class="form-control" name="name" type="text" value="<?php echo $name ;?>">
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
											<input class="form-control" name="father_name" type="text" value="<?php echo $father_name ;?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Father's Mobile</label>
										<div class="col-sm-7">
											<input class="form-control" name="father_mobile" type="text" value="<?php echo $father_mobile ;?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Mother's Name</label>
										<div class="col-sm-7">
											<input class="form-control" name="mother_name" type="text" value="<?php echo $mother_name ;?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Gender</label>
										<div class="col-sm-7">
											<label><input
											<?php 
												if($gender == 'Male'){echo "checked";}
											?>
											type="radio" value="Male" name="gender"  id=""> Male</label>
											<br>
											<label><input
											<?php 
												if($gender == 'Female'){echo "checked";}
											?>
											type="radio" value="Female" name="gender" id=""> Female</label>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Birthday</label>
										<div class="col-sm-7">
											<input class="form-control" name="birthday" type="date" value="<?php echo $birthday ;?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Adress</label>
										<div class="col-sm-7">
											<input class="form-control" name="address" type="text" value="<?php echo $address ;?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Roll</label>
										<div class="col-sm-7">
											<input class="form-control" name="roll" type="text" value="<?php echo $roll ;?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Current Class</label>
										<div class="col-sm-7">
											<input class="form-control" name="current_class" type="text" value="<?php echo $current_class ;?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Profile Photo</label>
										<div class="col-sm-7">
											<?php if($photo != null) :?>
											<div class="profile-photo">
                                               <a target="_blank" href="<?php echo $photo ;?>"><img style="height:100px; width=auto;" src="<?php echo $photo ;?>" ></a>
											</div>
											<?php endif;?>
											<mark><small>If won't change photo , skip the input field.</small></mark>
											<input class="form-control" name="photo" type="file">
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