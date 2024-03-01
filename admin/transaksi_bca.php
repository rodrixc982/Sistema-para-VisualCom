<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Transacción
      <small>Datos de la transacción</small>
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
            <h3 class="box-title">Cuenta Tianz</h3>
            <div class="btn-group pull-right">

              <p><b>Total Saldo:</b> <?php
                                      include '../koneksi.php';
                                      $no = 1;
                                      $data = mysqli_query($koneksi, "SELECT * FROM bank where bank_id = 2");
                                      while ($d = mysqli_fetch_array($data)) {
                                      ?>
                  <?php echo "S/. " . number_format($d['bank_saldo']) . " "; ?> <?php
                                                                                }
                                                                                  ?></p>

            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="transaksi_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="exampleModalLabel">Agregar transacción</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" name="tanggal" required="required" class="form-control datepicker2">
                      </div>

                      <div class="form-group">
                        <label>Tipo</label>
                        <select name="jenis" class="form-control" required="required">
                          <option value="">- Pilih -</option>
                          <option value="Pemasukan">Ingreso</option>
                          <option value="Pengeluaran">Gasto</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control" required="required">
                          <option value="">- Elegir -</option>
                          <?php
                          $kategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY kategori ASC");
                          while ($k = mysqli_fetch_array($kategori)) {
                          ?>
                            <option value="<?php echo $k['kategori_id']; ?>"><?php echo $k['kategori']; ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Valor</label>
                        <input type="number" name="nominal" required="required" class="form-control" placeholder="Introduce la cantidad ..">
                      </div>

                      <div class="form-group">
                        <label>Informacion</label>
                        <textarea name="keterangan" class="form-control" rows="3"></textarea>
                      </div>

                      <div class="form-group">
                        <label>Cuenta </label>
                        <select name="bank" class="form-control" required="required">
                          <option value="">- Elegir -</option>
                          <?php
                          $bank = mysqli_query($koneksi, "SELECT * FROM bank");
                          while ($b = mysqli_fetch_array($bank)) {
                          ?>
                            <option value="<?php echo $b['bank_id']; ?>"><?php echo $b['bank_nama']; ?></option>
                          <?php
                          }
                          ?>
                        </select>
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
                    <th width="1%" rowspan="2">N.</th>
                    <th width="10%" rowspan="2" class="text-center">FECHA</th>
                    <th rowspan="2" class="text-center">CATEGORIA</th>
                    <!-- <th rowspan="2" class="text-center">KETERANGAN</th> -->
                    <th colspan="2" class="text-center">TIPO</th>
                    <!-- <th rowspan="2" class="text-center">BANK</th> -->
                    <!-- <th rowspan="2" width="10%" class="text-center">OPSI</th> -->
                  </tr>
                  <tr>
                    <th class="text-center">INGRESO</th>
                    <th class="text-center">GASTO</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../koneksi.php';
                  $no = 1;
                  $data = mysqli_query($koneksi, "SELECT * FROM transaksi, kategori WHERE kategori_id = transaksi_kategori AND transaksi_bank = 2 ORDER BY transaksi_id DESC");
                  while ($d = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo date('d-m-Y', strtotime($d['transaksi_tanggal'])); ?></td>
                      <td><?php echo $d['kategori']; ?></td>
                      <!-- <td><?php echo $d['transaksi_keterangan']; ?></td> -->
                      <td class="text-center">
                        <?php
                        if ($d['transaksi_jenis'] == "Pemasukan") {
                          echo "S/. " . number_format($d['transaksi_nominal']) . " ";
                        } else {
                          echo "-";
                        }
                        ?>
                      </td>
                      <td class="text-center">
                        <?php
                        if ($d['transaksi_jenis'] == "Pengeluaran") {
                          echo "S/. " . number_format($d['transaksi_nominal']) . " ";
                        } else {
                          echo "-";
                        }
                        ?>
                      </td>
                      <!-- <td><?php echo $d['transaksi_bank']; ?></td> -->

                      <!-- <td class="text-center">
                        <?php
                        if ($d['transaksi_jenis'] == "Pengeluaran") {
                          echo "S/. " . number_format($d['transaksi_nominal']) . " ";
                        } else {
                          echo "-";
                        }
                        ?>
                      </td> -->
                      <td>
                        <!-- <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_transaksi_<?php echo $d['transaksi_id'] ?>">
                          <i class="fa fa-cog"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_transaksi_<?php echo $d['transaksi_id'] ?>">
                          <i class="fa fa-trash"></i>
                        </button> -->


                        <form action="transaksi_update.php" method="post">
                          <div class="modal fade" id="edit_transaksi_<?php echo $d['transaksi_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="exampleModalLabel">Editar transacciones</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Fecha</label>
                                    <input type="hidden" name="id" value="<?php echo $d['transaksi_id'] ?>">
                                    <input type="text" style="width:100%" name="tanggal" required="required" class="form-control datepicker2" value="<?php echo $d['transaksi_tanggal'] ?>">
                                  </div>

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Tipo</label>
                                    <select name="jenis" style="width:100%" class="form-control" required="required">
                                      <option value="">- Pilih -</option>
                                      <option <?php if ($d['transaksi_jenis'] == "Pemasukan") {
                                                echo "selected='selected'";
                                              } ?> value="Pemasukan">Pemasukan</option>
                                      <option <?php if ($d['transaksi_jenis'] == "Pengeluaran") {
                                                echo "selected='selected'";
                                              } ?> value="Pengeluaran">Pengeluaran</option>
                                    </select>
                                  </div>

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Categoria</label>
                                    <select name="kategori" style="width:100%" class="form-control" required="required">
                                      <option value="">- Elegir -</option>
                                      <?php
                                      $kategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY kategori ASC");
                                      while ($k = mysqli_fetch_array($kategori)) {
                                      ?>
                                        <option <?php if ($d['transaksi_kategori'] == $k['kategori_id']) {
                                                  echo "selected='selected'";
                                                } ?> value="<?php echo $k['kategori_id']; ?>"><?php echo $k['kategori']; ?></option>
                                      <?php
                                      }
                                      ?>
                                    </select>
                                  </div>

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Valor</label>
                                    <input type="number" style="width:100%" name="nominal" required="required" class="form-control" placeholder="Introduce la cantidad.." value="<?php echo $d['transaksi_nominal'] ?>">
                                  </div>

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Informacion</label>
                                    <textarea name="keterangan" style="width:100%" class="form-control" rows="4"><?php echo $d['transaksi_keterangan'] ?></textarea>
                                  </div>

                                  <div class="form-group" style="width:100%;margin-bottom:20px">
                                    <label>Cuenta</label>
                                    <select name="bank" class="form-control" required="required" style="width:100%">
                                      <option value="">- Pilih -</option>
                                      <?php
                                      $bank = mysqli_query($koneksi, "SELECT * FROM bank");
                                      while ($b = mysqli_fetch_array($bank)) {
                                      ?>
                                        <option <?php if ($d['transaksi_bank'] == $b['bank_id']) {
                                                  echo "selected='selected'";
                                                } ?> value="<?php echo $b['bank_id']; ?>"><?php echo $b['bank_nama']; ?></option>
                                      <?php
                                      }
                                      ?>
                                    </select>
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
                        <div class="modal fade" id="hapus_transaksi_<?php echo $d['transaksi_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <a href="transaksi_hapus.php?id=<?php echo $d['transaksi_id'] ?>" class="btn btn-primary">Eliminar</a>
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