<?php

namespace Database\Seeders;

use App\Models\Configuracao\Os\OsStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultsConfigOsStatus extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insert = [
            [
                'id' => 1,
                'name' => 'Orçamento',
                'descricao' => 'Os Orçamento',
                'color' => 'bg-warning',
                // 'email_id' => null,
                // 'ativar_rastreio' => 0,
                // 'ativar_email' => 0,
                // 'prazo_email' => null,1
            ],
            [
                'id' => 2,
                'name' => 'Aberta',
                'descricao' => 'OS Aberta',
                'color' => 'bg-success',
                // 'email_id' => null,
                // 'ativar_rastreio' => 0,
                // 'ativar_email' => 0,
                // 'prazo_email' => null,1
            ],
            [
                'id' => 3,
                'name' => 'Faturado',
                'descricao' => 'OS faturada',
                'color' => 'bg-info',
                // 'email_id' => null,
                // 'ativar_rastreio' => 0,
                // 'ativar_email' => 0,
                // 'prazo_email' => null,1
            ],
            [
                'id' => 4,
                'name' => 'Negociação',
                'descricao' => 'OS Negociação',
                'color' => 'bg-indigo',
                // 'email_id' => null,
                // 'ativar_rastreio' => 0,
                // 'ativar_email' => 0,
                // 'prazo_email' => null,1
            ],
            [
                'id' => 5,
                'name' => 'Em Andamento',
                'descricao' => 'OS Em andamento',
                'color' => 'bg-orange',
                // 'email_id' => null,
                // 'ativar_rastreio' => 0,
                // 'ativar_email' => 0,
                // 'prazo_email' => null,1
            ],
            [
                'id' => 6,
                'name' => 'Finalizado',
                'descricao' => 'OS Finalizada',
                'color' => 'bg-navy',
                // 'email_id' => null,
                // 'ativar_rastreio' => 0,
                // 'ativar_email' => 0,
                // 'prazo_email' => null,1
            ],
            [
                'id' => 7,
                'name' => 'Cancelada',
                'descricao' => 'OS Cancelada',
                'color' => 'bg-danger',
                // 'email_id' => null,
                // 'ativar_rastreio' => 0,
                // 'ativar_email' => 0,
                // 'prazo_email' => null,1
            ],
            [
                'id' => 8,
                'name' => 'Aguardando Peças',
                'descricao' => 'OS Aguardando peças ',
                'color' => 'bg-secondary',
                // 'email_id' => null,
                'ativar_rastreio' => 1,
                // 'ativar_email' => 0,
                // 'prazo_email' => null,1
            ],

            [
                'id' => 9,
                'name' => 'Aprovado',
                'descricao' => 'OS Aprovada',
                'color' => 'bg-primary',
                // 'email_id' => null,
                // 'ativar_rastreio' => 0,
                // 'ativar_email' => 0,
                // 'prazo_email' => null,1
            ],
        ];

        foreach ($insert as $key => $value) {
            OsStatus::updateOrCreate(
                [
                    'id' => $value['id'],
                    'name'  => $value['name'],
                ],
                [
                    'color' => $value['color'],
                    'descricao' => $value['descricao'],
                    'email_id' => (isset($value['email_id'] ) == true ? $value['email_id'] : null),
                    'ativar_rastreio' => (isset($value['ativar_rastreio'] ) == true ? $value['ativar_rastreio'] : null),
                    'ativar_email' => (isset($value['ativar_email'] ) == true ? $value['ativar_email'] : null),
                    'prazo_email' => (isset($value['prazo_email'] ) == true ? $value['prazo_email'] : null),
                ]
            );
        }
    }
}
