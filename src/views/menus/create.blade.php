<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">
		<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
	</button>
	<h4 class="modal-title" id="myModalLabel">Add menu</h4>
</div>
<div class="modal-body">
	<form id="editform" class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-4 control-label">Parent ID:</label>
			<div class="col-sm-6">
			    <?php echo call_user_func_array(array('\Service\Common\Html', 'select'), array(
			        'pid', 'pid', $menus, null, 'Top', 'form-control'
			    ));?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Menu names:</label>
			<div class="col-sm-6">
				<input type="text" name="name" value="" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Path:</label>
			<div class="col-sm-6">
				<input type="text" name="url" value="" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Icon<a href="//v3.bootcss.com/components/#glyphicons" data-original-title="Icon selection" target="_blank">go</a>:</label>
			<div class="col-sm-6">
				<input type="text" name="icons" value="" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Sequence:</label>
			<div class="col-sm-6">
			    <?php echo \Service\Common\Html::select('sorts', 'sorts', range(0, 100), null, false, 'form-control');?>
			</div>
		</div>

	</form>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-primary useradd" data-dismiss="modal">Determine</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
</div>

<script>
    $(document).ready(function(){
        $(".useradd").click(function(){
            var url = "{{url('menus')}}";
            $.ajax({
                url : url,
                data : $('#editform').serialize(),
                dataType : 'json',
                type : 'POST'
            }).done(function(data){
                if (data.code == 0) {
                  notify('Prompt', data.message, 'success', false, 3);
                  window.location.reload();
                } else {
                  notify('Prompt', data.message, 'danger');
                }
            }).fail(function(){ alert("Error !"); });
        });
    });
</script>