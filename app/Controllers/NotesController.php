<?php 
namespace App\Controllers;
use App\Models\NotesModel;
use CodeIgniter\Controller;

class NotesController extends Controller
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
     * @return - login/notes-list view
     * @descrition
     * Method to get notes-list
     * Getting list from notes table and return output in array format
     */
    public function notes()
    {
        /**
         * Checking user_id is empty or not if yes it throws back to login page
         */
        if(isset($this->session->user_id))
        {
            return view('notes');
        }
        else
        {
            return $this->response->redirect(site_url('/login'));
        }
    }

    /**
     * @method - single_note()
     * @return - edit_note view
     * @description
     * Method to get single notes details by id
     */
    public function single_note()
    {
        $post_data=[
            "id" => $this->request->getVar('id'),
        ];
        $notes_obj = new NotesModel();
        $data['single_note'] = $notes_obj->where($post_data)->first();
        /**
         * Checking user_id is empty or not if yes it throws back to login page
         */
        if(isset($this->session->user_id))
        {
            return view('single-note', $data);
        }
        else
        {
            return $this->response->redirect(site_url('/login'));
        }
    }

    /**
     * @method - notes_list()
     * @return - login/notes-list view
     * @descrition
     * Method to get notes-list
     * Getting list from notes table and return output in array format
     */
    public function notes_list()
    {
        $notes_obj = new NotesModel();
        $notes_by=[
            'user_id' => $this->session->user_id,
            'status' => true,
            'archive' => false,
        ];
        $data['notes'] = $notes_obj->where($notes_by)->findAll();
        /**
         * Checking user_id is empty or not if yes it throws back to login page
         */
        if(isset($this->session->user_id))
        {
            return view('note-list', $data);
        }
        else
        {
            return $this->response->redirect(site_url('/login'));
        }
    }

    /**
     * @method - notes_list_by_label()
     * @return - login/notes-list view
     * @descrition
     * Method to get notes-list
     * Getting list from notes table and return output in array format
     */
    public function notes_list_by_label()
    {
        $notes_obj = new NotesModel();
        $notes_by=[
            'user_id' => $this->session->user_id,
            'label_id' => $this->request->getVar('label_id'),
            'status' => true,
            'archive' => false,
        ];
        $data['notes'] = $notes_obj->where($notes_by)->findAll();
        /**
         * Checking user_id is empty or not if yes it throws back to login page
         */
        if(isset($this->session->user_id))
        {
            return view('note-list', $data);
        }
        else
        {
            return $this->response->redirect(site_url('/login'));
        }
    }
 
    /**
     * @method - save_note()
     * @description
     * Method to get inputs by post and inserts data into notes table
     */
    public function save_note() {
        $notes_obj = new NotesModel();
        $data = [
            'user_id' => $this->session->user_id,
            'user_name' => $this->session->user_name,
            'label' => $this->request->getVar('label'),
            'label_id' => $this->request->getVar('label_id'),
            'title' => $this->request->getVar('title'),
            'note'  => $this->request->getVar('note'),
            'status' => true,
            'created' => date('d-m-y h:i:s'),

        ];

        //Returning inserted id of current record
        echo $notes_obj->insert($data);
    }

    /**
     * @method - update_note()
     * @return - notes-list view
     * @description
     * Method to get inputs by post and update data according to id
     */
    public function update_note(){
        $notes_obj = new NotesModel();
        $id = $this->request->getVar('note_id');
        $update_by = [
            'id' => $this->request->getVar('note_id'),
            'user_id'  => $this->session->user_id,
        ];
        $data = [
            'title' => $this->request->getVar('title'),
            'note'  => $this->request->getVar('note'),
            'updated' => date('d-m-y h:i:s'),
        ];
        $notes_obj->update($update_by, $data);

        $data['updated_note'] = $notes_obj->where('id', $id)->first();
        return view('updated-note', $data);
    }
 
    /**
     * @method - delete_note()
     * @return - notes-list view
     * @description
     * Method to get input by get and delete data according to id
     */
    public function delete_note(){
        $notes_obj = new NotesModel();
        $delete_by = [
            'id' => $this->request->getVar('note_id'),
            'user_id' => $this->session->user_id,
        ];
        $data['note'] = $notes_obj->where($delete_by)->delete();
        return $this->response->redirect(site_url('/notes-list'));
    } 
}