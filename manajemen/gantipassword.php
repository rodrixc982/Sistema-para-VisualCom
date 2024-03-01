<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Cambiar la contraseña
      <small>Cambiar la contraseña</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-5">

        <?php 
        if(isset($_GET['alert'])){
          if($_GET['alert'] == "sukses"){
            echo "<div class='alert alert-success'>Password anda berhasil diganti!</div>";
          }
        }
        ?>

        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Cambiar la contraseña</h3>
          </div>
          <div class="box-body">
            <form action="gantipassword_act.php" method="post">
              <div class="form-group">
                <label>Ingrese nueva clave</label>
                <input type="password" class="form-control" placeholder="Ingrese nueva clave.." name="password" required="required" min="5">
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