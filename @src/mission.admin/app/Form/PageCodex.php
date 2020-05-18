<?php namespace Application\AdminCodex\Form;

use Andesite\Codex\Form\FormDecorator;
use Andesite\Codex\Form\FormHandler\FormHandler;
use Andesite\Codex\Form\ListHandler\ListHandler;
use Application\AdminCodex\GhostHelper\BlogpostHelper;
use Application\AdminCodex\GhostHelper\PageHelper;
use Application\Component\Constant\Permission\Role;

class PageCodex extends PageHelper{

	protected function decorator(FormDecorator $decorator){
		$decorator->setIcons('fal fa-file-alt');
		$decorator->setTitle('Cikk');
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
		$main->input('string', $this->slug);
		$main->input('select', $this->status)('options', $this->status->options);
		$main->input('string', $this->siteId);
		$main->input('text', $this->content);
		$main->input('datetime', $this->created);
		$main->input('datetime', $this->updated);
	}


}
