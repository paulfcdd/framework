<?php


namespace Controller;

use App\App;

class AppController extends App
{

    public function indexAction() {
        return $this->render('index.twig', [
            'foo' => 'bar'
        ]);
    }

    /**
     * @param int $id
     */
    public function testAction(int $id) {
        dump($id);
        die;
    }
}