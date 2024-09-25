<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{   
    private $authors;

    public function __construct(){
        $this->authors = [
            ['id'=>1, 'name'=>'Taha Hussain', 'nbrBooks'=>300, 'picture'=>'images/taha.jpg', 'email'=>"taha@gmail.com"],
            ['id'=>2, 'name'=>'Victor Hugo', 'nbrBooks'=>200, 'picture'=>'images/victor.jpg', 'email'=>"vh@gmail.com"],
        ];
    }

    #[Route("/library", name: "app_library", methods: ["GET"])]
    public function index(): Response {
        return $this->render('author/index.html.twig');
    }

    #[Route("/author/{name}", name: "app_author", methods: ["GET"], defaults: ["name" => "taha hussain"])]
    public function showAuthor($name): Response {
        return $this->render('author/show.html.twig', ['name' => $name]);
    }

    // Return list of authors
    #[Route("/list", name:"app_list", methods:["GET"])]
public function authorList()
{
    //$disableImages = true; // Change this value to control whether images are shown or hidden

    return $this->render('author/list.html.twig', [
        'authors' => $this->authors,
        //'disableImages' => $disableImages
    ]);
}


    #[Route("/showDetails", name: "app_showDetail", methods: ["GET"])]
    #[Route("/showDetails/{id}", name: "app_showDetail", methods: ["GET"])]
    public function showDetailsAction($id): Response {
        $author = null;
        foreach ($this->authors as $a) {
            if ($a['id'] == $id) {
                $author = $a;
                break;
            }
        }

        if (!$author) {
            throw $this->createNotFoundException('Author not found');
        }

        return $this->render('author/showDetails.html.twig', [
            'author' => $author
        ]);
    }
}
