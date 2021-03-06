<?php

use Carbon\Carbon;

class InputEditController extends BaseController {
	
	public function view_kebaktian()
	{		
		// $header = $this->setHeader();
		$list_jenis_kegiatan = $this->getListJenisKegiatan();		
		$list_pembicara = $this->getListPendeta();
		// $list_gereja = $this->getListGereja();		
		// return View::make('pages.user_inputdata.kebaktian_domi', 
		// 	compact('list_jenis_kegiatan','list_pembicara' )
		return View::make('pages.__user.__input.kebaktian', 
			compact('list_jenis_kegiatan','list_pembicara' )
		);					
	}
	
	public function view_anggota()
	{		
		// $header = $this->setHeader();
		// $list_gereja = $this->getListGereja();
		$list_wilayah = $this->getListWilayah();
		$list_gol_darah = $this->getListGolonganDarah();
		$list_pendidikan = $this->getListPendidikan();
		$list_pekerjaan = $this->getListPekerjaan();
		$list_etnis = $this->getListEtnis();
		$list_role = $this->getListRoleAnggota();				
		// return View::make('pages.user_inputdata.anggota_domi', 
		// 	compact('list_wilayah','list_gol_darah','list_pendidikan','list_pekerjaan','list_etnis','list_role'));		
		return View::make('pages.__user.__input.anggota', 
			compact('list_wilayah','list_gol_darah','list_pendidikan','list_pekerjaan','list_etnis','list_role'));		
	}
	
	public function view_baptis()
	{
		// $header = $this->setHeader();
		// $list_gereja = $this->getListGereja();
		$list_pembaptis = $this->getListPendeta();
		$list_jenis_baptis = $this->getListJenisBaptis();
		$list_jemaat = $this->getListJemaat();		
		// return View::make('pages.user_inputdata.baptis_domi', 
		// 	compact('list_pembaptis','list_jenis_baptis','list_jemaat'));		
		return View::make('pages.__user.__input.baptis', 
			compact('list_pembaptis','list_jenis_baptis','list_jemaat'));		
	}	
	
	public function view_atestasi()
	{
		// $header = $this->setHeader();
		$list_jenis_atestasi = $this->getListJenisAtestasi();
		$list_jemaat = $this->getListAnggota();
		$list_gereja = $this->getListGereja();		
		// return View::make('pages.user_inputdata.atestasi_domi', 
		// 	compact('list_jenis_atestasi','list_jemaat','list_gereja'));		
		return View::make('pages.__user.__input.atestasi', 
			compact('list_jenis_atestasi','list_jemaat','list_gereja'));		
	}
	
	public function view_pernikahan()
	{
		// $header = $this->setHeader();
		$list_jemaat_pria = $this->getListAnggotaPria();
		$list_jemaat_wanita = $this->getListAnggotaWanita();
		$list_gereja = $this->getListGereja();
		$list_pendeta = $this->getListPendeta();		
		// return View::make('pages.user_inputdata.pernikahan_domi', 
		// 	compact('list_jemaat_pria','list_jemaat_wanita','list_gereja','list_pendeta'));
		return View::make('pages.__user.__input.pernikahan', 
			compact('list_jemaat_pria','list_jemaat_wanita','list_gereja','list_pendeta'));
	}
	
	public function view_kedukaan()
	{
		// $header = $this->setHeader();
		$list_gereja = $this->getListGereja();
		$list_anggota = $this->getListAnggotaHidup();		
		// return View::make('pages.user_inputdata.kedukaan_domi', 
		// 	compact('list_gereja','list_anggota'));
		return View::make('pages.__user.__input.kedukaan', 
			compact('list_gereja','list_anggota'));
	}
	
	public function view_dkh()
	{
		// $header = $this->setHeader();
		$list_jemaat = $this->getListAnggota();	
		$list_jenis_dkh = $this->getListJenisDkh();	
		// return View::make('pages.user_inputdata.dkh_domi', 
		// 	compact('list_jemaat', 'list_jenis_dkh'));		
		return View::make('pages.__user,__input.dkh', 
			compact('list_jemaat', 'list_jenis_dkh'));		
	}

/*----------------------------------------LIVE SEARCH----------------------------------------*/

	public function user_search_anggota()
	{			
		try{
			$keyword = Input::get('keyword');
			$anggota = DB::table('anggota')->where(DB::raw('CONCAT(nama_depan, " " ,nama_tengah, " " ,nama_belakang)'), 'LIKE', '%'.$keyword.'%')->get();
			if(count($anggota) == 0)
			{
				//not found
				$respond = array('code' => '404', 'status' => 'Not Found');			
				return json_encode($respond);
			}
			else
			{
				$respond = array('code' => '200', 'status' => 'OK', 'messages' => $anggota);			
				return json_encode($respond);
			}
		}catch(Exception $e)
		{
			//internal server error
			$respond = array('code' => '500', 'status' => 'Internal Server Error');			
			return json_encode($respond);
		}
		
		// return null;
	}
	
/*----------------------------------------POST----------------------------------------*/	
	
	//NOTE :			
	//masukin data ke persembahan ... 
	public function postKebaktian()
	{				
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
								
		// $input = Input::get('data');							
		
		$data_valid = array(			
			'nama_pendeta' => trim($input->{'nama_pendeta'}),			
			'nama_jenis_kegiatan' => trim($input->{'nama_jenis_kegiatan'}),
			'tanggal_mulai' => $input->{'tanggal_mulai'},
			'tanggal_selesai' => $input->{'tanggal_selesai'},
			'jam_mulai' => $input->{'jam_mulai'},
			'jam_selesai' => $input->{'jam_selesai'},
			'banyak_jemaat' => $input->{'banyak_jemaat'},
			'banyak_simpatisan' => $input->{'banyak_simpatisan'},
			'banyak_penatua' => $input->{'banyak_penatua'},
			'banyak_pemusik' => $input->{'banyak_pemusik'},
			'banyak_komisi' => $input->{'banyak_komisi'}
		);
		
		//validate
		$validator = Validator::make($data = $data_valid, Kegiatan::$rules); 								

		if ($validator->fails())
		{			
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Bagian yang bertanda (*) harus diisi.');
			return json_encode($respond);
			// return "Bagian yang bertanda (*) harus diisi.";
		}
		if($input->{'jumlah_persembahan'} == '')
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Bagian yang bertanda (*) harus diisi.');
			return json_encode($respond);
			// return "Bagian yang bertanda (*) harus diisi.";
		}
		
		/*
			VALIDATE DUPLICATE DATA
				nama_jenis_kegiatan
				id_gereja
				tanggal_mulai
				tanggal_selesai
		*/
		$duplicate = Kegiatan::where('deleted', '=', 0)
					->where('nama_jenis_kegiatan', '=', trim($input->{'nama_jenis_kegiatan'}))
					->where('tanggal_mulai', '=', $input->{'tanggal_mulai'})
					->where('tanggal_selesai', '=', $input->{'tanggal_selesai'})
					->where('id_gereja', '=', Auth::user()->id_gereja)
					->first();
		if(count($duplicate))
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Gagal memasukkan data. Terdapat duplikasi data karena data yang dimasukkan sudah ada.');
			return json_encode($respond);
		}		
		
		$kebaktian = new Kegiatan();												
		if($input->{'id_jenis_kegiatan'} == '') //nama kebaktian lain
		{
			//$kebaktian->id_jenis_kegiatan = null;

			//cek jenis kegiatan baru
			$arr_temp = JenisKegiatan::where('id_gereja', '=', Auth::user()->id_gereja)
							->where('nama_kegiatan', '=', trim($input->{'nama_jenis_kegiatan'}))->get();
			if(count($arr_temp) == 0) //nama_jenis_kegiatan belum pernah terdaftar
			{
				//add ke jenis_kegiatan
				$jeniskegiatanbaru = new JenisKegiatan();
				$jeniskegiatanbaru -> nama_kegiatan = trim($input->{'nama_jenis_kegiatan'});
					$jeniskegiatanbaru -> id_gereja = Auth::user()->id_gereja;
				$jeniskegiatanbaru -> save();

				$kebaktian->id_jenis_kegiatan = $jeniskegiatanbaru->id;
			}			
			else
			{
				$kebaktian->id_jenis_kegiatan = null;
			}
		}
		else
		{
			$kebaktian->id_jenis_kegiatan = $input->{'id_jenis_kegiatan'};
		}
		$kebaktian->nama_jenis_kegiatan = trim($input->{'nama_jenis_kegiatan'});
		if($input->{'id_pendeta'} == '')
		{
			$kebaktian->id_pendeta = null;
		}
		else
		{
			$kebaktian->id_pendeta = $input->{'id_pendeta'};
		}		
		$kebaktian->nama_pendeta = trim($input->{'nama_pendeta'});				
		$kebaktian->tanggal_mulai = $input->{'tanggal_mulai'};
		$kebaktian->tanggal_selesai = $input->{'tanggal_selesai'};
		$kebaktian->jam_mulai = $input->{'jam_mulai'};
		$kebaktian->jam_selesai = $input->{'jam_selesai'};
		$kebaktian->banyak_jemaat_pria = $input->{'banyak_jemaat_pria'};
		$kebaktian->banyak_jemaat_wanita = $input->{'banyak_jemaat_wanita'};
		$kebaktian->banyak_jemaat = $input->{'banyak_jemaat'};
		$kebaktian->banyak_simpatisan_pria = $input->{'banyak_simpatisan_pria'};
		$kebaktian->banyak_simpatisan_wanita = $input->{'banyak_simpatisan_wanita'};
		$kebaktian->banyak_simpatisan = $input->{'banyak_simpatisan'};
		$kebaktian->banyak_penatua_pria = $input->{'banyak_penatua_pria'};
		$kebaktian->banyak_penatua_wanita = $input->{'banyak_penatua_wanita'};
		$kebaktian->banyak_penatua = $input->{'banyak_penatua'};
		$kebaktian->banyak_komisi_pria = $input->{'banyak_komisi_pria'};
		$kebaktian->banyak_komisi_wanita = $input->{'banyak_komisi_wanita'};
		$kebaktian->banyak_komisi = $input->{'banyak_komisi'};
		$kebaktian->banyak_pemusik_pria = $input->{'banyak_pemusik_pria'};
		$kebaktian->banyak_pemusik_wanita = $input->{'banyak_pemusik_wanita'};
		$kebaktian->banyak_pemusik = $input->{'banyak_pemusik'};		
		// $kebaktian->id_gereja = $input->{'id_gereja'};
		$kebaktian->id_gereja = Auth::user()->id_gereja;		
		$kebaktian->keterangan = $input->{'keterangan'};					
		$kebaktian->deleted = 0;
		
		try{
			$kebaktian->save();
			
			try{
				$persembahan = new Persembahan();
				$persembahan->tanggal_persembahan = $kebaktian->tanggal_mulai;
				$persembahan->jumlah_persembahan = $input->{'jumlah_persembahan'};
				$persembahan->id_kegiatan = $kebaktian->id;
				$persembahan->jenis = 1;	//jenis 1 khusus untuk persembahan kebaktian
				$persembahan->deleted = 0;
				
				$persembahan->save();
				
				$respond = array('code' => '201', 'status' => 'Created', 'messages' => 'Berhasil menyimpan data kebaktian.');
				return json_encode($respond);
				
				// return "berhasil";
			}catch(Exception $e){
				//delete kebaktian
				$kebaktian->delete();
				
				$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data kebaktian');
				return json_encode($respond);
				// return "Gagal menyimpan data kebaktian.";
			}
						
		}catch(Exception $e){			
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data kebaktian');
			return json_encode($respond);
			// return "Gagal menyimpan data kebaktian.";
		}
							
	}
		
	public function postAnggota()
	{	
		/*
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);	
		
		$data_valid = array(
			'nama_depan' => $input->{'nama_depan'},
			'telp' => $input->{'telp'},
			'gender' => $input->{'gender'},
			'gol_darah' => $input->{'gol_darah'},
			'pekerjaan' => $input->{'pekerjaan'},
			'kota_lahir' => $input->{'kota_lahir'},
			'tanggal_lahir' => $input->{'tanggal_lahir'}, 
			'role' => $input->{'role'}
		);	
			
		// $file = Input::file('foto');	
			
		$respond = array('code' => '201', 'status' => 'Created', 'messages' => 'Berhasil menyimpan data anggota.');
		return json_encode($respond);
		*/
				
		//BEFORE
		$data_valid = array(
			'nama_depan' => trim(Input::get('nama_depan')),
			'telp' => Input::get('telp'),
			'gender' => Input::get('gender'),
			'gol_darah' => Input::get('gol_darah'),
			'pekerjaan' => Input::get('pekerjaan'),
			'kota_lahir' => trim(Input::get('kota_lahir')),
			'tanggal_lahir' => Input::get('tanggal_lahir'), 
			'role' => Input::get('role')
		);
		
		//validate anggota
		$validator = Validator::make($data = $data_valid, Anggota::$rules);
		
		if($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Bagian yang bertanda (*) harus diisi.');
			return json_encode($respond);
			// return "Bagian yang bertanda (*) harus diisi.";
		}
		
		$data_valid = array(
			'jalan' => trim(Input::get('jalan')),
			'kota' => trim(Input::get('kota'))			
		);
		
		//validate alamat
		$validator = Validator::make($data = $data_valid, Alamat::$rules);
		
		if($validator->fails())		
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Bagian yang bertanda (*) harus diisi.');
			return json_encode($respond);
			// return "Bagian yang bertanda (*) harus diisi.";
		}
	
		/*
			VALIDATE DUPLICATE DATA				
				nama_depan
				nama_tengah
				nama_belakang
				id_gereja
			
			VALIDATE WITH CASE SENSITIVE
				Invite::where(DB::raw('BINARY `token`'), $token)->first();	
		*/		
		$duplicate = Anggota::where('deleted', '=', 0)
					->where('nama_depan', '=', trim(Input::get('nama_depan')))
					->where('nama_tengah', '=', trim(Input::get('nama_tengah')))
					->where('nama_belakang', '=', trim(Input::get('nama_belakang')))
					->where('id_gereja', '=', Auth::user()->id_gereja)
					->first();
		if(count($duplicate))
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Gagal memasukkan data. Terdapat duplikasi data karena data yang dimasukkan sudah ada.');
			return json_encode($respond);
		}
		
		/*
			VALIDATE UNIQUE NO_ANGGOTA
			NOTE: unique di validator laravel bersifat 'NOT CASE SENSITIVE'
		*/
		$validator = Validator::make(
			array('no_anggota' => trim(Input::get('no_anggota'))),
			array('no_anggota' => array('unique:anggota,no_anggota'))
		);
		if($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Gagal memasukkan data. Terdapat duplikasi data nomor anggota. Data nomor anggota yang dimasukkan sudah ada.');
			return json_encode($respond);
		}
		
		$anggota = new Anggota();
		//$anggota->no_anggota = trim(Input::get('no_anggota'));
		$anggota->nama_depan = trim(Input::get('nama_depan'));
		$anggota->nama_tengah = trim(Input::get('nama_tengah'));
		$anggota->nama_belakang = trim(Input::get('nama_belakang'));
		$anggota->telp = Input::get('telp');
		$anggota->gender = Input::get('gender');
		$anggota->wilayah = Input::get('wilayah');
		$anggota->gol_darah = Input::get('gol_darah');
		$anggota->pendidikan = Input::get('pendidikan');
		$anggota->pekerjaan = Input::get('pekerjaan');
		$anggota->etnis = Input::get('etnis');
		$anggota->kota_lahir = trim(Input::get('kota_lahir'));
		$anggota->tanggal_lahir = Input::get('tanggal_lahir');		
		// $anggota->id_gereja = Input::get('id_gereja');
		$anggota->id_gereja = Auth::user()->id_gereja;
		$anggota->role = Input::get('role');
		$anggota->deleted = 0;		
		
		try{
			$anggota->save();
			
			//save no hp
			$ctHp = 0;			
			$temp_arr_hp = Input::get('arr_hp');
			if($temp_arr_hp != "") //kalo ada input hp			
			{
				$arr_hp = explode(",", $temp_arr_hp);
				foreach($arr_hp as $key)
				{
					$hp = new Hp();
					$hp->no_hp = $key;
					$hp->id_anggota = $anggota->id;
					// $hp->deleted = 0;
					try{
						$hp->save();
						
						$ctHp++;					
					}catch(Exception $e){								
						//delete hp sebelumnya
						for($i = 0; $i < $ctHp ; $i++)
						{
							$delHp = DB::table('hp')->orderBy('created_at', 'desc')->first();
							$delHp->delete();
						}
						
						//delete anggota
						$anggota->delete();
						
						$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data anggota');
						return json_encode($respond);						
						// return "Gagal menyimpan data anggota.";
					}
				}
			}
			
			//save alamat
			$alamat = new Alamat();
			$alamat->jalan = trim(Input::get('jalan'));
			$alamat->kota = trim(Input::get('kota'));
			$alamat->kodepos = Input::get('kodepos');
			$alamat->id_anggota = $anggota->id;
			// $alamat->deleted = 0;
			try{
				$alamat->save();
			}catch(Exception $e){
				//delete hp sebelumnya
				for($i = 0; $i < $ctHp ; $i++)
				{
					$delHp = DB::table('hp')->orderBy('created_at', 'desc')->first();
					$delHp->delete();
				}
				
				//delete anggota
				$anggota->delete();
						
				$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data anggota');
				return json_encode($respond);
				// return "Gagal menyimpan data anggota.";
			}
			
			//save foto
			if (Input::hasFile('foto'))
			{
				$file = Input::file('foto');
				$destinationPath = "assets/file_upload/anggota/";
				$fileName = $file->getClientOriginalName();						
				
				$foto_id = $anggota->id;
				$destinationPath .= $foto_id;
				$destinationPath .= "/";
				if(!file_exists($destinationPath))
				{
					File::makeDirectory($destinationPath, $mode = 0777, true, true);
					$uploadSuccess = $file->move($destinationPath, $fileName);
					$anggota->foto = $destinationPath.$fileName;
					try{
						$anggota->save();
					}catch(Exception $e){						
						//delete hp sebelumnya
						for($i = 0; $i < $ctHp ; $i++)
						{
							$delHp = DB::table('hp')->orderBy('created_at', 'desc')->first();
							$delHp->delete();
						}
						
						//delete alamat
						$alamat->delete();
						
						//delete anggota
						$anggota->delete();
						
						$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data angggota');
						return json_encode($respond);
						// return "Gagal menyimpan data anggota.";
					}					
				}
				else
				{
					$uploadSuccess = $file->move($destinationPath, $fileName);
					$anggota->foto = $destinationPath.$fileName;
					try{
						$anggota->save();
					}catch(Exception $e){												
						//delete hp sebelumnya
						for($i = 0; $i < $ctHp ; $i++)
						{
							$delHp = DB::table('hp')->orderBy('created_at', 'desc')->first();
							$delHp->delete();
						}
						
						//delete alamat
						$alamat->delete();
						
						//delete anggota
						$anggota->delete();
						
						$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data anggota');
						return json_encode($respond);
						// return "Gagal menyimpan data anggota.";
					}					
				}
			}			
		}catch(Exception $e){			
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data angggota');
			return json_encode($respond);
			// return "Gagal menyimpan data anggota.";
		}		
		
		$respond = array('code' => '201', 'status' => 'Created', 'messages' => 'Berhasil menyimpan data anggota.');
		return json_encode($respond);
		// return "berhasil";		
	}
	
	public function postBaptis()
	{		
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		// $input = Input::get('data');
		
		$data_valid = array(
			'no_baptis' => trim($input->{'no_baptis'}),
			'id_jemaat' => $input->{'id_jemaat'},
			'id_pendeta' => $input->{'id_pendeta'},
			'tanggal_baptis' => $input->{'tanggal_baptis'},
			'id_jenis_baptis' => $input->{'id_jenis_baptis'},
			'id_gereja' => Auth::user()->id_gereja
		);
		
		//validate
		$validator = Validator::make($data = $data_valid, Baptis::$rules);
		
		if($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Bagian yang bertanda (*) harus diisi.');
			return json_encode($respond);
			// return "Bagian yang bertanda (*) harus diisi.";
		}
		
		/*
			VALIDATE DUPLICATE DATA
				no_baptis				
		*/
		$duplicate = Baptis::where('deleted', '=', 0)
					->where('no_baptis', '=', trim($input->{'no_baptis'}))
					->where('id_gereja', '=', Auth::user()->id_gereja)
					->first();
		if(count($duplicate))
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Gagal memasukkan data. Terdapat duplikasi data karena data yang dimasukkan sudah ada.');
			return json_encode($respond);
		}
		
		$baptis = new Baptis();
		$baptis->no_baptis = trim($input->{'no_baptis'});				
		$baptis->id_jemaat = $input->{'id_jemaat'};
		$baptis->id_pendeta = $input->{'id_pendeta'};
		$baptis->tanggal_baptis = $input->{'tanggal_baptis'};
		$baptis->id_jenis_baptis = $input->{'id_jenis_baptis'};
		// $baptis->id_gereja = $input->{'id_gereja'};
		$baptis->id_gereja = Auth::user()->id_gereja;
		$baptis->keterangan = $input->{'keterangan'};
		$baptis->deleted = 0;
		
		try{
			$baptis->save();
			
			$respond = array('code' => '201', 'status' => 'Created', 'messages' => 'Berhasil menyimpan data baptis.');
			return json_encode($respond);
			
			// return "berhasil";
		}catch(Exception $e){
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data baptis');
			return json_encode($respond);
			
			// return $e->getMessage();
			// return "Gagal menyimpan data baptis.";
		}
				
	}
		
	public function postAtestasi()
	{			
		
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		// $input = Input::get('data');
		
		$data_valid = array(
			'no_atestasi' => trim($input->{'no_atestasi'}),			
			'tanggal_atestasi' => $input->{'tanggal_atestasi'},			
			'nama_gereja_lama' => trim($input->{'nama_gereja_lama'}),
			'nama_gereja_baru' => trim($input->{'nama_gereja_baru'}),
			'id_jenis_atestasi' => $input->{'id_jenis_atestasi'},
			'id_anggota' => $input->{'id_anggota'}
		);				
		
		//validate
		$validator = Validator::make($data = $data_valid, Atestasi::$rules); 
		
		if ($validator->fails())
		{			
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Bagian yang bertanda (*) harus diisi.');
			return json_encode($respond);
			// return "Bagian yang bertanda (*) harus diisi.";
		}	
		
		/*
			VALIDATE DUPLICATE DATA
				no_atestasi
		*/		
		$duplicate = Atestasi::where('deleted', '=', 0)
					->where('no_atestasi', '=', trim($input->{'no_atestasi'}))					
					->first();
		if(count($duplicate))
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Gagal memasukkan data. Terdapat duplikasi data karena data yang dimasukkan sudah ada.');
			return json_encode($respond);
		}
		
		
		$atestasi = new Atestasi();
		$atestasi->no_atestasi = trim($input->{'no_atestasi'});
		$atestasi->tanggal_atestasi = $input->{'tanggal_atestasi'};
		$atestasi->id_jenis_atestasi = $input->{'id_jenis_atestasi'};		
		$atestasi->nama_gereja_lama = trim($input->{'nama_gereja_lama'});
		$atestasi->nama_gereja_baru = trim($input->{'nama_gereja_baru'});
		$atestasi->id_anggota = $input->{'id_anggota'};		
		$atestasi->keterangan = $input->{'keterangan'};
		$atestasi->deleted = 0;
		if($input->{'id_gereja_lama'} == '')
		{
			$atestasi->id_gereja_lama = null;
		}
		else
		{
			$atestasi->id_gereja_lama = $input->{'id_gereja_lama'};
		}
		if($input->{'id_gereja_baru'} == '')
		{
			$atestasi->id_gereja_baru = null;
		}
		else
		{
			$atestasi->id_gereja_baru = $input->{'id_gereja_baru'};
		}				
		
		
			
		try{
			$atestasi->save();	
			
			$respond = array('code' => '201', 'status' => 'Created', 'messages' => 'Berhasil menyimpan data atestasi.');
			return json_encode($respond);
			/*
			$anggota = Anggota::find($input['id_jemaat']);
		
			if($anggota->id_atestasi == null) //anggota masih blom punya id_atestasi
			{													
				//update id_atestasi anggota
				$anggota->id_atestasi = $atestasi->id;
				try{
					$anggota->save();
					
					return "berhasil";
				}catch(Exception $e){
					//delete atestasi
					$atestasi->delete();
										
					return "Gagal menyimpan data atestasi.";
				}			
			}
			else //anggota udh punya id_atestasi
			{
				//looping sampe data atestasi terakhir milik anggota
				$temp_id_atestasi = $anggota->id_atestasi;
				while($temp_id_atestasi != null)
				{
					$temp_atestasi = Atestasi::find($temp_id_atestasi);
					$temp_id_atestasi = $temp_atestasi->id_atestasi_baru;
				}
				
				//update id_atestasi_baru
				$temp_atestasi->id_atestasi_baru = $atestasi->id;
				try{
					$temp_atestasi->save();
					
					return "berhasil";
				}catch(Exception $e){	
					//delete atestasi
					$atestasi->delete();
					
					// return $e->getMessage();
					return "Gagal menyimpan data atestasi.";
				}
			
			*/
		}catch(Exception $e){
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data atestasi.');
			return json_encode($respond);
			// return "Gagal menyimpan data atestasi.";
		}
		
	}
	
	public function postPernikahan()
	{
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		// $input = Input::get('data');
		
		$data_valid = array(
			'no_pernikahan' => trim($input->{'no_pernikahan'}),			
			'tanggal_pernikahan' => $input->{'tanggal_pernikahan'},
			'id_pendeta' => $input->{'id_pendeta'},
			'nama_pria' => trim($input->{'nama_pria'}),
			'nama_wanita' => trim($input->{'nama_wanita'})
		);				
		
		//validate
		$validator = Validator::make($data = $data_valid, Pernikahan::$rules); 
		
		if ($validator->fails())
		{		
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Bagian yang bertanda (*) harus diisi.');
			return json_encode($respond);
			// return "Bagian yang bertanda (*) harus diisi.";
		}		
		
		/*
			VALIDATE DUPLICATE DATA
				no_pernikahan				
		*/
		$duplicate = Pernikahan::where('deleted', '=', 0)
					->where('no_pernikahan', '=', trim($input->{'no_pernikahan'}))					
					->where('id_gereja', '=', Auth::user()->id_gereja)
					->first();
		if(count($duplicate))
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Gagal memasukkan data. Terdapat duplikasi data karena data yang dimasukkan sudah ada.');
			return json_encode($respond);
		}

		$pernikahan = new Pernikahan();
		$pernikahan->no_pernikahan = trim($input->{'no_pernikahan'});
		$pernikahan->tanggal_pernikahan = $input->{'tanggal_pernikahan'};
		$pernikahan->id_pendeta = $input->{'id_pendeta'};			
		$pernikahan->id_gereja = Auth::user()->id_gereja;
		$pernikahan->nama_pria = trim($input->{'nama_pria'});
		$pernikahan->nama_wanita = trim($input->{'nama_wanita'});
		$pernikahan->keterangan = $input->{'keterangan'};
		$pernikahan->deleted = 0;
		if($input->{'id_jemaat_wanita'} == '')
		{
			$pernikahan->id_jemaat_wanita = null;
		}
		else
		{
			$pernikahan->id_jemaat_wanita = $input->{'id_jemaat_wanita'};
		}
		if($input->{'id_jemaat_pria'} == '')
		{
			$pernikahan->id_jemaat_pria = null;
		}
		else
		{
			$pernikahan->id_jemaat_pria = $input->{'id_jemaat_pria'};
		}
		try{
			$pernikahan->save();
			
			$respond = array('code' => '201', 'status' => 'Created', 'messages' => 'Berhasil menyimpan data pernikahan.');
			return json_encode($respond);
			// return "berhasil";
		}catch(Exception $e){			
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data pernikahan');
			return json_encode($respond);
			// return "Gagal menyimpan data pernikahan.";
		}		
	}
	
	public function postKedukaan()
	{		
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		// $input = Input::get('data');
		
		$data_valid = array(
			'no_kedukaan' => trim($input->{'no_kedukaan'}),			
			'id_jemaat' => $input->{'id_jemaat'},
			'keterangan' => $input->{'keterangan'}
			// 'id_gereja' : $id_gereja,
			// 'tanggal_meninggal' : $tanggal_meninggal
		);				
		
		//validate
		$validator = Validator::make($data = $data_valid, Kedukaan::$rules); 
		
		if ($validator->fails())
		{			
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Bagian yang bertanda (*) harus diisi.');
			return json_encode($respond);
			// return "Bagian yang bertanda (*) harus diisi.";
		}
		if($input->{'tanggal_meninggal'} == '')
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Bagian yang bertanda (*) harus diisi.');
			return json_encode($respond);
			// return "Bagian yang bertanda (*) harus diisi.";
		}
		
		/*
			VALIDATE DUPLICATE DATA
				no_kedukaan				
		*/
		$duplicate = Kedukaan::where('deleted', '=', 0)
					->where('no_kedukaan', '=', trim($input->{'no_kedukaan'}))					
					->where('id_gereja', '=', Auth::user()->id_gereja)
					->first();
		if(count($duplicate))
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Gagal memasukkan data. Terdapat duplikasi data karena data yang dimasukkan sudah ada.');
			return json_encode($respond);
		}
		
		$duka = new Kedukaan();
		$duka->no_kedukaan = trim($input->{'no_kedukaan'});		
		$duka->id_gereja = Auth::user()->id_gereja;
		$duka->id_jemaat = $input->{'id_jemaat'};		
		$duka->keterangan = $input->{'keterangan'};
		$duka->deleted = 0;
		
		try{
			$duka->save();
			
			//save tanggal_meninggal anggota
			$anggota = Anggota::find($input->{'id_jemaat'});
			if(count($anggota) != 0)
			{
				$anggota->tanggal_meninggal = $input->{'tanggal_meninggal'};
				try{
					$anggota->save();
					
					$respond = array('code' => '201', 'status' => 'Created', 'messages' => 'Berhasil menyimpan data kedukaan.');
					return json_encode($respond);
					// return "berhasil";
				}catch(Exception $e){
					//delete duka
					$duka->delete();
							
					$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data kedukaan');
					return json_encode($respond);
					// return "Gagal menyimpan data kedukaan.";
				}
			}
			else
			{
				$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data kedukaan');
				return json_encode($respond);
				// return "Gagal menyimpan data kedukaan.";
			}							
		}catch(Exception $e){			
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data kedukaan');
			return json_encode($respond);
			// return "Gagal menyimpan data kedukaan.";
		}
	}
		
	public function postDkh()
	{
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		// $input = Input::get('data');	
		
		$data_valid = array(
			'no_dkh' => trim($input->{'no_dkh'}),
			'id_jemaat' => $input->{'id_jemaat'},
			'tanggal_dkh' => $input->{'tanggal_dkh'},
			'id_jenis_dkh' => $input->{'id_jenis_dkh'},
			'keterangan' => $input->{'keterangan'}
		);
		
		//validate
		$validator = Validator::make($data = $data_valid, Dkh::$rules);
		
		if($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Bagian yang bertanda (*) harus diisi.');
			return json_encode($respond);
			// return "Bagian yang bertanda (*) harus diisi.";
		}
		
		/*
			VALIDATE DUPLICATE DATA
				no_dkh
		*/
		$duplicate = Dkh::where('deleted', '=', 0)
					->where('no_dkh', '=', trim($input->{'no_dkh'}))										
					->first();
		if(count($duplicate))
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Gagal memasukkan data. Terdapat duplikasi data karena data yang dimasukkan sudah ada.');
			return json_encode($respond);
		}

		$dkh = new Dkh();
		$dkh->no_dkh = trim($input->{'no_dkh'});
		$dkh->id_jemaat = $input->{'id_jemaat'};
		$dkh->tanggal_dkh = $input->{'tanggal_dkh'};
		$dkh->id_jenis_dkh = $input->{'id_jenis_dkh'};
		$dkh->keterangan = $input->{'keterangan'};
		$dkh->deleted = 0;
		try{
			$dkh->save();
			
			$respond = array('code' => '201', 'status' => 'Created', 'messages' => 'Berhasil menyimpan data dkh.');
			return json_encode($respond);
			// return "berhasil";
		}catch(Exception $e){			
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data dkh');
			return json_encode($respond);
			// return "Gagal menyimpan data dkh.";
		}
							
	}
	
/*----------------------------------------EDIT----------------------------------------*/	
		
	
}

?>