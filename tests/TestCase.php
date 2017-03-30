<?php

namespace Naoray\Larablog\Test;

use Carbon\Carbon;
use Naoray\Larablog\Contracts\Post;
use Illuminated\Testing\TestingTools;
use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    use TestingTools;

    /** @var \Naoray\Larablog\Test\User */
    protected $testUser;

    /** @var \Naoray\Larablog\Models\Post */
    protected $testPost;
    
    public function setUp()
    {
        parent::setUp();

        $this->setUpDatabase($this->app);

        $this->testUser = User::first();
        $this->testPost = app(Post::class)->first();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Naoray\Larablog\LarablogServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * Set up the database.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function setUpDatabase($app)
    {
        $app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
        });

        include_once __DIR__.'/../database/migrations/create_posts_table.php.stub';

        (new \CreatePostsTable())->up();

        $user = User::create(['email' => 'test@user.com']);

        $app[Post::class]->create([
            'author_id' => $user->id,
            'slug' => 'test-slug',
            'title' => 'published test',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam voluptas placeat pariatur, blanditiis molestiae natus eligendi vitae, libero ipsam alias numquam, ducimus aut. Fugit expedita recusandae veniam, quis autem cum!',
            'is_published' => true,
            'published_at' => Carbon::now()->previous(Carbon::WEDNESDAY),
        ]);
    }
}
