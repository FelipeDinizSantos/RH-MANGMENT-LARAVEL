<div class="col-6">
    <div class="border p-5 shadow-sm">
        <form action="{{ route('user.update.data') }}" method="post">
            @csrf

            <h3>Alterar suas Informações</h3>

            <hr>

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $colaborator->name) }}">
            </div>
            @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror

            <div class="mb-3">
                <label for="email" class="form-label">Email (Username)</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('name', $colaborator->email) }}">
            </div>
            @error('email')
                <div class="text-alert">
                    {{ $message }}
                </div>
            @enderror

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Atualizar Informações</button>
            </div>

        </form>

        @if (session('success_change_data'))
            <div class="alert alert-success mt-3">
                {{ session('success_change_data') }}
            </div>
        @endif
    </div>
</div>
