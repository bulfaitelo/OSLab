<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultsConfigFormaPagamento extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insert = [
            [
                'id' => 1,
                'name' => 'Cartão de Crédito',
                'descricao' => 'Pagamento realizado através de cartão de crédito.'
            ],
            [
                'id' => 2,
                'name' => 'Boleto Bancário',
                'descricao' => 'Pagamento realizado através de boleto bancário.'
            ],
            [
                'id' => 3,
                'name' => 'Transferência Bancária',
                'descricao' => 'Pagamento realizado através de transferência bancária.'
            ],
            [
                'id' => 4,
                'name' => 'PIX',
                'descricao' => 'Pagamento realizado através do sistema de pagamentos instantâneos PIX.'
            ],
            [
                'id' => 5,
                'name' => 'Débito Online',
                'descricao' => 'Pagamento realizado através de débito online, diretamente da conta bancária.'
            ],
            [
                'id' => 6,
                'name' => 'Link de pagamento',
                'descricao' => 'Link gerado via aplicação para pagamento online.'
            ]

        ];

        foreach ($insert as $key => $value) {
            Setor::updateOrCreate(
            // DB::table('permissions')->updateOrInsert(
                [   'id' => $value['id'],
                ],
                [
                    'name'  => $value['name'],
                    'descricao'  => $value['descricao'],
                ]
            );
        }
    }
}
