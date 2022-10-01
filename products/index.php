<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../layout/head.template.php"; ?>
</head>
<body>
  <?php 
        include "../app/ProductController.php";
        include "../app/BrandController.php";

        $productController = new ProductController();
        $productos = $productController->getProductos();

        $brandController = new BrandController();
        $brands = $brandController->getBrands();
  ?>
    <?php include "../layout/navbar.template.php"; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include "../layout/sidebar.template.php"; ?>
            <div class="col-lg-10">
                <div class="row d-flex flex-row justify-content-between mt-2 border-bottom">
                    <div class="col"><span>Productos</span></div>
                    <div class="col-2"><button class="btn btn-info mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick='action("add")'>Añadir producto</button></div>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis ad sapiente totam, libero eveniet repellendus amet aliquam. Eveniet, rerum nihil alias iste quo dignissimos est consequuntur similique explicabo.</p>
                <div class="row">
                  <?php foreach($productos as $producto): ?>
                      <div class="col-lg-3 col-md-5 col-sm-6 col-xs-12 mb-3">
                        <div class="card" style="height: 37rem; cursor: pointer;">
                            <img src="<?php echo $producto["cover"]; ?>" class="card-img-top" width="100" height="250" alt="...">
                            <div class="card-body">
                              <h5 class="card-title"><?php echo $producto["name"]; ?></h5>
                              <p class="card-text"><?php echo $producto["description"]; ?></p>
                            </div>
                              <div class="row d-flex flex-row justify-content-between p-3">
                                <hr>
                                <div class="col-6">
                                  <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-warning w-100" onclick='action("edit")'><strong>Editar</strong></a>
                                </div>
                                <div class="col-6">
                                  <a href="#" class="btn btn-danger w-100" onclick="remove(this)"><strong>Eliminar</strong></a>
                                </div>
                                <div class="col"><a href="detalles.php"  class="btn btn-info mt-2 w-100"><strong>Detalles</strong></a></div>
                              </div>
                        </div>
                      </div>
                  <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../app/ProductController.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row flex-column d-flex justify-content-center align-items-center">
            <div class="col">
                <div class="form-group">
                    <label for="name" class="form-label">Nombre del producto</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nombre del producto">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug">
                </div>
                
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="description" class="form-label">Descripción</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Descripción">
                </div>
                
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="features" class="form-label">Features</label>
                    <input type="text" class="form-control" id="features" name="features" placeholder="Features">
                </div>
                
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="brand_id" class="form-label">Brand</label>
                    <select class='form-control' name="brand_id" id="brand_id">
                      <option disabled selected value="">Seleccione un brand</option>
                      <?php foreach($brands as $brand): ?>
                        <option value="<?= $brand['id']?>"><?= $brand['name'] ?></option>
                      <?php endforeach;?>
                    </select>
                </div>
                
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="cover" class="form-label">Cover</label>
                    <input type="file" class="form-control" id="cover" name="cover" accept="image/*" data-max-size="1507459">
                </div>
                
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="action" value="create">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include "../layout/scripts.template.php"; ?>

<script>
  function action(action){
    switch(action){
      case 'add':
        document.getElementById('modalTitle').innerText = 'Agregar producto';
        break;
      case 'edit':
        document.getElementById('modalTitle').innerText = 'Editar producto';
        break;
    }
  } 
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