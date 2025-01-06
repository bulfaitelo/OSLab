<?php

namespace Database\Seeders;

use App\Models\Configuracao\Garantia\Garantia;
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
                'garantia' => '<p>Está coberto pela garantia: 30 dias corridos para … Mão-de-Obra somente referente aos componentes consertados ou trocados, limpeza e materiais envolvidos, aquisição de novos componentes, estado integral de sistema operacional e softwares instalados (conforme lista em anexo) se os mesmos não sofrerem danos ou adulterações referente a vírus ou programas de terceiros que afetem os mesmos.</p><br><p xss="removed">Essa garantia ficará automaticamente cancelada se os equipamentos ou softwares instalados vierem a sofrer reparos por pessoas não autorizadas ou sem certificação técnica comprobatória, receber maus tratos ou sofrer danos decorrentes de acidentes, quedas, sobrecarga elétrica ou atmosférica acima do especificado nos circuitos e fonte de alimentação do equipamento, ou decorrentes de má utilização dos equipamentos por parte do usuário (uso em local não apropriado, muito quente, tais como camas e travesseiros – acima de 28º C – e/ou com muita umidade – acima de 90% - assim como em superfícies que favoreçam o aquecimento e/ou bloqueiem a passagem de ar), ligação incorreta na rede elétrica, sinistros atmosféricos e utilização de estabilizadores e no-breaks incorretos ou apresentando vícios de funcionamento. </p><br><p xss="removed">Esta garantia não cobre a infecção do sistema por parte do usuário no que diz respeito a vírus de computador ou armadilhas consensuais de internet que tenha sido por ação comprobatória de download,&nbsp; leitura de e-mail perigoso ou por acesso a site de alto-risco na internet (terrorismo / pornografia / pedofilia / hackerismo / pirataria/ Download de músicas e vídeos, Compras On-Line, jogos&nbsp; e outros da mesma categoria) ou por ação errônea de instalação de programas incisivos ao sistema. </p><br><p xss="removed">Esta coberto pela Garantia somente os programas que foram corretamente instalados na lista em anexo, não sendo exclusos de danos causados pelo próprio usuário no caso de infecções ou por dano físico as memórias do equipamento.</p>',
                'color' => 'bg-warning',
                'prazo_garantia' => 30,
                'user_id' => 1,
                'os' => 1,
                'venda' => 1,
            ],
        ];

        foreach ($insert as $key => $value) {
            Garantia::updateOrCreate(
                [
                    'id' => $value['id'],
                ],
                [
                    'name' => $value['name'],
                    'garantia' => $value['garantia'],
                    'prazo_garantia' => $value['prazo_garantia'],
                    'user_id' => $value['user_id'],
                    'os' => $value['os'],
                    'venda' => $value['venda'],
                ]
            );
        }
    }
}
