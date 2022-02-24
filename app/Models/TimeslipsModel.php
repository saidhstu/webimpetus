<?php

namespace App\Models;

use CodeIgniter\Model;

class TimeslipsModel extends Model
{
    protected $table                = 'timeslips';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'modified_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];

    private $businessUuid;

    public function __construct()
    {
        parent::__construct();
        $this->businessUuid = session('uuid_business');
    }

    public function getSingleData($uuid=0)
    {
        $this->where('uuid', $uuid);
        $this->where('uuid_business_id', $this->businessUuid);
        return $this->find();
    }

    public function getTaskData()
    {
        $db = \Config\Database::connect();
        return $db->table("tasks")->getWhere(array('uuid_business_id' => $this->businessUuid))->getResultArray();
    }

    public function getEmployeesData()
    {
        $db = \Config\Database::connect();
        return $db->table("employees")->select('id,CONCAT_WS(" ", saludation, first_name, surname) as name')->getWhere(array('uuid_business_id' => $this->businessUuid))->getResultArray();
    }

    public function saveByUuid($uuid, $data)
    {
        $db = \Config\Database::connect();
        if (!empty($uuid)) {
            unset($data['uuid']);
            $db->table($this->table)->where('uuid', $uuid)->update($data);
        } else {
            $db->table($this->table)->insert($data);
        }
    }
}
