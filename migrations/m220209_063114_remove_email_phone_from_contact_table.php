<?php

use yii\db\Migration;

/**
 * Class m220209_063114_remove_email_phone_from_contact_table
 */
class m220209_063114_remove_email_phone_from_contact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('contact', 'phone');
        $this->dropColumn('contact', 'email');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('contact', 'phone', $this->string(20)->null()->comment('Phone'));
        $this->addColumn('contact', 'email', $this->string(200)->null()->comment('Email'));
    }    
}
