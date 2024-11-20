<x-master>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <style>
        table {
            width: 100%;
            color: white;
            /* Set text color to white */
        }

        th,
        td {
            padding: 8px;
            /* Add padding for better spacing */
            text-align: left;
            /* Align text to the left */
        }

        tr:nth-child(even) {
            background-color: #333;
            /* Alternate row color */
        }

        tr:nth-child(odd) {
            background-color: #444;
            /* Alternate row color */
        }
    </style>
    <table>
        <a class="btn btn-success mb-3" href="{{route('categories.create')}}">Create </a>
        <!-- <a class="btn btn-primary  ml-3 mb-3" href="#">get category from project 2 </a> -->
        <tr>
            <th>Name</th>
            <th>Time</th>
            <th>Actions</th>
        </tr>
        @foreach($data['categories'] as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>{{ $category->time}}</td>
            <td>
                <div class="d-flex">
                    <a class="btn btn-primary" href="{{ route('categories.edit', $category->id) }}">Edit</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class=" ml-3 btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            </td>

        </tr>
        @endforeach
    </table>
</x-master>