<?php namespace Application\Ghost;

use Andesite\DBAccess\Connection\Filter\Filter;
class Blogpost extends BlogpostGhost{

	public static function getById($id, Site $site): ?Blogpost{
		return static::search(static::statusFilter()->and('id = $1', $id)->and('siteId=$1', $site->id))->pick();
	}

	public static function statusFilter(): Filter{
		return Filter::where('status = $1', Blogpost::V_status_active)->and('published < Now()');
	}
}
