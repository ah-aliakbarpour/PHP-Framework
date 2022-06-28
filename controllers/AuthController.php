<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

class AuthController extends Controller
{

    public function login()
    {
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {
        $this->setLayout('auth');

        $errors = [];

        $registerModel = new RegisterModel();

        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());

            if ($registerModel->validation()/* && $registerModel->register()*/) {
                return 'Success';
            }


            return $this->render('register',[
                'model' => $registerModel,
            ]);
        }

        return $this->render('register',[
            'model' => $registerModel,
        ]);
    }
}