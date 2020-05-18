<?php namespace Application\Ghost;

use Andesite\Attachment\AttachmentCategoryManager;
use Andesite\DBAccess\Connection\Filter\Filter;
use Andesite\DBAccess\Connection\Filter\Comparison;
use Andesite\DBAccess\Connection\Finder;
use Andesite\Ghost\Field;
use Andesite\Ghost\Ghost;
use Andesite\Ghost\Model;

/**
 * @method static GhostPageFinder search(Filter $filter = null)
 * @property-read $id
 * @property-read AttachmentCategoryManager $files
 * @property-read AttachmentCategoryManager $gallery
 */
abstract class PageGhost extends Ghost{

	/** @var Model */
	public static $model;
	const Table = "page";
	const ConnectionName = "default";

		public static function f_id(){return new Comparison('id');}
		public static function f_siteId(){return new Comparison('siteId');}
		public static function f_title(){return new Comparison('title');}
		public static function f_slug(){return new Comparison('slug');}
		public static function f_content(){return new Comparison('content');}
		public static function f_status(){return new Comparison('status');}
		public static function f_created(){return new Comparison('created');}
		public static function f_updated(){return new Comparison('updated');}

	const V_status_active = "active";
	const V_status_draft = "draft";
	const V_status_deleted = "deleted";

	const F_id = "id";
	const F_siteId = "siteId";
	const F_title = "title";
	const F_slug = "slug";
	const F_content = "content";
	const F_status = "status";
	const F_created = "created";
	const F_updated = "updated";

	const A_files = "files";
	const A_gallery = "gallery";

	/** @var int $id */
	protected $id;
	/** @var int $siteId */
	public $siteId;
	/** @var string $title */
	public $title;
	/** @var string $slug */
	public $slug;
	/** @var string $content */
	public $content;
	/** @var string $status */
	public $status;
	/** @var \DateTime $created */
	public $created;
	/** @var \DateTime $updated */
	public $updated;



	final static protected function createModel(): Model{
		$model = new Model(get_called_class());
		$model->addField("id", Field::TYPE_ID,null);
		$model->addField("siteId", Field::TYPE_ID,null);
		$model->addField("title", Field::TYPE_STRING,null);
		$model->addField("slug", Field::TYPE_STRING,null);
		$model->addField("content", Field::TYPE_STRING,null);
		$model->addField("status", Field::TYPE_ENUM,['active','draft','deleted']);
		$model->addField("created", Field::TYPE_DATETIME,null);
		$model->addField("updated", Field::TYPE_DATETIME,null);
		$model->protectField("id");
		$model->addValidator("id", new \Symfony\Component\Validator\Constraints\Type('int'));
		$model->addValidator("id", new \Symfony\Component\Validator\Constraints\PositiveOrZero());
		$model->addValidator("siteId", new \Symfony\Component\Validator\Constraints\NotNull());
		$model->addValidator("siteId", new \Symfony\Component\Validator\Constraints\Type('int'));
		$model->addValidator("siteId", new \Symfony\Component\Validator\Constraints\PositiveOrZero());
		$model->addValidator("title", new \Symfony\Component\Validator\Constraints\NotNull());
		$model->addValidator("title", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("title", new \Symfony\Component\Validator\Constraints\Length(['max'=>255]));
		$model->addValidator("slug", new \Symfony\Component\Validator\Constraints\NotNull());
		$model->addValidator("slug", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("slug", new \Symfony\Component\Validator\Constraints\Length(['max'=>255]));
		$model->addValidator("content", new \Symfony\Component\Validator\Constraints\NotNull());
		$model->addValidator("content", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("content", new \Symfony\Component\Validator\Constraints\Length(['max'=>65535]));
		$model->addValidator("status", new \Symfony\Component\Validator\Constraints\NotNull());
		$model->addValidator("status", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("status", new \Symfony\Component\Validator\Constraints\Choice(['active','draft','deleted']));
		$model->addValidator("created", new \Symfony\Component\Validator\Constraints\NotNull());
		$model->addValidator("created", new \Andesite\Ghost\Validator\Instance('DateTime'));
		$model->addValidator("updated", new \Symfony\Component\Validator\Constraints\NotNull());
		$model->addValidator("updated", new \Andesite\Ghost\Validator\Instance('DateTime'));
		return $model;
	}
}

/**
 * Nobody uses this class, it exists only to help the code completion
 * @method \Application\Ghost\Page[] collect($limit = null, $offset = null)
 * @method \Application\Ghost\Page[] collectPage($pageSize, $page, &$count = 0)
 * @method \Application\Ghost\Page pick()
 */
abstract class GhostPageFinder extends Finder {}