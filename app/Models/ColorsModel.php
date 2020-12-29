<?php 
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class ColorsModel extends Model
{
    protected $table = 'colors';

    protected $primaryKey = 'id';
 
    protected $allowedFields = ['id', 'color', 'color_name'];

}