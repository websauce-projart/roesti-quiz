/********************************
 * App JS
 ********************************/
require("./bootstrap");

import { createApp } from "vue";
import AvatarEditor from "./components/avatar/AvatarEditor.vue";
// import ElementScroller from "./components/avatar/ElementScroller.vue";


const avatarEditor = createApp({
    components: {
        AvatarEditor,
        // ElementScroller
    }
}).mount("#avatar-editor");
