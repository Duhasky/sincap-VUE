<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Ability;
use App\Models\Role;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = \App\Models\User::create([
          'name' => 'admin',
          'email' => 'admin@admin.com',
          'password' => Hash::make('admin'),
          'remember_token' => Str::random(10),
        ]);

        $role = $user->roles()->create(['name' => 'admin']);
        $role->abilities()->create([ 'name' => 'user_create' ]);
        $role->abilities()->create([ 'name' => 'user_read' ]);
        $role->abilities()->create([ 'name' => 'user_update' ]);
        $role->abilities()->create([ 'name' => 'user_delete' ]);
        
        $role->abilities()->create([ 'name' => 'role_admin' ]);

        \App\Models\Group::create(['name' => 'CV']);
        \App\Models\Group::create(['name' => 'GDE']);
        \App\Models\Group::create(['name' => 'PCC']);
        
        \App\Models\City::create(['name' => "Abaiara"]);
        \App\Models\City::create(['name' => "Acarape"]);
        \App\Models\City::create(['name' => "Acaraú"]);
        \App\Models\City::create(['name' => "Acopiara"]);
        \App\Models\City::create(['name' => "Aiuaba"]);
        \App\Models\City::create(['name' => "Alcântaras"]);
        \App\Models\City::create(['name' => "Altaneira"]);
        \App\Models\City::create(['name' => "Alto Santo"]);
        \App\Models\City::create(['name' => "Amontada"]);
        \App\Models\City::create(['name' => "Antonina do Norte"]);
        \App\Models\City::create(['name' => "Apuiarés"]);
        \App\Models\City::create(['name' => "Aquiraz"]);
        \App\Models\City::create(['name' => "Aracati"]);
        \App\Models\City::create(['name' => "Aracoiaba"]);
        \App\Models\City::create(['name' => "Ararendá"]);
        \App\Models\City::create(['name' => "Araripe"]);
        \App\Models\City::create(['name' => "Aratuba"]);
        \App\Models\City::create(['name' => "Arneiroz"]);
        \App\Models\City::create(['name' => "Assaré"]);
        \App\Models\City::create(['name' => "Aurora"]);
        \App\Models\City::create(['name' => "Baixio"]);
        \App\Models\City::create(['name' => "Banabuiú"]);
        \App\Models\City::create(['name' => "Barbalha"]);
        \App\Models\City::create(['name' => "Barreira"]);
        \App\Models\City::create(['name' => "Barro"]);
        \App\Models\City::create(['name' => "Barroquinha"]);
        \App\Models\City::create(['name' => "Baturité"]);
        \App\Models\City::create(['name' => "Beberibe"]);
        \App\Models\City::create(['name' => "Bela Cruz"]);
        \App\Models\City::create(['name' => "Boa Viagem"]);
        \App\Models\City::create(['name' => "Brejo Santo"]);
        \App\Models\City::create(['name' => "Camocim"]);
        \App\Models\City::create(['name' => "Campos Sales"]);
        \App\Models\City::create(['name' => "Canindé"]);
        \App\Models\City::create(['name' => "Capistrano"]);
        \App\Models\City::create(['name' => "Caridade"]);
        \App\Models\City::create(['name' => "Cariré"]);
        \App\Models\City::create(['name' => "Caririaçu"]);
        \App\Models\City::create(['name' => "Cariús"]);
        \App\Models\City::create(['name' => "Carnaubal"]);
        \App\Models\City::create(['name' => "Cascavel"]);
        \App\Models\City::create(['name' => "Catarina"]);
        \App\Models\City::create(['name' => "Catunda"]);
        \App\Models\City::create(['name' => "Caucaia"]);
        \App\Models\City::create(['name' => "Cedro"]);
        \App\Models\City::create(['name' => "Chaval"]);
        \App\Models\City::create(['name' => "Choró"]);
        \App\Models\City::create(['name' => "Chorozinho"]);
        \App\Models\City::create(['name' => "Coreaú"]);
        \App\Models\City::create(['name' => "Crateús"]);
        \App\Models\City::create(['name' => "Crato"]);
        \App\Models\City::create(['name' => "Croatá"]);
        \App\Models\City::create(['name' => "Cruz"]);
        \App\Models\City::create(['name' => "Deputado Irapuan Pinheiro"]);
        \App\Models\City::create(['name' => "Ereré"]);
        \App\Models\City::create(['name' => "Eusébio"]);
        \App\Models\City::create(['name' => "Farias Brito"]);
        \App\Models\City::create(['name' => "Forquilha"]);
        \App\Models\City::create(['name' => "Fortaleza"]);
        \App\Models\City::create(['name' => "Fortim"]);
        \App\Models\City::create(['name' => "Frecheirinha"]);
        \App\Models\City::create(['name' => "General Sampaio"]);
        \App\Models\City::create(['name' => "Graça"]);
        \App\Models\City::create(['name' => "Granja"]);
        \App\Models\City::create(['name' => "Granjeiro"]);
        \App\Models\City::create(['name' => "Groaíras"]);
        \App\Models\City::create(['name' => "Guaiúba"]);
        \App\Models\City::create(['name' => "Guaraciaba do Norte"]);
        \App\Models\City::create(['name' => "Guaramiranga"]);
        \App\Models\City::create(['name' => "Hidrolândia"]);
        \App\Models\City::create(['name' => "Horizonte"]);
        \App\Models\City::create(['name' => "Ibaretama"]);
        \App\Models\City::create(['name' => "Ibiapina"]);
        \App\Models\City::create(['name' => "Ibicuitinga"]);
        \App\Models\City::create(['name' => "Icapuí"]);
        \App\Models\City::create(['name' => "Icó"]);
        \App\Models\City::create(['name' => "Iguatu"]);
        \App\Models\City::create(['name' => "Independência"]);
        \App\Models\City::create(['name' => "Ipaporanga"]);
        \App\Models\City::create(['name' => "Ipaumirim"]);
        \App\Models\City::create(['name' => "Ipu"]);
        \App\Models\City::create(['name' => "Ipueiras"]);
        \App\Models\City::create(['name' => "Iracema"]);
        \App\Models\City::create(['name' => "Irauçuba"]);
        \App\Models\City::create(['name' => "Itaiçaba"]);
        \App\Models\City::create(['name' => "Itaitinga"]);
        \App\Models\City::create(['name' => "Itapajé"]);
        \App\Models\City::create(['name' => "Itapipoca"]);
        \App\Models\City::create(['name' => "Itapiúna"]);
        \App\Models\City::create(['name' => "Itarema"]);
        \App\Models\City::create(['name' => "Itatira"]);
        \App\Models\City::create(['name' => "Jaguaretama"]);
        \App\Models\City::create(['name' => "Jaguaribara"]);
        \App\Models\City::create(['name' => "Jaguaribe"]);
        \App\Models\City::create(['name' => "Jaguaruana"]);
        \App\Models\City::create(['name' => "Jardim"]);
        \App\Models\City::create(['name' => "Jati"]);
        \App\Models\City::create(['name' => "Jijoca de Jericoacoara"]);
        \App\Models\City::create(['name' => "Juazeiro do Norte"]);
        \App\Models\City::create(['name' => "Jucás"]);
        \App\Models\City::create(['name' => "Lavras da Mangabeira"]);
        \App\Models\City::create(['name' => "Limoeiro do Norte"]);
        \App\Models\City::create(['name' => "Madalena"]);
        \App\Models\City::create(['name' => "Maracanaú"]);
        \App\Models\City::create(['name' => "Maranguape"]);
        \App\Models\City::create(['name' => "Marco"]);
        \App\Models\City::create(['name' => "Martinópole"]);
        \App\Models\City::create(['name' => "Massapê"]);
        \App\Models\City::create(['name' => "Mauriti"]);
        \App\Models\City::create(['name' => "Meruoca"]);
        \App\Models\City::create(['name' => "Milagres"]);
        \App\Models\City::create(['name' => "Milhã"]);
        \App\Models\City::create(['name' => "Miraíma"]);
        \App\Models\City::create(['name' => "Missão Velha"]);
        \App\Models\City::create(['name' => "Mombaça"]);
        \App\Models\City::create(['name' => "Monsenhor Tabosa"]);
        \App\Models\City::create(['name' => "Morada Nova"]);
        \App\Models\City::create(['name' => "Moraújo"]);
        \App\Models\City::create(['name' => "Morrinhos"]);
        \App\Models\City::create(['name' => "Mucambo"]);
        \App\Models\City::create(['name' => "Mulungu"]);
        \App\Models\City::create(['name' => "Nova Olinda"]);
        \App\Models\City::create(['name' => "Nova Russas"]);
        \App\Models\City::create(['name' => "Novo Oriente"]);
        \App\Models\City::create(['name' => "Ocara"]);
        \App\Models\City::create(['name' => "Orós"]);
        \App\Models\City::create(['name' => "Pacajus"]);
        \App\Models\City::create(['name' => "Pacatuba"]);
        \App\Models\City::create(['name' => "Pacoti"]);
        \App\Models\City::create(['name' => "Pacujá"]);
        \App\Models\City::create(['name' => "Palhano"]);
        \App\Models\City::create(['name' => "Palmácia"]);
        \App\Models\City::create(['name' => "Paracuru"]);
        \App\Models\City::create(['name' => "Paraipaba"]);
        \App\Models\City::create(['name' => "Parambu"]);
        \App\Models\City::create(['name' => "Paramoti"]);
        \App\Models\City::create(['name' => "Pedra Branca"]);
        \App\Models\City::create(['name' => "Penaforte"]);
        \App\Models\City::create(['name' => "Pentecoste"]);
        \App\Models\City::create(['name' => "Pereiro"]);
        \App\Models\City::create(['name' => "Pindoretama"]);
        \App\Models\City::create(['name' => "Piquet Carneiro"]);
        \App\Models\City::create(['name' => "Pires Ferreira"]);
        \App\Models\City::create(['name' => "Poranga"]);
        \App\Models\City::create(['name' => "Porteiras"]);
        \App\Models\City::create(['name' => "Potengi"]);
        \App\Models\City::create(['name' => "Potiretama"]);
        \App\Models\City::create(['name' => "Quiterianópolis"]);
        \App\Models\City::create(['name' => "Quixadá"]);
        \App\Models\City::create(['name' => "Quixelô"]);
        \App\Models\City::create(['name' => "Quixeramobim"]);
        \App\Models\City::create(['name' => "Quixeré"]);
        \App\Models\City::create(['name' => "Redenção"]);
        \App\Models\City::create(['name' => "Reriutaba"]);
        \App\Models\City::create(['name' => "Russas"]);
        \App\Models\City::create(['name' => "Saboeiro"]);
        \App\Models\City::create(['name' => "Salitre"]);
        \App\Models\City::create(['name' => "Santa Quitéria"]);
        \App\Models\City::create(['name' => "Santana do Acaraú"]);
        \App\Models\City::create(['name' => "Santana do Cariri"]);
        \App\Models\City::create(['name' => "São Benedito"]);
        \App\Models\City::create(['name' => "São Gonçalo do Amarante"]);
        \App\Models\City::create(['name' => "São João do Jaguaribe"]);
        \App\Models\City::create(['name' => "São Luís do Curu"]);
        \App\Models\City::create(['name' => "Senador Pompeu"]);
        \App\Models\City::create(['name' => "Senador Sá"]);
        \App\Models\City::create(['name' => "Sobral"]);
        \App\Models\City::create(['name' => "Solonópole"]);
        \App\Models\City::create(['name' => "Tabuleiro do Norte"]);
        \App\Models\City::create(['name' => "Tamboril"]);
        \App\Models\City::create(['name' => "Tarrafas"]);
        \App\Models\City::create(['name' => "Tauá"]);
        \App\Models\City::create(['name' => "Tejuçuoca"]);
        \App\Models\City::create(['name' => "Tianguá"]);
        \App\Models\City::create(['name' => "Trairi"]);
        \App\Models\City::create(['name' => "Tururu"]);
        \App\Models\City::create(['name' => "Ubajara"]);
        \App\Models\City::create(['name' => "Umari"]);
        \App\Models\City::create(['name' => "Umirim"]);
        \App\Models\City::create(['name' => "Uruburetama"]);
        \App\Models\City::create(['name' => "Uruoca"]);
        \App\Models\City::create(['name' => "Varjota"]);
        \App\Models\City::create(['name' => "Várzea Alegre"]);
        \App\Models\City::create(['name' => "Viçosa do Ceará"]);

        \App\Models\User::factory(100)->create();
        
        

        for ($i = 0; $i < 100; $i++) {
          $person = \App\Models\Person::factory()->create();

          // Crie 3 fotos para cada pessoa com diferentes tamanhos
          $photoSizes = [200, 300, 400];
          
          foreach ($photoSizes as $size) {
              $person->photos()->create(['photo' => "https://picsum.photos/{$size}"]);
          }
      }
    }
}
