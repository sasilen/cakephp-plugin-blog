<?php

use Cake\View\Helper\BreadcrumbsHelper;

/**
  * @var \App\View\AppView $this
  */
?>

<div class="container">

<?php
$this->Breadcrumbs->templates([
    'wrapper' => '<ol class="breadcrumb">{{content}}</ol>',
		'separator' => '<li{{attrs}}>{{separator}}</li>'
]);
$this->Breadcrumbs->add('Posts',['plugin'=>'Blog','controller' => 'posts', 'action' => 'index'],['class'=>'breadcrumb-item']);
$this->Breadcrumbs->add('Edit',null,['class'=>'breadcrumb-item active']);
echo $this->Breadcrumbs->render(
    ['separator' => '/']
);
?>
<div class="row">
<div class="form-group col-sm-12">
    <?= $this->Form->create($post,['class'=>'form-horizontal']) ?>
    <fieldset>
        <?php
            echo $this->Form->control('name',['label' => ['class' => 'col-sm-2 control-label', 'text' => __('Name')]]);
            echo $this->Form->control('summary',['cols'=>'70','label' => ['class' => 'col-sm-2 control-label', 'text' => __('Summary')]]);
            echo $this->Form->control('body',['cols'=>'70','label' => ['class' => 'col-sm-2 control-label', 'text' => __('Body')]]);
            echo $this->Form->control('user_id', ['default'=>$post['user_id'],'options' => $users,'label' => ['class' => 'col-sm-2 control-label', 'text' => __('Online')]]);
						echo $this->Form->control('online', [
              'label' => ['text' => __('Online'),'class' => 'col-sm-2 control-label'],
              'type' => 'select',
              'multiple' => false,
              'default' => 1,
              'options' => [1 => __('Yes',true), 0 => __('No',true)],
              'empty' => false
            ]);
						echo $this->Form->control('auth', [
              'label' => ['text' => __('Auth'),'class' => 'col-sm-2 control-label'],
              'type' => 'select',
              'multiple' => false,
              'default' => 1,
              'options' => [1 => __('Yes',true), 0 => __('No',true)],
              'empty' => false
            ]);
            echo $this->Form->control('created',['label' => ['class' => 'col-sm-2 control-label', 'text' => __('Created')]]);

            echo $this->Form->input('tags',['label' => ['class' => 'col-sm-2 control-label', 'text' => __('Tags')]]);
            echo $this->Media->iframe('Blog.Posts',$post->id);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
