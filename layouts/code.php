<?php
if(!isset($code_type) || !isset($rawCode)){
    // Redirect to error
    ?>
    <script>updateRequest('page=error;error=404')</script>
    <?php
    return;
}

$encodedCode = base64_encode($rawCode);
$htmlSpecialChars = htmlspecialchars($rawCode);
?>

<?php
if($code_type) {
    echo '<h3 class="text-lg text-gray-50">' . $code_type . ' Response:</h3>';
} else if (isset($title)) {
    echo '<h3 class="text-lg text-gray-50">' . $title . '</h3>';
} else {
    echo '<h3 class="text-lg text-gray-50">Response:</h3>';
}
?>

<div class="bg-gray-700 my-3 py-2 rounded-lg">
    <div class="relative mx-2">
        <div class="absolute right-0 -mt-1 bg-gray-500 p-2 rounded-lg text-xs hover:bg-gray-600 cursor-pointer" data-clipboard="<?php print_r($encodedCode) ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" data-clipboard="<?php print_r($encodedCode) ?>">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
        </div>
    </div>
    <pre data-code>
    <?php print_r($htmlSpecialChars); ?>
</pre>
</div>