<?php
use Migrations\AbstractMigration;

class Initial extends AbstractMigration
{
    public function up()
    {

        $this->table('blog_posts')
            ->addColumn('slug', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('summary', 'text', [
                'default' => null,
                'limit' => 16777215,
                'null' => false,
            ])
            ->addColumn('body', 'text', [
                'default' => null,
                'limit' => 16777215,
                'null' => false,
            ])
            ->addColumn('published', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('user_id', 'string', [
                'default' => null,
                'limit' => 36,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('auth', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('tag_count', 'integer', [
                'default' => null,
                'limit' => 5,
                'null' => true,
            ])
            ->addIndex(
                [
                    'name',
                ]
            )
            ->create();
    }

    public function down()
    {
        $this->dropTable('blog_posts');
    }

}
