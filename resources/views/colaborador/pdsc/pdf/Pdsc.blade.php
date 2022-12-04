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
            margin-top: 100px

        }
    </style>
    <title>sisGRH | PDFPdsc</title>
</head>

<body>

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
    <h5 style="text-decoration: underline; font-size: 16px;">RELATÓRIO DE PDSC (PROVEDORES DE SERVISERVIÇOS COMUNITÁRIOS)
    </h5>
    <table>
        <thead style="background-color:#A9D0F5">
            <tr>
                <th style="text-align: left;">Nr. Processo</th>
                <th style="text-align: left;">Nome</th>
                <th style="text-align: left;">Sexo</th>
                <th style="text-align: left;">BI</th>
                <th style="text-align: left;">Telefone</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($colaboradores as $key => $pdsc)
                <tr>
                    <td>{{ $pdsc->processo }}</td>
                    <td>{{ $pdsc->nome }}</td>
                    <td>{{ $pdsc->sexo }}</td>
                    <td>{{ $pdsc->bi }}</td>
                    <td>{{ $pdsc->telefone }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            @if (isset($key))
                <tr>
                    <th colspan="4" style="text-align: right">TOTAL </th>
                    <th style="background-color:#A9D0F5; text-align: right;">
                        {{ number_format($key + 1, 1, '.', '.') }}
                    </th>
                </tr>
            @endif
        </tfoot>
    </table>

</body>

</html>
