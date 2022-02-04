<template>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <side-menu></side-menu>
            <div class="col py-3">
                Welcome to the dashboard !
            </div>
        </div>
    </div>
</template>

<script>
import SideMenu from "../Layouts/SideMenu";
export default {
    name: "Dashboard",
    components: {SideMenu},
    beforeRouteEnter(to, from, next) {
        axios.get('/api/user').then((response) => {
            if (response.data.role === "editor") {
                next()
            } else {
                next({name: 'Home'})
            }
        })
    }
}
</script>

