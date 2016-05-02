<?php

namespace APP\EmpresaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Servicos
 *
 * @ORM\Table(name="servicos")
 * @ORM\Entity(repositoryClass="APP\EmpresaBundle\Repository\ServicosRepository")
 */
class Servicos {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255)
     */
    private $descricao;

    /**
     * @ORM\ManyToOne(targetEntity="Empresar", inversedBy="servicos")
     * @ORM\JoinColumn(name="empresar_servico_id", referencedColumnName="id",nullable=false)
     */
    private $empresar;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Receita", mappedBy="servico")
     */
    private $receitas;
    
    function getReceitas() {
        return $this->receitas;
    }

    function setReceitas($receitas) {
        $this->receitas = $receitas;
    }

        
    
    
    function getEmpresar() {
        return $this->empresar;
    }

    function setEmpresar($empresar) {
        $this->empresar = $empresar;
    }

    
    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Servicos
     */
    public function setNome($nome) {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     *
     * @return Servicos
     */
    public function setDescricao($descricao) {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string
     */
    public function getDescricao() {
        return $this->descricao;
    }

    public function __toString() {
        return $this->nome;
    }
}
