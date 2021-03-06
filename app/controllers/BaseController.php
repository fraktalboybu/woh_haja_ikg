<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function setHeader()
	{
		return;
		/*
		$id_gereja = $this->get_gereja('id'); //buat keperluan import/eksport
		
		$nama_gereja = $this->get_gereja('nama');
		
		$alamat_gereja = Session::get('alamat');
		
		$telepon_gereja = Session::get('telp');				
		
		$kota_gereja = Session::get('kota');
		
		
		$header = array(
			'id_gereja' => $id_gereja,
			'nama' => $nama_gereja,
			'alamat' => $alamat_gereja, 
			'telp' => $telepon_gereja,
			'kota' => $kota_gereja
		);
		
		return $header;
		*/
	}
	
	private function get_gereja($kembalian)
	{
		return;
		/*
		$gereja = Gereja::find(Auth::user()->id_gereja);
		return $gereja->$kembalian;
		*/
		
		// $gereja = Gereja::find(Auth::user()->id_gereja);
		
		/*
		//get gereja status:jemaat yang pertama di get di database
		$count = Gereja::where('status','=', '3')->first();		
		if(count($count) != 0)
		{
			return $count->$kembalian;
		}else
		{
			return "";
		}
		*/
	}
	
	//--------------------------------------------------GET LIST--------------------------------------------------
	
	//get list gereja
	public function getListGereja()
	{		
		// $count = DB::table('gereja')->orderBy('id','asc')->lists('nama','id');
		$count = DB::table('gereja')->where('deleted', '=', 0)->orderBy('nama','asc')->lists('nama','id');
		if(count($count) != 0)
		{
			return $count;
		}
		else
		{
			return null;
		}
	}
	
	//get list status gereja
	public function getListStatusGereja()
	{		
		$arrStatusGereja = array(			
			'1' => 'Posjem',
			'2' => 'Bajem',
			'3' => 'Jemaat',
			'4' => 'Klassis',
			'5' => 'Sinode Wilayah'			
		);		
		return $arrStatusGereja;
	}
		
	//get list wilayah
	public function getListWilayah()
	{
		$arrWilayah = array(
			'' => 'pilih!',
			'I' => 'I',
			'II' => 'II',
			'III' => 'III',
			'IV' => 'IV',
			'V' => 'V',
			'VI' => 'VI',
			'VII' => 'VII',
			'VIII' => 'VIII',
			'IX' => 'IX',
			'X' => 'X',
			'XI' => 'X1',
			'XII' => 'XII',
			'XIII' => 'XIII',
			'XIV' => 'XIV',
			'XV' => 'XI'
		);		
		return $arrWilayah;
	}
	
	//get list gol_darah	
	public function getListGolonganDarah()
	{
		$arrGolonganDarah = array(
			'' => 'pilih!',
			'A +' => 'A +',
			'B +' => 'B +',
			'A B+' => 'AB +',
			'O +' => 'O +',
			'A -' => 'A -',
			'B -' => 'B -',
			'A B-' => 'AB -',
			'O -' => 'O -'	
		);
		return $arrGolonganDarah;
	}
			
	//get list pendidikan
	public function getListPendidikan()
	{
		$arrPendidikan = array(
			'' => 'pilih!',
			'TK' => 'TK',
			'SD' => 'SD',
			'SLTP' => 'SLTP',
			'SMU' => 'SMU',
			'Kejuruan' => 'Kejuruan',
			'D-1' => 'D-1',
			'D-2' => 'D-2',
			'D-3' => 'D-3',
			'S-1' => 'S-1',
			'S-2' => 'S-2',
			'S-3' => 'S-3',
			'Lain-Lain' => 'Lain-Lain'
		);			
		return $arrPendidikan;
	}
	
	//get list pekerjaan
	public function getListPekerjaan()
	{
		$arrPekerjaan = array(
			'' => 'pilih!',
			'Wirausaha' => 'Wirausaha',
			'P.Negeri' => 'P.Negeri',
			'P.Swasta' => 'P.Swasta',
			'Profesional' => 'Profesional',
			'Pensiunan' => 'Pensiunan',
			'Ibu RT' => 'Ibu RT',
			'Petani' => 'Petani',
			'Pel/Mhs' => 'Pel/Mhs',
			'Lain-Lain' => 'Lain-Lain'
		);
		return $arrPekerjaan;
	}
	
	//get list etnis
	public function getListEtnis()
	{	
		$arrEtnis = array(
			'' => 'pilih!',
			'T.Hoa' => 'T.Hoa',
			'Sunda' => 'Sunda',
			'Batak' => 'Batak',
			'Jawa' => 'Jawa',
			'Ambon' => 'Ambon',
			'Minahasa' => 'Minahasa',
			'Nias' => 'Nias',
			'Timor' => 'Timor',
			'Toraja' => 'Toraja',
			'Dayak' => 'Dayak',
			'Papua' => 'Papua',
			'Lain-Lain' => 'Lain-Lain'
		);
		return $arrEtnis;
	}
	
	//get list role anggota
	public function getListRoleAnggota()
	{
		$arrRoleAnggota = array(			
			'1' => 'jemaat',
			'2' => 'pendeta',
			'3' => 'penatua',
			'4' => 'majelis'
		);
		return $arrRoleAnggota;
	}
	
	//get list jenis kegiatan
	//note: udh dimodifikasi untuk menambah sendiri otomatis jika ada jenis kegiatan baru yang dicantumkan oleh gereja masing-masing
	public function getListJenisKegiatan()
	{
		$count = DB::table('jenis_kegiatan')
						->whereNull('id_gereja')						
						->orWhere('id_gereja', '=', Auth::user()->id_gereja)
						->where('deleted', '=', 0)
						->orderBy('id','asc')
						->lists('nama_kegiatan','id');
		if(count($count) != 0)
		{
			return $count;
		}
		else
		{
			return null;
		}
	}
	
	//get list jenis baptis
	public function getListJenisBaptis()
	{
		$count = DB::table('jenis_baptis')->where('deleted', '=', 0)->orderBy('id','asc')->lists('nama_jenis_baptis','id');
		if(count($count) != 0)
		{
			return $count;
		}
		else
		{
			return null;
		}
	}
	
	//get list jenis atestasi
	public function getListJenisAtestasi()
	{
		$count = DB::table('jenis_atestasi')->where('deleted', '=', 0)->orderBy('id','asc')->lists('nama_atestasi','id');
		if(count($count) != 0)
		{
			return $count;
		}
		else
		{
			return null;
		}
	}

	//get list jenis dkh
	public function getListJenisDkh()
	{
		$count = DB::table('jenis_dkh')->where('deleted', '=', 0)->orderBy('id','asc')->lists('nama_dkh','id');
		if(count($count) != 0)
		{
			return $count;
		}
		else
		{
			return null;
		}
	}
	
	//admin get list pendeta
	public function admin_getListPendeta()
	{		
		$count = Anggota::select('id', DB::raw('CONCAT(nama_depan, " " ,nama_tengah, " " ,nama_belakang) AS nama_lengkap'))
					->where('deleted', '=', 0)					
					->where('role', '=', 2) //role pendeta					
					->orderBy('nama_depan')								
					->lists('nama_lengkap', 'id');					
		if(count($count) != 0)
		{			
			return $count;
		}
		else
		{
			return null;
		}
	}
	
	//get list pendeta
	public function getListPendeta()
	{		
		$count = Anggota::select('id', DB::raw('CONCAT(nama_depan, " " ,nama_tengah, " " ,nama_belakang) AS nama_lengkap'))
					->where('deleted', '=', 0)
					->where('id_gereja', '=', Auth::user()->id_gereja)
					->where('role', '=', 2) //role pendeta					
					->orderBy('nama_depan')								
					->lists('nama_lengkap', 'id');					
		if(count($count) != 0)
		{			
			return $count;
		}
		else
		{
			return null;
		}
	}
	
	//get list penatua
	public function getListPenatua()
	{		
		$count = Anggota::select('id', DB::raw('CONCAT(nama_depan, " " ,nama_tengah, " " ,nama_belakang) AS nama_lengkap'))
					->where('deleted', '=', 0)
					->where('id_gereja', '=', Auth::user()->id_gereja)
					->where('role', '=', 3) //role pendeta					
					->orderBy('nama_depan')								
					->lists('nama_lengkap', 'id');					
		if(count($count) != 0)
		{			
			return $count;
		}
		else
		{
			return null;
		}
	}
	
	//get list majelis
	public function getListMajelis()
	{		
		$count = Anggota::select('id', DB::raw('CONCAT(nama_depan, " " ,nama_tengah, " " ,nama_belakang) AS nama_lengkap'))
					->where('deleted', '=', 0)
					->where('id_gereja', '=', Auth::user()->id_gereja)
					->where('role', '=', 4) //role pendeta					
					->orderBy('nama_depan')								
					->lists('nama_lengkap', 'id');					
		if(count($count) != 0)
		{			
			return $count;
		}
		else
		{
			return null;
		}
	}
	
	//get list anggota
	public function getListAnggota()
	{				
		$count = Anggota::select('id', DB::raw('CONCAT(nama_depan, " " ,nama_tengah, " " ,nama_belakang) AS nama_lengkap'))
					->where('deleted', '=', 0)
					->where('id_gereja', '=', Auth::user()->id_gereja)
					// ->where('role', '=', 1) //role jemaat					
					->orderBy('nama_depan')
					->lists('nama_lengkap', 'id');
		if(count($count) != 0)
		{
			return $count;
		}
		else
		{
			return null;
		}
	}
	
	//get list jemaat
	public function getListJemaat()
	{				
		$count = Anggota::select('id', DB::raw('CONCAT(nama_depan, " " ,nama_tengah, " " ,nama_belakang) AS nama_lengkap'))
					->where('deleted', '=', 0)
					->where('id_gereja', '=', Auth::user()->id_gereja)
					->where('role', '=', 1) //role jemaat					
					->orderBy('nama_depan')
					->lists('nama_lengkap', 'id');
		if(count($count) != 0)
		{
			return $count;
		}
		else
		{
			return null;
		}
	}
	
	//get list anggota pria
	public function getListAnggotaPria()
	{		
		// $count = DB::table('anggota')->where('role', '=', 2)->orderBy('nama_depan','asc')
				// ->lists('nama_depan'.' '.'nama_tengah'. ' '.'nama_belakang','id');
		$count = Anggota::select('id', DB::raw('CONCAT(nama_depan, " " ,nama_tengah, " " ,nama_belakang) AS nama_lengkap'))
					->where('deleted', '=', 0)
					->where('id_gereja', '=', Auth::user()->id_gereja)
					// ->where('role', '=', 1)
					->where('gender', '=', 1)					
					->orderBy('nama_depan')
					->lists('nama_lengkap', 'id');
		if(count($count) != 0)
		{
			return $count;
		}
		else
		{
			return null;
		}
	}
	
	//get list anggota wanita
	public function getListAnggotaWanita()
	{		
		// $count = DB::table('anggota')->where('role', '=', 2)->orderBy('nama_depan','asc')
				// ->lists('nama_depan'.' '.'nama_tengah'. ' '.'nama_belakang','id');
		$count = Anggota::select('id', DB::raw('CONCAT(nama_depan, " " ,nama_tengah, " " ,nama_belakang) AS nama_lengkap'))
					->where('deleted', '=', 0)
					->where('id_gereja', '=', Auth::user()->id_gereja)
					// ->where('role', '=', 1)
					->where('gender', '=', 0)					
					->orderBy('nama_depan')
					->lists('nama_lengkap', 'id');
		if(count($count) != 0)
		{
			return $count;
		}
		else
		{
			return null;
		}
	}
	
	//get list anggota yang masih hidup
	public function getListAnggotaHidup()
	{
		$count = Anggota::select('id', DB::raw('CONCAT(nama_depan, " " ,nama_tengah, " " ,nama_belakang) AS nama_lengkap'))
					->where('deleted', '=', 0)
					->where('id_gereja', '=', Auth::user()->id_gereja)
					// ->where('role', '=', 1) //role jemaat saja
					->whereNull('tanggal_meninggal')					
					->orderBy('nama_depan')
					->lists('nama_lengkap', 'id');
		if(count($count) != 0)
		{
			return $count;
		}
		else
		{
			return null;
		}
	}
	
	//-------------------------------------GET LIST (FOR SEARCHING)--------------------------------------------------
	
	
}
