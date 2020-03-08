<?php 
//  berfungsi untuk melayani segala query CRUD database
class M_data extends CI_Model{
  // function untuk mengambil keseluruhan baris data dari tabel user
	function tampil_data(){
		return $this->db->get('user');
    }
    // function untuk nginputkan atau insert data ke dalam tabel
    function input_data($data,$table){
		$this->db->insert($table,$data);
    }
    // method untuk melakukan delete dalam sebuah tabel
    function hapus_data($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
    // method untuk melakukan edit data ke dalam database
    function edit_data($where,$table){		
        return $this->db->get_where($table,$where);
    }
    // method untuk mengupdate data ke dalam database 
    function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}	
}