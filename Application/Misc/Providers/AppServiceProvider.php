<?php
Namespace App\Providers;
use Skytells\Support\ServiceProvider;
use Skytells\Foundation;
Class AppServiceProvider extends ServiceProvider {


  protected $defer = false;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      return [
        'contracts' => ['AppContract'],
        'services'  => ['AppService']
      ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      Foundation::$App->singleton(DummyApp::class, function ($app) {
            return new DummyApp();
        });
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [DummyApp::class];
    }
}
