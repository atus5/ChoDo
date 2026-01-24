import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import Default from "./layout/wrapper/index.vue";
import Client from "./layout/wrapper/client.vue";
import Blank from "./layout/wrapper/master_blank.vue";
import Toaster from "@meforma/vue-toaster";
import axios from "axios";
import { setupErrorInterceptor } from "./utils/errorHandler.js";

const app = createApp(App);

app.use(router);
const toaster = app.use(Toaster, {
  position: "top-right",
});
app.component("default-layout", Default);
app.component("client-layout", Client);
app.component("blank-layout", Blank);

// Setup global error interceptor
// Wait for router to be ready before setting up interceptor
router.isReady().then(() => {
  setupErrorInterceptor(router, app.config.globalProperties.$toast);
});

app.mount("#app");

