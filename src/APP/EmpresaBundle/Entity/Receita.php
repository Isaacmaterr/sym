<?php

namespace APP\EmpresaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Receita
 *
 * @ORM\Table(name="receita")
 * @ORM\Entity(repositoryClass="APP\EmpresaBundle\Repository\ReceitaRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Receita {

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
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var int
     *
     * @ORM\Column(name="tipo", type="integer")
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_total", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $valorTotal;

    /**
     * @var int
     *
     * @ORM\Column(name="qtd_parcela", type="integer")
     */
    private $qtdParcela;

    /**
     * @ORM\ManyToOne(targetEntity="Empresar", inversedBy="receitas")
     * @ORM\JoinColumn(name="empresa_receita_id", referencedColumnName="id",nullable=false)
     */
    private $empresa;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status = 1;

    /**
     * @ORM\ManyToOne(targetEntity="Clientes", inversedBy="receitas")
     * @ORM\JoinColumn(name="cliente_receita_id", referencedColumnName="id")
     */
    private $cliente;
    
    /**
     * @ORM\OneToMany(targetEntity="Parcelas", mappedBy="receita")
     */
    private $parcelas;
    
      /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_cadastro", type="datetime")
     */
    private $dataCadastro;
    
       /** @ORM\PrePersist */
    public function preCadastro() {
        $this->dataCadastro = new \DateTime("now");
    }
    
    function getCliente() {
        return $this->cliente;
    }

    function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    
    
    /**
     * @ORM\ManyToOne(targetEntity="Servicos", inversedBy="receitas")
     * @ORM\JoinColumn(name="servico_receita_id", referencedColumnName="id",nullable=false)
     */
    private $servico;

    
    
    function getServico() {
        return $this->servico;
    }

    function setServico($servico) {
        $this->servico = $servico;
    }

    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
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
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Receita
     */
    public function setTitulo($titulo) {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo() {
        return $this->titulo;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     *
     * @return Receita
     */
    public function setTipo($tipo) {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return int
     */
    public function getTipo() {
        return $this->tipo;
    }

    /**
     * Set valorTotal
     *
     * @param string $valorTotal
     *
     * @return Receita
     */
    public function setValorTotal($valorTotal) {
        $this->valorTotal = $valorTotal;

        return $this;
    }

    /**
     * Get valorTotal
     *
     * @return string
     */
    public function getValorTotal() {
        return $this->valorTotal;
    }

    /**
     * Set qtdParcela
     *
     * @param integer $qtdParcela
     *
     * @return Receita
     */
    public function setQtdParcela($qtdParcela) {
        $this->qtdParcela = $qtdParcela;

        return $this;
    }

    /**
     * Get qtdParcela
     *
     * @return int
     */
    public function getQtdParcela() {
        return $this->qtdParcela;
    }
 
}
