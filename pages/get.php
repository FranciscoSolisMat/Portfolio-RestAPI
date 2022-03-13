<?php

if(!isset($db)) {
	require_once('../utils.php');
}

$query = strtolower($_REQUEST['query'] ?? '');
$sort_by = $_REQUEST['sort_by'] ?? 'created_at';
if($sort_by != 'created_at' && $sort_by != 'id' && $sort_by != 'name') {
	$sort_by = 'created_at';
}


$countStatement = $db->prepare('SELECT COUNT(id) FROM users WHERE name LIKE :query');
$countStatement->bindValue(':query', '%' . $query . '%');
$countResult = $countStatement->execute();
$count = $countResult->fetchArray(SQLITE3_NUM)[0];

$statement = $db->prepare("SELECT id,name,created_at FROM users WHERE name LIKE :query ORDER BY :sort DESC");
$statement->bindValue(':query', '%' . $query . '%');
$statement->bindValue(':sort', $sort_by);
$result = $statement->execute();
$data = [];
$i = 0;
while($i < $count) {
	$row = $result->fetchArray(SQLITE3_ASSOC);
	$row['created_at'] = date('Y-m-d H:i:s', doubleval($row['created_at']) / 1000);
	$data[] = $row;
	$i++;
}

$rawCode = json([
	'data' => $data,
	'meta' => [
		'query' => [
			'filter' => $query,
			'sort_by' => $sort_by,
		],
		'count' => sizeof($data),
	],
]);
$code_type = 'JSON';
if(REQUIRES_JSON){
    return json(json_decode($rawCode, true), true, true);
}

include_once(LAYOUTS['head']);
?>
	<form id="search" class="flex flex-row" autocomplete="off">
		<div class="flex flex-row items-center justify-start mb-5 bg-gray-600 p-2 rounded-lg cursor-text" onclick="document.getElementById('query').focus()">
			<span onclick="document.getElementById('query').focus()">Search:&nbsp;</span>
			<label>
				<input class="bg-gray-600 text-white placeholder:text-gray-300 rounded-lg focus:outline-none" id="query" type="text" name="query" placeholder="...">
			</label>
		</div>
		<script>
			document.getElementById('search').onsubmit = ($event) => {
                let query = document.getElementById('query').value
				updateRequest(`query=${query};`)
                $event.preventDefault()
				$event.stopPropagation()
				return false;
			}
            
            let currentQuery = new URLSearchParams(window.location.search).get('query') || ''
            if(currentQuery && currentQuery.length > 0){
                document.getElementById('query').value = currentQuery
            }
		</script>
	</form>
<?php
include(LAYOUTS['code']);
include_once(LAYOUTS['foot']);
