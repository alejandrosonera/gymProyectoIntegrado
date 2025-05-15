<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">💳 Pago</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-md mx-auto">
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-500 text-white rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('pago.procesar') }}" method="POST" id="payment-form">
                @csrf

                <label for="card-element" class="block text-sm font-medium mb-2">Tarjeta de crédito</label>
                <div id="card-element" class="mb-4 p-2 border rounded"></div>

                <input type="hidden" name="total" value="{{ $total }}">

                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">
                    Pagar {{ number_format($total, 2) }} €
                </button>
            </form>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ config("services.stripe.key") }}');
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            const { token, error } = await stripe.createToken(card);
            if (error) {
                alert(error.message);
            } else {
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                form.submit();
            }
        });
    </script>
</x-app-layout>
