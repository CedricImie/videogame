<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Videogame;
use AppBundle\Form\VideogameType;

/**
 * Videogame controller.
 *
 * @Route("/videogame")
 */
class VideogameController extends Controller
{
    /**
     * Lists all Videogame entities.
     *
     * @Route("/", name="videogame_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $videogames = $em->getRepository('AppBundle:Videogame')->findAll();

        return $this->render('videogame/index.html.twig', array(
            'videogames' => $videogames,
        ));
    }

    /**
     * Creates a new Videogame entity.
     *
     * @Route("/new", name="videogame_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $videogame = new Videogame();
        $form = $this->createForm('AppBundle\Form\VideogameType', $videogame);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($videogame);
            $em->flush();

            return $this->redirectToRoute('videogame_show', array('id' => $videogame->getId()));
        }

        return $this->render('videogame/new.html.twig', array(
            'videogame' => $videogame,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Videogame entity.
     *
     * @Route("/{id}", name="videogame_show")
     * @Method("GET")
     */
    public function showAction(Videogame $videogame)
    {
        $deleteForm = $this->createDeleteForm($videogame);

        return $this->render('videogame/show.html.twig', array(
            'videogame' => $videogame,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Videogame entity.
     *
     * @Route("/{id}/edit", name="videogame_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Videogame $videogame)
    {
        $deleteForm = $this->createDeleteForm($videogame);
        $editForm = $this->createForm('AppBundle\Form\VideogameType', $videogame);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($videogame);
            $em->flush();

            return $this->redirectToRoute('videogame_edit', array('id' => $videogame->getId()));
        }

        return $this->render('videogame/edit.html.twig', array(
            'videogame' => $videogame,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Videogame entity.
     *
     * @Route("/{id}", name="videogame_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Videogame $videogame)
    {
        $form = $this->createDeleteForm($videogame);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($videogame);
            $em->flush();
        }

        return $this->redirectToRoute('videogame_index');
    }

    /**
     * Creates a form to delete a Videogame entity.
     *
     * @param Videogame $videogame The Videogame entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Videogame $videogame)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('videogame_delete', array('id' => $videogame->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
