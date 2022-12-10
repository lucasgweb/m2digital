<?php

namespace Tests\Feature;

use App\Models\Campaign;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


/*
Discount recebe os seguintes valores:
String title
Float value
Foreing|int|nullable campaign_id
Foreing|int|nullable product_id_id

Product recebe os seguintes valores:
String name, 
Float Price

Campaign recebe os seguintes valores:
String name,
String uf,
Foreing|int|nullable group_id

Totas as foreign keys são verificadas pelo laravel, em caso de não existir o id informado uma json de erro é retornado.
 */

class DiscountsTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Lista todos os registros de descontos paginadas
     *
     * @return void
     */
    public function test_list_all_discounts()
    {
        $response = $this->get('/api/discounts');
        $response->assertStatus(200);
    }

    /**
     * Testa o regristro de um novo desconto
     *  
     * @return void
     */
    public function test_create_discount()
    {

        //Criando registro de um novo produto
        $product = Product::create([
            'name' => 'Produto Test',
            'price' => 12.33
        ]);

        //Criando registro de uma nova campanha sem nenhum grupo definido em group_id
        $campaign = Campaign::create([
            'name' => 'Campaign Test'
        ]);

        $response = $this->postJson('/api/discounts', [
            'title' => 'Black Friday Test',
            'value' => 30.0,
            'product_id' => $product->id,
            'campaign_id' => $campaign->id
        ]);

        //Se tudo ocorrer bem uma menssage de sucesso é retornada junto com um json contendo os dados registrados.
        $response->assertStatus(200)->assertJsonFragment([
            'message' => 'Desconto cadastrado com sucesso.'
        ]);
    }

    /**
     * Lista apenas um desconto especifico
     *
     * @return void
     */
    public function test_show_discount()
    {

        //Criando registro de um novo produto
        $product = Product::create([
            'name' => 'Produto Test',
            'price' => 12.33
        ]);

        //Criando registro de uma nova campanha sem nenhum grupo definido em group_id
        $campaign = Campaign::create([
            'name' => 'Campaign Test'
        ]);

        //Criando registro de um novo desconto
        $discount = Discount::create([
            'title' => 'Black Friday Test',
            'value' => 30.0,
            'product_id' => $product->id,
            'campaign_id' => $campaign->id
        ]);

        $response = $this->get("/api/discounts/{$discount->id}");

        //Se tudo ocorrer bem um json contendo os dados do desconto especificado é retornado.
        $response->assertStatus(200)->assertJsonFragment([
            'id' => $discount->id,
            'title' => $discount->title,
            'value' => $discount->value
        ]);
    }

    /**
     * Testa o erro restornado caso não exista o parametro id na tabela discunts.
     *
     * @return void
     */
    public function test_error_discount_not_exists_in_show_discount()
    {

        $response = $this->get("/api/discounts/1");

        //Se o id não existir na tabela discounts uma mensagem de erro é retornada.
        $response->assertStatus(404)->assertJsonFragment([
            "message" => "Nenhum desconto encontrado."
        ]);
    }


    /**
     * Deleta um desconto
     *
     * @return void
     */
    public function test_delete_discount()
    {

        //Criando registro de um novo produto
        $product = Product::create([
            'name' => 'Produto Test',
            'price' => 12.33
        ]);

        //Criando registro de uma nova campanha sem nenhum grupo definido em group_id
        $campaign = Campaign::create([
            'name' => 'Campaign Test'
        ]);

        //Criando registro de um novo desconto
        $discount = Discount::create([
            'title' => 'Black Friday Test',
            'value' => 30.0,
            'product_id' => $product->id,
            'campaign_id' => $campaign->id
        ]);

        //Caso id exista na tabela discounts uma menssagem de sucesso é retornada
        $response = $this->deleteJson("/api/discounts/{$discount->id}");
        $response->assertStatus(200)->assertJsonFragment([
            "message" => "Desconto deletado com sucesso."
        ]);
    }

    /**
     * Testa o erro retornado caso não exista o parametro id na tabela discounts
     *
     * @return void
     */
    public function test_error_discount_not_exists_in_delete_discount()
    {
        //Caso id exista na tabela discounts uma menssagem de sucesso é retornada
        $response = $this->deleteJson("/api/discounts/1");
        $response->assertStatus(404)->assertJsonFragment([
            "message" => "Nenhum desconto encontrado."
        ]);
    }

    /**
     * Atualiza o desconto
     *
     * @return void
     */
    public function test_update_discount()
    {

        //Criando registro de um novo produto
        $product = Product::create([
            'name' => 'Produto Test',
            'price' => 12.33
        ]);

        //Criando registro de uma nova campanha sem nenhum grupo definido em group_id
        $campaign = Campaign::create([
            'name' => 'Campaign Test'
        ]);

        //Criando registro de um novo desconto
        $discount = Discount::create([
            'title' => 'Black Friday Test',
            'value' => 30.0,
            'product_id' => $product->id,
            'campaign_id' => $campaign->id
        ]);

        $response = $this->putJson("/api/discounts/{$discount->id}", [
            'title' => 'Black Friday Test Updated',
            'value' => 123
        ]);

        /*Caso tudo ocorra bem uma menssage de sucesso é retornada
         junto com um json contendo os dados atualizados*/
        $response->assertStatus(200)->assertJsonFragment([
            'message' => "Desconto atualizado com sucesso.",
            'title' => 'Black Friday Test Updated',
            'value' => 123
        ]);
    }

    /**
     * Testa o erro retornado caso não exista o parametro id na tabela discounts
     *
     * @return void
     */
    public function test_discount_not_exists_in_update_discount()
    {

        $response = $this->putJson("/api/discounts/1", [
            'title' => 'Black Friday Test Updated',
            'value' => 123
        ]);


        //Se o id não existir na tabela discounts uma mensagem de desconto não econtrado é retornado.
        $response->assertStatus(404)->assertJsonFragment([
            "message" => "Nenhum desconto encontrado."
        ]);
    }
}
