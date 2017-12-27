<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Table\Column;

class Users extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        // IDの自動生成を抑制
        $table = $this->table('users', [
            'id'          => false,
            'primary_key' => 'id'
        ]);

        // IDを手動で定義
        $table
            ->addColumn('id', 'integer', [
                'identity' => true,
                'signed'   => false
            ])
            ->addColumn('first_name', 'string', ['limit' => 255])
            ->addColumn('last_name', 'string', ['limit' => 255])
            ->create();
    }
}
