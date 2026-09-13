<x-layouts.layout-app page-title='Editar Departamento'>

    <div class="w-25 p-4">

        <h3>Editar Departamento</h3>

        <hr>

        <form action="{{ route('department.update') }}" method="post">
            @csrf

            <input type="hidden" name="id" value="{{ $department->id }}">

            <div class="mb-3">
                <label for="name" class="form-label">Nome do Departamento</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $department->name) }}" required>
                @error('name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <a href="{{ route('department.index') }}" class="btn btn-outline-danger me-3">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary">Editar</button>
            </div>

        </form>

    </div>

</x-layouts.layout-app>
