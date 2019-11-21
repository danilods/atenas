<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;

class CRUDController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */

    public function indexAction(Request $request)
    {
		
        // replace this example code with whatever you need
        return $this->render('number.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }
	
	public function listAction(Request $request)
    {
		
        // replace this example code with whatever you need
        return $this->render('number.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }
	
	
	 /**
     * @Route("/pdf", name="homepage")
     */
	public function pdfAction()
    {
         $number = mt_rand(0, 100);

       
		
		 $html = $this->renderView('number.html.twig', array(
            'number'  => $number
        ));

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            'file.pdf'
        );
    }
	
	
}


