<?php
set_include_path('.;');//;C:\xampp\htdocs\MICHAL-PHP\new-‏‏end-to-end-movies-project;C:\xampp\php\PEAR;');

require_once "IController.php";
//require_once "../Common/Connection.php";


class PhoneController extends IController
{
    private $phoneObj; 
      
    public function __construct( $dbHandler, $phoneObj=null )
    {
       
        parent::__construct( $dbHandler, "phones", "PhoneModel" );
        $this->phoneObj = $phoneObj;
    }

    public function Read( $paramArr )
    {
        try
        {
            $allObjArr = parent::Read( $paramArr );
            
            //echo json_encode( $allObjArr);
            $data = $allObjArr;
            header('Content-Type: application/json');
            echo json_encode($data);


            // if(  $statement )
            // {   
            //    // $this->createHtmlTbl( $statement );
            //     /*             
            //     $allObjArr = $statement->fetchAll( PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->modelClassName , array('id', 'name'));
            //     $tmp = $allObjArr[0]->jsonSerialize() ;
            //     return json_encode( $tmp);
            //     */
            // }
            // else
            // {
     
            // }

        }
        catch(PDOException  $e )
        {
            notify::Error( $e->getMessage() );
            Die(); //TODO: Restart app
        }

    }
/*
    private function createHtmlTbl( $statement )
    {
        while( $row = $statement->fetch())
        {
            ?><tr>
                <td><?php echo $row['id']?></td>
                <td><?php echo hebrevc($row['name'])?></td>
                <td>
                    <button class="btn btn-warning"  data-toggle="modal" data-target="#update-<?php echo $row['id']?>">Edit</button>
                    <!-- Modal -->
                    <div class="modal fade" id="update-<?php echo $row['id']?>" tabindex="-1" role="dialog" aria-labelledby="updateLabel-<?php echo $row['id']?>">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="updateLabel-<?php echo $row['id']?>">Edit data</h4>
                            </div>
                            <form>
                                <div class="modal-body">
                                <input type="hidden" id="<?php echo $row['id']?>" value="<?php echo $row['id']?>">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name-<?php echo $row['id']?>" value="<?php echo $row['name']?>">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" onclick="CRUD.Update(<?php echo $row['id']?>)" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    <button onclick="CRUD.Delete(<?php echo $row['id']?>)" class="btn btn-danger">Delete</button>
                </td>
            </tr><?php    
        }
    }*/
}

// the controller maintains the logic of the model (CRUD opeartions for example)

/*
if($page == 'create')
{
    $name = $_POST['name'];
   
    
    $stmnt = $db->prepare("insert into directors values('',?)");
    $stmnt->bindParam(1,$name);
   
    
    if( $stmnt->execute() )
    {
        echo "Succeed adding data";

    }else
    {
        echo "failed adding data";

    }
    
    
}else if($page == 'update')
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    
    
    $stmnt = $db->prepare("update directors set name=? where id=?");
    $stmnt->bindParam(1,$name);
     $stmnt->bindParam(2,$id);
    
    
    if( $stmnt->execute() )
    {
        echo "Succeed update data";

    }else
    {
        echo "failed update data";

    }

}else if($page == 'del')
{
    $id = $_GET['id'];
    $stmnt = $db->prepare("delete from directors where id=?");
    $stmnt->bindParam(1,$id);
    
    if( $stmnt->execute() )
    {
        echo "Succeed Delete data";

    }else
    {
        echo "failed Delete data";

    }

}else //getAll
{
    try
    {
        $stmnt = $db->prepare("select * from directors order by id desc");
        $ok = $stmnt->execute();
    }catch( PDOException $e) 
    {
        echo 'pdo prepare/execute failed:  exception was thrown: ' . $e->getMessage();   
    }
        
}

*/



?>