<?php 
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class LabelsModel extends Model
{
    protected $table = 'labels';

    protected $primaryKey = 'id';
    protected $allowedDateTime=true;
 
    protected $allowedFields = ['user_id', 'user_name', 'label_name', 'status', 'created'];

}