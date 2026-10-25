<x-layouts.layout-app page-title="Atualizar Colaborador">
    <div class="w-100 p-4">

        <h3>Atualizar Colaborador</h3>

        <hr>

        <form action="{{ route('rh.management.updateColaborator') }}" method="post">
            @csrf

            <div class="d-flex gap-2">
                <p>Nome: <strong>{{ $colaborator->name }}</strong></p>
                |
                <p>E-mail: <strong>{{ $colaborator->email }}</strong></p>
            </div>

            <hr>

            <input type="hidden" name="user_id" value="{{ $colaborator->id }}">

            <div class="container-fluid">
                <div class="row gap-3">

                    <div class="col border border-black p-4">

                        <div class="col">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="salary" class="form-label">Salário</label>
                                    <input type="number" class="form-control" id="salary" name="salary"
                                        step=".01" placeholder="0,00"
                                        value="{{ old('salary', $colaborator->details->salary) }}">
                                    @error('salary')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label for="admission_date" class="form-label">Data de Adimissão</label>
                                <input type="text" class="form-control" id="admission_date" name="admission_date"
                                    placeholder="YYYY-mm-dd"
                                    value="{{ old('admission_date', $colaborator->details->admission_date) }}">
                                @error('admission_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label for="select_department">Departamento</label>
                                <select name="select_department" id="select_department" class="form-select">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ $colaborator->department->id === $department->id ? 'selected' : ''}}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('select_department')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                <div class="mt-3">
                    <a href="{{ route('rh.management.home') }}" class="btn btn-outline-danger me-3">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>

            </div>

        </form>

    </div>
</x-layouts.layout-app>
