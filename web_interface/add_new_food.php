<!DOCTYPE html>
<html lang="en">
<?php require_once('head_all.php');?>
<body>
		
	<!-- start: Header -->
		<?php require_once('header_menu.php');?>
	<!-- start: Header -->
	
	
		<div class="container-fluid-full">
		<div class="row-fluid">
			<?php require_once('right_menu.php');?>
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
		<div id="content" class="span10">
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">New Food</a></li>
			</ul>
		<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Add New Food</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal">
							<fieldset>
							  <div class="control-group">
								<label class="control-label" for="prependedInput" >Name</label>
								<div class="controls">
								  <div class="input-prepend">
									<input id="food_name" size="16" type="text" value="" onkeyUp="addImageName();">
								  </div>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="prependedInput">Image</label>
								<div class="controls">
								  <div class="input-prepend">
									<input id="food_image" size="16" type="text" value="">
								  </div>
								</div>
							  </div> 
							  <div class="control-group">
								<label class="control-label">Type</label>
								<div class="controls">
								  <label class="checkbox inline">
									<input type="checkbox" id="type_check1" value="breakfast">Breakfast
								  </label>
								  <label class="checkbox inline">
									<input type="checkbox" id="type_check2" value="lunch"> Lunch
								  </label>
								  <label class="checkbox inline">
									<input type="checkbox" id="type_check3" value="snacks">Snacks
								  </label>
								  <label class="checkbox inline">
									<input type="checkbox" id="type_check4" value="dinner">Dinner
								  </label>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="prependedInput">Calorie</label>
								<div class="controls">
								  <div class="input-prepend">
									<input id="food_calorie" size="16" type="text" value="">
								  </div>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="prependedInput">Date</label>
								<div class="controls">
								  <div class="input-prepend">
									<input id="date_added" size="16" type="text" value="<?php echo date('d/M/Y',time()+12600); ?>">
								  </div>
								</div>
							  </div>
							  <div class="form-actions">
								<button type="submit" class="btn btn-primary" onClick="addFood();">Save changes</button>
								<button class="btn">Cancel</button>
							  </div>
							</fieldset>
						</form>
					</div>
				</div><!--/span-->

			</div><!--/row-->
    
			
		</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>
	
	<div class="common-modal modal fade" id="common-Modal1" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-content">
			<ul class="list-inline item-details">
				<li><a href="http://themifycloud.com">Admin templates</a></li>
				<li><a href="http://themescloud.org">Bootstrap themes</a></li>
			</ul>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	<footer>

		<p>
			<span style="text-align:left;float:left">&copy; 2013 <a href="http://themifycloud.com/downloads/janux-free-responsive-admin-dashboard-template/" alt="Bootstrap_Metro_Dashboard">JANUX Responsive Dashboard</a></span>
			
		</p>

	</footer>
	
<?php require_once("scripts_all.php");?>
</body>
</html>

