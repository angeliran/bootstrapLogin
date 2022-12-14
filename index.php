<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Bootstrap</title>
</head>
<body>
    <?php
    include_once "app/config.php";
    error_reporting(E_ALL ^ E_NOTICE);  ?>
   <div class="container" >
       <div class="row flex-column d-flex justify-content-center align-items-center" style="height: 50rem">
        <form class="flex-column d-flex justify-content-center align-items-center " action="<?= BASE_PATH ?>auth" method="POST">
           <div class="text-center">
               <h1>Form</h1>
           </div>
               <div class="col-lg-4">
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="asolis_19@alu.uabcs.mx">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="password" class="form-label" >Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="Le*J9eZbBU7w72"> <!-- Le*J9eZbBU7w72 -->
                    </div>
                    <?php if(isset($_GET["error"]))
                        { 
                            echo '<div class="alert alert-danger mt-3" role="alert">
                                    '.$_GET["error"].'
                                    </div>';
                        }
                    ?>
                    <button class="btn btn-primary w-100 mt-4">Submit</button>
                </div>
                <input type="hidden" name="action" value="access">
                <input type="hidden" name="global_token" value="<?= $_SESSION['global_token']?>">
           </form>
       
    </div>
</div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>