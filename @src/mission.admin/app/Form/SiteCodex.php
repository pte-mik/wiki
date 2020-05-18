<?php namespace Application\AdminCodex\Form;

use Andesite\Codex\Form\FormDecorator;
use Andesite\Codex\Form\FormHandler\FormHandler;
use Andesite\Codex\Form\ListHandler\ListHandler;
use Application\AdminCodex\GhostHelper\SiteHelper;
use Application\Component\Constant\Permission\Role;

class SiteCodex extends SiteHelper{

	protected function decorator(FormDecorator $decorator){
		$decorator->setIcons('fal fa-book');
		$decorator->setTitle('Wiki');
		$decorator->setRole(Role::Admin);
	}

	protected function listHandler(ListHandler $list){
		$list->addJSPlugin('ListButtonAddNew');
		$list->add($this->id)->visible(false);
		$list->add($this->title);
	}

	protected function formHandler(FormHandler $form){
		$form->setLabelField($this->title);
		$form->addJSPlugin('FormButtonSave');
		$form->addJSPlugin('FormButtonDelete', 'FormButtonReload', 'FormButtonFiles');

		$main = $form->section('Adatok');
		$main->input('string', $this->title);
		$main->input('string', $this->slug);
		$main->input('select', $this->language)('options', $this->language->options);
		$main->input('select', $this->status)('options', $this->status->options);
		$main->input('string', $this->start);
//		$main->input('text', $this->structure);
		$main->input('string', $this->owner);
		$main->input('text', $this->editors);
		$main->input('text', $this->guests);
		$main->input('color', $this->titleColor);
		$main->input('color', $this->menuBgColor);
		$main->input('color', $this->menuColor);
		$main->input('color', $this->menuSecondaryColor);
		$main->input('color', $this->footerBgColor);
		$main->input('text', $this->footerText);
		$main->input('text', $this->footerContact);


	}


}
