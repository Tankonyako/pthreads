--TEST--
Test that unsupported types are correctly rejected
--FILE--
<?php

$threaded = new ThreadedArray;
foreach([
	[],
	[1, 2, 3],
	array_fill(0, 10, 0),
	new \stdClass,
] as $bannedType){
	try{
		$threaded[] = $bannedType;
	}catch(\Error $e){
		echo $e->getMessage() . PHP_EOL;
	}
}
?>
--EXPECT--
Cannot assign non-thread-safe value of type array to ThreadedArray
Cannot assign non-thread-safe value of type array to ThreadedArray
Cannot assign non-thread-safe value of type array to ThreadedArray
Cannot assign non-thread-safe value of type object to ThreadedArray

