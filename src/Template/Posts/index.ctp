<?php

use Cake\I18n\Date;
use Thumber\Utility\ThumbCreator;
use Cake\View\Helper\BreadcrumbsHelper;
/**
  * @var \App\View\AppView $this
  */
?>
<?= $this->Html->css('Blog.timeline',['block' => 'css']);?>
<?= $this->Html->css('Blog.lightbox',['block' => 'css']); ?>
<?= $this->Html->script('Blog.lightbox',['block' => 'scriptTop']); ?>

<div class="posts index large-12 medium-10 columns content">

<?php
$this->Breadcrumbs->templates([
    'wrapper' => '<ol class="breadcrumb">{{content}}</ol>',
    'separator' => '<li{{attrs}}>{{separator}}</li>'
]);
$this->Breadcrumbs->add('Posts',['plugin'=>'Blog','controller' => 'posts', 'action' => 'index'],['class'=>'breadcrumb-item']);
$this->Breadcrumbs->add('index',null,['class'=>'breadcrumb-item active']);
foreach ($tags as $tag) :
	$this->Breadcrumbs->add($tag['label'],['plugin'=>'Blog','controller' => 'posts', 'action' => 'index','tags'=>[ $tag['label'] ] ],['class'=>'badge badge-warning ml-1 float-right']);
endforeach;
echo $this->Breadcrumbs->render(
    ['separator' => '/']
);
?>

    <ul class="timeline">
    <?php $i=0; ?>
      <?php foreach ($posts as $post): $i++;?> 
      <?=($i % 2 == 0) ? '<li class="timeline-inverted">' : '<li>'; ?>
        <div class="timeline-badge">
          <a><i class="fa fa-circle" id=""></i></a>
        </div>
        <div class="timeline-panel">
          <div class="timeline-heading card-header">
            <h5 style="margin-bottom:0px"> <?= $this->Html->link(h($post->name),['plugin'=>'blog','controller'=>'posts','action' => 'view',$post->id]); ?> 
                <span style="float:right;padding:0">
                 <?= $this->AuthLink->link($this->Html->image('Blog.ic_mode_edit_black_24px.svg'),['plugin'=>'blog','controller'=>'posts','action' => 'edit',$post->id],['escape'=>false]);?>
								 <?php if ($this->AuthLink->isAuthorized(['plugin'=>'blog','controller'=>'posts','action' => 'delete',$post->id])) : ?>	
	                 <?= $this->Form->postLink($this->Html->image('ic_delete_forever_black_24px.svg'), ['action' => 'delete', $post->id], ['confirm' => __('Are you sure you want to delete # {0}?', $post->id),'escape'=>false]) ?>
								<?php endif; ?>
                </span></h5>
          </div>
          <div class="timeline-body panel-body" style="padding:0px 15px 15px 15px">
            <?= $post->body ?>
            <div>
              <?php foreach ($post->media as $media):
//            		echo $this->Html->link($this->Blog->display($media),array('plugin'=>'Blog','controller'=>'posts','action' => 'view',$post->id),array('class'=>'swipebox','escape' => false));
								echo $this->Blog->display($media,'raw');
							?>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="timeline-footer card-footer">
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
                <p class="text-right"><?= $post->has('user') ? $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]) : '' ?><?=$age;?>  @ <?= $time->format('d-m-Y H:i:s'); ?> </p>
						<div style="clear:both"/>
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
<script>
	$(function(){
		var $gallery = $('.gallery a').simpleLightbox();
		$gallery.on('show.simplelightbox', function(){
			console.log('Requested for showing');
		})
		.on('shown.simplelightbox', function(){
			console.log('Shown');
		})
		.on('close.simplelightbox', function(){
			console.log('Requested for closing');
		})
		.on('closed.simplelightbox', function(){
			console.log('Closed');
		})
		.on('change.simplelightbox', function(){
			console.log('Requested for change');
		})
		.on('next.simplelightbox', function(){
			console.log('Requested for next');
		})
		.on('prev.simplelightbox', function(){
			console.log('Requested for prev');
		})
		.on('nextImageLoaded.simplelightbox', function(){
			console.log('Next image loaded');
		})
		.on('prevImageLoaded.simplelightbox', function(){
			console.log('Prev image loaded');
		})
		.on('changed.simplelightbox', function(){
			console.log('Image changed');
		})
		.on('nextDone.simplelightbox', function(){
			console.log('Image changed to next');
		})
		.on('prevDone.simplelightbox', function(){
			console.log('Image changed to prev');
		})
		.on('error.simplelightbox', function(e){
			console.log('No image found, go to the next/prev');
			console.log(e);
		});
	});
</script>
