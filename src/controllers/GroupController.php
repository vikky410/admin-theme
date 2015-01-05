<?php
namespace Tech\Controller;
use Tech\Model\GroupModel;
use View;

class GroupController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$groups = GroupModel::all();
		$this->layout->content = View::make('techvikky::groups.index')->with(compact('groups'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('techvikky::groups.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// if( \Session::token() !== \Input::get('_token') ){
		// 	return $this->toJson('Unauthorize Access!', 1);
		// }

		// $res = GroupModel::create(array(
		// 		'name' => e(\Input::get('name'))
		// 	));

		// $code = is_object($res) ? 0 : 1;
            
        return $this->toJson('Updated successfully!', 0);

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
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
