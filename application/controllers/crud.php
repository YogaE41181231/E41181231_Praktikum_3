<?php 
//  berikut adalah sebuah controller yang mengatur segala hal tentang CRUD pada database
class Crud extends CI_Controller{
//  ini adalah fucntion yang akan dijalankan pertama kali paada saat di akses dan secara otomatis
	function __construct(){
    parent::__construct();	
    	// ini adalah function untuk memuat model bernama m_data
    $this->load->model('m_data');
    // 
                $this->load->helper('url');
	}
//  method yang akan diakses saat controller ini diakses
	function index(){
    // ini adalah variabel array $data yang memiliki index user, berguna untuk menyimpan data 
    $data['user'] = $this->m_data->tampil_data()->result();
    // ini adalah baris kode yang berfungsi menampilkan v_tampil dan membawa data dari tabel user
		$this->load->view('v_tampil',$data);
    }
    // method untuk mengarahkan pengguna ke v_input yang berisi form input data baru
    function tambah(){
      // function untuk menampilkan v_input
		$this->load->view('v_input');
    }
    // function yang dijalankan pada saat tombol submit dalam v_input di klik, berfungsi untuk merekam data dari view  dan menyimpan ke database
    function tambah_aksi(){
      // ini adalah baris kode yang berfungsi merekam data yang diinput oleh pengguna
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$pekerjaan = $this->input->post('pekerjaan');
      // array yang berguna untuk mennjadikanva variabel diatas menjadi 1 variabel yang nantinya akan di sertakan dalam query insert
		$data = array(
			'nama' => $nama,
			'alamat' => $alamat,
			'pekerjaan' => $pekerjaan
      );
      // method yang berfungsi melakukan insert ke dalam database yang mengirim 2 parameter yaitu sebuah array data dan nama tabel yang dimaksud
		$this->m_data->input_data($data,'user');
    // kode yang berfungsi mengarahkan pengguna ke link base_url()crud/index/ 
    redirect('crud/index');
    }
    
    // method ini berfungsi untuk menghapus data dari database, dan memerlukan 1 parameter yaitu $id yang berasal dari id user
    function hapus($id){
      // baaris kode ini berisi fungsi untuk menyimpan id user kedalam array $where pada index array bernama 'id'
    $where = array('id' => $id);
    // kode di bawah ini untuk menjalankan query hapus yang berasal dari method hapus_data() pada model m_data
		$this->m_data->hapus_data($where,'user');
    // kode yang berfungsi mengarakan pengguna ke link base_url()crud/index/
    redirect('crud/index');
    }

    // function edit ini berfungsi unutk mengarahkan user ke view_edit yang merupakan form input edit untuk melakukan update data ke dalam database
    function edit($id){
        // kode yang berfungsi untuk menyimpan id user ke dalam array $where pada index array benama id
        $where = array('id' => $id);
        // kode di bawah ini adalah kode yang mengambil data user berdasarkan id dan disimpan kedalam array $data dengan index bernama user
        $data['user'] = $this->m_data->edit_data($where,'user')->result();
        // kode ini memuat vie edit dan membawa data hasil query diatas
        $this->load->view('v_edit',$data);
    }

    // baris kode function update adalah method yang diajalankan ketika tombol submit pada form v_edit ditekan, method ini berfungsi untuk merekam data, memperbarui baris database yang dimaksud, lalu mengarahkan pengguna ke controller crud method index
    function update(){
      // keempat baris kode ini berfungsi untuk merekam data yang dikirim melalui method post
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $pekerjaan = $this->input->post('pekerjaan');
     
        // brikut ini adalah array yang berguna untuk menjadikan variabel diatas menjadi 1 variabel yang nantinya akan disertakan ke dalam query update pada model
        $data = array(
            'nama' => $nama,
            'alamat' => $alamat,
            'pekerjaan' => $pekerjaan
        );
     
        // kode yang berfungsi menyimpan id user ke dalam array $where pada index array bernama id
        $where = array(
            'id' => $id
        );
     
        // kode untuk melakukan query update dengan menjalankan method update_data() 
        $this->m_data->update_data($where,$data,'user');
        // baris kode yang mengerahkan pengguna ke link base_url()crud/index/
        redirect('crud/index');
    }

}