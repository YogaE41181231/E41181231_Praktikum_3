<?php 
 // class Login sebagai controller yang berfungsi untuk mengurus segala hal tentang Login, mulai dari cek ketersediaan akun, session, logout dsb.
class Login extends CI_Controller{
 
	// fungsi yang akan dijalankan pertama kali dan dijalankan otomatis
	function __construct(){
		parent::__construct();
		//berikut adalah baris kode yang digunakan untuk memuat model bernama m_data
		$this->load->model('m_login');
 
	}
	// berikut adalah method yang akan diakses saat controller ini diakses walaupun tanpa menyertakan method
	function index(){
		// berikut adalah baris kode yang berfungsi untuk menampilkan v_login
		$this->load->view('v_login');
	}
 
	// berikut adalah method yang dijalankan ketika kita melakukan login
	function aksi_login(){
		// berikut kode untuk merekam data yang dikirim melalui post
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		// berikut menyimpan data pada array untuk nantinya diproses ke dalam model
		$where = array(
			'username' => $username,
			'password' => md5($password)
			);
		// berikut menjalankan method cek_login pada model m_login
		$cek = $this->m_login->cek_login("admin",$where)->num_rows();
		if($cek > 0){

			//  membuat session dengan index 'nama' yang berisi username dan 'status' berisi login
			$data_session = array(
				'nama' => $username,
				'status' => "login"
				);
			// menambahkan sebuah session userdata berisi array diatas
			$this->session->set_userdata($data_session);
 
			redirect(base_url("admin"));
 
		}else{
			echo "Username dan password salah !";
		}
	}

	// method yang akan dilakukan ketika tombol link logout ditekan
	function logout(){
		//  baris kode yang akan menghapus session yang ada
		$this->session->sess_destroy();
		//  baris kode yang mengarahkan pengguna ke controller login
		redirect(base_url('login'));
	}
}