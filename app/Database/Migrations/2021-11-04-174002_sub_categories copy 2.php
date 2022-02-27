<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sub_category extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'sub_category_id'			=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'auto_increment' 	=> TRUE
			],
			'category_id'			=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
			],
			'sub_category_name'       	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '100',
			],
			'sub_category_status' 		=> [
				'type'           	=> 'ENUM',
				'constraint' 		=> "'Active','Inactive'",
				'default' 			=> 'Active'
			],
		]);
		$this->forge->addKey('sub_category_id', TRUE);
		$this->forge->addForeignKey('category_id', 'categories', 'category_id');
		$this->forge->createTable('sub_categories');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sub_categories');
	}
}
