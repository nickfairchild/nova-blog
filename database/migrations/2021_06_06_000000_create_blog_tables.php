<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateBlogTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('nova-blog.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/nova-blog.php not loaded. Run [php artisan config:clear] and try again.');
        }

        Schema::create($tableNames['posts'], function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->longText('content')->nullable();
            $table->json('data')->nullable();
            $table->string('featured_image')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->unique(['slug']);
        });

        Schema::create($tableNames['categories'], function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();

            $table->unique(['slug']);
        });

        Schema::create($tableNames['model_has_categories'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedBigInteger('category_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->index(['model_id', 'model_type'], 'model_has_categories_model_id_model_type_index');

            $table->foreign('category_id')
                ->references('id')
                ->on($tableNames['categories']);

            $table->primary(['category_id', 'model_id', 'model_type'],
                'model_has_categories_category_model_type_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('nova-blog.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/nova-blog.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        Schema::dropIfExists($tableNames['posts']);
        Schema::dropIfExists($tableNames['categories']);
        Schema::dropIfExists($tableNames['model_has_categories']);
    }
}
