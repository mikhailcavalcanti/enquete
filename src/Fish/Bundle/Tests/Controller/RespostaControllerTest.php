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

    public static function setUpBeforeClass()
    {
        static::createClient();
        $entityManager = static::$kernel->getContainer()->get('doctrine')->getManager();
        $metadatas = $entityManager->getMetadataFactory()->getAllMetadata();
        if (!empty($metadatas)) {
            $tool = new \Doctrine\ORM\Tools\SchemaTool($entityManager);
            $tool->dropSchema($metadatas);
            $tool->createSchema($metadatas);
        }
    }

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

        $resposta4 = new RespostaEntity();
        $resposta4->setResposta('Laranja');

        return array(array($resposta1), array($resposta2), array($resposta3), array($resposta4));
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

        $client->request('GET', "/api/resposta/{$resposta->id}", array(), array(), array('HTTP_ACCEPT' => 'application/json'));

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        $conteudoFromDatabase = $client->getResponse()->getContent();
        $this->assertNotEmpty($conteudoFromDatabase);
        $respostaFromDatabase = json_decode($conteudoFromDatabase);
        $this->assertNotEmpty($respostaFromDatabase);
        $this->assertEquals(1, count($respostaFromDatabase));
        $this->assertEquals($resposta->id, $respostaFromDatabase->id);
        $this->assertEquals($resposta->resposta, $respostaFromDatabase->resposta);
    }

    /**
     * 
     */
    public function testCreateValidate()
    {
        $client = static::createClient();

        $client->request('POST', '/api/resposta', array('resposta' => ''), array(), array('HTTP_ACCEPT' => 'application/json'));
        $this->assertTrue($client->getResponse()->isClientError());
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $client->getResponse()->getStatusCode());
        $conteudo = $client->getResponse()->getContent();
        $this->assertNotEmpty($conteudo);
        $mensagem = json_decode($conteudo);
        $this->assertNotEmpty($mensagem);
        $this->assertEquals(1, count($mensagem));
        $this->assertEquals('Resposta não pode ser vazia', $mensagem->messages);
    }

    /**
     * 
     */
    public function testReadAll()
    {
        $client = static::createClient();

        $client->request('GET', '/api/resposta', array(), array(), array('HTTP_ACCEPT' => 'application/json'));
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $conteudo = $client->getResponse()->getContent();
        $this->assertNotEmpty($conteudo);
        $respostas = json_decode($conteudo);
        $this->assertNotEmpty($respostas);
        $this->assertEquals(4, count($respostas));
    }

    /**
     * 
     */
    public function testReadNotFound()
    {
        $client = static::createClient();
        $client->request('GET', '/api/resposta/1000000', array(), array(), array('HTTP_ACCEPT' => 'application/json'));
        $this->assertTrue($client->getResponse()->isNotFound());
    }

    /**
     * 
     */
    public function testUpdate()
    {
        $client = static::createClient();
        $client->request('PUT', '/api/resposta/1', array('resposta' => 'Preto'), array(), array('HTTP_ACCEPT' => 'application/json'));
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        $conteudo = $client->getResponse()->getContent();
        $this->assertNotEmpty($conteudo);
        $resposta = json_decode($conteudo);
        $this->assertNotEmpty($resposta);
        $this->assertEquals(1, count($resposta));
        $this->assertEquals(1, $resposta->id);
        $this->assertEquals('Preto', $resposta->resposta);
    }

    /**
     * 
     */
    public function testUpdateValidate()
    {
        $client = static::createClient();
        $client->request('PUT', '/api/resposta/1', array(), array(), array('HTTP_ACCEPT' => 'application/json'));
        $this->assertTrue($client->getResponse()->isClientError());
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $client->getResponse()->getStatusCode());
        $conteudo = $client->getResponse()->getContent();
        $this->assertNotEmpty($conteudo);
        $mensagem = json_decode($conteudo);
        $this->assertNotEmpty($mensagem);
        $this->assertEquals(1, count($mensagem));
        $this->assertEquals('Resposta não pode ser vazia', $mensagem->messages);
    }

    /**
     * 
     */
    public function testUpdateNotFound()
    {
        $client = static::createClient();
        $client->request('PUT', '/api/resposta/1000000', array('resposta' => 'Branco'), array(), array('HTTP_ACCEPT' => 'application/json'));
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
        $conteudo = $client->getResponse()->getContent();
        $this->assertNotEmpty($conteudo);
        $resposta = json_decode($conteudo);
        $this->assertNotEmpty($resposta);
        $this->assertEquals(1, count($resposta));
        $this->assertEquals('Branco', $resposta->resposta);
    }

    /**
     * 
     */
    public function testUpdateNotFoundValidate()
    {
        $client = static::createClient();
        $client->request('PUT', '/api/resposta/1000000', array(), array(), array('HTTP_ACCEPT' => 'application/json'));
        $this->assertTrue($client->getResponse()->isClientError());
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $client->getResponse()->getStatusCode());
        $conteudo = $client->getResponse()->getContent();
        $this->assertNotEmpty($conteudo);
        $mensagem = json_decode($conteudo);
        $this->assertNotEmpty($mensagem);
        $this->assertEquals(1, count($mensagem));
        $this->assertEquals('Resposta não pode ser vazia', $mensagem->messages);
    }

    /**
     * 
     */
    public function testDelete()
    {
        $client = static::createClient();
        $client->request('DELETE', '/api/resposta/4', array(), array(), array('HTTP_ACCEPT' => 'application/json'));
        $this->assertTrue($client->getResponse()->isEmpty());
    }

    /**
     * 
     */
    public function testDeleteNotFound()
    {
        $client = static::createClient();
        $client->request('DELETE', '/api/resposta/1000000', array(), array(), array('HTTP_ACCEPT' => 'application/json'));
        $this->assertTrue($client->getResponse()->isNotFound());
    }

}
