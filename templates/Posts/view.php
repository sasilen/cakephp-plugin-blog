<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="container"i>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title"><?= h($post->name) ?><span style="float:right">
            <?=$post->online ? '<span class="badge badge-success">Online</span>':'<span class="badge badge-danger">Online</span>'; ?>
            <?=$post->auth ? '<span class="badge badge-success">Auth</span>':'<span class="badge badge-danger">Auth</span>'; ?></span></h5>
        </div>
        <div class="card-body">
            <?php foreach ($post->medias as $media):
                echo $this->Html->link($this->Blog->display($post->id,$media->id),array('plugin'=>'Sasilen/Blog','controller'=>'posts','action' => 'view',$post->id),array('class'=>'swipebox','escape' => false));


            endforeach; ?>

            <p class="card-text"><?= $this->Text->autoParagraph(h($post->body)); ?></p>
        </div>
        <div class="card-footer text-muted">
           <?= $post->has('user') ? $this->Html->link($post->user->id, ['controller' => 'Users', 'action' => 'view', $post->user->id])." @ " : '';?>
           <?=h($post->created) ?>
           <?= $post->modified ? '<small>('.$post->modified.')</small>' : ''; ?>
           <span style="float:right">
               <?php foreach ($post->tags as $tag): ?>
                   <span class="badge badge-dark"><?=($tag->label);?></span>
               <?php endforeach; ?>
           </span>
        </div>
    </div>
</div>
