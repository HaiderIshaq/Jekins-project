/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require("./bootstrap");

window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component("ibr", require("./components/IBR/Ibr.vue").default);
// import VueFormWizard from "vue-form-wizard";
// import "vue-form-wizard/dist/vue-form-wizard.min.css";
import Vuelidate from "vuelidate";
Vue.use(Vuelidate);
// Vue.use(VueFormWizard);

// import { FormWizard, TabContent } from "vue-form-wizard";
import { required, minLength } from "vuelidate/lib/validators";
import IBR from "./components/IBR/Ibr.vue";
import Debt from "./components/Debt/Debt.vue";
import Inspection from "./components/Inspection/Inspection.vue";
import IbrEdit from "./components/IBR/IbrEdit.vue";
import DebtEdit from "./components/Debt/DebtEdit.vue";
import Valuation from "./components/Valuation/Valuation.vue";
import Verification from "./components/Verification/Verification.vue";
import VerificationEdit from "./components/Verification/VerificationEdit.vue";
import Perfoma from "./components/Verification/Perfoma.vue";
import Geolocate from "./components/Verification/Geolocate.vue";
import ValuationEdit from "./components/Valuation/ValuationEdit.vue";
import InspectionEdit from "./components/Inspection/InspectionEdit.vue";
import BillingEdit from "./components/BillingEdit.vue";
import Billing from "./components/Billing.vue";
import BillingPrism from "./components/BillingPrism.vue";
import User from "./components/User/User.vue";
import Muccaduum from "./components/Muccaduum/Muccaduum.vue";
import MuccadumEdit from "./components/Muccaduum/MuccadumEdit.vue";
import Supervision from "./components/Supervision/Supervision.vue";
import SupervisionEdit from "./components/Supervision/SupervisionEdit.vue";
import Clearing from "./components/Clearing/Clearing.vue";
import ClearingEdit from "./components/Clearing/ClearingEdit.vue";
import BIR from "./components/Bir/Bir.vue";
import BIREdit from "./components/Bir/BirEdit.vue";
import IE from "./components/IE/IE.vue";
import IEEdit from "./components/IE/IEEdit.vue";
import LCR from "./components/Lcr/Lcr.vue";
import LcrEdit from "./components/Lcr/LcrEdit.vue";
import MCR from "./components/Mcr/Mcr.vue";
import McrEdit from "./components/Mcr/McrEdit.vue";
import MVR from "./components/Mvr/Mvr.vue";
import MvrEdit from "./components/Mvr/MvrEdit.vue";
import Stats from "./components/Stats/stats.vue";
import Legal_Service from "./components/Legal_Service/Legal_Service.vue";
import Legal_ServiceEdit from "./components/Legal_Service/Legal_ServiceEdit.vue";
import Invoices from "./components/Verification/Invoices.vue";
import Prism from "./components/Prism/Prism.vue";
import PrismEdit from "./components/Prism/PrismEdit.vue";
import PrismVehicle from "./components/Prism/PrismVehicle.vue";
import PrismInvoices from "./components/Prism/PrismInvoices.vue";
import PrismStats from "./components/Prism/PrismStats.vue";
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    components: {
        // FormWizard,
        // TabContent,
        required,
        minLength,
        ibr: IBR,
        "ibr-edit": IbrEdit,
        "debt-edit": DebtEdit,
        valuation: Valuation,
        "valuation-edit": ValuationEdit,
        "inspection-edit": InspectionEdit,
        "billing-edit": BillingEdit,
        "billing": Billing,
        "billing-prism": BillingPrism,
        "user": User,
        "debt": Debt,
        "inspection": Inspection,
        "verification": Verification,
        "perfoma": Perfoma,
        "verification-edit": VerificationEdit,
        "muccaduum": Muccaduum,
        "muccaduum-edit": MuccadumEdit,
        "stats": Stats,
        "supervision": Supervision,
        "supervision-edit": SupervisionEdit,
        "Clearing": Clearing,
        "clearing-edit": ClearingEdit,
        "bir": BIR,
        "bir-edit": BIREdit,
        "ie": IE,
        "ie-edit": IEEdit,
        "lcr": LCR,
        "lcr-edit": LcrEdit,
        "mcr": MCR,
        "mcr-edit": McrEdit,
        "mvr": MVR,
        "mvr-edit": MvrEdit,
        "legal-service": Legal_Service,
        "legal-service-edit": Legal_ServiceEdit,
        "geolocate": Geolocate,
        "invoices": Invoices,
        "prism": Prism,
        "prism-intimating": PrismEdit,
        "prism-vehicle": PrismVehicle,
        "prism-invoice":PrismInvoices,
        "prism-stats":PrismStats,
    }
});
