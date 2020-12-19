<?php 
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class UserModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';
    protected $allowedDateTime=true;
 
    protected $allowedFields = ['first_name', 'last_name', 'email', 'password', 'status', 'created'];
}