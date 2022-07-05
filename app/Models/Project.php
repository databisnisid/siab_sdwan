<?php

namespace App\Models;

use CodeIgniter\Model;
#use CodeIgniter\Database\RawSql;

class Project extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'project';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function get_all() {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        $query = $builder->get()->getResultArray();

        return $query;
    }

    public function get_project_id_by_name($name='SIAB') {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        #$sql = "SELECT * FROM " . $this->table . " WHERE name like " . $name . "%";
        #$builder->select($sql);
        $builder->like('name', $name);
        $query = $builder->get()->getResultArray();

        return $query;
    }
}
