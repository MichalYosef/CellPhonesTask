<?php
include_once "IModel.php";

class PhoneModel extends IModel
{

    private $id;
    private $name;
    private $img_name; 
    private $manufacturer_id;

    public function __construct(  $name="", $manufacturer_id=0, $img_name="", $id=null )
    {
        $this->id = $id;
        $this->name = $name;
        $this->manufacturer_id = $manufacturer_id ;
        $this->img_name = $img_name;

       
    }

    public function getDataModel()
    {
        return  [  "id" => $this->id,
                    "name" => $this->name,
                    "img_name" => $this->img_name,
                    "manufacturer_id" => $this->manufacturer_id];

    }

    public function getId()
    {
        return $this->id;
    }
}

?>