<?php include_once('../template/admin/header.php'); ?>
<?php include_once('../template/admin/sidebar.php'); ?>
<?php include_once('../template/admin/navbar.php'); ?>
<?php 
  // Check the id is valid or not
  if(!isset($_GET['edit']) OR !is_numeric($_GET['edit'])) {
        header('location: logout.php');
        exit;
      } else {

        $statement = $conn->prepare("SELECT * FROM users WHERE user_id=?");
        $statement->execute(array($_GET['edit']));
        $total  = $statement->rowCount();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if( $total == 0 ) {
          header('location: logout.php');
          exit;
        }
        else{
          $a = extract($result,EXTR_PREFIX_ALL, "edit");
        }
    }
?>

<?php 

	if(isset($_POST['submit'])){

		$valid 						= 1;
		$user_full_name 	= clean($_POST['user_full_name']);
		$username 				= clean($_POST['username']);
		$email 						= clean($_POST['email']);
		$password 				= clean($_POST['password']);
		$verify_password 	= clean($_POST['verify_password']);
		$password_hash    = password_hash($password, PASSWORD_DEFAULT);
		$date_updated     = date('Y-m-d H:i:s');
		
		if(isset($_POST['status'])){
			$status 		= clean($_POST['status']);

			if($status == 'on'){
				$status = 1;
			}else{
				$status = 0;
			}
		}else{
			$status = 0;
		}

		$statement = $conn->prepare('SELECT  * FROM users WHERE user_id != ? AND (user_name = ? OR email = ?)');
	  $statement->execute(array($edit_user_id, $username, $email));
	  $total = $statement->rowCount();
	  if( $total > 0 ) {
	    $valid    = 0;
	    $errors[] = 'This user is already registered.';
	  }
		//check if fields empty - code starts
		if(empty($user_full_name)){
		    $valid    = 0;
		    $errors[] = 'Please Enter User Full Name';
		}
		if(empty($username)){
		    $valid    = 0;
		    $errors[] = 'Please Enter Username';
		}
		if(empty($email)){
	      	$valid    = 0;
	      	$errors[] = 'Please Enter Email';
		}
		if(!empty($password)){

        if(strlen($password) < 4){
	          $valid    = 0;
	          $errors[] = "Password must be atleast 4 characters";
	    	}

	    	if($password != $verify_password){
	        $valid    = 0;
	        $errors[] = 'Password and Verify Password are not same';
				}
		
		}else{
			$password_hash = $edit_user_password;
		}
		
		//check if fields empty - code ends

		//check User Photo - code starts
  	$user_photo     = $_FILES['profile_image']['name'];
  	$user_photo_tmp = $_FILES['profile_image']['tmp_name'];

  	if($user_photo!='') {
    	$user_photo_ext = pathinfo( $user_photo, PATHINFO_EXTENSION );
    	$file_name = basename( $user_photo, '.' . $user_photo_ext );
	    	if( $user_photo_ext!='jpg' && $user_photo_ext!='png' && $user_photo_ext!='jpeg' && $user_photo_ext!='gif' ) {
	      	$valid = 0;
	      	$errors[]= 'You must have to upload jpg, jpeg, gif or png file<br>';
	    }
	  }
	  //check User Photo - code ends

	  //If everthing is OK - code starts
	if($valid == 1) {

	  	//Upload user Photo if available
			if($user_photo!='') {
		    $user_photo_file = 'admin-photo-'.time().'.'.$user_photo_ext;
		    move_uploaded_file( $user_photo_tmp, '../storage/profile/'.$user_photo_file );
			}else{
				$user_photo_file = $edit_user_photo;
			}

			//insert the data

			$insert = $conn->prepare("UPDATE users SET user_full_name = ?, email = ?, user_name =
				?, user_password = ?, user_photo = ?, user_status = ?, user_date_updated = ? WHERE user_id = ?");

			$insert->execute(array($user_full_name, $email, $username, $password_hash, $user_photo_file, $status, $date_updated, $edit_user_id));

			//insert the data - code ends

			$_SESSION['success'] = 'User has been updated successfully!';
		  header('location: users.php');
		  exit(0);
	  }
	}
?>
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3"><strong>Хэрэглэгч засах</strong></h1>
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="col-12 col-lg-4 d-flex">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Дэлгэрэнгүй мэдээлэл</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="mb-3">
										<label class="form-label" for="inputUsername">Нэр</label>
										<input type="text" class="form-control" id="inputUsername" placeholder="Enter User Full Name" name="user_full_name" value="<?php echo clean($edit_user_full_name); ?>">
									</div>
									<div class="mb-3">
										<label class="form-label" for="inputUsername">Нэвтрэх нэр</label>
										<input type="text" class="form-control" id="inputUsername" placeholder="Enter Username"  name="username" value="<?php echo clean($edit_user_name); ?>">
									</div>
									<div class="mb-3">
										<label class="form-label" for="inputEmail">Имайл хаяг</label>
										<input type="email" class="form-control" id="inputEmail" placeholder="Enter Email"  name="email" value="<?php echo clean($edit_email); ?>">
									</div>
								</div>		
 						</div> 
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4 d-flex">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Нууц үг & Идэвхтэй эсэх</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="mb-3">
										<label class="form-label" for="inputPasswordNew">Нууц үг</label>
										<input type="password" class="form-control" id="inputPasswordNew" placeholder="Enter password"  name="password">
									</div>
									<div class="mb-3">
										<label class="form-label" for="inputPasswordNew2">Нууц үг давтах</label>
										<input type="password" class="form-control" id="inputPasswordNew2" placeholder="Enter Verify password"  name="verify_password">
									</div>
									<div class="mt-4">
										<label for="flexSwitchCheckChecked">Идэвхтэй / Идэвхгүй</label>
										<div class="form-check form-switch mt-2">
											<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" <?php if($edit_user_status == 1){echo 'checked=""';} ?> name="status">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4 d-flex">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Нүүр зураг</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="text-center">
										<img alt="Profile Image" src="../storage/profile/<?php echo clean($edit_user_photo); ?>" class="rounded-circle img-responsive mt-2" width="100" height="100" id="profileImg">
										<div class="mt-2">
											<button type="button" class="btn btn-primary">Зураг сонгох
												<input type="file" class="file-upload edit-file" value="Upload" name="profile_image" onchange="previewFile(this);" accept="image/*">
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<button type="submit" name="submit" class="btn btn-primary">Хадгалах</button>
								</div>
							</div>
						</div>
					</div>
				</div>				
			</div>
		</form>
	</div>
</main>
<?php include_once('../template/admin/footer.php'); ?>