<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.4
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
Namespace {NAMESPACE}\Providers;
use Skytells\Support\ServiceProvider;
use Skytells\Foundation;
Class {PROVIDERNAME} extends ServiceProvider {


  protected $defer = false;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      return [
        'contracts' => ['{CONTRACTNAME}'],
        'services'  => ['{SERVICENAME}']
      ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      Foundation::$App->singleton({SERVICENAME}::class, function ($app) {
            return new {SERVICENAME}();
        });
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [{SERVICENAME}::class];
    }
}
