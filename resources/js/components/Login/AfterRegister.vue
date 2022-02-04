<template>
    <section class="vh-100 bg-image">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <div class="text-center text-muted mt-5 mb-0">
                                     <h4>Please check your email to complete your registration !</h4>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <router-link to="/"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">
                                        Go to Home
                                    </router-link>
                                </div>
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
    name: "AfterRegister"
}
</script>

