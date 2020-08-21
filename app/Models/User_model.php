<?php namespace App\Models;

class User_model extends MY_model
{
    protected $table = 'users';

    public function findData($model)
    {
        $query = $this->db->table($this->table)->get();
        return $query->getResultArray();
    }

}