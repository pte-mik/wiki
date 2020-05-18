<?php namespace Application\Module\MikAuth;

use Andesite\Codex\Interfaces\CodexWhoAmIInterface;
use Andesite\Core\ServiceManager\Service;
use Application\Module\MikAuth\MikAuth;
class CodexWhoAmI implements CodexWhoAmIInterface{

	use Service;

	public function getName(): string{
		dump('getName');
		return MikAuth::Module()->getAuthSession()->getUser()->name;
	}

	public function getAvatar(): string{
		dump('getAvatar');
		return MikAuth::Module()->getAuthSession()->getUser()->avatar32;
	}

	public function checkRole($role): bool{
		dump('checkRole');
		dump($role);
		return MikAuth::Module()->getAuthSession()->getUser()->checkRole($role);
	}

	public function isAuthenticated(): bool{
		dump('isAuthenticated');
		return MikAuth::Module()->getAuthSession()->isAuthenticated();
	}

	public function logout(){
		dump('logout');
		return MikAuth::Module()->getAuthSession()->forget();
	}

	public function __invoke(): ?int{
		dump('__invoke');
		return MikAuth::Module()->getAuthSession()->getUserId();
	}
}