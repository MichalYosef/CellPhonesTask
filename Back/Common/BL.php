<?php

require_once "\\..\\Models\DirectorModel.php";

class MoviesBL
{
    private $tblName;
    private $modelClassName ;
    private $dbHandler;
      
    public function __construct( $dbHandler, $tblName, $modelClassName  )
    {     
        if(( $dbHandler )&&( $tblName ))
        {
            $this->dbHandler = $dbHandler;
            $this->tblName = strtolower($tblName); 
            $this->modelClassName = $modelClassName ;
        }
        else
        {
            // TODO:?? get from DI Injector
            $errorMsg = "Controller __construct got a faulty dbHandler: " . dbHandler . "or table name: " . $tblName;
            Notify::log( $errorMsg );
            throw new Exception( $errorMsg );   
        }      
    }

    public function Read( $paramArr )
    {

    }
    
    public function getAll( $arrOrStatement) 
    {
        try
        {
            $statement = $this->dbHandler->runQuery( "SELECT * FROM " . $this->tblName );
            if(  $statement )
            {   
                if($arrOrStatement == "array")             
                {
                    $allObjArr = $statement->fetchAll( PDO::FETCH_CLASS , $this->modelClassName );
                    return $allObjArr;
                }
                else if($arrOrStatement == "statement")
                {
                    return $statement;
                }
                
            }
            else
            {
                Notify("No data returned from GetAll, tabls name:  " . $this->tblName );
            }

        }
        catch(PDOException  $e )
        {
            notify::Error( $e->getMessage() );
            Die(); //TODO: Restart app
        }
    }

    public function Create( $modelObj) //Insert
    {
        $model = $modelObj->jsonSerialize(); 
        $keyStr = "(";
        $valueStr = " VALUES(";
        
        foreach( $model as $key => $value ) 
        {
            $keyStr .= $key . ", ";
            $valueStr .= "'" . $value . "',";    
        }

        $keyStr = rtrim($keyStr,", ") . ")" ;
        $valueStr = rtrim( $valueStr, ", ") . ")" ;
        

        $sqlQuery = "INSERT INTO " . $this->tblName . $keyStr . $valueStr .";";

        $result = $this->dbHandler->runQuery( $sqlQuery );

        if($result)
        {
            if ( $GLOBALS['debugMode'] == true)
                echo "";
        }
    
        return $result;
    }


    public function Update( $modelObj )
    {
        $sqlQuery = "UPDATE `" . $this->tblName . "` SET ";

        $model = $modelObj->jsonSerialize(); 

        foreach( $model as $key => $value ) 
        {
            if( $key != "id")
                $sqlQuery .= "`". $key . "` = '" . $value . "',";    
        }

        $sqlQuery =substr($sqlQuery, 0 , strlen( $sqlQuery )-1 ) ;
        $sqlQuery .= " WHERE `" . $this->tblName ."`.`id` = " . $model["id"].";";

        if ( $GLOBALS['debugMode'] == true)
        {
            echo   $sqlQuery ;
            //die();
        }
        $result = $this->dbHandler->runQuery( $sqlQuery );

        if($result)
        {
            if ( $GLOBALS['debugMode'] == true)
                echo "Update succeed!";
        }
    
        return $result;
    }

    public function Delete( $id )
    {
        $sqlQuery = "DELETE FROM `" . $this->tblName . "` WHERE `" . $this->tblName ."`.`id` = " . $id.";";
        
        $result = $this->dbHandler->runQuery( $sqlQuery );
        
        if($result)
        {
            if ( $GLOBALS['debugMode'] == true)
                echo "Delete succeed!";
        }
    
        return $result;

    }

}


?>