<?php

namespace App\Controllers;

use App\Models\LabelsModel;
use CodeIgniter\Controller;

class LabelsController extends Controller
{
    /**
     * @constructor
     * @description
     * Using constructor to initialise session under controller
     */
    function __construct()
    {
        $this->session = \Config\Services::session();
    }
    /**
     * @method - index()
     * @return - login/labels-list view
     * @descrition
     * Method to get labels-list
     * Getting list from labels table and return output in array format
     */
    public function labels()
    {
        $labels_obj = new LabelsModel();
        $data['labels'] = $labels_obj->orderBy('id', 'DESC')->findAll();
        /**
         * Checking user_id is empty or not if yes it throws back to login page
         */
        if (isset($this->session->user_id)) {
            return view('labels', $data);
        } else {
            return $this->response->redirect(site_url('/login'));
        }
    }

    /**
     * @method - single_label()
     * @return - edit_label view
     * @description
     * Method to get single labels details by id
     */
    public function single_label()
    {
        $post_data = [
            "id" => $this->request->getVar('id'),
        ];
        $labels_obj = new LabelsModel();
        $data['single_label'] = $labels_obj->where($post_data)->first();
        /**
         * Checking user_id is empty or not if yes it throws back to login page
         */
        if (isset($this->session->user_id)) {
            return view('single-label', $data);
        } else {
            return $this->response->redirect(site_url('/login'));
        }
    }

    /**
     * @method - index()
     * @return - login/labels-list view
     * @descrition
     * Method to get labels-list
     * Getting list from labels table and return output in array format
     */
    public function labels_list()
    {
        $labels_obj = new LabelsModel();
        $data['labels'] = $labels_obj->where('user_id', $this->session->user_id)->findAll();
        /**
         * Checking user_id is empty or not if yes it throws back to login page
         */
        if (isset($this->session->user_id)) {
            return view('label-list', $data);
        } else {
            return $this->response->redirect(site_url('/login'));
        }
    }

    /**
     * @method - index()
     * @return - login/labels-list view
     * @descrition
     * Method to get labels-list
     * Getting list from labels table and return output in array format
     */
    public function labels_list_on_form()
    {
        $labels_obj = new LabelsModel();
        $data['labels'] = $labels_obj->where('user_id', $this->session->user_id)->findAll();
        /**
         * Checking user_id is empty or not if yes it throws back to login page
         */
        if (isset($this->session->user_id)) {
            return view('label-list-on-form', $data);
        } else {
            return $this->response->redirect(site_url('/login'));
        }
    }

    /**
     * @method - save_label()
     * @description
     * Method to get inputs by post and inserts data into labels table
     */
    public function save_label()
    {
        $labels_obj = new LabelsModel();
        $data = [
            'user_id' => $this->session->user_id,
            'user_name' => $this->session->user_name,
            'label_name' => $this->request->getVar('title'),
            'status' => true,
            'created' => date('d-m-y h:i:s'),

        ];

        //Returning inserted id of current record
        echo $labels_obj->insert($data);
    }

    /**
     * @method - update_label()
     * @return - labels-list view
     * @description
     * Method to get inputs by post and update data according to id
     */
    public function update_label()
    {
        $labels_obj = new LabelsModel();
        $id = $this->request->getVar('label_id');
        $update_by = [
            'id' => $this->request->getVar('label_id'),
            'user_id'  => $this->session->user_id,
        ];
        $data = [
            'label_name' => $this->request->getVar('label_name'),
            'updated' => date('d-m-y h:i:s'),
        ];
        $labels_obj->update($update_by, $data);

        // $data['updated_label'] = $labels_obj->where('id', $id)->first();
        // return view('updated-label', $data);
    }

    /**
     * @method - delete_label()
     * @return - labels-list view
     * @description
     * Method to get input by get and delete data according to id
     */
    public function delete_label()
    {
        $labels_obj = new LabelsModel();
        $delete_by = [
            'id' => $this->request->getVar('label_id'),
            'user_id' => $this->session->user_id,
        ];
        $data['label'] = $labels_obj->where($delete_by)->delete();
        return $this->response->redirect(site_url('/labels-list'));
    }
}
