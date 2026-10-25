<x-layout-app page-title="Remover Colaborador">

    <div class="w-25 p-4">

        <h3>Remover colaborador</h3>

        <hr>

        <p>Você tem certeza que deseja remover este colaborador?</p>

        <div class="d-flex flex-column justify-content-center gap-2">
            <h3 class="my-5">{{ $colaborator->name }}</h3>
            <p>{{ $colaborator->email }}</p>
            <a href="{{ route('rh.management.home') }}" class="btn btn-secondary px-5">Cancelar</a>
            <a href="{{ route('rh.management.delete-confirm', $colaborator->id) }}" class="btn btn-danger px-5">Sim,
                remover!</a>
        </div>

    </div>

</x-layout-app>
