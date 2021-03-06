<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mpmb extends CI_Model{
	private $prodi	= array( "-"=>"Plih Jurusan","TI"=>"Teknik Informatika (D3)",
"TM"=>"Teknik Mekatronika (D3)","TT"=>"Teknik Telekomunikasi
(D3)","B1"=>"Teknik Alat Berat (D1)","B3"=>"Teknik Alat Berat (D3)");
	private	$jurusan_sma= array("-"=>"Plih Jurusan","IPA"=>"IPA","IPS"=>"IPS","lainnya"=>"Lainnya");
	private $agama = array("-"=>"Plih Agama","ISLAM" => "ISLAM","KRISTEN"=> "KRISTEN","KATOLIK"=> "KATOLIK","HINDU"=>"HINDU","BUDHA"=>"BUDHA","LAIN"	=>"LAINNYA");
	private $months= array("1"=>"Januari","2"=>"Februari","3"=>"Maret","4"=>"April","5"=>"Mei","6"=>"Juni","7"=>"Juli","8"=>"Agustus","9"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember");
	private $kelamin=array("L"=>"Laki-Laki","P"=>"Perempuan");
	function __construct(){
		parent::__construct();
	}



	function general(){
		$this->load->library('number');
		$this->db->select_max('id','max_id');
		$query = $this->db->get('mahasiswa_baru');

		$row = $query->row();

		$format['num']=$row->max_id;
		$data['nomor_pendaftaran'] = $this->number->generate_pendaftaran($format);
		$data['header']		= "FORMULIR";
		$data['subheader'] 	= "PENDAFTARAN MAHASISWA BARU <br> POLITEKNIK KOTA MALANG";
		$data['no_dokumen']	= "FRM.BAAK.05.01.00";
		$data['tanggal']	= "04-01-2012";
		$data['revisi']		= "-";
		$data['halaman']	= "1";
		$data['jurusan']	= $this->prodi;
		$data['jurusan_sma']= $this->jurusan_sma;
		$data['agama']		= $this->agama;

		for ($i=1;$i<=31;$i++){
			$data['date'][$i]=$i;
		}

		$data['month']=$this->months;

		for ($i=1980;$i<=1997;$i++){
			$data['year'][$i]=$i;
		}

		$data['input_jenjang']	= array('name'=>'jenjang','class'=>'input');
		$data['input_prodi']	= array('name'=>'prodi','class'=>'input');
		$data['input_no_pendaftaran']	= array('name'=>'no_pendaftaran','size'=>30,'class'=>'input','value'=>set_value('no_pendaftaran'));
		$data['input_nama_lengkap']		= array('name'=>'nama_lengkap','size'=>50,'class'=>'input','value'=>set_value('nama_lengkap'));
		$data['input_tempat_lahir']		= array('name'=>'tempat_lahir', 'size'=>50,'class'=>'input','value'=>set_value('tempat_lahir'));
		$data['input_asal_sekolah']		= array('name'=>'asal_sekolah', 'size'=>50,'class'=>'input','value'=>set_value('asal_sekolah'));
		$data['input_tahun_lulus']		= array('name'=>'tahun_lulus', 'size'=>20,'class'=>'input','value'=>set_value('tahun_lulus'));
		$data['input_nun']						= array('name'=>'nilai_un','size'=>15,'class'=>'input','value'=>set_value('nilai_un'));
		$data['input_alamat_asal']		= array('name'=>'alamat_asal', 'rows'=>5,'cols'=>80,'class'=>'input','value'=>set_value('alamat_asal'));
		$data['input_alamat_sekarang']= array('name'=>'alamat_sekarang', 'rows'=>5,'cols'=>80,'class'=>'input','value'=>set_value('alamat_sekarang'));
		$data['input_no_telp']				= array('name'=>'no_telp', 'size'=>20,'class'=>'input','value'=>set_value('no_telp'));
		$data['input_email']					= array('name'=>'email', 'size'=>50,'class'=>'input','value'=>set_value('email'));
		$data['input_nama_ayah']			= array('name'=>'nama_ayah', 'size'=>50,'class'=>'input','value'=>set_value('nama_ayah'));
		$data['input_nama_wali']			= array('name'=>'nama_wali', 'size'=>50,'class'=>'input','value'=>set_value('nama_wali'));
		$data['input_nama_ibu']				= array('name'=>'nama_ibu', 'size'=>50,'class'=>'input','value'=>set_value('nama_ibu'));
		$data['input_pekerjaan_ayah']	= array('name'=>'pekerjaan_ayah', 'size'=>50,'class'=>'input','value'=>set_value('pekerjaan_ayah'));
		$data['input_pekerjaan_ibu']	= array('name'=>'pekerjaan_ibu', 'size'=>50,'class'=>'input','value'=>set_value('pekerjaan_ibu'));
		$data['input_pekerjaan_wali']	= array('name'=>'pekerjaan_wali', 'size'=>50,'class'=>'input','value'=>set_value('pekerjaan_wali'));
		$data['input_alamat_orang_tua']	= array('name'=>'alamat_orang_tua', 'rows'=>5,'cols'=>80,'class'=>'input','value'=>set_value('alamat_orang_tua'));
		$data['input_no_telp_orang_tua']= array('name'=>'no_telp_orang_tua', 'size'=>20,'class'=>'input','value'=>set_value('no_telp_orang_tua'));
		$data['input_alamat_wali']		= array('name'=>'alamat_wali', 'rows'=>5,'cols'=>80,'class'=>'input','value'=>set_value('alamat_wali'));
		$data['input_no_telp_wali']		= array('name'=>'no_telp_wali', 'size'=>20,'class'=>'input','value'=>set_value('no_telp_wali'));
		$data['input_jenis_kelamin']	= array('name'=>'jenis_kelamin','class'=>'input');
		$data['input_jenis_biaya']		= array('name'=>'jenis_biaya[]','class'=>'input');
		$data['input_jenis_info']			= array('name'=>'jenis_info[]','class'=>'input');
		$data['input_biaya_lainnya']	= array('name'=>'biaya_lainnya', 'size'=>50,'class'=>'input','value'=>set_value('biaya_lainnya'));
		$data['input_info_lainnya']		= array('name'=>'info_lainnya', 'size'=>50,'class'=>'input','value'=>set_value('info_lainnya'));

		return $data;
	}

	function validate(){
		$config = array(
		array(
							'field'   => 'nama_lengkap',
							'label'   => 'Nama Lengkap',
							'rules'   => 'required|xss_clean',
		),
		array(
							'field'   => 'jenis_kelamin',
							'label'   => 'Jenis kelamin',
							'rules'   => 'required|xss_clean',
		),
		array(
							'field'   => 'jenjang',
							'label'   => 'Jenjang pendidikan',
							'rules'   => 'required|xss_clean',
		),
		array(
							'field'   => 'prodi',
							'label'   => 'Program Studi',
							'rules'   => 'required|xss_clean',
		),
		array(
							'field'   => 'tempat_lahir',
							'label'   => 'Tempat Lahir',
							'rules'   => 'required|xss_clean',
		),
		array(
							'field'   => 'tanggal',
							'label'   => 'tanggal',
							'rules'   => 'xss_clean',
		),
		array(
							'field'   => 'bulan',
							'label'   => 'bulan',
							'rules'   => 'xss_clean',
		),
		array(
							'field'   => 'tahun',
							'label'   => 'tahun',
							'rules'   => 'xss_clean',
		),
		array(
							'field'   => 'agama',
							'label'   => 'agama',
							'rules'   => 'xss_clean',
		),
		array(
							'field'   => 'alamat_asal',
							'label'   => 'Alamat Asal',
							'rules'   => 'required|xss_clean',
		),
		array(
							'field'   => 'alamat_sekarang',
							'label'   => 'Alamat Sekarang',
							'rules'   => 'required|xss_clean',
		),
		array(
							'field'   => 'no_telp',
							'label'   => 'Nomor Telepon / HP',
							'rules'   => 'required|alpha_dash|xss_clean',
		),
		array(
							'field'   => 'email',
							'label'   => 'Email',
							'rules'   => 'required|valid_email|xss_clean',
		),
		array(
							'field'   => 'asal_sekolah',
							'label'   => 'Asal Sekolah',
							'rules'   => 'required|xss_clean',
		),
		array(
							'field'   => 'tahun_lulus',
							'label'   => 'Tahun Lulus',
							'rules'   => 'required|numeric|min_length[4]|max_length[4]|xss_clean',
		),
		array(
							'field'   => 'jurusan_sma',
							'label'   => 'Jurusan SMA',
							'rules'   => 'xss_clean',
		),
		array(
							'field'   => 'nilai_un',
							'label'   => 'Nilai UN',
							'rules'   => 'required|min_length[2]|max_length[5]|xss_clean',
		),
		array(
							'field'   => 'nama_ayah',
							'label'   => 'Nama Ayah',
							'rules'   => 'required|xss_clean',
		),
		array(
							'field'   => 'pekerjaan_ayah',
							'label'   => 'Pekerjaan Ayah',
							'rules'   => 'required|xss_clean',
		),
		array(
							'field'   => 'nama_ibu',
							'label'   => 'Nama Ibu',
							'rules'   => 'required|xss_clean',
		),
		array(
							'field'   => 'pekerjaan_ibu',
							'label'   => 'Pekerjaan Ibu',
							'rules'   => 'required|xss_clean',
		),
		array(
							'field'   => 'alamat_orang_tua',
							'label'   => 'Alamat Orang Tua',
							'rules'   => 'required|xss_clean',
		),
		array(
							'field'   => 'nama_wali',
							'label'   => 'Nama Wali',
							'rules'   => 'required|xss_clean',
		),
		array(
							'field'   => 'pekerjaan_wali',
							'label'   => 'Pekerjaan Wali',
							'rules'   => 'required|xss_clean',
		),
		array(
							'field'   => 'no_telp_wali',
							'label'   => 'Nomor Telepon / HP Wali',
							'rules'   => 'required|alpha_dash|xss_clean',
		),
		array(
							'field'   => 'no_telp_orang_tua',
							'label'   => 'Nomor Telepon / HP orang tua',
							'rules'   => 'required|alpha_dash|xss_clean',
		),
		array(
							'field'   => 'alamat_orang_tua',
							'label'   => 'Alamat Orang Tua',
							'rules'   => 'required|xss_clean',
		),
		array(
							'field'   => 'alamat_wali',
							'label'   => 'Alamat Wali',
							'rules'   => 'required|xss_clean',
		),
		array(
							'field'   => 'jenis_biaya',
							'label'   => 'Jenis Biaya',
							'rules'   => 'xss_clean',
		),
		array(
							'field'   => 'jenis_info',
							'label'   => 'Jenis Info',
							'rules'   => 'xss_clean',
		),
		array(
							'field'   => 'biaya_lainnya',
							'label'   => 'biaya_lainnya',
							'rules'   => 'xss_clean',
		),
		array(
							'field'   => 'info_lainnya',
							'label'   => 'info_lainnya',
							'rules'   => 'xss_clean',
		),

		);
		$this->form_validation->set_message('required', '%s wajib diisi');
		$this->form_validation->set_message('min_length', '%s minimal 2 karakter');
		$this->form_validation->set_message('exact_length', 'Pilih dahulu');
		return $this->form_validation->set_rules($config);

	}

	function save(){

		$tanggal_lahir = $this->input->post('tahun')."-".$this->input->post('bulan')."-".$this->input->post('tanggal');
		$jenis_biaya = $this->input->post('jenis_biaya');
		$biaya = implode(",",$jenis_biaya);
		$jenis_info = $this->input->post('jenis_info');
		$info = implode(",",$jenis_info);

		$data = array(
			'no_pendaftaran'=> $this->input->post('no_pendaftaran') ,
			'jenjang' 	=> $this->input->post('jenjang') ,
		 	'prodi' 	=> $this->input->post('prodi') ,
			'nama_lengkap' 	=> $this->input->post('nama_lengkap'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'tempat_lahir' 	=> $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $tanggal_lahir,
			'agama' 		=> $this->input->post('agama'),
			'alamat_asal' 	=> $this->input->post('alamat_asal'),
			'alamat_sekarang'=> $this->input->post('alamat_sekarang'),
			'no_telp' 		=> $this->input->post('no_telp'),
			'email' 		=> $this->input->post('email'),
			'asal_sekolah'	=> $this->input->post('asal_sekolah'),
			'tahun_lulus' 	=> $this->input->post('tahun_lulus'),
			'jurusan_sma'	=> $this->input->post('jurusan_sma'),
			'nilai_un'		=> $this->input->post('nilai_un'),
			'nama_ayah'		=> $this->input->post('nama_ayah'),
			'pekerjaan_ayah'=> $this->input->post('pekerjaan_ayah'),
			'nama_ibu'		=> $this->input->post('nama_ibu'),
			'pekerjaan_ibu'	=> $this->input->post('pekerjaan_ibu'),
			'alamat_orang_tua'=> $this->input->post('alamat_orang_tua'),
			'no_telp_orang_tua'	=> $this->input->post('no_telp_orang_tua'),
			'nama_wali'=>$this->input->post('nama_wali'),
			'pekerjaan_wali'	=> $this->input->post('pekerjaan_wali'),
			'alamat_wali'=> $this->input->post('alamat_wali'),
			'no_telp_wali'	=> $this->input->post('no_telp_wali'),
			'jenis_biaya'	=> $biaya,
			'biaya_lainnya'=> $this->input->post('biaya_lainnya'),
			'jenis_info'=> $info,
			'info_lainnya'=> $this->input->post('info_lainnya')
		);

		$this->db->insert('mahasiswa_baru', $data);

	}

	function get_mahasiswa($no_pendaftaran){
		$query = $this->db->get_where('mahasiswa_baru', array('no_pendaftaran' => $no_pendaftaran));

		if ($query->num_rows() > 0){
			$row = $query->row();
			$data['header']		= "FORMULIR";
			$data['subheader'] 	= "PENDAFTARAN MAHASISWA BARU <br> POLITEKNIK KOTA MALANG";
			$data['no_dokumen']	= "FRM.BAAK.05.01.00";
			$data['tanggal']	= "04-01-2012";
			$data['revisi']		= "-";
			$data['halaman']	= "1";
			$data['no_pendaftaran'] = $row->no_pendaftaran;
			/*
			$data['pilihan_1'] = $this->prodi[$row->pilihan_1];
			$data['pilihan_2'] = $this->prodi[$row->pilihan_2];
			$data['pilihan_3'] = $this->prodi[$row->pilihan_3];
			$data['pilihan_4'] = $this->prodi[$row->pilihan_4];
			$data['pilihan_5'] = $this->prodi[$row->pilihan_5];
			*/
			$data['jenjang']=$row->jenjang;
			if ($row->prodi == 'TI') {
				$data['prodi']="Teknik Informatika";
			} else if ($row->prodi == 'TT') {
				$data['prodi']="Teknik Telekomunikasi";
			}else if ($row->prodi == 'TM') {
				$data['prodi']="Teknik Mekatronika";
			}else{
				$data['prodi']="Teknik Alat Berat";
			}
			
			$data['nama_lengkap'] = $row->nama_lengkap;
			$data['jenis_kelamin'] = $this->kelamin[$row->jenis_kelamin];
			$data['tempat_lahir'] = $row->tempat_lahir;
			$data['tanggal_lahir'] = date('d M Y', strtotime($row->tanggal_lahir));
			$data['agama'] = $row->agama;
			$data['alamat_asal'] = $row->alamat_asal;
			$data['alamat_sekarang'] = $row->alamat_sekarang;
			$data['no_telp'] = $row->no_telp;
			$data['email'] = $row->email;
			$data['asal_sekolah'] = $row->asal_sekolah;
			$data['tahun_lulus'] = $row->tahun_lulus;
			$data['jurusan_sma'] = $row->jurusan_sma;
			$data['nilai_un'] = $row->nilai_un;
			$data['nama_ayah'] = $row->nama_ayah;
			$data['pekerjaan_ayah'] = $row->pekerjaan_ayah;
			$data['nama_ibu']=$row->nama_ibu;
			$data['pekerjaan_ibu'] = $row->pekerjaan_ibu;
			$data['alamat_orang_tua'] = $row->alamat_orang_tua;
			$data['no_telp_orang_tua'] = $row->no_telp_orang_tua;
			$data['nama_wali'] = $row->nama_wali;
			$data['pekerjaan_wali'] = $row->pekerjaan_wali;
			$data['alamat_wali']=$row->alamat_wali;
			$data['no_telp_wali'] = $row->no_telp_wali;
			$data['jenis_biaya'] = $row->jenis_biaya;
			$data['biaya_lainnya'] = $row->biaya_lainnya;
			$data['jenis_info'] = $row->jenis_info;
			$data['info_lainnya'] = $row->info_lainnya;

			return $data;
		}else{
			redirect('pmb');
		}
	}

	function getAllGrid($start,$limit,$sidx,$sord,$where){
    $this->db->select('id,no_pendaftaran,nama_lengkap,pilihan_1,asal_sekolah,no_telp');
    $this->db->group_by('nama_lengkap');
    $this->db->limit($limit);
    if($where != NULL)$this->db->where($where,NULL,FALSE);
	    $this->db->order_by($sidx,$sord);
    $query = $this->db->get('mahasiswa_baru',$limit,$start);

    return $query->result();
  }

}