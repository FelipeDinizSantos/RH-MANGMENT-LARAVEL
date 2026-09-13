<x-layouts.layout-app page-title='Remover Departamento'>
    <div class="w-25 p-4">

        <h3>Remover Departamento</h3>

        <hr>

        <p>Tem certeza que deseja remover este departamento?</p>

        <div class="d-flex gap-3 flex-column text-center">
            <h3 class="my-5">{{ $department->name }}</h3>
            <a href="{{ route('department.index') }}" class="btn btn-secondary px-5">Cancelar</a>
            <a href="{{ route('department.confirmDelete', $department->id) }}" class="btn btn-danger px-5">Confirmar</a>
        </div>

    </div>
</x-layouts.layout-app>
