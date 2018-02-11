<?php
	include "includes/header.php";
	if(isset($_POST['btn_del'])){

		$std_adm_no = mysqli_real_escape_string($link,$_POST['student_adm_no']);
		
		$del_std_query= "DELETE from students where adm_no= '$std_adm_no'";
		$result= mysqli_query($link,$del_std_query);
		if($result){
			header("location: manage_students.php?del_msg=1");
		}else{

			header("location: manage_students.php?del_msg=0");
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
Students <small>Manage Students</small>
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
		Manage Students
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
				<i class="fa fa-plus"></i>Studnets Lisiting
			</div>
		</div>
		<div class="portlet-body">
			<?php 
			if(isset($_GET['msg']) && $_GET['msg']==1){
				?>
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
					<div class="alert alert-success text-center">
						<button class="close" data-close="alert"></button>
						<span>
							Admission successful.
						</span>
					</div>
					</div>
					<div class="col-md-3"></div>
				</div>
				<?php
			} 

			if(isset($_GET['msg']) && $_GET['msg']==2){
				?>
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
					<div class="alert alert-success text-center">
						<button class="close" data-close="alert"></button>
						<span>
							Student updated successfully.
						</span>
					</div>
					</div>
					<div class="col-md-3"></div>
				</div>
				<?php
			} 

			if(isset($_GET['del_msg']) && $_GET['del_msg']){
				?>
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
					<div class="alert alert-success text-center">
						<button class="close" data-close="alert"></button>
						<span>
							Student Deleted Successfully.
						</span>
					</div>
					</div>
					<div class="col-md-3"></div>
				</div>
				<?php
			} 
			
			if(isset($_GET['del_msg']) && !$_GET['del_msg']){
				?>
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
					<div class="alert alert-danger text-center">
						<button class="close" data-close="alert"></button>
						<span>
							Student Deletion Not Successfull.
						</span>
					</div>
					</div>
					<div class="col-md-3"></div>
				</div>
				<?php
			} 
			?>
			<table class="table table-striped table-bordered table-hover" id="sample_2">
				<thead>
					<tr>
						<th>Sr. #</th>
						<th>Admission ID</th>
						<th>Student Name</th>
						<th>Father Name</th>
						<th>Gender</th>
						<th>Date of Birth</th>
						<th>Nationality</th>
						<th>Class</th>
						<th>Section</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$get_students= "SELECT * FROM students where status =1";
						$result_get_students= mysqli_query($link,$get_students);
						if(mysqli_num_rows($result_get_students)>0){
							$i=1;
							while($row= mysqli_fetch_assoc($result_get_students)){
							?>
								<tr>
									<td>
									<?php echo $i; ?>
									</td>
									<td>
									<?php echo $row['adm_no']; ?>
									</td>
									<td>
									<?php echo $row['name']; ?>
									</td>
									<td>
									<?php echo $row['fname']; ?>
									</td>
									<td>
									<?php echo $row['gender']; ?>
									</td>
									<td>
									<?php echo $row['dob']; ?>
									</td>
									<td>
									<?php echo $row['nationality']; ?>
									</td>
									<td>
										<?php 
											$c_id= $row['class'];
											$get_class= "SELECT name from class where id= '$c_id'";
											$result_get_class= mysqli_query($link,$get_class);
											echo mysqli_fetch_assoc($result_get_class)['name'];
										?>
									</td>
									<td>
										<?php 
											$s_id= $row['section'];
											$get_section= "SELECT name from section where id= '$s_id'";
											$result_get_section= mysqli_query($link,$get_section);
											echo mysqli_fetch_assoc($result_get_section)['name'];
										?>
									</td>
									<td>
										<a href="edit_student.php?student=<?php echo $row['adm_no'];?>" class="btn btn-sm blue"><i class="fa fa-pencil" title="Edit student"></i></a>
										<a href="#del_student" id="btn_del_std" class="btn btn-sm red" data-id="<?php echo $row['adm_no'];?>" data-toggle="modal" title="Delete Student"><i class="fa fa-trash-o" ></i></a>
									</td>
								</tr>
							<?php
							 $i++;
							 }
						}else{
							echo "<h3>No enrolled studnets</h3>";
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div class="modal fade" id="del_student" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">Student Deletion Confirmation</h4>
		</div>
		<form method="post">
		<div class="modal-body">
			 	<input type="hidden" name="student_adm_no" id="student_adm_no" value="">
			 Are you sure to delete the student?
		</div>
		<div class="modal-footer">
			<button type="submit" name="btn_del" class="btn blue">Delete</button>
			<button type="button" class="btn default" data-dismiss="modal">Close</button>
		</div>
		</form>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php
	include "includes/footer.php";
?>
