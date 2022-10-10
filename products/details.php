<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../layout/head.template.php"; ?>
</head>
<body>
    <?php 
    include "../app/ProductController.php";
    $productController = new ProductController();
    $productos = $productController->getProductos();
    $product = false;

    if(isset($_GET['slug'])){
      foreach($productos as $producto){
        if($producto['slug'] == $_GET['slug']){
          $product = $productController->getProduct($producto['id']);
          break;
        }
      }
    }
    if(!$product){
      header('Location: index.php?error=Producto no encontrado');
    }
      include "../layout/navbar.template.php"; 
    ?>
    <div class="container-fluid">
        <div class="row">
            <?php include "../layout/sidebar.template.php"; ?>
            <div class="col-lg-10">
                <div class="row d-flex flex-row justify-content-between mt-2 border-bottom">
                    <div class="col"><span>Detalle de producto</span></div>
                    <div class="col-2"><a href="<?= BASE_PATH ?>productos" class="btn btn-info mb-2" >Regresar a productos</a></div>
                </div>
                <div class="row d-flex justify-content-start mt-4">
                  <div class="col-lg-4">
                    <img src="<?= $product['cover']?>" width="500" height="600" alt="">
                  </div>
                  <div class="col-lg-6 m-5 d-flex flex-column justify-content-between">
                    <h3><?= $product['name']?></h3>
                    <h5 class="fst-italic" style="color: gray;"><?= $product['slug']?></h5>
                    <h5>Descripcion</h5>
                    <p><?= $product['description']?></p>
                    <h5>Features</h5>
                    <p><?= $product['features']?></p>

                    <div>
                    <p><strong>Marca: </strong><?= $product['brand']['name']?></p>
                    <strong>Etiquetas: </strong>
                    <?php foreach($product['tags'] as $tag): ?>
                      <li><?= $tag['name']?></li>
                    <?php endforeach;?>

                    <strong>Categorias: </strong>
                    <?php foreach($product['categories'] as $cat): ?>
                      <li><?= $cat['name']?></li>
                    <?php endforeach;?>
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