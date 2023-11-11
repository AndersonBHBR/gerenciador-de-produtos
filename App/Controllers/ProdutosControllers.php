<?php
    namespace App\Controllers;

    use App\Models\Produtos;

    class ProdutosControllers {
        public function get($id = null) {
            if ($id) {
                return Produtos::select($id);
            } else {
                $paginaAtual = $_GET['pagina'] ?? 1;
                $registrosPorPagina = $_GET['por_pagina'] ?? 5;

                $produtos = Produtos::selectAll();
                $totalRegistros = count($produtos);
                $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

                $paginaAtual = max($paginaAtual, 1); // Página mínima
                $paginaAtual = min($paginaAtual, $totalPaginas); // Página máxima

                $offset = ($paginaAtual - 1) * $registrosPorPagina;

                $produtosPaginados = array_slice($produtos, $offset, $registrosPorPagina);

                return [
                    'pagina_atual' => $paginaAtual,
                    'total_paginas' => $totalPaginas,
                    'total_registros' => $totalRegistros,
                    'registros_por_pagina' => $registrosPorPagina,
                    'registros' => $produtosPaginados,
                ];
            }
        }

        public function post() {
            $data = $_POST;
            return Produtos::insert($data);
        }

        public function update() {
            $data = $_POST;
            return Produtos::update($id, $data);
        }

        public function delete() {
            return Produtos::delete($id);
        }
    }