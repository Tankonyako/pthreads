--TEST--
Test object cast
--DESCRIPTION--
If you pass two Thread objects (A,B) to a Thread, and set as B as a member of A, or vice versa
this will raise an exception when you try to access the member in the context that created A and B
if the Thread has been destroyed.

This is because A and B inside the Thread are objects that represent the original objects but are not physically
the same.

Explicitly casting Threaded to object upon access ensures you are referencing the original object.

This could be dangerous if misused ... please don't misuse it ...
--FILE--
<?php
class Test extends Thread {
	
	public function __construct(ThreadedBase $thing, ThreadedBase $member) {
		$this->thing = $thing;
		$this->member = $member;
	}

	public function run() : void{
		$this->thing->member = 
			(object) $this->member;

	}
	
	private $thing;
	private $member;
}

$thing = new ThreadedBase();
$member = new ThreadedBase();

$test = new Test($thing, $member);

$test->start() && $test->join();

var_dump($thing);
?>
--EXPECT--
object(ThreadedBase)#1 (1) {
  ["member"]=>
  object(ThreadedBase)#2 (0) {
  }
}



