<div class="modal fade popup_edit_anggota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Keanggotaan</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">	

					<div class="form-group">
						<label class="col-xs-4 control-label">Nomor anggota</label> 
						<div class="col-xs-5">
							{{ Form::text('nomor_anggota', Input::old('nomor_anggota'), array('id' => 'f_nomor_anggota', 'class'=>'form-control')) }}
						</div>
					</div>	
					<div class="form-group">
						<label class="col-xs-4 control-label">Nama</label> 
						<div class="col-xs-5">
							{{ Form::text('nama', Input::old('nama'), array('id' => 'f_nama', 'class'=>'form-control')) }} 
						</div>
						<div class="col-xs-1">
							<span class="red">*</span>
						</div>
					</div>							
					<div class="form-group">
						<label class="col-xs-4 control-label">Kota</label> 
						<div class="col-xs-5">
							{{ Form::text('kota', Input::old('kota'), array('id' => 'f_kota', 'class'=>'form-control')) }}  
						</div>
						<div class="col-xs-1">
							<span class="red">*</span>
						</div>
					</div>		
					<div class="form-group">		
						<label class="col-xs-4 control-label">Jenis kelamin</label> 				
						<div class="col-xs-5">
							{{ Form::radio('gender', '1', true, array('id'=>'f_jenis_kelamin')) }}pria    {{ Form::radio('gender', '0', '', array('id'=>'f_jenis_kelamin')) }}wanita
						</div>
						<div class="col-xs-1">
							<span class="red">*</span>
						</div>											
					</div>		
					<div class="form-group">
						<label class="col-xs-4 control-label">Wilayah</label> 
						<div class="col-xs-5">
							<select name="wilayah" id="f_wilayah" class="form-control">
								<option>bla</option>
							</select>  
						</div>
						<div class="col-xs-1">
							<span class="red">*</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-4 control-label">Golongan darah</label> 
						<div class="col-xs-5">
							<select name="gol_darah" id="f_gol_darah" class="form-control">
								<option>bla</option>
							</select>  
						</div>
						<div class="col-xs-1">
							<span class="red">*</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-4 control-label">Pendidikan </label> 
						<div class="col-xs-5">
							<select name="pendidikan" id="f_pendidikan" class="form-control">
								<option>bla</option>
							</select>  
						</div>
						<div class="col-xs-1">
							<span class="red">*</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-4 control-label">Pekerjaan</label> 
						<div class="col-xs-5">
							<select name="pekerjaan" id="f_pekerjaan" class="form-control">
								<option>bla</option>
							</select>  
						</div>
						<div class="col-xs-1">
							<span class="red">*</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-4 control-label">Etnis</label> 
						<div class="col-xs-5">
							<select name="etnis" id="f_etnis" class="form-control">
								<option>bla</option>
							</select>  
						</div>
						<div class="col-xs-1">
							<span class="red">*</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-4 control-label">Tanggal lahir antara </label> 
						<div class="col-xs-2">

							{{ Form::text('tanggal_awal', Input::old('tanggal_awal'), array('id' => 'f_tanggal_awal', 'class'=>'form-control')) }} 
						</div>
						<div class="col-xs-2">
							{{ Form::text('tanggal_akhir', Input::old('tanggal_akhir'), array('id' => 'f_tanggal_akhir', 'class'=>'form-control')) }}
						</div>
						<div class="col-xs-1">
							<span class="red">*</span>
						</div>
						<script>
						jQuery('#f_tanggal_awal').datetimepicker({
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
						jQuery('#f_tanggal_akhir').datetimepicker({
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
						</script>
					</div>			
					<div class="form-group">
						<label class="col-xs-4 control-label">Status</label> 
						<div class="col-xs-5">
							<select name="status" id="f_status" class="form-control">
								<option>bla</option>
							</select>  
						</div>
						<div class="col-xs-1">
							<span class="red">*</span>
						</div>
					</div>
					<div class="form-group">

						<div class="col-xs-5 col-xs-push-4">
							<button id="f_search_anggota" class="btn btn-success">Save Changes</button>
						</div>
					</div>
				</form>	
				

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
			</div>
		</div>
	</div>
</div>