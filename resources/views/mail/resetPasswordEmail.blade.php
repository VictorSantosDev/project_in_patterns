@component('mail::message')
    <h1>Olá, <strong>{{ $name }}</strong></h1>
        <p>
            Ops!!! esqueceu a senha ? <span style="color: #a7d02f;">NEXTBANK</span> vai te ajudar.
        </p>
        <br>
        <p>
            Caso voçê não tenha solicitado o resete de senha, por favor
            ignore esse e-mail.
            <br>
            Para resetar a senha é bem simples, é só clicar no botão do 
            resete de senha.
        </p>

    @component('mail::button', ['url' => $urlHttpHost])
        Resetar Senha
    @endcomponent

@endcomponent