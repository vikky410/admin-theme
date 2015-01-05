<?php 
namespace Tech\Controller;
use View;
use Tech\Model\MenuModel;
//use Tech\Controller\AdminController;
class MenuController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $menus;
   // protected $cache_menus;
    
    public function __construct()
    {
        // $this->cache_menus = sprintf('%s_%s_%s', __CLASS__, __FILE__, 'menus');
        // $this->menus = \Cache::get($this->cache_menus);
        // if (!$this->menus)
        // {
            $this->menus = MenuModel::all()->toArray();
        //     \Cache::put($this->cache_menus, $this->menus, 60);
        // }
    }
    
    // private function removeCache()
    // {
    //     \Cache::forget($this->cache_menus);
    // }


	public function index()
	{
		$menus = $this->menus;
		$this->layout->content = View::make("techvikky::menus.index")->with(compact('menus'));;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * 
	 * @return Response
	 */
	public function create()
	{
		 //parents menus
        $menus = $this->menus;
        $menus = array_filter($this->menus, function ($v) {
            if($v ['pid'] == 0) {
                return true;
            }
            return false;
        });

        
        $menus = \Service\Common\Util::ArrayColumn($menus, 'id', 'name');
        //parents menus end
                
        return View::make('techvikky::menus.create')->with(compact('menus'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//if (is_super_admin()){
            $res = MenuModel::create(array(
                'pid' => e(\Input::get('pid')),
                'name' => e(\Input::get('name')),
                'url' => e(\Input::get('url')),
                'icons' => e(\Input::get('icons')),
                'sorts' => e(\Input::get('sorts')),
            ));
            $code = is_object($res) ? 0 : 1;
            
            // clean cache
            //$this->removeCache();
            
            return $this->toJson('Updated successfully!', $code);
        // } else {
        //     return $this->toJson('You do not have permission!', 1);
        // }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$menu = MenuModel::find($id)->toArray();
        
        //parents menus
        $menus = $this->menus;
        $menus = array_filter($this->menus, function ($v) {
            if($v ['pid'] == 0) {
                return true;
            }
            return false;
        });
        $menus = \Service\Common\Util::ArrayColumn($menus, 'id', 'name');
        //parents menus end
        
        return View::make('techvikky::menus.edit')->with(compact('menus', 'menu'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//if (is_super_admin()){
            $res = MenuModel::where('id', $id)->update(array(
                'pid' => e(\Input::get('pid')),
                'name' => e(\Input::get('name')),
                'url' => e(\Input::get('url')),
                'icons' => e(\Input::get('icons')),
                'sorts' => e(\Input::get('sorts')),
            ));
            $code = $res > 0 ? 0 : 1;
            
            // clean cache
            //$this->removeCache();
            
            return $this->toJson('Updated successfully!', $code);
        // } else {
        //     return $this->toJson('You do not have permission!', 1);
        // }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// if (is_super_admin()){
            $res = MenuModel::where('id', $id)->delete();
            $code = $res > 0 ? 0 : 1;
            // clean cache
            //$this->removeCache();
        
            return $this->toJson('Deleted successfully!', $code);
        // } else {
        //     return $this->toJson('You do not have permission!', 1);
        // }
	}


}
