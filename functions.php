<?php

// koneksi ke database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}


function redirect($url)
{
	$url = ltrim($url, '/');
	header('location:' . BASE_URL . '/' . $url);
	die;
}

function guest_move_to_login()
{
	if (!isset($_SESSION['user'])) {
		redirect('login.php');
	}
}

function admin_move_to_dashboard()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') {
		return redirect('admin/dashboard.php');
	}
}

function get_login_account()
{
	return $_SESSION['user'] ?? null;
}

function get_tingkat_lomba_option()
{
	return [
		'kota/kabupaten', 'provinsi', 'nasional', 'regional', 'internasional', 'lainnya'
	];
}

function get_jenis_lomba_option()
{
	return [
		'1' => 'Lomba Guru',
		'2' => 'Lomba Siswa'
	];
}

function login($username, $password)
{
	global $conn;
	$username = mysqli_real_escape_string($conn, $username);
	$password = mysqli_real_escape_string($conn, $password);

	$admin = query("SELECT * FROM tb_admin WHERE ausername = '$username' AND apassword = '$password'")[0] ?? null;

	if ($admin != null) {
		$_SESSION['user'] = [
			'uid' => $admin['aid'],
			'username' => $admin['ausername'],
			'jabatan' => $admin['ajabatan'],
			'nama' => $admin['anama'],
			'role' => 'admin'
		];

		return $_SESSION['user'];
	}

	return null;
}

function dd($var)
{
	var_dump($var);
	die;
}

function reopen_page()
{
	header('location: ' . $_SERVER['REQUEST_URI']);
	die;
}

function set_flash($bs_class, $message)
{
	$_SESSION['flash'] = [
		'message' => $message,
		'bs_class' => $bs_class
	];
}

function flash()
{
	if (isset($_SESSION['flash'])) {
		$flash_message = $_SESSION['flash']['message'];
		$bs_class = $_SESSION['flash']['bs_class'];
		echo "
			<div class='alert alert-$bs_class'>
				$flash_message
			</div>
		";
		unset($_SESSION['flash']);
	}
}

function getCountData($tabel)
{
	$data = query("SELECT COUNT(*) as jmlData FROM $tabel")[0] ?? null;

	return $data['jmlData'];
}

function upload($name)
{

	$fileName = $_FILES["$name"]['name'];
	$fileSize = $_FILES["$name"]['size'];
	$error = $_FILES["$name"]['error'];
	$tmpName = $_FILES["$name"]['tmp_name'];

	// if there's no image, use default image
	if ($error === 4) {
		return false;
	}

	$allowedExtension = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'jfif', 'webp', 'pdf'];
	$imageExtension = explode('.', $fileName);
	$imageExtension = strtolower(end($imageExtension));

	if (!in_array($imageExtension, $allowedExtension)) {
		echo "<script>alert('yang anda upload tidak sesuai dengan format')</script>";
		return false;
	}

	if ($fileSize > 50000000) {
		echo "<script>alert('ukuran gambar terlalu besar')</script>";
		return false;
	}

	$newFileName = uniqid();
	$newFileName .= '.';

	$newFileName .= $imageExtension;

	move_uploaded_file($tmpName, "../../document/piagam/" . $newFileName);

	return $newFileName;
}
