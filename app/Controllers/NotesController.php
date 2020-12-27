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
     * @method - notes()
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
        if (isset($this->session->user_id)) {
            return view('notes');
        } else {
            return $this->response->redirect(site_url('/login'));
        }
    }

    /**
     * @method - archive()
     * @return - login/notes-list view
     * @descrition
     * Method to get notes-list
     * Getting list from notes table and return output in array format
     */
    public function archive()
    {
        /**
         * Checking user_id is empty or not if yes it throws back to login page
         */
        if (isset($this->session->user_id)) {
            return view('archive');
        } else {
            return $this->response->redirect(site_url('/login'));
        }
    }

    /**
     * @method - pinned()
     * @return - login/notes-list view
     * @descrition
     * Method to get notes-list
     * Getting list from notes table and return output in array format
     */
    public function pinned()
    {
        /**
         * Checking user_id is empty or not if yes it throws back to login page
         */
        if (isset($this->session->user_id)) {
            return view('pinned-notes');
        } else {
            return $this->response->redirect(site_url('/login'));
        }
    }

    /**
     * @method - trash()
     * @return - login/trash-notes-list view
     * @descrition
     * Method to get notes-list from trash
     * Getting list from notes table and return output in array format
     */
    public function trash()
    {
        /**
         * Checking user_id is empty or not if yes it throws back to login page
         */
        if (isset($this->session->user_id)) {
            return view('trash');
        } else {
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
        $note_by = [
            "id" => $this->request->getVar('id'),
        ];
        $notes_obj = new NotesModel();
        $data['notes'] = $notes_obj->where($note_by)->findAll();
        /**
         * Checking user_id is empty or not if yes it throws back to login page
         */
        if (isset($this->session->user_id)) {
            return view('note-list', $data);
        } else {
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
        $notes_by = [
            'user_id' => $this->session->user_id,
            'status' => true,
            'archive' => false,
        ];
        $data['notes'] = $notes_obj->where($notes_by)->findAll();
        /**
         * Checking user_id is empty or not if yes it throws back to login page
         */
        if (isset($this->session->user_id)) {
            return view('note-list', $data);
        } else {
            return $this->response->redirect(site_url('/login'));
        }
    }

    /**
     * @method - archive_list()
     * @return - login/notes-list view
     * @descrition
     * Method to get notes-list
     * Getting list from notes table and return output in array format
     */
    public function archive_list()
    {
        $notes_obj = new NotesModel();
        $notes_by = [
            'user_id' => $this->session->user_id,
            'status' => true,
            'archive' => true,
        ];
        $data['notes'] = $notes_obj->where($notes_by)->findAll();
        /**
         * Checking user_id is empty or not if yes it throws back to login page
         */
        if (isset($this->session->user_id)) {
            return view('note-list', $data);
        } else {
            return $this->response->redirect(site_url('/login'));
        }
    }
    /**
     * @method - trash_list()
     * @return - login/notes-list view
     * @descrition
     * Method to get notes-list
     * Getting list from notes table and return output in array format
     */
    public function trash_list()
    {
        $notes_obj = new NotesModel();
        $notes_by = [
            'user_id' => $this->session->user_id,
            'status' => false,
        ];
        $data['notes'] = $notes_obj->where($notes_by)->findAll();
        /**
         * Checking user_id is empty or not if yes it throws back to login page
         */
        if (isset($this->session->user_id)) {
            return view('note-list', $data);
        } else {
            return $this->response->redirect(site_url('/login'));
        }
    }

    /**
     * @method - pinned_notes()
     * @return - login/notes-list view
     * @descrition
     * Method to get notes-list
     * Getting list from notes table and return output in array format
     */
    public function pinned_notes()
    {
        $notes_obj = new NotesModel();
        $notes_by = [
            'user_id' => $this->session->user_id,
            'status' => true,
            'pin' => true,
        ];
        $data['notes'] = $notes_obj->where($notes_by)->findAll();
        /**
         * Checking user_id is empty or not if yes it throws back to login page
         */
        if (isset($this->session->user_id)) {
            return view('note-list', $data);
        } else {
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
        $notes_by = [
            'user_id' => $this->session->user_id,
            'label_id' => $this->request->getVar('label_id'),
            'status' => true,
            'archive' => false,
        ];
        $data['notes'] = $notes_obj->where($notes_by)->findAll();
        /**
         * Checking user_id is empty or not if yes it throws back to login page
         */
        if (isset($this->session->user_id)) {
            return view('note-list', $data);
        } else {
            return $this->response->redirect(site_url('/login'));
        }
    }

    /**
     * @method - save_note()
     * @description
     * Method to get inputs by post and inserts data into notes table
     */
    public function save_note()
    {
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
    public function update_note()
    {
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
    public function delete_note()
    {
        $notes_obj = new NotesModel();
        $delete_by = [
            'id' => $this->request->getVar('note_id'),
            'user_id' => $this->session->user_id,
        ];
        $data['note'] = $notes_obj->where($delete_by)->delete();
        return $this->response->redirect(site_url('/notes-list'));
    }
    /**
     * @method - set_archive()
     * @description
     * Method to set an note as archive note
     */
    public function set_archive()
    {
        $notes_obj = new NotesModel();
        $id = $this->request->getVar('note_id');
        $update_by = [
            'id' => $this->request->getVar('note_id'),
            'user_id'  => $this->session->user_id,
        ];
        $data = [
            'archive'  => true,
            'updated' => date('d-m-y h:i:s'),
        ];
        $notes_obj->update($update_by, $data);
    }
    /**
     * @method - unset_archive()
     * @description
     * Method to unset an note from archive note
     */
    public function unset_archive()
    {
        $notes_obj = new NotesModel();
        $id = $this->request->getVar('note_id');
        $update_by = [
            'id' => $this->request->getVar('note_id'),
            'user_id'  => $this->session->user_id,
        ];
        $data = [
            'archive'  => false,
            'updated' => date('d-m-y h:i:s'),
        ];
        $notes_obj->update($update_by, $data);
    }

    /**
     * @method - trash_note()
     * @description
     * Method to move note to trash
     */
    public function trash_note()
    {
        $notes_obj = new NotesModel();
        $id = $this->request->getVar('note_id');
        $update_by = [
            'id' => $this->request->getVar('note_id'),
            'user_id'  => $this->session->user_id,
        ];
        $data = [
            'status'  => false,
            'updated' => date('d-m-y h:i:s'),
        ];
        $notes_obj->update($update_by, $data);
    }

    /**
     * @method - restore_note()
     * @description
     * Method to restore note from trash
     */
    public function restore_note()
    {
        $notes_obj = new NotesModel();
        $id = $this->request->getVar('note_id');
        $update_by = [
            'id' => $this->request->getVar('note_id'),
            'user_id'  => $this->session->user_id,
        ];
        $data = [
            'status'  => true,
            'updated' => date('d-m-y h:i:s'),
        ];
        $notes_obj->update($update_by, $data);
    }

    /**
     * @method - empty_trash()
     * @description
     * Method to move note to trash by id
     */
    public function empty_trash()
    {
        $notes_obj = new NotesModel();
        $delete_by = [
            'user_id' => $this->session->user_id,
            'status' => false,
        ];
        $data['note'] = $notes_obj->where($delete_by)->delete();
    }

    /**
     * @method - change_color()
     * @description
     * Method to change note background color
     */
    public function change_color()
    {
        $notes_obj = new NotesModel();
        $update_by = [
            'id' => $this->request->getVar('note_id'),
            'user_id'  => $this->session->user_id,
        ];
        $data = [
            'color' => $this->request->getVar('color'),
        ];
        $notes_obj->update($update_by, $data);
    }
    /**
     * @method - change_image()
     * @description
     * Method to change note background color
     */
    public function change_image()
    {
        $notes_obj = new NotesModel();
        $update_by = [
            'id' => $this->request->getVar('note_id'),
            'user_id'  => $this->session->user_id,
        ];
        $note_info = $notes_obj->where($update_by)->first();
        helper(['form', 'url']);
         
        $image_file = $this->validate([
            'file' => [
                'uploaded[file]',
                'mime_in[file,image/jpg,image/jpeg,image/png]',
                'max_size[file,1024]',
            ]
        ]);
    
        if (!$image_file) {
            print_r('Choose a valid file');
        } else {
            $image = $this->request->getFile('file');
            $new_file_name=str_replace(' ','-',$note_info['title']).date("d-m-Y_h-i-s-A").".".$image->getExtension();
            $image->move(WRITEPATH . 'temp', $new_file_name);
    
            $data = [
               'image' =>  $image->getName(),
            ];
            $notes_obj->update($update_by, $data);

            print_r('File has successfully uploaded');
            return $this->response->redirect(site_url('/notes'));
        }
        // $notes_obj->update($update_by, $data);
    }
}
