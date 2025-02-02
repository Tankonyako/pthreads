--TEST--
Check graceful serialization of Threaded objects as members of non Threaded objects
--DESCRIPTION--
We don't need to serialize Threaded objects when they are set as members of other Threaded
objects. However, a non-threaded object who has a Threaded object as a member must still serialize
the Threaded object when that non-threaded object is set as a member of yet another Threaded object.

So while Threaded objects can store other Threaded objects without hacky serialization routines, normal objects
still require a hack.

This test ensures the hack is right.
--FILE--
<?php
class Wrapper {
    public $worker;

    public function __construct() {
        $this->worker = new Worker;
        $this->worker->start();
    }

    public function stack(ThreadedRunnable $work) {
        $this->worker->stack($work);
    }

	public function shutdown() {
		$this->worker->shutdown();
	}
}

class Work extends ThreadedRunnable {
    public $wrapper;
    public function __construct(Wrapper $wrapper) {
        $this->wrapper = serialize($wrapper);
    }

    public function stack() {
        unserialize($this->wrapper)->stack($this);
    }

    public function run() : void{
        echo "Foo\n";
    }
}
$wrapper = new Wrapper;
$work = new Work($wrapper);
$work->stack();
$wrapper->shutdown();

--EXPECT--
Foo
