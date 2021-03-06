@extends('layouts.user_layout')
@section('content')


<script>
$(document).ready(function(){				
	
	//END LOADER				
	$('.f_loader_container').addClass('hidden');
				
	$('#f_nama_kebaktian').attr('disabled', true);		
	$('#f_kebaktian_ke').attr('disabled', false);				

		//set nama kebaktian di awal
		var selected = $('#f_kebaktian_ke').find(":selected").text();
		$('#f_nama_kebaktian').val(selected);	
	
	
	$('#f_nama_pengkotbah').attr('disabled', true);		
	$('#f_pengkotbah').attr('disabled', false);				

		//set nama pembicara di awal
		var selected = $('#f_pengkotbah').find(":selected").text();
		$('#f_nama_pengkotbah').val(selected);	
		
});
</script>

<!-- <div class="s_sidebar"> -->
<!-- input data-->

<!-- olahdata -->
	<!--
	<ul>
		<li>{{HTML::linkRoute('view_olahdata_kebaktian', 'Olah Data Kebaktian')}}</li>
		<li>{{HTML::linkRoute('view_olahdata_anggota', 'Olah Data Anggota')}}</li>
		<li>{{HTML::linkRoute('view_olahdata_baptis', 'Olah Data Baptis')}}</li>
		<li>{{HTML::linkRoute('view_olahdata_atestasi', 'Olah Data Atestasi')}}</li>
		<li>{{HTML::linkRoute('view_olahdata_pernikahan', 'Olah Data Pernikahan')}}</li>
		<li>{{HTML::linkRoute('view_olahdata_kedukaan', 'Olah Data Kedukaan')}}</li>
		<li>{{HTML::linkRoute('view_olahdata_dkh', 'Olah Data Dkh')}}</li>
	</ul>
-->
<!-- </div> -->



<div class="s_content_maindiv" style="overflow: hidden;">
	<!-- <div class="s_sidebar_main" style="width:200px; background-color:white;"> -->
	<div class="s_sidebar_main" style="width:200px; background-color:white;">
		<div>
			@include('includes.sidebar.sidebar_user_inputdata')
		</div>		
	</div>
	<div class="s_main_side" style="">
		<!-- css -->
		<style>

		</style>
		<!-- end css -->

		<!--<ol class="breadcrumb">
			<li><a href="#">Input Data</a></li>
			<li class="active">Kebaktian</li>
		</ol>-->
	
		<div class="s_content">
			<div class="container-fluid">
				<!--<div class="col-md-3 panel panel-default ">					
					<ul>		
						<li>{{HTML::linkRoute('view_inputdata_kebaktian', 'Input Data Kebaktian')}}</li>
						<li>{{HTML::linkRoute('view_inputdata_anggota', 'Input Data Anggota')}}</li>
						<li>{{HTML::linkRoute('view_inputdata_baptis', 'Input Data Baptis')}}</li>
						<li>{{HTML::linkRoute('view_inputdata_atestasi', 'Input Data Atestasi')}}</li>
						<li>{{HTML::linkRoute('view_inputdata_pernikahan', 'Input Data Pernikahan')}}</li>
						<li>{{HTML::linkRoute('view_inputdata_kedukaan', 'Input Data Kedukaan')}}</li>
						<li>{{HTML::linkRoute('view_inputdata_dkh', 'Input Data Dkh')}}</li>
					</ul>					
				</div>-->
				
				<!--div class="panel panel-default col-md-12"-->
				<div style="margin-top: 15px;" class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">
							KEBAKTIAN
						</h3>
					</div>
					<div class="panel-body">
						<form class="form-horizontal">							
							<div class="pull-right" style="position:relative;">
								<input type="button" value="Help ?" id="f_video_input_kebaktian" class="btn btn-danger" data-toggle="modal" data-target=".popup_video_input_kebaktian" />
							</div>															
							<div class="form-group">
								<label class="col-xs-4 control-label">Kebaktian</label>
								<div class="col-xs-4">
									@if($list_jenis_kegiatan == null)
										<p class="control-label pull-left">(tidak ada daftar kegiatan)</p>
									@else
										{{Form::select('kebaktian_ke', $list_jenis_kegiatan, Input::old('kebaktian_ke'), array('id'=>'f_kebaktian_ke', 'class'=>'form-control', 'disabled' => false))}} 
									@endif	
									<!--
									<div class="checkbox">
										<label>
											<input id="f_check_kebaktian_lain" type="checkbox" name="kebaktian_lain" value="0" /> Kebaktian Lain
										</label>
									</div>
									-->
								</div>		
								<div class="col-xs-0">								
									<input id="f_check_kebaktian_lain" type="checkbox" name="kebaktian_lain" value="0" /> Kebaktian Lain									
								</div>								
							</div>
							
							<div class="form-group">
								<label class="col-xs-4 control-label">Nama Kebaktian</label>
								<div class="col-xs-4">
									{{Form::text('nama_kebaktian', Input::old('nama_kebaktian') , array('id' => 'f_nama_kebaktian', 'disabled' => true , 'class'=>'form-control', 'placeholder'=>'(maksimum 25 karakter)'))}}
								</div>
								<div class="col-xs-0">
									* 
								</div>								
							</div>

							<div class="form-group">
								<label class="col-xs-4 control-label">Pengkotbah</label>
								<div class="col-xs-4">
									@if($list_pembicara == null)
										<p class="control-label pull-left">(tidak ada daftar pengkotbah)</p>
									@else
										{{Form::select('pengkotbah', $list_pembicara, Input::old('pengkotbah'), array('id'=>'f_pengkotbah','class'=>'form-control', 'disabled' => false))}}	 	
									@endif	
									<!--
									<div class="checkbox">
										<label>
											<input id="f_check_pembicara_luar" type="checkbox" name="pembicara_luar" value="0" /> Pembicara Luar
										</label>
									</div>
									-->
								</div>
								<div class="col-xs-0">
									<input id="f_check_pembicara_luar" type="checkbox" name="pembicara_luar" value="0" /> Pembicara Luar
									
								</div>								
							</div>

							<div class="form-group">
								<label class="col-xs-4 control-label">Nama Pengkotbah</label>
								<div class="col-xs-4">
									{{Form::text('nama_pengkotbah', Input::old('nama_pengkotbah') , array('id' => 'f_nama_pengkotbah', 'disabled' => true , 'class'=>'form-control'))}} 
								</div>
								<div class="col-xs-0">
									*
								</div>
							</div>

							<div class="form-group">
								<label class="col-xs-4 control-label">Tanggal Mulai - Tanggal Selesai</label>
								
								<div class="col-xs-2">
									{{ Form::text('tanggal_mulai', Input::old('tanggal_mulai'), array('id' => 'f_tanggal_mulai', 'class'=>'form-control')) }}
								</div>						
								<div class="col-xs-2">
									{{ Form::text('tanggal_selesai', Input::old('tanggal_selesai'), array('id' => 'f_tanggal_selesai', 'class'=>'form-control')) }} 
								</div>
								<div class="col-xs-0">
									* 
								</div>
								
							</div>

							<div class="form-group">
								<label class="col-xs-4 control-label">Jam Mulai - Jam Selesai</label>

								<div class="col-xs-1">
									{{ Form::text('jam_mulai', Input::old('jam_mulai'), array('id' => 'f_jam_mulai', 'class'=>'form-control')) }} 
								</div>								
								<div class="col-xs-1">
									{{ Form::text('jam_selesai', Input::old('jam_selesai'), array('id' => 'f_jam_selesai', 'class'=>'form-control')) }} 
								</div>
								<div class="col-xs-0">
									* 
								</div>
							</div>	
								
							<div class="form-group">
								<label class="col-xs-4 control-label">Banyak Jemaat Pria, Banyak Jemaat Wanita</label>

								<div class="col-xs-2">
									{{Form::text('banyak_jemaat_pria', Input::old('banyak_jemaat_pria'), array('id'=>'f_banyak_jemaat_pria', 'class'=>'form-control','onkeypress'=>'return isNumberKey(event)'))}} 
								</div>
								<div class="col-xs-2">	
									{{Form::text('banyak_jemaat_wanita', Input::old('banyak_jemaat_wanita'), array('id'=>'f_banyak_jemaat_wanita', 'class'=>'form-control','onkeypress'=>'return isNumberKey(event)'))}}
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-4 control-label">Banyak Seluruh Jemaat</label>
								<div class="col-xs-2">
									{{Form::text('banyak_jemaat', Input::old('banyak_jemaat'), array('id'=>'f_banyak_jemaat', 'class'=>'form-control','onkeypress'=>'return isNumberKey(event)'))}} 
								</div>
								<div class="col-xs-0">
									* 
								</div>
							</div>

							<div class="form-group">
								<label class="col-xs-4 control-label">
									Banyak Simpatisan Pria dan Wanita
								</label>

								<div class="col-xs-2">
									{{Form::text('banyak_simpatisan_pria', Input::old('banyak_simpatisan_pria'), array('id'=>'f_banyak_simpatisan_pria', 'class'=>'form-control','onkeypress'=>'return isNumberKey(event)'))}} 
								</div>
								<div class="col-xs-2">
									{{Form::text('banyak_simpatisan_wanita', Input::old('banyak_simpatisan_wanita'), array('id'=>'f_banyak_simpatisan_wanita', 'class'=>'form-control','onkeypress'=>'return isNumberKey(event)'))}}
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-4 control-label">
									Banyak Seluruh Simpatisan
								</label>

								<div class="col-xs-2">
									{{Form::text('banyak_simpatisan', Input::old('banyak_simpatisan'), array('id'=>'f_banyak_simpatisan', 'class'=>'form-control','onkeypress'=>'return isNumberKey(event)'))}} 
								</div>
								<div class="col-xs-0">
									* 
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-4 control-label">
									Banyak Penatua Pria dan Wanita
								</label>

								<div class="col-xs-2">
									{{Form::text('banyak_penatua_pria', Input::old('banyak_penatua_pria'), array('id'=>'f_banyak_penatua_pria', 'class'=>'form-control','onkeypress'=>'return isNumberKey(event)'))}} 
								</div>
								<div class="col-xs-2">
									{{Form::text('banyak_penatua_wanita', Input::old('banyak_penatua_wanita'), array('id'=>'f_banyak_penatua_wanita', 'class'=>'form-control','onkeypress'=>'return isNumberKey(event)'))}}
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-4 control-label">
									Banyak Seluruh Penatua
								</label>

								<div class="col-xs-2">
									{{Form::text('banyak_penatua', Input::old('banyak_penatua'), array('id'=>'f_banyak_penatua', 'class'=>'form-control','onkeypress'=>'return isNumberKey(event)'))}} 									
								</div>
								<div class="col-xs-0">
									* 
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-4 control-label">
									Banyak Pemusik Pri dan Wanita
								</label>
								<div class="col-xs-2">
									{{Form::text('banyak_pemusik_pria', Input::old('banyak_pemusik_pria'), array('id'=>'f_banyak_pemusik_pria', 'class'=>'form-control','onkeypress'=>'return isNumberKey(event)'))}}
								</div>
								<div class="col-xs-2">
									{{Form::text('banyak_pemusik_wanita', Input::old('banyak_pemusik_wanita'), array('id'=>'f_banyak_pemusik_wanita', 'class'=>'form-control','onkeypress'=>'return isNumberKey(event)'))}}
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-4 control-label">
									Banyak Seluruh Pemusik
								</label>

								<div class="col-xs-2">
									{{Form::text('banyak_pemusik', Input::old('banyak_pemusik'), array('id'=>'f_banyak_pemusik', 'class'=>'form-control','onkeypress'=>'return isNumberKey(event)'))}} 
								</div>
								<div class="col-xs-0">
									* 
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-4 control-label">
									Banyak Komisi Pria dan Wanita
								</label>

								<div class="col-xs-2">
									{{Form::text('banyak_komisi_pria', Input::old('banyak_komisi_pria'), array('id'=>'f_banyak_komisi_pria', 'class'=>'form-control','onkeypress'=>'return isNumberKey(event)'))}}
								</div>
								<div class="col-xs-2">
									{{Form::text('banyak_komisi_wanita', Input::old('banyak_komisi_wanita'), array('id'=>'f_banyak_komisi_wanita', 'class'=>'form-control','onkeypress'=>'return isNumberKey(event)'))}}
								</div>
							</div>
							<div class="form-group">
								<label class="col-xs-4 control-label">
									Banyak Seluruh Komisi
								</label>

								<div class="col-xs-2">
									{{Form::text('banyak_komisi', Input::old('banyak_komisi'), array('id'=>'f_banyak_komisi', 'class'=>'form-control','onkeypress'=>'return isNumberKey(event)'))}} 
								</div>
								<div class="col-xs-0">
									* 
								</div>
							</div>	

							<div class="form-group">
								<label class="col-xs-4 control-label">
									Jumlah Persembahan
								</label>
								<div class="col-xs-3">
									 <div class="input-group">
										<span class="input-group-addon">Rp.</span>
										{{Form::text('jumlah_persembahan', Input::old('jumlah_persembahan'), array('id'=>'f_jumlah_persembahan', 'class'=>'form-control','onkeypress'=>'return isNumberKey(event)'))}} 
									</div>
								</div>
								<div class="col-xs-0">
									* 
								</div>								
							</div>
							<div class="form-group">
								<label class="col-xs-4 control-label">
									Keterangan
								</label>
								<div class="col-xs-6">
									{{Form::textarea('keterangan', Input::old('keterangan'), array('id'=>'f_keterangan', 'class'=>'form-control'))}}
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-6 col-xs-push-5">
									@if($list_jenis_kegiatan == null || $list_pembicara == null)
										<input type="button" value="Simpan Data Kebaktian" id="f_post_kebaktian" class="btn btn-success" disabled=true />
									@else
										<input type="button" value="Simpan Data Kebaktian" id="f_post_kebaktian" class="btn btn-success" data-toggle="modal" data-target=".popup_confirm_warning_kebaktian" />
									@endif 							
								</div>
							</div>
						</form>	
					</div>
					<div class="panel-footer" style="background-color: white;">
						(*) wajib diisi
					</div>
				</div>	
			</div>	
		</div>	
	</div>
</div>	

<script>
	function numberWithCommas(evt) {
		$('#f_jumlah_persembahan').val(evt.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
		// return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	$('body').on('change','#f_kebaktian_ke', function(){
		var selected = $('#f_kebaktian_ke').find(":selected").text();
		$('#f_nama_kebaktian').val(selected);					
	});
	
	$('body').on('change','#f_pengkotbah', function(){
		var selected = $('#f_pengkotbah').find(":selected").text();
		$('#f_nama_pengkotbah').val(selected);					
	});
	
	jQuery('#f_tanggal_mulai').datetimepicker({
		lang:'en',
		i18n:{
			en:{
				months:[
				'Januari','Februari','Maret','April',
				'Mei','Juni','Juli','Agustus',
				'September','Oktober','November','Desember',
				],
				dayOfWeek:[
				"Ming.", "Sen.", "Sel.", "Rab.", 
				"Kam.", "Jum.", "Sab.",
				]

			}
		},
		timepicker:false,
		format: 'Y-m-d',
		yearStart: '1900'
	});
	
	jQuery('#f_tanggal_selesai').datetimepicker({
		lang:'en',
		i18n:{
			en:{
				months:[
				'Januari','Februari','Maret','April',
				'Mei','Juni','Juli','Agustus',
				'September','Oktober','November','Desember',
				],
				dayOfWeek:[
				"Ming.", "Sen.", "Sel.", "Rab.", 
				"Kam.", "Jum.", "Sab.",
				]

			}
		},
		timepicker:false,
		format: 'Y-m-d',
		yearStart: '1900'
	});
	
	jQuery('#f_jam_mulai').datetimepicker({
		datepicker:false,
		 // allowTimes:[
		  // '12:00', '13:00', '15:00', 
		  // '17:00', '17:05', '17:20', '19:00', '20:00'
		 // ]
		 format:'H:i'
		});
		
	jQuery('#f_jam_selesai').datetimepicker({
		datepicker:false,
		format:'H:i'
	});
	
	$('body').on('click', '#f_check_kebaktian_lain', function(){		
		if($('#f_check_kebaktian_lain').val() == 0){	
			$('#f_check_kebaktian_lain').val(1); //pakai pembicara luar jika value f_check_pembicara_luar == 1
			$('#f_nama_kebaktian').attr('disabled', false);			
			$('#f_nama_kebaktian').val("");
			$('#f_kebaktian_ke').attr('disabled', true);								
		}
		else
		{
			$('#f_check_kebaktian_lain').val(0); //tidak pakai pembicara luar jika value f_check_pembicara_luar == 0
			$('#f_nama_kebaktian').attr('disabled', true);				
			selected = $('#f_kebaktian_ke').find(":selected").text();
			$('#f_nama_kebaktian').val(selected);	
			$('#f_kebaktian_ke').attr('disabled', false);				
		}
	});
	
	$('body').on('click', '#f_check_pembicara_luar', function(){		
		if($('#f_check_pembicara_luar').val() == 0){	
			$('#f_check_pembicara_luar').val(1); //pakai pembicara luar jika value f_check_pembicara_luar == 1
			$('#f_nama_pengkotbah').attr('disabled', false);			
			$('#f_nama_pengkotbah').val("");
			$('#f_pengkotbah').attr('disabled', true);								
		}
		else
		{
			$('#f_check_pembicara_luar').val(0); //tidak pakai pembicara luar jika value f_check_pembicara_luar == 0
			$('#f_nama_pengkotbah').attr('disabled', true);				
			selected = $('#f_pengkotbah').find(":selected").text();
			$('#f_nama_pengkotbah').val(selected);	
			$('#f_pengkotbah').attr('disabled', false);				
		}
	});
		

	//banyak_jemaat
	$('body').on('change','#f_banyak_jemaat_pria',function(){
		var jemaat_pria = parseInt($('#f_banyak_jemaat_pria').val());		
		var jemaat_wanita = parseInt($('#f_banyak_jemaat_wanita').val());		
		if(isNaN(jemaat_pria))
		{
			jemaat_pria = 0;
		}
		if(isNaN(jemaat_wanita))
		{
			jemaat_wanita = 0;
		}
		$('#f_banyak_jemaat').val(jemaat_pria+jemaat_wanita);
	});
	$('body').on('change','#f_banyak_jemaat_wanita',function(){
		var jemaat_pria = parseInt($('#f_banyak_jemaat_pria').val());		
		var jemaat_wanita = parseInt($('#f_banyak_jemaat_wanita').val());
		if(isNaN(jemaat_pria))
		{			
			jemaat_pria = 0;
		}
		if(isNaN(jemaat_wanita))
		{
			jemaat_wanita = 0;
		}
		$('#f_banyak_jemaat').val(jemaat_pria+jemaat_wanita);
	});		
	$('body').on('change','#f_banyak_jemaat',function(){
		$('#f_banyak_jemaat_pria').val('');
		$('#f_banyak_jemaat_wanita').val('');		
	});		
	
	//banyak_simpatisan
	$('body').on('change','#f_banyak_simpatisan_pria',function(){
		var simpatisan_pria = parseInt($('#f_banyak_simpatisan_pria').val());		
		var simpatisan_wanita = parseInt($('#f_banyak_simpatisan_wanita').val());
		if(isNaN(simpatisan_pria))
		{
			simpatisan_pria = 0;
		}
		if(isNaN(simpatisan_wanita))
		{
			simpatisan_wanita = 0;
		}
		$('#f_banyak_simpatisan').val(simpatisan_pria+simpatisan_wanita);
	});
	$('body').on('change','#f_banyak_simpatisan_wanita',function(){
		var simpatisan_pria = parseInt($('#f_banyak_simpatisan_pria').val());
		var simpatisan_wanita = parseInt($('#f_banyak_simpatisan_wanita').val());
		if(isNaN(simpatisan_pria))
		{
			simpatisan_pria = 0;
		}
		if(isNaN(simpatisan_wanita))
		{
			simpatisan_wanita = 0;
		}
		$('#f_banyak_simpatisan').val(simpatisan_pria+simpatisan_wanita);
	});		
	$('body').on('change','#f_banyak_simpatisan',function(){
		$('#f_banyak_simpatisan_pria').val('');
		$('#f_banyak_simpatisan_wanita').val('');		
	});
	
	//banyak_penatua
	$('body').on('change','#f_banyak_penatua_pria',function(){
		var penatua_pria = parseInt($('#f_banyak_penatua_pria').val());		
		var penatua_wanita = parseInt($('#f_banyak_penatua_wanita').val());
		if(isNaN(penatua_pria))
		{
			penatua_pria = 0;
		}
		if(isNaN(penatua_wanita))
		{
			penatua_wanita = 0;
		}
		$('#f_banyak_penatua').val(penatua_pria+penatua_wanita);
	});
	$('body').on('change','#f_banyak_penatua_wanita',function(){
		var penatua_pria = parseInt($('#f_banyak_penatua_pria').val());
		var penatua_wanita = parseInt($('#f_banyak_penatua_wanita').val());
		if(isNaN(penatua_pria))
		{
			penatua_pria = 0;
		}
		if(isNaN(penatua_wanita))
		{
			penatua_wanita = 0;
		}
		$('#f_banyak_penatua').val(penatua_pria+penatua_wanita);
	});		
	$('body').on('change','#f_banyak_penatua',function(){
		$('#f_banyak_penatua_pria').val('');
		$('#f_banyak_penatua_wanita').val('');		
	});
	
	//banyak_pemusik
	$('body').on('change','#f_banyak_pemusik_pria',function(){
		var pemusik_pria = parseInt($('#f_banyak_pemusik_pria').val());		
		var pemusik_wanita = parseInt($('#f_banyak_pemusik_wanita').val());
		if(isNaN(pemusik_pria))
		{
			pemusik_pria = 0;
		}
		if(isNaN(pemusik_wanita))
		{
			pemusik_wanita = 0;
		}
		$('#f_banyak_pemusik').val(pemusik_pria+pemusik_wanita);
	});
	$('body').on('change','#f_banyak_pemusik_wanita',function(){
		var pemusik_pria = parseInt($('#f_banyak_pemusik_pria').val());
		var pemusik_wanita = parseInt($('#f_banyak_pemusik_wanita').val());
		if(isNaN(pemusik_pria))
		{
			pemusik_pria = 0;
		}
		if(isNaN(pemusik_wanita))
		{
			pemusik_wanita = 0;
		}
		$('#f_banyak_pemusik').val(pemusik_pria+pemusik_wanita);
	});		
	$('body').on('change','#f_banyak_pemusik',function(){
		$('#f_banyak_pemusik_pria').val('');
		$('#f_banyak_pemusik_wanita').val('');		
	});
	
	//banyak_komisi
	$('body').on('change','#f_banyak_komisi_pria',function(){
		var komisi_pria = parseInt($('#f_banyak_komisi_pria').val());		
		var komisi_wanita = parseInt($('#f_banyak_komisi_wanita').val());
		if(isNaN(komisi_pria))
		{
			komisi_pria = 0;
		}
		if(isNaN(komisi_wanita))
		{
			komisi_wanita = 0;
		}
		$('#f_banyak_komisi').val(komisi_pria+komisi_wanita);
	});
	$('body').on('change','#f_banyak_komisi_wanita',function(){
		var komisi_pria = parseInt($('#f_banyak_komisi_pria').val());
		var komisi_wanita = parseInt($('#f_banyak_komisi_wanita').val());
		if(isNaN(komisi_pria))
		{
			komisi_pria = 0;
		}
		if(isNaN(komisi_wanita))
		{
			komisi_wanita = 0;
		}
		$('#f_banyak_komisi').val(komisi_pria+komisi_wanita);
	});		
	$('body').on('change','#f_banyak_komisi',function(){
		$('#f_banyak_komisi_pria').val('');
		$('#f_banyak_komisi_wanita').val('');		
	});
	
	//desimal persembahan
	// $('body').on('change','#f_jumlah_persembahan',function(){
		// var temp_uang = $('#f_jumlah_persembahan').val();
		// if(temp_uang.length >= 3)
		// {
			// alert('titik');
		// }
	// });
	
	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;		
	}
	
	$('body').on('click', '#f_post_kebaktian', function(){	  
		//SHOW POP UP CONFIRM KEBAKTIAN			
		
		/*
		if($('#f_check_kebaktian_lain').val() == 1) //pakai nama kebaktian lain
		{
			$kebaktian_ke = '';
			$nama_kebaktian = $('#f_nama_kebaktian').val();
		}
		else
		{
			$kebaktian_ke = $('#f_kebaktian_ke').val();
			$nama_kebaktian = $('#f_nama_kebaktian').val();
		}
		if($('#f_check_pembicara_luar').val() == 1) //pakai pembicara luar
		{
			$id_pendeta = '';
			$nama_pendeta = $('#f_nama_pengkotbah').val();
		}
		else
		{
			$id_pendeta = $('#f_pengkotbah').val();
			$nama_pendeta = $('#f_nama_pengkotbah').val();
		}		
		$tanggal_mulai = $('#f_tanggal_mulai').val();
		$tanggal_selesai = $('#f_tanggal_selesai').val();
		$jam_mulai = $('#f_jam_mulai').val();
		$jam_selesai = $('#f_jam_selesai').val();
		$banyak_jemaat_pria = $('#f_banyak_jemaat_pria').val();
		$banyak_jemaat_wanita = $('#f_banyak_jemaat_wanita').val();
		$banyak_jemaat = $('#f_banyak_jemaat').val();
		$banyak_simpatisan_pria = $('#f_banyak_simpatisan_pria').val();
		$banyak_simpatisan_wanita = $('#f_banyak_simpatisan_wanita').val();
		$banyak_simpatisan = $('#f_banyak_simpatisan').val();
		$banyak_penatua_pria = $('#f_banyak_penatua_pria').val();
		$banyak_penatua_wanita = $('#f_banyak_penatua_wanita').val();
		$banyak_penatua = $('#f_banyak_penatua').val();
		$banyak_pemusik_pria = $('#f_banyak_pemusik_pria').val();
		$banyak_pemusik_wanita = $('#f_banyak_pemusik_wanita').val();
		$banyak_pemusik = $('#f_banyak_pemusik').val();
		$banyak_komisi_pria = $('#f_banyak_komisi_pria').val();
		$banyak_komisi_wanita = $('#f_banyak_komisi_wanita').val();
		$banyak_komisi = $('#f_banyak_komisi').val();
		// $id_gereja = $('#f_id_gereja').val();
		$jumlah_persembahan = $('#f_jumlah_persembahan').val();
		$keterangan = $('#f_keterangan').val();		
		
		$data = {
			'id_jenis_kegiatan' : $kebaktian_ke,
			'nama_jenis_kegiatan' : $nama_kebaktian,
			'id_pendeta' : $id_pendeta,
			'nama_pendeta' : $nama_pendeta,
			'tanggal_mulai' : $tanggal_mulai,
			'tanggal_selesai' : $tanggal_selesai,
			'jam_mulai' : $jam_mulai,
			'jam_selesai' : $jam_selesai,
			'banyak_jemaat_pria' : $banyak_jemaat_pria,
			'banyak_jemaat_wanita' : $banyak_jemaat_wanita,
			'banyak_jemaat' : $banyak_jemaat,
			'banyak_simpatisan_pria' : $banyak_simpatisan_pria,
			'banyak_simpatisan_wanita' : $banyak_simpatisan_wanita,
			'banyak_simpatisan' : $banyak_simpatisan,
			'banyak_penatua_pria' : $banyak_penatua_pria,
			'banyak_penatua_wanita' : $banyak_penatua_wanita,
			'banyak_penatua' : $banyak_penatua,
			'banyak_pemusik_pria' : $banyak_pemusik_pria,
			'banyak_pemusik_wanita' : $banyak_pemusik_wanita,
			'banyak_pemusik' : $banyak_pemusik,
			'banyak_komisi_pria' : $banyak_komisi_pria,
			'banyak_komisi_wanita' : $banyak_komisi_wanita,
			'banyak_komisi' : $banyak_komisi,
			// 'id_gereja' : $id_gereja,
			'jumlah_persembahan' : $jumlah_persembahan,
			'keterangan' : $keterangan
		};				
		
		var json_data = JSON.stringify($data);
		
		$.ajax({
			type: 'POST',
			url: "{{URL('user/post_kebaktian')}}",
			data : {
				'json_data' : json_data
				// 'data' : $data
			},
			success: function(response){				
				result = JSON.parse(response);				
				if(result.code==201)
				{
					// alert("Berhasil simpan data kebaktian");					
					// location.reload();
					alert(result.messages);
					window.location = '{{URL::route('view_inputdata_kebaktian')}}';
				}
				else
				{
					alert(result.messages);
				}				
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(errorThrown);
			}
		},'json');
		*/
	});
</script>

@include('pages.__user.__input.popup_confirm_warning_kebaktian')
@include('pages.__popup_video.popup_video_input_kebaktian')

@stop