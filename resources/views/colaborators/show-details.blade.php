<x-layout-app page-title="Detalhes do Colaborador">

    <div class="w-100 p-4">

        <h3>Detalhes do Colaborador</h3>

        <hr>

        <div class="container-fluid">
            <div class="row mb-3">

                <div class="col">

                    <p>Nome: <strong>{{ $colaborator->name }}</strong></p>
                    <p>Email: <strong>{{ $colaborator->email }}</strong></p>
                    <p>Perfil: <strong>{{ $colaborator->role }}</strong></p>
                    <p>Permissões: </p>

                    @php
                        $permissions = $colaborator->permissions;
                    @endphp

                    <ul>
                        @foreach ($permissions as $permission)
                            <li>{{ $permission }}</li>
                        @endforeach
                    </ul>

                    <p>Departamento: <strong>{{ $colaborator->department->name ?? '-' }}</strong></p>
                    <p>Ativo: 
                        @if($colaborator->ativo)
                            <span class="badge bg-success">Sim</span>
                        @else 
                            <span class="badge bg-danger">Não</span>
                        @endif
                    </p>
                </div>

                <div class="col">
                    <p>Endereço: <strong>{{ $colaborator->details->address }}</strong></p>
                    <p>CEP: <strong>{{ $colaborator->details->zip_code }}</strong></p>
                    <p>Cidade: <strong>{{ $colaborator->details->city }}</strong></p>
                    <p>Telefone: <strong>{{ $colaborator->details->phone }}</strong></p>
                    <p>Data de Admissão: <strong>{{ $colaborator->details->admission_date }}</strong></p>
                    <p>Salário: R$ <strong>{{ $colaborator->details->salary }}</strong></p>
                </div>
            </div>
        </div>

        <button 
            class="btn btn-outline-dark"
            onclick="window.history.back()">
            <i class="fas fa-arrow-left me-2"></i>
            Voltar
        </button>

    </div>

</x-layout-app>