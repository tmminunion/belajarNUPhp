<?php
namespace App\Helper;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;

class NuRequest
{
    protected $container;
    protected $router;
    protected $events;
    protected $request;
    protected $url;

    public function __construct()
    {
        $this->container = new Container;
        $this->events = new Dispatcher($this->container);
        $this->router = new Router($this->events, $this->container);
        $this->request = Request::capture();
        $this->url = new UrlGenerator($this->router->getRoutes(), $this->request);

        Container::setInstance($this->container);
        Facade::setFacadeApplication($this->container);

        $this->container->instance('router', $this->router);
        $this->container->instance('url', $this->url);
    }

    public function getHttpClient()
    {
        return Http::getFacadeRoot();
    }

    public function Http($url)
    {
        return Http::get($url);
    }
}