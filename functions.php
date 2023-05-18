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
	$url = ltrim($url,'/');
	header('location:' . BASE_URL . '/' . $url);
	die;
}

function guest_move_to_login()
{
	if (! isset($_SESSION['user'])) {
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