
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
							<li><a href="#">Control Appliances</a></li>
						</ul>
									<div class="row-fluid">	
							<div class="box span12">
								<div class="box-header">
									<h2><i class="halflings-icon white white hand-top"></i><span class="break"></span>Control Appliances</h2>
								</div>
								<?php
								$idCounter=0;
								$rowItemCounter=0;
								include('Exception.php');
								ExceptionThrower::Start();
								$m = new MongoClient();
								$db = $m->smart_home->board_output_details;
								$val = $db->find()->sort(array('sl_no' => 1));
								echo '<div class="box-content">';
								foreach ($val as $document) {
									if(strcmp($document['status'],"O")==0)
									{
										$status='blue">ON';
										$sta='_on';
									}
									else
									{
										$status='red">OFF';
										$sta='_off';
									}
									echo '		<a class="quick-button-small span1" onclick="loadStatusChangeButtonClicked(\''.$document['sl_no'].'\',\''.$idCounter.'\',\''.$document['image'].'\',\''.$document['name'].'\');" id="'.$idCounter.'">
													<img src="img/devices/'.$document['image'].$sta.'.png" style="height:16px width:16px"></img>
													<p>'.$document['name'].'</p>
													<span class="notification '.$status.'</span>
												</a>';
									$idCounter++;
									$rowItemCounter++;	
									if($rowItemCounter>11)
									{
										echo '<div class="clearfix"></div></div><div class="box-content">';
										$rowItemCounter=0;
									}
								}
								echo '<div class="clearfix"></div></div>';
								ExceptionThrower::Stop();
							?>
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