<?php

include_once "IModel.php";



class ManufacturerModel extends IModel
{
    private $id;
    private $name;
    

    public function __construct(  $name="",  $id=null )
    {
        $this->id = $id;
        $this->name = $name;
        

       
    }

    public function getDataModel()
    {
        return  [  "id" => $this->id,
                    "name" => $this->name];

    }

    public function getId()
    {
        return $this->id;
    }
}

?>