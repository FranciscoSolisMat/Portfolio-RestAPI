<?php

if(!isset($db)) {
	require_once('../utils.php');
}


// Show form to post
$center_content = true;
include_once(ROOT . '/layouts/head.php');

$errormsg = '';

$data = $_SERVER['REQUEST_METHOD'] == 'POST' ? $_POST : [];
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($data['name']) && isset($data['created_at']) && !empty($data['name']) && !empty($data['created_at'])) {
        // Check if the user exists
        $statement = $db->prepare('SELECT COUNT(id) FROM users WHERE name = :username');
        $statement->bindValue(':username', $data['name']);
        $statement->execute();
        $result = $statement->execute();
        if($result->fetchArray(SQLITE3_NUM)[0] > 0){
            $errormsg = 'User already exists!';
        } else {
	        $statement = $db->prepare('INSERT INTO users (name, created_at) VALUES (:username, :created_at)');
            // Turn the created_at date into a timestamp
            $strtotime = strtotime($data['created_at']);
	        $statement->bindParam(':username', $data['name']);
	        $statement->bindParam(':created_at', $strtotime);
	        $result = $statement->execute();
            ?>
            <script>updateRequest('page=get;query=<?php echo htmlspecialchars($data['name']); ?>')</script>
            <?php
	        return;
        }
    } else {
        $errormsg = 'Please fill in all fields!';
    }
}

?>
    <form class="flex flex-col" method="post" enctype="multipart/form-data" autocomplete="on">
	    <?php
	    if(!empty($errormsg)){
		    ?>
            <div class="text-red-500 text-xl font-bold text-start my-5">
			    <?php echo $errormsg; ?>
            </div>
		    <?php
	    }
	    ?>
        <div class="flex flex-col justify-start grid mb-5">
            <label for="name" class="text-white">Name</label>
            <input <?php echo isset($data['name']) ? 'value="' . $data['name'] . '"' : '' ?> class="my-2 px-2 py-1 bg-gray-500 text-white placeholder:text-gray-300 rounded-lg border border-gray-500 focus:border-indigo-700 focus:outline-none" id="name" type="text" name="name" placeholder="Francisco Solis" autocapitalize="words" autocomplete="name">
            <span class="text-xs text-gray-200">Write here a name for the user.</span>
        </div>

        <div class="flex flex-col justify-start grid mb-5">
            <label for="created_at" class="text-white">Created At</label>
            <input <?php echo isset($data['created_at']) ? 'value="' . $data['created_at'] . '"' : '' ?> class="my-2 px-2 py-1 bg-gray-500 text-white placeholder:text-gray-300 rounded-lg border border-gray-500 focus:border-indigo-700 focus:outline-none" id="created_at" type="datetime-local" name="created_at" placeholder="2020-05-05">
            <span class="text-xs text-gray-200">Write here the date and time when the user was created.</span>
        </div>

        <div class="flex">
            <button type="submit" class="bg-indigo-600 px-4 py-2 rounded-lg">Submit</button>
        </div>
        
        <script>
            document.querySelector('form').action = window.location.href
        </script>
    </form>
<?php


include_once(ROOT . '/layouts/foot.php');