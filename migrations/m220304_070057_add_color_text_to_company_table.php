<?php

use yii\db\Migration;

/**
 * Class m220304_070057_add_color_text_to_company_table
 */
class m220304_070057_add_color_text_to_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('company', 'color_text', $this->string(20)->defaultValue('#fff')->notNull()->comment('Text banner color'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('company', 'color_text');
    } 
}
