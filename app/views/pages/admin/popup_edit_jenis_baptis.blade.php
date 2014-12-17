<div class="modal fade popup_edit_jenis_baptis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Jenis Baptis</h4>
			</div>
			<div class="modal-body form-horizontal">

				<form class="form-horizontal">
					<div class="form-group">
						<label class="col-xs-4 control-label">Nama Jenis Baptis</label>
						<div class="col-xs-5">
							{{Form::text('nama_jenis_baptis', Input::old('nama_jenis_baptis'), array('id' => 'f_edit_nama_jenis_baptis', 'class' => 'form-control'))}}
						</div>
						<div class="col-xs-0">
							*
						</div>
					</div>							
					<div class="form-group">
						<label class="col-xs-4 control-label">Keterangan</label>
						<div class="col-xs-5">
							{{Form::textarea('keterangan', Input::old('keterangan'), array('id'=>'f_edit_keterangan', 'class'=>'form-control'))}}
						</div>
						<div class="col-xs-0">
							*
						</div>
					</div>
				</form>
				
			</div>
			<div class="modal-footer">
				<input type="button" value="Simpan Perubahan" id="f_edit_post_jenis_baptis" class="btn btn-success" data-dismiss="modal" />
				<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
			</div>
		</div>
	</div>
</div>

<script>
	$('body').on('click', '#f_edit_post_jenis_baptis', function(){
		$nama_jenis_baptis = $('#f_edit_nama_jenis_baptis').val();
		$keterangan = $('#f_edit_keterangan').val();
		
		$data = {
			'nama_jenis_baptis' : $nama_jenis_baptis,
			'keterangan' : $keterangan
		};
		
		var json_data = JSON.stringify($data);
				
		$.ajax({
			type: 'POST',
			url: "{{URL('admin/edit_jenis_baptis')}}",
			data : {
				'json_data' : json_data
			},
			success: function(response){
				result = JSON.parse(response);
				if(result.code==200)
				{
					alert(result.messages);
					window.location = '{{URL::route('admin_view_input_jenis_baptis')}}';
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
		
	});
</script>