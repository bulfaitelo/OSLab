<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Declaração MEI {{ $year }}</title>
    <style>
        @page {
            margin: 22mm 15mm;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #0f172a;
            font-size: 12px;
        }

        h1 {
            font-size: 18px;
            margin: 0 0 8px 0;
        }

        .subtitle {
            margin: 0 0 16px 0;
            color: #334155;
        }

        .meta {
            margin-bottom: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        th,
        td {
            border: 1px solid #cbd5e1;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #e2e8f0;
            font-size: 11px;
        }

        .text-right {
            text-align: right;
        }

        tfoot td {
            font-weight: bold;
            background: #f1f5f9;
        }

        .sign-area {
            margin-top: 48px;
        }

        .line {
            margin-top: 48px;
            border-top: 1px solid #334155;
            width: 320px;
            padding-top: 6px;
        }
    </style>
</head>
<body>
    <h1>Declaração Mensal de Faturamento Bruto - MEI</h1>
    <p class="subtitle">Suporte para apuração anual (DASN-SIMEI)</p>

    <div class="meta">
        <strong>Ano de referência:</strong> {{ $year }}<br>
        <strong>Tipo de agrupamento:</strong> {{ $type === 'yearly' ? 'Anual' : 'Mensal' }}<br>
        <strong>Gerado em:</strong> {{ $generatedAt->format('d/m/Y H:i') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Período</th>
                <th class="text-right">Receita Bruta - Comércio/Indústria</th>
                <th class="text-right">Receita Bruta - Prestação de Serviços</th>
                <th class="text-right">Receita Bruta Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
                <tr>
                    <td>{{ $record['period'] }}</td>
                    <td class="text-right">R$ {{ number_format($record['commerce'], 2, ',', '.') }}</td>
                    <td class="text-right">R$ {{ number_format($record['service'], 2, ',', '.') }}</td>
                    <td class="text-right">R$ {{ number_format($record['total'], 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td>Total Geral</td>
                <td class="text-right">R$ {{ number_format($totals['commerce'], 2, ',', '.') }}</td>
                <td class="text-right">R$ {{ number_format($totals['service'], 2, ',', '.') }}</td>
                <td class="text-right">R$ {{ number_format($totals['total'], 2, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="sign-area">
        <p>Local: ____________________________________________</p>
        <p>Data: ________/________/____________</p>

        <p class="line">Assinatura do Microempreendedor Individual</p>
    </div>
</body>
</html>
