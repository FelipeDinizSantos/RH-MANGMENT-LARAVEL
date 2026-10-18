<x-layouts.layout-app page-title='Recursos Humanos'>

    <div class="w-100 p-4">

        <h3>Colaboradores dos Recursos Humanos</h3>

        <hr>

        @if (count($colaborators) === 0)
            <div class="text-center my-5">
                <p>Nenhum colaborador encontrado.</p>
                <a href="{{ route('colaborators.rhUsers.newColaborator') }}" class="btn btn-primary">Criar um Novo
                    Colaborador</a>
            </div>
        @else
            <div class="mb-3">
                <a href="{{ route('colaborators.rhUsers.newColaborator') }}" class="btn btn-primary">Criar um Novo
                    Colaborador</a>
            </div>

            <table class="table" id="table">
                <thead class="table-dark">
                    <th>
                        Nome
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Ativo
                    </th>
                    <th>
                        Departamento
                    </th>
                    <th>
                        Perfil
                    </th>
                    <th>
                        Data de Admissão
                    </th>
                    <th>
                        Salário
                    </th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($colaborators as $colaborator)
                        <tr>
                            <td>{{ $colaborator->name }}</td>
                            <td>{{ $colaborator->email }}</td>
                            <td>
                                <span class="badge bg-{{ $colaborator->ativo ? 'success' : 'danger' }}">
                                    {{ $colaborator->ativo ? 'Sim' : 'Não' }}
                                </span>
                            </td>
                            <td> {{ $colaborator->department->name }} </td>
                            <td>{{ $colaborator->role }}</td>
                            <td>{{ \Carbon\Carbon::parse($colaborator->details->admission_date)->format('d/m/Y') }}
                            </td>
                            <td>R$ {{ $colaborator->details->salary }}</td>
                            <td>
                                @empty($colaborator->deleted_at)
                                    <div class="d-flex gap-3 justify-content-end">
                                        <a href="{{ route('colaborators.rhUsers.editRhColaborator', ['id' => $colaborator->id]) }}"
                                            class="btn btn-sm btn-outline-dark"><i
                                                class="fa-regular fa-pen-to-square me-2 ms-3"></i>Editar</a>
                                        <a href="{{ route('colaborators.rhUsers.delete-rh-user', ['id' => $colaborator->id]) }}"
                                            class="btn btn-sm btn-outline-dark"><i
                                                class="fa-regular fa-trash-can me-2 ms-3"></i>Remover</a>
                                    </div>
                                @else
                                    <div class="d-flex gap-3 justify-content-center">
                                        <a href="{{ route('colaborators.rhUsers.restore', ['id' => $colaborator->id]) }}"
                                            class="btn btn-sm btn-outline-dark"><i
                                                class="fa-solid fa-trash-arrow-up me-2 ms-3"></i>Restaurar</a>
                                    </div>
                                @endempty
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endempty
</div>
</x-layouts.layout-app>
