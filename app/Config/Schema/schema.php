<?php
App::uses('Post', 'Model');
class AppSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {

        if (isset($event['create'])) {
            switch ($event['create']) {
                case 'posts':
                    App::uses('ClassRegistry', 'Utility');
                    $post = ClassRegistry::init('Post');
                    $post->create();

                        $post->save(
                            array('Post' => array(
                                'title' => 'The title 1',
                                "body" => "This is the post body.",
                                "created" => date("Y-m-d H:i:s"),
                            ))
                        );

                    break;
            }
        }
	}

    var $posts = array(
        'id'=> array('type' => 'integer','null' => false,'length' => 10, 'key' => 'primary'),
        'title'=>array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'key' => 'unique'),
        'body'=> array('type' => 'text'),
        'created'=>array('type'=>'datetime','null'=>false,'default'=>NULL),

    );


}
