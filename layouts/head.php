<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>FranciscoSolis Portfolio (RestAPI)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>const updateRequest = (params) => {let urlparams = new URLSearchParams(window.location.search);let initial = urlparams.toString();params.split(';').forEach(part => {let parts = part.split('=');if(parts.length === 2) {urlparams.set(parts[0], parts[1]);}});if(urlparams.toString() !== initial){window.location.search = urlparams.toString();}}</script>
</head>
<body class="bg-gray-800 text-white transition-all duration-300 ease-in-out">
    <!-- NAV -->
    <div class="bg-indigo-600 p-5">
        <div class="container mx-auto flex justify-between">
            <h1 data-request="page=actions;" class="text-2xl font-bold text-white flex items-center text-center"><img src="https://i.imgur.com/1ymXrSi.png" alt="Logo" class="w-14 h-14 mr-2"/> FranciscoSolis » Portfolio (RestAPI)</h1>
        </div>
    </div>
    <div class="container mx-auto mt-10">
	    <?php if(!in_array(PAGE, ['error', 'index'])) { ?>
            <div class="flex">
                <div class="flex items-center text-center my-5 bg-indigo-800 px-3 py-2 rounded-full text-white font-bold" data-request="page=index;">
                    &leftarrow; Go Back
                </div>
            </div>
	    <?php } ?>
    </div>
    <div class="container mx-auto <?php print_r(!in_array(PAGE, ['error', 'index']) ? 'mb-10' : 'my-10') ?> min-h-screen <?php print_r(isset($center_content) ? 'flex flex-col items-center justify-center -my-20' : '') ?>">