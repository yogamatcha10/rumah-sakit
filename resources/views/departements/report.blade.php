@section('content')
<h1>Departement Report</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Location</th>
            <th>Manager ID</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($departements as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->location }}</td>
                <td>{{ $item->manager_id }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<form action="{{ url('/report/generate') }}" method="post">
    @csrf
    <button type="submit">Generate Report</button>
</form>
@endsection