<?php
namespace Tech\Model;
use \Illuminate\Database\Eloquent\Model as Eloquent;
class MenuModel extends Eloquent
{
    protected $table = 'vcc_menu';
    protected $fillable = array();
    protected $guarded  = array();
    protected $softDelete = true;
    protected $hidden = array('created_at', 'updated_at', 'deleted_at');
}
