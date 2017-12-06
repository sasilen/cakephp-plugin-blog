<?php
/* src/View/Helper/DisplayHelper.php */
namespace Blog\View\Helper;

use Cake\View\Helper;
use Thumber\Utility\ThumbCreator;

class BlogHelper extends Helper
{
    public $helpers = ['Html'];

    public function resize($media) {
      $ref = explode('.',$media->ref)[1];
      if (isset($media)) :                  
        if ((!file_exists('../../img/'.$ref.'/thumbs/'.basename($media->file)) ||
             !file_exists('../../img/'.$ref.'/swipebox/'.basename($media->file))) &&
              file_exists('../../img/'.$ref.'/'.basename($media->file))) :              
              $thumber = new ThumbCreator('../../../img/'.$ref.'/'.basename($media->file));
        $thumber->fit(100,100);
        $thumb = $thumber->save([ 'target'=>'../../../img/'.$ref.'/thumbs/'.basename($media->file),'format'=>'jpg' ]);
        $thumber = new ThumbCreator('../../../img/'.$ref.'/'.basename($media->file));
        $thumber->resize(1280,720);
        $thumb = $thumber->save([ 'target'=>'../../../img/'.$ref.'/swipebox/'.basename($media->file),'format'=>'jpg' ]);
        endif;
      endif;
    }
    
    public function display($object,$mode='thumbs',$nb=0)
    {
			if (isset($object['media'][$nb])) :
				$media = $object['media'][$nb];
			else : 
				$media = $object;
			endif;

      $this->resize($media);

			if ($mode=='raw') :
				return $this->Html->link($this->display($media,'thumbs'),
																 array('plugin'=>'Media','controller' => 'medias','action' => 'display',$media->id,'swipebox'),
																 array('escape' => false));
			endif;
         return $this->Html->image(
            array('plugin'=>'Media','controller' => 'medias','action' => 'display',$media->id,$mode),
            array('class'=>'pull-left img-thumbnail','escape'=>false)
          );
#          array('plugin'=>'Media','controller'=>'medias','action' => 'display',$media->id,$mode),
#          array('class'=>'swipebox','escape'=>false)
#        );


    }
    
    public function galleria($object)
    {    
      foreach(array_keys($object['media']) as $nb) :
        echo $this->display($object,'raw',$nb);
	    endforeach;
    }

    public function getAge($dob,$dod=false) {
			if (!$dod || $dod < $dob) $dod = date('Y-m-d');
      $diff = date_diff(date_create($dob), date_create($dod));
      return $diff->format('%yy, %mm, %dd');
    }
}
?>

