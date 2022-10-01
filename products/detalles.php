<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../layout/head.template.php"; ?>
</head>
<body>
    <?php 
      include "../app/ProductController.php";
      $productController = new ProductController();
      $productController->getProduct();
      include "../layout/navbar.template.php"; 
    ?>
    <div class="container-fluid">
        <div class="row">
            <?php include "../layout/sidebar.template.php"; ?>
            <div class="col-lg-10">
                <div class="row d-flex flex-row justify-content-between mt-2 border-bottom">
                    <div class="col"><span>Productos</span></div>
                    <div class="col-2"><a href="index.php" class="btn btn-info mb-2" >Regresar a productos</a></div>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis ad sapiente totam, libero eveniet repellendus amet aliquam. Eveniet, rerum nihil alias iste quo dignissimos est consequuntur similique explicabo dolor ipsam.</p>
                <div class="row">
                      <div class="col-sm-3 col-md-3 mb-3">
                        <div class="card" style="width: 18rem;">
                            <img src="../public/images/foto.png" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">Card title</h5>
                              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                              <div class="row">
                                <div class="col">
                                  <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-warning w-100">Editar</a>
                                </div>
                                <div class="col">
                                  <a href="#" class="btn btn-danger w-100" onclick="remove(this)">Eliminar</a>
                                </div>
                              </div>
                            </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row flex-column d-flex justify-content-center align-items-center">
          <div class="col">
              <div class="form-group">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" id="username" name="username" class="form-control" placeholder="Username">
              </div>
          </div>
          <div class="col">
              <div class="form-group">
                  <label for="password" class="form-label">Password</label>
                  <input type="text" class="form-control" id="password" name="password" placeholder="Password">
              </div>
              <button class="btn btn-primary w-100 mt-4">Submit</button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php include "../layout/scripts.template.php"; ?>
<script>
  function remove(target){
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
      )
    }
  })
  }
</script>
</body>
</html>