<style type="text/css" style="display: none">
.navbar-custom {
    background-color: #eceeef;
}
</style>
 

   <nav class="navbar navbar-expand-md navbar-custom bg-dark fixed-top navbar-toggleable-sm">
			<?=$this->Html->link('Laukkoski.com', ['plugin'=>false, 'controller' => 'Pages', 'action' => 'display'],['class'=>'navbar-brand']);?>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=__('Blog');?></a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <?=$this->Html->link(__('Nea'), array('plugin'=>'Blog','controller'=>'posts','action' => 'index'),array('class'=>'dropdown-item'));?>
              <?=$this->Html->link(__('Tia'), array('plugin'=>'Blog','controller'=>'users','action' => 'index'),array('class'=>'dropdown-item'));?>
            </div>
          </li>



	      </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
