<?php namespace Tech\Controller;
use View;
use Tech\Model\MenuModel;
class AdminController extends \BaseController{
	protected $layout = "techvikky::layouts.admin_layout)";

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	 protected function setupLayout() {
        if( ! is_null($this->layout)) {
            $this->layout = View::make($this->layout, array (
                'menu' => $this->initMenu()
            ));
        }
    }

    /**
     * 
     * 
     * @return array menu
     */
    private function initMenu() {
        
        //$name = strtolower(substr(get_class($this), 0, - 10));
        
        // 
        $menu = MenuModel::where('pid', 0)->orderBy('sorts', 'DESC')->get()->toArray();
       
        $menus = \Service\Common\Util::ArrayColumn($menu, 'id', 'id,pid,name,url,icons');

        //userMids 
        //$userMids = \Service\Repository\UserRepository::getAuthMenus();
        
        // $menus = array_filter($menus, function($v) use ($userMids) {
        //     if ( in_array($v['id'], $userMids) || in_array($v['pid'], $userMids) || current($userMids) == 'all' )
        //     {
        //         return true;
        //     } 
        // });
        
        foreach($menus as $pid => &$parendval) {
            //
            
            $parendval ['is_active'] = '';
            $parendval ['is_parent'] = '';
            $parendval ['nav-active'] = '';
            
            //
            if($parendval ['pid'] == 0) {
                
                $parendval ['submenu'] = MenuModel::where('pid', $pid)->get()->toArray();
                $parendval ['is_parent'] = empty($parendval ['submenu']) ? '' : 'nav-parent';
                
                //
                if (empty($parendval ['submenu']) && $parendval ['url'] === \Request::path()) {
                    $parendval ['is_active'] = 'active';
                    $parendval ['is_parent'] = 'nav-parent';
                }
                
                // 
                foreach($parendval ['submenu'] as &$subval) {
                    $subval ['is_active'] = '';
                    if($subval ['url'] === \Request::path()) {
                        $subval ['is_active'] = 'active';
                        $parendval ['is_active'] = 'active';
                    }
                }
                
                unset($subval);
            }
            
            // nav-active
            if ($parendval ['is_active'] && $parendval ['is_parent'])
            {
                $parendval ['nav-active'] = 'nav-active';
            }
            
        }
        unset($parendval);
        return $menus;
    }
    

    /**
     * Return method
     *
     * @param String $msg
     * @param int $code
     */
    protected function toJson($msg, $code, $data = false) {
        return \Response::json(array (
            'code' => $code,
            'message' => $msg,
            'data' => $data
        ));
    }


}

 ?>