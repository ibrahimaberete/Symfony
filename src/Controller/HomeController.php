<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController {

   /**
    * @Route("/hello/{prenom}/age/{age}",name="hello")
    * @Route("/hello", name= "hello_base")
    * @Route ("/hello/{prenom}", name="hello_prenom")
    * montre la page qui dit bonjour
    *
    * @return void
    */
    public function hello($prenom = "ananyme", $age = 0){
        return $this->render(
            'hello.html.twig',

            [
                'prenom' => $prenom,
                'age' => $age
            ]
        );
    }

    /**
     * @Route("/",name="homepage")
     */
    public function home(){
        $prenoms = ["sambou" => 22 ,"thierno" => 19,"ibra"=> 19];
        return  $this->render(
            'Home.html.twig',
            [
                'title' =>"Bonjour à tous",
                'age' => 15,
                'tableau' => $prenoms

                
                
                ]
        );
    }

}



?>