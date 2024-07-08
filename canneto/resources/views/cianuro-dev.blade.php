<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cianuro-Dev</title>
    <!-- Carica gli stili SCSS utilizzando Vite -->
    @vite(['resources/scss/cianuro-dev.scss'])
</head>
<body>
    <div class="video-background">
        <video autoplay muted loop id="bg-video">
            <source src="{{ asset('storage/video/cianuroDev.mp4') }}" type="video/mp4">
            Il tuo Browser Non Supporta i video
        </video>
        <div class="content">

        </div>
    </div>

    <div id="chat-box" class="chat-box hidden">
        <div class="chat-message" id="question">Ciao, come posso aiutarti?</div>
        <form action="{{ route('check.answer') }}" method="POST" id="answer-form">
            @csrf
            <input type="text" id="user-input" name="user_response" required class="chat-input" placeholder="Chiedi a <Cianuro Dev/>">
            <button type="submit" id="submit-btn" class="chat-submit">Chiedi</button>
        </form>
       
        @error('message')
            <div class="error-message ">{{ $message }}</div>
        @enderror
    </div>

    
    @vite(['resources/js/cianuro-dev.js'])
</body>
</html>
