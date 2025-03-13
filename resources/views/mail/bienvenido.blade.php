<x-mail::message>
# Bienvenido {{ $name }} a UTCJ Sustentable

Estas seran tus credenciales de acceso:

<x-mail::button :url="''">
Button Text
</x-mail::button>

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
