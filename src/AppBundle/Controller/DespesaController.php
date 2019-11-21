<?php

namespace AppBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;

class DespesaController extends Controller
{
    public function listAction()
    {



        //... use any methods or services to get statistics data
       // $statisticsData = ...

       return $this->render('movimentacao.html.twig');
    }
}


