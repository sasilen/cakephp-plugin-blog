<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="card mb-3"">
    <h4 class="card-title"><?= h($post->name) ?></h4>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $post->has('user') ? $this->Html->link($post->user->id, ['controller' => 'Users', 'action' => 'view', $post->user->id]) : '' ?></td>
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
        <p class="card-text"><?=$this->Text->autoParagraph(h($post->summary)); ?></p>
    </div>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <p class="card-text"><?= $this->Text->autoParagraph(h($post->body)); ?></p>
    </div>
		 <div class="card-footer text-muted">

    2 days ago
  </div>
</div>
