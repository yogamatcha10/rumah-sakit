<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Departemen</title>
    <style>
        /* Style untuk header */
        .header {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Style untuk tabel */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            
        }

        th {
            background-color: #f2f2f2;
        }
        td {
            align: center;
        }

    </style>
</head>
<body>
    <div class="header">Laporan Departemen</div>

    <table class="table text-center">
        <thead>
        <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Lokasi</th>
            <th scope="col">Manager ID</th>
        </tr>
        </thead>
        <tbody class="text-center text-justify" style="line-height: 1.9 em;">
        <?php $i = 1; ?>
        @foreach ($departements as $item)
            <tr class="text-center">
                <td>{{ $i++ }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->location }}</td>
                <td>{{ $item->manager_id }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
