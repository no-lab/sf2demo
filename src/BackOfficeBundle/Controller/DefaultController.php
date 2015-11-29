<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontEndBundle\Entity\Invoice;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BackOfficeBundle:Default:index.html.twig');
    }

    public function invoiceListAction()
    {
        $invoices = $this->getDoctrine()
            ->getRepository('FrontEndBundle:Invoice')
            ->findAll();

        return $this->render('BackOfficeBundle:Default:invoice/list.html.twig',
            array('invoices' => $invoices));
    }

    public function invoiceViewAction($invoiceId)
    {
        $invoice = $this->getDoctrine()
            ->getRepository('FrontEndBundle:Invoice')
            ->find($invoiceId);

        if (!$invoice) {
            throw $this->createNotFoundException(
                'No invoice found for id ' . $invoiceId
            );
        }

        return $this->render('BackOfficeBundle:Default:invoice/view.html.twig',
            array('invoice' => $invoice));
    }
}
