<template lang="">
    <div class="container my-5 p-5 rounded border-bottom-0">
        <div class="container">
            <AppLoader v-if="isLoading" />
            <div class="row">
                <div class="col-12">
                    <AppRestaurantDetails :restaurant="restaurant" />
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Menu ristorante -->
            <div class="col-12 col-md-7">
                <RestaurantMenu
                    :items="restaurant.items"
                    @change-items="getOrder"
                    @is-another="getModal"
                />
            </div>
            <!-- Carrello sticky -->
            <div class="col-12 col-md-5">
                <AppCart
                    :restaurant="restaurant"
                    :order="order"
                    @change-items="getOrder"
                ></AppCart>
            </div>
        </div>

        <!-- ! MODALE DA AGGIUNGERE DOPO -->
        <div ref="newCartModal" id="new-cart-modal">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Vuoi creare un nuovo carrello?</h5>
                    <p class="card-text">
                        In questo modo cancelli il carrello esistente e crei un
                        nuovo carrello.
                    </p>
                    <div
                        @click="closeModal"
                        href="#"
                        class="btn btn-primary mr-2"
                        ref="new-cart-modal-no"
                    >
                        Visualizza il menù
                    </div>
                    <div
                        @click="addNewProduct"
                        href="#"
                        class="btn btn-success"
                        ref="new-cart-modal-yes"
                    >
                        Nuovo carrello
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import RestaurantMenu from "../RestaurantMenu.vue";
import AppRestaurantDetails from "../AppRestaurantDetails.vue";
import AppCart from "../AppCart.vue";
import AppLoader from "../AppLoader.vue";

export default {
    name: "RestaurantPage",
    components: {
        AppCart,
        RestaurantMenu,
        AppRestaurantDetails,
        AppLoader,
    },
    data() {
        return {
            isLoading: false,
            restaurant: {},
            order: [],
            item: {},
        };
    },
    methods: {
        fetchRestaurant() {
            this.isLoading = true;
            axios
                .get(
                    `http://127.0.0.1:8000/api/restaurants/${this.$route.params.id}`
                )
                .then((res) => {
                    this.restaurant = res.data;
                })
                .catch((err) => {
                    this.error = "Errore durante il fetch dei ristoranti";
                })
                .then(() => {
                    this.isLoading = false;
                });
        },
        getOrder(value) {
            this.order = value;
            localStorage.setItem("ordine", JSON.stringify(this.order));
        },
        addNewProduct() {
            const order = [];

            const newProduct = {
                id: this.item.id,
                name: this.item.name,
                price: this.item.price,
                restaurant: this.item.restaurant_id,
                quantity: 1,
                total: this.item.price,
            };

            order.push(newProduct);
            this.getOrder(order);
            this.closeModal();
        },
        getModal(value) {
            document.body.classList.add("overflow-hidden");
            this.$refs.newCartModal.classList.add("d-block");
            this.item = value;
        },
        closeModal() {
            document.body.classList.remove("overflow-hidden");
            this.$refs.newCartModal.classList.remove("d-block");
        },
    },
    mounted() {
        this.fetchRestaurant();
        this.order = JSON.parse(localStorage.getItem("ordine"));
    },
};
</script>
<style lang="scss" scoped>
#new-cart-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background-color: rgba($color: #000000, $alpha: 0.4);

    .card {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        z-index: 10;
    }
}
.container {
    background-color: rgb(255, 255, 255);
}
</style>
