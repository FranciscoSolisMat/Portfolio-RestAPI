<?php

if(!isset($db)) {
	require_once('../utils.php');
}

include_once(LAYOUTS['head']);
?>
<h1 class="text-2xl font-bold">What's this?</h1>
<p class="text-md my-5">
	This is my portfolio regarding RestAPIs! That means that this code is available for everyone to review it, and to show my experience with php and RestAPIs.
	<br>
	<span class="text-red-500">THIS IS NOT A SUPPORTED OR ACTUAL APPLICATION. IS JUST FOR DEMONSTRATION!!</span>
</p>
<div>
	<h2 class="text-2xl font-bold">Available Endpoints</h2>
    <p class="text-md my-2">(Click any item from the list to visit it)</p>
	<ul class="list-disc ml-4 my-5">
		<li data-request="page=post;">Post Request » Adds a new user to the database</li>
		<li data-request="page=get;">Get Request » Shows a list of users</li>
	</ul>
</div>
<?php
include_once(LAYOUTS['foot']);