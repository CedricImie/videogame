<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Trader;
use AppBundle\Form\TraderType;

/**
 * Trader controller.
 *
 * @Route("/trader")
 */
class TraderController extends Controller
{
    /**
     * Lists all Trader entities.
     *
     * @Route("/", name="trader_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $traders = $em->getRepository('AppBundle:Trader')->findAll();

        return $this->render('trader/index.html.twig', array(
            'traders' => $traders,
        ));
    }

    /**
     * Creates a new Trader entity.
     *
     * @Route("/new", name="trader_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $trader = new Trader();
        $form = $this->createForm('AppBundle\Form\TraderType', $trader);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($trader);
            $em->flush();

            return $this->redirectToRoute('trader_show', array('id' => $trader->getId()));
        }

        return $this->render('trader/new.html.twig', array(
            'trader' => $trader,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Trader entity.
     *
     * @Route("/{id}", name="trader_show")
     * @Method("GET")
     */
    public function showAction(Trader $trader)
    {
        $deleteForm = $this->createDeleteForm($trader);

        return $this->render('trader/show.html.twig', array(
            'trader' => $trader,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Trader entity.
     *
     * @Route("/{id}/edit", name="trader_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Trader $trader)
    {
        $deleteForm = $this->createDeleteForm($trader);
        $editForm = $this->createForm('AppBundle\Form\TraderType', $trader);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($trader);
            $em->flush();

            return $this->redirectToRoute('trader_edit', array('id' => $trader->getId()));
        }

        return $this->render('trader/edit.html.twig', array(
            'trader' => $trader,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Trader entity.
     *
     * @Route("/{id}", name="trader_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Trader $trader)
    {
        $form = $this->createDeleteForm($trader);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($trader);
            $em->flush();
        }

        return $this->redirectToRoute('trader_index');
    }

    /**
     * Creates a form to delete a Trader entity.
     *
     * @param Trader $trader The Trader entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Trader $trader)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('trader_delete', array('id' => $trader->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
