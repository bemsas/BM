<?php

use yii\db\Migration;

/**
 * Class m220130_154608_add_size_to_map_table
 */
class m220130_154608_add_size_to_map_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('map', 'size', $this->smallInteger()->defaultValue(4)->notNull()->comment('Size'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('map', 'size');
    }
    
}
