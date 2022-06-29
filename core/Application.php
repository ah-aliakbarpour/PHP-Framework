<?php

namespace app\core;


class Application
{
    public static string $ROOT_DIR;

    public string $layout = 'app';
    public string $userClass;
    public Request $request;
    public Router $router;
    public Response $response;
    public Database $db;
    public Session $session;
    public ?Dbmodel $user;

    public static Application $app;
    public ?Controller $controller = null;

    public function __construct($rootDir, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootDir;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();
        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }
        else
            $this->user = null;
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $exception) {

            $this->response->setStatusCode($exception->getCode());

            echo $this->router->renderView('error', [
                'exception' => $exception,
            ]);
        }
    }


    public function getController(): Controller
    {
        return $this->controller;
    }
    public function setController(): Controller
    {
        return $this->controller;
    }

    public function login(DbModel $user): bool
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};

        $this->session->set('user', $primaryValue);

        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest(): bool
    {
        return !self::$app->user;
    }
}