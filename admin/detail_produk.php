<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Kategori
      <small>Data Kategori</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-8">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Kategori</h3>
            <a href="kategori.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>NAMA PRODUK</th>
                    <th>KATEGORI</th>
                    <th>HARGA</th>
                    <th width="15%">FOTO</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM produk,kategori where kategori_id=produk_kategori order by produk_id desc");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['produk_nama']; ?></td>
                      <td><?php echo $d['kategori_nama']; ?></td>
                      <td><?php echo "Rp. ".number_format($d['produk_harga']).",-"; ?></td>
                      <td>
                        <center>
                          <?php if($d['produk_foto1'] == ""){ ?>
                            <img src="../gambar/sistem/produk.png" style="width: 80px;height: auto">
                          <?php }else{ ?>
                            <img src="../gambar/produk/<?php echo $d['produk_foto1'] ?>" style="width: 80px;height: auto">
                          <?php } ?>
                        </center>

                        <center>
                          <?php if($d['produk_foto2'] == ""){ ?>
                            <img src="../gambar/sistem/produk.png" style="width: 80px;height: auto">
                          <?php }else{ ?>
                            <img src="../gambar/produk/<?php echo $d['produk_foto2'] ?>" style="width: 80px;height: auto">
                          <?php } ?>
                        </center>

                        <center>
                          <?php if($d['produk_foto3'] == ""){ ?>
                            <img src="../gambar/sistem/produk.png" style="width: 80px;height: auto">
                          <?php }else{ ?>
                            <img src="../gambar/produk/<?php echo $d['produk_foto3'] ?>" style="width: 80px;height: auto">
                          <?php } ?>
                        </center>
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