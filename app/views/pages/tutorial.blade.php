<!-- 
	THIS VIEW TEMPORARY UNUSED 
									-->
									
@extends('layouts.user_layout')
@section('content')

<script>
	$(document).ready(function(){				
	
		//END LOADER				
		$('.f_loader_container').addClass('hidden');
	
	});
</script>

<div class="s_content_maindiv" style="overflow: hidden;">
	<div class="s_main_side" style="">
		<div class="s_content">
			<div class="container-fluid">
				<div style="margin-top: 15px;" class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">
							TUTORIAL
						</h3>
					</div>
					<div class="panel-body">
						<!--<p>isi di sini halaman tutorial</p>-->
						<video width="320" height="240" controls>
						  	<source src="{{URL('assets/tutorial/tes.mp4')}}" type="video/mp4">
						</video>
					</div>
				</div>
			</div>
		</div>	
	</div>	
</div>	

@stop