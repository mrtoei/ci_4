<?php namespace App\Models;

use CodeIgniter\Model;

class Authentication_model extends Model
{
    protected $table = 'users';

    public function __construct()
    {
        parent::__construct();

    }
}