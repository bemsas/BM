<?php

use yii\db\Migration;

/**
 * Class m220208_043640_add_color_to_cell_table
 */
class m220208_043640_add_color_to_cell_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('cell', 'color', $this->string(20)->null()->comment('Cell color'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('cell', 'color');
    }    
}
