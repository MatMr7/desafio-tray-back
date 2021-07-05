<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Comprovante</title>
</head>
<!-- style="display: flex; align-items:  center; justify-content: cener; width:  500px ;" -->

<!-- style="display: flex; align-items: center; justify-content: center; flex-direction: column; width: 500px; text-align: center; word-wrap: break-word;" -->
<body style="text-align:  center; width:  500px ;">
        <div class="body" style="width: 350px; text-align: center; word-wrap:  break-word;">
            <span class="title" style="color: #10104F; font-weight: 700; font-size: 21px; font-family: 'DM Sans', sans-serif; margin-top: 20px; margin-bottom: 41px;">
                <h1>Vendas nas ultimas 24 horas: </h1>
            </span>
        <table style="margin-top: 10px; list-style-type: none;
        ">
            <tbody>
                @foreach ($sales as $sale)
                <tr>
                    <ul style="list-style-type: none;">
                        <li>
                            <span class="title" style="color: #10104F; font-weight: 700; font-size: 21px; font-family: 'DM Sans', sans-serif; margin-top: 20px; margin-bottom: 41px;">
                                <b>Vendedor: </b>{{ $sale['seller_email'] }}
                            </span>
                        </li>
                        <li>
                            <span class="title" style="color: #10104F; font-weight: 700; font-size: 21px; font-family: 'DM Sans', sans-serif; margin-top: 20px; margin-bottom: 41px;">
                                <b>Valor: R$</b>{{ $sale['sale_value'] }}
                            </span>
                        </li>
                    </ul>
                    </tr>
                    @endforeach
        </tbody>

        </table>

        <span class="title" style="color: #10104F; font-weight: 700; font-size: 21px; font-family: 'DM Sans', sans-serif; margin-top: 20px; margin-bottom: 41px;">
            <b>Total: R$</b>{{ $total }}
        </span>



        </div>
    </body>
</html>
