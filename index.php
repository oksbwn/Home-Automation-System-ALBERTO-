<?php
header('Content-Type: application/json');
$tempData=[];
$mailboxes = array(
	array(
		'label' 	=> 'Gmail',
		'enable'	=> true,
		'mailbox' 	=> '{imap.gmail.com:993/imap/ssl}INBOX',
		'username' 	=> 'oksbwn@gmail.com',
		'password' 	=> 'lovenanu'
	)
);

	foreach ($mailboxes as $current_mailbox) {
		
		// Open an IMAP stream to our mailbox
		$stream = @imap_open($current_mailbox['mailbox'], $current_mailbox['username'], $current_mailbox['password']);
				if (!$stream) { 
				//Error
				} else {
					$emails = imap_search($stream,'UNSEEN');
					if (!count($emails)){
					// No Email
					} else {
						rsort($emails);
						foreach($emails as $email_id){
							$overview = imap_fetch_overview($stream,$email_id,0);
							$message =imap_fetchbody($stream,$email_id, 1.1);
							$tempData[]=['subject'=>decode_imap_text($overview[0]->subject),
										'from'=>decode_imap_text($overview[0]->from),
										'date'=>$overview[0]->date,'body'=>$message];
						} 
					} 
					imap_close($stream); 
				}
				
	}
echo json_encode($tempData);
// a function to decode MIME message header extensions and get the text
function decode_imap_text($str){
    $result = '';
    $decode_header = imap_mime_header_decode($str);
    foreach ($decode_header AS $obj) {
        $result .= htmlspecialchars(rtrim($obj->text, "\t"));
	}
    return $result;
}	
	
?>