<?php

App::uses('CakeEvent','Event');

class Post extends AppModel
{


    public $actsAs = array(
        'Sluggable.Sluggable' => array(
            'field'     => 'title',  // Field that will be slugged
            'slug'      => 'slug',  // Field that will be used for the slug
            'separator' => '-',     //
            'overwrite' => true    // Does the slug is auto generated when field is saved no matter what
        )
    );


    public $validate    = array(

                                'title'=>array('rule'=>'notEmpty'),
                                'body'=>array('rule'=>'notEmpty'),

                            );

    public function isOwnedBy($post, $user)
    {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
    }



}