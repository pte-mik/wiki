<?php namespace Application\AdminCodex\GhostHelper;

use Andesite\Codex\Form\AdminDescriptor;
use Andesite\Codex\Form\DataProvider\GhostDataProvider;
use Andesite\Codex\Form\Field;
use Andesite\Codex\Interfaces\DataProviderInterface;

/**
 * @label-field id: 
 * @label-field siteId: 
 * @label-field title: 
 * @label-field lead: 
 * @label-field content: 
 * @label-field status: 
 * @label-field status.active: 
 * @label-field status.draft: 
 * @label-field status.deleted: 
 * @label-field published: 
 * @label-attachment files: 
 * @label-attachment gallery: 
 * @label-attachment leadImage: 
 */
abstract class BlogpostHelper extends AdminDescriptor{


	/** @var Field */ protected $id;
	/** @var Field */ protected $siteId;
	/** @var Field */ protected $title;
	/** @var Field */ protected $lead;
	/** @var Field */ protected $content;
	/** @var Field */ protected $status;
	/** @var Field */ protected $published;
	/** @var Field */ protected $files;
	/** @var Field */ protected $gallery;
	/** @var Field */ protected $leadImage;

	public function __construct(){
		$this->id = new Field('id', 'id');
		$this->siteId = new Field('siteId', 'siteId');
		$this->title = new Field('title', 'title');
		$this->lead = new Field('lead', 'lead');
		$this->content = new Field('content', 'content');
		$this->status = new Field('status', 'status', ['active'=>'active', 'draft'=>'draft', 'deleted'=>'deleted']);
		$this->published = new Field('published', 'published');
		$this->files = new Field('files', 'files');
		$this->gallery = new Field('gallery', 'gallery');
		$this->leadImage = new Field('leadImage', 'leadImage');
	}

	protected function createDataProvider(): DataProviderInterface{
		return new GhostDataProvider(\Application\Ghost\Blogpost::class);
	}

}
