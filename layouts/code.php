<!-- Display of variable 'json' if present through html -->
<?php
$escaped_json = htmlspecialchars($json ?? '');
$special_json = htmlspecialchars(json_encode(json_decode($json ?? ''), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS));
?>
<h3 class="text-lg text-gray-50">JSON Response:</h3>
<div class="bg-gray-700 my-3 py-2 rounded-lg">
    <div class="relative mx-2">
        <div class="absolute right-0 -mt-1 bg-gray-500 p-2 rounded-lg text-xs hover:bg-gray-600 cursor-pointer" data-clipboard="<?php echo $special_json ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" data-clipboard="<?php echo $special_json ?>">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
        </div>
    </div>
    <pre data-code>
    <?php echo $escaped_json ?>
</pre>
</div>