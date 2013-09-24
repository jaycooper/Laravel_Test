<?php

use Illuminate\Database\Migrations\Migration;

class CreateMessages extends Migration {

	/**
		 * Run the migrations.
		 *
		 * @return void
	 */
		public function up()
		{
			Schema::create('messages', function($table) {
				$table->increments('message_id');
				$table->string('sender_id');
				$table->string('recipient_id');
				$table->text('text');
				$table->timestamps();
			});
			//
		}
	
		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
			Schema::drop('messages');
		}
	
	}