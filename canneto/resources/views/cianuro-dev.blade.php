<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cianuro-Dev</title>
  @vite(['resources/scss/cianuro-dev.scss'])
</head>
<body>
  <div class="video-background">
    <video autoplay muted loop id="bg-video">
      <source src="{{ asset('storage/video/cianuroDev.mp4') }}" type="video/mp4">
      Your browser does not support the video tag.
    </video>
    <div class="content">
        
  </div>

  <div id="chat-box" class="chat-box hidden">
    <div class="chat-message" id="question">OGGI CI STA GENTE?</div>
    <input type="text" id="user-input" class="chat-input" placeholder="Inserisci la tua risposta">
    <button id="submit-btn" class="chat-submit">Invia</button>
  </div>

  @vite(['resources/js/cianuro-dev.js'])
</body>
</html>
