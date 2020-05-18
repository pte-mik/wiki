<?php namespace Application\Ghost;

use Andesite\Attachment\AttachmentCategoryManager;
use Andesite\DBAccess\Connection\Filter\Filter;
use Andesite\DBAccess\Connection\Filter\Comparison;
use Andesite\DBAccess\Connection\Finder;
use Andesite\Ghost\Field;
use Andesite\Ghost\Ghost;
use Andesite\Ghost\Model;

/**
 * @method static GhostSiteFinder search(Filter $filter = null)
 * @property-read $id
 * @property-read AttachmentCategoryManager $headImage
 */
abstract class SiteGhost extends Ghost{

	/** @var Model */
	public static $model;
	const Table = "site";
	const ConnectionName = "default";

		public static function f_id(){return new Comparison('id');}
		public static function f_slug(){return new Comparison('slug');}
		public static function f_owner(){return new Comparison('owner');}
		public static function f_language(){return new Comparison('language');}
		public static function f_structure(){return new Comparison('structure');}
		public static function f_title(){return new Comparison('title');}
		public static function f_status(){return new Comparison('status');}
		public static function f_editors(){return new Comparison('editors');}
		public static function f_guests(){return new Comparison('guests');}
		public static function f_menuBgColor(){return new Comparison('menuBgColor');}
		public static function f_menuColor(){return new Comparison('menuColor');}
		public static function f_menuSecondaryColor(){return new Comparison('menuSecondaryColor');}
		public static function f_titleColor(){return new Comparison('titleColor');}
		public static function f_footerBgColor(){return new Comparison('footerBgColor');}
		public static function f_footerText(){return new Comparison('footerText');}
		public static function f_footerContact(){return new Comparison('footerContact');}
		public static function f_start(){return new Comparison('start');}

	const V_language_EN = "EN";
	const V_language_HU = "HU";
	const V_status_public = "public";
	const V_status_protected = "protected";
	const V_status_hidden = "hidden";

	const F_id = "id";
	const F_slug = "slug";
	const F_owner = "owner";
	const F_language = "language";
	const F_structure = "structure";
	const F_title = "title";
	const F_status = "status";
	const F_editors = "editors";
	const F_guests = "guests";
	const F_menuBgColor = "menuBgColor";
	const F_menuColor = "menuColor";
	const F_menuSecondaryColor = "menuSecondaryColor";
	const F_titleColor = "titleColor";
	const F_footerBgColor = "footerBgColor";
	const F_footerText = "footerText";
	const F_footerContact = "footerContact";
	const F_start = "start";

	const A_headImage = "headImage";

	/** @var int $id */
	protected $id;
	/** @var string $slug */
	public $slug;
	/** @var string $owner */
	public $owner;
	/** @var string $language */
	public $language;
	/** @var array $structure */
	public $structure;
	/** @var string $title */
	public $title;
	/** @var string $status */
	public $status;
	/** @var string $editors */
	public $editors;
	/** @var string $guests */
	public $guests;
	/** @var string $menuBgColor */
	public $menuBgColor;
	/** @var string $menuColor */
	public $menuColor;
	/** @var string $menuSecondaryColor */
	public $menuSecondaryColor;
	/** @var string $titleColor */
	public $titleColor;
	/** @var string $footerBgColor */
	public $footerBgColor;
	/** @var string $footerText */
	public $footerText;
	/** @var string $footerContact */
	public $footerContact;
	/** @var string $start */
	public $start;



	final static protected function createModel(): Model{
		$model = new Model(get_called_class());
		$model->addField("id", Field::TYPE_ID,null);
		$model->addField("slug", Field::TYPE_STRING,null);
		$model->addField("owner", Field::TYPE_STRING,null);
		$model->addField("language", Field::TYPE_ENUM,['EN','HU']);
		$model->addField("structure", Field::TYPE_JSON,null);
		$model->addField("title", Field::TYPE_STRING,null);
		$model->addField("status", Field::TYPE_ENUM,['public','protected','hidden']);
		$model->addField("editors", Field::TYPE_STRING,null);
		$model->addField("guests", Field::TYPE_STRING,null);
		$model->addField("menuBgColor", Field::TYPE_STRING,null);
		$model->addField("menuColor", Field::TYPE_STRING,null);
		$model->addField("menuSecondaryColor", Field::TYPE_STRING,null);
		$model->addField("titleColor", Field::TYPE_STRING,null);
		$model->addField("footerBgColor", Field::TYPE_STRING,null);
		$model->addField("footerText", Field::TYPE_STRING,null);
		$model->addField("footerContact", Field::TYPE_STRING,null);
		$model->addField("start", Field::TYPE_STRING,null);
		$model->protectField("id");
		$model->addValidator("id", new \Symfony\Component\Validator\Constraints\Type('int'));
		$model->addValidator("id", new \Symfony\Component\Validator\Constraints\PositiveOrZero());
		$model->addValidator("slug", new \Symfony\Component\Validator\Constraints\NotNull());
		$model->addValidator("slug", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("slug", new \Symfony\Component\Validator\Constraints\Length(['max'=>255]));
		$model->addValidator("owner", new \Symfony\Component\Validator\Constraints\NotNull());
		$model->addValidator("owner", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("owner", new \Symfony\Component\Validator\Constraints\Length(['max'=>255]));
		$model->addValidator("language", new \Symfony\Component\Validator\Constraints\NotNull());
		$model->addValidator("language", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("language", new \Symfony\Component\Validator\Constraints\Choice(['EN','HU']));
		$model->addValidator("title", new \Symfony\Component\Validator\Constraints\NotNull());
		$model->addValidator("title", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("title", new \Symfony\Component\Validator\Constraints\Length(['max'=>255]));
		$model->addValidator("status", new \Symfony\Component\Validator\Constraints\NotNull());
		$model->addValidator("status", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("status", new \Symfony\Component\Validator\Constraints\Choice(['public','protected','hidden']));
		$model->addValidator("editors", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("editors", new \Symfony\Component\Validator\Constraints\Length(['max'=>65535]));
		$model->addValidator("guests", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("guests", new \Symfony\Component\Validator\Constraints\Length(['max'=>65535]));
		$model->addValidator("menuBgColor", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("menuBgColor", new \Symfony\Component\Validator\Constraints\Length(['max'=>255]));
		$model->addValidator("menuColor", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("menuColor", new \Symfony\Component\Validator\Constraints\Length(['max'=>255]));
		$model->addValidator("menuSecondaryColor", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("menuSecondaryColor", new \Symfony\Component\Validator\Constraints\Length(['max'=>255]));
		$model->addValidator("titleColor", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("titleColor", new \Symfony\Component\Validator\Constraints\Length(['max'=>255]));
		$model->addValidator("footerBgColor", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("footerBgColor", new \Symfony\Component\Validator\Constraints\Length(['max'=>255]));
		$model->addValidator("footerText", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("footerText", new \Symfony\Component\Validator\Constraints\Length(['max'=>255]));
		$model->addValidator("footerContact", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("footerContact", new \Symfony\Component\Validator\Constraints\Length(['max'=>255]));
		$model->addValidator("start", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("start", new \Symfony\Component\Validator\Constraints\Length(['max'=>255]));
		return $model;
	}
}

/**
 * Nobody uses this class, it exists only to help the code completion
 * @method \Application\Ghost\Site[] collect($limit = null, $offset = null)
 * @method \Application\Ghost\Site[] collectPage($pageSize, $page, &$count = 0)
 * @method \Application\Ghost\Site pick()
 */
abstract class GhostSiteFinder extends Finder {}