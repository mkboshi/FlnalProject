<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Catalog;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ListController extends AbstractController
{


    /**
     * @Route("/list", name="app_list")
     */
    public function index(): Response
    {
        $request = Request::createFromGlobals();
        $catalog = $request->query->get('catalog');
        $book = $request->query->get('book');

        if ($catalog!=''){
            $book = $this->getDoctrine()->getRepository(Catalog::class)->
            findOneBy(['id' => $catalog])->getBookId();
            return $this->render('list/show.html.twig', ['book'=>$book]);
        }
        else{
            $book = $this->getDoctrine()->getRepository(Book::class)->findAll();
            $catalog = $this->getDoctrine()->getRepository(Catalog::class)->findAll();
            return $this->render('list/index.html.twig', ['book'=>$book,
                'catalog'=>$catalog]);
        }
    }
}