import './bootstrap';

// Import Flowbite
import 'flowbite';

// Import Flowbite Datepicker
import 'flowbite-datepicker';

// Import SweetAlert2
import Swal from 'sweetalert2';

// Import RemixIcon CSS
import 'remixicon/fonts/remixicon.css';

// Import Lucide
import { createIcons, icons } from 'lucide';

// Make SweetAlert2 globally available
window.Swal = Swal;

// Initialize Lucide icons
document.addEventListener('DOMContentLoaded', function() {
    createIcons(icons);
});
