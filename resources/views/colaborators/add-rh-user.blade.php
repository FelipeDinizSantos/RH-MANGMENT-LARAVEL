<x-layouts.layout-app page-title='Adicionar novo Colaborador aos Recursos Humanos'>
    <div class="w-100 p-4">

        <div class="container-fluid">
            <div class="row">
                <div class="col-4">

                    <h3>Adicionar novo Colaborador aos Recursos Humanos</h3>

                    <hr>

                    <form action="{{ route('colaborators.rhUsers.createColaborator') }}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="d-flex">
                                <div class="flex-grow-1 pe-3">
                                    <label for="select_departments" class="form-label">Departamentos</label>
                                    <select name="select_departments" class="form_select" id="departments">
                                        @foreach ($departments as $department)
                                            @if ($department->id !== 1)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('select_departments')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <a href="{{ route('department.new') }}" class="btn btn-outline-primary mt-4">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <p class="mb-3">Perfil: <strong>Recursos Humanos</strong></p>

                        <div class="mb-3">
                            <a href="{{ route('colaborators.rhUsers.index') }}"
                                class="btn btn-outline-danger me-3">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Criar</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>


    </div>
</x-layouts.layout-app>
