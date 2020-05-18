<?php namespace Application\AdminCodex\GhostHelper;

use Andesite\Codex\Form\AdminDescriptor;
use Andesite\Codex\Form\DataProvider\GhostDataProvider;
use Andesite\Codex\Form\Field;
use Andesite\Codex\Interfaces\DataProviderInterface;

/**
 * @label-field id: 
 * @label-field slug: al-domain
 * @label-field owner: tulajdonos
 * @label-field language: nylev
 * @label-field language.EN: angol
 * @label-field language.HU: magyar
 * @label-field structure: struktúra
 * @label-field title: cím
 * @label-field status: státusz
 * @label-field status.public: publikus
 * @label-field status.protected: védett
 * @label-field status.hidden: rejtett
 * @label-field editors: szerkesztők
 * @label-field guests: vendégek
 * @label-field menuBgColor: menü háttér szín
 * @label-field menuColor: menű szöveg szín
 * @label-field menuSecondaryColor: menü másodlagos szín
 * @label-field titleColor: cím szín
 * @label-field footerBgColor: lábléc háttér szín
 * @label-field footerText: lábléc szöveg
 * @label-field footerContact: lábléc kontakt info
 * @label-field start: kezdő oldal
 * @label-attachment headImage: 
 */
abstract class SiteHelper extends AdminDescriptor{


	/** @var Field */ protected $id;
	/** @var Field */ protected $slug;
	/** @var Field */ protected $owner;
	/** @var Field */ protected $language;
	/** @var Field */ protected $structure;
	/** @var Field */ protected $title;
	/** @var Field */ protected $status;
	/** @var Field */ protected $editors;
	/** @var Field */ protected $guests;
	/** @var Field */ protected $menuBgColor;
	/** @var Field */ protected $menuColor;
	/** @var Field */ protected $menuSecondaryColor;
	/** @var Field */ protected $titleColor;
	/** @var Field */ protected $footerBgColor;
	/** @var Field */ protected $footerText;
	/** @var Field */ protected $footerContact;
	/** @var Field */ protected $start;
	/** @var Field */ protected $headImage;

	public function __construct(){
		$this->id = new Field('id', 'id');
		$this->slug = new Field('slug', 'al-domain');
		$this->owner = new Field('owner', 'tulajdonos');
		$this->language = new Field('language', 'nylev', ['EN'=>'angol', 'HU'=>'magyar']);
		$this->structure = new Field('structure', 'struktúra');
		$this->title = new Field('title', 'cím');
		$this->status = new Field('status', 'státusz', ['public'=>'publikus', 'protected'=>'védett', 'hidden'=>'rejtett']);
		$this->editors = new Field('editors', 'szerkesztők');
		$this->guests = new Field('guests', 'vendégek');
		$this->menuBgColor = new Field('menuBgColor', 'menü háttér szín');
		$this->menuColor = new Field('menuColor', 'menű szöveg szín');
		$this->menuSecondaryColor = new Field('menuSecondaryColor', 'menü másodlagos szín');
		$this->titleColor = new Field('titleColor', 'cím szín');
		$this->footerBgColor = new Field('footerBgColor', 'lábléc háttér szín');
		$this->footerText = new Field('footerText', 'lábléc szöveg');
		$this->footerContact = new Field('footerContact', 'lábléc kontakt info');
		$this->start = new Field('start', 'kezdő oldal');
		$this->headImage = new Field('headImage', 'headImage');
	}

	protected function createDataProvider(): DataProviderInterface{
		return new GhostDataProvider(\Application\Ghost\Site::class);
	}

}
