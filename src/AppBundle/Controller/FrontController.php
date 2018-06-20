<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class FrontController extends Controller
{
    public function indexAction()
    {
        return $this->render('@App/front/fabhotels.html.twig');
    }

    public function searchAction(Request $request)
    {
        $keywords = trim(preg_replace('/[,]+/', '|', str_replace(' ', ',', $request->query->get('keywords'))), '|');
        $properties = $this->getDoctrine()
            ->getRepository('AppBundle:Property')
            ->searchPropertyByText($keywords);
        return new JsonResponse([
            'keywords' => $keywords,
            'data' => $properties
        ]);
    }
}
