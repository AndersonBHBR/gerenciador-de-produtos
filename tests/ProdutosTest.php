<?php
use PHPUnit\Framework\TestCase;
use App\Models\Produtos;

class ProdutosTest extends TestCase {
    public function testListarProdutosComPaginacao() {
        $url = 'http://localhost/Gerenciador-de-Produtos/public/api/produtos?pagina=1&por_pagina=10';

        $response = file_get_contents($url);

        $this->assertJson($response); // Verifica se a resposta é um JSON válido
        $data = json_decode($response, true); // Decodifica o JSON para um array

        $this->assertArrayHasKey('status', $data); // Verifica se a resposta possui a chave 'status'
        $this->assertEquals('sucess', $data['status']); // Verifica se o status é 'sucess'

    }

    public function testCriarNovoProduto() {
        $url = 'http://localhost/Gerenciador-de-Produtos/public/api/produtos';

        $data = [
            'nome' => 'Novo Produto Teste',
            'descricao' => 'Descrição do novo produto de teste',
            'preco' => 30.99,
            'quantidade' => 50
        ];

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        $this->assertJson($result); // Verifica se a resposta é um JSON válido
        $responseData = json_decode($result, true); // Decodifica o JSON para um array

        $this->assertArrayHasKey('status', $responseData); // Verifica se a resposta possui a chave 'status'
        $this->assertEquals('sucess', $responseData['status']); // Verifica se o status é 'sucess'

    }

    public function testAtualizarProdutoExistente() {
        // Simulando a atualização de um produto existente
        $dados = [
            'id' => 1,
            'nome' => 'Produto 1 Atualizado',
            'descricao' => 'Nova descrição do Produto 1',
            'preco' => 15.99,
            'quantidade' => 150
        ];

        $response = Produtos::update($dados);
        $this->assertEquals('Produto atualizado com sucesso!', $response);
    }

    public function testExcluirProdutoExistente() {
        // Simulando a exclusão de um produto existente
        $id = 3;

        $response = Produtos::delete($id);
        $this->assertEquals('Produto excluído com sucesso!', $response);
    }
}
