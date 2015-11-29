<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use FrontEndBundle\Entity\Invoice;
use BackOfficeBundle\Utils\EmailPlanner;

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

    public function invoiceChangeStatusAction($invoiceId)
    {
        $invoice = $this->getDoctrine()
            ->getRepository('FrontEndBundle:Invoice')
            ->find($invoiceId);

        if (!$invoice) {
            throw $this->createNotFoundException(
                'No invoice found for id ' . $invoiceId
            );
        }

        if ($invoice->getStatus() == Invoice::STATUS_NOT_APPROVED) {
            $invoice->setStatus(Invoice::STATUS_APPROVED);
        } else {
            $invoice->setStatus(Invoice::STATUS_NOT_APPROVED);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($invoice);
        $em->flush();

        return $this->redirect($this->generateUrl('back_office_invoice_view',
            array('invoiceId' => $invoice->getId()))
            );
    }

    public function simulateSendingDateAction()
    {
        $timestamp = $this->get('request')->request->get('timestamp');
        $startDate = new \DateTime();
        $startDate->setTimestamp($timestamp);

        $emailPlanner = new EmailPlanner($startDate);
        $sendDate = $emailPlanner->findAvailableTime();

        return new JsonResponse(array('data' => $sendDate));
    }
}
