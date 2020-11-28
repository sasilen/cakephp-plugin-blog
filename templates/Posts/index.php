<?php

use Cake\I18n\Date;
use Thumber\Utility\ThumbCreator;
use Cake\View\Helper\BreadcrumbsHelper;
/**
  * @var \App\View\AppView $this
  */
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">

<div style="position: absolute; margin-top:10px; right:0; margin-right:30px;">
    <?=$this->AuthLink->link('<i class="far fa-file"></i>',['plugin'=>'Sasilen/Blog','controller'=>'posts','action' => 'add'],['escape'=>false]);?>
</div>

<?php
$this->Breadcrumbs->setTemplates([
    'wrapper' => '<ol class="breadcrumb">{{content}}</ol>',
    'separator' => '<li{{attrs}}>{{separator}}</li>'
]);
$this->Breadcrumbs->add('Posts',['plugin'=>'Sasilen/Blog','controller' => 'posts', 'action' => 'index'],['class'=>'breadcrumb-item']);
$this->Breadcrumbs->add('index',null,['class'=>'breadcrumb-item active']);
$this->Breadcrumbs->add($this->AuthLink->link($this->Html->image('Blog.ic_note_add_black_24px.svg'),['plugin'=>'Sasilen/Blog','controller'=>'posts','action' => 'add'],['escape'=>false,'class'=>'float-right']));
foreach ($tags as $tag) :
	$this->Breadcrumbs->add($tag['label'],['plugin'=>'Sasilen/Blog','controller' => 'posts', 'action' => 'index','?' => ['tags'=> $tag['label'] ] ],['class'=>'badge badge-info ml-1 float-right']);
endforeach;
echo $this->Breadcrumbs->render(
    ['separator' => '/']
);
?>

    <div class="card-columns">
        <?php foreach ($posts as $post) : ?>
        <div class="card">
            <div class="card-header text-muted">
                <h5 class="card-title"><?= $this->Html->link(h($post->name),['plugin'=>'Sasilen/Blog','controller'=>'posts','action' => 'view',$post->id]); ?>
                <?=$this->AuthLink->link('<i class="far fa-edit"></i>',['plugin'=>'Sasilen/Blog','controller'=>'posts','action' => 'edit',$post->id],['escape'=>false,'class'=>'float-right']);?>
                <?=$this->AuthLink->postLink('<i class="far fa-trash-alt"></i>', ['plugin'=>'Sasilen/Blog','controller'=>'posts','action' => 'delete', $post->id], ['confirm' => __('Are you sure you want to delete # {0}?', $post->id),'escape'=>false,'class'=>'float-right']) ?>
            </div>
            <div class="card-body" style="margin:-3px;">
                    <?php if (!$post->online) : ?>
                     <span class="badge badge-warning">draft</span>
                    <?php endif; ?>
                <p class="card-text"><?= $post->body ?></p>
              <?php foreach ($post->medias as $media):
                echo $this->Html->link($this->Blog->display($post->id,$media->id),array('plugin'=>'Sasilen/Blog','controller'=>'posts','action' => 'view',$post->id),array('class'=>'swipebox','escape' => false));
                //					echo $this->Blog->display($media,'raw');
                ?>
              <?php endforeach; ?>
            </div> <!-- card-block -->
            <div class="card-footer">
                <?php
                    foreach ($post->tags as $tag) :
                        echo $this->Html->link('<span class="badge badge-info ml-1">'.$tag->label.'</span>',['plugin'=>'Sasilen/Blog','controller'=>'posts','action' => 'index','?' =>['tags'=>$tag->label]],['escape'=>false]);
                    endforeach; ?>
                <?php
                $time = new Date($post->created); 
                $date1 = new DateTime($tag->created);
                $date2 = new DateTime($post->created);
                $interval = $date1->diff($date2); 
                $age  = ($interval->y!=0) ? $interval->y."v " :"";
                $age .= ($interval->m!=0) ? $interval->m."kk ":"";
                $age .= ($interval->d!=0) ? $interval->d."pv"  :"";?>
                <small class="text-right"><?= $post->has('user') ? $this->Html->link($post->user->username, ['controller' => 'CakeDC/Users', 'action' => 'view', $post->user->id]) : '' ?><?=$age;?>  @ <?= $time->format('d-m-Y H:i:s'); ?> </small>
            </div>
        </div>
    <?php endforeach; ?>
    </div>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div></div>
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
