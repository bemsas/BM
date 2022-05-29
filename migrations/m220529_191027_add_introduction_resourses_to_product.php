<?php

use yii\db\Migration;
use app\models\Product;

/**
 * Class m220529_191027_add_introduction_resourses_to_product
 */
class m220529_191027_add_introduction_resourses_to_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->delete('page', ['name' => 'introduction']);

        $intro = "Patients with the disease had a decreased adjusted HRQoL score of 4.7, reflecting a poorer. European guidelines recommend screening for patients with the disease.<br>
            <br>
            The European guidelines state ‘’ diagnostics tests should be used for initial assessment of a patient with newly diagnosed disease in order to evaluate their suitability for particular therapies’.<br>
            <br>
            The limitations of current therapies<br>
            <br>
            Current therapies are associated with substantial toxicity, which contributes to morbidity and mortality<br>
            <br>
            Current therapies are associated with substantial toxicity, due to non-specific effects, causing adverse events.";
        $this->addColumn('{{%product}}', 'introduction', $this->text()->null()->defaultValue($intro));

        $resources = "<p><a href='https://google.com'>Example link1</a></p><p><a href='https://www.yahoo.com/'>Example link2</a></p>";
        $this->addColumn('{{%product}}', 'resources', $this->text()->null());
        $this->dropColumn('{{%product}}', 'add_link');
        Product::updateAll(['resources' => $resources]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'introduction');
        $this->dropColumn('{{%product}}', 'resources');
        $this->addColumn('{{%product}}', 'add_link', $this->string(200)->null()->comment('link to additional resource'));
        $this->insert('{{%page}}', [
            'name' => 'introduction',
            'content' => "Patients with the disease had a decreased adjusted HRQoL score of 4.7, reflecting a poorer. European guidelines recommend screening for patients with the disease.<br>
            <br>
            The European guidelines state ‘’ diagnostics tests should be used for initial assessment of a patient with newly diagnosed disease in order to evaluate their suitability for particular therapies’.<br>
            <br>
            The limitations of current therapies<br>
            <br>
            Current therapies are associated with substantial toxicity, which contributes to morbidity and mortality<br>
            <br>
            Current therapies are associated with substantial toxicity, due to non-specific effects, causing adverse events.",
        ]);
    }
}
