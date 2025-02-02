<?php
/**
* This example illustrates best practice with regard to using MySQLi in multiple threads
*
* For convenience and simplicity it uses a Pool.
**/

class Connect extends Worker {

    public function __construct($hostname, $username, $password, $database, $port = 3306) {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->port     = $port;
    }
    
    public function getConnection() {
        if (!self::$link) {
            self::$link = new mysqli(
                $this->hostname, 
                $this->username, 
                $this->password, 
                $this->database, 
                $this->port);
        }
        
        /* do some exception/error stuff here maybe */       
         
        return self::$link;
    }
    
    protected $hostname;
    protected $username;
    protected $password;
    protected $database;
    protected $port;
    
    /**
    * Note that the link is stored statically, which for pthreads, means thread local
    **/
    protected static $link;
}

class Query extends ThreadedRunnable {

    public function __construct(string $sql, ThreadedRunnable $store) {
        $this->sql = $sql;
        $this->result = $store;
    }
    
    public function run() {
        $mysqli = $this->worker->getConnection();
        
        $result = $mysqli->query($this->sql);
        
        if ($result) {    
            while (($row = $result->fetch_assoc())) {
                $this->result[] = "{$row['Id']}) {$row['User']} ({$row['State']})";
            }
        }
    }
    
    protected $sql;
    protected $result;
}

$pool = new Pool(4, "Connect", ["localhost", "root", "", "mysql"]);
$stores = [];

for ($i = 0; $i < 6; ++$i) {
    $store = new ThreadedArray(); // store all results in here for the Query object
    $pool->submit(new Query("SHOW PROCESSLIST;", $store));
    $stores[] = $store; // maintain a list of stores to retrieve their results later
}

$pool->collect(); // collect all finished work to free up memory
$pool->shutdown(); // shutdown the pool to make sure it has completely finished executing

print_r($stores); // output all results for all Query objects

?>
