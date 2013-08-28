<html>
    <head>
        <script src="http://www.nihilogic.dk/labs/canvas2image/canvas2image.js"></script>
        <script>
            function draw(){
                var canvas = document.getElementById("thecanvas");
                var ctx = canvas.getContext("2d");
                ctx.fillStyle = "rgba(125, 46, 138, 0.5)";
                ctx.fillRect(25,25,100,100); 
                ctx.fillStyle = "rgba( 0, 146, 38, 0.5)";
                ctx.fillRect(58, 74, 125, 100);
            }

            function to_image(){
                var canvas = document.getElementById("thecanvas");
                document.getElementById("theimage").src = canvas.toDataURL();
                Canvas2Image.saveAsPNG(canvas);
            }
        </script>
    </head>
    <body onload="draw()">
        <canvas width=200 height=200 id="thecanvas"></canvas>
        <div><button onclick="to_image()">Draw to Image</button></div>
        <image id="theimage"></image>
    </body>
</html>