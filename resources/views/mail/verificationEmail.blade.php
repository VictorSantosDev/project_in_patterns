@component('mail::message')
    <h1>Olá, <strong>{{ $name }}</strong></h1>
        <p>
            Você agora é um <span style="color: #a7d02f;">NEXTBANK</span>
        </p>
        <br>
        <p>
            Antes de tudo, gostaria de agradecer por você 
            está fazendo parte do teste deste sistema, muito obrigado!
        </p>
    @component('mail::button', ['url' => $urlHttpHost])
        Verifique sua conta!
    @endcomponent

@endcomponent