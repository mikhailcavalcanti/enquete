<?php
/**
 * 
 */
namespace Fish\Bundle\Entity;
/**
 * 
 */
class PerguntaEntity
{
	public $id;
	public $pergunta;
	public $respostas = array();

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setPergunta($pergunta)
	{
		$this->pergunta = $pergunta;
	}

	public function setRespostas(array $respostas)
	{
		$this->respostas = $respostas;
	}
}
