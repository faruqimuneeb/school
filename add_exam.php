<?php
	include "includes/header.php";

	if(isset($_POST['btn_add_exams'])){
		$title = mysqli_real_escape_string($link,trim($_POST['exam_title']));
		$session = mysqli_real_escape_string($link,trim($_POST['session']));
		$class_id = mysqli_real_escape_string($link,trim($_POST['class']));

		$create_exmas = "INSERT INTO exams (title,session,class_id) VALUES ('$title','$session','$class_id')";
		$result= mysqli_query($link,$create_exmas);
		if($result){
			$msg=1;
		}else{
			$msg=0;
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
Exams <small>New Exam</small>
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
		Exams
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
		<i class="fa fa-plus"></i>Create Exam
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
					Exams Creation Successfull.
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
					Exams Creation failed, please go back and look at the data you entered.<br>
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
			<label class="col-md-3 control-label">Exams Title *</label>
			<div class="col-md-4">
				<input type="text" name="exam_title" class="form-control" placeholder="Enter Exams Title">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Session *</label>
			<div class="col-md-4">
				<input type="text" name="session" class="form-control" placeholder="Enter Exams Session">
			</div>
		</div>
		<div class="form-group last">
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
	</div>
	<div class="form-actions fluid">
		<div class="col-md-offset-3 col-md-9">
			<button type="submit" name="btn_add_exams" class="btn blue">Add</button>
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
