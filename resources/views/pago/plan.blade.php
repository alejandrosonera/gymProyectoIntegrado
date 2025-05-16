<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">💳 Pago Plan {{ $plan }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
            <form action="{{ route('pago.procesar') }}" method="POST" id="payment-form">
                @csrf

                <input type="hidden" name="total" value="{{ $total }}">
                <input type="hidden" name="plan" value="{{ $plan }}">

                <label for="card-element" class="block text-sm font-medium mb-2">Tarjeta de crédito</label>
                <div id="card-element" class="mb-4 p-2 border rounded"></div>

                <button
                    type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow w-full"
                >
                    Pagar {{ number_format($total, 2) }} €
                </button>
            </form>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const {token, error} = await stripe.createToken(card);

            if (error) {
                alert(error.message);
            } else {
                // Agregar el token al formulario y enviarlo
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
