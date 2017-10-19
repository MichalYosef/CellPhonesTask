<?php
require_once '..\\Back\Common\Connection.php';
require_once '..\\Back\Common\App.php';
require_once '..\\Back\Controllers\PhoneController.php';


$myApp = new App();
$dbHanler = new Connection( $myApp->getDbName() );
$phonesCtrl = new PhoneController( $dbHanler );

$allPhones = $phonesCtrl->getAllWithManuName();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"/>
        <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="phones.css"/>
        <title>Cell Phones - Class Task</title>
    </head>
    <body class="frame">
        
        <!-- Header-->
        <header class="page-header">
            <h3 class="jumbotron text-center">Cell Phones - Class Task</h3>
        </header>
        
        
        <!--button to create new phone-->
        <button type="button" data-toggle="modal" data-target="#create" class="btn btn-primary center-block">
   <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">-->
            Add new phone<span class="glyphicon glyphicon-plus-sign">
        </button>

          <!-- Modal -->
        <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="createLabel">Add new phone</h4>
                    </div>
                    <form id="newPhoneForm">
                        <div class="modal-body">
                            <div class="form-group">
                            <!--  Input field for phone model/name  -->
                                <label for="name">Phone model/Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter model / Name here...">
                            </div>
                           
                           <hr>
                           <!-- <form id="uploadimage" action="" method="post" enctype="multipart/form-data">-->
                           <form>
                                <!-- <div id="image_preview"><img id="previewing" src="images/noimage.png" />
                                </div> -->
                                <hr id="line">
                                <div id="selectImage">
                                    <label>Select Your Image</label><br/>
                                    <input type="file" name="file" id="file" required />
                                </div>
                            </form>
                            </div>
                           
                            <!-- manufecturers list to choose from-->
                            <div class="form-group">
                                <label for="manuSelectEl">Manufecturer</label>
                                <select id="manuSelectEl">
                                </select>
                            </div>
                        </div>     
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id='btnCreate' class="btn btn-primary">Save (Create) </button>
                        </div>
                    </form>
                </div>
            </div>
      </div>
        <!--->

        <!-- Data table to present the phones -->
        <div>
            <table id="phonesTbl" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Manufacturer</th>
                    
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Manufacturer</th>
                    
                    </tr>
                </tfoot>
                <tbody>
                    <?php if (count($allPhones)): ?>
                        <?php foreach ($allPhones as $key => $value): ?>
                            <tr>
                                <td><?php echo $value['phone_id'] ?></td>
                                <td><?php echo $value['phone_name'] ?></td>
                                <!-- if there is an image load image -->
                            <?php if ($value['img_name']): ?>
                                <td><?php echo  "<img src='".$myApp->getImgPath().$value['img_name']."' style='max-height:100%; max-width:100%'/>"  ?></td>
                                <!-- if there is no image load an empty cell -->
                            <?php else : ?>
                                <td></td>
                            <?php endif; ?>
                                <td><?php echo $value['manu_name'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>    
        <script src="js/main.js"></script>
       
        
        </div>
    </body>
</html>