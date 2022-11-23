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

        }
    </style>
    <title>sisGRH | PDFDepartamentos</title>
</head>

<body> 
    @if (Auth::user()->tipo == 'Administrador' || Auth::user()->tipo == 'Gerente')
        <figure>
            <img src="{{ 'storage/imagens/artigos/' . $entidade->imagem }}" alt="Sem Imagem" height="200px" width="200px">
        </figure>

        <h3>{{ $entidade->nome }}</h3>
        <p>Nuit: {{ $entidade->nuit }}</p>
        <p>Cidade: {{ $entidade->cidade }}</p>
        <p>Av_Rua: {{ $entidade->avrua }}</p>
        <p>Telefone: {{ $entidade->telefone }} - Fax: {{ $entidade->fax }}</p>
        <p>E_mail: {{ $entidade->email }}</p>

        <hr class="my-2" style="color: #A9D0F5">
        <h5 style="text-decoration: underline; font-size: 16px;">RELATÓRIO DE DEPARTAMENTO</h5>
        <table>
            <thead style="background-color:#A9D0F5">
                <tr>
                    <th style="text-align: left;">Código</th>
                    <th style="text-align: left;">Departamento</th>
                    <th style="text-align: left;">Descrição</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departamento as $key => $dep)
                    <tr>
                        <td>{{ $dep->iddepartamento }}</td>
                        <td>{{ $dep->nome }}</td>
                        <td>{{ $dep->descricao }}</td>
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
    @else
        @include('errors.info')
    @endif
</body>

</html>
