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
    public function index(){
        $notes_obj = new NotesModel();
        $data['notes'] = $notes_obj->orderBy('id', 'DESC')->findAll();
        /**
         * Checking user_id is empty or not if yes it throws back to login page
         */
        if(isset($this->session->user_id))
        {
            return view('notes-list', $data);
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
            'title' => $this->request->getVar('title'),
            'note'  => $this->request->getVar('note'),
            'status' => true,
            'created' => date('d-m-y h:i:s'),

        ];

        //Returning inserted id of current record
        echo $notes_obj->insert($data);
    }

    /**
     * @method - single_note()
     * @return - edit_note view
     * @description
     * Method to get single notes details by id
     */
    public function singleNote($id = null){
        $notes_obj = new NotesModel();
        $data['note_obj'] = $notes_obj->where('id', $id)->first();
        return view('edit_note', $data);
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
        $data = [
            'title' => $this->request->getVar('title'),
            'note'  => $this->request->getVar('note'),
            'updated' => date('d-m-y h:i:s'),
        ];
        $notes_obj->update($id, $data);
        return $this->response->redirect(site_url('/notes-list'));
    }
 
    /**
     * @method - delete_note()
     * @return - notes-list view
     * @description
     * Method to get input by get and delete data according to id
     */
    public function delete($id = null){
        $notes_obj = new NotesModel();
        $data['note'] = $notes_obj->where('id', $id)->delete($id);
        return $this->response->redirect(site_url('/notes-list'));
    }    
}