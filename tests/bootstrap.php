<?php

spl_autoload_register(function($class) {
	$parts = explode('\\', ltrim($class, '\\'));
	if ($parts[0] === 'Transphporm') {
		require_once 'tests/' . implode(DIRECTORY_SEPARATOR, $parts) . '.php';
	}
    if ($parts[0] === 'TransphpormXMarkDown') {
		array_shift($parts);
		require_once 'src/' . implode(DIRECTORY_SEPARATOR, $parts) . '.php';
	}
    if ($parts[0] === 'XMarkDown') {
		require_once 'tests/' . implode(DIRECTORY_SEPARATOR, $parts) . '.php';
	}
});
// phpunit --bootstrap tests/bootstrap.php tests/MarkDownFuncTest.php
