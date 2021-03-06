<?php

declare(strict_types=1);

use Arcanesoft\Blog\Base\Migration;
use Arcanesoft\Blog\Blog;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class     CreateBlogPostsTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @see  \Arcanesoft\Blog\Models\Post
 */
class CreateBlogPostsTable extends Migration
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make a migration instance.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setTable(Blog::table('posts', 'posts', false));
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->createSchema(function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->unsignedBigInteger('author_id');
            $table->string('locale', 5)->default(app()->getLocale());
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->text('body');
            $table->string('thumbnail')->nullable();
            $table->string('thumbnail_caption');
            $table->text('meta')->nullable();
            $table->timestamps();
            $table->timestamp('published_at')->nullable();

            $table->index(['uuid', 'author_id']);
        });
    }
}
