<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends AbstractController
{
    public function number(): Response
    {
        $name1 = "Maxime";
        $name2 = "Hugo";
        return $this->render('number.html.twig', [
            'name'=>$name1, 'name2'=>$name2, 'page'=>"Motoblouz",
        ]);
    }
}