<?php
	include "includes/header.php";
	if(isset($_GET['student'])){

		$adm_no= mysqli_real_escape_string($link,$_GET['student']);

		$get_student = "SELECT * FROM students WHERE adm_no= '$adm_no'";
		
		$result_get_student= mysqli_query($link, $get_student);
		if($result_get_student){
			$data= mysqli_fetch_assoc($result_get_student);
			$std_name = $data['name'];
			$fname = $data['fname'];
			$dob = $data['dob'];
			$gender = $data['gender'];
			$nationality = $data['nationality'];
			$class = $data['class'];
			$section = $data['section'];

		}
	}
	if(isset($_POST['btn_save'])){

		$adm_no1 = mysqli_real_escape_string($link,$_POST['adm_no']);
		$std_name = mysqli_real_escape_string($link,$_POST['std_name']);
		$fname = mysqli_real_escape_string($link,$_POST['fname']);
		$dob = mysqli_real_escape_string($link,date('Y-m-d',strtotime($_POST['dob'])));
		$gender = mysqli_real_escape_string($link,$_POST['gender']);
		$nationality = mysqli_real_escape_string($link,$_POST['nationality']);
		$class = mysqli_real_escape_string($link,$_POST['class']);
		$section = mysqli_real_escape_string($link,$_POST['section']);

		//check if admission number is changed.
		
		if($adm_no1==$adm_no){
			
			$save_std_query = "UPDATE students SET name='$std_name', fname='$fname', dob='$dob', gender='$gender', nationality='$nationality', class='$class', section='$section', status='1' WHERE adm_no='$adm_no1'";

			$result = mysqli_query($link,$save_std_query);
			if($result){
				//$msg=1;
				header("location: manage_students.php?msg=2");
			}else{
				$msg=0;
			}	
			
		}else{
			
			$msg=0;
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
Students <small>Update Student Record</small>
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
		<i class="fa fa-plus"></i>Update Student Record
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
					Updation failed, please go back and look at the data you entered.<br>
					Hint: 1: admission number changed.<br>
					2: field with * are given no value
				</span>
			</div>
			</div>
			<div class="col-md-3"></div>
		</div>
			<?php
		} ?>
	
<!-- BEGIN FORM-->
<form class="form-horizontal" method="post" >
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
					<input type="text" name="adm_no" readonly class="form-control" placeholder="Enter Admission Number" value="<?php echo $adm_no; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Student Name *</label>
			<div class="col-md-4">
				<input type="text" name="std_name" class="form-control" placeholder="Enter Student Name" value="<?php echo $std_name; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Father Name *</label>
			<div class="col-md-4">
				<input type="text" name="fname" class="form-control" placeholder="Enter Father Name" value="<?php echo $fname; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Gender *</label>
			<div class="col-md-4">
				<select class="form-control" name="gender">
					<?php if($gender=="Male"){
						$male="selected";
						$female="";
					} else{

						$male="";
						$female ="selected";
					} 

					?>
					<option>----Select Gender----</option>
					<option value="Male" <?php echo $male; ?>>Male</option>
					<option value="Female" <?php echo $female; ?>>Female</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Date of Birth *</label>
			<div class="col-md-4">
				<input class="form-control form-control-inline  date-picker" type="text" name="dob" value="<?php echo $dob; ?>" >
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
								if($row['country_name']==$nationality){
									$selected="selected";
								}else{
									$selected="";
								}
								?>
								<option value="<?php echo $row['country_name'] ?>" <?php echo $selected; ?> ><?php echo $row['country_name']; ?></option>
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
							if($row['id']==$class){
								$selected="selected";
							}else{
								$selected="";
							}
							?>
							<option value="<?php echo $row['id']; ?>" <?php echo $selected; ?> ><?php echo $row['name']; ?></option>
							<?php
						}
					?>
				</select>
			</div>
		</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label">Section *</label>
		<div class="col-md-4">
			<select class="form-control" name="section">
				<option>----Select Section----</option>
				<?php
					$section_query= "select * from section where status= 1";
					$result_section=mysqli_query($link,$section_query);
					while($row= mysqli_fetch_assoc($result_section)){
						if($row['id']== $section){
							$selected="selected";
						}else{
							$selected="";
						}
						?>
						<option value="<?php echo $row['id']; ?>" <?php echo $selected; ?>><?php echo $row['name']; ?></option>

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