
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
			
	<div id="content" class="span10">
			
						
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Server Logs</a></li>
			</ul>

			<div class="row-fluid">
				<div class="span5 noMarginLeft">
					<div class="dark">
					<h1>Logs</h1>
					<div class="timeline">
						<?php
								include('Exception.php');
								ExceptionThrower::Start();
								$m = new MongoClient();
								$db = $m->smart_home->smart_home_logs;
								$val = $db->find()->sort(array('sl_no' => -1))->limit(50);
								$sl_no=0;//echo $document['sl_no'];
								$i=0;
								foreach ($val as $document) {
									if($i==0){
										$alt='';
										$i++;
										}
									else{
										$alt='alt';
										$i=0;
									}
									echo '<div class="timeslot '.$alt.'">
												<div class="task">
													<span>
														<span class="type"></span>
														<span class="details">
																'.$document['from'].'
														</span>
														<span>
															<span class="remaining">
																'.$document['comment'].'
															</span>	
														</span> 
													</span>
													<div class="arrow"></div>
												</div>							
												<div class="icon">
													<img src="http://192.168.0.1/smart_home/web_interface/img/devices/bulb_off.png">
												</div>
												<div class="time">
													'.$document['date'].'  '.$document['time'].'
												</div>	
													
											</div>
										
											<div class="clearfix"></div>';
										}?>			    
					</div>
				</div>
				
				</div>	
						
			</div>
			
       

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

