<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Platform;
use AppBundle\Form\PlatformType;

/**
 * Platform controller.
 *
 * @Route("/platform")
 */
class PlatformController extends Controller
{
    /**
     * Lists all Platform entities.
     *
     * @Route("/", name="platform_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $platforms = $em->getRepository('AppBundle:Platform')->findAll();

        return $this->render('platform/index.html.twig', array(
            'platforms' => $platforms,
        ));
    }

    /**
     * Creates a new Platform entity.
     *
     * @Route("/new", name="platform_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $platform = new Platform();
        $form = $this->createForm('AppBundle\Form\PlatformType', $platform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($platform);
            $em->flush();

            return $this->redirectToRoute('platform_show', array('id' => $platform->getId()));
        }

        return $this->render('platform/new.html.twig', array(
            'platform' => $platform,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Platform entity.
     *
     * @Route("/{id}", name="platform_show")
     * @Method("GET")
     */
    public function showAction(Platform $platform)
    {
        $deleteForm = $this->createDeleteForm($platform);

        return $this->render('platform/show.html.twig', array(
            'platform' => $platform,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Platform entity.
     *
     * @Route("/{id}/edit", name="platform_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Platform $platform)
    {
        $deleteForm = $this->createDeleteForm($platform);
        $editForm = $this->createForm('AppBundle\Form\PlatformType', $platform);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($platform);
            $em->flush();

            return $this->redirectToRoute('platform_edit', array('id' => $platform->getId()));
        }

        return $this->render('platform/edit.html.twig', array(
            'platform' => $platform,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Platform entity.
     *
     * @Route("/{id}", name="platform_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Platform $platform)
    {
        $form = $this->createDeleteForm($platform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($platform);
            $em->flush();
        }

        return $this->redirectToRoute('platform_index');
    }

    /**
     * Creates a form to delete a Platform entity.
     *
     * @param Platform $platform The Platform entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Platform $platform)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('platform_delete', array('id' => $platform->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
