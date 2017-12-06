<?php

use Cake\I18n\Date;
use Thumber\Utility\ThumbCreator;
/**
  * @var \App\View\AppView $this
  */
?>
<?= $this->Html->css('Blog.timeline',['block' => 'css']);?>
<?= $this->Html->css('Blog.swipebox.min',['block' => 'css']); ?>
<?= $this->Html->script('Blog.jquery.swipebox.min',['block' => 'script']); ?>
<!--<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Post'), ['plugin'=>'blog','controller'=>'posts','action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['plugin'=>'CakeDC/Users','controller' => 'users', 'action' => 'index']) ?></li>
    </ul>
</nav>
-->

<div class="posts index large-12 medium-10 columns content">
    <h3><?= __('Posts') ?></h3>

    <ul class="timeline">
    <?php $i=0; ?>
      <?php foreach ($posts as $post): $i++;?> 
      <?=($i % 2 == 0) ? '<li class="timeline-inverted">' : '<li>'; ?>
        <div class="timeline-badge">
          <a><i class="fa fa-circle" id=""></i></a>
        </div>
        <div class="timeline-panel">
          <div class="timeline-heading">
            <h4 style="margin-bottom:0px"> <?= $this->Html->link(h($post->name),['plugin'=>'blog','controller'=>'posts','action' => 'view',$post->id]); ?> 
                <span style="float:right;padding:0">
                 <?= $this->Html->link($this->Html->image('Blog.ic_mode_edit_black_24px.svg'),['plugin'=>'blog','controller'=>'posts','action' => 'edit',$post->id],['escape'=>false]);?>
                 <?= $this->Form->postLink($this->Html->image('ic_delete_forever_black_24px.svg'), ['action' => 'delete', $post->id], ['confirm' => __('Are you sure you want to delete # {0}?', $post->id),'escape'=>false]) ?>
                </span></h4>
          </div>
          <div class="timeline-body panel-body" style="padding:0px 15px 15px 15px">
            <?= $post->body ?>
            <div>
              <?php foreach ($post->media as $media):
                if (!file_exists('../../img/thumbs/Posts/'.basename($media->file)) || !file_exists('../../img/swipebox/Posts/'.basename($media->file))) :
                    $thumber = new ThumbCreator('../../../img/Posts/'.basename($media->file));
                    $thumber->fit(100,100);
                    $thumb = $thumber->save([ 'target'=>'../../../img/thumbs/Posts/'.basename($media->file),'format'=>'jpg' ]);
                    $thumber = new ThumbCreator('../../../img/Posts/'.basename($media->file));
                    $thumber->resize(1280,720);
                    $thumb = $thumber->save([ 'target'=>'../../../img/swipebox/Posts/'.basename($media->file),'format'=>'jpg' ]);
                endif;
                echo $this->Html->link(
                $this->Html->image(
                  array('plugin'=>'Media','controller' => 'medias','action' => 'display',$media->id),
                  array('class'=>'pull-left img-thumbnail')),
                  array('plugin'=>'Media','controller'=>'medias','action' => 'display',$media->id,'swipebox'),
                  array('class'=>'swipebox','escape'=>false));?>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="timeline-footer panel-footer">
            <div style="float:left">
              <?php 
                  foreach ($post->tags as $tag): 
                      echo $this->Html->link('<span class="badge badge-default">'.$tag->label.'</span>',['plugin'=>'blog','controller'=>'posts','action' => 'index','tags'=>[$tag->label]],['escape'=>false]);
                   endforeach; ?>
              <?php 
                $time = new Date($post->created);
                $date1 = new DateTime($tag->created);
                $date2 = new DateTime($post->created);
                $interval = $date1->diff($date2);
                $age  = ($interval->y!=0) ? $interval->y."v " :"";
                $age .= ($interval->m!=0) ? $interval->m."kk ":"";
                $age .= ($interval->d!=0) ? $interval->d."pv"  :"";?>
            </div><div style="float:right">
                <p class="text-right"><?= $post->has('user') ? $this->Html->link($post->user->id, ['controller' => 'Users', 'action' => 'view', $post->user->id]) : '' ?><?=$age;?>  @ <?= $time->format('d-m-Y H:i:s'); ?> </p>
            </div>
          </div>
        </div>
      </li>
    <?php endforeach; ?>
    </ul>
    </div>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
<script type="text/javascript">
;( function( $ ) {

        $( '.swipebox' ).swipebox();

} )( jQuery );
</script>
