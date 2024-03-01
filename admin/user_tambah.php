<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Usuario
      <small>Añadir nuevo usuario</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6 col-lg-offset-3">       
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Añadir nuevo usuario</h3>
            <a href="user.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Devolver</a> 
          </div>
          <div class="box-body">
            <form action="user_act.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>NOMBRE</label>
                <input type="text" class="form-control" name="nama" required="required" placeholder="Ingrese su nombre ..">
              </div>
              <div class="form-group">
                <label>Nombre de usuario</label>
                <input type="text" class="form-control" name="username" required="required" placeholder="Introduzca su nombre de usuario ..">
              </div>
              <div class="form-group">
                <label>Contraseñas</label>
                <input type="password" class="form-control" name="password" required="required" min="5" placeholder="Introducir la contraseña ..">
              </div>
               <div class="form-group">
                <label>Level</label>
                <select class="form-control" name="level" required="required">
                  <option value=""> - Seleccionar niveles - </option>
                  <option value="administrator"> Administrator </option>
                  <option value="manajemen"> Manajemen </option>
                </select>
              </div>
              <div class="form-group">
                <label>Foto</label>
                <input type="file" name="foto">
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-sm btn-primary" value="Guardar">
              </div>
            </form>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>