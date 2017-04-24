<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Posts'), ['plugin'=>'blog','controller'=>'posts','action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['plugin'=>'users','controller' => 'users', 'action' => 'index']) ?></li>
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
            echo $this->Form->control('body');
            echo $this->Form->control('published');
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('auth');
            echo $this->Form->input('tags');

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
