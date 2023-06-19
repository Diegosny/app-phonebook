<x-mail::message>
    # Olá, {{ ucwords($data['name'])  }}

    @component('mail::button', ['url' => config('app.vexpenses_url')])
       Vexpenses
    @endcomponent

    Obrigado,<br>
    {{ config('app.name') }}
</x-mail::message>
