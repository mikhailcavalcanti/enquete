<?php

namespace Fish\Bundle\Controller;

use Doctrine\ORM\NoResultException;
use InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api")
 */
class EnqueteController extends Controller
{

    /**
     * @Route("/enquete")
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        try {
            $enquete = $this->get('enquete_model')->buildEntity($request->request->all());
            $this->get('enquete_model')->create($enquete);
            return new Response($this->get('jms_serializer')->serialize($enquete, 'json'), Response::HTTP_CREATED, array('content-type' => 'application/json'));
        } catch (InvalidArgumentException $exception) {
            return new JsonResponse(array('messages' => $exception->getMessage()), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @Route("/enquete/{id}", defaults={"id" = null})
     * @Method({"GET"})
     * @param int $id
     * @return Response|JsonResponse
     */
    public function readAction($id = null)
    {
        try {
            return new Response($this->get('jms_serializer')->serialize($this->get('enquete_model')->read($id), 'json'), Response::HTTP_OK, array('content-type' => 'application/json'));
        } catch (NoResultException $exception) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Route("/enquete/{id}")
     * @Method({"PUT"})
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function updateAction(Request $request, $id)
    {
        try {
            $enquete = $this->get('enquete_model')->buildEntity($request->request->all());
            $enqueteUpdated = $this->get('enquete_model')->update($id, $enquete);

            return new Response($this->get('jms_serializer')->serialize($enqueteUpdated, 'json'), Response::HTTP_OK, array('content-type' => 'application/json'));
        } catch (InvalidArgumentException $exception) {
            return new JsonResponse(array('messages' => $exception->getMessage()), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @Route("/enquete/{id}")
     * @Method({"DELETE"})
     * @param int $id
     * @return \Fish\Bundle\Controller\JsonResponse
     */
    public function deleteAction($id)
    {
        try {
            $this->get('enquete_model')->delete($id);
            return new JsonResponse('', Response::HTTP_NO_CONTENT);
        } catch (NoResultException $exception) {
            return new JsonResponse(array('messages' => $exception->getMessage()), Response::HTTP_NOT_FOUND);
        }
    }

}
