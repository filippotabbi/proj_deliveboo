<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel=“preconnect” href=“https://fonts.googleapis.com”>
    <link rel=“preconnect” href=“https://fonts.gstatic.com” crossorigin>
    <link
        href=“https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap”
        rel=“stylesheet”>
    <title>Il tuo ordine</title>
</head>
<style>
    * {
        margin: 0;
        border: 0;
        box-sizing: border-box;
        font-family: ‘Montserrat’, sans-serif;
    }

    header {
        height: 80px;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #c06632;
    }

    header h1 {
        color: #fff;
    }

    .mail-top {
        height: 150px;
        width: 100%;
        padding: 50px;
        background-color: #df814a;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .mail-top h1 {
        color: #fff;
        font-size: 32px;
    }

    table {
        border-collapse: collapse;
        color: #3e281c;
    }

    td,
    th {
        border: none;
        text-align: left;
        padding: 5px 0;
    }

    .text-right {
        text-align: right;
    }

    .text-uppercase {
        text-transform: uppercase;
    }

    .mail-content {
        padding: 50px;
    }

    h3,
    h4 {
        color: #3e281c;
        margin-bottom: 15px;
    }

</style>

<body>
    <header>
        <h1>deliveboo</h1>
    </header>
    <section class="mail-top">
        <h1>"{{ $restaurant }}" ha ricevuto il tuo ordine!</h1>
    </section>

    <section class="mail-content">
        <h3>Il tuo ordine è in preparazione</h3>
        <h4>ID transazione: <span class="text-uppercase">{{ $transaction }}</span></h4>
        <table>
            <tr>
                <th>Piatto</th>
                <th>Quantità</th>
            </tr>
            @foreach ($dishes as $dish)
                <tr>
                    <td>{{ $dish['name'] }}</td>
                    <td class="text-right">x{{ $dish['quantity'] }}</td>
                </tr>
            @endforeach
        </table>
        <h4>Prezzo totale: €{{ $amount }}</h4>
    </section>
</body>

</html>
