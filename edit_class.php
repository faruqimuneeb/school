<?php
	include "includes/header.php";
	if(isset($_GET['class'])){
		$class_id = mysqli_real_escape_string($link,trim($_GET['class']));

		$get_class= "SELECT * from class where id= '$class_id'";

		$result_get_class= mysqli_query($link,$get_class);
		if($result_get_class){
			$data = mysqli_fetch_assoc($result_get_class);
			$class_name= $data['name'];
			$sec_id= $data['section'];
		}
	}
	if(isset($_POST['btn_save'])){


		$name= mysqli_real_escape_string($link,trim($_POST['name']));
		$section= mysqli_real_escape_string($link,trim($_POST['section']));
		$c_id = mysqli_real_escape_string($link,trim($_POST['c_id']));
		$update_clas= "UPDATE class SET name = '$name', section= '$section' where id = '$c_id'";
		$result_update_class = mysqli_query($link, $update_clas);
		
		if($result_update_class){
			header("location: manage_classes.php?msg=2");
		}else{
			$msg=0;
		}
	}	
?>

<?php 
	include "includes/sidebar.php";
?>

<div class="row">
<div class="col-md-12">
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<h3 class="page-title">
Class <small>Update Class Record</small>
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
		Class
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
		<i class="fa fa-plus"></i>Update Class Record
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
					1: field with * are given no value
				</span>
			</div>
			</div>
			<div class="col-md-3"></div>
		</div>
			<?php
		} ?>

	<form class="form-horizontal" method="post">
		<input type="hidden" value="<?php echo $class_id ?>" name="c_id" />
	<div class="form-body">
		<div class="form-group">
			<label class="col-md-3 control-label">Class Name *</label>
			<div class="col-md-4">
				<input type="text" name="name" class="form-control" value="<?php echo $class_name; ?>" placeholder="Enter Class Name">
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
						if($sec_id==$row['id']){
							$selected= "selected";
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
		
	</div>
	<div class="form-actions fluid">
		<div class="col-md-offset-3 col-md-9">
			<button type="submit" name="btn_save" class="btn blue">Submit</button>
			<a href="manage_classes.php" class="btn btn-default">Cancle</a>
		</div>
	</div>
</form>
</div>
</div>
</div>




<?php 
	include "includes/footer.php";
?>