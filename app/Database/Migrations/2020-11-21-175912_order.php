<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'order_id'				=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'auto_increment' 	=> TRUE
			],
			'user_id'       		=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
			],		
			'order_status'			=>[
				'type'           	=> 'ENUM',
				'constraint'     	=> ['PENDING', 'CANCEL', 'PROCESS', 'SENDING', 'SUCCESS'],
				'default'        	=> 'PENDING',
			],
			'order_description' 	=> [
				'type'           	=> 'TEXT',
				'null'           	=> TRUE,
			],
			'order_destination'     => [
				'type'           	=> 'TEXT',
				'null'           	=> TRUE,
			],
			'order_total' 				=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
			],
			'order_notif'					=> [
				'type'           	=> 'ENUM',
				'constraint'     	=> ['NEW', 'NOTNEW'],
				'default'        	=> 'NEW',
			],
			'order_token'			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '100',
				'NULL'				=> TRUE
			],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
		]);
		$this->forge->addKey('order_id', TRUE);
		$this->forge->createTable('orders');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
