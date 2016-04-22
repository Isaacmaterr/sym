<?php

namespace APP\EmpresaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parcelas
 *
 * @ORM\Table(name="parcelas")
 * @ORM\Entity(repositoryClass="APP\EmpresaBundle\Repository\ParcelasRepository")
 */
class Parcelas
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="numero", type="integer", nullable=true)
     */
    private $numero;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $valor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vencimento", type="datetime")
     */
    private $vencimento;


    
    
    /**
     * @ORM\ManyToOne(targetEntity="Empresar", inversedBy="parcelas")
     * @ORM\JoinColumn(name="empresa_parcelas_id", referencedColumnName="id",nullable=false)
     */
    private $empresa;
    
    
    function getEmpresa()
    {
        return $this->empresa;
    }

    function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    }

        
    
    
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     *
     * @return Parcelas
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Parcelas
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return Parcelas
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set vencimento
     *
     * @param \DateTime $vencimento
     *
     * @return Parcelas
     */
    public function setVencimento($vencimento)
    {
        $this->vencimento = $vencimento;

        return $this;
    }

    /**
     * Get vencimento
     *
     * @return \DateTime
     */
    public function getVencimento()
    {
        return $this->vencimento;
    }
}

