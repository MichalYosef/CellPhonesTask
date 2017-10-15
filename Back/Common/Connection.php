<?php
header('Content-Type: text/html; charset=utf-8');





$debugMode = true;

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
                try
                {
                    $this->dbConnection = new PDO( $this->dsn, $this->user, $this->password, $this->opt );
                }
                catch( PDOException $e) 
                {
                    if((strpos($e->getMessage(), 'SQLSTATE[HY000] [1049] Unknown database') !== false) )
                    {
                        $this->dbConnection = $this->createDb();       
                    }    
                    else
                    {
                        return null;
                    }       
                }
            }
                
            // this is required to see hebrew 
            $this->dbConnection->exec("SET NAMES 'utf8'");

            return $this->dbConnection;
            
        }catch( PDOException $e) 
        {
            die("DB ERROR: ". $e->getMessage());
            
        }
        
    }

    private function createDb()
    {
        try 
        {
            
            $dbh = new PDO( "mysql:host=$this->host", 
                            $this->user, 
                            $this->password, 
                            array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET sql_mode="NO_AUTO_VALUE_ON_ZERO"',
                                  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ) );
   
                                  $dbh->exec("SET NAMES 'utf8';");
            $dbh->exec("CREATE DATABASE  IF NOT EXISTS `$this->dbName`  DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
                    CREATE USER '$this->user'@'localhost' IDENTIFIED BY '$this->password';
                    GRANT ALL ON `$this->dbName`.* TO '$this->user'@'localhost';
                    FLUSH PRIVILEGES;") 
            or die(print_r($dbh->errorInfo(), true));
           
            // set db time zone           
            $offset = $this->getCurTimeZoneForMySql();
                     
            $dbh->exec("SET time_zone='$offset';");
                        
          
            // // Create table directors

            // $sqlCreateTbl = '
            // CREATE table  IF NOT EXISTS `movies_project`.`directors`(
            // id int(11) NOT NULL AUTO_INCREMENT,
            // name varchar(50) NOT NULL,
            // PRIMARY KEY (id)
            // ) ENGINE=InnoDB DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci';
            
    

            // $dbh->exec($sqlCreateTbl);

            // // Create table movies
          
            // $sqlCreateTbl = '
            // CREATE table  IF NOT EXISTS `movies_project`.`movies`(
            // id int(11) NOT NULL AUTO_INCREMENT,
            // name varchar(50) NOT NULL,
            // d_id int(11) NOT NULL,
            // PRIMARY KEY (id),
            // CONSTRAINT movie_dir_id FOREIGN KEY (d_id)
            // REFERENCES `movies_project`.`directors` (id)
            // ) ENGINE=InnoDB DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci';
                                                                                                                                                                                

            // $dbh->exec($sqlCreateTbl);                                                                  

            
            // $sqlCreateTbl = "INSERT INTO `movies_project`.`directors` (`id`, `name`) VALUES (NULL, 'רמה בורשטין'), (NULL, 'גידי דר')";
            // $dbh->exec($sqlCreateTbl);
           
            // $sqlCreateTbl = "INSERT INTO `movies_project`.`movies` (`id`, `name`, `d_id`) VALUES (NULL, 'אושפיזין', 2), (NULL, 'לעבור את הקיר', 1)";
            // $dbh->exec($sqlCreateTbl);
           
            return $dbh;
    
        } catch (PDOException $e) 
        {
            die("DB ERROR: ". $e->getMessage());
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

    

    public function getDbConnection()
    {
        if( $this->dbConnection == null)        
            $this->connect();
        

        return $this->dbConnection;
    }

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
                        die(print_r('pdo->prepare->execute failed' , true));
                        
                    }
                    return $statement;

                }
            }
            
        
        }catch( PDOException $e) 
        {
            die(print_r($this->dbConnection->errorInfo(), true));
            
        }
    }
}




?>
