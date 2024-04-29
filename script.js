const probe = document.querySelectorAll("input[name='probe']");
const probe_ja = document.getElementById("ja");
const probe_nee = document.getElementById("nee");
const stand = document.getElementById("stand");
const preset = document.getElementById("preset");
const vleessoort = document.getElementById("vleessoort");
const temperatuur = document.getElementById("temperatuur");
const gaarheid = document.getElementById("gaarheid");
const target_temp = document.getElementById("target_temp");
const kooktijd = document.getElementById("kooktijd");

function check() {
    // probe conditions
    if ((stand.value === "dehydrate") || (stand.value === "")) {
        probe_nee.checked = true;
        probe.forEach((input) => {
            input.setAttribute("disabled", "");
        });
    } else {
        probe.forEach((input) => {
            input.removeAttribute("disabled");
        });
    }
    // preset conditions   
    if (probe_ja.checked === true) {
        preset.removeAttribute("disabled");
    } else {
        preset.value = "";
        preset.setAttribute("disabled", "");
    }
    // vleessoort conditions
    if ((preset.value === "small") || (preset.value === "large")) {
        vleessoort.removeAttribute("disabled");
    } else {
        vleessoort.value = "";
        vleessoort.setAttribute("disabled", "");
    }
    // gaarheid conditions
    if (vleessoort.value === "") {
        gaarheid.value = "";
        gaarheid.setAttribute("disabled", "");
    } else {
        gaarheid.removeAttribute("disabled");
        document.querySelectorAll("#gaarheid " + "option").forEach((option) => {
            option.setAttribute("disabled", "");
        });
        document.querySelectorAll("." + vleessoort.value).forEach((option) => {
            option.removeAttribute("disabled");
        });
        const checkGaarheid = document.querySelector("option[value='" + gaarheid.value + "']").className;
        if (!(checkGaarheid.includes(vleessoort.value))) {
            gaarheid.value = "";
        }
        if (vleessoort.value === "chicken") {
            gaarheid.value = "9-well";
        }
    }
    // TARGET TEMP conditions
    if (preset.value === "manual") {
        target_temp.removeAttribute("disabled");
    } else {
        target_temp.value = "";
        target_temp.setAttribute("disabled", "");
    }
    // Temperatuur conditions
    if ((probe_ja.checked === true) || stand.value === "") {
        temperatuur.setAttribute("disabled", "");
        temperatuur.value = "";
    } else {
        temperatuur.removeAttribute("disabled");
        if (stand.value === "max_crisp") {
            temperatuur.setAttribute("min", "240");
            temperatuur.setAttribute("max", "240");
            temperatuur.value = 240;
        }
        if (stand.value === "air_fry") {
            temperatuur.setAttribute("min", "150");
            temperatuur.setAttribute("max", "240");
            if ((temperatuur.value === "") || (temperatuur.value > 240) || (temperatuur.value < 150)) {
                temperatuur.value = 200;
            }
        }
        if (stand.value === "roast") {
            temperatuur.setAttribute("min", "120");
            temperatuur.setAttribute("max", "210");
            if ((temperatuur.value === "") || (temperatuur.value > 210) || (temperatuur.value < 120)) {
                temperatuur.value = 190;
            }
        }
        if (stand.value === "bake") {
            temperatuur.setAttribute("min", "120");
            temperatuur.setAttribute("max", "210");
            if ((temperatuur.value === "") || (temperatuur.value > 210) || (temperatuur.value < 120)) {
                temperatuur.value = 160;
            }
        }
        if (stand.value === "reheat") {
            temperatuur.setAttribute("min", "130");
            temperatuur.setAttribute("max", "210");
            if ((temperatuur.value === "") || (temperatuur.value > 210) || (temperatuur.value < 130)) {
                temperatuur.value = 170;
            }
        }
        if (stand.value === "dehydrate") {
            temperatuur.setAttribute("min", "40");
            temperatuur.setAttribute("max", "90");
            if ((temperatuur.value === "") || (temperatuur.value > 90) || (temperatuur.value < 40)) {
                temperatuur.value = 60;
            }
        }
    }
    // Kooktijd conditions
    if ((probe_ja.checked === true) || stand.value === "") {
        kooktijd.setAttribute("disabled", "");
        kooktijd.value = "";
    } else {
        kooktijd.removeAttribute("disabled");
        if (stand.value === "max_crisp") {
            kooktijd.setAttribute("min", "1");
            kooktijd.setAttribute("max", "30");
            if ((kooktijd.value === "") || (kooktijd.value > 30) || (kooktijd.value < 1)) {
                kooktijd.value = 10;
            }
        }
        if (stand.value === "air_fry") {
            kooktijd.setAttribute("min", "1");
            kooktijd.setAttribute("max", "90");
            if ((kooktijd.value === "") || (kooktijd.value > 90) || (kooktijd.value < 1)) {
                kooktijd.value = 20;
            }
        }
        if (stand.value === "roast") {
            kooktijd.setAttribute("min", "1");
            kooktijd.setAttribute("max", "240");
            if ((kooktijd.value === "") || (kooktijd.value > 240) || (kooktijd.value < 1)) {
                kooktijd.value = 15;
            }
        }
        if (stand.value === "bake") {
            kooktijd.setAttribute("min", "1");
            kooktijd.setAttribute("max", "240");
            if ((kooktijd.value === "") || (kooktijd.value > 240) || (kooktijd.value < 1)) {
                kooktijd.value = 15;
            }
        }
        if (stand.value === "reheat") {
            kooktijd.setAttribute("min", "1");
            kooktijd.setAttribute("max", "60");
            if ((kooktijd.value === "") || (kooktijd.value > 60) || (kooktijd.value < 1)) {
                kooktijd.value = 15;
            }
        }
        if (stand.value === "dehydrate") {
            kooktijd.setAttribute("min", "60");
            kooktijd.setAttribute("max", "720");
            if ((kooktijd.value === "") || (kooktijd.value > 720) || (kooktijd.value < 1)) {
                kooktijd.value = 360;
            }
        }
    }
}
document.querySelectorAll(".validate").forEach((element) => {
    element.addEventListener("change", () => {
        check();
    });
})

/*document.querySelector("body").addEventListener("click", () => {
    check();
});*/