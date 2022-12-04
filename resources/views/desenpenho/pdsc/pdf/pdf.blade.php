<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" charset="utf-8">
    <style type="text/css">
        #tabint {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border-bottom: 1px solid #ccc;
            border-top: 0px;
            border-right: 0px;
            border-left: 0px;
            text-align: left;
        }

        tbody tr:nth-child(odd) {
            background: #eee;
            width: 100%;
        }

        figure {
            width: 20%;
            margin-left: 50px;
        }

        h3 {
            float: right;
            margin-top: 130px;
            margin-right: -50px;
        }

        #inf {
            font-size: 12px;
            margin-left: 50px;
        }

        #detalhe {
            border: .50px solid;
            padding: 15px;
        }

        #cli {
            float: right;
            border: .50px solid;
            border-radius: 10%;
            margin-top: -200px;
            padding-right: 5px;
            width: 300px;
            display: block;
            text-align: center;
        }

        #titlo {
            text-align: center;
        }

        #cli b {
            font-size: 14px;
            padding-left: 20px;
        }

        #cli label {
            padding-left: 20px;
        }

        h4 {
            text-align: right;
            padding: 0px;
            margin: 0px;
        }
    </style>
    <title>sisGRH | Avaliação de desempenho do pdsc</title>
</head>

<body>

    <figure>
        <img src="{{ 'storage/imagens/artigos/' . $entidade->imagem }}" alt="Sem Imagem" height="120px" width="180px">
    </figure>

    <div id="inf">
        Rua: Kruss Gomes -3223 – R/C -Munhava - Beira,Tel: Coordenador Geral nºs 824091110 - 844560149<br>
        Cel: -846090051-Departamento Finanças - 848590543- Departamento Técnico Sofala, Moçambique
    </div>

    <hr style="border: .4px solid;">

    <div id="cli"><br>

        Visto Autorizo<br><br>
        _________________________________
        <br><br>(Msc. Manuel Guerra J. Sitole)<br><br>

    </div><br><br>

    <div id="titlo">
        AVALIAÇÃO DE DESEMPENHO PARA MENTORAS, GESTORES DE CASO, FACILITADOR DE LIGACAO, GARRA, FACILITADOR DE POUPANCA,
        MENTORES DE PREVENCAO PRIMARIA & SUPERVISORAS DREAMS E LÍDERES
    </div><br><br>

    <div id="detalhe">
        <b> Nome da Organização : {{ $entidade->nome }}, Projecto: {{ Strtoupper($desenpenho->nomeprojecto) }}<br>
            Nome do Colaborador(a) : {{ $desenpenho->nome }}<br>
            Nome da Supervisor (a) : {{ $desenpenho->idsupervisora }}, Data desta Avaliação:
            {{ date('d-m-Y', strtotime($desenpenho->dataini)) }}</b>
    </div><br><br><br>

    <table id="tabint">
        <thead style="background-color:#A9D0F5">
            <tr>
                <th>Indicadores</th>
                <th style="text-align: left">Avaliação</th>
                <th style="text-align: left">Media da Avaliação</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1. ASSIDUIDADE</td>
                <td>{{ $desenpenho->assiduidade }}</td>
                <td style="text-align: center">
                    {{ Str::beforeLast($desenpenho->assi_nota, ' ') }}
                </td>
            </tr>
            <tr>
                <td>2. RESPONSABILIDADE </td>
                <td>{{ $desenpenho->responsablidade }}</td>
                <td style="text-align: center">
                    {{ Str::beforeLast($desenpenho->res_nota, ' ') }}
                </td>
            </tr>
            <tr>
                <td>3. COMPRIMENTO DAS METAS </td>
                <td>{{ $desenpenho->meta }}</td>
                <td style="text-align: center">
                    {{ Str::beforeLast($desenpenho->meta_nota, ' ') }}
                </td>
            </tr>
            <tr>
                <td>4. REGISTO E REPORTE DE DADOS</td>
                <td>{{ $desenpenho->registo }}</td>
                <td style="text-align: center">
                    {{ Str::beforeLast($desenpenho->registo_nota, ' ') }}
                </td>
            </tr>
        </tbody>
    </table>
    <br><br>

    <div style="text-align: center">
        <b>FOLHA DE TABULAÇÃO</b><br><br>
        <table id="a">
            <thead style="background-color:#A9D0F5;">
                <tr>
                    <th style="text-align: center" rowspan="2">INDICADORES</th>
                    <td style="text-align: center" colspan="4"><b>Conceitos</b> (Marque com palavras correspondentes
                        / atribui a nota) a
                        cotação obtida
                        acima no indicador correspondente
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center">A ( 5 á 4 Valores)</td>
                    <td style="text-align: center">B ( 3 á 2 Valores)</td>
                    <td style="text-align: center">C ( 2 á 1 Valores)</td>
                    <td style="text-align: center">D ( 1 á 0 Valor)</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> 1. ASSIDUIDADE</td>
                    <td style="text-align: center">
                        @if (Str::beforeLast($desenpenho->assi_nota, ' ') == '4' || Str::beforeLast($desenpenho->assi_nota, ' ') == '5')
                            EXCELENTE
                        @else
                        @endif
                    </td>
                    <td style="text-align: center">
                        @if (Str::beforeLast($desenpenho->assi_nota, ' ') == '2' || Str::beforeLast($desenpenho->assi_nota, ' ') == '3')
                            BOM
                        @else
                        @endif
                    </td>
                    <td style="text-align: center">
                        @if (Str::beforeLast($desenpenho->assi_nota, ' ') == '1')
                            REGULAR
                        @else
                        @endif
                    </td>
                    <td style="text-align: center">
                        @if (Str::beforeLast($desenpenho->assi_nota, ' ') == '0')
                            INSATISFATÓRIO
                        @else
                        @endif
                    </td>
                </tr>
                <tr>
                    <td> 2. RESPONSABILIDADE </td>
                    <td style="text-align: center">
                        @if (Str::beforeLast($desenpenho->res_nota, ' ') == '4' || Str::beforeLast($desenpenho->res_nota, ' ') == '5')
                            EXCELENTE
                        @else
                        @endif
                    </td>
                    <td style="text-align: center">
                        @if (Str::beforeLast($desenpenho->res_nota, ' ') == '2' || Str::beforeLast($desenpenho->res_nota, ' ') == '3')
                            BOM
                        @else
                        @endif
                    </td>
                    <td style="text-align: center">
                        @if (Str::beforeLast($desenpenho->res_nota, ' ') == '1')
                            REGULAR
                        @else
                        @endif
                    </td>
                    <td style="text-align: center">
                        @if (Str::beforeLast($desenpenho->res_nota, ' ') == '0')
                            INSATISFATÓRIO
                        @else
                        @endif
                    </td>
                </tr>
                <tr>
                    <td> 3. COMPRIMENTO DAS METAS </td>
                    <td style="text-align: center">
                        @if (Str::beforeLast($desenpenho->meta_nota, ' ') == '4' || Str::beforeLast($desenpenho->meta_nota, ' ') == '5')
                            EXCELENTE
                        @else
                        @endif
                    </td>
                    <td style="text-align: center">
                        @if (Str::beforeLast($desenpenho->meta_nota, ' ') == '2' || Str::beforeLast($desenpenho->meta_nota, ' ') == '3')
                            BOM
                        @else
                        @endif
                    </td>
                    <td style="text-align: center">
                        @if (Str::beforeLast($desenpenho->meta_nota, ' ') == '1')
                            REGULAR
                        @else
                        @endif
                    </td>
                    <td style="text-align: center">
                        @if (Str::beforeLast($desenpenho->meta_nota, ' ') == '0')
                            INSATISFATÓRIO
                        @else
                        @endif
                    </td>
                </tr>
                <tr>
                    <td> 4. REGISTO E REPORTE DE DADOS</td>
                    <td style="text-align: center">
                        @if (Str::beforeLast($desenpenho->registo_nota, ' ') == '4' ||
                            Str::beforeLast($desenpenho->registo_nota, ' ') == '5')
                            EXCELENTE
                        @else
                        @endif
                    </td>
                    <td style="text-align: center">
                        @if (Str::beforeLast($desenpenho->registo_nota, ' ') == '2' ||
                            Str::beforeLast($desenpenho->registo_nota, ' ') == '3')
                            BOM
                        @else
                        @endif
                    </td>
                    <td style="text-align: center">
                        @if (Str::beforeLast($desenpenho->registo_nota, ' ') == '1')
                            REGULAR
                        @else
                        @endif
                    </td>
                    <td style="text-align: center">
                        @if (Str::beforeLast($desenpenho->registo_nota, ' ') == '0')
                            INSATISFATÓRIO
                        @else
                        @endif
                    </td>

                </tr>
            </tbody>
        </table><br><br>

        <div style="align-content: center">
            <table>
                <thead style="background-color:#A9D0F5;">
                    <tr>
                        <th colspan="2" style="text-align: center">Comentário do(a) Avaliador(a)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">
                            {{ $desenpenho->comentario }}
                        </td>
                    </tr>
                    <tr>
                        <td>Assinatura do(a) Avaliador(a):_______________________________________ </td>
                        <td>Data: {{ date('d-m-Y', strtotime($desenpenho->dataini)) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
