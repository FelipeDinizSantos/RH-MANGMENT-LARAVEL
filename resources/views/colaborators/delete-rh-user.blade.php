<x-layouts.layout-app page-title='Remover Colaborador'>
    <div class="w-25 p-4">

        <h3>Remover Colaborador</h3>

        <hr>

        <p>Tem certeza que deseja remover este colaborador?</p>

        <div class="d-flex gap-3 flex-column text-center">
            <h3 class="my-5">{{ $colaborator->name }}</h3>
            <a href="{{ route('colaborators.rhUsers.index') }}" class="btn btn-secondary px-5">Cancelar</a>
            <a href="{{ route('colaborators.rhUsers.confirmDelete', $colaborator->id) }}" class="btn btn-danger px-5">Confirmar</a>
        </div>

    </div>
</x-layouts.layout-app>
