<?php

namespace FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FrontEndBundle\Entity\Invoice;
use FrontEndBundle\Form\Type\InvoiceType;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {

        return $this->render('FrontEndBundle:Default:index.html.twig');
    }

    public function addInvoiceAction(Request $request)
    {
        $invoice = new Invoice();
        $form = $this->createForm(new InvoiceType(), $invoice);

        $form->handleRequest($request);

        if ($form->isValid()) {
            // @todo: check email
            $em = $this->getDoctrine()->getManager();
            $invoice->setStatus(Invoice::STATUS_NOT_APPROVED);

            if (!$invoice->getId()) {
                $invoice->setCreatedTime(new \DateTime());
            }
            $invoice->setUpdatedTime(new \DateTime());

            $em->persist($invoice);
            $em->flush();
            // @todo: add flash message

            return $this->redirect($this->generateUrl('front_end_homepage'));
        }

        return $this->render('FrontEndBundle:Default:addInvoice.html.twig', array(
            'form' => $form->createView())
        );
    }

    public function findSellerAction(Request $request)
    {
        return new JsonResponse(array('items' => $this->searchFakeEmail()));
    }

    public function findDebtorAction(Request $request)
    {
        return new JsonResponse(array('items' => $this->searchFakeEmail()));
    }

    protected function searchFakeEmail()
    {
        return array(
            array('id' => 'alpha@test.com', 'text' => 'alpha@test.com'),
            array('id' => 'blue@test.com', 'text' => 'blue@test.com'),
            array('id' => 'charlie@test.com', 'text' => 'charlie@test.com'),
        );
    }
}
