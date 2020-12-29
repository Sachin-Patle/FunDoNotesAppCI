<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    /**
     * @constructor
     * @description
     * Using constructor to start and initialise session
     */
    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }
    /**
     * @method - login()
     * @return - login view
     * @description
     * Redirecting on login page
     */

    public function login()
    {
        return view('login');
    }

    /**
     * @method - register()
     * @return - registration view
     * @description
     * Redirecting on registration page
     */
    public function register()
    {
        return view('registration');
    }

    /**
     * @method - user_registration()
     * @description
     * Method to get inputs by post and inserts data into users table
     */
    public function user_registration()
    {
        
        $user_obj = new UserModel();
        if (!empty($user_obj->where('email', $this->request->getVar('email'))->first())) {
            $response_msg = [
                'error' => 'Email already taken.. Please take another email',
            ];
            $this->session->set($response_msg); // setting error message on session
            return $this->response->redirect(site_url('/register'));
        } else {
            $data = [
                'first_name' => $this->request->getVar('first_name'),
                'last_name' => $this->request->getVar('last_name'),
                'email' => $this->request->getVar('email'),
                'password'  => $this->request->getVar('password'),
                'status' => true,
                'created' => date('d-m-y h:i:s'),

            ];
            $user_obj->insert($data);
            /**
             * Sending Registration Mail
             */
            $user_name = $this->request->getVar('first_name');
            $user_pass = $this->request->getVar('password');
            $user_email = $this->request->getVar('email');
            $message = "<div style='box-shadow: 3px 3px 3px #888888;padding:15px;background-color:cornsilk; border-radius:10px;'><h2 style='font-family:calibri; text-shadow:2px 2px 1px rgba(0,0,0,0.2); border-bottom: inset #ecd67c;'>Welcome to FunDooNotes</h2><p>Dear $user_name, Thanks for Registration..<br>Your login credentials are :<br><b>Username :</b> $user_email <br> <b> Password :</b>  $user_pass <br>Please do note share it with anyone..</p></div>";
            $email = \Config\Services::email();
            $email->setTo($user_email);
            $email->setSubject('FundoNotes | Registration Successfull');
            $email->setMessage($message); //your message here
            $email->send();

            $response_msg = [
                'success' => 'Registration Successfull',
            ];
            $this->session->set($response_msg); // setting error message on session

            return $this->response->redirect(site_url('/login'));
        }
    }

    /**
     * @method - user_login()
     * @return - login/notes-list view
     * @description
     * Method to check user is registered or not 
     * and if yes, stores user id on session
     */
    public function user_login()
    {
        $user_obj = new UserModel();
        $form_data = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'status' => true,
        ];
        if (!empty($user_info = $user_obj->where($form_data)->first())) {
            $user_data = [
                'user_id' => $user_info['id'],
                'user_email' => $user_info['email'],
                'user_name' => $user_info['first_name'] . " " . $user_info['last_name']
            ];

            $this->session->set($user_data); // setting session data

            return $this->response->redirect(site_url('/notes'));
        } else {
            $response_msg = [
                'error' => 'Invalid login credentials',
            ];
            $this->session->set($response_msg); // setting error message on session
            return $this->response->redirect(site_url('/login'));
        }
    }

    /**
     * @method - logout()
     * @return - login view
     * @description
     * Method to expire user session
     * deletes user id from session
     */
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        return $this->response->redirect(site_url('/login'));
    }
}
