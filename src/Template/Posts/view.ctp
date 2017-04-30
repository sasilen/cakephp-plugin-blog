<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Post'), ['plugin'=>'Blog','controller'=>'posts','action' => 'edit', $post->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Post'), ['action' => 'delete', $post->id], ['confirm' => __('Are you sure you want to delete # {0}?', $post->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Posts'), ['plugin'=>'Blog','controller'=>'posts','action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post'), ['plugin'=>'Blog','controller'=>'posts','action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['plugin'=>'CakeDC/Users','controller' => 'Users', 'action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="posts view large-9 medium-8 columns content">
    <h3><?= h($post->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($post->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $post->has('user') ? $this->Html->link($post->user->id, ['controller' => 'Users', 'action' => 'view', $post->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($post->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($post->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($post->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Online') ?></th>
            <td><?= $post->online ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Auth') ?></th>
            <td><?= $post->auth ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Tags') ?></th>
            <td>
              <?php foreach ($post->tags as $tag): ?>
                <?= h($tag->label) ?>
              <?php endforeach; ?>
            </td>
        </tr>
        <tr>
          <th><?= __('Media') ?></th>
          <td>
            <?php foreach ($post->media as $media): 
            echo $this->Html->link(
              $this->Html->image(
                array('plugin'=>'Media','controller' => 'medias','action' => 'display',$media->id),
                array('height'=>'95','width'=>'95','class'=>'pull-left thumbnail')),
                array('plugin'=>'Media','controller'=>'medias','action' => 'display',$media->id),
                array('escape'=>false,'data-dialog')); ?>
            <?php endforeach; ?>
          </td>
        </tr>

    </table>
    <div class="row">
        <h4><?= __('Summary') ?></h4>
        <?= $this->Text->autoParagraph(h($post->summary)); ?>
    </div>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($post->body)); ?>
    </div>
</div>
