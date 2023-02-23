<?php
/**
 * pthreads extension stub file for code completion purposes
 *
 * @author Lisachenko Alexander <lisachenko.it@gmail.com>
 * @version 3.0.0
 */

/**
 * The default inheritance mask used when starting Threads and Workers
 */
define('PTHREADS_INHERIT_ALL', 0x111111);

/**
 * Nothing will be inherited by the new context
 */
define('PTHREADS_INHERIT_NONE', 0);

/**
 * Determines whether the ini entries are inherited by the new context
 */
define('PTHREADS_INHERIT_INI', 0x1);

/**
 * Determines whether the constants are inherited by the new context
 */
define('PTHREADS_INHERIT_CONSTANTS', 0x10);

/**
 * Determines whether the class table is inherited by the new context
 */
define('PTHREADS_INHERIT_CLASSES', 0x100);

/**
 * Determines whether the function table is inherited by the new context
 */
define('PTHREADS_INHERIT_FUNCTIONS', 0x100);

/**
 * Determines whether the included_files table is inherited by the new context
 */
define('PTHREADS_INHERIT_INCLUDES', 0x10000);

/**
 * Determines whether the comments are inherited by the new context
 */
define('PTHREADS_INHERIT_COMMENTS', 0x100000);

/**
 * Allow output headers from the threads
 */
define('PTHREADS_ALLOW_HEADERS', 0x1000000);


/**
 * Pool class
 *
 * A Pool is a container for, and controller of, a number of Worker threads, the number of threads can be adjusted
 * during execution, additionally the Pool provides an easy mechanism to maintain and collect references in the
 * proper way.
 *
 * @link http://www.php.net/manual/en/class.pool.php
 * @generate-class-entries
 */
class Pool{
    /**
     * The maximum number of Worker threads allowed in this Pool
     *
     * @var int
     */
    protected $size;

    /**
     * The name of the Worker class for this Pool
     *
     * @var string
     */
    protected $class;

    /**
     * The array of Worker threads for this Pool
     *
     * @var Worker[]
     */
    protected $workers;

    /**
     * The constructor arguments to be passed by this Pool to new Workers upon construction
     *
     * @var array
     */
    protected $ctor;

    /**
     * The numeric identifier for the last Worker used by this Pool
     *
     * @var int
     */
    protected $last = 0;

    /**
     * Construct a new Pool of Workers
     *
     * @param integer $size The maximum number of Workers this Pool can create
     * @param string $class The class for new Workers
     * @param array $ctor An array of arguments to be passed to new Workers
     *
     * @link http://www.php.net/manual/en/pool.__construct.php
     */
    public function __construct(int $size, string $class = Worker::class, array $ctor = []) {}

    /**
     * Collect references to completed tasks
     *
     * Allows the Pool to collect references determined to be garbage by the given collector
     *
     * @param callable|null $collector
     * @return int the number of tasks collected from the pool
	 *
     * @link http://www.php.net/manual/en/pool.collect.php
     */
    public function collect(callable $collector = null) : int{}

    /**
     * Resize the Pool
     *
     * @param integer $size The maximum number of Workers this Pool can create
     *
     * @link http://www.php.net/manual/en/pool.resize.php
     */
    public function resize(int $size) : void{}

    /**
     * Shutdown all Workers in this Pool
     *
     * @link http://www.php.net/manual/en/pool.shutdown.php
     */
    public function shutdown() : void{}

    /**
     * Submit the task to the next Worker in the Pool
     *
     * @param Threaded $task The task for execution
     *
     * @return int the identifier of the Worker executing the object
     */
    public function submit(ThreadedRunnable $task) : int{}

    /**
     * Submit the task to the specific Worker in the Pool
     *
     * @param int $worker The worker for execution
     * @param Threaded $task The task for execution
     *
     * @return int the identifier of the Worker that accepted the object
     */
    public function submitTo(int $worker, ThreadedRunnable $task) : int{}
}


/**
 * Basic thread implementation
 *
 * An implementation of a Thread should extend this declaration, implementing the run method.
 * When the start method of that object is called, the run method code will be executed in separate Thread.
 *
 * @link http://www.php.net/manual/en/class.thread.php
 * @generate-class-entries
 */
abstract class Thread extends ThreadedRunnable
{
    /**
     * Will return the identity of the Thread that created the referenced Thread
     *
     * @link http://www.php.net/manual/en/thread.getcreatorid.php
     * @return int A numeric identity
     */
    public function getCreatorId() : int{}

    /**
     * Will return the instance of currently executing thread
     *
     * @return Thread|null
     */
    public static function getCurrentThread() : ?Thread{}

    /**
     * Will return the identity of the currently executing thread
     *
     * @link http://www.php.net/manual/en/thread.getcurrentthreadid.php
     * @return int
     */
    public static function getCurrentThreadId() : int{}

    /**
     * Will return the identity of the referenced Thread
     *
     * @link http://www.php.net/manual/en/thread.getthreadid.php
     * @return int
     */
    public function getThreadId() : int{}

    /**
     * Tell if the referenced Thread has been joined by another context
     *
     * @link http://www.php.net/manual/en/thread.isjoined.php
     * @return bool A boolean indication of state
     */
    public function isJoined() : bool{}

    /**
     * Tell if the referenced Thread has been started
     *
     * @link http://www.php.net/manual/en/thread.isstarted.php
     * @return bool A boolean indication of state
     */
    public function isStarted() : bool{}

    /**
     * Causes the calling context to wait for the referenced Thread to finish executing
     *
     * @link http://www.php.net/manual/en/thread.join.php
     * @return bool A boolean indication of state
     */
    public function join() : bool{}

    /**
     * Will start a new Thread to execute the implemented run method
     *
     * @param int $options An optional mask of inheritance constants, by default PTHREADS_INHERIT_ALL
     *
     * @link http://www.php.net/manual/en/thread.start.php
     * @return bool A boolean indication of success
     */
    public function start(int $options = PTHREADS_INHERIT_ALL) : bool{}
}


/**
 * ThreadedArray objects are similar to regular arrays, with the exception that they can be shared between threads.
 *
 * @generate-class-entries
 * @strict-properties
 */
final class ThreadedArray extends ThreadedBase implements Countable, ArrayAccess
{
    /**
     * Fetches a chunk of the objects properties table of the given size
     *
     * @param int $size The number of items to fetch
     * @param bool $preserve Preserve the keys of members
     *
     * @return array An array of items from the objects member table
     */
    public function chunk(int $size, bool $preserve = false) : array{}

    /**
     * {@inheritdoc}
     */
    public function count() : int{}

    /**
     * Converts the given array into a ThreadedArray object (recursively)
     * @param array $array
     *
     * @return ThreadedArray A ThreadedArray object created from the provided array
     */
    public static function fromArray(array $array) : ThreadedArray {}

    /**
     * Merges data into the current ThreadedArray
     *
     * @param mixed $from The data to merge
     * @param bool $overwrite Overwrite existing keys flag
     *
     * @return bool A boolean indication of success
     */
    public function merge(mixed $from, bool $overwrite = true) : bool{}

    /**
     * Pops an item from the array
     *
     * @return mixed The last item in the array
     */
    public function pop() : mixed{}

    /**
     * Shifts an item from the array
     *
     * @return mixed The first item in the array
     */
    public function shift() : mixed{}

	public function offsetGet(mixed $offset) : mixed{}

	public function offsetSet(mixed $offset, mixed $value) : void{}

	public function offsetExists(mixed $offset) : bool{}

	public function offsetUnset(mixed $offset) : void{}
}


/**
 * ThreadedBase class
 *
 * ThreadedBase exposes similar synchronization functionality to the old Threaded, but
 * with a less bloated interface which reduces undefined behaviour possibilities.
 *
 * Threaded objects form the basis of pthreads ability to execute user code in parallel;
 * they expose and include synchronization methods.
 *
 * Threaded objects, most importantly, provide implicit safety for the programmer;
 * all operations on the object scope are safe.
 * @generate-class-entries
 */
class ThreadedBase implements IteratorAggregate
{
    /**
     * Send notification to the referenced object
     *
     * @link http://www.php.net/manual/en/threaded.notify.php
     * @return bool A boolean indication of success
     */
    public function notify() : bool{}

    /**
     * Send notification to one context waiting on the Threaded
     *
     * @return bool A boolean indication of success
     */
    public function notifyOne() : bool{}

    /**
     * Executes the block while retaining the synchronization lock for the current context.
     *
     * @param \Closure $function The block of code to execute
     * @param mixed $args... Variable length list of arguments to use as function arguments to the block
     *
     * @link http://www.php.net/manual/en/threaded.synchronized.php
     * @return mixed The return value from the block
     */
    public function synchronized(\Closure $function, mixed ...$args) : mixed{}

    /**
     * Waits for notification from the Stackable
     *
     * @param int $timeout An optional timeout in microseconds
     *
     * @link http://www.php.net/manual/en/threaded.wait.php
     * @return bool A boolean indication of success
     */
    public function wait(int $timeout = 0) : bool{}

	public function getIterator() : Iterator{}
}


/**
 * @generate-class-entries
 */
class ThreadedConnectionException extends \RuntimeException{

}


/**
 * ThreadedRunnable class
 *
 * ThreadedRunnable represents a unit of work. It provides methods to determine its execution state.
 * @generate-class-entries
 */
abstract class ThreadedRunnable extends ThreadedBase
{
    /**
     * Tell if the referenced object is executing
     *
     * @link http://www.php.net/manual/en/threaded.isrunning.php
     * @return bool A boolean indication of state
     */
    public function isRunning() : bool{}

    /**
     * Tell if the referenced object exited, suffered fatal errors, or threw uncaught exceptions during execution
     *
     * @link http://www.php.net/manual/en/threaded.isterminated.php
     * @return bool A boolean indication of state
     */
    public function isTerminated() : bool{}

    /**
     * The programmer should always implement the run method for objects that are intended for execution.
     *
     * @link http://www.php.net/manual/en/threaded.run.php
     * @return void The methods return value, if used, will be ignored
     */
    abstract public function run() : void{}
}


/**
 * Worker
 *
 * Worker Threads have a persistent context, as such should be used over Threads in most cases.
 *
 * When a Worker is started, the run method will be executed, but the Thread will not leave until one
 * of the following conditions are met:
 *   - the Worker goes out of scope (no more references remain)
 *   - the programmer calls shutdown
 *   - the script dies
 * This means the programmer can reuse the context throughout execution; placing objects on the stack of
 * the Worker will cause the Worker to execute the stacked objects run method.
 *
 * @link http://www.php.net/manual/en/class.worker.php
 * @generate-class-entries
 */
class Worker extends Thread
{
    /**
     * Executes the optional collector on each of the tasks, removing the task if true is returned
     *
     * @param callable $function The collector to be executed upon each task
     * @return int The number of tasks left to be collected
     */
    public function collect(callable $function = null) : int{}

    /**
     * Default collection function called by collect(), if a collect callback wasn't given.
     *
     * @param ThreadedRunnable $collectable The collectable object to run the collector on
     * @return bool Whether or not the object can be disposed of
     */
    public function collector(ThreadedRunnable $collectable) : bool{}

    /**
     * Returns the number of threaded tasks waiting to be executed by the referenced Worker
     *
     * @link http://www.php.net/manual/en/worker.getstacked.php
     * @return int An integral value
     */
    public function getStacked() : int{}

    /**
     * Tell if the referenced Worker has been shutdown
     *
     * @link http://www.php.net/manual/en/worker.isshutdown.php
     * @return bool A boolean indication of state
	 * @alias Thread::isJoined
     */
    public function isShutdown() : bool{}

    /**
     * Shuts down the Worker after executing all the threaded tasks previously stacked
     *
     * @link http://www.php.net/manual/en/worker.shutdown.php
     * @return bool A boolean indication of success
	 * @alias Thread::join
     */
    public function shutdown() : bool{}

    /**
     * Appends the referenced object to the stack of the referenced Worker
     *
     * @param ThreadedRunnable $work Threaded object to be executed by the referenced Worker
     *
     * @link http://www.php.net/manual/en/worker.stack.php
     * @return int The new length of the stack
     */
    public function stack(ThreadedRunnable $work) : int{}

    /**
     * Removes the first task (the oldest one) in the stack.
     *
     * @link http://www.php.net/manual/en/worker.unstack.php
     * @return ThreadedRunnable|null The item removed from the stack
     */
    public function unstack() : ?ThreadedRunnable{}

    /**
     * Performs initialization actions when the Worker is started.
     * Override this to do actions on Worker start; an empty default implementation is provided.
     *
     * @return void
     */
    public function run() : void{}
}
