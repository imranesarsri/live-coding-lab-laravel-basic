<table class="table table-striped text-nowrap table-tasks">
    <thead>
        <tr>
            <th>Tâche</th>
            <th>Projet</th>
            <th>Description</th>
            {{-- <th>Actions</th> --}}
        </tr>
    </thead>
    <tbody>

        @foreach ($Tasks as $Task)
            <tr>
                <td>{{ $Task->name }}</td>
                <td>{{ $Task->project->name }}</td>
                <td>{{ $Task->description }}</td>

            </tr>
        @endforeach

    </tbody>
</table>
