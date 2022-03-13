<?php

if(!isset($db)) {
	require_once('../utils.php');
}

if(!isset($error)){
	$error = 'Unknown error';
}

if(!isset($_GET['error_message'])){
	if(is_numeric($error)) {
		if(str_starts_with("$error", "4")){
			$error_message = 'User error. Please check the url and try again later.';
		} else if (str_starts_with("$error", "5")){
			$error_message = 'Server error. Please try again later.';
		} else {
			$error_message = 'Unknown error. Please try again later.';
		}
	} else {
		$error_message = 'Unknown error. Please try again later.';
	}
} else {
    $error_message = $_GET['error_message'];
}
// Remove the html tags for security reasons
$error_message = strip_tags($error_message);
$error = strip_tags($error);

if(REQUIRES_JSON){
    header('Content-Type: application/json');
    print_r(json([
        'error' => $error,
        'error_message' => $error_message
    ]));
    return;
}

$center_content = true;
include_once(LAYOUTS['head']);
?>
    <h2 class="text-2xl font-bold text-red-500"> <?php echo is_numeric($error) ? "Error $error" : $error; ?></h2>
    <p class="text-md my-2"><?php echo $error_message; ?></p>
    <div class="flex">
        <div class="flex items-center text-center my-5 bg-indigo-800 px-3 py-2 rounded-full text-white font-bold" data-request="page=index;">
            &leftarrow; Go Back
        </div>
    </div>
<?php
include_once(LAYOUTS['foot']);

