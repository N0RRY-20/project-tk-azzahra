import "./bootstrap";

// Impor Alpine.js dari node_modules
import Alpine from "alpinejs";

// Jadikan Alpine global agar bisa diakses dari file Blade Anda
window.Alpine = Alpine;

// "Nyalakan" Alpine.js
Alpine.start();
