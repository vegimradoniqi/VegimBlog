<template>
    <section class="vh-100 bg-image">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Create an account</h2>
                                    <div class="form-outline mb-4">
                                        <span class="alert-danger" v-if="errors.username">{{ errors.username[0] }}</span>
                                        <input v-model="form.username" type="text" id="form3Example5cg" class="form-control form-control-lg"/>
                                        <label class="form-label" for="form3Example5cg">Username</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <span class="alert-danger" v-if="errors.firstname">{{ errors.firstname[0] }}</span>
                                        <input v-model="form.firstname" type="text" id="form3Example1cg" class="form-control form-control-lg"/>
                                        <label class="form-label" for="form3Example1cg">Your First Name</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <span class="alert-danger" v-if="errors.lastname">{{ errors.lastname[0] }}</span>
                                        <input v-model="form.lastname" type="text" id="form3Example2cg" class="form-control form-control-lg"/>
                                        <label class="form-label" for="form3Example2cg">Your Last Name</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <span class="alert-danger" v-if="errors.email">{{ errors.email[0] }}</span>
                                        <input v-model="form.email" type="email" id="form3Example3cg" class="form-control form-control-lg"/>
                                        <label class="form-label" for="form3Example3cg">Your Email</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <span class="alert-danger" v-if="errors.password">{{ errors.password[0] }}</span>
                                        <input v-model="form.password" type="password" id="form3Example4cg"
                                               class="form-control form-control-lg"/>
                                        <label class="form-label" for="form3Example4cg">Password</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <span class="alert-danger" v-if="errors.password_confirmation">{{ errors.password_confirmation[0] }}</span>
                                        <input v-model="form.password_confirmation" type="password" id="form3Example4cdg"
                                               class="form-control form-control-lg"/>
                                        <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button @click.prevent="saveForm" type="button"
                                                class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">
                                            Register
                                        </button>
                                    </div>

                                    <p class="text-center text-muted mt-5 mb-0">Have already an account?
                                        <router-link to="/login" class="fw-bold text-body"><u>Login here</u>
                                        </router-link>
                                    </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios'
export default {
    name: "Register",
    data(){
        return {
            form:{
                username: null,
                firstname: null,
                lastname: null,
                email: null,
                password: null,
                password_confirmation: null,
            },
            errors:[]
        }
    },
    methods: {
        saveForm(){
            axios.post('/api/register/',this.form).then((res)=>{
                if (res.data.success){
                    this.$router.push({name:'AfterRegister'})
                } else {
                    this.errors = res.data.data
                }

            }).catch((error) => {
                this.errors = error.response.data.errors;
            })
        }
    }
}
</script>
