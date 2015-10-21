<?php
session_start();
//Connection au serveur
require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>A Simple Page with CKEditor</title>
        <!-- Make sure the path to CKEditor is correct. -->
        <script src="ckeditor/ckeditor.js"></script>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
        <script src="js/jquery-2.1.0.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css">
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href='css/moncss.css' type='text/javascript'>
    </head>
    <body>

        <!-- Button trigger modal -->

        <span class='glyphicon glyphicon-envelope grey' data-toggle="modal" data-target="#myModal"></span>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Mail :</h4>
                    </div>
                    <div class="modal-body">
                        <form class='form-horizontal' role='form' method='POST' action='envoi_mail.php' enctype='multipart/form-data'>
                            <div class='form-group'>
                                <label for='exampleInputEmail1'>Votre adresse mail :</label>
                                <input type='email' class='form-control' id='form_mail' name='form_mail' placeholder='Votre adresse mail ?' readonly="">
                            </div>

                            <div class='form-group'>
                                <label for='exampleInputEmail1'>Destinataire :</label>
                                <input type='email' class='form-control' id='to_mail' name='to_mail' placeholder='Enter email' readonly="">
                            </div>

                            <div class='form-group'>
                                <label for='exampleInputEmail1'>Titre :</label>
                                <input type="text" class="form-control" id='titre' name='titre' placeholder="Titre ?">
                            </div>

                            <textarea name="body" id="body" rows="10" cols="80">
                            
                            </textarea>
                            <script>
                                CKEDITOR.replace('body');
                            </script>


                            <div><label for='exampleInputEmail1'>Piece jointe :</label><input type='file' id='exampleInputFile' name='piece'></div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default col-lg-2" data-dismiss="modal">Close</button>
                                <button type='submit' method='POST' class='btn btn-primary ' name='envoi'>Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    </body>
</html>