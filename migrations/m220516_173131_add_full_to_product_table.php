<?php

use yii\db\Migration;

/**
 * Class m220516_173131_add_full_to_product_table
 */
class m220516_173131_add_full_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $default = "<p>
        Patients with the disease had a decreased adjusted HRQoL score of 4.7, reflecting a poorer. European guidelines recommend screening for patients with the disease<br>
        <br>
        The European guidelines state ‘’ diagnostics tests should be used for initial assessment of a patient with newly diagnosed disease in order to evaluate their suitability for particular therapies’.
        The limitations of current therapies.
    </p>";
        $this->addColumn('{{%product}}', 'full', $this->text()->null()->defaultValue($default));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'full');
    }
    
}
