<x-layouts.layout-app page-title='Adicionar Novo Departamento'>

    <div class="w-25 p-4">

        <h3>Novo Departamento</h3>

        <hr>

        <form action="{{ route('department.create') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome do Departamento</label>
                @error('name')
                    <div class="text-danget">
                        {{ $message }}
                    </div>
                @enderror
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <a href="{{ route('department.index') }}" class="btn btn-outline-danger me-3">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary">Criar</button>
            </div>

        </form>

    </div>

</x-layouts.layout-app>
