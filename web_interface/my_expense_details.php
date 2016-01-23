
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
				<li><a href="#">Current</a></li>
			</ul>

			<div class="row-fluid">
				<?php
					$days=array();
					$days[0]=date('d M Y',time());
					for($iCount=1;$iCount<30;$iCount++)
					{
						$days[$iCount]=date('d M Y',strtotime($days[$iCount-1]."last day"));
					}
					function getDayVal($day){
					 //echo date('M/Y',strtotime($day));
						$mDay = new MongoClient();
						$dbDay= $mDay ->smart_home;
						$collection = $dbDay->my_expenses;
						$val = $collection->find(array('date' => new MongoRegex("/$day/")));
						$sl_no=0;
						foreach ($val as $document) {
						  $sl_no=$sl_no+$document['cost'];
						}
						return $sl_no;
					}
				?>
				<div class="span3 statbox purple" onTablet="span6" onDesktop="span3">
					<div class="boxchart">
					<?php
					$totalCost=0;
					for($i=0;$i<30;$i++)
						{	
							$cost=getDayVal(date('d/M/Y',strtotime($days[$i])));
							$totalCost=$totalCost+$cost;
							echo $cost.",";
						}
					?>
					</div>
					<div class="number"><?php echo $totalCost; ?><i class="icon-arrow-up"></i></div>
					<div class="title">Expense</div>
					<div class="footer">
						<a href="#">This Month</a>
					</div>	
				</div>
				<div class="span3 statbox green" onTablet="span6" onDesktop="span3">
					<div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
					<div class="number">123<i class="icon-arrow-up"></i></div>
					<div class="title">sales</div>
					<div class="footer">
						<a href="#"> read full report</a>
					</div>
				</div>
				
					<?php
					$days=array();
					$days[0]=date('M Y',strtotime("last month"));
					for($iCount=1;$iCount<32;$iCount++)
					{
						$days[$iCount]=$iCount.' '.$days[0];
					}
					function getLastDayVal($day){
					 //echo date('M/Y',strtotime($day));
						$mDay = new MongoClient();
						$dbDay= $mDay ->smart_home;
						$collection = $dbDay->my_expenses;
						$val = $collection->find(array('date' => new MongoRegex("/$day/")));
						$sl_no=0;
						foreach ($val as $document) {
						  $sl_no=$sl_no+$document['cost'];
						}
						return $sl_no;
					}
				?>
				<div class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
					<div class="boxchart">
					<?php
					$totalCost=0;
					for($i=1;$i<32;$i++)
						{	
							$cost=getLastDayVal(date('d/M/Y',strtotime($days[$i])));
							$totalCost=$totalCost+$cost;
							echo $cost.",";
						}
					?>
					</div>
					<div class="number"><?php echo $totalCost; ?><i class="icon-arrow-up"></i></div>
					<div class="title">Expense</div>
					<div class="footer">
						<a href="#">Last Month</a>
					</div>	
				</div>
				<div class="span3 statbox yellow" onTablet="span6" onDesktop="span3">
					<div class="boxchart">7,2,2,2,1,-4,-2,4,8,,0,3,3,5</div>
					<div class="number">678<i class="icon-arrow-down"></i></div>
					<div class="title">visits</div>
					<div class="footer">
						<a href="#"> read full report</a>
					</div>
				</div>	
				
			</div>		

			<div class="row-fluid">
				
				<div class="span8 widget blue" onTablet="span7" onDesktop="span8">
					
					<div id="stats-chart"  style="height:282px" ></div>
					
				</div>
				<div class="sparkLineStats span4 widget green" onTablet="span5" onDesktop="span4">
				<table class="table table-condensed">
					<thead>
						<tr>
							<th>Sl. No</th>
							<th>Details</th>
							<th>Cost</th>                                      
						</tr>
					</thead>   
				<?php
					$mDay = new MongoClient();
					$dbDay= $mDay ->smart_home;
					$collection = $dbDay->my_expenses;
					$val = $collection->find(array('date' =>date('d/M/Y',time()+12600)));
					$sl_no=0;
					foreach ($val as $document) {
						echo '<tr>
							<td class="center">'.$document['sl_no'].'</td>
							<td class="center">'.$document['details'].'</td> 
							<td class="center">'.$document['cost'].'</td>                                      
							</tr>';
					}
				  ?>           	
				</table>	
				<div class="clearfix"></div>
                </div><!-- End .sparkStats -->
			</div>
			
						
			<div class="row-fluid">
				
				<div class="widget blue span5" onTablet="span6" onDesktop="span5">
					
					<h2><span class="glyphicons globe"><i></i></span> Monthwise Expenses</h2>
					
					<hr>
					<?php 
						$months=array();
						$months[0]=date('M Y',time());
						$months[1]=date('M Y',strtotime($months[0]."last month"));
						$months[2]=date('M Y',strtotime($months[1]." last month"));
						$months[3]=date('M Y',strtotime($months[2]." last month"));
						$months[4]=date('M Y',strtotime($months[3]." last month"));
						$months[5]=date('M Y',strtotime($months[4]." last month"));
						$months[6]=date('M Y',strtotime($months[5]." last month"));
						$months[7]=date('M Y',strtotime($months[6]." last month"));
						$months[8]=date('M Y',strtotime($months[7]." last month"));
						$months[9]=date('M Y',strtotime($months[8]." last month"));
						$months[10]=date('M Y',strtotime($months[9]." last month"));
						$months[11]=date('M Y',strtotime($months[10]." last month"));
						include('Exception.php');
						function getMonthVal($month){
						 //echo date('M/Y',strtotime($month));
						ExceptionThrower::Start();
						$m = new MongoClient();
						$db = $m ->smart_home;
						$collection = $db->my_expenses;
						$val = $collection->find(array('date' => new MongoRegex("/$month/")));
						$sl_no=0;
						foreach ($val as $document) {
						  $sl_no=$sl_no+$document['cost'];
						}
						ExceptionThrower::Stop();
						return $sl_no/100;
						}
					?>
					<div class="content">
						
						<div class="verticalChart">
						<?php
						for($i=0;$i<10;$i++)
							{
								echo '<div class="singleBar">
									<div class="bar">
										<div class="value">
											<span>
												'.getMonthVal(date('M/Y',strtotime($months[$i]))).'
											</span>
										</div>
										</div>
									<div class="title">
										'.$months[$i].'
									</div>
								</div>';
							}
						?>	
							<div class="clearfix"></div>
							
						</div>
					
					</div>
					
				</div><!--/span-->
				
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

