<?php

namespace App\Models;

use CodeIgniter\Model;

class BackOne extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'backone';
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

    public function get_backone_by_project_id($project_id=7) {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->where('project_id', $project_id);
        $query = $builder->get()->getResultArray();

        return $query;
    }
}
