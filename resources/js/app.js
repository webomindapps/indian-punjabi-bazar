import './bootstrap';
import {
    createApp,
    defineComponent
} from "vue";
import BookATime from "./components/timeslots/BookATime.vue";

// Root vue component
const root = defineComponent({});

//Create the app
const app = createApp(root);

//Attach global components to the app
app.component("book-time", BookATime);

//Mount the app
app.mount("#variant");
