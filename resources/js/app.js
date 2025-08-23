import "./bootstrap";

import Alpine from "alpinejs";
import focus from "@alpinejs/focus";
import combobox from "./components/combobox";
import datepicker from "./components/datepicker";

window.Alpine = Alpine;

Alpine.plugin(focus);
Alpine.data("combobox", combobox);
Alpine.data("datepicker", datepicker);

Alpine.start();
