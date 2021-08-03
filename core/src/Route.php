<?php
namespace mfw;

class Route
{
    private static object $instance;

    private function __construct(
        private string $app   = '',
        private string $act   = '',
        private string $route = '/'
    )
    {
        $url = new UrlParse();
        $this->loadApp();
    }

    public static function start()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function loadApp()
    {
        var_dump($this->app);
        var_dump($this->act);
        var_dump($this->route);
        $url = new UrlParse();
        var_dump($url->getUrlArray());
        var_dump($url->getByNumUrlArray(1));
    }
}