<x-layouts.layout-app page-title='Departamentos'>

    <div class="w-100 p-4">

        <h3>Departamentos</h3>

        <hr>

        @if(count($departments) === 0)
            <div class="text-center my-5">
                <p>Nenhum departamento encontrado.</p>
                <a href="{{ route('department.new') }}" class="btn btn-primary">Criar um Novo Departamento</a>
            </div>
        @else
            <div class="mb-3">
                <a href="{{ route('department.new') }}" class="btn btn-primary">Criar um Novo Departamento</a>
            </div>

            <table class="table w-50" id="table">
                <thead class="table-dark">
                    <th>Departamentos</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                        <tr>
                            <td>{{ $department->name }}</td>
                            <td>
                                <div class="flex gap-3 justify-content-end">
                                    @if ($department->id === 1)
                                        <i class="fa-solid fa-lock"></i>
                                    @else
                                        <a href="{{ route('department.edit', $department->id) }}" class="btn btn-sm btn-outline-dark"><i
                                                class="fa-regular fa-pen-to-square me-2"></i>Editar</a>
                                        <a href="{{ route('department.delete', $department->id) }}" class="btn btn-sm btn-outline-dark"><i
                                                class="fa-regular fa-trash-can me-2"></i>Remover</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endempty
    </div>
</x-layouts.layout-app>
