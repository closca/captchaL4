<?php namespace closca\Captcha;

use Illuminate\Support\ServiceProvider;

class CaptchaServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('mews/captcha');

        require __DIR__ . '/../../routes.php';
        $this->app->validator->resolver(function ($translator, $data, $rules, $messages) {
            return new CaptchaValidator($translator, $data, $rules, $messages);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['captcha'] = $this->app->share(function ($app) {
            return Captcha::instance();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('captcha');
    }
}
