<template>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <side-menu></side-menu>
            <div class="col py-3">
                Welcome to the Users Manage !
            </div>
        </div>
    </div>
</template>

<script>
import SideMenu from "../Layouts/SideMenu";
export default {
    name: "Users",
    components: {SideMenu}
}
</script>

<style scoped>

</style>
