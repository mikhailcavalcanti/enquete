<?php

namespace Fish\Bundle\Controller;

use Doctrine\ORM\NoResultException;
use Fish\Bundle\Entity\PerguntaEntity;
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
class PerguntaController extends Controller
{

    /**
     * @Route("/pergunta")
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        /* @var $pergunta PerguntaEntity */
        $pergunta = $this->get('pergunta_entity');
        $pergunta->setPergunta($request->request->get('pergunta'));
        if ($request->request->get('respostas')) {
            foreach ($request->request->get('respostas') as $respostaRequest) {
                $pergunta->addResposta($this->get('resposta_model')->read($respostaRequest['id']));
            }
        }
        $this->get('pergunta_model')->create($pergunta);
        return new Response($this->get('jms_serializer')->serialize($pergunta, 'json'), Response::HTTP_OK, array('content-type' => 'application/json'));
    }

    /**
     * @Route("/pergunta/{id}")
     * @Method({"GET"})
     */
    public function readAction(PerguntaEntity $pergunta = null)
    {
        $stauts = empty($pergunta) ? Response::HTTP_NOT_FOUND : Response::HTTP_OK;
        return new Response($this->get('jms_serializer')->serialize($pergunta, 'json'), $stauts, array('content-type' => 'application/json'));
    }

    /**
     * @Route("/pergunta/{id}")
     * @Method({"PUT"})
     * @param Request $request
     * @param type $id
     * @return Response
     */
    public function updateAction(Request $request, $id)
    {
        try {
            /* @var $pergunta PerguntaEntity */
            $pergunta = $this->get('pergunta_entity');
            $pergunta->setPergunta($request->request->get('pergunta'));
            foreach ($request->request->get('respostas') as $respostaRequest) {
                $pergunta->addResposta($this->get('resposta_model')->read($respostaRequest['id']));
            }
            $perguntaUpdated = $this->get('pergunta_model')->update($id, $pergunta);

            return new Response($this->get('jms_serializer')->serialize($perguntaUpdated, 'json'), Response::HTTP_OK, array('content-type' => 'application/json'));
        } catch (InvalidArgumentException $exception) {
            return new JsonResponse(array('messages' => $exception->getMessage()), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @Route("/pergunta/{id}")
     * @Method({"DELETE"})
     * @param int $id
     * @return \Fish\Bundle\Controller\JsonResponse
     */
    public function deleteAction($id)
    {
        try {
            $this->get('pergunta_model')->delete($id);
            return new JsonResponse('', Response::HTTP_NO_CONTENT);
        } catch (NoResultException $exception) {
            return new JsonResponse(array('messages' => $exception->getMessage()), Response::HTTP_NOT_FOUND);
        }
    }

}
