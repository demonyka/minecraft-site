import {toast} from "vue3-toastify";
import "vue3-toastify/dist/index.css";
export function showMessage(message) {
    toast(message, {
        "theme": "colored",
        "autoClose": 3000,
        "role": "alert",
        "pauseOnHover": false,
        "closeButton": false,
        "hideProgressBar": true,
    });
}
