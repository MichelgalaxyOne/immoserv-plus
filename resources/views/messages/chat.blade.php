<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            💬 Chat — {{ $demande->service->titre }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4">
            <div class="bg-white rounded-lg shadow overflow-hidden">

                {{-- Messages --}}
                <div id="messages-box" style="height:450px; overflow-y:auto; padding:20px;">
                    @foreach($messages as $msg)
                        <div class="d-flex mb-3 {{ $msg->sender_id === auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                            <div style="max-width:70%">
                                <div class="small text-muted mb-1">
                                    {{ $msg->sender->name }} · {{ $msg->created_at->format('H:i') }}
                                </div>
                                <div class="px-3 py-2 rounded-3 {{ $msg->sender_id === auth()->id() ? 'bg-primary text-white' : 'bg-light' }}">
                                    {{ $msg->contenu }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Formulaire --}}
                <div class="border-top p-3">
                    <div class="d-flex gap-2">
                        <input type="text" id="message-input" class="form-control"
                            placeholder="Écrire un message...">
                        <button id="send-btn" class="btn btn-primary">Envoyer</button>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">← Retour</a>
            </div>
        </div>
    </div>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        const demandeId = {{ $demande->id }};
        const userId = {{ auth()->id() }};
        const sendUrl = "{{ route('messages.store', $demande) }}";
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Scroll en bas
        const box = document.getElementById('messages-box');
        box.scrollTop = box.scrollHeight;

        // Envoyer message
        document.getElementById('send-btn').addEventListener('click', sendMessage);
        document.getElementById('message-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') sendMessage();
        });

        function sendMessage() {
            const input = document.getElementById('message-input');
            const contenu = input.value.trim();
            if (!contenu) return;

            fetch(sendUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ contenu })
            })
            .then(res => res.json())
            .then(msg => {
                appendMessage(msg, true);
                input.value = '';
            });
        }

        function appendMessage(msg, isMine) {
            const div = document.createElement('div');
            div.className = 'd-flex mb-3 ' + (isMine ? 'justify-content-end' : 'justify-content-start');
            div.innerHTML = `
                <div style="max-width:70%">
                    <div class="small text-muted mb-1">${msg.sender} · ${msg.created_at}</div>
                    <div class="px-3 py-2 rounded-3 ${isMine ? 'bg-primary text-white' : 'bg-light'}">
                        ${msg.contenu}
                    </div>
                </div>`;
            box.appendChild(div);
            box.scrollTop = box.scrollHeight;
        }

        // Reverb temps réel
        Pusher.logToConsole = true;
        const pusher = new Pusher("{{ config('broadcasting.connections.reverb.key') }}", {
            wsHost: "127.0.0.1",
            wsPort: 8080,
            wssPort: 8080,
            forceTLS: false,
            enabledTransports: ['ws', 'wss'],
            cluster: 'mt1',
            authEndpoint: '/broadcasting/auth',
            auth: {
                headers: {
                    'X-CSRF-TOKEN': token
                }
            }
        });

        const channel = pusher.subscribe('private-demande.' + demandeId);

        channel.bind('pusher:subscription_succeeded', function() {
            console.log('✅ Connecté au canal demande.' + demandeId);
        });

        channel.bind('pusher:subscription_error', function(err) {
            console.error('❌ Erreur canal:', err);
        });

        channel.bind('MessageEnvoye', function(data) {
            console.log('📩 Message reçu:', data);

            // Ignore l'événement si c'est moi-même qui ai envoyé ce message
            // (déjà affiché par appendMessage dans sendMessage())
            if (data.sender_id === userId) {
                return;
            }

            appendMessage(data, false);
        });
    </script>
</x-app-layout>