<?php

namespace Fish\Bundle\Controller;

use Fish\Bundle\Entity\RespostaEntity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api")
 */
class RespostaController extends Controller
{

//
    /**
     * @Route("/resposta")
     * @Method({"POST"})
     */
    public function create(Request $request)
    {
        /* @var $resposta RespostaEntity */
        $resposta = $this->get('resposta_entity');
        $resposta->setResposta($request->request->get('resposta'));
        $this->get('resposta_model')->create($resposta);
        return new Response($this->get('jms_serializer')->serialize($resposta, 'json'), Response::HTTP_OK, array('content-type' => 'application/json'));
    }

    /**
     * @Route("/resposta/{id}", defaults={"id" = null})
     * @Method({"GET"})
     */
    public function readAction(RespostaEntity $resposta)
    {
        return new Response($this->get('jms_serializer')->serialize($resposta, 'json'), Response::HTTP_OK, array('content-type' => 'application/json'));
    }

    /**
     * @Route("/resposta/{id}")
     * @Method({"PUT"})
     */
    public function updateAction(Request $request, $id)
    {
        /* @var $entity RespostaEntity */
        $resposta = $this->get('resposta_entity');
        $resposta->setResposta($request->request->get('resposta'));
        $respostaUpdated = $this->get('resposta_model')->update($id, $resposta);
        return new Response($this->get('jms_serializer')->serialize($respostaUpdated, 'json'), Response::HTTP_OK, array('content-type' => 'application/json'));
    }

    /**
     * @Route("/resposta/{id}")
     * @Method({"DELETE"})
     */
    public function deleteAction($id)
    {
        $this->get('resposta_model')->delete($id);
        return new JsonResponse('', Response::HTTP_NO_CONTENT);
    }

}
