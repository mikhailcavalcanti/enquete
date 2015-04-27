<?php

namespace Fish\Bundle\Controller;

use Fish\Bundle\Entity\EnqueteEntity;
use Fish\Bundle\Entity\PerguntaEntity;
use Fish\Bundle\Entity\RespostaEntity;
use InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
            /* @var $enquete EnqueteEntity */
            $enquete = $this->get('enquete_entity');
            $enquete->setTitulo($request->request->get('titulo'));
            foreach ($request->request->get('perguntas', array()) as $perguntaRequest) {
                $enquete->addPergunta($this->get('pergunta_model')->read($perguntaRequest['id']));
            }
            $this->get('enquete_model')->create($enquete);
            return new Response($this->get('jms_serializer')->serialize($enquete, 'json'), Response::HTTP_CREATED, array('content-type' => 'application/json'));
        } catch (InvalidArgumentException $exception) {
            return new JsonResponse(array('messages' => $exception->getMessage()), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @Route("/enquete/{id}")
     * @Method({"GET"})
     * @param EnqueteEntity $enquete
     * @return Response
     */
    public function findAction(EnqueteEntity $enquete = null)
    {
        $stauts = empty($enquete) ? Response::HTTP_NOT_FOUND : Response::HTTP_OK;
        return new Response($this->get('jms_serializer')->serialize($enquete, 'json'), $stauts, array('content-type' => 'application/json'));
    }

    /**
     * @Route("/enquete/.{_format}")
     * @Template()
     */
    public function readAction(Request $request, $_format)
    {
        #
        {
            $resposta1 = new RespostaEntity();
            $resposta1->setId(1);
            $resposta1->setResposta('Resposta 01');
            $resposta2 = new RespostaEntity();
            $resposta2->setId(2);
            $resposta2->setResposta('Resposta 02');
            #
            $pergunta1 = new PerguntaEntity();
            $pergunta1->setId(1);
            $pergunta1->setPergunta('Porque usar PHP?');
            $pergunta1->setRespostas(array($resposta1, $resposta2));
            $pergunta2 = new PerguntaEntity();
            $pergunta2->setId(2);
            $pergunta2->setPergunta('Porque nao usar PHP?');
            $pergunta2->setRespostas(array($resposta1, $resposta2));
            #
            $enquete1 = new EnqueteEntity();
            $enquete1->setId(1);
            $enquete1->setTitulo('Enquete 01');
            $enquete1->setPerguntas(array($pergunta1, $pergunta2));
        }
        #
        {
            #
            $pergunta3 = new PerguntaEntity();
            $pergunta3->setId(3);
            $pergunta3->setPergunta('Porque usar?');
            $pergunta3->setRespostas(array($resposta1, $resposta2));
            #
            $enquete2 = new EnqueteEntity();
            $enquete2->setId(2);
            $enquete2->setTitulo('Enquete 02');
            $enquete2->setPerguntas(array($pergunta3));
        }
        #
        $enquetes = array($enquete1, $enquete2);
        $request->query->set('enquetes', $enquetes);
    }

}
