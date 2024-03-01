<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Ingreso
      <small>Dato de Ingreso</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Datos de Ingreso</h3>
            <div class="btn-group pull-right">            

              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Agregar Ingreso
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="bank_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Agregar Ingreso</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Nombre de Ingreso</label>
                        <input type="text" name="nama" required="required" class="form-control" placeholder="Nombre Ingreso..">
                      </div>

                      <div class="form-group">
                        <label>Nombre del propietario del ingreso</label>
                        <input type="text" name="pemilik" class="form-control" placeholder="Nombre del propietario del Ingreso ..">
                      </div>

                      <div class="form-group">
                        <label>Número del Ingreso</label>
                        <input type="text" name="nomor" class="form-control" placeholder="número de ingreso ..">
                      </div>

                      <div class="form-group">
                        <label>Saldo inicial</label>
                        <input type="number" name="saldo" required="required" class="form-control" placeholder="saldo Ingreso ..">
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>


            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">N.</th>
                    <th>NOMBRE INGRESO</th>
                    <th>PROPIETARIO DEL INGRESO</th>
                    <th>NÚMERO DE INGRESO</th>
                    <th>SALDO</th>
                    <th width="10%">OPCION</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM bank");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['bank_nama']; ?></td>
                      <td><?php echo $d['bank_pemilik']; ?></td>
                      <td><?php echo $d['bank_nomor']; ?></td>
                      <td><?php echo "S/. ".number_format($d['bank_saldo'])." "; ?></td>
                      <td>    
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_bank_<?php echo $d['bank_id'] ?>">
                          <i class="fa fa-cog"></i>
                        </button>

                        <?php 
                        if($d['bank_id'] != 1){
                          ?>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_bank_<?php echo $d['bank_id'] ?>">
                            <i class="fa fa-trash"></i>
                          </button>
                          <?php
                        }
                        ?>

                        <form action="bank_update.php" method="post">
                          <div class="modal fade" id="edit_bank_<?php echo $d['bank_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="exampleModalLabel">Editar Ingreso</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">

                                  <div class="form-group" style="margin-bottom:15px;width: 100%">
                                    <label>Nombre de ingreso</label>
                                    <input type="hidden" name="id" required="required" class="form-control" placeholder="Nama bank .." value="<?php echo $d['bank_id']; ?>">
                                    <input type="text" name="nama" style="width:100%" required="required" class="form-control" placeholder="Escribe aqui.." value="<?php echo $d['bank_nama']; ?>">
                                  </div>

                                  <div class="form-group" style="margin-bottom:15px;width: 100%">
                                    <label>Nombre del propietario del ingreso</label>
                                    <input type="text" name="pemilik" style="width:100%" class="form-control" placeholder="Escribe aqui .." value="<?php echo $d['bank_pemilik']; ?>">
                                  </div>

                                  <div class="form-group" style="margin-bottom:15px;width: 100%">
                                    <label>Numero de ingreso</label>
                                    <input type="text" name="nomor" style="width:100%" class="form-control" placeholder="Escribe aqui .." value="<?php echo $d['bank_nomor']; ?>">
                                  </div>

                                  <div class="form-group" style="margin-bottom:15px;width: 100%">
                                    <label>Saldo inicial</label>
                                    <input type="number" name="saldo" style="width:100%" required="required" class="form-control" placeholder="Escribe aqui .." value="<?php echo $d['bank_saldo']; ?>">
                                  </div>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                  <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>

                        <!-- modal hapus -->
                        <div class="modal fade" id="hapus_bank_<?php echo $d['bank_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">¡Advertencia!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">

                                <p>¿Estás seguro de que deseas eliminar estos datos?</p>
                                <p>Todos los datos relacionados con ingreso de dinero se trasladarán a un ingreso predeterminada.</p>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <a href="bank_hapus.php?id=<?php echo $d['bank_id'] ?>" class="btn btn-primary">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>

                      </td>
                    </tr>
                    <?php 
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>