<?php
class RecipesController extends AppController
{
    public function view()
    {

        $info = array(
            "title_page" => "CakePHP demo by qhonline.info",
            "id" => 124,
        );
        $this->set("data",$info);
    }
}