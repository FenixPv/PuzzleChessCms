<?php
namespace mfw;

class Route
{
    private static object $instance;

    private function __construct(
        private string $app   = '',
        private string $act   = '',
        private string $map   = __DIR__ . '/../config/routesConfig.php',
        private string $route = '/'
    )
    {
        $url = new UrlParse();
        $this->route = ($url->getByNumUrlArray(1) != '') ? $url->getByNumUrlArray(1) : '/';
        $this->act   = ($url->getByNumUrlArray(2) != '') ? $url->getByNumUrlArray(2) : '';
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
        $map = require $this->map;
        
        if (array_key_exists($this->route, $map)) {
            $app = $map[$this->route][0];
            if ($this->act === '') {
                $act = $map[$this->route][1];
            } else {
                $act = $this->act;
            }
        } else {
            $app = $map['/'][0];
            if ($this->app === "") {
                $act = $map['/'][1];
            } else {
                $act = $this->app;
            }
        }

        $class = 'apps\\' . $app . '\\' . ucfirst($app) . 'Controller';
        if (method_exists($class, $act)) {
            $method = $act;
        } else {
            $method = 'default';
        }
        
        $startApp = new $class;
        $startApp->$method();
        $this->routeInfo();
    }

    public function routeInfo()
    {
        $map = require $this->map;
        $defaultApp = $map['/'];
        $searchApp = $this->route;
        echo '<div style="border:1px solid #000;background: aliceblue;padding: 20px">';
        echo '<h1>Test class Route</h1>';
        echo '<table border="1" cellspacing="0" cellpadding="10">';
        echo '<tr><th>ROUTE</th><th>APP</th><th>ACTION</th></tr>';
        foreach ($map as $r => $v) {
            echo '<tr>';
            echo "<td><b>$r</b></td>";
            echo "<td><b>$v[0]</b></td>";
            echo "<td><b>$v[1]</b></td>";
            echo '</tr>';
        }
        echo '</table>';
        echo '<h3>Default App</h3>';
        var_dump($defaultApp);
        echo '<h3>Searhc App</h3>';
        var_dump($searchApp);
        echo '</div>';
    }
}