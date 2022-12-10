<?php

namespace Tests\Feature;

use App\Models\Campaign;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/*
Group recebe os seguintes valores:
String name, 
Foreing|int|nullable active_campaign

Totas as foreign keys são verificadas pelo laravel, em caso de não existir o id informado uma json de erro é retornado.
 */

class GroupsTest extends TestCase
{

    use RefreshDatabase;

    public function test_list_all_groups()
    {
        /**
         * Lista todos os registros de grupos paginados
         *
         * @return void
         */
        $response = $this->get('/api/groups');
        $response->assertStatus(200);
    }

    /**
     * Testa o registro de um novo grupo
     *  
     * @return void
     */
    public function test_create_group()
    {
        $response = $this->postJson('/api/groups', [
            'name' => 'Grupo Test'
        ]);

        //Se tudo ocorrer bem uma menssage de sucesso é retornada junto com um json contendo os dados registrados.
        $response->assertStatus(200)->assertJsonFragment([
            'message' => 'Grupo cadastrado com sucesso.',
            'name' => 'Grupo Test'
        ]);
    }

    /**
     * Lista apenas um grupo especifico
     *
     * @return void
     */
    public function test_show_group()
    {
        //Criando registro de um novo grupo sem uma campanha definida na coluna active_campaign
        $group = Group::create([
            'name' => 'Grupo Test'
        ]);

        $response = $this->get("/api/groups/{$group->id}");

        //Se tudo ocorrer bem um json contendo os dados do grupo especificado é retornado.
        $response->assertStatus(200)->assertJsonFragment([
            'name' => $group->name
        ]);
    }

    /**
     * Testa o erro restornado caso não exista o parametro id na tabela groups.
     *
     * @return void
     */
    public function test_error_group_not_exists_in_show_group()
    {

        $response = $this->get("/api/groups/1");

        //Se o id não existir na tabela groups uma mensagem de erro é retornada.
        $response->assertStatus(404)->assertJsonFragment([
            "message" => "Nenhum grupo encontrado."
        ]);
    }

    /**
     * Deleta um grupo
     *
     * @return void
     */
    public function test_delete_group()
    {

        //Criando registro de um novo grupo sem uma campanha definida na coluna active_campaign
        $group = Group::create([
            'name' => 'Grupo Test'
        ]);

        $response = $this->deleteJson("/api/groups/{$group->id}");

        //Caso id exista na tabela groups uma menssagem de sucesso é retornada
        $response->assertStatus(200)->assertJsonFragment([
            "message" => "Grupo deletado com sucesso."
        ]);
    }

    /**
     * Deleta um grupo
     *
     * @return void
     */
    public function test_error_group_not_exists_in_delete_group()
    {

        $response = $this->deleteJson("/api/groups/1");

        //Se o id não existir uma mensagem de grupo não econtrado é retornado.
        $response->assertStatus(404)->assertJsonFragment([
            "message" => "Nenhum grupo encontrado."
        ]);
    }

    /**
     * Atualiza a cidade
     *
     * @return void
     */
    public function test_update_group()
    {

        //Criando registro de um novo grupo sem uma campanha definida em active_campaign
        $group = Group::create([
            'name' => 'Grupo Test'
        ]);

        $response = $this->putJson("/api/groups/{$group->id}", [
            'name' => 'Grupo Test Updated'
        ]);

        /*Caso tudo ocorra bem uma menssage de sucesso é retornada
         junto com um json contendo os dados atualizados*/
        $response->assertStatus(200)->assertJsonFragment([
            'message' => "Grupo atualizado com sucesso.",
            'id' => $group->id,
            'name' => 'Grupo Test Updated'
        ]);
    }

    /**
     * Testa o erro retornado caso não exista o parametro id na tabela groups
     *
     * @return void
     */
    public function test_error_group_not_exists_in_update_group()
    {

        $response = $this->putJson("/api/groups/1", [
            'name' => 'Grupo Test Updated'
        ]);

        //Se o id não existir na tabela groups uma mensagem de cidade não econtrada é retornado.
        $response->assertStatus(404)->assertJsonFragment([
            "message" => "Nenhum grupo encontrado."
        ]);
    }
}
