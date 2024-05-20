<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		body{
			font-family: sans-serif;
		}

		.table{
			border-collapse: collapse;
		}
		.table th,
		.table td{
			padding: 5px 10px;
			border: 1px solid black;
		}
	</style>
</head>
<body>

	<?php 
	session_start();
	include 'koneksi.php';
	?>

	

	<div>

		<?php 
		$id_invoice = $_GET['id'];
		$id = $_SESSION['customer_id'];
		$invoice = mysqli_query($koneksi,"select * from invoice where invoice_customer='$id' and invoice_id='$id_invoice' order by invoice_id desc");
		while($i = mysqli_fetch_array($invoice)){
			?>


			<div>

			<center>
    <h3>E-Gallery Proyek Siswa</h3>
</center>

<h4>INVOICE-00<?php echo $i['invoice_id']; ?></h4>

<br/>
Nama Customer : <?php echo $i['invoice_nama']; ?><br/>
Alamat Tujuan : <?php echo $i['invoice_alamat']; ?><br/>
Provinsi : <?php echo $i['invoice_provinsi']; ?><br/>
Kota/Kabupaten : <?php echo $i['invoice_kabupaten']; ?><br/>
No Hp Customer : <?php echo $i['invoice_hp']; ?><br/>
<br/>
<br/>

<table class="table">
    <thead>
        <tr>
            <th class="text-center" width="1%">NO</th>
            <th colspan="2">Produk</th>
            <th class="text-center">Kategori</th>
            <th class="text-center">Harga</th>
            <th class="text-center">Jumlah</th>
            <th class="text-center">Total Harga</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1;
        $total = 0;
        $transaksi = mysqli_query($koneksi, "SELECT transaksi.*, produk.produk_nama, produk.produk_foto1, kategori.kategori_nama 
                                             FROM transaksi 
                                             INNER JOIN produk ON transaksi.transaksi_produk = produk.produk_id 
                                             INNER JOIN kategori ON produk.produk_kategori = kategori.kategori_id 
                                             WHERE transaksi.transaksi_invoice='$id_invoice'");
        while($d = mysqli_fetch_array($transaksi)){
            $total += $d['transaksi_harga'];
            ?>
            <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td>
                    <center>
                        <?php if($d['produk_foto1'] == "") { ?>
                            <img src="gambar/sistem/produk.png" style="width: 50px; height: auto;">
                        <?php } else { ?>
                            <img src="gambar/produk/<?php echo $d['produk_foto1']; ?>" style="width: 50px; height: auto;">
                        <?php } ?>
                    </center>
                </td>
                <td><?php echo $d['produk_nama']; ?></td>
				<td><?php echo $d['kategori_nama']; ?></td>
                <td class="text-center"><?php echo "Rp. " . number_format($d['transaksi_harga']) . ",-"; ?></td>
                <td class="text-center"><?php echo number_format($d['transaksi_jumlah']); ?></td>
                <td class="text-center"><?php echo "Rp. " . number_format($d['transaksi_jumlah'] * $d['transaksi_harga']) . " ,-"; ?></td>
            </tr>
            <?php 
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" style="border: none"></td>
            <th>Berat</th>
            <td class="text-center"><?php echo number_format($i['invoice_berat']); ?> gram</td>
        </tr>
        <tr>
            <td colspan="5" style="border: none"></td>
            <th>Total Belanja</th>
            <td class="text-center"><?php echo "Rp. " . number_format($total) . " ,-"; ?></td>
        </tr>
        <tr>
            <td colspan="5" style="border: none"></td>
            <th>Ongkir (<?php echo $i['invoice_kurir']; ?>)</th>
            <td class="text-center"><?php echo "Rp. " . number_format($i['invoice_ongkir']) . " ,-"; ?></td>
        </tr>
        <tr>
            <td colspan="5" style="border: none"></td>
            <th>Total Bayar</th>
            <td class="text-center"><?php echo "Rp. " . number_format($i['invoice_total_bayar']) . " ,-"; ?></td>
        </tr>
    </tfoot>
</table>



				<h5>STATUS :</h5> 
				<?php 
				if($i['invoice_status'] == 0){
					echo "<span class='label label-warning'>Menunggu Pembayaran</span>";
				}elseif($i['invoice_status'] == 1){
					echo "<span class='label label-default'>Menunggu Konfirmasi</span>";
				}elseif($i['invoice_status'] == 2){
					echo "<span class='label label-danger'>Ditolak</span>";
				}elseif($i['invoice_status'] == 3){
					echo "<span class='label label-primary'>Dikonfirmasi & Sedang Diproses</span>";
				}elseif($i['invoice_status'] == 4){
					echo "<span class='label label-warning'>Dikirim</span>";
				}elseif($i['invoice_status'] == 5){
					echo "<span class='label label-success'>Selesai</span>";
				}
				?>

			</div>	


			<?php 
		}
		?>
	</div>


	<script>
		window.print();
	</script>
</body>
</html>