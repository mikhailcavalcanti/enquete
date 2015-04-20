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

    /**
     *
     * @var int
     */
    public $id;

    /**
     *
     * @var string
     */
    public $resposta;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get resposta
     *
     * @return string 
     */
    public function getResposta()
    {
        return $this->resposta;
    }

    /**
     * Set resposta
     *
     * @param string $resposta
     * @return RespostaEntity
     */
    public function setResposta($resposta)
    {
        $this->resposta = $resposta;
        return $this;
    }

}
