<script setup>
    import {onMounted, ref} from "vue";

    import router from "../../router/index.js";
    let form = ref([]);
    let allCustomers = ref([]);
    let customer_id = ref([]);

    let item = ref([]);
    let listCart = ref([]);

    const showModel = ref(false);
    const hideModel = ref(true);

    let listProducts = ref([]);

    onMounted(async ()=>{
        indexForm();
        getAllCustromers();
        getProduct();
    });
    const indexForm = async ()=>{
        let response = await axios.get('/api/create_invoice');
        // console.log('form',response.data);
        form.value = response.data;
    }
    const getAllCustromers = async ()=>{
        let response = await axios.get('/api/customers');
        //console.log('response',response);
        allCustomers.value = response.data.customers;
    }
    const addCart = (item) => {
        const itemCart = {
            id: item.id,
            item_code: item.item_code,
            description: item.description,
            unit_price: item.unit_price,
            quantity: item.quantity
        }
        listCart.value.push(itemCart);
        closeModel();
    }
    const removeItem = (i) => {
        listCart.value.splice(i,1);
    }
    const openModel = () =>{
        showModel.value = !showModel.value;
    }
    const closeModel = () =>{
        showModel.value = !hideModel.value;
    }

    const getProduct = async () => {
        let response = await axios.get('/api/products');
        console.log('resp',response);
        listProducts.value = response.data.products;
    }

    const subTotal = () =>{
        let total  = 0;
        listCart.value.map((data)=>{
            total = total + (data.quantity *data.unit_price)
        });
        return total;
    }

    const Total = () => {
        return subTotal() - form.value.discount;
    }

    const onSave = () =>{
        if(listCart.value.length >= 1 ){
            let subtotal = 0;
            subtotal = subTotal();
            let total = 0;
            total = Total();

            const formData = new FormData();
            formData.append('invoice_item', JSON.stringify(listCart.value));
            formData.append('customer_id', customer_id.value );
            formData.append('date', form.value.date);
            formData.append('due_date', form.value.due_date);
            formData.append('number', form.value.number);
            formData.append('reference', form.value.reference);
            formData.append('discount', form.value.discount);
            formData.append('sub_total', subtotal);
            formData.append('total', total);
            formData.append('terms_and_conditions', form.value.terms_and_conditions);

            axios.post("/api/add_invoice", formData);
            listCart.value=[];
            router.push('/');
        }
    }
</script>
<template>
    <div class="container">
        <div class="invoices">

            <div class="card__header">
                <div>
                    <h2 class="invoice__title">New Invoice</h2>
                </div>
                <div>

                </div>
            </div>

            <div class="card__content">
                <div class="card__content--header">
                    <div>
                        <p class="my-1">Customer</p>
                        <select name="" id="" class="input" v-model="customer_id">
                            <option disabled>Select Customer</option>
                            <option :value="customer.id" v-for="customer in allCustomers" :key="customer.id">{{ customer.firstname}}</option>
                        </select>
                    </div>
                    <div>
                        <p class="my-1">Date</p>
                        <input id="date" placeholder="dd-mm-yyyy" type="date" class="input" v-model="form.date"> <!---->
                        <p class="my-1">Due Date</p>
                        <input id="due_date" type="date" class="input" v-model="form.due_date">
                    </div>
                    <div>
                        <p class="my-1">Numero</p>
                        <input type="text" class="input" v-model="form.number">
                        <p class="my-1">Reference(Optional)</p>
                        <input type="text" class="input" v-model="form.reference">
                    </div>
                </div>
                <br><br>
                <div class="table">

                    <div class="table--heading2">
                        <p>Item Description</p>
                        <p>Unit Price</p>
                        <p>Qty</p>
                        <p>Total</p>
                        <p></p>
                    </div>

                    <!-- item 1 -->
                    <div class="table--items2" v-for="(itemcart, i) in listCart" :key="itemcart.id">
                        <p>{{ itemcart.item_code }} {{ itemcart.description}}</p>
                        <p>
                            <input type="text" class="input" v-model="itemcart.unit_price" >
                        </p>
                        <p>
                            <input type="text" class="input" v-model="itemcart.quantity">
                        </p>
                        <p v-if="itemcart.quantity">
                            $ {{ (itemcart.quantity) * (itemcart.unit_price) }}
                        </p>
                        <p v-else></p>
                        <p style="color: red; font-size: 24px;cursor: pointer;" @click="removeItem(i)">
                            &times;
                        </p>
                    </div>
                    <div style="padding: 10px 30px !important;">
                        <button class="btn btn-sm btn__open--modal" @click="openModel()">
                            Add New Line
                        </button>
                    </div>
                </div>

                <div class="table__footer">
                    <div class="document-footer" >
                        <p>Terms and Conditions</p>
                        <textarea cols="50" rows="7" class="textarea" v-model="form.terms_and_conditions"></textarea>
                    </div>
                    <div>
                        <div class="table__footer--subtotal">
                            <p>Sub Total</p>
                            <span>$ {{ subTotal() }}</span>
                        </div>
                        <div class="table__footer--discount">
                            <p>Discount</p>
                            <input type="text" class="input" v-model="form.discount">
                        </div>
                        <div class="table__footer--total">
                            <p>Grand Total</p>
                            <span>$ {{ Total() }}</span>
                        </div>
                    </div>
                </div>


            </div>
            <div class="card__header" style="margin-top: 40px;">
                <div>

                </div>
                <div>
                    <a class="btn btn-secondary" @click="onSave()">
                        Save
                    </a>
                </div>
            </div>

        </div>
        <!--==================== add modal items ====================-->
        <div class="modal main__modal " :class="{ show: showModel }">
            <div class="modal__content">
                <span class="modal__close btn__close--modal" @click="closeModel()">×</span>
                <h3 class="modal__title">Add Item</h3>
                <hr><br>
                <div class="modal__items">
                    <ul style="list-style: none">
                        <li v-for="(item, i) in listProducts" :key="item.id" style="display: grid; grid-template-columns:30px 350px 15px; align-items:center; padding-bottom: 5px;  ">
                            <p> {{ i+1 }}</p>
                            <a href="#"> {{ item.item_code }} {{ item.description }}</a>
                            <button @click="addCart(item)" style="border: 1px solid #000000; padding: 5px;">
                                +
                            </button>
                        </li>
                    </ul>
                </div>
                <br><hr>
                <div class="model__footer">
                    <button class="btn btn-light mr-2 btn__close--modal" @click="closeModel()">
                        Cancel
                    </button>
                    <button class="btn btn-light btn__close--modal ">Save</button>
                </div>
            </div>
        </div>

        <br><br><br>
    </div>
</template>
