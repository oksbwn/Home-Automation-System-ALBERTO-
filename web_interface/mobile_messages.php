
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
				<li><a href="#">Messages</a></li>
			</ul>

			<div class="row-fluid">
				
				<div class="span7">
					<h1>All Messages</h1>
					
					<div class="box-content">
						<ul class="chat" id="cht">
						<?php
						include('Exception.php');
						ExceptionThrower::Start();
						$m = new MongoClient();
						$db = $m->smart_home->mobile_messages;
						$dbName = $m->smart_home->phone_synced_contacts_list;
						$val = $db->find()->sort(array('sl_no' => -1))->limit(50);
						$sl_no=0;
						foreach ($val as $row)
						{
						if($row['type']==1)
							$arrow='left';
						if($row['type']==2)
							$arrow='right';
						$name=$row['From'];
						try{
							$valx = $dbName->find(array('contact_no'=>$name))->sort(array('sl_no' => -1))->limit(1);
							foreach ($valx as $doc) {
								$name=$doc['person_name'];
							}
							}catch(Exception $e){
							}
						if($row['Body']!=null || $row['Body']!=""){
						echo '<li class="'.$arrow.'" onclick="readMessage(\''.$row['type'].'\',\''.$name.'\',\''.date('d M/Y h:i:s A',$row['Date']/1000).'\',\''.$row['read'].'\',\''.$row['Body'].'\');">
									<img class="avatar" alt="Dennis Ji" src="img/fonts/'.$name{2}.'.png">
									<span class="message"><span class="arrow"></span>
										<span class="from"><b>'.$name.'</b></span>
										<span class="time">';echo date(' d M/Y h:i:s A',$row['date']/1000).' </span>
										<span class="text">';
										if($row['read']==1) 
												echo $row['Body'];
										else 
											echo '<b>'.$row['Body'].'</b>';
											
										echo '</span>
									</span>	                                  
								</li>';
							}
						}
						ExceptionThrower::Stop();
						?>
					</ul>
					<div class="chat-form">
						<textarea></textarea>
						<button class="btn btn-info">Send message</button>
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
				</div>
				<div class="span5 noMarginLeft">
					
					<div class="message dark">
						
						<div class="header">
							<h1>Message</h1>
							<div class="from"><i class="halflings-icon user"></i> <b id="message_from">+9938864040</b></div>
							<div class="date"><i class="halflings-icon time"></i> <b id="message_time">3:47 PM</b></div>
							
							<div class="menu"></div>
							
						</div>
						
						<div class="content" id="message_body">
						
						</div>
						</br>
						</br>
						<form class="replyForm"method="post" action="">

							<fieldset>
								<textarea tabindex="3" class="input-xlarge span12" id="message" name="body" rows="2" placeholder="Click here to reply"></textarea>

								<div class="actions">
									
									<button tabindex="3" type="submit" class="btn btn-success">Send message</button>
									
								</div>

							</fieldset>

						</form>	
						
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

