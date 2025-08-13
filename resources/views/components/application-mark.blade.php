@props(['class' => ''])

<div class="application-mark-container">
    <!-- Logo para tema claro -->
    <img
        src="{{ asset('build/assets/img/logocontraloria.png') }}"
        alt="Logo Contraloría Municipal"
        class="application-mark-light {{ $class }}"
        style="display: none;"
    >

    <!-- Logo para tema oscuro -->
    <img
        src="{{ asset('build/assets/img/logocontraloria_white.png') }}"
        alt="Logo Contraloría Municipal"
        class="application-mark-dark {{ $class }}"
        style="display: none;"
    >
</div>
