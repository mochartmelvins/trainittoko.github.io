<?php 
$koneksi = new mysqli("localhost","root","","trainittoko"); 
?>	
<!DOCTYPE html>
<html>
	<head>
		<title>nota pembelian</title>
		<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	</head>
	<body>
		
		<nav class="navbar navbar-default">
			<div class="container">
			
			
			<ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="keranjang.php">Keranjang</a></li>
				<!-- jk sudah login(ada session pelanggan) -->
				<?php if(isset($_SESSION["pelanggan"])): ?>
				<li><a href="logout.php">Logout</a></li>
				<!-- selainitu(blm login||bllm ada session pelanggan) -->
				<?php else: ?>
				<li><a href="login.php">Login</a></li>
				<?php endif ?>
				
				<li><a href="checkout.php">Checkout</a></li>
				</ul>
			</div>
		</nav>
		
		<section class="konten">
			<div class="container">
				
				
				<!-- nota disini copas saja dari nota yang ada di admin -->
				<h2>Detail Pembelian</h2>
<?php
$koneksi = new mysqli("localhost","root","","trainittoko"); 
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_planggan WHERE pembelian.id_pembelian='$_GET[id]'");
if ($ambil) {
	while ($detail = $ambil->fetch_assoc()) {
		print_r($detail);
		echo "<strong>".$detail['nama_pelanggan']."</strong> <br>";
	echo $detail['telfon_pelanggan'];
	echo $detail['email_pelanggan'];

		echo "tanggal:".$detail['tanggal_pembelian'];
	echo "total: ". $detail['total_pembelian'];

	}
}

?>



<table class="table table-bordered">
	<thead>
		<tr>
			<th>no</th>
			<th>nama</th>
			<th>harga</th>
			<th>jumlah</th>
			<th>subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON
		pembelian_produk.id_produk=produk,id_produk
		WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
		<?php if ($ambil) { ?>
		<?php while ($pecah=$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_produk']; ?></td>
			<td><?php echo $pecah['harga_produk']; ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td>
			<?php echo $pecah['harga_produk']*$pecah['jumlah']; ?>
			</td>
		</tr>
		<?php }?>
		<?php }?>
	</tbody>
</table>
				<div class="row">
	<div class="col-md-7">
		<div class="alert alert-info">
			<p>
				Silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?> ke <br>
				<strong>BANK BNI 0727143670 AN. Mochart Melvin Sakryan</strong>
			</p>
		</div>
	</div>
</div>
		
		
			</div>
		</section>
	</body>
</html>
		
		