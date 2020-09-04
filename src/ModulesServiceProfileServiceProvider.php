<?php

namespace Dorcas\ModulesServiceProfile;
use Illuminate\Support\ServiceProvider;

class ModulesServiceProfileServiceProvider extends ServiceProvider {

	public function boot()
	{
		$this->loadRoutesFrom(__DIR__.'/routes/web.php');
		$this->loadViewsFrom(__DIR__.'/resources/views', 'modules-service-profile');
		$this->publishes([
			__DIR__.'/config/modules-service-profile.php' => config_path('modules-service-profile.php'),
		], 'dorcas-modules');
		/*$this->publishes([
			__DIR__.'/assets' => public_path('vendor/modules-service-profile')
		], 'dorcas-modules');*/
	}

	public function register()
	{
		//add menu config
		$this->mergeConfigFrom(
	        __DIR__.'/config/navigation-menu.php', 'navigation-menu.modules-service-profile.sub-menu'
	     );
	}

}


?>