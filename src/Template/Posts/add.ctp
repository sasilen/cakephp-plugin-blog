<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Posts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="posts form large-9 medium-8 columns content">
    <?= $this->Form->create($post) ?>
    <fieldset>
        <legend><?= __('Add Post') ?></legend>
        <?php
            echo $this->Form->control('slug');
            echo $this->Form->control('name');
            echo $this->Form->control('summary');
            echo $this->Form->control('parent_id');
            echo $this->Form->control('body');
            echo $this->Form->control('published');
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('startdate', ['empty' => true]);
            echo $this->Form->control('enddate', ['empty' => true]);
            echo $this->Form->control('link');
            echo $this->Form->control('auth');
            echo $this->Form->control('darken');
            echo $this->Form->input('tags');

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
