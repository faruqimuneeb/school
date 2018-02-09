<?php
	include "includes/header.php";
	if (isset($_POST['btn_del'])) {

		$class_id = mysqli_real_escape_string($link,trim($_POST['class_to_del']));

		$del_class= "DELETE FROM class WHERE id='$class_id'";
		$result= mysqli_query($link,$del_class);

		if($result){
			header("location:manage_classes.php?del_msg=1");
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
Classes <small>Manage Class</small>
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
		Classes
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
		<i class="fa fa-plus"></i>Manage Classes
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
						Class Creation Successful.
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
						Class updated successfully.
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
							Class Deleted Successfully.
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
							Class Deletion Not Successfull.
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
						<th>Class Name</th>
						<th>Sectoion</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$get_classes= "SELECT * FROM class";
						$result= mysqli_query($link,$get_classes);
						if(mysqli_num_rows($result)>0){
							$i=1;
							while($row= mysqli_fetch_assoc($result)){
								?>
								<tr>
									
									<td><?php echo $i; ?></td>
									<td><?php echo $row['name'];?></td>
									<td>
										<?php 
											$s_id= $row['section'];
											$get_section= "SELECT name from section where id= '$s_id'";
											$result_get_section= mysqli_query($link,$get_section);
											echo mysqli_fetch_assoc($result_get_section)['name'];
										?>
									</td>
									<td>
										
										<form method="post">
											<a href="edit_class.php?class=<?php echo $row['id'];?>" class="btn btn-sm blue"><i class="fa fa-pencil" title="Edit Class"></i></a>	
											<input type="hidden" name="class_to_del" value=<?php echo $row['id'] ?> >
											<button type="submit" name="btn_del" class="btn btn-sm red"><i class="fa fa-trash-o" ></i></button>
										</form>
										<!-- <a href="#del_class" id="btn_delete" class="btn btn-sm red" tag1="<?php echo $row['id'];?>" data-toggle="modal" title="Delete Class"><i class="fa fa-trash-o" ></i></a> -->
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


<div class="modal fade" id="del_class" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">Class Deletion Confirmation</h4>
		</div>
		<form method="post">
		<div class="modal-body">
			 	<input type="hidden" name="class_to_del" id="class_to_del" value="">
			 Are you sure to delete the class?
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
