<?php
	include "includes/header.php";

	if(isset($_POST['btn_del_subject'])){
		$subj = mysqli_real_escape_string($link,trim($_POST['subj_to_del']));

		$del_subject= "DELETE from subjects WHERE id='$subj'";

		$result= mysqli_query($link,$del_subject);
		if($result){
			$del_subj_msg=1;
		}else{
			$del_subj_msg=0;
		}


	}

	if(isset($_POST['btn_del_group'])){
		$group = mysqli_real_escape_string($link,trim($_POST['group_to_del']));

		$del_group= "DELETE from groups WHERE id='$group'";

		$result = mysqli_query($link,$del_group);
		if($result){
			$del_group_msg=1;
		}else{
			$del_group_msg=0;
		}
	}
?>


<?php
	include "includes/sidebar.php"
?>
<div class="clearfix">
</div>
<div class="row">
<div class="portlet box green">
<div class="portlet-title">
	<div class="caption">
		<i class="fa fa-plus"></i>Manage Groups
	</div>
</div>
<div class="portlet-body">
	<?php
	if(isset($del_group_msg) && $del_group_msg==1){
			?>
		<div class="clearfix">
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
			<div class="alert alert-success text-center">
				<button class="close" data-close="alert"></button>
				<span>
					Group Delition Successfull.
				</span>
			</div>
			</div>
			<div class="col-md-3"></div>
		</div>
			<?php
		}else if(isset($del_group_msg) && $del_group_msg==0){
			?>
		<div class="clearfix">
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
			<div class="alert alert-danger text-center">
				<button class="close" data-close="alert"></button>
				<span>
					Group Delition Failed.
				</span>
			</div>
			</div>
			<div class="col-md-3"></div>
		</div>
			<?php
		}

		if(isset($_GET['update_group']) && $_GET['update_group']==1){
			?>
		<div class="clearfix">
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
			<div class="alert alert-success text-center">
				<button class="close" data-close="alert"></button>
				<span>
					Group Updation Successfull.
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
						<th>Group Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$get_groups= "SELECT * FROM groups";
						$result= mysqli_query($link,$get_groups);
						if(mysqli_num_rows($result)>0){
							$i=1;
							while($row= mysqli_fetch_assoc($result)){
								?>
								<tr>
									
									<td><?php echo $i; ?></td>
									<td><?php echo $row['name'];?></td>
									<td class="text-center">
										
										<form method="post">
											<a href="edit_subj_group.php?action=edit_group&group=<?php echo $row['id'];?>" class="btn btn-sm blue"><i class="fa fa-pencil" title="Edit Subject"></i></a>	
											<input type="hidden" name="group_to_del" value=<?php echo $row['id'] ?> >
											<button type="submit" name="btn_del_group" class="btn btn-sm red"><i class="fa fa-trash-o" ></i></button>
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

<div class="clearfix">
</div>
<div class="row">
<div class="portlet box green">
<div class="portlet-title">
	<div class="caption">
		<i class="fa fa-plus"></i>Manage Subjects
	</div>
</div>
<div class="portlet-body">
	<?php 
		if(isset($del_subj_msg) && $del_subj_msg==1){
			?>
		<div class="clearfix">
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
			<div class="alert alert-success text-center">
				<button class="close" data-close="alert"></button>
				<span>
					Subject Delition Successfull.
				</span>
			</div>
			</div>
			<div class="col-md-3"></div>
		</div>
			<?php
		}else if(isset($del_subj_msg) && $del_subj_msg==0){
			?>
		<div class="clearfix">
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
			<div class="alert alert-danger text-center">
				<button class="close" data-close="alert"></button>
				<span>
					Subject Delition Failed.
				</span>
			</div>
			</div>
			<div class="col-md-3"></div>
		</div>
			<?php
		}

		if(isset($_GET['update_subject']) && $_GET['update_subject']==1){
			?>
		<div class="clearfix">
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
			<div class="alert alert-success text-center">
				<button class="close" data-close="alert"></button>
				<span>
					Subject Updation Successfull.
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
						<th>Subject Name</th>
						<th>Group</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$get_subjects= "SELECT * FROM subjects";
						$result= mysqli_query($link,$get_subjects);
						if(mysqli_num_rows($result)>0){
							$i=1;
							while($row= mysqli_fetch_assoc($result)){
								?>
								<tr>
									
									<td><?php echo $i; ?></td>
									<td><?php echo $row['name'];?></td>
									<td>
										<?php 
											$group_id= $row['group_id'];
											$get_section= "SELECT name from groups where id= '$group_id'";
											$result_get_section= mysqli_query($link,$get_section);
											echo mysqli_fetch_assoc($result_get_section)['name'];
										?>
									</td>
									<td class="text-center">
										<form method="post">
											<a href="edit_subj_group.php?action=edit_subject&subject=<?php echo $row['id'];?>" class="btn btn-sm blue"><i class="fa fa-pencil" title="Edit Subject"></i></a>	
											<input type="hidden" name="subj_to_del" value=<?php echo $row['id'] ?> >
											<button type="submit" name="btn_del_subject" class="btn btn-sm red"><i class="fa fa-trash-o" ></i></button>
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


<?php
	include "includes/footer.php";
?>