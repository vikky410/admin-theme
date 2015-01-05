@section('content')
<p>
<a class="btn btn-primary" href="{{URL::route('groups.create')}}" data-toggle="modal" data-target="#addModal">Add Group</a>	
</p>

 <div class="table-responsive">
	<table class="table table-bordered table-hover" id="table2">
		@if(count($groups))
			<thead>
				<tr>
					<th>Name</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($groups as $group)
					<tr>
						<td>{{ $group->name }}</td>
					</tr>
				@endforeach
			</tbody>
		@else
			<tr>
				<td>No group found</td>
			</tr>
		@endif
	</table>
</div>
<!-- deleteModal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete</h4>
      </div>
      <div class="modal-body">
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Determine</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- addModal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>

<!-- editModal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>
@stop

@section('css')
    {{ HTML::style('/assets/package/datatables/css/jquery.dataTable_themebracket.css?' . date("Ymd", time()) . '.css') }}
@stop

@section('footer')
<script src="{{asset('/assets/package/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('/assets/styles/js/chosen.jquery.min.js')}}"></script>

<script type="text/javascript">
  // $(document).ready(function() {
  //   $('#table2').dataTable({
  //     "processing": true,
  //     "sPaginationType": "full_numbers",
  //     "fnDrawCallback" : function(){
  //       // Chosen Select
  //       $("select").chosen({
  //         'min-width': '100px',
  //         'white-space': 'nowrap',
  //         disable_search_threshold: 10
  //       });

  // 	    jQuery('.delete-row').click(function(){
  //     	    $this = $(this);
  //     	    $("#deleteModal .modal-body").html("You sure you want to delete["+ $this.attr('title') +"]It?");

  //     	    $("#deleteModal .modal-footer .btn-primary").off('click').on('click', function(){

  //     	    var deleteurl = "{{url('groups')}}" + "/" + $this.attr('rel');
  //     	        $.ajax({
  //     	    	    url: deleteurl,
  //       	    	dataType: 'json',
  //   	    	    type: 'DELETE'
  //   	    	}).done(function(data){
  //                   if (data.code == 0) {
  //                     $this.closest('tr').fadeOut(function(){
  //                         $this.remove();
  //                     });
  //                     notify('Prompt', data.message, 'success');
  //                   } else {
  //                     notify('Prompt', data.message, 'danger');
  //                   }
  //       	    })
  //               .fail(function(){ alert("Error it!"); });
  //         	});
  // 	    });
        
  //     },
  //     // "oLanguage": {
  //     //     "sUrl" : "{{asset('/assets/package/datatables/jquery.datatables.surl.cn-zn.txt')}}"
  //     // }
  //   });

  //   $("#editModal, #addModal").on("hidden.bs.modal", function() {
  //       $(this).removeData("bs.modal");
  //   });
    
  // });
</script>
@stop