--TEST--
Closure copying of an already copied closure
--DESCRIPTION--
We need to retain function flag information for closures, since their copying
semantics differ to that of normal function copying.
--FILE--
<?php

class SubThread extends Thread
{
    public function run() : void{
        $this->testFunction();
    }

    public function testFunction()
    {
        (function () {})();
    }
}

$thread = new class extends Thread {
    public function run() : void{
        $thread = new SubThread();
        $thread->start(PTHREADS_INHERIT_NONE) && $thread->join();
    }
};

$thread->start() && $thread->join();
echo "OK\n";
--EXPECT--
OK
