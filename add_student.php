<?php
	include "includes/header.php";
	if(isset($_POST['btn_save'])){
		$adm_no = mysqli_real_escape_string($link,$_POST['adm_no']);
		$std_name = mysqli_real_escape_string($link,$_POST['std_name']);
		$fname = mysqli_real_escape_string($link,$_POST['fname']);
		$dob = mysqli_real_escape_string($link,date('Y-m-d',strtotime($_POST['dob'])));
		$gender = mysqli_real_escape_string($link,$_POST['gender']);
		$nationality = mysqli_real_escape_string($link,$_POST['nationality']);
		$class = mysqli_real_escape_string($link,$_POST['class']);
		$section = mysqli_real_escape_string($link,$_POST['section']);

		//check if admission number exists.
		$chk_adm_no = "select * from students where adm_no = '$adm_no'";
		$result_chk_adm_no= mysqli_query($link, $chk_adm_no);
		if(mysqli_num_rows($result_chk_adm_no)>0){
			$msg=0;
		}else{
			
			$save_std_query = "INSERT INTO students (adm_no, name, fname, dob, gender, nationality, class, section, status) VALUES ('$adm_no','$std_name','$fname','$dob','$gender','$nationality','$class','$section','1')";
			
			$result = mysqli_query($link,$save_std_query);
			if($result){
				//$msg=1;
				header("location: manage_students.php?msg=1");
			}else{
				$msg=0;
			}	
		}
	}
?>

<?php
	include "includes/sidebar.php";
?>


<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<h3 class="page-title">
Students <small>New admission</small>
</h3>
<ul class="page-breadcrumb breadcrumb">
<li>
	<i class="fa fa-home"></i>
	<a href="dashboard.php">
		Home
	</a>
	<i class="fa fa-angle-right"></i>
</li>
<li>
	<a href="#">
		Students
	</a>
</li>
</ul>
<!-- END PAGE TITLE & BREADCRUMB-->
</div>
</div>
<!-- END PAGE HEADER-->
<div class="clearfix">
</div>
<div class="row">
<div class="portlet box green">
<div class="portlet-title">
	<div class="caption">
		<i class="fa fa-plus"></i>New admission
	</div>
</div>
<div class="portlet-body form">
	
	
	<?php if(isset($msg) && !$msg){
			?>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
			<div class="alert alert-danger text-center">
				<button class="close" data-close="alert"></button>
				<span>
					Admission failed, please go back and look at the data you entered.<br>
					Hint: 1: admission number alreadt exists.<br>
					2: field with * are given no value
				</span>
			</div>
			</div>
			<div class="col-md-3"></div>
		</div>
			<?php
		} ?>
		
	
<!-- BEGIN FORM-->
<form class="form-horizontal" method="post" action="add_student.php">
	<div class="form-body">
		<div class="form-group" style="display: none;">
			<label class="col-md-3 control-label">Registration Id *</label>
			<div class="col-md-4">
				<input type="text" class="form-control" placeholder="Enter registration number here">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Admission ID *</label>
			<div class="col-md-4">
					<input type="text" name="adm_no" class="form-control" placeholder="Enter Admission Number">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Student Name *</label>
			<div class="col-md-4">
				<input type="text" name="std_name" class="form-control" placeholder="Enter Student Name">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Father Name *</label>
			<div class="col-md-4">
				<input type="text" name="fname" class="form-control" placeholder="Enter Father Name">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Gender *</label>
			<div class="col-md-4">
				<select class="form-control" name="gender">
					<option>----Select Gender----</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Date of Birth *</label>
			<div class="col-md-4">
				<input class="form-control form-control-inline  date-picker" type="text" name="dob" >
			</div>
		</div>

	
		<div class="form-group">
			<label class="col-md-3 control-label">Nationality *</label>
			<div class="col-md-4">
				<select class="form-control" name="nationality">
					<option>----Select Nationality----</option>
					<?php 
						$country_query= "SELECT * from apps_countries";
						$query_result=mysqli_query($link,$country_query);
						if($query_result){
							while($row= mysqli_fetch_assoc($query_result)){
								?>
								<option value="<?php echo $row['country_name'] ?>" ><?php echo $row['country_name']; ?></option>
								<?php
							}
						}
					?>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-3 control-label">Class *</label>
			<div class="col-md-4">
				<select class="form-control" name="class">
					<option>----Select Class----</option>
					<!-- select classes from database-->
					<?php
						$class_query= "select * from class where status= 1";
						$result_class=mysqli_query($link,$class_query);
						while($row= mysqli_fetch_assoc($result_class)){
							?>
							<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
							<?php
						}
					?>
				</select>
			</div>
		</div>
	
	<div class="form-group last">
		<label class="col-md-3 control-label">Section *</label>
		<div class="col-md-4">
			<select class="form-control" name="section">
				<option>----Select Section----</option>
				<?php
					$section_query= "select * from section where status= 1";
					$result_section=mysqli_query($link,$section_query);
					while($row= mysqli_fetch_assoc($result_section)){
						?>
						<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
						<?php
					}
				?>
			</select>
		</div>
	</div>
		</div>
	<div class="form-actions fluid">
		<div class="col-md-offset-3 col-md-9">
			<button type="submit" name="btn_save" class="btn blue">Submit</button>
			<a href="manage_students.php" class="btn btn-default">Cancle</a>
		</div>
	</div>
</form>
<!-- END FORM-->
</div>
</div>
</div>

<?php
	include "includes/footer.php"
?>