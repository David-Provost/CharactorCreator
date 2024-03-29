<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Habilete $habilete
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Habiletes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="habiletes form large-9 medium-8 columns content">
    <?= $this->Form->create($habilete) ?>
    <fieldset>
        <legend><?= __('Add Habilete') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('Description');
            echo $this->Form->control('ShortDesc');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
