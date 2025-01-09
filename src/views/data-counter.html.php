<div>
    <h4 class="text-5xl uppercase font-bold text-center">dailtyrip c'est :</h4>
    <div class="m-auto text-center mb-20 grid grid-cols-3 mt-20 justify-items-center gap-5">
        <!-- Valeur ajoutée -->
        <div class=" border-r-4 p-5  w-full">
            <div id="counter-up-1" class="text-3xl font-bold">0</div>
            <div id="trigger" class=""></div>
            <p id="trigger-1" class="block text-3xl">kilomètres</p>
        </div>
        <div class=" border-r-4 p-5  w-full">
            <div id="counter-up-2" class=" text-3xl font-bold">0</div>
            <p id="trigger-2" class="block text-3xl">kilomètres</p>
        </div>
        <div class=" border-r-4 p-5  w-full">
            <div id="counter-up-3" class="text-3xl font-bold">0</div>
            <p id="trigger-3" class="block text-3xl">kilomètres</p>
        </div>
    </div>
</div>

<script type="text/javascript">
var counterUp1 = $("#counter-up-1");
var counterUp2 = $("#counter-up-2");
var counterUp3 = $("#counter-up-3");

counterUp1.counter({
    autoStart: true,
    duration: 1500,
    countTo: 800,
    countFrom: 0,
    placeholder: 0,
    easing: "easeOutExpo",
    onStart: function() {
        document.getElementById("trigger-1").innerHTML = "kilomètres"
    },
    onComplete: function() {
        document.getElementById("trigger-1").innerHTML = "kilomètres"
    }
});
counterUp2.counter({
    autoStart: true,
    duration: 1500,
    countTo: 76,
    countFrom: 0,
    placeholder: 0,
    easing: "easeOutExpo",
    onStart: function() {
        document.getElementById("trigger-2").innerHTML = "commentaires"
    },
    onComplete: function() {
        document.getElementById("trigger-2").innerHTML = "commentaires"
    }
});
counterUp3.counter({
    autoStart: true,
    duration: 1500,
    countTo: 32,
    countFrom: 0,
    placeholder: 0,
    easing: "easeOutExpo",
    onStart: function() {
        document.getElementById("trigger-3").innerHTML = "partages"
    },
    onComplete: function() {
        document.getElementById("trigger-3").innerHTML = "partages"
    }
});
</script>