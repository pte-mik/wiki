<?php namespace Application\Ghost;

use Andesite\DBAccess\Connection\Filter\Filter;
class Page extends PageGhost{

	public static function getBySlug($slug, Site $site): ?Page{
		return static::search(static::statusFilter()->and('slug = $1', $slug)->and('siteId=$1', $site->id))->pick();
	}

	public static function statusFilter(): Filter{
		return Filter::where('status = $1', Page::V_status_active);
	}

	public function onBeforeInsert($data = null){
		$this->created = new \DateTime();
		return true;
	}

	public function onBeforeSave($data = null){
		$this->updated = new \DateTime();
		return true;
	}
}
