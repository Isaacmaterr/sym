<?php

namespace APP\EmpresaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produtos
 *
 * @ORM\Table(name="produtos")
 * @ORM\Entity(repositoryClass="APP\EmpresaBundle\Repository\ProdutosRepository")
 */
class Produtos
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
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="decimal", precision=10, scale=2)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255)
     */
    private $descricao;

    /**
     * @var int
     *
     * @ORM\Column(name="quantidade", type="integer")
     */
    private $quantidade;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_cadastro", type="datetime")
     */
    private $dataCadastro;
    
     /**
     * @ORM\ManyToOne(targetEntity="Empresar", inversedBy="produtos")
     * @ORM\JoinColumn(name="empresar_produto_id", referencedColumnName="id",nullable=false)
     */
    
    private $empresar;
    
     /**
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="produtos")
     * @ORM\JoinColumn(name="categoria_produto_id", referencedColumnName="id",nullable=false)
     */
    
    private $categoria;
    function getEmpresar() {
        return $this->empresar;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function setEmpresar($empresar) {
        $this->empresar = $empresar;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
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
     * Set nome
     *
     * @param string $nome
     *
     * @return Produtos
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return Produtos
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
     * Set descricao
     *
     * @param string $descricao
     *
     * @return Produtos
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set quantidade
     *
     * @param integer $quantidade
     *
     * @return Produtos
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    /**
     * Get quantidade
     *
     * @return int
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Produtos
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set dataCadastro
     *
     * @param \DateTime $dataCadastro
     *
     * @return Produtos
     */
    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;

        return $this;
    }

    /**
     * Get dataCadastro
     *
     * @return \DateTime
     */
    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }
}

