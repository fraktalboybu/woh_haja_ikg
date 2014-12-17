<?php

use Carbon\Carbon;

class InputEditAdminController extends BaseController {
	
	public function admin_view_input_auth()
	{
		return View::make('pages.admin.input_auth');
	}
	
	public function admin_view_input_gereja()
	{
		$list_status_gereja = $this->getListStatusGereja();
		$list_gereja = $this->getListGereja();	
		$data_gereja = $this->getDataGereja();		
		return View::make('pages.admin.input_gereja', compact('list_status_gereja','list_gereja','data_gereja'));
	}
	
	public function admin_view_input_jenis_baptis()
	{
		$data_jenis_baptis = $this->getDataJenisBaptis();
		return View::make('pages.admin.input_jenisbaptis', compact('data_jenis_baptis'));
	}
	
	public function admin_view_input_jenis_atesasi()
	{
		$data_jenis_atestasi = $this->getDataJenisAtestasi();
		return View::make('pages.admin.input_jenisatestasi', compact('data_jenis_atestasi'));
	}
	
	public function admin_view_input_jenis_kegiatan()
	{
		$data_jenis_kegiatan = $this->getDataJenisKegiatan();
		return View::make('pages.admin.input_jeniskegiatan', compact('data_jenis_kegiatan'));
	}

/*----------------------------------------GET----------------------------------------*/

	public function getDataGereja()
	{
		$gereja = Gereja::all();
		if(count($gereja) == 0)
		{
			return null;
		}		
		else
		{
			return $gereja;
		}
	}
	
	public function getDataJenisAtestasi()
	{
		$jenis_atestasi = JenisAtestasi::all();
		if(count($jenis_atestasi) == 0)
		{
			return null;
		}		
		else
		{
			return $jenis_atestasi;
		}
	
	
	public function getDataJenisBaptis()
	{
		$jenis_baptis = JenisBaptis::all();
		if(count($jenis_baptis) == 0)
		{
			return null;
		}		
		else
		{
			return $jenis_baptis;
		}
	}
	
	public function getDataJenisKegiatan()
	{
		$jenis_kegiatan = JenisKegiatan::all();
		if(count($jenis_kegiatan) == 0)
		{
			return null;
		}		
		else
		{
			return $jenis_kegiatan;
		}
	}
	
/*----------------------------------------POST----------------------------------------*/	

	public function admin_postAuth()
	{
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
				
		return null;
	}
	
	public function admin_postGereja()
	{
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		$nama = $input->{'nama'};
		$alamat = $input->{'alamat'};
		$kota = $input->{'kota'};
		$kodepos = $input->{'kodepos'};
		$telp = $input->{'telp'};		
		$status = $input->{'status'};
		$id_parent_gereja = $input->{'id_parent_gereja'}; //kalo null maka -1
		// deleted
		
		$data_valid = array(
			'nama' => $nama,
			'alamat' => $alamat,
			'kota' => $kota,
			'kodepos' => $kodepos,
			'telp' => $telp,
			'status' => $status
		);
		
		//validate
		$validator = Validator::make($data = $data_valid, Gereja::$rules); 								
		if($validator->fails())
		{			
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Bagian yang bertanda (*) harus diisi.');
			return json_encode($respond);			
		}
		
		$gereja = new Gereja();
		
		$gereja->nama = $nama;
		$gereja->alamat = $alamat;
		$gereja->kota = $kota;
		$gereja->kodepos = $kodepos;
		$gereja->telp = $telp;
		if($id_parent_gereja == -1)
		{
			$gereja->id_parent_gereja = null;
		}
		else
		{
			$gereja->id_parent_gereja = $id_parent_gereja;
		}			
		$gereja->status = $status;
		$gereja->deleted = 0;
		
		try{
			$gereja->save();
			
			$respond = array('code' => '201', 'status' => 'Created', 'messages' => 'Berhasil menyimpan data gereja.');
			return json_encode($respond);
		}catch(Exception $e){
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data gereja');
			return json_encode($respond);
		}
						
	}
	
	public function admin_postJenisBaptis()
	{
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		$nama_jenis_baptis = $input->{'nama_jenis_baptis'};
		$keterangan = $input->{'keterangan'};
		
		$data_valid = array(
			'nama_jenis_baptis' => $nama_jenis_baptis,
			'keterangan' =>	$keterangan
		);
		
		//validate
		$validator = Validator::make($data = $data_valid, JenisBaptis::$rules); 								
		if($validator->fails())
		{			
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Bagian yang bertanda (*) harus diisi.');
			return json_encode($respond);			
		}
		
		$jenis_baptis = new JenisBaptis();

		$jenis_baptis->nama_jenis_baptis = $nama_jenis_baptis;
		$jenis_baptis->keterangan = $keterangan;
		$jenis_baptis->deleted = 0;
				
		try{
			$jenis_baptis->save();
			
			$respond = array('code' => '201', 'status' => 'Created', 'messages' => 'Berhasil menyimpan data jenis baptis.');
			return json_encode($respond);
		}Catch(Exception $e){
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data jenis baptis');
			return json_encode($respond);
		}
	}
	
	public function admin_postJenisAtestasi()
	{
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		$nama_atestasi = $input->{'nama_atestasi'};
		$keterangan = $input->{'keterangan'};
		
		$data_valid = array(
			'nama_atestasi' => $nama_atestasi,
			'keterangan' =>	$keterangan
		);
		
		//validate
		$validator = Validator::make($data = $data_valid, JenisAtestasi::$rules); 								
		if($validator->fails())
		{			
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Bagian yang bertanda (*) harus diisi.');
			return json_encode($respond);			
		}
		
		$jenis_atestasi = new JenisAtestasi();

		$jenis_atestasi->nama_atestasi = $nama_atestasi;
		$jenis_atestasi->keterangan = $keterangan;
		$jenis_atestasi->deleted = 0;
				
		try{
			$jenis_atestasi->save();
			
			$respond = array('code' => '201', 'status' => 'Created', 'messages' => 'Berhasil menyimpan data jenis atestasi.');
			return json_encode($respond);
		}Catch(Exception $e){
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data jenis atestasi');
			return json_encode($respond);
		}
	}
	
	public function admin_postJenisKegiatan()
	{
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		$nama_kegiatan = $input->{'nama_kegiatan'};
		$keterangan = $input->{'keterangan'};
		
		$data_valid = array(
			'nama_kegiatan' => $nama_kegiatan,
			'keterangan' =>	$keterangan
		);
		
		//validate
		$validator = Validator::make($data = $data_valid, JenisKegiatan::$rules); 								
		if($validator->fails())
		{			
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Bagian yang bertanda (*) harus diisi.');
			return json_encode($respond);			
		}
		
		$jenis_kegiatan = new JenisKegiatan();

		$jenis_kegiatan->nama_kegiatan = $nama_kegiatan;
		$jenis_kegiatan->keterangan = $keterangan;
		$jenis_kegiatan->deleted = 0;
				
		try{
			$jenis_kegiatan->save();
			
			$respond = array('code' => '201', 'status' => 'Created', 'messages' => 'Berhasil menyimpan data jenis kegiatan.');
			return json_encode($respond);
		}Catch(Exception $e){
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data jenis kegiatan');
			return json_encode($respond);
		}
	}
	
/*----------------------------------------EDIT----------------------------------------*/	
	
	public function admin_edit_auth()
	{		
		return null;
	}
	
	public function admin_edit_gereja()
	{
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		$id = $input->{'id'};
		
		$nama = $input->{'nama'};
		$alamat = $input->{'alamat'};
		$kota = $input->{'kota'};
		$kodepos = $input->{'kodepos'};
		$telp = $input->{'telp'};
		$id_parent_gereja = $input->{'id_parent_gereja'}; //kalo null maka -1
		$status = $input->{'status'};
		// deleted
		
		$data_valid = array(
			'nama' => $nama,
			'alamat' => $alamat,
			'kota' => $kota,
			'kodepos' => $kodepos,
			'telp' => $telp,
			'status' => $status
		);
		
		//validate
		$validator = Validator::make($data = $data_valid, Gereja::$rules); 								
		if($validator->fails())
		{			
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Bagian yang bertanda (*) harus diisi.');
			return json_encode($respond);			
		}
		
		$gereja = Gereja::find($id);
		
		if($gereja == null)
		{
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan perubahan.');
			return json_encode($respond);
		}
		else
		{		
			$gereja->nama = $nama;
			$gereja->alamat = $alamat;
			$gereja->kota = $kota;
			$gereja->kodepos = $kodepos;
			$gereja->telp = $telp;
			if($id_parent_gereja == -1)
			{
				$gereja->id_parent_gereja = null;
			}
			else
			{
				$gereja->id_parent_gereja = $id_parent_gereja;
			}			
			$gereja->status = $status;
			$gereja->deleted = 0;
			
			try{
				$gereja->save();
				
				$respond = array('code' => '200', 'status' => 'OK', 'messages' => 'Berhasil menyimpan perubahan.');
				return json_encode($respond);
			}catch(Exception $e){
				$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data gereja');
				return json_encode($respond);
			}	
		}
	}
	
	public function admin_edit_jenis_baptis()
	{
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		$id = $input->{'id'};
		
		$nama_jenis_baptis = $input->{'nama_jenis_baptis'};
		$keterangan = $input->{'keterangan'};
		
		$data_valid = array(
			'nama_jenis_baptis' => $nama_jenis_baptis,
			'keterangan' =>	$keterangan
		);
		
		//validate
		$validator = Validator::make($data = $data_valid, JenisBaptis::$rules); 								
		if($validator->fails())
		{			
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Bagian yang bertanda (*) harus diisi.');
			return json_encode($respond);			
		}
		
		$jenis_baptis = JenisBaptis::find($id);

		if($jenis_baptis == null)
		{
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan perubahan.');
			return json_encode($respond);
		}
		else
		{		
			$jenis_baptis->nama_jenis_baptis = $nama_jenis_baptis;
			$jenis_baptis->keterangan = $keterangan;
			$jenis_baptis->deleted = 0;
					
			try{
				$jenis_baptis->save();
				
				$respond = array('code' => '200', 'status' => 'OK', 'messages' => 'Berhasil menyimpan perubahan.');
				return json_encode($respond);
			}Catch(Exception $e){
				$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data jenis baptis');
				return json_encode($respond);
			}
		}	
	}
	
	public function admin_edit_jenis_atesasi()
	{
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		$id = $input->{'id'};
		
		$nama_atestasi = $input->{'nama_atestasi'};
		$keterangan = $input->{'keterangan'};
		
		$data_valid = array(
			'nama_atestasi' => $nama_atestasi,
			'keterangan' =>	$keterangan
		);
		
		//validate
		$validator = Validator::make($data = $data_valid, JenisAtestasi::$rules); 								
		if($validator->fails())
		{			
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Bagian yang bertanda (*) harus diisi.');
			return json_encode($respond);			
		}
		
		$jenis_atestasi = JenisAtestasi::find($id);

		if($jenis_atestasi == null)
		{
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan perubahan.');
			return json_encode($respond);
		}
		else
		{
			$jenis_atestasi->nama_atestasi = $nama_atestasi;
			$jenis_atestasi->keterangan = $keterangan;
			$jenis_atestasi->deleted = 0;
					
			try{
				$jenis_atestasi->save();
				
				$respond = array('code' => '200', 'status' => 'OK', 'messages' => 'Berhasil menyimpan perubahan.');
				return json_encode($respond);
			}Catch(Exception $e){
				$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data jenis atestasi');
				return json_encode($respond);
			}
		}	
	}
	
	public function admin_edit_jenis_kegiatan()
	{
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		$id = $input->{'id'};
		
		$nama_kegiatan = $input->{'nama_kegiatan'};
		$keterangan = $input->{'keterangan'};
		
		$data_valid = array(
			'nama_kegiatan' => $nama_kegiatan,
			'keterangan' =>	$keterangan
		);
		
		//validate
		$validator = Validator::make($data = $data_valid, JenisKegiatan::$rules); 								
		if($validator->fails())
		{			
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => 'Bagian yang bertanda (*) harus diisi.');
			return json_encode($respond);			
		}
		
		$jenis_kegiatan = JenisKegiatan::find($id);

		if($jenis_kegiatan == null)
		{
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan perubahan.');
			return json_encode($respond);
		}
		else
		{
			$jenis_kegiatan->nama_kegiatan = $nama_kegiatan;
			$jenis_kegiatan->keterangan = $keterangan;
			$jenis_kegiatan->deleted = 0;
					
			try{
				$jenis_kegiatan->save();
				
				$respond = array('code' => '200', 'status' => 'OK', 'messages' => 'Berhasil menyimpan perubahan.');
				return json_encode($respond);
			}Catch(Exception $e){
				$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data jenis kegiatan');
				return json_encode($respond);
			}
		}
	}
	
/*----------------------------------------VISIBLE----------------------------------------*/		

	public function admin_change_visible_gereja()
	{
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		$id = $input->{'id'};				
		
		$gereja = Gereja::find($id);
		
		if($gereja == null)
		{
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan perubahan.');
			return json_encode($respond);
		}
		else
		{		
			if($gereja->deleted == 0)
			{
				$gereja->deleted = 1;
			}
			else
			{
				$gereja->deleted = 0;
			}			
			
			try{
				$gereja->save();
				
				$respond = array('code' => '200', 'status' => 'OK', 'messages' => 'Berhasil menyimpan perubahan.');
				return json_encode($respond);
			}catch(Exception $e){
				$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data gereja');
				return json_encode($respond);
			}	
		}
	}
	
	public function admin_change_visible_jenis_baptis()
	{
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		$id = $input->{'id'};				
		
		$jenis_baptis = JenisBaptis::find($id);
		
		if($jenis_baptis == null)
		{
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan perubahan.');
			return json_encode($respond);
		}
		else
		{		
			if($jenis_baptis->deleted == 0)
			{
				$jenis_baptis->deleted = 1;
			}
			else
			{
				$jenis_baptis->deleted = 0;
			}			
			
			try{
				$jenis_baptis->save();
				
				$respond = array('code' => '200', 'status' => 'OK', 'messages' => 'Berhasil menyimpan perubahan.');
				return json_encode($respond);
			}catch(Exception $e){
				$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data gereja');
				return json_encode($respond);
			}	
		}
	}
	
	public function admin_change_visible_jenis_atestasi()
	{
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		$id = $input->{'id'};				
		
		$jenis_atestasi = JenisAtestasi::find($id);
		
		if($jenis_atestasi == null)
		{
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan perubahan.');
			return json_encode($respond);
		}
		else
		{		
			if($jenis_atestasi->deleted == 0)
			{
				$jenis_atestasi->deleted = 1;
			}
			else
			{
				$jenis_atestasi->deleted = 0;
			}			
			
			try{
				$jenis_atestasi->save();
				
				$respond = array('code' => '200', 'status' => 'OK', 'messages' => 'Berhasil menyimpan perubahan.');
				return json_encode($respond);
			}catch(Exception $e){
				$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data gereja');
				return json_encode($respond);
			}	
		}
	}
	
	public function admin_change_visible_jenis_kegiatan()
	{
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		$id = $input->{'id'};				
		
		$jenis_kegiatan = JenisKegiatan::find($id);
		
		if($jenis_kegiatan == null)
		{
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan perubahan.');
			return json_encode($respond);
		}
		else
		{		
			if($jenis_kegiatan->deleted == 0)
			{
				$jenis_kegiatan->deleted = 1;
			}
			else
			{
				$jenis_kegiatan->deleted = 0;
			}			
			
			try{
				$jenis_kegiatan->save();
				
				$respond = array('code' => '200', 'status' => 'OK', 'messages' => 'Berhasil menyimpan perubahan.');
				return json_encode($respond);
			}catch(Exception $e){
				$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menyimpan data gereja');
				return json_encode($respond);
			}	
		}
	}

/*----------------------------------------DELETE----------------------------------------*/		
	
	public function admin_delete_gereja()
	{
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		$id = $input->{'id'};
		
		$gereja = Gereja::find($id);
		
		try{						
			$gereja->delete();
			
			$respond = array('code' => '204', 'status' => 'No Content', 'messages' => 'Berhasil menghapus data.');
			return json_encode($respond);			
		}catch(Exception $e){
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menghapus data.');
			return json_encode($respond);						
		}
	}
	
	public function admin_delete_jenis_baptis()
	{
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		$id = $input->{'id'};
		
		$jenis_baptis = JenisBaptis::find($id);
		
		try{						
			$jenis_baptis->delete();
			
			$respond = array('code' => '204', 'status' => 'No Content', 'messages' => 'Berhasil menghapus data.');
			return json_encode($respond);			
		}catch(Exception $e){
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menghapus data.');
			return json_encode($respond);						
		}
	}
	
	public function admin_delete_jenis_atestasi()
	{
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		$id = $input->{'id'};
		
		$jenis_atestasi = JenisAtestasi::find($id);
		
		try{						
			$jenis_atestasi->delete();
			
			$respond = array('code' => '204', 'status' => 'No Content', 'messages' => 'Berhasil menghapus data.');
			return json_encode($respond);			
		}catch(Exception $e){
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menghapus data.');
			return json_encode($respond);						
		}
	}
	
	public function admin_delete_jenis_kegiatan()
	{
		$json_data = Input::get('json_data');
		$input = json_decode($json_data);
		
		$id = $input->{'id'};
		
		$jenis_kegiatan = JenisKegiatan::find($id);
		
		try{						
			$jenis_kegiatan->delete();
			
			$respond = array('code' => '204', 'status' => 'No Content', 'messages' => 'Berhasil menghapus data.');
			return json_encode($respond);			
		}catch(Exception $e){
			$respond = array('code' => '500', 'status' => 'Internal Server Error', 'messages' => 'Gagal menghapus data.');
			return json_encode($respond);						
		}
	}
	
}

?>