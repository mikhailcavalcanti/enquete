<?php

namespace Fish\Bundle\Tests\Controller;

use Fish\Bundle\Entity\RespostaEntity;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Mikhail Cavalcanti <mikhailcavalcanti@gmail.com>
 */
class RespostaControllerTest extends WebTestCase
{

    /**
     * 
     */
    public function respostaProvider()
    {
        $resposta1 = new RespostaEntity();
        $resposta1->setResposta('Azul');

        $resposta2 = new RespostaEntity();
        $resposta2->setResposta('Vermelho');

        $resposta3 = new RespostaEntity();
        $resposta3->setResposta('Amarelo');

        return array(array($resposta1), array($resposta2), array($resposta3));
    }

    /**
     * @dataProvider respostaProvider
     */
    public function testCreate(RespostaEntity $respostaEntity)
    {
        $client = static::createClient();

        $client->request('POST', '/api/resposta', array('resposta' => $respostaEntity->getResposta()), array(), array('HTTP_ACCEPT' => 'application/json'));

        // Assert that the response status code is 2xx
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
        $conteudo = $client->getResponse()->getContent();
        $this->assertNotEmpty($conteudo);
        $resposta = json_decode($conteudo);
        $this->assertNotEmpty($resposta);
        $this->assertEquals(1, count($resposta));

        $this->assertEquals($respostaEntity->getResposta(), $resposta->resposta);
    }

}
