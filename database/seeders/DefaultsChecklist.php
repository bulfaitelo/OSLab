<?php

namespace Database\Seeders;

use App\Models\Checklist\Checklist;
use Illuminate\Database\Seeder;

class DefaultsChecklist extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insert = [
            [
                'id' => 1,
                'name' => 'Checklist Notebook',
                'categoria_id' => 2,
                'user_id' => 1,
                'descricao' => 'Checklist básico de reparo e notebooks',
                'checklist' => '[
                    {
                        "name": "checkbox-group-1694878113667-0",
                        "type": "checkbox-group",
                        "label": "Procedimentos básicos<br>",
                        "other": true,
                        "access": false,
                        "inline": false,
                        "toggle": false,
                        "values": [
                            {
                                "label": "Realizada limpeza",
                                "value": "",
                                "selected": false
                            },
                            {
                                "label": "Realizada troca pasta termica",
                                "value": "Qual?",
                                "selected": false
                            },
                            {
                                "label": "Realizado reparo?",
                                "value": "Descrição",
                                "selected": false
                            }
                        ],
                        "required": true
                    },
                    {
                        "name": "radio-group-1694878380178-0",
                        "type": "radio-group",
                        "label": "Teste de Estresse<br>",
                        "other": true,
                        "access": false,
                        "inline": true,
                        "values": [
                            {
                                "label": "Heaven Benchmark",
                                "value": "opo-1",
                                "selected": false
                            },
                            {
                                "label": "Prime 95",
                                "value": "opo-2",
                                "selected": false
                            },
                            {
                                "label": "Aida 64",
                                "value": "opo-3",
                                "selected": false
                            }
                        ],
                        "required": true
                    },
                    {
                        "name": "number-1694878567979-0",
                        "type": "number",
                        "label": "<div>Temperatura Ocioso</div>",
                        "access": false,
                        "required": true,
                        "className": "form-control",
                        "description": "Temperatura em ºC"
                    },
                    {
                        "name": "number-1694878615301",
                        "type": "number",
                        "label": "Temperatura Máxima<br>",
                        "access": false,
                        "required": true,
                        "className": "form-control",
                        "description": "Temperatura em ºC"
                    },
                    {
                        "name": "text-1694878579598-0",
                        "type": "text",
                        "label": "Resultados",
                        "value": "Score:                                        FPS:                               Min FPS:                                    Max FPS:",
                        "access": false,
                        "subtype": "text",
                        "required": true,
                        "className": "form-control"
                    },
                    {
                        "type": "paragraph",
                        "label": "Teste de Memória<br>",
                        "access": false,
                        "subtype": "p"
                    },
                    {
                        "name": "number-1694878773385-0",
                        "type": "number",
                        "label": "Tempo de realização<br>",
                        "access": false,
                        "required": false,
                        "className": "form-control",
                        "description": "Tempo em minutos"
                    },
                    {
                        "name": "radio-group-1694878845482-0",
                        "type": "radio-group",
                        "label": "Houve erros<br>",
                        "other": true,
                        "access": false,
                        "inline": true,
                        "values": [
                            {
                                "label": "Sim",
                                "value": "opo-1",
                                "selected": true
                            },
                            {
                                "label": "Não",
                                "value": "opo-2",
                                "selected": false
                            }
                        ],
                        "required": false
                    },
                    {
                        "type": "header",
                        "label": "Teste Físico",
                        "access": false,
                        "subtype": "h5"
                    },
                    {
                        "name": "radio-group-1694878917429-0",
                        "type": "radio-group",
                        "label": "USB",
                        "other": true,
                        "access": false,
                        "inline": true,
                        "values": [
                            {
                                "label": "OK",
                                "value": "opo-1",
                                "selected": false
                            },
                            {
                                "label": "Ruim",
                                "value": "opo-2",
                                "selected": false
                            }
                        ],
                        "required": true
                    },
                    {
                        "name": "radio-group-1694878922155",
                        "type": "radio-group",
                        "label": "Teclado",
                        "other": true,
                        "access": false,
                        "inline": true,
                        "values": [
                            {
                                "label": "Ok",
                                "value": "opo-1",
                                "selected": false
                            },
                            {
                                "label": "Ruim",
                                "value": "opo-2",
                                "selected": false
                            },
                            {
                                "label": "Opção 3",
                                "value": "opo-3",
                                "selected": false
                            }
                        ],
                        "required": true
                    },
                    {
                        "name": "radio-group-1694878975045",
                        "type": "radio-group",
                        "label": "Som interno (L/R)<br>",
                        "other": true,
                        "access": false,
                        "inline": true,
                        "values": [
                            {
                                "label": "OK",
                                "value": "opo-1",
                                "selected": false
                            },
                            {
                                "label": "Ruim",
                                "value": "opo-2",
                                "selected": false
                            }
                        ],
                        "required": true
                    },
                    {
                        "name": "radio-group-1694879043626",
                        "type": "radio-group",
                        "label": "Som P2 (fone de ouvido)<br>",
                        "other": true,
                        "access": false,
                        "inline": true,
                        "values": [
                            {
                                "label": "OK",
                                "value": "opo-1",
                                "selected": false
                            },
                            {
                                "label": "Ruim",
                                "value": "opo-2",
                                "selected": false
                            }
                        ],
                        "required": true
                    },
                    {
                        "name": "radio-group-1694878975759",
                        "type": "radio-group",
                        "label": "Microfone<br>",
                        "other": true,
                        "access": false,
                        "inline": true,
                        "values": [
                            {
                                "label": "OK",
                                "value": "opo-1",
                                "selected": false
                            },
                            {
                                "label": "Ruim",
                                "value": "opo-2",
                                "selected": false
                            }
                        ],
                        "required": true
                    },
                    {
                        "name": "radio-group-1694878974373",
                        "type": "radio-group",
                        "label": "Webcam",
                        "other": true,
                        "access": false,
                        "inline": true,
                        "values": [
                            {
                                "label": "OK",
                                "value": "opo-1",
                                "selected": false
                            },
                            {
                                "label": "Ruim",
                                "value": "opo-2",
                                "selected": false
                            }
                        ],
                        "required": true
                    },
                    {
                        "name": "radio-group-1694879042585",
                        "type": "radio-group",
                        "label": "Bateria",
                        "other": true,
                        "access": false,
                        "inline": true,
                        "values": [
                            {
                                "label": "OK",
                                "value": "opo-1",
                                "selected": false
                            },
                            {
                                "label": "Ruim",
                                "value": "opo-2",
                                "selected": false
                            }
                        ],
                        "required": true
                    },
                    {
                        "name": "radio-group-1694879072343",
                        "type": "radio-group",
                        "label": "Conexão Wi-fi<br>",
                        "other": true,
                        "access": false,
                        "inline": true,
                        "values": [
                            {
                                "label": "OK",
                                "value": "opo-1",
                                "selected": false
                            },
                            {
                                "label": "Ruim",
                                "value": "opo-2",
                                "selected": false
                            }
                        ],
                        "required": true
                    },
                    {
                        "name": "radio-group-1694879072113",
                        "type": "radio-group",
                        "label": "Conexão Cabo<br>",
                        "other": true,
                        "access": false,
                        "inline": true,
                        "values": [
                            {
                                "label": "OK",
                                "value": "opo-1",
                                "selected": false
                            },
                            {
                                "label": "Ruim",
                                "value": "opo-2",
                                "selected": false
                            }
                        ],
                        "required": true
                    }
                ]',
            ],

        ];

        foreach ($insert as $key => $value) {
            Checklist::updateOrCreate(
                [
                    'id' => $value['id'],
                    'name' => $value['name'],
                ],
                [
                    'categoria_id' => $value['categoria_id'],
                    'user_id' => $value['user_id'],
                    'descricao' => $value['descricao'],
                    'checklist' => $value['checklist'],

                ]
            );
        }
    }
}
