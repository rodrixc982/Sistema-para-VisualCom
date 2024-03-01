<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Cobranza
      <small>Datos de cuentas por cobrar</small>
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
            <h3 class="box-title">Notas de cuentas por cobrar</h3>
            <div class="btn-group pull-right">            

              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Agregar cuentas por cobrar
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="piutang_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="exampleModalLabel">Agregar cuentas por cobrar</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Fecha</label>
                        <input type="text" name="tanggal" required="required" class="form-control datepicker2">
                      </div>

                      <div class="form-group">
                        <label>Cantidad</label>
                        <input type="number" name="nominal" required="required" class="form-control" placeholder="Introduce la Cantidad ..">
                      </div>

                      <div class="form-group">
                        <label>Información</label>
                        <textarea name="keterangan" class="form-control" rows="4"></textarea>
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
                    <th width="1%">CODIGO</th>
                    <th width="10%" class="text-center">FECHA</th>
                    <th class="text-center">INFORMACIÓN</th>
                    <th class="text-center">CANTIDAD</th>
                    <th width="10%" class="text-center">OPCION</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM piutang");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td>PTG-000<?php echo $d['piutang_id']; ?></td>
                      <td class="text-center"><?php echo date('d-m-Y', strtotime($d['piutang_tanggal'])); ?></td>
                      <td><?php echo $d['piutang_keterangan']; ?></td>
                      <td class="text-center"><?php echo "S/. ".number_format($d['piutang_nominal'])." ,-"; ?></td>
                      <td>    

                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_piutang_<?php echo $d['piutang_id'] ?>">
                        <i class="fa fa-cog"></i>
                      </button>

                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_piutang_<?php echo $d['piutang_id'] ?>">
                        <i class="fa fa-trash"></i>
                      </button>


                      <form action="piutang_update.php" method="post">
                        <div class="modal fade" id="edit_piutang_<?php echo $d['piutang_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Editar cuentas por cobrar</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">

                                <div class="form-group" style="width:100%;margin-bottom:20px">
                                  <label>Fecha</label>
                                  <input type="hidden" name="id" value="<?php echo $d['piutang_id'] ?>">
                                  <input type="text" style="width:100%" name="tanggal" required="required" class="form-control datepicker2" value="<?php echo $d['piutang_tanggal'] ?>">
                                </div>

                                <div class="form-group" style="width:100%;margin-bottom:20px">
                                  <label>Cantidad</label>
                                  <input type="number" style="width:100%" name="nominal" required="required" class="form-control" placeholder="Introduce la cantidad.." value="<?php echo $d['piutang_nominal'] ?>">
                                </div>

                                <div class="form-group" style="width:100%">
                                  <label>Información</label>
                                  <textarea name="keterangan" style="width:100%" class="form-control" rows="4"><?php echo $d['piutang_keterangan'] ?></textarea>
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
                      <div class="modal fade" id="hapus_piutang_<?php echo $d['piutang_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="exampleModalLabel">¡Advertencia!</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">

                              <p>¿Estás seguro de que deseas eliminar estos datos?</p>

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                              <a href="piutang_hapus.php?id=<?php echo $d['piutang_id'] ?>" class="btn btn-primary">Eliminar</a>
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
<?php include 'footer.php'; ?>s