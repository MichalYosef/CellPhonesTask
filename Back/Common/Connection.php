<?php
header('Content-Type: text/html; charset=utf-8');

$debugMode = true;

/*  
    DAL - PDO db Connection
    responsible for all db actions
*/


class Connection
{
    private $host;
    private $dbName;
    private $user;
    private $password;
    private $charset;
    private $opt; //A key=>value array of driver-specific connection options.
    private $dbConnection; //pdo
    private $dsn; /*The Data Source Name, or DSN, contains the information required to connect to the database.*/
     

    public function __construct( $dbName ,
                                 $user = 'root',
                                 $password = '',
                                 $host = '127.0.0.1',
                                 $charset = 'utf8',//'utf8_general_ci',
                                 $opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                                         PDO::ATTR_EMULATE_PREPARES   => false,
                                         PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]
                                )
    {
        $this->host    = $host;
        $this->dbName  = $dbName;
        $this->user    = $user;
        $this->password= $password;
        $this->charset = $charset;
        $this->opt     = $opt;
        $this->dsn = "mysql:host=" . $host . ";dbname=" . $dbName . ";charset=" . $charset;
        
        $this->connect();      
    }

    private function connect()
    {
        try
        {
            if(!$this->dbConnection)
            {
                try{ // establish a connection to db
                    $this->dbConnection = new PDO( $this->dsn, $this->user, $this->password, $this->opt );
                }
                catch( PDOException $e) 
                {
                    // if db doesnt exist
                    if((strpos($e->getMessage(), 'SQLSTATE[HY000] [1049] Unknown database') !== false) )
                    {
                        $this->dbConnection = $this->createDb();       
                    }    
                    else
                    {
                        echo "DB ERROR: Connection failed.<br>".$e->getMessage();
                    }       
                }
            }
            // this is required to see hebrew 
            $this->dbConnection->exec("SET NAMES 'utf8'");

            // return the connection that was just established
            return $this->dbConnection;
            
        }catch (PDOException $e)
        { // catch pdo errors
            echo "DB ERROR: Connection failed.<br>".$e->getMessage();
        }catch (Exception $e)
        { // catch general errors
            echo "General Error: DB Connection failed.<br>".$e->getMessage();
        }
    }


    private function createDb() // if db doesnt exist (TODO: add generic tbl create)
    {
        try 
        {
            $dbh = new PDO( "mysql:host=$this->host", 
                            $this->user, 
                            $this->password, 
                            array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET sql_mode="NO_AUTO_VALUE_ON_ZERO"',
                                  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ) );
   
            $dbh->exec("SET NAMES 'utf8';"); // for the hebrew presentation
            $dbh->exec("CREATE DATABASE  IF NOT EXISTS `$this->dbName`  
                        DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
                        CREATE USER '$this->user'@'localhost' IDENTIFIED BY '$this->password';
                        GRANT ALL ON `$this->dbName`.* TO '$this->user'@'localhost';
                        FLUSH PRIVILEGES;") 
            or die(print_r($dbh->errorInfo(), true));
           
            // set db time zone           
            $offset = $this->getCurTimeZoneForMySql();         
            $dbh->exec("SET time_zone='$offset';");
                        
            /*
            TODO: add generic tbl creation
            */
                      
            return $dbh;
    
        }catch (PDOException $e){
            echo "CREATE DATABASE: " .  $this->dbName . " failed.<br>".$e->getMessage();
        }catch (Exception $e){
            echo "General Error: CREATE DATABASE: " .  $this->dbName . " failed.<br>".$e->getMessage();
        }

    }

    // runQuery: prepare and execute sql query

    public function runQuery( $sqlQuery, $arrParams=null )
    {
        try
        {
            $dbh = $this->getDbConnection();
            if($dbh)
            {
                $statement = $dbh->prepare( $sqlQuery );
                if($statement)
                {
                    if(  ! $statement->execute($arrParams) )
                    {
                        die(print_r('pdo->prepare->execute failed'.$sqlQuery , true));
                    }

                    return $statement;
                }
            }
        }catch (PDOException $e)
        {
            echo "DB ERROR: runQuery: (prepare and execute) failed.".$sqlQuery."<br>".$e->getMessage();
        }catch (Exception $e)
        {
            echo "General Error: runQuery: (prepare and execute) failed.".$sqlQuery."<br>".$e->getMessage();
        }
    }

    private function getCurTimeZoneForMySql()
    {
        $now = new DateTime();
        $mins = $now->getOffset() / 60;
        $sgn = ($mins < 0 ? -1 : 1);
        $mins = abs($mins);
        $hrs = floor($mins / 60);
        $mins -= $hrs * 60;
        $offset = sprintf('%+d:%02d', $hrs*$sgn, $mins);
        return $offset;
    }

    

    private function getDbConnection()
    {
        if( $this->dbConnection == null)        
            $this->connect();
        
        return $this->dbConnection;
    }
}
?>
