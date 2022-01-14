<?php

namespace App;

use AltoRouter;
use App\Controller\AnneeController;

class Router
{

    /**
     
     * @var string
     */
    private $viewPath;
    /**
     * Undocumented variable
     *
     * @var string
     */
    private string $controlPath;

    /**
     * @var AltoRouter
     */
    private $router;
    /**
     * Undocumented function
     *
     * @param string $viewPath
     */
    public function __construct(string $viewPath, ?string $controlPath = null)
    {
        $this->viewPath = $viewPath;
        $this->controlPath = $controlPath;
        $this->router = new \AltoRouter();
    }
    /**
     * Undocumented function
     *
     * @param string $method
     * @param string $url
     * @param string $view
     * @param string|null $name
     * @return self
     */
    public function get(string $method = 'GET', string $url, string $view, ?string $name = null): self
    {

        $this->router->map($method, $url, $view, $name);
        return $this;
    }
    /**
     * Undocumented function
     *
     * @param string $name
     * @param array $params
     */
    public function url(string $name, array $params = [])
    {
        return $this->router->generate($name, $params);
    }
    /**
     * Undocumented function
     *
     * @return self
     */
    public function run(): self
    {
        $match = $this->router->match();
        if ($match) {
            $target = $match['target'];
            if (strpos($target, '#') !== false) {
                list($controller, $action) = explode('#', $target);
                require $this->controlPath . DIRECTORY_SEPARATOR . $controller . '.php';

                $controller = "App\\Controller\\" . $controller;
                $control = new $controller;
                $control->$action();
            } else {
                $params = $match['params'];
                $view = $match['target'];
                if (strpos($view, 'login') !== false) {
                    require $this->viewPath . DIRECTORY_SEPARATOR . $view . '.php';
                    return $this;
                }
                $router = $this;
                ob_start();
                require $this->viewPath . DIRECTORY_SEPARATOR . $view . '.php';
                $content = ob_get_clean();

                require $this->viewPath . DIRECTORY_SEPARATOR . 'layouts/default.php';
            }
        } else {
            http_response_code(404);
            require $this->viewPath . DIRECTORY_SEPARATOR . 'error/404.php';
            //header('Location: /error');
        }

        return $this;
    }
}
