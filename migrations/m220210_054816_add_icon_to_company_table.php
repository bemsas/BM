<?php

use yii\db\Migration;

/**
 * Class m220210_054816_add_icon_to_company_table
 */
class m220210_054816_add_icon_to_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%company}}', 'icon', $this->string(2000)->null()->comment('Icon url'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%company}}', 'icon');
    }
    
}
