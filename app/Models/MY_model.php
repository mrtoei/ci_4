<?php namespace App\Models; 
use CodeIgniter\I18n\Time;
use CodeIgniter\Model;
use Config\Database as db;

class MY_model extends Model 
{

    protected $table = false ;
    protected $idField = 'id';
    public function __construct()
    {
        $this->db = db::connect();
        $this->time_now_utc = Time::now('UTC')->toDateTimeString();
    }

    public function create($data)
    {
       $this->db->table($this->table)->insert($data);
       return $this->db->insertID();
    }

    public function read($id)
    {
        return $this->db->table($this->table)->where($this->idField,$id)->get()->getResultArray();
    }

    public function remove($id)
    {
        return $this->db->table($this->table)->where($this->idField,$id)->delete() ? true : false;
    }
}