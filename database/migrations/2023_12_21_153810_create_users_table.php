<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email_address', 100);
            $table->string('email', 150)->unique(); // Ensure email is unique
            $table->string('password', 100);
            $table->string('role')->default('user'); // Add a default role for users
//            update store in controller $data['role'] = $request->input('is_admin') ? 'admin' : 'user';
            $table->timestamps();
            $table->softDeletes();
        });

        // Add a demo user
        DB::table('users')->insert([
            'name' => 'Jafan',
            'email_address' => 'jafan2222@gmail.com',
            'email' => 'jafan2222@gmail.com',
            'password' => bcrypt('password123'), // Use bcrypt to hash the password
            'role'=> 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
