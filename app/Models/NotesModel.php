<?php 
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class NotesModel extends Model
{
    protected $table = 'notes';

    protected $primaryKey = 'id';
    protected $allowedDateTime=true;
 
    protected $allowedFields = ['user_id', 'user_name', 'label_id', 'label', 'title', 'note', 'color', 'image', 'status', 'archive', 'pin', 'trash', 'created', 'updated'];

}