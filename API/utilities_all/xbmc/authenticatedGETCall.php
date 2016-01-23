<?PHP
function callXBMC($url){
$username = "om";
$password = "om";
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header' => "Authorization: Basic " . base64_encode("$username:$password")                 
  )
);

$context = stream_context_create($opts);

// Open the file using the HTTP headers set above
$file = file_get_contents($url, false, $context);
return $file;
}
?>