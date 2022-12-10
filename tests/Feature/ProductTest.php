<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/*
Product recebe os seguintes valores:
String name
Float price
 */


class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Lista todos os registros de cidades paginadas
     *
     * @return void
     */
    public function test_list_all_products()
    {
        $response = $this->get('/api/products');

        //Retorna um json vazio ou com dados de todos os produtos
        $response->assertStatus(200);
    }

    /**
     * Testa o registro de um novo produto
     *  
     * @return void
     */
    public function test_create_product()
    {

        $response = $this->postJson('/api/products', [
            'name' => 'Producto Test',
            'price' => 22.9
        ]);

        /*Se tudo ocorrer bem uma menssage de sucesso
         é retornada junto com um json contendo os dados registrados.*/
        $response->assertStatus(200)->assertJsonFragment([
            'message' => 'Produto cadastrado com sucesso.'
        ]);
    }

    public function test_show_product()
    {
        //Criando registro de um novo produto
        $product = Product::create([
            'name' => 'Producto Test',
            'price' => 22.9
        ]);

        $response = $this->get("/api/products/{$product->id}");

        //Se tudo ocorrer bem um json contendo os dados do produto especificado é retornado.
        $response->assertStatus(200)->assertJsonFragment([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price
        ]);
    }

    /**
     * Testa o erro restornado caso não exista o parametro id na tabela products.
     *
     * @return void
     */
    public function test_error_product_not_exists_in_show_product()
    {
        $response = $this->get("/api/products/1");

        //Se o id não existir na tabela products uma mensagem de erro é retornada.
        $response->assertStatus(404)->assertJsonFragment([
            "message" => "Nenhum produto encontrado."
        ]);
    }

    /**
     * Deleta um produto
     *
     * @return void
     */
    public function test_delete_product()
    {
        //Criando registro de um novo produto
        $product = Product::create([
            'name' => 'Producto Test',
            'price' => 22.9
        ]);

        $response = $this->deleteJson("/api/products/{$product->id}");

        //Caso id exista na tabela products uma menssagem de sucesso é retornada
        $response->assertStatus(200)->assertJsonFragment([
            "message" => "Produto deletado com sucesso."
        ]);
    }

    /**
     * Testa o erro retornado caso não exista o parametro id na tabela products
     *
     * @return void
     */
    public function test_error_product_not_exists_in_delete_product()
    {
        $response = $this->deleteJson("/api/products/1");

        //Caso id exista na tabela products uma menssagem de sucesso é retornada
        $response->assertStatus(404)->assertJsonFragment([
            "message" => "Nenhum produto encontrado."
        ]);
    }

    /**
     * Atualiza o produto
     *
     * @return void
     */
    public function test_update_product()
    {

        //Criando registro de um novo produto
        $product = Product::create([
            'name' => 'Producto Test',
            'price' => 22.9
        ]);

        $response = $this->putJson("/api/products/{$product->id}", [
            'name' => 'Producto Updated',
            'price' => 10.22
        ]);

        /*Caso tudo ocorra bem uma menssage de sucesso é retornada
         junto com um json contendo os dados atualizados*/
        $response->assertStatus(200)->assertJsonFragment([
            'message' => 'Produto atualizado com sucesso.',
            'id' => $product->id,
            'name' => 'Producto Updated',
            'price' => 10.22
        ]);
    }

    /**
     * Testa o erro retornado caso não exista o parametro id na tabela products
     *
     * @return void
     */
    public function test_product_not_exist_in_update_product()
    {

        $response = $this->putJson("/api/products/1", [
            'name' => 'Producto Updated',
            'price' => 10.22
        ]);

        //Se o id não existir na tabela products uma mensagem de produto não econtrad0 é retornado.
        $response->assertStatus(404)->assertJsonFragment([
            "message" => "Nenhum produto encontrado."
        ]);
    }
}
