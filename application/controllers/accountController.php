<?php

class accountController extends framework
{

    public function __construct()
    {

        if ($this->getSession('userId')) {
            $this->redirect("user_profile");
        }
        $this->helper("link");
        $this->accountModel = $this->model('accountModel');
    }

    public function index()
    {

        $this->view("signup");
    }

    public function createAccount()
    {

        $userData = [

            'fullName' => $this->input('fullName'),
            'email' => $this->input('email'),
            'password' => $this->input('password'),
            'fullNameError' => '',
            'emailError' => '',
            'passwordError' => '',

        ];

        if (empty($userData['fullName'])) {

            $userData['fullNameError'] = 'Required';
        }

        if (empty($userData['email'])) {
            $userData['emailError'] = 'Required';
        } else {
            $isExist = $this->accountModel->checkEmail(['email' => $userData['email']]);
            if (!$isExist) {

                $userData['emailError'] = "Already taken";
            }
        }

        if (empty($userData['password'])) {
            $userData['passwordError'] = "Required";
        } else if (strlen($userData['password']) < 5) {
            $userData['passwordError'] = "Passowrd must be 5 or more characters";
        }

        if (empty($userData['fullNameError']) && empty($userData['emailError']) && empty($userData['passwordError'])) {

            $password = password_hash($userData['password'], PASSWORD_DEFAULT);
            $data = ['fullName' => $userData['fullName'], 'email' => $userData['email'], 'password' => $password];
            if ($this->accountModel->createAccount($data)) {

                $this->setFlash("accountCreated", "Account has been created successfully");
                $this->redirect("accountController/loginForm");
            }
        } else {
            $this->view('signup', $userData);
        }
    }

    public function loginForm()
    {
        $this->view("login");
    }

    public function userLogin()
    {

        $userData = [

            'email' => $this->input('email'),
            'password' => $this->input('password'),
            'emailError' => '',
            'passwordError' => '',

        ];
        $password = password_hash($this->input('password'), PASSWORD_DEFAULT);
        if (empty($userData['email'])) {
            $userData['emailError'] = "Required";
        }

        if (empty($userData['password'])) {
            $userData['passwordError'] = "Required";
        }

        if (empty($userData['emailError']) && empty($userData['passwordError'])) {

            $result = $this->accountModel->userLogin(['email' => $userData['email']], ['password' => $userData['password']]);

            if ($result['status'] === 'emailNotFound') {
                $userData['emailError'] = "You have entered wrong email";
                $this->view("login", $userData);
            } else if ($result['status'] === 'passwordNotMacthed') {
                $userData['passwordError'] = "You have entered wrong password";
                $this->view("login", $userData);
            } else if ($result['status'] === "ok") {
                $this->setSession("userId", $result['data']);
                $this->redirect("profile");
            } else if ($result['status'] === "emailNotExists") {
                $userData['emailError'] = "Email ID not exists";
                $this->view("login", $userData);
            }
        } else {
            $this->view("login", $userData);
        }
    }
}
