<x-layouts.layout-app page-title='Recursos Humanos'>

    <div class="w-100 p-4">

        <h3>Colaboradores dos Recursos Humanos</h3>

        <hr>

        @if(count($colaborators) === 0)
            <div class="text-center my-5">
                <p>Nenhum colaborador encontrado.</p>
                <a href="{{ route('colaborators.rhUsers.newColaborator') }}" class="btn btn-primary">Criar um Novo Colaborador</a>
            </div>
        @else
            <div class="mb-3">
                <a href="{{ route('colaborators.rhUsers.newColaborator') }}" class="btn btn-primary">Criar um Novo Colaborador</a>
            </div>

            <table class="table" id="table">
                <thead class="table-dark">
                    <th>
                        Nome
                    </th>
                    <th>
                        Emails
                    </th>
                    <th>
                        Perfil
                    </th>
                    <th>
                        Salário
                    </th>
                    <th>
                        Permissões
                    </th>
                    <th>
                        Data de Admissão
                    </th>
                    <th>
                        Cidade
                    </th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($colaborators as $colaborator)
                        <tr>
                            <td>{{ $colaborator->name }}</td>
                            <td>{{ $colaborator->email }}</td>
                            <td>{{ $colaborator->role }}</td>
                            <td>R$ {{ $colaborator->details->salary }}</td>
                            <td>{{ implode(',', $colaborator->permissions) }}</td>
                            <td>{{ \Carbon\Carbon::parse($colaborator->details->admission_date)->format('d/m/Y') }}</td>
                            <td>{{ $colaborator->details->city }}</td>
                            <td>
                                <div class="d-flex gap-3 justify-content-end">
                                    <a href="{{ route('colaborators.rhUsers.editRhColaborator', ['id' => $colaborator->id]) }}" class="btn btn-sm btn-outline-dark"><i
                                            class="fa-regular fa-pen-to-square me-2 ms-3"></i>Editar</a>
                                    <a href="{{ route('colaborators.rhUsers.delete-rh-user', ['id' => $colaborator->id]) }}" class="btn btn-sm btn-outline-dark"><i
                                            class="fa-regular fa-trash-can me-2 ms-3"></i>Remover</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endempty
    </div>
</x-layouts.layout-app>
