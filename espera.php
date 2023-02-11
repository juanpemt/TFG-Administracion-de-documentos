<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descargando</title>
    <style>
html,
body {
  background-color: #240F52; 
  background-image: linear-gradient(0deg, #36295e, #1c1045);
  height: 100%;
  overflow: hidden;
  display:flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: center;
  align-content: flex-start;
  align-items: center;
}

.center {
  margin: 0 auto;
}

.outer-ring {
  position: absolute;
  left: calc(50% - 150px);
  height: 300px;
  width: 300px;
  background-image: linear-gradient(135deg, #FEED07 0%, #FE6A50 5%, #ED00AA 15%, #2FE3FE 50%, #8900FF 100%);
  border-radius: 50%;
  
  /*  Rotate  */
  animation-duration: 2s;
  animation-name: rotate;
  animation-iteration-count: infinite;
}

.inner-ring {
  position: absolute;
  left: calc(50% - 140px);
  height: 280px;
  width: 280px;
  background-image: linear-gradient(0deg, #36295e, #1c1045);
  border-radius: 50%;
}

@keyframes rotate {
    0% {transform:rotate(0deg);}
    100% {transform:rotate(360deg);}
}

    </style>
</head>
<body>
<div class="outer-ring center"></div>
<div class="inner-ring center"></div>
</body>
</html>
