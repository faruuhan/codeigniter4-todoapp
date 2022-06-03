<?php 

namespace App\Models;

use CodeIgniter\Model;

class TodosModel extends Model {
    protected $table = 'todos';
    protected $allowedFields = ['listname', 'status'];

    public function getTodos($status = false)
    {
        if ($status == false) {
            return $this->findAll();
        }

        return $this->where('status', $status)->findAll();
    }
}