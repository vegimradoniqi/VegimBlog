<template>
    <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
        <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
            <a href="/"
               class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-5 d-none d-sm-inline">Menu</span>
            </a>
            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                id="menu">
                <li class="nav-item">
                    <router-link to="/" class="nav-link align-middle px-0">
                        <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                    </router-link>
                </li>
                <li>
                    <router-link to="/blogs-manage" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Blogs</span></router-link>
                </li>

                <li>
                    <router-link to="/users-manage" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Users</span> </router-link>
                </li>
            </ul>
            <hr>
            <div class="dropdown pb-4">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                    id="menu">
                    <li class="nav-item">
                        <a @click="logout" class="nav-link align-middle px-0">
                            <i class="bi bi-toggle-off"></i> <span
                            class="ms-1 d-none d-sm-inline">Log Out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SideMenu",
    methods : {
        logout() {
            axios.get('/api/logout').then(()=>{
                this.$router.push({name:'Home'})
            }).catch((error)=>{
                console.log(error)
            })
        }
    }
}
</script>
