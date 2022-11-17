<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelatihan_model extends CI_Model
{
	var $table ='peserta';
	var $column_order = array(null,'nama_peserta', 'alamat', 'no_telpon', 'j_kel');
	var $column_search = array('nama_peserta', 'alamat', 'no_telpon', 'j_kel');
	var $order = array('id_peserta' => 'asc' );

	var $table_Filter ='peserta pe';
	var $column_orderFilter = array(null, 'nama_peserta', 'alamat', 'no_telpon', 'j_kel', 'du.nama_usaha', 'ju.nama_usaha', 'su.nama_sub');
	var $column_searchFilter = array('nama_peserta', 'alamat', 'no_telpon', 'j_kel', 'du.nama_usaha', 'ju.nama_usaha', 'su.nama_sub');
	var $order_Filter = array('pe.id_peserta' => 'asc' );

	var $table_pelatihan ='pendaftaran pen';
	var $column_order_pelatihan = array(null,'nama_kegiatan', 'tgl_pelatihan', 'waktu_pelatihan', 'tempat');
	var $column_search_pelatihan = array('nama_kegiatan', 'tgl_pelatihan', 'waktu_pelatihan', 'tempat');
	var $order_pelatihan = array('pen.id_pendaftaran' => 'asc' );

	var $table_kegiatan ='pelatihan pel';
	var $column_order_kegiatan = array(null,'nama_kegiatan', 'tgl_pelatihan', 'tgl_selesai_p', 'waktu_pelatihan', 'tempat', 'kuota', 'nama_usaha');
	var $column_search_kegiatan = array('nama_kegiatan', 'tgl_pelatihan', 'tgl_selesai_p', 'waktu_pelatihan', 'tempat', 'kuota', 'nama_usaha');
	var $order_kegiatan = array('pel.id_p' => 'asc' );

    // Data Pelatihan
    public function showPelatihan()
    {
        $query = "SELECT *,`peserta`.id_peserta AS idPeserta ,`data_usaha`.`nama_usaha` AS nu_peserta
        FROM `peserta` JOIN `desa`
        ON `peserta`.`id_desa` = `desa`.`id_desa`
        JOIN `kecamatan`
        ON `desa`.`id_kec` = `kecamatan`.`id_kec`
        JOIN `data_usaha`
        ON `peserta`.`id_peserta` = `data_usaha`.`id_peserta`
        JOIN `jenis_usaha`
        ON `data_usaha`.`id_ju` = `jenis_usaha`.`id_ju`
        JOIN `subjenis_usaha`
        ON `data_usaha`.`id_subju` = `subjenis_usaha`.`id_subju`
        ";
        return $this->db->query($query)->result_array();
    }

    public function showDetailPelatihanById($id)
    {
        $query = "SELECT *,`data_usaha`.`nama_usaha` AS nu_peserta
        FROM `peserta` JOIN `desa`
        ON `peserta`.`id_desa` = `desa`.`id_desa`
        JOIN `kecamatan`
        ON `desa`.`id_kec` = `kecamatan`.`id_kec`
        JOIN `data_usaha`
        ON `peserta`.`id_peserta` = `data_usaha`.`id_peserta`
        JOIN `jenis_usaha`
        ON `data_usaha`.`id_ju` = `jenis_usaha`.`id_ju`
        JOIN `subjenis_usaha`
        ON `data_usaha`.`id_subju` = `subjenis_usaha`.`id_subju`
        WHERE `peserta`.`id_peserta` = $id
        ";
        return $this->db->query($query)->result_array();
    }

    public function showPesertaById($id)
    {
        $query = "SELECT *,`data_usaha`.`nama_usaha` AS nu_peserta
        FROM `peserta` JOIN `desa`
        ON `peserta`.`id_desa` = `desa`.`id_desa`
        JOIN `kecamatan`
        ON `desa`.`id_kec` = `kecamatan`.`id_kec`
        JOIN `data_usaha`
        ON `peserta`.`id_peserta` = `data_usaha`.`id_peserta`
        JOIN `jenis_usaha`
        ON `data_usaha`.`id_ju` = `jenis_usaha`.`id_ju`
        JOIN `subjenis_usaha`
        ON `data_usaha`.`id_subju` = `subjenis_usaha`.`id_subju`
        WHERE `peserta`.`id_peserta` = $id
        ";
        return $this->db->query($query)->row_array();
    }

    public function showJenisUsaha()
    {
        $query = "SELECT *
        FROM `subjenis_usaha` JOIN `jenis_usaha`
        ON `subjenis_usaha`.`id_ju` = `jenis_usaha`.`id_ju`
        ";
        return $this->db->query($query)->result_array();
    }

    public function showDetailPelatihan()
    {
        $query = "SELECT *,`data_usaha`.`nama_usaha` AS nu_peserta
        FROM `peserta` JOIN `desa`
        ON `peserta`.`id_desa` = `desa`.`id_desa`
        JOIN `kecamatan`
        ON `desa`.`id_kec` = `kecamatan`.`id_kec`
        JOIN `data_usaha`
        ON `peserta`.`id_peserta` = `data_usaha`.`id_peserta`
        JOIN `jenis_usaha`
        ON `data_usaha`.`id_ju` = `jenis_usaha`.`id_ju`
        JOIN `subjenis_usaha`
        ON `data_usaha`.`id_subju` = `subjenis_usaha`.`id_subju`
        ";
        return $this->db->query($query)->result_array();
    }

    public function deletePelatihanById($id)
    {
        return $this->db->delete('pelatihan', ['id_p' => $id]);
    }

    public function editPelatihanById($id, $data)
    {
        return $this->db->where('id_p', $id)->update('pelatihan', $data);
    }

    // Data Jenis Usaha
    public function deleteJenisUsahaById($id)
    {
        return $this->db->delete('jenis_usaha', ['id_ju' => $id]);
    }

    public function editJenisUsahaById($id, $data)
    {
        return $this->db->where('id_ju', $id)->update('jenis_usaha', $data);
    }

    // Data Sub Jenis Usaha
    public function deleteSubJenisUsahaById($id)
    {
        return $this->db->delete('subjenis_usaha', ['id_subju' => $id]);
    }

    public function editSubJenisUsahaById($id, $data)
    {
        return $this->db->where('id_subju', $id)->update('subjenis_usaha', $data);
    }

    // Data Peserta
    public function deletePesertaById($id)
    {
        return $this->db->delete('peserta', ['id_peserta' => $id]);
    }

    public function editPesertaById($id, $data)
    {
        return $this->db->where('id_peserta', $id)->update('peserta', $data);
    }

    public function editUploadPesertaById($id, $data)
    {
        return $this->db->where('id_peserta', $id)->update('upload_data', $data);
    }

    // Data Usaha
    public function editDataUsahaById($id, $data)
    {
        return $this->db->where('id_usaha', $id)->update('data_usaha', $data);
    }

    // Jangkauan Pasar
    public function editJangkauanPasarById($id, $data)
    {
        return $this->db->where('id_jp', $id)->update('jangkauan_pasar', $data);
    }

    // Data Pelatihan
    public function showSosialMedia()
    {
        $query = "SELECT *
        FROM `sosialmedia` JOIN `peserta`
        ON `sosialmedia`.`id_peserta` = `peserta`.`id_peserta`
        ";
        return $this->db->query($query)->result_array();
    }

    // Sosial Media
    public function deleteSosialMediaById($id)
    {
        return $this->db->delete('sosialmedia', ['id_sm' => $id]);
    }

    public function editSosialMediaById($id, $data)
    {
        return $this->db->where('id_sm', $id)->update('sosialmedia', $data);
    }

    // Pendaftaran Peserta
    public function showPP()
    {
        $query = "SELECT *
        FROM `pendaftaran` JOIN `peserta`
        ON `pendaftaran`.`id_peserta` = `peserta`.`id_peserta`
        JOIN `pelatihan`
        ON `pendaftaran`.`id_pelatihan` = `pelatihan`.`id_p`
        JOIN `data_usaha`
        ON `peserta`.`id_peserta` = `data_usaha`.`id_peserta`
        ";
        return $this->db->query($query)->result_array();
    }

    // Data Pendaftaran
    public function deletePPById($id)
    {
        return $this->db->delete('pendaftaran', ['id_pendaftaran' => $id]);
    }

    public function editPPById($id, $data)
    {
        return $this->db->where('id_pendaftaran', $id)->update('pendaftaran', $data);
    }

    // Data Kecamatan
    public function deleteKecamatanById($id)
    {
        return $this->db->delete('kecamatan', ['id_kec' => $id]);
    }

    public function editKecamatanById($id, $data)
    {
        return $this->db->where('id_kec', $id)->update('kecamatan', $data);
    }

    // Data Desa
    public function showD()
    {
        $query = "SELECT *
        FROM `desa` JOIN `kecamatan`
        ON `desa`.`id_kec` = `kecamatan`.`id_kec`
        ";
        return $this->db->query($query)->result_array();
    }

    // Data Desa
    public function deleteDesaById($id)
    {
        return $this->db->delete('desa', ['id_desa' => $id]);
    }

    public function editDesaById($id, $data)
    {
        return $this->db->where('id_desa', $id)->update('desa', $data);
    }

    // Fungsi untuk melakukan proses upload file
    public function upload_file($filename)
    {
        $this->load->library('upload'); // Load librari upload

        $config['upload_path'] = './assets/excel/';
        $config['allowed_types'] = 'xlsx';
        $config['max_size']  = '2048';
        $config['overwrite'] = true;
        $config['file_name'] = $filename;

        $this->upload->initialize($config); // Load konfigurasi uploadnya
        if ($this->upload->do_upload('file')) { // Lakukan upload dan Cek jika proses upload berhasil
            // Jika berhasil :
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else {
            // Jika gagal :
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }

    // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
    public function insert_multiple($data)
    {
        $this->db->insert_batch('peserta', $data);
    }

    // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
    public function insert_multiple2($data, $dataa)
    {
        $this->db->insert_batch('data_usaha', $data);
        $this->db->update_batch('peserta', $dataa, 'id_peserta');
    }

    // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
    public function insert_multiple3($data)
    {
        $this->db->insert_batch('jangkauan_pasar', $data);
    }

    public function getPeserta()
    {
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) {
			if($_POST['search']['value']){
				if($i===0){
					$this->db->group_start();

					$this->db->like($item, $_POST['search']['value']);
				}else{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) -1 == $i)
					$this->db->group_end();
			}
			$i++;
        }
		if(isset($_POST['order'])){
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
		}else if(isset($this->order)){
			$order = $this->order;
			$this->db->order_by(key($order),$order[key($order)]);
		}
    }

	function get_datatables(){
		$this->getPeserta();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'],$_POST['start']);
		$query = $this->db->get();
		return $query->result_array();
	}

	function count_filtered(){
		$this->getPeserta();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all(){
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function getPesertaFilter($data)
	{
        $kecamatan = $data['kecamatan'];
        $desa = $data['desa'];
        $JUsaha = $data['JUsaha'];
        $subJUsaha = $data['subJUsaha'];
        if ($kecamatan !== 0 && $desa !== 0 && $JUsaha !== 0 && $subJUsaha !== 0) {
			$this->db->select('*,pe.id_peserta AS idPeserta ,du.nama_usaha AS nu_peserta');
			$this->db->from($this->table_Filter);
			$this->db->join('desa de','id_desa','left');
			$this->db->join('kecamatan kec','id_kec','left');
			$this->db->join('data_usaha du','id_peserta','left');
			$this->db->join('jenis_usaha ju','id_ju','left');
			$this->db->join('subjenis_usaha su','id_subju','left');
			$this->db->where('de.id_kec', $kecamatan);
			$this->db->where('pe.id_desa', $desa);
			$this->db->where('du.id_ju', $JUsaha);
			$this->db->where('du.id_subju', $subJUsaha);
        } elseif ($kecamatan !== 0 && $desa == 0 && $JUsaha == 0 && $subJUsaha == 0) {
			$this->db->select('*,pe.id_peserta AS idPeserta ,du.nama_usaha AS nu_peserta');
			$this->db->from($this->table_Filter);
			$this->db->join('desa de','id_desa','left');
			$this->db->join('kecamatan kec','id_kec','left');
			$this->db->join('data_usaha du','id_peserta','left');
			$this->db->join('jenis_usaha ju','id_ju','left');
			$this->db->join('subjenis_usaha su','id_subju','left');
			$this->db->where('de.id_kec', $kecamatan);
        } elseif ($kecamatan !== 0 && $desa !== 0 && $JUsaha == 0 && $subJUsaha == 0) {
			$this->db->select('*,pe.id_peserta AS idPeserta ,du.nama_usaha AS nu_peserta');
			$this->db->from($this->table_Filter);
			$this->db->join('desa de','id_desa','left');
			$this->db->join('kecamatan kec','id_kec','left');
			$this->db->join('data_usaha du','id_peserta','left');
			$this->db->join('jenis_usaha ju','id_ju','left');
			$this->db->join('subjenis_usaha su','id_subju','left');
			$this->db->where('pe.id_desa', $desa);
        } elseif ($kecamatan == 0 && $desa == 0 && $JUsaha !== 0 && $subJUsaha == 0) {
			$this->db->select('*,pe.id_peserta AS idPeserta ,du.nama_usaha AS nu_peserta');
			$this->db->from($this->table_Filter);
			$this->db->join('desa de','id_desa','left');
			$this->db->join('kecamatan kec','id_kec','left');
			$this->db->join('data_usaha du','id_peserta','left');
			$this->db->join('jenis_usaha ju','id_ju','left');
			$this->db->join('subjenis_usaha su','id_subju','left');
			$this->db->where('du.id_ju', $JUsaha);
        } elseif ($kecamatan == 0 && $desa == 0 && $JUsaha !== 0 && $subJUsaha !== 0) {
			$this->db->select('*,pe.id_peserta AS idPeserta ,du.nama_usaha AS nu_peserta');
			$this->db->from($this->table_Filter);
			$this->db->join('desa de','id_desa','left');
			$this->db->join('kecamatan kec','id_kec','left');
			$this->db->join('data_usaha du','id_peserta','left');
			$this->db->join('jenis_usaha ju','id_ju','left');
			$this->db->join('subjenis_usaha su','id_subju','left');
			$this->db->where('du.id_subju', $subJUsaha);
        } elseif ($kecamatan !== 0 && $desa !== 0 && $JUsaha !== 0 && $subJUsaha == 0) {
			$this->db->select('*,pe.id_peserta AS idPeserta ,du.nama_usaha AS nu_peserta');
			$this->db->from($this->table_Filter);
			$this->db->join('desa de','id_desa','left');
			$this->db->join('kecamatan kec','id_kec','left');
			$this->db->join('data_usaha du','id_peserta','left');
			$this->db->join('jenis_usaha ju','id_ju','left');
			$this->db->join('subjenis_usaha su','id_subju','left');
			$this->db->where('de.id_kec', $kecamatan);
			$this->db->where('pe.id_desa', $desa);
			$this->db->where('du.id_ju', $JUsaha);
        } elseif ($kecamatan !== 0 && $desa == 0 && $JUsaha !== 0 && $subJUsaha == 0) {
			$this->db->select('*,pe.id_peserta AS idPeserta ,du.nama_usaha AS nu_peserta');
			$this->db->from($this->table_Filter);
			$this->db->join('desa de','id_desa','left');
			$this->db->join('kecamatan kec','id_kec','left');
			$this->db->join('data_usaha du','id_peserta','left');
			$this->db->join('jenis_usaha ju','id_ju','left');
			$this->db->join('subjenis_usaha su','id_subju','left');
			$this->db->where('de.id_kec', $kecamatan);
			$this->db->where('du.id_ju', $JUsaha);
        } elseif ($kecamatan !== 0 && $desa == 0 && $JUsaha !== 0 && $subJUsaha !== 0) {
			$this->db->select('*,pe.id_peserta AS idPeserta ,du.nama_usaha AS nu_peserta');
			$this->db->from($this->table_Filter);
			$this->db->join('desa de','id_desa','left');
			$this->db->join('kecamatan kec','id_kec','left');
			$this->db->join('data_usaha du','id_peserta','left');
			$this->db->join('jenis_usaha ju','id_ju','left');
			$this->db->join('subjenis_usaha su','id_subju','left');
			$this->db->where('de.id_kec', $kecamatan);
			$this->db->where('du.id_subju', $subJUsaha);
        } else {
			$this->db->select('*,pe.id_peserta AS idPeserta ,du.nama_usaha AS nu_peserta');
			$this->db->from($this->table_Filter);
			$this->db->join('desa de','id_desa','left');
			$this->db->join('kecamatan kec','id_kec','left');
			$this->db->join('data_usaha du','id_peserta','left');
			$this->db->join('jenis_usaha ju','id_ju','left');
			$this->db->join('subjenis_usaha su','id_subju','left');
        }

        $i = 0;
        foreach ($this->column_searchFilter as $item) {
			if($_POST['search']['value']){
				if($i===0){
					$this->db->group_start();

					$this->db->like($item, $_POST['search']['value']);
				}else{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_searchFilter) -1 == $i)
					$this->db->group_end();
			}
			$i++;
        }
        if(isset($_POST['order'])){
	        $this->db->order_by($this->column_orderFilter[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
        }else if(isset($this->order)){
    	    $order = $this->order_Filter;
        	$this->db->order_by(key($order),$order[key($order)]);
        }
	}

	function get_datatablesFilter($data){
		$this->getPesertaFilter($data);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'],$_POST['start']);
		$query = $this->db->get();
		return $query->result_array();
	}

	function count_filteredFilter($data){
		$this->getPesertaFilter($data);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_allFilter(){
		$this->db->from($this->table_Filter);
		$this->db->join('desa de','id_desa','left');
		$this->db->join('kecamatan kec','id_kec','left');
		$this->db->join('data_usaha du','id_peserta','left');
		$this->db->join('jenis_usaha ju','id_ju','left');
		$this->db->join('subjenis_usaha su','id_subju','left');
		return $this->db->count_all_results();
	}

    public function count_allPendataanPelatihanbyid($id){
		$this->db->from('pendaftaran');
		$this->db->where('id_peserta',$id);
		return $this->db->count_all_results();
    }

	public function getPelatihan($id)
	{
		$this->db->from($this->table_pelatihan);
		$this->db->join('pelatihan pel','pen.id_pelatihan=pel.id_p','right');
		$this->db->where('pen.id_peserta',$id);
		$i = 0;
		foreach ($this->column_search_pelatihan as $item) {
			if($_POST['search']['value']){
			if($i===0){
				$this->db->group_start();

				$this->db->like($item, $_POST['search']['value']);
			}else{
				$this->db->or_like($item, $_POST['search']['value']);
			}

			if(count($this->column_search_pelatihan) -1 == $i)
				$this->db->group_end();
			}
			$i++;
			}
			if(isset($_POST['order'])){
				$this->db->order_by($this->column_order_pelatihan[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
			}else if(isset($this->order_pelatihan)){
				$order = $this->order_pelatihan;
				$this->db->order_by(key($order),$order[key($order)]);
		}
	}

	function get_datatablesPelatihan($id){
		$this->getPelatihan($id);
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'],$_POST['start']);
			$query = $this->db->get();
		return $query->result_array();
	}

	function count_filteredPelatihan($id){
		$this->getPelatihan($id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_allPelatihan($id){
		$this->db->from($this->table_pelatihan);
		$this->db->join('pelatihan pel','pen.id_pelatihan=pel.id_p','right');
		$this->db->where('pen.id_peserta',$id);
		return $this->db->count_all_results();
	}

	public function getKegiatan()
	{
		$this->db->from($this->table_kegiatan);
		$this->db->join('jenis_usaha jp','id_ju','left');
		$i = 0;
		foreach ($this->column_search_kegiatan as $item) {
			if($_POST['search']['value']){
			if($i===0){
				$this->db->group_start();

				$this->db->like($item, $_POST['search']['value']);
			}else{
				$this->db->or_like($item, $_POST['search']['value']);
			}

			if(count($this->column_search_kegiatan) -1 == $i)
				$this->db->group_end();
			}
			$i++;
		}
		if(isset($_POST['order'])){
			$this->db->order_by($this->column_order_kegiatan[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
		}else if(isset($this->order_kegiatan)){
			$order = $this->order_kegiatan;
			$this->db->order_by(key($order),$order[key($order)]);
		}
	}

	function get_datatablesKegiatan(){
		$this->getKegiatan();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'],$_POST['start']);
		$query = $this->db->get();
		return $query->result_array();
	}

	function count_filteredKegiatan(){
		$this->getKegiatan();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_allKegiatan(){
		$this->db->from($this->table_kegiatan);
		$this->db->join('jenis_usaha jp','id_ju','left');
		return $this->db->count_all_results();
	}
}