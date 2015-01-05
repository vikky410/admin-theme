<?php 
namespace Tech\Model;
use \Illuminate\Database\Eloquent\Model as Eloquent;
class GroupModel extends Eloquent{
	protected $table = 'vcc_groups';
	protected $softDelete = true;
	protected $guarded = array(
			'id','created_at','updated_at','deleted_at'
		);
}

 ?>