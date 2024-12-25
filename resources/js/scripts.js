import {toast} from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import Checkmark from "@/Components/Icons/Checkmark.vue";
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

export function showAchievement(message, icon = false) {
    toast(message, {
        "theme": "colored",
        "autoClose": 3000,
        "role": "alert",
        "pauseOnHover": false,
        "closeButton": false,
        "hideProgressBar": true,
        "toastClassName": "achievement",
        "icon": icon
    })
}
