<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ranking Alternatif</title>

    <style>
        table {
            width: 100%;
        }

        td, th {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <center>
        Daftar Karyawan Terbaik
    </center>
    <br />
    <table cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th width="5%">Ranking</th>
                <th width="70%">Nama Alternatif</th>
                <th width="25%">Nilai Hasil</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['sum'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>