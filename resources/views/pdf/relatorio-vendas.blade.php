<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Vendas</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Relatório de Vendas</h1>
        <p>Data de geração: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vendas as $venda)
            <tr>
                <td>{{ $venda->id }}</td>
                <td>{{ $venda->data_venda->format('d/m/Y') }}</td>
                <td>{{ $venda->cliente->nome }}</td>
                <td>{{ $venda->vendedor->name }}</td>
                <td>{{ $venda->status_formatado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if($venda->parcelas && $venda->parcelas->count() > 0)
    <div style="margin-top: 30px;">
        <h3>Parcelas</h3>
        <table>
            <thead>
                <tr>
                    <th>Número</th>
                    <th>Vencimento</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($venda->parcelas as $parcela)
                <tr>
                    <td>{{ $parcela->numero }}/{{ $venda->parcelas->count() }}</td>
                    <td>{{ $parcela->data_vencimento->format('d/m/Y') }}</td>
                    <td>R$ {{ number_format($parcela->valor, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div style="margin-top: 20px; text-align: right;">
        <p style="margin: 0; font-weight: bold;">Total: {{ $venda->valor_total_formatado }}</p>
    </div>
</body>
</html>
