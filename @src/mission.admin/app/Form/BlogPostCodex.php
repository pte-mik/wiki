<?php namespace Application\AdminCodex\Form;

use Andesite\Codex\Form\FormDecorator;
use Andesite\Codex\Form\FormHandler\FormHandler;
use Andesite\Codex\Form\ListHandler\ListHandler;
use Application\AdminCodex\GhostHelper\BlogpostHelper;
use Application\Component\Constant\Permission\Role;

class BlogPostCodex extends BlogpostHelper{

	protected function decorator(FormDecorator $decorator){
		$decorator->setIcons('fal fa-blog');
		$decorator->setTitle('Blogpost');
		$decorator->setRole(Role::Admin);
	}

	protected function listHandler(ListHandler $list){
		$list->addJSPlugin('ListButtonAddNew');
		$list->add($this->id)->visible(false);
		$list->add($this->title);
		$list->add($this->siteId);
	}

	protected function formHandler(FormHandler $form){
		$form->setLabelField($this->title);
		$form->addJSPlugin('FormButtonSave');
		$form->addJSPlugin('FormButtonDelete', 'FormButtonReload', 'FormButtonFiles');

		$main = $form->section('Adatok');
		$main->input('string', $this->title);
		$main->input('text', $this->lead);
		$main->input('text', $this->content);
		$main->input('select', $this->status)('options', $this->status->options);
		$main->input('datetime', $this->published);
	}


}
