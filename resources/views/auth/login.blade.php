<x-guest-layout>

    <h3 class="text-center mb-4">
        Login
    </h3>

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form method="POST" action="/login">

        @csrf

        <div class="mb-3">

            <label>Email</label>

            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                required
            >

        </div>

        <div class="mb-3">

            <label>Senha</label>

            <input
                type="password"
                name="password"
                class="form-control"
                required
            >

        </div>

        <div class="d-grid">

            <button class="btn btn-primary">
                Entrar
            </button>

        </div>

    </form>

    <div class="text-center mt-3">

        <a href="/register">
            Criar conta
        </a>

    </div>

</x-guest-layout>
