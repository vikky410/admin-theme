<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">
		<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
	</button>
	<h4 class="modal-title" id="myModalLabel">Add Group</h4>
</div>

<div class="modal-body">
	{{ Form::open(array(
			'autocomplete' => 'off',
			'route' => 'groups.store',
			'class' => 'form form-horizontal',
			'id' => 'editform',
		)) }}

		{{ 
			Form::field(array(
				'name' => 'name',
				'label' => 'Name',
				'placeholder' => 'Group Name'
			)) 
		}}

	{{ Form::close() }}
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-primary useradd" data-dismiss="modal">Confirm</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
</div>
<script type="text/javascript">
	// $(document).ready(function($){
	// 	$('#editform').on('submit', function(){
	// 		$.post(
	// 				$(this).prop('action'),
	// 				{
	// 					"_token": $(this).find('input[name=_token]').val(),
	// 					"name": $('#name').val()
	// 				},
	// 				'json'
	// 			).done(function(data){
	//                 if (data.code == 0) {
	//                   notify('Prompt', data.message, 'success', false, 3);
	//                   window.location.reload();
 //                } else {
 //                  notify('Prompt', data.message, 'danger');
 //                }
 //            }).fail(function(){ alert("Error !"); });
	// 		return false;
	// 	});
	// });
	
	// $(document).ready(function(){
	// 	$('#editform').ready
	// });
</script>

