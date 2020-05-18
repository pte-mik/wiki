<?php namespace Application\AdminCodex\GhostHelper;

use Andesite\Codex\Form\AdminDescriptor;
use Andesite\Codex\Form\DataProvider\GhostDataProvider;
use Andesite\Codex\Form\Field;
use Andesite\Codex\Interfaces\DataProviderInterface;

/**
 * @label-field id: 
 * @label-field siteId: 
 * @label-field title: 
 * @label-field slug: 
 * @label-field content: 
 * @label-field status: 
 * @label-field status.active: 
 * @label-field status.draft: 
 * @label-field status.deleted: 
 * @label-field created: 
 * @label-field updated: 
 * @label-attachment files: 
 * @label-attachment gallery: 
 */
abstract class PageHelper extends AdminDescriptor{


	/** @var Field */ protected $id;
	/** @var Field */ protected $siteId;
	/** @var Field */ protected $title;
	/** @var Field */ protected $slug;
	/** @var Field */ protected $content;
	/** @var Field */ protected $status;
	/** @var Field */ protected $created;
	/** @var Field */ protected $updated;
	/** @var Field */ protected $files;
	/** @var Field */ protected $gallery;

	public function __construct(){
		$this->id = new Field('id', 'id');
		$this->siteId = new Field('siteId', 'siteId');
		$this->title = new Field('title', 'title');
		$this->slug = new Field('slug', 'slug');
		$this->content = new Field('content', 'content');
		$this->status = new Field('status', 'status', ['active'=>'active', 'draft'=>'draft', 'deleted'=>'deleted']);
		$this->created = new Field('created', 'created');
		$this->updated = new Field('updated', 'updated');
		$this->files = new Field('files', 'files');
		$this->gallery = new Field('gallery', 'gallery');
	}

	protected function createDataProvider(): DataProviderInterface{
		return new GhostDataProvider(\Application\Ghost\Page::class);
	}

}
