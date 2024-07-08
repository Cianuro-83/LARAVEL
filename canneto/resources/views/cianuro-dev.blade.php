<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
   @vite(['resources/js/cianuro-dev.js'])
</body>
</html>