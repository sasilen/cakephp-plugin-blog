<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $post
 */
?>
<div class="container">
    <div class="column-responsive column-80">
        <div class="posts form content">
            <?= $this->Form->create($post,['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Add Post') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('summary');
                    echo $this->Form->control('body');
                    echo $this->Form->control('online');
                    echo $this->Form->control('user_id');
                    echo $this->Form->control('auth');
                    echo $this->Form->input('medias.name[]', ['type' => 'file','multiple' => true, 'label' => 'Files to upload']);
//                    echo $this->Form->input('filename[]', ['type' => 'file', 'multiple' => true, 'label' => 'Files to upload']);
//                    echo $this->Form->hidden('medias.0.ref',['value'=>'Blog.Posts']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
