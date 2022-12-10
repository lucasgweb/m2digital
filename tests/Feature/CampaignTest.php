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

     Campanha recebe os seguintes valores:
     String name,
     Foreing|int|nullable group_id, 

     Totas as foreign keys são verificadas pelo laravel, em caso de não existir o id informado uma json de erro é retornado.
     */

class CampaignTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Lista todos registros de campanhas
     *
     * @return void
     */
    public function test_list_all_campaigns()
    {

        //Retorna um json vazio ou com dados de todas campanhas paginadas
        $response = $this->get('/api/campaigns');
        $response->assertStatus(200);
    }

    /**
     * Testa o registro de uma nova campanha 
     *
     * @return void
     */
    public function test_create_campaign()
    {
        //Criando registro de um novo grupo com nenhuma campanha definida em active_campaign
        $group = Group::create([
            'name' => 'Grupo Test'
        ]);

        $response = $this->postJson('/api/campaigns', [
            'name' => 'Campanha Test',
            'group_id' => $group->id
        ]);

        //Se tudo ocorrer bem uma menssage de sucesso é retornada, junto com um json contendo os dados registrados.
        $response->assertStatus(200)->assertJsonFragment([
            'message' => 'Campanha cadastrada com sucesso.',
            'name' => 'Campanha Test'
        ]);
    }

    /**
     * Lista apenas uma campanha especifica
     *
     * @return void
     */
    public function test_show_campaign()
    {

        //Criando registro de um novo grupo com nenhuma campanha definida em active_campaign
        $group = Group::create([
            'name' => 'Grupo Test'
        ]);

        //Criando registro de uma nova campanha
        $campaign = Campaign::create([
            'name' => 'Campanha Test',
            'group_id' => $group->id
        ]);

        //Se tudo ocorrer bem uma menssage de sucesso é retornada junto com um json contendo os dados da campanha especificada.
        $response = $this->get("/api/campaigns/{$campaign->id}");
        $response->assertStatus(200)->assertJsonFragment([
            'id' => $campaign->id,
            'name' => $campaign->name
        ]);
    }

    /**
     * Testa o erro restornado caso não exista o parametro id na tabela campaigns.
     *
     * @return void
     */
    public function test_error_campaign_not_exists_in_show_campaign()
    {

       //Se o id não existir na tabela campaigns uma mensagem de erro é retornada.
        $response = $this->get("/api/campaigns/1");
        $response->assertStatus(404)->assertJsonFragment([
            "message" => "Nenhuma campanha encontrada."
        ]);
    }

    /**
     * Deleta uma campanha
     *
     * @return void
     */
    public function test_delete_campaign()
    {

        //Criando registro de um novo grupo com nenhuma campanha definida em active_campaign
        $group = Group::create([
            'name' => 'Grupo Test'
        ]);

        //Criando registro de uma nova campanha
        $campaign = Campaign::create([
            'name' => 'Campanha Test',
            'group_id' => $group->id
        ]);

        $response = $this->deleteJson("/api/campaigns/{$campaign->id}");
        $response->assertStatus(200)->assertJsonFragment([
            "message" => "Campanha deletada com sucesso."
        ]);
    }

    /**
     * Testa o erro retornado caso não exista o parametro id na tabela cities
     *
     * @return void 
     */
    public function test_error_campaign_not_exists_in_delete_campaign()
    {

        //Se o id não existir uma mensagem de campanha não econtrada é retornado.
        $response = $this->deleteJson("/api/campaigns/1");
        $response->assertStatus(404)->assertJsonFragment([
            "message" => "Nenhuma campanha encontrada."
        ]);
    }

    /**
     * Atualiza os dados da campanha
     *
     * @return void
     */
    public function test_update_campaign()
    {
        //Criando registro de um novo grupo com nenhuma campanha definida em active_campaign
        $group = Group::create([
            'name' => 'Grupo Test'
        ]);

        //Criando registro de uma nova campanha
        $campaign = Campaign::create([
            'name' => 'Campanha Test',
            'group_id' => $group->id
        ]);

        //Caso tudo ocorra bem uma menssage de sucesso é retornada junto com um json contendo os dados atualizados, se o id não existir na tabela cities uma mensagem de cidade não econtrada é retornado.
        $response = $this->putJson("/api/campaigns/{$campaign->id}", [
            'name' => 'Campanha Test Updated'
        ]);
        $response->assertStatus(200)->assertJsonFragment([
            'message' => 'Campanha atualizada com sucesso.',
            'id' => $campaign->id,
            'name' => 'Campanha Test Updated'
        ]);
    }

     /**
     * Testa o erro retornado caso não exista o parametro id na tabela campaigns
     *
     * @return void
     */
    public function test_error_campaign_not_exists_in_update_campaign()
    {
        $response = $this->putJson("/api/campaigns/1", [
            'name' => 'Campanha Test Updated'
        ]);
        //Se o id não existir na tabela campaigns uma mensagem de cidade não econtrada é retornado.
        $response->assertStatus(404)->assertJsonFragment([
            "message" => "Nenhuma campanha encontrada."
        ]);
    }
}
