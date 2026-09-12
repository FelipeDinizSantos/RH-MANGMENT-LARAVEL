<div class="col-6">
    <div class="border p-5 shadow-sm">
        <form action="{{ route('user.update.updatePassword') }}" method="post">
            @csrf

            <h3>Altere sua Senha</h3>

            <div class="mb-3">
                <label for="current_password" class="form-label">Senha Atual</label>
                <input type="password" name="current_password" id="current_password" class="form-control">
            </div>
            @error('current_password')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror

            <div class="mb-3">
                <label for="new_password" class="form-label">Nova Senha</label>
                <input type="password" name="new_password" id="new_password" class="form-control">
            </div>
            @error('new_password')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror

            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">Confirme sua Senha</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                    class="form-control">
            </div>
            @error('new_password_confirmation')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Atualizar Senha</button>
            </div>

        </form>

        @if (session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>
