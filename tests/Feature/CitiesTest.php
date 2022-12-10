<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/*
Group recebe os seguintes valores:
String name, 
Foreing|int|nullable active_campaign

Cidade recebe os seguintes valores:
String name,
String uf,
Foreing|int|nullable group_id, 

Totas as foreign keys são verificadas pelo laravel, em caso de não existir o id informado uma json de erro é retornado.
 */

class CitiesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Lista todos os registros de cidades paginadas
     *
     * @return void
     */
    public function test_list_all_cities()
    {
        $response = $this->get('/api/cities');
        
        //Retorna um json vazio ou com dados de todas cidades
        $response->assertStatus(200);
    }

    /**
     * Testa o registro de uma nova cidade
     *  
     * @return void
     */
    public function test_create_city()
    {

        //Criando registro de um novo grupo com nenhuma campanha definida em active_campaign
        $group = Group::create([
            'name' => 'Grupo Test'
        ]);

        $response = $this->postJson('/api/cities', [
            'name' => 'Amparo Test',
            'uf' => 'São Paulo Test',
            'group_id' => $group->id
        ]);

        //Se tudo ocorrer bem uma menssage de sucesso é retornada junto com um json contendo os dados registrados.
        $response->assertStatus(200)->assertJsonFragment([
            'message' => 'Cidade cadastrada com sucesso.',
            'name' => 'Amparo Test',
            'uf' => 'São Paulo Test',
        ]);
    }

    /**
     * Lista apenas uma cidade especifica
     *
     * @return void
     */
    public function test_show_city()
    {

        //Criando registro de um novo grupo sem uma campanha definida na coluna active_campaign
        $group = Group::create([
            'name' => 'Grupo Test'
        ]);

        //Criando registro de uma nova cidade
        $city = City::create([
            'name' => 'Amparo Test',
            'uf' => 'São Paulo Test',
            'group_id' => $group->id
        ]);

        $response = $this->get("/api/cities/{$city->id}");

        //Se tudo ocorrer bem um json contendo os dados da cidade especificada é retornado.
        $response->assertStatus(200)->assertJsonFragment([
            'id' => $city->id,
            'name' => $city->name,
            'uf' =>  $city->uf
        ]);
    }

    /**
     * Testa o erro restornado caso não exista o parametro id na tabela cities.
     *
     * @return void
     */
    public function test_error_city_not_exists_in_show_city()
    {

        //Se o id não existir na tabela cities uma mensagem de erro é retornada.
        $response = $this->get("/api/cities/1");
        $response->assertStatus(404)->assertJsonFragment([
            "message" => "Nenhuma cidade encontrada."
        ]);
    }

    /**
     * Deleta uma cidade
     *
     * @return void
     */
    public function test_delete_city()
    {

        //Criando registro de um novo grupo sem uma campanha definida na coluna active_campaign
        $group = Group::create([
            'name' => 'Grupo Test'
        ]);

        //Criando registro de uma nova cidade
        $city = City::create([
            'name' => 'Amparo Test',
            'uf' => 'São Paulo Test',
            'group_id' => $group->id
        ]);

        $response = $this->deleteJson("/api/cities/{$city->id}");

        //Caso id exista na tabela cities uma menssagem de sucesso é retornada
        $response->assertStatus(200)->assertJsonFragment([
            "message" => "Cidade deletada com sucesso."
        ]);
    }

    /**
     * Testa o erro retornado caso não exista o parametro id na tabela cities
     *
     * @return void
     */
    public function test_error_city_not_exists_in_delete_city()
    {

        $response = $this->deleteJson("/api/cities/1");

        //Se o id não existir uma mensagem de cidade não econtrada é retornado.
        $response->assertStatus(404)->assertJsonFragment([
            "message" => "Nenhuma cidade encontrada."
        ]);
    }
    /**
     * Atualiza a cidade
     *
     * @return void
     */
    public function test_update_city()
    {

        //Criando registro de um novo grupo sem uma campanha definida em active_campaign
        $group = Group::create([
            'name' => 'Grupo Test'
        ]);

        //Criando registro de uma nova cidade
        $city = City::create([
            'name' => 'Amparo Test',
            'uf' => 'São Paulo Test',
            'group_id' => $group->id
        ]);

        /*Caso tudo ocorra bem uma menssage de sucesso é retornada
         junto com um json contendo os dados atualizados*/
        $response = $this->putJson("/api/cities/{$city->id}", [
            'name' => 'Amparo Test Updated',
            'uf' => 'São Paulo Test Updated',
            'group_id' => $city->group_id
        ]);
        /*Caso tudo ocorra bem uma menssage de sucesso é retornada
         junto com um json contendo os dados atualizados*/
        $response->assertStatus(200)->assertJsonFragment([
            'message' => 'Cidade atualizada com sucesso.',
            'name' => 'Amparo Test Updated',
            'uf' => 'São Paulo Test Updated',
            'group_id' => $city->group_id
        ]);
    }

    /**
     * Testa o erro retornado caso não exista o parametro id na tabela cities
     *
     * @return void
     */
    public function test_error_city_not_exists_in_update_city()
    {

        $response = $this->putJson("/api/cities/1", [
            'name' => 'Amparo Test Updated',
            'uf' => 'São Paulo Test Updated'
        ]);
        //Se o id não existir na tabela cities uma mensagem de cidade não econtrada é retornado.
        $response->assertStatus(404)->assertJsonFragment([
            "message" => "Nenhuma cidade encontrada."
        ]);
    }
}
