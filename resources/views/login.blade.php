<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=@, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }} </li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('validation') }}">
        @csrf
        <label for="email">Nome</label>
        <input type="email" id="email" name="email"> 
        <br>

        <label for="password">Senha</label>
        <input type="password" id="password" name="password"> 
        <br>

        <label for="birth_year">Ano nascimento</label>
        <input type="text" id="birth_year" name="birth_year"> 
        <br>

        <button type="submit">Login</button>
    </form>
</body>
</html>