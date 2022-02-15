<template>
    <section class="vh-100 bg-image">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Sign in</h2>

                                <form>
                                    <div class="form-outline mb-4">
                                        <span class="alert-danger" v-if="errors.username">{{
                                                errors.username[0]
                                            }}</span>
                                        <input v-model="form.username" type="text" id="form3Example5cg"
                                               class="form-control form-control-lg"/>
                                        <label class="form-label" for="form3Example5cg">Username</label>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <span class="alert-danger" v-if="errors.password">{{
                                                errors.password[0]
                                            }}</span>
                                        <input v-model="form.password" type="password" id="form3Example4cg"
                                               class="form-control form-control-lg"/>
                                        <label class="form-label" for="form3Example4cg">Password</label>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button @click.prevent="loginUser" type="button"
                                                class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">
                                            Login
                                        </button>
                                    </div>

                                    <p class="text-center text-muted mt-5 mb-0">Don't have an account?
                                        <router-link to="/register" class="fw-bold text-body"><u>Register here</u>
                                        </router-link>
                                    </p>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "Login",

    data() {
        return {
            form: {
                username: '',
                password: '',
            },
            errors: []
        }
    },beforeRouteEnter(to, from, next){
        axios.get('/api/authenticated').then(() => {
            next({name: 'Home'})
        }).catch(()=>{
            next()
        })
    },
    methods: {
        loginUser() {
            axios.post('/api/login/', this.form).then((res) => {
                if (res.data.success) {
                    this.$router.push({name: "Dashboard"})
                }else {
                    this.errors = res.data.data
                }
            }).catch((error) => {
                this.errors = error.response.data.errors;
            })
        }
    }
}
</script>

