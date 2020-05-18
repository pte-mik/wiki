<?php

namespace Application\AdminCodex\Api;

use Andesite\DBAccess\Connection\Filter\Filter;
use Andesite\Mission\Web\Responder\ApiJsonResponder;
use Application\Ghost\User;

class Users extends ApiJsonResponder{
	/**
	 * @on get
	 */
	function get($id){
		$ids = explode(',', $id);
		$users = User::collect($ids);
		return array_map([$this, 'map'], $users);
	}
	/**
	 * @accepts get
	 */
	function search($name){
		$users = User::search(Filter::where(User::f_name()->instring($name)))->collect();
		return array_map([$this, 'map'], $users);
	}

	function map(User $user){
		if (is_null($user)) return null;
		return ['key' => $user->id, 'value' => $user->name];
	}
}