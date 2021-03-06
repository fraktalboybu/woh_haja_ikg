@extends('layouts.superadmin_layout')
@section('content')

<script>
	<!-- set variable javascript biar ga usah get detail lagi -->	
	var data_gereja = new Array();
	
	$(document).ready(function(){				
	
		//END LOADER				
		$('.f_loader_container').addClass('hidden');
		
		//reset kalau sampai reload page
		data_gereja = new Array();
		
		//insert ke data gereja ke variable javascript
		<?php
			foreach($data_gereja as $gereja)
			{
		?>	
				data_gereja[data_gereja.length] = <?php echo $gereja; ?>
		<?php		
			}
		?>
		
		// alert(data_gereja[1]['nama']);
		// var data_gereja = '';
		// alert(data_gereja[1]);
		// alert(arr_gereja);
	});
</script>
		
<div class="s_content_maindiv" style="overflow: hidden;">
	<div class="s_sidebar_main" style="width:200px; background-color:white;">
		<div>
			@include('includes.sidebar.sidebar_superadmin')
		</div>
	</div>
	<div class="s_main_side" style="">
		<!-- css -->
		<style>

		</style>
		<!-- end css -->			
		
		<div class="s_content">
			<div class="container-fluid">
				
				<!-- INI PANEL BUAT TAMBAH GEREJA -->
				<div style="margin-top: 15px;" class="panel panel-default">					
					
					<div class="panel-group" style="margin-bottom: 0px;" id="accordion" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
										<strong>tambah data gereja baru</strong>
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
									<form class="form-horizontal">
										<div class="form-group">
											<label class="col-xs-4 control-label">Nama Gereja</label>
											<div class="col-xs-5">
												{{Form::text('nama_gereja', Input::old('nama_gereja'), array('id' => 'f_nama_gereja', 'class' => 'form-control'))}}
											</div>
											<div class="col-xs-0">
												*
											</div>
										</div>							
										<div class="form-group">
											<label class="col-xs-4 control-label">Alamat</label>
											<div class="col-xs-5">
												{{Form::textarea('alamat', Input::old('alamat'), array('id'=>'f_alamat', 'class'=>'form-control'))}}
											</div>
											<div class="col-xs-0">
												*
											</div>
										</div>
										<div class="form-group">
											<label class="col-xs-4 control-label"> Kota</label>
											<div class="col-xs-5">
												{{Form::text('kota', Input::old('kota'), array('id' => 'f_kota', 'class' => 'form-control'))}}
											</div>
											<div class="col-xs-0">
												*
											</div>
										</div>	
										<div class="form-group">
											<label class="col-xs-4 control-label"> Kodepos</label>
											<div class="col-xs-5">
												{{Form::text('kodepos', Input::old('kodepos'), array('id' => 'f_kodepos', 'class' => 'form-control', 'onkeypress' => 'return isNumberKey(event)'))}}
											</div>
											<div class="col-xs-0">
												*
											</div>
										</div>
										<div class="form-group">
											<label class="col-xs-4 control-label"> Telepon</label>
											<div class="col-xs-5">
												{{Form::text('telepon', Input::old('telepon'), array('id' => 'f_telepon', 'class' => 'form-control'))}}
											</div>
											<div class="col-xs-0">
												*
											</div>
										</div>
										<div class="form-group">
											<label class="col-xs-4 control-label">Status</label>
											<div class="col-xs-5">
												@if($list_status_gereja == null)
													<p class="control-label pull-left">(tidak ada daftar status gereja)</p>
												@else
													{{Form::select('status', $list_status_gereja, Input::old('status'), array('id'=>'f_status', 'class'=>'form-control'))}} 
												@endif								
											</div>											
										</div>
										<div class="form-group">
											<label class="col-xs-4 control-label">Gereja Induk</label>
											<div class="col-xs-5">
												<?php
													$new_list_gereja = array(
														'-1' => 'pilih!'
													);
													
													foreach($list_gereja as $id => $key)
													{
														$new_list_gereja[$id] = $key;
													}
												?>
												@if($list_gereja == null)
													<p class="control-label pull-left">(tidak ada daftar status gereja)</p>
												@else
													{{Form::select('list_gereja', $new_list_gereja, Input::old('list_gereja'), array('id'=>'f_list_gereja', 'class'=>'form-control'))}} 
												@endif														
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-6 col-xs-push-5">
												<input type="button" value="Simpan Data Gereja" id="f_post_gereja" class="btn btn-success" />
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

				<!-- INI PANEL BUAT SHOW SELURUH DATA GEREJA -->	
				<div style="margin-top: 15px;" class="panel panel-default" id="tabel_gereja">	
					
					<table class="table">
						<thead>
							<tr class="active">
								<td class="col-md-2"><strong>ID Gereja</strong></td>
								<td class="col-md-4"><strong>Nama Gereja</strong></td>
								<td class="col-md-1"><strong>Visible</strong></td>
								<td class="col-md-4"><!-- edit delete --></td>
							</tr>								
						</thead>
						<tbody class="tabel_body">
													
							<!-- set list gereja -->
							<?php $index = 0; ?>
							@foreach($data_gereja as $gereja)
								<tr>
									<td class="tabel_id_gereja<?php echo $index; ?>">{{$gereja->id}}</td>
									<td class="tabel_nama_gereja<?php echo $index; ?>">{{$gereja->nama}}</td>
									<td class="tabel_visible<?php echo $index; ?>">
										@if($gereja->deleted == 0)
											<span style="color:green;" class="glyphicon glyphicon-ok" aria-hidden="true"></span>
										@else											
											<span style="color:red;" class="glyphicon glyphicon-remove" aria-hidden="true"></span>
										@endif
									</td>																		
									<td>											
										<div class="pull-right">											
											<input type="hidden" value="{{$gereja->id}}" />
											<input type="hidden" value="<?php echo $index; ?>" />
											<button type="button" class="btn btn-warning visibleButton">Ganti Visible</button>
											<input type="hidden" value="{{$gereja->id}}" />
											<input type="hidden" value="<?php echo $index; ?>" />
											<button type="button" class="btn btn-info detailButton" data-toggle="modal" data-target=".popup_edit_gereja">Detail / Edit</button>			
											<input type="hidden" value="{{$gereja->id}}" />
											<input type="hidden" value="<?php echo $index; ?>" />
											<button type="button" class="btn btn-danger deleteButton" data-toggle="modal" data-target=".popup_delete_warning_gereja">Delete</button>
										</div>	
										<!-- index++ -->
										<?php $index++; ?>
									</td>
								</tr>
							@endforeach							
						</tbody>
					</table>
				</div>
				
			</div>			
		</div>
	</div>
</div>	

<script>
	//global variable buat ajax ganti view
	var temp = '';
	
	//click change visible
	$('body').on('click', '.visibleButton', function(){		
				
		//START LOADER				
		$('.f_loader_container').removeClass('hidden');
		
		$id = $(this).prev().prev().val();
		temp = $(this).prev().val();		
		
		$data = {
			'id' : $id
		};
		
		var json_data = JSON.stringify($data);
				
		$.ajax({
			type: 'POST',
			url: "{{URL('superadmin/change_visible_gereja')}}",
			data: {
				'json_data' : json_data
			},
			success: function(response){							
				result = JSON.parse(response);
				if(result.code==200)
				{
					alert(result.messages);					
					// window.location = '{{URL::route('superadmin_view_input_gereja')}}';
										
					//ganti isi row sesuai hasil edit
					// alert(result.data['deleted']);
					if(result.data['deleted'] == 0)
					{						
						$('.tabel_visible'+temp).html("<span style='color:green;' class='glyphicon glyphicon-ok' aria-hidden='true'></span>");						
					}
					else
					{							
						$('.tabel_visible'+temp).html("<span style='color:red;' class='glyphicon glyphicon-remove' aria-hidden='true'></span>");
					}	

					//END LOADER				
					$('.f_loader_container').addClass('hidden');
				}
				else
				{
					alert(result.messages);
					//END LOADER				
					$('.f_loader_container').addClass('hidden');
				}				
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(errorThrown);
				//END LOADER				
				$('.f_loader_container').addClass('hidden');
			}
		},'json');
		
	});
	
	//click detail/edit button
	$('body').on('click', '.detailButton', function(){
		$id = $(this).prev().prev().val();
		$index = $(this).prev().val();				
		
		temp = $(this).prev().val();				
		
		//set value di popup detail/edit
		$('#f_edit_nama_gereja').val(data_gereja[$index]['nama']);
		$('#f_edit_alamat').val(data_gereja[$index]['alamat']);
		$('#f_edit_kota').val(data_gereja[$index]['kota']);
		$('#f_edit_kodepos').val(data_gereja[$index]['kodepos']);
		$('#f_edit_telepon').val(data_gereja[$index]['telp']);
		$('#f_edit_status').val(data_gereja[$index]['status']);
		if(data_gereja[$index]['id_parent_gereja'] == null)
		{
			$('#f_edit_list_gereja').val(-1);
		}
		else
		{
			$('#f_edit_list_gereja').val(data_gereja[$index]['id_parent_gereja']);
		}
		
		//clear background
		$('#f_edit_nama_gereja').css('background-color','#FFFFFF');
		$('#f_edit_alamat').css('background-color','#FFFFFF');
		$('#f_edit_kota').css('background-color','#FFFFFF');
		$('#f_edit_kodepos').css('background-color','#FFFFFF');
		$('#f_edit_telepon').css('background-color','#FFFFFF');
	});
	
	//click delete button
	$('body').on('click', '.deleteButton', function(){
		$id = $(this).prev().prev().val();
		$index = $(this).prev().val();
			
	});
	
	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}
	
	$('body').on('click', '#f_post_gereja', function(){
	
		//START LOADER				
		$('.f_loader_container').removeClass('hidden');
		
		$nama = $('#f_nama_gereja').val();
		$alamat = $('#f_alamat').val();
		$kota = $('#f_kota').val();
		$kodepos = $('#f_kodepos').val();
		$telp = $('#f_telepon').val();
		$status = $('#f_status').val();
		$list_gereja = $('#f_list_gereja').val();
		
		$data = {
			'nama' : $nama,
			'alamat' : $alamat,
			'kota' : $kota,
			'kodepos' : $kodepos, 
			'telp' : $telp,
			'status' : $status,
			'id_parent_gereja' : $list_gereja
		};
		
		var json_data = JSON.stringify($data);
				
		$.ajax({
			type: 'POST',
			url: "{{URL('superadmin/post_gereja')}}",
			data: {
				'json_data' : json_data
			},
			success: function(response){
				result = JSON.parse(response);
				if(result.code==201)
				{
					alert(result.messages);
					
					location.reload();
					
					
					// window.location = '{{URL::route('superadmin_view_input_gereja')}}';
										
				}
				else
				{
					alert(result.messages);

					//show red background validation
					if($nama == ""){$('#f_nama_gereja').css('background-color','#FBE3E4');}else{$('#f_nama_gereja').css('background-color','#FFFFFF');}
					if($alamat == ""){$('#f_alamat').css('background-color','#FBE3E4');}else{$('#f_alamat').css('background-color','#FFFFFF');}
					if($kota == ""){$('#f_kota').css('background-color','#FBE3E4');}else{$('#f_kota').css('background-color','#FFFFFF');}
					if($kodepos == ""){$('#f_kodepos').css('background-color','#FBE3E4');}else{$('#f_kodepos').css('background-color','#FFFFFF');}
					if($telp == ""){$('#f_telepon').css('background-color','#FBE3E4');}else{$('#f_telepon').css('background-color','#FFFFFF');}									

					//END LOADER				
					$('.f_loader_container').addClass('hidden');
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(errorThrown);
				//END LOADER				
				$('.f_loader_container').addClass('hidden');
			}
		},'json');
		
	});
</script>

@include('pages.__superadmin.popup_edit_gereja')
@include('pages.__superadmin.popup_delete_warning_gereja')

@stop