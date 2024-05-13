<?php include 'header.php'; ?>


<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Ganti Password Customer</li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->

<div class="section">
	<div class="container">
		<div class="row">
			
			<?php 
			include 'customer_sidebar.php'; 
			?>

			<div id="main" class="col-md-9">
				
				<h4>GANTI PASSWORD</h4>

				<div id="store">
					<div class="row">

						<div class="col-lg-12">
							<?php 
							if(isset($_GET['alert'])){
								if($_GET['alert'] == "sukses"){
									echo "<div class='alert alert-success'>Password anda berhasil diganti!</div>";
								}
							}
							?>

							<form action="customer_password_act.php" method="post">
							<div class="form-group">
        <label for="">Password Lama Anda</label>
        <?php
        // Menghubungkan dengan koneksi
        include 'koneksi.php';

        $id = $_SESSION['customer_id'];
        
        // Mendapatkan password lama dari database
        $result = mysqli_query($koneksi, "SELECT customer_password FROM customer WHERE customer_id='$id'");
        $row = mysqli_fetch_assoc($result);
        $old_password = $row['customer_password'];
        ?>
 <div class="password-wrapper">
        <input type="password" class="input password-input" readonly="readonly" value="<?php echo $old_password; ?>">
        <span class="toggle-password">
            <i class="fa fa-eye-slash" aria-hidden="true"></i>
        </span>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('.toggle-password');
        const passwordInput = document.querySelector('.password-input');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            this.querySelector('i').classList.toggle('fa-eye-slash');
            this.querySelector('i').classList.toggle('fa-eye');
        });
    });
</script>
								<div class="form-group">
									<label for="">Masukkan Password Baru</label>
									<input type="password" class="input" required="required" name="password" placeholder="Masukkan password .." min="5">
								</div>
								<div class="form-group">
									<label for="">Konfirmasi Password Baru</label>
									<input type="password" class="input" required="required" name="password" placeholder="Masukkan password .." min="5">
								</div>

								<div class="form-group">
									<input type="submit" class="primary-btn" value="Ganti Password">
								</div>
							</form>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>