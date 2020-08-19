<?php namespace App\Models; 
use CodeIgniter\Model;
use Config\Database as db;

class MY_model extends Model 
{
    protected $table = false ;
    public function __construct()
    {
        $this->db = db::connect();
    }
    
    public function findData($find = null)
    {
        $query = $this->db->table($this->table)->get();
        return$query->getResultArray();
    }
}