<?php

use yii\db\Migration;

/**
 * Class m220209_051135_add_color_to_company_table
 */
class m220209_051135_add_color_to_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('company', 'color', $this->string(20)->null()->comment('Banner color'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('company', 'color');
    }    
}
