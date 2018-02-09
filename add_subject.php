<?php
include "includes/header.php";
if(isset($_POST['btn_add_group'])){
	$group_name= mysqli_real_escape_string($link,trim($_POST['group_name']));

	$add_group= "INSERT INTO groups (name) VALUES ('$group_name')";
	$result= mysqli_query($link,$add_group);
	if($result){
		$msg=1;
		//header("Location:manag_subjects.php?add_group=1");
	}else{
		$msg=0;
	}
}
if(isset($_POST['btn_save_subject'])){
	$subj_name= mysqli_real_escape_string($link,trim($_POST['subj_name']));
	$group= mysqli_real_escape_string($link,trim($_POST['group']));

	$save_subj= "INSERT INTO subjects (name,group_id) VALUES ('$subj_name','$group')";
	$result= mysqli_query($link,$save_subj);
	if($result){
		//$msg=2;
		header("Location:manage_subjects.php?msg=1");
	}else{
		$msg=1;
	}
}
?>


<?php 
	include "includes/sidebar.php";
?>
<div class="clearfix">
</div>
<!-- BEGIN PAGE HEADER-->
<div class="row">
<div class="col-md-12">
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<h3 class="page-title">
Subjects <small>New Subject</small>
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
		Subjects
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
		<i class="fa fa-plus"></i>Add Group
	</div>
</div>
<div class="portlet-body form">
<?php
	if(isset($msg) && $msg==1){
			?>
		<div class="clearfix">
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
			<div class="alert alert-success text-center">
				<button class="close" data-close="alert"></button>
				<span>
					Group Addition Successfull.
				</span>
			</div>
			</div>
			<div class="col-md-3"></div>
		</div>
			<?php
		}
	if(isset($msg) && !$msg){
		?>
		<div class="clearfix">
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
			<div class="alert alert-danger text-center">
				<button class="close" data-close="alert"></button>
				<span>
					Group Addition failed, please go back and look at the data you entered.<br>
				</span>
			</div>
			</div>
			<div class="col-md-3"></div>
		</div>
		<?php
	}
?>
	<form class="form-horizontal" method="post">
	<div class="form-body">
		<div class="form-group last">
			<label class="col-md-3 control-label">Group Name *</label>
			<div class="col-md-4">
				<input type="text" name="group_name" class="form-control" placeholder="Enter Group Name">
			</div>
		</div>
	</div>
	<div class="form-actions fluid">
		<div class="col-md-offset-3 col-md-9">
			<button type="submit" name="btn_add_group" class="btn blue">Add</button>
			<a href="add_subject.php" class="btn btn-default">Cancle</a>
		</div>
	</div>
</form>
<!-- END FORM-->
</div>
</div>
</div>
<!--- Add New Subject -->

<div class="clearfix">
</div>
<div class="row">
<div class="portlet box green">
<div class="portlet-title">
	<div class="caption">
		<i class="fa fa-plus"></i>New Subject
	</div>
</div>
<div class="portlet-body form">
	<?php
		if(isset($msg) && $msg==2){
			?>
		<div class="clearfix">
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
			<div class="alert alert-danger text-center">
				<button class="close" data-close="alert"></button>
				<span>
					Subject Addition Failed.
				</span>
			</div>
			</div>
			<div class="col-md-3"></div>
		</div>
			<?php
		} 
		?>
	<form class="form-horizontal" method="post">
	<div class="form-body">
		<div class="form-group">
			<label class="col-md-3 control-label">Subject Name *</label>
			<div class="col-md-4">
				<input type="text" name="subj_name" class="form-control" placeholder="Enter Subject Name">
			</div>
		</div>
		<div class="form-group last">
		<label class="col-md-3 control-label">Group *</label>
		<div class="col-md-4">
			<select class="form-control" name="group">
				<option>----Select Group----</option>
				<?php
					$group_query= "select * from groups";
					$result_group=mysqli_query($link,$group_query);
					while($row= mysqli_fetch_assoc($result_group)){
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
			<button type="submit" name="btn_save_subject" class="btn blue">Add</button>
			<a href="add_subject.php" class="btn btn-default">Cancle</a>
		</div>
	</div>
</form>
<!-- END FORM-->
</div>
</div>
</div>




<?php
	include "includes/footer.php";
?>