<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CurrenciesMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('currency_rate');
        $table->addColumn('table_name', 'string', ['limit' => 10])
            ->addColumn('effective_date', 'date')
            ->addColumn('currency', 'string', ['limit' => 100])
            ->addColumn('code', 'string', ['limit' => 10])
            ->addColumn('rate', 'decimal', ['precision' => 10, 'scale' => 2])
            ->create();

        $table = $this->table('converted_currencies');
        $table->addColumn('initial_value', 'integer', ['limit' => 10])
            ->addColumn('source_currencies', 'string', ['limit' => 10])
            ->addColumn('rate_kurs', 'string', ['limit' => 10])
            ->addColumn('converted_amount', 'decimal', ['precision' => 10, 'scale' => 2])
            ->create();
    }
}
