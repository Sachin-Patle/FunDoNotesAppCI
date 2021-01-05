<?php

namespace App\Controllers;

use App\Controllers\NotesController;
use CodeIgniter\Controller;

class CronController extends Controller
{
    /**
     * @method auto_archive
     * @description
     * Method to auto archive notes
     * Setting notes as archive if it has been more than 30 days from last update
     */

    function auto_archive()
    {
        // if($this->input->is_cli_request())
        // {
        //     $notes_obj = new NotesController();
        //     $notes_obj->auto_archive();
        // }
            $notes_obj = new NotesController();
            $notes_obj->auto_archive();

    }
}
