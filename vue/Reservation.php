<?php
if (isset($_GET['plane'])) {
    $id = $_GET['plane'];
    $plane = new plane();
    $result = $plane->findSomeone($id);
} else {
    echo "avion innéxistant";
}
?>
<section>
    <div class="grid grid-cols-2 mt-20 gap-4">
        <div>
            <img class="w-3/4 m-auto" src="./assets/images/<?= $result[0]['image'] ?>" alt="<?= $result[0]['modele'] ?>">
        </div>
        <div>
            <h1 class="text-5xl text-white"><?= $result[0]['modele'] ?><?= $result[0]['marque'] ?></h1>
            <h2 class="text-2xl text-white"><?= $result[0]['type'] ?></h2>
            <p class="w-3/4 text-xl mt-2"><?= $result[0]['description'] ?></p>

        </div>
    </div>
    <div class="w-full bg-white mt-10">

        <div class="w-3/4 m-auto  p-2">
            <h2 class="text-5xl text-sky-800 w-full text-center">Choisir la date</h2>
            <div class="w-2/5 m-auto grid grid-cols-3 mt-10 mb-10">
                <div>
                    <div class="bg-gray-200 p-2 rounded-xl place-items-end w-1/2 m-auto cursor-pointer hover:bg-sky-200" onclick="RemoveMonth()">

                        <img src="./assets/images/chevron-left.svg" alt="right">
                    </div>
                </div>
                <h3 class="text-2xl text-gray-800 text-center " id="month"></h3>
                <div>
                    <div class="bg-gray-200 p-2 rounded-xl place-items-end w-1/2 m-auto cursor-pointer hover:bg-sky-200" onclick="AddMonth()">
                        <img src="./assets/images/chevron-right.svg" alt="right">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-7 mt-5">
                <div class="border border-white text-start p-2">Dimanche</div>
                <div class="border border-white text-start p-2 ">Lundi</div>
                <div class="border border-white text-start p-2">Mardi</div>
                <div class="border border-white text-start p-2">Mercredi</div>
                <div class="border border-white text-start p-2">Jeudi</div>
                <div class="border border-white text-start p-2">Vendredi</div>
                <div class="border border-white text-start p-2">Samedi</div>
            </div>
            <div class="grid grid-cols-7 mt-5" id="calendar"></div>
            <div class="p-2 bg-cyan-500 w-1/4 m-auto mt-2 text-center text-xl rounded-xl text-white cursor-pointer hover:bg-cyan-200" onclick="openForm(), Form()">Reservé</div>
        </div>
    </div>


</section>

<div class="hidden bg-gradient-to-r to-blue-500 bg-cyan-500 from-cyan-500 absolute z-90 w-full h-full" id="updateForm">
    <form action="" method="post">
        <div id="form">


        </div>
    </form>
</div>
<script>
    const months = [
        'Janvier',
        'Février',
        'Mars',
        'Avril',
        'Mai',
        'Juin',
        'Juillet',
        'Aout',
        'Septembre',
        'Octobre',
        'Novembre',
        'Decembre',
    ];
    var form;
    var today = new Date();
    var month = today.getMonth();
    var year = today.getFullYear();
    var firstDay;
    var lastDay;
    Give();
    var div = "<div class='border border-white p-2'></div>";
    var calendar = div;
    Fill();
    Write();
    var ChooseDate = [];

    function AddMonth() {
        month++;
        if (month > 11) {
            month = 0;
            year++;
        }
        Give();
        calendar = div;
        Fill();
        Write();
    }

    function RemoveMonth() {
        month--;
        if (month < 0) {
            month = 11;
            year--;
        }
        Give();
        calendar = div;
        Fill();
        Write();
    }

    function Fill() {
        if (firstDay.getDay() > 1) {
            for (let y = 2; y <= firstDay.getDay(); y++) {
                calendar += div;
            }
        }
        var Classe;
        for (let i = 1; i <= lastDay.getDate(); i++) {
            if (
                (firstDay.getFullYear() < today.getFullYear()) ||
                (firstDay.getFullYear() === today.getFullYear() && firstDay.getMonth() < today.getMonth()) ||
                (firstDay.getFullYear() === today.getFullYear() && firstDay.getMonth() === today.getMonth() && i < today.getDate())
            ) {
                Classe = "border border-sky-500 text-start p-2 pb-10 bg-gray-200";
            } else {
                Classe = "border border-sky-500 text-start p-2 pb-10 cursor-pointer hover:bg-sky-200";
            }
            calendar += "<div class='" + Classe + "' id='" + i + "/" + firstDay.getMonth() + "/" + firstDay.getFullYear() + "' " + " " + "onclick='Choose(event)'" + ">" + i + "</div>";
        }
    }

    function Write() {
        document.getElementById('month').innerText = months[firstDay.getMonth()];
        document.getElementById('calendar').innerHTML = calendar;
    }

    function Give() {
        firstDay = new Date(year, month, 1);
        lastDay = new Date(year, month + 1, 0);
    }

    function Choose(event) {
        var dateClique = event.target;
        var iddateClique = dateClique.id;
        var index = ChooseDate.indexOf(iddateClique);
        if (index !== -1) {
            ChooseDate.splice(index, 1);
            document.getElementById(iddateClique).classList.remove('bg-green-300');
        } else {
            document.getElementById(iddateClique).classList.add('bg-green-300');
            ChooseDate.push(iddateClique);
        }

    }

    function Form() {
    var form = "<h2>Confirmer Vos dates</h2>"
    for (let i = 0; i < ChooseDate.length; i++) {
        form += '<input class="placeholder:italic placeholder:text-slate-400 mt-2  block bg-white w-3/4 m-auto border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" type="date" name="reservation' + i + '" value="' + ChooseDate[i] + '"/>';
    }
    console.log(form); 
    document.getElementById('form').innerHTML = form;
} 

</script>