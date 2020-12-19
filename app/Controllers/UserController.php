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

    public function login(){
        return view('login');
    }

    /**
     * @method - register()
     * @return - registration view
     * @description
     * Redirecting on registration page
     */
    public function register(){
        return view('registration');
    }
 
    /**
     * @method - user_registration()
     * @description
     * Method to get inputs by post and inserts data into users table
     */
    public function user_registration() {
        $user_obj = new UserModel();
        $data = [
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name'),
            'email' => $this->request->getVar('email'),
            'password'  => $this->request->getVar('password'),
            'status' => true,
            'created' => date('d-m-y h:i:s'),

        ];
        $user_obj->insert($data);
        return $this->response->redirect(site_url('/login'));
    }

    /**
     * @method - user_login()
     * @return - login/notes-list view
     * @description
     * Method to check user is registered or not 
     * and if yes, stores user id on session
     */
    public function user_login(){
        $user_obj = new UserModel();
        $form_data = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'status' => true,
        ];
        if(!empty($user_info=$user_obj->where($form_data)->first()))
        {
            // $this->session->set($user_info['user']);
            $_SESSION['user_id']=$user_info['id'];
            $user_id=$this->session->user_id;
            return $this->response->redirect(site_url('/notes-list'));

        }
        else{
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
    public function logout(){
            unset($_SESSION['user_id']);
            return $this->response->redirect(site_url('/login'));
        
    }

    
}