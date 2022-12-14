<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" charset="utf-8">
    <style type="text/css">
        table {
            border-collapse: collapse;
            width: 100%
        }

        th,
        td {
            border-bottom: 1px solid #ccc;
            border-top: 0px;
            border-right: 0px;
            border-left: 0px;
            height: 25px;
        }

        tbody tr:nth-child(odd) {
            background: #eee;
        }

        figure {
            float: right;
            width: 20%;
            margin-top: 100px;

        }
    </style>
    <title>sisGRH | PDFFormacao</title>
</head>

<body> 
    @if (Auth::user()->tipo == 'Supervisor')
    @include('errors.info')
    @else
        <figure>
            <img src="{{ 'storage/imagens/artigos/' . $entidade->imagem }}" alt="Sem Imagem" height="120px" width="180px">
        </figure>

        <h3>{{ $entidade->nome }}</h3>
        <p>Nuit: {{ $entidade->nuit }}</p>
        <p>Cidade: {{ $entidade->cidade }}</p>
        <p>Av_Rua: {{ $entidade->avrua }}</p>
        <p>Telefone: {{ $entidade->telefone }} - Fax: {{ $entidade->fax }}</p>
        <p>E_mail: {{ $entidade->email }}</p>

        <hr class="my-2" style="color: #A9D0F5">
        <h5 style="text-decoration: underline; font-size: 16px;">RELATÓRIO DE FORMAÇÕES</h5>
        <table>
            <thead style="background-color:#A9D0F5">
                <tr>
                    <th style="text-align: left;">Código</th>
                    <th style="text-align: left;">Formações</th>
                    <th style="text-align: left;">Descrição</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($formacao as $key => $for)
                    <tr>
                        <td>{{ $for->idformacao }}</td>
                        <td>{{ $for->nome }}</td>
                        <td>{{ $for->descricao }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                @if (isset($key))
                    <tr>
                        <th colspan="2" style="text-align: right">TOTAL </th>
                        <th style="background-color:#A9D0F5; text-align: right;">
                            {{ number_format($key + 1, 1, '.', '.') }}
                        </th>
                    </tr>
                @endif
            </tfoot>
        </table>

    @endif
</body>

</html>
