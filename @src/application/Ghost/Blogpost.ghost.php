<?php namespace Application\Ghost;

use Andesite\Attachment\AttachmentCategoryManager;
use Andesite\DBAccess\Connection\Filter\Filter;
use Andesite\DBAccess\Connection\Filter\Comparison;
use Andesite\DBAccess\Connection\Finder;
use Andesite\Ghost\Field;
use Andesite\Ghost\Ghost;
use Andesite\Ghost\Model;

/**
 * @method static GhostBlogpostFinder search(Filter $filter = null)
 * @property-read $id
 * @property-read AttachmentCategoryManager $files
 * @property-read AttachmentCategoryManager $gallery
 * @property-read AttachmentCategoryManager $leadImage
 */
abstract class BlogpostGhost extends Ghost{

	/** @var Model */
	public static $model;
	const Table = "blogpost";
	const ConnectionName = "default";

		public static function f_id(){return new Comparison('id');}
		public static function f_siteId(){return new Comparison('siteId');}
		public static function f_title(){return new Comparison('title');}
		public static function f_lead(){return new Comparison('lead');}
		public static function f_content(){return new Comparison('content');}
		public static function f_status(){return new Comparison('status');}
		public static function f_published(){return new Comparison('published');}

	const V_status_active = "active";
	const V_status_draft = "draft";
	const V_status_deleted = "deleted";

	const F_id = "id";
	const F_siteId = "siteId";
	const F_title = "title";
	const F_lead = "lead";
	const F_content = "content";
	const F_status = "status";
	const F_published = "published";

	const A_files = "files";
	const A_gallery = "gallery";
	const A_leadImage = "leadImage";

	/** @var int $id */
	protected $id;
	/** @var int $siteId */
	public $siteId;
	/** @var string $title */
	public $title;
	/** @var string $lead */
	public $lead;
	/** @var string $content */
	public $content;
	/** @var string $status */
	public $status;
	/** @var \DateTime $published */
	public $published;



	final static protected function createModel(): Model{
		$model = new Model(get_called_class());
		$model->addField("id", Field::TYPE_ID,null);
		$model->addField("siteId", Field::TYPE_ID,null);
		$model->addField("title", Field::TYPE_STRING,null);
		$model->addField("lead", Field::TYPE_STRING,null);
		$model->addField("content", Field::TYPE_STRING,null);
		$model->addField("status", Field::TYPE_ENUM,['active','draft','deleted']);
		$model->addField("published", Field::TYPE_DATETIME,null);
		$model->protectField("id");
		$model->addValidator("id", new \Symfony\Component\Validator\Constraints\Type('int'));
		$model->addValidator("id", new \Symfony\Component\Validator\Constraints\PositiveOrZero());
		$model->addValidator("siteId", new \Symfony\Component\Validator\Constraints\NotNull());
		$model->addValidator("siteId", new \Symfony\Component\Validator\Constraints\Type('int'));
		$model->addValidator("siteId", new \Symfony\Component\Validator\Constraints\PositiveOrZero());
		$model->addValidator("title", new \Symfony\Component\Validator\Constraints\NotNull());
		$model->addValidator("title", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("title", new \Symfony\Component\Validator\Constraints\Length(['max'=>255]));
		$model->addValidator("lead", new \Symfony\Component\Validator\Constraints\NotNull());
		$model->addValidator("lead", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("lead", new \Symfony\Component\Validator\Constraints\Length(['max'=>65535]));
		$model->addValidator("content", new \Symfony\Component\Validator\Constraints\NotNull());
		$model->addValidator("content", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("content", new \Symfony\Component\Validator\Constraints\Length(['max'=>65535]));
		$model->addValidator("status", new \Symfony\Component\Validator\Constraints\NotNull());
		$model->addValidator("status", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("status", new \Symfony\Component\Validator\Constraints\Choice(['active','draft','deleted']));
		$model->addValidator("published", new \Symfony\Component\Validator\Constraints\NotNull());
		$model->addValidator("published", new \Andesite\Ghost\Validator\Instance('DateTime'));
		return $model;
	}
}

/**
 * Nobody uses this class, it exists only to help the code completion
 * @method \Application\Ghost\Blogpost[] collect($limit = null, $offset = null)
 * @method \Application\Ghost\Blogpost[] collectPage($pageSize, $page, &$count = 0)
 * @method \Application\Ghost\Blogpost pick()
 */
abstract class GhostBlogpostFinder extends Finder {}