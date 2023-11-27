<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <div class="shadow col-md-3 p-3 mx-auto mb-3">
            <h5 class="text-center">Simule quanto você precisa na PROVA FINAL</h5>
            <label>1º BIMESTRE</label>
            <input type="text" class="form-control" id="b1">
            <label>2º BIMESTRE</label>
            <input type="text" class="form-control" id="b2">
            <label>3º BIMESTRE</label>
            <input type="text" class="form-control" id="b3">
            <label>4º BIMESTRE</label>
            <input type="text" class="form-control" id="b4">
            <button class="btn btn-success w-100 mt-2" onclick="calcular()">CALCULAR</button>
            <label CLASS="mt-3">MÉDIA</label>
            <input type="text" disabled="disabled" id="media" class="form-control">

            <label CLASS="mt-3">NOTA DA PROVA FINAL</label>
            <input type="text" disabled="disabled" id="resultado" class="form-control">

    </div>

    <script>
        function calcular(){

            var b1 = parseFloat(document.getElementById("b1").value.replace(",", "."))
            var b2 = parseFloat(document.getElementById("b2").value.replace(",", "."))
            var b3 = parseFloat(document.getElementById("b3").value.replace(",", "."))
            var b4 = parseFloat(document.getElementById("b4").value.replace(",", "."))

            var media = document.getElementById("media")
            var resultado = document.getElementById("resultado")

            var m = (b1 + b2 + b3 + b4)/4
            media.value = m.toFixed(2)

            if(m >= 7){
                resultado.value = 'Não Precisa'
            }else if(m >= 2){
                var pf = (30 - m*2)/3
                resultado.value = pf.toFixed(2)
            }else{
                resultado.value = 'Reprovado'
            }

        }
    </script>

</body>
</html>
