--TEST--
Test traits scope (gh issue #484)
--FILE--
<?php
class MyWork extends \ThreadedRunnable {
	use \MyTrait;

	public function run() : void{
    	$this->getSomething();
	}
}

trait MyTrait {
	protected function getSomething($test = false) {
		if (!$test) {
			require_once 'traits-scope.inc';
			return (new \MyClass())->doSomething();
		}
	}
}

$pool = new \Pool(1, \Worker::class);
$pool->submit(new MyWork());
$pool->shutdown();
--EXPECT--
OK

