<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    const HELPDESK = 'helpdesk';

    public function up()
    {
        Schema::create(self::HELPDESK . '_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(self::HELPDESK . '_clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(self::HELPDESK . '_projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(self::HELPDESK . '_priorities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(self::HELPDESK . '_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(self::HELPDESK . '_ticket', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->string('ticket_no')->index();
            $table->longText('description');
            $table->longText('content')->nullable();
            $table->longText('html')->nullable();
            $table
                ->foreignId('ticket_status_id')
                ->on(self::HELPDESK . '_statuses')
                ->onDelete('cascade');
            $table
                ->foreignId('priority_id')
                ->on(self::HELPDESK . '_priorities')
                ->onDelete('cascade');
            $table
                ->foreignId('client_id')
                ->on(self::HELPDESK . '_clients')
                ->onDelete('cascade');
            $table
                ->foreignId('project_id')
                ->on(self::HELPDESK . '_projects')
                ->onDelete('cascade');

            $table
                ->foreignId('created_by')
                ->on('users')
                ->onDelete('cascade');
            $table
                ->foreignId('category_id')
                ->on(self::HELPDESK . '_categories')
                ->onDelete('cascade');

            $table->tinyInteger('status')->default(1);
            $table->dateTime('due_date')->nullable();
            $table->dateTime('reopened_at')->nullable();
            $table->dateTime('closed_at')->nullable();
            $table->dateTime('last_activity')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(self::HELPDESK . '_activities', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('ticket_id')
                ->on(self::HELPDESK . '_ticket')
                ->onDelete('cascade');

            $table
                ->foreignId('user_id')
                ->on('users')
                ->onDelete('cascade');

            $table->string('activity')->nullable();
            $table->longText('description');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(self::HELPDESK . '_attachments', function (Blueprint $table) {
            $table->id();

            $table
                ->foreignId('ticket_id')
                ->on(self::HELPDESK . '_ticket')
                ->onDelete('cascade');
            $table
                ->foreignId('user_id')
                ->on('users')
                ->onDelete('cascade');
            $table->string('file')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(self::HELPDESK . '_comments', function (Blueprint $table) {
            $table->id();
            $table->longText('content');

            $table
                ->foreignId('ticket_id')
                ->on(self::HELPDESK . '_ticket')
                ->onDelete('cascade');
            $table
                ->foreignId('user_id')
                ->on('users')
                ->onDelete('cascade');
            $table->longText('html')->nullable();
            $table->integer('reply_to')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(self::HELPDESK . '_assigns', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('ticket_id')
                ->on(self::HELPDESK . '_ticket')
                ->onDelete('cascade');
            $table
                ->foreignId('user_id')
                ->on('users')
                ->onDelete('cascade');
            $table->tinyInteger('status')->default(1);
            $table
                ->foreignId('created_by')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(self::HELPDESK . '_settings', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('user_id')
                ->on('users')
                ->onDelete('cascade');
            $table->string('meta_key');
            $table->string('meta_value');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::HELPDESK . '_statuses');
        Schema::dropIfExists(self::HELPDESK . '_clients');
        Schema::dropIfExists(self::HELPDESK . '_projects');
        Schema::dropIfExists(self::HELPDESK . '_priorities');
        Schema::dropIfExists(self::HELPDESK . '_categories');
        Schema::dropIfExists(self::HELPDESK . '_ticket');
        Schema::dropIfExists(self::HELPDESK . '_activities');
        Schema::dropIfExists(self::HELPDESK . '_attachments');
        Schema::dropIfExists(self::HELPDESK . '_comments');
        Schema::dropIfExists(self::HELPDESK . '_assigns');
        Schema::dropIfExists(self::HELPDESK . '_settings');
    }
};
