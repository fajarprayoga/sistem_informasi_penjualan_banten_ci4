<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sub_category extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'order_detail_id'		=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'auto_increment' 	=> TRUE
			],
			'order_id'			=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
			],
			'product_id'			=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
			],
			'order_detail_quantity'       	=> [
				'type'           	=> 'INT',
				'constraint'     	=> '11',
			],
			'order_detail_price' 		=> [
				'type'           	=> 'INT',
				'constraint'     	=> '11',
			],
		]);
		$this->forge->addKey('order_detail_id', TRUE);
		$this->forge->addForeignKey('order_id', 'orders', 'order_id');
		$this->forge->createTable('order_details');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('order_details');
	}
}
