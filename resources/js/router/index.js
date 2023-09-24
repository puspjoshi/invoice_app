import {createRouter, createWebHistory} from "vue-router";

import invoiceIndex from '../components/invoice/index.vue';
import newInvoice from '../components/invoice/newInv.vue';
import showInvoice from '../components/invoice/show.vue';
import editInvoice from '../components/invoice/edit.vue';

import notFound from '../components/NotFound.vue';

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: invoiceIndex
        },
        {
              path: '/invoice/new',
              component: newInvoice
        },
        {
            path: '/invoice/show/:id',
            component: showInvoice,
            props:true
        },
        {
            path: '/invoice/edit/:id',
            component: editInvoice,
            props:true
        },
        {
            path: '/:pathMatch(.*)*',
            name: 'notfound',
            component: notFound
        }
    ]
});

export default router;
