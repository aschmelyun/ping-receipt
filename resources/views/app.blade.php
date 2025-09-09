<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send a Receipt Message</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #d8f6ed;
            background-image: radial-gradient(circle at 15% 85%, hsla(318, 80%, 97%, 1) 19%, transparent 84%), radial-gradient(circle at 31% 1%, hsla(161.47058823529412, 99%, 84%, 1) 12%, transparent 85%), radial-gradient(circle at 88% 87%, hsla(163, 90%, 78%, 1) 3.6400864520532363%, transparent 75.20902830975928%), radial-gradient(circle at 30% 27%, hsla(314, 91%, 59%, 1) 14%, transparent 90%);
            background-blend-mode: normal, normal, normal, normal;
        }
        .receipt:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/images/paper.jpg') no-repeat center center;
            background-size: 100%;
            opacity: 0.5;
            z-index: 2;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-start md:items-center justify-center p-4 font-mono">
    <div class="w-full max-w-md">

        <div class="mb-4 space-y-2">
            @session('success')
                <div class="bg-teal-50 text-sm border border-teal-200 text-teal-700 px-4 py-3 rounded-lg flex items-center gap-2" role="alert">
                    <span>😁 {{ session('success') }}</span>
                </div>
            @endsession

            @error('message')
                <div class="bg-rose-50 text-sm border border-rose-200 text-rose-700 px-4 py-3 rounded-lg flex items-center gap-2" role="alert">
                    <span>🙃 {{ $message }}</span>
                </div>
            @enderror
        </div>

        {{-- Receipt Container --}}
        <div class="relative bg-white receipt shadow-2xl pt-6 pb-6">
            <div class="relative z-10">

                {{-- Receipt Header --}}
                <div class="px-6 pb-4 border-b-2 border-gray-300 border-dashed">
                    <div class="text-center">
                        <div class="text-2xl font-bold mb-0 tracking-wide">PING</div>
                        <div class="text-xs text-gray-600 uppercase tracking-wider">Message for Andrew Schmelyun</div>
                    </div>
                </div>

                {{-- Receipt Body --}}
                <div class="px-6 py-4">
                    <div class="text-xs text-gray-600 mb-1">
                        <div class="flex justify-between">
                            <span>TIMESTAMP:</span>
                            <span id="current-time">{{ $timestamp }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>TRANSACTION #:</span>
                            <span>{{ $transaction }}</span>
                        </div>
                    </div>

                    <div class="border-b border-gray-300 border-dashed my-3 py-3">
                        <form action="{{ route('send-message') }}" method="POST" class="space-y-3" id="messageForm">
                            @csrf

                            <div>
                                <textarea
                                    name="message"
                                    id="message"
                                    rows="6"
                                    cols="42"
                                    maxlength="1024"
                                    placeholder="Type your message here..."
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring focus:ring-gray-700 focus:border-transparent resize-none"
                                    oninput="updateCharCount()"
                                    pattern="[\x00-\x7F]*"
                                >{{ old('message') }}</textarea>
                                <input type="hidden" id="transaction" name="transaction" value="{{ $transaction }}">
                            </div>

                            {{-- Character Counter --}}
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-gray-500">MAX: 1024 CHARS</span>
                                <span id="char-count" class="font-bold">0 / 1024</span>
                            </div>
                        </form>
                    </div>

                    {{-- Receipt Footer Info --}}
                    <div class="text-xs text-gray-600 space-y-1 mb-4">
                        <div class="text-center">***************************************</div>
                        <div class="text-center font-bold">THANKS FOR STOPPING BY</div>
                        <div class="text-center">Your message will be sent to my desk</div>
                        <div class="text-center">***************************************</div>
                    </div>

                    {{-- Submit Button --}}
                    <button
                        type="submit"
                        onClick="document.getElementById('messageForm').submit()"
                        class="w-full bg-gray-900 text-white py-3 px-4 rounded hover:bg-teal-400 hover:cursor-pointer transition-colors duration-150 font-bold text-sm tracking-wider focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                    >
                        Send ➤
                    </button>
                </div>
            </div>
        </div>
        <div class="text-center text-xs py-4 opacity-50">
            <p class="mb-1">Basic text only (no emojis, special symbols, etc)</p>
            <p>Printer text width is 42 characters wide</p>
        </div>
    </div>

    <script>
        // Update character count
        function updateCharCount() {
            const textarea = document.getElementById('message');
            const charCount = document.getElementById('char-count');
            const currentLength = textarea.value.length;

            charCount.textContent = `${currentLength} / 1024`;

            // Change color based on remaining characters
            if (currentLength > 900) {
                charCount.classList.add('text-red-600');
                charCount.classList.remove('text-yellow-600');
            } else if (currentLength > 700) {
                charCount.classList.add('text-yellow-600');
                charCount.classList.remove('text-red-600');
            } else {
                charCount.classList.remove('text-red-600', 'text-yellow-600');
            }
        }
    </script>
</body>
</html>
