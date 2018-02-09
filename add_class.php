<?php
	include "includes/header.php";

	if(isset($_POST['btn_save'])){
		$name= mysqli_real_escape_string($link, trim($_POST['name']));
		$section= mysqli_real_escape_string($link, trim($_POST['section']));

		$create_class="INSERT INTO class (name,section,status) VALUES ('$name','$section','1')";

		$result=mysqli_query($link,$create_class);
		if($result){
			//$msg=1;
			header("location: manage_classes.php?msg=1");
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
Classes <small>New Class</small>
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
		<i class="fa fa-plus"></i>New Class
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
					Class Creation failed, please go back and look at the data you entered.<br>
				</span>
			</div>
			</div>
			<div class="col-md-3"></div>
		</div>
			<?php
		} ?>
	<form class="form-horizontal" method="post">
	<div class="form-body">
		<div class="form-group">
			<label class="col-md-3 control-label">Class Name *</label>
			<div class="col-md-4">
				<input type="text" name="name" class="form-control" placeholder="Enter Class Name">
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
	include "includes/footer.php";
?>