<?php

require_once "\\..\\Models\PhoneModel.php";
require_once "\\..\\Models\ManufacturerModel.php";
// the controller will maintain the logic of the model, 
// Implements CRUD opeartions for all controllers that will inherit

class IController
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

    public function Create( $modelObj) //Insert
    {
        //$model = $modelObj->jsonSerialize(); 
        $keyStr = "(";
        $valueStr = " VALUES(";
        
        foreach( $modelObj as $key => $value ) 
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
    
        return  $result;
    }


    public function Read( $paramArr )
    {
        if(count($paramArr)==0)
        {
            return $this->getAll("statement") ;
        }

        try
        {
            $sqlQuery = "SELECT * FROM " . $this->tblName . " WHERE `" . $this->tblName ."`.`id` = " . $paramArr["id"].";";
            $statement = $this->dbHandler->runQuery( $sqlQuery );

            if(  $statement )
            {                
                $allObjArr = $statement->fetchAll( PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->modelClassName , array('id', 'name'));
                return $allObjArr;
                // $tmp = $allObjArr[0]->jsonSerialize() ;
                // return json_encode( $tmp);
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
    
    public function getAll($arrOrStatement) 
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
            //   //  return  $statement;             
            //      $allObjArr = $statement->fetchAll( PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE , $this->modelClassName );
            //      return $allObjArr;
            }
            else
            {
                Notify("No data returned from GetAll, tabls name:  " . $this->tblName );
                return null;
            }

        }
        catch(PDOException  $e )
        {
            notify::Error( $e->getMessage() );
            Die(); //TODO: Restart app
        }
    }

    


    public function Update( $modelObj )
    {
        $sqlQuery = "UPDATE `" . $this->tblName . "` SET ";

        //$model = $modelObj->jsonSerialize(); 

        foreach( $modelObj as $key => $value ) 
        {
            if( $key != "id")
                $sqlQuery .= "`". $key . "` = '" . $value . "',";    
        }

        $sqlQuery =substr($sqlQuery, 0 , strlen( $sqlQuery )-1 ) ;
        $sqlQuery .= " WHERE `" . $this->tblName ."`.`id` = " . $modelObj["id"].";";

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