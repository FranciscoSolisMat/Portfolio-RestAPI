<?php

if(!function_exists('str_starts_with')){
	function str_starts_with($haystack, $needle): bool {
		return $needle === "" || strpos($haystack, $needle) === 0;
	}
}

if(!function_exists('str_contains')){
	function str_contains($haystack, $needle): bool {
		return strpos($haystack, $needle) !== false;
	}
}