--TEST--
Test anonymous classes (bound inherited class)
--DESCRIPTION--
This test verifies that anonymous Threaded objects work as expected
--FILE--
<?php
$worker = new Worker();

$collectable = new class extends ThreadedRunnable {
	/** z */
	const Z = 1;
	/** a */
	static $a = 2;
	/** c */
	public $c = false;

	public function run() : void{
		var_dump(
			$this instanceof ThreadedRunnable,
			self::Z,
			self::$a,
			$this->c
		);
	}
};

$worker->start();
$worker->stack($collectable);
$worker->shutdown();
--EXPECT--
bool(true)
int(1)
int(2)
bool(false)
