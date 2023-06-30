<?php

namespace Database\Seeders;

use App\Models\Configuracao\Os\Garantia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultsConfigGarantiaOs extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insert = [
            [
                'id' => 1,
                'name' => 'Garantia Padrão',
                'garantia' => '<p>Está coberto pela garantia: 30 dias corridos para …Mão-de-Obra somente referente aos componentes consertados ou trocados, limpeza e materiais envolvidos, aquisição de novos componentes, estadointegral de sistema operacional e softwares instalados (conforme listaem anexo) se os mesmos não sofrerem danos ou adulterações referente avírus ou programas de terceiros que afetem os mesmos.</p><br><p>Essa garantia ficará automaticamente cancelada se os equipamentos ousoftwares instalados vierem a sofrer reparos por pessoas não autorizadas ou sem certificação técnica comprobatória, receber maus tratos ousofrer danos decorrentes de acidentes, quedas, sobrecarga elétrica ouatmosférica acima do especificado nos circuitos e fonte de alimentaçãodo equipamento, ou decorrentes de má utilização dos equipamentos porparte do usuário (uso em local não apropriado, muito quente, tais comocamas e travesseiros – acima de 28º C – e/ou com muita umidade – acimade 90% - assim como em superfícies que favoreçam o aquecimento e/oubloqueiem a passagem de ar), ligação incorreta na rede elétrica,sinistros atmosféricos e utilização de estabilizadores e no-breaksincorretos ou apresentando vícios de funcionamento. </p><br><p>Esta garantia não cobre a infecção do sistema por parte do usuário no quediz respeito a vírus de computador ou armadilhas consensuais de internet que tenha sido por ação comprobatória de download,&nbsp; leitura de e-mailperigoso ou por acesso a site de alto-risco na internet (terrorismo /pornografia / pedofilia / hackerismo / pirataria/ Download de músicas evídeos, Compras On-Line, jogos&nbsp; e outros da mesma categoria) ou por ação errônea de instalação de programas incisivos ao sistema. </p><br><p>Esta coberto pela Garantia somente os programas que foram corretamenteinstalados na lista em anexo, não sendo exclusos de danos causados pelopróprio usuário no caso de infecções ou por dano físico as memórias doequipamento.</p>
                ',
                'color' => 'bg-warning',
                'prazo_garantia' => 30,
                'user_id' => 1,
            ],

        ];

        foreach ($insert as $key => $value) {
            Garantia::updateOrCreate(
                [
                    'id' => $value['id'],
                ],
                [
                    'name'  => $value['name'],
                    'garantia' => $value['garantia'],
                    'prazo_garantia' => $value['prazo_garantia'],
                    'user_id' => $value['user_id'],

                ]
            );
        }
    }
}
