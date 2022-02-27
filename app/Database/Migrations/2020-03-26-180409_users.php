<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'			=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'auto_increment' 	=> TRUE
			],
			'username'       		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '100',
			],
			'name'       			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '100',
			],
			'email'       			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '100',
			],
			'phone'       			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '20',
			],
			'password'       		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '255',
			],
			'status' 				=> [
				'type'           	=> 'ENUM',
				'constraint' 		=> "'Active','Inactive'",
				'default' 			=> 'Active'
			],
			'level' 				=> [
				'type'           	=> 'ENUM',
				'constraint' 		=> "'Admin','User'",
				'default' 			=> 'Admin'
			],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
