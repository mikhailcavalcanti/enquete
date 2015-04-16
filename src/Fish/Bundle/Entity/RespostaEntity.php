<?php
/**
 * 
 */
namespace Fish\Bundle\Entity;
/**
 * 
 */
class RespostaEntity
{
	public $id;
	public $resposta;

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setResposta($resposta)
	{
		$this->resposta = $resposta;
	}
}
