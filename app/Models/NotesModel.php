<?php 
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class NotesModel extends Model
{
    protected $table = 'notes';

    protected $primaryKey = 'id';
    protected $allowedDateTime=true;
 
    protected $allowedFields = ['title', 'note', 'status', 'created'];

    function display_records()
	{
		$query=$this->db->query("select * from notes");
		return $query->result();
	}
}