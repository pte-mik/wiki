<?php namespace Application\Ghost;

use Andesite\DBAccess\Connection\Filter\Filter;
class Site extends SiteGhost{

	public function onBeforeInsert(){
		$this->structure = ['items'=>[]];
	}

	public $language = Site::V_language_HU;

	public static function pickBySlug($slug): ?Site{ return static::search(Filter::where('slug=$1', $slug))->pick(); }

	public function getPage($slug): ?Page{ return Page::getBySlug($slug, $this); }

	public function getPages(){ return Page::search(Filter::where('siteId = $1', $this->id)->and('status != $1', 'deleted'))->asc(Page::F_title)->collect(); }

	public function getBlogpost($id): ?Blogpost{ return Blogpost::getById($id, $this); }

	public function getBlogposts(){
		$search = Blogpost::search(Filter::where('siteId = $1', $this->id)->and('status != $1', 'deleted'))->desc(Blogpost::F_published);
		return $search->collect();
	}
	public function getPublicBlogposts($page = null, $pagesize = null, &$count = null){
		$search = Blogpost::search(Blogpost::statusFilter()->and('siteId = $1', $this->id))->desc(Blogpost::F_published);
		return $search->collectPage($pagesize, $page, $count);
	}
}
