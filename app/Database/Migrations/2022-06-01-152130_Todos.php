<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Todos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'listname' => [
                'type' => 'VARCHAR',
                'constraint' => 150
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Active', 'Inactive'],
                'auto_increment' => true
            ],
        ]);
        $this->forge->addKey('id');
        $this->forge->createTable('todos');
    }

    public function down()
    {
        //
    }
}
